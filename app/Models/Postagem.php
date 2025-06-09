<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Postagem extends Model
{
    use \Illuminate\Database\Eloquent\Factories\HasFactory;
    protected $fillable = [
        'titulo',
        'conteudo',
        'nome_autor',
        'data_publicacao',
        'data_atualizacao',
        'visualizacoes',
        'curtidas'
    ];
}
