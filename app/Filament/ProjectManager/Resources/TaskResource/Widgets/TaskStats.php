<?php

namespace App\Filament\ProjectManager\Resources\TaskResource\Widgets;

use App\Models\Task;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Database\Eloquent\Builder;

class TaskStats extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Pending Tasks', Task::where('status', 'pending') ->whereHas('project', function (Builder $query) {
                $query->where('company_id', '=', auth()->user()->selected_company);
            })->count())
                ->description('PENDING')
                ->descriptionIcon('heroicon-o-clock')
                ->color('danger'),
            Stat::make('Ongoing Tasks', Task::where('status', 'ongoing') ->whereHas('project', function (Builder $query) {
                $query->where('company_id', '=', auth()->user()->selected_company);
            })->count())
                ->description('ONGOING')
                ->descriptionIcon('heroicon-o-pencil')
                ->color('primary'),
            Stat::make('Completed Tasks', Task::where('status', 'completed') ->whereHas('project', function (Builder $query) {
                $query->where('company_id', '=', auth()->user()->selected_company);
            })->count())
                ->description('COMPLETED')
                ->descriptionIcon('heroicon-o-check-circle')
                ->color('success'),
        ];
    }
}
