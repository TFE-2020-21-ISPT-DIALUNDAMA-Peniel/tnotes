<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Titulaire extends Authenticatable
{
	use Notifiable;

    protected $primaryKey = 'idtitulaires';
    protected $fillable = [
        'matricule','nom','postnom','prenom','idgrades','pseudo','password','idroles' 
    ];
    protected $hidden = [
        'password',
    ];
    
}

	