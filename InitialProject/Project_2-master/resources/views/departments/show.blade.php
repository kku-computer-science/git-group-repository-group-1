<!-- @php
   if(Auth::user()->hasRole('admin')) {
      $layoutDirectory = 'dashboards.admins.layouts.admin-dash-layout';
   } else {
      $layoutDirectory = 'dashboards.users.layouts.user-dash-layout';
   }
@endphp -->

@extends('dashboards.users.layouts.user-dash-layout')
@section('content')
<div class="container">
    <div class="justify-content-center">
        @if (\Session::has('success'))
            <div class="alert alert-success">
                <p>{{ \Session::get('success') }}</p>
            </div>
        @endif
        <div class="card">
            <div class="card-header">department
                @can('role-create')
                    <span class="float-right">
                        <a class="btn btn-primary" href="{{ route('departments.index') }}">Back</a>
                    </span>
                @endcan
            </div>
            <div class="card-body">
                <div class="lead">
                    <strong>Deapartment Name TH:</strong>
                    {{ $department->department_name_th }}
                </div>
                <div class="lead">
                    <strong>Deapartment Name EN:</strong>
                    {{ $department->department_name_en }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection