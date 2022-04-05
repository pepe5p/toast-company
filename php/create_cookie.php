<?php
    if(isset($_POST['name'])) {
        $name = strtoupper($_POST['name']);
        //name sanitize
        setcookie('person', $name, time()+(86400*30), '/');
	}
?>