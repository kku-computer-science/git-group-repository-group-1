@extends('layouts.layout')

@section('content')
<div class="container">
    <h3 class="mt-4">Search results for: {{ $tag->name }}</h3>
    <p class="text-muted">Search results found: {{ $highlights->count() }} items</p>

    <div class="row">
        @forelse ($highlights as $highlight)
        @php
            $lang = App::getLocale();
            $imagePath = $highlight->{"image_url_{$lang}"} ?? $highlight->image_url_en;
        @endphp
        <div class="col-12">
            <div class="card highlight-card d-flex flex-row align-items-center p-2">
                <a href="{{ route('highlight.show', $highlight->id) }}" class="d-flex w-100 text-decoration-none">
                    <img src="{{ asset($imagePath) }}" class="highlight-img img-fluid" alt="{{ $highlight->{"title_{$lang}"} }}">
                    <div class="card-body m-2">
                        <h5 class="card-title text-dark">{{ $highlight->{"title_{$lang}"} }}</h5>
                        <p class="text-muted mb-3">
                            {{ Str::limit($highlight->{"description_{$lang}"} ?? '', 300) }}
                        </p>
                    </div>
                </a>
            </div>
        </div>

        @empty
        <div class="col-12">
            <p class="text-muted">No highlights in this tag</p>
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
        border: none;
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
        filter: brightness(0.9);
    }

    .highlight-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    /* Remove underline from links */
    .text-decoration-none {
        text-decoration: none !important;
    }
</style>
@endsection
