@extends('dashboards.users.layouts.user-dash-layout')
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
@section('content')
<style type="text/css">
    .dropdown-toggle .filter-option {
        height: 40px;
        width: 400px !important;
        color: #212529;
        background-color: #fff;
        border-width: 0.2;
        border-style: solid;
        border-color: -internal-light-dark(rgb(118, 118, 118), rgb(133, 133, 133));
        border-radius: 5px;
        padding: 4px 10px;
    }

    .my-select {
        background-color: #fff;
        color: #212529;
        border: #000 0.2 solid;
        border-radius: 5px;
        padding: 4px 10px;
        width: 100%;
        font-size: 14px;
    }
</style>
<div class="container">
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-right">

            </div>
        </div>
    </div>

    @if ($errors->any())
    <div class="alert alert-danger">
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <!-- <a class="btn btn-primary" href="{{ route('papers.index') }}"> Back </a> -->

    <div class="col-md-10 grid-margin stretch-card">
        <div class="card" style="padding: 16px;">
            <div class="card-body">
                <h4 class="card-title">{{ trans('message.addPublication') }}</h4>
                <p class="card-description">{{ trans('message.addResearchDetail') }}</p>
                <form class="forms-sample" action="{{ route('papers.store') }}" method="POST">
                    @csrf
                    <div class="form-group row">
                        <label for="exampleInputpaper_name" class="col-sm-3 col-form-label"><b>{{ trans('message.addResearchSource') }}</b></label>
                        <div class="col-sm-9">
                            <select class="selectpicker" multiple data-live-search="true" name="cat[]">
                                @foreach( $source as $s)
                                <option value='{{ $s->id }}'>{{ $s->source_name }}</option>
                                @endforeach
                            </select>

                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="exampleInputpaper_name" class="col-sm-3 col-form-label"><b>{{ trans('message.researchName') }}</b></label>
                        <div class="col-sm-9">
                            <input type="text" name="paper_name" class="form-control" placeholder="ชื่อเรื่อง">
                        </div>
                    </div>
                    
                    <!-- <div class="form-group row">
                        <label for="exampleInputpaper_type" class="col-sm-3 col-form-label"><b>ประเภทของเอกสาร</b></label>
                        <div class="col-sm-9">
                            <input type="text" name="paper_type" class="form-control" placeholder="paper_type">
                        </div>
                    </div> -->

                    <div class="form-group row">
                        <label for="exampleInputabstract" class="col-sm-3 col-form-label"><b>{{ trans('message.abstract') }}</b></label>
                        <div class="col-sm-9">
                            <textarea type="text" name="abstract" class="form-control form-control-lg" style="height:150px" placeholder="abstract"></textarea>
                            <!-- <input type=" text" name="abstract" class="form-control" placeholder="abstract"> -->
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="exampleInputkeyword" class="col-sm-3 col-form-label"><b>{{ trans('message.keyword') }}</b></label>
                        <!-- <div class="col-sm-9">
                            <p>แต่ละคําต้องคั่นด้วยเครื่องหมายเซมิโคลอน (;) แล้วเว้นวรรคหนึ่งครั้ง</p>
                        </div> -->
                        <div class="col-sm-9">
                            <input type="text" name="keyword" class="form-control" placeholder="keyword">
                            <p class="text-danger">{{ trans('message.addResearchDetailLines') }}</p>
                        </div>

                    </div>
                    <div class="form-group row">
                        <label for="exampleInputpaper_type" class="col-sm-3 col-form-label"><b>ประเภทของเอกสาร
                                (Type)</b></label>
                        <div class="col-sm-9">
                            <select id='paper_type' class="custom-select my-select" style='width: 200px;' name="paper_type">
                                <option value="" disabled selected> {{ trans('message.addResearchtype') }} </option>
                                <option value="Journal">{{ trans('message.journal')}}</option>
                                <option value="Conference Proceeding">{{ trans('message.confProceeding')}}</option>
                                <option value="Book Series">{{ trans('message.bookSeries')}}</option>
                                <option value="Book">{{ trans('message.book')}}</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="exampleInputpaper_subtype" class="col-sm-3 col-form-label"><b>{{ trans('message.subType')}}
                                (Subtype)</b></label>
                        <div class="col-sm-9">
                            <select id='paper_subtype' class="custom-select my-select" style='width: 200px;' name="paper_subtype">
                                <option value="" disabled selected>{{ trans('message.addResearchSubtype')}}</option>
                                <option value="Article">{{ trans('message.article') }}</option>
                                <option value="Conference Paper">{{ trans('message.conferencePaper') }}</option>
                                <option value="Editorial">{{ trans('message.editorial') }}</option>
                                <option value="Book Chapter">{{ trans('message.bookChapter') }}</option>
                                <option value="Erratum">{{ trans('message.erratum') }}</option>
                                <option value="Review">{{ trans('message.review') }}</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="exampleInputpublicatione" class="col-sm-3 col-form-label"><b>{{ trans('message.addResearchSubtype')}}
                                </b></label>
                        <div class="col-sm-9">
                            <select id='publication' class="custom-select my-select" style='width: 200px;' name="publication">
                                <option value="" disabled selected>{{ trans('message.publication')}}</option>
                                <option value="International Journal">{{ trans('message.internationalJournal')}}</option>
                                <option value="International Book">{{ trans('message.internationalBook')}}</option>
                                <option value="International Conference">{{ trans('message.internationalConference')}}</option>
                                <option value="National Conference">{{ trans('message.nationalConference')}}</option>
                                <option value="National Journal">{{ trans('message.nationalJournal')}}</option>
                                <option value="National Book">{{ trans('message.nationalBook')}}</option>
                                <option value="National Magazine">{{ trans('message.nationalMagazine')}}</option>
                                <option value="Book Chapter">{{ trans('message.bookChapter')}}</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="exampleInputpaper_sourcetitle" class="col-sm-3 col-form-label"><b>{{ trans('message.journalName') }}</b></label>
                        <div class="col-sm-9">
                            <input type="text" name="paper_sourcetitle" class="form-control" placeholder="sourcetitle">
                        </div>
                    </div>
            
                    <div class="form-group row">
                        <label for="exampleInputpaper_yearpub" class="col-sm-3 col-form-label"><b>{{ trans('message.yearJournal') }}</b></label>
                        <div class="col-sm-4">
                            <input type="text" name="paper_yearpub" class="form-control" placeholder="ปีที่ตีพิมพ์">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="exampleInputpaper_volume" class="col-sm-3 col-form-label"><b>{{ trans('message.journalPublished') }}</b></label>
                        <div class="col-sm-4">
                            <input type="text" name="paper_volume" class="form-control" placeholder="Volume">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="exampleInputpaper_issue" class="col-sm-3 col-form-label"><b>{{ trans('message.issueNumber') }}</b></label>
                        <div class="col-sm-4">
                            <input type="text" name="paper_issue" class="form-control" placeholder="Issue">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="exampleInputpaper_citation" class="col-sm-3 col-form-label"><b>{{ trans('message.reference') }}
                                (Citation)</b></label>
                        <div class="col-sm-4">
                            <input type="text" name="paper_citation" class="form-control" placeholder="จำนวนการอ้างอิง">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="exampleInputpaper_page" class="col-sm-3 col-form-label"><b>{{ trans('message.page') }}</b></label>
                        <div class="col-sm-4">
                            <input type="text" name="paper_page" class="form-control" placeholder="01-99">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="exampleInputpaper_doi" class="col-sm-3 col-form-label"><b>Doi</b></label>
                        <div class="col-sm-9">
                            <input type="text" name="paper_doi" class="form-control" placeholder="doi">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="exampleInputpaper_funder" class="col-sm-3 col-form-label"><b>{{ trans('message.grant') }}</b></label>
                        <div class="col-sm-9">
                            <input type="int" name="paper_funder" class="form-control" placeholder="Funder">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="exampleInputpaper_url" class="col-sm-3 col-form-label"><b>URL</b></label>
                        <div class="col-sm-9">
                            <input type="text" name="paper_url" class="form-control" placeholder="url">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="exampleInputpaper_doi" class="col-sm-3 "><b>{{ trans('message.authorNameInternal') }}</b></label>
                        <div class="col-sm-9">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dynamicAddRemove">
                                    <tr>
                                        <td><select id='selUser0' style='width: 200px;' name="moreFields[0][userid]">
                                                <option value=''>Select User</option>@foreach($users as $user)<option value="{{ $user->id }}">{{ $user->fname_th }} {{ $user->lname_th }}
                                                </option>@endforeach
                                            </select>
                                        </td>
                                        <td><select id='pos' class="custom-select my-select" style='width: 200px;' name="pos[]">
                                                <option value="1">First Author</option>
                                                <option value="2">Co-Author</option>
                                                <option value="3">Corresponding Author</option>
                                            </select>
                                        </td>
                                        <td><button type="button" name="add" id="add-btn2" class="btn btn-success btn-sm"><i class="fas fa-plus"></i></button>
                                        </td>
                                    </tr>
                                </table>
                                <!-- <input type="button" name="submit" id="submit" class="btn btn-info" value="Submit" />-->
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="exampleInputpaper_doi" class="col-sm-3 col-form-label"><b>{{ trans('message.authorNameExternal') }}</b></label>
                        <div class="col-sm-9">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dynamic_field">
                                    <tr>
                                        <td><input type="text" name="fname[]" placeholder="ชื่อ (First name)" class="form-control name_list" /></td>
                                        <td><input type="text" name="lname[]" placeholder="นามสกุล (Last name)" class="form-control name_list" /></td>
                                        <td><select id='pos2' class="custom-select my-select" style='width: 200px;' name="pos2[]">
                                                <option value="1">First Author</option>
                                                <option value="2">Co-Author</option>
                                                <option value="3">Corresponding Author</option>
                                            </select>
                                        </td>
                                        <td><button type="button" name="add" id="add" class="btn btn-success btn-sm"><i class="fas fa-plus"></i></button>
                                        
                                    </tr>
                                </table>
                                <!-- <input type="button" name="submit" id="submit" class="btn btn-info" value="Submit" /> -->
                            </div>
                        </div>
                    </div>
                    <button type="submit" name="submit" id="submit" class="btn btn-primary me-2">{{ trans('message.submit') }}</button>
                    <a class="btn btn-light" href="{{ route('papers.index')}}">{{ trans('message.back') }}</a>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $("#selUser0").select2()
        $("#head0").select2()

        var i = 0;

        $("#add-btn2").click(function() {

            ++i;
            $("#dynamicAddRemove").append('<tr><td><select id="selUser' + i + '" name="moreFields[' + i +
                '][userid]"  style="width: 200px;"><option value="">Select User</option>@foreach($users as $user)<option value="{{ $user->id }}">{{ $user->fname_th }} {{ $user->lname_th }}</option>@endforeach</select></td><td><select id="pos" class="custom-select my-select" style="width: 200px;" name="pos[]"><option value="1">First Author</option><option value="2">Co-Author</option><option value="3">Corresponding Author</option></select></td><td><button type="button" class="btn btn-danger btn-sm remove-tr">X</i></button></td></tr>'
            );
            $("#selUser" + i).select2()
        });
        $(document).on('click', '.remove-tr', function() {
            $(this).parents('tr').remove();
        });

    });
