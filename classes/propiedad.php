<?php

namespace App;

class Propiedad extends ActiveRecord{
    protected static $tabla = 'propiedades';
    protected static $columnasDB = ['id', 'titulo', 'precio','imagen','descripcion',
    'habitaciones','wc','estacionamiento','creado','vendedorId'];

    public $id;
    public $titulo;
    public $precio;
    public $imagen;
    public $descripcion;
    public $habitaciones;
    public $wc;
    public $estacionamiento;
    public $creado;
    public $vendedorId;

    public function __construct($args = []) {
        $this->id = $args['id'] ?? null;
        $this->titulo = $args['titulo'] ?? '';
        $this->precio = $args['precio'] ?? '';
        $this->imagen = $args['imagen'] ?? '';
        $this->descripcion = $args['descripcion'] ?? '';
        $this->habitaciones = $args['habitaciones'] ?? '';
        $this->wc = $args['wc'] ?? '';
        $this->estacionamiento = $args['estacionamiento'] ?? '';
        $this->creado = date('Y/m/d');
        $this->vendedorId = $args['vendedorId'] ?? '';
    }

    public function validar(){
        if(!$this->titulo){
        self::$errores[] = "Debes añadir un título";
        } 

         if(!$this->precio){
            self::$errores[] = "Debes añadir un precio";
         }

         if(strlen (!$this->precio)> 10) {
            self::$errores[] = "Debes ingresar un numero de precio más chico";
         }

         if(strlen ($this->descripcion )< 50){
            self::$errores[] = "Debes añadir una descripción con almenos 50 caracteres";
         }
        
         if(!$this->habitaciones){
            self::$errores[] = "Debes añadir la cantidad de habitaciones";
         }
        
         if(!$this->wc){
            self::$errores[] = "Debes añadir la cantidad de baños";
         }
        
         if(!$this->estacionamiento){
            self::$errores[] = "Debes añadir la cantidad de estacionamientos";
         }
         if(!$this->vendedorId){
            self::$errores[] = "Debes añadir un vendedor";
         }
         if(!$this->imagen){
            self::$errores[] = 'La imagen de la propiedad es Obligatoria';
         }

         return self ::$errores;
    }
}