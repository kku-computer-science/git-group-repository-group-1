<!DOCTYPE html>
<html>

<head>
    <title>Teacher PDF</title>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <style type="text/css">
    @font-face {
        font-family: 'THSarabunNew';
        font-style: normal;
        font-weight: normal;
        src: url("{{ public_path('fonts/THSarabunNew.ttf') }}") format('truetype');
    }

    @font-face {
        font-family: 'THSarabunNew';
        font-style: normal;
        font-weight: bold;
        src: url("{{ public_path('fonts/THSarabunNew Bold.ttf') }}") format('truetype');
    }

    @font-face {
        font-family: 'THSarabunNew';
        font-style: italic;
        font-weight: normal;
        src: url("{{ public_path('fonts/THSarabunNew Italic.ttf') }}") format('truetype');
    }

    @font-face {
        font-family: 'THSarabunNew';
        font-style: italic;
        font-weight: bold;
        src: url("{{ public_path('fonts/THSarabunNew BoldItalic.ttf') }}") format('truetype');
    }

    body {
        font-family: "THSarabunNew";
        padding: 32px;

    }

    .m-0 {
        margin: 0px;
    }

    .p-0 {
        padding: 0px;
    }

    .pt-5 {
        padding-top: 5px;
    }

    .mt-10 {
        margin-top: 10px;
    }

    .text-center {
        text-align: center !important;
    }

    .w-100 {
        width: 100%;
    }

    .w-50 {
        width: 50%;
    }

    .w-85 {
        width: 85%;
    }

    .w-70 {
        width: 70%;
    }

    .w-30 {
        width: 30%;
    }

    .w-15 {
        width: 15%;
    }

    .logo img {
        width: 45px;
        height: 45px;
        padding-top: 30px;
    }

    .logo span {
        margin-left: 8px;
        top: 19px;
        position: absolute;
        font-weight: bold;
        font-size: 25px;
    }

    .gray-color {
        color: #5D5D5D;
    }

    .text-bold {
        font-weight: bold;
    }

    .border {
        border: 1px solid black;
    }

    table tr,
    th,
    td {
        border: 0px solid #fff;
        border-collapse: collapse;
        /* padding: 7px 8px; */
    }

    table tr th {
        background: #fff;
        font-size: 16px;
    }

    table tr td {
        font-size: 14px;
    }

    table {
        border-collapse: collapse;
    }

    .box-text p {
        line-height: 5px;
    }

    .float-left {
        float: left;
    }

    .total-part {
        font-size: 16px;
        line-height: 12px;
    }

    .total-right p {
        padding-right: 20px;
    }
    /* .add-detail{
        padding: 20px;
    } */
    .user {
        position: absolute;
        left: 100px;
        top: 20px;
    }
    .usre {
        position: absolute;
        left: 100px;
        top: 20px;
    }
    </style>
</head>

