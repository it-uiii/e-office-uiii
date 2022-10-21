<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index($id)
    {

        $user = User::find($id);
        return view('profile.index', [
            'title' => 'Profile',
            'subtitle' => 'Show',
            'user' => $user
        ]);
    }

    public function setting()
    {
        return view('profile.settings', [
            'title' => 'Change',
            'subtitle' => 'Password'
        ]);
    }

    public function change(Request $request, $id)
    {
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|min:4|max:20',
        ]);

        $user = User::select('id', 'password')->whereId($id)->firstOrFail();
        if (Hash::check($request->old_password, $user->password)) {
            $user->update(['password' => Hash::make($request->new_password)]);

            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect('/')->with('change', 'Ganti password success, please login again');
        } else {
            return redirect()->back()->with('gagal', 'Wrong old password');
        }
    }

    public function profil()
    {
        return view('profile.profil', [
            'title' => 'Profile',
            'subtitle' => Auth()->user()->name
        ]);
    }
}
