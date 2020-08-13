<?php
header('Access-Control-Allow-Origin: *');
$descripcion=$_POST['descripcion'];
$precio=$_POST['precio'];
try {
    $conn = new PDO("mysql:host=Esther;dbname=tidracl_tis", "tidracl_tis", "gogi9999");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "INSERT INTO  item_menu ( descripcion, precio, id_tem ) VALUES ('".$descripcion."', ".$precio.", 1) ";
    
    $statement=$conn->prepare($sql);
    $statement->execute();
    $conn = null;
    //echo json_encode($items);
  }
  catch(PDOException $err) {
    echo "ERROR: Unable to connect: " . $err->getMessage();
  }

?>