@extends('dashboards.users.layouts.user-dash-layout')

@section('content')
<div class="container">
    <div class="card shadow-sm p-4">
        <div class="card-body">
            <h4 class="card-title">Add New Highlight</h4>

            <form action="{{ route('highlights.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label>Title (EN)</label>
                    <input type="text" name="title_en" class="form-control border rounded p-2" value="{{ old('title_en') }}" required>
                </div>

                <div class="mb-3">
                    <label>Title (TH)</label>
                    <input type="text" name="title_th" class="form-control border rounded p-2" value="{{ old('title_th') }}" required>
                </div>

                <div class="mb-3">
                    <label>Description (EN)</label>
                    <textarea name="description_en" class="form-control border rounded p-2">{{ old('description_en') }}</textarea>
                </div>

                <div class="mb-3">
                    <label>Description (TH)</label>
                    <textarea name="description_th" class="form-control border rounded p-2">{{ old('description_th') }}</textarea>
                </div>

                <!-- Image Upload -->
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label class="d-block">Upload Image (EN)</label>
                        <input type="file" name="image_en" class="form-control border rounded" required>
                    </div>
                    <div class="col-md-4">
                        <label class="d-block">Upload Image (TH)</label>
                        <input type="file" name="image_th" class="form-control border rounded" required>
                    </div>
                </div>

                <!-- Tags -->
                <div class="mb-3">
                    <label>Tags</label>
                    <div id="selected-tags"></div>
                    <button type="button" class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#tagModal">
                        Add Tag
                    </button>
                </div>

                <div class="mb-3">
                    <label>Priority</label>
                    <input type="number" name="priority" class="form-control border rounded" value="{{ old('priority', 1) }}" required>
                </div>

                <button type="submit" class="btn btn-success">Save</button>
                <a href="{{ route('highlights.index') }}" class="btn btn-secondary">Cancel</a>
            </form>

            <!-- Modal for Tags -->
            <div class="modal fade" id="tagModal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Select Tags</h5>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <!--tag manage-->
                            <button type="button" class="btn btn-sm btn-outline-secondary" onclick="window.location.href='{{ route('tags.manage') }}'" style="position: absolute; right: 50px;">
                                <i class="fas fa-cog"></i> Manage Tags
                            </button>
                        </div>
                        <div class="modal-body">
                            @if(!empty($existingTags) && is_iterable($existingTags))
                                @foreach($existingTags as $tag)
                                    <button type="button" class="btn btn-outline-primary tag-option m-1">
                                        {{ is_object($tag) ? $tag->name : $tag }}
                                    </button>
                                @endforeach
                            @else
                                <p class="text-muted">No tags available</p>
                            @endif

                            <div class="mt-3">
                                <input type="text" id="newTagName" class="form-control border rounded" placeholder="Enter new tag">
                                <button type="button" id="addNewTag" class="btn btn-primary mt-2">Add New Tag</button>
                            </div>
                        </div>
                        <div class="modal-header">
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    // เลือกแท็กจากรายการที่มีอยู่
    $('.tag-option').click(function() {
        var tag = $(this).text().trim();
        if ($('#selected-tags input[value="'+tag+'"]').length == 0) {
            $('#selected-tags').append(`
                <span class="badge badge-primary m-1">${tag}
                    <span class="remove-tag" style="cursor:pointer">&times;</span>
                    <input type="hidden" name="tags[]" value="${tag}">
                </span>
            `);
        }
        $('#tagModal').modal('hide');
    });

    // เพิ่มแท็กใหม่ลงใน Database
    $('#addNewTag').click(function() {
        let tagName = $('#newTagName').val().trim();
        if (tagName === '') {
            alert('Please enter a tag name.');
            return;
        }

        $.ajax({
            url: "{{ route('tags.store') }}",
            method: "POST",
            data: {
                name: tagName,
                _token: "{{ csrf_token() }}"
            },
            success: function(response) {
                if (response.success) {
                    $('#selected-tags').append(`
                        <span class="badge badge-primary m-1">${response.tag.name}
                            <span class="remove-tag" style="cursor:pointer">&times;</span>
                            <input type="hidden" name="tags[]" value="${response.tag.id}">
                        </span>
                    `);
                    $('#newTagName').val('');
                }
            },
            error: function(xhr) {
                alert('Error adding tag. Check console for details.');
                console.error(xhr.responseText);
            }
        });
    });

    // ลบแท็กที่เลือก
    $(document).on('click', '.remove-tag', function(){
        $(this).parent('.badge').remove();
    });
});
</script>

@endsection
