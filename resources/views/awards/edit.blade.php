@extends('layouts.back-end.master')

@push('style')
@include('cdn-library.fileinput.style')
@include('cdn-library.select2.style')
@include('cdn-library.datepicker.style')
@endpush

@section('content')
<main class="app-content">
  <div class="app-title">
    <div>
      <h1>แก้ไข<span class="small"> บทความ</span></h1>
    </div>
    <ul class="app-breadcrumb breadcrumb">
      <li class="breadcrumb-item"><a href="{{ url('dashboard')}}"><i class="fas fa-home fa-lg"></i></a></li>
      <li class="breadcrumb-item"><a href="{{ url('dashboard/award')}}">บทความ</a></li>
      <li class="breadcrumb-item"><a href="{{ url('dashboard/award/create')}}">แก้ไขข้อมูล</a></li>
    </ul>
  </div>
  @if (session('alert'))
  <div class="alert {{session('alert')}}" role="alert"><i class="far fa-bell"></i> {{ session('message') }}</div>
  @endif
  <div class="row">
    <div class="col-md-12">
      <div class="box">
        <div class="box-body">
          <form action="{{ url('dashboard/award/'.$award->id)}}" method="post" enctype="multipart/form-data">
            {{ method_field('PUT') }} {{ csrf_field() }}
            <div class="form-group">
              <label for="portfolio">ประเภทผลงาน</label>
              <select class="form-control activities {{ $errors->has('portfolio') ? 'is-invalid' : '' }}" name="portfolio"
                id="portfolio">
                @foreach($portfolios as $portfolio)
                <option value="{{ $portfolio->id }}">{{ $portfolio->portfolio}}</option>
                @endforeach
              </select>
              @if ($errors->has('portfolio'))
              <div class="invalid-feedback">{{ $errors->first('portfolio') }}</div>
              @endif
            </div>
            <div class="form-group">
              <label for="title">หัวข้อ/ชื่อ</label>
              <input type="text" class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" id="title"
                placeholder="Title" name="title" value="{{ $award->title }}">
              @if ($errors->has('title'))
              <div class="invalid-feedback">{{ $errors->first('title') }}</div>
              @endif
            </div>
            <div class="form-group">
              <label for="subtitle">หัวข้อย่อย/ระดับชั้น/โรงเรียน</label>
              <input type="text" class="form-control {{ $errors->has('subtitle') ? 'is-invalid' : '' }}" id="subtitle"
                placeholder="Subtitle" name="subtitle" value="{{ $award->subtitle }}">
              @if ($errors->has('subtitle'))
              <div class="invalid-feedback">{{ $errors->first('subtitle') }}</div>
              @endif
            </div>
            <div class="form-group">
              <label for="award">ชื่อรางวัลที่ได้รับ</label>
              <input type="text" class="form-control {{ $errors->has('award') ? 'is-invalid' : '' }}" id="award"
                placeholder="Award" name="award" value="{{ $award->award }}">
              @if ($errors->has('award'))
              <div class="invalid-feedback">{{ $errors->first('award') }}</div>
              @endif
            </div>
            <div class="form-group">
              <label for="competition">กิจกรรม/การแข่งขัน</label>
              <input type="text" class="form-control {{ $errors->has('competition') ? 'is-invalid' : '' }}" id="competition"
                placeholder="Competition" name="competition" value="{{ $award->competition }}">
              @if ($errors->has('competition'))
              <div class="invalid-feedback">{{ $errors->first('competition') }}</div>
              @endif
            </div>
            <div class="form-row">
              <div class="form-group col-md-8">
                <label for="institution">ผู้จัดงาน/หน่วยงาน</label>
                <input type="text" class="form-control {{ $errors->has('institution') ? 'is-invalid' : '' }}" id="institution"
                  placeholder="Institution" name="institution" value="{{ $award->institution }}">
                @if ($errors->has('institution'))
                <div class="invalid-feedback">{{ $errors->first('institution') }}</div>
                @endif
              </div>
              <div class="form-group col-md-4">
                <label for="year">ปีที่ได้รับรางวัล</label>
                <div class="input-group date" id="year" data-target-input="nearest">
                  <input type="text" class="form-control datetimepicker-input {{ $errors->has('year') ? 'is-invalid' : '' }}"
                    name="year" id="year" value="{{ $award->year}}" data-toggle="datetimepicker" data-target="#year"
                    placeholder="Year">
                  @if ($errors->has('year'))
                  <div class="invalid-feedback">{{ $errors->first('year') }}</div>
                  @endif
                </div>
              </div>
            </div>
            <div class="form-group">
              <label for="content">รายละเอียด</label>
              <textarea class="form-control {{ $errors->has('content') ? 'is-invalid' : '' }}" name="content" rows="5"
                id="content">{!! $award->content !!}</textarea>
              @if ($errors->has('content'))
              <div class="invalid-feedback">{{ $errors->first('content') }}</div>
              @endif
            </div>
            <div class="form-group">
              <label class="image">เลือกรูปภาพ <small class="text-danger">(720 x 480 pixel)</small></label>
              <input id="image" type="file" class="form-control" name="image">
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
@include('cdn-library.moment.script')
@include('cdn-library.datepicker.script')
@include('cdn-library.tinymce.script')
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
    initialPreview: @json(asset('images/awards/'.$award->image)),
    initialPreviewConfig: [{
      caption: @json($award->image),
      size: @json($size),
      key: 1
    }, ],
  });

  $(document).ready(function () {
    $(".activities").select2().val(@json($award->portfolio->id)).trigger('change');
  });

  $(function () {
    $('#year').datetimepicker({
      format: 'YYYY',
      defaultDate: @json($award->year),
    });
  });

  $(".alert").delay(1500).slideUp(300, function () {
    $(this).alert('close');
  });
</script>
@endpush