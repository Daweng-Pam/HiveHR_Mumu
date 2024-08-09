<?php

namespace App\Filament\Employee\Resources\TaskResource\Pages;

use App\Filament\Employee\Resources\TaskResource;
use Filament\Actions;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;

class ListTasks extends ListRecords
{
    protected static string $resource = TaskResource::class;

    protected function getHeaderActions(): array
    {
        return [
//            Actions\CreateAction::make(),
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return [
            TaskResource\Widgets\TaskStats::class,
        ];
    }

    public function getTabs(): array
    {
        return [
            'All' => Tab::make(),
            'Pending' => Tab::make()->modifyQueryUsing(function (\Illuminate\Database\Eloquent\Builder $query) {
                $query->where('assigned_employee', auth()->user()->id)->where('status', '=', 'pending');
            }),
            'Ongoing' => Tab::make()->modifyQueryUsing(function (\Illuminate\Database\Eloquent\Builder $query) {
                $query->where('assigned_employee', auth()->user()->id)->where('status', '=', 'ongoing');
            }),
            'Completed' => Tab::make()->modifyQueryUsing(function (\Illuminate\Database\Eloquent\Builder $query) {
                $query->where('assigned_employee', auth()->user()->id)->where('status', '=', 'completed');
            }),
        ];
    }
}
