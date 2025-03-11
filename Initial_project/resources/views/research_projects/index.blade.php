@extends('dashboards.users.layouts.user-dash-layout')
<link rel="stylesheet" href="https://cdn.datatables.net/fixedheader/3.2.3/css/fixedHeader.bootstrap4.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.0/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/fixedheader/3.2.3/css/fixedHeader.bootstrap4.min.css">
@section('title','Project')

@section('content')

<div class="container">

    @if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
    @endif
    <div class="card" style="padding: 16px;">
        <div class="card-body">
            <h4 class="card-title">โครงการวิจัย</h4>
            <a class="btn btn-primary btn-menu btn-icon-text btn-sm mb-3" href="{{ route('researchProjects.create') }}"><i class="mdi mdi-plus btn-icon-prepend"></i> ADD</a>
            <!-- <div class="table-responsive"> -->
                <table id="example1" class="table table-striped">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Year</th>
                            <th>Project name</th>
                            <th>Head</th>
                            <th>Member</th>
                            <th width="auto">Action</th>
                        </tr>
                        <thead>
                        <tbody>
                            @foreach ($researchProjects as $i=>$researchProject)
                            <tr>
                                <td>{{ $i+1 }}</td>
                                <td>{{ $researchProject->project_year }}</td>
                                {{-- <td>{{ $researchProject->project_name }}</td> --}}
                                <td>{{ Str::limit($researchProject->project_name,70) }}</td>
                                <td>
                                    @foreach($researchProject->user as $user)
                                    @if ( $user->pivot->role == 1)
                                    {{ $user->fname_en}}
                                    @endif

                                    @endforeach
                                </td>
                                <td>
                                    @foreach($researchProject->user as $user)
                                    @if ( $user->pivot->role == 2)
                                    {{ $user->fname_en}}
                                    @endif

                                    @endforeach
                                </td>
                                <td>
                                    <form action="{{ route('researchProjects.destroy',$researchProject->id) }}"method="POST">
                                    <li class="list-inline-item">
                                    <a class="btn btn-outline-primary btn-sm" type="button" data-toggle="tooltip"
                                            data-placement="top" title="view"
                                            href="{{ route('researchProjects.show',$researchProject->id) }}"><i
                                                class="mdi mdi-eye"></i></a>
                                    </li>
                                        <!-- @if(Auth::user()->can('update',$researchProject))
                                <a class="btn btn-primary"
                                    href="{{ route('researchProjects.edit',$researchProject->id) }}">Edit</a>
                                @endif -->
                               
                                        @if(Auth::user()->can('update',$researchProject)) 
                                        <li class="list-inline-item">
                                        <a class="btn btn-outline-success btn-sm" type="button" data-toggle="tooltip"
                                            data-placement="top" title="Edit"
                                            href="{{ route('researchProjects.edit',$researchProject->id) }}"><i
                                                class="mdi mdi-pencil"></i></a>
                                             </li>
                                        @endif
                               
                                        @if(Auth::user()->can('delete',$researchProject))
                                        @csrf
                                        @method('DELETE')

                                        <li class="list-inline-item">
                                            <button class="btn btn-outline-danger btn-sm show_confirm" type="submit"
                                                data-toggle="tooltip" data-placement="top" title="Delete"><i
                                                    class="mdi mdi-delete"></i></button>
                                        </li>
                                        @endif
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