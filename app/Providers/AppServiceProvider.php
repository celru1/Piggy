<?php

namespace App\Providers;

use Filament\Support\Facades\FilamentView;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {

        $this->app->singleton(
            \Filament\Http\Responses\Auth\Contracts\LogoutResponse::class,
            \App\Http\Responses\LogoutResponse::class
        );

        $this->app->singleton(
            \Filament\Http\Responses\Auth\Contracts\LoginResponse::class,
            \App\Http\Responses\LoginResponse::class
        );

        $this->app->singleton(
            \Filament\Http\Responses\Auth\Contracts\RegistrationResponse::class,
            \App\Http\Responses\RegisterResponse::class
        );


        //e inject ang compiled javascript kung magrun sa terminal ug npm run dev or build to the admin panel
        parent::register();
        FilamentView::registerRenderHook('panels::body.end', fn(): string => Blade::render("@vite('resources/js/app.js')"));


    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
