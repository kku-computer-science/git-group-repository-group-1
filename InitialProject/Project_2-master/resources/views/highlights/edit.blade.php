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
                    <label>Title</label>
                    <input type="text" name="title" class="form-control" value="{{ $highlight->title }}" required>
                </div>
                <div class="mb-3">
                    <label>Description</label>
                    <textarea name="description" class="form-control">{{ $highlight->description }}</textarea>
                </div>
                <div class="mb-3">
                    <label>Current Image</label><br>
                    <img src="{{ asset($highlight->image_url) }}" width="100">
                </div>
                <div class="mb-3">
                    <label>New Image</label>
                    <input type="file" name="image" class="form-control">
                </div>
                <div class="mb-3">
                    <label>Priority</label>
                    <input type="number" name="priority" class="form-control" value="{{ $highlight->priority }}" required>
                </div>
                <div class="mb-3">
                    <label>Status</label>
                    <select name="status" class="form-control">
                        <option value="active" {{ $highlight->status == 'active' ? 'selected' : '' }}>Active</option>
                        <option value="inactive" {{ $highlight->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-success">Update</button>
                <a href="{{ route('highlights.index') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
</div>
@endsection
