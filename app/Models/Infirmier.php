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
}
