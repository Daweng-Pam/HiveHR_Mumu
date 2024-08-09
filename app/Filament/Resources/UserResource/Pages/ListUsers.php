<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use Filament\Actions;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;

class ListUsers extends ListRecords
{
    protected static string $resource = UserResource::class;

    protected function getHeaderActions(): array
    {
        return [
//            Actions\CreateAction::make(),
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return [
            UserResource\Widgets\EmployeeStats::class,
        ];
    }

    public function getTabs(): array
    {
        return [
            'All' => Tab::make(),
            'Verified' => Tab::make()->modifyQueryUsing(function (\Illuminate\Database\Eloquent\Builder $query) {
                $query->where('approved', '=', 1);
            }),
            'Not Verified' => Tab::make()->modifyQueryUsing(function (\Illuminate\Database\Eloquent\Builder $query) {
                $query->where('approved', '=', 0);
            }),
        ];
    }
}
