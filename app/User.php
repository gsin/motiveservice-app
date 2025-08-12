<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends \TCG\Voyager\Models\User
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'sifra_avtohise', 'api_token', 'komercialist'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

     

    public function isAdmin()
    {    
        if ($this->role->name == 'admin')
        {
            return true;
        }
        return false;
    }

    public function isSuperUser()
    {    
        if ($this->role->name == 'superuser')
        {
            return true;
        }
        return false;
    }

    public function isKomercialist()
    {    
        if ($this->komercialist == 1)
        {
            return true;
        }
        return false;
    }  
}
