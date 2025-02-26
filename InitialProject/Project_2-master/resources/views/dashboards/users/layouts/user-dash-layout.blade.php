<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">

<<<<<<< HEAD
=======
<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Dashboard</title>
    <base href="{{ \URL::to('/') }}">
    <link href="img/Newlogo.png" rel="shortcut icon" type="image/x-icon" />
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('plugins/ijaboCropTool/ijaboCropTool.min.css') }}">
    <!-- Theme style -->
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

    <!-- plugins:css -->
    <link rel="stylesheet" href="{{asset('vendors/feather/feather.css')}}">
    <link rel="stylesheet" href="{{asset('vendors/mdi/css/materialdesignicons.min.css')}}">
    <link rel="stylesheet" href="{{asset('vendors/ti-icons/css/themify-icons.css')}}">
    <link rel="stylesheet" href="{{asset('vendors/typicons/typicons.css')}}">
    <link rel="stylesheet" href="{{asset('vendors/simple-line-icons/css/simple-line-icons.css')}}">
    <link rel="stylesheet" href="{{asset('vendors/css/vendor.bundle.base.css')}}">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <!-- <link rel="stylesheet" href="{{asset('vendors/datatables.net-bs4/dataTables.bootstrap4.css')}}"> -->
    <link rel="stylesheet" href="{{asset('js/select.dataTables.min.css')}}">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="{{asset('css/styleadmin.css')}}">

    <!-- endinject -->
    <!-- <link rel="shortcut icon" href="images/favicon.png" /> -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <!-- <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"> </script> -->

    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"> -->
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.1.0/css/flag-icon.min.css" rel="stylesheet">


>>>>>>> main
<!-------------------- ที่ออกแบบใหม่ของแปลภาษา  ------------------------------->
<style>
        .language-switcher {
            display: inline-flex;
            border: 1px solid #c2c2c2;
            border-radius: 20px;
            overflow: hidden;
        }

        .lang-item {
            padding: 6px 12px;
            border: none;
            background: #fff;
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: 14px;
            font-weight: 500;
            color: #a7caef;
        }

        .lang-item.active {
            background: #ffffff;
            color: #436991; 
        }

        .lang-item:hover:not(.active) {
            background: #f8f9fa;
            color: #70b1f7; 
        }

        .lang-item-th {
            border-top-left-radius: 20px;
            border-bottom-left-radius: 20px;
        }

        .lang-item-en {
            border-radius: 0;
        }
        .lang-item-cn {
            border-top-right-radius: 20px;
            border-bottom-right-radius: 20px;
        }
    </style>

<<<<<<< HEAD

<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Dashboard</title>
    <base href="{{ \URL::to('/') }}">
    <link href="img/Newlogo.png" rel="shortcut icon" type="image/x-icon" />
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('plugins/ijaboCropTool/ijaboCropTool.min.css') }}">
    <!-- Theme style -->
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

    <!-- plugins:css -->
    <link rel="stylesheet" href="{{asset('vendors/feather/feather.css')}}">
    <link rel="stylesheet" href="{{asset('vendors/mdi/css/materialdesignicons.min.css')}}">
    <link rel="stylesheet" href="{{asset('vendors/ti-icons/css/themify-icons.css')}}">
    <link rel="stylesheet" href="{{asset('vendors/typicons/typicons.css')}}">
    <link rel="stylesheet" href="{{asset('vendors/simple-line-icons/css/simple-line-icons.css')}}">
    <link rel="stylesheet" href="{{asset('vendors/css/vendor.bundle.base.css')}}">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <!-- <link rel="stylesheet" href="{{asset('vendors/datatables.net-bs4/dataTables.bootstrap4.css')}}"> -->
    <link rel="stylesheet" href="{{asset('js/select.dataTables.min.css')}}">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="{{asset('css/styleadmin.css')}}">

    <!-- endinject -->
    <!-- <link rel="shortcut icon" href="images/favicon.png" /> -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <!-- <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"> </script> -->

    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />
        <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"> -->
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
=======
>>>>>>> main
</head>

<body>
    <div class=" container-scroller sidebar-dark">
<<<<<<< HEAD
        <!-- navbar ข้างบน 
    -->
=======
        <!-- navbar ข้างบน -->
>>>>>>> main
        <nav class=" navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex align-items-top flex-row">
            <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-start">
                <div class="me-3">
                    <button class="navbar-toggler navbar-toggler align-self-center" type="button"
                        data-bs-toggle="minimize">
                        <span class="icon-menu"></span>
                    </button>
                </div>
            </div>
            <!-- {{ Auth::user()->fname }} {{ Auth::user()->lname }} -->
            <!-- Left navbar links -->
            <div class="navbar-menu-wrapper d-flex align-items-top">
                <ul class="navbar-nav">
                    <li class="nav-item font-weight-semibold d-none d-lg-block ms-0">
<<<<<<< HEAD
                        <h1 class="welcome-text">Research Information Management System <span
=======
                        <h1 class="welcome-text">{{ trans('message.titleDashboard') }}<span
