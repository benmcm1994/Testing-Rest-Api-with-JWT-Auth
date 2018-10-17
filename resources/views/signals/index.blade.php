<!doctype html>
<html>
    <head>
        <title>Laravel</title>
    </head>
    <body>
       <ul>
            @foreach ($signals as $signal)
                <li>{{ $signal-> name }}</li>
            @endforeach
       </ul>
    </body>
</html>
