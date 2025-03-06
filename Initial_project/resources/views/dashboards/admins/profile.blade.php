@extends('dashboards.users.layouts.user-dash-layout')
@section('title','Profile')
<style>
    body label:not(.input-group-text) {
        margin-top: 10px;
    }

    body .my-select {
        background-color: #DABCAA;
        color: #5F6162;
        border: 0 none;
        border-radius: 10px;
        padding: 6px 20px;
        width: 100%;
    }
</style>
@section('content')
<div class="container profile">
    <h2 class="mb-5">Account Settings</h2>

    <div class="bg-white shadow rounded-lg d-block d-sm-flex">
        <div class="profile-tab-nav border-right">
            <div class="p-4">
                <div class="img-circle text-center mb-3">
                    <div class="text-center">
                        <img class="profile-user-img img-fluid img-circle admin_picture" src="{{ Auth::user()->picture }}" alt="User profile picture">
                    </div>
                    <h4 class="text-center p-2">{{ Auth::user()->fname }} {{ Auth::user()->lname }}</h4>
                    <input type="file" name="admin_image" id="admin_image" style="opacity: 0;height:1px;display:none">
                    <a href="javascript:void(0)" class="btn btn-primary btn-block btn-sm" id="change_picture_btn"><b>Change picture</b></a>
                </div>

            </div>
            <div class="nav flex-column nav-pills-1" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                <a class="nav-link active" id="account-tab" data-toggle="pill" href="#account" role="tab" aria-controls="account" aria-selected="true">
                    <i class="mdi mdi-account-card-details"></i>
                    <span class="menu-title"> Account </span>
                </a>
                <a class="nav-link " id="password-tab" data-toggle="pill" href="#password" role="tab" aria-controls="password" aria-selected="false">
                    <i class="mdi mdi-key-variant"></i>
                    <span class="menu-title"> Password </span>
                </a>
                <a class="nav-link" id="expertise-tab" data-toggle="pill" href="#expertise" role="tab" aria-controls="expertise" aria-selected="false">
                    <i class="mdi mdi-account-star"></i>
                    <span class="menu-title"> Expertise </span>
                </a>
                <a class="nav-link" id="education-tab" data-toggle="pill" href="#education" role="tab" aria-controls="education" aria-selected="false">
                    <i class="mdi mdi-school"></i>
                    <span class="menu-title"> Education </span>
                </a>
            </div>
        </div>
        <div class="tab-content p-4 p-md-5" id="v-pills-tabContent">
            <div class="tab-pane fade show active" id="account" role="tabpanel" aria-labelledby="account-tab">
                <h3 class="mb-4">Account Settings</h3>
                <form class="form-horizontal" method="POST" action="{{ route('adminUpdateInfo') }}" id="AdminInfoForm">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>ชื่อภาษาไทย</label>
                                <input type="text" class="form-control" id="inputFName" placeholder="FName" value="{{ Auth::user()->fname_th }}" name="fname_th">

                                <span class="text-danger error-text name_error"></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>นามสกุลภาษาไทย</label>
                                <input type="text" class="form-control" id="inputLName" placeholder="LName" value="{{ Auth::user()->lname_th }}" name="lname_th">
                                <span class="text-danger error-text name_error"></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>ชื่อภาษาอังกฤษ</label>
                                <input type="text" class="form-control" id="inputFName" placeholder="FName" value="{{ Auth::user()->fname_en }}" name="fname_en">

                                <span class="text-danger error-text name_error"></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>นามสกุลภาษาอังกฤษ</label>
                                <input type="text" class="form-control" id="inputLName" placeholder="LName" value="{{ Auth::user()->lname_en }}" name="lname_en">
                                <span class="text-danger error-text name_error"></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Email</label>
                                <input type="text" class="form-control" id="inputEmail" placeholder="Email" value="{{ Auth::user()->email }}" name="email">
                                <span class="text-danger error-text email_error"></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Position</label>
                                <input type="text" class="form-control" id="inputPosition" placeholder="Position" value="{{ Auth::user()->position_en }}" name="position_en">
                                <span class="text-danger error-text position_error"></span>
                            </div>
                        </div>
                        <br>
                        <!-- <h5 >สำหรับอ.ผู้ที่มีคุณวุฒิปริญญาเอก</h5> -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Academic Ranks</label>
                                <select id="category" class="custom-select my-select" name="position_en">
                                    <option value="Prof. Dr.">Professor</option>
                                    <option value="Assoc. Prof. Dr.">Associate Professor</option>
                                    <option value="Asst. Prof. Dr.">Assistant Professor</option>
                                    <option value="Lecturer">Lecturer</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>ตำแหน่งทางวิชาการ</label>
                                <select name="position_th" id="subcategory" class="custom-select my-select">
                                    <optgroup id="Prof." label="Professor">
                                        <option value="ศ.ดร.">ศาสตราจารย์</option>

                                    </optgroup>
                                    <optgroup id="Assoc. Prof. Dr." label="Associate Professor">
                                        <option value="รศ.ดร.">รองศาสตราจารย์</option>

                                    </optgroup>
                                    <optgroup id="Asst. Prof. Dr." label="Assistant Professor">
                                        <option value="ผศ.ดร.">ผู้ช่วยศาสตราจารย์</option>

                                    </optgroup>
                                    <optgroup id="Lecturer" label="Lecturer">
                                        <option value="อ.ดร.">อาจารย์</option>
                                    </optgroup>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div>

                        <button type="submit" class="btn btn-primary">Update</button>

                    </div>

                </form>

            </div>

            <div class="tab-pane fade" id="password" role="tabpanel" aria-labelledby="password-tab">
                <form class="form-horizontal" action="{{ route('adminChangePassword') }}" method="POST" id="changePasswordAdminForm">
                    <h3 class="mb-4">Password Settings</h3>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Old password</label>
                                <input type="password" class="form-control" id="inputPassword" placeholder="Enter current password" name="oldpassword">
                                <span class="text-danger error-text oldpassword_error"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>New password</label>
                                <input type="password" class="form-control" id="newpassword" placeholder="Enter new password" name="newpassword">
                                <span class="text-danger error-text newpassword_error"></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Confirm new password</label>
                                <input type="password" class="form-control" id="cnewpassword" placeholder="ReEnter new password" name="cnewpassword">
                                <span class="text-danger error-text cnewpassword_error"></span>
                            </div>
                        </div>
                    </div>
                    <div>
                        <button class="btn btn-primary">Update</button>
                        <!-- <button class="btn btn-light">Cancel</button> -->
                    </div>

                </form>

            </div>
            <div class="tab-pane fade" id="education" role="tabpanel" aria-labelledby="education-tab">
                <form class="form-horizontal" action="{{ route('adminChangePassword') }}" method="POST" id="changePasswordAdminForm">
                    <h3 class="mb-4">Password Settings</h3>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Old password</label>
                                <input type="password" class="form-control" id="inputPassword" placeholder="Enter current password" name="oldpassword">
                                <span class="text-danger error-text oldpassword_error"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>New password</label>
                                <input type="password" class="form-control" id="newpassword" placeholder="Enter new password" name="newpassword">
                                <span class="text-danger error-text newpassword_error"></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Confirm new password</label>
                                <input type="password" class="form-control" id="cnewpassword" placeholder="ReEnter new password" name="cnewpassword">
                                <span class="text-danger error-text cnewpassword_error"></span>
                            </div>
                        </div>
                    </div>
                    <div>
                        <button class="btn btn-primary">Update</button>
                        <!-- <button class="btn btn-light">Cancel</button> -->
                    </div>

                </form>

            </div>
            <div class="tab-pane fade" id="expertise" role="tabpanel" aria-labelledby="expertise-tab">
                <div class="row">
                    <div class="col-lg-12 margin-tb">
                        <div class="pull-right">
                            <a href="javascript:void(0)" class="btn btn-success mb-2" id="new-expertise" data-toggle="modal">Add
                                Expertise</a>
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


                        <th>Name</th>

                        <th width="280px">Action</th>
                    </tr>

                    @foreach (Auth::user()->expertise as $expert)
                    <tr id="expert_id_{{ $expert->id }}">


                        <td>{{ $expert->expert_name }}</td>

                        <td>
                            <form action="{{ route('experts.destroy',$expert->id) }}" method="POST">
                                <!-- <a class="btn btn-info" id="show-expertise" data-toggle="modal" data-id="{{ $expert->id }}">Show</a> -->
                                <li class="list-inline-item">
                                    <button class="btn btn-success btn-sm rounded-0" href="javascript:void(0)" id="edit-expertise" type="button" data-toggle="modal" data-placement="top" data-id="{{ $expert->id }}" title="Edit"><i class="fa fa-edit"></i></button>
                                </li>
                                <!-- <a href="javascript:void(0)" class="btn btn-success" id="edit-expertise" data-toggle="modal" data-id="{{ $expert->id }}">Edit </a> -->
                                <meta name="csrf-token" content="{{ csrf_token() }}">
                                <li class="list-inline-item">
                                    <button id="delete-expertise" data-id="{{ $expert->id }}" class="btn btn-danger btn-sm rounded-0" type="button" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash"></i></button>
                                </li>
                                <!-- <a id="delete-expertise" data-id="{{ $expert->id }}" class="btn btn-danger delete-user">Delete</a> -->
                            </form>
                        </td>

                    </tr>
                    @endforeach

                </table>
            </div>

            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="crud-modal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="expertiseCrudModal"></h4>
            </div>
            <div class="modal-body">
                <form name="expForm" action="{{ route('experts.store') }}" method="POST">
                    <input type="hidden" name="exp_id" id="exp_id">
                    @csrf
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Name:</strong>
                                <input type="text" name="expert_name" id="expert_name" class="form-control" placeholder="Expert_name" onchange="validate()">
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                            <button type="submit" id="btn-save" name="btnsave" class="btn btn-primary" disabled>Submit</button>
                            <!-- <a  href="{{ URL::previous() }}"class="btn btn-danger">Cancel</a> -->
                            <button class="btn btn-danger" id="btnCancel">Cancel</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
