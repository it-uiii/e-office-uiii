<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Menu extends Model
{
    use HasFactory;

    public function getMenu()
    {
        $menu = DB::select('select * from sidebar_menu where menu_inactive = ?', ['0']);
        $submenu = DB::select('select * from sidebar_sub_menu where sub_inactive = ?', ['0']);

        return ['menu' => $menu, 'submenu' => $submenu];
    }
}
