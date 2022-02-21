@extends('layouts.nav')
@section('title') Serie @stop
@section('style') @parent @stop
@section('body') @parent
@section('menu')  @parent  @stop
@section('contenido')
 @section('content')
@isset($serie)
    <h1  class="text-center" >Vizualizar Serie</h1>
    <div class="row px-5">
        <div class="col-12 col-sm-8">
            <div class="row">
                <div class="col-12">
                    <div class="boxForm">
                        <div class="row py-3">
                            <div class="col-4">
                                <div class="text-center">
                                    <img src="{{asset('img/imgSerieView.jpg') }}" class="card-img-center imgCard">
                                </div>
                            </div>
                            <div class="col-8">
                                <div class="row presentacion" style="color: black" >
                                    <div class="col-12 mt-2">
                                        <label for="serieTittle" class="form-label">Título:</label> {{$serie->title}}
                                    </div>
                                    <div class="col-12">
                                        <label for="serieDirector" class="form-label">Director:</label>  {{$serie->firstName}} {{$serie->lastName}}
                                    </div>
                                    <div class="col-12" style="height: 135px;">
                                        <label for="serieSinopsis" class="form-label">Sinopsis:</label>  {{$serie->synopsis}}
                                    </div>
                                    <div class="col-12">
                                        <label for="seriePlataform" class="form-label">Plataforma:</label>  {{$serie->name}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="card" >
                        <div id="Listados" class="card-header d-flex justify-content-between">
                            <h5><a class="text-dark2">Listado del Reparto</a></h5>
                        </div>
                        <div class="table-responsive" style="border: 1px solid #dddddd; padding-top: 2px;">
                            <table class="table">
                                <thead>
                                    <tr class="text-center">
                                        <th style="width: 10%">Índice</th>
                                        <th  style="width: 45%">Nombre</th>
                                        <th  style="width: 45%">Apellido</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (count($listActors)>0)
                                        <?php $contadorActores = 0; ?>
                                        @foreach ($listActors as $dato)
                                            <tr>
                                                <td class="indice">{{++$contadorActores}}</td>
                                                <td>{{$dato->firstName}}</td>
                                                <td>{{$dato->lastName}}</td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <td class="font-italic text-center" colspan="3">
                                            No existen actores ó actrices agregados
                                        </td>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-4">
            <div class="card" >
                <div id="Listados" class="card-header d-flex justify-content-between">
                    <h5><a class="text-dark2">Listado de Idiomas Disponible</a></h5>
                </div>
                <div class="table-responsive" style="border: 1px solid #dddddd; padding-top: 2px;">
                    <table class="table">
                        <thead>
                            <tr class="text-center">
                                <th style="width: 10%">Índice</th>
                                <th  style="width: 45%">Idioma</th>
                                <th  style="width: 35%">Tipo</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($listLanguages)>0)
                                <?php $contadorLanguages = 0; ?>
                                @foreach ($listLanguages as $dato)
                                    <tr>
                                        <td class="indice">{{++$contadorLanguages}}</td>
                                        <td>{{$dato->name}}</td>
                                        <td>{{$dato->pivot->type}}</td>
                                    </tr>
                                @endforeach
                            @else
                                <td class="font-italic text-center" colspan="3">
                                    No existen idiomas agregados
                                </td>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
     </div>
@else
    <h2  class="text-center" >Error</h2>
@endisset
@endsection
@stop
@section('footer')  @parent @stop
@section('script')  @parent @stop
@stop