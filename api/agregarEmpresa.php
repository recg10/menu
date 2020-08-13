<?php
header('Access-Control-Allow-Origin: *');
$rut=$_POST['rut'];
$digito=$_POST['digito'];
$email=$_POST['email'];
$nombre=$_POST['nombre'];
try {
    $conn = new PDO("mysql:host=Esther;dbname=tidracl_tis", "tidracl_tis", "gogi9999");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "INSERT INTO  empresa ( rut , digito, email, nombre, logo, codigo_qr ) VALUES (".$rut.", '".$digito."', '".$email."', '".$nombre."', null, null) ";    
    $statement=$conn->prepare($sql);
    $statement->execute();
    $conn = null;
    //echo json_encode($items);
  }
  catch(PDOException $err) {
    echo "ERROR: Unable to connect: " . $err->getMessage();
  }

?>