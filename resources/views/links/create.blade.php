@extends('layouts.back-end.master')

@push('style')
@include('cdn-library.fileinput.style')
@endpush

@section('content')
<main class="app-content">
  <div class="app-title">
    <div>
      <h1>เพิ่ม<span class="small"> ลิงค์ภายนอก</span></h1>
    </div>
    <ul class="app-breadcrumb breadcrumb">
      <li class="breadcrumb-item"><a href="{{ url('dashboard')}}"><i class="fas fa-home fa-lg"></i></a></li>
      <li class="breadcrumb-item"><a href="{{ url('dashboard/link')}}">ลิงค์ภายนอก</a></li>
      <li class="breadcrumb-item"><a href="{{ url('dashboard/link/create')}}">เพิ่มข้อมูล</a></li>
    </ul>
  </div>
  @if (session('alert'))
  <div class="alert {{session('alert')}}" role="alert"><i class="far fa-bell"></i> {{ session('message') }}</div>
  @endif
  <div class="row">
    <div class="col-md-12">
      <div class="box">
        <div class="box-body">
          <form action="{{ url('dashboard/link')}}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="form-group">
              <label for="link">ชื่อลิงค์ภายนอก</label>
              <input type="text" class="form-control {{ $errors->has('link') ? 'is-invalid' : '' }}" id="link"
                placeholder="title" name="link" value="{{ old('link') }}">
              @if ($errors->has('link'))
              <div class="invalid-feedback">{{ $errors->first('link') }}</div>
              @endif
            </div>
            <div class="form-group">
              <label class="image">แบนเนอร์ <small class="text-danger">(404 x 202 pixel)</small></label>
              <input id="image" type="file" class="form-control" name="image">
            </div>
            <div class="form-group">
              <label for="link">URL</label>
              <input type="text" class="form-control {{ $errors->has('url') ? 'is-invalid' : '' }}" id="url"
                placeholder="URL" name="url" value="{{ old('url') }}">
              @if ($errors->has('url'))
              <div class="invalid-feedback">{{ $errors->first('url') }}</div>
              @endif
            </div>
            <input type="hidden" name="author" value="{{ Auth::user()->id }}">
            <button class="btn btn-primary" type="submit" name="submit"><i class="far fa-save"></i> บันทึกข้อมูล</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</main>
@endsection

@push('script')
@include('cdn-library.fileinput.script')
<script type="text/javascript">
  $("#image").fileinput({
    language: "th",
    theme: "fas",
    showCancel: false,
    showUpload: false,
    maxFileSize: 2000,
    allowedFileExtensions: ["jpg", "png", "gif"]
  });
</script>
@endpush