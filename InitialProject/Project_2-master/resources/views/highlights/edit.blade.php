@extends('dashboards.users.layouts.user-dash-layout')

@section('content')
<div class="container">
    <div class="card" style="padding: 16px;">
        <div class="card-body">
            <h4 class="card-title">Edit Highlight</h4>

            <form action="{{ route('highlights.update', $highlight->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label>Title (EN)</label>
                    <input type="text" name="title_en" class="form-control" value="{{ old('title_en', $highlight->title_en) }}" required>
                </div>

                <div class="mb-3">
                    <label>Title (TH)</label>
                    <input type="text" name="title_th" class="form-control" value="{{ old('title_th', $highlight->title_th) }}" required>
                </div>

                <div class="mb-3">
                    <label>Title (CN)</label>
                    <input type="text" name="title_cn" class="form-control" value="{{ old('title_cn', $highlight->title_cn) }}" required>
                </div>

                <div class="mb-3">
                    <label>Description (EN)</label>
                    <textarea name="description_en" class="form-control">{{ old('description_en', $highlight->description_en) }}</textarea>
                </div>

                <div class="mb-3">
                    <label>Description (TH)</label>
                    <textarea name="description_th" class="form-control">{{ old('description_th', $highlight->description_th) }}</textarea>
                </div>

                <div class="mb-3">
                    <label>Description (CN)</label>
                    <textarea name="description_cn" class="form-control">{{ old('description_cn', $highlight->description_cn) }}</textarea>
                </div>

                <div class="mb-3">
                    <label>Current Image (EN)</label><br>
                    <img src="{{ asset($highlight->image_url_en) }}" width="100">
                </div>

                <div class="mb-3">
                    <label>Current Image (TH)</label><br>
                    <img src="{{ asset($highlight->image_url_th) }}" width="100">
                </div>

                <div class="mb-3">
                    <label>Current Image (CN)</label><br>
                    <img src="{{ asset($highlight->image_url_cn) }}" width="100">
                </div>

                <div class="mb-3">
                    <label>New Image (EN)</label>
                    <input type="file" name="image_en" class="form-control">
                </div>

                <div class="mb-3">
                    <label>New Image (TH)</label>
                    <input type="file" name="image_th" class="form-control">
                </div>
                
                <div class="mb-3">
                    <label>New Image (CN)</label>
                    <input type="file" name="image_cn" class="form-control">
                </div>

                <div class="mb-3">
                    <label>Priority</label>
                    <input type="number" name="priority" class="form-control" value="{{ old('priority', $highlight->priority) }}" required>
                </div>

                <button type="submit" class="btn btn-success">Update</button>
                <a href="{{ route('highlights.index') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
</div>
@endsection
