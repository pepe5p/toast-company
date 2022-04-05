<?php
    //http://localhost/toast_company/php/delete_cookie.php
    setcookie('person', null, -1, '/');
    header('Location: ../name.php');
    exit();
?>