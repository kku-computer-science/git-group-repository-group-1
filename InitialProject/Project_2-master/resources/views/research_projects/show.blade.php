@extends('dashboards.users.layouts.user-dash-layout')

@section('content')
<div class="container">
    <div class="card col-md-8" style="padding: 16px;">
        <div class="card-body">
            <h4 class="card-title">Research Projects Detail</h4>
            <p class="card-description">ข้อมูลรายละเอียดโครงการวิจัย</p>
            <div class="row">
                <p class="card-text col-sm-3"><b>ชื่อโครงการ</b></p>
                <p class="card-text col-sm-9">{{ $researchProject->project_name }}</p>
            </div>
            <div class="row">
                <p class="card-text col-sm-3"><b>วันเริ่มต้นโครงการ</b></p>
                <p class="card-text col-sm-9">{{ $researchProject->project_start }}</p>
            </div>
            <div class="row">
                <p class="card-text col-sm-3"><b>วันสิ้นสุดโครงการ</b></p>
                <p class="card-text col-sm-9">{{ $researchProject->project_end }}</p>
            </div>
            <div class="row">
                <p class="card-text col-sm-3"><b>แหล่งทุนวิจัย</b></p>
                <p class="card-text col-sm-9">{{ $researchProject->fund->fund_name }}</p>
            </div>
            <div class="row">
                <p class="card-text col-sm-3"><b>จำนวนเงิน</b></p>
                <p class="card-text col-sm-9">{{ $researchProject->budget }}</p>
            </div>
            <div class="row">
                <p class="card-text col-sm-3"><b>รายละเอียดโครงการ</b></p>
                <p class="card-text col-sm-9">{{ $researchProject->note }}</p>
            </div>
            <div class="row">
                <p class="card-text col-sm-3"><b>สถานะโครงการ</b></p>
                @if($researchProject->status == 1)
                <p class="card-text col-sm-9">ยื่นขอ</p>
                @elseif($researchProject->status == 2)
                <p class="card-text col-sm-9">ดำเนินการ</p>
                @else
                <p class="card-text col-sm-9">ปิดโครงการ</p>
                @endif
            </div>
            <div class="row">
                <p class="card-text col-sm-3"><b>ผู้รับผิดชอบโครงการ</b></p>
                @foreach($researchProject->user as $user)
                @if ( $user->pivot->role == 1)
                <p class="card-text col-sm-9">{{$user->position_th}}{{ $user->fname_th}} {{ $user->fname_th}}</p>
                @endif
                @endforeach
            </div>
            <div class="row">
                <p class="card-text col-sm-3"><b>สมาชิกโครงการ</b></p>
                @foreach($researchProject->user as $user)
                @if ( $user->pivot->role == 2)
                <p class="card-text col-sm-9">{{$user->position_th}}{{ $user->fname_th}} {{ $user->fname_th}}
				@if (!$loop->last),@endif
                @endif
                
                @endforeach

                @foreach($researchProject->outsider as $user)
                @if ( $user->pivot->role == 2)
                ,{{$user->title_name}}{{ $user->fname}} {{ $user->fname}}</p>
				@if (!$loop->last),@endif
                @endif
                
                @endforeach
            </div>
            <div class="pull-right mt-5">
                <a class="btn btn-primary" href="{{ route('researchProjects.index') }}">Back</a>
            </div>

        </div>
    </div>
</div>
@endsection