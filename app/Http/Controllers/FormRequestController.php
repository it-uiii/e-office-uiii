<?php

namespace App\Http\Controllers;

use App\Models\FormRequest;
use Illuminate\Http\Request;

class FormRequestController extends Controller
{
    // function __construct()
    // {
    //     $this->middleware('permission:request-list|request-create|request-edit|request-delete', ['only' => ['index', 'store']]);
    //     $this->middleware('permission:request-create', ['only' => ['create', 'store']]);
    //     $this->middleware('permission:request-edit', ['only' => ['edit', 'update']]);
    //     $this->middleware('permission:request-delete', ['only' => ['destroy']]);
    // }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('request.index', [
            'title' => 'Inbox',
            'subtitle' => 'Request',
            'requests' => FormRequest::all()
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
     * @param  \App\Models\FormRequest  $formRequest
     * @return \Illuminate\Http\Response
     */
    public function show(FormRequest $request)
    {
        return view('request.show', [
            'title' => 'Read',
            'subtitle' => 'Message',
            'request' => $request
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\FormRequest  $formRequest
     * @return \Illuminate\Http\Response
     */
    public function edit(FormRequest $formRequest)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\FormRequest  $formRequest
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FormRequest $formRequest)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\FormRequest  $formRequest
     * @return \Illuminate\Http\Response
     */
    public function destroy(FormRequest $request)
    {
        FormRequest::destroy($request->id);
        return redirect('/request')->with('deleted', 'Service has been deleted');
    }
}
