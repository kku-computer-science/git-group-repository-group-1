@extends('dashboards.users.layouts.user-dash-layout')
<link rel="stylesheet" href="https://cdn.datatables.net/fixedheader/3.2.3/css/fixedHeader.bootstrap4.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.0/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/fixedheader/3.2.3/css/fixedHeader.bootstrap4.min.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
@section('content')

<style>
.table-responsive {
    margin: 30px 0;
}

.table-wrapper {
    min-width: 1000px;
    background: #fff;
    padding: 20px 25px;
    border-radius: 3px;
    box-shadow: 0 1px 1px rgba(0, 0, 0, .05);
}

.search-box {
    position: relative;
    float: right;
    top:0;
}

.search-box .input-group {
    min-width: 300px;
    position: absolute;
    right: 0;
}

.search-box .input-group-addon,
.search-box input {
    border-color: #ddd;
    border-radius: 0;
}

.search-box input {
    height: 34px;
    padding-right: 35px;
    background: #0e393e;
    color: #ffffff;
    border: none;
    border-radius: 15px !important;
}

.search-box input:focus {
    background: #0e393e;
    color: #ffffff;
}

.search-box input::placeholder {
    font-style: italic;
}

.search-box .input-group-addon {
    min-width: 35px;
    border: none;
    background: transparent;
    position: absolute;
    right: 0;
    z-index: 9;
    padding: 6px 0;
}

.search-box i {
    color: #a0a5b1;
    font-size: 19px;
    position: relative;
    top: 2px;
}
</style>
<script>
$(document).ready(function() {
    // Activate tooltips
    $('[data-toggle="tooltip"]').tooltip();

    // Filter table rows based on searched term
    $("#search").on("keyup", function() {
        var term = $(this).val().toLowerCase();
        $("table tbody tr").each(function() {
            $row = $(this);
            var name = $row.find("td:nth-child(2)").text().toLowerCase();
            console.log(name);
            if (name.search(term) < 0) {
                $row.hide();
            } else {
                $row.show();
            }
        });
    });
});
</script>
<div class="container">
    @if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
    @endif
    <div class="card" style="padding: 16px;">
        <div class="card-body">
            <h4 class="card-title">Users</h4>
            <!-- <p class="card-description">สามารถ Export ข้อมูลของอาจารย์แต่ละท่าน</p> -->
            <!-- <div class="search-box">
                <div class="input-group">
                    <input type="text" id="search" class="form-control" placeholder="Search by Name">
                    <span class="input-group-addon"><i class="material-icons">&#xE8B6;</i></span>
                </div>
            </div> -->

            <div class="table-responsive mt-5">
                <table id="example1" class="table table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>หลักสูตร</th>
                            <th>Email</th>
                            <th>Roles</th>
                            <th width="280px">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i=1 ?>
                        @foreach ($data as $key => $user)
                        <tr>
                            <td>{{ $i++ }}</td>
                            <td>{{ $user->fname_en }} {{ $user->lname_en }} </td>
                            <td>{{ $user->program->program_name_en }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                @if(!empty($user->getRoleNames()))
                                @foreach($user->getRoleNames() as $val)
                                <label class="badge badge-dark">{{ $val }}</label>
                                @endforeach
                                @endif
                            </td>
                            <td>
                                <a class="btn btn-danger btn-sm" type="button" data-toggle="tooltip"
                                    data-placement="top" title="PDF" href="{{ route('pdf', ['id' => $user->id]) }}"><i
                                        class="mdi mdi-file-pdf"></i></a>

                                <a class="btn btn-success btn-sm" type="button" data-toggle="tooltip"
                                    data-placement="top" title="EXCEL" href="{{ route('excel', ['id' => $user->id]) }}"><i
                                        class="mdi mdi-file-excel"></i></a>

                                <a class="btn btn-primary btn-sm" type="button" data-toggle="tooltip"
                                    data-placement="top" title="WORD" href="{{ route('docx', ['id' => $user->id]) }}"><i
                                        class="mdi mdi-file-word"></i></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
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
@stop