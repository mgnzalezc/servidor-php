<?php


/**
 * ¿Qué es una API?
 * Es un conjunto de reglas que permiten a un programa que se comunique con otro sin conocer su implementación interna
 * 
 * En la práctica hay que especificar tres cosas:
 * 
 * - Qué se puede pedir
 * - Cómo se pide
 * - Qué me devuelve
 * 
 * ¿Qué es una API REST?
 * 
 * Un tipo de API que sigue la arquitectura REST (Representational State Transfer), su característica principal es que usa el protocolo HTTP como estándar de comunicación.
 * 
 * Características claves de API REST:
 * - Stateless (sin estado): cada petición es independiente del resto de peticiones (no se guarda el estado)
 * - Formato JSON como estándar
 * - Separación del frontend y backend
 * - Uso de verbos HTTP con su corrrespondiente código de estado
 * 
 * 
 */

error_reporting(E_ALL);
ini_set("display_errors",1);


/**
 * header() => función para enviar información "invisible" al navegador.
 * con el valor "Content-Type: application/json" le decimos al cliente que lo que le va a llegar está en formato JSON. 
 * Esto es importante sobre todo si estamos trabajando con JavaScript
 */
header("Content-Type: application/json");

/**
 * include() => cargar el archivo de conexión a la BBDD PERO si falla, se mostrará un warning en vez de que se pare la ejecución del script
 */
include "conexion_pdo.php";

/**
 * _SERVER es un array que contiene información del servidor y la clave REQUEST_METHOD es la que nos dice qué método HTTP se usó
 */
$metodo = $_SERVER["REQUEST_METHOD"];

/**
 * file_get_contents('php://input') => lee el cuerpo de la petición que se ha hecho
 * 
 * cuando alguien envía datos al nucleo de la API, (por ejemplo, POST o PUT),
 * estos datos viajan en el cuerpo de la petición HTTP.
 * 
 * con 'php://input' podemos leer el contenido "crudo" o "RAW" de cuerpo de la petición
 * 
 * 
 */
$entrada = file_get_contents('php://input');

/**
 * json_decode() => convertir el JSON en un array de PHP
 * 
 * tiene dos parámetros, el primero será la entrada o el JSON a decodificar y la segunda es IMPORTANTE. Si en el segundo parámetro el valor es true, convertimos el JSON en array asociativo. Si es false, se convierte en un objeto (NO VAMOS A USAR NUNCA EL OBJETO ASÍ QUE SIEMPRE TRUE PLEASE)
 */

$entrada = json_decode($entrada, true);

/**
 * VAMOS A DECIDIR QUÉ HACER SEGÚN EL METODO HTTP QUE ME HA LLEGADO
*/

switch($metodo){
    case "GET":
        controlGet($_conexion);
        break;

    case "POST":
        controlPost($_conexion, $entrada);
        break;

    case "PUT":
        controlPut($_conexion, $entrada);
        break;
    case "DELETE":
        controlDelete($_conexion, $entrada);
        break;
    default:
        echo json_encode([
            "estado" => "error",
            "mensaje" => "No se ha identificado el método"
        ]);
        break;
}

/**
 * controlGet() => leemos datos según lo que me llegue. Vamos a buscar datos en la BBDD filtrando por ciudad, es decir, el cliente me envía el nombre de una ciudad y yo le respondo con el nombre de las desarrolladoras que están en esa ciudad. 
 * 
 * En el caso en el que el cliente no me envíe ninguna ciudad, le respondo con todas las desarrolladoras
 * 
 */
function controlGet($_conexion){
    try{
        if(isset($_GET["ciudad"]) && $_GET["ciudad"] != ""){ // si me ha llegado una ciudad a través del método GET (es decir, a través de la URL)
            $consulta = "SELECT * FROM desarrolladoras WHERE ciudad = :ciu";
            
            $res = $_conexion->prepare($consulta); // lanzo esquema
            
            $res->bindValue("ciu", $_GET["ciudad"], PDO::PARAM_STR); // bindeo parámetro dinámico con el valor que me interesa
            
            $res->execute();
        }else{ 
            // el cliente no me ha mandao ninguna ciudad y por tanto le voy a mostrar TODAS las desarrolladoras

            $consulta = "SELECT * FROM desarrolladoras";
            $res = $_conexion->prepare($consulta);
            $res->execute(); 
        }

        $res = $res->fetchAll(); // reescribo res para guardar el resultado de la consulta hecha arriba en formato array bidimensional asociativo

        /**
         * echo envía directamente al cliente la respuesta correspondiente incluyendo el cuerpo el resultado en formato JSON con el método json_encode
         * 
         * cuando hacemos el echo, también mandamos la cabecera correspondiente al cliente
         */
        echo json_encode($res);
    }catch(PDOException $e){
        echo json_encode([
            "estado" => "Error en la consulta",
            "detalles" => $e->getMessage()
        ]);
    }
}