>>>>>>> main
                                class="text-black fw-bold"></span></h1>
                        <h3 class="welcome-sub-text"> </h3>
                    </li>
                </ul>
                <ul class="navbar-nav ms-auto">
<<<<<<< HEAD
<!------------------------------------------- แปลภาษา ---------------------------------------------------------------------->
                <li class="nav-item">
=======
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

<!------------------------------------------- แปลภาษา ---------------------------------------------------------------------->
<li class="nav-item">
>>>>>>> main
                    <div class="language-switcher">
                        <button class="lang-item lang-item-44 lang-item-th lang-item-first {{ App::getLocale() == 'th' ? 'active' : '' }}" 
                                onclick="window.location.href='{{ route('langswitch', 'th') }}'">
                            TH
                        </button>
                        <button class="lang-item lang-item-63 lang-item-en current-lang {{ App::getLocale() == 'en' ? 'active' : '' }}" 
                                onclick="window.location.href='{{ route('langswitch', 'en') }}'">
                            EN
                        </button>
                        <button class="lang-item lang-item-64 lang-item-en current-lang {{ App::getLocale() == 'cn' ? 'active' : '' }}" 
                                onclick="window.location.href='{{ route('langswitch', 'cn') }}'">
                            CN
                        </button>
                    </div>
                </li>


<<<<<<< HEAD
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


=======
>>>>>>> main
                    <!-- <li class="nav-item dropdown">
                        <a class="nav-link count-indicator" id="countDropdown" href="#" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <i class="icon-bell"></i>
                            <span class="count"></span>
                        </a>
                    </li> -->
                    <!-- <li class="nav-item dropdown d-none d-lg-block user-dropdown">
                        <a class="nav-link" id="UserDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                            <img class="img-xs rounded-circle" src="{{ Auth::user()->picture }}"
                                alt="User profile picture">
                        </a>
                    </li> -->
                    <!-- <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
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
                                    class="dropdown-item-icon mdi mdi-power text-primary me-2"></i>Sign Out</a> -->
                    <li class="nav-item d-none d-sm-inline-block">
                        <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault(); 
<<<<<<< HEAD
                        document.getElementById ('logout-form').submit();"> {{ __('Logout') }} <i class="mdi mdi-logout"></i></a>
=======
                        document.getElementById ('logout-form').submit();"> {{ trans('message.logout') }} <i class="mdi mdi-logout"></i></a>
>>>>>>> main
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>
            </div>
            </ul>
            <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
                data-bs-toggle="offcanvas">
                <span class="mdi mdi-menu"></span>
            </button>

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
                            <i class="menu-icon mdi mdi-grid-large"></i>
<<<<<<< HEAD
                            <span class="menu-title">Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-item nav-category">Profile</li>
=======
                            <span class="menu-title">{{ trans('message.dashboard') }}</span>
                        </a>
                    </li>
                    <li class="nav-item nav-category">{{ trans('message.profile') }}</li>
>>>>>>> main
                    <li class="nav-item">
                        <a class="nav-link {{ (request()->is('admin/profile*')) ? 'active' : '' }}"
                            href="{{ route('profile')}}">
                            <i class="menu-icon mdi mdi-account-circle-outline"></i>
<<<<<<< HEAD
                            <span class="menu-title">User Profile</span>
=======
                            <span class="menu-title">{{ trans('message.userProfile') }}</span>
>>>>>>> main

                        </a>
                    </li>
                    <!-- <li class="nav-item">
                        <a class="nav-link {{ (request()->is('admin/settings*')) ? 'active' : '' }}"
                            href="{{ route('settings')}}">
                            <i class="menu-icon mdi mdi mdi-settings-outline"></i>
                            <span class="menu-title">Settings</span>

                        </a>
                    </li> -->
<<<<<<< HEAD
                    <li class="nav-item nav-category">Option</li>
=======
                    <li class="nav-item nav-category">{{ trans('message.option') }}</li>
>>>>>>> main
                    @can('funds-list')
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('funds.index')}}">
                            <i class="menu-icon mdi mdi-file-document-box-outline"></i>
<<<<<<< HEAD
                            <span class="menu-title">Manage Fund</span>
=======
                            <span class="menu-title">{{ trans('message.manageFund') }}</span>
>>>>>>> main

                        </a>
                    </li>
                    @endcan
                    @can('projects-list')
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('researchProjects.index')}}">
                            <i class="menu-icon mdi mdi-book-outline"></i>
<<<<<<< HEAD
                            <span class="menu-title">Research Project</span>
=======
                            <span class="menu-title">{{ trans('message.ResearchProj') }}</span>
>>>>>>> main

                        </a>
                    </li>
                    @endcan
                    @can('groups-list')
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('researchGroups.index')}}">
                            <i class="menu-icon mdi mdi-view-dashboard-outline"></i>
<<<<<<< HEAD
                            <span class="menu-title">Research Group</span>
=======
                            <span class="menu-title">{{ trans('message.ResearchGroup') }}</span>
