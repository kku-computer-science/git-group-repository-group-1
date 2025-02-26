@extends('dashboards.users.layouts.user-dash-layout')
@section('title','Dashboard')

@section('content')

<h3 style="padding-top: 10px;">{{ trans('message.welcomeTextDashboard') }}</h3>
<br>

@if (app()->getLocale() == 'en')
<h4>{{ trans('message.hello') }} {{Auth::user()->position_en}} {{Auth::user()->fname_en}} {{Auth::user()->lname_en}}</h2>
@else
<h4>{{ trans('message.hello') }} {{Auth::user()->position_th}} {{Auth::user()->fname_th}} {{Auth::user()->lname_th}}</h2>
@endif
    
@endsection
