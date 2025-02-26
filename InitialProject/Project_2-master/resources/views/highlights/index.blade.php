@extends('dashboards.users.layouts.user-dash-layout') 

@section('content')

<div class="container">
    <div class="card" style="padding: 16px;">
        <div class="card-body">
            <h4 class="card-title">{{ trans('message.highlightList') }}</h4>

            <!-- ADD New Highlight Button -->
            <a class="btn btn-primary mb-3" href="{{ route('highlights.create') }}">
                <i class="mdi mdi-plus"></i>{{ trans('message.add') }}
            </a>

            <div class="table-responsive">
                <table id="highlightsTable" class="table table-striped">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Title (EN)</th>
                            <th>Title (TH)</th>
                            <th>Title (CN)</th>
                            <th>Description (EN)</th>
                            <th>Description (TH)</th>
                            <th>Description (CN)</th>
                            <th>Image (EN)</th>
                            <th>Image (TH)</th>
                            <th>Image (CN)</th>
                            <th>Priority</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($highlights as $i => $highlight)
                        <tr>
                            <td>{{ $i + 1 }}</td>
                            <td>{{ $highlight->title_en }}</td>
                            <td>{{ $highlight->title_th }}</td>
                            <td>{{ $highlight->title_cn }}</td>
                            <td>{{ Str::limit($highlight->description_en, 100) }}</td>
                            <td>{{ Str::limit($highlight->description_th, 100) }}</td>
                            <td>{{ Str::limit($highlight->description_cn, 100) }}</td>
                            <td>
                                <img src="{{ asset($highlight->image_url_en) }}" alt="Highlight EN" width="100">
                            </td>
                            <td>
                                <img src="{{ asset($highlight->image_url_th) }}" alt="Highlight TH" width="100">
                            </td>
                            <td>
                                <img src="{{ asset($highlight->image_url_cn) }}" alt="Highlight CN" width="100">
                            </td>
                            <td>{{ $highlight->priority }}</td>
                            <td>
                                <!-- Edit Button -->
                                <a class="btn btn-outline-success btn-sm" href="{{ route('highlights.edit', $highlight->id) }}" title="Edit">
                                    <i class="mdi mdi-pencil"></i>
                                </a>

                                <!-- Delete Form -->
                                <form action="{{ route('highlights.destroy', $highlight->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger btn-sm show_confirm" title="Delete">
                                        <i class="mdi mdi-delete"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- jQuery & DataTables -->
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://cdn.datatables.net/1.12.0/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.12.0/js/dataTables.bootstrap4.min.js"></script>

<script>
    $(document).ready(function() {
        $('#highlightsTable').DataTable(); // Initialize DataTable
    });

    //delete confirm
    $('.show_confirm').click(function(event) {
        var form = $(this).closest("form");
        event.preventDefault();
        swal({
            title: `Are you sure?`,
            text: "If you delete this, it will be gone forever.",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {
                swal("Highlight deleted successfully!", {
                    icon: "success",
                }).then(function() {
                    form.submit();
                });
            }
        });
    });
</script>

@endsection