@extends('dashboards.users.layouts.user-dash-layout')

@section('content')
<div class="container">
    <div class="card col-md-8" style="padding: 16px;">
        <div class="card-body">
            <h4 class="card-title">Book Detail</h4>
            <p class="card-description">ข้อมูลรายละเอียดหนังสือ</p>
            <div class="row">
                <p class="card-text col-sm-3"><b>ชื่อหนังสือ</b></p>
                <p class="card-text col-sm-9">{{ $paper->ac_name }}</p>
            </div>
            <div class="row">
                <p class="card-text col-sm-3"><b>ปี</b></p>
                <p class="card-text col-sm-9">{{  date('Y', strtotime($paper->ac_year))+543 }}</p>
            </div>
            <div class="row">
                <p class="card-text col-sm-3"><b>แหล่งเผยแพร่</b></p>
                <p class="card-text col-sm-9">{{ $paper->ac_sourcetitle }}</p>
            </div>
            <div class="row">
                <p class="card-text col-sm-3"><b>หน้า</b></p>
                <p class="card-text col-sm-9">{{ $paper->ac_page }}</p>
            </div>

            <div class="pull-right mt-5">
                <a class="btn btn-primary btn-sm" href="{{ route('books.index') }}"> Back</a>
            </div>
        </div>

    </div>


</div>
@endsection