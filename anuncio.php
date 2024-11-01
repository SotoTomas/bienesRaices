<?php
    require 'includes/app.php';

    $id = $_GET['id'];
    $id = filter_var($id, FILTER_VALIDATE_INT);
    if(!$id){
        header('Location: /admin');
    }

    $db = conectarDB();
    
    $consultaId = "SELECT * FROM propiedades WHERE id = $id";
    $resultado= mysqli_query($db, $consultaId);
    $propiedad= mysqli_fetch_assoc($resultado);
    
    if($resultado->num_rows=== 0){
        header('Location: /');
    }
    
    incluirTemplate('header');
    
?>


    <main class="contenedor seccion contenido-centrado  ">
        <a href="/anuncios.php" class="boton boton-verde">Volver</a>

        <h1><?php echo $propiedad['titulo']; ?></h1>

        <img loading="lazy" src="/imagenes/<?php echo $propiedad['imagen']; ?>" alt="Imagen de la Propiedad">
     

        <div class="resumen-propiedad">
            <p class="precio">>$<?php echo $propiedad['precio']; ?></p>
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
            <p><?php echo $propiedad['descripcion']; ?></p>
    </main>

    <?php
    
    incluirTemplate('footer');
    mysqli_close($db);
    ?>