@extends('dashboards.users.layouts.user-dash-layout')
@section('content')
<div class="container">
    <div class="justify-content-center">
        @if (\Session::has('success'))
        <div class="alert alert-success">
            <p>{{ \Session::get('success') }}</p>
        </div>
        @endif
        <div class="card col-8" style="padding: 16px;">
            <div class="card-body">
                <h4 class="card-title">Roles</h4>
                <p class="card-description">ข้อมูลรายละเอียด</p>
                <div class="row">
                    <p class="card-text col-sm-3"><b>ชื่อ </b></p>
                    <p class="card-text col-sm-9">{{ $role->name }}</p>
                </div>
                <div class="row mt-3">
                    <p class="card-text col-sm-3"><b>Permissions </b></p>
                    @if(!empty($rolePermissions))
                    <p class="card-text col-sm-9" style="line-height: 1.85rem;">@foreach($rolePermissions as $permission)<label
                            class="badge badge-success"> {{ $permission->name }} </label>  @endforeach</p>
                    @endif
                </div>
                @can('role-create')
                <a class="btn btn-primary mt-5" href="{{ route('roles.index') }}">Back</a>
                @endcan
            </div>
        </div>
    </div>
</div>
@endsection