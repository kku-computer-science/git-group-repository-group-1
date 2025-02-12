<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1 ">
    <title>@yield('title')</title>
    <base href="{{ \URL::to('/') }}">

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
        <!-- Font Awesome Icons -->
  
<
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{asset('vendors/feather/feather.css')}}">
    <link rel="stylesheet" href="{{asset('vendors/mdi/css/materialdesignicons.min.css')}}">
    <link rel="stylesheet" href="{{asset('vendors/ti-icons/css/themify-icons.css')}}">
    <link rel="stylesheet" href="{{asset('vendors/typicons/typicons.css')}}">
    <link rel="stylesheet" href="{{asset('vendors/simple-line-icons/css/simple-line-icons.css')}}">
    <link rel="stylesheet" href="{{asset('vendors/css/vendor.bundle.base.css')}}">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="{{asset('vendors/datatables.net-bs4/dataTables.bootstrap4.css')}}">
    <link rel="stylesheet" href="{{asset('js/select.dataTables.min.css')}}">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="{{asset('css/styleadmin.css')}}">
    <!-- endinject -->
    <!-- <link rel="shortcut icon" href="images/favicon.png" /> -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
   <link rel="stylesheet" href="{{ asset('plugins/ijaboCropTool/ijaboCropTool.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
</head>

