<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="csrf-token" content ="{!!csrf_token()!!}" />
	<link rel="icon" type="image/png"   href="public/images/favicon.png">
	<title>Necesito lentes</title>

	<link rel="stylesheet" type="text/css" href="public/css/app.css">
	{{-- <link rel="stylesheet" type="text/css" href="public/extras/css/font-awesome/css/all.min.css"> --}}
	{{-- <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.15.3/css/all.css" type="text/css"> --}}

	{{-- FB sharing metadata --}}
  {{-- <meta name="robots" content="NOODP">
	<meta property="og:url"                content="https://xxx.xxx/"/>
	<meta property="og:title"              content="Base v2"/>
	<meta property="og:description"        content=""/>
  <meta property="og:image"              content="https://xxx.xxx/public/images/social.jpg"/>
  <meta name="description" content="" /> --}}

	@include('shared.jsDir')
</head>

<body>
	<div id="app">
		<vue-topprogress ref="loadingBar" color="#ffffff" :height="2"></vue-topprogress>
		<my-header></my-header>
		<router-view></router-view>
		<my-footer></my-footer>
	</div>

	<script type="text/javascript" src="public/js/app.js"></script>
</body>

</html>
