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
              <li>{{ str_limit($personnel->name, 25) }}</li>
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
        <div class="card">
          <div class="row justify-content-center">
            <div class="col-md-2 col-6 ">
              <img class="card-img-top img-fluid mb-3 wow fadeIn" src="{{ asset('images/personnels/'.$personnel->image)}}"
                alt="{{$personnel->name}}">
            </div>
            <div class="col-md-10 col-12">
              <div class="card-block wow fadeIn">
                <dl class="row">
                  <dt class="col-sm-2 col-4">ชื่อ-สกุล :</dt>
                  <dd class="col-sm-10 col-8">{{$personnel->name}}</dd>
                  <dt class="col-sm-2 col-4">ตำแหน่ง :</dt>
                  <dd class="col-sm-10 col-8">{{$personnel->position.$personnel->accredit}}</dd>
                  <dt class="col-sm-2 col-4">วุฒิการศึกษา :</dt>
                  <dd class="col-sm-10 col-8">{{$personnel->qualification}}</dd>
                  <dt class="col-sm-2 col-4">วิชาเอก :</dt>
                  <dd class="col-sm-10 col-8">{{$personnel->major}}</dd>
                  @if ($personnel->tel)
                  <dt class="col-sm-2 col-4">เบอร์โทรศัพท์ :</dt>
                  <dd class="col-sm-10 col-8">{{$personnel->tel}}</dd>
                  @endif
                  @if ($personnel->email)
                  <dt class="col-sm-2 col-4">อีเมล์ :</dt>
                  <dd class="col-sm-10 col-8">{{$personnel->email}}</dd>
                  @endif
                </dl>
              </div>
            </div>
          </div>
          <div class="row my-3">
            <div class="col-md-12">
              <div class="table-responsive wow fadeIn">
                <table class="table">
                  <thead>
                    <tr>
                      <th class="text-center">เผยแพร่ผลงานทางวิชาการ</th>
                      <th class="text-center" width="15%">ปีการศึกษา</th>
                      <th class="text-center" width="15%">บทคัดย่อ</th>
                    </tr>
                  </thead>
                  <tbody>
                    @if ($researches->where('personnel_id',$personnel->id)->count())
                    @foreach ($researches->where('personnel_id',$personnel->id)->sortByDesc('year') as $key =>
                    $research)
                    <tr>
                      <td>{{$research->research}}</td>
                      <td>{{$research->year+543}}</td>
                      <td class="text-center"><a class="btn btn-secondary btn-sm" href="{{ url('งานวิจัย/'.$research->slug)}}"
                        role="button" aria-pressed="true"><i class="fas fa-file-alt"></i> บทคัดย่อ</a></td>
                    </tr>
                    @endforeach
                    @else
                    <tr>
                      <td colspan="3">รอการอัพเดตข้อมูล...</td>
                    </tr>
                    @endif
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection