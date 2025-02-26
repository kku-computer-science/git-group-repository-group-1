@extends('dashboards.users.layouts.user-dash-layout')

@section('content')
<div class="container">
    <div class="card" style="padding: 16px;">
        <div class="card-body">
            <h4 class="card-title">Add Highlight</h4>
            <form action="{{ route('highlights.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label>Title (EN)</label>
                    <input type="text" name="title_en" class="form-control" value="{{ old('title_en') }}" required>
                </div>

                <div class="mb-3">
                    <label>Title (TH)</label>
                    <input type="text" name="title_th" class="form-control" value="{{ old('title_th') }}" required>
                </div>

                <div class="mb-3">
                    <label>Title (CN)</label>
                    <input type="text" name="title_cn" class="form-control" value="{{ old('title_cn') }}" required>
                </div>

                <div class="mb-3">
                    <label>Description (EN)</label>
                    <textarea name="description_en" class="form-control">{{ old('description_en') }}</textarea>
                </div>

                <div class="mb-3">
                    <label>Description (TH)</label>
                    <textarea name="description_th" class="form-control">{{ old('description_th') }}</textarea>
                </div>

                <div class="mb-3">
                    <label>Description (CN)</label>
                    <textarea name="description_cn" class="form-control">{{ old('description_cn') }}</textarea>
                </div>

                <div class="mb-3">
                    <label>Image (EN)</label>
                    <input type="file" name="image_en" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label>Image (TH)</label>
                    <input type="file" name="image_th" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label>Image (CN)</label>
                    <input type="file" name="image_cn" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label>Priority</label>
                    <input type="number" name="priority" class="form-control" value="{{ old('priority', 1) }}" required>
                </div>

                <button type="submit" class="btn btn-primary">Save</button>
                <a href="{{ route('highlights.index') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
</div>
@endsection