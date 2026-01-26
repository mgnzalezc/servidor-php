<?php
    /**
     * PDO (PHP Data Objects) - la usaremos para acceder a db de manera uniforme y segura
     * 
     * Es un traductor universal que permite a PHP hablar con diferentes tipos de db usando el mismo lenguaje para todos
     * 
     * Problemas de MySQLi:
     * - solo funciona con MYSAL/MariaDB 
     * - mas vulnerable a inyecciones SQL (si no se usa bien)
     * - codigo es menos portable
     * 
     * Ventajas de PDO:
     * - compatible con muchos tipos de db
     * - consultas preparadas por defecto, por tanto es mas seguro
     * - se pueden manejar errores con excepciones de forma mas robusta
     * - sintaxis es consistente entre diferentes tipos de db
     * 
     */

    $_servidor = "localhost";
    $_bd = "videojuegos_bd";
    $_usuario = "root";
    $_contrasena = "";

    try{
        $_conexion = new PDO(
            // DSN -> data source name
            // usuario
            // contraseña 

            "mysql:host=$_servidor;dbname=$_bd;charset=utf8mb4",
            $_usuario,
            $_contrasena
        );

        /**
         *  :: es el operador de resolucion de ambito
         *  se usa para acceder a miembros estaticos de una clase (métodos estáticos, propiedades estáticas, constantes...)
         * 
         * PDO es una clase y cosas como PDO::ATTR_ERRMODE son constantes que PDO expone para configurar o interpretar comportamientos del objeto
        */

        // Para lanzar excepciones
        $_conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Para que de manera prefeterminada extraigamos la info de las querys en formato array asociativo
        // Cambiamos la manera estandard de hacer fetch por la forma que sabemos que es fetch asscos, cada vez que se use fetch se aplica fetch assoc
        $_conexion->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

        //echo "conectado";

    } catch(PDOException $e) {
        die("ERROR: No se puede conectar a la DB <br> Detalles: {$e->getMessage()}"); //de cara a empresa no se imprime el mensaje
    }

?>