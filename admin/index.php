<?php
require "../includes/app.php";

estaAutenticado();

//Importar Clases
use App\Propiedad;
use App\Vendedor;

//Implementarun metodo para obtener todas propiedades
$propiedades = Propiedad::all();
$vendedores = Vendedor::all();

//Muestra mensaje condicional
$resultado = $_GET["resultado"] ?? null;

if($_SERVER["REQUEST_METHOD"] === "POST"){

    //Validar id
    $id = $_POST["id"];
    $id = filter_var($id, FILTER_VALIDATE_INT);
    
    if($id){

        $tipo = $_POST["tipo"];
        if(validarTipoContenido($tipo)){
                        //Compara lo que vamos a eliminar
            if($tipo === "vendedor"){
                $vendedor = Vendedor::find($id);
                $vendedor->eliminar();  

            }else if($tipo === "propiedad"){
                $propiedad = Propiedad::find($id);
                $propiedad->eliminar();   
            }
        }   
    }
}

//Incluye un Template
incluirTemplates("header");
?>


<main class="contenedor seccion">
    <h1>Administrador de Bienes Raices</h1>
    <?php
        $mensaje = mostrarNotificacion(intval($resultado));
        if($mensaje):?>
        <p class="alerta exito">
            <?php echo s($mensaje); ?>
        </p>
    <?php endif; ?>
    <a href="/admin/propiedades/crear.php" class="boton boton-verde">Nueva Propiedad</a>
    <a href="/admin/vendedores/crear.php" class="boton boton-amarillo">Nuevo/a Vendedor</a>

    <h2>Propiedades</h2>
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
                        <input name="tipo" value="propiedad" type="hidden">
                        <input class="boton-rojo-block" type="submit" value="Eliminar">
                    </form>

                    <a class="boton-amarillo-block" href="/admin/propiedades/actualizar.php?id=<?php echo $propiedad->id; ?>">Actualizar</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <h2>Vendedores</h2>
    <table class="propiedades">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Teléfono</th>
                <th>Imágen</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <!-- Mostrar los resultados -->
        <tbody>
            <?php foreach($vendedores as $vendedor): ?>

            <tr>
                <td><?php echo $vendedor->id; ?></td>
                <td><?php echo $vendedor->nombre . " " . $vendedor->apellido; ?></td>
                <td> <?php echo $vendedor->telefono; ?></td>
                <td><img class="imagen-tabla" src="/vendedores/<?php echo $vendedor->imagen; ?>" alt="imagen tabla" > </td>
                <td>
                    <form method="POST" class="w-100" >
                        <input name="id" value="<?php echo $vendedor->id; ?>" type="hidden">
                        <input name="tipo" value="vendedor" type="hidden">
                        <input class="boton-rojo-block" type="submit" value="Eliminar">
                    </form>

                    <a class="boton-amarillo-block" href="/admin/vendedores/actualizar.php?id=<?php echo $vendedor->id; ?>">Actualizar</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</main>


<?php


incluirTemplates("footer");
?>