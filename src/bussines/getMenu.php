<?php
header('Access-Control-Allow-Origin: *');
try {
    $conn = new PDO("mysql:host=Esther;dbname=tidracl_tis", "tidracl_tis", "gogi9999");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "select id, descripcion, rut_empresa FROM menu";
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