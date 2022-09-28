<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
use Illuminate\Http\Request;

class SummaryController extends Controller
{
    // view buat admin
    public function summary()
    {
        $reports = Laporan::paginate(40);
        return view(
            'summary.index',
            [
                'title' => 'Summary',
                'subtitle' => 'All'
            ],
            compact('reports')
        );
    }

    // view buat pimpinan
    public function report()
    {
        $reports = Laporan::paginate(40);
        return view('summary.reports', [
            'title' => 'Reports',
            'subtitle' => 'All'
        ], compact('reports'));
    }

    public function review()
    {
        return view('summary.review', [
            'title' => 'Review',
            'subtitle' => 'nama'
        ]);
    }
}