<body>
    <div class="container-scroller">

        <!-- navbar ข้างบน -->
      <nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex align-items-top flex-row">
          <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-start">
                <div class="me-3">
                    <button class="navbar-toggler navbar-toggler align-self-center" type="button"
                        data-bs-toggle="minimize">
                        <span class="icon-menu"></span>
                    </button>
                </div>
                <!-- <div>
                    <a class="navbar-brand brand-logo" href="index.html">
                        <img src="{{asset('img/logo.png')}}" alt="logo" />
                    </a>
                </div> -->
            </div>

                <!-- Left navbar links -->
                <div class="navbar-menu-wrapper d-flex align-items-top">
                    <ul class="navbar-nav">
                        <li class="nav-item font-weight-semibold d-none d-lg-block ms-0">
                            <h1 class="welcome-text">Hello, <span class="text-black fw-bold">{{ Auth::user()->fname }} {{ Auth::user()->lname }}</span></h1>
                            <h3 class="welcome-sub-text">Have a good day. </h3>
                        </li>
                    </ul>
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item d-none d-lg-block">
                            <div id="datepicker-popup" class="input-group date datepicker navbar-date-picker">
                                <span class="input-group-addon input-group-prepend border-right">
                                    <span class="icon-calendar input-group-text calendar-icon"></span>
                                </span>
                                <input type="text" class="form-control">
                            </div>
                        </li>
                        <li class="nav-item">
                            <form class="search-form" action="#">
                                <i class="icon-search"></i>
                                <input type="search" class="form-control" placeholder="Search Here" title="Search here">
                            </form>
                        </li>
                        <li class="nav-item dropdown">
                        <a class="nav-link count-indicator" id="countDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="icon-bell"></i>
                            <span class="count"></span>
                        </a>   
                        </li>
                        <li class="nav-item dropdown d-none d-lg-block user-dropdown">
                            <a class="nav-link" id="UserDropdown" href="#" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                <img class="img-xs rounded-circle" src="images/faces/face8.jpg" alt="Profile image">
                            </a>
                            <div class="dropdown-menu dropdown-menu-right navbar-dropdown"
                                aria-labelledby="UserDropdown">
                                <div class="dropdown-header text-center">
                                    <img class="img-md rounded-circle" src="{{ Auth::user()->picture }}"
                                        alt="Profile image">
                                    <p class="mb-1 mt-3 font-weight-semibold">{{ Auth::user()->name }}</p>
                                    <p class="fw-light text-muted mb-0"></p>
                                </div>
                                <a class="dropdown-item"><i
                                        class="dropdown-item-icon mdi mdi-account-outline text-primary me-2"></i> My
                                    Profile <span class="badge badge-pill badge-danger">1</span></a>
                                <a class="dropdown-item"><i
                                        class="dropdown-item-icon mdi mdi-message-text-outline text-primary me-2"></i>
                                    Messages</a>
                                <a class="dropdown-item"><i
                                        class="dropdown-item-icon mdi mdi-calendar-check-outline text-primary me-2"></i>
                                    Activity</a>
                                <a class="dropdown-item"><i
                                        class="dropdown-item-icon mdi mdi-help-circle-outline text-primary me-2"></i>
                                    FAQ</a>
                                <a class="dropdown-item"><i
                                        class="dropdown-item-icon mdi mdi-power text-primary me-2"></i>Sign Out</a>
                        <li class="nav-item d-none d-sm-inline-block">
                            <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault(); 
                                document.getElementById ('logout-form').submit();"> {{ __('Logout') }}</a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </li>
                </div>
                </li>
                </ul>
                <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
                    data-bs-toggle="offcanvas">
                    <span class="mdi mdi-menu"></span>
                </button>
    </div>
    </nav>
    <!-- navbar ข้างบน -->
    <div class="container-fluid page-body-wrapper">
        <!-- Main Sidebar Container -->
        <!-- <div class="theme-setting-wrapper">
                <div id="settings-trigger"><i class="mdi mdi-home"></i></div>
            </div> -->
        <nav class="sidebar sidebar-offcanvas" id="sidebar">
            <ul class="nav">
                <li class="nav-item">
                    <a class="nav-link {{ (request()->is('dashboard*')) ? 'active' : '' }}"
                        href="{{ route('dashboard')}}">
                        <i class="mdi mdi-grid-large menu-icon"></i>
                        <span class="menu-title">Dashboard</span>
                    </a>
                </li>
                <li class="nav-item nav-category">Profile</li>
                <li class="nav-item">
                    <a class="nav-link {{ (request()->is('admin/profile*')) ? 'active' : '' }}"
                        href="{{ route('profile')}}">
                        <i class="menu-icon mdi mdi-account-circle-outline"></i>
                        <span class="menu-title">User Profile</span>
                        
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ (request()->is('admin/settings*')) ? 'active' : '' }}"
                        href="{{ route('settings')}}">
                        <i class="menu-icon mdi mdi mdi-settings-outline"></i>
                        <span class="menu-title">Settings</span>
                        
                    </a>
                </li>
                <li class="nav-item nav-category">Option</li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('funds.index')}}">
                        <i class="menu-icon mdi mdi-file-document-box-outline"></i>
                        <span class="menu-title">Manage Fund</span>
                        <!-- <i class="menu-arrow"></i> -->
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('researchProjects.index')}}">
                        <i class="menu-icon mdi mdi-book-outline"></i>
                        <span class="menu-title">Research Project</span>
                        
                    </a>
                </li>
                @can('user-list')
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('users.index')}}">
                        <i class="menu-icon mdi mdi-account-multiple-outline"></i>
                        <span class="menu-title">Users</span>
                        
                    </a>
                </li>
                @endcan
                @can('role-list')
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('roles.index')}}">
                        <i class="menu-icon mdi mdi-chart-gantt"></i>
                        <span class="menu-title">Roles</span>
                        
                    </a>
                </li>
                @endcan
                @can('permission-list')
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('permissions.index')}}">
                        <i class="menu-icon mdi mdi-checkbox-marked-circle-outline"></i>
                        <span class="menu-title">Permission</span>
                        
                    </a>
                </li>
                @endcan
                @can('departments-list')
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('departments.index')}}">
                        <i class="menu-icon mdi mdi-animation-outline"></i>
                        <span class="menu-title">Departments</span>
                        
                    </a>
                </li>
                @endcan
                @can('groups-list')
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('researchGroups.index')}}">
                        <i class="menu-icon mdi mdi-view-dashboard-outline"></i>
                        <span class="menu-title">Research Group</span>
                        
                    </a>
                </li>
                @endcan
                @can('papers-list')
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('papers.index')}}">
                        <i class="menu-icon mdi mdi-book-open-page-variant"></i>
                        <span class="menu-title">Manage Paper</span>
                        
                    </a>
                </li>
                @endcan
            </ul>
        </nav>

        <!-- Content Wrapper. Contains page content -->
        <div class="main-panel">
            <div class="content-wrapper">
                @yield('content')
            </div>
            <footer class="footer">
                <div class="d-sm-flex justify-content-center justify-content-sm-between">
                    <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Premium <a
                            href="https://www.bootstrapdash.com/" target="_blank">Bootstrap admin template</a> from
                        BootstrapDash.</span>
                    <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Copyright © 2021. All
                        rights
                        reserved.</span>
                </div>
            </footer>
        </div>

    </div>
    </div>
    

    <!-- plugins:js -->
    <script src="{{asset('vendors/js/vendor.bundle.base.js')}}"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="{{asset('vendors/chart.js/Chart.min.js')}}"></script>
    <script src="{{asset('vendors/bootstrap-datepicker/bootstrap-datepicker.min.js')}}"></script>
    <script src="{{asset('vendors/progressbar.js/progressbar.min.js')}}"></script>

    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="{{asset('js/off-canvas.js')}}"></script>
    <script src="{{asset('js/hoverable-collapse.js')}}"></script>
    <script src="{{asset('js/template.js')}}"></script>
    <script src="{{asset('js/settings.js')}}"></script>
    <script src="{{asset('js/todolist.js')}}"></script>
    <!-- endinject -->
    <!-- Custom js for this page-->
    <script src="{{asset('js/dashboard.js')}}"></script>
    <script src="{{asset('js/Chart.roundedBarCharts.js')}}"></script>
    <!-- End custom js for this page-->
    <!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('plugins/ijaboCropTool/ijaboCropTool.min.js') }}"></script>
    @yield('javascript')


