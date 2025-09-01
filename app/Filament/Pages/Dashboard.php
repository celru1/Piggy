<?php

namespace App\Filament\Pages;

use Filament\Facades\Filament;
use Filament\Pages\Page;

class Dashboard extends Page
{
    protected static ?string $slug = 'dashboard';
    protected static ?string $navigationIcon = 'heroicon-s-home';

    protected static string $view = 'filament.pages.dashboard';

    //Only users role can access this page
    public static function canAccess(): bool
    {
        return auth()->check() && auth()->user()->role === 'user';
    }

}
