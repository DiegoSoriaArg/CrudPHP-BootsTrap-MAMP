<?php

$link = '';
$usuario = 'root';
$pass = 'root';

try{

    $pdo = new PDO($link, $usuario, $pass);

    echo 'Conectado culiau <br>';

    //foreach($pdo->query('SELECT * FROM `colores `') as $fila) {
    //    print_r($fila);
    //}

}catch (PDOException $e) {
    print "¡Error!: ".$e->getMessage()."<br/>";
    die();
}


?>