<?php

namespace App\Http\Controllers;

use App\Models\AdditionalReport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdditionalReportController extends Controller
{

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AdditionalReport  $additional_report
     * @return \Illuminate\Http\Response
     */
    public function destroy(AdditionalReport $additional_report)
    {
        Storage::delete($additional_report->file);
        $additional_report->delete();
        return back()->with('success', 'Lampiran berhasil dihapus');
    }
}
