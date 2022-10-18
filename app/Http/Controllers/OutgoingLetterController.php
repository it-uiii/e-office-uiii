<?php

namespace App\Http\Controllers;

use App\Models\Additional;
use App\Models\OutgoingLetter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

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
            $query->where('status',0)->orWhere('status',1)->orWhere('status',4);
        })->when(auth()->user()->hasRole('Pimpinan') && auth()->user()->position->name == 'KTU Sekretaris', function ($query) {
            $query->where('status',1)->orWhere('status',2)->orWhere('status',4);
        })->when(auth()->user()->hasRole('Admin') && auth()->user()->position->name == 'Sekretaris Universitas', function ($query) {
            $query->where('status',2)->orWhere('status',3)->orWhere('status',4);
        })->when(auth()->user()->hasRole('Pimpinan') && auth()->user()->position->name == 'Rektor', function ($query) {
            $query->where('status',3)->orWhere('status',4);
        })->orderBy('created_at','desc')->paginate(10);
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
            'description'   => ['required','string'],
            'file.*'        => ['nullable','image','max:2048'],
        ],[],[
            'subject'       => 'Perihal',
            'date'          => 'Tanggal',
            'destination'   => 'Tujuan',
            'description'   => 'Description',
        ]);

        $data['created_by'] = auth()->user()->id;

        $outgoing_letter = OutgoingLetter::create($data);
        if ($request->file) {
            foreach ($request->file as $file) {
                $data['outgoing_letter_id'] = $outgoing_letter->id;
                $data['file']   = $file->storeAs('public/outgoing-letters', $file->getClientOriginalName());
                Additional::create($data);
            }
        }
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
        return view('outgoing-letters.show', ['title' => 'Surat Keluar', 'subtitle' => 'Detail'], compact('outgoing_letter'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\OutgoingLetter  $outgoing_letter
     * @return \Illuminate\Http\Response
     */
    public function pdf(OutgoingLetter $outgoing_letter)
    {
        if ($outgoing_letter->status == 4) {
            $pdf = App::make('dompdf.wrapper');
            $pdf->loadView('outgoing-letters.pdf', ['data' => $outgoing_letter])->setPaper(array(0,0,609.449,935.433));
            return $pdf->stream($outgoing_letter->perihal. '.pdf');
        }
        return abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\OutgoingLetter  $outgoing_letter
     * @return \Illuminate\Http\Response
     */
    public function edit(OutgoingLetter $outgoing_letter)
    {
        if ((auth()->user()->position->name == 'Rektor' && ($outgoing_letter->status == 3 || $outgoing_letter->status == 4)) ||
        (auth()->user()->position->name == 'Sekretaris Universitas' && ($outgoing_letter->status == 2 || $outgoing_letter->status == 3)) ||
        (auth()->user()->position->name == 'KTU Sekretaris' && ($outgoing_letter->status == 1 || $outgoing_letter->status == 2)) ||
        (auth()->user()->position->name == 'Pelaksana Sekretariat' && ($outgoing_letter->status == 0 || $outgoing_letter->status == 1)) ||
        (auth()->user()->hasRole('Staff') && $outgoing_letter->status == 0)) {
            return view('outgoing-letters.edit', ['title' => 'Surat Keluar', 'subtitle' => 'Ubah', 'data' => $outgoing_letter]);
        } else {
            return abort(404);
        }
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
            'number'                => [auth()->user()->position && auth()->user()->position->name == 'Pelaksana Sekretariat' ? 'required' : 'nullable','string','max:128'],
            'subject'               => ['required','string','max:128'],
            'date'                  => ['required','date'],
            'destination'           => ['required','string','max:128'],
            'description'           => ['required','string'],
            'file.*'                => ['nullable','image','max:2048'],
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
            'signature'             => 'Tanda Tangan',
        ]);

        if ($request->acc) {
            if (auth()->user()->hasRole('Admin') && auth()->user()->position->name == 'Pelaksana Sekretariat') {
                if ($request->revision) {
                    $data['status'] = 0;
                } else {
                    $data['status'] = 1;
                    $data['revision'] = null;
                    $data['revision_description'] = null;
                }
            } elseif (auth()->user()->hasRole('Pimpinan') && auth()->user()->position->name == 'KTU Sekretaris') {
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

                    $timestamp = strtotime(now());
                    if ($request->signature) {
                        if (!file_exists(storage_path('app/public/ttd'))) {
                            mkdir(storage_path('app/public/ttd'), 0777, true);
                        }
                        $image_parts = explode(";base64,", $request->signature);
                        $image_type_aux = explode("image/", $image_parts[0]);
                        $image_type = $image_type_aux[1];
                        $image_base64 = base64_decode($image_parts[1]);
                        Storage::put('public/ttd/'. $data['subject'] .' - '. $timestamp .'.'. $image_type, $image_base64);
                        $data['signature'] = 'public/ttd/'. $data['subject'] .' - '. $timestamp .'.'. $image_type;
                    }
                }
            }
        }

        if ($request->file) {
            foreach ($request->file as $file) {
                $data['outgoing_letter_id'] = $outgoing_letter->id;
                $data['file']   = $file->storeAs('public/outgoing-letters', $file->getClientOriginalName());
                Additional::create($data);
            }
        }

        $data['updated_by'] = auth()->user()->id;

        $outgoing_letter->update($data);
        if ($request->file) {
            return back()->with('success', 'Surat Keluar berhasil disimpan');
        }
        return redirect()->route('outgoing-letters.index')->with('success', 'Surat Keluar berhasil disimpan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\OutgoingLetter  $outgoing_letter
     * @return \Illuminate\Http\Response
     */
    public function destroy(OutgoingLetter $outgoing_letter)
    {
        foreach ($outgoing_letter->additionals as $item) {
            Storage::delete($item->file);
            $item->delete();
        }
        $outgoing_letter->delete();
        return redirect()->route('outgoing-letters.index')->with('success', 'Surat Keluar berhasil dihapus');
    }
}
