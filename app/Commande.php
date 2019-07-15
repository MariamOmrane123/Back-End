<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Commande extends Model
{
    public $timestamps=true;
    protected $table='commandes';
    public $primaryKey='commande_id';
    protected $dates = ['created_at', 'updated_at','deleted_at'];
    protected $fillable = ['produit_id','utilisateur_id','quantite'];

    public function produit ()
    {
        return $this->belongsTo('App\Produit', 'produit_id', 'id');
    }

    public function utilisateur ()
    {
        return $this->belongsTo('App\Utilisateur', 'utilisateur_id', 'id');
    }
}
