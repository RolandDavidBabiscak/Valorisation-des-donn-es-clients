<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Entreprise extends Model
{
    // Nom de la table dans la base de données
    protected $table = 'ENTREPRISE';

    // Clé primaire
    protected $primaryKey = 'ENTREPRISE_ID';

    // Indique que la clé primaire n'est pas incrémentale
    public $incrementing = true;

    // Types des clés primaires
    protected $keyType = 'integer';

    // Désactiver les timestamps
    public $timestamps = false;

    // Colonnes autorisées pour les insertions/modifications
    protected $fillable = [
        'NOM',
        'SIREN',
        'SIRET_SIEGE',
    ];

    // Modèle Entreprise
    public function commentaires()
    {
        return $this->hasMany(Commentaire::class, 'ENTREPRISE_ID');
    }

}
