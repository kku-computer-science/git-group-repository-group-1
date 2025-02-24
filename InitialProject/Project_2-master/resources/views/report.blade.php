@extends('layouts.layout')
<style>
.count {
    background-color: #f5f5f5;
    padding: 20px 0;
    border-radius: 5px;


}

.count-title {
    font-size: 40px;
    font-weight: normal;
    margin-top: 10px;
    margin-bottom: 0;
    text-align: center;
}

.count-text {
    font-size: 15px;
    font-weight: normal;
    margin-top: 10px;
    margin-bottom: 0;
    text-align: center;

}

.fa-2x {
    margin: 0 auto;
    float: none;
    display: table;
    color: #4ad1e5;
}

.card-title {
    color:#19568A;
    font-family: 'Kanit', sans-serif;
    font-size: 16px;
}
</style>
@section('content')
<div class="container card-cart d-sm-flex  justify-content-center mt-5">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title" style="padding: 16px;">สถิติจำนวนบทความทั้งหมด 5 ปี</h4>
                <div class="row">
                    <div class="col-md-6 p-5">
                        <div style="width:520px;height:250px">
                            <canvas id="barChart1"></canvas>
                        </div>
                    </div>
                    <div class="col-md-6 p-5">
                        <table class="table table-bordered" id="myTable">
                            <thead>
                                <tr id="myRow" style="text-align: center;">


                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
        </div>
    </div>
</div>

<div class="container card-cart d-sm-flex  justify-content-center mt-5">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title"  style="padding: 16px;">สถิติจำนวนบทความที่ได้รับการอ้างอิง</h4>
                <div class="row">
                    <div class="col-md-6 p-5">
                        <div style="width:520px;height:250px">
                            <canvas id="barChart2"></canvas>
                        </div>
                    </div>
                    <div class="col-md-6 p-5">
                        <table class="table table-bordered" id="myTable2">
                            <thead>
                                <tr style="text-align: center;">


                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
<script>
var year = <?php echo $year; ?>;
var paper_tci = <?php echo $paper_tci; ?>;
var paper_scopus = <?php echo $paper_scopus; ?>;
var paper_wos = <?php echo $paper_wos; ?>;

var paper_tci_cit = <?php echo $paper_tci_cit; ?>;
var paper_scopus_cit = <?php echo $paper_scopus_cit; ?>;
var paper_wos_cit = <?php echo $paper_wos_cit; ?>;

year.unshift("source");
paper_tci.unshift("tci");

//console.log(paper_scopus_cit);
paper_scopus.unshift("scopus");
paper_wos.unshift("wos");

let pro = year;
let dat = [
    paper_scopus,
    paper_tci,
    paper_wos
];
let res = dat.map((innerArray) => {
    let obj = {};
    innerArray.forEach((innerData, index) => {
        //index.hasOwnProperty("undefined");
        // if(pro[index]==undefined){
        //     obj['source'] = innerData;
        //     console.log(obj)
        // }else{
        //     obj[pro[index]] = innerData;
        // }
        obj[pro[index]] = innerData;

        //console.log(pro[index])
    });

    return obj;
});

console.log(res);

//let props2 = year;

paper_scopus_cit.unshift("scopus");
//console.log(paper_scopus_cit);
paper_tci_cit.unshift("tci");
paper_wos_cit.unshift("wos");


let dat2 = [
    paper_scopus_cit,
    paper_tci_cit,
    paper_wos_cit
];

let res2 = dat2.map((innerArray) => {
    let obj = {};
    innerArray.forEach((innerData, index) => {
        obj[pro[index]] = innerData;
    });
    return obj;
});
console.log(res2);

function generateTableHead(table, data) {
    let thead = table.createTHead();
    let row = thead.insertRow();
    for (let key of data) {
        let th = document.createElement("th");
        let text = document.createTextNode(key);
        th.appendChild(text);
        row.appendChild(th);
    }
}

function generateTable(table, data) {
    for (let element of data) {
        let row = table.insertRow();
        for (key in element) {
            let cell = row.insertCell();
            let text = document.createTextNode(element[key]);
            cell.appendChild(text);
        }
    }
}

let table = document.getElementById("myTable");
let data = Object.keys(res[0]);
generateTableHead(table, data);
generateTable(table, res);
let table2 = document.getElementById("myTable2");
let data2 = Object.keys(res2[0]);
generateTableHead(table2, data2);
generateTable(table2, res2);
</script>

<script>
var year = <?php echo $year; ?>;
var paper_tci = <?php echo $paper_tci; ?>;
var paper_scopus = <?php echo $paper_scopus; ?>;
var paper_wos = <?php echo $paper_wos; ?>;


var areaChartData = {

    labels: year,

    datasets: [{
            label: 'SCOPUS',
            backgroundColor: '#83E4B5',
            borderColor: 'rgba(255, 255, 255, 0.5)',
            pointRadius: false,
            pointColor: '#83E4B5',
            pointStrokeColor: '#3b8bba',
            pointHighlightFill: '#fff',
            pointHighlightStroke: '#83E4B5',
            data: paper_scopus
        },
        {
            label: 'TCI',
            backgroundColor: '#3994D6',
            borderColor: 'rgba(210, 214, 222, 1)',
            pointRadius: false,
            pointColor: '#3994D6',
            pointStrokeColor: '#c1c7d1',
            pointHighlightFill: '#fff',
            pointHighlightStroke: '#3994D6',
            data: paper_tci
        },
        {
            label: 'WOS',
            backgroundColor: '#FCC29A',
            borderColor: 'rgba(0, 0, 255, 1)',
            pointRadius: false,
            pointColor: '#FCC29A',
            pointStrokeColor: '#c1c7d1',
            pointHighlightFill: '#fff',
            pointHighlightStroke: '#FCC29A',
            data: paper_wos
        },
    ]
}



