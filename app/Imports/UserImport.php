<?php

namespace App\Imports;

use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\ToCollection;

class UserImport implements ToCollection
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        $heading = ['Nama', 'Username', 'Email', 'NRP', 'Jabatan', 'Roles'];

        if ($heading != $collection[0]->toArray()) {
            return back()->with('danger', 'Data tidak sesuai');
        }

        unset($collection[0]);

        $message = [];
        foreach ($collection as $key => $row) {
            $baris = ((int) $key) + 1;
            try {
                $data               = [];
                $data['name']       = $row[0];
                $data['username']   = $row[1];
                $data['email']      = $row[2];
                $data['nrp']        = $row[3];
                $data['position']   = $row[4];
                $data['role']       = $row[5];
                $user               = User::where('email', $data['email'])->first();

                Validator::make($data, [
                    'name'      => ['required', 'string', 'max:128'],
                    'username'  => ['required', 'string', 'max:128'],
                    'email'     => ['required', 'string', 'email', 'max:128'],
                    'nrp'       => ['required', 'string', 'max:128'],
                    'position'  => ['required', 'string', 'max:128', 'exists:positions,name'],
                    'role'      => ['required', 'string', 'max:128', 'exists:roles,name'],
                ], [], [
                    'name'      => 'Nama baris ke ' . $baris,
                    'username'  => 'Username baris ke ' . $baris,
                    'email'     => 'Email baris ke ' . $baris,
                    'nrp'       => 'NRP baris ke ' . $baris,
                    'position'  => 'Jabatan baris ke ' . $baris,
                    'role'      => 'Roles baris ke ' . $baris,
                ])->validate();

                if ($user) {
                    $user->update($data);
                } else {
                    $user = User::create($data);
                }
            } catch (\Throwable $th) {
                $message[] = $baris;
            }
        }

        return back()->with('success', 'User berhasil diimport. ' . (count($message) > 0 ? ' Tetapi, Data pada baris ke ' . implode(', ', $message) . ' tidak sesuai dan tidak dapat disimpan' : ''));
    }
}
