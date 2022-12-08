<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\quote;
use Illuminate\Support\Facades\Http;

class DashboardController extends Controller
{
    public function index()
    {
        // $response = file_get_contents(url('/json/sopid.json'));
        // $rules = json_decode($response)->results;
        $menu = new Menu();

        $sidebar_menu = $menu->getMenu();
        return view('index', $sidebar_menu, [
            'title' => 'Home',
            'subtitle' => 'Dashboard',
            'quotes' => quote::all(),
            // 'rules' => $rules

        ]);
    }
}
