<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Shorten for me</title>
        <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">
    </head>
    <body>
        <div class="container mt-5">
            <form method="post" action="{{ route('aliases.addNew') }}">
                @csrf
                <div class="form-group">
                    <input type="text" class="form-control {{ $errors->has('origin_url') ? 'error' : '' }}" name="origin_url" id="origin_url" placeholder="URL to be shortened...">
                    @if ($errors->has('origin_url'))
                        <div class="error">
                            {{ $errors->first('origin_url') }}
                        </div>
                    @endif
                </div>
                <input type="submit" name="send" value="Shorten for me" class="btn btn-dark btn-block">
            </form>
        </div>
    </body>
</html>
