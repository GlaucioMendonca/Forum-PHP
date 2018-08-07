<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="{{asset('js/script.js')}}"></script>
<script type="text/javascript">
    $(document).ready(function(){
        var mensagem_fixa = $('#mensagem-fixa');

        $(window).scrollTop(0);

        $('#button-postagem').click(function(){
            $('#cadastrar-postagem').toggle();
        });

        $(window).scroll(function () {
            ($(this).scrollTop() > 177)
                ? mensagem_fixa.show()
                : mensagem_fixa.hide();
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
            @if(sizeof($data) == 0)
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
            @foreach($data as $post)
                <div class="container" id="mensagem-fixa">
                    <div class="row" >
                        <div class="col-md-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    @if(!Auth::guest())
                                        <div class="row">
                                            <h5 class="col-md-11">{{$post->getTitulo()}}</h5>
                                            @if(\Illuminate\Support\Facades\Auth::user()->getId() == $post->getUser()->getId())
                                                <ul class="col-md-1 dropdown" style="margin-bottom: 0; margin-top: 0.5%">

                                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                                        Opções <span class="caret"></span>
                                                    </a>
                                                    <ul class="dropdown-menu" role="menu">
                                                        <li>
                                                            <a href="{{ route('remover_postagem', ['postagem_id' => $post->getId()])}}">
                                                                Remover
                                                            </a>
                                                        </li>

                                                        <li>
                                                            <a href="{{ route('show_editar_postagem', ['postagem_id' => $post->getId()])}}">
                                                                Editar
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </ul>
                                            @endif
                                        </div>
                                    @else
                                        {{$post->getTitulo()}}
                                    @endif
                                </div>
                                <div id="conteudo-postagem" class="panel-body"> {{$post->getMensagem()}} </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                @if(!Auth::guest())
                                    <div class="row">
                                        <h5 class="col-md-11">{{$post->getTitulo()}}</h5>
                                        @if(\Illuminate\Support\Facades\Auth::user()->getId() == $post->getUser()->getId())
                                            <ul class="col-md-1 dropdown" style="margin-bottom: 0; margin-top: 0.5%">

                                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                                    Opções <span class="caret"></span>
                                                </a>
                                                <ul class="dropdown-menu" role="menu">
                                                    <li>
                                                        <a href="{{ route('remover_postagem', ['postagem_id' => $post->getId()])}}">
                                                            Remover
                                                        </a>
                                                    </li>

                                                    <li>
                                                        <a href="{{ route('show_editar_postagem', ['postagem_id' => $post->getId()])}}">
                                                            Editar
                                                        </a>
                                                    </li>
                                                </ul>
                                            </ul>
                                        @endif
                                    </div>
                                @else
                                    {{$post->getTitulo()}}
                                @endif
                            </div>
                            <div id="conteudo-postagem" class="panel-body"> {{$post->getMensagem()}} </div>
                            <div class="panel-body">
                                <strong>
                                    Autor: {{$post->getUser()->getEmail()}} - Tema: {{$post->getTema()->getTema()}} - {{$post->getDataPostagem()->format('d/M/y')}}
                                </strong>
                            </div>
                            <div class="panel panel-default panel-commentary">
                                <div class="panel-heading  commentary">Comentários</div>
                                @foreach($post->getAnswers() as $answers)
                                    <div class="panel-heading">
                                        {{$answers->getMensagem()}}
                                        <div class="panel-body">
                                            <strong>
                                                Autor: {{$answers->getUser()->getEmail()}} - Tema: {{$answers->getPost()->getTema()->getTema()}} - {{$answers->getDataResposta()->format('d/M/y')}}
                                            </strong>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            @if(!Auth::guest())
                                <div id="comentar-postagem" class="panel panel-default panel-commentary" style="margin-top: 2%">
                                    <form class="form-horizontal commentary-form" method="POST" action="{{route('comentar_postagem', ['postagem_id' => $post->getId()])}}">
                                        {{ csrf_field() }}
                                        <div class="form-group commentary-form">
                                            <div class="col-md-12">
                                                <div class="modal-body">
                                                    <div class="form-group commentary-form">
                                                        <div class="col-md-12">
                                                            <textarea id="comentario" style="resize: none;" class="form-control" name="comentario" rows="4" cols="50" required autofocus></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-primary">
                                                        Comentar
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <button class="button_top btn btn-primary">Topo</button>
    </div>
@endsection
