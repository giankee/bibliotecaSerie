@extends('layouts.nav')
@section('title') Login @stop
@section('style') @parent @stop
@section('body') @parent
@section('menu')  @parent  @stop
@section('contenido')
@section('content')
<div class="container">
    <h1  class="text-center" >Iniciar Sesión</h1>
    <div class="row">
        <div class="col-12 d-flex justify-content-center">
            <div class="card" style="width: 60%;">
                <form action="{{route('login.aLogin')}}" method="post" enctype="multipart/form-data">
                    {!! csrf_field() !!}
                    <div class="my-3 py-2 px-4 tituloLabel">
                        <label for="email" class="form-label">Email</label>
                        <input id="email" name="email" type="email" placeholder="Introduce el correo registrado" 
                        class="form-control"  required>
                        <br><br>
                        <label for="password" class="form-label">Contraseña</label>
                        <input id="password" type="password" class="form-control" name="password" placeholder="Introduce la contraseña" required>
                        <div class="text-center mt-5">
                            <input type="submit" class="btn btn-secondary" name="createBtn" value="Ingresar">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@stop
@section('footer')  @parent @stop
@section('script')  @parent @stop
@stop