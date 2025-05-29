<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Response; // <-- Keep this for abort_if
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log; // <-- Add Log facade
use Inertia\Inertia;
use Inertia\Response as InertiaResponse;
use Illuminate\Support\Facades\App; // <-- Import App facade (or use app() helper)

class PageController extends Controller
{
    public function show(string $slug): InertiaResponse
    {
        // Get the current locale
        $locale = App::getLocale(); // Or use app()->getLocale()

        $item = Cache::rememberForever('page.' . $locale . '.' . $slug,
            function () use ($slug, $locale) {
                Log::debug("[PageController] Attempting to resolve slug: '{$slug}' for locale: '{$locale}'");

                $pathSegments = explode('/', $slug);
                $leafSlug = array_pop($pathSegments);
                Log::debug("[PageController] leafSlug: '{$leafSlug}', pathSegments: " . json_encode($pathSegments));

                $page = Page::published() // <-- Use standard published() scope
                    ->forSlug($leafSlug) // This already considers locale via app()->getLocale()
                    ->first();

                if (!$page) {
                    Log::warning("[PageController] Leaf page with slug '{$leafSlug}' not found or not published.");
                    return null;
                }
                Log::debug("[PageController] Found leaf page: ID {$page->id}, Title '{$page->title}'");

                $tempParent = $page->parent;
                for ($i = count($pathSegments)-1; $i >= 0; $i--){
                    $expectedParentSlug = $pathSegments[$i];
                    Log::debug("[PageController] Checking parent segment: expected '{$expectedParentSlug}'");

                    if (!$tempParent) {
                        Log::warning("[PageController] Expected parent '{$expectedParentSlug}', but tempParent is null.");
                        return null;
                    }
                    Log::debug("[PageController] Current tempParent: ID {$tempParent->id}, Slug '{$tempParent->slug}' (Title: '{$tempParent->title}')");
                    if ($tempParent->slug !== $expectedParentSlug){
                        Log::warning("[PageController] Slug mismatch: tempParent slug '{$tempParent->slug}' (ID {$tempParent->id}) !== expected '{$expectedParentSlug}'.");
                        return null;
                    }
                    $tempParent = $tempParent->parent;
                }

                if ($tempParent !== null) {
                    Log::warning("[PageController] tempParent is not null after loop, indicating an issue with path depth. tempParent ID: {$tempParent->id}");
                    return null;
                }
                
                // If we reach here, the page is found, it's publishedInListings, and its ancestry matches the path.
                $page->load('translations', 'medias', 'blocks');
                // Pass locale explicitly if computeBlocks needs it immediately
                // though it defaults to app()->getLocale() anyway
                $page->computeBlocks($locale);
                Log::info("[PageController] Successfully resolved page: ID {$page->id} for slug '{$slug}'");
                return $page;
            }
        );

        // Add check for null item after cache retrieval
        abort_if($item === null, Response::HTTP_NOT_FOUND);

        return Inertia::render('Page', [ // Or 'Pages' if that's your component name
            'item' => $item->only($item->publicAttributes),
            'locale' => $locale, // <--- ADD THIS LINE
        ]);
    }
}
