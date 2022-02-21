@extends('layouts.nav')
@section('title')
    @isset($language)
        Edit Language
    @else
        New Language
    @endisset
@stop
@section('style') @parent @stop
@section('body') @parent
@section('menu')  @parent  @stop
@section('contenido')
 @section('content')
 <div class="container">
    @isset($language)
    <h1  class="text-center" >Editar Idiomas</h1>
    @else
    <h1  class="text-center" >Crear Idiomas</h1>
    @endisset
 <div class="row">
     <div class="col-12">
        @isset($language)
        <form action="{{route('languages.aUpdate', $language)}}" method="post" enctype="multipart/form-data">
            {!! csrf_field() !!}
            <input type="hidden" name="idLanguage" id="idLanguage" value="{{old('idLanguage',$language->idLanguage)}}">
        @else
        <form action="{{route('languages.aStore')}}" method="post" enctype="multipart/form-data">
            {!! csrf_field() !!}
        @endisset
             <div class="mb-3 tituloLabel">
                <label for="languageIsoCode" class="form-label">Código</label>
                <input id="languageIsoCode" name="languageIsoCode" type="text" placeholder="Introduce el código del idioma" 
                class="form-control"  required
                @isset($language)
                    value="{{old('languageIsoCode',$language->isoCode)}}"
                @else
                    value="{{old('languageIsoCode')}}"
                @endisset
                 />
                <br>
                <label for="languageName" class="form-label">Nombre del idioma</label>
                <input id="languageName" name="languageName" type="text" placeholder="Introduce el nombre del idioma" 
                class="form-control"  required
                @isset($language)
                    value="{{old('languageName',$language->name)}}"
                @else
                    value="{{old('languageName')}}"
                @endisset
                 />
             </div>
             <input type="submit" class="btn btn-secondary" name="createBtn"
            @isset($language)
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