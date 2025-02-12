@extends('layouts.layout')
@section('content')

<div class="container refund">
    <p>โครงการบริการวิชาการ/ โครงการวิจัย</p>

    <div class="table-refund table-responsive">
        <table id="example1" class="table table-striped" style="width:100%">
            <thead>
                <tr>
                    <th style="font-weight: bold;">ลำดับ</th>
                    <th class="col-md-1" style="font-weight: bold;">ปี</th>
                    <th class="col-md-4" style="font-weight: bold;">ชื่อโครงการ </th>
                    <!-- <th>ระยะเวลาโครงการ</th>
                    <th>ผู้รับผิดชอบโครงการ</th>
                    <th>ประเภททุนวิจัย</th>
                    <th>หน่วยงานที่สนันสนุนทุน</th>
                    <th>งบประมาณที่ได้รับจัดสรร</th> -->
                    <th class="col-md-4" style="font-weight: bold;">รายละเอียด</th>
                    <th class="col-md-2" style="font-weight: bold;">ผู้รับผิดชอบโครงการ</th>
                    <!-- <th class="col-md-5">หน่วยงานที่รับผิดชอบ</th> -->
                    <th class="col-md-1" style="font-weight: bold;">สถานะ</th>
                </tr>
            </thead>

            
            <tbody>
                @foreach($resp as $i => $re)
                <tr>
                    <td style="vertical-align: top;text-align: left;">{{$i+1}}</td>
                    <td style="vertical-align: top;text-align: left;">{{($re->project_year)+543}}</td>
                    <td style="vertical-align: top;text-align: left;">
                        {{$re->project_name}}

                    </td>
                    <td>
                        <div style="padding-bottom: 10px">

                            @if ($re->project_start != null)
                            <span style="font-weight: bold;">
                                ระยะเวลาโครงการ
                            </span>
                            <span style="padding-left: 10px;">
                                {{\Carbon\Carbon::parse($re->project_start)->thaidate('j F Y') }} ถึง {{\Carbon\Carbon::parse($re->project_end)->thaidate('j F Y') }}
                            </span>
                            @else
                            <span style="font-weight: bold;">
                                ระยะเวลาโครงการ
                            </span>
                            <span>

                            </span>
                            @endif
                        </div>


                        <!-- @if ($re->project_start != null)
                    <td>{{\Carbon\Carbon::parse($re->project_start)->thaidate('j F Y') }}<br>ถึง {{\Carbon\Carbon::parse($re->project_end)->thaidate('j F Y') }}</td>
                    @else
                    <td></td>
                    @endif -->

                        <!-- <td>@foreach($re->user as $user)
                        {{$user->position }}{{$user->fname_th}} {{$user->lname_th}}<br>
                        @endforeach
                    </td> -->
                        <!-- <td>
                        @if(is_null($re->fund))
                        @else
                        {{$re->fund->fund_type}}
                        @endif
                    </td> -->
                        <!-- <td>@if(is_null($re->fund))
                        @else
                        {{$re->fund->support_resource}}
                        @endif
                    </td> -->
                        <!-- <td>{{$re->budget}}</td> -->
                        <div style="padding-bottom: 10px;">
                            <span style="font-weight: bold;">ประเภททุนวิจัย</span>
                            <span style="padding-left: 10px;"> @if(is_null($re->fund))
                                @else
                                {{$re->fund->fund_type}}
                                @endif</span>
                        </div>
                        <div style="padding-bottom: 10px;">
                            <span style="font-weight: bold;">หน่วยงานที่สนันสนุนทุน</span>
                            <span style="padding-left: 10px;"> @if(is_null($re->fund))
                                @else
                                {{$re->fund->support_resource}}
                                @endif</span>
                        </div>
                        <div style="padding-bottom: 10px;">
                            <span style="font-weight: bold;">หน่วยงานที่รับผิดชอบ</span>
                            <span style="padding-left: 10px;">
                                {{$re->responsible_department}}
                            </span>
                        </div>
                        <div style="padding-bottom: 10px;">

                            <span style="font-weight: bold;">งบประมาณที่ได้รับจัดสรร</span>
                            <span style="padding-left: 10px;"> {{number_format($re->budget)}} บาท</span>
                        </div>
                    </td>

                    <td style="vertical-align: top;text-align: left;">
                        <div style="padding-bottom: 10px;">
                            <span>@foreach($re->user as $user)
                                {{$user->position_th }} {{$user->fname_th}} {{$user->lname_th}}<br>
                                @endforeach</span>
                        </div>
                    </td>
                    @if($re->status == 1)
                    <td style="vertical-align: top;text-align: left;">
                        <h6><label class="badge badge-success">ยื่นขอ</label></h6>
                    </td>
                    @elseif($re->status == 2)
                    <td style="vertical-align: top;text-align: left;">
                        <h6><label class="badge bg-warning text-dark">ดำเนินการ</label></h6>
                    </td>
                    @else
                    <td style="vertical-align: top;text-align: left;">
                        <h6><label class="badge bg-dark">ปิดโครงการ</label>
                            <h6>
                    </td>
                    @endif
                    <!-- <td></td>
                    <td></td> -->
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>
<script type="text/javascript" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap5.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.9/js/responsive.bootstrap5.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>

<script>
    $(document).ready(function() {

        var table1 = $('#example1').DataTable({
            responsive: true,
        });
    });
</script>
@stop