<?php
$nombre=$_POST['nombre'];
$cantidad=$_POST['cantidad'];
try {
    $conn = new PDO("mysql:host=Esther;dbname=tidracl_tis", "tidracl_tis", "gogi9999");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "INSERT INTO  debit ( nombre, monto ) VALUES ('".$nombre."', ".$cantidad.") ";
    
    $statement=$conn->prepare($sql);
    $statement->execute();
    $conn = null;
    //echo json_encode($items);
  }
  catch(PDOException $err) {
    echo "ERROR: Unable to connect: " . $err->getMessage();
  }

?>