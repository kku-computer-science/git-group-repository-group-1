@extends('dashboards.users.layouts.user-dash-layout')

@section('content')
<div class="container">
    <div class="card shadow-sm p-4">
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
                    <label>Description (EN)</label>
                    <textarea name="description_en" class="form-control">{{ old('description_en', $highlight->description_en) }}</textarea>
                </div>

                <div class="mb-3">
                    <label>Description (TH)</label>
                    <textarea name="description_th" class="form-control">{{ old('description_th', $highlight->description_th) }}</textarea>
                </div>
    
                <div class="row mb-3">
                    <div class="col-md-3">
                        <label class="d-block">Current Image (EN)</label>
                        <img src="{{ asset($highlight->image_url_en) }}" class="img-thumbnail" width="150">
                        <div class="custom-file mt-2">
                            <input type="file" name="image_en" class="custom-file-input" id="image_en"> 
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label class="d-block">Current Image (TH)</label>
                        <img src="{{ asset($highlight->image_url_th) }}" class="img-thumbnail" width="150">
                        <div class="custom-file mt-2">
                            <input type="file" name="image_th" class="custom-file-input" id="image_th"> 
                        </div>
                    </div>
                </div>


                <!-- Tags -->
                <div class="mb-3">
                    <div class="col-md-3">
                        <label class="d-block">Tags</label>
                        <div id="selected-tags">
                            @foreach($highlightTags as $tag)
                                <span class="badge badge-primary m-2">{{ $tag }}
                                    <span class="remove-tag" style="cursor:pointer">&times;</span>
                                    <input type="hidden" name="tags[]" value="{{ $tag }}">
                                </span>
                            @endforeach
                        </div>
                        <button type="button" class="btn btn-secondary btn-sm mt-2" data-toggle="modal" data-target="#tagModal">
                                Add Tag
                        </button>

                    </div>
                </div>

                <div class="mb-3">
                    <label>Priority</label>
                    <input type="number" name="priority" class="form-control" value="{{ old('priority', $highlight->priority) }}">
                </div>

                <button type="submit" class="btn btn-success">Update</button>
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
                            <!--add new tag-->
                            <div class="mt-3">
                                <input type="text" id="newTagName" class="form-control border rounded" placeholder="Enter new tag">
                                <button type="button" id="addTempTag" class="btn btn-primary mt-2">Add New Tag</button>
                            </div>
                        </div>
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
    $('#addTempTag').click(function() {
        let tagName = $('#newTagName').val().trim();
        if (tagName === '') {
            alert('Please enter a tag name.');
            return;
        }
        
        addTagToForm(tagName);
        $('#newTagName').val('');
    });

    // ฟังก์ชันเพิ่มแท็กเข้า Form
    function addTagToForm(tag) {
        if ($('#selected-tags input[value="'+tag+'"]').length == 0) {
            $('#selected-tags').append(`
                <span class="badge badge-primary m-1">${tag}
                    <span class="remove-tag" style="cursor:pointer">&times;</span>
                    <input type="hidden" name="tags[]" value="${tag}">
                </span>
            `);
        }
    }

    // ลบแท็กที่เลือก
    $(document).on('click', '.remove-tag', function(){
        $(this).parent('.badge').remove();
    });
});
</script>

@endsection
