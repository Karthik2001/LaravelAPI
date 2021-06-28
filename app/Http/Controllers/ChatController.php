<?php

namespace App\Http\Controllers;
use App\Events\Message;

use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function sendmessage(Request $request){
        $input = $request->all();
        
        Mesages::create([
            'chat_id' => $input['chat_id'],'message'=>$input['message'],'from'=>$input['from'],
        ]);
        Chat::where('chat_id',$input['chat_id'])->where('status','offine')->where('chat_id',$input['chat_id'])->update([
            'no_of_unread' => DB::raw('no_of_unread + 1'),
        ]);
        Chat::where('user_id','!=',$input['from'])->update([
            'last_message' => $input['message'],'last_message_from'=>$input['from']
        ]);
       $chat= Chat::where('chat_id',$input['chat_id'])->where('user_id' ,'!=', $input['user_id']);
       event(new Message($chat));
        
    }

    public function fetchchatdata(Request $request)
    {  
         $input = $request->all();
        Chat::select('chat_id','last_message','no_of_unread','updated_at')->where('user_id',$input['user_id'])->get();
    }

    public function fetchmessages(Request $request)
    {  
         $input = $request->all();
        Messages::select('messages','from','created_at',)->where('chat_id',$input['chat_id'])->orderBy('created_at')->get();
        Chat::where('user_id','=',$input['user_id'])->update([
            'status' => 'online','no_of_unread'=>0
        ]);

    }
} 
