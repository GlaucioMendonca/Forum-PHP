<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="{{asset('js/script.js')}}"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $('#button-postagem').click(function(){
            $('#cadastrar-postagem').toggle();
        });
    });
</script>
@extends('layouts.app')
<link href="{{ asset('css/style.css') }}" rel="stylesheet">

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <form class="form-horizontal" method="GET" action="{{route('pesquisar')}}">
                            <div class="form-group">
                                <div class="col-md-11">
                                    <input id="pesquisar" type="text" class="form-control" name="pesquisar" value="" disabled>
                                </div>
                                <button type="submit" class="btn btn-primary">
                                    Pesquisar
                                </button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                @if(!Auth::guest())
                    <div class="panel panel-default">
                        <div class="panel-heading">Postagens</div>
                        <div class="panel-body">
                            <button id='button-postagem' type="submit" class="btn btn-primary">
                                Criar Postagem
                            </button>
                        </div>
                        <div id="cadastrar-postagem">
                            <div class="panel panel-default panel-commentary">
                                <div class="panel-heading">Cadastrar Postagem</div>
                                <div class="panel-body panel-body-padding-bottom">
                                    <form class="form-horizontal commentary-form" method="POST" action="{{route('cadastrar_postagem')}}">
                                        {{ csrf_field() }}
                                        <div class="form-group">
                                            <label for="titulo" class="col-md-1 control-label">Título</label>
                                            <div class="col-md-3">
                                                <input id="titulo" type="text" class="form-control" name="titulo" value="" required autofocus>
                                            </div>

                                        </div>
                                        <div class="form-group">
                                            <label for="tema" class="col-md-1 control-label">Tema</label>
                                            <div class="col-md-3">
                                                <select name='tema' class="dropdown dropdown-tema btn btn-primary">
                                                    <option value="{{$tema->getId()}}">{{$tema->getTema()}}</option>
                                                </select>
                                            </div>

                                        </div>
                                        <div class="form-group">
                                            <label for="mensagem" class="col-md-1 control-label">Conteúdo</label>
                                            <div class="col-md-11">
                                             <textarea id="mensagem" style="resize: none;" class="form-control" name="mensagem" rows="6" cols="50" required autofocus>
                                            </textarea>
                                            </div>
                                        </div>
                                        <div class="form-group commentary-form">
                                            <div class=" modal-footer">
                                                <button type="submit" class="btn btn-primary">
                                                    Cadastrar
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                    </div>
                @endif
            </div>
            @if(sizeof($posts) == 0)
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">Postagens não encontradas!</div>
                            <div class="panel-body panel-body-padding-bottom">
                                <p class="none">Nenhuma postagem foi encontrada!</p>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            @foreach($posts as $post)
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-default">
                            <div class="container-fluid">
                                <a class="btn btn-default col-md-12" href="{{ route('show_messages',
                                    ['tema_id' => $tema->getId(), 'post_id' => $post->getId()])}}" role="button">
                                    <p class="h3">{{$post->getTitulo()}}</p>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <button class="button_top btn btn-primary">Topo</button>
    </div>
@endsection
