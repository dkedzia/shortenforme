<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Shorten for me</title>
        <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">
        <script src="{{ asset('js/aliasAdded.js') }}"></script>
    </head>
    <body>
        <div class="container mt-5">
            Your shortened url:
            <h2 id="shortened_url">{{ $shortenedUrl }}</h2>
            <div
                id="copy_to_clipboard"
                class="btn btn-dark btn-block"
                onclick="copyUrlToClipboard()"
            >
                Copy
            </div>
        </div>
    </body>
</html>
