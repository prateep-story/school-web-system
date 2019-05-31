<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  @include('cdn-library/bootstrap/style')
  @include('cdn-library/animate/style')
  @include('cdn-library/fontawesome/style')
  @include('cdn-library/iCheck/style')
  <link rel="stylesheet" href="{{ asset('css/authentication/style.min.css')}}">
  <title>@yield('title','ระบบจัดการเว็บไซต์')</title>
</head>

<body>

  <!-- Content -->
  @yield('content')

  @include('cdn-library/jquery/script')
  @include('cdn-library/bootstrap/script')
  @include('cdn-library/animate/script')
  @include('cdn-library/iCheck/script')
  @include('cdn-library/particlesjs/script')
  <script src="{{ asset('js/authentication/script.min.js')}}"></script>
</body>

</html>