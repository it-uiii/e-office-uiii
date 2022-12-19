<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\AdditionalReport;
use App\Models\PerformanceReport;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use setasign\Fpdi\Fpdi;

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
            'attachment.*'      => ['nullable', 'file','mimeTypes:application/pdf', 'max:8048'],
            // 'file.*'            => ['nullable', 'image', 'max:8048'],
            // 'signature_reporter'=> ['nullable'],
            // 'signature_leader'  => ['nullable'],
        ], [], [
            'date'          => 'Tanggal',
            'activity.*'    => 'Kegiatan',
            'output.*'      => 'Output',
            'volume.*'      => 'Volume',
            'attachment.*'  => 'Lampiran',
        ]);


        try {
            DB::beginTransaction();
            // $timestamp = strtotime(now());
            // if ($request->signature_reporter) {
            //     if (!file_exists(storage_path('app/public/ttd'))) {
            //         mkdir(storage_path('app/public/ttd'), 0777, true);
            //     }
            //     $image_parts = explode(";base64,", $request->signature_reporter);
            //     $image_type_aux = explode("image/", $image_parts[0]);
            //     $image_type = $image_type_aux[1];
            //     $image_base64 = base64_decode($image_parts[1]);
            //     Storage::put('public/ttd/' . auth()->user()->name . '_laporan_kinerja_tanggal_' . $data['date'] . '_' . $timestamp . '.' . $image_type, $image_base64);
            //     $data['signature_reporter'] = 'public/ttd/' . auth()->user()->name . '_laporan_kinerja_tanggal_' . $data['date'] . ' - ' . $timestamp . '.' . $image_type;
            // }

            $data['created_by'] = auth()->user()->id;

            $performance_report = PerformanceReport::create($data);

            foreach ($request->activity as $key => $value) {
                $attachment = null;
                if ($request->attachment[$key]) {
                    $attachment = $request->attachment[$key]->storeAs('public/performance-reports', $request->attachment[$key]->getClientOriginalName());
                }
                Activity::create([
                    'performance_report_id' => $performance_report->id,
                    'activity'              => $value,
                    'output'                => $request->output[$key],
                    'volume'                => $request->volume[$key],
                    'description'           => $request->description[$key],
                    'attachment'            => $attachment
                ]);
            }


            // if ($request->file) {
            //     foreach ($request->file as $file) {
            //         $data['performance_report_id'] = $performance_report->id;
            //         $data['file']   = $file->storeAs('public/performance-reports', $file->getClientOriginalName());
            //         AdditionalReport::create($data);
            //     }
            // }

            DB::commit();

            $pdf = Pdf::loadView('performance-reports.pdf', ['data' => $performance_report]);
            $pdf->save(storage_path('app/performace-reports/' . $performance_report->id .'-'.str_replace(':','_',$performance_report->created_at) . '.pdf'));
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
        $fpdi = new Fpdi();
        // check if file exist
        if (file_exists(storage_path('app/performace-reports/' . $performance_report->id .'-'.str_replace(':','_',$performance_report->created_at) . '.pdf' ))) {
            Storage::delete('performace-reports/' . $performance_report->id .'-'.str_replace(':','_',$performance_report->created_at) . '.pdf');
        }
        $pdf = Pdf::loadView('performance-reports.pdf', ['data' => $performance_report])->setPaper('a4', 'potrait');
        $pdf->save(storage_path('app/performace-reports/' . $performance_report->id .'-'.str_replace(':','_',$performance_report->created_at) . '.pdf'));
        $fpdi->setSourceFile(storage_path('app/performace-reports/' . $performance_report->id .'-'.str_replace(':','_',$performance_report->created_at) . '.pdf' ));
        $tplIdx = $fpdi->importPage(1);
        $fpdi->addPage();
        $fpdi->useTemplate($tplIdx, 0, 0);

        foreach ($performance_report->activities as $key => $activity) {
            if ($activity->attachment && file_exists(storage_path('app/' . $activity->attachment)) && substr($activity->attachment, -3) == 'pdf') {
                try {
                    $fpdi->setSourceFile(storage_path('app/' . $activity->attachment));
                    $count = $fpdi->setSourceFile(storage_path('app/' . $activity->attachment));
                    for ($i = 1; $i <= $count; $i++) {
                        $tplIdx = $fpdi->importPage($i);
                        $size = $fpdi->getTemplateSize($tplIdx);
                        if ($size[0] > $size[1]) {
                            $fpdi->AddPage('L', array($size[0], $size[1]));
                        } else {
                            $fpdi->AddPage('P', array($size[0], $size[1]));
                        }
                        $fpdi->useTemplate($tplIdx);
                        $fpdi->SetFont('Helvetica', 'B', 10);
                        $fpdi->SetTextColor(0, 0, 0);
                        $fpdi->Text(10, 10, 'Lampiran Kegiatan ' . ($key + 1));
                        $fpdi->_out('Q');
                    }
                } catch (\Throwable $th) {
                    return '<h1 style="background-color: white; height: 400px;">please check the file on activity ' . $activity->activity . ', ' . $th->getMessage() . '</h1>';
                }
            }
        }

        $fpdi->Output('Laporan kinerja ' . $performance_report->report_created_by->name . ' - ' . $performance_report->date . '.pdf', 'I');
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
            // 'file.*'            => ['nullable', 'image', 'max:8048'],
            'attachment.*'      => ['nullable', 'image', 'max:8048'],
        ], [], [
            'date'          => 'Tanggal',
            'activity.*'    => 'Kegiatan',
            'output.*'      => 'Output',
            'volume.*'      => 'Volume',
            'attachment.*'  => 'Lampiran',
        ]);

        try {
            DB::beginTransaction();
            // $timestamp = strtotime(now());
            // if ($request->signature_reporter) {
            //     if (!file_exists(storage_path('app/public/ttd'))) {
            //         mkdir(storage_path('app/public/ttd'), 0777, true);
            //     }
            //     $image_parts = explode(";base64,", $request->signature_reporter);
            //     $image_type_aux = explode("image/", $image_parts[0]);
            //     $image_type = $image_type_aux[1];
            //     $image_base64 = base64_decode($image_parts[1]);
            //     Storage::put('public/ttd/' . auth()->user()->name . '_laporan_kinerja_tanggal_' . $performance_report->date . '_' . $timestamp . '.' . $image_type, $image_base64);
            //     $data['signature_reporter'] = 'public/ttd/' . auth()->user()->name . '_laporan_kinerja_tanggal_' . $performance_report->date . '_' . $timestamp . '.' . $image_type;
            // }
            if (auth()->user()->hasRole('Pimpinan')) {
                if ($request->revision) {
                    $data['status'] = 0;
                } else {
                    $data['status'] = 1;
                    $data['revision'] = null;
                    $data['revision_description'] = null;
                    // if ($request->signature_leader) {
                    //     if (!file_exists(storage_path('app/public/ttd'))) {
                    //         mkdir(storage_path('app/public/ttd'), 0777, true);
                    //     }
                    //     $image_parts = explode(";base64,", $request->signature_leader);
                    //     $image_type_aux = explode("image/", $image_parts[0]);
                    //     $image_type = $image_type_aux[1];
                    //     $image_base64 = base64_decode($image_parts[1]);
                    //     Storage::put('public/ttd/' . auth()->user()->name . '_laporan_kinerja_tanggal_' . $performance_report->date . '_' . $timestamp . '.' . $image_type, $image_base64);
                    //     $data['signature_leader'] = 'public/ttd/' . auth()->user()->name . '_laporan_kinerja_tanggal_' . $performance_report->date . '_' . $timestamp . '.' . $image_type;
                    // }
                }
            }

            $data['updated_by'] = auth()->user()->id;
            $performance_report->update($data);

            // if ($request->file) {
            //     foreach ($request->file as $file) {
            //         $data['performance_report_id'] = $performance_report->id;
            //         $data['file']   = $file->storeAs('public/performance-reports', $file->getClientOriginalName());
            //         AdditionalReport::create($data);
            //     }
            // }
            DB::commit();
            if ($performance_report->status == 0) {
                return back()->with('success', 'Laporan Kinerja berhasil diubah');
            }
            Storage::delete('performance-reports/'.$performance_report->id . ' - ' . str_replace(':','_',$performance_report->created_at) . '.pdf');
            $pdf = Pdf::loadView('performance-reports.pdf', compact('performance_report'));
            $pdf->save(storage_path('app/performace-reports/' . $performance_report->id .'-'.str_replace(':','_',$performance_report->created_at) . '.pdf'));
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
        Storage::delete('performance-reports/'.$performance_report->id . ' - ' . str_replace(':','_',$performance_report->created_at) . '.pdf');
        Storage::delete($performance_report->signature_reporter);
        Storage::delete($performance_report->signature_leader);
        $performance_report->delete();
        return redirect()->route('performance-reports.index')->with('success', 'Laporan Kinerja berhasil dihapus');
    }
}
