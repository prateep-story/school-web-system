@extends('layouts.back-end.master')

@section('content')
<main class="app-content">
  <div class="app-title">
    <div>
      <h1>เพิ่ม<span class="small"> ประเภทผลงาน</span></h1>
    </div>
    <ul class="app-breadcrumb breadcrumb">
      <li class="breadcrumb-item"><a href="{{ url('dashboard')}}"><i class="fas fa-home fa-lg"></i></a></li>
      <li class="breadcrumb-item"><a href="{{ url('dashboard/portfolio')}}">ประเภทผลงาน</a></li>
      <li class="breadcrumb-item"><a href="{{ url('dashboard/portfolio/create')}}">เพิ่มข้อมูล</a></li>
    </ul>
  </div>
  @if (session('alert'))
  <div class="alert {{session('alert')}}" role="alert"><i class="far fa-bell"></i> {{ session('message') }}</div>
  @endif
  <div class="row">
    <div class="col-md-12">
      <div class="box">
        <div class="box-body">
          <form action="{{ url('dashboard/portfolio')}}" method="post">
            {{ csrf_field() }}
            <div class="form-group">
              <label for="portfolio">ประเภทผลงาน</label>
              <input type="text" class="form-control {{ $errors->has('portfolio') ? 'is-invalid' : '' }}" id="portfolio"
                placeholder="Portfolio" name="portfolio" value="{{ old('portfolio')}}">
              @if ($errors->has('portfolio'))
              <div class="invalid-feedback">{{ $errors->first('portfolio') }}</div>
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
<script type="text/javascript">
  $(".alert").delay(1500).slideUp(300, function () {
    $(this).alert('close');
  });
</script>
@endpush