@extends('dashboards.users.layouts.user-dash-layout')

@section('content')
<div class="container">
    <div class="card col-md-8" style="padding: 16px;">
        <div class="card-body">
            <h4 class="card-title">{{ trans('message.otherProjectDetail') }}</h4>
            <p class="card-description">{{ trans('message.otherProjectDetail') }}</p>
            <div class="row">
                <p class="card-text col-sm-3"><b>{{ trans('message.name') }}</b></p>
                <p class="card-text col-sm-9">{{ $patent->ac_name }}</p>
            </div>
            <div class="row">
                <p class="card-text col-sm-3"><b>{{ trans('message.type') }}</b></p>
                <p class="card-text col-sm-9">{{ $patent->ac_type }}</p>
            </div>
            <div class="row">
                <p class="card-text col-sm-3"><b>{{ trans('message.copyrightDate') }}</b></p>
                <p class="card-text col-sm-9">{{ $patent->ac_year }}</p>
            </div>
            <div class="row">
                <p class="card-text col-sm-3"><b>{{ trans('message.registrationNumber') }}</b></p>
                <p class="card-text col-sm-9">{{ trans('message.number') }} : {{ $patent->ac_refnumber }}</p>
            </div>
            <div class="row">
                <p class="card-text col-sm-3"><b>{{ trans('message.producer') }}</b></p>
                <p class="card-text col-sm-9">@foreach($patent->user as $a)
                    {{ $a->fname_th }} {{ $a->lname_th }}
                @if (!$loop->last),@endif
                @endforeach
                </p>
            </div>
            <div class="row">
                <p class="card-text col-sm-3"><b>{{ trans('message.producerCo') }}</b></p>
                <p class="card-text col-sm-9">
                @foreach($patent->author as $a)
                    {{ $a->author_fname }} {{ $a->author_lname }}
                @if (!$loop->last),@endif
                @endforeach</p>
            </div>
            
            <div class="pull-right mt-5">
                <a class="btn btn-primary btn-sm" href="{{ route('patents.index') }}">{{ trans('message.back') }}</a>
            </div>
        </div>
    </div>
</div>
@endsection