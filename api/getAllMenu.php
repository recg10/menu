<?php
header('Access-Control-Allow-Origin: *');
$rut=$_GET['rut'];

try {
    $conn = new PDO("mysql:host=Esther;dbname=tidracl_tis", "tidracl_tis", "gogi9999");

    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   // echo 'Connected to the database.<br>';

    $sql = "select menu.id id, menu.descripcion desc_menu, item_menu.id idMenu, item_menu.descripcion descripcion, item_menu.precio  precio  from menu, item_menu
    where menu.id = item_menu.id_item
    AND menu.rut_empresa= ". $rut ."
    ORDER by id ";
    
    $statement=$conn->prepare($sql);
    $statement->execute();    
    //$items = $statement->fetchAll(PDO::FETCH_ASSOC);
    
    //echo json_encode($items);
    echo "<html><head>Carta de Menu</head><body><style>
    body {
      background-image: url('menu.jpg');
      background-repeat: no-repeat;
      background-attachment: fixed;
      background-size: 100% 100%;
    }
    </style>";
    $i=0;
    while ($row = $statement->fetch(PDO::FETCH_ASSOC)){
      if ($i==0){
        echo "<table><tr><td>id registro<td>id Menu</td><td>Descripción</td><td>Precio</td></tr>";
      }
      echo "<tr><td>".$row["id"]."</td><td>".$row["desc_menu"]."</td><td>".$row["idMenu"]."</td><td>".$row["descripcion"]."</td><td>".$row["precio"]."<td></tr>"; 
      $i++;
    }
    echo "</table></body></html>";
    $conn = null;
  }
  catch(PDOException $err) {
    echo "ERROR: Unable to connect: " . $err->getMessage();
  }

?>