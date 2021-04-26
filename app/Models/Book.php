<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class Book extends Authenticatable
{
    protected $fillable = [
      'name', 'author'
    ];

    use HasFactory, Notifiable, HasApiTokens;

    public function user(){
      return $this->belongsTo(User::class,'user_id');
    }
}
