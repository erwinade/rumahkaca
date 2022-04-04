<?php
    include 'conn.php';


    $result = query("SELECT * FROM kelistrikan order by id desc limit 100");

    $labels = [];
    $values = [];
    foreach ($result as $r) {
        $labels[] = $r['created_at'];
        $values[] = $r['voltage'];
    }

    $data = [
        'gauge'=>$result[0],
        'labels' => $labels,
        'values' => $values

    ];
    
    echo json_encode($data);