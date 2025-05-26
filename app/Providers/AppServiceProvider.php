<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use A17\Twill\Facades\TwillNavigation;
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
    ->donotAddSelfAsFirstChild()
    ->setChildren([
        NavigationLink::make()
        ->title(Str::ucfirst(__('home')))
        ->forSingleton('pageHome'),
    ]),
);
    }
}
