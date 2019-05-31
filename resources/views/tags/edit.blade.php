@extends('layouts.back-end.master')

@section('content')
<main class="app-content">
  <div class="app-title">
    <div>
      <h1>แก้ไข<span class="small"> ป้ายข้อความ</span></h1>
    </div>
    <ul class="app-breadcrumb breadcrumb">
      <li class="breadcrumb-item"><a href="{{ url('dashboard')}}"><i class="fas fa-home fa-lg"></i></a></li>
      <li class="breadcrumb-item"><a href="{{ url('dashboard/tag')}}">ป้ายข้อความ</a></li>
      <li class="breadcrumb-item"><a href="{{ url('dashboard/tag/create')}}">แก้ไขข้อมูล</a></li>
    </ul>
  </div>
  @if (session('alert'))
  <div class="alert {{session('alert')}}" role="alert"><i class="far fa-bell"></i> {{ session('message') }}</div>
  @endif
  <div class="row">
    <div class="col-md-12">
      <div class="box">
        <div class="box-body">
          <form action="{{ url('dashboard/tag/'.$tag->id)}}" method="post">
            {{ method_field('PUT') }} {{ csrf_field() }}
            <div class="form-group">
              <label for="tag">ป้ายข้อความ</label>
              <input type="text" class="form-control {{ $errors->has('tag') ? 'is-invalid' : '' }}" id="tag"
                placeholder="Tag" name="tag" value="{{ $tag->tag }}">
              @if ($errors->has('tag'))
              <div class="invalid-feedback">{{ $errors->first('tag') }}</div>
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
<script type="text/javascript">
  $(".alert").delay(1500).slideUp(300, function () {
    $(this).alert('close');
  });
</script>
@endpush