<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ $title }}</title>
    </head>
    <body>
        <h1>{{ $title }}</h1>

        <form action="example/1" method="POST">
            @csrf
            <input type="text" name="var" value="10000">
            <input type="submit" value="send">
        </form>

        <form action="example/2" method="POST">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="text" name="var" value="20000">
            <input type="submit" value="send">
        </form>

        <form action="example/3" method="POST">
            <input type="text" name="var" value="30000">
            @csrf
            @method('PUT')
            <input type="submit" value="send">
        </form>

        <form action="example/4" method="POST">
            <input type="text" name="var" value="40000">
            @csrf
            @method('DELETE')
            <input type="submit" value="send">
        </form>

        <form action="example/5" method="POST">
            <input type="text" name="var" value="50000">
            @csrf
            @method('PATCH')
            <input type="submit" value="send">
        </form>
    </body>
</html>
