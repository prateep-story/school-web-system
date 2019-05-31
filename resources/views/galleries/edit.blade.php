@extends('layouts.back-end.master')

@push('style')
@include('cdn-library.fileinput.style')
@include('cdn-library.select2.style')
@include('cdn-library.icheck.style')
@include('cdn-library.datepicker.style')
@endpush

@section('content')
<main class="app-content">
  <div class="app-title">
    <div>
      <h1>แก้ไข<span class="small"> อัลบั้มภาพ</span></h1>
    </div>
    <ul class="app-breadcrumb breadcrumb">
      <li class="breadcrumb-item"><a href="{{ url('dashboard')}}"><i class="fas fa-home fa-lg"></i></a></li>
      <li class="breadcrumb-item"><a href="{{ url('dashboard/gallery')}}">อัลบั้มภาพ</a></li>
      <li class="breadcrumb-item"><a href="{{ url('dashboard/gallery/edit')}}">แก้ไขข้อมูล</a></li>
    </ul>
  </div>
  @if (session('alert'))
  <div class="alert {{session('alert')}}" role="alert"><i class="far fa-bell"></i> {{ session('message') }}</div>
  @endif
  <div class="row">
    <div class="col-md-12">
      <div class="box">
        <div class="box-body">
          <form action="{{ url('dashboard/gallery/'.$gallery->id)}}" method="post" enctype="multipart/form-data">
            {{ method_field('PUT') }} {{ csrf_field() }}
            <div class="form-group">
              <label for="gallery">ชื่ออัลบั้มภาพ</label>
              <input type="text" class="form-control {{ $errors->has('gallery') ? 'is-invalid' : '' }}" id="gallery"
                placeholder="Gallery" name="gallery" value="{{ $gallery->gallery }}">
              @if ($errors->has('gallery'))
              <div class="invalid-feedback">{{ $errors->first('gallery') }}</div>
              @endif
            </div>
            <div class="form-group">
              <label for="content">เนื้อหาบทความ</label>
              <textarea class="form-control" name="content" rows="5" id="content">{!! $gallery->content !!}</textarea>
            </div>
            <div class="form-group">
              <label class="image">ภาพปก <small class="text-danger">(1200 x 628 pixel)</small></label>
              <input id="image" type="file" class="form-control" name="image">
            </div>
            <div class="form-group">
              <label class="event_date">วันที่จัดกิจกรรม</label>
              <input type="text" class="form-control datetimepicker-input {{ $errors->has('event_date') ? 'is-invalid' : '' }}"
                name="event_date" id="event_date" data-toggle="datetimepicker" data-target="#event_date" placeholder="Event Date">
              @if ($errors->has('event_date'))
              <div class="invalid-feedback">{{ $errors->first('event_date') }}</div>
              @endif
            </div>
            <div class="form-group">
              <label for="status">สถานะ</label>
              <div class="checkbox icheck">
                <input type="radio" name="status" value="1" @if ($gallery->status ==1) checked
                @endif> แสดงผล
                <input type="radio" name="status" value="0" @if ($gallery->status ==0) checked
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
@include('cdn-library.tinymce.script')
@include('cdn-library.moment.script')
@include('cdn-library.datepicker.script')
<script type="text/javascript">
  $("#image").fileinput({
    language: "th",
    theme: "fas",
    showCancel: false,
    showUpload: false,
    maxFileSize: 2000,
    allowedFileExtensions: ["jpg", "png", "gif"],
    initialPreviewAsData: true,
    initialPreviewFileType: 'image',
    initialPreview: @json(asset('images/galleries/'.$gallery->image)),
  });

  $(function () {
    $('#event_date').datetimepicker({
      defaultDate: @json($gallery->created_at->format('m/d/Y')),
      format: 'L',
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