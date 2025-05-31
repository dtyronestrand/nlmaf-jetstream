<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use A17\Twill\Facades\TwillNavigation;
use A17\Twill\Services\Assets\Twill;
use A17\Twill\View\Components\Navigation\NavigationLink;
use Illuminate\Database\Eloquent\Relations\Relation;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
   TwillNavigation::addLink(
    NavigationLink::make()
    ->title(Str::ucfirst(__('content')))
    ->forSingleton('pageHome')
    ->doNotAddSelfAsFirstChild()
    ->setChildren([
        NavigationLink::make()
        ->title(Str::ucfirst(__('home')))
        ->forSingleton('pageHome'),
        NavigationLink::make()
        ->title(Str::ucfirst(__('Pages')))
        ->forModule('page'),
        NavigationLink::make()
        ->title(Str::ucfirst(__('Programs')))
        ->forModule('programs'),
        NavigationLink::make()
        ->title(Str::ucfirst(__('News')))
        ->forModule('news')
    ]),
);
TwillNavigation::addLink(
     NavigationLink::make()
        ->title(Str::ucfirst(__(' Menus')))
        ->forModule('menuLinks')
        ->doNotAddSelfAsFirstChild()
        ->setChildren([
            NavigationLink::make(
            )
            ->title(Str::ucfirst(__('Main')))
            ->forModule('menuLinks'),
            NavigationLink::make()
            ->title(Str::ucfirst(__('Dashboard Menu')))
            ->forModule('sidemenu'),
            NavigationLink::make()
            ->title(Str::ucfirst(__('TKD Menu')))
            ->forModule('tkdmenu'),
            ]),
);

        Relation::enforceMorphMap([
            'page' => 'App\Models\Page',
            'pageHome' => 'App\Models\PageHome',
            'menuLink' => 'App\Models\MenuLink',
            'program' => 'App\Models\Program',
            'news' => 'App\Models\News',
            'sidemenu' => 'App\Models\Sidemenu',
            'tkdmenu' => 'App\Models\Tkdmenu',
        ]);
    }
}
