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
        $postagem = Postagem::create($request::all());
        return $postagem;
    }

    // Exibir uma postagem específica
    public function show($postagem)
    {
        return $postagem;
    }

    // Atualizar uma postagem
    public function update(Request $request, Postagem $postagem)
    {
        $postagem->update($request::all());
        return $postagem;
    }

    // Deletar uma postagem
    public function destroy(Postagem $postagem)
    {
        $postagem->delete();
        return $postagem;
    }
}
