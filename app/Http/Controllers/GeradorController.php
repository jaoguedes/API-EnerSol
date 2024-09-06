<?php

namespace App\Http\Controllers;

use App\Models\Gerador;
use Illuminate\Http\Request;

class GeradorController extends Controller
{
    public function index()
    {
        $geradores = Gerador::all();
        return response()->json($geradores);
    }

    public function show($id)
    {
        $gerador = Gerador::findOrFail($id);
        return response()->json($gerador);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nome' => 'required|string',
            'tamanho' => 'required|integer',
            'potencia' => 'required|numeric',
            'valor' => 'required|numeric',
            'quantidade' => 'required|integer',
        ]);

        $gerador = Gerador::create($validated);
        return response()->json($gerador, 201);
    }

    public function update(Request $request, $id)
    {
        $gerador = Gerador::findOrFail($id);

        $validated = $request->validate([
            'nome' => 'required|string',
            'tamanho' => 'required|integer',
            'potencia' => 'required|numeric',
            'valor' => 'required|numeric',
            'quantidade' => 'required|integer',
        ]);

        $gerador->update($validated);
        return response()->json($gerador);
    }

    public function destroy($id)
    {
        $gerador = Gerador::findOrFail($id);
        $gerador->delete();
        return response()->json(null, 204);
    }
}
