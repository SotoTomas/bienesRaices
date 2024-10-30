<?php
    require 'includes/app.php';
    incluirTemplate('header');
?>


    <main class="contenedor seccion">
        <h1>Conoce sobre Nosotros</h1>

        <div class="contenido-nosotros">
            <div class="imagen">
                <picture>
                    <source src="build/img/nosotros.webp" type="image/webp">
                    <source src="build/img/nosotros.jpg" type="image/jpeg">
                    <img loading="lazy" src="build/img/nosotros.jpg" alt="Sobre Nosotros">
                </picture>
            </div>

            <div class="texto-nosotros">
                <blockquote>
                    25 Años de Experiencia
                </blockquote>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.
                     Sapiente, sed! Esse inventore, id, quo eaque ratione nihil nisi aut 
                     dolor dicta adipisci consequuntur, doloremque at hic in voluptas! 
                     Accusamus, quisquam.Lorem ipsum dolor sit amet consectetur adipisicing elit.
                     Sapiente, sed! Esse inventore, id, quo eaque ratione nihil nisi aut 
                     dolor dicta adipisci consequuntur, doloremque at hic in voluptas! 
                     Accusamus, quisquamLorem ipsum dolor sit amet consectetur adipisicing elit.
                     Sapiente, sed! Esse inventore, id, quo eaque ratione nihil nisi aut 
                     dolor dicta adipisci consequuntur, doloremque at hic in voluptas! 
                     Accusamus, quisquamLorem ipsum dolor sit amet consectetur adipisicing elit.
                     Sapiente, sed! Esse inventore, id, quo eaque ratione nihil nisi aut 
                     dolor dicta adipisci consequuntur, doloremque at hic in voluptas! 
                     Accusamus, quisquamLorem ipsum dolor sit amet consectetur adipisicing elit.
                     Sapiente, sed! Esse inventore, id, quo eaque ratione nihil nisi aut 
                     dolor dicta adipisci consequuntur, doloremque at hic in voluptas! 
                     Accusamus, quisquam</p>
            </div>
        </div>
    </main>

    <section class="contenedor seccion">
        <h1>Más sobre Nosotros</h1>

        <div class="iconos-nosotros">
            <div class="icono">
                <img src="build/img/icono1.svg" alt="Icono seguridad" loading="lazy">
                <h3>Seguridad</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Tempore velit quae unde explicabo quibusdam autem aliquid v</p>
            </div>
            <div class="icono">
                <img src="build/img/icono2.svg" alt="Icono Precio" loading="lazy">
                <h3>Precio</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Tempore velit quae unde explicabo quibusdam autem aliquid v</p>
            </div>
            <div class="icono">
                <img src="build/img/icono3.svg" alt="Icono Tiempo" loading="lazy">
                <h3>Tiempo</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Tempore velit quae unde explicabo quibusdam autem aliquid v</p>
            </div>
        </div>
    </section>


    <?php
   incluirTemplate('footer');
   ?>