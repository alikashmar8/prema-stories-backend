<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactUsMail;

class UsersController extends Controller
{
    public function sendContactUsEmail(Request $request)
    {
        $email = env('ADMIN_MAIL_RECEIVER');
        Mail::to($email)->send(new ContactUsMail($request->all()));
    }
}
