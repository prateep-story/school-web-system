@extends('layouts.front-end.master')

@push('style')
@include('cdn-library.slick.style')
@include('cdn-library.lightbox.style')
@endpush

@section('content')
@isset($highlights)
<div id="highlight" class="carousel slide wow fadeIn" data-ride="carousel">
    <ol class="carousel-indicators">
        @foreach ($highlights->where('status','1') as $key => $value)
        <li data-target="#highlight" data-slide-to="{{ $loop->index }}" class="{{ $loop->first ? 'active' : ''}}"></li>
        @endforeach
    </ol>
    <div class="carousel-inner">
        @foreach ($highlights->where('status','1')->sortByDesc("updated_at") as $key => $highlight)
        <div class="carousel-item {{ $loop->first ? 'active' : ''}}">
            @if ($highlight->articles->count())
            @foreach($highlight->articles as $article)
            <a href="{{ url('อ่าน/'.$article->category->slug.'/'.$article->slug)}}">
                <img class="d-block w-100" src="{{ asset('images/highlights/'.$highlight->image)}}"
                    alt="{{$highlight->highlight}}">
            </a>
            @endforeach
            @elseif($highlight->url)
            <a href="{{ $highlight->url}}" target="_blank">
                <img class="d-block w-100" src="{{ asset('images/highlights/'.$highlight->image)}}"
                    alt="{{$highlight->highlight}}">
            </a>
            @else
            <img class="d-block w-100" src="{{ asset('images/highlights/'.$highlight->image)}}"
                alt="{{$highlight->highlight}}">
            @endif
        </div>
        @endforeach
    </div>
    <a class="carousel-control-prev" href="#highlight" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#highlight" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>
@endisset
@isset($feed)
<section id="breaking-news" class="d-none d-lg-block wow fadeIn">
    <div class="container-fluid">
        <div class="row mb-5">
            <div class="col-12 py-4 bg-dark">
                <div class="container">
                    <div class="row">
                        <div class="col-md-3 col-lg-2 pr-md-0">
                            <div class="p-2 breaking text-white text-center breaking-caret "><span
                                    class="font-weight-bold">ข่าวการศึกษา</span></div>
                        </div>
                        <div class="col-md-9 col-lg-10 pl-md-4 py-2">
                            <div class="breaking-box">
                                <div id="carouselbreaking" class="carousel slide" data-ride="carousel">
                                    <div class="carousel-inner">
                                        @foreach ($feed->channel->item as $key => $item)
                                        <div class="carousel-item {{ $loop->first ? 'active' : ''}}">
                                            <span class="text-white"><i class="far fa-calendar"></i>
                                                {{date_th(Carbon::parse($item->pubDate))}} - </span>
                                            <a class="text-white" href="{{$item->link}}"
                                                target="_blank">{{$item->title}}</a>
                                        </div>
                                        @endforeach
                                    </div>
                                    <div class="navigation-box p-2 d-none d-sm-block">
                                        <!--nav left-->
                                        <a class="carousel-control-prev text-light" href="#carouselbreaking"
                                            role="button" data-slide="prev">
                                            <i class="fas fa-chevron-left faa-passing-reverse animated"
                                                aria-hidden="true"></i>
                                            <span class="sr-only">Previous</span>
                                        </a>
                                        <a class="carousel-control-next text-light" href="#carouselbreaking"
                                            role="button" data-slide="next">
                                            <i class="fas fa-chevron-right faa-passing animated" aria-hidden="true"></i>
                                            <span class="sr-only">Next</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endisset
