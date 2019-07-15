<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Produit extends Model
{
    
    public $timestamps=true;
    protected $table='produits';
    public $primaryKey='id';
    protected $dates = ['created_at', 'updated_at'];
    protected $fillable = ['label','quantite','prix'];
}
