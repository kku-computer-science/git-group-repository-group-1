@extends('layouts.layout')
@section('content')
<div class="container card-2">
    <p class="title">{{ trans('message.Researchers') }}</p>

    {{-- วนลูปโปรแกรมทั้งหมด --}}
    @foreach($programs as $res)
        <span>
            @if (app()->getLocale() == 'en')
                <ion-icon name="caret-forward-outline" size="small"></ion-icon>
                {{ $res->program_name_en }}
            @else
                <ion-icon name="caret-forward-outline" size="small"></ion-icon>
                {{ $res->program_name_th }}
            @endif
        </span>

        <div class="d-flex">
            <div class="ml-auto">
                <form class="row row-cols-lg-auto g-3"
                      method="GET"
                      action="{{ route('searchresearchers', ['id' => $res->id]) }}">
                    <div class="col-md-8">
                        <div class="input-group">
                            <input type="text"
                                   class="form-control"
                                   name="textsearch"
                                   placeholder="{{ trans('message.researchInterest') }}">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <button type="submit"
                                class="btn btn-outline-primary">
                            {{ trans('message.search') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <div class="row row-cols-1 row-cols-md-2 g-0">
            @foreach($users as $r)
                <a href="{{ route('detail', Crypt::encrypt($r['id'])) }}">
                    <div class="card mb-3">
                        <div class="row g-0">
                            <div class="col-sm-4">
                                <img class="card-image" src="{{ $r['picture'] }}" alt="">
                            </div>
                            <div class="col-sm-8 overflow-hidden"
                                 style="text-overflow: clip;
                                        @if(app()->getLocale() == 'en')
                                            max-height: 220px;
                                        @else
                                            max-height: 210px;
                                        @endif">
                                <div class="card-body">
                                    {{-- ตัวอย่างเช็คภาษา --}}
                                    @if(app()->getLocale() == 'en')
                                        @if($r['doctoral_degree'] == 'Ph.D.')
                                            <h5 class="card-title">
                                                {{ $r['fname_en'] }}
                                                {{ $r['lname_en'] }},
                                                {{ $r['doctoral_degree'] }}
                                            </h5>
                                        @else
                                            <h5 class="card-title">
                                                {{ $r['fname_en'] }}
                                                {{ $r['lname_en'] }}
                                            </h5>
                                        @endif
                                        <h5 class="card-title-2">
                                            {{ $r['academic_ranks_en'] }}
                                        </h5>
                                    @else
                                        <h5 class="card-title">
                                            {{ $r['position_th'] }}
                                            {{ $r['fname_th'] }}
                                            {{ $r['lname_th'] }}
                                        </h5>
                                    @endif

                                    <p class="card-text-1">{{ trans('message.expertise') }}</p>
                                    <div class="card-expertise">
                                        @if(isset($r['expertise']))
                                            @php
                                                // เปลี่ยน $r['expertise'] ให้เป็น collection เพื่อ sortBy() ได้
                                                $expertises = collect($r['expertise'])->sortBy('expert_name');
                                            @endphp
                                            @foreach($expertises as $exper)
                                                <p class="card-text">{{ $exper['expert_name'] }}</p>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    @endforeach
</div>
@stop