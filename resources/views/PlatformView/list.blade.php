@extends('layouts.nav')
@section('title') Platforms @stop
@section('style') @parent @stop
@section('body') @parent
@section('menu')  @parent  @stop
@section('contenido')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="card" >
                <div id="Listados" class="card-header d-flex justify-content-between">
                    <h5><a class="text-dark2">Listado de plataformas</a></h5>
                    <a href="{{route('platforms.aCreate')}}" class="btn btn-outline-secondary btn-sm text-white">+ Crear Plaforma
                </a>
                </div>
                <div class="row mt-2 px-4 pt-2">
                    <div class="col-8">
                        <form method="POST" action="">
                            {!! csrf_field() !!}
                            <div class="input-group mb-3">
                                <div class="input-group-prepend" style="width: 80%">
                                    <input type="text" name="dataFiltro" id="dataFiltro" class="form-control" required value="@isset($dataFiltro) {{$dataFiltro}} @endisset" placeholder="Buscar por nombre de plataforma">
                                </div>
                                <button type="submit" class="btn btn-secondary" name="buscarBtn">Buscar</button>
                            </div>
                        </form>
                    </div>
                    <div class="col-4">
                        <div class="float-right">
                            @if ($platforms instanceof \Illuminate\Pagination\LengthAwarePaginator)
                                {{$platforms->links()}}
                            @endif
                        </div>
                    </div>
                </div>
                <div class="table-responsive" style="border: 1px solid #dddddd; padding-top: 2px;">
                    <table class="table">
                        <thead>
                            <tr class="text-center">
                                <th style="width: 10%">Índice</th>
                                <th style="width: 65%">Nombre</th>
                                <th style="width: 25%">Operaciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($platforms)>0)
                                <?php $contador = 0; ?>
                                @foreach ($platforms as $dato)
                                    <tr>
                                        <td class="indice">{{++$contador}}</td>
                                        <td>{{$dato->name}}</td>
                                        <td class="text-center"> 
                                            <a href="{{ route('platforms.aShowForm',[$dato->idPlatform])}}" class="btn btn-danger"><i class="fa fa-edit">Editar</i></a>
                                            <form method="POST" action="{{route('platforms.aDelete',$dato)}}" style="display: inline-block;">
                                                {{method_field('delete')}}
                                                {!! csrf_field() !!}
                                                <input type="hidden" name="idPlatform" id="idPlatform" value="{{$dato->idPlatform}}">
                                                <button type="submit" class="btn btn-danger" name="delateBtn">Borrar</button>
                                            </form>
                                        </td>
                                        
                                    </tr>
                                @endforeach
                            @else
                                <td class="font-italic text-center" colspan="3">
                                    No existen plataformas registradas
                                </td>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@stop
@section('footer')  @parent @stop
@section('script')  @parent @stop
@stop