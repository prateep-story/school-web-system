@extends('layouts.front-end.master')

@section('content')
<section class="wow fadeIn">
  <div class="breadcumb">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="page-title d-none d-lg-block">
            <h1>ข่าวทั้งหมด</h1>
          </div>
          <div class="page-pagination" id="breadcumb">
            <ul>
              <li><a href="{{ url('/')}}">หน้าหลัก</a></li>
              <li><i class="fas fa-angle-right"></i></li>
              <li>ข่าวทั้งหมด</li>
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
        <div class="row">
            @foreach ($data as $key => $article)
              <a href="{{ url('อ่าน/'.$article->category.'/'.$article->slug)}}">
                  <div class="col-md-4 col-12 mb-1 wow fadeIn">
                    <div class="card">
                      <div class="thumbnail">
                          <img class="card-img-top" src="{{ asset('images/thumbnails/' .$article->image)}}" alt="{{$article->image}}">
                          <div class="publish">{{date_th($article->created_at)}}</div>
                      </div>
                      <div class="card-body">
                          <h5 class="card-title mb-0"><a href="{{ url('อ่าน/'.$article->category.'/'.$article->slug)}}">{{ $article->article}}</a></h5>
                          <ul class="list-inline small wow fadeIn">
                              <li class="list-inline-item"><a href="{{ url('หมวดหมู่/'.$article->category) }}"> <i class="far fa-folder-open"></i> {{$article->category}}</a></li>
                              <li class="list-inline-item"><i class="far fa-user"></i> {{$article->user->name}}</li>
                              <li class="list-inline-item"><i class="far fa-eye"></i> {{$article->view}}</li>
                          </ul>
                      </div>
                  </div>
                  </div>
              </a>
            @endforeach
            @empty ($data->count())
              ไม่พบข้อมูล...
            @endempty
          </div>
          <div class="d-flex justify-content-center mb-3 wow fadeIn">
            {{ $data->links() }}
          </div>
      </div>
    </div>
  </div>
</section>
@endsection
