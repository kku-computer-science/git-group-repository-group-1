@extends('dashboards.users.layouts.user-dash-layout')
@section('title','Dashboard')

@section('content')

<h3 style="padding-top: 10px;">{{trans('message.welcomeUser')}}</h3>
<br>
<h4>
    @if(app()->getLocale() == 'en')
    Hello {{ Auth::user()->position_en }} {{ Auth::user()->fname_en }} {{ Auth::user()->lname_en }}
    @else
    สวัสดี {{Auth::user()->position_th}} {{Auth::user()->fname_th}}{{Auth::user()->lname_th}}
    @endif
</h4>
@endsection