<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Commentaire extends Model
{
	protected $table = 'COMMENTAIRE';

	protected $fillable = [
        'ENTREPRISE_ID',
		'content'
	];
}