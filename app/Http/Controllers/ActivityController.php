<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
            'attachment'            => ['nullable', 'image', 'max:8048'],
        ]);

        if ($request->attachment) {
            $data['attachment'] = $request->attachment->storeAs('public/performance-reports', $request->attachment->getClientOriginalName());
        }

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

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Activity  $activity
     * @return \Illuminate\Http\Response
     */
    public function destroy_attachment(Activity $activity)
    {
        Storage::delete($activity->attachment);
        $activity->update([
            'attachment'    => null
        ]);
        return back()->with('success', 'Lampiran Kegiatan berhasil dihapus');
    }
}
