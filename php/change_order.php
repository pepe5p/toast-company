<?php
    $id = $_POST['id'];
    $name = $_COOKIE['person'];

    require_once "connect.php";
    
    if($connection->connect_errno == 0)
    {
        $state = "SELECT state FROM orders WHERE order_id = $id";
        if($result = @$connection->query($state)){
            $old_state = mysqli_fetch_assoc($result)['state'];
            $result->close();
    
            if($old_state > 3) $new_state = 0;
            else $new_state = $old_state + 1;
            $add_order = "UPDATE `orders` SET `state` = $new_state WHERE order_id = $id";
            @$connection->query($add_order);
        }
    
        $connection->close();
    }
?>