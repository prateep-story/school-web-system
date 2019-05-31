@extends('layouts.back-end.master')

@push('style')
@include('cdn-library.icheck.style')
@include('cdn-library.fileinput.style')
<style media="screen">
  .kv-avatar .krajee-default.file-preview-frame,.kv-avatar .krajee-default.file-preview-frame:hover {
      margin: 0;
      padding: 0;
      border: none;
      box-shadow: none;
      text-align: center;
    }

    .krajee-default.file-preview-frame .kv-file-content {
      height: 100%;
      width: 100%;
    }


    .kv-avatar {
      display: inline-block;
    }

    .kv-avatar .file-input {
      display: table-cell;
      width: 100%;
    }

    .kv-reqd {
      color: red;
      font-family: monospace;
      font-weight: normal;
    }

    .file-drop-zone{
      border-radius: 0;
      padding: 5px;
    }
  </style>
@endpush

@section('content')
<main class="app-content">
  <div class="app-title">
    <div>
      <h1>แก้ไข<span class="small"> สมาชิก</span></h1>
    </div>
    <ul class="app-breadcrumb breadcrumb">
      <li class="breadcrumb-item"><a href="{{ url('dashboard')}}"><i class="fas fa-home fa-lg"></i></a></li>
      <li class="breadcrumb-item"><a href="{{ url('dashboard/user')}}">สมาชิก</a></li>
      <li class="breadcrumb-item"><a href="{{ url('dashboard/user/create')}}">แก้ไข</a></li>
    </ul>
  </div>
  @if (session('alert'))
  <div class="alert {{session('alert')}}" role="alert"><i class="far fa-bell"></i> {{ session('message') }}</div>
  @endif
  <div class="row">
    <div class="col-md-12">
      <div class="box">
        <div class="box-body">

          <form action="{{ url('dashboard/user/'.$user->id)}}" method="post">
            {{ csrf_field() }} {{ method_field('put') }}
            <div class="form-row">
              <div class="col-md-2">
                <div class="form-group">
                  <label class="image">เลือกรูปภาพ <small class="text-danger">(200 x 250 pixel)</small></label>
                  <div class="kv-avatar">
                    <div class="file-loading">
                      <input id="image" name="image" class="form-control" type="file">
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-10">
                <div class="form-group col-md-12">
                  <label for="name">ชื่อ-นามสกุล</label>
                  <input type="text" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" id="name" name="name"
                    value="{{ $user->name }}" disabled>
                  @if ($errors->has('name'))
                  <div class="invalid-feedback">{{ $errors->first('name') }}</div>
                  @endif
                </div>
                <div class="form-group col-md-12">
                  <label for="email">อีเมล์</label>
                  <input type="text" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" id="email"
                    name="email" value="{{ $user->email }}" disabled>
                  @if ($errors->has('email'))
                  <div class="invalid-feedback">{{ $errors->first('email') }}</div>
                  @endif
                </div>

                <div class="form-group col-md-12">
                  <label for="roles">บทบาท</label>
                  <div class="checkbox icheck">
                    @foreach ($roles as $role)
                    <input type="radio" name="roles[]" value="{{$role->id}}"  @if ($role->name == str_replace(array('[',']','"'),'', $user->getRoleNames())) checked @endif> {{$role->name}}</br>
                    @endforeach
                    @if ($errors->has('roles'))
                    <div class="invalid-feedback">{{ $errors->first('roles') }}</div>
                    @endif
                  </div>
                </div>
                <div class="form-group col-md-12">
                    <button class="btn btn-primary" type="submit" name="submit"> <i class="far fa-edit"></i> อัพเดทข้อมูลข้อมูล</button>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</main>
@endsection

@push('script')
@include('cdn-library.fileinput.script')
@include('cdn-library.icheck.script')
<script type="text/javascript">
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%'
    });
  });

  $("#image").fileinput({
    language: "th",
    theme: "fas",
    overwriteInitial: true,
    maxImageWidth: 200,
    maxImageHeight: 250,
    maxFileSize: 2000,
    showClose: false,
    showCaption: false,
    defaultPreviewContent: '<img src="/images/avatars/avatar.jpg" class="img-fluid" alt="Your Avatar"><h6 class="text-muted">Click to select</h6>',
    layoutTemplates: {
      main2: '{preview}'
    },
    allowedFileExtensions: ["jpg", "png", "gif"],
    initialPreviewAsData: true,
    initialPreviewFileType: 'image',
    initialPreview: @json(asset('images/avatars/'.$user->avatar)),
    initialPreviewConfig: [{
      caption: @json($user->avatar),
      size: @json($size),
      key: 1
    }, ],
  });

  $(".alert").delay(1500).slideUp(300, function () {
    $(this).alert('close');
  });
</script>
@endpush