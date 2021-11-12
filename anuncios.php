<?php

require "includes/app.php";


incluirTemplates("header");
?>

<main class="contenedor seccion">
    <section class="seccion contenedor">
        <h2>Casas y Depas en Vente</h2>
        <?php
            // incluirTemplates("anuncios");
            $limite = 10;
            include "includes/templates/anuncios.php"
        ?>
    </section>
</main>



<?php
incluirTemplates("footer");
?>