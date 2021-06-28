<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    use HasFactory;
    protected $table='chat';
    protected $fillable = [
        'user_id', 'chat_id','last_message','last_message_from','no_of_uread','status'
      
      ];
}
