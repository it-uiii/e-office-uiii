<?php

namespace App\Http\Controllers;

use App\Models\OutgoingLetter;
use Illuminate\Http\Request;

class OutgoingLetterController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:outgoing-letter-list|outgoing-letter-create|outgoing-letter-edit|outgoing-letter-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:outgoing-letter-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:outgoing-letter-edit', ['only' => ['edit']]);
        $this->middleware('permission:outgoing-letter-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = OutgoingLetter::when(auth()->user()->hasRole('Staff'), function ($query) {
            $query->where('created_by', auth()->user()->id);
        })->when(auth()->user()->hasRole('Admin') && auth()->user()->position->name == 'Pelaksana Sekretariat', function ($query) {
            $query->where('status',0)->orWhere('status',1);
        })->when(auth()->user()->hasRole('Admin') && auth()->user()->position->name == 'KTU Sekretaris', function ($query) {
            $query->where('status',1)->orWhere('status',2);
        })->when(auth()->user()->hasRole('Admin') && auth()->user()->position->name == 'Sekretaris Universitas', function ($query) {
            $query->where('status',2)->orWhere('status',3);
        })->when(auth()->user()->hasRole('Pimpinan') && auth()->user()->position->name == 'Rektor', function ($query) {
            $query->where('status',3)->orWhere('status',4);
        })->paginate(10);
        return view('outgoing-letters.index', ['title' => 'Surat Keluar', 'subtitle' => 'List'], compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('outgoing-letters.create', ['title' => 'Surat Keluar', 'subtitle' => 'Tambah']);
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
            'subject'       => ['required','string','max:128'],
            'date'          => ['required','date'],
            'destination'   => ['required','string','max:128'],
            'description'   => ['nullable','string','max:255'],
            'file'          => ['required','file','mimes:pdf,doc,docx','max:2048'],
        ],[],[
            'subject'       => 'Perihal',
            'date'          => 'Tanggal',
            'destination'   => 'Tujuan',
            'description'   => 'Keterangan',
            'file'          => 'File',
        ]);

        $data['created_by'] = auth()->user()->id;
        $data['file']       = $request->file('file')->storeAs('public/outgoing-letters', $request->file('file')->getClientOriginalName());

        OutgoingLetter::create($data);
        return redirect()->route('outgoing-letters.index')->with('success', 'Surat Keluar berhasil disimpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\OutgoingLetter  $outgoing_letter
     * @return \Illuminate\Http\Response
     */
    public function show(OutgoingLetter $outgoing_letter)
    {
        return view('outgoing-letters.show', ['title' => 'Surat Keluar', 'subtitle' => 'Detail', 'data' => $outgoing_letter]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\OutgoingLetter  $outgoing_letter
     * @return \Illuminate\Http\Response
     */
    public function edit(OutgoingLetter $outgoing_letter)
    {
        return view('outgoing-letters.edit', ['title' => 'Surat Keluar', 'subtitle' => 'Ubah', 'data' => $outgoing_letter]);
    }

    /**
     * Update the form for editing the specified resource.
     *
     * @param  \App\Models\OutgoingLetter  $outgoing_letter
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, OutgoingLetter $outgoing_letter)
    {
        $data = $request->validate([
            'acc'                   => ['required'],
            'number'                => ['required','string','max:128'],
            'subject'               => ['required','string','max:128'],
            'date'                  => ['required','date'],
            'destination'           => ['required','string','max:128'],
            'description'           => ['nullable','string','max:255'],
            'file'                  => ['nullable','file','mimes:pdf,doc,docx','max:2048'],
            'revision'              => ['nullable'],
            'revision_description'  => ['nullable','required_if:revision,1'],
        ],[
            'revision_description.required_if'  => 'Keterangan revisi harus diisi jika tidak disetujui',
        ],[
            'number'                => 'Nomor Surat',
            'subject'               => 'Perihal',
            'date'                  => 'Tanggal',
            'destination'           => 'Tujuan',
            'description'           => 'Keterangan',
            'file'                  => 'File',
            'revision'              => 'Revisi',
        ]);

        if (auth()->user()->hasRole('Admin') && auth()->user()->position->name == 'Pelaksana Sekretariat') {
            if ($request->revision) {
                $data['status'] = 0;
            } else {
                $data['status'] = 1;
                $data['revision'] = null;
                $data['revision_description'] = null;
            }
        } elseif (auth()->user()->hasRole('Admin') && auth()->user()->position->name == 'KTU Sekretaris') {
            if ($request->revision) {
                $data['status'] = 1;
            } else {
                $data['status'] = 2;
                $data['revision'] = null;
                $data['revision_description'] = null;
            }
        } elseif (auth()->user()->hasRole('Admin') && auth()->user()->position->name == 'Sekretaris Universitas') {
            if ($request->revision) {
                $data['status'] = 2;
            } else {
                $data['status'] = 3;
                $data['revision'] = null;
                $data['revision_description'] = null;
            }
        } elseif (auth()->user()->hasRole('Pimpinan') && auth()->user()->position->name == 'Rektor') {
            if ($request->revision) {
                $data['status'] = 3;
            } else {
                $data['status'] = 4;
                $data['revision'] = null;
                $data['revision_description'] = null;
            }
        }

        if ($request->file('file')) {
            $data['file'] = $request->file('file')->storeAs('public/outgoing-letters', $request->file('file')->getClientOriginalName());
        }

        $data['updated_by'] = auth()->user()->id;

        $outgoing_letter->update($data);
        return redirect()->route('outgoing-letters.index')->with('success', 'Surat Keluar berhasil disimpan');
        return view('outgoing-letters.edit', ['title' => 'Surat Keluar', 'subtitle' => 'Ubah'], compact('data'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\OutgoingLetter  $outgoing_letter
     * @return \Illuminate\Http\Response
     */
    public function destroy(OutgoingLetter $outgoing_letter)
    {
        File::delete('storage/'.$outgoing_letter->file);
        $outgoing_letter->delete();
        return redirect()->route('outgoing-letters.index')->with('success', 'Surat Keluar berhasil dihapus');
    }
}
