<!doctype html>
<html>
    <head>
        <title>Laravel</title>
    </head>
    <body>
       <ul>
            @foreach ($users as $user)
                <li>{{ $user-> name }}</li>
            @endforeach
       </ul>
    </body>
</html>
