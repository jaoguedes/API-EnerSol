<?php

namespace App\Http\Controllers;

use App\Models\Placa;
use Illuminate\Http\Request;

class PlacaController extends Controller
{ 
    public function index()
    {
        $placas = Placa::all();
        return response()->json($placas);
    }

    public function show($id)
    {
        $placa = Placa::findOrFail($id);
        return response()->json($placa);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nome' => 'required|string',
            'valor' => 'required|numeric',
            'potencia' => 'required|numeric',
            'tamanho' => 'required|integer',
            'quantidade' => 'required|integer',
        ]);

        $placa = Placa::create($validated);
        return response()->json($placa, 201);
    }

    public function update(Request $request, $id)
    {
        $placa = Placa::findOrFail($id);

        $validated = $request->validate([
            'nome' => 'required|string',
            'valor' => 'required|numeric',
            'potencia' => 'required|numeric',
            'tamanho' => 'required|integer',
            'quantidade' => 'required|integer',
        ]);

        $placa->update($validated);
        return response()->json($placa);
    }

    public function destroy($id)
    {
        $placa = Placa::findOrFail($id);
        $placa->delete();
        return response()->json(null, 204);
    }
}
