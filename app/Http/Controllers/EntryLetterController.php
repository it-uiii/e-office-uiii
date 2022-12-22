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
        $this->middleware('user_permission:entry-letter-list|entry-letter-create|entry-letter-edit|entry-letter-delete', ['only' => ['index', 'store']]);
        $this->middleware('user_permission:entry-letter-create', ['only' => ['create', 'store']]);
        $this->middleware('user_permission:entry-letter-edit', ['only' => ['edit']]);
        $this->middleware('user_permission:entry-letter-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = EntryLetter::filter()->when(session('user')->role == 'Admin' && session('user')->position == 'Pelaksana Sekretariat', function ($query) {
            $query->where('created_by', session('user')->id);
        })->when(session('user')->role == 'Admin' && session('user')->position == 'KTU Sekretaris', function ($query) {
            $query->where('status',0)->orWhere('status',1);
        })->when(session('user')->role == 'Admin' && session('user')->position == 'Rektor', function ($query) {
            $query->where('status',1)->orWhere('status',2);
        })->paginate(10);
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
            'id'                    => ['nullable','integer'],
            'number'                => ['required','string','max:128'],
            'subject'               => ['required','string','max:128'],
            'date_in'               => ['required','date'],
            'sender'                => ['required','string','max:128'],
            'disposition_id'        => [(session('user')->position && session('user')->position == 'Rektor' ? 'required' : 'nullable')],
            'description'           => ['nullable'],
            'file'                  => [($request->id ? 'nullable' : 'required'),'file','mimes:pdf,doc,docx','max:2048'],
            'acc'                   => ['nullable'],
            'revision'              => ['nullable'],
            'revision_description'  => ['nullable','required_if:revision,1'],
        ],[
            'revision_description.required_if' => 'Keterangan revisi harus diisi',
        ],[
            'number'                => 'Nomor Surat',
            'subject'               => 'Perihal',
            'date_in'               => 'Tanggal Masuk',
            'sender'                => 'Pengirim',
            'disposition_id'        => 'Disposisi',
            'description'           => 'Keterangan',
            'file'                  => 'File',
            'acc'                   => 'Acc',
        ]);

        if ($request->id) {
            $data['updated_by'] = session('user')->id;
        } else {
            $data['created_by'] = session('user')->id;
        }
        if ($request->file) {
            $data['file']       = $request->file('file')->storeAs('public/entry-letters', $request->file('file')->getClientOriginalName());
        }

        if (session('user')->role == 'Admin' && session('user')->position == 'Pelaksana Sekretariat') {
            $data['status'] = 0;
            $data['revision'] = null;
            $data['revision_description'] = null;
        } elseif (session('user')->role == 'Pimpinan' && session('user')->position == 'KTU Sekretaris') {
            if ($request->revision) {
                $data['status'] = 0;
            } else {
                $data['status'] = 1;
                $data['revision'] = null;
                $data['revision_description'] = null;
            }
        } elseif (session('user')->role == 'Pimpinan' && session('user')->position == 'Rektor') {
            if ($request->revision) {
                $data['status'] = 1;
            } else {
                $data['status'] = 2;
                $data['revision'] = null;
                $data['revision_description'] = null;
            }
        }

        try {
            $entry_letter = EntryLetter::updateOrCreate(['id' => $request->id],$data);
            if ($request->id) {
                if (session('user')->position && session('user')->position == 'Rektor') {
                    foreach ($entry_letter->dispositions as $item) {
                        $item->delete();
                    }
                    if ($request->disposition_id) {
                        foreach ($request->disposition_id as $item) {
                            $entry_letter->dispositions()->create([
                                'user_id' => $item,
                            ]);
                        }
                    }
                }
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
