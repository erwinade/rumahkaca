<?php
$page = $_SERVER['PHP_SELF'];
$sec = "5";
?>
<html>
    <head>
    <meta http-equiv="refresh" content="<?php echo $sec?>;URL='<?php echo $page?>'">
    </head>
    <body>
    </body>
</html>

<?php

    include 'conn.php';

    $sql = "insert into kelistrikan (voltage,energy,watt,current,frequency,created_at) values (".rand(10,100).",".rand(10,100).",".rand(10,100).",".rand(10,100).",".rand(10,100).",'".date('Y-m-d H:i:s')."')";

    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
      } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
      }
    
    // echo json_encode($data);