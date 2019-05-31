@extends('layouts.front-end.master')

@section('content')
<section class="wow fadeIn">
  <div class="breadcumb">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="page-title d-none d-lg-block">
            <h1>เผยแพร่ผลงานวิจัย</h1>
          </div>
          <div class="page-pagination" id="breadcumb">
            <ul>
              <li><a href="{{ url('/')}}">หน้าหลัก</a></li>
              <li><i class="fas fa-angle-right"></i></li>
              <li><a href="{{url('บุคลากร/'.$research->personnel->slug)}}">{{$research->personnel->name}}</a></li>
              <li><i class="fas fa-angle-right"></i></li>
              <li>{{ str_limit($research->research, 25) }}</li>
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
        <div class="card mb-3" id="research">
          <div class="card-body">
            <dl class="row">
              <dt class="col-sm-2 wow fadeInUp">ชื่องานวิจัย :</dt>
              <dd class="col-sm-10 wow fadeInUp">{{$research->research}}</dd>
              <dt class="col-sm-2 wow fadeInUp">ผู้วิจัย :</dt>
              <dd class="col-sm-10 wow fadeInUp"><a href="{{url('บุคลากร/'.$research->personnel->slug)}}">{{$research->personnel->name}}</a></dd>
              <dt class="col-sm-2 wow fadeInUp">ปีที่ศึกษา :</dt>
              <dd class="col-sm-10 wow fadeInUp">{{$research->year+543}}</dd>
              <dt class="col-sm-2 wow fadeInUp">บทคัดย่อ :</dt>
              <dd class="col-sm-10 wow fadeInUp">{!! $research->abstract !!}</dd>
              <dt class="col-sm-2 wow fadeInUp">ผลการวิจัย :</dt>
              <dd class="col-sm-10 wow fadeInUp">{!! $research->result !!}</dd>
            </dl>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection