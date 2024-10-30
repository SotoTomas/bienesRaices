<?php

use App\Propiedad;
use Intervention\Image\ImageManager as Image;
use Intervention\Image\Drivers\Gd\Driver;

    require '../../includes/app.php';
    estaAutenticado();

    $id = $_GET['id'];
    $id = filter_var($id, FILTER_VALIDATE_INT);

    if(!$id){
        header('Location: /admin');
    }

    //Obtener los datos de la propiedad
    $propiedad = Propiedad::find($id);

    // Consultar para obtener los vendedores
    $consulta = "SELECT * FROM vendedores";
    $resultado = mysqli_query($db, $consulta);

    // Arreglo con mensajes de errores . 
    //VARIABLES QUE COMIENZAN VACIAS Y SE LLENAN UNA VEZ QUE EL USUARIO INGRESA EL POST
    $errores= Propiedad::getErrores();

    // Ejecutar el codigo despues de que el usuario envia el codigo

    if($_SERVER['REQUEST_METHOD'] === 'POST') {

        //ASIGNAR LOS ATRIBUTOS
        $args = $_POST['propiedad'];
       
        $propiedad -> sincronizar($args);
        
        //VALIDACION
        $errores = $propiedad->validar();

        //SUBIDA DE ARCHIVOS
        $nombreImagen= sha1(uniqid(rand(), true)). ".jpg";
        
        $manager = new Image (Driver::class);
        if($_FILES['propiedad']['tmp_name']['imagen']){
            $image = ($manager->read($_FILES['propiedad']['tmp_name']['imagen']))->cover(800,600);
            $propiedad->setImagen($nombreImagen);
        }

        if (empty($errores)) {
            //ALMACENAR LA IMAGEN
            if(isset($image)){
                $image->save(CARPETA_IMAGENES . $nombreImagen);
            }
            $propiedad->guardar();
            
    }
} 
    

   incluirTemplate('header');
?>

<main class="contenedor seccion">
        <h1>Actualizar Propiedad</h1>
        <a href="/admin" class="boton boton-verde">Volver</a>

        <?php foreach ($errores as $error): ?>
        <div class="alerta error">
            <?php echo $error; ?>
        </div>

        <?php endforeach; ?>


        <form class="formulario" method="POST" enctype="multipart/form-data">
            <?php include '../../includes/templates/formulario_propiedades.php' ?>
            <input type="submit" class="boton boton-verde" value="Actualizar Propiedad">
        </form>
    </main>

<?php 
    incluirTemplate('footer'); 
?>