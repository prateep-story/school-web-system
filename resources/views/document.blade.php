@extends('layouts.front-end.master')

@section('content')
<section class="wow fadeIn">
    <div class="breadcumb">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-title d-none d-lg-block">
                        <h1>ดาวน์โหลด</h1>
                    </div>
                    <div class="page-pagination" id="breadcumb">
                        <ul>
                            <li><a href="{{ url('/')}}">หน้าหลัก</a></li>
                            <li><i class="fas fa-angle-right"></i></li>
                            <li><a href="{{ url('ไฟล์เอกสารทั้งหมด/')}}">ไฟล์เอกสารทั้งหมด</a></li>
                            <li><i class="fas fa-angle-right"></i></li>
                            <li>{{ str_limit($document->document, 25) }}</li>
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
                            @foreach ($files->where('document_id',$document->id)->where('status',
                            '1')->sortByDesc('created_at') as $key => $file)
                            <tr class="wow fadeInUp">
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
                </div>
            </div>
        </div>
    </div>
</section>
@endsection