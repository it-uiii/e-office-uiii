<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\quote;

class DashboardController extends Controller
{
    public function index()
    {
        $response = file_get_contents(config('setting.api_url') . '/api/v1/sopid?start=1&limit=5');
        $rules = json_decode($response)->results;
        $menu = new Menu();

        $sidebar_menu = $menu->getMenu();
        return view('index', $sidebar_menu, [
            'title' => 'Home',
            'subtitle' => 'Dashboard',
            'quotes' => quote::all(),
            'rules' => $rules

        ]);
    }
}
