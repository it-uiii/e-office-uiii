<?php

namespace App\Http\Controllers;

use App\Models\EntryLetter;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class EntryLetterController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:entry-letter-list|entry-letter-create|entry-letter-edit|entry-letter-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:entry-letter-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:entry-letter-edit', ['only' => ['edit']]);
        $this->middleware('permission:entry-letter-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (auth()->user()->hasRole('Super Admin')) {
            $data = EntryLetter::filter()->paginate(10);
        } elseif (auth()->user()->hasRole('Staff')) {
            $data = EntryLetter::filter()->where('created_by', auth()->user()->id)->paginate(10);
        } else {
            $data = EntryLetter::filter()->whereHas('dispositions', function ($query) {
                $query->where('user_id', auth()->user()->id);
            })->paginate(10);
        }
        $data->appends(request()->query());
        return view('entry-letters.index', ['title' => 'Surat Masuk', 'subtitle' => 'List'], compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::all();
        return view('entry-letters.create', ['title' => 'Surat Masuk', 'subtitle' => 'Tambah'], compact('users'));
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
            'id'                => ['nullable','integer'],
            'number'            => ['required','string','max:128'],
            'subject'           => ['required','string','max:128'],
            'date_letters'      => ['required','date'],
            'date_in'           => ['required','date'],
            'sender'            => ['required','string','max:128'],
            'disposition_id'    => ['required'],
            'description'       => ['nullable','string','max:255'],
            'file'              => [($request->id ? 'nullable': 'required'),'file','mimes:pdf,doc,docx','max:2048'],
        ],[],[
            'number'            => 'Nomor Surat',
            'subject'           => 'Perihal',
            'date_letters'      => 'Tanggal Surat',
            'date_in'           => 'Tanggal Masuk',
            'sender'            => 'Pengirim',
            'disposition_id'    => 'Disposisi',
            'description'       => 'Keterangan',
            'file'              => 'File',
        ]);

        $data['created_by'] = auth()->user()->id;
        if ($request->file) {
            $data['file']       = $request->file('file')->storeAs('public/entry-letters', $request->file('file')->getClientOriginalName());
        }

        try {
            $entry_letter = EntryLetter::updateOrCreate(['id' => $request->id],$data);
            if ($request->id) {
                foreach ($entry_letter->dispositions as $item) {
                    $item->delete();
                }
            }

            foreach ($request->disposition_id as $item) {
                $entry_letter->dispositions()->create([
                    'user_id' => $item
                ]);
            }
        } catch (\Throwable $th) {
            return back()->with('danger', 'Surat Masuk gagal disimpan. '. $th->getMessage());
        }
        return redirect()->route('entry-letters.index')->with('success', 'Surat Masuk berhasil disimpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\EntryLetter  $entry_letter
     * @return \Illuminate\Http\Response
     */
    public function show(EntryLetter $entry_letter)
    {
        return view('entry-letters.show', ['title' => 'Surat Masuk', 'subtitle' => 'Detail', 'data' => $entry_letter]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\EntryLetter  $entry_letter
     * @return \Illuminate\Http\Response
     */
    public function edit(EntryLetter $entry_letter)
    {
        $users = User::all();
        return view('entry-letters.edit', ['title' => 'Surat Masuk', 'subtitle' => 'Ubah', 'data' => $entry_letter], compact('users'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\EntryLetter  $entry_letter
     * @return \Illuminate\Http\Response
     */
    public function destroy(EntryLetter $entry_letter)
    {
        File::delete('storage/'.$entry_letter->file);
        $entry_letter->delete();
        return redirect()->route('entry-letters.index')->with('success', 'Surat Masuk berhasil dihapus');
    }
}
