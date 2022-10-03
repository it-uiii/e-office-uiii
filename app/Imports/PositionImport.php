<?php

namespace App\Imports;

use App\Models\Position;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\ToCollection;

class PositionImport implements ToCollection
{
  /**
   * @param Collection $collection
   */
  public function collection(Collection $collection)
  {
    ini_set('max_execution_time', '3600');
    set_time_limit(3600);

    $heading = [];
    $heading[] = 'Jabatan';

    if ($heading != $collection[0]->toArray()) {
      return back()->with('danger', 'Data tidak sesuai');
    }

    unset($collection[0]);

    $message = [];
    foreach ($collection as $key => $row) {
      $baris = ((int) $key) + 1;
      try {
        $data           = [];
        $data['name']   = $row[0];
        $position           = Position::where('name', $data['name'])->first();

        Validator::make($data, [
          'name'    => ['required', 'string', 'max:128'],
        ],[],[
          'name'    => 'Jabatan baris ke '. $baris,
        ])->validate();

        if ($position) {
          $position->update($data);
        } else {
          $position = Position::create($data);
        }
      } catch (\Throwable $th) {
        $message[] = $baris;
      }
    }

    return back()->with('success', 'Jabatan berhasil diimport. '. (count($message) > 0 ? ' Tetapi, Data pada baris ke ' . implode(', ', $message) . ' tidak sesuai dan tidak dapat disimpan' : ''));
  }
}
