<?php
    /**
     * Que es una API? 
     * Conjunto d reglas que permiten que un programa se comunique con otro sin conocer su implementacion interna
     * 
     * En la practica hay que especificar tres cosas:
     * 
     *  - Que se puede pedir?
     *  - Como se pide
     *  - Que se devuelve
     * 
     * 
     * Que es API REST?
     * Un tipo de API que sigue la arquitectura REST, su caracteristica principal es que el protocolo HTTP como estandar de comunicacion
     * 
     * Caracteristicsa clase API REST:
     *  - Stateless (sin estado): cada èticion es independiente a la anterior
     *  - Formato JSON
     *  - Separacion del front y el back
     *  - Uso de verbos HTTP y su correspondiente codigo de estado
     * 
     */

    error_reporting(E_ALL);
    ini_set("display_errors",1);

    /**
     * header -> funcion para enviar info invisible al navegador
     * con el valor content type: application/json le decimos al cliente qye ko que le va a llegar esta en formato JSON
     * esto es importante sobre todo si estamos trabajando con JS
     */
    header("Content Type: application/json");

    /**
     * include() -> cargar el archivo de conexion a la db pero si falla se muestra un warning en vez de que se pare la ejecucion del script
     */
    include "conexion_pdo.php";

    /**
     * SERVER es un array asociativ con indo del servidor
     * REQUEST METHOD es lo que nos dice que metodo HTTPS se ha usado
     */
    $metodo = $_SERVER["REQUEST_METHOD"];

    /**
     * file_get_contents("php://input") -> lee el cuerpo de la peticion
     * 
     * cuando alguien envia datos al nucleo de la API estos datos viajan en el cuerpo de la peticion hTTP
     * 
     * con "php://input" podemos leer el contenido crudo raw del cuerpo de la peticion
     */
    $entrada = file_get_contents("php://input");
    
    /**
     * json_decode() -> convertir el json en un array de php
     * 
     * tiene dos parametros, el primero sera la entrada o el json a decodificar y la segunda IMPORTANTE - true o false, true para convertir el json en array asociativo y false para objeto. nosotros SIEMPRE TRUE
     */
    $entrada = json_decode($entrada,true);

    // DECIDIMOS QUE HACER SEGUN EL METODO HTTP QUE ME HA LLEGADO

    switch($metodo){
        case "GET":
            controlGet($_conexion);
            break;

        case "POST":
            //controlPost($_conexion, $entrada);
            break;

        case "PUT":
            //controlPut($_conexion, $entrada);
            break;

        case "DELETE":
            //controlDelete($_conexion, $entrada);
            break;
        default:
            break;
    }

    /**
    * control get -> leemos datos, buscamos en la db filtrando por ciudad. cliente envia nombre ciudad y yo respond con nombre de desarrolladoras
    * 
    * si cliente no mete ninguna ciudad, devuelvo todas las desarrolladoras
    */
    function controlGet($_conexion){
        try {
            if(isset($_GET["ciudad"]) && $_GET["ciudad"] != ""){
                $consulta = "SELECT * FROM desarrolladoras WHERE ciudad = :ciu";
                $res = $_conexion->prepare($consulta);
                $res->bindValue("ciu", $_GET["ciudad"], PDO::PARAM_STR);
                $res->execute();
            } else {
                // el cliente no ha mandado ni una ciudad
                $consulta = "SELECT * FROM desarrolladoras";
                $res = $_conexion->prepare($consulta);
                $res->execute();
            }

            //res ya tiene el resultado de mi consulta, sea la que sea, asiq lo saco por aqui

            //reescribo en formato array bidimensional asociativo
            $res = $res->fetchAll();

            //enviar de vuelta al cliente
            echo json_encode($res);


        } catch (PDOException $e) {
            echo json_encode([
                "error" => "error consulta",
                "detalles" => "otro mensaje"
          ]);
        }
    }




?>