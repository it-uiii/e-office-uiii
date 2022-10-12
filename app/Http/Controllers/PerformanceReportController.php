<?php

namespace App\Http\Controllers;

use App\Models\PerformanceReport;
use Illuminate\Http\Request;

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
        $data = PerformanceReport::when(auth()->user()->hasRole('Staff'), function ($query) {
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PerformanceReport  $performanceReport
     * @return \Illuminate\Http\Response
     */
    public function show(PerformanceReport $performanceReport)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PerformanceReport  $performanceReport
     * @return \Illuminate\Http\Response
     */
    public function edit(PerformanceReport $performanceReport)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PerformanceReport  $performanceReport
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PerformanceReport $performanceReport)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PerformanceReport  $performanceReport
     * @return \Illuminate\Http\Response
     */
    public function destroy(PerformanceReport $performanceReport)
    {
        //
    }
}
