@extends('layouts.back-end.master')

@section('content')
<main class="app-content">
    <div class="app-title">
        <div>
            <h1>แผงควบคุม<span class="small"> เว็บไซต์โรงเรียนปางศิลาทองศึกษา <small><a class="text-info" href="#"
                data-toggle="modal" data-target="#readme"><i class="fas fa-feather-alt"></i></a></small>
                </span></h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fas fa-home fa-lg"></i></li>
            <li class="breadcrumb-item"><a href="#">แผงควบคุม</a></li>
        </ul>
    </div>
    @if (session('alert'))
    <div class="alert {{session('alert')}}" role="alert"><i class="far fa-bell"></i> {{ session('message') }}</div>
    @endif
    <div class="row">
        <div class="col-md-6">
            <div class="row">
                <div class="col-md-12">
                    <div class="box">
                        <h4 class="box-title">สถิติผู้เข้าชมเว็บไซต์ {{ \Carbon\Carbon::now()->format('Y') }}</h4>
                        <canvas id="lineChart" height="175"></canvas>
                    </div>
                </div>

            </div>
        </div>
        <div class="col-md-6">
            <div class="row">
                <div class="col-md-6">
                    <div class="widget-small greensea coloured-icon"><i class="icon fas fa-sign fa-2x"></i>
                        <div class="info">
                            <h4>แบนเนอร์</h4>
                            <p><b>{{$highlights->count()}}</b></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="widget-small nephritis coloured-icon"><i class="icon fas fa-bookmark fa-2x"></i>
                        <div class="info">
                            <h4>ข่าว/บทความ</h4>
                            <p><b>{{$articles->count()}}</b></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="widget-small belizehole coloured-icon"><i class="icon fas fa-cloud-upload-alt fa-2x"></i>
                        <div class="info">
                            <h4>ไฟล์ดาวน์โหลด</h4>
                            <p><b>{{$files->count()}}</b></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="widget-small wisteria coloured-icon"><i class="icon fas fa-image fa-2x"></i>
                        <div class="info">
                            <h4>ภาพกิจกรรม</h4>
                            <p><b>{{$galleries->count()}}</b></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="widget-small midnightblue coloured-icon"><i class="icon fas fa-trophy fa-2x"></i>
                        <div class="info">
                            <h4>เกียรติประวัติ</h4>
                            <p><b>{{$awards->count()}}</b></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="widget-small orange coloured-icon"><i class="icon fas fa-award fa-2x"></i>
                        <div class="info">
                            <h4>ผลงานทางวิชาการ</h4>
                            <p><b>{{$researches->count()}}</b></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="widget-small pumpkin coloured-icon"><i class="icon fas fa-users fa-2x"></i>
                        <div class="info">
                            <h4>ข้อมูลบุคลากร</h4>
                            <p><b>{{$personnels->count()}}</b></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="widget-small pomegranate coloured-icon"><i class="icon fas fa-file-signature fa-2x"></i>
                        <div class="info">
                            <h4>ข้อมูลการติดต่อ</h4>
                            <p><b>{{$contacts->count()}}</b></p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="col-md-12">
            <div class="box">
                <div class="row">
                    @foreach ($users as $key => $user)
                    <div class="col-md-1 col-4 text-center" data-toggle="tooltip" data-placement="top" title="@if ($user->online_at)
                      {{ $user->online_at->locale('th_TH')->diffForHumans() }}
                    @endif">
                        <img class="img img-fluid rounded-circle" src="{{asset('images/avatars/'.$user->avatar)}}" alt="User Image">
                        <div class="users-list-name">{{ $user->name }}</div>
                        @if ($user->isOnline())
                        <span class="users-list-date"><i class="fas fa-circle text-success"></i> ออนไลน์</span>
                        @else
                        @isset($user->online_at)
                        <span class="users-list-date"><i class="fas fa-circle text-secondary"></i> ออฟไลน์</span>
                        @endisset
                        @endif
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</main>
<div class="modal fade" id="readme" tabindex="-1" role="dialog" aria-labelledby="readme" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="readme">วัตถุประสงค์</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>ผู้พัฒนาสารสนเทศ ซึ่งเป็นศิษย์เก่าของโรงเรียนปางศิลาทองศึกษา
                    ได้เล็งเห็นความสำคัญของการนำเทคโนโลยีมาใช้ในการ เผยแพร่ข้อมูลประชาสัมพันธ์
                    และการดำเนินงานด้านสารสนเทศของโรงเรียนให้มีประสิทธิภาพมากขึ้น
                    โดยในการพัฒนาเว็บไซต์ผู้จัดทำได้พัฒนาด้วยภาษาพีเอชพี (PHP) โดยใช้ Laravel - The PHP Framework
                    และระบบฐานข้อมูล MySQL เพื่อให้เป็นเว็บไซต์ทีมีประสิทธิภาพต่อผู้ใช้งานมากที่สุด
                    และผู้จัดทำสามารถปรับปรุงให้มี ความเหมาะสมกับการดำเนินงานของโรงเรียน
                    พร้อมทั้งมีความปลอดภัยด้านข้อมูลด้วยการกำหนดสิทธิการแก้ไขข้อมูลจากผู้ที่เกี่ยวข้องโดยตรง
                    เพื่ออำนวยความสะดวกในการนำเสนอข้อมูลต่างๆ สามารถเผยแพร่ข้อมูล
                    ประชาสัมพันธ์สู่กลุ่มเป้าหมายได้อย่างถูกต้อง อ่านง่ายสบายตา
                    เป็นมาตรฐานเดียวกันและเชื่อมโยงข้อมูลไปยังเป้าหมายได้ตรงกับความต้องการ</p>
                <blockquote class="blockquote text-right">
                    <p class="mb-0">ผู้พัฒนาระบบ</p>
                    <footer class="blockquote-footer">นายประทีป อุ่นอก</br><small>โทรศัพท์: 085-3469543</small></footer>
                </blockquote>
            </div>
        </div>
    </div>
</div>
@endsection

@push('script')
@include('cdn-library.chartjs.script')
<script type="text/javascript">
    var visitor = [];

    $.each(visitors = @json($visitor), function (index) {
        visitor[index - 1] = visitors[index];
    });


    var ctx = document.getElementById("lineChart");

    var lineChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ["ม.ค.", "ก.พ.", "มี.ค.", "เม.ย.", "พ.ค.", "มิ.ย.", "ก.ค.", "ส.ค.", "ก.ย.", "ต.ค.", "พ.ย.",
                "ธ.ค."
            ],
            datasets: [{
                label: "จำนวนผู้เข้าชม",
                backgroundColor: "#2980b9",
                data: visitor
            }]
        },
        options: {
            legend: {
                display: false
            }
        }
    });
</script>
@endpush