<script src="alert/dist/sweetalert-dev.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script>
    $("#btnCancel").click(function() {
        $('#crud-modal').modal('hide');
    });
</script>
<script>
    $(document).ready(function() {
        var $optgroups = $('#subcategory > optgroup');

        $("#category").on("change", function() {
            var selectedVal = this.value;

            $('#subcategory').html($optgroups.filter('[id="' + selectedVal + '"]'));
        });
    });
</script>

<script>
    $(function() {
        /* UPDATE ADMIN
               PERSONAL INFO */
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        showSwal = function(type) {
            swal({
                    title: "Are you sure update info",
                    text: "Are you sure to proceed?",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#82ce34",
                    confirmButtonText: "Update My Info!",
                    cancelButtonText: "I am not sure!",
                    closeOnConfirm: false,
                    closeOnCancel: false
                },
                function(isConfirm) {
                    if (isConfirm) {
                        swal("Update Info", "Your account is updated!", "success");
                    } else {
                        swal("Cancle", "Account is not updated", "error");
                    }
                });
        }


        $('#AdminInfoForm').on('submit', function(e) {

            e.preventDefault();
            $.ajax({
                url: $(this).attr('action'),
                method: $(this).attr('method'),
                data: new FormData(this),
                processData: false,
                dataType: 'json',
                contentType: false,

                beforeSend: function() {
                    $(document).find('span.error-text').text('');
                },
                success: function(data) {
                    if (data.status == 0) {
                        $.each(data.error, function(prefix, val) {
                            $('span.' + prefix +
                                '_error').text(val[0]);
                        });
                    } else {
                        $('.admin_name').each(function() {
                            $(this).html($('#AdminInfoForm').find($(
                                'input[name="name"]')).val());
                        });

                        alert(data.msg);
                    }
                }
            });
        });
        $(document).on('click', '#change_picture_btn', function() {
            $('#admin_image').click();
        });
        $('#admin_image').ijaboCropTool({
            preview: '.admin_picture',
            setRatio: 1,
            allowedExtensions: ['jpg', 'jpeg', 'png'],
            buttonsText: ['CROP', 'QUIT'],
            buttonsColor: ['#30bf7d', '#ee5155', -15],
            processUrl: '{{ route("adminPictureUpdate") }}',
            withCSRF: ['_token', '{{ csrf_token() }}'],
            onSuccess: function(message, element, status) {
                //swal("Congrats!", message , "success");
                //alert(message);
                swal("Update Profile Picture", "Your account is updated!", "success");
            },
            onError: function(message, element, status) {
                alert(message);
            }
        });
        $('#changePasswordAdminForm').on('submit', function(e) {
            e.preventDefault();
            $.ajax({
                url: $(this).attr('action'),
                method: $(this).attr('method'),
                data: new FormData(this),
                processData: false,
                dataType: 'json',
                contentType: false,
                beforeSend: function() {
                    $(document).find('span.error-text').text('');
                },
                success: function(data) {
                    if (data.status == 0) {
                        $.each(data.error, function(prefix, val) {
                            $('span.' + prefix +
                                '_error').text(val[0]);
                        });
                    } else {
                        $('#changePasswordAdminForm')[0].reset();
                        //alert(data.msg);
                        swal("Update Password", "Your account is Password updated!", "success");
                    }
                }
            });
        });
    });