function controlPost($_conexion, $entrada){
    if(!isset($entrada["nombre_desarrolladora"]) || $entrada["nombre_desarrolladora"] === ""){
        echo json_encode(
            ["estado" => "error", "mensaje" => "Falta la primary key (nombre_desarrolladora)"]
        );
        return;
    }
    $des = $entrada["nombre_desarrolladora"];
    $ciudad = $entrada["ciudad"] ?? "";
    $anno = $entrada["anno_fundacion"] ?? 0;

    try{
        $consulta = "INSERT INTO desarrolladoras (nombre_desarrolladora, ciudad, anno_fundacion) VALUES (:viento, :lluvia, :muerte)";
        $consulta = $_conexion->prepare($consulta);

        $consulta->bindValue("viento", $des, PDO::PARAM_STR);
        $consulta->bindValue("lluvia", $ciudad, PDO::PARAM_STR);
        $consulta->bindValue("muerte", $anno, PDO::PARAM_INT);

        $bien = $consulta->execute();
        if($bien && $consulta->rowCount() === 1){
            echo json_encode([
            "estado" => "exito",
            "mensaje" => "La desarrolladora se ha metio correctamente"
            ]);
        }else{
            echo json_encode(["estado"=>"error","mensaje"=>"No se ha podido insertar la desarrolladora"]);
        }
        
    }catch(PDOException $e){
        echo json_encode(["estado" => "error", "mensaje" => $e->getMessage()]);
    }
}

function controlPut($_conexion, $entrada){
    // IMPORTANTE: Como nombre_desarrolladora es la primary key, no podemos actualizar este campo :D Solo podemos actualizar ciudad y año de fundación

    if(!isset($entrada["nombre_desarrolladora"]) || $entrada["nombre_desarrolladora"] == ""){
        echo json_encode([
            "estado" => "error",
            "mensaje" => "no se ha encontrado una desarrolladora que actualizar"
        ]);
        return;
    }

    $consulta = $_conexion->prepare("UPDATE desarrolladoras SET ciudad = :ciu, anno_fundacion = :anno WHERE nombre_desarrolladora = :des");
    $des = $entrada["nombre_desarrolladora"];
    $ciudad = $entrada["ciudad"] ?? "";
    $anno = $entrada["anno_fundacion"] ?? 0;

    $consulta->bindValue("ciu", $ciudad, PDO::PARAM_STR);
    $consulta->bindValue("anno", $anno, PDO::PARAM_INT);
    $consulta->bindValue("des", $des, PDO::PARAM_STR);

    $bien = $consulta->execute();

    if($bien && $consulta->rowCount() === 1){
        echo json_encode([
            "estado" => "exito",
            "mensaje" => "se ha podio actualizar la desarrolladora :D"
        ]);
    }else{
        echo json_encode([
            "estado" => "error",
            "mensaje" => "NO se ha podio actualizar la desarrolladora D:"
        ]);
    }

}
function controlDelete($_conexion, $entrada){
    if(!isset($entrada["nombre_desarrolladora"]) || $entrada["nombre_desarrolladora"] == ""){
        echo json_encode([
            "estado" => "error",
            "mensaje" => "no se ha encontrado una desarrolladora que actualizar"
        ]);
        return;
    }
    $consulta = $_conexion->prepare("DELETE FROM desarrolladoras WHERE nombre_desarrolladora = :d");

    $consulta->bindValue("d", $entrada["nombre_desarrolladora"], PDO::PARAM_STR);

    $bien = $consulta->execute();

    if($bien && $consulta->rowCount() === 1){
        echo json_encode([
            "estado" => "exito",
            "mensaje" => "se ha rompido la desarrolladora"
        ]);

    }else{
        echo json_encode([
            "estado" => "error",
            "mensaje" => "no se ha rompido la desarrolladora"
        ]);
    }
}