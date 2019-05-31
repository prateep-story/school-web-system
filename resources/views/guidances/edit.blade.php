@extends('layouts.back-end.master')

@push('style')
@include('cdn-library.fileinput.style')
@include('cdn-library.icheck.style')
@endpush

@section('content')
<main class="app-content">
  <div class="app-title">
    <div>
      <h1>แก้ไข<span class="small"> โปสเตอร์แนะแนวการศึกษา</span></h1>
    </div>
    <ul class="app-breadcrumb breadcrumb">
      <li class="breadcrumb-item"><a href="{{ url('dashboard')}}"><i class="fas fa-home fa-lg"></i></a></li>
      <li class="breadcrumb-item"><a href="{{ url('dashboard/guidance')}}">โปสเตอร์แนะแนวการศึกษา</a></li>
      <li class="breadcrumb-item"><a href="{{ url('dashboard/guidance/edit')}}">แก้ไขข้อมูล</a></li>
    </ul>
  </div>
  @if (session('alert'))
  <div class="alert {{session('alert')}}" role="alert"><i class="far fa-bell"></i> {{ session('message') }}</div>
  @endif
  <div class="row">
    <div class="col-md-12">
      <div class="box">
        <div class="box-body">
          <form action="{{ url('dashboard/guidance/'.$guidance->id)}}" method="post" enctype="multipart/form-data">
            {{ method_field('PUT') }} {{ csrf_field() }}
            <div class="form-group">
              <label for="guidance">ชื่อโปสเตอร์แนะแนวการศึกษา</label>
              <input type="text" class="form-control {{ $errors->has('guidance') ? 'is-invalid' : '' }}" id="guidance"
                placeholder="guidance" name="guidance" value="{{ $guidance->guidance }}">
              @if ($errors->has('guidance'))
              <div class="invalid-feedback">{{ $errors->first('guidance') }}</div>
              @endif
            </div>
            <div class="form-group">
              <label class="image">เลือกรูปภาพ <small class="text-danger">(800 x 600 pixel)</small></label>
              <input id="image" type="file" class="form-control" name="image">
            </div>
            <div class="form-group">
              <label for="link">URL <small class="text-danger">(ระบุ http://)</small></label>
              <input type="text" class="form-control {{ $errors->has('url') ? 'is-invalid' : '' }}" id="url"
                placeholder="URL" name="url" value="{{ $guidance->url }}">
              @if ($errors->has('url'))
              <div class="invalid-feedback">{{ $errors->first('url') }}</div>
              @endif
            </div>
            <div class="form-group">
              <label for="status">สถานะ</label>
              <div class="checkbox icheck">
                <input type="radio" name="status" value="1" @if ($guidance->status ==1) checked
                @endif> แสดงผล
                <input type="radio" name="status" value="0" @if ($guidance->status ==0) checked
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
@include('cdn-library.icheck.script')
<script type="text/javascript">
  $("#image").fileinput({
    language: "th",
    theme: "fas",
    showCancel: false,
    showUpload: false,
    maxImageWidth: 800,
    maxImageHeight: 600,
    maxFileSize: 2000,
    allowedFileExtensions: ["jpg", "png", "gif"],
    initialPreviewAsData: true,
    initialPreviewFileType: 'image',
    initialPreview: @json(asset('images/guidances/'.$guidance->image)),
    initialPreviewConfig: [{
      caption: @json($guidance->image),
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

  $(".alert").delay(1500).slideUp(300, function () {
    $(this).alert('close');
  });
</script>
@endpush