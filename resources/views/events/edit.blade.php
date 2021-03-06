@extends('layouts.back-end.master')

@push('style')
@include('cdn-library.datepicker.style')
@endpush

@section('content')
<main class="app-content">
  <div class="app-title">
    <div>
      <h1>แก้ไข<span class="small"> กิจกรรม</span></h1>
    </div>
    <ul class="app-breadcrumb breadcrumb">
      <li class="breadcrumb-item"><a href="{{ url('dashboard')}}"><i class="fas fa-home fa-lg"></i></a></li>
      <li class="breadcrumb-item"><a href="{{ url('dashboard/event')}}">กิจกรรม</a></li>
      <li class="breadcrumb-item"><a href="{{ url('dashboard/event/create')}}">แก้ไข</a></li>
    </ul>
  </div>
  @if (session('alert'))
  <div class="alert {{session('alert')}}" role="alert"><i class="far fa-bell"></i> {{ session('message') }}</div>
  @endif
  <div class="row">
    <div class="col-md-12">
      <div class="box">
        <div class="box-body">
          <form action="{{ url('dashboard/event/'.$event->id)}}" method="post">
            {{ csrf_field() }} {{ method_field('put') }}
            <div class="form-group">
              <label for="event">กิจกรรม</label>
              <input type="text" class="form-control {{ $errors->has('event') ? 'is-invalid' : '' }}" id="event"
                placeholder="Event" name="event" value="{{$event->event}}">
              @if ($errors->has('event'))
              <div class="invalid-feedback">{{ $errors->first('event') }}</div>
              @endif
            </div>
            <div class="form-group">
              <label for="organizer">ผู้จัดกิจกรรม</label>
              <input type="text" class="form-control {{ $errors->has('organizer') ? 'is-invalid' : '' }}" id="organizer"
                placeholder="Organizer" name="organizer" value="{{$event->organizer}}">
              @if ($errors->has('organizer'))
              <div class="invalid-feedback">{{ $errors->first('organizer') }}</div>
              @endif
            </div>
            <div class="form-group">
              <label for="description">รายละเอียด</label>
              <textarea class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" name="description"
                rows="5" id="description">{{$event->description}}</textarea>
              @if ($errors->has('description'))
              <div class="invalid-feedback">{{ $errors->first('description') }}</div>
              @endif
            </div>
            <div class="form-group">
              <label for="start_date">กิจกรรมเริ่มวันที่</label>
              <div class="input-group date" id="start_date" data-target-input="nearest">
                <input type="text" class="form-control datetimepicker-input {{ $errors->has('start_date') ? 'is-invalid' : '' }}"
                  name="start_date" id="start_date" data-toggle="datetimepicker" data-target="#start_date" placeholder="Start">
                @if ($errors->has('start_date'))
                <div class="invalid-feedback">{{ $errors->first('start_date') }}</div>
                @endif
              </div>
            </div>
            <div class="form-group">
              <label for="end_date">กิจกรรมสิ้นสุดวันที่</label>
              <div class="input-group date" id="end_date" data-target-input="nearest">
                <input type="text" class="form-control datetimepicker-input {{ $errors->has('end_date') ? 'is-invalid' : '' }}"
                  name="end_date" id="end_date" data-toggle="datetimepicker" data-target="#end_date" placeholder="End">
                @if ($errors->has('end_date'))
                <div class="invalid-feedback">{{ $errors->first('end_date') }}</div>
                @endif
              </div>
            </div>
            <input type="hidden" name="author" value="{{ Auth::user()->id }}">
            <button class="btn btn-primary" type="submit" name="submit"><i class="far fa-edit"></i> อัพเดทข้อมูลข้อมูล</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</main>
@endsection

@push('script')
@include('cdn-library.moment.script')
@include('cdn-library.datepicker.script')
@include('cdn-library.tinymce.script')
<script type="text/javascript">
  $(function () {
    $('#start_date').datetimepicker({
      sideBySide: true,
      defaultDate: @json($event->start_date->format('m/d/Y h:i A')),
    });
    $('#end_date').datetimepicker({
      useCurrent: false,
      sideBySide: true,
      defaultDate: @json($event->end_date->format('m/d/Y h:i A')),
    });
    $("#start_date").on("change.datetimepicker", function (e) {
      $('#end_date').datetimepicker('minDate', e.date);
    });
    $("#end_date").on("change.datetimepicker", function (e) {
      $('#start_date').datetimepicker('maxDate', e.date);
    });
  });

  $(".alert").delay(1500).slideUp(300, function () {
    $(this).alert('close');
  });
</script>
@endpush