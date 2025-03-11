@extends('dashboards.users.layouts.user-dash-layout')

@section('content')
<div class="container">
    <div class="justify-content-center">
        @if (count($errors) > 0)
        <div class="alert alert-danger">
            <strong>Opps!</strong> Something went wrong, please check below errors.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <div class="col-md-8 grid-margin stretch-card">
            <div class="card" style="padding: 16px;">
                <div class="card-body">
                    <h4 class="card-title mb-5">เพิ่มผู้ใช้งาน</h4>
                    <p class="card-description">กรอกข้อมูลแก้ไขรายละเอียดผู้ใช้งาน</p>
                    {!! Form::open(array('route' => 'users.store','method'=>'POST')) !!}
                    <div class="form-group row">
                        <div class="col-sm-6">
                            <p><b>ชื่อ (ภาษาไทย)</b></p>
                            {!! Form::text('fname_th', null, array('placeholder' => 'ชื่อภาษาไทย','class' =>
                            'form-control')) !!}
                        </div>
                        <div class="col-sm-6">
                            <p><b>นามสกุล (ภาษาไทย)</b></p>
                            {!! Form::text('lname_th', null, array('placeholder' => 'นามสกุลภาษาไทย','class' =>
                            'form-control')) !!}
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-6">
                            <p><b>ชื่อ (English)</b></p>
                            {!! Form::text('fname_en', null, array('placeholder' => 'ชื่อภาษาอังกฤษ','class' =>
                            'form-control')) !!}
                        </div>
                        <div class="col-sm-6">
                            <p><b>นามสกุล (English)</b></p>
                            {!! Form::text('lname_en', null, array('placeholder' => 'นามสกุลภาษาอังกฤษ','class' =>
                            'form-control')) !!}
                        </div>
                    </div>
                    <div class="form-group row">

                        <div class="col-sm-8">
                            <p><b>Email</b></p>
                            {!! Form::text('email', null, array('placeholder' => 'Email','class' => 'form-control'))!!}
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-6">
                            <p><b>Password:</b></p>
                            {!! Form::password('password', array('placeholder' => 'Password','class' => 'form-control'))!!}
                        </div>
                        <div class="col-sm-6">
                            <p><b>Confirm Password:</p></b>
                            {!! Form::password('password_confirmation', array('placeholder' => 'Confirm Password','class' =>'form-control')) !!}
                        </div>
                    </div>
                    <div class="form-group col-sm-8">
                    <p><b>Role:</b></p>
                        <div class="col-sm-8">
                            
                            {!! Form::select('roles[]', $roles,[],  array('class' => 'selectpicker','multiple')) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                                <h6 for="category">Department <span class="text-danger">*</span></h6>
                                <select class="form-control" name="cat" id="cat" style="width: 100%;" required>
                                    <option>Select Category</option>
                                    @foreach ($departments as $cat)
                                    <option value="{{$cat->id}}">{{ $cat->department_name_en }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4">
                                <h6 for="subcat">Program <span class="text-danger">*</span></h6>
                                <select class="form-control select2" name="sub_cat" id="subcat" required>
                                    <option value="">Select Subcategory</option>
                                </select>
                            </div>

                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">Submit</button>
                    <a class="btn btn-secondary" href="{{ route('users.index') }}">Cencel</a>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>

    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script> -->

<script>
    $('#cat').on('change', function(e) {
        var cat_id = e.target.value;
        $.get('/ajax-get-subcat?cat_id=' + cat_id, function(data) {
            $('#subcat').empty();
            $.each(data, function(index, areaObj) {
                //console.log(areaObj)
                $('#subcat').append('<option value="' + areaObj.id + '">' + areaObj.degree.title_en +' in '+ areaObj.program_name_en + '</option>');
            });
        });
    });
</script>

@endsection