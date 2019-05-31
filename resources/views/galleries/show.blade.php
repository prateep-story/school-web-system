@extends('layouts.back-end.master')

@push('style')
@include('cdn-library.lightbox.style')
@endpush

@section('content')
<main class="app-content">
  <div class="app-title">
    <div>
      <h1>ตารางข้อมูล<span class="small"> รูปภาพ</span></h1>
    </div>
    <ul class="app-breadcrumb breadcrumb">
      <li class="breadcrumb-item"><a href="{{ url('dashboard')}}"><i class="fas fa-home fa-lg"></i></a></li>
      <li class="breadcrumb-item"><a href="{{ url('dashboard/gallery')}}">อัลบั้มภาพ</a></li>
      <li class="breadcrumb-item"><a href="{{ url('dashboard/picture')}}">รูปภาพ</a></li>
    </ul>
  </div>

  @if (session('alert'))
  <div class="alert {{session('alert')}}" role="alert"><i class="far fa-bell"></i> {{ session('message') }}</div>
  @endif
  <div class="row">
    <div class="col-md-12">
      <div class="box">
        <div class="box-body">
          <h6>รูปภาพทั้งหมด {{$pictures->count()}} รูป</h6>
          <div class="row">
            @foreach ($pictures->sortByDesc('updated_at') as $picture)
            <div class="col-md-3 col-sm-12">
              <div class="card my-3 rounded-0">
                <img class="card-img-top img-fluid rounded-0" src="{{ asset('images/pictures/'.$picture->picture)}}"
                  alt="Card image cap">
                <div class="card-footer d-flex justify-content-between">
                  <a href="{{ asset('images/pictures/'.$picture->picture)}}" data-toggle="lightbox" data-title="{{$picture->gallery->gallery}}"
                    data-footer="{{$picture->picture}}"><i class="fas fa-search text-secondary"></i></a>
                  <p class="mb-0">{{$picture->picture}}</p>
                  <a href="#" class="card-link " data-toggle="modal" data-target="#delete-{{ $picture->id }}"><i class="far fa-trash-alt text-danger"></i></a>
                </div>
              </div>
            </div>
            <div class="modal fade" id="delete-{{ $picture->id }}" tabindex="-1" role="dialog" aria-labelledby=""
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
                    <form action="{{ url('dashboard/picture/'.$picture->id)}}" method="post">
                      {{ csrf_field() }} {{ method_field('DELETE')}}
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
                      <button type="submit" class="btn btn-danger"><span class="fas fa-trash"></span> ยืนยัน</button>
                    </form>
                  </div>
                </div>
              </div>
            </div>
            @endforeach
          </div>
        </div>
      </div>
    </div>
  </div>
</main>
@endsection

@push('script')
@include('cdn-library.lightbox.script')
<script type="text/javascript">
  $(".alert").delay(1500).slideUp(300, function () {
    $(this).alert('close');
  });

  $(document).on('click', '[data-toggle="lightbox"]', function (event) {
    event.preventDefault();
    $(this).ekkoLightbox();
  });
</script>
@endpush