@extends('layouts.nav')
@section('title') Director @stop
@section('style') @parent @stop
@section('body') @parent
@section('menu')  @parent  @stop
@section('contenido')
 @section('content')
 <div class="container">
    <h1  class="text-center" >Vizualizar Director</h1>
    <div class="row">
        <div class="col-12 d-flex justify-content-center">
            <div class="card" style="width: 25rem;">
                <div class="text-center">
                    <img src="{{asset('img/imgDirectorView.jpg') }}" class="card-img-center imgCard">
                </div>
                <div class="card-body home px-5">
                    <div class="row presentacion" >
                        <div class="col-12">
                            <label for="directorFirstName" class="form-label">Nombre:</label> {{$director->firstName}}
                        </div>
                        <div class="col-12">
                            <label for="directorLastName" class="form-label">Apellido:</label> {{$director->lastName}}
                        </div>
                        <div class="col-12">
                            <label for="directorBirthDateName" class="form-label">Fecha Nacimiento:</label> {!! date('d/m/Y', strtotime($director->birthDate)) !!}
                        </div>
                        <div class="col-12">
                            <label for="directorNationality" class="form-label">Nacionalidad:</label> {{$director->nationality}}
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