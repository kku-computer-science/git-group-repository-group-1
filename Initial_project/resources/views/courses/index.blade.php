@extends('dashboards.users.layouts.user-dash-layout')
@section('content')
<div class="row">
    <div class="col-lg-12" style="text-align: center">
        <div>
            <h2>course</h2>
        </div>
        <br />
    </div>
</div>
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-right">
            <a href="javascript:void(0)" class="btn btn-success mb-2" id="new-course" data-toggle="modal">Add
                course</a>
        </div>
    </div>
</div>
<br />
@if ($message = Session::get('success'))
<div class="alert alert-success">
    <p id="msg">{{ $message }}</p>
</div>
@endif
<table class="table table-bordered">
    <tr>
        <th>ID</th>
        <th>Code</th>
        <th>Name</th>
        <th width="280px">Action</th>
    </tr>

    @foreach ($courses as $course)
    <tr id="course_id_{{ $course->id }}">
        <td>{{ $course->id }}</td>
        <td>{{ $course->course_code }}</td>
        <td>{{ $course->course_name }}</td>
        <td>
            <form action="{{ route('courses.destroy',$course->id) }}" method="POST">
                <a class="btn btn-info" id="show-course" data-toggle="modal" data-id="{{ $course->id }}">Show</a>
                <a href="javascript:void(0)" class="btn btn-success" id="edit-course" data-toggle="modal" data-id="{{ $course->id }}">Edit </a>
                <meta name="csrf-token" content="{{ csrf_token() }}">
                <a id="delete-course" data-id="{{ $course->id }}" class="btn btn-danger delete-user">Delete</a>
        </td>
        </form>
        </td>
    </tr>
    @endforeach

</table>
{!! $courses->links() !!}
<!-- Add and Edit course modal -->
<div class="modal fade" id="crud-modal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="courseCrudModal"></h4>
            </div>
            <div class="modal-body">
                <form name="courseForm" action="{{ route('courses.store') }}" method="POST">
                    <input type="hidden" name="course_id" id="course_id">
                    @csrf
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Code:</strong>
                                <input type="text" name="course_code" id="course_code" class="form-control"
                                    placeholder="course_code" onchange="validate()">
                            </div>
                            <div class="form-group">
                                <strong>Name:</strong>
                                <input type="text" name="course_name" id="course_name" class="form-control"
                                    placeholder="course_name" onchange="validate()">
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                            <button type="submit" id="btn-save" name="btnsave" class="btn btn-primary"
                                disabled>Submit</button>
                            <a href="{{ route('courses.index') }}" class="btn btn-danger">Cancel</a>
                            <!-- <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button> -->
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@stop
@section('javascript')
<script>
$(document).ready(function() {

    /* When click New course button */
    $('#new-course').click(function() {
        $('#btn-save').val("create-course");
        $('#course').trigger("reset");
        $('#courseCrudModal').html("Add New course");
        $('#crud-modal').modal('show');
    });

    /* Edit course */
    $('body').on('click', '#edit-course', function() {
        var course_id = $(this).data('id');
        $.get('courses/' + course_id + '/edit', function(data) {
            $('#courseCrudModal').html("Edit course");
            $('#btn-update').val("Update");
            $('#btn-save').prop('disabled', false);
            $('#crud-modal').modal('show');
            $('#course_id').val(data.id);
            $('#course_code').val(data.course_code);
            $('#course_name').val(data.course_name);
        })
    });


    /* Delete course */
    $('body').on('click', '#delete-course', function() {
        var course_id = $(this).data("id");
        var token = $("meta[name='csrf-token']").attr("content");
        confirm("Are You sure want to delete !");

        $.ajax({
            type: "DELETE",
            url: "courses/" + course_id,
            data: {
                "id": course_id,
                "_token": token,
            },
            success: function(data) {
                $('#msg').html('course entry deleted successfully');
                $("#course_id_" + course_id).remove();
            },
            error: function(data) {
                console.log('Error:', data);
            }
        });
    });
});
</script>

@stop
<script>
error = false

function validate() {
    if (document.courseForm.course_code.value != '' && document.courseForm.course_name.value !='')
        document.courseForm.btnsave.disabled = false
    else
        document.courseForm.btnsave.disabled = true
}
</script>