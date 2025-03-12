@extends('dashboards.users.layouts.user-dash-layout')

@section('content')

<div class="container">
    <div class="card shadow-sm p-4">
        <div class="card-body">
            <h4 class="card-title">Highlight List</h4>

            <!-- ADD New Highlight Button -->
            <a class="btn btn-primary mb-3" href="{{ route('highlights.create') }}">
                <i class="mdi mdi-plus"></i> Add Highlight
            </a>

            <div class="table-responsive">
                <table id="highlightsTable" class="table table-bordered table-striped">
                    <thead class="thead-dark">
                        <tr>
                            <th>No.</th>
                            <th>Title (EN)</th>
                            <th>Title (TH)</th>
                            <th>Description (EN)</th>
                            <th>Description (TH)</th>
                            <th>Image (EN)</th>
                            <th>Image (TH)</th>
                            <th>Tags</th>
                            <th>Priority</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($highlights as $i => $highlight)
                        <tr>
                            <td class="text-center">{{ $i + 1 }}</td>
                            <td>{{ $highlight->title_en }}</td>
                            <td>{{ $highlight->title_th }}</td>
                            <td style="max-width: 200px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                                {{ $highlight->description_en }}
                            </td>
                            <td style="max-width: 200px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                                {{ $highlight->description_th }}
                            </td>
                            <td class="text-center">
                                <img src="{{ asset($highlight->image_url_en) }}" alt="Highlight EN" class="img-thumbnail" width="80">
                            </td>
                            <td class="text-center">
                                <img src="{{ asset($highlight->image_url_th) }}" alt="Highlight TH" class="img-thumbnail" width="80">
                            </td>
                            <!--show highlight tag-->
                            <td>
                                @if($highlight->hasTags()->count() > 0)
                                    <span class="badge badge-primary">Has Tags</span>
                                @else
                                @endif
                            </td>

                            <td class="text-center">{{ $highlight->priority }}</td>
                            <td class="text-center">
                                <!-- Edit Button -->
                                <a class="btn btn-outline-success btn-sm" href="{{ route('highlights.edit', $highlight->id) }}" title="Edit">
                                    <i class="mdi mdi-pencil"></i>
                                </a>

                                <!-- Delete Button with Modal -->
                                <!-- ปุ่มลบ -->
                                <button class="btn btn-outline-danger btn-sm delete-btn" data-id="{{ $highlight->id }}">
                                    <i class="mdi mdi-delete"></i>
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Confirm Deletion</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this highlight? This action cannot be undone.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <form id="deleteForm" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- jQuery (ต้องมาก่อน DataTables) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- DataTables CSS & JS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.0/css/dataTables.bootstrap4.min.css">
<script src="https://cdn.datatables.net/1.12.0/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.12.0/js/dataTables.bootstrap4.min.js"></script>

<script>
$(document).ready(function() {
    // เมื่อกดปุ่มลบ
    $('.delete-btn').click(function() {
        let highlightId = $(this).data('id');

        if (confirm("Are you sure you want to delete this highlight?")) {
            $.ajax({
                url: "/highlights/" + highlightId,
                method: "POST",
                data: {
                    _method: "DELETE",
                    _token: "{{ csrf_token() }}"
                },
                success: function(response) {
                    if (response.success) {
                        alert("Highlight deleted successfully!");
                        location.reload(); // รีเฟรชหน้า
                    } else {
                        alert("Error: " + response.message);
                    }
                },
                error: function(xhr) {
                    alert("Failed to delete highlight. Please try again.");
                    console.error(xhr.responseText);
                }
            });
        }
    });
});


</script>

@endsection
