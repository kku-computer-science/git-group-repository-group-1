@extends('dashboards.users.layouts.user-dash-layout')
<link rel="stylesheet" href="https://cdn.datatables.net/fixedheader/3.2.3/css/fixedHeader.bootstrap4.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.0/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/fixedheader/3.2.3/css/fixedHeader.bootstrap4.min.css">
@section('title','Dashboard')

@section('content')

<div class="container">
    @if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
    @endif
    <div class="card" style="padding: 16px;">
        <div class="card-body">
            <h4 class="card-title">Book</h4>
            <a class="btn btn-primary btn-menu btn-icon-text btn-sm mb-3" href="{{ route('books.create') }}"><i class="mdi mdi-plus btn-icon-prepend"></i> ADD </a>
            <!-- <div class="table-responsive"> -->
                <table id="example1" class="table table-striped">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>ชื่อ</th>
                            <th>ปี(พ.ศ.)</th>
                            <th>แหล่งเผยแพร่</th>
                            <th>หน้า</th>
                            <th width="280px">Action</th>
                        </tr>
                        <thead>
                        <tbody>
                            @foreach ($books as $i=>$paper)
                            <tr>
                                <td>{{ $i+1 }}</td>
                                <td>{{ Str::limit($paper->ac_name,50) }}</td>
                                <td>{{ date('Y', strtotime($paper->ac_year))+543 }}</td>
                                <td>{{ Str::limit($paper->ac_sourcetitle,50) }}</td>
                                <td>{{ $paper->ac_page}}</td>
                                <td>
                                    <form action="{{ route('books.destroy',$paper->id) }}" method="POST">

                                        <!-- <a class="btn btn-info" href="{{ route('books.show',$paper->id) }}">Show</a> -->
                                        <li class="list-inline-item">
                                            <a class="btn btn-outline-primary btn-sm" type="button" data-toggle="tooltip" data-placement="top" title="view" href="{{ route('books.show',$paper->id) }}"><i class="mdi mdi-eye"></i></a>
                                        </li>
                                        <!-- <a class="btn btn-primary" href="{{ route('books.edit',$paper->id) }}">Edit</a> -->
                                        @if(Auth::user()->can('update',$paper))
                                        <li class="list-inline-item">
                                            <a class="btn btn-outline-success btn-sm" type="button" data-toggle="tooltip" data-placement="top" title="Edit" href="{{ route('books.edit',$paper->id) }}"><i class="mdi mdi-pencil"></i></a>
                                        </li>
                                        @endif

                                        @if(Auth::user()->can('delete',$paper))
                                        @csrf
                                        @method('DELETE')
                                        <li class="list-inline-item">
                                            <button class="btn btn-outline-danger btn-sm show_confirm" type="submit" data-toggle="tooltip" data-placement="top" title="Delete"><i class="mdi mdi-delete"></i></button>
                                        </li>
                                        @endif
                                        <!-- <button type="submit" class="btn btn-danger">Delete</button> -->
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                    <tbody>
                </table>
            <!-- </div> -->
            <br>
            
        </div>
    </div>


</div>
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src = "http://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js" defer ></script>
<script src = "https://cdn.datatables.net/1.12.0/js/dataTables.bootstrap4.min.js" defer ></script>
<script src = "https://cdn.datatables.net/fixedheader/3.2.3/js/dataTables.fixedHeader.min.js" defer ></script>
<script>
    $(document).ready(function() {
        var table1 = $('#example1').DataTable({
            responsive: true,
        });
    });
</script>
<script type="text/javascript">
    $('.show_confirm').click(function(event) {
        var form = $(this).closest("form");
        var name = $(this).data("name");
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
                    swal("Delete Successfully", {
                        icon: "success",
                    }).then(function() {
                        location.reload();
                        form.submit();
                    });
                }
            });
    });
</script>
@stop