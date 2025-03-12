@extends('layouts.layout')

@section('content')
<div class="container mt-5">
    @php
    $lang = App::getLocale();
    @endphp

    {{-- รูปภาพ --}}
    <div class="d-flex justify-content-center">
        <img src="{{ asset($highlight->{"image_url_{$lang}"} ?? $highlight->image_url_en) }}"
            class="img-fluid rounded w-100 col-md-8 mb-3"
            alt="{{ $highlight->{"title_{$lang}"} }}">
    </div>

    {{-- วันที่เผยแพร่ --}}
    <div class="text-muted text-end mb-2">
        <small>เผยแพร่ {{ optional($highlight->created_at)->format('d/m/Y H:i') }}</small>
    </div>

    {{-- แสดง Tag ที่เกี่ยวข้อง --}}
    <div class="mt-3 d-flex align-items-center flex-wrap">
        <h5 class="fw-bold me-2 mb-0">Tags:</h5>
            @forelse($highlight->tags as $tag)
            <span class= "me-2 text-primary text-decoration-none">{{ $tag->name }}</span>
            @empty
            <span class="text-muted">ไม่มีแท็ก</span>
            @endforelse
    </div>

    {{-- หัวข้อ --}}
    <div class="text-center">
        <h1 class="fw-semibold">{{ $highlight->{"title_{$lang}"} }}</h1>
    </div>

    {{-- รายละเอียด --}}
    <div class="d-flex justify-content-center mt-4">
        <p class="fs-5 col-md-8 text-start">{{ $highlight->{"description_{$lang}"} }}</p>
    </div>

    {{-- วันที่อัปเดตล่าสุด --}}
    <div class="text-muted text-end mt-3">
        <small>อัปเดตล่าสุด {{ optional($highlight->updated_at)->format('d/m/Y H:i') }}</small>
    </div>
</div>
@endsection
