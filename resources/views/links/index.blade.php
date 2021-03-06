@extends('layouts.back-end.master')

@push('style')
@include('cdn-library.datatable.style')
@include('cdn-library.lightbox.style')
@endpush

@section('content')
<main class="app-content">
  <div class="app-title">
    <div>
      <h1>ตารางข้อมูล<span class="small"> ลิงค์ภายนอก</span></h1>
    </div>
    <ul class="app-breadcrumb breadcrumb">
      <li class="breadcrumb-item"><a href="{{ url('dashboard')}}"><i class="fas fa-home fa-lg"></i></a></li>
      <li class="breadcrumb-item"><a href="{{ url('dashboard/link')}}">ลิงค์ภายนอก</a></li>
    </ul>
  </div>
  <div class="mb-2">
      @can('create')
      <a class="btn btn-primary" href="{{ url('dashboard/link/create')}}" role="button"><i class="fas fa-plus"></i>
        เพิ่มข้อมูล</a>
      @endcan
  </div>
  @if (session('alert'))
  <div class="alert {{session('alert')}}" role="alert"><i class="far fa-bell"></i> {{ session('message') }}</div>
  @endif
  <div class="row">
    <div class="col-md-12">
      <div class="box">
        <div class="box-body">
          <table class="table table-striped table-bordered dt-responsive nowrap" id="datatable" style="width:100%">
            <thead>
              <tr>
                <th>#</th>
                <th>ลิงค์ภายนอก</th>
                <th>รูปภาพ</th>
                <th>URL</th>
                <th>สร้างวันที่</th>
                <th>แก้ไขล่าสุด</th>
                <th>ผู้บันทึกข้อมูล</th>
                <th>จัดการข้อมูล</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($links->sortByDesc('updated_at') as $key => $value)
              <tr>
                <td>{{ $key+1}}</td>
                <td>{{ str_limit($value->link, 75) }}</td>
                <td class="text-center"><a href="{{ asset('images/links/'.$value->image)}}" data-toggle="lightbox"> <i
                      class="fas fa-image"></i> รูปภาพ</a></td>
                <td>{{ $value->url}}</td>
                <td class="text-center">{{ date_th($value->created_at) }}</td>
                <td class="text-center">{{ date_th($value->updated_at) }}</td>
                <td class="text-center">{{ $value->user->name }}</td>
                <td class="text-center">
                  <div class="btn-group btn-group-sm" role="group" aria-label="management">
                      @can('edit')
                      <a href="{{ url('dashboard/link/'.$value->id.'/edit')}}" class="btn btn-secondary btn-sm"><i class="far fa-edit"></i></a>
                      @endcan
                      @can('delete')
                      <a href="#" data-toggle="modal" data-target="#delete-{{ $value->id }}" class="btn btn-danger btn-sm"><i
                        class="far fa-trash-alt"></i></a>
                      @endcan
                  </div>
                </td>
              </tr>
              <div class="modal fade" id="delete-{{ $value->id }}" tabindex="-1" role="dialog" aria-labelledby=""
                aria-hidden="true">>
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
                      <form action="{{ url('dashboard/link/'.$value->id)}}" method="post">
                        {{ csrf_field() }} {{ method_field('DELETE')}}
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
                        <button type="submit" class="btn btn-danger"><i class="far fa-trash-alt"></i> ยืนยัน</button>
                      </form>
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
@include('cdn-library.lightbox.script')
<script type="text/javascript">
  $(document).ready(function () {
    $('#datatable').DataTable({
      responsive: true,
      autoWidth: true,
      language: {
        url: "https://cdn.datatables.net/plug-ins/1.10.19/i18n/Thai.json"
      }
    });
  });

  $(".alert").delay(1500).slideUp(300, function () {
    $(this).alert('close');
  });

  $(document).on('click', '[data-toggle="lightbox"]', function (event) {
    event.preventDefault();
    $(this).ekkoLightbox();
  });
</script>
@endpush