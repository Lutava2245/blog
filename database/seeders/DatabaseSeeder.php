<?php

namespace Database\Seeders;

use App\Models\Postagem;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Postagem::create([
            'titulo' => 'Primeira Postagem',
            'conteudo' => 'Conteúdo da primeira postagem.',
            'nome_autor' => 'Autor 1',
            'data_publicacao' => now(),
            'visualizacoes' => 100,
            'curtidas' => 10
        ]);

        Postagem::create([
            'titulo' => 'Segunda Postagem',
            'conteudo' => 'Conteúdo da segunda postagem.',
            'nome_autor' => 'Autor 2',
            'data_publicacao' => now(),
            'visualizacoes' => 200,
            'curtidas' => 20
        ]);

        Postagem::create([
            'titulo' => 'Terceira Postagem',
            'conteudo' => 'Conteúdo da terceira postagem.',
            'nome_autor' => 'Autor 1',
            'data_publicacao' => now(),
            'visualizacoes' => 300,
            'curtidas' => 30
        ]);
    }
}
