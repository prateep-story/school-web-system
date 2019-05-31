@extends('layouts.back-end.master')

@push('style')
@include('cdn-library.datatable.style')
@endpush

@section('content')
<main class="app-content">
  <div class="app-title">
    <div>
      <h1>ตารางข้อมูล<span class="small"> บทบาท</span></h1>
    </div>
    <ul class="app-breadcrumb breadcrumb">
      <li class="breadcrumb-item"><a href="{{ url('dashboard')}}"><i class="fas fa-home fa-lg"></i></a></li>
      <li class="breadcrumb-item"><a href="{{ url('dashboard/role')}}">บทบาท</a></li>
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
                <th>บทบาท</th>
                <th>การ์ด</th>
                <th>การอนุญาต</th>
                <th>สร้างวันที่</th>
                @role('admin')
                <th>จัดการข้อมูล</th>
                @endrole
              </tr>
            </thead>
            <tbody>
              @foreach ($roles as $key => $value)
              <tr>
                <td>{{ $key+1 }}</td>
                <td>{{ str_limit($value->name, 75) }}</td>
                <td>{{ $value->guard_name }}</td>
                <td>
                        @foreach ($value->permissions()->pluck('name') as $item)
                        <i class="far fa-check-circle"></i> {{$item}}
                        @endforeach

                </td>
                <td class="text-center">{{ date_th($value->created_at) }}</td>
                @role('admin')
                <td class="text-center">
                    <a href="{{ url('dashboard/role/'.$value->id.'/edit')}}" class="btn btn-secondary btn-sm"><i class="far fa-edit"></i></a>  
                </td>
                @endrole
              </tr>
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
</script>
@endpush