<?php

namespace App\Filament\Employee\Resources\TaskResource\Widgets;

use App\Models\Task;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Database\Eloquent\Builder;

class TaskStats extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Pending Tasks', Task::where('status', 'pending')->where('assigned_employee', auth()->user()->id)->count())
                ->description('PENDING')
                ->descriptionIcon('heroicon-o-clock')
                ->color('danger'),
            Stat::make('Ongoing Tasks', Task::where('status', 'ongoing')->where('assigned_employee', auth()->user()->id)->count())
                ->description('ONGOING')
                ->descriptionIcon('heroicon-o-pencil')
                ->color('primary'),
            Stat::make('Completed Tasks', Task::where('status', 'completed')->where('assigned_employee', auth()->user()->id)->count())
                ->description('COMPLETED')
                ->descriptionIcon('heroicon-o-check-circle')
                ->color('success'),
        ];
    }
}
