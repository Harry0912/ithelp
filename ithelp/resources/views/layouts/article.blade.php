<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('css/app.css') }}">
    <title>Harry 幫幫忙!</title>
</head>
<body>
    <main css="m-4">
        @if(session()->has('notice'))
            <div class="bg-pink-300 px-3 py-2 rounded">
                {{ session()->get('notice') }}
            </div>
        @endif
        @yield('main')
    </main>
</body>
<script src="{{ asset('js/app.js') }}"></script>
</html>