@extends('layouts.front-end.master')

@section('content')
<section class="wow fadeIn">
    <div class="breadcumb">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-title d-none d-lg-block">
                        <h1>บุคลากร</h1>
                    </div>
                    <div class="page-pagination" id="breadcumb">
                        <ul>
                            <li><a href="{{ url('/')}}">หน้าหลัก</a></li>
                            <li><i class="fas fa-angle-right"></i></li>
                            <li>{{ str_limit($course->course, 25) }}</li>
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
                <div class="card" id="personnels">
                    @isset($personnels)
                    <div class="card-body">
                        <h2 class="card-text text-center mb-3 wow fadeIn">{{ $course->course }}</h2>
                        <div class="row justify-content-center">
                            @foreach ($personnels->where('course_id', $course->id)->where('course_level', 'หัวหน้า') as $personnel)
                            <div class="card col-md-4 col-6 wow fadeIn">
                                <img class="card-img-top img-fluid mx-auto" src="{{ asset('images/personnels/'.$personnel->image)}}" alt="{{$personnel->name}}" style=" width: 50%">
                                <div class="card-body ">
                                    <h4 class="card-title text-center"><a href="{{url('บุคลากร/'.$personnel->slug)}}">{{$personnel->name}}</a> </h4>
                                    <p class="text-center">{{$personnel->position.$personnel->accredit}}</p>
                                </div>
                            </div>
                            @endforeach
                            @foreach ($personnels->where('course_id', $course->id)->where('course_level', 'รองหัวหน้า') as $personnel)
                            <div class="card col-md-4 col-6 wow fadeIn">
                                <img class="card-img-top img-fluid mx-auto" src="{{ asset('images/personnels/'.$personnel->image)}}" alt="{{$personnel->name}}" style=" width: 50%">
                                <div class="card-body ">
                                    <h4 class="card-title text-center"><a href="{{url('บุคลากร/'.$personnel->slug)}}">{{$personnel->name}}</a> </h4>
                                    <p class="card-text text-center">{{$personnel->course_level.$personnel->course->course}}</p>
                                    <p class="text-center">{{$personnel->position.$personnel->accredit}}</p>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <div class="row justify-content-start">
                            @foreach ($personnels->where('course_id', $course->id)->where('course_level', 'ครูผู้สอน') as $personnel)
                            <div class="card col-md-4 col-6 wow fadeIn">
                                <img class="card-img-top img-fluid mx-auto" src="{{ asset('images/personnels/'.$personnel->image)}}" alt="{{$personnel->name}}" style=" width: 50%">
                                <div class="card-body ">
                                    <h4 class="card-title text-center"><a href="{{url('บุคลากร/'.$personnel->slug)}}">{{$personnel->name}}</a> </h4>
                                    <p class="text-center">{{$personnel->position.$personnel->accredit}}</p>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="card-footer wow fadeIn">
                      @isset($course->description)
                        <h1 class="card-text text-center mb-3">ขอบข่ายงาน{{$course->course}}</h1>
                        {!! $course->description !!}
                      @endisset
                    </div>
                    @endisset
                    @empty ($personnels->count())
                    <div style="height:425px;">ไม่พบข้อมูล...</div>
                    @endempty
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
