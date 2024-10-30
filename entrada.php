<?php
    require 'includes/app.php';
   incluirTemplate('header');
?>


    <main class="contenedor seccion contenido-centrado  ">
        <h1>Guia para la decoracion de tu hogar</h1>
        <p class="informacion-meta">Escrito el <span>20/10/2021</span> por <span>Admin</span></p>

        <picture>
            <source srcset="build/img/destacada2.webp" type="image/webp">
            <source srcset="build/img/destacada2.jpg" type="image/jpeg">
            <img loading="lazy" src="build/img/destacada.jpg" alt="Imagen de la Propiedad">
        </picture>

        <div class="resumen-propiedad">
           <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.
            Praesentium similique quibusdam perspiciatis harum dolores!
            Voluptate consequuntur tempora quam, quasi tempore excepturi 
            odio minima soluta inventore magnam nostrum quos sit harum! Lorem,
            ipsum dolor sit amet consectetur adipisicing elit. Maiores blanditiis
            labore minus, facere accusantium repudiandae beatae voluptas, eaque sunt, 
            nisi tenetur error neque aperiam culpa doloribus dolores repellat eos? 
            Mollitia. Lorem ipsum dolor sit amet consectetur adipisicing elit.
            Quae illo unde libero nulla ratione architecto facere pariatur hic laudantium
            , magnam sunt nesciunt officiis, expedita, asperiores harum commodi 
            nam obcaecati saepe!</p>
        </div>
    </main>

    <?php
   incluirTemplate('footer');
   ?>