<!doctype html>
<html lang="{{ app()->getLocale() }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="description"
    content="โรงเรียนปางศิลาทองศึกษาจัดการศึกษาให้นักเรียนมีคุณภาพตามมาตรฐานการศึกษาขั้นพื้นฐาน มีคุณธรรม น้อมนำหลักปรัชญาเศรษฐกิจพอเพียง ครูและผู้บริหารมีมาตรฐานตามวิชาชีพ การบริหารจัดการแบบมีส่วนร่วม">
  <meta name="keywords" content="โรงเรียนปางศิลาทองศึกษา, Pangsilathongsuksa School, ป.ศ., P.S., แสด-ขาว">
  @yield('meta','')
  <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
  @include('cdn-library/bootstrap/style')
  @include('cdn-library/animate/style')
  @include('cdn-library/fontawesome/style')
  @include('cdn-library/font-awesome-animation/style')
  <link rel="stylesheet" href="{{ asset('css/front-end/style.min.css')}}">
  @stack('style')
  <title>@yield('title','โรงเรียนปางศิลาทองศึกษา')</title>
</head>

<body>
  {{-- <span class="preloader"></span> --}}
  <nav class="navbar navbar-expand-lg navbar-dark d-none d-lg-block topbar wow fadeIn">
    <div class="container">
      <div class="collapse navbar-collapse">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a class="nav-link" href="#"><i class="fas fa-clock"></i> <span id="datetime"></span></a>
          </li>
        </ul>
        <ul class="navbar-nav justify-content-between">
          @guest
          <li class="nav-item">
            <div class="btn-group" role="group" aria-label="sgs">
              <a class="btn btn-outline-light btn-sm" role="button"
                href="https://sgs6.bopp-obec.info/sgss/security/signin.aspx" target="_blank"><i
                  class="fas fa-chart-area"></i>
                ผลการเรียน</a>
              <a class="btn btn-outline-light btn-sm" role="button"
                href="https://sgs3.bopp-obec.info/sgs/Security/SignIn.aspx" target="_blank"><i
                  class="fas fa-chart-bar"></i>
                ทะเบียน-วัดผล</a>
            </div>
            <div class="btn-group" role="group" aria-label="guest">
              <a class="btn btn-outline-light btn-sm" role="button" href="{{ route('login') }}"><i
                  class="fas fa-sign-in-alt"></i>
                ผู้ดูแลระบบ</a>
            </div>
          </li>
          @else
          @auth
          <li class="nav-item">
              <div class="btn-group" role="group" aria-label="sgs">
                  <a class="btn btn-outline-light btn-sm" role="button"
                    href="https://sgs6.bopp-obec.info/sgss/security/signin.aspx" target="_blank"><i
                      class="fas fa-chart-area"></i>
                    ผลการเรียน</a>
                  <a class="btn btn-outline-light btn-sm" role="button"
                    href="https://sgs3.bopp-obec.info/sgs/Security/SignIn.aspx" target="_blank"><i
                      class="fas fa-chart-bar"></i>
                    ทะเบียน-วัดผล</a>
                </div>
            <div class="btn-group" role="group" aria-label="auth">
              @role('admin|officer')
              <a class="btn btn-outline-light btn-sm" role="button" href="{{ route('dashboard') }}"><i
                  class="fas fa-cog"></i>
                การจัดการ</a>
              @endrole
              @if (!Auth::user()->hasVerifiedEmail())
              <button class="btn btn-link btn-sm text-light" type="button" disabled>
                <i class="fas fa-exclamation-circle"></i> กรุณาตรวจสอบอีเมล์ของคุณ เพื่อยืนยันอีเมล์ในการเข้าสู่ระบบ!
              </button>
              @elseif(!Auth::user()->hasRole(['admin', 'officer']))
              <button class="btn btn-link btn-sm text-light" type="button" disabled>
                <i class="fas fa-exclamation-circle"></i> คุณไม่มีสิทธิเข้าใช้ระบบจัดการเว็บไซต์ โปรดติดต่อผู้ดูแลระบบ!
              </button>
              @endif
              <a class="btn btn-outline-light btn-sm" role="button" href="{{ route('logout') }}"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i
                  class="fas fa-sign-out-alt"></i> ออกจากระบบ</a>
              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
              </form>
            </div>
          </li>
          @endauth
          @endguest
        </ul>
      </div>
    </div>
  </nav>
  <nav class="navbar navbar-expand-lg navbar-light bg-light navigation sticky-top wow fadeIn" data-wow-delay=".5s">
    <div class="container">
      <a class="navbar-brand" href="{{url('/')}}"><img src="{{ asset('svg/logo.svg')}}" width="200"
          class="d-inline-block align-top" alt=""></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapse"
        aria-controls="collapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="collapse">
        <ul class="navbar-nav ml-auto justify-content-end">
          <li class="nav-item active">
            <a class="nav-link navbar-menu" href="{{ url('/') }}">หน้าแรก <span class="sr-only">(current)</span></a>
          </li>
          @isset ($navbar_categories)
          @foreach ($navbar_categories->where('type','บทความ') as $category)
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle navbar-menu" href="#" id="information" role="button"
              data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              {{$category->category}}
            </a>
            <div class="dropdown-menu" aria-labelledby="information">
              @foreach ($category->articles->where('status','1') as $article)
              <a class="dropdown-item"
                href="{{ url('อ่าน/'.$article->category->slug.'/'.$article->slug)}}">{{$article->article}}</a>
              @endforeach
            </div>
          </li>
          @endforeach
          @endisset
          @isset ($navbar_departments)
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle navbar-menu" href="#" id="department" role="button"
              data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              กลุ่มบริหารงาน
            </a>
            <div class="dropdown-menu" aria-labelledby="department">
              @foreach ($navbar_departments as $department)
              <a class="dropdown-item" href="{{url('กลุ่มบริหารงาน/'.$department->slug)}}">{{str_after($department->department,
                'กลุ่มบริหารงาน')}}</a>
              @endforeach
            </div>
          </li>
          @endisset

          @isset ($navbar_courses)
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle navbar-menu" href="#" id="course" role="button" data-toggle="dropdown"
              aria-haspopup="true" aria-expanded="false">
              กลุ่มสาระการเรียนรู้
            </a>
            <div class="dropdown-menu" aria-labelledby="course">
              @foreach ($navbar_courses as $course)
              <a class="dropdown-item" href="{{url('กลุ่มสาระการเรียนรู้/'.$course->slug)}}">{{str_after($course->course,
                'กลุ่มสาระการเรียนรู้')}}</a>
              @endforeach
            </div>
          </li>
          @endisset
          @isset ($navbar_galleries)
          <li class="nav-item">
            <a class="nav-link navbar-menu" href="{{ url('ภาพกิจกรรมทั้งหมด')}}">ภาพกิจกรรม</a>
          </li>
          @endisset
          @isset ($navbar_documents)
          <li class="nav-item">
            <a class="nav-link navbar-menu" href="{{ url('ไฟล์เอกสารทั้งหมด/')}}">ดาวน์โหลด</a>
          </li>
          @endisset
          <li class="nav-item">
            <a class="nav-link navbar-menu" href="{{ url('ติดต่อเรา/')}}">ติดต่อเรา</a>
          </li>
          @guest
          <form class="form-inline d-md-none d-flex justify-content-between">
            <a class="btn btn-outline-secondary btn-sm mr-1 mb-1" role="button"
              href="https://sgs6.bopp-obec.info/sgss/security/signin.aspx" target="_blank"><i
                class="fas fa-chart-area"></i>
              ผลการเรียน</a>
            <a class="btn btn-outline-secondary btn-sm mr-1 mb-1" role="button"
              href="https://sgs3.bopp-obec.info/sgs/Security/SignIn.aspx" target="_blank"><i
                class="fas fa-chart-bar"></i>
              ทะเบียน-วัดผล</a>
            <a class="btn btn-outline-secondary btn-sm mr-1 mb-1" role="button" href="{{ route('login') }}"><i
                class="fas fa-sign-in-alt"></i>
              ผู้ดูแลระบบ</a>
          </form>
          @else
          @auth
          <form class="form-inline d-md-none d-flex justify-content-between">
            <a class="btn btn-outline-secondary btn-sm mr-1 mb-1" role="button"
              href="https://sgs6.bopp-obec.info/sgss/security/signin.aspx" target="_blank"><i
                class="fas fa-chart-area"></i>
              ผลการเรียน</a>
            <a class="btn btn-outline-secondary btn-sm mr-1 mb-1" role="button"
              href="https://sgs3.bopp-obec.info/sgs/Security/SignIn.aspx" target="_blank"><i
                class="fas fa-chart-bar"></i>
              ทะเบียน-วัดผล</a>
            @role('admin|officer')
            <a class="btn btn-outline-secondary btn-sm mr-1 mb-1" role="button" href="{{ route('dashboard') }}"><i
                class="fas fa-cog"></i>
              การจัดการ</a>
            @endrole
            @if (!Auth::user()->hasVerifiedEmail())
            <button class="btn btn-link btn-sm text-secondary" type="button" disabled>
              <i class="fas fa-exclamation-circle"></i> กรุณาตรวจสอบอีเมล์ของคุณ เพื่อยืนยันอีเมล์ในการเข้าสู่ระบบ!
            </button>
            @elseif(!Auth::user()->hasRole(['admin', 'officer']))
            <button class="btn btn-link btn-sm text-secondary" type="button" disabled>
              <i class="fas fa-exclamation-circle"></i> คุณไม่มีสิทธิเข้าใช้ระบบจัดการเว็บไซต์ โปรดติดต่อผู้ดูแลระบบ!
            </button>
            @endif
            <a class="btn btn-outline-secondary btn-sm mr-1 mb-1" role="button" href="{{ route('logout') }}"
              onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i
                class="fas fa-sign-out-alt"></i> ออกจากระบบ</a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              {{ csrf_field() }}
            </form>
          </form>
          @endauth
          @endguest
        </ul>
      </div>
    </div>
  </nav>
  <a class="scroll-to-top" href="#" style="display: inline;">
    <i class="fas fa-arrow-up"></i>
  </a>
  @yield('content')

  <footer class="sticky-bottomUp">
    @if (Request::is('/'))
    <div class="footer wow fadeIn">
      <div class="container">
        <div class="row justify-content-between">
          <div class="col-md-2 text-center d-none d-sm-block">
            <img src="{{asset('images/logo.png')}}" class="img-fluid px-3" alt="">
            <div class="my-2">
              <ul class="list-inline text-light">
                <li class="list-inline-item">เรียนดี</li>
                <li class="list-inline-item">กีฬาเด่น</li>
              </ul>
              <ul class="list-inline text-light">
                <li class="list-inline-item">เน้นคุณธรรม</li>
                <li class="list-inline-item">นำชุมชน</li>
              </ul>
            </div>
          </div>
          <div class="col-md-4">
            <div class="footer_item">
              <ul>
                <li>โรงเรียนปางศิลาทองศึกษา สังกัดเขตพื้นที่การศึกษา สพม. 41</li>
                <li>เลขที่ 107 หมู่ที่ 17 บ้านมอแสงทอง ตำบลโพธิ์ทอง<br>อำเภอปางศิลาทอง จังหวัดกำแพงเพชร 62120</li>
                <li>โทรศัพท์ 055-868884 โทรสาร 055-868886</li>
                <li>อีเมล์ pangschool@hotmail.com เว็บไซต์ www.pslt.ac.th</li>
                <li>
                  จำนวนผู้เข้าชมเว็บไซต์
                  <a class="text-light" href="#" data-toggle="modal" data-target="#visitor"> {{$visitors}} <i
                      class="fas fa-chart-bar"></i></a>
                </li>
                <li>
                  <a href="https://www.facebook.com/Pangsilathongsuksa-School-147507345343192/"
                    class="social fab fa-facebook"> </a>
                  <a href="https://www.youtube.com/channel/UCCiYXyhYYq3mXpPCKvZUhdQ/featured"
                    class="social fab fa-youtube"> </a>
                  <a href="{{ url('/rss')}}" class="social fas fa-rss"> </a>
              </ul>
              </li>
              </ul>
            </div>
          </div>
          <div class="col-md-6">
            <div class="footer_item">
              <div class="embed-responsive embed-responsive-21by9">
                <div class="embed-responsive-item" id="map"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    @endif
    <div class="copyright">
      <div class="container text-center">
        <div>© สงวนลิขสิทธิ์ 2562 โรงเรียนปางศิลาทองศึกษา.
          <a class="text-danger" href="#" data-toggle="modal" data-target="#readme"><i
              class="fas fa-feather-alt"></i></a>
          </a>
        </div>
      </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="visitor" tabindex="-1" role="dialog" aria-labelledby="visitorLabel" aria-hidden="true">
      <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
          <div class="modal-body">
            <h1 class="text-center">สถิติผู้เข้าชมเว็บไซต์</h1>
            <table class="table">
              <tbody>
                <tr>
                  <td>สถิติวันนี้</td>
                  <td>{{$visitor_in_day}}</td>
                </tr>
                <tr>
                  <td>สถิติเมื่อวานนี้</td>
                  <td>{{$visitor_last_day}}</td>
                </tr>
                <tr>
                  <td>สถิติเดือนนี้</td>
                  <td>{{$visitor_in_month}}</td>
                </tr>
                <tr>
                  <td>สถิติเดือนที่แล้ว</td>
                  <td>{{$visitor_last_month}}</td>
                </tr>
                <tr>
                  <td>สถิติปีนี้</td>
                  <td>{{$visitor_in_year}}</td>
                </tr>
                <tr>
                  <td>สถิติปีที่แล้ว</td>
                  <td>{{$visitor_last_year}}</td>
                </tr>
                <tr>
                  <td>สถิติทั้งหมด</td>
                  <td>{{$visitors}}</td>
                </tr>
              </tbody>
            </table>
            <div class="text-center">
              <p>ไอพีของคุณคือ {{$ip_address}}</p>
              <small>(เริ่มนับวันที่ 21/06/2562)</small>
            </div>
          </div>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
        </div>
      </div>
    </div>

    <!-- Modal -->
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
              ได้เล็งเห็นความสำคัญของการนำเทคโนโลยีมาใช้ในการเผยแพร่ข้อมูลประชาสัมพันธ์
              และการดำเนินงานด้านสารสนเทศของโรงเรียนให้มีประสิทธิภาพมากขึ้น
              โดยในการพัฒนาเว็บไซต์ผู้จัดทำได้พัฒนาด้วยภาษา PHP ขับเคลื่อนโดย Laravel 
              และระบบฐานข้อมูล MySQL เพื่อให้เว็บไซต์มีประสิทธิภาพต่อผู้ใช้งานมากที่สุด
            </p>
            <p>โดยการพัฒนาระบบในครั้งนี้ จัดทำขึ้นเพื่อทดแทนระบบเว็บไซต์เก่า
              โดยปรับปรุงให้มีความเหมาะสมกับการดำเนินงานของโรงเรียน
              พร้อมทั้งมีความปลอดภัยด้านข้อมูลด้วยการกำหนดสิทธิการแก้ไขข้อมูลจากผู้ที่เกี่ยวข้องโดยตรง
              เพื่ออำนวยความสะดวกในการนำเสนอข้อมูลต่างๆ สามารถเผยแพร่ข้อมูล
              ประชาสัมพันธ์สู่กลุ่มเป้าหมายได้อย่างถูกต้อง อ่านง่ายสบายตา
              เป็นมาตรฐานเดียวกันและเชื่อมโยงข้อมูลไปยังเป้าหมายได้ตรงกับความต้องการ มีความทันสมัยมากขึ้น
              โดยการจัดทำครั้งนี้ไม่มีค่าใช้จ่ายใดๆ เป็นความเต็มใจของผู้จัดทำ
              ที่อยากจะเห็นโรงเรียนของเรามีความเจริญก้าวหน้า เป็นโรงเรียนที่ดีมีคุณภาพ</p>
            <p>"คิดและเขียนคือสิ่งที่ผมชอบ
              แบ่งปันคือสิ่งที่ผมรัก" เพราะไม่ใช่มีแค่ผมคนเดียวที่อยากเห็นโรงเรียนของเราพัฒนา... </p>
            <blockquote class="blockquote text-right">
              <p class="mb-0">ผู้พัฒนาระบบ</p>
              <footer class="blockquote-footer">นายประทีป อุ่นอก</br><small><a
                    href='https://www.facebook.com/prateep.aunaok' target='_blank'><span class='
                          fa-stack' style='vertical-align: top;'>
                      <i class='fas fa-circle fa-stack-2x'></i>
                      <i class='fab fa-facebook-f fa-stack-1x fa-inverse'></i>
                    </span></a> <a href='https://github.com/prateep-story' target='_blank'><span class='fa-stack'
                      style='vertical-align: top;'>
                      <i class='fas fa-circle fa-stack-2x'></i>
                      <i class='fab fa-github-alt fa-stack-1x fa-inverse'></i>
                    </span></a> <a href='https://twitter.com/prateep_aunaok' target='_blank'><span class='fa-stack'
                      style='vertical-align: top;'>
                      <i class='fas fa-circle fa-stack-2x'></i>
                      <i class='fab fa-twitter fa-stack-1x fa-inverse'></i>
                    </span></a>
                  </span></a> <a href='tel:+66853469543' data-container="body" data-toggle="popover"
                    data-placement="right" data-content="085-346-9543"><span class='fa-stack'
                      style='vertical-align: top;'>
                      <i class='fas fa-circle fa-stack-2x'></i>
                      <i class='fas fa-phone fa-stack-1x fa-inverse'></i>
                    </span></a>
                </small></footer>
            </blockquote>
          </div>
        </div>
      </div>
    </div>
  </footer>
  @include('cdn-library/jquery/script')
  @include('cdn-library/bootstrap/script')
  @include('cdn-library/animate/script')
  @include('cdn-library/moment/script')
  <script src="{{ asset('js/front-end/script.min.js')}}"></script>
  @stack('script')
</body>

</html>