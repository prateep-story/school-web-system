@extends('layouts.back-end.master')

@push('style')
@include('cdn-library.select2.style')
@include('cdn-library.icheck.style')
@endpush

@section('content')
<main class="app-content">
  <div class="app-title">
    <div>
      <h1>แก้ไข<span class="small"> สาส์นจากผู้บริหาร</span></h1>
    </div>
    <ul class="app-breadcrumb breadcrumb">
      <li class="breadcrumb-item"><a href="{{ url('dashboard')}}"><i class="fas fa-home fa-lg"></i></a></li>
      <li class="breadcrumb-item"><a href="{{ url('dashboard/message')}}">สาส์นจากผู้บริหาร</a></li>
      <li class="breadcrumb-item"><a href="{{ url('dashboard/message/create')}}">แก้ไขข้อมูล</a></li>
    </ul>
  </div>
  @if (session('alert'))
  <div class="alert {{session('alert')}}" role="alert"><i class="far fa-bell"></i> {{ session('message') }}</div>
  @endif
  <div class="row">
    <div class="col-md-12">
      <div class="box">
        <div class="box-body">
          <form action="{{ url('dashboard/message/'.$message->id)}}" method="post" enctype="multipart/form-data">
            {{ method_field('PUT') }} {{ csrf_field() }}
            <div class="form-group">
              <label for="personnel">บุคลากร</label>
              <select class="form-control {{ $errors->has('personnel') ? 'is-invalid' : '' }}" name="personnel" id="personnel"
                style="width:100%">
                @foreach($personnels as $personnel)
                <option value="{{ $personnel->id }}">{{ $personnel->name}}</option>
                @endforeach
              </select>
              @if ($errors->has('personnel'))
              <div class="invalid-feedback">{{ $errors->first('personnel') }}</div>
              @endif
            </div>
            <div class="form-group">
              <label for="message">สาส์น/ข่าว</label>
              <textarea class="form-control {{ $errors->has('message') ? 'is-invalid' : '' }}" name="message" rows="5"
                id="message">{{$message->message}}</textarea>
              @if ($errors->has('message'))
              <div class="invalid-feedback">{{ $errors->first('message') }}</div>
              @endif
            </div>
            <div class="form-group">
              <label for="status">สถานะ</label>
              <div class="checkbox icheck">
                <input type="radio" name="status" value="1" @if ($message->status ==1) checked @endif> แสดงผล
                <input type="radio" name="status" value="0" @if ($message->status ==0) checked @endif> แบบร่าง
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
@include('cdn-library.select2.script')
@include('cdn-library.icheck.script')
@include('cdn-library.tinymce.script')
<script type="text/javascript">
  $(document).ready(function () {
    $("#personnel").select2().val(@json($message->personnel->id)).trigger('change');
  });

  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%'
    });
  });

  $(".alert").delay(1500).slideUp(300, function () {
    $(this).alert('close');
  });
</script>
@endpush