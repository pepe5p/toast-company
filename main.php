<?php
    if(!isset($_COOKIE['person'])) {
		header('Location: name.php');
		exit();
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="Shortcut icon" href="img/icon.png" />
    <title>The Toast Company</title>
    <meta name="author" content="Piotr Karaś" />

    <meta http-equiv="X-Ua-Compatible" content="IE=edge,chrome=1" />

	<link rel="stylesheet" href="fontello/css/the_toast_company.css" type="text/css" />
    <link rel="stylesheet" href="style/style.css" type="text/css" />

    <script src="scripts/addOrder.js"></script>
    <script src="scripts/loadingScreen.js"></script>
    <script src="scripts/newOrder.js"></script>
    <script src="scripts/orderPanel.js"></script>
    <script src="scripts/toastType.js"></script>
</head>
<body>
    <div class="loading_screen">
        <div class="loading_box">
            <header>The<br>Toast<br>Company</header>
            <img src="img/logo.png">
        </div>
    </div>
    <img class="logo" src="img/icon.png">
    <?php
        require_once "php/connect.php";

        if($connection->connect_errno == 0)
        {
            $total_number_sql = 'SELECT value from options WHERE name = "total_number"';
            $total_number_result = @$connection->query($total_number_sql);
            $total_number = mysqli_fetch_assoc($total_number_result)['value'];

            echo '<nav class="box">';
            echo '  <div>TOSTY <span class="actual_number">0</span>/<span class="total_number">'.$total_number.'</span></div>';
            echo '  <div>'.$_COOKIE['person'].'</div>';
            echo '</nav>';
            $connection->close();
        }
    ?>
    <main></main>
    <form id="orderPanel" class="order_panel">
        <div class="order_box box">
            <i class="icon-angle-circled-up"></i>
            <nav id="orderPanelButton" class="order_panel_button">ZAMÓW TOSTA</nav>
            <div class="type_tile inactive">
                <input class="toast_type" value="0" type="radio" name="type"/>
                <div class="toast_box">
                    <div class="ham"></div>
                    <div class="cheese"></div>
                    <img src="img/toast.png">
                </div>
                <div class="price blush">1,50 PLN</div>
                <div class="type blush">SER + SZYNKA</div>
            </div>
            <div class="type_tile inactive">
                <input class="toast_type" value="1" type="radio" name="type"/>
                <div class="toast_box">
                    <div class="cheese"></div>
                    <img src="img/toast.png">
                </div>
                <div class="price honey_yellow">1,50 PLN</div>
                <div class="type honey_yellow">SAM SER</div>
            </div>
            <div class="type_tile inactive">
                <input class="toast_type" value="2" type="radio" name="type"/>
                <div class="toast_box">
                    <div class="dbham"></div>
                    <img src="img/toast.png">
                </div>
                <div class="price blush">2,00 PLN</div>
                <div class="type blush">SER + DBL SZYNKA</div>
            </div>
            <div class="type_tile inactive">
                <input class="toast_type" value="3" type="radio" name="type"/>
                <div class="toast_box">
                    <div class="undefined"></div>
                    <img src="img/toast.png">
                </div>
                <div class="price emerald">ZA DARMO</div>
                <div class="type emerald">WŁASNA KANAPKA</div>
            </div>
            <div class="header error"></div>
            <button class="order_submit" type="button" disabled>
                ZAMÓW<i class="icon-ok"></i>
            </button>
            <div class="accepted_box inactive">ZAMÓWIENIE ZOSTAŁO PRZYJĘTE</div>
        </div>
    </form>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script>newOrderCheck();</script>
</body>
</html>