//-------------
//- BAR CHART -
//-------------
var barChartCanvas = $('#barChart1').get(0).getContext('2d')

var barChartData = $.extend(true, {}, areaChartData)
var temp0 = areaChartData.datasets[0]
var temp1 = areaChartData.datasets[1]
barChartData.datasets[0] = temp1
barChartData.datasets[1] = temp0

var barChartOptions = {
    responsive: true,
    maintainAspectRatio: false,
    datasetFill: false,
}

new Chart(barChartCanvas, {
    type: 'bar',
    data: barChartData,
    options: barChartOptions
})

new Chart(barChartCanvas3, {
    type: 'bar',
    data: barChartData,
    options: barChartOptions
})
</script>
<script>
var year = <?php echo $year; ?>;
var paper_tci = <?php echo $paper_tci_cit; ?>;
var paper_scopus = <?php echo $paper_scopus_cit; ?>;
var paper_wos = <?php echo $paper_wos_cit; ?>;
var areaChartData = {

    labels: year,

    datasets: [{
            label: 'SCOPUS',
            backgroundColor: '#83E4B5',
            borderColor: 'rgba(255, 255, 255, 0.5)',
            pointRadius: false,
            pointColor: '#83E4B5',
            pointStrokeColor: '#3b8bba',
            pointHighlightFill: '#fff',
            pointHighlightStroke: '#83E4B5',
            data: paper_scopus
        },
        {
            label: 'TCI',
            backgroundColor: '#3994D6',
            borderColor: 'rgba(210, 214, 222, 1)',
            pointRadius: false,
            pointColor: '#3994D6',
            pointStrokeColor: '#c1c7d1',
            pointHighlightFill: '#fff',
            pointHighlightStroke: '#3994D6',
            data: paper_tci
        },
        {
            label: 'WOS',
            backgroundColor: '#FCC29A',
            borderColor: 'rgba(0, 0, 255, 1)',
            pointRadius: false,
            pointColor: '#FCC29A',
            pointStrokeColor: '#c1c7d1',
            pointHighlightFill: '#fff',
            pointHighlightStroke: '#FCC29A',
            data: paper_wos
        },
    ]
}



//-------------
//- BAR CHART -
//-------------
var barChartCanvas = $('#barChart2').get(0).getContext('2d')

var barChartData = $.extend(true, {}, areaChartData)
var temp0 = areaChartData.datasets[0]
var temp1 = areaChartData.datasets[1]
barChartData.datasets[0] = temp1
barChartData.datasets[1] = temp0

var barChartOptions = {
    responsive: true,
    maintainAspectRatio: false,
    datasetFill: false,
}
new Chart(barChartCanvas, {
    type: 'bar',
    data: barChartData,
    options: barChartOptions
})
</script>
<script>
var year = <?php echo $year; ?>;
var paper_tci = <?php echo $paper_tci_cit; ?>;
var paper_scopus = <?php echo $paper_scopus_cit; ?>;
var paper_wos = <?php echo $paper_wos_cit; ?>;
var areaChartData = {

    labels: year,

    datasets: [{
            label: 'SCOPUS',
            backgroundColor: '#83E4B5',
            borderColor: 'rgba(255, 255, 255, 0.5)',
            pointRadius: false,
            pointColor: '#83E4B5',
            pointStrokeColor: '#3b8bba',
            pointHighlightFill: '#fff',
            pointHighlightStroke: '#83E4B5',
            data: paper_scopus
        },
        {
            label: 'TCI',
            backgroundColor: '#3994D6',
            borderColor: 'rgba(210, 214, 222, 1)',
            pointRadius: false,
            pointColor: '#3994D6',
            pointStrokeColor: '#c1c7d1',
            pointHighlightFill: '#fff',
            pointHighlightStroke: '#3994D6',
            data: paper_tci
        },
        {
            label: 'WOS',
            backgroundColor: '#FCC29A',
            borderColor: 'rgba(0, 0, 255, 1)',
            pointRadius: false,
            pointColor: '#FCC29A',
            pointStrokeColor: '#c1c7d1',
            pointHighlightFill: '#fff',
            pointHighlightStroke: '#FCC29A',
            data: paper_wos
        },
    ]
}



//-------------
//- BAR CHART -
//-------------
var barChartCanvas = $('#barChart2').get(0).getContext('2d')

var barChartData = $.extend(true, {}, areaChartData)
var temp0 = areaChartData.datasets[0]
var temp1 = areaChartData.datasets[1]
barChartData.datasets[0] = temp1
barChartData.datasets[1] = temp0

var barChartOptions = {
    responsive: true,
    maintainAspectRatio: false,
    datasetFill: false,
}
new Chart(barChartCanvas, {
    type: 'bar',
    data: barChartData,
    options: barChartOptions
})
</script>
@endsection