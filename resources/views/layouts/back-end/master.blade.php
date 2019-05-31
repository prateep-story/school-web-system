<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    @include('cdn-library/bootstrap/style')
    @include('cdn-library/animate/style')
    @include('cdn-library/fontawesome/style')
    @include('cdn-library/font-awesome-animation/style')
    <link rel="stylesheet" href="{{ asset('css/back-end/style.min.css')}}">
    @stack('style')
    <title>@yield('title','ระบบจัดการเว็บไซต์')</title>
</head>

<body class="app sidebar-mini rtl">

    <!-- Navbar -->
    <header class="app-header"><a class="app-header-logo" href="{{url('/dashboard')}}">ระบบจัดการเว็บไซต์โรงเรียน</a>
        <!-- Sidebar toggle button--><a class="app-sidebar-toggle" href="#" data-toggle="sidebar" aria-label="Hide Sidebar"></a>
        <!-- Navbar Right Menu-->
        <ul class="app-nav">
            <li class="app-search">
                <input class="app-search-input" type="search" placeholder="Search">
                <button class="app-search-button"><i class="fas fa-search"></i></button>
            </li>
            <!--Notification Menu-->

            <li class="dropdown">
            <a class="app-nav-item" href="#" data-toggle="dropdown" aria-label="Show notifications"><i class="far fa-bell fa-lg @if ($notifications->count()) faa-ring animated @endif"></i>@if ($notifications->count())<span class="badge badge-light badge-counter">{{$notifications->count()}}</span>@endif</a>
                @if($notifications->count())
                <ul class="app-notification dropdown-menu dropdown-menu-right">
                    <li class="app-notification-title">คุณมีการแจ้งเตือนใหม่ {{$notifications->count()}} รายการ</li>
                    <div class="app-notification-content">
                        @foreach ($notifications as $notification)
                        <li>
                            <a class="app-notification-item" href="{{url('dashboard/contact/'.$notification->id)}}"><span
                                    class="app-notification-icon"><span class="fa-stack fa-lg"><i class="fas fa-circle fa-stack-2x text-primary"></i><i
                                            class="fas fa-envelope fa-stack-1x fa-inverse"></i></span></span>
                                <div>
                                    <p class="app-notification-message">{{$notification->topic}}</p>
                                    {{-- <p class="app-notification-meta">{{$notification->name}}</p> --}}
                                </div>
                            </a>
                        </li>
                        @endforeach
                    </div>
                    <li class="app-notification-footer"><a href="{{url('dashboard/contact/')}}">ดูการแจ้งเตือนทั้งหมด</a></li>
                </ul>
                @endif
            </li>
            <!-- User Menu-->
            <li class="dropdown">
                <a class="app-nav-item" href="#" data-toggle="dropdown" aria-label="User"><i class="far fa-user fa-lg"></i></a>
                <ul class="dropdown-menu settings-menu dropdown-menu-right">
                    <li><a class="dropdown-item" href="{{url('/')}}"><i class="fas fa-link"></i> หน้าเว็บไซต์</a></li>
                    <li><a class="dropdown-item" href="#" data-toggle="modal" data-target="#u-{{Auth::user()->id}}"><i
                                class="fas fa-cog"></i> ข้อมูลส่วนตัว</a></li>
                    <li><a class="dropdown-item" href="#" data-toggle="modal" data-target="#p-{{Auth::user()->id}}"><i
                                class="fas fa-key"></i> เปลี่ยนรหัสผ่าน</a></li>
                    <li>
                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                             document.getElementById('logout-form').submit();">
                            <i class="fas fa-sign-out-alt"></i> ออกจากระบบ
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </li>
                </ul>
            </li>
        </ul>
    </header>

    <!-- Modal -->
    <div class="modal fade" id="u-{{Auth::user()->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">แก้ไขข้อมูลส่วนตัว</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ url('dashboard/profile/'.Auth::user()->id)}}" method="post" enctype="multipart/form-data">
                    <div class="modal-body">
                        {{ method_field('PUT') }} {{ csrf_field() }}
                        <div class="avatar-upload">
                            <div class="avatar-edit">
                                <input type='file' name="avatar" id="imageUpload" accept=".png, .jpg, .jpeg" />
                                <label for="imageUpload"></label>
                            </div>
                            <div class="avatar-preview">
                                <div id="imagePreview" style="background-image: url('../images/avatars/{{ Auth::user()->avatar }}');">
                                </div>
                            </div>
                            @if ($errors->has('avatar'))
                            <span class="text-muted">{{ $errors->first('avatar') }}</span>
                            @endif
                        </div>
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name">ชื่อ-นามสกุล</label>
                            <input type="text" class="form-control" id="name" placeholder="Name" name="name" value="{{ Auth::user()->name }}">
                            @if ($errors->has('name'))
                            <span class="text-muted">{{ $errors->first('name') }}</span>
                            @endif
                        </div>
                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email">อีเมล์</label>
                            <input type="email" class="form-control" id="email" placeholder="Email" name="email" value="{{ Auth::user()->email }}">
                            @if ($errors->has('email'))
                            <span class="text-muted">{{ $errors->first('email') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
                        <button class="btn btn-primary" type="submit" name="submit">บันทึก</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="p-{{Auth::user()->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">แก้ไขรหัสผ่าน</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ url('dashboard/password/'.Auth::user()->id)}}" method="post" enctype="multipart/form-data">
                    <div class="modal-body">
                        {{ method_field('PUT') }} {{ csrf_field() }}
                        <div class="form-group">
                            <label class="control-label">รหัสผ่าน </label>
                            <input class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}" type="password"
                                placeholder="Password" name="password">
                            @if ($errors->has('password'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label class="control-label">ยืนยันรหัสผ่าน</label>
                            <input class="form-control {{ $errors->has('password_confirmation') ? ' is-invalid' : '' }}" type="password"
                                placeholder="Password" name="password_confirmation">
                            @if ($errors->has('password_confirmation'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('password_confirmation') }}</strong>
                            </span>
                            @endif
                        
                        </div>
                        <input type="hidden" name="name" value="{{Auth::user()->name}}">
                        <input type="hidden" name="email" value="{{Auth::user()->email}}">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
                        <button class="btn btn-primary" type="submit" name="submit">บันทึก</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Sidebar -->
    <div class="app-sidebar-overlay" data-toggle="sidebar"></div>
    <aside class="app-sidebar">
        <div class="app-sidebar-user"><img class="app-sidebar-user-avatar img-fluid rounded-circle" src="{{ asset('images/avatars/'.Auth::user()->avatar)}}"
                alt="User Image">
            <div>
                <p class="app-sidebar-user-name">{{ Auth::user()->name }}</p>
                <p class="app-sidebar-user-designation text-secondary">{{ str_replace(array('[',']','"'),'',
                    Auth::user()->getRoleNames()) }}</p>
            </div>
        </div>
        <ul class="app-menu">
            <li><a class="app-menu-item {{ Request::is('dashboard') ? 'active' : '' }}" href="{{ url('/dashboard')}}"><i
                        class="app-menu-icon fas fa-laptop"></i><span class="app-menu-label">แผงควบคุม</span></a></li>
            <li class="treeview {{ Request::is('dashboard/category*', 'dashboard/article*', 'dashboard/tag*', 'dashboard/highlight*', 'dashboard/guidance*') ? 'is-expanded' : '' }}">
                <a class="app-menu-item" href="#" data-toggle="treeview">
                    <i class="app-menu-icon fas fa-newspaper"></i><span class="app-menu-label">ข่าว/บทความ</span><i
                        class="treeview-indicator fas fa-angle-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a class="treeview-item {{ Request::is('dashboard/category*') ? 'active' : '' }}" href="{{ url('dashboard/category')}}"><i
                                class="icon fas fa-folder"></i> หมวดหมู่</a></li>
                    <li><a class="treeview-item {{ Request::is('dashboard/article*') ? 'active' : '' }}" href="{{ url('dashboard/article')}}"><i
                                class="icon fas fa-file"></i> ข่าว/บทความ</a></li>
                    <li><a class="treeview-item {{ Request::is('dashboard/tag*') ? 'active' : '' }}" href="{{ url('dashboard/tag')}}"><i
                                class="icon fas fa-tag"></i> ป้ายข้อความ</a></li>
                    <li><a class="treeview-item {{ Request::is('dashboard/highlight*') ? 'active' : '' }}" href="{{ url('dashboard/highlight')}}"><i
                                class="icon fas fa-sign"></i> ไฮไลท์/แบนเนอร์</a></li>
                    <li><a class="treeview-item {{ Request::is('dashboard/guidance*') ? 'active' : '' }}" href="{{ url('dashboard/guidance')}}"><i
                                class="icon fas fa-rss"></i> แนะแนวการศึกษา</a></li>
                </ul>
            </li>
            <li class="treeview {{ Request::is('dashboard/document*', 'dashboard/file*') ? 'is-expanded' : '' }}">
                <a class="app-menu-item" href="#" data-toggle="treeview">
                    <i class="app-menu-icon fas fa-folder-open"></i><span class="app-menu-label">เอกสารดาวน์โหลด</span><i
                        class="treeview-indicator fas fa-angle-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a class="treeview-item {{ Request::is('dashboard/document*') ? 'active' : '' }}" href="{{ url('dashboard/document')}}"><i
                                class="icon fas fa-folder"></i> แฟ้มเอกสาร</a></li>
                    <li><a class="treeview-item {{ Request::is('dashboard/file*') ? 'active' : '' }}" href="{{ url('dashboard/file')}}"><i
                                class="icon fas fa-upload"></i> ไฟล์อัพโหลด</a></li>
                </ul>
            </li>
            <li class="treeview {{ Request::is('dashboard/gallery*', 'dashboard/picture*', 'dashboard/event*' ) ? 'is-expanded' : '' }}">
                <a class="app-menu-item" href="#" data-toggle="treeview">
                    <i class="app-menu-icon fas fa-image"></i><span class="app-menu-label">กิจกรรมโรงเรียน</span><i
                        class="treeview-indicator fas fa-angle-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a class="treeview-item {{ Request::is('dashboard/event*') ? 'active' : '' }}" href="{{ url('dashboard/event')}}"><i
                                class="icon fas fa-calendar"></i> ปฏิทินกิจกรรม</a></li>
                    <li><a class="treeview-item {{ Request::is('dashboard/gallery*') ? 'active' : '' }}" href="{{ url('dashboard/gallery')}}"><i
                                class="icon fas fa-images"></i> อัลบั้มภาพ</a></li>
                </ul>
            </li>
            <li class="treeview {{ Request::is('dashboard/department*', 'dashboard/course*', 'dashboard/personnel*') ? 'is-expanded' : '' }}">
                <a class="app-menu-item" href="#" data-toggle="treeview">
                    <i class="app-menu-icon fas fa-users"></i><span class="app-menu-label">บุคลากรโรงเรียน</span><i
                        class="treeview-indicator fas fa-angle-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a class="treeview-item {{ Request::is('dashboard/department*') ? 'active' : '' }}" href="{{ url('dashboard/department')}}"><i
                                class="icon fas fa-id-card-alt"></i> กลุ่มบริหารงานภายใน</a></li>
                    <li><a class="treeview-item {{ Request::is('dashboard/course*') ? 'active' : '' }}" href="{{ url('dashboard/course')}}"><i
                                class="icon fas fa-address-card"></i> กลุ่มสาระการเรียนรู้ฯ</a></li>
                    <li><a class="treeview-item {{ Request::is('dashboard/personnel*') ? 'active' : '' }}" href="{{ url('dashboard/personnel')}}"><i
                                class="icon fas fa-user-tie"></i> บุคลากร</a></li>
                </ul>
            </li>
            <li class="treeview {{ Request::is('dashboard/portfolio*', 'dashboard/award*', 'dashboard/research*' ) ? 'is-expanded' : '' }}">
                <a class="app-menu-item" href="#" data-toggle="treeview">
                    <i class="app-menu-icon fas fa-certificate"></i><span class="app-menu-label">เกียรติประวัติ</span><i
                        class="treeview-indicator fas fa-angle-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a class="treeview-item {{ Request::is('dashboard/portfolio*') ? 'active' : '' }}" href="{{ url('dashboard/portfolio')}}"><i
                                class="icon fas fa-trophy"></i> ประเภทผลงาน</a></li>
                    <li><a class="treeview-item {{ Request::is('dashboard/award*') ? 'active' : '' }}" href="{{ url('dashboard/award')}}"><i
                                class="icon fas fa-award"></i> รางวัลที่ได้รับ</a></li>
                    <li><a class="treeview-item {{ Request::is('dashboard/research*') ? 'active' : '' }}" href="{{ url('dashboard/research')}}"><i
                                class="icon fas fa-book-open"></i> ผลงานทางวิชาการ</a></li>
                </ul>
            </li>
            <li><a class="app-menu-item {{ Request::is('dashboard/counter*') ? 'active' : '' }}" href="{{ url('dashboard/counter')}}"><i
                        class="app-menu-icon fas fa-question-circle"></i><span class="app-menu-label">ข้อมูลสถิติโรงเรียน</span></a></li>
            <li><a class="app-menu-item {{ Request::is('dashboard/link*') ? 'active' : '' }}" href="{{ url('dashboard/link')}}"><i
                        class="app-menu-icon fas fa-link"></i><span class="app-menu-label">ลิงค์ภายนอก</span></a></li>
            <li><a class="app-menu-item {{ Request::is('dashboard/message*') ? 'active' : '' }}" href="{{ url('dashboard/message')}}"><i
                        class="app-menu-icon fas fa-comment-alt"></i> <span class="app-menu-label">สาส์นจากผู้บริหาร</span></a></li>
            <li><a class="app-menu-item {{ Request::is('dashboard/contact*') ? 'active' : '' }}" href="{{ url('dashboard/contact')}}"><i
                        class="app-menu-icon fas fa-file-signature"></i> <span class="app-menu-label">ข้อมูลการติดต่อ</span> @if ($notifications->count())<span class="badge badge-danger">{{$notifications->count()}}</span>@endif</a></li>

            <li><a class="app-menu-item {{ Request::is('dashboard/user*') ? 'active' : '' }}" href="{{ url('dashboard/user')}}"><i
                        class="app-menu-icon fas fa-user"></i> <span class="app-menu-label">ข้อมูลสมาชิก</span></a></li>
            <li><a class="app-menu-item {{ Request::is('dashboard/role*') ? 'active' : '' }}" href="{{ url('dashboard/role')}}"><i
                            class="app-menu-icon fas fa-shield-alt"></i> <span class="app-menu-label">บทบาท/การอนุญาต</span></a></li>
        </ul>
    </aside>

    <!-- Content -->
    @yield('content')

    @include('cdn-library/jquery/script')
    @include('cdn-library/bootstrap/script')
    @include('cdn-library/animate/script')
    <script src="{{ asset('js/back-end/script.min.js')}}"></script>
    @stack('script')
</body>

</html>