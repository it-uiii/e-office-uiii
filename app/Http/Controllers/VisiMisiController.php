<?php

namespace App\Http\Controllers;

use App\Models\VisiMisi;
use Illuminate\Http\Request;

class VisiMisiController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:visimisi-list|visimisi-edit', ['only' => ['index']]);
        $this->middleware('permission:visimisi-edit', ['only' => ['edit', 'update']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('visi_misi.index', [
            'title' => 'Visi & Misi',
            'subtitle' => 'All',
            'results' => VisiMisi::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\VisiMisi  $visiMisi
     * @return \Illuminate\Http\Response
     */
    public function show(VisiMisi $visiMisi)
    {
        return view('visi_misi.show', [
            'title' => 'About',
            'subtitle' => 'Show',
            'result' => $visiMisi
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\VisiMisi  $visiMisi
     * @return \Illuminate\Http\Response
     */
    public function edit(VisiMisi $visiMisi)
    {
        return view('visi_misi.edit', [
            'title' => 'Vision & Mission',
            'subtitle' => 'Edit',
            'result' => $visiMisi
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\VisiMisi  $visiMisi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, VisiMisi $visiMisi)
    {
        $validate = $request->validate([
            'body' => 'required'
        ]);

        VisiMisi::where('id', $visiMisi->id)->update($validate);
        return redirect('/visi_misi')->with('success', 'Vision & Mission has been updated!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\VisiMisi  $visiMisi
     * @return \Illuminate\Http\Response
     */
    public function destroy(VisiMisi $visiMisi)
    {
        //
    }
}
