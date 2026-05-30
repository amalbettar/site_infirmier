<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Infirmier extends Model
{
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $fillable = [
        'id',
        'specialite',
        'experience',
        'status',
        'description',
        'validation'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id');
    }
    public function rendezvous()
    {
        return $this->hasMany(Rendezvous::class,'infirmier_id','id');
    }
    public function disponibilites()
    {
        return $this->hasMany(Disponibilite::class,'infirmier_id','id');
    }
    public function avis()
    {
        return $this->hasMany(Avis::class,'infirmier_id','id');
    }
}
