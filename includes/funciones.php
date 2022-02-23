<?php

define("TEMPLATES_URL",__DIR__ . "/templates");
define("FUNCIONES_URL",__DIR__ . "funciones.php");
define("CARPETA_IMAGENES", __DIR__ ."/../imagenes/");
define("IMAGENES_VENDEDORES", __DIR__ ."/../vendedores/");


function incluirTemplates(string $nombre, bool $inicio = false){

    include TEMPLATES_URL . "/${nombre}.php";
}

function estaAutenticado(){
    session_start();

    if(!$_SESSION["login"]){
        header("Location: /");
    }
}
function debuguear($variable){    
    echo "<pre>";
    var_dump($variable);
    echo "</pre>";
    exit;
}
//Escapa/Sanitizar el HTML
function s($html):string{
$s = htmlspecialchars($html);
return $s;
}

//Validar tipo de contenido
function validarTipoContenido($tipo){
    $tipos=["vendedor", "propiedad"];

    return in_array($tipo, $tipos);
}

//Muestra Los mensajes
function mostrarNotificacion($codigo){
    $mensaje = "";

    switch($codigo){
        case 1:
            $mensaje = "Creado Correctamente";
            break;
        case 2:
            $mensaje = "Actualizado Correctamente";
            break;
        case 3:
            $mensaje = "Eliminado Correctamente";
            break;
        default:
            $mensaje = false;
            break;
    }

    return $mensaje;
}