@extends('layouts.back-end.master')

@push('style')
@include('cdn-library.select2.style')
@include('cdn-library.icheck.style')
@include('cdn-library.datepicker.style')
@endpush

@section('content')
<main class="app-content">
  <div class="app-title">
    <div>
      <h1>เพิ่ม<span class="small"> ผลงานวิชาการ</span></h1>
    </div>
    <ul class="app-breadcrumb breadcrumb">
      <li class="breadcrumb-item"><a href="{{ url('dashboard')}}"><i class="fas fa-home fa-lg"></i></a></li>
      <li class="breadcrumb-item"><a href="{{ url('dashboard/research')}}">ผลงานวิชาการ</a></li>
      <li class="breadcrumb-item"><a href="{{ url('dashboard/research/create')}}">เพิ่มข้อมูล</a></li>
    </ul>
  </div>
  @if (session('alert'))
  <div class="alert {{session('alert')}}" role="alert"><i class="far fa-bell"></i> {{ session('message') }}</div>
  @endif
  <div class="row">
    <div class="col-md-12">
      <div class="box">
        <div class="box-body">
          <form action="{{ url('dashboard/research')}}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="form-group">
              <label for="personnel">ผู้วิจัย</label>
              <select class="form-control {{ $errors->has('personnel') ? 'is-invalid' : '' }}" name="personnel" id="personnel">
                @foreach($personnels as $personnel)
                <option value="{{ $personnel->id }}">{{ $personnel->name}}</option>
                @endforeach
              </select>
              @if ($errors->has('personnel'))
              <div class="invalid-feedback">{{ $errors->first('personnel') }}</div>
              @endif
            </div>
            <div class="form-row">
              <div class="form-group col-md-8">
                <label for="research">ชื่องานวิจัย</label>
                <input type="text" class="form-control {{ $errors->has('research') ? 'is-invalid' : '' }}" id="research"
                  placeholder="Research" name="research" value="{{ old('research')}}">
                @if ($errors->has('research'))
                <div class="invalid-feedback">{{ $errors->first('research') }}</div>
                @endif
              </div>
              <div class="form-group col-md-4">
                <label for="year">ปีการศึกษา</label>
                <input type="text" class="form-control datetimepicker-input {{ $errors->has('year') ? 'is-invalid' : '' }}"
                  name="year" id="year" data-toggle="datetimepicker" data-target="#year" value="{{old('year')}}"
                  placeholder="Year">
                @if ($errors->has('year'))
                <div class="invalid-feedback">{{ $errors->first('year') }}</div>
                @endif
              </div>
            </div>
            <div class="form-group">
              <label for="abstract">บทคัดย่อ</label>
              <textarea class="form-control {{ $errors->has('abstract') ? 'is-invalid' : '' }}" name="abstract" rows="5"
                id="abstract">{!! old('abstract') !!}</textarea>
              @if ($errors->has('abstract'))
              <div class="invalid-feedback">{{ $errors->first('abstract') }}</div>
              @endif
            </div>
            <div class="form-group">
              <label for="result">ผลการวิจัย</label>
              <textarea class="form-control {{ $errors->has('result') ? 'is-invalid' : '' }}" name="result" rows="3" id="result">{!! old('result') !!}</textarea>
              @if ($errors->has('result'))
              <div class="invalid-feedback">{{ $errors->first('result') }}</div>
              @endif
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
@include('cdn-library.select2.script')
@include('cdn-library.icheck.script')
@include('cdn-library.moment.script')
@include('cdn-library.datepicker.script')
@include('cdn-library.tinymce.script')
<script type="text/javascript">
  $(document).ready(function () {
    $("#personnel").select2({
      placeholder: 'Personnel',
    }).val(null).trigger('change');
  });

  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' // optional
    });
  });

  $(function () {
    $('#year').datetimepicker({
      format: 'YYYY'
    });
  });

  $(".alert").delay(1500).slideUp(300, function () {
    $(this).alert('close');
  });
</script>
@endpush