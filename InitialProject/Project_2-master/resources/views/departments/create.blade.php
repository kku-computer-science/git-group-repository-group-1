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
        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <strong>{{ trans('message.opps') }}</strong>{{ trans('message.textErrorDepartment') }}<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="card">
            <div class="card-header">{{ trans('message.createDepartment') }}
                <span class="float-right">
                    <a class="btn btn-primary" href="{{ route('departments.index') }}">{{ trans('message.department') }}</a>
                </span>
            </div>
            <div class="card-body">
                {!! Form::open(array('route' => 'departments.store', 'method'=>'department')) !!}
                    <div class="form-group">
                        <strong>{{ trans('message.departmentName') }} TH	:</strong>
                        {!! Form::text('department_name_th', null, array('placeholder' => trans("message.departmentName") . ' TH','class' => 'form-control')) !!}
                    </div>
                    <div class="form-group">
                        <strong>{{ trans('message.departmentName') }} EN	:</strong>
                        {!! Form::text('department_name_en', null, array('placeholder' => trans("message.departmentName") . ' EN','class' => 'form-control')) !!}
                    </div>
                    
                    <button type="submit" class="btn btn-primary">{{ trans('message.submit') }}</button>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@endsection