</body>

{{-- CUSTOM JS CODES --}}
<script>
$(function() {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(function() {

        /* UPDATE ADMIN PERSONAL INFO */

        $('#AdminInfoForm').on('submit', function(e) {
            e.preventDefault();

            $.ajax({
                url: $(this).attr('action'),
                method: $(this).attr('method'),
                data: new FormData(this),
                processData: false,
                dataType: 'json',
                contentType: false,
                beforeSend: function() {
                    $(document).find('span.error-text').text('');
                },
                success: function(data) {
                    if (data.status == 0) {
                        $.each(data.error, function(prefix, val) {
                            $('span.' + prefix + '_error').text(val[0]);
                        });
                    } else {
                        $('.admin_name').each(function() {
                            $(this).html($('#AdminInfoForm').find($(
                                'input[name="name"]')).val());
                        });
                        alert(data.msg);
                    }
                }
            });
        });



        $(document).on('click', '#change_picture_btn', function() {
            $('#admin_image').click();
        });


        $('#admin_image').ijaboCropTool({
            preview: '.admin_picture',
            setRatio: 1,
            allowedExtensions: ['jpg', 'jpeg', 'png'],
            buttonsText: ['CROP', 'QUIT'],
            buttonsColor: ['#30bf7d', '#ee5155', -15],
            processUrl: '{{ route("adminPictureUpdate") }}',
            // withCSRF:['_token','{{ csrf_token() }}'],
            onSuccess: function(message, element, status) {
                alert(message);
            },
            onError: function(message, element, status) {
                alert(message);
            }
        });


        $('#changePasswordAdminForm').on('submit', function(e) {
            e.preventDefault();

            $.ajax({
                url: $(this).attr('action'),
                method: $(this).attr('method'),
                data: new FormData(this),
                processData: false,
                dataType: 'json',
                contentType: false,
                beforeSend: function() {
                    $(document).find('span.error-text').text('');
                },
                success: function(data) {
                    if (data.status == 0) {
                        $.each(data.error, function(prefix, val) {
                            $('span.' + prefix + '_error').text(val[0]);
                        });
                    } else {
                        $('#changePasswordAdminForm')[0].reset();
                        alert(data.msg);
                    }
                }
            });
        });


    });
});
</script>


</html>