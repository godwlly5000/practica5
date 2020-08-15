<?php
     header("Content-type: application/json; charset=utf-8");

     //decodificar la informacion obtenida del cliente

     $informacion=json_decode(file_get_contents("php://input"),true);
        $nom=$informacion["_nombre"];
        $coment=$informacion["_comentario"];
        //enviando la respuesta al cliente(JSON)

        //variables de conexion ah base de datos
        $host="localhost";
        $bd="bd_web_mensaje";
        $usuario="root";
        $passwd="sonym5000";

        try{
            //estalecer conexion al SGBD
            $con=new PDO("mysql:host=$host;dbname=$bd;charset=utf8",$usuario,$passwd);
            $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

            //PREPARAR UNA SENTENCIA SQL
            $stm=$con->prepare("INSERT INTO tbl_comentarios(C_nombre,C_comentario) VALUES (:nombre,:comentario)");

            //ejecutar la sentencia SQL y proceesar los resultados
            $stm->execute(array(":nombre"=>$nom,":comentario"=>$coment));

            //****OBTENER LOS REGISTROS DE LA BASE DE DATOS */
            // preparar la sentencia sql

            $stm=$con->prepare("SELECT * FROM tbl_comentarios");
            //ejecutar a setencia sql
            $stm->execute();
            //declarar un arrlego que contndra los registros de la BD
            $registros=array();
            //Obtenr la información
            while($fila=$stm->fetch(PDO::FETCH_ASSOC)){
                $registros[]=$fila;
            }

            //cerrar la conexión
            $stp=null;
            $con=null;
            
            echo json_encode($registros);
        }catch(PDOException $ex){
            echo "Error: ".$ex->getMessage();

        }

        echo json_encode($informacion);

    ?>