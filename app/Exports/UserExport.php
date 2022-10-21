<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithCustomValueBinder;
use PhpOffice\PhpSpreadsheet\Cell\Cell;

class UserExport implements FromCollection, WithCustomValueBinder, ShouldAutoSize
{
    public function bindValue(Cell $cell, $value)
    {
        $cell->setValueExplicit($value, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
        return true;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return User::select('users.name', 'username', 'email', 'nrp', 'positions.name as position', 'roles.name as role')
                ->join('positions', 'users.position_id', '=', 'positions.id')
                ->join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
                ->join('roles', 'model_has_roles.role_id', '=', 'roles.id')
                ->get()->prepend(['Nama', 'Username', 'Email', 'NRP', 'Jabatan', 'Roles']);
    }
}
