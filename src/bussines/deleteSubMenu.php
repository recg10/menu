<?php
header('Access-Control-Allow-Origin: *');
$id=$_GET['id'];
try {
    $conn = new PDO("mysql:host=Esther;dbname=tidracl_tis", "tidracl_tis", "gogi9999");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = 'delete FROM item_menu where id='.$id; 
    $conn->exec($sql);
    $conn = null;
    echo json_encode($items);
  }
  catch(PDOException $err) {
    echo "ERROR: Unable to connect: " . $err->getMessage();
  }

?>