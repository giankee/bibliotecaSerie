@extends('layouts.nav')
@section('title')
    @isset($director)
        Edit Director
    @else
        New Director
    @endisset
@stop
@section('style') @parent @stop
@section('body') @parent
@section('menu')  @parent  @stop
@section('contenido')
 @section('content')
 <div class="container">
    @isset($director)
    <h1  class="text-center" >Editar Director</h1>
    @else
    <h1  class="text-center" >Crear Director</h1>
    @endisset
    <div class="row">
        <div class="col-12">
        @isset($director)
        <form action="{{route('directors.aUpdate', $director)}}" method="post" enctype="multipart/form-data">
            {!! csrf_field() !!}
            <input type="hidden" name="idDirector" id="idDirector" value="{{old('idDirector',$director->idDirector)}}">
        @else
        <form action="{{route('directors.aStore')}}" method="post" enctype="multipart/form-data">
            {!! csrf_field() !!}
        @endisset
                <div class="mb-3 tituloLabel">
                <label for="directorFirstName" class="form-label">Nombre</label>
                <input id="directorFirstName" name="directorFirstName" type="text" placeholder="Introduce nombre del director" 
                class="form-control"  required
                @isset($director)
                    value="{{old('directorFirstName',$director->firstName)}}"
                @else
                    value="{{old('directorFirstName')}}"
                @endisset
                    />
                <br>
                <label for="directorLastName" class="form-label">Apellido</label>
                <input id="directorLastName" name="directorLastName" type="text" placeholder="Introduce apellido del director" 
                class="form-control"  required
                @isset($director)
                    value="{{old('directorLastName',$director->lastName)}}"
                @else
                    value="{{old('directorLastName')}}"
                @endisset
                    />
                <br>
                <label for="directorBirthDate" class="form-label">Fecha de Nacimiento</label>
                <input id="directorBirthDate" name="directorBirthDate" type="date" class="form-control" min="1800-01-01" required
                @isset($director)
                    value="{{old('directorBirthDate',$director->birthDate)}}"
                @else
                    value="{{old('directorBirthDate')}}"
                @endisset
                    />
                <br>
                <label for="directorNationality" class="form-label">Nacionalidad</label>
                <input id="directorNationality" name="directorNationality" type="text" placeholder="Introduce nacionalidad del director" 
                class="form-control"  required
                @isset($director)
                    value="{{old('directorNationality',$director->nationality)}}"
                @else
                    value="{{old('directorNationality')}}"
                @endisset
                    />
                </div>
                <input type="submit" class="btn btn-secondary" name="createBtn"
            @isset($director)
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