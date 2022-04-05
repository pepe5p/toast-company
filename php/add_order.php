<?php
    $type = $_POST['type'];
    $name = $_COOKIE['person'];

    require_once "connect.php";
    
    if($connection->connect_errno == 0)
    {
        require_once "time.php";
        //checking total limit
        $total_orders_sql = 'SELECT COUNT(*) FROM orders WHERE state != 4 AND datetime > "'.$yesterday.'"';
        $total_number_sql = 'SELECT value from options WHERE name = "total_number"';
        $total_orders_result = @$connection->query($total_orders_sql);
        $total_number_result = @$connection->query($total_number_sql);
        $actual_number = mysqli_fetch_assoc($total_orders_result)['COUNT(*)'];
        $total_number = mysqli_fetch_assoc($total_number_result)['value'];

        if($actual_number < $total_number){
            //checking queue and limit=4
            $last_queue = 'SELECT COUNT(*) FROM orders WHERE state != 4 AND person = "'.$name.'" AND datetime > "'.$yesterday.'"';
            if($result = @$connection->query($last_queue)){
                $queue_number = mysqli_fetch_assoc($result)['COUNT(*)'] + 1;
                $result->close();
            } else $queue_number = 1;
        
            echo $last_queue;
            if($queue_number <= 4) $add_order = 'INSERT INTO `orders` (`order_id`, `queue`, `datetime`, `toast_type`, `person`, `state`) VALUES (NULL, '.$queue_number.', "'.$now->format("Y-m-d H:i:s").'", '.$type.', "'.$name.'", 0)';
            else $add_order = "";
            @$connection->query($add_order);
        }
    
        $connection->close();
    }
?>