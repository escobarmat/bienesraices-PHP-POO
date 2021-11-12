<?php
require "../../includes/funciones.php";
$auth = estaAutenticado();


if(!$auth){
    header("Location: /");
}

//Validar la URL sea un ID valido
$id = $_GET["id"];
$id = filter_var($id, FILTER_VALIDATE_INT);

if(!$id){
    header("location: /admin");
}

//Base de datos
require "../../includes/config/database.php";
$db = conectarDB();


//Obtener los datos de la propiedad
$consulta = "SELECT * FROM propiedades WHERE id = ${id}";
$resultado = mysqli_query($db, $consulta);
$propiedad = mysqli_fetch_assoc($resultado);

//Consultar para obtener los vendedores
$consulta = "SELECT * FROM vendedores";
$resultado = mysqli_query($db,$consulta);

//Arreglo con mensaje de errores
$errores = [];

$titulo = $propiedad["titulo"];
$precio = $propiedad["precio"];
$descripcion = $propiedad["descripcion"];
$habitaciones = $propiedad["habitaciones"];
$wc = $propiedad["wc"];
$estacionamiento = $propiedad["estacionamiento"];
$vendedorId = $propiedad["vendedorId"];
$imagenPropiedad = $propiedad["imagen"];


//Ejecutar el codigo despues de que el usuario envia el formulario
if($_SERVER["REQUEST_METHOD"] === "POST"){

    // echo "<pre>";
    // var_dump($_POST);
    // echo "</pre>";

    // echo "<pre>";
    // var_dump($_FILES);
    // echo "</pre>";


    $titulo = mysqli_real_escape_string($db, $_POST["titulo"]);
    $precio = mysqli_real_escape_string($db, $_POST["precio"]);
    $descripcion = mysqli_real_escape_string($db, $_POST["descripcion"]);
    $habitaciones = mysqli_real_escape_string($db, $_POST["habitaciones"]);
    $wc = mysqli_real_escape_string($db, $_POST["wc"]);
    $estacionamiento = mysqli_real_escape_string($db, $_POST["estacionamiento"]);
    $vendedorId = mysqli_real_escape_string($db, $_POST["vendedor"]);
    $creado = date("Y/m/d");

    //Asignar files a una variable
    $imagen = $_FILES["imagen"];


    if(!$titulo){
        $errores[] = "Debes añadir un titulo";
    }

    if(!$precio){
        $errores[] = "El precio es obligatorio";
    }

    if(strlen($descripcion)<50){
        $errores[] = "La descripcion es obligatoria y debe tener al menos 50 caracteres";
    }

    if(!$habitaciones){
        $errores[] = "El numero de habitaciones es obligatorio";
    }

    if(!$wc){
        $errores[] = "El numero de lugares es obligatorio";
    }

    if(!$estacionamiento){
        $errores[] = "El numero de estacionamientos es obligatorio";
    }

    if(!$vendedorId){
        $errores[] = "Elige un vendedor";
    }


    //Validar por tamaño (1mb máximo)
    $medida = 1000*1000;

    if($imagen["size"] > $medida){
        $errores[] = "La imágen es muy pesada";
    }

    // echo "<pre>";
    // var_dump($errores);
    // echo "/<pre>";

    //Revisar que el arreglo de errores este vacio
    if(empty($errores)){

        // //Crear carpeta
        $carpetaImagenes = "../../imagenes/";

        if(!is_dir($carpetaImagenes)){
            mkdir($carpetaImagenes);
        }

        $nombreImagen = "";

        // //Subida de archivos

        if($imagen["name"]){
            //Eliminar Imágen previa
            unlink($carpetaImagenes . $propiedad["imagen"]);

            // //Generar nombre único
            $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";

            // //Subir la imagen
            move_uploaded_file($imagen["tmp_name"],$carpetaImagenes . $nombreImagen);
        }else{
            $nombreImagen = $propiedad["imagen"];
        }

        
        
       
        //Insertar enla base de datos
        $query = "UPDATE propiedades SET titulo = '${titulo}', precio = '${precio}', imagen = '${nombreImagen}', descripcion = '${descripcion}',habitaciones = ${habitaciones},wc = ${wc},estacionamiento = ${estacionamiento}, vendedorId = ${vendedorId} WHERE id = ${id} ";

        // echo $query;


        $resultado = mysqli_query($db,$query);

        if($resultado){
            //Redirecionar al usuario

            header("location: /admin?resultado=2");
        }

    }
 




}


incluirTemplates("header");
?>


<main class="contenedor seccion">
    <h1>Actualizar Propiedad</h1>


    <a href="/admin/" class="boton boton-verde">Volver</a>

    <?php foreach($errores as $error): ?>
    <div class="alerta error">
        <?php echo $error;  ?>
    </div>

    <?php endforeach; ?>

    <form class="formulario" method="POST" enctype="multipart/form-data">
        <fieldset>
            <legend>Informacion Feneral</legend>

            <label for="titulo">Titulo</label>
            <input value="<?php echo $titulo; ?>" name="titulo" type="text" id="titulo" placeholder="Titulo Propiedad">

            <label for="precio">Precio</label>
            <input value="<?php echo $precio; ?>" name="precio" type="number" id="precio" placeholder="Precio Propiedad">

            <label for="imagen">Imagen</label>
            <input name="imagen" type="file" id="imagen" accept="image/jpeg, image/png">
            <img src="/imagenes/<?php echo $imagenPropiedad; ?>" alt="imàgen propiedad" class="imagen-small">

            <label for="descripcion">Descripcion</label>
            <textarea name="descripcion" id="descripcion"><?php echo $descripcion; ?></textarea>

        </fieldset>
        <legend>Informacion Propiedad</legend>

        <label for="habitaciones">Habitaciones</label>
        <input value="<?php echo $habitaciones; ?>" name="habitaciones" type="number" id="habitaciones" placeholder="Ej:  3" min="1" max="9">

        <label for="wc">Baños</label>
        <input value="<?php echo $wc; ?>" name="wc" type="number" id="wc" placeholder="Ej:  3" min="1" max="9">

        <label for="estacionamiento">Estacionamiento</label>
        <input value="<?php echo $estacionamiento; ?>" name="estacionamiento" type="number" id="estacionamiento" placeholder="Ej:  3" min="1" max="9">

        <fieldset>
            <legend>Vendedor</legend>
            <select name="vendedor">
                <option value="" >--Seleccione--</option>
                <?php while($row = mysqli_fetch_assoc($resultado)):?>
                      <option <?php echo $vendedorId === $row["id"] ?"selected" : ""; ?> value="<?php echo $row["id"];?>"><?php echo $row["nombre"] . " " . $row["apellido"]; ?></option>  
                <?php endwhile; ?>
            </select>
        </fieldset>

        <input type="submit" value="Actualizar Propiedad" class="boton boton-verde">

    </form>
</main>


<?php
incluirTemplates("footer");
?>