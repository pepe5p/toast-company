<?php
    $time = new DateTime(null, new DateTimeZone('Europe/Warsaw'));
    $yesterday = $time->modify("-14 hours")->format("Y-m-d").' 14:00:00';
    $now = new DateTime(null, new DateTimeZone('Europe/Warsaw'));
?>