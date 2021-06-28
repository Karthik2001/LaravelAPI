<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use  App\Models\Rightswipes;
use  App\Models\User;
use  App\Models\History;
use  App\Models\Matches;


class OperationsController extends Controller
{

  public function addrightswipes(Request $request)
  {
     $input = $request->all();
     $rihtswipes = RightSwipes::create($input);
     
     $output= RightSwipes::select('right_swiped_users')->where(['user_id', '=', $input['right_swiped_users']],
      ['right_swiped_user', '=',$input['user_id'] ],);
      if($input['user_id']=$output['right_swiped_users'])
      {
        Matches::create([
          'user_id' => $input['user_id'],'right_swiped_users'=>$input['right_swiped_users'],
      ]);
      Matches::create([
        'user_id' => $input['right_swiped_users'],'right_swiped_users'=>$input['user_id'],
    ]);
      }
     
     return response()->json([
       'success' => true,
       'token' => 'sds',
       'user' => 'aas'
      ]);
  
  }
  public function addtohistory(Request $request)
  {
     $input = $request->all();
     $rihtswipes = History::create($input);
     return response()->json([
       'success' => true,
       'token' => 'sds',
       'user' => 'aas'
      ]);
  
  }

  public function fetchmatches(Request $request)
  {
     $input = $request->all();
     $matches =User::select('user_id','fname','lname','user_name','age','location','bio')
     ->whereIn('user_id', Matches::select('matched_users')->where('user_id',$input['user_id']))
     ->orderByDesc('user_id')
     ->get();
     return response()->json([
       'success' => true,
       'token' => 'sds',
       'user' => $matches
      ]);
  
  }

  public function fetchusers(Request $request)
  {
     $input = $request->all();
     $user_to_show =User::select('user_id','fname','lname','user_name','age','location','bio')
     ->whereNotIn('user_id', History::select('users_shown')->where('user_id',$input['user_id']))
     ->orderByDesc('user_id')
     ->get();

     return response()->json([
       'success' => true,
       'token' => 'sds',
       'user' => $user_to_show
      ]);
  
  }

  
  
}
