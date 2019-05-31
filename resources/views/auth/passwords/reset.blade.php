@extends('layouts.authentication.master')

@section('content')
<section id="particles-js"></section>
<section class="login-content wow bounceIn">
  <div class="login-box" style="min-height: 450px;">
    <form class="login-form" action="{{ route('password.request') }}" method="post">
      {{ csrf_field() }}
      <input type="hidden" name="token" value="{{ $token }}">
      <h3 class="login-head">เปลี่ยนรหัสผ่าน ?</h3>
      <div class="form-group">
        <label class="control-label">อีเมล์</label>
        <input class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" type="text" placeholder="Email"
          value="{{ $email ?? old('email') }}" name="email" required>
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
        <label class="control-label">ยืนยัน รหัสผ่าน</label>
        <input class="form-control" type="password" placeholder="Password" name="password_confirmation" required>
      </div>
      <div class="form-group btn-container">
        <button class="btn btn-primary btn-block" type="submit">เปลี่ยนรหัสผ่าน</button>
      </div>
    </form>
  </div>
</section>
@endsection