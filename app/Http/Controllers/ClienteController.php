<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Cliente;
use Exception;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    //
    public function index()
    {
        return Cliente::all();
    }
    public function store(Request $request)
    {
        try {
            $cliente = new Cliente();
            $cliente->nombres = $request->nombres;
            $cliente->ruc_dni = $request->ruc_dni;
            $cliente->direccion = $request->direccion;
            $cliente->email = $request->email;
            $cliente->estado = 1;
            $cliente->save();
            $result = [
                'nombres' => $cliente->nombres,
                'ruc_dni' => $request->ruc_dni,
                'direccion' => $cliente->direccion,
                'email' => $request->email,
                'cliente_id' => $cliente->cliente_id,
                'created' => true
            ];
            return $result;
        } catch (Exception $e) {
            return "Error fatal - " . $e->getMessage();
        }
    }
    public function show($id)
    {
        return cliente::find($id);
    }
    public function update(Request $request, $id)
    {
        $cliente = Cliente::findOrFail($id);
        $cliente->update($request->all());
        return $cliente;
    }
    public function destroy($id)
    {
        $cliente = Cliente::findOrFail($id);
        $cliente->delete();
        return 204;
    }
    public function delete($id)
    {
        $cliente = Cliente::findOrFail($id);
        $cliente->delete();
        return 204;
    }
    public function Listado(Request $request)
    {
        $ListaCliente = Cliente::all();
        return response()->json($ListaCliente);
    }
}
