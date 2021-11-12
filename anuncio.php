<?php

//Validar la URL sea un ID valido
$id = $_GET["id"];
$id = filter_var($id, FILTER_VALIDATE_INT);

if(!$id){
    header("location: /");
}

//Base de datos
require "includes/app.php";
$db = conectarDB();


//Obtener los datos de la propiedad
$consulta = "SELECT * FROM propiedades WHERE id = ${id}";
$resultado = mysqli_query($db, $consulta);

if(!$resultado->num_rows){
    header("location: /");
}

$propiedad = mysqli_fetch_assoc($resultado);



//Incluye Templates
incluirTemplates("header");
?>

<main class="contenedor seccion contenido-centrado">
    <h1><?php echo $propiedad["titulo"]; ?></h1>

    <picture>
        <!-- <source srcset="build/img/destacada.webp" type="image/webp">
        <source srcset="build/img/destacada.jpg" type="image/jpg"> -->
        <img src="/imagenes/<?php echo $propiedad["imagen"]; ?>" alt="imagen de propiedad" loading="lazy">
    </picture>

    <div class="resumen-propiedad">
        <p class="precio">$ <?php echo $propiedad["precio"]; ?></p>
        <ul class="iconos-caracteristicas">
            <li>
                <img class="icono" loading="lazy" src="build/img/icono_wc.svg" alt="icono wc">
                <p><?php echo $propiedad["wc"]; ?></p>
            </li>
            <li>
                <img class="icono" loading="lazy" src="build/img/icono_estacionamiento.svg" alt="icono estacionamiento">
                <p><?php echo $propiedad["estacionamiento"]; ?></p>
            </li>
            <li>
                <img class="icono" loading="lazy" src="build/img/icono_dormitorio.svg" alt="icono habitaciones">
                <p><?php echo $propiedad["habitaciones"]; ?></p>
            </li>
        </ul>
        <p><?php echo $propiedad["descripcion"]; ?></p>

        <p>Aliquam lectus magna, luctus vel gravida nec, iaculis ut augue. Praesent ac enim lorem. Quisque ac dignissim sem, non condimentum orci. Morbi a iaculis neque, ac euismod felis. Fusce augue quam, fermentum sed turpis nec, hendrerit dapibus ante. Cras mattis laoreet nibh, quis tincidunt odio fermentum vel. Nulla facilisi.</p>

    </div>
</main>


<?php
//Cerrar la conexion
mysqli_close($db);

incluirTemplates("footer");
?>