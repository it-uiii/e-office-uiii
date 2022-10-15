<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'performance_report_id' => ['required','exists:performance_reports,id'],
            'activity'              => ['required','string','max:191'],
            'output'                => ['required','string','max:191'],
            'volume'                => ['nullable','string','max:191'],
            'description'           => ['nullable'],
        ]);

        Activity::updateOrCreate(['id' => $request->id], $data);

        return response()->json([
            'success'   => true,
            'message'   => 'Kegiatan berhasil disimpan',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Activity  $activity
     * @return \Illuminate\Http\Response
     */
    public function destroy(Activity $activity)
    {
        $activity->delete();
        return back()->with('success', 'Kegiatan berhasil dihapus');
    }
}
