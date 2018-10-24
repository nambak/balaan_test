<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>검색결과</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.2/css/bulma.min.css">

</head>
<body>
<div class="section">
    <div class="container">
        @foreach($results as $sku => $value)
            <h1 class="is-size-3">{{ $sku }}</h1>
            @if (empty($value))
                <span>검색결과 없음</span>
            @else
                @foreach($value as $item)
                    <li style="margin-top: 10px;">
                        <span>가격 : {{ number_format($item['price']) }}</span>
                        <a class="button is-small is-success" href="{{ $item['url'] }}">쇼핑몰 바로가기</a>
                    </li>
                @endforeach
            @endif
        @endforeach
    </div>
</div>
</body>
</html>
