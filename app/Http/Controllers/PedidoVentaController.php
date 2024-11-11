<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\PedidoVenta;
use App\Models\PedidoVentaDetalle;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PedidoVentaController extends Controller
{
    public function index()
    {
        return PedidoVenta::all();
    }
    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $lastPedido = PedidoVenta::latest('idPedidoVenta')->first();
            $nextCorrelativo = $lastPedido ? $lastPedido->correlativo + 1 : 1;
            // Formatear el correlativo a cuatro dígitos
            $correlativo = str_pad($nextCorrelativo, 4, '0', STR_PAD_LEFT);
            $codigo = 'PV-' . $correlativo;
            $fechaEmision = Carbon::parse($request->fechaEmision)->format('Y-m-d H:i:s'); // Formato para MySQL

            $pedido = PedidoVenta::create([
                'idCliente' => $request->idCliente,
                'idFormaPago' => $request->idFormaPago,
                'idMoneda' => $request->idMoneda,
                'fechaEmision' => $fechaEmision,
                'codigo' =>$codigo ,
                'correlativo' => $correlativo,
                'total' => $request->total,
            ]);

            foreach ($request->productos as $item) {
                PedidoVentaDetalle::create([
                    'idPedidoVenta' => $pedido->idPedidoVenta,
                    'idProducto' => $item['idProducto'],
                    'descripcionProducto' => $item['descripcion'],
                    'precioProducto' => $item['precio'],
                    'cantidad' => $item['cantidad'],
                    'subTotal' => $item['cantidad'] * $item['precio']
                ]);
            }

            DB::commit();
            return response()->json(['message' => 'Pedido creado con éxito'], 201);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['error' => 'Error al crear el pedido'.$e->getMessage()], 500);
        }
    }
}
