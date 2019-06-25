@extends('layouts.front-end.master')

@section('content')
<section class="wow fadeIn">
    <div class="breadcumb">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-title d-none d-lg-block">
                        <h1>รางวัล</h1>
                    </div>
                    <div class="page-pagination" id="breadcumb">
                        <ul>
                            <li><a href="{{ url('/')}}">หน้าหลัก</a></li>
                            <li><i class="fas fa-angle-right"></i></li>
                            <li><a href="{{url('เกียรติประวัติ/')}}">เกียรติประวัติ</a></li>
                            <li><i class="fas fa-angle-right"></i></li>
                            <li> <a href="{{url('รางวัล/'.$award->slug)}}">{{ str_limit($award->title, 25) }}</a></li>
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
          <div class="card col-md-12 p-3">
            <div class="row ">
              <div class="col-md-12 mb-2 wow fadeIn">
                <img class="w-100 img-fluid" src="{{asset('images/awards/'.$award->image)}}">
              </div>
              <div class="col-md-12 wow fadeIn">
                <div class="card-block">
                  <h1 class="card-title mb-0">{{ $award->title }}</h1>
                  <h5 class="text-muted">{{ $award->subtitle }}</h5>
                  <dl class="row">
                    <dt class="col-sm-1">รางวัล</dt>
                    <dd class="col-sm-11">{{$award->award}}</dd>
                  </dl>
                  <dl class="row">
                    <dt class="col-sm-1">กิจกรรม</dt>
                    <dd class="col-sm-11">{{$award->competition}}</dd>
                  </dl>
                  <dl class="row">
                    <dt class="col-sm-1">หน่วยงาน</dt>
                    <dd class="col-sm-11">{{$award->institution}}</dd>
                  </dl>
                  <dl class="row">
                    <dt class="col-sm-1">ปี พ.ศ.</dt>
                    <dd class="col-sm-11">{{$award->year+543}}</dd>
                  </dl>
                </div>
              </div>
              <div class="col-md-12">
                @if ($award->content)
                <p>{!!$award->content!!}</p>
                @endif
              </div>
            </div>
          </div>
        </div>
    </div>
</section>
@endsection
