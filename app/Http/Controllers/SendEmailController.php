<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use App\Mail\Messaging;

class SendEmailController extends Controller
{
    
    public function sendEmail(Request $request){
        $validator=Validator::make($request->all(),[
            'first_name' => 'required',
            'last_name'=>'required',
            'your_email'=>'required|email',
            'reciever_email' =>'required|email',
            'subject' =>'required',
            'message'=>'required',
        ]);
        Mail::to($request->reciever_email)->send(new Messaging(
            $request->first_name,
            $request->last_name,
            $request->your_email,
            $request->subject,
            $request->message,
        ));
    }
}
