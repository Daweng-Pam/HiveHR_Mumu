<?php

namespace App\Filament\ProjectManager\Resources\ProjectResource\Pages;

use App\Filament\ProjectManager\Resources\ProjectResource;
use Filament\Actions;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;

class ListProjects extends ListRecords
{
    protected static string $resource = ProjectResource::class;

    protected function getHeaderActions(): array
    {
        return [
//            Actions\CreateAction::make(),
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return [
            ProjectResource\Widgets\ProjectStats::class,
        ];
    }

    public function getTabs(): array
    {
        return [
            'All' => Tab::make(),
            'Pending' => Tab::make()->modifyQueryUsing(function (\Illuminate\Database\Eloquent\Builder $query) {
                $query->where('project_manager_id', auth()->user()->id)->where('status', '=', 'pending');
            }),
            'Ongoing' => Tab::make()->modifyQueryUsing(function (\Illuminate\Database\Eloquent\Builder $query) {
                $query->where('project_manager_id', auth()->user()->id)->where('status', '=', 'ongoing');
            }),
            'Completed' => Tab::make()->modifyQueryUsing(function (\Illuminate\Database\Eloquent\Builder $query) {
                $query->where('project_manager_id', auth()->user()->id)->where('status', '=', 'completed');
            }),
        ];
    }
}
