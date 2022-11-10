<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactUsController extends Controller
{
    public function index()
    {
        return view('contact-us.index', ['title' => 'Home', 'subtitle' => 'Contact Us']);
    }

    public function send()
    {
    }
}
