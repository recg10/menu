<?php
header('Access-Control-Allow-Origin: *');
$id=$_GET['id'];

try {
    $conn = new PDO("mysql:host=Esther;dbname=tidracl_tis", "tidracl_tis", "gogi9999");

    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   // echo 'Connected to the database.<br>';

    $sql = "select id, nombre, monto, DATE_FORMAT(fecha, '%d-%m-%Y') fecha FROM debit WHERE DATE_FORMAT(fecha, '%m') = ".$id;
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