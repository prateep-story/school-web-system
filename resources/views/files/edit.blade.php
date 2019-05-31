@extends('layouts.back-end.master')

@push('style')
@include('cdn-library.fileinput.style')
@include('cdn-library.icheck.style')
@include('cdn-library.select2.style')
@endpush

@section('content')
<main class="app-content">
  <div class="app-title">
    <div>
      <h1>แก้ไข<span class="small"> ไฟล์อัพโหลด</span></h1>
    </div>
    <ul class="app-breadcrumb breadcrumb">
      <li class="breadcrumb-item"><a href="{{ url('dashboard')}}"><i class="fas fa-home fa-lg"></i></a></li>
      <li class="breadcrumb-item"><a href="{{ url('dashboard/file')}}">ไฟล์อัพโหลด</a></li>
      <li class="breadcrumb-item"><a href="{{ url('dashboard/file/create')}}">แก้ไขข้อมูล</a></li>
    </ul>
  </div>
  @if (session('alert'))
  <div class="alert {{session('alert')}}" role="alert"><i class="far fa-bell"></i> {{ session('message') }}</div>
  @endif
  <div class="row">
    <div class="col-md-12">
      <div class="box">
        <div class="box-body">
          <form action="{{ url('dashboard/file/'.$file->id)}}" method="post" enctype="multipart/form-data">
            {{ method_field('PUT') }} {{ csrf_field() }}
            <div class="form-group">
              <label for="document">แฟ้มเอกสาร</label>
              <select class="form-control documents {{ $errors->has('document') ? 'is-invalid' : '' }}" name="document"
                id="document">
                @foreach($documents as $document)
                <option value="{{ $document->id }}">{{$document->document}}</option>
                @endforeach
              </select>
              @if ($errors->has('document'))
              <div class="invalid-feedback">{{ $errors->first('document') }}</div>
              @endif
            </div>
            <div class="form-group">
              <label for="title">ชื่อไฟล์</label>
              <input type="text" class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" id="title"
                placeholder="title" name="title" value="{{ $file->title }}">
              @if ($errors->has('title'))
              <div class="invalid-feedback">{{ $errors->first('title') }}</div>
              @endif
            </div>
            <div class="form-group">
              <label class="file">เลือกไฟล์ <small class="text-danger">(ไฟล์เอกสาร, ไฟล์รูปภาพ, ไฟล์บีบอัด)</small></label>
              <input id="file" type="file" class="form-control" name="file">
            </div>
            <div class="form-group">
              <label for="status">สถานะ</label>
              <div class="checkbox icheck">
                <input type="radio" name="status" value="1" @if ($file->status ==1) checked
                @endif> แสดงผล
                <input type="radio" name="status" value="0" @if ($file->status ==0) checked
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
  $(document).ready(function () {
    $(".documents").select2().val(@json($file->document->id)).trigger('change');
  });

  $("#file").fileinput({
    theme: 'fas',
    showCancel: false,
    showUpload: false,
    showPreview: false,
    allowedFileExtensions: ["doc", "docx", "xls", "xlsx", "ppt", "pptx", "pdf", "zip", "rar", "jpg", "png", "gif"],
    initialPreview: @json(asset('files/'.$file->file)),
    initialCaption: @json($file->file),
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