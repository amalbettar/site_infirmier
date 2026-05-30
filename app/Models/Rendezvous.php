<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rendezvous extends Model
{
    protected $table='rendezvous';
    protected $fillable=[
        'date',
        'heure_debut',
        'heure_fin',
        'service',
        'etat',
        'patient_id',
        'infirmier_id',

    ];
    public function infirmier()
    {
        return $this->belongsTo(Infirmier::class,'infirmier_id','id');
    }
    public function patient()
    {
        return $this->belongsTo(Infirmier::class,'patient_id','id');
    }
}
