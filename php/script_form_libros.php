<?php 
    header("Content-type: application/json; charset=utf-8");
    $info=json_decode(file_get_contents("php://input"),true);

    //obtner los valores del objeto JSON

    $sku=$info['_sku'];
    $nombre=$info['_nombre'];
    $autor=$info['_autor'];
    $imagen=$info['_imagen'];

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

        //preparar la sentencia sql
        $stm=$con->prepare("INSERT INTO bd_libros(c_sku,c_nombre,c_autor,c_imagen) VALUES (:sku,:nombre,:autor,:imagen) ");

        $arreglo_valores=array(":sku"=>$sku, ":nombre"=>$nombre, ":autor"=>$autor, ":imagen"=>$imagen);

        //ejecutar la sentencia sql insert
        $stm->execute($arreglo_valores);

        //OBTENER LOS REGISTROS DE LA TBAL LIBROS
        //PREPARAR LA SENTENCIA sql SELECT
        $stm=$con->prepare("SELECT * FROM bd_libros");

        //ejecutar a sentencia SQL
        $stm->execute();

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