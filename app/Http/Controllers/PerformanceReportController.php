<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\AdditionalReport;
use App\Models\PerformanceReport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class PerformanceReportController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:performance-report-list|performance-report-create|performance-report-edit|performance-report-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:performance-report-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:performance-report-edit', ['only' => ['edit']]);
        $this->middleware('permission:performance-report-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (auth()->user()->hasRole('Staff')) {
            $data = PerformanceReport::where('created_by', auth()->user()->id)->paginate(10);
        } elseif (auth()->user()->hasRole('Pimpinan')) {
            $data = PerformanceReport::whereHas('report_created_by', function ($query) {
                $query->where('head_id', auth()->user()->id);
            })->paginate(10);
        } else {
            $data = PerformanceReport::paginate(10);
        }
        return view('performance-reports.index', ['title' => 'Laporan Kinerja', 'subtitle' => 'List'], compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('performance-reports.create', ['title' => 'Laporan Kinerja', 'subtitle' => 'Tambah']);
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
            'date'              => ['required', 'date'],
            'activity.*'        => ['required', 'string', 'max:128'],
            'output.*'          => ['required', 'string'],
            'volume.*'          => ['nullable'],
            'description.*'     => ['nullable'],
            'file.*'            => ['nullable', 'image', 'max:8048'],
            'signature_reporter' => ['nullable'],
            'signature_leader'  => ['nullable'],
        ], [], [
            'date'          => 'Tanggal',
            'activity.*'    => 'Kegiatan',
            'output.*'      => 'Output',
            'volume.*'      => 'Volume',
        ]);


        try {
            DB::beginTransaction();
            $timestamp = strtotime(now());
            if ($request->signature_reporter) {
                if (!file_exists(storage_path('app/public/ttd'))) {
                    mkdir(storage_path('app/public/ttd'), 0777, true);
                }
                $image_parts = explode(";base64,", $request->signature_reporter);
                $image_type_aux = explode("image/", $image_parts[0]);
                $image_type = $image_type_aux[1];
                $image_base64 = base64_decode($image_parts[1]);
                Storage::put('public/ttd/' . auth()->user()->name . ' - laporan kinerja tanggal - ' . $data['date'] . ' - ' . $timestamp . '.' . $image_type, $image_base64);
                $data['signature_reporter'] = 'public/ttd/' . auth()->user()->name . ' - laporan kinerja tanggal - ' . $data['date'] . ' - ' . $timestamp . '.' . $image_type;
            }

            $data['created_by'] = auth()->user()->id;

            $performance_report = PerformanceReport::create($data);

            foreach ($request->activity as $key => $value) {
                Activity::create([
                    'performance_report_id' => $performance_report->id,
                    'activity'              => $value,
                    'output'                => $request->output[$key],
                    'volume'                => $request->volume[$key],
                    'description'           => $request->description[$key],
                ]);
            }

            if ($request->file) {
                foreach ($request->file as $file) {
                    $data['performance_report_id'] = $performance_report->id;
                    $data['file']   = $file->storeAs('public/performance-reports', $file->getClientOriginalName());
                    AdditionalReport::create($data);
                }
            }

            DB::commit();
            return response()->json([
                'success' => true,
                'message' => 'Laporan Kinerja berhasil ditambahkan',
                'redirect' => route('performance-reports.index')
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Laporan Kinerja gagal ditambahkan',
                'error'   => $th->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PerformanceReport  $performance_report
     * @return \Illuminate\Http\Response
     */
    public function show(PerformanceReport $performance_report)
    {
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadView('performance-reports.pdf', ['data' => $performance_report])->setPaper(array(0, 0, 609.449, 935.433));
        return $pdf->stream('Laporan kinerja ' . $performance_report->report_created_by->name . ' - ' . $performance_report->date . '.pdf');
    }

    public function archive(Request $request)
    {
        $performance_report = PerformanceReport::where('created_by', $request->created_by)->whereBetween('date', [$request->date_start, $request->date_end])->get();

        if (count($performance_report) > 0) {
            $pdf = App::make('dompdf.wrapper');
            $pdf->loadView('performance-reports.archive', ['performance_reports' => $performance_report])->setPaper(array(0, 0, 609.449, 935.433));
            return $pdf->stream('Laporan kinerja ' . $performance_report->first()->report_created_by->name . ' - ' . $performance_report->first()->date . ' - ' . $performance_report->last()->date . '.pdf');
        }

        return abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PerformanceReport  $performance_report
     * @return \Illuminate\Http\Response
     */
    public function edit(PerformanceReport $performance_report)
    {
        return view('performance-reports.edit', ['title' => 'Laporan Kinerja', 'subtitle' => 'Edit'], compact('performance_report'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PerformanceReport  $performance_report
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PerformanceReport $performance_report)
    {
        $data = $request->validate([
            'date'              => ['required', 'date'],
            'file.*'            => ['nullable', 'image', 'max:8048'],
        ], [], [
            'date'          => 'Tanggal',
            'activity.*'    => 'Kegiatan',
            'output.*'      => 'Output',
            'volume.*'      => 'Volume',
        ]);

        try {
            DB::beginTransaction();
            $timestamp = strtotime(now());
            if ($request->signature_reporter) {
                if (!file_exists(storage_path('app/public/ttd'))) {
                    mkdir(storage_path('app/public/ttd'), 0777, true);
                }
                $image_parts = explode(";base64,", $request->signature_reporter);
                $image_type_aux = explode("image/", $image_parts[0]);
                $image_type = $image_type_aux[1];
                $image_base64 = base64_decode($image_parts[1]);
                Storage::put('public/ttd/' . auth()->user()->name . ' - laporan kinerja tanggal - ' . $performance_report->date . ' - ' . $timestamp . '.' . $image_type, $image_base64);
                $data['signature_reporter'] = 'public/ttd/' . auth()->user()->name . ' - laporan kinerja tanggal - ' . $performance_report->date . ' - ' . $timestamp . '.' . $image_type;
            }

            if (auth()->user()->hasRole('Pimpinan')) {
                if ($request->revision) {
                    $data['status'] = 0;
                } else {
                    $data['status'] = 1;
                    $data['revision'] = null;
                    $data['revision_description'] = null;
                    if ($request->signature_leader) {
                        if (!file_exists(storage_path('app/public/ttd'))) {
                            mkdir(storage_path('app/public/ttd'), 0777, true);
                        }
                        $image_parts = explode(";base64,", $request->signature_leader);
                        $image_type_aux = explode("image/", $image_parts[0]);
                        $image_type = $image_type_aux[1];
                        $image_base64 = base64_decode($image_parts[1]);
                        Storage::put('public/ttd/' . auth()->user()->name . ' - laporan kinerja tanggal - ' . $performance_report->date . ' - ' . $timestamp . '.' . $image_type, $image_base64);
                        $data['signature_leader'] = 'public/ttd/' . auth()->user()->name . ' - laporan kinerja tanggal - ' . $performance_report->date . ' - ' . $timestamp . '.' . $image_type;
                    }
                }
            }

            $data['updated_by'] = auth()->user()->id;
            $performance_report->update($data);

            if ($request->file) {
                foreach ($request->file as $file) {
                    $data['performance_report_id'] = $performance_report->id;
                    $data['file']   = $file->storeAs('public/performance-reports', $file->getClientOriginalName());
                    AdditionalReport::create($data);
                }
            }

            DB::commit();
            if ($performance_report->status == 0) {
                return back()->with('success', 'Laporan Kinerja berhasil diubah');
            }
            return redirect()->route('performance-reports.index')->with('success', 'Laporan Kinerja berhasil di konfirmasi');
        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->with('error', 'Laporan Kinerja gagal diubah');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PerformanceReport  $performance_report
     * @return \Illuminate\Http\Response
     */
    public function destroy(PerformanceReport $performance_report)
    {
        foreach ($performance_report->additional_reports as $item) {
            Storage::delete($item->file);
            $item->delete();
        }
        foreach ($performance_report->activities as $item) {
            $item->delete();
        }
        Storage::delete($performance_report->signature_reporter);
        Storage::delete($performance_report->signature_leader);
        $performance_report->delete();
        return redirect()->route('performance-reports.index')->with('success', 'Laporan Kinerja berhasil dihapus');
    }
}
