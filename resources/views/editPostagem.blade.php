@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <form class="form-horizontal" method="POST" action="{{route('editar_postagem', ['postagem_id' => $post->getId()])}}">
                        {{ csrf_field()}}
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-md-11">
                                    <textarea id="titulo" style="resize: none;" class="form-control" name="titulo" rows="1" cols="20" required autofocus>{{$post->getTitulo()}}</textarea>
                                </div>
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
                                    </ul>
                                </ul>
                            </div>
                        </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <div class="col-md-12">
                                <textarea id="mensagem" style="resize: none;" class="form-control" name="mensagem" rows="6" cols="50" required autofocus>{{preg_replace('/\s+/', ' ', $post->getMensagem())}}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <a class="btn btn-default" style="margin-right: 1%" href="{{ route('home') }}">Home</a>
                        <span class="pull-right">
                            <button type="submit" class="btn btn-primary">
                                Confirmar Alteraçoes
                            </button>
                        </span>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection