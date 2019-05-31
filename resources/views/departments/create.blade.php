@extends('layouts.back-end.master')

@section('content')
<main class="app-content">
  <div class="app-title">
    <div>
      <h1>เพิ่ม<span class="small"> กลุ่มบริหารงานภายใน</span></h1>
    </div>
    <ul class="app-breadcrumb breadcrumb">
      <li class="breadcrumb-item"><a href="{{ url('dashboard')}}"><i class="fas fa-home fa-lg"></i></a></li>
      <li class="breadcrumb-item"><a href="{{ url('dashboard/department')}}">กลุ่มบริหารงานภายใน</a></li>
      <li class="breadcrumb-item"><a href="{{ url('dashboard/department/create')}}">เพิ่มข้อมูล</a></li>
    </ul>
  </div>
  @if (session('alert'))
  <div class="alert {{session('alert')}}" role="alert"><i class="far fa-bell"></i> {{ session('message') }}</div>
  @endif
  <div class="row">
    <div class="col-md-12">
      <div class="box">
        <div class="box-body">
          <form action="{{ url('dashboard/department')}}" method="post">
            {{ csrf_field() }}
            <div class="form-group">
              <label for="department">กลุ่มบริหารงานภายใน</label>
              <input type="text" class="form-control {{ $errors->has('department') ? 'is-invalid' : '' }}" id="department"
                placeholder="department" name="department" value="{{old('department')}}">
              @if ($errors->has('department'))
              <div class="invalid-feedback">{{ $errors->first('department') }}</div>
              @endif
            </div>
            <div class="form-group">
              <label for="description">รายละเอียด</label>
              <textarea class="form-control" name="description" rows="5">{!! old('description') !!}</textarea>
            </div>
            <input type="hidden" name="author" value="{{ Auth::user()->id }}">
            <button class="btn btn-primary" type="submit" name="submit"><i class="far fa-save"></i> บันทึก</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</main>
@endsection

@push('script')
@include('cdn-library.tinymce.script')
<script type="text/javascript">
  $(".alert").delay(1500).slideUp(300, function () {
    $(this).alert('close');
  });
</script>
@endpush