<!DOCTYPE html>
<html class="h-full bg-gray-200">
<head>
    <meta charset="utf-8">
    {{-- <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=yes"> --}}
    <link href="{{ mix('/css/app.css') }}" rel="stylesheet">

    {{-- Inertia --}}
    <script src="https://polyfill.io/v3/polyfill.min.js?features=smoothscroll,NodeList.prototype.forEach,Promise,Object.values,Object.assign" defer></script>

    {{-- Ping CRM --}}
    <script src="https://polyfill.io/v3/polyfill.min.js?features=String.prototype.startsWith" defer></script>

    <script src="{{ mix('/js/app.js') }}" defer></script>
    
    <!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-117992585-1"></script>
	<script>
	  window.dataLayer = window.dataLayer || [];
	  function gtag(){dataLayer.push(arguments);}
	  gtag('js', new Date());

	  gtag('config', 'UA-117992585-1');
	</script>

    @routes
</head>
<body class="font-sans leading-none text-gray-700 antialiased">

@inertia

</body>
</html>
