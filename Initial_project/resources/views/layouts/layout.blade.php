<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ระบบข้อมูลงานวิจัย วิทยาลัยการคอมพิวเตอร์</title>
    <base href="{{ \URL::to('/') }}">
    <link href="img/Newlogo.png" rel="shortcut icon" type="image/x-icon" />

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <link href="{{ asset('css/load-more-button.css') }}" rel="stylesheet">

    <script src="{{ asset('js/app.js') }}"></script>

    <link rel="stylesheet" href="{{asset('vendor/bootstrap/css/bootstrap.min.css')}}">
    <script src="{{asset('js/jquery-3.6.0.min.js')}}"></script>

    <script src="{{asset('vendor/bootstrap/js/bootstrap.min.js')}}"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{asset('vendors/mdi/css/materialdesignicons.min.css')}}">
    <link rel="stylesheet" href="{{asset('vendors/ti-icons/css/themify-icons.css')}}">
    <link rel="stylesheet" href="{{asset('vendors/typicons/typicons.css')}}">
    <link rel="stylesheet" href="{{asset('vendors/simple-line-icons/css/simple-line-icons.css')}}">
    <!-- datatable -->
    <!-- <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.css" />
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap5.css" />
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap5.css" /> -->

    <!-- <script src="https://code.jquery.com/jquery-3.5.1.js" defer></script> -->
    <!--<script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js" defer></script>
    <script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap5.min.js" defer></script> -->



    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.css" />
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap5.css" />
    <link rel="stylesheet" type="text/css"
        href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap5.css" />


    <link href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.1.0/css/flag-icon.min.css" rel="stylesheet">
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

    <link rel="stylesheet" href="{{asset('css/style.css')}}">

    

</head>

<body>
    <!-- Navigation -->
    <nav id="navbar" class="navbar navbar-expand-lg navbar-light">
        <div class="container-fluid">
            <a class="navbar-brand logo-image" href="#"><img src="{{asset('img/logo2.png')}}" alt="alternative"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="collapsibleNavbar">
                <ul class="navbar-nav ms-auto navbar-nav-scroll">
                    <li class="nav-item {{ request()->is('/') ? 'active' : ''}} ">
                        <a class="nav-link" href="/">{{ trans('message.Home') }}</a>
                    </li>
                    <li
                        class="nav-item dropdown {{ Request::routeIs('researchers') ? 'active' : '' }} {{ request()->is('detail*') ? 'active' : ''}} ">
                        <a class="nav-link dropdown-toggle" id="navbarDropdown" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            {{ trans('message.Researchers') }}
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            @foreach($dn as $department)
                            <li><a class="dropdown-item" href="{{ route('researchers',['id'=>$department->id])}}">
                                    {{$department->program_name_en}}</a>
                            </li>
                            @endforeach
                        </ul>
                    </li>
                    <li class="nav-item {{ request()->is('researchproject') ? 'active' : ''}} ">
                        <a class="nav-link" href="/researchproject">{{ trans('message.ResearchProj') }}</a>
                    </li>
                    <li class="nav-item {{ request()->is('researchgroup') ? 'active' : ''}}  ">
                        <a class="nav-link" href="/researchgroup">{{ trans('message.ResearchGroup') }}</a>
                    </li>
                    <li class="nav-item {{ request()->is('reports') ? 'active' : ''}}">
                        <a class="nav-link" href="/reports">{{ trans('message.Report') }}</a>
                    </li>


                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            <span
                                class="flag-icon flag-icon-{{Config::get('languages')[App::getLocale()]['flag-icon']}}"></span>
                            {{ Config::get('languages')[App::getLocale()]['display'] }}
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            @foreach (Config::get('languages') as $lang => $language)
                            @if ($lang != App::getLocale())
                            <a class="dropdown-item" href="{{ route('langswitch', $lang) }}"><span
                                    class="flag-icon flag-icon-{{$language['flag-icon']}}"></span>
                                {{$language['display']}}</a>
                            @endif
                            @endforeach
                        </div>
                    </li>


                </ul>
                @if (Route::has('login'))
                @auth
                <span class="nav-item">

                </span>
                @else
                <span class="nav-item">
                    <a class="btn-solid-sm" href="/login" target="_blank">Login</a>
                </span>
                @endauth
                @endif
            </div> <!-- end of navbar-collapse -->
        </div> <!-- end of container -->
    </nav> <!-- end of navbar -->
    <!-- end of navigation -->
    @yield('content')
    @yield('javascript')

    <footer class="footer">
        <div class="d-sm-flex justify-content-center justify-content-sm-between">
        </div>
    </footer>
</body>

</html>