@extends('layouts.front-end.master')

@push('style')
  @include('cdn-library/fullcalendar/style')
@endpush

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
              <li>ปฎิทินกิจกรรม</li>
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
        <div class="card wow fadeInUp" id="article">
          <div class="card-body">
            {!! $calendar->calendar() !!}
          </div>
        </div>
      </div>
      <div class="col-md-12">
        <div class="row">
          @foreach ($cards as $key => $event)
          <div class="col-md-4">
            <div class="row row-striped wow fadeInUp">
              <div class="col-4 text-left">
                <div class="list-group text-center">
                  <h4 class="list-group-item list-group-item-action" style="background-color: {{$event->color}}; color: #fff;">
                      @if ($event->start_date->format('d') == $event->end_date->format('d'))
                      {{ $event->start_date->format('d') }}
                      @else
                      {{ $event->start_date->format('d').'-'.$event->end_date->format('d') }}
                      @endif
                  </h4>
                  <h5 class="list-group-item list-group-item-action list-group-item-light">{{
                      month_th($event->start_date).' '.year_th($event->start_date) }}</h5>
                </div>
              </div>
              <div class="col-8">
                <h5><a href="{{url('กิจกรรม/'.$event->slug)}}">{{ $event->event }}</a></h5>
                <ul class="list-inline">
                  <li class="list-item">
                    โดย: {{$event->organizer}}
                  </li>
                  @if ($event->end_date <= Carbon::now())
                  <li class="list-item">
                    <small class="text-danger">กิจกรรมสิ้นสุดแล้ว</small>
                  </li>
                  @elseif ($event->start_date <= Carbon::now() && $event->end_date >= Carbon::now())
                  <li class="list-item">
                    <small class="text-success">กิจกรรมเริ่มแล้ว</small>
                  </li>
                  @else
                  <li class="list-item">
                    <small class="text-primary">กิจกรรมจะเริ่มเร็วๆนี้</small>
                  </li>
                  @endif
                </ul>
              </div>
            </div>
          </div>
          @endforeach
        </div>
        <div class="d-flex justify-content-center mb-3 wow fadeInUp">
          {{ $cards->links() }}
        </div>
      </div>
    </div>
</section>
@endsection

@push('script')
  @include('cdn-library/moment/script')
  @include('cdn-library/fullcalendar/script')
   {!! $calendar->script() !!}
@endpush
