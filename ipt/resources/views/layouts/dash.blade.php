<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>{{ config('app.name', 'Laravel') }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" integrity="sha384-gfdkjb5BdAXd+lj+gudLWI+BXq4IuLW5IT+brZEZsLFm++aCMlF1V92rMkPaX4PP" crossorigin="anonymous">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('/public/assets/dist/css/adminlte.min.css') }}">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{ asset('/public/assets/plugins/iCheck/flat/blue.css') }}">
  <!-- Morris chart -->
  <link rel="stylesheet" href="{{ asset('/public/assets/plugins/morris/morris.css') }}">
  <!-- jvectormap -->
  <link rel="stylesheet" href="{{ asset('/public/assets/plugins/jvectormap/jquery-jvectormap-1.2.2.css') }}">
  <!-- Date Picker -->
  <link rel="stylesheet" href="{{ asset('/public/assets/plugins/datepicker/datepicker3.css') }}">
  <!-- Ion Slider -->
  <link rel="stylesheet" href="{{ asset('/public/assets/plugins/ionslider/ion.rangeSlider.css') }}">
  <!-- ion slider Nice -->
  <link rel="stylesheet" href="{{ asset('/public/assets/plugins/ionslider/ion.rangeSlider.skinNice.css') }}">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{ asset('/public/assets/plugins/daterangepicker/daterangepicker-bs3.css') }}">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="{{ asset('/public/assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') }}">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Dosis|Raleway" rel="stylesheet">
  <!-- Css Validation -->

{{-- toaster style --}}
  @toastr_css

  <style>

    body{

      font-family: 'Dosis', sans-serif;
      font-family: 'Raleway', sans-serif;

    }

  </style>

  @yield('css')

</head>

@auth
  @php
    $name = Auth::user()->name;
    $img = Auth::user()->img;
    $phone = Auth::user()->phone;
 
 // Store user info to the session
    session(['user_name' => $name]);
    session(['user_img' => $img]);
    session(['user_phone' => $phone])

  @endphp