<body>

    <div class="add-detail">
        <div class="user w-50 float-left">
            <h4 class="m-0 text-bold w-100">{{$user->title_name_th}} {{$user->fname_th}} {{$user->lname_th}}</h4>
            <h4 class="m-0 text-bold w-100">{{$user->title_name_en}} {{$user->fname_en}} {{$user->lname_en}}</h4>
        </div>
        <div style="clear: both;"></div>
        <div class="w-30 float-left" style="margin-left: 30px;">
            <p class="m-0 pt-5  text-bold w-100">ตำแหน่งทางวิชาการ</p>
        </div>
        <div class="w-30 float-left">
            <p class="m-0 pt-5 text-bold w-100">{{$user->academic_ranks_th}}</p>
        </div>
        <div style="clear: both;"></div>
    </div>
        <p class="m-0 pt-5 text-bold w-100" style="margin-left: 30px;">ประวัติการศึกษา</p>
    <div class="table-section bill-tbl">
        <table class="table w-100 ">
            <tr>
                <th style="margin-left: 20px;">ระดับ</th>
                <th style="margin-left: 80px;">ชื่อปริญญา (สาขาวิชา)</th>
                <th style="margin-left: 0px;">ชื่อสถาบัน,ประเทศ</th>
                <th style="margin-left: 80px;">ปี พ.ศ. ที่จบ</th>
            </tr>
            <tr>
                <td align="center">
                    <div class="box-text">
                        <p>ปริญญาตรี</p>
                        <p>ปริญญาโท</p>
                        <p>ปริญญาเอก</p>
                    </div>
                </td>
                <td >
                    <div class="box-text">
                        @foreach($ed as $n)
                        <p style="margin-left: 80px;">{{$n->qua_name}}</p>
                        @endforeach
                    </div>
                </td>
                <td>
                    <div class="box-text">
                        @foreach($ed as $n)
                        <p style="margin-left: 40px;">{{$n->uname}}</p>
                        @endforeach
                    </div>
                </td>
                <td align="center">
                    <div class="box-text">
                        @foreach($ed as $n)
                        <p>{{$n->year}}</p>
                        @endforeach
                    </div>
                </td>
            </tr>
        </table>
    </div>
    
    <h4>ผลงานทางวิชาการ (ผลงาน 5 ปี ย้อนหลัง {{$from+543}}-{{$to+543}})</h4>
    <h4>ตำรา หนังสือ และเอกสารประกอบการสอน</h4>
    @foreach($b as $key=> $b)
    <p class="w-100">
        {{$key+1}}.
        @foreach($b->user as $c)
        {{$c->fname_th}} {{$c->lname_th}}
        @endforeach
        ({{date('Y', strtotime($b->ac_year))}}). {{$b->ac_name}}. {{$b->ac_sourcetitle}}
    </p>
    @endforeach
    <h4>งานวิจัย และบทความทางวิชาการ</h4>
    @foreach($p as $k=> $b)
    <p class="w-100">
        {{$k+1}}.
        {{$b['author']}}
        ({{$b['paper_yearpub']}}), {{$b['paper_name']}}, {{$b['paper_sourcetitle']}}, DOI: {{$b['paper_doi']}}

    </p>
    @endforeach

    <h4>ผลงานวิชาการด้านอื่นๆ (สิทธิบัตร, อนุสิทธิบัตร, ลิขสิทธิ์)</h4>
    @foreach($pat as $k=> $pp)
    <p class="w-100">
        {{$k+1}}.

        @foreach($pp->user as $c)
        {{$c->full_name}}
        @if (!$loop->last),@endif
        @endforeach

        @foreach($pp->author as $c)

        {{$c->full_name}}.
        @if (!$loop->last),@endif
        @endforeach
        
        {{$pp->paper_type}}:{{$pp->paper_name}}. กรมทรัพย์สินทางปัญญา : เลขที่ : {{$pp->reference_number}},
        {{\Carbon\Carbon::parse($pp->patent_date)->thaidate('j F Y') }}.

    </p>
    @endforeach
    <!-- <tr>
        <th align="left" colspan="2" class="w-75">งานวิจัย และบทความทางวิชาการ</th>
        <!-- <th class="w-25">Shipping Method</th>
    </tr>
    <tr>
        <td class="w-70">1. Doan, P. T. H., Arch-int, N. and Arch-int, S. (2020). A Semantic Framework for Extracting Taxonomic Relations From Text Corpus. The International Arab Journal of Information Technology: IAJIT, 17(3), pp. 325-337.</td>
        <td class="w-30">บทความวิจัยหรือบทความวิชาการที่ตีพิมพ์ในวารสารวิชาการระดับนานาชาติที่มีอยู่ในฐานข้อมูล ตามประกาศ ก.พ.อ. หรือระเบียบคณะกรรมการการอุดมศึกษาว่าด้วย หลักเกณฑ์การพิจารณาวารสารทางวิชาการสำหรับการเผยแพร่ผลงานทางวิชาการ พ.ศ.2556; 1.0</td>
    </tr>
    <tr>
        <td class="w-70">2. Sengloiluean K., Arch-int N. and Arch-int S. (2019), A Semantic Question Classification for Question Answering System using Linked Open Data Approach, Journal of Theoretical and Applied Information Technology, Vol. 97(20), pp. 2293-2305.</td>
        <td class="w-30">บทความวิจัยหรือบทความวิชาการฉบับสมบูรณ์ที่ตีพิมพ์ในรายงานสืบเนื่องจากการประชุมวิชาการระดับนานาชาติ หรือในวารสารวิชาการระดับชาติที่มีอยู่ในฐานข้อมูล ตามประกาศ ก.พ.อ. หรือระเบียบคณะกรรมการการอุดมศึกษาว่าด้วย หลักเกณฑ์การพิจารณาวารสารทางวิชาการสำหรับการเผยแพร่ผลงานทางวิชาการ พ.ศ.2556; 0.4</td>
    </tr>

    </table> -->
    </div>

</body>

</html>