@component('mail::message')
## เรียน คุณ{{ $data['name']}}

## จากข้อร้องเรียน

{!! $data['topic'] !!} </br>
<hr>
{!! $data['message']!!}

## ผลการดำเนินการ

{!! $data['reply'] !!}

@lang('ขอขอบคุณ')<br>{{ config('app.name') }}

@endcomponent