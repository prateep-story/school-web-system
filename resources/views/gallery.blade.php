@extends('layouts.front-end.master')

@section('meta')
<meta property="og:url" content="{{$url}}" />
<meta property="og:title" content="{{$title}}" />
<meta property="og:description" content="{{$description}}" />
<meta property="og:image" content="{{$image}}" />
@endsection

@push('style')
  @include('cdn-library/lightbox/style')
  @include('cdn-library/jssocials/style')
@endpush

@section('content')
<section class="wow fadeIn">
  <div class="breadcumb">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="page-title d-none d-lg-block">
            <h1>ภาพกิจกรรม</h1>
          </div>
          <div class="page-pagination" id="breadcumb">
            <ul>
              <li><a href="{{ url('/')}}">หน้าหลัก</a></li>
              <li><i class="fas fa-angle-right"></i></li>
              <li><a href="{{ url('ภาพกิจกรรมทั้งหมด')}}">ภาพกิจกรรม</a></li>
              <li><i class="fas fa-angle-right"></i></li>
              <li>{{ str_limit($gallery->gallery, 25) }}</li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="wow fadeIn">
  <div class="container box">
    <div class="row">
      <div class="col-md-12">
        <div class="card" id="article">
          <img class="card-img-top wow fadeIn" src="{{ asset('images/galleries/'.$gallery->image)}}" alt="">
          <h1 class="card-title mt-3 wow fadeIn">{{ $gallery->gallery }} <span class="float-right" id="share"></span></h1>
          <ul class="list-inline wow fadeIn">
              <li class="list-inline-item"><i class="far fa-clock"></i> {{ date_th($gallery->created_at) }}</li>
              <li class="list-inline-item"><i class="far fa-user"></i> {{$gallery->user->name}}</li>
              <li class="list-inline-item"><i class="far fa-images"></i> {{$gallery->pictures->count()}}</li>
              <li class="list-inline-item"><i class="far fa-eye"></i> {{$gallery->view}}</li>
          </ul>
          <div class="card-body wow fadeIn">
            <p class="card-text">{!! $gallery->content !!}</p>
          </div>
          <div class="row">
            @foreach ($gallery->pictures as $picture)
            <div class="card col-md-4 my-3 wow fadeIn">
              <a href="{{ asset('images/pictures/'.$picture->picture)}}" data-toggle="lightbox">
                <img src="{{ asset('images/pictures/'.$picture->picture)}}" class="card-img-top img-fluid">
              </a>
            </div>
            @endforeach
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection

@push('script')
  @include('cdn-library/lightbox/script')
  @include('cdn-library/jssocials/script')
  <script type="text/javascript">
    $(document).on('click', '[data-toggle="lightbox"]', function(event) {
      event.preventDefault();
      $(this).ekkoLightbox();
    });

    $("#share").jsSocials({
      showLabel: false,
      showCount: true,
      shareIn: "popup",
      shares: [
        {
            share: "facebook",
            logo: "fab fa-facebook-f",
        },
        {
            share: "twitter",
            logo: "fab fa-twitter",
        },
        {
            share: "linkedin",
            logo: "fab fa-linkedin",
        },
      ]
    });
  </script>
@endpush
