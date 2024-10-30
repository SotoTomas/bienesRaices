<?php

namespace App;

class Vendedor extends ActiveRecord{
    protected static $tabla = 'vendedores';
    protected static $columnasDB = ['id', 'nombre', 'apellido', 'telefono'];

    public $id;
    public $nombre;
    public $apellido;
    public $telefono;
    
    public function __construct($args = []) {
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->apellido = $args['apellido'] ?? '';
        $this->telefono = $args['telefono'] ?? '';
    }

    public function validar(){
        if(!$this->id){
        self::$errores[] = "Debes añadir un título";
        } 

         if(!$this->nombre){
            self::$errores[] = "Debes añadir un precio";
         }
         if(!$this->apellido){
            self::$errores[] = "Debes añadir la cantidad de habitaciones";
         }
        
         if(!$this->telefono){
            self::$errores[] = "Debes añadir la cantidad de baños";
         }
         return self ::$errores;
    }
}