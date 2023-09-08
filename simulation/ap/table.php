<?php
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
require_once "../PHPExcel/Classes/PHPExcel.php";
?>
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Detail</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Baloo+Chettan+2&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <!-- Styles -->
    <style>
        html, body {
            background-color: #f8f9fa;
            color: #636b6f;
            font-family: 'Baloo Chettan 2', cursive;
            font-weight: 200;
            font-size: 18px;
            height: 100vh;
            margin: 0;
        }
        th{
            text-align: center;
            width: 16.67%;
        }
    </style>
</head>
<?php //dump($request);
$time= "";
$loan= "";
$interest= "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $time= $_POST["time"];
    $loan= $_POST["loan"];
    $interest= $_POST["interest"];
}
?>
<body>
<div class="container-fluid bg-light py-3">
    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="card card-body card-block">
                <div class="row form-group">
                    <div class="row col-md-6">
                        <div class="col-4">
                            <label for="number" class=" form-control-label">借入金</label>
                        </div>
                        <div class="col-8">
                            <input readonly type="text" value="<?php  echo number_format($loan); ?> 円" class="form-control">
                        </div>
                    </div>
                    <div class="row col-md-6">
                        <div class="col-4">
                            <label for="number" class=" form-control-label">支払年額</label>
                        </div>
                        <div class="col-8">
                            <input readonly type="text" id="money_year" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="row col-md-6">
                        <div class="col-4">
                            <label for="number" class=" form-control-label">金利（年利）</label>
                        </div>
                        <div class="col-8">
                            <input readonly type="text" value="<?php  echo number_format($interest) ?>%" class="form-control">
                        </div>
                    </div>
                    <div class="row col-md-6">
                        <div class="col-4">
                            <label for="number" class=" form-control-label">月利</label>
                        </div>
                        <div class="col-8">
                            <input readonly type="text" value="<?php  echo round($interest/12,2) ?>%" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="row col-md-6">
                        <div class="col-4">
                            <label for="number" class=" form-control-label">返済年数</label>
                        </div>
                        <div class="col-8">
                            <input readonly type="text" value="<?php  echo $time; ?>" class="form-control">
                        </div>
                    </div>
                    <div class="row col-md-6">
                        <div class="col-4">
                            <label for="number" class=" form-control-label">返済回数</label>
                        </div>
                        <div class="col-8">
                            <input readonly type="text" value="<?php  echo  $time*12 ?>" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="row col-md-6">
                        <div class="col-4">
                            <label for="number" class=" form-control-label">支払金利合計</label>
                        </div>
                        <div class="col-8">
                            <input readonly type="text" id="total_ipmt" class="form-control">
                        </div>
                    </div>
                    <div class="row col-md-6">
                        <div class="col-4">
                            <label for="number" class=" form-control-label">返済総額合計</label>
                        </div>
                        <div class="col-8">
                            <input readonly type="text" id="total_money" class="form-control">
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

</div>
<div class="container-fluid bg-light py-3">
    <div class="row">
        <div class="col-8 offset-2 mx-auto">
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>回数</th>
                        <th>元金</th>
                        <th>金利</th>
                        <th>返済額</th>
                        <th>残元金</th>
                        <th>団信保険料</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <?php $total_ppmt=0; $total_ipmt=0;
                     for($i=1;$i<=($time*12);$i++){

                    $ipmt = PHPExcel_Calculation_Financial::IPMT($interest/100/12,$i,$time*12,$loan);
                    $ppmt= PHPExcel_Calculation_Financial::PPMT($interest/100/12,$i,$time*12,$loan);
                    $money_year=-round(($ipmt+$ppmt)*12);
                    $total_ppmt+=$ppmt;
                    $total_ipmt+=$ipmt;
                    ?>
                    <tr>
                        <th> <?php echo number_format($i) ?></th>
                        <th><?php echo number_format(-$ppmt) ?></th>
                        <th><?php echo number_format(-$ipmt)?></th>
                        <th><?php echo number_format(-$ppmt-$ipmt)?></th>
                        <th><?php echo number_format($loan+$total_ppmt)?></th>
                        <th>0</th>
                    </tr>
                    <?php } ?>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>


</body>

</html>
<script>
    document.getElementById("money_year").value = '<?php echo number_format($money_year) ?>';
    document.getElementById("total_ipmt").value = '<?php echo number_format(-$total_ipmt) ?>';
    document.getElementById("total_money").value = '<?php echo number_format(-round($total_ipmt)+$loan) ?>';
</script>