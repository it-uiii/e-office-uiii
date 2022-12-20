<?php

namespace App\Http\Controllers;

use App\Models\quote;
use Illuminate\Http\Request;

class QuoteController extends Controller
{

    function __construct()
    {
        $this->middleware('permission:quote-list|quote-create|quote-edit|quote-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:quote-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:quote-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:quote-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = quote::paginate(10);
        return view('quotes.index', ['title' => 'Quotes', 'subtitle' => 'All'], compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('quotes.create', ['title' => 'Quotes', 'subtitle' => 'Create']);
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
            'title' => ['required', 'max:255']
        ]);

        $validate['user_id'] = session('user')->id;
        $validate['body'] = $request->body;

        // dd($validate);

        quote::create($validate);
        return redirect('/quotes')->with('success', 'Quote baru telah ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(quote $quotes, $id)
    {
        $data = quote::find($id);
        return view('quotes.edit', ['title' => 'Quote', 'subtitle' => 'Edit'], compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, quote $quote)
    {
        $validate = $request->validate([
            'title' => ['required', 'max:255']
        ]);

        $validate['user_id'] = session('user')->id;
        $validate['body'] = $request->body;

        // dd($validate);

        $quote->update($validate);
        return redirect()->route('quotes.index')
            ->with('warning', 'quote berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(quote $quote)
    {
        $quote->delete();
        return redirect()->route('quotes.index');
    }
}
