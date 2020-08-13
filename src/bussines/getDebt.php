<?php


header('Access-Control-Allow-Origin: *');
//header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
//header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
//header("Allow: GET, POST, OPTIONS, PUT, DELETE");
//header('Access-Control-Allow-Origin: *');
//header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
//header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
//header('content-type: application/json; charset=utf-8');


//header('Access-Control-Allow-Origin: http://www.tidra.cl');

/*if (isset($_SERVER['HTTP_ORIGIN'])) {
    header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
    header('Access-Control-Allow-Credentials: true');
    header('Access-Control-Max-Age: 86400');
}
*/

/*class Debit {
    public $nombre;
    public $edad;

    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }
    public function setEdad($edad)
    {
        $this->edad = $edad;
    }
    public function __toString()
    {
        return $this->nombre;
        return $this->edad;
    }
}



$deuda= new Debit;
$deuda->setNombre('Banco');
$deuda->setEdad(10);

$deuda1 = new Debit;
$deuda1->setNombre('Luz');
$deuda1->setEdad(34000);

$list = array($deuda, $deuda1);

$myJSON = json_encode($list);
echo $myJSON;*/


try {
    $conn = new PDO("mysql:host=Esther;dbname=tidracl_tis", "tidracl_tis", "gogi9999");

    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   // echo 'Connected to the database.<br>';

    $sql = "select id, nombre, monto, DATE_FORMAT(fecha, '%d-%m-%Y') fecha FROM debit";
    $statement=$conn->prepare($sql);
    $statement->execute();
    
    //print "Employee Name:<br>";
    /*$items = array();	
    foreach ($conn->query($sql) as $row) {
        print $row['nombre'] . "<br>";
        //array_push($items, $row);
        $items[] = $row;
    }*/
    $items = $statement->fetchAll(PDO::FETCH_ASSOC);
    //echo json_encode($items);
    /*$sth = mysqli_query($sql);
    $rows = array();
    while($r = mysqli_fetch_assoc($sth)) {
        $rows[] = $r;
    }
    */
    //$result -> free_result();
    $conn = null;
    echo json_encode($items);
  }
  catch(PDOException $err) {
    echo "ERROR: Unable to connect: " . $err->getMessage();
  }

?>