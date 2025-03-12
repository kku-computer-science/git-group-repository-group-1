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
    <div class="container mt-3 mb-3 d-flex justify-content-between align-items-center flex-wrap">
        {{-- Tags --}}
        <div class="d-flex align-items-center flex-wrap">
            <span class="fw-bold me-2 mb-0">Tags:</>
            @forelse($highlight->tags as $tag)
            <a href="{{ route('highlight.byTag', ['tag_id' => $tag->id]) }}" class="text-primary text-decoration-none">
                {{ $tag->name }} /
            </a>
            @empty
            <span class="text-muted">ไม่มีแท็ก</span>
            @endforelse
        </div>

        {{-- วันที่เผยแพร่ --}}
        <div class="text-muted">
            <span>Publish {{ optional($highlight->created_at)->format('d/m/Y H:i') }}</span>
        </div>
    </div>

    {{-- หัวข้อ --}}
    <div class="text-center mt-5">
        <h2 class="fw-semibold">{{ $highlight->{"title_{$lang}"} }}</h>
    </div>

    {{-- รายละเอียด --}}
    <div class="d-flex justify-content-center mt-5 ">
        <span class="fs-5 col-md-8 text-start">{{ $highlight->{"description_{$lang}"} }}</>
    </div>

    {{-- วันที่อัปเดตล่าสุด --}}
    <div class="container text-end mt-5">
        <span class="text-muted">Latest update {{ optional($highlight->updated_at)->format('d/m/Y H:i') }}</>
    </div>
</div>
@endsection
