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
      <h1>เพิ่ม<span class="small"> บทความ</span></h1>
    </div>
    <ul class="app-breadcrumb breadcrumb">
      <li class="breadcrumb-item"><a href="{{ url('dashboard')}}"><i class="fas fa-home fa-lg"></i></a></li>
      <li class="breadcrumb-item"><a href="{{ url('dashboard/article')}}">บทความ</a></li>
      <li class="breadcrumb-item"><a href="{{ url('dashboard/article/create')}}">เพิ่มข้อมูล</a></li>
    </ul>
  </div>
  @if (session('alert'))
  <div class="alert {{session('alert')}}" role="alert"><i class="far fa-bell"></i> {{ session('message') }}</div>
  @endif
  <div class="row">
    <div class="col-md-12">
      <div class="box">
        <div class="box-body">
          <form action="{{ url('dashboard/article')}}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="form-group">
              <label for="article">ชื่อบทความ</label>
              <input type="text" class="form-control {{ $errors->has('article') ? 'is-invalid' : '' }}" id="article"
                placeholder="Article" name="article" value="{{ old('article') }}">
              @if ($errors->has('article'))
              <div class="invalid-feedback">{{ $errors->first('article') }}</div>
              @endif
            </div>
            <div class="form-group">
              <label for="category">หมวดหมู่</label>
              <select class="form-control {{ $errors->has('category') ? 'is-invalid' : '' }}" name="category" id="category">
                @foreach($categories as $category)
                <option value="{{ $category->id }}">{{ $category->category}} - {{ $category->type}}</option>
                @endforeach
              </select>
              @if ($errors->has('category'))
              <div class="invalid-feedback">{{ $errors->first('category') }}</div>
              @endif
            </div>
            <div class="form-group">
              <label for="content">เนื้อหาบทความ</label>
              <textarea class="form-control {{ $errors->has('content') ? 'is-invalid' : '' }}" name="content" rows="5"
                id="content"> {!! old('content') !!} </textarea>
              @if ($errors->has('content'))
              <div class="invalid-feedback">{{ $errors->first('content') }}</div>
              @endif
            </div>
            <div class="form-group">
              <label class="image">เลือกรูปภาพ <small class="text-danger">(1200 x 628 pixel)</small></label>
              <input id="image" type="file" class="form-control" name="image">
            </div>
            <div class="form-group">
              <label for="tags">ป้ายข้อความ</label>
              <select class="form-control tags" name="tags[]" id="tag" data-placeholder="Select a Tags" multiple="multiple">
                @foreach ($tags as $tag)
                <option value="{{ $tag->id }}">{{ $tag->tag }}</option>
                @endforeach
              </select>
            </div>
            <div class="form-group">
              <label for="status">สถานะ</label>
              <div class="checkbox icheck">
                <input type="radio" name="status" value="1" checked> แสดงผล
                <input type="radio" name="status" value="0"> แบบร่าง
              </div>
              @if ($errors->has('status'))
              <div class="invalid-feedback">{{ $errors->first('status') }}</div>
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
@include('cdn-library.select2.script')
@include('cdn-library.icheck.script')
@include('cdn-library.tinymce.script')
<script type="text/javascript">
  $("#image").fileinput({
    language: "th",
    theme: "fas",
    showCancel: false,
    showUpload: false,
    maxFileSize: 2000,
    allowedFileExtensions: ["jpg", "png", "gif"]
  });

  $(document).ready(function () {
    $("#category").select2({
      placeholder: 'Category',
    }).val(null).trigger('change');
    $("#tag").select2({
      placeholder: 'Tag',
    });
  });

  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' // optional
    });
  });

  $(".alert").delay(1500).slideUp(300, function () {
    $(this).alert('close');
  });
</script>
@endpush