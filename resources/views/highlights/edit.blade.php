@extends('layouts.back-end.master')

@push('style')
@include('cdn-library.fileinput.style')
@include('cdn-library.select2.style')
@include('cdn-library.icheck.style')
@endpush

@section('content')
<main class="app-content">
  <div class="app-title">
    <div>
      <h1>แก้ไข<span class="small"> ไฮไลท์</span></h1>
    </div>
    <ul class="app-breadcrumb breadcrumb">
      <li class="breadcrumb-item"><a href="{{ url('dashboard')}}"><i class="fas fa-home fa-lg"></i></a></li>
      <li class="breadcrumb-item"><a href="{{ url('dashboard/highlight')}}">ไฮไลท์</a></li>
      <li class="breadcrumb-item"><a href="{{ url('dashboard/highlight/edit')}}">แก้ไขข้อมูล</a></li>
    </ul>
  </div>
  @if (session('alert'))
  <div class="alert {{session('alert')}}" role="alert"><i class="far fa-bell"></i> {{ session('message') }}</div>
  @endif
  <div class="row">
    <div class="col-md-12">
      <div class="box">
        <div class="box-body">
          <form action="{{ url('dashboard/highlight/'.$highlight->id)}}" method="post" enctype="multipart/form-data">
            {{ method_field('PUT') }} {{ csrf_field() }}
            <div class="form-group">
              <label for="highlight">ชื่อไฮไลท์</label>
              <input type="text" class="form-control {{ $errors->has('highlight') ? 'is-invalid' : '' }}" id="highlight"
                placeholder="Highlight" name="highlight" value="{{ $highlight->highlight }}">
              @if ($errors->has('highlight'))
              <div class="invalid-feedback">{{ $errors->first('highlight') }}</div>
              @endif
            </div>
            <div class="form-group">
              <label class="image">เลือกรูปภาพ <small class="text-danger">(1920 x 660 pixel)</small></label>
              <input id="image" type="file" class="form-control" name="image">
            </div>
            <div class="form-group">
              <label for="article">บทความ <small class="text-danger">(เลือกหรือไม่เลือกก็ได้)</small></label>
              <select class="form-control articles" name="article" id="article">
                @foreach($articles as $article)
                <option value="{{ $article->id }}">{{ $article->article}}</option>
                @endforeach
              </select>
            </div>
            <div class="form-group">
              <label for="link">URL <small class="text-danger">(ระบุ http://)</small></label>
              <input type="text" class="form-control {{ $errors->has('url') ? 'is-invalid' : '' }}" id="url"
                placeholder="URL" name="url" value="{{ $highlight->url }}">
              @if ($errors->has('url'))
              <div class="invalid-feedback">{{ $errors->first('url') }}</div>
              @endif
            </div>
            <div class="form-group">
              <label for="status">สถานะ</label>
              <div class="checkbox icheck">
                <input type="radio" name="status" value="1" @if ($highlight->status ==1) checked
                @endif> แสดงผล
                <input type="radio" name="status" value="0" @if ($highlight->status ==0) checked
                @endif> แบบร่าง
              </div>
              @if ($errors->has('status'))
              <div class="invalid-feedback">{{ $errors->first('status') }}</div>
              @endif
            </div>
            <input type="hidden" name="author" value="{{ Auth::user()->id }}">
            <button class="btn btn-primary" type="submit" name="submit"><i class="far fa-edit"></i> อัพเดทข้อมูล</button>
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
@include('cdn-library.icheck.script')
<script type="text/javascript">
  $("#image").fileinput({
    language: "th",
    theme: "fas",
    showCancel: false,
    showUpload: false,
    maxImageWidth: 1920,
    maxImageHeight: 660,
    maxFileSize: 2000,
    allowedFileExtensions: ["jpg", "png", "gif"],
    initialPreviewAsData: true,
    initialPreviewFileType: 'image',
    initialPreview: @json(asset('images/highlights/'.$highlight->image)),
    initialPreviewConfig: [{
      caption: @json($highlight->image),
      size: @json($size),
      key: 1
    }, ],
  });

  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' // optional
    });
  });

  var articles = [];
  $.each(@json($article_array), function (i, item) {
    articles[i] = i;
  });

  $(document).ready(function () {
    $(".articles").select2().val(articles).trigger('change');
  });

  $(".alert").delay(1500).slideUp(300, function () {
    $(this).alert('close');
  });
</script>
@endpush