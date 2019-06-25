@extends('layouts.front-end.master')

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
              <li>ภาพกิจกรรม</li>
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
          <div class="card-body">
            <div class="row">
              @foreach ($galleries as $gallery)
                <a href="{{ url('ภาพกิจกรรม/'.$gallery->slug)}}">
                    <div class="col-md-4 col-12 mb-1 wow fadeIn">
                        <div class="card">
                            <div class="thumbnail">
                                <img class="card-img-top" src="{{ asset('images/thumbnails/'.$gallery->image)}}" alt="{{$gallery->gallery}}">
                                <div class="post-date">
                                    <span class="month">{{ month_th($gallery->created_at) }}</span>
                                    <span class="date">{{day_th($gallery->created_at)}}</span>
                                </div>
                            </div>
                            <div class="card-body">
                                <ul class="list-inline small wow fadeIn">
                                    <li class="list-inline-item"><i class="far fa-user"></i> {{$gallery->user->name}}</li>
                                    <li class="list-inline-item"><i class="far fa-images"></i> {{$gallery->pictures->count()}}</li>
                                    <li class="list-inline-item"><i class="far fa-eye"></i> {{$gallery->view}}</li>
                                    <li class="list-inline-item float-right"><span id="share"></span></li>
                                </ul>
                                <h5 class="card-title mb-0"><a href="{{ url('ภาพกิจกรรม/'.$gallery->slug)}}">{{ $gallery->gallery }}</a></h5>
                            </div>
                        </div>
                    </div>
                </a>
              @endforeach
            </div>
            <div class="d-flex justify-content-center mb-3 wow fadeIn">
              {{ $galleries->links() }}
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection
