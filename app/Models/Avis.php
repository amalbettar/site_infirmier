<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Avis extends Model
{
    protected $fillable=['commentaire','note','patient_id','infirmier_id'];
    public function patient() {
        return $this->belongsTo(Patient::class,'patient_id','id'); 	
    }

    public function infirmier(){
        return $this->belongsTo(Infirmier::class,'infirmier_id','id');
    }
}
