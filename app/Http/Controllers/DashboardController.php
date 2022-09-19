<?php

namespace App\Http\Controllers;

use App\Models\FormRequest;
use App\Models\Menu;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $menu = new Menu();

        $sidebar_menu = $menu->getMenu();
        // dd($sidebar_menu);
        return view('index', $sidebar_menu, [
            'title' => 'Home',
            'subtitle' => 'Dashboard',

        ]);
    }
}
