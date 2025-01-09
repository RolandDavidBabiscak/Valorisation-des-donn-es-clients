<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Commentaire extends Model
{
    protected $table = 'COMMENTAIRE';
	
    protected $primaryKey = 'COMMENTAIRE_ID';

    protected $fillable = [
        'ENTREPRISE_ID',
        'COMMENTAIRE'
    ];

    public function entreprise()
    {
        return $this->belongsTo(Entreprise::class, 'ENTREPRISE_ID');
    }
}