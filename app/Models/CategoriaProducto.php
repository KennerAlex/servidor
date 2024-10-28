<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoriaProducto extends Model
{

    use HasFactory;
        protected $table='categoriaproductos';
        protected $primaryKey='idCategoriaProducto';
        public $timestamps=false;
        protected $fillable=['descripcion','estado'];
}
