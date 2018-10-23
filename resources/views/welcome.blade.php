<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>검색</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.2/css/bulma.min.css">

    </head>
    <body>
        <div class="section">
            <div class="container">
                <form action="/search" method="get">
                    <div class="field">
                        <textarea class="textarea" placeholder="SKU 코드" name="sku"></textarea>
                    </div>
                    <input type="submit" class="button is-primary" value="검색">
                </form>
            </div>
        </div>
    </body>
</html>
