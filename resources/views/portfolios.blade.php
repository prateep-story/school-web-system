@extends('layouts.front-end.master')

@section('content')
<section class="wow fadeIn">
    <div class="breadcumb">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-title d-none d-lg-block">
                        <h1>เกียรติประวัติ</h1>
                    </div>
                    <div class="page-pagination" id="breadcumb">
                        <ul>
                            <li><a href="{{ url('/')}}">หน้าหลัก</a></li>
                            <li><i class="fas fa-angle-right"></i></li>
                            <li>เกียรติประวัติ</li>
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
                @foreach ($awards->sortByDesc('created_at') as $key => $award)
                <a href="{{url('รางวัล/'.$award->slug)}}">
                    <div class="col-md-4 col-12 mb-1 wow fadeInUp">
                        <div class="card">
                            <div class="thumbnail">
                                <img class="card-img-top" src="{{asset('images/thumbnails/'.$award->image)}}" alt="{{$award->title}}">
                            </div>
                            <div class="card-body">
                                <ul class="list-inline small wow fadeInUp">
                                    <li class="list-inline-item"><i class="far fa-clock"></i> {{date_th($award->created_at)}}</li>
                                    <li class="list-inline-item"><i class="far fa-user"></i> {{$award->user->name}}</li>
                                    <li class="list-inline-item"><i class="fas fa-trophy"></i> {{$award->portfolio->portfolio}}</li>
                                    <li class="list-inline-item float-right"><span id="share"></span></li>
                                </ul>
                                <h5 class="card-title mb-0"><a href="{{url('รางวัล/'.$award->slug)}}">{{
                                        str_limit($award->title.$award->award.$award->competition, 100)}}</a></h5>
                            </div>
                        </div>
                    </div>
                </a>
                @endforeach
                <div class="d-flex justify-content-center mb-3 wow fadeInUp">
                    {{ $awards->links() }}
                </div>
            </div>
        </div>
    </div>
</section>
@endsection