<?php

namespace App\Filament\Widgets;

use App\Models\Task;
use Filament\Widgets\ChartWidget;
use Illuminate\Database\Eloquent\Builder;

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
                    'data' => [Task::where('status', 'completed') ->whereHas('project', function (Builder $query) {
                        $query->where('company_id', '=', auth()->user()->id);
                    })->count(), Task::where('status', 'ongoing') ->whereHas('project', function (Builder $query) {
                        $query->where('company_id', '=', auth()->user()->id);
                    })->count(), Task::where('status', 'pending') ->whereHas('project', function (Builder $query) {
                        $query->where('company_id', '=', auth()->user()->id);
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
