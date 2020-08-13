<?php
header('Access-Control-Allow-Origin: *');
$rut=$_GET['rut'];

try {
    $conn = new PDO("mysql:host=Esther;dbname=tidracl_tis", "tidracl_tis", "gogi9999");

    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   // echo 'Connected to the database.<br>';

    $sql = "select menu.id id, item_menu.id idMenu, item_menu.descripcion descripcion, item_menu.precio  precio  from menu, item_menu
    where menu.id = item_menu.id_item
    AND menu.rut_empresa= ". $rut ."
    ORDER by id ";
    
    $statement=$conn->prepare($sql);
    $statement->execute();    
    //$items = $statement->fetchAll(PDO::FETCH_ASSOC);
    
    //echo json_encode($items);
    echo "Carta de Menu ";
    $i=0;
    while ($row = $statement->fetch(PDO::FETCH_ASSOC)){
      if ($i==0){
        echo "<table><tr><td><h1>id registro</h1><td><h1>id Menu</h1></td><td><h1>Descripción</h1></td><td><h1>Precio</h1></td></tr>";
      }
      echo "<tr><td>".$row["id"]."</td><td>".$row["idMenu"]."</td><td>".$row["descripcion"]."</td><td>".$row["precio"]."<td></tr>"; 
      $i++;
    }
    echo "</table>";
    $conn = null;
  }
  catch(PDOException $err) {
    echo "ERROR: Unable to connect: " . $err->getMessage();
  }

?>