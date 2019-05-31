@extends('layouts.back-end.master')

@push('style')
@include('cdn-library.select2.style')
@endpush

@section('content')
<main class="app-content">
  <div class="app-title">
    <div>
      <h1>เพิ่ม<span class="small"> หมวดหมู่เอกสาร</span></h1>
    </div>
    <ul class="app-breadcrumb breadcrumb">
      <li class="breadcrumb-item"><a href="{{ url('dashboard')}}"><i class="fas fa-home fa-lg"></i></a></li>
      <li class="breadcrumb-item"><a href="{{ url('dashboard/document')}}">หมวดหมู่เอกสาร</a></li>
      <li class="breadcrumb-item"><a href="{{ url('dashboard/document/create')}}">เพิ่มข้อมูล</a></li>
    </ul>
  </div>
  @if (session('alert'))
  <div class="alert {{session('alert')}}" role="alert"><i class="far fa-bell"></i> {{ session('message') }}</div>
  @endif
  <div class="row">
    <div class="col-md-12">
      <div class="box">
        <div class="box-body">
          <form action="{{ url('dashboard/document')}}" method="post">
            {{ csrf_field() }}
            <div class="form-group">
              <label for="document">ชื่อหมวดหมู่</label>
              <input type="text" class="form-control {{ $errors->has('document') ? 'is-invalid' : '' }}" id="document"
                placeholder="Document" name="document" value="{{ old('document') }}">
              @if ($errors->has('document'))
              <div class="invalid-feedback">{{ $errors->first('document') }}</div>
              @endif
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
@include('cdn-library.select2.script')
<script type="text/javascript">
  $(".alert").delay(1500).slideUp(300, function () {
    $(this).alert('close');
  });
</script>
@endpush