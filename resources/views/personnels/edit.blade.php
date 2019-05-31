@extends('layouts.back-end.master')

@push('style')
@include('cdn-library.fileinput.style')
@include('cdn-library.select2.style')
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
      <h1>แก้ไข<span class="small"> บุคลากร</span></h1>
    </div>
    <ul class="app-breadcrumb breadcrumb">
      <li class="breadcrumb-item"><a href="{{ url('dashboard')}}"><i class="fas fa-home fa-lg"></i></a></li>
      <li class="breadcrumb-item"><a href="{{ url('dashboard/personnel')}}">บุคลากร</a></li>
      <li class="breadcrumb-item"><a href="{{ url('dashboard/personnel/create')}}">แก้ไขข้อมูล</a></li>
    </ul>
  </div>
  @if (session('alert'))
  <div class="alert {{session('alert')}}" role="alert"><i class="far fa-bell"></i> {{ session('message') }}</div>
  @endif
  <div class="row">
    <div class="col-md-12">
      <div class="box">
        <div class="box-body">
          <form action="{{ url('dashboard/personnel/'.$personnel->id)}}" method="post" enctype="multipart/form-data">
            {{ method_field('PUT') }} {{ csrf_field() }}
            <div class="form-row">
              <div class="col-md-3">
                <div class="form-group">
                  <label class="image">เลือกรูปภาพ <small class="text-danger">(200 x 250 pixel)</small></label>
                  <div class="kv-avatar">
                    <div class="file-loading">
                      <input id="image" name="image" class="form-control" type="file">
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-9">
                <div class="form-row">
                  <div class="form-group col-md-8">
                    <label for="name">ชื่อ-นามสกุล</label>
                    <input type="text" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" id="name"
                      placeholder="Name" name="name" value="{{ $personnel->name }}">
                    @if ($errors->has('name'))
                    <div class="invalid-feedback">{{ $errors->first('name') }}</div>
                    @endif
                  </div>
                  <div class="form-group col-md-4">
                    <label for="gender">เพศ</label>
                    <select class="form-control {{ $errors->has('gender') ? 'is-invalid' : '' }}" name="gender" id="gender">
                      <option value="{{ $personnel->gender }}">{{ $personnel->gender }}</option>
                    </select>
                    @if ($errors->has('gender'))
                    <div class="invalid-feedback">{{ $errors->first('gender') }}</div>
                    @endif
                  </div>
                </div>
                <div class="form-row">
                  <div class="form-group col-md-4">
                    <label for="category">ประเภท</label>
                    <select class="form-control {{ $errors->has('category') ? 'is-invalid' : '' }}" name="category" id="category">
                      <option value="{{ $personnel->category }}">{{ $personnel->category }}</option>
                    </select>
                    @if ($errors->has('category'))
                    <div class="invalid-feedback">{{ $errors->first('category') }}</div>
                    @endif
                  </div>
                  <div class="form-group col-md-4">
                    <label for="position">เลือกตำแหน่ง</label>
                    <select class="form-control {{ $errors->has('position') ? 'is-invalid' : '' }}" name="position" id="position">
                      <option value="{{ $personnel->position }}">{{ $personnel->position }}</option>
                    </select>
                    @if ($errors->has('position'))
                    <div class="invalid-feedback">{{ $errors->first('position') }}</div>
                    @endif
                  </div>
                  <div class="form-group col-md-4">
                    <label for="accredit">เลือกวิทยฐานะ</label>
                    <select class="form-control" name="accredit" id="accredit">
                      <option value="{{ $personnel->accredit }}">{{ $personnel->accredit }}</option>
                    </select>
                  </div>
                </div>
                <div class="form-row">
                  <div class="form-group col-md-4">
                    <label for="degree">ระดับการศึกษาสูงสุด</label>
                    <select class="form-control {{ $errors->has('degree') ? 'is-invalid' : '' }}" name="degree" id="degree">
                      <option value="{{ $personnel->degree }}">{{ $personnel->degree }}</option>
                    </select>
                    @if ($errors->has('degree'))
                    <div class="invalid-feedback">{{ $errors->first('degree') }}</div>
                    @endif
                  </div>
                  <div class="form-group col-md-4">
                    <label for="qualification">หลักสูตรการศึกษา</label>
                    <input type="text" class="form-control" id="qualification" placeholder="Qualification" name="qualification"
                      value="{{ $personnel->qualification }}">
                  </div>
                  <div class="form-group col-md-4">
                    <label for="major">สาขา</label>
                    <input type="text" class="form-control" id="major" placeholder="Major" name="major" value="{{ $personnel->major }}">
                  </div>
                </div>
                <div class="form-row">
                  <div class="form-group col-md-6">
                    <label for="tel">เบอร์โทรศัพท์</label>
                    <input type="tel" class="form-control" id="tel" placeholder="Telephone number" name="tel" value="{{ $personnel->tel }}">
                  </div>
                  <div class="form-group col-md-6">
                    <label for="email">อีเมล์</label>
                    <input type="email" class="form-control" id="email" placeholder="Email" name="email" value="{{ $personnel->email }}">
                  </div>
                </div>
                <hr>
                <div class="form-row">
                  <div class="form-group col-md-12">
                    <label for="department">กลุ่มงาน</label>
                    <select class="form-control" name="department" id="department">
                      @foreach($departments as $department)
                      <option value="{{ $department->id }}">{{ $department->department}}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="form-group col-md-6">
                    <label for="department_level">ระดับ</label>
                    <select class="form-control" name="department_level" id="department_level">
                      <option value="{{ $personnel->department_level }}">{{ $personnel->department_level }}</option>
                    </select>
                  </div>
                  <div class="form-group col-md-6">
                    <label for="responsible">หน้าที่รับผิดชอบ</label>
                    <input type="text" class="form-control" id="responsible" placeholder="Responsible" name="responsible"
                      value="{{ $personnel->responsible }}">
                  </div>
                </div>
                <div class="form-row">
                  <div class="form-group col-md-12">
                    <label for="course">กลุ่มสาระฯ</label>
                    <select class="form-control " name="course" id="course">
                      @foreach($courses as $course)
                      <option value="{{ $course->id }}">{{ $course->course}}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="form-group col-md-6">
                    <label for="course_level">ระดับ</label>
                    <select class="form-control" name="course_level" id="course_level">
                      <option value="{{ $personnel->course_level }}">{{ $personnel->course_level }}</option>
                    </select>
                  </div>
                  <div class="form-group col-md-6">
                    <label for="teach">วิชาที่สอน</label>
                    <input type="text" class="form-control" id="teach" placeholder="Teach" name="teach" value="{{ $personnel->teach }}">
                  </div>
                </div>
                <input type="hidden" name="author" value="{{ Auth::user()->id }}">
                <button class="btn btn-primary" type="submit" name="submit"><i class="far fa-edit"></i> อัพเดทข้อมูลข้อมูล</button>
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
@include('cdn-library.select2.script')
<script type="text/javascript">
  $("#image").fileinput({
    language: "th",
    theme: "fas",
    overwriteInitial: true,
    maxImageWidth: 200,
    maxImageHeight: 250,
    maxFileSize: 2000,
    showClose: false,
    showCaption: false,
    browseOnZoneClick: true,
    browseClass: "btn btn-primary btn-block",
    browseLabel: "เลือกรูปภาพ",
    defaultPreviewContent: '<img src="/images/personnels/default.jpg" class="img-fluid" alt="Your Avatar"><h6 class="text-muted">Click to select</h6>',
    layoutTemplates: {
      main2: '{preview} {browse}'
    },
    allowedFileExtensions: ["jpg", "png", "gif"],
    initialPreviewAsData: true,
    initialPreviewFileType: 'image',
    initialPreview: @json(asset('images/personnels/'.$personnel->image)),
    initialPreviewConfig: [{
      caption: @json($personnel->image),
      size: @json($size),
      key: 1
    }, ],
  });

  $(document).ready(function () {
    var gender = ['ชาย', 'หญิง'];
    var department_level = ['หัวหน้า', 'รองหัวหน้า', 'กรรมการ', 'กรรมการ/เลขานุการ'];
    var course_level = ['หัวหน้า', 'รองหัวหน้า', 'ครูผู้สอน'];
    var category = ['บริหาร', 'การสอน', 'ลูกจ้าง'];
    var manager = ['ผู้อำนวยการโรงเรียน', 'รองผู้อำนวยการโรงเรียน'];
    var instructor = ['ครู', 'ครูผู้ช่วย', 'ครูอัตราจ้าง', 'ครูต่างชาติ', 'พนักงานราชการ', 'ครูธุรการ'];
    var employee = ['ลูกจ้างประจำ', 'ลูกจ้างชั่วคราว', 'เจ้าหน้าที่'];
    var accredit = ['ชำนาญการ', 'ชำนาญการพิเศษ', 'เชี่ยวชาญ', 'เชี่ยวชาญพิเศษ'];
    var degree = ['ต่ำกว่าปริญญาตรี', 'ปริญญาตรี', 'ปริญญาโท', 'ปริญญาเอก'];

    $("#course").select2({
      allowClear: true,
      placeholder: 'Course',
    }).trigger('change');

    $("#department").select2({
      allowClear: true,
      placeholder: 'Department',
    }).trigger('change');

    $("#gender").select2({
      placeholder: 'Gender',
      data: gender,
    });
    $("#category").select2({
      allowClear: true,
      placeholder: 'Category',
      data: category,
    });
    $("#position").select2({
      allowClear: true,
      placeholder: 'Position',
    });
    $("#accredit").select2({
      allowClear: true,
      placeholder: 'Accredit',
    });
    $("#degree").select2({
      allowClear: true,
      placeholder: 'Degree',
      data: degree,
    });
    $("#department_level").select2({
      placeholder: 'Level',
      data: department_level,
    });
    $("#course_level").select2({
      placeholder: 'Level',
      data: course_level,
    });
    $("#category").on("change", function () {
      var newOption = [];
      if ($(this).val() === 'บริหาร') {
        for (var i = 0; i < manager.length; i++) {
          var option = new Option(manager[i], manager[i]);
          newOption.push(option);
        }
      } else if ($(this).val() === 'การสอน') {
        for (var i = 0; i < instructor.length; i++) {
          var option = new Option(instructor[i], instructor[i]);
          newOption.push(option);
        }
      } else if ($(this).val() === 'ลูกจ้าง') {
        for (var i = 0; i < employee.length; i++) {
          var option = new Option(employee[i], employee[i]);
          newOption.push(option);
        }
      }
      $("#position option[value]").remove();
      $('#position').append(newOption).trigger('change');
    });
    $("#position").on("change", function () {
      var newOption = [];
      if ($(this).val() === 'ผู้อำนวยการโรงเรียน' || $(this).val() === 'รองผู้อำนวยการโรงเรียน' || $(this).val() ===
        'ครู') {
        for (var i = 0; i < accredit.length; i++) {
          var option = new Option(accredit[i], accredit[i]);
          newOption.push(option);
        }
      }
      $("#accredit option[value]").remove();
      $('#accredit').append(newOption).trigger('change');
    });
  });

  $(".alert").delay(1500).slideUp(300, function () {
    $(this).alert('close');
  });
</script>
@endpush