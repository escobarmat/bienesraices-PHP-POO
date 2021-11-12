<?php
require "../../includes/app.php";
use App\Propiedad;
use Intervention\Image\ImageManagerStatic as Image;


estaAutenticado();



$db = conectarDB();

//Consultar para obtener los vendedores
$consulta = "SELECT * FROM vendedores";
$resultado = mysqli_query($db,$consulta);

//Arreglo con mensaje de errores
$errores = Propiedad::getErrores();

//Ejecutar el codigo despues de que el usuario envia el formulario
if($_SERVER["REQUEST_METHOD"] === "POST"){
    
    /**Crear Una nueva Instancia */
    $propiedad = new Propiedad($_POST);

    /**SUBIDA DE ARCHIVOS */

    //Generar nombre único
    $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";

    //Setear la imagen
    //Realiza un resize a la imagen con intervention image
    if($_FILES["imagen"]["tmp_name"]){
        $image = Image::make($_FILES["imagen"]["tmp_name"])->fit(800,600);
        $propiedad->setImagen($nombreImagen);
    }

    //Validar
    $errores = $propiedad->validar();


    //Revisar que el arreglo de errores este vacio
    if(empty($errores)){
        //Crear la carpeta para subir Imagenes
        //Crear carpeta
        if(!is_dir(CARPETA_IMAGENES)){
            mkdir(CARPETA_IMAGENES);
        }


        //Guarda la imagen en el servidor
        $image->save(CARPETA_IMAGENES. $nombreImagen);

        //Guarda en la base de datos
        $resultado = $propiedad->guardar();
        

        //Mensaje de exito o error
        if($resultado){
            //Redirecionar al usuario

            header("location: /admin?resultado=1");
        }
    }
}


incluirTemplates("header");
?>


<main class="contenedor seccion">
    <h1>Crear</h1>


    <a href="/admin/" class="boton boton-verde">Volver</a>

    <?php foreach($errores as $error): ?>
    <div class="alerta error">
        <?php echo $error;  ?>
    </div>

    <?php endforeach; ?>

    <form action="/admin/propiedades/crear.php" class="formulario" method="POST" enctype="multipart/form-data">
            <?php include "../../includes/templates/formulario_propiedades.php"; 
            ?>
        <input type="submit" value="Crear Propiedad" class="boton boton-verde">

    </form>
</main>


<?php
incluirTemplates("footer");
?>