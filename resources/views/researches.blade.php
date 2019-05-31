@extends('layouts.front-end.master')

@section('content')
<section class="wow fadeIn">
    <div class="breadcumb">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-title d-none d-lg-block">
                        <h1>งานวิจัยทั้งหมด</h1>
                    </div>
                    <div class="page-pagination" id="breadcumb">
                        <ul>
                            <li><a href="{{ url('/')}}">หน้าหลัก</a></li>
                            <li><i class="fas fa-angle-right"></i></li>
                            <li>งานวิจัยทั้งหมด</li>
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
                <div class="table-responsive">
                    <table class="table">
                        <tbody>
                            @foreach ($researches as $key => $research)
                            <tr class="wow fadeInUp">
                                <td>
                                    <p class="mb-0">{{$research->research}}</p>
                                    <small class="text-mute">{{'ปีการศึกษา: '.($research->year+543)}}</small>
                                </td>
                                <td><a href="{{url('บุคลากร/'.$research->personnel->slug)}}">{{$research->personnel->name}}</a></td>
                                <td class="text-center">{{date_th($research->created_at)}}</td>
                                <td class="text-center">
                                        <a class="btn btn-secondary btn-sm" href="{{ url('งานวิจัย/'.$research->slug)}}"
                                            role="button" aria-pressed="true"><i class="fas fa-file-alt"></i> บทคัดย่อ</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-center mb-3 wow fadeInUp">
                        {{ $researches->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection