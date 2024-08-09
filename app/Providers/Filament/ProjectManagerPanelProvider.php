<?php

namespace App\Providers\Filament;

use App\Http\Middleware\VerifyIsProjectManagerMiddleware;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Navigation\NavigationItem;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class ProjectManagerPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->id('project-manager')
            ->path('project-manager')
            ->colors([
                'primary' => Color::Blue,
            ])
            ->navigationItems([
                NavigationItem::make('Edit Profile')
                    ->url('/user/profile')
                    ->icon('heroicon-o-pencil-square')
                    ->group('Settings')
            ])
            ->sidebarCollapsibleOnDesktop()
            ->discoverResources(in: app_path('Filament/ProjectManager/Resources'), for: 'App\\Filament\\ProjectManager\\Resources')
            ->discoverPages(in: app_path('Filament/ProjectManager/Pages'), for: 'App\\Filament\\ProjectManager\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/ProjectManager/Widgets'), for: 'App\\Filament\\ProjectManager\\Widgets')
            ->widgets([
//                Widgets\AccountWidget::class,
//                Widgets\FilamentInfoWidget::class,
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
                VerifyIsProjectManagerMiddleware::class
            ])
            ->authMiddleware([
                Authenticate::class,
            ]);
    }
}
