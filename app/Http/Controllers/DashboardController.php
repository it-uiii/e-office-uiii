<?php

namespace App\Http\Controllers;

use App\Models\FormRequest;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('index', [
            'title' => 'Home',
            'subtitle' => 'Dashboard',
            'users' => User::where('role', 'guest')->get()->count(),
            'requests' => FormRequest::where('status', 'On process')->get()->count()
        ]);
    }
}
