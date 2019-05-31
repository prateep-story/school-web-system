@component('mail::message')
{{-- Greeting --}}
@if (! empty($greeting))
## {{ $greeting }}
@else
@if ($level === 'error')
## @lang('Whoops!')
@else
## @lang('สวัสดี!')
@endif
@endif

{{-- Intro Lines --}}
@foreach ($introLines as $line)
{{ $line }}

@endforeach

{{-- Action Button --}}
@isset($actionText)
<?php
    switch ($level) {
        case 'success':
        case 'error':
            $color = $level;
            break;
        default:
            $color = 'primary';
    }
?>
@component('mail::button', ['url' => $actionUrl, 'color' => $color])
{{ $actionText }}
@endcomponent
@endisset

{{-- Outro Lines --}}
@foreach ($outroLines as $line)
{{ $line }}

@endforeach

{{-- Salutation --}}
@if (! empty($salutation))
{{ $salutation }}
@else
@lang('ขอขอบคุณ')<br>{{ config('app.name') }}
@endif

{{-- Subcopy --}}
@isset($actionText)
@slot('subcopy')
@lang(
    "หากคุณมีปัญหาในการคลิกปุ่ม \":actionText\" , ให้คัดลอกและวาง URL ด้านล่าง\n".
    'ลงในเว็บเบราว์เซอร์ของคุณ: [:actionURL](:actionURL)',
    [
        'actionText' => $actionText,
        'actionURL' => $actionUrl,
    ]
)
@endslot
@endisset
@endcomponent
