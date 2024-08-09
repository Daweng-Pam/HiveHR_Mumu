<?php

namespace App\Filament\ProjectManager\Widgets;

use App\Models\Project;
use App\Models\Task;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Database\Eloquent\Builder;

class DashboardStats extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Pending Projects', Project::where('project_manager_id', auth()->user()->id)->where('status', 'pending')->count())
                ->description('PENDING')
                ->descriptionIcon('heroicon-o-clock')
                ->color('danger'),
            Stat::make('Ongoing Projects', Project::where('project_manager_id', auth()->user()->id)->where('status', 'ongoing')->count())
                ->description('ONGOING')
                ->descriptionIcon('heroicon-o-pencil')
                ->color('primary'),
            Stat::make('Completed Projects', Project::where('project_manager_id', auth()->user()->id)->where('status', 'completed')->count())
                ->description('COMPLETED')
                ->descriptionIcon('heroicon-o-check-circle')
                ->color('success'),



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
