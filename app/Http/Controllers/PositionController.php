<?php

namespace App\Http\Controllers;

use App\Exports\PositionExport;
use App\Imports\PositionImport;
use App\Models\Position;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class PositionController extends Controller
{
    public function __construct()
    {
        $this->middleware('user_permission:position-list|position-create|position-edit|position-delete', ['only' => ['index', 'store']]);
        $this->middleware('user_permission:position-create', ['only' => ['create', 'store']]);
        $this->middleware('user_permission:position-edit', ['only' => ['edit']]);
        $this->middleware('user_permission:position-import', ['only' => ['import']]);
        $this->middleware('user_permission:position-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Position::paginate(10);
        return view('positions.index', ['title' => 'Jabatan', 'subtitle' => 'List'], compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('positions.create', ['title' => 'Jabatan', 'subtitle' => 'Tambah']);
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
            'name'  => ['required','max:128','min:5']
        ],[],[
            'name'  => 'Nama'
        ]);

        Position::updateOrCreate(['id' => $request->id], $data);
        return redirect()->route('positions.index')->with('success', 'Jabatan berhasil disimpan');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => ['required', 'file', 'max:2048']
        ], [
            'file.required' => 'File wajib diisi'
        ]);

        Excel::import(new PositionImport, $request->file('file'));
        return back();
    }

    public function export()
    {
        return Excel::download(new PositionExport, 'Jabatan.xlsx');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Position  $position
     * @return \Illuminate\Http\Response
     */
    public function show(Position $position)
    {
        return view('positions.show', ['title' => 'Jabatan', 'subtitle' => 'Detail', 'data' => $position]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Position  $position
     * @return \Illuminate\Http\Response
     */
    public function edit(Position $position)
    {
        return view('positions.edit', ['title' => 'Jabatan', 'subtitle' => 'Ubah', 'data' => $position]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Position  $position
     * @return \Illuminate\Http\Response
     */
    public function destroy(Position $position)
    {
        $position->delete();
        return redirect()->route('positions.index')->with('success', 'Jabatan berhasil dihapus');
    }
}
