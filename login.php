<?php
    require 'includes/app.php';
    $db = conectarDB();
    
    // Autenticar el usuario
    $errores= [];

    // Leer los resultados de $_POST
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        // echo "<pre>";
        // var_dump($_POST);
        // echo "</pre>";

        $email = mysqli_real_escape_string($db, filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) );
        $password =mysqli_real_escape_string($db, $_POST['password']);

        if(!$email){
            $errores[] = "Email inválido";
        }
        if(!$password){
            $errores[] = "Contraseña inválida";
        }

        if(empty($errores)){

            //revisar si el usuario existe
            $query = "SELECT * FROM usuarios WHERE email = '$email' ";
            $resultado = mysqli_query($db, $query);

            // echo "<pre>";
            // var_dump($resultado);
            // echo "</pre>";

            if ($resultado->num_rows) {

                $usuario = mysqli_fetch_assoc($resultado);
                // var_dump($usuario);
                //revisar si el password es correcto
                $auth = password_verify($password, $usuario['password']);
                var_dump($auth);

                if($auth){
                    //El usuario esta autenticado
                    session_start();

                    $_SESSION['usuario'] = $usuario['email'];
                    $_SESSION['login'] = true;

                    // echo "<pre>";
                    // var_dump($_SESSION);
                    // echo "</pre>";

                    header('Location: /admin');



                }else{
                    $errores[]= "La contraseña es incorrecta";
                }
            }else{
                $errores[]= "El correo no existe";
            }
        }
    }



    // require '../bienesraices/usuario.php';
   incluirTemplate('header');

?>


    <main class="contenedor seccion contenido-centrado">
        <h1>Iniciar Sesion</h1>

        <?php foreach($errores as $error):?>
        <div class="alerta error">
        <?php echo $error; ?>
    
        </div>
        
        <?php endforeach; ?>

       <form method="POST" class="formulario">
           <fieldset>
                <legend>Email y Password</legend>

                <label for="email">Correo Electrónico</label>
                <input type="email" name="email" placeholder="Tu Correo" id="email">

                <label for="password">Contraseña</label>
                <input type="password" name="password" placeholder="Tu Contraseña" id="password">

                <input class="boton boton-verde" type="submit" value="Iniciar Sesión">

            </fieldset> 
       </form>
    </main>

    <?php
   incluirTemplate('footer');
   ?>