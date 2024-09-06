<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\AnalisePlaca;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $usuarios = User::with('analisePlaca')->get(); // Inclui análises de placas
        return response()->json($usuarios->map(function ($usuario) {
            // Adiciona informações da análise da placa
            $usuario->analise_placa = $usuario->analisePlaca
                ? $usuario->analisePlaca
                : ['mensagem' => 'Nenhuma placa vinculada'];
            return $usuario;
        }));
    }

    public function show($id)
    {
        $usuario = User::with('analisePlaca')->findOrFail($id);
        $usuario->analise_placa = $usuario->analisePlaca
            ? $usuario->analisePlaca
            : ['mensagem' => 'Nenhuma placa vinculada'];
        return response()->json($usuario);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|email|unique:users', // Atualize para o nome correto da tabela
            'password' => 'required|string',
            'tipo' => 'required|string|in:pessoa comum,produtor rural',
            'cep' => 'nullable|string',
            'bairro' => 'nullable|string',
            'numero' => 'nullable|string',
            'cidade' => 'nullable|string',
            'rua' => 'nullable|string',
            'cpf' => 'nullable|numeric|required_if:tipo,pessoa comum',
            'documento' => 'nullable|string|required_if:tipo,produtor rural',
        ]);

        $validated['password'] = bcrypt($validated['password']);

        $usuario = User::create($validated);

        // Cria automaticamente uma análise da placa para o usuário criado
        AnalisePlaca::create(['id_usuario' => $usuario->id]);

        return response()->json($usuario, 201);
    }

    public function update(Request $request, $id)
    {
        $usuario = User::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string',
            'email' => 'required|string',
            'password' => 'nullable|string',
            'tipo' => 'required|string|in:pessoa comum,produtor rural',
            'cep' => 'nullable|string',
            'bairro' => 'nullable|string',
            'numero' => 'nullable|string',
            'cidade' => 'nullable|string',
            'rua' => 'nullable|string',
            'cpf' => 'nullable|numeric|required_if:tipo,pessoa comum',
            'documento' => 'nullable|string|required_if:tipo,produtor rural',
        ]);

        if (isset($validated['password'])) {
            $validated['password'] = bcrypt($validated['password']);
        }

        $usuario->update($validated);
        return response()->json($usuario);
    }

    public function destroy($id)
    {
        $usuario = User::findOrFail($id);
        $usuario->delete();
        return response()->json(null, 204);
    }
}
