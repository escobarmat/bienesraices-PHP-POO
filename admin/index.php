<?php
require "../includes/app.php";

estaAutenticado();

use App\Propiedad;

//Implementarun metodo para obtener todas propiedades
$propiedades = Propiedad::all();

//Muestra mensaje condicional
$resultado = $_GET["resultado"] ?? null;

if($_SERVER["REQUEST_METHOD"] === "POST"){
    $id = $_POST["id"];
    $id = filter_var($id, FILTER_VALIDATE_INT);
    if($id){
        //Eliminar el archivo
        $query = "SELECT imagen FROM propiedades WHERE id = ${id}";
        $resultado = mysqli_query($db, $query);
        $propiedad = mysqli_fetch_assoc($resultado);
        unlink("../imagenes/" . $propiedad["imagen"] );

        //Eliminar la propiedad
        $query = "DELETE FROM propiedades WHERE id = ${id}";
        $resultado = mysqli_query($db, $query);

        if($resultado){
            header("location: /admin?resultado=3");
        }
    }
}

//Incluye un Template
incluirTemplates("header");
?>


<main class="contenedor seccion">
    <h1>Administrador de Bienes Raices</h1>
    <?php if(intval($resultado)===1):?>
        <p class="alerta exito">Anuncio Creado Correctamente</p>
    <?php elseif(intval($resultado)===2):?>
        <p class="alerta exito">Anuncio Actualizado Correctamente</p>
    <?php elseif(intval($resultado)===3):?>
        <p class="alerta exito">Anuncio Eliminado Correctamente</p>
    <?php endif; ?>
    <a href="/admin/propiedades/crear.php" class="boton boton-verde">Nueva Propiedad</a>

    <table class="propiedades">
        <thead>
            <tr>
                <th>ID</th>
                <th>Titulo</th>
                <th>Imágen</th>
                <th>Precio</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <!-- Mostrar los resultados -->
        <tbody>
            <?php foreach($propiedades as $propiedad): ?>

            <tr>
                <td><?php echo $propiedad->id; ?></td>
                <td><?php echo $propiedad->titulo; ?></td>
                <td><img class="imagen-tabla" src="/imagenes/<?php echo $propiedad->imagen; ?>" alt="imagen tabla" > </td>
                <td>$ <?php echo $propiedad->precio; ?></td>
                <td>
                    <form method="POST" class="w-100" >
                        <input name="id" value="<?php echo $propiedad->id; ?>" type="hidden">
                        <input class="boton-rojo-block" type="submit" value="Eliminar">
                    </form>

                    <a class="boton-amarillo-block" href="/admin/propiedades/actualizar.php?id=<?php echo $propiedad->id; ?>">Actualizar</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</main>


<?php

//Cerrar la conexion
mysqli_close($db);

incluirTemplates("footer");
?>