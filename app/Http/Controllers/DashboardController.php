<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\quote;
use Illuminate\Support\Facades\Http;

class DashboardController extends Controller
{
    public function index()
    {
        $response = Http::get('http://192.168.74.57:8090/api/v1/sopid?start=1&limit=5');
        $rules = json_decode($response->getBody())->users;
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
