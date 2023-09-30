<?php
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
require_once "../PHPExcel/Classes/PHPExcel.php";
?>
<!doctype html>
<html>
<body>

<?php
include('../layout/head.php');
?>
<body>

<?php
include('../layout/header.php');
?>


<div  id="content">
    <style>
        td,th{
            text-align: center;
            max-width: 20px;
        }
    </style>
    <div class="pankuzu pcView"><a href="https://az-one.biz/"><img src="../img/common/icon_home.png" width="20" height="" alt="home" /></a>&nbsp;&gt;&nbsp;年金受給額シミュレーション</div>

    <section class="explanatory" id="simulation03">
        <h2 class="main_title">年金受給額シミュレーション</h2>
        <div class="baseForm">
            <form action="" method="post" class="form-horizontal">
                <input type="hidden" name="" value="">
                <div id="scroolForm" class="baseBox">
                    <div class="baseFormDlist basePane" style="padding-top: 15px; padding-bottom: 15px;">

                        <table>
                            <caption>
                                老齢基礎年金
                            </caption>
                            <tr class="in">
                                <input class="number_input grey" type="hidden" placeholder="例　30才" id="current_age" name="current_age" value="30" onkeyup="getYear()" >
                                <input class="number_input" type="hidden" placeholder="例　22才" id="working_age" name="working_age" value="22" onkeyup="getYear()" >
                                <input class="number_input" type="hidden" placeholder="例　60才" id="retire_age" name="retire_age" value="60" onkeyup="getYear()" >
                                <th class="col-1"><span>加入(納付)年数</span></th>
                                <td class="col-2"><input class="number_input" type="number"  disabled placeholder="40" id="joined_year" name="joined_year" value="40" onkeyup="getYear()" >
                                    年 </td>
                            </tr>
                            <tr class="in">
                                <th><span>月額</span></th>
                                <td><span id="basic_pension_month"></span>  円 </td>
                            </tr>
                            <tr class="in">
                                <th><span>年額</span></th>
                                <td><span id="basic_pension_year"></span> 円 </td>
                            </tr>
                        </table>
                        <div style="margin-top: 10px!important;">
                            <table class="mb_20" >
                                    <span style="color: red;font-weight: bold;">※老齢基礎年金は、保険料納付済期間と保険料免除期間などを合算した受給資格期間が10年以上ある場合に、65歳から受け取ることができます。</span>
                                <caption>
                                    老齢厚生年金
                                </caption>
                                <tr class="in">
                                    <th><span>現役中の平均給与月額<br>
                    <span style="color: red">※賞与を含む</span></th>
                                    <td><input class="number_input" type="number" placeholder="0" id="after_2003_standard_pension" name="after_2003_standard_pension" value="" onkeyup="getYear()" >
                                        円</td>
                                </tr>
                                <tr class="in">
                                    <th><span>老齢厚生年金の合算　月額</span></th>
                                    <td><span id="after_2003_welfare_month"></span> 円 </td>
                                </tr>
                                <tr class="in">
                                    <th><span>老齢厚生年金の合算　年額</span></th>
                                    <td><span id="after_2003_welfare_year"></span> 円 </td>
                                </tr>
                            </table>

                        </div>
                        <table>
                            <caption>
                                <span style="color: red">※2003年4月以降に厚生年金へ加入した場合です。</span>
                            </caption>
                            <caption>
                                老齢基礎年金と老齢厚生年金の合計
                            </caption>
                            <tr class="in">
                                <th class="col-1"><span>月額</span></th>
                                <td class="col-2"><span id="pension_month"></span>  円 </td>
                            </tr>
                            <tr class="in">
                                <th><span>年額</span></th>
                                <td><span id="pension_year"></span>  円 </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </form>
        </div>
    </section>

    <!-- <script
            src="https://code.jquery.com/jquery-3.4.1.js"
            integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
            crossorigin="anonymous"></script> -->
    <script src="../js/jquery.validate.min.js" type="text/javascript"></script>
    <script>


        const standard_pension = 781700;
        const joined_duty_age = 20;
        const before_2003_percentage = 0.7125/100;
        const after_2003_percentage = 0.5481/100;
        const joinable_month = 480;

        function getYear() {
            var now = new Date();
            var currentYear = now.getFullYear();
            var current_age=$('#current_age').val();
            var start_working_age=$('#working_age').val();
            var retire_age=$('#retire_age').val();
            var joined_year= $('#joined_year').val();
            var pension_year = standard_pension*parseInt(joined_year)*12/joinable_month  || 0;
            $('#basic_pension_year').text(number_format(Math.round(pension_year),0,'.',','));
            $('#basic_pension_month').text(number_format(Math.round(pension_year/12),0,'.',','));

            var count_year_before_2003 = 2003-(parseInt(currentYear)-(parseInt(current_age)-parseInt(start_working_age))) || 0;
            var count_year_affter_2003 = parseInt(retire_age) - parseInt(start_working_age) - count_year_before_2003;
            var before_2003 = $('#before_2003_standard_pension').val();
            var after_2003 = $('#after_2003_standard_pension').val();
            var before_2003_year;
            var before_2003_month;
            var after_2003_year;
            var after_2003_month;
            if (count_year_before_2003 > 0){
                before_2003_year = parseInt(before_2003)*before_2003_percentage*(count_year_before_2003*12);
                before_2003_month = before_2003_year/12;
                after_2003_year = parseInt(after_2003)*after_2003_percentage*(count_year_affter_2003*12);
                after_2003_month = after_2003_year/12;
            }else{
                before_2003_year = 0;
                before_2003_month = 0;
                after_2003_year = parseInt(after_2003)*after_2003_percentage*((parseInt(retire_age)-parseInt(start_working_age))*12);
                after_2003_month = after_2003_year/12;
            }
            $('#before_2003_welfare_year').text(number_format(Math.round(before_2003_year),0,'.',','));
            $('#before_2003_welfare_month').text(number_format(Math.round(before_2003_month),0,'.',','));
            $('#after_2003_welfare_year').text(number_format(Math.round(after_2003_year),0,'.',','));
            $('#after_2003_welfare_month').text(number_format(Math.round(after_2003_month),0,'.',','));
            $('#welfare_year').text(number_format(Math.round(before_2003_year+after_2003_year),0,'.',','));
            $('#welfare_month').text(number_format(Math.round(before_2003_month+after_2003_month),0,'.',','));
            $('#pension_year').text(number_format(Math.round(before_2003_year+after_2003_year+pension_year),0,'.',','));
            $('#pension_month').text(number_format(Math.round(before_2003_month+after_2003_month+pension_year/12),0,'.',','));

            if(current_age > 0){
                $("#current_age").css("background-color", "#E0E0E0");
            }else {
                $("#current_age").css("background-color", "#fff");
            }

            if(start_working_age > 0){
                $("#working_age").css("background-color", "#E0E0E0");
            }else {
                $("#working_age").css("background-color", "#fff");
            }

            if(retire_age > 0){
                $("#retire_age").css("background-color", "#E0E0E0");
            }else {
                $("#retire_age").css("background-color", "#fff");
            }

            if(joined_year > 0){
                $("#joined_year").css("background-color", "#E0E0E0");
            }else {
                $("#joined_year").css("background-color", "#fff");
            }
            if(before_2003 > 0){
                $("#before_2003_standard_pension").css("background-color", "#E0E0E0");
            }else {
                $("#before_2003_standard_pension").css("background-color", "#fff");
            }

            if(after_2003 > 0){
                $("#after_2003_standard_pension").css("background-color", "#E0E0E0");
            }else {
                $("#after_2003_standard_pension").css("background-color", "#fff");
            }

            if(before_2003_year < 0){
                $('#before_2003_welfare_year').css("color", "#ff1a1a");
                $('#before_2003_welfare_month').css("color", "#ff1a1a");
            }else {
                $('#before_2003_welfare_year').css("color", "#000000");
                $('#before_2003_welfare_month').css("color", "#000000");
            }

            if(after_2003_year < 0){
                $('#after_2003_welfare_year').css("color", "#ff1a1a");
                $('#after_2003_welfare_month').css("color", "#ff1a1a");
            }else {
                $('#after_2003_welfare_year').css("color", "#000000");
                $('#after_2003_welfare_month').css("color", "#000000");
            }

            if(before_2003_year+after_2003_year <0){
                $('#welfare_year').css("color", "#ff1a1a");
                $('#welfare_month').css("color", "#ff1a1a");
            }else {
                $('#welfare_year').css("color", "#000000");
                $('#welfare_month').css("color", "#000000");
            }

            if(before_2003_year+after_2003_year+pension_year < 0){
                $("#pension_year").css("color", "#ff1a1a");
                $("#pension_month").css("color", "#ff1a1a");
            }else {
                $("#pension_year").css("color", "#000000");
                $("#pension_month").css("color", "#000000");
            }
        }

        function number_format (number, decimals, dec_point, thousands_sep) {
            // Strip all characters but numerical ones.
            number = (number + '').replace(/[^0-9+\-Ee.]/g, '');
            var n = !isFinite(+number) ? 0 : +number,
                prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
                sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
                dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
                s = '',
                toFixedFix = function (n, prec) {
                    var k = Math.pow(10, prec);
                    return '' + Math.round(n * k) / k;
                };
            // Fix for IE parseFloat(0.55).toFixed(0) = 0;
            s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
            if (s[0].length > 3) {
                s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
            }
            if ((s[1] || '').length < prec) {
                s[1] = s[1] || '';
                s[1] += new Array(prec - s[1].length + 1).join('0');
            }
            return s.join(dec);
        }

        $(function(){
            $('.number_input').keypress(function(e) {
                if(isNaN(this.value+""+String.fromCharCode(e.charCode)))
                    return false;
            })
                .on("cut copy paste",function(e){
                    e.preventDefault();
                });
        });
        $(document).ready(function () {
            getYear();
        });
    </script>

</div>
<!--▼footer strat-->
<?php
include('../layout/footer.php');
?>
<div class="btn_pagetop"><a href="#pagetop" class="anchor">PAGE<br>TOP</a></div>
</body>
</html>
