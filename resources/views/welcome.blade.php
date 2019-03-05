<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Laravel</title>

        <script type="text/javascript" src="//cdn.webix.com/edge/webix.js"></script>
        <link rel="stylesheet" type="text/css" href="//cdn.webix.com/edge/webix.css">

        <!-- App -->
        <script type="text/javascript" src="{{ asset('webix/myapp.js') }}"></script>
        <link rel="stylesheet" type="text/css" href="{{ asset('webix/myapp.css') }}">
    </head>
    <body>

    </body>
</html>
