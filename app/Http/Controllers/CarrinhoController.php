<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Placa;
use App\Models\Kit;
use App\Models\Gerador;
use App\Models\AnalisePlaca;
use Illuminate\Http\Request;

class CarrinhoController extends Controller
{
    public function comprar(Request $request)
    {
        $validated = $request->validate([
            'usuario_id' => 'required|exists:users,id',
            'items' => 'required|array',
            'items.*.tipo_item' => 'required|string|in:placa,kit,gerador',
            'items.*.item_id' => 'required|integer',
        ]);
    
        $usuario = User::findOrFail($validated['usuario_id']);
        $desconto = $usuario->tipo === 'produtor rural' ? 0.45 : 0;
        $produtosComprados = [];
        $totalValor = 0;
    
        foreach ($validated['items'] as $itemData) {
            $item = null;
    
            if ($itemData['tipo_item'] === 'placa') {
                $item = Placa::findOrFail($itemData['item_id']);
            } elseif ($itemData['tipo_item'] === 'kit') {
                $item = Kit::findOrFail($itemData['item_id']);
            } else {
                $item = Gerador::findOrFail($itemData['item_id']);
            }
    
            if ($item->quantidade <= 0) {
                return response()->json(['message' => 'Produto indisponível.'], 400);
            }
    
            $item->quantidade -= 1;
            $item->save();
    
            // Atualiza a análise da placa do usuário
            if ($itemData['tipo_item'] === 'placa' || $itemData['tipo_item'] === 'kit') {
                $analise = AnalisePlaca::where('id_usuario', $usuario->id)->first();
                if ($analise) {
                    $analise->id_placa = $itemData['item_id'];
                    $analise->produçao = random_int(1, 1000);
                    $analise->save();
                }
            }
    
            $valorFinal = $item->valor * (1 - $desconto);
            $totalValor += $valorFinal;
    
            $produtosComprados[] = [
                'tipo_item' => $itemData['tipo_item'],
                'item_id' => $itemData['item_id'],
                'valor_final' => $valorFinal,
            ];
        }
    
        return response()->json([
            'message' => 'Compra efetuada com sucesso.',
            'produtos_comprados' => $produtosComprados,
            'valor_total' => $totalValor,
        ]);
    }
}
