<?php

namespace App\Http\Controllers;

use App\Models\faq;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:faq-list|faq-create|faq-edit|faq-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:faq-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:faq-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:faq-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('faqs.index', [
            'title' => 'Faqs',
            'subtitle' => 'All',
            'faqs' => faq::paginate(5)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('faqs.create', [
            'title' => 'Faq',
            'subtitle' => 'All'
        ]);
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
            'question' => 'required|min:5|max:100',
            'table' => 'required|min:5|max:100'
        ]);

        // return $validate;

        faq::create($validate);
        return redirect('/faqs')->with('success', 'Faq has been Added!!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\faq  $faq
     * @return \Illuminate\Http\Response
     */
    public function show(faq $request)
    {
        return view('faqs.show', [
            'title' => 'Show',
            'subtitle' => $request->id,
            'faq' => $request
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\faq  $faq
     * @return \Illuminate\Http\Response
     */
    public function edit(faq $request)
    {
        return view('faqs.edit', [
            'title' => 'Edit',
            'subtitle' => 'id ' . $request->id,
            'faq' => $request
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\faq  $faq
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, faq $faq)
    {
        $validate = $request->validate([
            'question' => 'required|min:5',
            'table' => 'required'
        ]);

        faq::where('id', $faq->id)->update($validate);
        return redirect('/faqs')->with('edited', 'faq has been updated!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\faq  $faq
     * @return \Illuminate\Http\Response
     */
    public function destroy(faq $request)
    {
        faq::destroy($request->id);
        return redirect('/faqs')->with('deleted', 'faq has been deleted');
    }
}
