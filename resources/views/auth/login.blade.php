@extends('layouts.authentication.master')

@section('content')
<section id="particles-js"></section>
<section class="login-content wow bounceIn">
  @if (session('status'))
  <div class="login-alert">
    <div class="alert alert-success" role="alert"><i class="far fa-bell"></i>
      ลิงก์ยืนยันถูกส่งไปยังที่อยู่อีเมลของคุณแล้ว</div>
  </div>
  @endif
  <div class="login-box">
    <form class="login-form" action="{{ route('login') }}" method="post">
      {{ csrf_field() }}
      <div class="login-head">
          <img src="{{ asset('images/preloader.gif')}}" class="img-fluid" alt="">
      </div>
    
      {{-- <h3 class="login-head">เข้าสู่ระบบ</h3> --}}
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
        <div class="utility">
          <div class="animated-checkbox">
            <input id="remember" type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
            <label class="control-label" for="remember">จดจำการเข้าสู่ระบบ</label>
          </div>
          <p class="semibold-text mb-2"><a href="#" data-toggle="flip">ลืมรหัสผ่าน ?</a></p>
        </div>
      </div>
      <div class="form-group btn-container">
        <button class="btn btn-primary btn-block" type="submit">เข้าสู่ระบบ</button>
      </div>
      <div class="form-group mt-1 text-center">
          <small class="text-primary text-center">หากพบปัญหาเข้าใช้งาน ติดต่อ 085-3469543 (นก)</small>
        </div>
    </form>

    <form class="forget-form" action="{{ route('password.email') }}" method="post">
      {{ csrf_field() }}
      <h3 class="login-head">ลืมรหัสผ่าน ?</h3>
      <div class="form-group">
        <label class="control-label">อีเมล์</label>
        <input class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" type="text" placeholder="Email"
          value="{{ old('email') }}" name="email" required>
        @if ($errors->has('email'))
        <span class="invalid-feedback">
          <strong>{{ $errors->first('email') }}</strong>
        </span>
        @endif
      </div>
      <div class="form-group btn-container">
        <button class="btn btn-primary btn-block" type="submit">ยกเลิกรหัสผ่าน</button>
      </div>
      <div class="form-group mt-3">
        <p class="semibold-text mb-0"><a href="#" data-toggle="flip">กลับไปหน้าเข้าสู่ระบบ</a></p>
      </div>
    </form>
  </div>
</section>
@endsection