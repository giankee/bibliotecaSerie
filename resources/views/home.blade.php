@extends('layouts.nav')
@section('title') HOME @stop
@section('style') @parent @stop
@section('body') @parent
@section('menu')  @parent  @stop
@section('contenido')
<h1  class="text-center" >Biblioteca de Series</h1>
<div class="row mt-2">
    <div class="col-4 d-flex justify-content-center">
        <div class="card text-center" style="width: 18rem;">
            <img src="{{asset('img/imgPlataformas.jpg') }}" class="card-img-center imgCard">
            <div class="card-body home">
                <h5 class="card-title">Plataformas</h5>
                <a href="{{route('platforms.aList')}}" class="btn btn-secondary">Visitar</a>
            </div>
        </div>
    </div>
    <div class="col-4 d-flex justify-content-center">
        <div class="card text-center" style="width: 18rem;">
            <img src="{{asset('img/imgDirector.jpg') }}" class="card-img-center imgCard">
            <div class="card-body home">
                <h5 class="card-title">Directores</h5>
                <a href="{{route('directors.aList')}}" class="btn btn-secondary">Visitar</a>
            </div>
        </div>
    </div>
    <div class="col-4 d-flex justify-content-center">
        <div class="card text-center" style="width: 18rem;">
            <img src="{{asset('img/imgActor.jpg') }}" class="card-img-center imgCard">
            <div class="card-body home">
                <h5 class="card-title">Actores</h5>
                <a href="{{route('actors.aList')}}" class="btn btn-secondary">Visitar</a>
            </div>
        </div>
    </div>
</div>
<div class="row mt-4">
    <div class="col-6 d-flex justify-content-center">
        <div class="card text-center" style="width: 18rem;">
            <img src="{{asset('img/imgLenguaje.jpg') }}" class="card-img-center imgCard">
            <div class="card-body home">
                <h5 class="card-title">Idiomas</h5>
                <a href="{{route('languages.aList')}}" class="btn btn-secondary">Visitar</a>
            </div>
        </div>
    </div>
    <div class="col-6 d-flex justify-content-center">
        <div class="card text-center" style="width: 18rem;">
            <img src="{{asset('img/imgSerie.jpg') }}" class="card-img-center imgCard">
            <div class="card-body home">
                <h5 class="card-title">Series</h5>
                <a href="{{route('series.aList')}}" class="btn btn-secondary">Visitar</a>
            </div>
        </div>
    </div>
</div>
@stop
@section('footer')  @parent @stop
@section('script')  @parent @stop
@stop