<section id="news" class="mt-3 wow fadeIn">
    <div class="container box">
        <div class="row">
            <div class="col-md-12">
                <div class="box-news">
                    <div class="header wow fadeIn">
                        <a href="{{ url('ข่าวทั้งหมด')}}" class="pull-right view-all">ดูทั้งหมด <span class="icon"><i
                                    class="fas fa-chevron-right faa-passing animated fa-1x"></i></span></a>
                        <h1><span class="title-head">ข่าว</span>ประชาสัมพันธ์</h1>
                    </div>
                    <div class="row">
                        @foreach ($articles->slice(0, 6) as $key => $article)
                        <a href="{{ url('อ่าน/'.$article->category.'/'.$article->slug)}}">
                            <div class="col-md-4 col-12 mb-1 wow fadeIn">
                                <div class="card ">
                                    <div class="thumbnail">
                                        <img class="card-img-top"
                                            src="{{ asset('images/thumbnails/' .$article->image)}}"
                                            alt="{{$article->image}}">
                                        <div class="publish">{{date_th($article->created_at)}}</div>
                                    </div>

                                    <div class="card-body">
                                        <ul class="list-inline text-muted small">
                                            <li class="list-inline-item"><i class="far fa-folder-open"></i> {{
                                                        $article->category}}</li>
                                            <li class="list-inline-item"><i class="far fa-user"></i> {{
                                                        $article->user->name}}</li>
                                            <li class="list-inline-item"><i class="far fa-eye"></i>
                                                {{ $article->view}}</li>
                                        </ul>
                                        <h5 class="card-title mb-0">
                                            @if ($loop->first)
                                            <i class="far fa-hand-point-right faa-horizontal animated"></i>
                                            @endif
                                            <a href="{{ url('อ่าน/'.$article->category.'/'.$article->slug)}}">{{
                                                $article->article}}</a></h5>
                                    </div>
                                </div>
                            </div>
                        </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section id="gallery" class="gallery py-5 wow fadeIn">
    <div class="container box">
        <div class="row">
            <div class="col-md-8">
                <div class="box-news">
                    <div class="header wow fadeIn">
                        <a href="{{ url('ภาพกิจกรรมทั้งหมด')}}" class="pull-right view-all">ดูทั้งหมด <span
                                class="icon"><i class="fas fa-chevron-right faa-passing animated fa-1x"></i></span></a>
                        <h1><span class="title-head">ภาพ</span>กิจกรรม</h1>
                    </div>
                    <div class="row">
                        @foreach ($galleries->sortByDesc('created_at')->slice(0,4) as $key => $gallery)
                        <a href="{{ url('ภาพกิจกรรม/'.$gallery->slug)}}">
                            <div class="col-md-6 col-12 mb-1 mb-2 wow fadeIn">
                                <div class="card ">
                                    <div class="thumbnail">
                                        <img class="card-img-top" src="{{ asset('images/thumbnails/'.$gallery->image)}}"
                                            alt="{{$gallery->gallery}}">
                                        <div class="post-date">
                                            <span class="month">{{ month_th($gallery->created_at) }}</span>
                                            <span class="date">{{day_th($gallery->created_at)}}</span>
                                        </div>
                                    </div>
                                    <div class="card-body p-3">
                                        <ul class="list-inline text-muted small">
                                            <li class="list-inline-item"><i class="far fa-user"></i> {{
                                                        $gallery->user->name}}</li>
                                            <li class="list-inline-item"><i class="far fa-images"></i> {{
                                                        $gallery->pictures->count()}}</li>
                                            <li class="list-inline-item"><i class="far fa-eye"></i> {{
                                                        $gallery->view}}</li>
                                        </ul>
                                        <h5 class="card-title mb-0">
                                            @if ($loop->first)
                                            <i class="far fa-thumbs-up faa-vertical animated"></i>
                                            @endif
                                            <a href="{{ url('ภาพกิจกรรม/'.$gallery->slug)}}">{{
                                                $gallery->gallery }}</a></h5>
                                    </div>
                                </div>
                            </div>
                        </a>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-md-4" id="events">
                <div class="box-news">
                    <div class="header wow fadeIn">
                        <a href="{{ url('กิจกรรมทั้งหมด')}}" class="pull-right view-all">ดูทั้งหมด <span class="icon"><i
                                    class="fas fa-chevron-right faa-passing animated fa-1x"></i></span></a>
                        <h1><span class="title-head">ปฏิทิน</span>กิจกรรม</h1>
                    </div>
                    @foreach ($events->sortByDesc('start_date')->slice(0, 5) as $key => $event)
                    <div class="row row-striped Right wow fadeIn">
                        <div class="col-4 text-left">
                            <div class="list-group text-center">
                                <h4 class="list-group-item list-group-item-action"
                                    style="background-color: {{$event->color}}; color: #fff;">
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
                            <h5>
                                @if (Carbon::now() <= $event->end_date)
                                    <span class="far fa-bell faa-ring animated"></span>
                                    @endif
                                    <a href="{{url('กิจกรรม/'.$event->slug)}}">
                                        {{ $event->event }}
                                    </a>
                            </h5>
                            <small class="text-muted">โดย: {{$event->organizer}}</small>

                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
