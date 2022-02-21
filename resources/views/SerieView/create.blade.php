@extends('layouts.nav')
@section('title')
    @isset($serie)
        Edit Serie
    @else
        New Serie
    @endisset
@stop
@section('style') @parent @stop
@section('body') @parent
@section('menu')  @parent  @stop
@section('contenido')
@section('content')
<div class="container">
    @isset($serie)
    <h1  class="text-center" >Editar Series</h1>
    @else
    <h1  class="text-center" >Crear Series</h1>
    @endisset

    @isset($serie)
    <form action="{{route('series.aUpdate', $serie)}}" method="post" enctype="multipart/form-data">
        {!! csrf_field() !!}
        <input type="hidden" name="idSerie" id="idSerie" value="{{old('idSerie',$serie->idSerie)}}">
    @else
    <form action="{{route('series.aStore')}}" method="post" enctype="multipart/form-data">
        {!! csrf_field() !!}
    @endisset
        <div class="row tituloLabel">
            <div class="col-12  col-md-4">
                <label for="serieTitle" class="form-label">Titulo</label>
                <input id="serieTitle" name="serieTitle" type="text" placeholder="Introduce el título" class="form-control"  required
                @isset($serie) value="{{old('serieTitle',$serie->title)}}"
                @else value="{{old('serieTitle')}}" @endisset>
            </div>
            <div class="col-6 col-md-4">
                <label for="serieDirectorId" class="form-label">Director</label>
                <select id="serieDirectorId" name="serieDirectorId" class="form-control" required>
                    <option value="">Sin Asignar</option>
                    @foreach($directors as $datoDirector)
                        @isset($serie)
                            @if ($serie->directorId ==$datoDirector->idDirector )
                                <option value="{{$datoDirector->idDirector}}" selected>{{$datoDirector->firstName}} {{$datoDirector->lastName}}</option>
                            @else
                                <option value="{{$datoDirector->idDirector}}">{{$datoDirector->firstName}} {{$datoDirector->lastName}}</option>
                            @endif
                        @else <option value="{{$datoDirector->idDirector}}">{{$datoDirector->firstName}} {{$datoDirector->lastName}}</option>
                        @endisset
                    @endforeach
                </select>
            </div>
            <div class="col-6 col-md-4">
                <label for="seriePlatformId" class="form-label">Plataforma</label>
                <select id="seriePlatformId" name="seriePlatformId" class="form-control" required>
                    <option value="">Sin Asignar</option>
                    @foreach($platforms as $datoPlatform)
                        @isset($serie)
                            @if ($serie->platformId ==$datoPlatform->idPlatform )
                                <option value="{{$datoPlatform->idPlatform}}" selected>{{$datoPlatform->name}}</option>
                            @else
                                <option value="{{$datoPlatform->idPlatform}}">{{$datoPlatform->name}}</option>
                            @endif
                        @else <option value="{{$datoPlatform->idPlatform}}">{{$datoPlatform->name}}</option>
                        @endisset
                    @endforeach
                </select>
            </div>
            <div class="col-12">
                <label for="serieSynopsis" class="form-label">Sinopsis</label>
                <textarea id="serieSynopsis" name="serieSynopsis" class="form-control" required placeholder="Introduce una breve detalle de la serie">@isset($serie){{old('serieSynopsis',$serie->synopsis)}}@else{{old('serieSynopsis')}}@endisset</textarea>
            </div>
            <div class="col-12 mt-2 text-center">
                <input type="submit" class="btn btn-secondary" name="createBtn"
                @isset($serie) value="Editar" @else value="Crear"@endisset>
            </div>
        </div>
    </form>

    @isset($serie)
    <div class="row mb-5">
        <div class="col-12 col-lg-6">
            <h2  class="text-center" >Elenco</h2>
            <div class="boxForm">
                <form method="POST" action="{{route('series.aAddActor')}}">
                    {!! csrf_field() !!}
                    <div class="d-flex inline-block mb-3">
                        <input type="hidden" name="idSerie" id="idSerie" value="{{old('idSerie',$serie->idSerie)}}">
                        <select id="addActor" name="addActor" class="form-control" required>
                            <option value="">Sin Asignar</option>
                            @foreach($actors as $datoActor)
                            <option value="{{$datoActor->idActor}}">{{$datoActor->firstName}} {{$datoActor->lastName}}</option>
                            @endforeach
                        </select>
                        <input type="submit" class="btn btn-secondary" name="createBtn" value="Agregar">
                    </div>
                </form>
                <div class="table-responsive" style="border: 1px solid #dddddd; padding-top: 2px;">
                    <table class="table">
                        <thead>
                            <tr class="text-center">
                                <th style="width: 10%">Índice</th>
                                <th  style="width: 35%">Nombre</th>
                                <th  style="width: 35%">Apellido</th>
                                <th style="width: 20%">Operaciones</th>
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
                                        <td class="text-center">
                                            <form method="POST" action="{{route('series.aDeleteActor')}}" style="display: inline-block;">
                                                {{method_field('delete')}}
                                                {!! csrf_field() !!}
                                                <input type="hidden" name="serieActorIdSerie" id="serieActorIdSerie" value="{{old('serieActorIdSerie',$serie->idSerie)}}">
                                                <input type="hidden" name="serieActorIdSerieActor" id="serieActorIdSerieActor" value="{{old('serieActorIdSerieActor',$dato->pivot->idSerieActor)}}">
                                                <button type="submit" class="btn btn-danger" name="delateBtn">Borrar</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <td class="font-italic text-center" colspan="3">
                                    No existen actores ó actrices agregados
                                </td>
                            @endif
                        </tbody>
                    </table>
                    {{-- <div class="float-right pr-3">
                        @if ($listActors instanceof \Illuminate\Pagination\LengthAwarePaginator)
                            {{$listActors->links()}}
                        @endif
                    </div> --}}
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-6">
            <h2  class="text-center" >Idiomas Disponibles</h2>
            <div class="boxForm">
                <form method="POST" action="{{route('series.aAddLanguage')}}">
                    {!! csrf_field() !!}
                    <div class="d-flex inline-block mb-3">
                        <input type="hidden" name="idSerie" id="idSerie" value="{{old('idSerie',$serie->idSerie)}}">
                        <select id="addLanguage" name="addLanguage" class="form-control" required>
                            <option value="">Sin Asignar</option>
                            @foreach($languages as $datoLanguage)
                            <option value="{{$datoLanguage->idLanguage}}">{{$datoLanguage->name}}</option>
                            @endforeach
                        </select>
                        <input type="submit" class="btn btn-secondary" name="createBtn" value="Agregar">
                    </div>
                </form>
                <div class="table-responsive" style="border: 1px solid #dddddd; padding-top: 2px;">
                    <table class="table">
                        <thead>
                            <tr class="text-center">
                                <th style="width: 10%">Índice</th>
                                <th  style="width: 40%">Idioma</th>
                                <th  style="width: 30%">Tipo</th>
                                <th style="width: 20%">Operaciones</th>
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
                                        <td class="text-center">
                                            <form method="POST" action="{{route('series.aDeleteLanguage')}}" style="display: inline-block;">
                                                {{method_field('delete')}}
                                                {!! csrf_field() !!}
                                                <input type="hidden" name="serieLanguageIdSerie" id="serieLanguageIdSerie" value="{{old('serieLanguageIdSerie',$serie->idSerie)}}">
                                                <input type="hidden" name="serieLanguageIdSerieLanguage" id="serieLanguageIdSerieLanguage" value="{{old('serieLanguageIdSerieLanguage',$dato->pivot->idSerieLanguage)}}">
                                                <button type="submit" class="btn btn-danger" name="delateBtn">Borrar</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <td class="font-italic text-center" colspan="3">
                                    No existen idiomas agregados
                                </td>
                            @endif
                        </tbody>
                    </table>
                    {{-- <div class="float-right pr-3">
                        @if ($listLanguages instanceof \Illuminate\Pagination\LengthAwarePaginator)
                            {{$listLanguages->links()}}
                        @endif
                    </div> --}}
                </div>
            </div>
        </div>
    </div>
    @endisset
</div>
@endsection
@stop
@section('footer')  @parent @stop
@section('script')  @parent @stop
@stop