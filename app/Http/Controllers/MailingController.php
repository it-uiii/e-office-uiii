<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MailingController extends Controller
{
    public function index()
    {
        return view('mailing.index', [
            'title' => 'Mail',
            'subtitle' => 'Outcome Mail'
        ]);
    }

    public function compose()
    {
        return view('mailing.compose', [
            'title' => 'Mail',
            'subtitle' => 'New Message'
        ]);
    }

    public function inbox()
    {
        return view('mailing.inbox', [
            'title' => 'Mail',
            'subtitle' => 'Disposisi'
        ]);
    }

    public function detail()
    {
        return view('mailing.readmail', [
            'title' => 'Mail',
            'subtitle' => 'Read Mail' // + subject
        ]);
    }
}
