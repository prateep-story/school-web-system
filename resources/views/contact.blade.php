@extends('layouts.front-end.master')

@section('content')
<section class="wow fadeIn">
  <div class="breadcumb">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="page-title d-none d-lg-block">
            <h1>ติดต่อเรา</h1>
          </div>
          <div class="page-pagination" id="breadcumb">
            <ul>
              <li><a href="{{ url('/')}}">หน้าหลัก</a></li>
              <li><i class="fas fa-angle-right"></i></li>
              <li>ติดต่อเรา</li>
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
      <div class="col-md-6 wow fadeInUp">
        <h1>ข้อมูลการติดต่อโรงเรียน</h1>
        <p>107 หมู่ที่ 17 บ้านมอแสงทอง ต.โพธิ์ทอง อ.ปางศิลาทอง จ.กำแพงเพชร 62120</p>
        <p>โทรศัพท์ 055-868884 โทรสาร 055-868886</p>
        <p>อีเมล์ info@pslt.ac.th</p>
        <p>เว็บไซต์ http://www.pslt.ac.th</p>
        <div class="wow fadeInUp" id="map" style="height: 500px; position: relative; overflow: hidden;"></div>
      </div>
      <div class="col-md-6 blog-sidebar">
        @if (session('alert'))
        <div class="alert {{session('alert')}}" role="alert"><i class="far fa-bell"></i> {{ session('message') }}</div>
        @endif
        <div class="card wow fadeInUp">
          <div class="card-body ">
            <form class="" action="{{ url('ติดต่อเรา')}}" method="post">
              {{ csrf_field() }}
              <div class="form-row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="name">ชื่อ-นามสกุล</label>
                    <input type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" id="name" placeholder="Name" name="name" value="{{ old('name') }}" >
                    @if ($errors->has('name'))
                    <div class="invalid-feedback">{{ $errors->first('name') }}</div>
                    @endif
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="email">อีเมล์</label>
                    <input type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" id="email" placeholder="Email" name="email" value="{{ old('email') }}">
                    @if ($errors->has('email'))
                    <div class="invalid-feedback">{{ $errors->first('email') }}</div>
                    @endif
                  </div>
                </div>
              </div>
              <div class="form-group{{ $errors->has('topic') ? ' has-error' : '' }}">
                <label for="topic">หัวข้อ</label>
                <input type="text" class="form-control{{ $errors->has('topic') ? ' is-invalid' : '' }}" id="topic" placeholder="Topic" name="topic" value="{{ old('topic') }}">
                @if ($errors->has('topic'))
                <div class="invalid-feedback">{{ $errors->first('topic') }}</div>
                @endif
              </div>
              <div class="form-group{{ $errors->has('message') ? ' has-error' : '' }}">
                <label for="message">ข้อความ</label>
                <textarea name="message" class="form-control{{ $errors->has('message') ? ' is-invalid' : '' }}" rows="8" placeholder="Message">{!! old('message') !!}</textarea>
                @if ($errors->has('message'))
                <div class="invalid-feedback">{{ $errors->first('message') }}</div>
                @endif
              </div>
              <div class="form-group">
                <label for="">ยืนยันตัวตน</label>
                {!! NoCaptcha::display() !!}
                @if ($errors->has('g-recaptcha-response'))
                <div class="text-danger">{{ $errors->first('g-recaptcha-response') }}</div>
                @endif
              </div>
              <div class="form-group">
                <button class="btn btn-primary" type="submit" name="submit"><i class="far fa-save"></i> บันทึกข้อมูล</button>
              </div>
            </form>
          </div>
          <div class="card-footer text-muted">
            ขอขอบคุณที่สละเวลาเสนอความคิดเห็นอันมีค่าของท่านต่อโรงเรียนปางศิลาทองศึกษา ทุกความคิดเห็นของท่าน เราจะนำมาพิจารณาและปรับปรุงโรงเรียนปางศิลาทองศึกษาให้ดียิ่งขึ้น
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection

@push('script')
  @include('cdn-library.googlemap.script')
  {!! NoCaptcha::renderJs() !!}
  <script type="text/javascript">
  var map;
  function initMap() {
    var styledMapType = new google.maps.StyledMapType(
     [
       {
         "featureType": "poi.school",
         "elementType": "labels.icon",
         "stylers": [
           {
             "visibility": "off"
           }
         ]
       }
     ],{name: 'แผนที่'});
    map = new google.maps.Map(document.getElementById('map'), {
      center: {lat: 16.102900, lng: 99.509988},
      zoom: 15,
      mapTypeControlOptions: {
        mapTypeIds: ['styleMap', 'satellite']
      }
    });
    map.mapTypes.set('styleMap', styledMapType);
    map.setMapTypeId('styleMap');
    var contentString ='<h5 class="text-primary mb-0">' + 'โรงเรียนปางศิลาทองศึกษา' + '</h5>' +
      '<p class="text-muted mb-0">' + 'สังกัดสำนักงานเขตพื้นที่การศึกษามัธยมศึกษา เขต ๔๑' + '</p>';
    var infowindow = new google.maps.InfoWindow({
      content: contentString
    });
    var image = '/images/marker.png';
    var marker = new google.maps.Marker({
      position: {lat: 16.0996500, lng: 99.5099600},
      map: map,
      icon: image,
      title: 'โรงเรียนปางศิลาทองศึกษา'
    });
    marker.addListener('click', function() {
      infowindow.open(map, marker);
    });
  }

  $(".alert").delay(5000).slideUp(300, function() {
    $(this).alert('close');
  });
  </script>
@endpush
