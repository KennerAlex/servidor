<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Producto;
use Exception;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    //
    public function index()
    {
        $ListaProducto = Producto::with(['categoria'])->where('activo', '=', '1')->get();
        return response()->json($ListaProducto);
    }
    public function store(Request $request)
    {
        try {
            $producto = new Producto();
            $producto->descripcion = $request->descripcion;
            $producto->idCategoriaProducto = $request->idcategoria;
            $producto->precio = $request->precio;
            $producto->stockActual = 0;
            $producto->cantidad = $request->cantidad;
            $producto->activo = 1;
            $producto->save();
            $result = [
                'descripcion' => $producto->descripcion,
                'idCategoriaProducto' => $producto->idCategoriaProducto,
                'precio' => $producto->precio,
                'cantidad' => $producto->cantidad,
                'created' => true
            ];
            return $result;
        } catch (Exception $e) {
            return "Error fatal - " . $e->getMessage();
        }
    }
    public function show($id)
    {
        return producto::find($id);
    }
    public function update(Request $request, $id)
    {
        $producto = Producto::findOrFail($id);
        $producto->update($request->all());
        return $producto;
    }

    public function destroy($id)
    {
        $producto = Producto::findOrFail($id);
        $producto->delete();
        return 204;
    }
    public function delete($id)
    {
        $producto = Producto::findOrFail($id);
        $producto->delete();
        return 204;
    }
}
