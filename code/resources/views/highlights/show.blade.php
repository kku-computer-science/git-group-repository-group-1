@extends('layouts.layout')

@section('content')
<div class="container-fluid p-0"> {{-- เปลี่ยนเป็น container-fluid เพื่อลด padding --}}
    @php
    $lang = App::getLocale();
    @endphp

    {{-- รูปภาพเต็มแนวยาว --}}
    <div class="d-flex justify-content-center">
        <img src="{{ asset($highlight->{"image_url_{$lang}"} ?? $highlight->image_url_en) }}"
            class="img-fluid w-100 vh-50 object-fit-cover"
            alt="{{ $highlight->{"title_{$lang}"} }}">
    </div>
    <br>
    {{-- แสดง Tag และวันที่เผยแพร่ให้อยู่บรรทัดเดียวกัน --}}
    <div class="container mt-3 d-flex justify-content-between align-items-center flex-wrap">
        {{-- Tags --}}
        <div class="d-flex align-items-center flex-wrap">
            <h5 class="fw-bold me-2 mb-0">Tags:</h5>
            @forelse($highlight->tags as $tag)
            <a href="{{ route('highlight.byTag', ['tag_id' => $tag->id]) }}" class="me-2 text-primary text-decoration-none">
                {{ $tag->name }}
            </a>
            @empty
            <span class="text-muted">ไม่มีแท็ก</span>
            @endforelse
        </div>

        {{-- วันที่เผยแพร่ --}}
        <div class="text-muted">
            <small>เผยแพร่ {{ optional($highlight->created_at)->format('d/m/Y H:i') }}</small>
        </div>
    </div>

    {{-- หัวข้อ --}}
    <div class="text-center mt-4">
        <h1 class="fw-semibold">{{ $highlight->{"title_{$lang}"} }}</h1>
    </div>

    {{-- รายละเอียด --}}
    <div class="d-flex justify-content-center mt-4">
        <p class="fs-5 col-md-8 text-start">{{ $highlight->{"description_{$lang}"} }}</p>
    </div>

    {{-- วันที่อัปเดตล่าสุด --}}
    <div class="container text-end mt-3">
        <small class="text-muted">อัปเดตล่าสุด {{ optional($highlight->updated_at)->format('d/m/Y H:i') }}</small>
    </div>
</div>
@endsection
