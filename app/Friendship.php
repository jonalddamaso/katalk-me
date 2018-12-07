<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Friendship extends Model
{
    protected $fillable = ['requestor', 'user_requested', 'status'];

     public function user(){
      return $this->belongsTo('App\User');
    }
}
