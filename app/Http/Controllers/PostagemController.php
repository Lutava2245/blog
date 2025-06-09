<?php

namespace App\Http\Controllers;

use App\Models\Postagem;
use Illuminate\Http\Request;

class PostagemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return View('postagem.index') -> with('Postagens', Postagem::all());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Postagem::create([
            'titulo' => $request->titulo,
            'conteudo' => $request->conteudo,
            'nome_autor' => $request->nome_autor,
            'data_atualizacao' => now(),
            'data_publicacao' => now(),
            'visualizacoes' => 0,
            'curtidas' => 0
        ]);
        return redirect('/postagens');
    }

    /**
     * Display the specified resource.
     */
    public function show(Postagem $postagem)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Postagem $postagem)
    {
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $postagem = Postagem::findOrFail($id);

        $postagem->update([
            'titulo' => $request->titulo,
            'conteudo' => $request->conteudo,
            'data_atualizacao' => now()
        ]);
        return redirect('/postagens');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $postagem = Postagem::findOrFail($id);

        $postagem->delete();
        return redirect('/postagens');
    }

    /**
     * Increment the 'curtidas' count for a specific postagem.
     */
    public function curtir($id)
    {
        $post = Postagem::findOrFail($id);

        if (session('curtidas_postagem_' . $id)) {
            $post->curtidas -= 1;
            session()->forget('curtidas_postagem_' . $id);
            $curtiu = false;
        }
        else {
            $post->curtidas += 1;
            session(['curtidas_postagem_' . $id => true]);
            $curtiu = true;
        }

        $post->save();

        return response()->json([
            'curtidas' => $post->curtidas,
            'curtiu' => $curtiu
        ]);
    }
}
