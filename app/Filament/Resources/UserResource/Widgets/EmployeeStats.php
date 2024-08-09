<?php

namespace App\Filament\Resources\UserResource\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class EmployeeStats extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            // show the total number of users
            Stat::make('Total Employees', \App\Models\User::where('role', '=', 2)->where('selected_company', '=', auth()->user()->id)->count())
                ->descriptionIcon('heroicon-m-users')
                ->color('primary')
                ->description('Employees Count'),

            // show the total number of users who are verified
            Stat::make('Verified Employees', \App\Models\User::where('role', '=', 2)->where('selected_company', '=', auth()->user()->id)->where('approved', '=', 1)->count())
                ->descriptionIcon('heroicon-o-check-badge')
                ->color('success')
                ->description('Verified Employee Count'),

            // show the total number of users who are not verified
            Stat::make('Unverified Employees', \App\Models\User::where('role', '=', 2)->where('selected_company', '=', auth()->user()->id)->where('approved', '=', 0)->count())
                ->descriptionIcon('heroicon-o-x-circle')
                ->color('danger')
                ->description('Unverified Employee Count'),
        ];
    }
}
