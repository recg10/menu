<?php
header('Access-Control-Allow-Origin: *');
$descripcion=$_POST['descripcion'];
try {
    $conn = new PDO("mysql:host=Esther;dbname=tidracl_tis", "tidracl_tis", "gogi9999");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "INSERT INTO  menu ( descripcion, rut_empresa ) VALUES ('".$descripcion."', 1) ";
    
    $statement=$conn->prepare($sql);
    $statement->execute();
    $conn = null;
    //echo json_encode($items);
  }
  catch(PDOException $err) {
    echo "ERROR: Unable to connect: " . $err->getMessage();
  }

?>