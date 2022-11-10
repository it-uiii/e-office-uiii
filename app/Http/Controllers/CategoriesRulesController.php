<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use App\Models\categoryRule;
use Illuminate\Http\Request;

class CategoriesRulesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = categoryRule::paginate(10);
        return view('categories-rule.index', ['title' => 'Category Rules', 'subtitle' => 'List'], compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('categories-rule.create', ['title' => 'Category Rules', 'subtitle' => 'Create']);
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
            'category_name'     => 'required',
            'status'            => 'required|boolean',
            'image'             => 'image|max:5028',
        ]);

        $image = $request->image;
        $validate['image'] = $image->storeAs('public/logo', $image->getClientOriginalName());

        $validate['slug'] = Str::slug($request->category_name, '-');
        // ddd($validate);

        categoryRule::create($validate);
        return redirect('/categories')->with('success', 'Category aturan baru telah ditambahkan');
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
    public function edit(categoryRule $categoryRule, $id)
    {
        $data = categoryRule::find($id);
        return view('categories-rule.edit', ['title' => 'Category Rules', 'subtitle' => 'Update'], compact('data'));
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
