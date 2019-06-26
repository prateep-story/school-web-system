@extends('layouts.back-end.master')

@push('style')
@include('cdn-library.datatable.style')
@include('cdn-library.select2.style')
@endpush

@section('content')
<main class="app-content">
  <div class="app-title">
    <div>
      <h1>ตารางข้อมูล<span class="small"> สมาชิก</span></h1>
    </div>
    <ul class="app-breadcrumb breadcrumb">
      <li class="breadcrumb-item"><a href="{{ url('dashboard')}}"><i class="fas fa-home fa-lg"></i></a></li>
      <li class="breadcrumb-item"><a href="{{ url('dashboard/user')}}">สมาชิก</a></li>
    </ul>
  </div>
  @if (session('alert'))
  <div class="alert {{ session('alert') }}" role="alert"><i class="far fa-bell"></i> {{ session('message') }}</div>
  @endif
  <div class="row">
    <div class="col-md-12">
      <div class="box">
        <div class="box-body">
          <table class="table table-striped table-bordered dt-responsive nowrap" id="datatable" style="width:100%">
            <thead>
              <tr>
                <th>#</th>
                <th>ชื่อ-นามสกุล</th>
                <th>อีเมล์</th>
                <th>บทบาท</th>
                <th>ยืนยันตัวตน</th>
                <th>ออนไลน์ล่าสุด</th>
                <th>ไอพีแอดเดรส</th>
                <th>ลงทะเบียน</th>
                @role('admin')
                <th>จัดการข้อมูล</th>
                @endrole
              </tr>
            </thead>
            <tbody>
              @foreach ($users->sortByDesc('updated_at') as $key => $value)
              <tr>
                <td class="text-center">{{ $key+1 }}</td>
                <td><a href="#" data-toggle="popover" data-img="{{asset('images/avatars/'.$value->avatar)}}"
                    title="{{$value->name}}">{{ str_limit($value->name, 75) }}</a></td>
                <td>{{ $value->email }}</td>
                <td class="text-center"> {{ str_replace(array('[',']','"'),'', $value->getRoleNames()) }}</td>
                <td class="text-center">
                  @if ($value->email_verified_at != null)
                  <p class="text-success"><i class="far fa-check-circle"></i> เรียบร้อย</p>
                  @elseif ($value->email_verified_at == null)
                  <p class="text-secondary"><i class="far fa-times-circle"></i> รอดำเนินการ</p>
                  @endif
                </td>
                <td class="text-center">
                  @if($value->online_at != null)
                  {{ date_th($value->online_at) }}
                  @else
                  -
                  @endif
                </td>
                <td class="text-center">
                  @if($value->online_ip != null)
                  {{ $value->online_ip }}
                  @else
                  -
                  @endif
                </td>
                <td class="text-center">{{ date_th($value->created_at) }}</td>
                @role('admin')
                <td class="text-center">
                  <div class="btn-group btn-group-sm" role="group" aria-label="management">
                    @can('edit')
                    <a href="{{ url('dashboard/user/'.$value->id.'/edit')}}" class="btn btn-secondary btn-sm"><i
                        class="far fa-edit"></i></a>
                    @endcan
                    @can('delete')
                    <a href="#" data-toggle="modal" data-target="#delete-{{ $value->id }}"
                      class="btn btn-danger btn-sm"><i class="far fa-trash-alt"></i></a>
                    @endcan
                  </div>
                </td>
                @endrole
              </tr>
              <div class="modal fade" id="delete-{{ $value->id }}" tabindex="-1" role="dialog" aria-labelledby=""
                aria-hidden="true">
                <div class="modal-dialog modal-sm" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h4 class="modal-title">ยืนยันการลบข้อมูล</h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        <span class="sr-only">Close</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <p>คุณต้องการลบรายการนี้หรือไม่?</p>
                    </div>
                    <div class="modal-footer">
                      <form action="{{ url('dashboard/user/'.$value->id)}}" method="post">
                        {{ csrf_field() }} {{ method_field('DELETE')}}
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
                        <button type="submit" class="btn btn-danger"><i class="far fa-trash-alt"></i> ยืนยัน</button>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
              <div class="modal fade" id="edit-{{ $value->id }}" tabindex="-1" role="dialog" aria-labelledby=""
                aria-hidden="true">
                <div class="modal-dialog modal-sm" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h4 class="modal-title">แก้ไขข้อมูล</h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        <span class="sr-only">Close</span>
                      </button>
                    </div>
                  </div>
                </div>
              </div>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</main>
@endsection

@push('script')
@include('cdn-library.datatable.script')
@include('cdn-library.select2.script')
<script type="text/javascript">
  $(document).ready(function () {
    var role = ['developer', 'administrator', 'member'];
    $("#role").select2({
      allowClear: true,
      placeholder: 'role',
      data: role,
    });
  });

  $(document).ready(function () {
    $('#datatable').DataTable({
      responsive: true,
      autoWidth: true,
      language: {
        url: "https://cdn.datatables.net/plug-ins/1.10.19/i18n/Thai.json"
      }
    });
  });

  $(document).ready(function () {
    $('[data-toggle="popover"]').popover({
      //trigger: 'focus',
      trigger: 'hover',
      html: true,
      content: function () {
        return '<img class="img-fluid" src="' + $(this).data('img') + '" />';
      },
      title: 'Toolbox'
    })
  });

  $(".alert").delay(1500).slideUp(300, function () {
    $(this).alert('close');
  });
</script>
@endpush