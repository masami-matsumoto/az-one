<?php
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
require_once "../PHPExcel/Classes/PHPExcel.php";
?>
<!doctype html>
<html>

<body>
<header>
    <meta charset="utf-8">
    <title>シミュレーション結果</title>
    <meta name="viewport" content="width=device-width,user-scalable=yes,maximum-scale=1.6" />
    <!-- ※デフォルトのスタイル（style.css） -->
    <link rel="stylesheet" media="all" type="text/css" href="../css/style_pc.css" />
    <!-- ※スマートフォン用のスタイル（smart.css） -->
    <link rel="stylesheet" media="all" type="text/css" href="../css/style_sp.css" />
    <!-- ※シュミレーション用のスタイル（smart.css） -->
    <link rel="stylesheet" media="all" type="text/css" href="../css/simulation_ms.css" />
    <!-- ※drawerのスタイル -->
    <!-- ※drawerのスタイル -->
    <link rel="stylesheet" media="all" type="text/css" href="../css/drawer.css">
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript" src="../js/jquery.drawer.js"></script>
    <script type="text/javascript" src="../js/1.10.1_jquery.min.js"></script>
    <script type="text/javascript" src="../js/acor.js"></script>
    <div class="inner">
        <h1 class="pcView"><a href="/"><img src="../img/common/logo.svg" width="80%" height="" alt="AZEST-GROUP" /></a></h1>
        <h1 class="spView"><a href="/"><img src="../img/common/logo.svg" width="318" height="60" alt="AZEST-GROUP" /></a></h1>
        <nav class="pcView">
            <ul>
                <!-- <li class="message"><a href="/message/">代表ご挨拶</a></li> -->
                <li class="identity"><a href="/identity/">企業理念</a></li>
                <li class="overview"><a href="/overview/">会社概要</a></li>
                <li class="asset"><a href="/asset/">資産運用</a></li>
                <li class="reason"><a href="/reason/">なぜ不動産投資なのか</a></li>
                <li class="information"><a href="/information/">イベント情報</a></li>
                <li class="contact"><a href="/faq/">お問合せ</a></li>
            </ul>
        </nav>
        <div class="drawer drawer-right spView">
            <button  class="drawer-toggle drawer-hamburger"> <span class="sr-only">toggle navigation</span> <span class="drawer-hamburger-icon"></span> </button>
            <div class="drawer-main drawer-default">
                <nav class="drawer-nav" role="navigation">
                    <ul class="nav drawer-nav-list">
                        <li><a href="/">TOP</a></li>
                        <li class="identity"><a href="/identity/">企業理念</a></li>
                        <li class="overview"><a href="/overview/">会社概要</a></li>
                        <li class="asset"><a href="/asset/">資産運用</a></li>
                        <li class="reason"><a href="/reason/">なぜ不動産投資なのか</a></li>
                        <li class="information"><a href="/information/">イベント情報</a></li>
                        <li class="contact"><a href="/faq/">お問合せ</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</header>


<div id="content">

<?php

//Khởi tạo đối tượng
//$excel = new PHPExcel();
function showNumber($num,$sub=null){
    if(empty($num)){
        return 0;
    }
    if(!empty($sub)){
        return $sub.number_format(abs($num));
    }
    if($num>0){
        return '+'.number_format(abs($num));
    }
    if($num<0){
        return '-'.number_format(abs($num));
    }
    return $num;
}
$real_estate_money0 = null;
$real_estate_money1 = null;

$owner_money0 = null;
$owner_money1 = null;

$loanShow0 = null;
$loanShow1 = null;

$loan0 = null;
$loan1 = null;

$interest0 = null;
$interest1 = null;


$time0 = null;
$time1 = null;
$pmtShow0 = null;
$pmtShow1 = null;
$pmt0 = null;
$pmt1 = null;
$management_costShow0 = null;
$management_costShow1 = null;
$commission0 = null;
$commission1 = null;
$Typecommission0 = null;
$Typecommission1 = null;
$subtotalShow0 = null;
$subtotalShow1 = null;
$subtotal0 = null;
$subtotal1 = null;
$rentShow0 = null;
$rentShow1 = null;
$rent0 = null;
$rent1 = null;
$monthly_receipt_expenseShow0 = null;
$monthly_receipt_expenseShow1 = null;
$monthly_receipt_expense0 = null;
$monthly_receipt_expense1 = null;
$management_cost0 = null;
$management_cost1 = null;


