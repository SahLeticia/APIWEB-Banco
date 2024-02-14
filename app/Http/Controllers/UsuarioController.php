<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Usuario;
class UsuarioController extends Controller
{
    public function store(Request $request)
    {
        // Método para lidar com a requisição POST e salvar o usuário no banco de dados
        $data = $request->validate([
            'cpf' => 'required|integer',
            'nome' => 'required|string',
            'data_nascimento' => 'required|date',
        ]);

        $usuario = Usuario::create($data);

        return response()->json($usuario, 201);
    }

    public function show($cpf)
    {
        // Método para lidar com a requisição GET e retornar os dados do usuário se existir
        $usuario = Usuario::where('cpf', $cpf)->first();

        if (!$usuario) {
            return response()->json(['error' => 'Usuário não encontrado'], 404);
        }

        return response()->json($usuario);
    }
}
