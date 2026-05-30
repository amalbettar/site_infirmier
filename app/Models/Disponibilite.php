<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Disponibilite extends Model
{
    protected $fillable=['jour','heure_debut','heure_fin','infirmier_id'];
    public function infirmier(){

        return $this->belongsTo(Infirmier::class,'infirmier_id','id');
    }
}
