<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <div class="container p-4">
        <div class="nav">
            <a href="{{ route('change.lang') }}" class="btn btn-secondary">@lang('homePage.changeLanguage')</a>
        </div>
        <h1 class="text-center">@lang('homePage.title')</h1>

        @if(\Illuminate\Support\Facades\Session::has('status'))

        <div class="alert alert-success">
            <b>@lang('homePage.alert')</b>
        </div>
            <div class="mt-5">
                <a href="{{ asset('uploads/'.\Illuminate\Support\Facades\Session::get('filename')) }}" download>
                    <button class="btn form-control btn-success" type="button">@lang('homePage.downloadButton')</button>
                </a>
            </div>

        @else

            <div class="text-center mt-4">
                <form action="{{ route('image.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="image">@lang('homePage.fileInputLabel'):</label>
                        <input accept="image/*" oninput="showDetails()" type="file" name="image" id="image" class="form-control">
                    </div>
                    <div style="display: none" class="mt-4 p-2 border" id="details">
                        <h3>@lang('homePage.configBoxTitle'):</h3>
                        <div class="form-group mt-3">
                            <label for="width">@lang('homePage.width')</label>
                            <input type="number" name="width" id="width" class="form-control" placeholder="@lang('homePage.widthPlaceholder')">
                        </div>
                        <div class="form-group mt-3">
                            <label for="height">@lang('homePage.height')</label>
                            <input type="number" name="height" placeholder="@lang('homePage.heightPlaceholder')" id="height" class="form-control">
                        </div>
                        <div class="form-group mt-3">
                            <label for="compress">@lang('homePage.compress') (<span id="compressPercent">20%</span>):</label>

                            <input oninput="changeRange()" type="range" name="compress" id="compress" class="form-control" min="0" max="100" value="20">
                        </div>
                        <div class="form-group mt-3">
                            <input type="submit" value="@lang('homePage.startButton')" class="form-control btn btn-success">
                        </div>
                    </div>
                </form>
                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>

        @endif

    </div>

{{--    Scripts --}}
<script src="{{ asset('js/app.js') }}"></script>
    <script>
        function showDetails() {
            let details = document.querySelector('#details');
            details.style.display = 'block';
            console.log(details.style.display);
        }

        function changeRange() {
            let rangeInput = document.querySelector("input[type='range']").value;
            document.querySelector("span#compressPercent").innerHTML = rangeInput+"%";
        }
    </script>
</body>
</html>