if ($_SERVER["REQUEST_METHOD"] == "POST") {

//    $countRecipe = $_POST['countRecipe'];
    $arrDataGraphAll = [];
    $real_estate_money0 = $_POST['real_estate_money0'];
    $real_estate_money1 = $_POST['real_estate_money1'];
//
    $owner_money0 = $_POST['owner_money0'];
    $owner_money1 = $_POST['owner_money1'];

    $loanShow0 = $_POST['loanShow0'];
    $loanShow1 = $_POST['loanShow1'];
    $loan0 = $_POST['loan0'];
    $loan1 = $_POST['loan1'];

    $interest0 = $_POST['interest0'];
    $interest1 = $_POST['interest1'];


    $time0 = $_POST['time0'];
    $time1 = $_POST['time1'];
    $pmtShow0 = $_POST['pmtShow0'];
    $pmtShow1 = $_POST['pmtShow1'];
    $pmt0 = $_POST['pmt0'];
    $pmt1 = $_POST['pmt1'];
    $management_costShow0 = $_POST['management_costShow0'];
    $management_costShow1 = $_POST['management_costShow1'];
    $commission0 = $_POST['commission0'];
    $commission1 = $_POST['commission1'];
    $Typecommission0 = $_POST['Typecommission0'];
    $Typecommission1 = $_POST['Typecommission1'];
    $subtotalShow0 = $_POST['subtotalShow0'];
    $subtotalShow1 = $_POST['subtotalShow1'];
    $subtotal0 = $_POST['subtotal0'];
    $subtotal1 = $_POST['subtotal1'];
    $rentShow0 = $_POST['rentShow0'];
    $rentShow1 = $_POST['rentShow1'];
    $rent0 = $_POST['rent0'];
    $rent1 = $_POST['rent1'];
    $monthly_receipt_expenseShow0 = $_POST['monthly_receipt_expenseShow0'];
    $monthly_receipt_expenseShow1 = $_POST['monthly_receipt_expenseShow1'];
    $monthly_receipt_expense0 = $_POST['monthly_receipt_expense0'];
    $monthly_receipt_expense1 = $_POST['monthly_receipt_expense1'];
    $management_cost0 = $_POST['management_cost0'];
    $management_cost1 = $_POST['management_cost1'];
    $earnings0 = null;
    $earnings1 = null;
    $earnings = null;
    for ($iCount = 0; $iCount <= 1; $iCount++) {
        $nameReal_estate = 'real_estate_money' . $iCount;
        $real_estate = $_POST[$nameReal_estate];
        $nameOwner_money = 'owner_money' . $iCount;
        $money = $_POST[$nameOwner_money];
        $nameLoan = 'loan' . $iCount;
        $loan = $_POST[$nameLoan];
        $nameTime = 'time' . $iCount;
        $time = $_POST[$nameTime];
        $nameInterest = 'interest' . $iCount;
        $interest = $_POST[$nameInterest];
        $namePmt = 'pmt' . $iCount;
        $pmt = $_POST[$namePmt];
        $nameManagement_cost = 'management_cost' . $iCount;
        $management_cost = $_POST[$nameManagement_cost];

        $nameCommission = 'commission' . $iCount;
        $commission = $_POST[$nameCommission];

        $nameCommissionT = 'commission' . $iCount;
        $commissionT = $_POST[$nameCommissionT];

        $namesubtotal = 'subtotal' . $iCount;
        $subtotal = $_POST[$namesubtotal];
        $nameRent = 'rent' . $iCount;
        $rent = $_POST[$nameRent];
        $nameMonthly_receipt_expense = 'monthly_receipt_expense' . $iCount;
        $monthly_receipt_expense = $_POST[$nameMonthly_receipt_expense];

        $earnings0 = (float)$rent0 - ((float)$management_cost0 + (float)$commission0);
        $earnings1 = (float)$rent1 - ((float)$management_cost1 + (float)$commission1);

        $arrDataGraph = array();
        $arrTime = array();
        for ($i = 1; $i <= $time / 5; $i++) {
            array_push($arrTime, $i * 12 * 5);
        }
        $total = 0;
        for ($i = 1; $i <= 12 * $time; $i++) {

            $ppmt = PHPExcel_Calculation_Financial::PPMT($interest / 100 / 12, $i, $time * 12, $loan);
            if (is_numeric($ppmt)) {
                $total += $ppmt;
                $debt = $loan + $total;
                if (in_array($i, $arrTime)) {
                    array_push($arrDataGraph, $debt);
                }
            } else {
                if (in_array($i, $arrTime)) {
                    array_push($arrDataGraph, 0);
                }
            }
        }
        array_push($arrDataGraphAll, $arrDataGraph);
    }


?>
    <script>
        var uA = window.navigator.userAgent,
            onlyIEorEdge = /msie\s|trident\/|edge\//i.test(uA) && !!( document.uniqueID || window.MSInputMethodContext),
            checkVersion = (onlyIEorEdge && +(/(edge\/|rv:|msie\s)([\d.]+)/i.exec(uA)[2])) || NaN;
        var testIE =  !isNaN(checkVersion);
        var widthBar = '88%';
        var widthGroup = "60%";
        if(testIE){
            widthBar = '88%';
            widthGroup = "30%";
        }
        google.charts.load("current", {packages:['corechart']});
        // google.charts.setOnLoadCallback(drawChart);
        function drawChart() {
            return;
            var time0 = <?php echo $time0 ?>;
            var time1 = <?php echo $time1 ?>;
            var time = time0>time1?time0:time1;
            var pmt = <?php echo $pmt0 ?>;
            var loan = <?php echo $loan0 ?>;
            var earnings0 = <?php echo $earnings0 ?>;
            var earnings1 = <?php echo $earnings1 ?>;
            var arrDataGraph = <?php echo json_encode($arrDataGraphAll ) ?> ;

            var arrAllData = [];
            arrAllData.push(['年', '金額', { role: 'annotation' }, {role: 'style'},'金額',  {role: 'style'}]);

            var countY = time/5;
            var countE = 1;
            for (var i=1;i<=countY*2;i++){
                var year = i*5;
                if(year<10){
                    year = '0'+year;
                }
                if(i<=countY){
                    var txtLabel1 = 0;
                    if(arrDataGraph[1][i-1]){
                        txtLabel1 =  Math.round(arrDataGraph[1][i-1]/10000);
                    }
                    var txtLabel0 = 0;
                    if(arrDataGraph[0][i-1]){
                        txtLabel0 =  Math.round(arrDataGraph[0][i-1]/10000);
                    }
                    // arrAllData.push([year +'年', txtLabel0,txtLabel0 , '#cf260f',txtLabel1,'#f4b183']);
                    arrAllData.push([year +'年', txtLabel0,txtLabel0 , 'stroke-color: #cf260f; stroke-width: 0; fill-color: #cf260f',txtLabel1,'stroke-color: #fffffff; stroke-width: 4; fill-color: #f4b183']);



                }else{
                    var txtTest = Math.round((earnings1*5*12*countE)/10000);
                    arrAllData.push( [year +'年', Math.round(earnings0*5*12*countE/10000) ,Math.round(earnings0*5*12*countE/10000), '#2eaff4',txtTest,'#0066ff']);

                    countE++;
                }
            }


            var data = google.visualization.arrayToDataTable(arrAllData);
            var view = new google.visualization.DataView(data);
            // view.setColumns([0, 1,
            //     { calc: "stringify",
            //         sourceColumn: 1,
            //         type: "string",
            //         role: "annotation"
            //     },
            //     2]);
            var options = {
                axes: {
                    x: {
                        1: {side: 'top'}
                    }
                },
                // colors: ['#e0440e', '#e6693e', '#ec8f6e', '#f3b49f', '#f6c7b6'],
                title: "ローン計算結果",
                annotations: {
                    alwaysOutside: true,
                    textStyle: {
                        fontSize: 14,
                        color: '#000',
                        auraColor: 'none'
                    }
                },
                height: 600,
//                    width: 1000,
                chartArea: {
                    width: widthBar
                },
                bar: {groupWidth: widthGroup},
                legend: { position: "none" },
                vAxes: {
                    0: {title: '万円'},
                },
//                hAxis: {
//                    title: '年',
//                },
            };

            function placeMarker(dataTable) {
                var cli = this.getChartLayoutInterface();
                var chartArea = cli.getChartAreaBoundingBox();
                // "Zombies" is element #5.

            };
            var chart = new google.visualization.ColumnChart(document.getElementById("columnchart_values0"));
            google.visualization.events.addListener(chart, 'ready', placeMarker.bind(chart, view));
            chart.draw(view, options);
        }


        google.charts.load('current', {packages: ['corechart', 'bar']});
        google.charts.setOnLoadCallback(drawAnnotations);

        function drawAnnotations() {
            var time0 = <?php echo $time0 ?>;
            var time1 = <?php echo $time1 ?>;
            var time = time0>time1?time0:time1;
            var pmt = <?php echo $pmt0 ?>;
            var loan = <?php echo $loan0 ?>;
            var earnings0 = <?php echo $earnings0 ?>;
            var earnings1 = <?php echo $earnings1 ?>;
            var arrDataGraph = <?php echo json_encode($arrDataGraphAll ) ?> ;

            var data = new google.visualization.DataTable();

            var arrAllData = [];
            // arrAllData.push(['年', '金額', { role: 'annotation' }, {role: 'style'},'金額',  {role: 'style'}]);

            data.addColumn('string', '収支');
            data.addColumn('number', '金額');
            data.addColumn({type: 'number', role: 'annotation'});
            data.addColumn({role: 'style' });
            data.addColumn('number', '金額');
            data.addColumn({type: 'number', role: 'annotation'});
            data.addColumn({role: 'style' });

            var countY = time/5;
            var countY0 = time0/5;
            var countY1 = time1/5;
            var countE0 = 1;
            var countE1 = 1;
            var countE = 1;
            for (var i=1;i<=countY*2;i++){
                var year = i*5;
                if(year<10){
                    year = '0'+year;
                }

                var txtLabel0 = 0;
                var txtLabel1 = 0;
                var color0 = 'fill-color: #f4b183';
                if(i<=countY0){
                    color0 = 'fill-color: #f4b183';
                    if(arrDataGraph[0][i-1]){
                        txtLabel0 =  Math.round(arrDataGraph[0][i-1]/10000);
                    }
                }else{
                    color0 = 'fill-color:#2eaff4';
                    // if(year<=time0*2){
                    txtLabel0 =Math.round(earnings0*5*12*countE0/10000);
                    // }
                    countE0++;
                }
                var color1 = 'fill-color:#cf260f ';
                if(i<=countY1){
                    color1 = 'fill-color:#cf260f' ;
                    if(arrDataGraph[1][i-1]){
                        txtLabel1 =  Math.round(arrDataGraph[1][i-1]/10000);
                    }
                }else{
                    color1 = 'fill-color:#0066ff' ;
                    // if(year<=time1*2){
                    txtLabel1 =Math.round(earnings1*5*12*countE1/10000);
                    // }
                    countE1++;
                }

                arrAllData.push( [year +'年',   txtLabel0, txtLabel0,color0,  txtLabel1, txtLabel1,color1]);

                // if(i<=countY){
                //     var txtLabel1 = 0;
                //     if(arrDataGraph[1][i-1]){
                //         txtLabel1 =  Math.round(arrDataGraph[1][i-1]/10000);
                //     }
                //     var txtLabel0 = 0;
                //     if(arrDataGraph[0][i-1]){
                //         txtLabel0 =  Math.round(arrDataGraph[0][i-1]/10000);
                //     }
                //     // arrAllData.push([year +'年', txtLabel0,txtLabel0 , '#cf260f',txtLabel1,'#f4b183']);
                //     // arrAllData.push([year +'年', txtLabel0,txtLabel0 , 'stroke-color: #cf260f; stroke-width: 0; fill-color: #cf260f',txtLabel1,'stroke-color: #fffffff; stroke-width: 4; fill-color: #f4b183']);
                //
                //     // arrAllData.push( [year +'年', txtLabel0,txtLabel0 , '#cf260f',txtLabel1,txtLabel1,'#f4b183'])
                //     arrAllData.push( [year +'年',   txtLabel0, txtLabel0,'fill-color: #f4b183',  txtLabel1, txtLabel1,'fill-color:#cf260f ']);
                //
                // }else{
                //     let txtTest0 = 0
                //     if(year<=time0*2){
                //          txtTest0 =Math.round(earnings0*5*12*countE/10000);
                //     }
                //     console.log(time0*2);
                //     console.log(txtTest0);
                //
                //     let txtTest1 = 0;
                //     if(year<=time1*2){
                //         txtTest1 = Math.round((earnings1*5*12*countE)/10000);
                //     }
                //     console.log(txtTest1);
                //     // arrAllData.push( [year +'年', Math.round(earnings0*5*12*countE/10000) ,Math.round(earnings0*5*12*countE/10000), '#2eaff4',txtTest,'#0066ff']);
                //     // arrAllData.push( [year +'年', Math.round(earnings0*5*12*countE/10000) ,Math.round(earnings0*5*12*countE/10000), '#2eaff4',txtTest,txtTest,'#0066ff'])
                //     arrAllData.push( [year +'年', txtTest0 ,txtTest0,'fill-color:#2eaff4',  txtTest1, txtTest1,'fill-color:#0066ff  ']);
                //
                //
                //     countE++;
                // }
            }


            data.addRows(arrAllData);
            // data.addRows([
            //     [{v: [8, 0, 0], f: '8 am'},   1, '1','fill-color: #C5A5CF',  .25, '.2','fill-color: #f4b183',],
            //     [{v: [9, 0, 0], f: '9 am'},   2, '2', 'fill-color: #C5A5CF',  .5, '.5','fill-color: #f4b183',],
            //
            // ]);

            var options = {
                fontSize: 12,
                height: 400,
                chartArea: {
                    width: widthBar
                },
                title: 'ローン計算結果',
                legend: { position: "none" },
                hAxis: {
                    // title: '収支',
                    viewWindow: {
                        min: [0, 0, 0],
                        max: [0, 0, 0]
                    }
                },
                vAxis: {
                    title: '万円'
                }
            };

            var chart = new google.visualization.ColumnChart(document.getElementById('chart_div'));
            chart.draw(data, options);
        }

    </script>
    <?php
}
?>
    <style>
        .textColor{
            color: red;
        }
    </style>
    <div class="pankuzu pcView"><a href="https://az-one.biz/"><img src="../img/common/icon_home.png" width="20" height="" alt="home" /></a>&nbsp;&gt;&nbsp;不動産投資シミュレーション</div>
    <section class="explanatory" id="simulation">
        <h2 class="main_title">不動産投資シミュレーション</h2>
        <div class="simulation-catch">
            <p>不動産投資の簡単シミュレーション！！</p>
            <p>ローン期間中の収支から家賃収入累積までをシミュレーション計算いたします。</p>
        </div>
        <div class="baseForm">
            <div class="formTitle">
                <h3>新築</h3>
                <h3>マンション</h3>
                <h3>中古</h3>
            </div>
            <form method="post" name="post" action="" id="graph"  class="form-horizontal comparisonForm">
                <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
                <input type="hidden" name="" value="">
                <div id="scroolForm" class="baseBox">
                    <div class="baseFormDlist basePane">
                        <dl class="in">
                            <dd class="text-right">
                                <select class="form-control input-lg" name="real_estate_money0" id="real_estate_money0" onchange="getData(0)">
                                    <option value="">選択</option>
                                    <option value="2500" <?php if ($real_estate_money0 ==2500 ){ ?> selected <?php }?> >2500</option>
                                    <option value="2600" <?php if ($real_estate_money0 ==2600 ){ ?> selected <?php }?>  >2600</option>
                                    <option value="2700" <?php if ($real_estate_money0 ==2700 ){ ?> selected <?php }?> >2700</option>
                                    <option value="2800" <?php if ($real_estate_money0 ==2800 ){ ?> selected <?php }?> >2800</option>
                                    <option value="2900" <?php if ($real_estate_money0 ==2900 ){ ?> selected <?php }?> >2900</option>
                                    <option value="3000" <?php if ($real_estate_money0 ==3000 ){ ?> selected <?php }?> >3000</option>
                                    <option value="3100" <?php if ($real_estate_money0 ==3100 ){ ?> selected <?php }?> >3100</option>
                                    <option value="3200" <?php if ($real_estate_money0 ==3200 ){ ?> selected <?php }?> >3200</option>
                                    <option value="3300" <?php if ($real_estate_money0 ==3300 ){ ?> selected <?php }?> >3300</option>
                                    <option value="3400" <?php if ($real_estate_money0 ==3400 ){ ?> selected <?php }?> >3400</option>
                                    <option value="3500" <?php if ($real_estate_money0 ==3500 ){ ?> selected <?php }?> >3500</option>
                                    <option value="3600" <?php if ($real_estate_money0 ==3600 ){ ?> selected <?php }?> >3600</option>
                                    <option value="3700" <?php if ($real_estate_money0 ==3700 ){ ?> selected <?php }?> >3700</option>
                                    <option value="3800" <?php if ($real_estate_money0 ==3800 ){ ?> selected <?php }?> >3800</option>
                                    <option value="3900" <?php if ($real_estate_money0 ==3900 ){ ?> selected <?php }?> >3900</option>
                                    <option value="4000" <?php if ($real_estate_money0 ==4000 ){ ?> selected <?php }?> >4000</option>
                                </select>
                                万円
                                <div><span id="err_real_estate_money0"></span></div>
                                <span class="notes">目安：2,500万～3,000万</span></dd>
                            <dt>購入物件価格</dt>
                            <dd>
                                <select class="form-control input-lg" name="real_estate_money1" id="real_estate_money1" onchange="getData(1)">
                                    <option value="">選択</option>
                                    <option value="1200" <?php if ($real_estate_money1 ==1200 ){ ?> selected <?php }?> >1200</option>
                                    <option value="1300" <?php if ($real_estate_money1 ==1300 ){ ?> selected <?php }?> >1300</option>
                                    <option value="1400" <?php if ($real_estate_money1 ==1400 ){ ?> selected <?php }?> >1400</option>
                                    <option value="1500" <?php if ($real_estate_money1 ==1500 ){ ?> selected <?php }?> >1500</option>
                                    <option value="1600" <?php if ($real_estate_money1 ==1600 ){ ?> selected <?php }?> >1600</option>
                                    <option value="1700" <?php if ($real_estate_money1 ==1700 ){ ?> selected <?php }?> >1700</option>
                                    <option value="1800" <?php if ($real_estate_money1 ==1800 ){ ?> selected <?php }?> >1800</option>
                                    <option value="1900" <?php if ($real_estate_money1 ==1900 ){ ?> selected <?php }?> >1900</option>
                                    <option value="2000" <?php if ($real_estate_money1 ==2000 ){ ?> selected <?php }?> >2000</option>
                                    <option value="2100" <?php if ($real_estate_money1 ==2100 ){ ?> selected <?php }?> >2100</option>
                                    <option value="2200" <?php if ($real_estate_money1 ==2200 ){ ?> selected <?php }?> >2200</option>
                                    <option value="2300" <?php if ($real_estate_money1 ==2300 ){ ?> selected <?php }?> >2300</option>
                                    <option value="2400" <?php if ($real_estate_money1 ==2400 ){ ?> selected <?php }?> >2400</option>
                                    <option value="2500" <?php if ($real_estate_money1 ==2500 ){ ?> selected <?php }?> >2500</option>
                                </select>
                                万円
                                <div><span id="err_real_estate_money1"></span></div>
                                <span class="notes">目安：1,200万～2,500万</span></dd>
                        </dl>
                        <dl class="in">
                            <dd class="text-right">
                                <input class="form-control" type="number" placeholder="" name="owner_money0" id="owner_money0" value="<?php echo $owner_money0; ?>"  onchange="getData(0)" >


                                万円
                                <div><span id="err_owner_money0"></span></div>
                                <span class="notes">頭金：10万円から可能</span></dd>
                            <dt><span>自己資金</span></dt>
                            <dd>
                                <input class="form-control" type="number" placeholder="" name="owner_money1" id="owner_money1" value="<?php echo $owner_money1; ?>"  onchange="getData(1)" >


                                万円
                                <div><span id="err_owner_money1"></span></div>
                                <span class="notes">目安：物件価格の5～20％以上必要</span></dd>
                        </dl>
                        <dl class="in">
                            <dd class="text-right">
                                <input class="form-control" type="" placeholder="" name="loanShow0" id="loanShow0" value="<?php echo $loanShow0; ?>" readonly >
                                <input class="form-control" type="hidden" placeholder="" name="loan0" id="loan0" value="<?php echo $loan0; ?>"  >
                                円
                                <div><span id="err_loan0"></span></div>
                            </dd>
                            <dt><span>融資額</span></dt>
                            <dd>
                                <input class="form-control" type="" placeholder="" name="loanShow1" id="loanShow1" value="<?php echo $loanShow1; ?>" readonly >
                                <input class="form-control" type="hidden" placeholder="" name="loan1" id="loan1" value="<?php echo $loan1; ?>"  >
                                円
                                <div><span id="err_loan1"></span></div>

                            </dd>
                        </dl>
                        <dl class="in">
                            <dd class="text-right">
                                <input class="form-control" type="number" step="0.1" name="interest0" id="interest0" value="<?php echo $interest0; ?>" onchange="getData(0)">
                                ％
                                <div><span id="err_interest0"></span></div>
                                <span class="notes">目安：1.2％（最優遇）～</span></dd>
                            <dt><span>金利</span></dt>
                            <dd>
                                <input class="form-control" type="number" step="0.1" name="interest1" id="interest1" value="<?php echo $interest1; ?>" onchange="getData(1)">
                                ％
                                <div><span id="err_interest1"></span></div>
                                <span class="notes">目安：2％～</span> </dd>
                        </dl>
                        <dl class="in">
                            <dd class="text-right">
                                <input class="" type="number" placeholder="入力" name="time0" id="time0" value="<?php echo $time0; ?>" onchange="getData(0)"  >
                                年
                                <div><span id="err_time0"></span></div>

                            </dd>
                            <dt>期間<br>
                                (最長35年間)</dt>
                            <dd>
                                <input class="" type="number" placeholder="入力" name="time1" id="time1" value="<?php echo $time1; ?>" onchange="getData(1)"  >
                                年
                                <div><span id="err_time1"></span></div>

                                <span class="notes">※45年マイナス築年数など上限があります。</span></dd>
                        </dl>
                        <dl class="in">
                            <dd class="text-right">
                                <input class="form-control" type="" placeholder="" name="pmtShow0" id="pmtShow0" value="<?php echo $pmtShow0; ?>" readonly >
                                <input class="form-control" type="hidden" placeholder="" name="pmt0" id="pmt0" value="<?php echo $pmt0; ?>" >

                                円
                                <div><span id="err_pmt0"></span></div>

                            </dd>
                            <dt><span>毎月返済額</span></dt>
                            <dd>
                                <input class="form-control" type="" placeholder="" name="pmtShow1" id="pmtShow1" value="<?php echo $pmtShow1; ?>" readonly >
                                <input class="form-control" type="hidden" placeholder="" name="pmt1" id="pmt1" value="<?php echo $pmt1; ?>"  >

                                円
                                <div><span id="err_pmt1"></span></div>
                            </dd>
                        </dl>
                        <dl class="in">
                            <dd class="text-right">
                                <input class="form-control" type="number" placeholder="入力" name="management_costShow0" id="management_costShow0" onkeyup="getData(0)"   value="<?php echo $management_costShow0; ?>" >
                                <input class="" type="hidden" placeholder="" name="management_cost0" id="management_cost0" onkeyup="getData(0)" value="<?php echo $management_cost0; ?>" >

                                円
                                <div><span id="err_management_cost0"></span></div>
                                <span class="notes">目安：合計7,000前後～</span></dd>
                            <dt><span>管理費・修繕積立金</span></dt>
                            <dd>
                                <input class="form-control" type="number" placeholder="入力" name="management_costShow1" id="management_costShow1" onkeyup="getData(1)"   value="<?php echo $management_costShow1; ?>"  >
                                <input class="" type="hidden" placeholder="" name="management_cost1" id="management_cost1" onkeyup="getData(1)" value="<?php echo $management_cost1; ?>" >

                                円
                                <div><span id="err_management_cost1"></span></div>
                                <span class="notes">目安：合計9,500円以上～</span></dd>
                        </dl>
                        <dl class="in">
                            <dd class="text-right">
                                <input id="radio4-1" class="radiobutton" type="radio" <?php if($commission0 == 10000) { ?> checked <?php } ?> name="radio40">
                                <label for="radio4-1" class="radio4 " onclick="commissionGraph(0,1)"><span id="spanCommission01">家賃保証 10,000円</span></label>
                                <input id="radio4-2" class="radiobutton" type="radio" name="radio40" <?php if($commission0 == 5000) { ?> checked <?php } ?>>
                                <label for="radio4-2" class="radio4" onclick="commissionGraph(0,2)"><span id="spanCommission02">集金代行 5,000円</span></label>
                                <input id="commission0" class="radiobutton" type="hidden" name="commission0" value="<?php echo $commission0; ?>"  >
                                <input id="Typecommission0" class="radiobutton" type="hidden" name="Typecommission0" value="<?php echo $Typecommission0; ?>"  >

                            </dd>
                            <dt><span>管理委託手数料</span></dt>
                            <dd>
                                <input id="radio4-3" class="radiobutton" type="radio" name="radio4" <?php if($commission1 == 10000) { ?> checked <?php } ?>>
                                <label for="radio4-3" class="radio4" onclick="commissionGraph(1,1)"><span id="spanCommission11">家賃保証 10,000円</span></label>
                                <input id="radio4-4" class="radiobutton" type="radio" name="radio4" <?php if($commission1 == 5000) { ?> checked <?php } ?> >
                                <label for="radio4-4" class="radio4" onclick="commissionGraph(1,2)"><span id="spanCommissio12">集金代行 5,000円</span></label>
                                <input id="commission1" class="radiobutton" type="hidden" name="commission1" value="<?php echo $commission1; ?>"  >
                                <input id="Typecommission1" class="radiobutton" type="hidden" name="Typecommission1" value="<?php echo $Typecommission1; ?>"  >

                            </dd>
                        </dl>
                        <dl class="in">
                            <dd class="text-right">
                                <input class="form-control" type="" placeholder=""  name="subtotalShow0" id="subtotalShow0" value="<?php echo $subtotalShow0; ?>"  readonly>
                                <input class="form-control" type="hidden" placeholder="" name="subtotal0" id="subtotal0" value="<?php echo $subtotal0; ?>" >

                                円
                                <div><span id="err_subtotal0"></span></div>
                            </dd>
                            <dt><span>支出合計/月</span></dt>
                            <dd>
                                <input class="form-control" type="" placeholder="" name="subtotalShow1" id="subtotalShow1" value="<?php echo $subtotalShow1; ?>" readonly>
                                <input class="form-control" type="hidden" placeholder="" name="subtotal1" id="subtotal1" value="<?php echo $subtotal1; ?>" >

                                円
                                <div><span id="err_subtotal1"></span></div>

                            </dd>
                        </dl>
                        <dl class="in">
                            <dd class="text-right">
                                <input class="" type="number" placeholder="入力" name="rentShow0" id="rentShow0" onchange="getData(0)" value="<?php echo $rentShow0; ?>"  >
                                <input class="" type="hidden" placeholder=""  name="rent0" id="rent0" onchange="getData(0)"  value="<?php echo $rent0; ?>" >

                                円
                                <div><span id="err_rent0"></span></div>
                            </dd>
                            <dt><span>家賃</span></dt>
                            <dd>
                                <input class="" type="number" placeholder="入力" name="rentShow1" id="rentShow1" onchange="getData(1)" value="<?php echo $rentShow1; ?>"  >
                                <input class="" type="hidden" placeholder=""  name="rent1" id="rent1" onchange="getData(1)"  value="<?php echo $rent1; ?>">

                                円
                                <div><span id="err_rent1"></span></div>
                            </dd>
                        </dl>
                        <dl class="in">
                            <dd class="text-right">
                                <input class="<?php if($monthly_receipt_expenseShow0 <0){ ?>textColor <?php  } ?>" type="" placeholder="" name="monthly_receipt_expenseShow0" id="monthly_receipt_expenseShow0" value="<?php echo $monthly_receipt_expenseShow0; ?>"  readonly >
                                <input class="" type="hidden" placeholder="" name="monthly_receipt_expense0" id="monthly_receipt_expense0" value="<?php echo $monthly_receipt_expense0; ?>"  >

                                円
                                <div><span id="err_monthly0"></span></div>

                            </dd>
                            <dt><span> 収支/月</span></dt>
                            <dd>
                                <input class="<?php if($monthly_receipt_expenseShow1 <0){ ?>textColor <?php  } ?>" type="" placeholder="" name="monthly_receipt_expenseShow1" id="monthly_receipt_expenseShow1" value="<?php echo $monthly_receipt_expenseShow1; ?>" readonly >
                                <input class="" type="hidden" placeholder="" name="monthly_receipt_expense1" id="monthly_receipt_expense1" value="<?php echo $monthly_receipt_expense1; ?>"  >

                                円
                                <div><span id="err_monthly1"></span></div>

                            </dd>
                        </dl>
                        <p class="baseFormBtn">
                            <input type="submit" value="計算する ＞">
                        </p>
                    </div>
                </div>
                <div class="simulation-catch">
                    <p>シミュレーション結果</p>
                </div>
                <div class="wrap_result">
                    <div class="box">
                        <h3>新築</h3>
                        <ul class="busi_top">
                            <li>
                                <dl>
                                    <dt>ローン期間中の負担合計</dt>
                                    <dd <?php if ($monthly_receipt_expense0 *12 * $time0<0) { ?> style="color: red"  <?php }  ?> ><?php echo showNumber($monthly_receipt_expense0 *12 * $time0)?>円</dd>
                                </dl>
                            </li>
                            <li>
                                <dl>
                                    <dt>手取家賃収入合計</dt>
                                    <dd><?php echo showNumber(((float)$rent0 - ((float)$management_cost0+(float)$commission0)) *12 * (float)$time0) ?>円</dd>

                                </dl>
                            </li>
                            <li>
                                <dl>
                                    <dt>差引収支</dt>
                                    <dd><?php echo showNumber((((float)$rent0 - ((float)$management_cost0+(float)$commission0)) *12 * (float)$time0)+((float)$monthly_receipt_expense0 *12 * (float)$time0)) ?>円</dd>
                                </dl>
                            </li>
                        </ul>
                        <p style="margin-bottom: 15px;margin-left: 10px;margin-top: 10px;">※手取家賃収入の期間はローン年数と同じです。</p>
                    </div>
                    <div class="box">
                        <h3>中古</h3>
                        <ul class="busi_top">
                            <li>
                                <dl>
                                    <dt>ローン期間中の負担合計</dt>
                                    <dd <?php if ($monthly_receipt_expense1 *12 * $time1<0) { ?> style="color: red"  <?php }?>><?php echo showNumber($monthly_receipt_expense1 *12 * $time1) ?>円</dd>
                                </dl>
                            </li>
                            <li>
                                <dl>
                                    <dt>手取家賃収入合計</dt>
                                    <dd><?php echo showNumber(($rent1 - ($management_cost1+$commission1)) *12 * $time1) ?>円</dd>
                                </dl>
                            </li>
                            <li>
                                <dl>
                                    <dt>差引収支</dt>
                                    <dd><?php echo showNumber((($rent1 - ($management_cost1+$commission1)) *12 * $time1)+($monthly_receipt_expense1 *12 * $time1)) ?>円</dd>
                                </dl>
                            </li>

                        </ul>

                    </div>

                </div>
                <div class="columchart">
                    <h3 style="margin-top: 15px">グラフ収支</h3>

                    <div class="card card-block" style="margin-top: 20px;margin-left: 40px;">
                        <div id="chart_div"></div>
                        <div style="width: 40px;float: left;text-align: center;">新築 </div><div style="background-color:#f4b183 ;width: 10px;height: 20px;float: left;text-align: center;"></div> <div style="background-color: #2eaff4;width: 10px;height: 20px;float: left;text-align: center;margin-left: 5px"></div>
                        <div style="width: 40px;float: left;text-align: center;">中古 </div><div style="background-color:#cf260f ;width: 10px;height: 20px;float: left;text-align: center;"></div> <div style="background-color: #0066ff;width: 10px;height: 20px;float: left;text-align: center;margin-left: 5px"></div>

                    </div>
                </div>
                <div class="baseBox">
                    <h3>収支</h3>
                    <div class="formTitle">
                        <h4>新築</h4>
                        <h4>中古</h4>
                    </div>
                    <div class="basePane tableBlock wrap_table">
                        <table>
                            <thead>
                            <tr>
                                <th>ローン期間中</th>
                                <th></th>
                                <th>ローン完済後</th>
                            </tr>
                            <tr>
                                <td class="right_text" style="color: red" ><?php echo showNumber(($subtotal0),'-') ?>円</td>

                                <th>支出合計/月</th>
                                <?php $subtotal_2=(float)$management_cost0+(float)$commission0;?>
                                <td class="right_text" style="color: red" ><?php echo showNumber(($subtotal_2),'-') ?>円</td>

                            </tr>
                            <tr>
                                <td class="right_text" <?php if($rent0>0){?> style="color: #1771c6" <?php } ?> <?php if($rent0<0){?> style="color: red" <?php } ?>><?php echo showNumber($rent0) ?>円</td>
                                <th>家賃</th>
                                <td class="right_text" <?php if($rent0>0){?> style="color: #1771c6" <?php } ?> <?php if($rent0<0){?> style="color: red" <?php } ?>><?php echo showNumber($rent0) ?>円</td>
                            </tr>
                            <tr class="yellow-box01">
                                <td class="right_text" <?php if ($monthly_receipt_expense0<0) { ?> style="color: red"  <?php }?> <?php if ($monthly_receipt_expense0>0) { ?> style="color: #1771c6"  <?php }?> ><?php echo showNumber(($monthly_receipt_expense0)) ?>円</td>
                                <th >収支/月</th>
                                <td class="right_text"  <?php if(($rent0 - $subtotal_2)>0){?> style="color: #1771c6" <?php } ?>  <?php if(($rent0 - $subtotal_2)<0){?> style="color: red" <?php } ?> > <?php echo showNumber(($rent0 - $subtotal_2)) ?>円</td>
                            </tr>
                            <tr class="yellow-box02">
                                <td class="right_text" <?php if ($monthly_receipt_expense0<0) { ?> style="color: red"  <?php }?>  <?php if ($monthly_receipt_expense0>0) { ?> style="color: #1771c6"  <?php }?>  ><?php echo showNumber(($monthly_receipt_expense0 *12)) ?>円</td>
                                <th >収支/年</th>
                                <td class="right_text" <?php if(($rent0 - $subtotal_2)>0){?> style="color: #1771c6"  <?php } ?> <?php if(($rent0 - $subtotal_2)<0){?> style="color: red"  <?php } ?> ><?php echo showNumber(($rent0 - $subtotal_2) *12) ?>円</td>
                            </tr>
                            </thead>
                        </table>
                        <table>
                            <thead>
                            <tr>
                                <th>ローン期間中</th>
                                <th></th>
                                <th>ローン完済後</th>
                            </tr>
                            <tr>
                                <td class="right_text" style="color: red" > <?php echo showNumber($subtotal1,'-') ?>円</td>

                                <th>支出合計/月</th>
                                <?php $subtotal_2=$management_cost1+$commission1;?>
                                <td class="right_text" style="color: red" ><?php echo showNumber($subtotal_2,'-') ?>円</td>

                            </tr>
                            <tr>
                                <td class="right_text" <?php if($rent1>0){?> style="color: #1771c6"  <?php } ?>  <?php if($rent1<0){?> style="color: red"  <?php } ?>><?php echo showNumber($rent1) ?>円</td>
                                <th>家賃</th>
                                <td class="right_text" <?php if($rent1>0){?> style="color: #1771c6"  <?php } ?>  <?php if($rent1<0){?> style="color: red"  <?php } ?>><?php echo showNumber($rent1) ?>円</td>
                            </tr>
                            <tr class="yellow-box01">
                                <td class="right_text" <?php if ($monthly_receipt_expense1<0) { ?> style="color: red"  <?php }?>  <?php if ($monthly_receipt_expense1>0) { ?> style="color: #1771c6"  <?php }?>><?php echo showNumber($monthly_receipt_expense1) ?>円</td>
                                <th >収支/月</th>
                                <td class="right_text" <?php if(($rent1 - $subtotal_2)>0){?> style="color: #1771c6" <?php } ?> <?php if(($rent1 - $subtotal_2)<0){?> style="color: red" <?php } ?>><?php echo showNumber($rent1 - $subtotal_2) ?>円</td>
                            </tr>
                            <tr class="yellow-box02">
                                <td class="right_text" <?php if ($monthly_receipt_expense1<0) { ?> style="color: red"  <?php }?> <?php if ($monthly_receipt_expense1>0) { ?> style="color: #1771c6"  <?php }?>><?php echo showNumber($monthly_receipt_expense1 *12) ?>円</td>
                                <th  >収支/年</th>
                                <td class="right_text" <?php if(($rent1 - $subtotal_2) >0){?> style="color: #1771c6" <?php } ?>  <?php if(($rent1 - $subtotal_2) <0){?> style="color: red" <?php } ?>> <?php echo showNumber(($rent1 - $subtotal_2) *12) ?>円</td>
                            </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </form>
        </div>
        <div class="btn-wrap">
            <div>
                <a href="<?php echo $_SERVER["REQUEST_URI"]; ?>">
                    <p class="tableBtn">計算をやり直す ＞</p>
                </a></div>
            <div>
            </div>
        </div>
    </section>

