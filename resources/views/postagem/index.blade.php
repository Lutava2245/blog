{{--
'titulo',
'conteudo',
'nome_autor',
'categoria_id',
'data_publicacao',
'visualizacoes',
'curtidas'
--}}
@extends('base')
@section('content')
<h1>Postagens</h1>

<div>
    <h2>Nova Postagem</h2>
    <form action="/postagens" method="post">
        <table>
            @csrf
            <tr>
                <td>Título:</td>
                <td><input type="text" name="titulo" required></td>
            </tr>
            <tr>
                <td>Conteúdo:</td>
                <td><textarea name="conteudo" required></textarea></td>
            </tr>
            <tr>
                <td>Autor:</td>
                <td><input type="text" name="nome_autor" required></td>
            </tr>
            <tr>
                <td colspan="2"><button type="submit">Criar Postagem</button></td>
            </tr>
        </table>
    </form>
</div>

@foreach ($Postagens as $post)
    @php
        $curtiu = session('curtidas_post_' . $post->id, false);

        $post->visualizacoes++;
        $post->save();
    @endphp

    <div class="post">
        <hr>
        <h2>{{ $post->titulo }}</h2>
        <p>{{ $post->conteudo }}</p>
        <p>Autor: {{ $post->nome_autor }}</p>
        <p>Data de Publicação: {{ $post->data_publicacao }}</p>
        <p>Data de Atualização: {{ $post->data_atualizacao }}</p>
        <p>Visualizações: {{ $post->visualizacoes }}</p>
        <p>Curtidas: <span id="curtidas-{{ $post->id }}">{{ $post->curtidas }}</span></p>

        <div>
            <h3>Editar</h3>
            <form action="/postagens/{{ $post->id }}" method="post">
                @csrf
                @method('put')
                <table>
                    <tr>
                        <td>Título:</td>
                        <td><input type="text" name="titulo" value="{{ $post->titulo }}" required></td>
                    </tr>
                    <tr>
                        <td>Conteúdo:</td>
                        <td><textarea name="conteudo" required>{{ $post->conteudo }}</textarea></td>
                    </tr>
                    <tr>
                        <td colspan="2"><button type="submit">Salvar</button></td>
                    </tr>
                </table>
            </form>
        </div>

        <div>
            <form action="/postagens/{{ $post->id }}" method="post">
                @csrf
                @method('delete')
                <button type="submit">Excluir Postagem</button>
            </form>
        </div>

        <button type="button" id="botao_curtir-{{ $post->id }}" onclick="updateCurtidas({{ $post->id }})">{{ $curtiu ? 'Descurtir' : 'Curtir' }}</button>
    </div>
@endforeach

<script>
function updateCurtidas(postId) {
    fetch(`/postagens/${postId}/curtir`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        }
    })
    .then(response => response.json())
    .then(data => {
        document.getElementById('curtidas-' + postId).innerText = data.curtidas;
        document.getElementById('botao_curtir-' + postId).innerText = data.curtiu ? 'Descurtir' : 'Curtir';
    });
}
</script>
