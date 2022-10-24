<?php

namespace App\Exports;

use App\Models\Position;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithCustomValueBinder;
use PhpOffice\PhpSpreadsheet\Cell\Cell;

class PositionExport implements FromCollection, WithCustomValueBinder, ShouldAutoSize
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
        return Position::select('name')->get()->prepend(['Jabatan']);
    }
}