</script>
<script type="text/javascript">
    $(document).ready(function() {
        var postURL = "<?php echo url('addmore'); ?>";
        var i = 1;


        $('#add').click(function() {
            i++;
            $('#dynamic_field').append('<tr id="row' + i +
                '" class="dynamic-added"><td><input type="text" name="fname[]" placeholder="Enter your Name" class="form-control name_list" /></td><td><input type="text" name="lname[]" placeholder="Enter your Name" class="form-control name_list" /></td><td><select id="pos2" class="custom-select my-select" style="width: 200px;" name="pos2[]"><option value="1">First Author</option><option value="2">Co-Author</option><option value="3">Corresponding Author</option></select></td><td><button type="button" name="remove" id="' +
                i + '" class="btn btn-danger btn-sm btn_remove">X</button></td></tr>');
        });


        $(document).on('click', '.btn_remove', function() {
            var button_id = $(this).attr("id");
            $('#row' + button_id + '').remove();
        });


        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });


        $('#submit').click(function() {
            $.ajax({
                url: postURL,
                method: "POST",
                data: $('#add_name').serialize(),
                type: 'json',
                success: function(data) {
                    if (data.error) {
                        printErrorMsg(data.error);
                    } else {
                        i = 1;
                        $('.dynamic-added').remove();
                        $('#add_name')[0].reset();
                        $(".print-success-msg").find("ul").html('');
                        $(".print-success-msg").css('display', 'block');
                        $(".print-error-msg").css('display', 'none');
                        $(".print-success-msg").find("ul").append(
                            '<li>Record Inserted Successfully.</li>');
                    }
                }
            });
        });


        function printErrorMsg(msg) {
            $(".print-error-msg").find("ul").html('');
            $(".print-error-msg").css('display', 'block');
            $(".print-success-msg").css('display', 'none');
            $.each(msg, function(key, value) {
                $(".print-error-msg").find("ul").append('<li>' + value + '</li>');
            });
        }
    });
</script>
@endsection
<!-- <form action="{{ route('papers.store') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Name:</strong>
                    <input type="text" name="paper_name" class="form-control" placeholder="paper_name">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Year:</strong>
                    <textarea class="form-control" style="height:150px" name="paper_year" placeholder="paper_year"></textarea>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>paper_type:</strong>
                    <textarea class="form-control" style="height:150px" name="paper_type" placeholder="paper_type"></textarea>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>paper_level:</strong>
                    <textarea class="form-control" style="height:150px" name="paper_level" placeholder="paper_level"></textarea>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>paper_details:</strong>
                    <textarea class="form-control" style="height:150px" name="paper_details" placeholder="paper_details"></textarea>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>

    </form>
</div> -->