@extends('layouts.nav')
@section('title')
    @isset($actor)
        Edit Actor
    @else
        New Actor
    @endisset
@stop
@section('style') @parent @stop
@section('body') @parent
@section('menu')  @parent  @stop
@section('contenido')
@section('content')
<div class="container">
    @isset($actor)
    <h1  class="text-center" >Editar Actor ó Actris</h1>
    @else
    <h1  class="text-center" >Crear Actor ó Actris</h1>
    @endisset
    <div class="row">
        <div class="col-12">
            @isset($actor)
            <form action="{{route('actors.aUpdate', $actor)}}" method="post" enctype="multipart/form-data">
                {!! csrf_field() !!}
                <input type="hidden" name="idActor" id="idActor" value="{{old('idActor',$actor->idActor)}}">
            @else
            <form action="{{route('actors.aStore')}}" method="post" enctype="multipart/form-data">
                {!! csrf_field() !!}
            @endisset
                <div class="mb-3 tituloLabel">
                    <label for="actorFirstName" class="form-label">Nombre</label>
                    <input id="actorFirstName" name="actorFirstName" type="text" placeholder="Introduce nombre del actor ó actris" 
                    class="form-control"  required
                    @isset($actor)
                        value="{{old('actorFirstName',$actor->firstName)}}"
                    @else
                        value="{{old('actorFirstName')}}"
                    @endisset
                    />
                    <br>
                    <label for="actorLastName" class="form-label">Apellido</label>
                    <input id="actorLastName" name="actorLastName" type="text" placeholder="Introduce apellido del actor ó actris" 
                    class="form-control"  required
                    @isset($actor)
                        value="{{old('actorLastName',$actor->lastName)}}"
                    @else
                        value="{{old('actorLastName')}}"
                    @endisset
                    />
                    <br>
                    <label for="actorBirthDate" class="form-label">Fecha de Nacimiento</label>
                    <input id="actorBirthDate" name="actorBirthDate" type="date" class="form-control" min="1800-01-01" required
                    @isset($actor)
                        value="{{old('actorBirthDate',$actor->birthDate)}}"
                    @else
                        value="{{old('actorBirthDate')}}"
                    @endisset
                    />
                    <br>
                    <label for="actorNationality" class="form-label">Nacionalidad</label>
                    <input id="actorNationality" name="actorNationality" type="text" placeholder="Introduce nacionalidad del actor ó actris" 
                    class="form-control"  required
                    @isset($actor)
                        value="{{old('actorNationality',$actor->nationality)}}"
                    @else
                        value="{{old('actorNationality')}}"
                    @endisset
                    />
                </div>
                <input type="submit" class="btn btn-secondary" name="createBtn"
                @isset($actor)
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