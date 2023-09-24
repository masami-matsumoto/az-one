<?php
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
require_once "../PHPExcel/Classes/PHPExcel.php";
?>
<!doctype html>
<html>

<?php
include('../layout/head.php');
?>
<body>

<?php
include('../layout/header.php');
?>

<div  id="content">
    <style>
        .textColor{
            color: red;
        }
    </style>

    <?php
    $isShowFrom = true;
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $isShowFrom = false;
        $countRecipe  = 0;
        for($iCount=0;$iCount<=$countRecipe;$iCount++){
            $nameReal_estate =  'real_estate_money'.$iCount;
            $real_estate= (float)$_POST[$nameReal_estate];
            $nameOwner_money =  'owner_money'.$iCount;
            $money= (float)$_POST[$nameOwner_money];
            $nameLoan = 'loan'.$iCount;
            $loan= (float)$_POST[$nameLoan];
            $nameTime =  'time'.$iCount;
            $time= (float)$_POST[$nameTime];
            $nameInterest =  'interest'.$iCount;
            $interest=(float)$_POST[$nameInterest];
            $namePmt =   'pmt'.$iCount;
            $pmt=(float)$_POST[$namePmt];
            $nameManagement_cost = 'management_cost'.$iCount;
            $management_cost=(float)$_POST[$nameManagement_cost];

            $nameCommission =    'commission'.$iCount;
            $commission=(float)$_POST[$nameCommission];

            $nameCommissionT =    'commission'.$iCount;
            $commissionT=(float)$_POST[$nameCommissionT];

            $namesubtotal = 'subtotal'.$iCount;
            $subtotal=(float)$_POST[$namesubtotal];
            $nameRent=  'rent'.$iCount;
            $rent=(float)$_POST[$nameRent];
            $nameMonthly_receipt_expense = 'monthly_receipt_expense'.$iCount;
            $monthly_receipt_expense=(float)$_POST[$nameMonthly_receipt_expense];
            $earnings=(float)$rent-((float)$management_cost+(float)$commission);
            ?>

            <?php
            $arrDataGraph = array();
            $arrTime = array();
            for($i=1;$i<=$time/5;$i++){
                array_push($arrTime,$i*12*5);
            }
            $total = 0;
            for($i=1;$i<=12*$time;$i++){
                $ppmt= PHPExcel_Calculation_Financial::PPMT($interest/100/12,$i,$time*12,$loan);
                if(is_numeric($ppmt)){
                    $total+=$ppmt;
                    $debt=$loan+$total;
                    if (in_array($i, $arrTime))
                    {
                        array_push($arrDataGraph,$debt);
                    }
                }else{
                    if (in_array($i, $arrTime))
                    {
                        array_push($arrDataGraph,0);
                    }
                }
            }
            ?>

            <script>
                var uA = window.navigator.userAgent,
                    onlyIEorEdge = /msie\s|trident\/|edge\//i.test(uA) && !!( document.uniqueID || window.MSInputMethodContext),
                    checkVersion = (onlyIEorEdge && +(/(edge\/|rv:|msie\s)([\d.]+)/i.exec(uA)[2])) || NaN;
                var testIE =  !isNaN(checkVersion);
                var widthBar = '80%';
                var widthGroup = "40%";
                if(testIE){
                    widthBar = '80%';
                    widthGroup = "30%";
                }
                google.charts.load("current", {packages:['corechart']});
                google.charts.setOnLoadCallback(drawChart);
                function drawChart() {
                    var time = <?php echo $time ?>;
                    var pmt = <?php echo $pmt ?>;
                    var loan = <?php echo $loan ?>;
                    var earnings = <?php echo $earnings ?>;
                    var arrDataGraph = <?php echo json_encode($arrDataGraph ) ?> ;
                    var arrAllData = [];
                    arrAllData.push(['年', '金額', {role: 'style'}]);
                    var countY = time/5;
                    var countE = 1;
                    for (var i=1;i<=countY*2;i++){
                        var year = i*5;
                        if(year<10){
                            year = '0'+year;
                        }
                        if(i<=countY){
                            arrAllData.push([year +'年', Math.round(arrDataGraph[i-1]/10000) , 'fill-color: #CF260F']);

                        }else{
                            arrAllData.push( [year +'年', Math.round(earnings*5*12*countE/10000) , 'fill-color: #2EAFF4']);
                            countE++;
                        }
                    }
                    var data = google.visualization.arrayToDataTable(arrAllData);
                    var view = new google.visualization.DataView(data);
                    view.setColumns([0, 1,
                        { calc: "stringify",
                            sourceColumn: 1,
                            type: "string",
                            role: "annotation" },
                        2]);
                    var options = {
                        title: "ローン計算結果",
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
                    var chart = new google.visualization.ColumnChart(document.getElementById("columnchart_values<?php echo $iCount;?>"));
                    chart.draw(view, options);
                }
            </script>
            <?php
        }
    }
    ?>
    <div class="pankuzu pcView"><a href="https://az-one.biz/"><img src="../img/common/icon_home.png" width="20px" height="" alt="home" /></a>&nbsp;&gt;&nbsp;不動産投資シミュレーション</div>
