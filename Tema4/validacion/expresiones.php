<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Validacion y Sanitizacion</title>
    <?php
        error_reporting(E_ALL); //recoge errores, E_ALL son todos
        ini_set("display_errors", 1); //modificar valor error variable PHP
    ?>

</head>
<body>
    <?php
        /**
         * /patron/ es el patron de la expresion regular
         * 
         * PATRONES COMUNES:
         * 
         * \d : un digito (0-9)
         * \w : caracter alfanumerico --> letras numeros y guion bajo
         * \s : un espacio en blanco
         * 
         * . : cualquier caracter exceptuando salto de linea
         * 
         * + : uno o mas de la expresion anterior. por ej \d+ uno o mas digitos
         * * : cero o mas
         * ^ : comienza con
         * $ : termina con
         * 
         * [] : define conjunto de caracteres que puede coincidir con cualquiera de los caracteres que estan dentro del     conjunto. como un array y solo funciona lo q esta en este array
         * 
         * {numero} : se repite el patron anterior ese numero d veces. eg {8} 8 veces, {8,10}, 8-10 veces, {,8} 8 o menos, 
         * [A-Z] de la A a la Z
         * 
         * (?=.*) : expresion de busqueda anticipada positiva. verifica que condicion dentro de parentesis este presente en algun lugar de la cadena
         * 
         * 
         */

        $cadena = "hola123";
        if(preg_match("/\d/", $cadena)) echo "La cadena tiene numeros"; 
        else echo "La cadena no tiene numeritos";

        if(preg_match("/^\d/", $cadena)) echo "La cadena empieza por numeros"; 
        else echo "La cadena no empieza por numeritos";

        if(preg_match("/\w/", $cadena)) echo "La cadena tiene caracteres alfanumericos"; 
        else echo "La cadena no tiene char alfanumericos"; //sale false si es un ? por ejemplo

        if(preg_match("/\s/", $cadena)) echo "La cadena tiene espacios"; 
        else echo "La cadena no tiene espacios";

        if(preg_match("/^\d{4}/", $cadena)) echo "La cadena empieza por 4 digitos"; 
        else echo "La cadena no empieza por 4 digitos";

        if(preg_match("/^\d+$/", $cadena)) echo "La cadena empieza y termina por digitos"; 
        else echo "La cadena no empieza y termina por digitos";
        if(preg_match("/^\d$/", $cadena)) echo "Solo UN digito"; 
        else echo "No es solo UN digito";


    $contrasena = "Hola123";
    //tener al menos una mayus --> (?=.*[A-Z])
    //al menos una minus --> (?=.*[a-z])

    if(preg_match("/(?=.*[A-Z])(?=.*[a-z])[a-zA-Z0-9]{8}/", $contrasena))


    ?>
    
</body>
</html>