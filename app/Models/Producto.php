<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{

    use HasFactory;
    protected $table = 'productos';
    protected $primaryKey = 'idProducto';
    public $timestamps = false;
    protected $fillable = [
        'descripcio', 'precio','stockActual','idCategoriaProducto','cantidad','activo'
    ];
    public function categoria()
    {
    return $this->belongsTo(CategoriaProducto::class,'idCategoriaProducto');
    }
}
