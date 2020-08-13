<?php


try {
    $conn = new PDO("mysql:host=Esther;dbname=tidracl_tis", "tidracl_tis", "gogi9999");

    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   // echo 'Connected to the database.<br>';

    $sql = 'select id, nombre, monto FROM debit';
    
    //print "Employee Name:<br>";
    $items = array();	
    foreach ($conn->query($sql) as $row) {
        //print $row['nombre'] . "<br>";
        array_push($items, $row);
    }
    $conn = null;
    echo json_encode($items);	

  }
  catch(PDOException $err) {
    echo "ERROR: Unable to connect: " . $err->getMessage();
  }
 

/*
//$conn = mysqli_connect($servername, $username, $password, $database);
$conn = new mysqli_connect('Esther','tidracl_tis','gogi9999', 'tidracl_tis');
// Check connection

if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);
}

echo "Connected successfully";

mysqli_close($conn);

/*

echo "re";
$result = array();
//$conn = mysql_connect('www.tidra.cl','tidracl_tis','gogi9999');
$conn = new mysql_connect('www.tidra.cl','tidracl_tis','gogi9999');
echo "Connected successfully"; 

  mysql_select_db('tidracl_tis', $conn);
  echo "BD"+$conn;
  if (!$conn) { die('Could not connect: ' . mysql_error());}
  echo "4";
  mysql_select_db(varDb::$db_bd, $conn);	
  $rs = mysql_query("select id, nombre, monto FROM debit");	
  $items = array();	
  $row = mysql_num_rows($rs);
  while($row = mysql_fetch_object($rs)){
      array_push($items, $row);
  }	
  mysql_close($conn);
  echo json_encode($items);	
  */
?>