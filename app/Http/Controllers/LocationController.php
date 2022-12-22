<?php

namespace App\Http\Controllers;

use App\Models\lokasi as Locations;
use App\Models\lokasi;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    function __construct()
    {
        $this->middleware('user_permission:location-list|location-create|location-edit|location-delete', ['only' => ['index', 'store']]);
        $this->middleware('user_permission:location-create', ['only' => ['create', 'store']]);
        $this->middleware('user_permission:location-edit', ['only' => ['edit', 'update']]);
        $this->middleware('user_permission:location-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $locations = Locations::paginate(20);
        return view('locations.index', ['title' => 'Locations', 'subtitle' => 'List'], compact('locations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('locations.create', ['title' => 'Location', 'subtitle' => 'Create']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'lokasi'        => 'required',
            'kode_lokasi'   => 'required'
        ]);

        // dd($validate);
        lokasi::create($validate);
        return redirect('locations')->with('success', 'Lokasi baru telah ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $loc = Locations::find($id);
        dd($loc);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
