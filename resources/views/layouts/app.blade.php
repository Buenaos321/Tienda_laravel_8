<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>
    {{-- La palabra reservada defer epera que termine de cargar el htm para despues cargar el js --}}
    <script src="{{asset('js/app.js')}}" defer></script>
    <link rel="stylesheet" href="{{asset('css/app.css')}}" />
</head>

<body>

    @include('partials.header')
    <div class="container border mt-2 p-4">
        @yield('content', 'Main Content')
    </div>



    
</body>

</html>
