<?php
    $last_id = $_POST['last_id'];
    $array = [
        "lastId" => $last_id,
        "myNewToasts" => 0,
        "deletedToasts" => 0,
        "error" => ""
    ];
    $max_id = -1;
    $queues_array = [];
    $orders_array = [];
    $order_ids_array = [];
    $states_array = [];
    $toasts_types_array = [];

    require_once "connect.php";

    if($connection->connect_errno != 0) $array["error"] = "<header class='error header'>ERROR $connection->connect_errno</header>";        
    else
    {
        require_once "time.php";

        $my_toasts = 0;
        $deleted_toasts = 0;
        $sql = 'SELECT order_id, queue, toast_type, person, state, datetime FROM orders WHERE datetime > "'.$yesterday.'" ORDER BY queue, datetime';

        if($result = @$connection->query($sql))
        {
            $orders_nr = mysqli_num_rows($result);
            if($orders_nr == 0) $array["error"] = "<header class='error header'>AKTUALNIE NIE MA ŻADNYCH ZAMÓWIEŃ</header>";
            else{
                for($i = 0; $i < $orders_nr; $i++)
                {
                    $row = mysqli_fetch_assoc($result);
                    $order_id = $row['order_id'];
                    if($max_id < $order_id) $max_id = $order_id;
                    $state = $row['state'];
                    $toast_type = $row['toast_type'];

                    //NEW ORDERS
                    if($order_id > $last_id){
                        if($state == 4 || $toast_type == 3) $deleted_toasts++;
                        $queue = $row['queue'];
                        $person = $row['person'];
                        if($state != 4 && $person == $_COOKIE['person']) $my_toasts++;

                        //STATES
                        if($state == 0) $activity = "s0";
                        else if($state == 1) $activity = "s1";
                        else if($state == 2) $activity = "s2";
                        else if($state == 3) $activity = "s3";
                        else $activity = "s4";
                        
                        ///MENU
                        if($toast_type == 0){
                            $icon = '<div class="ham"></div><div class="cheese"></div>';
                            $color = "blush";
                            $name = "SER + SZYNKA";
                        }else if($toast_type == 1){
                            $icon = '<div class="cheese"></div>';
                            $color = "honey_yellow";
                            $name = "SAM SER";
                        }else if($toast_type == 2){
                            $icon = '<div class="dbham"></div>';
                            $color = "blush";
                            $name = "SER + DBL SZYNKA";
                        }else{
                            $icon = '<div class="undefined"></div>';
                            $color = "emerald";
                            $name = "WŁASNA KANAPKA";
                        }

                        array_push($queues_array, $queue);
                        $tile = "<div id='t$order_id' class='order_tile $activity'><div class='toast_box'>$icon<img src='img/toast.png'><i class='icon-i'></i></div><div class='type $color'>$name</div><div class='person'>$person</div></div>";
                        array_push($orders_array, $tile);
                    }
                    //CHANGING STATES
                    else{
                        array_push($order_ids_array, $order_id);
                        array_push($states_array, $state);
                        array_push($toasts_types_array, $toast_type);
                    }
                }
            }
            $result->close();
        }
        $connection->close();
    }
    if($max_id != -1){
        $array['lastId'] = $max_id;
        $array["myNewToasts"] = $my_toasts;
        $array["deletedToasts"] = $deleted_toasts;
        $array["queuesArray"] = $queues_array;
        $array["ordersArray"] = $orders_array;
        $array["orderIdsArray"] = $order_ids_array;
        $array["statesArray"] = $states_array;
        $array["toastsTypesArray"] = $toasts_types_array;
    }
    $array = json_encode($array);
    echo $array;
?>