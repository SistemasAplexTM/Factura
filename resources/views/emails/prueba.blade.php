<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Nueva solicitud</title>
    <link href="{{ asset('css/vendor.css') }}" rel="stylesheet">
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<body>
	<div class="container">
       
		<div class="row">
	        <div class="col s12 m7">
	          <div class="card">
	            {{-- <div class="card-image">
	              <img src="{{ asset('img/xplod.png') }}">
	              <span class="card-title vlack-text">Nueva petición</span>
	            </div> --}}
	            {{-- <div class="card-title black-text"></div> --}}
	            <div class="card-content">
	            	<h1>Nueva petición</h1>
	              <p>Se ha solicitado un nuevo cambio de precio.</p>
	            </div>
	            <div class="card-action">
	              <a href="http://demo.2factura.com/public">Ver solicitudes</a>
	            </div>
	          </div>
	        </div>
	      </div>
	           
          
	</div>
	<script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/vendor.js') }}"></script>
</body>
</html>