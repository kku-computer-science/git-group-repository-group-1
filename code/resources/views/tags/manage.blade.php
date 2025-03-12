@extends('dashboards.users.layouts.user-dash-layout')

@section('content')
<div class="container">
    <div class="card shadow-sm p-4">
        <div class="card-body">
            <h4 class="card-title mb-3">Manage Tags</h4>

                <!-- Add Tag Form -->
                <div class="mb-3">
                    <input type="text" id="newTagName" class="form-control" placeholder="Enter new tag">
                    <button class="btn btn-primary mt-3" id="addTag">Add Tag</button>
                </div>

                <!-- Tags List -->
                <table class="table table-bordered ">
                    <thead>
                        <tr>
                            <th>Tag Name</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="tagsTable">
                        @foreach($tags as $tag)
                            <tr data-id="{{ $tag->id }}">
                                <td contenteditable="true" class="tag-name">{{ $tag->name }}</td>
                                <td>
                                    <button class="btn btn-sm btn-success update-tag">Update</button>
                                    <button class="btn btn-sm btn-danger delete-tag">Delete</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <script>
            $(document).ready(function() {
                // Add Tag
                $('#addTag').click(function() {
                    let tagName = $('#newTagName').val().trim();
                    if (tagName === '') {
                        alert('Please enter a tag name.');
                        return;
                    }

                    $.ajax({
                        url: "{{ route('tags.store') }}",
                        method: "POST",
                        data: { name: tagName, _token: "{{ csrf_token() }}" },
                        success: function(response) {
                            if (response.success) {
                                location.reload();
                            }
                        }
                    });
                });

                // Update Tag
                $('.update-tag').click(function() {
                    let row = $(this).closest('tr');
                    let tagId = row.data('id');
                    let newName = row.find('.tag-name').text().trim();

                    $.ajax({
                        url: "/tags/" + tagId,
                        method: "PUT",
                        data: { name: newName, _token: "{{ csrf_token() }}" },
                        success: function(response) {
                            alert('Tag updated!');
                        }
                    });
                });

                // Delete Tag
                $('.delete-tag').click(function() {
                    if (!confirm('Are you sure you want to delete this tag?')) return;
                    
                    let row = $(this).closest('tr');
                    let tagId = row.data('id');

                    $.ajax({
                        url: "/tags/" + tagId,
                        method: "DELETE",
                        data: { _token: "{{ csrf_token() }}" },
                        success: function(response) {
                            if (response.success) {
                                row.remove();
                            }
                        }
                    });
                });
            });
            </script>
            @endsection