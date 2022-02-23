<?php
require "../../includes/app.php";
use App\Vendedor;
use Intervention\Image\ImageManagerStatic as Image;
estaAutenticado();

//Validar que sea un id válido
$id = $_GET["id"];
$id = filter_var($id, FILTER_VALIDATE_INT);

if(!$id){
    Header("Location: /admin");
}

//Obtener el arreglo del vendedor de la base de datos
$vendedor= Vendedor::find($id);

//Arreglo con mensaje de errores
$errores = Vendedor::getErrores();

//Ejecutar el codigo despues de que el usuario envia el formulario
if($_SERVER["REQUEST_METHOD"] === "POST"){
    
    //Asignar los valores
    $args = $_POST["vendedor"];

    //Sincronizar Objeto en memoria con lo que el usuario escribio
    $vendedor->sincronizar($args);

    //Validacion
    $errores = $vendedor->validar();

    //Subida de Archivos
    //Generar nombre único
    $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";
    if($_FILES["vendedor"]["tmp_name"]["imagen"]){
        $image = Image::make($_FILES["vendedor"]["tmp_name"]["imagen"])->fit(400,300);
        $vendedor->setImagen($nombreImagen);
    }

    if(empty($errores)){
        if($_FILES["vendedor"]["tmp_name"]["imagen"]){
            //Almacenar la imagen
            $image->save(IMAGENES_VENDEDORES. $nombreImagen);
        }
        $vendedor->guardar();
    }
}

incluirTemplates("header");

?>

<main class="contenedor seccion">
    <h1>Actualizar Vendedor/a</h1>


    <a href="/admin/" class="boton boton-verde">Volver</a>

    <?php foreach($errores as $error): ?>
    <div class="alerta error">
        <?php echo $error;  ?>
    </div>

    <?php endforeach; ?>

    <form class="formulario" method="POST" enctype="multipart/form-data">
            <?php include "../../includes/templates/formulario_vendedores.php"; ?>
        <input type="submit" value="Guardar Cambios" class="boton boton-verde">

    </form>
</main>


<?php
incluirTemplates("footer");
?>