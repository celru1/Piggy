<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;

class AdminDashboard extends Page
{
    protected static ?string $navigationIcon = 'heroicon-m-home';
    protected static string $view = 'filament.pages.admin-dashboard';
    protected static ?string $title = 'Admin Dashboard';

    // URL path sa browser /admin-dashboard after login
    protected static ?string $slug = 'admin-dashboard';

    // Only show for admins
    public static function canAccess(): bool
    {
        return auth()->user()?->role === 'admin';
    }

}
