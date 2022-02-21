@extends('layouts.nav')
@section('title')
    @isset($platform)
        Edit Platform
    @else
        New Platform
    @endisset
@stop
@section('style') @parent @stop
@section('body') @parent
@section('menu')  @parent  @stop
@section('contenido')
 @section('content')
 <div class="container">
    @isset($platform)
    <h1  class="text-center" >Editar Plataforma</h1>
    @else
    <h1  class="text-center" >Crear Plataforma</h1>
    @endisset
    <div class="row">
        <div class="col-12">
            @isset($platform)
            <form action="{{route('platforms.aUpdate', $platform)}}" method="post" enctype="multipart/form-data">
                {!! csrf_field() !!}
                <input type="hidden" name="idPlatform" id="idPlatform" value="{{old('idPlatform',$platform->idPlatform)}}">
            @else
            <form action="{{route('platforms.aStore')}}" method="post" enctype="multipart/form-data">
                {!! csrf_field() !!}
            @endisset
                <div class="mb-3 tituloLabel">
                    <label for="platformName" class="form-label">Nombre de la plataforma</label>
                    <input id="platformName" name="platformName" type="text" placeholder="Introduce el nombre de la plataforma" 
                    class="form-control"  required
                    @isset($platform)
                        value="{{old('platformName',$platform->name)}}"
                    @else
                        value="{{old('platformName')}}"
                    @endisset
                    />
                </div>
                <input type="submit" class="btn btn-secondary" name="createBtn"
                @isset($platform)
                    value="Editar" @else value="Crear"
                @endisset
                >
            </form>
        </div>
    </div>
 </div>
@endsection
@stop
@section('footer')  @parent @stop
@section('script')  @parent @stop
@stop