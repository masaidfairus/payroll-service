<?php

namespace App\Filament\Resources\AttendanceResource\Pages;

use App\Filament\Resources\AttendanceResource;
use Filament\Actions;
use Filament\Actions\Action as Action;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Traits\HasRoles;


class ListAttendances extends ListRecords
{
    protected static string $resource = AttendanceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('presensi')
                ->url('/presensi')
                ->color('success'),
            Actions\CreateAction::make(),
        ];
    }

    protected function getTableQuery(): ?Builder
    {
        $query = parent::getTableQuery();

        if (Auth::user()?->hasRole('super_admin')) {
            return $query;
        }

        return $query->where('user_id', Auth::id());
    }
}
