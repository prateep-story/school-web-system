@extends('layouts.back-end.master')

@push('style')
@include('cdn-library.lightbox.style')
@endpush

@section('content')
<main class="app-content">
    <div class="app-title">
        <div>
            <h1>ข้อมูลการติดต่อ<span class="small"> อ่าน</span></h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('dashboard')}}"><i class="fas fa-home fa-lg"></i></a></li>
            <li class="breadcrumb-item"><a href="{{ url('dashboard/contact')}}">ข้อมูลการติดต่อ</a></li>
        </ul>
    </div>
    @if (session('alert'))
    <div class="alert {{session('alert')}}" role="alert"><i class="far fa-bell"></i> {{ session('message') }}</div>
    @endif
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="mr-2">
                                <img class="rounded-circle" width="45" src="{{asset('images/avatars/avatar.jpg')}}" alt="">
                            </div>
                            <div class="ml-2">
                                <div class="h5 m-0">{{$contact->name}}</div>
                                <div class="h7 text-muted">{{$contact->email}}</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <h5 class="card-title">{{$contact->topic}}</h5>
                    <p class="card-text">
                        {!!$contact->message!!}
                    </p>
                </div>
                <div class="card-footer">
                    <a class="card-link" data-toggle="collapse" href="#reply" role="button" aria-expanded="false"
                        aria-controls="reply"><i class="fas fa-reply"></i> ตอบกลับ</a>
                    <span class="text-muted float-right"> <i class="fa fa-clock-o"></i>{{
                        date_th($contact->created_at)}}</span>
                </div>
            </div>
            <div class="collapse my-3" id="reply">
                <div class="card card-body">
                    <form action="{{ url('dashboard/reply')}}" method="post">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="reply">ตอบกลับ</label>
                            <textarea class="form-control {{ $errors->has('reply') ? 'is-invalid' : '' }}" name="reply"
                                rows="5" id="reply">{!! old('reply') !!}</textarea>
                            @if ($errors->has('reply'))
                            <div class="invalid-feedback">{{ $errors->first('reply') }}</div>
                            @endif
                        </div>
                        <input type="hidden" name="contact" value="{{ $contact->id }}">
                        <input type="hidden" name="name" value="{{ $contact->name }}">
                        <input type="hidden" name="topic" value="{{ $contact->topic }}">
                        <input type="hidden" name="message" value="{{ $contact->message }}">
                        <input type="hidden" name="email" value="{{ $contact->email }}">
                        <input type="hidden" name="author" value="{{ Auth::user()->id }}">
                        <button class="btn btn-primary" type="submit" name="submit"><i class="far fa-paper-plane"></i> ส่งข้อมูล</button>
                    </form>
                </div>
            </div>
            @foreach ($reply as $key => $value)
            <div class="card my-3">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="mr-2">
                                <img class="rounded-circle" width="45" src="{{asset('images/avatars/'.$value->user->avatar)}}"
                                    alt="">
                            </div>
                            <div class="ml-2">
                                <div class="h5 m-0">{{$value->user->name}}</div>
                                <div class="h7 text-muted">{{$value->user->email}}</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <p class="card-text">
                        {!!$value->reply!!}
                    </p>
                </div>
                <div class="card-footer">
                    <span class="text-muted float-right"> <i class="fa fa-clock-o"></i>{{
                        date_th($contact->created_at)}}</span>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</main>
@endsection

@push('script')
@include('cdn-library.lightbox.script')
<script type="text/javascript">
    $(".alert").delay(1500).slideUp(300, function () {
        $(this).alert('close');
    });

    $(topic).on('click', '[data-toggle="lightbox"]', function (event) {
        event.preventDefault();
        $(this).ekkoLightbox();
    });
</script>
@endpush