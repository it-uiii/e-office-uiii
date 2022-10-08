<?php

namespace App\Http\Controllers;

use App\Models\Additional;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdditionalController extends Controller
{
    public function destroy(Additional $additional)
    {
        Storage::delete($additional->file);
        $additional->delete();
        return back()->with('success', 'File berhasil dihapus');
    }
}
