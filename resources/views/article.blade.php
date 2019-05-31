@extends('layouts.front-end.master')

@section('meta')
<meta property="og:url" content="{{$url}}" />
<meta property="og:title" content="{{$title}}" />
<meta property="og:description" content="{{$description}}" />
<meta property="og:image" content="{{$image}}" />
@endsection

@push('style')
  @include('cdn-library/jssocials/style')
@endpush

@section('content')
<section class="wow fadeIn">
  <div class="breadcumb ">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="page-title d-none d-lg-block">
            <h1>อ่านบทความ</h1>
          </div>
          <div class="page-pagination" id="breadcumb">
            <ul>
              <li><a href="{{ url('/')}}">หน้าหลัก</a></li>
              <li><i class="fas fa-angle-right"></i></li>
              <li><a href="{{ url('หมวดหมู่/'.$article->category->slug) }}">{{ $article->category->category }}</a></li>
              <li><i class="fas fa-angle-right"></i></li>
              <li>{{ str_limit($article->article, 25) }}</li>
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
          <img class="card-img-top wow fadeInUp" src="{{ asset('images/articles/'.$article->image)}}" alt="">
          @if ($article->category->type == 'ข่าว')
            <h1 class="card-title mt-3 wow fadeInUp">{{$article->article}} <span class="float-right" id="share"></span></h1>
            <ul class="list-inline wow fadeInUp">
                <li class="list-inline-item"><i class="far fa-clock"></i> {{ date_th($article->created_at) }}</li>
                <li class="list-inline-item"><a href="{{ url('หมวดหมู่/'.$article->category->slug) }}"> <i class="far fa-folder-open"></i> {{$article->category->category}}</a></li>
                <li class="list-inline-item"><i class="far fa-user"></i> {{$article->user->name}}</li>
                <li class="list-inline-item"><i class="far fa-eye"></i> {{$article->view}}</li>
            </ul>
            
          @endif
          <div class="card-body wow fadeInUp">
            <p class="card-text">{!! $article->content !!}</p>
          </div>
          @if ($article->category->type == 'ข่าว')
          <div class="card-footer text-muted wow fadeInUp">
            @foreach ($article->tags as $tag)
            <a href="{{ url('ป้ายข้อความ/'.$tag->slug)}}">
                <i class="fas fa-tag"></i>
                {{ $tag->tag }}
              </a>
            @endforeach
          </div>
        @endif
        </div>
      </div>
    </div>
  </div>
</section>
@endsection

@push('script')
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
