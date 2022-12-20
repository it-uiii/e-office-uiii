<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
use App\Models\Position;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;

class LaporanKinerjaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $daily = Laporan::paginate(5);
        return view('reports.index', ['title' => 'Reports', 'subtitle' => 'All'], compact('daily'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('reports.create', ['title' => 'Report', 'subtitle' => 'Create']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request);
        $data = $request->validate([
            'kegiatan'          => ['required', 'string', 'max:255'],
            'tanggal_dibuat'    => ['required'],
            'keterangan'        => ['required'],
            'filenames'         => ['required'],
            'filenames.*'       => ['image', 'mimes:jpg,png,jpeg', 'max:10048']

        ]);

        $image = array();
        if ($files = $request->file('filenames')) {
            foreach ($files as $file) {
                $image_name = md5(rand(1000, 10000));
                $ext = strtolower($file->getClientOriginalExtension());
                $image_full_name = $image_name . '.' . $ext;
                $upload_path = 'public/lampiran';
                $image_url = $upload_path . $image_full_name;
                $file->storeAs($upload_path, $image_full_name);
                $image[] = $image_url;
            }
        }
        $data['status'] = 'Proses';
        $data['user_id'] = session('user')->id;
        $data['filenames'] = implode('|', $image);

        Laporan::create($data);
        return redirect('reports')->with('success', 'sukses');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Laporan  $laporan
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Laporan::find($id);
        $positions = Position::all();
        return view('reports.show', [
            'title' => 'Report',
            'subtitle' => 'Show'
        ], compact('data', 'positions'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Laporan  $laporan
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Laporan::find($id);
        return view('reports.edit', ['title' => 'Reports', 'subtitle' => 'Edit', 'data' => $data]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Laporan  $laporan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Laporan $laporan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Laporan  $laporan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Laporan $laporan)
    {
        //
    }
}
