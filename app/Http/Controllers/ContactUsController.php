<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactUsController extends Controller
{
    public function index()
    {
        return view('contact-us.index', ['title' => 'Home', 'subtitle' => 'Contact Us']);
    }

    public function send(Request $request)
    {
        $request->validate([
            'inputName' => ['required'],
            'inputEmail' => ['required', 'email:dns'],
            'inputSubject' => ['required'],
            'inputMessage' => ['required']
        ]);

        $mail_data = [
            'recipient' => 'admin.gws@uiii.ac.id',
            'fromEmail' => $request->inputEmail,
            'fromName' => $request->inputName,
            'subject' => $request->inputSubject,
            'body' => $request->inputMessage
        ];

        \Mail::send('contact-us.email-template', $mail_data, function ($message) use ($mail_data) {
            $message->to($mail_data['recipient'])
                ->from($mail_data['fromEmail'], $mail_data['fromName'])
                ->subject($mail_data['subject']);
        });

        return redirect('/contact-us')->with('success', 'message has been sent');
    }
}
