@extends('layouts.back-end.master')

@push('style')
@include('cdn-library.fileinput.style')
@include('cdn-library.select2.style')
@endpush

@section('content')
<main class="app-content">
  <div class="app-title">
    <div>
      <h1>เพิ่ม<span class="small"> รูปภาพ</span></h1>
    </div>
    <ul class="app-breadcrumb breadcrumb">
      <li class="breadcrumb-item"><a href="{{ url('dashboard')}}"><i class="fas fa-home fa-lg"></i></a></li>
      <li class="breadcrumb-item"><a href="{{ url('dashboard/picture')}}">รูปภาพ</a></li>
      <li class="breadcrumb-item"><a href="{{ url('dashboard/picture/create')}}">เพิ่มข้อมูล</a></li>
    </ul>
  </div>
  @if (session('alert'))
  <div class="alert {{session('alert')}}" role="alert"><i class="far fa-bell"></i> {{ session('message') }}</div>
  @endif
  <div class="row">
    <div class="col-md-12">
      <div class="box">
        <div class="box-body">
          <form action="{{ url('dashboard/picture')}}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="form-group">
              <label for="gallery">อัลบั้มภาพ</label>
              <select class="form-control gallery {{ $errors->has('gallery') ? 'is-invalid' : '' }}" name="gallery" id="gallery">
                @foreach($galleries->sortByDesc('id') as $gallery)
                <option value="{{ $gallery->id }}">{{ $gallery->gallery}}</option>
                @endforeach
              </select>
              @if ($errors->has('gallery'))
              <div class="invalid-feedback">{{ $errors->first('gallery') }}</div>
              @endif
            </div>
            <div class="form-group">
              <label for="pictures">รูปภาพ <small class="text-danger">(720 x 480 pixel เพิ่มรูปได้ 20 รูป/ครั้ง)</small></label>
              <input id="pictures" type="file" class="form-control" name="pictures[]" multiple>
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
@include('cdn-library.select2.script')
<script type="text/javascript">
  $(document).ready(function () {
    $(".gallery").select2();
  });

  $("#pictures").fileinput({
    language: "th",
    theme: "fas",
    showCancel: false,
    showUpload: false,
    maxFileSize: 2000,
    maxFileCount: 20,
    allowedFileExtensions: ["jpg", "png", "gif"]
  });

  $(".alert").delay(1500).slideUp(300, function () {
    $(this).alert('close');
  });
</script>
@endpush