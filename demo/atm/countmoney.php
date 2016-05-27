<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 5/27/2016
 * Time: 10:57
 */
require_once '../../class/Money.php';
$money = new Money();
?>
<html>
<head>
    <title></title>
    <meta charset="UTF-8">
    <script type="text/javascript" src="../assets/library/jquery-1.12.4.min.js"></script>
    <script type="text/javascript" src="../assets/library/bootstrap/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="../assets/library/bootstrap/css/bootstrap.min.css">
    <style>
        .list-money ul{
            list-style: none;
            padding-left: 0;
        }
        .list-money ul li{
            margin-bottom: 20px;
        }
        .list-money ul li img{
            width: 100%;
            height: auto;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="jumbotron">
            <h1>Hello, world!</h1>
            <p>...</p>
            <p><a class="btn btn-primary btn-lg" href="#" role="button">Learn more</a></p>
        </div>
        <div class="col-sm-12">
            <form action="countmoney.php" method="post">
                <div class="clearfix">
                    <div class="col-sm-9">
                        <h3>Mời bạn nhập số tiền cần rút (VND)</h3>
                        <div>
                            <input type="number" name="withdrawn" value="<?php echo isset($_POST['withdrawn']) ? $_POST['withdrawn'] : '' ?>" class="form-control" placeholder="Số tiền cần rút VND">
                        </div>
                    </div>
                   <div class="col-sm-3">
                       <h3>&nbsp;</h3>
                       <div class="text-left">
                           <button class="btn btn-warning">
                               Rút tiền
                           </button>
                       </div>
                   </div>
                </div>
            </form>

            <div class="list-money">
                <?php
                echo (int) $_POST['withdrawn'] % 1000;
                echo '<pre>';
                print_r($money->splitMoney(8738000455000));
                echo '</pre>';
                    if(isset($_POST['withdrawn'])) {
                        $withdrawn = $_POST['withdrawn'];
                        if( ! $item_cost = $money->splitMoney($withdrawn))
                            echo '<div class="alert alert-warning" role="alert">Số tiền bạn nhập phải chia hết cho 1k</div>';
                        else {
                            echo '<ul>';
                            foreach ($item_cost as $k => $v) {
                                ?>
                                <li class="col-sm-3">
                                    <h1><?php echo $v ?> tờ </h1>
                                    <img src="images/<?php echo $k ?>.jpg" alt="<?php echo $k ?>">
                                </li>
                                <?php
                            }
                            echo '</ul>';
                        }
                    }
                ?>
            </div>
        </div>
    </div>

</body>
</html>
