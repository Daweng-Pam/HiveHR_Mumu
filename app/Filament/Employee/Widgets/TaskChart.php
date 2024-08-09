<?php

namespace App\Filament\Employee\Widgets;

use App\Models\Task;
use Filament\Widgets\ChartWidget;

class TaskChart extends ChartWidget
{
    protected static ?string $heading = 'Advanced Tasks Details';

    protected function getData(): array
    {
        return [
            'labels' => ['Completed', 'In Progress', 'Not Started'],
            'datasets' => [
                [
                    'label' => 'Tasks',
                    'data' => [Task::where('status', 'completed')->where('assigned_employee', auth()->user()->id)->count(), Task::where('status', 'ongoing')->where('assigned_employee', auth()->user()->id)->count(), Task::where('status', 'pending')->where('assigned_employee', auth()->user()->id)->count()],
                    'backgroundColor' => ['#4CAF50', '#FFC107', '#F44336'],
                ],
            ]
        ];

    }

    protected function getType(): string
    {
        return 'doughnut';
    }
}
