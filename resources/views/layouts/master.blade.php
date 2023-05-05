<?php 
$setting = App\Models\Setting::latest()->first();
?>
<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  @if ($setting != null )

  <title>{{$setting->site_name.' Dashboard' ?? 'Value Games - Dashboard'}}</title>
  @else
  <title>Site Name Empty</title>
  @endif
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('admin/assets/plugins/font-awesome/css/font-awesome.min.css')}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="{{asset('admin/assets/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('admin/assets/dist/css/adminlte.min.css')}}">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{asset('admin/assets/plugins/daterangepicker/daterangepicker-bs3.css')}}">

  <!-- <link rel="stylesheet" type="text/css" href="/css/material.min.css"> -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">
  <link href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css" rel="stylesheet">
  <script src="https://cdn.ckeditor.com/4.21.0/standard/ckeditor.js"></script>
</head>
@yield('additional_styles')
</head>

<body class="hold-transition sidebar-mini">
  <div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand bg-white navbar-light border-bottom">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#"><i class="fa fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
          <a href="/admin/home" class="nav-link">Home</a>
        </li>
        <!-- <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Contact</a>
      </li> -->
      </ul>

      <!-- SEARCH FORM -->
      <form class="form-inline ml-3">
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
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="/admin/home" class="brand-link">
        @if ($setting != null && $setting->site_logi!=null )
        <img src="{{asset('storage/settings/logo/'.$setting->site_logo)}}" alt="VP Game" class="brand-image elevation-3"
          style="opacity: .8">

        @else
        <img src="" alt="VP Game" class="brand-image elevation-3" style="opacity: .8">

        @endif
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
            @if (auth()->check() && auth()->user()->image)
            <img src="{{asset('storage/profile/'.auth()->user()->image)}}" alt="VP Game" class="brand-image elevation-3"
              style="opacity: .8">
    
            @else
            <img src="{{asset('storage/images/profile.png')}}" class="img-circle elevation-2" >
    
            @endif
          </div>
          <div class="info">
            <a href="#" class="d-block">Simon Angatia</a>
          </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
              @if (auth()->check() && auth()->user()->is_admin)
              <li class="nav-item has-treeview">
                <a href="#" class="nav-link">
                  <i class="nav-icon fa fa-cog"></i>
                  <p>
                    Settings
                    <i class="right fa fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="{{route('settings.update.form')}}" class="nav-link">
                      <i class="fa fa-circle-o nav-icon"></i>
                      <p>General Settings</p>
                    </a>
                  </li>
                </ul>
              </li>
              <li class="nav-item has-treeview">
                <a href="#" class="nav-link">
                  <i class="nav-icon fa fa-list"></i>
                  <p>
                    Category
                    <i class="right fa fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="{{route('admin.categories')}}" class="nav-link">
                      <i class="fa fa-circle-o nav-icon"></i>
                      <p>Category</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{route('admin.category.create.form')}}" class="nav-link">
                      <i class="fa fa-circle-o nav-icon"></i>
                      <p>Add Category</p>
                    </a>
                  </li>
                </ul>
              </li>
              @endif
             
            
        
            <li class="nav-item has-treeview">
              <a href="#" class="nav-link">
                <i class="fa-solid fa fa-newspaper-o"></i>
                <p>
                  News
                  <i class="right fa fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
               <li class="nav-item">
                  <a href="{{route('admin.posts')}}" class="nav-link">
                    <i class="fa fa-circle-o nav-icon"></i>
                    <p>News</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{route('admin.post.create.form')}}" class="nav-link">
                    <i class="fa fa-circle-o nav-icon"></i>
                    <p>Create A Post</p>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item has-treeview">
              <a href="#" class="nav-link">
                <i class="nav-icon fa fa-video-camera"></i>
                <p>
                  Videos
                  <i class="right fa fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{route('admin.videos')}}" class="nav-link">
                    <i class="fa fa-circle-o nav-icon"></i>
                    <p>Videos</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{route('admin.video.create.form')}}" class="nav-link">
                    <i class="fa fa-circle-o nav-icon"></i>
                    <p>Add Video</p>
                  </a>
                </li>
              </ul>
            </li>
            @if (auth()->check() && auth()->user()->is_admin )
            <li class="nav-item has-treeview">
              <a href="#" class="nav-link">
                <i class="nav-icon fa fa-calendar-o"></i>
                <p>
                  Event
                  <i class="right fa fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{route('admin.events')}}" class="nav-link">
                    <i class="fa fa-circle-o nav-icon"></i>
                    <p>Events</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{route('admin.event.create.form')}}" class="nav-link">
                    <i class="fa fa-circle-o nav-icon"></i>
                    <p>Create A Event</p>
                  </a>
                </li>
              </ul>
            </li>


            <li class="nav-item">
              <a href="{{route('admin.users')}}" class="nav-link">
                <i class="nav-icon fa fa-user"></i>
                <p>
                  Users
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{route('admin.writer.requests')}}" class="nav-link">
                <i class="nav-icon fa fa-user"></i>
                <p>
                  Writer Requests
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{route('admin.advert.requests')}}" class="nav-link">
                <i class="nav-icon fa fa-newspaper"></i>
                <p>
                  Advertising Requests
                </p>
              </a>
            </li>
            @endif
          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      @yield('content')
    </div>
    <!-- /.content-wrapper -->


    <!-- Main Footer -->
    <footer class="main-footer">
      <!-- To the right -->
      <div class="float-right d-none d-sm-inline">
        @if ($setting != null )
        {{$setting->site_name.' Dashboard' ?? 'Value Games - Dashboard'}}
        @else
        Site Name Empty
        @endif
      </div>
      <!-- Default to the left -->
      <strong>Copyright &copy; {{date('Y')}} <a href="/admin/home"></a>.</strong> All rights reserved.
    </footer>
  </div>
  <!-- ./wrapper -->
  <!-- jQuery -->
  <script src="{{asset('admin/assets/plugins/jquery/jquery.min.js')}}"></script>
  <!-- jQuery UI 1.11.4 -->
  <script src="{{asset('admin/assets/plugins/jQueryUI/jquery-ui.min.js')}}"></script>
  <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
  <script>
    $.widget.bridge('uibutton', $.ui.button)
  </script>
  <!-- Bootstrap 4 -->
  <script src="{{asset('admin/assets/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  <!-- ChartJS -->
  <script src="{{asset('admin/assets/plugins/chart.js/Chart.min.js')}}"></script>
  <script src="{{asset('admin/assets/plugins/daterangepicker/daterangepicker.js')}}"></script>
  <!-- AdminLTE App -->
  <script src="{{asset('admin/assets/dist/js/adminlte.js')}}"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="{{asset('admin/assets/dist/js/demo.js')}}"></script>
  <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
  <script src="{{asset('admin/assets/dist/js/pages/dashboard.js')}}"></script>
  <script src="https://cdn.jsdelivr.net/gh/moment/moment@develop/min/moment-with-locales.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
  <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
  <script>
    CKEDITOR.replace('editor',{
      filebrowserUploadUrl: "{{route('ck.upload',['_token'=>csrf_token()])}}",
      filebrowserUploadMethod : 'form'
  });
  </script>
  @yield('additional_scripts')
</body>

</html>