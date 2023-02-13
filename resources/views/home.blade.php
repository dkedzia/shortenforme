<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Shorten for me</title>
        <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">
        <script src="{{ asset('js/home.js') }}"></script>
    </head>
    <body>
        <div class="container mt-5">
            <form
                method="post"
                action="{{ route('aliases.addNew') }}"
                name="shortenForMeForm"
                onsubmit="formSubmitValidator()"
            >
                @csrf
                <div class="form-group">
                    <input
                        type="url"
                        class="form-control {{ $errors->has('origin_url') ? 'error' : '' }}"
                        name="origin_url"
                        id="origin_url"
                        placeholder="URL to be shortened..."
                    >
                    @if ($errors->has('origin_url'))
                        <div class="error">
                            {{ $errors->first('origin_url') }}
                        </div>
                    @endif
                    <p
                        id="protocol_tip"
                        style="font-size: 12px; font-weight: bold; margin: 5px 0;"
                    >Tip: Don't forget the scheme (e.g. https://)</p>
                </div>
                <div class="form-group">
                    <details>
                        <summary>Additional option</summary>
                        <input type="checkbox" id="alias_should_expire" name="alias_should_expire" value="1">
                        <label for="alias_should_expire">Alias should expire?</label>

                        <h6 class="additional-option-heading">Expiration date</h6>
                        <input
                            type="date"
                            class="form-control {{ $errors->has('expires_on') ? 'error' : '' }}"
                            name="expires_on"
                            id="expires_on"
                        >
                    </details>
                    @if ($errors->has('expires_on'))
                        <div class="error">
                            {{ $errors->first('expires_on') }}
                        </div>
                    @endif
                </div>
                <input type="submit" name="send" value="Shorten for me" class="btn btn-dark btn-block">
            </form>
        </div>
    </body>
</html>
