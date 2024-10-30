<?php 
    $db = conectarDB(); 
    //consultar
    $query = "SELECT * FROM propiedades LIMIT $limite";


    //obtener base de datos
    $resultado = mysqli_query($db, $query);

?>


<div class="contenedor-anuncios">
        <?php while($propiedad = mysqli_fetch_assoc($resultado)): ?>
        <div class="anuncio">
                    <img loading="lazy" src="/imagenes/<?php echo $propiedad['imagen'];?>" alt="anuncio">
            
            <div class="contenido-anuncio">
                    <h3><?php echo $propiedad['titulo']; ?> </h3>
                    <p><?php echo $propiedad['descripcion']; ?></p>
                    <p class="precio">>$3,000,000</p>

                    <ul class="iconos-caracteristicas">
                        <li>
                            <img class="icono" loading="lazy" src="build/img/icono_wc.svg" alt="icono wc">
                            <p><?php echo $propiedad['wc']; ?></p>
                        </li>
                        <li>
                            <img class="icono" loading="lazy" src="build/img/icono_estacionamiento.svg" alt="icono estacionamiento">
                            <p><?php echo $propiedad['estacionamiento']; ?></p>
                        </li>
                        <li>
                            <img class="icono" loading="lazy" src="build/img/icono_dormitorio.svg" alt="icono habitaciones">
                            <p><?php echo $propiedad['habitaciones']; ?></p>
                        </li>

                    </ul>

                    <a href="anuncio.php?id=<?php echo $propiedad['id']; ?>" class="boton-amarillo-block">
                        Ver Propiedad
                    </a>
            </div> <!-- CONTENIDO ANUNCIO-->
        </div>   
        <?php endwhile; ?>    
</div> <!--CONTENEDOR ANUNCIO-->

<?php 
// Cerrar la conexión

mysqli_close($db);
?>