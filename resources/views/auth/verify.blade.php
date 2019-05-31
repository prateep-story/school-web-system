@extends('layouts.authentication.master')

@section('content')
<section id="particles-js"></section>
<section class="login-content wow bounceIn">
  @if (session('resent'))
  <div class="login-alert">
    <div class="alert alert-success" role="alert"><i class="far fa-bell"></i>
      ลิงก์ยืนยันใหม่ถูกส่งไปยังที่อยู่อีเมลของคุณแล้ว</div>
  </div>
  @endif
  <div class="login-box" style="min-height: 250px;">
    <div class="login-form">
      <h3 class="login-head">ยืนยันที่อยู่อีเมลของคุณ</h3>
      ก่อนจะดำเนินการต่อ, โปรดตรวจสอบอีเมลของคุณสำหรับลิงก์ยืนยัน
      หากคุณไม่ได้รับอีเมล, <a href="{{ route('verification.resend') }}">คลิกที่นี่เพื่อขอลิงค์ยืนยันอีเมล์อีกครั้ง</a>.
    </div>
  </div>
</section>
@endsection