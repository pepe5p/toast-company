<?php
    if(isset($_COOKIE['person'])) {
		header('Location: main.php');
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

    <script src="scripts/loadingScreen.js"></script>
    <script src="scripts/form.js"></script>
</head>
<body>
    <div class="loading_screen">
        <div class="loading_box">
            <header>The<br>Toast<br>Company</header>
            <img src="img/logo.png">
        </div>
    </div>
    <img class="logo" src="img/logo.png">
    <section class="center_box">
        <div class="header error">nazwa powinna mieć conajmniej 3 litery</div>
        <input class="input_name" placeholder="nazwa" spellcheck="false" type="text">
        <button class="order_submit" type="button" disabled>
            DALEJ<i class="icon-ok"></i>
        </button>
    </section>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
</body>
</html>