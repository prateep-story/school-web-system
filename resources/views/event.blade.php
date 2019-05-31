@extends('layouts.front-end.master')

@section('content')
<section class="wow fadeIn">
  <div class="breadcumb">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="page-title d-none d-lg-block">
            <h1>ปฎิทินกิจกรรม</h1>
          </div>
          <div class="page-pagination" id="breadcumb">
            <ul>
              <li><a href="{{ url('/')}}">หน้าหลัก</a></li>
              <li><i class="fas fa-angle-right"></i></li>
              <li><a href="{{ url('กิจกรรมทั้งหมด')}}">ปฏิทินกิจกรรม</a></li>
              <li><i class="fas fa-angle-right"></i></li>
              <li>{{ str_limit($event->event, 25) }}</li>
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
            <div class="card-body">
              <h1 class="card-title wow fadeInUp">{{ $event->event }} </h1> {{ $event->user->name }} | 
              @if ($event->start_date->format('d') == $event->end_date->format('d'))
              {{ "วันที่ ".date_th($event->end_date).' '.time_th($event->start_date) }}
              @else
              {{ "วันที่ ".day_th($event->start_date).' - '.date_th($event->end_date).' '.time_th($event->start_date) }}
              @endif
              <p class="card-text wow fadeInUp">{!! $event->description !!}</p>
              <div class="my-2 py-2 border-top wow fadeInUp">
                <strong>โดย:</strong> {{$event->organizer}}
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection
