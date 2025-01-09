<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    protected $table = 'NOTE';

    public function entreprise()
    {
        return $this->belongsTo(Entreprise::class);
    }
}
