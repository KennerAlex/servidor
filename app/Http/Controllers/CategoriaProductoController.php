<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\CategoriaProducto;
use Exception;
use Illuminate\Http\Request;

class CategoriaProductoController extends Controller
{
    //
    public function index()
        {
        $ListaCategoria=CategoriaProducto::where('activo','=','1')->get();
                return response()->json($ListaCategoria);
        }
        public function store(Request $request)
        {
            try {
                $categoria = new CategoriaProducto();
                $categoria->descripcion = $request->descripcion;
                $categoria->activo = 1;
                $categoria->save();
                $result = [
                    'descripcion' => $categoria->descripcion,
                    'created' => true
                ];
                return $result;
            } catch (Exception $e) {
                return "Error fatal - " . $e->getMessage();
            }
        }
        public function show($id)
        {
            return CategoriaProducto::find($id);
        }
        public function update(Request $request, $id)
        {
            $categoria = CategoriaProducto::findOrFail($id);
            $categoria->update($request->all());
            return $categoria;
        }
        public function destroy($id)
        {
            $categoria = CategoriaProducto::findOrFail($id);
            $categoria->delete();
            return 204;
        }
        public function delete($id)
        {
            $categoria = CategoriaProducto::findOrFail($id);
            $categoria->delete();
            return 204;
        }
        public function Listado(Request $request)
        {
            $categoria = CategoriaProducto::all();
            return response()->json($categoria);
        }
}
