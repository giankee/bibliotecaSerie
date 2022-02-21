<!DOCTYPE doctype html>
<html lang="es">
<head>
	<title>
		@yield ('title') - Biblioteca
	</title>
	<!-- Required meta tags -->
	<meta charset="utf-8">
    <!-- CSS only -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- Bootstrap CSS -->
	@section('style')
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="{{asset('css/estilos.css') }}" rel="stylesheet">
	@show
</head>
@section('body')
<body>
	@section('menu')
	<!-- sección menu -->
    <nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark mb-2">
        <div class="container-fluid">
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link " href="{{route('aHome')}}"> Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('platforms.aList')}}">Plataformas</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('directors.aList')}}">Directores</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('actors.aList')}}">Actores</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('languages.aList')}}">Idiomas</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('series.aList')}}">Series</a>
                    </li>
                </ul>
            </div><a class="nav-link text-white text-center" href="{{route('mShowLogin')}}"><i class="fa fa-sign-in" aria-hidden="true"></i>&nbsp; Login</a>
        </div>
    </nav>
	<!-- fin menu -->
	@show
    <div class="container-fluid mt-5 pt-2">
        <div class="position-ref full-height">
            <div id="app" class="content">
                @include('partials.alerts')
                <br>
                @yield('content')
            </div>
        </div>
    </div>
@show
<!-- secion contenido -->
@section('contenido')
@show
<!-- fin contenido -->
@section('footer')
<!-- footer -->
    <div class="footer">
        <div id="button"><img id="logoViu" src="{{asset('soloLogo.png') }}" style="width: 45px" ></div>
        <div id="container">
            <div id="cont" style="right: 250px;">
                <div class="footer_center" style="width: 800px;">
                    <h3>© 2022 Copyright: Universidad Internacional de Valencia</h3><br>
                    {{-- <h3>Karol Ricardo Linares Correa - Giancarlo Miguel Álvarez Reyes</h3> --}}
                </div>
            </div>
        </div>
    </div>
<!-- fin footer -->
@show
@section('script')
<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
</script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
</script>
@show
</body>
@show
</html>