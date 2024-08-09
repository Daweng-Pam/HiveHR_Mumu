<?php

namespace App\Filament\Employee\Widgets;

use App\Models\Project;
use Filament\Widgets\ChartWidget;
use Illuminate\Database\Eloquent\Builder;

class ProjectChart extends ChartWidget
{
    protected static ?string $heading = 'Advanced Project Details';

//    protected static ?string $maxHeight = '300px';

    protected function getData(): array
    {
        return [
            'labels' => ['Completed', 'In Progress', 'Not Started'],
            'datasets' => [
                [
                    'label' => 'Projects',
                    'data' => [Project::where('status', 'completed')->whereHas('teamMembers', function (Builder $query) {
                        $query->where('users.id', '=', auth()->user()->id);
                    })->count(), Project::where('status', 'ongoing')->whereHas('teamMembers', function (Builder $query) {
                        $query->where('users.id', '=', auth()->user()->id);
                    })->count(), Project::where('status', 'pending')->whereHas('teamMembers', function (Builder $query) {
                        $query->where('users.id', '=', auth()->user()->id);
                    })->count()],
                    'backgroundColor' => ['#4CAF50', '#FFC107', '#F44336'],
                ],
            ],
        ];
    }

    protected function getType(): string
    {
        return 'doughnut';
    }
}
