@extends('layouts.front-end.master')

@section('content')
<section class="wow fadeIn">
    <div class="breadcumb">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-title d-none d-lg-block">
                        <h1>ไฟล์เอกสารทั้งหมด</h1>
                    </div>
                    <div class="page-pagination" id="breadcumb">
                        <ul>
                            <li><a href="{{ url('/')}}">หน้าหลัก</a></li>
                            <li><i class="fas fa-angle-right"></i></li>
                            <li>ไฟล์เอกสารทั้งหมด</li>
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
                <div class="clearfix mb-3">
                    @foreach ($documents as $key => $document)
                    <a class="btn btn-outline-secondary mt-2" role="button" class="wow fadeIn" href="{{url('ดาวน์โหลด/'.$document->slug)}}" >{{$document->document}}</a>
                    @endforeach
                </div>
                <div class="table-responsive">
                    <table class="table">
                        <tbody>
                            @foreach ($files as $key => $file)
                            <tr class="wow fadeIn">
                                    <td>
                                        <p class="mb-0">{{$file->title}}</p>
                                        <small class="text-mute">{{'ชื่อไฟล์: '.$file->file}}</small>
                                    </td>
                                    <td><a class="d-none d-lg-block" href="{{url('ดาวน์โหลด/'.$file->document->slug)}}">{{$file->document->document}}</a></td>
                                    <td class="text-center"><span class="d-none d-lg-block"> {{date_th($file->created_at)}}</span></td>
                                    <td class="text-center"><a class="btn btn-secondary btn-sm" href="{{ url('ไฟล์/'.$file->slug)}}"
                                            role="button" aria-pressed="true"><i class="fas fa-download"></i> ดาวน์โหลด</a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-center mb-3 wow fadeIn">
                        {{ $files->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection