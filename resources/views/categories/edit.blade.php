@extends('layouts.back-end.master')

@push('style')
@include('cdn-library.select2.style')
@endpush

@section('content')
<main class="app-content">
  <div class="app-title">
    <div>
      <h1>แก้ไข<span class="small"> หมวดหมู่</span></h1>
    </div>
    <ul class="app-breadcrumb breadcrumb">
      <li class="breadcrumb-item"><a href="{{ url('dashboard')}}"><i class="fas fa-home fa-lg"></i></a></li>
      <li class="breadcrumb-item"><a href="{{ url('dashboard/category')}}">หมวดหมู่</a></li>
      <li class="breadcrumb-item"><a href="{{ url('dashboard/category/create')}}">แก้ไข</a></li>
    </ul>
  </div>
  @if (session('alert'))
  <div class="alert {{session('alert')}}" role="alert"><i class="far fa-bell"></i> {{ session('message') }}</div>
  @endif
  <div class="row">
    <div class="col-md-12">
      <div class="box">
        <div class="box-body">
          <form action="{{ url('dashboard/category/'.$category->id)}}" method="post">
            {{ csrf_field() }} {{ method_field('put') }}
            <div class="form-group">
              <label for="type">ประเภท</label>
              <select class="form-control type {{ $errors->has('type') ? 'is-invalid' : '' }}" id="type" name="type">
              </select>
              @if ($errors->has('type'))
              <div class="invalid-feedback">{{ $errors->first('type') }}</div>
              @endif
            </div>
            <div class="form-group">
              <label for="category">หมวดหมู่</label>
              <input type="text" class="form-control {{ $errors->has('category') ? 'is-invalid' : '' }}" id="category"
                placeholder="Category" name="category" value="{{ $category->category }}">
              @if ($errors->has('category'))
              <div class="invalid-feedback">{{ $errors->first('category') }}</div>
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
@include('cdn-library.select2.script')
<script type="text/javascript">
  $(document).ready(function () {
    var data = [{
        id: 'บทความ',
        text: 'บทความ'
      },
      {
        id: 'ข่าว',
        text: 'ข่าว'
      },      
      {
        id: 'คำสั่ง',
        text: 'คำสั่ง'
      }
    ];
    $('.type').select2({
      data: data
    }).val(@json($category->type)).trigger('change');
  });

  $(".alert").delay(1500).slideUp(300, function () {
    $(this).alert('close');
  });
</script>
@endpush