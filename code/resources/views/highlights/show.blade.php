@extends('layouts.layout')

@section('content')
<div class="container mt-5">
    @php
    $lang = App::getLocale();
    @endphp

    <div class="d-flex justify-content-center">
        <img src="{{ asset($highlight->{"image_url_{$lang}"} ?? $highlight->image_url_en) }}" 
             class="img-fluid rounded w-100 col-md-8 mb-3" 
             alt="{{ $highlight->{"title_{$lang}"} }}">
    </div>

    <div class="text-muted text-end mb-2">
        <small>เผยแพร่ {{ $highlight->{"created_at"}->format('d/m/Y H:i') }}</small>
    </div>

    <div class="text-center">
        <h1 class="fw-semibold">{{ $highlight->{"title_{$lang}"} }}</h1>
    </div>
    <br><br>
    <div class="d-flex justify-content-center">
        <p class="fs-5 col-md-8 text-justify">{{ $highlight->{"description_{$lang}"} }}</p>
    </div>

    <div class="text-muted text-end mt-3">
        <small>อัปเดตล่าสุด {{ $highlight->{"updated_at"}->format('d/m/Y H:i') }}</small>
    </div>
</div>
@endsection
