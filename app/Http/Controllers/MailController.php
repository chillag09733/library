<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Mail;
use App\Mail\DemoMail;

use Illuminate\Http\Request;

class MailController extends Controller
{
    public function index()
    {
        $mailData = [
            'title' => '🛠️ Testing... Is This Thing On?',
            'body' => 'Just making sure the email gremlins are awake. Carry on! 😊'
        ];

        $emails = [
           "angelobsessive@gmail.com", "kovacs.andrea0226@gmail.com",
           '4brainnotfound04@gmail.com',
           'whydoihavesufferwithit@gmail.com',
           'testemil84@gmail.com',
           '1honappremium@gmail.com',
           'cicakaki41@gmail.com',
           'tesztetelka01@gmail.com',
           'tesztklaudia33@gmail.com'
        ];

        Mail::to($emails)->send(new DemoMail($mailData));

        //Mail::to('4brainnotfound04@gmail.com')

        /* ->cc($moreUsers)
        ->bcc($evenMoreUsers) */
        // ->send(new DemoMail($mailData));

        dd("Email is sent successfully.");
    }
}
