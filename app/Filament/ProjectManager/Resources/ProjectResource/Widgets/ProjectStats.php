<?php

namespace App\Filament\ProjectManager\Resources\ProjectResource\Widgets;

use App\Models\Project;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class ProjectStats extends BaseWidget
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
        ];
    }
}
