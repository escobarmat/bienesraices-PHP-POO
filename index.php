<?php

require "includes/app.php";



incluirTemplates("header", $inicio = true);
?>


<main class="contenedor seccion">
    <h1>Más sobre Nosotros</h1>

    <div class="iconos-nosotros">
        <div class="icono">
            <img src="build/img/icono1.svg" alt="icono seguridad">
            <h3>Seguridad</h3>
            <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Illum, ipsa enim, consectetur ut iusto ipsum rerum corporis vel autem qui necessitatibus accusantium minima tenetur cupiditate porro inventore, natus atque incidunt.</p>
        </div>
        <div class="icono">
            <img src="build/img/icono2.svg" alt="icono Precio">
            <h3>Precio</h3>
            <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Illum, ipsa enim, consectetur ut iusto ipsum rerum corporis vel autem qui necessitatibus accusantium minima tenetur cupiditate porro inventore, natus atque incidunt.</p>
        </div>
        <div class="icono">
            <img src="build/img/icono3.svg" alt="icono Tiempo">
            <h3>Tiempo</h3>
            <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Illum, ipsa enim, consectetur ut iusto ipsum rerum corporis vel autem qui necessitatibus accusantium minima tenetur cupiditate porro inventore, natus atque incidunt.</p>
        </div>
    </div>

</main>

<section class="seccion contenedor">
    <h2>Casas y Depas en Vente</h2>
    <?php
    // incluirTemplates("anuncios");
    include "includes/templates/anuncios.php"
    ?>
    <div class="alinear-derecha ver-todas">
        <a href="anuncios.php" class="boton-verde">Ver Todas</a>
    </div>
</section>

<section class="imagen-contacto">
    <h2>Encuentra la Casa de tus Sueños</h2>
    <p>LLena el formulario de contacto y un asesor se pondrá en contacto contigo a la brevedad</p>
    <a href="contacto.php" class="boton-amarillo">Contactáctanos</a>
</section>

<div class="contenedor seccion seccion-inferior">
    <section class="blog">
        <h3>Nuestro Blog</h3>

        <article class="entrada-blog">
            <div class="imagen">
                <picture>
                    <source srcset="build/img/blog1.webp" type="image/webp">
                    <source srcset="build/img/blog1.jpg" type="image/jpg">
                    <img src="build/img/blog1.jpg" alt="Texto Entrada Blog" loading="lazy">
                </picture>
            </div>
            <div class="texto-entrada">
                <a href="entrada.php">
                    <h4>Terraza en el techo de tu casa</h4>
                    <p class="informacion-meta">Escrito el <span>20/10/2021 </span>por: <span>Admin</span></p>
                    <p>
                        Consejos para construir una terraza en el techo de tu casa con los mejores materiales y ahorrando dinero
                    </p>
                </a>
            </div>
        </article>

        <article class="entrada-blog">
            <div class="imagen">
                <picture>
                    <source srcset="build/img/blog2.webp" type="image/webp">
                    <source srcset="build/img/blog2.jpg" type="image/jpg">
                    <img src="build/img/blog2.jpg" alt="Texto Entrada Blog" loading="lazy">
                </picture>
            </div>
            <div class="texto-entrada">
                <a href="entrada.php">
                    <h4>Guía para la decoracion de tu hogar</h4>
                    <p class="informacion-meta">Escrito el <span>20/10/2021 </span>por: <span>Admin</span></p>
                    <p>
                        Maximiza el espacio en tu hogar con esta gía, aprende a combinar muebles y colores para darle vida a tu espacio
                    </p>
                </a>
            </div>
        </article>
    </section>

    <section class="testimoniales">
        <h3>Testimoniales</h3>
        <div class="testimonial">
            <blockquote>
                El personal se comporto de una excelente forma, muy buena atencion y la casa que me ofrecieron cumple con todas mis expectativas.
            </blockquote>
            <p>- Matias Escobar</p>
        </div>
    </section>
</div>


<?php
incluirTemplates("footer");
?>