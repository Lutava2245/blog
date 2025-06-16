<?php
namespace App\Http\Controllers;

use App\Models\Postagem;
use Illuminate\Http\Request;

class APIController extends Controller
{
    // Listar todas as postagens
    public function index()
    {
        return Postagem::all();
    }

    // Criar uma nova postagem
    public function store(Request $request)
    {
        $postagem = Postagem::create($request->all());
        return $postagem;
    }

    // Exibir uma postagem específica
    public function show($id)
    {
        $postagem = Postagem::findOrFail($id);

        $key = "visualizacao_{$id}";

        if (!session()->has($key) || now()->diffInSeconds(session($key)) > 30) {
            $postagem->increment('visualizacoes');
            session([$key => now()]);
        }

        return $postagem;
    }

    // Atualizar uma postagem
    public function update(Request $request, $id)
    {
        $postagem = Postagem::findOrFail($id);
        $postagem->update($request->all());
        return $postagem;
    }

    // Deletar uma postagem
    public function destroy($id)
    {
        $postagem = Postagem::findOrFail($id);
        $postagem->delete();
        return response()->json(['message' => 'Postagem excluída com sucesso']);

    }
}
