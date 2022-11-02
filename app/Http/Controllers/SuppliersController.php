<?php

namespace App\Http\Controllers;

use App\Models\supplier;
use Illuminate\Http\Request;

class SuppliersController extends Controller
{

    function __construct()
    {
        $this->middleware('permission:supplier-list|supplier-create|supplier-edit|supplier-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:supplier-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:supplier-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:supplier-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = supplier::paginate(10);
        return view('suppliers.index', ['title' => 'Suppliers', 'subtitle' => 'list'], compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('suppliers.create', ['title' => 'Suppliers', 'subtitle' => 'Create']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        dd($request);
        $validate = $request->validate([
            'kode_pemasok' => 'required|unique:suppliers',
            'nama_pemasok' => 'required|max:191|min:10',
        ]);

        $validate['user_id'];
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function show(supplier $supplier)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function edit(supplier $supplier)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, supplier $supplier)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function destroy(supplier $supplier)
    {
        //
    }
}
