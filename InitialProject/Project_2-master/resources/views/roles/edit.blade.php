@extends('dashboards.users.layouts.user-dash-layout')
@section('content')
<div class="container">
    <div class="justify-content-center">
        @if (count($errors) > 0)
        <div class="alert alert-danger">
            <strong>Opps!</strong> Something went wrong, please check below errors.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <div class="card col-8" style="padding: 16px;">
            <div class="card-body">
                <h4 class="card-title">{{ trans('message.editRole') }}</h4>
                {!! Form::model($role, ['route' => ['roles.update', $role->id],'method' => 'PATCH']) !!}
                <div class="form-group row">
                    <p class="col-sm-3">{{ trans('message.name') }}:</p>
                    <div class="col-sm-8">
                        {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control')) !!}
                    </div>
                </div>
                <div class="form-group">
                    <p class="col-sm-3">{{ trans('message.permission') }} </p>
                    <div class="col-sm-9">
                        @foreach($permission as $value)
                        <p>{{ Form::checkbox('permission[]', $value->id, in_array($value->id, $rolePermissions) ? true : false, array('class' => 'name')) }}
                            {{ $value->name }}</p>
                        @endforeach
                    </div>
                </div>
                <button type="submit" class="btn btn-primary mt-5">{{ trans('message.submit') }}</button>
                <a class="btn btn-light mt-5" href="{{ route('roles.index') }}">{{ trans('message.back') }}</a>
                {!! Form::close() !!}


            </div>

        </div>
    </div>
</div>
@endsection