>>>>>>> main

                        </a>
                    </li>
                    @endcan
                    @can('papers-list')
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="collapse" href="#ManagePublications" aria-expanded="false" aria-controls="ManagePublications">
                            <i class="menu-icon mdi mdi-book-open-page-variant"></i>
<<<<<<< HEAD
                            <span class="menu-title">Manage Publications</span>
=======
                            <span class="menu-title">{{ trans('message.managePublication') }}</span>
>>>>>>> main
                            <i class="menu-arrow"></i>
                        </a>
                        <div class="collapse" id="ManagePublications">
                            <ul class="nav flex-column sub-menu">
<<<<<<< HEAD
                                <li class="nav-item"> <a class="nav-link" href="{{ route('papers.index')}}">Published research</a></li>
                                <li class="nav-item"> <a class="nav-link" href="/books">Book</a></li>
                                <li class="nav-item"> <a class="nav-link" href="/patents">ผลงานวิชาการอื่นๆ</a></li>
=======
                                <li class="nav-item"> <a class="nav-link" href="{{ route('papers.index')}}">{{ trans('message.publishedResearch') }}</a></li>
                                <li class="nav-item"> <a class="nav-link" href="/books">{{ trans('message.book') }}</a></li>
                                <li class="nav-item"> <a class="nav-link" href="/patents">{{ trans('message.otherAcademic') }}</a></li>
>>>>>>> main
                            </ul>
                        </div>
                    </li>
                    @endcan
                    @can('export')
                    <li class="nav-item">
<<<<<<< HEAD
                        <a class="nav-link" href="{{route('exportfile')}}" >
                            <i class="menu-icon mdi mdi-file-export"></i>
                            <span class="menu-title">Export</span>
=======
                        <a class="nav-link" href="{{route('exportfile')}}">
                            <i class="menu-icon mdi mdi-file-export"></i>
                            <span class="menu-title">{{ trans('message.export') }}</span>
>>>>>>> main
                        </a>
                    </li>
                    @endcan
                    @can('user-list')
<<<<<<< HEAD
                    <li class="nav-item nav-category">Admin</li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('users.index')}}">
                            <i class="menu-icon mdi mdi-account-multiple-outline"></i>
                            <span class="menu-title">Users</span>
=======
                    <li class="nav-item nav-category">{{ trans('message.admin') }}</li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('users.index')}}">
                            <i class="menu-icon mdi mdi-account-multiple-outline"></i>
                            <span class="menu-title">{{  trans('message.user')}}</span>
>>>>>>> main

                        </a>
                    </li>
                    @endcan
                    @can('role-list')
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('roles.index')}}">
                            <i class="menu-icon mdi mdi-chart-gantt"></i>
<<<<<<< HEAD
                            <span class="menu-title">Roles</span>
=======
                            <span class="menu-title">{{ trans('message.role') }}</span>
>>>>>>> main

                        </a>
                    </li>
                    @endcan
                    @can('permission-list')
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('permissions.index')}}">
                            <i class="menu-icon mdi mdi-checkbox-marked-circle-outline"></i>
<<<<<<< HEAD
                            <span class="menu-title">Permission</span>
=======
                            <span class="menu-title">{{ trans('message.permission') }}</span>
>>>>>>> main

                        </a>
                    </li>
                    @endcan
                    @can('departments-list')
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('departments.index')}}">
                            <i class="menu-icon mdi mdi-animation-outline"></i>
<<<<<<< HEAD
                            <span class="menu-title">Departments</span>
=======
                            <span class="menu-title">{{  trans('message.department') }}</span>
>>>>>>> main

                        </a>
                    </li>
                    @endcan

                    @can('programs-list')
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('programs.index')}}">
                            <i class="menu-icon mdi mdi-format-list-bulleted"></i>
<<<<<<< HEAD
                            <span class="menu-title">Manage Programs</span>
=======
                            <span class="menu-title">{{ trans('message.manageProgram') }}</span>
>>>>>>> main

                        </a>
                    </li>
                    @endcan
                    @can('expertises-list')
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('experts.index')}}">
                            <i class="menu-icon mdi mdi-buffer"></i>
<<<<<<< HEAD
                            <span class="menu-title">Manage Expertise</span>
=======
                            <span class="menu-title">{{ trans('message.manageExpertise') }}</span>
>>>>>>> main

                        </a>
                    </li>
                    @endcan
<<<<<<< HEAD
=======
                    <li class="nav-item">
                    <a class="nav-link" href="{{ route('highlights.index') }}">
                        <i class="menu-icon mdi mdi-star-outline"></i>
                        <span class="menu-title">{{ trans('message.manageHighlight') }}</span>
                     </a>
                    </li>
>>>>>>> main
                </ul>
            </nav>

            <!-- Content Wrapper. Contains page content -->
            <div class="main-panel">
                <div class="content-wrapper">
                    @yield('content')
                </div>
                <footer class="footer">
                    <div class="d-sm-flex justify-content-center justify-content-sm-between">
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
    <!-- AdminLTE App -->
    <script src="dist/js/adminlte.min.js"></script>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>

    <!-- Select2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>

    @yield('javascript')


</body>


</html>