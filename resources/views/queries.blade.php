<!DOCTYPE html>
<html>
<head>
    <title>Laravel Query Builder</title>
</head>
<body>
    <h1>Laravel Query Builder Results</h1>

    @foreach($queries as $key => $result)
        <h3>{{ ucwords(str_replace('_', ' ', $key)) }}</h3>

        @if(is_object($result) || is_array($result))
            <ul>
                @foreach($result as $item)
                    <li>{{ json_encode($item) }}</li>
                @endforeach
            </ul>
        @else
            <p>{{ $result }}</p>
        @endif
    @endforeach
</body>
</html>
