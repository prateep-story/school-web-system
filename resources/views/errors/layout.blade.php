<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    @include('cdn-library/bootstrap/style')
    <style>
        @font-face {
            font-family: 'csprajad';
            src: url('../../../fonts/csprajad-webfont.woff2') format('woff2');
        }

        html {
            font-size: 1.075rem!important
        }

        body {
            font-family: 'csprajad', sans-serif;
            line-height: 1.5;
        }

        .page-wrap {
            min-height: 100vh;
        }
    </style>
</head>

<body>
    <div class="page-wrap d-flex flex-row align-items-center">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12 text-center">
                    <span class="display-1 d-block">@yield('code')</span>
                    <div class="mb-4 lead">@yield('message')</div>
                    <a href="{{ url()->previous() }}" class="btn btn-link">กลับสู่หน้าหลัก</a>
                </div>
            </div>
        </div>
    </div>
    @include('cdn-library/jquery/script')
    @include('cdn-library/bootstrap/script')
</body>

</html>