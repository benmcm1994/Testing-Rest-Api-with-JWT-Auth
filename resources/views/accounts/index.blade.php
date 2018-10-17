<!doctype html>
<html>
    <head>
        <title>Laravel</title>
    </head>
    <body>
       <ul>
            @foreach ($accounts as $account)
                <li>{{ $account-> name }}</li>
            @endforeach
       </ul>
    </body>
</html>
