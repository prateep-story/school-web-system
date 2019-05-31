@extends('layouts.back-end.master')

@push('style')
@include('cdn-library.select2.style')
@endpush

@section('content')
<main class="app-content">
  <div class="app-title">
    <div>
      <h1>แก้ไข<span class="small"> บทบาท</span></h1>
    </div>
    <ul class="app-breadcrumb breadcrumb">
      <li class="breadcrumb-item"><a href="{{ url('dashboard')}}"><i class="fas fa-home fa-lg"></i></a></li>
      <li class="breadcrumb-item"><a href="{{ url('dashboard/role')}}">บทบาท</a></li>
      <li class="breadcrumb-item"><a href="{{ url('dashboard/role/create')}}">แก้ไข</a></li>
    </ul>
  </div>
  @if (session('alert'))
  <div class="alert {{session('alert')}}" role="alert"><i class="far fa-bell"></i> {{ session('message') }}</div>
  @endif
  <div class="row">
    <div class="col-md-12">
      <div class="box">
        <div class="box-body">
          <form action="{{ url('dashboard/role/'.$role->id)}}" method="post">
            {{ csrf_field() }} {{ method_field('put') }}
            <div class="form-group">
              <label for="role">บทบาท</label>
              <input type="text" class="form-control {{ $errors->has('role') ? 'is-invalid' : '' }}" id="role"
                placeholder="role" name="role" value="{{ $role->name }}" disabled>
              @if ($errors->has('role'))
              <div class="invalid-feedback">{{ $errors->first('role') }}</div>
              @endif
            </div>
            <div class="form-group">
              <label for="permissions">การอนุญาต</label>
              <select class="form-control permissions" name="permissions[]" data-placeholder="Select a permissions" multiple="multiple">
                @foreach ($permissions as $permission)
                <option value="{{ $permission->id }}">{{ $permission->name }}</option>
                @endforeach
              </select>
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
  var permissions = [];
  $.each(@json($permission_array), function (i, item) {
    permissions[i] = i;
  });

  $(document).ready(function () {
    $(".permissions").select2().val(permissions).trigger('change');
  });
  $(".alert").delay(1500).slideUp(300, function () {
    $(this).alert('close');
  });
</script>
@endpush