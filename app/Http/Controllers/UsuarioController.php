<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Usuario;
use Exception;
use Illuminate\Http\Request;

class UsuarioController extends Controller
{

    public function index()
    {
        $usuarios = Usuario::all();
        return $usuarios;
    }
    public static function verificaemail($email)
    {
        try {
            $resultdata = Usuario::select('id', 'email')
                ->where('email', '=', $email)
                ->where('estado', '=', 1)
                ->first();
            if ($resultdata == null) {
                return response()->json([
                    "status" => 400,
                    "data" => $resultdata,
                    "login" => false
                ]);
            } else {
                return response()->json([
                    "status" => 200,
                    "data" => $resultdata,
                    "login" => true
                ]);
            }
        } catch (Exception $e) {
            return response()->json([
                "status" => 500,
                "error" => "Error: " . $e->getMessage()
            ]);
        }
    }
    public static function verificaclave($email, $password)
    {
        $resultdata = '';
        try {
            $resultdata = Usuario::select('id', 'email')
                ->where('email', '=', $email)
                ->where('password', '=', $password)
                ->where('estado', '=', 1)
                ->first();
            if ($resultdata == null) {
                return response()->json([
                    "status" => 400,
                    "data" => $resultdata,
                    "login" => false
                ]);
            } else {
                return response()->json([
                    "status" => 200,
                    "data" => $resultdata,
                    "login" => true
                ]);
            }
        } catch (Exception $e) {
            return response()->json([
                "status" => 500,
                "error" => "Error: " . $e->getMessage()
            ]);
        }
    }

    public function store(Request $request)
    {
        try {
            $usuario = new Usuario();
            $usuario->email = $request->email;
            $usuario->password = $request->password;
            $usuario->estado = 1;
            $usuario->save();
            $result = [
                'email' => $request->ruc_dni,
                'password' => $usuario->password,
                'estado'=> $usuario->estado,
            ];
            return $result;
        } catch (Exception $e) {
            return "Error fatal - " . $e->getMessage();
        }
    }
}