</div>
<script
        src="https://code.jquery.com/jquery-3.4.1.js"
        integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
        crossorigin="anonymous"></script>
<script src="../js/jquery.validate.min.js" type="text/javascript"></script>
<script>

    var countRecipe = 0;

    function realsEtateMoney(id,val){
        $("#real_estate_money"+id).val(val);
        getData(id)
    }
    function interestGraph(id,val){
        $("#interest"+id).val(val);
        getData(id)
    }
    function timeGraph(id,val){
        $("#time"+id).val(val);
        getData(id)
    }
    function commissionGraph(id,val){
        $("#Typecommission"+id).val(val);
        getData(id)
    }
    function addRecipeClick(){
        if(countRecipe >= 4) return;
        countRecipe = countRecipe + 1;

        addRecipe(countRecipe);
        $('#countRecipe').val(countRecipe);
    }
    function addRecipe(id){

        var myvar ='';



        $(myvar).insertAfter( ".recipe"+(id-1));

    }
    function changeAction(action_name)
    {
        if (action_name=='graph'){
            document.post.action="{{route('graph')}}"
        }else if(action_name=='compare'){
            document.post.action="{{route('compare')}}"
        }
    }
    function formatNumber(number){
        if(number =="") return "";
        return parseFloat(number)
            .toFixed(0)
            .replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
    }

    function getData(id){
        var real_estate_money=$('#real_estate_money'+id).children(":selected").val();
        var owner_money=$('#owner_money'+id).val();
        $('#loan'+id).val((real_estate_money-owner_money)*10000);
        $('#loanShow'+id).val(formatNumber((real_estate_money-owner_money)*10000));
        var loan = $('#loan'+id).val();
        var loan_pmt = parseInt(loan);
        var interest=$('#interest'+id).val();
        var interest_pmt = parseFloat(interest/100/12)
        var time=$('#time'+id).val();
        var time_pmt = parseInt(time*12);
        var calcul_pmt =Math.floor((interest_pmt*loan_pmt*Math.pow(1+interest_pmt,time_pmt))/(Math.pow(1+interest_pmt,time_pmt)-1));
        calcul_pmt = isFinite(calcul_pmt) ? calcul_pmt : "";
        $('#pmt'+id).val(calcul_pmt);
        $('#pmtShow'+id).val(formatNumber(calcul_pmt));
        var pmt = $('#pmt'+id).val();
        var management_cost = 69000;
        // $('#management_cost'+id).val(management_cost);
        // $('#management_costShow'+id).val(formatNumber(management_cost));

        $('#management_cost'+id).val($('#management_costShow'+id).val());

        var subcommission =  parseInt(pmt) + parseInt(management_cost) || 0;
        var rent;
        var Commission1 = 0
        var Commission2 = 0
        if (real_estate_money == 12000){
            rent = 650000;
            Commission1 = (rent*12)/100;
            Commission2 = (rent*5)/100;
            $('#spanCommission'+id+'1').text('家賃保証 '+formatNumber(Commission1)+'円');
            $('#spanCommission'+id+'2').text('集金代行 '+formatNumber(Commission2)+'円');

        } else if (real_estate_money == 7000){
            rent = 380000;
            Commission1 = (rent*12)/100;
            Commission2 = (rent*5)/100;
            $('#spanCommission'+id+'1').text('家賃保障 '+formatNumber(Commission1)+'円');
            $('#spanCommission'+id+'2').text('集金代行 '+formatNumber(Commission2)+'円');
        }
        // $('#rent'+id).val(rent);

        //sua sau
        rent =  $('#rentShow'+id).val();
        $('#rent'+id).val(rent);
        // $('#rentShow'+id).val(formatNumber(rent));


        if(parseInt(rent) >0){
            $('#rentShow'+id).removeClass("textColor");
        }else {
            $('#rentShow'+id).addClass("textColor");
        }
        //end

        var commissionType = $('#Typecommission'+id).val() || 0;
        var commission = 0;
        if(commissionType == 1){
            commission = Commission1;
            $('#commission'+id).val(10000);

        }
        if(commissionType == 2){
            commission = Commission2;
            $('#commission'+id).val(5000);

        }
        // var subtotal = subcommission + parseInt(commission) || 0;
        var subtotal = 0;
        if(parseInt($('#pmt'+id).val())>0){
            subtotal =  subtotal +  parseInt($('#pmt'+id).val());
        }
        if(parseInt($('#management_costShow'+id).val())>0){
            subtotal =  subtotal +  parseInt($('#management_costShow'+id).val());
        }
        if(parseInt($('#commission'+id).val())>0){
            subtotal =  subtotal +  parseInt($('#commission'+id).val());
        }
        $('#subtotal'+id).val(subtotal);
        $('#subtotalShow'+id).val(formatNumber(subtotal));
        var subtotal = $('#subtotal'+id).val();

        var monthly_receipt_expense = parseInt(rent) - parseInt(subtotal) || 0;
//        $('#rent'+id).on('input',function() {
//             subtotal = parseInt($('#subtotal'+id).val()) || 0;
//             rent = parseInt($('#rent'+id).val()) || 0;
//            $('#monthly_receipt_expense'+id).val(rent-subtotal);
//        });
        $('#monthly_receipt_expense'+id).val(monthly_receipt_expense);
        $('#monthly_receipt_expenseShow'+id).val(formatNumber(monthly_receipt_expense));

        if(parseInt(monthly_receipt_expense) >0){
            $('#monthly_receipt_expenseShow'+id).removeClass("textColor");
        }else {
            $('#monthly_receipt_expenseShow'+id).addClass("textColor");
        }

    }

    function ownerMoney(id){
        var data=getData(id)
        var owner_money=data[0], real_estate_money=data[1]
    }

    $('#graph').validate({
        errorElement: "dd",
        ignore: [],
        errorPlacement: function(error, element) {
            if (element.attr("name") == "real_estate_money0" ){
                error.insertAfter("#err_real_estate_money0");
            }
            if (element.attr("name") == "owner_money0" ){
                error.insertAfter("#err_owner_money0");
            }
            if (element.attr("name") == "interest0" ){
                error.insertAfter("#err_interest0");
            }
            if (element.attr("name") == "time0" ){
                error.insertAfter("#err_time0");
            }
            if (element.attr("name") == "loan0" ){
                error.insertAfter("#err_loan0");
            }
            if (element.attr("name") == "management_cost0" ){
                error.insertAfter("#err_management_cost0");
            }
            if (element.attr("name") == "pmt0" ){
                error.insertAfter("#err_pmt0");
            }
            if (element.attr("name") == "subtotal0" ){
                error.insertAfter("#err_subtotal0");
            }
            if (element.attr("name") == "rent0" ){
                error.insertAfter("#err_rent0");
            }
            if (element.attr("name") == "monthly_receipt_expense0" ){
                error.insertAfter("#err_monthly0");
            }

            if (element.attr("name") == "real_estate_money1" ){
                error.insertAfter("#err_real_estate_money1");
            }
            if (element.attr("name") == "owner_money1" ){
                error.insertAfter("#err_owner_money1");
            }
            if (element.attr("name") == "interest1" ){
                error.insertAfter("#err_interest1");
            }
            if (element.attr("name") == "time1" ){
                error.insertAfter("#err_time1");
            }
            if (element.attr("name") == "loan1" ){
                error.insertAfter("#err_loan1");
            }
            if (element.attr("name") == "management_cost1" ){
                error.insertAfter("#err_management_cost1");
            }
            if (element.attr("name") == "pmt1" ){
                error.insertAfter("#err_pmt1");
            }
            if (element.attr("name") == "subtotal1" ){
                error.insertAfter("#err_subtotal1");
            }
            if (element.attr("name") == "rent1" ){
                error.insertAfter("#err_rent1");
            }
            if (element.attr("name") == "monthly_receipt_expense1" ){
                error.insertAfter("#err_monthly1");
            }
        },
        rules:{
            real_estate_money0: {
                required: true,
                number: true
            },
            owner_money0: {
                required: true,
                digits: true,
            },
            interest0: {
                required: true,
            },
            time0: {
                required: true,
            },
            management_cost0: {
                required: true,
                digits: true
            },
            commission0: {
                digits: true
            },
            rent0: {
                required: true,
                digits: true
            },
            pmt0: {
                required: true,
                digits: true
            },
            monthly_receipt_expense0: {
                required: true,
                number: true
            },
            loan0: {
                required: true,
                digits: true
            },
            subtotal0: {
                required: true,
                digits: true
            },

            real_estate_money1: {
                required: true,
                number: true
            },
            owner_money1: {
                required: true,
                digits: true,
            },
            interest1: {
                required: true,
            },
            time1: {
                required: true,
            },
            management_cost1: {
                required: true,
                digits: true
            },
            commission1: {
                digits: true
            },
            rent1: {
                required: true,
                digits: true
            },
            pmt1: {
                required: true,
                digits: true
            },
            monthly_receipt_expense1: {
                required: true,
                number: true
            },
            loan1: {
                required: true,
                digits: true
            },
            subtotal1: {
                required: true,
                digits: true
            },
        },
        messages: {
            real_estate_money0: {
                required: "このフィールドは必須です。",
                digits:"正の整数を入力してください。"
            },
            owner_money0: {
                required: "このフィールドは必須です。",
                digits:"正の整数を入力してください。"
            },
            loan0: {
                required: "このフィールドは必須です。",
                digits:"正の整数を入力してください。"
            },
            interest0: {
                required: "このフィールドは必須です。",
                digits:"正の整数を入力してください。"
            },
            time0: {
                required: "このフィールドは必須です。",
                digits:"正の整数を入力してください。"
            },pmt0: {
                required: "このフィールドは必須です。",
                digits:"正の整数を入力してください。"
            },
            management_cost0: {
                required: "このフィールドは必須です。",
                digits:"正の整数を入力してください。"
            },
            commission0: {
                required: "このフィールドは必須です。",
                digits:"正の整数を入力してください。"
            },
            subtotal0: {
                required: "このフィールドは必須です。",
                digits:"正の整数を入力してください。"
            },
            rent0: {
                required: "このフィールドは必須です。",
                digits:"正の整数を入力してください。"
            },
            monthly_receipt_expense0: {
                required: "このフィールドは必須です。",
                number:"整数を入力してください。"
            },

            real_estate_money1: {
                required: "このフィールドは必須です。",
                digits:"正の整数を入力してください。"
            },
            owner_money1: {
                required: "このフィールドは必須です。",
                digits:"正の整数を入力してください。"
            },
            loan1: {
                required: "このフィールドは必須です。",
                digits:"正の整数を入力してください。"
            },
            interest1: {
                required: "このフィールドは必須です。",
                digits:"正の整数を入力してください。"
            },
            time1: {
                required: "このフィールドは必須です。",
                digits:"正の整数を入力してください。"
            },pmt1: {
                required: "このフィールドは必須です。",
                digits:"正の整数を入力してください。"
            },
            management_cost1: {
                required: "このフィールドは必須です。",
                digits:"正の整数を入力してください。"
            },
            commission1: {
                required: "このフィールドは必須です。",
                digits:"正の整数を入力してください。"
            },
            subtotal1: {
                required: "このフィールドは必須です。",
                digits:"正の整数を入力してください。"
            },
            rent1: {
                required: "このフィールドは必須です。",
                digits:"正の整数を入力してください。"
            },
            monthly_receipt_expense1: {
                required: "このフィールドは必須です。",
                number:"整数を入力してください。"
            },
        }
    })
</script>
<!--▼footer strat-->
<?php
include('../layout/footer.php');
?>
<div class="btn_pagetop"><a href="#pagetop" class="anchor">PAGE<br>TOP</a></div>
</body>
</html>
