<?php

namespace App\Filament\Widgets;

use App\Models\Project;
use Filament\Widgets\ChartWidget;

class ProjectChart extends ChartWidget
{
    protected static ?string $heading = 'Advanced Project Details';

    protected function getData(): array
    {
        return [
            'labels' => ['Completed', 'In Progress', 'Not Started'],
            'datasets' => [
                [
                    'label' => 'Projects',
                    'data' => [
                        Project::where('company_id', auth()->user()->id)->where('status', 'pending')->count(),
                        Project::where('company_id', auth()->user()->id)->where('status', 'ongoing')->count(),
                        Project::where('company_id', auth()->user()->id)->where('status', 'completed')->count()
                    ],
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
