<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KarticaVozila extends Model
{
    //
    protected $table = 'sv_kartice_vozil';
    protected $fillable = ['tip_jamstva', 'veljavnost_mesecev', 'dodatek_avt_menj',
    					   'dodatek_km', 'sifra_avtohise', 'soglasje_1',
    					   'soglasje_2', 'soglasje_3', 'datum_pogodbe',
						   'ime_priimek', 'kontaktna_st', 'naslov',
						   'postna_st', 'kraj', 'kraj_rojstva',
						   'datum_rojstva', 'email', 'znamka',
						   'model', 'registrska_st', 'st_sasije',
						   'moc_motorja', 'tip_motorja', 'datum_prve_reg',
						   'km', 'ccm', 'gorivo',
						   'pogon', 'menjalnik', 'komercialno_vozilo',
						   'datum_predaje', 'datum_jamstvo_od', 'userId', 'sifra', 'id_znamke'];

 	public function jamstvo()
    {
        return $this->hasOne('App\JamstvoTip', 'koda', 'tip_jamstva');
    }

    public function znamka_vozila()
    {
        return $this->hasOne('App\ZnamkaVozila', 'id', 'id_znamke');
    }

    public function prodajalec()
    {
        return $this->hasOne('App\Prodajalec', 'koda', 'sifra_avtohise');
    }
 
    public function user()
    {
        return $this->hasOne('App\User', 'id', 'userId');
    }
}
