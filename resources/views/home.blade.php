<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="{{asset('js/script.js')}}"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $('#button-tema').click(function(){
            $('#cadastrar-tema').toggle();
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
                    <div class="panel-heading">Temas</div>
                    <div class="panel-body">
                        @if(Auth::user()->getRole()->getId() == \App\Enum\RoleEnum::ADMINISTRADOR)
                            <button id='button-tema' type="submit" class="btn btn-primary">
                                Cadastrar Tema
                            </button>
                        @endif
                    </div>
                    <div id="cadastrar-tema">
                        <div class="panel panel-default panel-commentary">
                            <div class="panel-heading">Cadastrar Tema</div>
                            <div class="panel-body panel-body-padding-bottom">
                                <form class="form-horizontal" method="POST" action="{{route('cadastrar_tema')}}">
                                    {{ csrf_field() }}
                                    <div class="form-group">
                                        <label for="tema" class="col-md-1 control-label">Tema</label>
                                        <div class="col-md-3">
                                            <input id="tema" type="text" class="form-control" name="tema" value="" required autofocus>
                                        </div>
                                        <button type="submit" class="btn btn-primary">
                                            Cadastrar
                                        </button>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
        @foreach($temas as $tema)
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="container-fluid">
                    <a class="btn btn-default col-md-12" href="{{ route('show_posts', ['tema_id' => $tema->getId()])}}" role="button">
                        <p class="h3">{{$tema->getTema()}}</p>
                    </a>
                </div>
            </div>
        </div>

        @endforeach
    </div>
    <button class="button_top btn btn-primary">Topo</button>
</div>
@endsection
