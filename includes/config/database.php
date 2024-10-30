<?php

function conectarDB(){
    $db = new mysqli('localhost', 'root', '3003', 'bienesraices_crud');
    
     if(!$db){
         echo "No se pudo conectar";
         exit;
     }
     return $db;
}