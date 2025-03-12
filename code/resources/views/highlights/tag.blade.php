@extends('layouts.layout')

@section('content')
<div class="container">
    <h3 class="mt-4">Highlight สำหรับแท็ก: {{ $tag->name }}</h3>
    <p class="text-muted">ผลการค้นหาพบ : {{ $highlights->count() }} รายการ</p>

    <div class="row">
        @forelse ($highlights as $highlight)
        @php
        $lang = App::getLocale();
        $imagePath = $highlight->{"image_url_{$lang}"} ?? $highlight->image_url_en;
        @endphp
        <div class="col-12">
            <div class="card highlight-card d-flex flex-row align-items-center p-2">
                <a href="{{ route('highlight.show', $highlight->id) }}" class="d-flex w-100">
                    <img src="{{ asset($imagePath) }}" class="highlight-img img-fluid" alt="{{ $highlight->{"title_{$lang}"} }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $highlight->{"title_{$lang}"} }}</h5>
                    </div>
                </a>
            </div>
        </div>

        @empty
        <div class="col-12">
            <p class="text-muted">ไม่มี Highlights สำหรับแท็กนี้</p>
        </div>
        @endforelse
    </div>
</div>

<style>
    .highlight-card {
        display: flex;
        flex-direction: row;
        align-items: center;
        gap: 15px;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .highlight-img {
        width: 200px;
        height: 150px;
        object-fit: cover;
        border-radius: 8px;
        transition: transform 0.3s ease, filter 0.3s ease;
    }

    .highlight-card:hover .highlight-img {
        transform: scale(1.1);
        filter: brightness(0.8);
    }

    .highlight-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
</style>
@endsection