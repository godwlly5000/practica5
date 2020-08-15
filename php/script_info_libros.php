<?php 
    //variables de conexion a la BD
    $host="localhost";
    $bd="bd_web_mensaje";
    $usuario="root";
    $passwd="sonym5000";


    //CONECTAR LA BASE DE DATOS
    try{
        //establecer la conexion a la base de datos
        $con=new PDO("mysql:host=$host;dbname=$bd;charset=utf8",$usuario,$passwd);
        $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

        $registros=array();
        while ($fila=$stm->fetch(PDO::FETCH_ASSOC)){
            $registros[]=$fila;
        }
        //cerrar la conexion BD
        $stm=null;
        $con=null;
        //print_r($registros);
        //echo "el registro se ha almacenado de manera correcta";
        echo json_encode($registros);
        
    }catch(PDOException $ex){
        echo "Error: ".$ex->getMessage();
    }
?>