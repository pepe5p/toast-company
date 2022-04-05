<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="Shortcut icon" href="img/icon.png" />
    <title>TC | Admin Panel</title>
    <meta name="author" content="Piotr Karaś" />

    <meta http-equiv="X-Ua-Compatible" content="IE=edge,chrome=1" />

	<link rel="stylesheet" href="fontello/css/the_toast_company.css" type="text/css" />
    <link rel="stylesheet" href="style/style.css" type="text/css" />

    <script src="scripts/changeState.js"></script>
    <script src="scripts/loadingScreen.js"></script>
    <script src="scripts/newOrder.js"></script>
    <script src="scripts/orderPanel.js"></script>
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
            echo '  <div>--- ADMIN ---</div>';
            echo '</nav>';
            $connection->close();
        }
    ?>
    <main></main>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script>newOrderCheck();</script>
</body>
</html>