<section id="parallax-message" class="wow fadeIn">
    <div class="parallax-message">
        <div class="container">
            <div class="row py-5">
                <div class="col-md-2 wow fadeIn">
                    @foreach ($personnels->where('position', 'ผู้อำนวยการโรงเรียน') as $personnel)
                    <img class="img-fluid mx-auto d-block" src="{{ asset('images/personnels/'.$personnel->image)}}"
                        alt="{{$personnel->name}}">
                    <div class="card-body">
                        <p class="card-title text-center mb-0">{{$personnel->name}}</p>
                        <p class="card-text text-center mb-0">{{"(".$personnel->position.")"}}</p>
                    </div>
                    @endforeach
                </div>
                <div class="col-sm-10 wow fadeIn">
                    <div class="carousel-controls message-carousel-controls">
                        <div class="message-carousel ">
                            @foreach ($messages->where('status','1') as $message)
                            <div class="one-slide mx-auto">
                                <div class="row message">
                                    <div class="col-md-12 col-xs-12">
                                        <i class="fas fa-quote-left fa-2x fa-pull-left"></i>
                                        {!!$message->message!!}
                                        <blockquote class="blockquote text-right">
                                            <small class="mb-0">สาส์นจาก{{$message->personnel->position}}</small>
                                            <footer class="blockquote-footer text-light">{{$message->personnel->name}}
                                            </footer>
                                        </blockquote>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section id="download" class="wow fadeIn">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="box-news">
                    <div class="header wow fadeIn">
                        <a href="{{ url('ไฟล์เอกสารทั้งหมด/')}}" class="pull-right view-all">ดูทั้งหมด <span
                                class="icon"><i class="fas fa-chevron-right faa-passing animated fa-1x"></i></span></a>
                        <h1><span class="title-head">ดาวน์</span>โหลด</h1>
                    </div>
                    <div class="table-responsive wow fadeIn">
                        <table class="table">
                            <tbody>
                                @foreach ($files->sortByDesc('created_at')->slice(0,7) as $key => $file)
                                <tr>
                                    <td width="90%">
                                        <h5 class="mb-0">
                                                @if ($loop->first)
                                                <i class="fas fa-thumbtack faa-vertical animated"></i>
                                                @endif
                                                 {{$file->title}}
                                        </h5>
                                        <ul class="list-inline text-muted small">
                                            <li class="list-inline-item"><i class="far fa-user"></i>
                                                {{'ชื่อไฟล์: '.$file->file}}</li>
                                            <li class="list-inline-item"><i class="far fa-calendar-alt"></i>
                                                {{date_th($file->created_at)}}</li>
                                            <li class="list-inline-item"><i class="far fa-folder-open"></i>
                                                {{$file->document->document}}</li>
                                        </ul>
                                    </td width="10%">
                                    <td class="text-center"><a class="btn btn-secondary btn-sm"
                                            href="{{ url('ไฟล์/'.$file->slug)}}" role="button" aria-pressed="true"><i
                                                class="fas fa-download faa-float animated"></i> ดาวน์โหลด</a></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="box-news">
                    <div class="header wow fadeIn">
                        <a class="view-all mx-2" href="#newsletter" role="button" data-slide="next">
                            <span class="icon"><i
                                    class="fas fa-chevron-right faa-passing animated fa-1x"></i></span></a>
                        </a>
                        <a class="view-all mx-2" href="#newsletter" role="button" data-slide="prev">
                            <span class="icon"><i
                                    class="fas fa-chevron-left faa-passing-reverse animated fa-1x"></i></span></a>
                        </a>
                        <h1><span class="title-head">วารสาร</span>โรงเรียน</h1>
                    </div>
                    <div id="newsletter" class="carousel slide wow fadeIn" data-ride="carousel">
                        <div class="carousel-inner">
                            @foreach ($newsletters->where('status','1') as $newsletter)
                            <div class="carousel-item text-center {{ $loop->first ? 'active' : ''}}">
                                <a href="{{ asset('images/newsletters/'.$newsletter->image)}}" data-toggle="lightbox">
                                    <img class="d-block w-100" src="{{ asset('images/thumbnails/'.$newsletter->image)}}"
                                        alt="{{$newsletter->newsletter}}">
                                    <p class="text-muted mt-2">{{$newsletter->newsletter}}</p>
                                </a>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    <ol class="carousel-indicators">
                        @foreach ($newsletters->where('status','1') as $key => $value)
                        <li data-target="#newsletter" data-slide-to="{{ $loop->index }}"
                            class="{{ $loop->first ? 'active' : ''}}"></li>
                        @endforeach
                    </ol>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="parallax-info" class="wow fadeIn">
    <div class="parallax-info">
        <div class="container">
            <div class="row">
                <div class="col-md-6 wow fadeIn">
                    <div class="pt-5">
                        <h1>วิสัยทัศน์</h1>
                        <blockquote>
                            <p> โรงเรียนปางศิลาทองศึกษาจัดการศึกษาให้นักเรียนมีคุณภาพตามมาตรฐานการศึกษาขั้นพื้นฐาน
                                มีคุณธรรม น้อมนำหลักปรัชญาเศรษฐกิจพอเพียง ครูและผู้บริหารมีมาตรฐานตามวิชาชีพ
                                การบริหารจัดการแบบมีส่วนร่วม</p>
                        </blockquote>
                    </div>
                </div>
                <div class="col-md-6 ">
                    <div class="row text-center couter-item py-5" id="counter">
                        @foreach ($counters as $key => $counter)
                        <div class="col-md-{{12/$counters->count()}} col-4 wow fadeIn">
                            <div class="icon">
                                <i class="{{$counter->icon}} fa-3x"></i>
                            </div>
                            <span class="counter-value" data-count="{{$counter->quantity}}">0</span>
                            <h4>{{$counter->title}}</h4>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="award" class="wow fadeIn">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="box-news">
                    <div class="header wow fadeIn">
                        <a href="{{ url('เกียรติประวัติ')}}" class="pull-right view-all">ดูทั้งหมด <span class="icon"><i
                                    class="fas fa-chevron-right faa-passing animated fa-1x"></i></span></a>
                        <h1><span class="title-head">ความ</span>ภาคภูมิใจ</h1>
                    </div>
                    <div id="carouselAward" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">
                            @foreach ($awards->sortByDesc('created_at')->slice(0,5) as $key => $award)
                            <div class="carousel-item {{ $loop->first ? 'active' : ''}}">
                                <a href="{{url('รางวัล/'.$award->slug)}}">
                                    <img class="d-block w-100" src="{{asset('images/thumbnails/'.$award->image)}}"
                                        alt="First slide">
                                    <article class="carousel-caption d-none d-sm-block" style="padding-bottom:0;">
                                        <h5><i class="fas fa-trophy faa-pulse animated "></i> {{$award->title}}</h5>
                                        <p>{{ $award->award." ".$award->competition}}</p>
                                    </article> <!-- carousel-caption .// -->
                                </a>
                            </div>
                            @endforeach
                        </div>
                        <a class="carousel-control-prev" href="#carouselAward" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselAward" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="box-news">
                    <div class="header wow fadeIn">
                        <a href="{{ url('งานวิจัยทั้งหมด/')}}" class="pull-right view-all">ดูทั้งหมด <span
                                class="icon"><i class="fas fa-chevron-right faa-passing animated fa-1x"></i></span></a>
                        <h1><span class="title-head">ผลงาน</span>ทางวิชาการ</h1>
                    </div>
                    @foreach ($researches->sortByDesc('created_at')->slice(0, 5) as $key => $research)
                    <div class="clearfix Right mb-2 wow fadeIn">
                        <h5 class="mb-0"> <a href="{{ url('งานวิจัย/'.$research->slug)}}">
                                @if ($loop->first)
                                <i class="fas fa-award faa-tada animated"> </i>
                                @endif
                                {{$research->research}}</a></h5>
                        <ul class="list-inline text-muted small">
                            <li class="list-inline-item"><i class="far fa-user"></i> {{$research->personnel->name."
                                            (".$research->personnel->position.$research->personnel->accredit.")"}}</li>
                            <li class="list-inline-item"><i class="far fa-calendar-alt"></i>
                                {{$research->year+543}}</li>
                        </ul>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>

<section id="link" class="wow fadeIn">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="box-news">
                    <div class="header wow fadeIn">
                        <a class="view-all mx-2" href="#other-link" role="button" data-slide="next">
                            <span class="icon"><i
                                    class="fas fa-chevron-right faa-passing animated fa-1x"></i></span></a>
                        </a>
                        <a class="view-all mx-2" href="#other-link" role="button" data-slide="prev">
                            <span class="icon"><i
                                    class="fas fa-chevron-left faa-passing-reverse animated fa-1x"></i></span></a>
                        </a>
                        <h1><span class="title-head">ลิงค์</span>น่าสนใจ</h1>
                    </div>
                    <div id="other-link" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">
                            @foreach ($links->chunk(4) as $chunk)
                            <div class="carousel-item {{ $loop->first ? 'active' : ''}}">
                                <div class="row">
                                    @foreach ($chunk as $link)
                                    <div class="col-md-3 col-6">
                                        <a href="{{$link->url}}" target="_blank">
                                            <img src="{{ asset('images/links/'.$link->image)}}" alt="Image"
                                                style="max-width:100%;">
                                        </a>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@push('script')
@include('cdn-library.slick.script')
@include('cdn-library.googlemap.script')
@include('cdn-library.lightbox.script')
<script type="text/javascript">
    var a = 0;
    $(window).scroll(function () {
        var oTop = $('#counter').offset().top - window.innerHeight;
        if (a == 0 && $(window).scrollTop() > oTop) {
            $('.counter-value').each(function () {
                var $this = $(this),
                    countTo = $this.attr('data-count');
                $({
                    countNum: $this.text()
                }).animate({
                    countNum: countTo
                }, {
                    duration: 3000,
                    easing: 'swing',
                    step: function () {
                        $this.text(Math.floor(this.countNum));
                    },
                    complete: function () {
                        $this.text(this.countNum);
                        //alert('finished');	
                    }
                });
            });
            a = 1;
        }
    });

    var map;

    function initMap() {
        var styledMapType = new google.maps.StyledMapType(
            [{
                "featureType": "poi.school",
                "elementType": "labels.icon",
                "stylers": [{
                    "visibility": "off"
                }]
            }], {
                name: 'แผนที่'
            });
        map = new google.maps.Map(document.getElementById('map'), {
            center: {
                lat: 16.100500,
                lng: 99.509988
            },
            zoom: 16,
            mapTypeControlOptions: {
                mapTypeIds: ['satellite', 'styleMap']
            }
        });
        map.mapTypes.set('styleMap', styledMapType);
        map.setMapTypeId('satellite');
        var contentString = '<h5 class="text-primary mb-0">' + 'โรงเรียนปางศิลาทองศึกษา' + '</h5>' +
            '<p class="text-muted mb-0">' + 'สังกัดสำนักงานเขตพื้นที่การศึกษามัธยมศึกษา เขต ๔๑' + '</p>';
        var infowindow = new google.maps.InfoWindow({
            content: contentString
        });
        // var image = '/images/marker.png';
        var marker = new google.maps.Marker({
            position: {
                lat: 16.0996500,
                lng: 99.5099600
            },
            map: map,
            // icon: image,
            title: 'โรงเรียนปางศิลาทองศึกษา'
        });
        marker.addListener('click', function () {
            infowindow.open(map, marker);
        });
    }

    $(document).ready(function () {
        $(".message-carousel").slick({
            infinite: true,
            slidesToShow: 1,
            slidesToScroll: 1,
            autoplay: true,
            autoplaySpeed: 4000,
            arrows: false,
            dots: false,
        });
    });

    $('#newsletter').carousel({
        interval: 2000
    });
    $('#other-link').carousel({
        interval: 5000
    });

    $(document).on('click', '[data-toggle="lightbox"]', function (event) {
        event.preventDefault();
        $(this).ekkoLightbox();
    });
</script>
@endpush