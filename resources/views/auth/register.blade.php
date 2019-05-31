@extends('layouts.authentication.master')

@section('content')
<section id="particles-js"></section>
<section class="login-content wow bounceIn">
  <div class="login-box" style="min-height: 680px;">
    <form class="login-form" action="{{ route('register') }}" method="post">
      {{ csrf_field() }}
      <div class="login-head">
          <img src="{{ asset('images/preloader.gif')}}" class="img-fluid" alt="">
      </div>
      <div class="form-group">
        <label class="control-label">ชื่อ-สกุล</label>
        <input class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}" type="text" placeholder="Name"
          value="{{ old('name') }}" name="name" required autofocus>
        @if ($errors->has('name'))
        <span class="invalid-feedback">
          <strong>{{ $errors->first('name') }}</strong>
        </span>
        @endif
      </div>
      <div class="form-group">
        <label class="control-label">อีเมล์</label>
        <input class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" type="email" placeholder="Email"
          value="{{ old('email') }}" name="email" required autofocus>
        @if ($errors->has('email'))
        <span class="invalid-feedback">
          <strong>{{ $errors->first('email') }}</strong>
        </span>
        @endif
      </div>
      <div class="form-group">
        <label class="control-label">รหัสผ่าน</label>
        <input class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}" type="password" placeholder="Password"
          name="password" required>
        @if ($errors->has('password'))
        <span class="invalid-feedback">
          <strong>{{ $errors->first('password') }}</strong>
        </span>
        @endif
      </div>
      <div class="form-group">
        <label class="control-label">ยืนยันรหัสผ่าน</label>
        <input class="form-control" type="password" placeholder="Confirmation" name="password_confirmation" required>
      </div>
      <div class="form-group btn-container">
        <button class="btn btn-primary btn-block" type="submit">ลงทะเบียน</button>
      </div>
      <div class="form-group mt-1 text-center">
        <small class="text-primary text-center">กรุณาตรวจสอบอีเมล์เพื่อยืนยันอีเมล์ในการเข้าสู่ระบบ</small>
      </div>
    </form>
  </div>
</section>
@endsection