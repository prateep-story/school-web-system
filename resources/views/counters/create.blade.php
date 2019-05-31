@extends('layouts.back-end.master')

@push('style')
@include('cdn-library.iconpicker.style')
@endpush

@section('content')
<main class="app-content">
  <div class="app-title">
    <div>
      <h1>เพิ่ม<span class="small"> ข้อมูลเชิงสถิติ</span></h1>
    </div>
    <ul class="app-breadcrumb breadcrumb">
      <li class="breadcrumb-item"><a href="{{ url('dashboard')}}"><i class="fas fa-home fa-lg"></i></a></li>
      <li class="breadcrumb-item"><a href="{{ url('dashboard/counter')}}">ข้อมูลเชิงสถิติ</a></li>
      <li class="breadcrumb-item"><a href="{{ url('dashboard/counter/create')}}">เพิ่มข้อมูล</a></li>
    </ul>
  </div>
  @if (session('alert'))
  <div class="alert {{session('alert')}}" role="alert"><i class="far fa-bell"></i> {{ session('message') }}</div>
  @endif
  <div class="row">
    <div class="col-md-12">
      <div class="box">
        <div class="box-body">
          <form action="{{ url('dashboard/counter')}}" method="post">
            {{ csrf_field() }}
            <div class="form-row">
              <div class="col-md-4">
                <div class="form-group">
                  <label for="icon">ไอคอน <small class="text-danger">(font awesome v5)</small></label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <button class="btn btn-outline-secondary" type="button" role="iconpicker" id="target"></button>
                    </div>
                    <input type="text" class="form-control" id="icon" placeholder="Icon" name="icon" aria-describedby="target"
                      value="{{ old('icon') }}">
                  </div>
                </div>
              </div>
              <div class="col-md-8">
                <div class="form-group">
                  <label for="title">หัวข้อ</label>
                  <input type="text" class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" id="title"
                    placeholder="Title" name="title" value="{{ old('title') }}">
                  @if ($errors->has('title'))
                  <div class="invalid-feedback">{{ $errors->first('title') }}</div>
                  @endif
                </div>
              </div>
            </div>
            <div class="form-group">
              <label for="quantity">จำนวน</label>
              <input type="text" class="form-control {{ $errors->has('quantity') ? 'is-invalid' : '' }}" id="quantity"
                placeholder="Quantity" name="quantity" value="{{ old('quantity') }}">
              @if ($errors->has('quantity'))
              <div class="invalid-feedback">{{ $errors->first('quantity') }}</div>
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
@include('cdn-library.iconpicker.script')
<script type="text/javascript">
  $(".alert").delay(1500).slideUp(300, function () {
    $(this).alert('close');
  });

  $('#target').on('change', function(e) {
    $("#icon").val(e.icon);
  });
</script>
@endpush