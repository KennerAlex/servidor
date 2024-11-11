<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PedidoVentaDetalle extends Model
{

    use HasFactory;
    protected $table = 'pedido_venta_detalle';
    protected $primaryKey = 'idPedidoVentaDetalle';
    public $timestamps=false;
    protected $fillable = ['idPedidoVenta', 'idProducto', 'descripcionProducto', 'precioProducto', 'cantidad','subTotal'];

    public function pedidoVenta()
    {
        return $this->belongsTo(PedidoVenta::class,'idPedidoVenta');
    }
}