<?php if($isShowFrom) { ?>
    <section class="explanatory" id="simulation">
        <h2 class="main_title">不動産投資シミュレーション</h2>
        <div class="simulation-catch">
            <p>不動産投資の簡単シミュレーション！！</p>
            <p>ローン期間中の収支から家賃収入累積までをシミュレーション計算いたします。</p>
        </div>
        <div class="baseForm">
            <form class="form-horizontal" method="post" name="post" action="" id="graph">
                <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
                <input type="hidden" name="" value="">
                <div id="scroolForm" class="baseBox">
                    <div class="baseFormDlist basePane">
                        <dl class="in">
                            <dt><span>購入物件価格</span></dt>
                            <dd>選択
                                <input id="radio1-1" class="radiobutton" type="radio" name="real_estate_money0" value="12000">
                                <label for="radio1-1" class="real_estate_money"  data-price="12000" onclick="realsEtateMoney(0,12000)">新築 12,000万円</label>
                                <input id="radio1-2" class="radiobutton"  type="radio" name="real_estate_money0" value="7000">
                                <label for="radio1-2" class="real_estate_money" data-price="7000" onclick="realsEtateMoney(0,7000)">中古 7,000万円</label>

                                <select hidden style="" name="real_estate_money0" id="real_estate_money0">
                                    <option value="">選択</option>
                                    <option value="12000">12000</option>
                                    <option value="7000">7000</option>
                                </select>
                                <div><span id="err_real_estate_money0"></span></div>
                            </dd>

                        </dl>
                        <dl class="in">
                            <dt><span>自己資金</span></dt>
                            <dd>
                                <select class="form-control input-lg" name="owner_money0" id="owner_money0" onchange="ownerMoney(0)">
                                    <option value="">選択</option>
                                    <option value="10">10万</option>
                                    <option value="500">500万</option>
                                    <option value="1000">1000万</option>
                                    <option value="2000">2000万</option>
                                    <option value="2000">3000万</option>
                                </select>
                                円
                                <div><span id="err_owner_money0"></span></div>
                            </dd>
                        </dl>
                        <dl class="in">
                            <dt><span>融資額</span></dt>
                            <dd>
                                <input class="form-control" type="" placeholder="" name="loanShow0" id="loanShow0" value="" readonly >
                                <input class="form-control" type="hidden" placeholder="" name="loan0" id="loan0" value=""  >

                                円
                                <div><span id="err_loan0"></span></div>
                            </dd>

                        </dl>
                        <dl class="in">
                            <dt><span>金利</span></dt>
                            <dd>選択
                                <input id="radio2-1" class="radiobutton" type="radio" name="interest0" value="1.2">
                                <label for="radio2-1" class="interest" data-interest="1.2" onclick="interestGraph(0,1.2)">1.2%</label>
                                <input id="radio2-2" class="radiobutton" type="radio" name="interest0" value="1.5">
                                <label for="radio2-2" class="interest" data-interest="1.5" onclick="interestGraph(0,1.5)">1.5%</label>
                                <input id="radio2-3" class="radiobutton" type="radio" name="interest0" value="2">
                                <label for="radio2-3" class="interest" data-interest="2" onclick="interestGraph(0,2)">2%</label>

                                <select hidden style="" name="interest0" id="interest0">
                                    <option value="0">0</option>
                                    <option value="1.2">1.2</option>
                                    <option value="1.5">1.5</option>
                                    <option value="2">2</option>
                                </select>
                                <div><span id="err_interest0"></span></div>
                            </dd>
                        </dl>
                        <dl class="in">
                            <dt><span>期間</span></dt>
                            <dd id="time">選択
                                <input id="radio3-1" class="radiobutton" type="radio" name="time0" value="22">
                                <label for="radio3-1" class="time" data-time="22" onclick="timeGraph(0,22)">22年</label>
                                <input id="radio3-2" class="radiobutton" type="radio" name="time0" value="35">
                                <label for="radio3-2" class="time" data-time="35" onclick="timeGraph(0,35)">35年</label>

                                <select hidden style="" name="time0" id="time0" >
                                    <option value="0">0</option>
                                    <option value="22">22</option>
                                    <option value="35">35</option>
                                </select>
                                <div><span id="err_time0"></span></div>
                            </dd>
                        </dl>
                        <dl class="in">
                            <dt><span>毎月返済額</span></dt>
                            <dd>
                                <input class="form-control" type="" placeholder="" name="pmtShow0" id="pmtShow0" value="" readonly >
                                <input class="form-control" type="hidden" placeholder="" name="pmt0" id="pmt0" value=""  >

                                円
                                <div><span id="err_pmt0"></span></div>
                            </dd>

                        </dl>
                        <dl class="in">
                            <dt><span>管理費・修繕費</span></dt>
                            <dd>
                                <input class="" type="" placeholder="" name="management_costShow0" id="management_costShow0" onkeyup="getData(0)" readonly>
                                <input class="" type="hidden" placeholder="" name="management_cost0" id="management_cost0" onkeyup="getData(0)" >

                                円
                                <div><span id="err_management_cost0"></span></div>
                            </dd>
                        </dl>
                        <dl class="in">
                            <dt><span>管理委託手数料</span></dt>
                            <dd>選択
                                <input id="radio4-1" class="radiobutton" type="radio"  value="12"  name="commission5" >
                                <label for="radio4-1" class="commission" data-commission="12" onclick="commissionGraph(0,1)"><span id="spanCommission1">家賃保障</span></label>
                                <input id="radio4-2" class="radiobutton" type="radio" name="commission5" value="5"  >
                                <label for="radio4-2" class="commission" data-commission="5" onclick="commissionGraph(0,2)"><span id="spanCommission2">集金代行</span></label>


                                <input id="commission0" class="radiobutton" type="hidden" name="commission0" value=""  >
                                <input id="Typecommission0" class="radiobutton" type="hidden" name="Typecommission0" value=""  >



                            </dd>
                        </dl>
                        <dl class="in">
                            <dt><span>小計</span></dt>
                            <dd>
                                <input class="form-control" type="" placeholder="" name="subtotalShow0" id="subtotalShow0" value="" readonly>
                                <input class="form-control" type="hidden" placeholder="" name="subtotal0" id="subtotal0" value="" >

                                円
                                <div><span id="err_subtotal0"></span></div>
                            </dd>

                        </dl>
                        <dl class="in">
                            <dt><span>家賃</span></dt>
                            <dd>
                                <input class="" type="" placeholder="" value="" name="rentShow0" id="rentShow0" onchange="getData(0)" readonly >
                                <input class="" type="hidden" placeholder="" value="" name="rent0" id="rent0" onchange="getData(0)"  >

                                円
                                <div><span id="err_rent0"></span></div>
                            </dd>
                        </dl>
                        <dl class="in">
                            <dt><span>毎月収支</span></dt>
                            <dd>
                                <input class="" type="" placeholder="" name="monthly_receipt_expenseShow0" id="monthly_receipt_expenseShow0" value="" readonly >
                                <input class="" type="hidden" placeholder="" name="monthly_receipt_expense0" id="monthly_receipt_expense0" value=""  >

                                円
                                <div><span id="err_monthly0"></span></div>
                            </dd>
                        </dl>

                    </div>
                    <p class="baseFormBtn">
                        <input type="submit" value="計算する ＞">
                    </p>
                </div>
            </form>
        </div>
    </section>
<?php }else{ ?>

    <section class="explanatory" id="simulation02">
        <h2 class="main_title">不動産投資シミュレーション</h2>
        <div class="simulation-catch">
            <p><?php echo $time ?>年シミュレーションの結果です。</p>
        </div>
        <div class="wrap_whi">
            <ul class="busi_top">
                <li>
                    <dl>
                        <dt>収支負担額合計</dt>
                        <dd <?php if ($monthly_receipt_expense *12 * $time<0) { ?> style="color: red"  <?php }?>  ><?php echo number_format($monthly_receipt_expense *12 * $time) ?>円</dd>
                    </dl>
                </li>
                <li>
                    <dl>
                        <dt>家賃収入合計</dt>
                        <dd><?php echo number_format(($rent - ($management_cost+$commission)) *12 * $time) ?>円</dd>
                    </dl>
                </li>
            </ul>
        </div>
        <div class="columchart">
            <h3>グラフ収支</h3>
            <div class="card card-block" style="margin-top: 20px">
                <div id="columnchart_values0"></div>
            </div>

            <div class="baseForm">
                <div class="baseBox">
                    <div class="basePane tableBlock">
                        <table>
                            <thead>
                            <tr>
                                <td class="table-title bg-red">ローン期間中</td>
                                <th></th>
                                <td class="table-title bg-blue">ローン完済後</td>
                            </tr>
                            <tr>
                                <td class="bg-red">新築　<?php echo number_format($real_estate) ?>万円</td>
                                <th>購入物件価格</th>
                                <td class="bg-blue">新築　<?php echo number_format($real_estate) ?>万円</td>
                            </tr>
                            <tr>
                                <td class="bg-red"><?php echo number_format($money * 10000) ?>円</td>
                                <th>自己資金</th>
                                <td class="bg-blue"><?php echo number_format($money * 10000) ?>円</td>
                            </tr>
                            <tr>
                                <td class="bg-red"><?php echo number_format($loan/10000) ?>万円</td>
                                <th>融資額</th>
                                <td class="bg-blue"><?php echo number_format($loan/10000) ?>万円</td>
                            </tr>
                            <tr>
                                <td class="bg-red"><?php echo $interest ?>%</td>
                                <th>金利</th>
                                <td class="bg-blue"><?php echo $interest ?>%</td>
                            </tr>
                            <tr>
                                <td class="bg-red"><?php echo $time ?>年</td>
                                <th>期間</th>
                                <td class="bg-blue"><?php echo $time ?>年</td>
                            </tr>
                            <tr>
                                <td class="bg-red"><?php echo number_format($pmt) ?>円</td>
                                <th>毎月返済額</th>
                                <td class="bg-blue">0円</td>
                            </tr>
                            <tr>
                                <td class="bg-red"><?php if ($management_cost !=0) echo number_format($management_cost); else echo 0 ?>円</td>
                                <th>管理費・修繕費</th>
                                <td class="bg-blue"><?php if ($management_cost !=0) echo number_format($management_cost); else echo 0 ?>円</td>
                            </tr>
                            <tr>
                                <td class="bg-red">家賃保証　<?php if ($commissionT !=0) echo number_format($commissionT); else echo 0 ?>円</td>
                                <th>賃貸管理費</th>
                                <td class="bg-blue">家賃保証　<?php if ($commissionT !=0) echo number_format($commissionT); else echo 0 ?>円</td>
                            </tr>
                            </thead>
                        </table>
                    </div>
                </div>
                <div class="baseBox" style="background-color: #FFFFFF;margin-bottom: 35px">
                    <h3 class="underline-title" style="margin-left: 10px">収支</h3>
                    <div class="basePane tableBlock wrap_table"  style="padding-bottom: 0px!important;">
                        <table>
                            <thead>
                            <tr>
                                <td style="text-align: center;"><b>ローン期間中</b></td>
                                <th></th>
                                <td style="text-align: center;"><b>ローン完済後</b></td>
                            </tr>
                            <tr>
                                <td><?php echo number_format( $subtotal) ?>円</td>
                                <th>小計</th>
                                <td><?php echo number_format($subtotal_2=$management_cost+$commission) ?>円</td>
                            </tr>
                            <tr>
                                <td><?php echo number_format($rent) ?>円</td>
                                <th>家賃</th>
                                <td><?php echo number_format($rent) ?>円</td>
                            </tr>
                            <tr class="yellow-box01">
                                <td <?php if ($monthly_receipt_expense<0) { ?> style="color: red"  <?php }?>  <?php if ($monthly_receipt_expense>0) { ?> style="color: blue"  <?php }?> ><?php if ($monthly_receipt_expense<0) {echo "ー";} ?><?php if ($monthly_receipt_expense>0) {echo "＋";} ?><?php echo number_format(abs($monthly_receipt_expense)) ?>円</td>
                                <th>収支/月</th>
                                <td style="color: blue">＋<?php echo number_format($rent - $subtotal_2) ?>円</td>
                            </tr>
                            <tr class="yellow-box02">
                                <td <?php if ($monthly_receipt_expense<0) { ?> style="color: red"  <?php }?> <?php if ($monthly_receipt_expense>0) { ?> style="color: blue"  <?php }?>><?php if ($monthly_receipt_expense<0) {echo "ー";} ?><?php if ($monthly_receipt_expense>0) {echo "＋";} ?><?php echo number_format(abs($monthly_receipt_expense *12)) ?>円</td>
                                <th>収支/年</th>
                                <td style="color: blue">＋<?php echo number_format(($rent - $subtotal_2) *12) ?>円</td>
                            </tr>
                            </thead>
                        </table>
                    </div>
                </div>
                <div class="btn-wrap">
                    <div>
                        <a href="<?php echo $_SERVER["REQUEST_URI"]; ?>">
                            <p class="tableBtn">計算をやり直す ＞</p>
                        </a></div>
                    <div>
                    </div>
                </div>
            </div>


    </section>
<?php } ?>
    <!-- <script
            src="https://code.jquery.com/jquery-3.4.1.js"
            integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
            crossorigin="anonymous"></script> -->
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
            var interest=$('#interest'+id).children(":selected").val();
            var interest_pmt = parseFloat(interest/100/12)
            var time=$('#time'+id).children(":selected").val();
            var time_pmt = parseInt(time*12);
            var calcul_pmt =Math.floor((interest_pmt*loan_pmt*Math.pow(1+interest_pmt,time_pmt))/(Math.pow(1+interest_pmt,time_pmt)-1));
            calcul_pmt = isFinite(calcul_pmt) ? calcul_pmt : "";
            $('#pmt'+id).val(calcul_pmt);
            $('#pmtShow'+id).val(formatNumber(calcul_pmt));
            var pmt = $('#pmt'+id).val();
            var management_cost = 69000;
            $('#management_cost'+id).val(management_cost);
            $('#management_costShow'+id).val(formatNumber(management_cost));
            var subcommission =  parseInt(pmt) + parseInt(management_cost) || 0;
            var rent;
            var Commission1 = 0
            var Commission2 = 0
            if (real_estate_money == 12000){
                rent = 650000;
                Commission1 = (rent*12)/100;
                Commission2 = (rent*5)/100;
                $('#spanCommission1').text('家賃保障 '+formatNumber(Commission1)+'円');
                $('#spanCommission2').text('集金代行 '+formatNumber(Commission2)+'円');

            } else if (real_estate_money == 7000){
                rent = 400000;
                Commission1 = (rent*12)/100;
                Commission2 = (rent*5)/100;
                $('#spanCommission1').text('家賃保障 '+formatNumber(Commission1)+'円');
                $('#spanCommission2').text('集金代行 '+formatNumber(Commission2)+'円');
            }
            $('#rent'+id).val(rent);
            $('#rentShow'+id).val(formatNumber(rent));

            if(parseInt(rent) >0){
                $('#rentShow'+id).removeClass("textColor");
            }else {
                $('#rentShow'+id).addClass("textColor");
            }

            var commissionType = $('#Typecommission'+id).val() || 0;
            var commission = 0;
            if(commissionType == 1){
                commission = Commission1;
                $('#commission'+id).val(Commission1);

            }
            if(commissionType == 2){
                commission = Commission2;
                $('#commission'+id).val(Commission2);

            }
            var subtotal = subcommission + parseInt(commission) || 0;
            $('#subtotal'+id).val(subtotal);
            $('#subtotalShow'+id).val(formatNumber(subtotal));
            var subtotal = $('#subtotal'+id).val();

            var monthly_receipt_expense = rent - subtotal ||0;
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
                if (element.attr("name") == "real_estate_money0") {
                    error.insertAfter("#err_real_estate_money0");
                }
                if (element.attr("name") == "owner_money0") {
                    error.insertAfter("#err_owner_money0");
                }
                if (element.attr("name") == "interest0") {
                    error.insertAfter("#err_interest0");
                }
                if (element.attr("name") == "time0") {
                    error.insertAfter("#err_time0");
                }
                if (element.attr("name") == "loan0") {
                    error.insertAfter("#err_loan0");
                }
                if (element.attr("name") == "management_cost0") {
                    error.insertAfter("#err_management_cost0");
                }
                if (element.attr("name") == "pmt0") {
                    error.insertAfter("#err_pmt0");
                }
                if (element.attr("name") == "subtotal0") {
                    error.insertAfter("#err_subtotal0");
                }
                if (element.attr("name") == "rent0") {
                    error.insertAfter("#err_rent0");
                }
                if (element.attr("name") == "monthly_receipt_expense0") {
                    error.insertAfter("#err_monthly0");
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
                greater0:true
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
        }
        })
    </script>
</div>
<!--▼footer strat-->
<?php
include('../layout/footer.php');
?>
</body>
</html>
