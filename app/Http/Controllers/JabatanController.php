<?php

namespace App\Http\Controllers;

use App\Models\Jabatan;
use Illuminate\Http\Request;
use App\Imports\JabatanImport;
use Maatwebsite\Excel\Facades\Excel;

class JabatanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Jabatan::paginate(10);
        return view('jabatan.index', ['title' => 'Jabatan', 'subtitle' => 'All'], compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('jabatan.create', ['title' => 'Position', 'subtitle' => 'all']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'nama' => 'required|max:255|min:5'
        ]);

        Jabatan::create($data);
        return redirect('/jabatan')->with('success', 'Jabatan has been added!!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Jabatan  $jabatan
     * @return \Illuminate\Http\Response
     */
    public function show(Jabatan $jabatan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Jabatan  $jabatan
     * @return \Illuminate\Http\Response
     */
    public function edit(Jabatan $jabatan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Jabatan  $jabatan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Jabatan $jabatan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Jabatan  $jabatan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Jabatan $jabatan)
    {
        //
    }

    public function importjabatan(Request $request)
    {
        $data = $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv',
        ]);

        $data = $request->file('files');
        $namafile = $data->getClientOriginalName();

        Excel::import(new JabatanImport, $namafile);
        return redirect('/jabatan')->with('danger', 'Jabatan has been imported!!');
    }
}
