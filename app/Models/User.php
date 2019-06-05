<?php

namespace App\Models;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;


class User extends Authenticatable
{
    protected $primaryKey = "idusers";
        protected $fillable = [
       'nom','postnom','prenom','pseudo','e_mail','idroles','idsections'
    ];
    protected $hidden = [
        'password'
    ];
}
