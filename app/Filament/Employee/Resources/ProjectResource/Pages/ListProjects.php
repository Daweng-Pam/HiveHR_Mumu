<?php

namespace App\Filament\Employee\Resources\ProjectResource\Pages;

use App\Filament\Employee\Resources\ProjectResource;
use Filament\Actions;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;

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
            'All' => Tab::make()->modifyQueryUsing(function (\Illuminate\Database\Eloquent\Builder $query) {
                $query->whereHas('teamMembers', function (Builder $query) {
                    $query->where('users.id', '=', auth()->user()->id);
                });
            }),
            'Pending' => Tab::make()->modifyQueryUsing(function (\Illuminate\Database\Eloquent\Builder $query) {
                $query->where('status', '=', 'pending')->whereHas('teamMembers', function (Builder $query) {
                    $query->where('users.id', '=', auth()->user()->id);
                });
            }),
            'Ongoing' => Tab::make()->modifyQueryUsing(function (\Illuminate\Database\Eloquent\Builder $query) {
                $query->where('status', '=', 'ongoing')->whereHas('teamMembers', function (Builder $query) {
                    $query->where('users.id', '=', auth()->user()->id);
                });
            }),
            'Completed' => Tab::make()->modifyQueryUsing(function (\Illuminate\Database\Eloquent\Builder $query) {
                $query->where('status', '=', 'completed')->whereHas('teamMembers', function (Builder $query) {
                    $query->where('users.id', '=', auth()->user()->id);
                });
            }),
        ];
    }
}