<body class="hold-transition sidebar-mini">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-light border-bottom" style="background-color: #8CAEC7;">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fa fa-bars"></i></a>
      </li>
{{--       <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link active">Home</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Contact</a>
      </li> --}}
    </ul>

    <!-- SEARCH FORM -->
    <form class="form-inline ml-auto">
      <div class="input-group input-group-sm">
        <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-navbar" type="submit">
            <i class="fa fa-search"></i>
          </button>
        </div>
      </div>
    </form>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-light-info elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('home') }}" class="brand-link">
      <img src="{{ asset('/public/img/mbeya_logo.jpg') }}" alt="AdminLTE Logo" class="brand-image" style="opacity: .9; box-shadow: none;">
      <span class="brand-text font-weight-dark">IPT-M System</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ asset('/public/img/'. session('user_img')) }}" class="img-circle elevation-2" alt="Image">
        </div>
        <div class="info">
          <a href="#" class="d-block"> {{ Auth::user()->name }} </a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          @php
            $segment = Request::segment(2);
            
            if (!isset($segment3)) {
              
              $segment3 = Request::segment(3);
            
            }
          @endphp
          
          <li class="nav-item">
            <a href="{{ route('home') }}" class="nav-link 
              @if(!$segment)
              active
              @endif
              ">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>

          @role('admin')
          <li class="nav-item">
            <a href="{{ route('user') }}" class="nav-link 
              @if($segment == 'user')
              active
              @endif
              ">
              <i class="nav-icon fas fa-user"></i>
              <p>
                User
              </p>
            </a>
          </li>
          @endrole

          @hasanyrole('admin|student')
          <li class="nav-item has-treeview @if($segment == 'location' || $segment == 'vacancy') menu-open @endif ">
            <a href="#" class="nav-link @if($segment == 'location' || $segment == 'vacancy') active @endif ">
              <i class="nav-icon fas fa-map-marker-alt"></i>
              <p>
                Placement
                <i class="right fa fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              @role('student')
              <li class="nav-item">
                <a href="{{ route('student.loc') }}" class="nav-link">
                  <i class="far fa-eye nav-icon"></i>
                  <p>View</p>
                </a>
              </li>
              @endrole
              @role('admin')
              <li class="nav-item">
                <a href="{{ route('location.index') }}" class="nav-link">
                  <i class="far fa-eye nav-icon"></i>
                  <p>View</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('location.create') }}" class="nav-link">
                  <i class="far fa-plus-square nav-icon"></i>
                  <p>Add</p>
                </a
              </li>
              @endrole
            </ul>
          </li>
          @endhasanyrole

         @hasanyrole('admin|supervisor')
          <li class="nav-item has-treeview @if($segment == 'supervision') menu-open @endif">
            <a href="#" class="nav-link @if($segment == 'supervision') active @endif ">
              <i class="nav-icon fas fa-user-check"></i>
              <p>
                Supervision
                <i class="right fa fa-angle-left"></i>
              </p>
            </a>
            @role('admin')
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('admin.students') }}" class="nav-link">
                  <i class="fas fa-user-graduate nav-icon"></i>
                  <p>students</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('admin.supers') }}" class="nav-link">
                  <i class="fas fa-user-tie nav-icon"></i>
                  <p>Supervisors</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('admin.assign.view') }}" class="nav-link">
                  <i class="far fa-edit nav-icon"></i>
                  <p>Assign</p>
                </a>
              </li>
            </ul>
            @endrole
            @role('supervisor')
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('super.student_list') }}" class="nav-link">
                  <i class="fas fa-user-graduate nav-icon"></i>
                  <p>Students</p>
                </a>
              </li>
            </ul>
            @endrole
          </li>

          @endhasanyrole

          @role('admin')

          <li class="nav-item has-treeview @if($segment == 'info') menu-open @endif">
            <a href="#" class="nav-link @if($segment == 'info') active @endif ">
              <i class="nav-icon fas fa-newspaper"></i>
              <p>
                News
                <i class="right fa fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('info.index') }}" class="nav-link">
                  <i class="far fa-eye nav-icon"></i>
                  <p>View</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('info.create') }}" class="nav-link">
                  <i class="far fa-paper-plane nav-icon"></i>
                  <p>Post</p>
                </a>
              </li>
            </ul>
          </li>

          @endrole

          @role('marker')

          <li class="nav-item has-treeview @if($segment == 'students') menu-open @endif">
            <a href="#" class="nav-link @if($segment == 'students') active @endif ">
              <i class="nav-icon fas fa-user-graduate"></i>
              <p>
                Students
                <i class="right fa fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('logbook.show') }}" class="nav-link">
                  <i class="far fa-file-alt nav-icon"></i>
                  <p>Logbooks</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('student.list') }}" class="nav-link">
                  <i class="fas fa-chart-line nav-icon"></i>
                  <p>Performance</p>
                </a>
              </li>
            </ul>
          </li>

          @endrole

          @role('student')

          <li class="nav-item has-treeview @if($segment == 'submission') menu-open @endif">
            <a href="#" class="nav-link @if($segment == 'submission') active @endif ">
              <i class="nav-icon far fa-check-square"></i>
              <p>
                Submission
                <i class="right fa fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('sub.arrival') }}" class="nav-link">
                  <i class="fas fa-map-marked-alt nav-icon"></i>
                  <p>Arrival Note</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('logbook.index') }}" class="nav-link">
                  <i class="far fa-file-alt nav-icon"></i>
                  <p>Logbook and Report</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('logbook.report') }}" class="nav-link">
                  <i class="fas fa-table nav-icon"></i>
                  <p>Submission Report</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item">
            <a href="{{ route('news.show') }}" class="nav-link 
              @if($segment == 'news')
              active
              @endif
              ">
              <i class="nav-icon far fa-newspaper"></i>
              <p>
                News
              </p>
            </a>
          </li>

          @endrole
          
          {{-- <li class="nav-header">ACTION</li> --}}
          <li class="nav-item">
            <a class="nav-link" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        
                                    

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
              <i class="nav-icon fas fa-sign-out-alt"></i>
              <p class="text">{{ __('Logout') }}</p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            <h1 class="m-0 text-dark">{{ title_case($segment3) }}</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                <li class="breadcrumb-item active">{{ title_case($segment) }}</li>
            </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <section class="content">
        
        <div class="row justify-content-center">
            @yield('content')
        </div>
    
    </section>
  
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <strong>Copyright &copy; 2018
    <div class="float-right d-none d-sm-inline-block">
      <b>Designed and Developed By</b> Mohamed and Martha
    </div>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->
</body>
@endauth

<!-- jQuery -->
<script
  src="https://code.jquery.com/jquery-3.3.1.min.js"
  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
  crossorigin="anonymous"></script>
<!-- jQuery UI 1.11.4 -->
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="{{ asset('/public/assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- Morris.js charts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="{{ asset('/public/assets/plugins/morris/morris.min.js') }}"></script>
<!-- Sparkline -->
<script src="{{ asset('/public/assets/plugins/sparkline/jquery.sparkline.min.js') }}"></script>
<!-- jQuery Knob Chart -->
<script src="{{ asset('/public/assets/plugins/knob/jquery.knob.js') }}"></script>
<!-- daterangepicker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js"></script>
<script src="{{ asset('/public/assets/plugins/daterangepicker/daterangepicker.js') }}"></script>
<!-- datepicker -->
<script src="{{ asset('/public/assets/plugins/datepicker/bootstrap-datepicker.js') }}"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="{{ asset('/public/assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') }}"></script>
<!-- Slimscroll -->
<script src="{{ asset('/public/assets/plugins/slimScroll/jquery.slimscroll.min.js') }}"></script>
<!-- FastClick -->
<script src="{{ asset('/public/assets/plugins/fastclick/fastclick.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('/public/assets/dist/js/adminlte.js') }}"></script>
 @yield('script')

@toastr_js
@toastr_render
</html>
