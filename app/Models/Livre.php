<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Livre extends Model
{
    use HasFactory;

    protected $fillable = [
     'titre', 'pages', 'description', 'categorie_id', 'image'
 ];

    public function categorie()
    {
        return $this->belongsTo(Categorie::class,'categorie_id');
    }
}
