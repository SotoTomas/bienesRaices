<?php
    require '../../includes/app.php';

    use App\Propiedad;
    use App\Vendedor;
    use Intervention\Image\ImageManager as Image;
    use Intervention\Image\Drivers\Gd\Driver;
    estaAutenticado();


    $propiedad = new Propiedad;

    $vendedores = Vendedor::all();

    // Arreglo con mensajes de erorres
    $errores= Propiedad::getErrores();

    // Ejecutar el codigo despues de que el usuario envia el codigo
    if($_SERVER['REQUEST_METHOD'] === 'POST') {

        $manager = new Image (Driver::class);

        //CREA UNA NUEVA INSTANCIA
        $propiedad = new Propiedad($_POST['propiedad']);
        //CREAR CARPETA PARA SUBIDA DE ARCHIVOS (SI NO EXISTE)

        //Generar un nombre único
        $nombreImagen= sha1(uniqid(rand(), true)). ".jpg";
        
        //SETEAR LA IMAGEN}
         //Realiza un resize a la imagen con intervantion
        if($_FILES['propiedad']['tmp_name']['imagen']){
            $image = ($manager->read($_FILES['propiedad']['tmp_name']['imagen']))->cover(800,600);
            $propiedad->setImagen($nombreImagen);
        }
        
        
        //VALIDAR
        $errores = $propiedad->validar();
        
        if (empty($errores)) {
            if(!is_dir(CARPETA_IMAGENES)){
                mkdir(CARPETA_IMAGENES);
            }
            //guardar la imagen en el servidor
            $image -> save(CARPETA_IMAGENES . $nombreImagen);

            //guardar en al base de datos
            $resultado = $propiedad->guardar();

            // Asignar files hacia una variable
            $imagen= $_FILES['imagen'];

            
        }   
    }



   incluirTemplate('header');

?>


<main class="contenedor seccion">
        <h1>Crear</h1>
        <a href="/admin" class="boton boton-verde">Volver</a>

        <?php foreach ($errores as $error): ?>
        <div class="alerta error">
            <?php echo $error; ?>
        </div>

        <?php endforeach; ?>


        <form class="formulario" method="POST" action="/admin/propiedades/crear.php" enctype="multipart/form-data">
            <?php include '../../includes/templates/formulario_propiedades.php'; ?>
            
            <input type="submit" class="boton boton-verde" value="Crear Propiedad">
        </form>
    </main>

<?php 
    incluirTemplate('footer'); 
?>