<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Hash;

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
    public $timestamps =false;

    /**
     * Evénement éloquent lors de la creation d'un établissement
     * on crée un pseudo et un mot de passe par defaut pour chaque entrée
     */
    protected static function boot(){
        parent::boot();

        static::creating(function($titulaires){
           $titulaires->pseudo = self::pseudoUnique(str_slug($titulaires->nom, $separator = '-'));
           $titulaires->password = Hash::make('azerty');
        });
    }

    // Génération de pseudo unique
    private static function pseudoUnique($pseudo){
        if(self::where('pseudo',$pseudo)->first()){
            $complement  = random_int(1, 100);
            $pseudo = $pseudo.$complement;
            return self::pseudoUnique($pseudo);
        }

        return $pseudo;
    }
}

	