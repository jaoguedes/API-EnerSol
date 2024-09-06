<?php

namespace App\Http\Controllers;

use App\Models\AnalisePlaca;
use Illuminate\Http\Request;

class AnalisePlacaController extends Controller
{
    public function index()
    {
        $analises = AnalisePlaca::all();
        return response()->json($analises);
    }

    public function show($id)
    {
        $analise = AnalisePlaca::findOrFail($id);
        return response()->json($analise);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'produçao' => 'nullable|integer',
            'id_placa' => 'nullable|exists:placas,id',
            'id_usuario' => 'required|exists:usuarios,id',
        ]);

        $analise = AnalisePlaca::create($validated);
        return response()->json($analise, 201);
    }

    public function update(Request $request, $id)
    {
        $analise = AnalisePlaca::findOrFail($id);

        $validated = $request->validate([
            'produçao' => 'nullable|integer',
            'id_placa' => 'nullable|exists:placas,id',
            'id_usuario' => 'required|exists:usuarios,id',
        ]);

        $analise->update($validated);
        return response()->json($analise);
    }

    public function destroy($id)
    {
        $analise = AnalisePlaca::findOrFail($id);
        $analise->delete();
        return response()->json(null, 204);
    }
}