</script>

<script>
    $(document).ready(function() {

        /* When click New expertise button */
        $('#new-expertise').click(function() {
            $('#btn-save').val("create-expertise");
            $('#expertise').trigger("reset");
            $('#expertiseCrudModal').html("Add New Expertise");
            $('#crud-modal').modal('show');
        });

        /* Edit expertise */
        $('body').on('click', '#edit-expertise', function() {
            var expert_id = $(this).data('id');
            $.get('experts/' + expert_id + '/edit', function(data) {
                $('#expertiseCrudModal').html("Edit Expertise");
                $('#btn-update').val("Update");
                $('#btn-save').prop('disabled', false);
                $('#crud-modal').modal('show');
                $('#exp_id').val(data.id);
                $('#expert_name').val(data.expert_name);
                //swal("Update Profile Picture", "Your account is updated!", "success");
            })

        });


        /* Delete expertise */
        $('body').on('click', '#delete-expertise', function() {
            var expert_id = $(this).data("id");
            var token = $("meta[name='csrf-token']").attr("content");
            confirm("Are You sure want to delete !");

            $.ajax({
                type: "DELETE",
                url: "experts/" + expert_id,
                data: {
                    "id": expert_id,
                    "_token": token,
                },
                success: function(data) {
                    $('#msg').html('expertise entry deleted successfully');
                    $("#expert_id_" + expert_id).remove();
                },
                error: function(data) {
                    console.log('Error:', data);
                }
            });
        });
    });
</script>


<script>
    error = false

    function validate() {
        if (document.expForm.expert_name.value != '')
            document.expForm.btnsave.disabled = false
        else
            document.expForm.btnsave.disabled = true
    }
</script>
@endsection