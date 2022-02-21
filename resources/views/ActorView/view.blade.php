@extends('layouts.nav')
@section('title') Actor @stop
@section('style') @parent @stop
@section('body') @parent
@section('menu')  @parent  @stop
@section('contenido')
 @section('content')
 <div class="container">
    <h1  class="text-center" >Vizualizar Actor</h1>
    <div class="row">
        <div class="col-12 d-flex justify-content-center">
            <div class="card" style="width: 25rem;">
                <div class="text-center">
                    <img src="{{asset('img/imgActorView.jpg') }}" class="card-img-center imgCard">
                </div>
                <div class="card-body home px-5">
                    <div class="row presentacion" >
                        <div class="col-12">
                            <label for="actorFirstName" class="form-label">Nombre:</label> {{$actor->firstName}}
                        </div>
                        <div class="col-12">
                            <label for="actorLastName" class="form-label">Apellido:</label> {{$actor->lastName}}
                        </div>
                        <div class="col-12">
                            <label for="actorBirthDateName" class="form-label">Fecha Nacimiento:</label> {!! date('d/m/Y', strtotime($actor->birthDate)) !!}
                        </div>
                        <div class="col-12">
                            <label for="actorNationality" class="form-label">Nacionalidad:</label> {{$actor->nationality}}
                        </div>
                    </div>
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