<?php
    include ('../config/config.php');
    include ('../lib/database.php');
    require ('../carbon/autoload.php');
    use Carbon\Carbon;
    use Carbon\CarbonInterval;

    $db = new Database();

    if(isset($_POST['time'])){
        $time = $_POST['time'];
    }else{
        $time = '';
        $subdays = Carbon::now('Asia/Ho_Chi_Minh')->subdays(7)->toDateString();
    }

    if($time == '7days'){
        $subdays = Carbon::now('Asia/Ho_Chi_Minh')->subdays(7)->toDateString();
    } elseif ($time == '28days'){
        $subdays = Carbon::now('Asia/Ho_Chi_Minh')->subdays(28)->toDateString();
    } elseif ($time == '90days'){
        $subdays = Carbon::now('Asia/Ho_Chi_Minh')->subdays(90)->toDateString();
    } elseif ($time == '365days'){
        $subdays = Carbon::now('Asia/Ho_Chi_Minh')->subdays(365)->toDateString();
    }

    $now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();

    $sql = "SELECT DATE(o.createdAt) as 'date', COUNT(*) AS 'order', SUM(od.quantity*od.unitPrice) AS 'salary', SUM(quantity) AS 'quantity'
            FROM tbl_order o, tbl_orderDetail od
            WHERE o.id = od.orderId AND od.status = 2
            GROUP BY DATE(o.createdAt)
            ORDER by o.createdAt ASC";
    $sql_query = $db->select($sql);

    while($result = mysqli_fetch_array($sql_query)){
        $chart_data[] = array(
            'date' => $result['date'],
            'order' => $result['order'],
            'salary' => $result['salary'],
            'quantity' => $result['quantity']
        );
    }
    //print_r($chart_data);
    echo $data = json_encode($chart_data);
?>