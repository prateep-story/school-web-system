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
                            <li>{{ str_limit($department->department, 25) }}</li>
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
                    @isset ($personnels)
                    <div class="card-body">
                        <h2 class="card-text text-center mb-3 wow fadeInUp">{{$department->department}}</h2>
                        <div class="row justify-content-center">
                            @foreach ($personnels->where('position', 'ผู้อำนวยการโรงเรียน') as $personnel)
                            <div class="card col-md-4 col-6 wow fadeInUp">
                                <img class="card-img-top img-fluid mx-auto d-block" src="{{ asset('images/personnels/'.$personnel->image)}}" alt="{{$personnel->name}}" style=" width: 50%">
                                <div class="card-body ">
                                    <h4 class="card-title text-center"><a href="{{url('บุคลากร/'.$personnel->slug)}}">{{$personnel->name}}</a> </h4>
                                    <p class="card-text text-center">{{$personnel->position}}</p>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <div class="row justify-content-center">
                            @foreach ($personnels->where('department_id', $department->id)->where('position', 'รองผู้อำนวยการโรงเรียน') as $personnel)
                            <div class="card col-md-4 col-6 wow fadeInUp">
                                <img class="card-img-top img-fluid mx-auto d-block" src="{{ asset('images/personnels/'.$personnel->image)}}" alt="{{$personnel->name}}" style=" width: 50%">
                                <div class="card-body ">
                                    <h4 class="card-title text-center"><a href="{{url('บุคลากร/'.$personnel->slug)}}">{{$personnel->name}}</a> </h4>
                                    <p class="card-text text-center">{{$personnel->position.$personnel->responsible}}</p>
                                </div>
                            </div>
                            @endforeach
                            @foreach ($personnels->where('department_id', $department->id)->where('department_level', 'หัวหน้า') as $personnel)
                            <div class="card col-md-4 col-6 wow fadeInUp">
                                <img class="card-img-top img-fluid mx-auto d-block" src="{{ asset('images/personnels/'.$personnel->image)}}" alt="{{$personnel->name}}" style=" width: 50%">
                                <div class="card-body ">
                                    <h4 class="card-title text-center"><a href="{{url('บุคลากร/'.$personnel->slug)}}">{{$personnel->name}}</a> </h4>
                                    <p class="card-text text-center">{{$personnel->department_level.$personnel->department->department}}</p>
                                </div>
                            </div>
                            @endforeach
                            @foreach ($personnels->where('department_id', $department->id)->where('department_level', 'รองหัวหน้า') as $personnel)
                            <div class="card col-md-4 col-6 wow fadeInUp">
                                <img class="card-img-top img-fluid mx-auto d-block" src="{{ asset('images/personnels/'.$personnel->image)}}" alt="{{$personnel->name}}" style=" width: 50%">
                                <div class="card-body ">
                                    <h4 class="card-title text-center"><a href="{{url('บุคลากร/'.$personnel->slug)}}">{{$personnel->name}}</a> </h4>
                                    <p class="card-text text-center">{{$personnel->department_level.$personnel->department->department}}</p>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <div class="row justify-content-start">
                            @foreach ($personnels->where('department_id', $department->id)->where('department_level', 'กรรมการ') as $personnel)
                            <div class="card col-md-4 col-6 wow fadeInUp">
                                <img class="card-img-top img-fluid mx-auto d-block" src="{{ asset('images/personnels/'.$personnel->image)}}" alt="{{$personnel->name}}" style=" width: 50%">
                                <div class="card-body ">
                                    <h4 class="card-title text-center"><a href="{{url('บุคลากร/'.$personnel->slug)}}">{{$personnel->name}}</a> </h4>
                                    <p class="card-text text-center">{{$personnel->responsible}}</p>
                                </div>
                            </div>
                            @endforeach
                            @foreach ($personnels->where('department_id', $department->id)->where('department_level', 'กรรมการ/เลขานุการ') as $personnel)
                            <div class="card col-md-4 col-6 wow fadeInUp">
                                <img class="card-img-top img-fluid mx-auto d-block" src="{{ asset('images/personnels/'.$personnel->image)}}" alt="{{$personnel->name}}" style=" width: 50%">
                                <div class="card-body ">
                                    <h4 class="card-title text-center"><a href="{{url('บุคลากร/'.$personnel->slug)}}">{{$personnel->name}}</a> </h4>
                                    <p class="card-text text-center">{{$personnel->department_level}}</p>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="card-footer wow fadeInUp">
                      @isset($department->description)
                        <h1 class="card-text text-center mb-3">ขอบข่ายงาน{{$department->department}}</h1>
                        {!! $department->description !!}
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
