<?php 
//ARCHIVO QUE MANDA A LLAMAR FUNCIONES, BASES DE DATOS Y CLASSES
require 'funciones.php';
require 'config/database.php';
require __DIR__ . '/../vendor/autoload.php';

//conectarnos a la base de datos

$db = conectarDB();

use App\ActiveRecord;

ActiveRecord::setDB($db);



