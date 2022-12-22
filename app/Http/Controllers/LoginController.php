<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class LoginController extends Controller
{
    public function index()
    {
        return view('login.index', [
            'title' => 'Login'
        ]);
    }

    public function auth(Request $request)
    {
        $data = $request->validate([
            'username'  => ['required'],
            'password'  => ['required']
        ]);

        $data['key'] = config('setting.api_key');
        $response = json_decode(Http::withOptions([
            'verify' => false
        ])->withHeaders([
            'Authorization' => 'Bearer ' . config('setting.api_token')
        ])->get(config('setting.api_url').'/login?key='.$data['key'].'&email='. $data['username'] .'&password='. $data['password'])->getBody());
        if (isset($response->token)) {
            session(['token' => $response->token]);
            session(['user' => $response->session[0]->user]);
            session(['role' => $response->session[0]->role]);
            return redirect('/')->with('success', 'Selamat datang kembali, ' . session('user')->fullname);
        }

        return redirect('/login')->with('error', 'Please enter a correctly email and password.');
    }

    public function logout(Request $request)
    {
        session()->flush();
        return redirect('/');
    }
}
