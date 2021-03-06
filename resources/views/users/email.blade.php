@component('mail::message')
## เรียน คุณ{{ $data['name']}}

คุณได้รับอีเมลนี้เนื่องจากเราได้รับคำขอเปลี่ยนรหัสผ่านสำหรับบัญชีของคุณ.
คุณจะสามารถเข้าสู่ระบบได้โดยใช้รหัสผ่านอันใหม่นี้ได้ทันที

รหัสผ่านใหม่ของคุณคือ: {{ $data['password']}}

คุณสามารถเปลี่ยนข้อมูลส่วนตัวหรือรหัสผ่านใหม่ได้ด้วยตนเองที่เมนูข้อมูลส่วนตัว
ถ้าคุณต้องการความช่วยเหลือ กรุณาติดต่อ "ผู้ดูแลระบบ" ได้ทันที. 

@lang('ขอขอบคุณ')<br>{{ config('app.name') }}

@endcomponent