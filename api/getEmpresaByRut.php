<?php
header('Access-Control-Allow-Origin: *');
$rut=$_GET['rut'];
try {
    $conn = new PDO("mysql:host=Esther;dbname=tidracl_tis", "tidracl_tis", "gogi9999");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "SELECT rut, digito, email, nombre, logo, codigo_qr FROM empresa WHERE rut=".$rut;
    $statement=$conn->prepare($sql);
    $statement->execute();    
    $items = $statement->fetchAll(PDO::FETCH_ASSOC);
    $conn = null;
    echo json_encode($items);
  }
  catch(PDOException $err) {
    echo "ERROR: Unable to connect: " . $err->getMessage();
  }
?>