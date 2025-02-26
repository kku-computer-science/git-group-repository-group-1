@extends('dashboards.users.layouts.user-dash-layout')

@section('content')
<div class="container">
    <div class="card" style="padding: 16px;">
        <div class="card-body">
            <h4 class="card-title">{{ trans('message.journalWorkDetail') }}</h4>
            <p class="card-description">{{ trans('message.journalDetail') }}
            <div class="row mt-3">
                <p class="card-text col-sm-3"><b>{{ trans('message.nameTitle') }}</b></p>
                <p class="card-text col-sm-9">{{ $paper->paper_name }}</p>
            </div>
            <div class="row mt-2">
                <p class="card-text col-sm-3"><b>{{ trans('message.abstract') }}</b></p>
                <p class="card-text col-sm-9">{{ $paper->abstract }}</p>
            </div>
            <div class="row mt-2">
                <p class="card-text col-sm-3"><b>{{ trans('message.keyword') }}</b></p>
                <p class="card-text col-sm-9">
                    {{ $paper->keyword }}
                </p>


                <!-- <p class="card-text col-sm-9">{{ $paper->keyword }}</p> -->
            </div>
            <div class="row mt-2">
                <p class="card-text col-sm-3"><b>{{ trans('message.journalType') }}</b></p>
                <p class="card-text col-sm-9">{{ $paper->paper_type }}</p>
            </div>

            <div class="row mt-2">
                <p class="card-text col-sm-3"><b>{{ trans('message.documentType') }}</b></p>
                <p class="card-text col-sm-9">{{ $paper->paper_subtype }}</p>
            </div>
            <div class="row mt-2">
                <p class="card-text col-sm-3"><b>{{ trans('message.publications2') }}</b></p>
                <p class="card-text col-sm-9">{{ $paper->publication }}</p>
            </div>
            <div class="row mt-2">
                <p class="card-text col-sm-3"><b>{{ trans('message.author') }}</b></p>
                <p class="card-text col-sm-9">

                    @foreach($paper->author as $teacher)
                    @if($teacher->pivot->author_type == 1)
                    <b>{{ trans('message.firstAuthor') }}:</b> {{ $teacher->author_fname}} {{ $teacher->author_lname}} <br>
                    @endif
                    @endforeach
                    @foreach($paper->teacher as $teacher)
                    @if($teacher->pivot->author_type == 1)
                    <b>{{ trans('message.firstAuthor') }}:</b> {{ $teacher->fname_en}} {{ $teacher->lname_en}} <br>
                    @endif 
                    @endforeach

                    @foreach($paper->author as $teacher)
                    @if($teacher->pivot->author_type == 2)
                    <b>{{ trans('message.coAuthor') }}:</b> {{ $teacher->author_fname}} {{ $teacher->author_lname}} <br>
                    @endif
                    @endforeach
                    @foreach($paper->teacher as $teacher)
                    @if($teacher->pivot->author_type == 2)
                    <b>{{ trans('message.coAuthor') }}:</b> {{ $teacher->fname_en}} {{ $teacher->lname_en}} <br>
                    @endif 
                    @endforeach

                    @foreach($paper->author as $teacher)
                    @if($teacher->pivot->author_type == 3)
                    <b>{{ trans('message.correspondingAuthor') }}:</b> {{ $teacher->author_fname}} {{ $teacher->author_lname}} <br>
                    @endif
                    @endforeach
                    @foreach($paper->teacher as $teacher)
                    @if($teacher->pivot->author_type == 3)
                    <b>{{ trans('message.correspondingAuthor') }}:</b> {{ $teacher->fname_en}} {{ $teacher->lname_en}} <br>
                    @endif 
                    @endforeach
                    



                </p>
            </div>

            <div class="row mt-2">
                <p class="card-text col-sm-3"><b>{{ trans('message.journalTitle') }} ({{ trans('message.sourceTitle') }})</b></p>
                <p class="card-text col-sm-9">{{ $paper->paper_sourcetitle }}</p>
            </div>
            <div class="row mt-2">
                <p class="card-text col-sm-3"><b>{{ trans('message.yearOfPublication') }}</b></p>
                <p class="card-text col-sm-9">{{ $paper->paper_yearpub }}</p>
            </div>
            <div class="row mt-2">
                <p class="card-text col-sm-3"><b>{{ trans('message.volume') }}</b></p>
                <p class="card-text col-sm-9">{{ $paper->paper_volume }}</p>
            </div>
            <div class="row mt-2">
                <p class="card-text col-sm-3"><b>{{ trans('message.issue') }}</b></p>
                <p class="card-text col-sm-9">{{ $paper->paper_issue}}</p>
            </div>
            <div class="row mt-2">
                <p class="card-text col-sm-3"><b>{{ trans('message.pageNumber') }}</b></p>
                <p class="card-text col-sm-9">{{ $paper->paper_page }}</p>
            </div>
            <div class="row mt-2">
                <p class="card-text col-sm-3"><b>DOI</b></p>
                <p class="card-text col-sm-9">{{ $paper->paper_doi }}</p>
            </div>
            <div class="row mt-2">
                <p class="card-text col-sm-3"><b>URL</b></p>
                <a href="{{ $paper->paper_url }}" target="_blank" class="card-text col-sm-9">{{ $paper->paper_url }}</a>
            </div>

            <a class="btn btn-primary mt-5" href="{{ route('papers.index') }}">{{ trans('message.back') }}</a>
        </div>
    </div>

</div>
@endsection