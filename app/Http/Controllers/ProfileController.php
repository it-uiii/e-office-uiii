<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{   
    public function setting(){
        return view('profile.settings', [
            'title' => 'Change',
            'subtitle' => 'Password ' . Auth()->user()->name
        ]);
    }

    public function change(Request $request, $id)
    {
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|min:4|max:20',
        ]);

        $user = User::select('id','password')->whereId($id)->firstOrFail();
        if (Hash::check($request->old_password, $user->password)) {
            $user->update(['password' => Hash::make($request->new_password)]);

            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect('/');
        } else {
            return redirect()->back()->with('gagal', 'Wrong old password');
        }
    }

    public function profil(){
        return view('profile.profil', [
            'title' => 'Profile',
            'subtitle' => Auth()->user()->name
        ]);
    }
}
