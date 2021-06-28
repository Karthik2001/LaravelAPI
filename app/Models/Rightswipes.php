<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rightswipes extends Model
{
    use HasFactory;
    protected $table='right_swipes';
    protected $fillable = [
        'user_id', 'right_swiped_users'
      ];
}
