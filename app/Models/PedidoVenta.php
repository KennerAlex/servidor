<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PedidoVenta extends Model
{

    use HasFactory;
    protected $table = 'pedido_venta';
    protected $primaryKey = 'idPedidoVenta';
    public $timestamps=false;
    protected $fillable = ['idCliente', 'idFormaPago', 'idMoneda', 'fechaEmision','codigo','correlativo','total'];

    public function detalles()
    {
        return $this->hasMany(PedidoVentaDetalle::class,'idPedidoVenta');
    }

    // public function detalles()
    // {
    // return $this->belongsTo(PedidoVentaDetalle::class,'idPedidoVenta');
    // }
}
