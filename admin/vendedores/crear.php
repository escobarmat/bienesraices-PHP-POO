<?php

require "../../includes/app.php";

use App\Vendedor;
use Intervention\Image\ImageManagerStatic as Image;

estaAutenticado();

$vendedor = new Vendedor;

//Arreglo con mensaje de errores
$errores = Vendedor::getErrores();

//Ejecutar el codigo despues de que el usuario envia el formulario
if($_SERVER["REQUEST_METHOD"] === "POST"){

    //Crear una nueva instancia
    $vendedor = new Vendedor($_POST["vendedor"]);

    /**SUBIDA DE ARCHIVOS */
    //Generar nombre único
    $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";

    //Setear la imagen
    //Realiza un resize a la imagen con intervention image
    if($_FILES["vendedor"]["tmp_name"]["imagen"]){
        $image = Image::make($_FILES["vendedor"]["tmp_name"]["imagen"])->fit(400,300);
        $vendedor->setImagen($nombreImagen);
    }

    //Validar que no haya campos vacios
    $errores = $vendedor->validar();

    //No hay errores
    if(empty($errores)){
        //Crear la carpeta para subir Imagenes
        //Crear carpeta
        if(!is_dir(IMAGENES_VENDEDORES)){
            mkdir(IMAGENES_VENDEDORES);
        }


        //Guarda la imagen en el servidor
        $image->save(IMAGENES_VENDEDORES. $nombreImagen);

        $vendedor->guardar();
    }
}

incluirTemplates("header");

?>

<main class="contenedor seccion">
    <h1>Registrar Vendedor/a</h1>


    <a href="/admin/" class="boton boton-verde">Volver</a>

    <?php foreach($errores as $error): ?>
    <div class="alerta error">
        <?php echo $error;  ?>
    </div>

    <?php endforeach; ?>

    <form action="/admin/vendedores/crear.php" class="formulario" method="POST" enctype="multipart/form-data">
            <?php include "../../includes/templates/formulario_vendedores.php"; ?>
        <input type="submit" value="Registrar Vendedor/a" class="boton boton-verde">

    </form>
</main>


<?php
incluirTemplates("footer");
?>