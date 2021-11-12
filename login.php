<?php


//Incluye el Header
require "includes/app.php";
//Conexión a la base de datos

$db = conectarDB();
//Autenticar el usuario

$errores = [];

if($_SERVER["REQUEST_METHOD"]=== "POST"){
    // echo "<pre>";
    // var_dump($_POST);
    // echo "</pre>";

    $email = mysqli_real_escape_string($db,filter_var ($_POST["email"], FILTER_VALIDATE_EMAIL));

    $password =mysqli_real_escape_string( $db, $_POST["password"]);

    if(!$email){
        $errores[] = "El Email es obligatorio o no es valido"; 
    }
    if(!$password){
        $errores[] = "El Password es obligatorio"; 
    }
    if(empty($errores)){

        //Revisar si el usuario existe
        $query = "SELECT * FROM usuarios WHERE email = '${email}'";
        $resultado =  mysqli_query($db,$query);

        if($resultado->num_rows){
            //Revisar si el password es correcto
            $usuario = mysqli_fetch_assoc($resultado);

            //Verificar si el password es correcto o no
            $auth = password_verify($password,$usuario["password"]);

            if($auth){
                //El usuario esta autenticado
                session_start();

                //Llenar el arreglo de la sesión
                $_SESSION["usuario"] = $usuario["email"];
                $_SESSION["login"] = true;

                // echo "<pre>";
                // var_dump($_SESSION);
                // echo "</pre>";
                header("Location: /admin");

            }else{
                $errores[]= "El Password es Incorrecto";
            }

        }else{
            $errores[] = "El usuario no existe";
        }
    }



}



incluirTemplates("header");
?>


<main class="contenedor seccion contenido-centrado">
    <h1>Iniciar Sesión</h1>

    <?php foreach ($errores as $error):?>
        <div class="alerta error">
            <?php echo $error; ?>
        </div>

    <?php endforeach; ?>
    <form method="POST" class="formulario">

        <fieldset>
            <legend>Email y Password</legend>
           
            <label for="email">E-mail</label>
            <input name="email" type="email" placeholder="Tu E-mail" id="email" required>
            <label for="telefono">Password</label>
            <input name="password" type="password" placeholder="Tu Password" id="password" required>
        </fieldset>
        <input type="submit" value="Iniciar Sesión" class="boton boton-verde">
    </form>
</main>


<?php
incluirTemplates("footer");
?>