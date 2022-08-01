<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class InboxController extends Controller
{
    public function index()
    {
        return view('inbox.index', [
            'title' => 'Inbox',
            'subtitle' => 'All',
            'mails' => Contact::paginate(10)
        ]);
    }
}
