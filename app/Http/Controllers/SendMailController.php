<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendEmailToAdvertiser;
class SendMailController extends Controller
{
    public function sendMail(ContactRequest $request){
        Mail::to($request->adv_email)->send(new SendEmailToAdvertiser($request));
        return back();
    }
}
