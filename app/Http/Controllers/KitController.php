<?php

namespace App\Http\Controllers;

use App\Models\Kit;
use Illuminate\Http\Request;

class KitController extends Controller
{
    public function index()
    {
        $kits = Kit::with(['placa', 'gerador'])->get();

        return response()->json($kits->map(function ($kit) {
            // Inclui a placa e o gerador no JSON de resposta
            $kit->placa = $kit->placa
                ? $kit->placa
                : ['mensagem' => 'Nenhuma placa vinculada'];
            $kit->gerador = $kit->gerador
                ? $kit->gerador
                : ['mensagem' => 'Nenhum gerador vinculado'];
            return $kit;
        }));
    }

    public function show($id)
    {
        $kit = Kit::with(['placa', 'gerador'])->findOrFail($id);

        $kit->placa = $kit->placa
            ? $kit->placa
            : ['mensagem' => 'Nenhuma placa vinculada'];
        $kit->gerador = $kit->gerador
            ? $kit->gerador
            : ['mensagem' => 'Nenhum gerador vinculado'];

        return response()->json($kit);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nome' => 'required|string',
            'valor' => 'required|numeric',
            'quantidade' => 'required|integer',
            'placa_id' => 'required|exists:placas,id',
            'gerador_id' => 'required|exists:geradores,id',
        ]);

        $kit = Kit::create($validated);
        return response()->json($kit, 201);
    }

    public function update(Request $request, $id)
    {
        $kit = Kit::findOrFail($id);

        $validated = $request->validate([
            'nome' => 'required|string',
            'valor' => 'required|numeric',
            'quantidade' => 'required|integer',
            'placa_id' => 'required|exists:placas,id',
            'gerador_id' => 'required|exists:geradores,id',
        ]);

        $kit->update($validated);
        return response()->json($kit);
    }

    public function destroy($id)
    {
        $kit = Kit::findOrFail($id);
        $kit->delete();
        return response()->json(null, 204);
    }
}
