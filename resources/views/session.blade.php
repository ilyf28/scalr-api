<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>
    </head>
    <body>
        <h1>Session: Get</h1>
        <h2>Description</h2>
        <p></p>
        <p>Retrieve detailed information about the current authenticated user.</p>
        <p></p>
        <h2>Try it out!</h2>
        <p>No parameters.</p>
        <form method="POST" action="{{ url('/session') }}">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="submit" name="submit" value="Authorize and execute" />
        </form>
        <p></p>
        @isset($session)
        <h2>Response Body</h2>
        <p>
            @php
            echo '<pre>'.json_encode($session, JSON_PRETTY_PRINT).'</pre>';
            @endphp
        </p>
        @endisset
    </body>
</html>
