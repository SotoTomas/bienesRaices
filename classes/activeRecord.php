<?php 

namespace App;

class ActiveRecord{
        //Base de datos
        protected static $db;
        protected static $tabla = '';
        protected static $columnasDB = [];
    
        //ERRORES
        protected static $errores= [];
    
       
    
         //definir la conexion a la BD
         public static function setDB($database){
            self::$db = $database;
        }
    
        
    
        public function guardar(){
            if(!is_null($this->id)){
                //actualizar
                $this->actualizar();
            }else{
                //crear
                $this->crear();
            }
        }
    
    
    
        public function crear(){
            //SANITIZAR BASE DE DATOS
            $atributos = $this->sanitizarAtributos();
            
            //INSERTAR BASE DE DATOS
            $query = "INSERT INTO " . static::$tabla . " ( "; 
            $query .= join(', ',array_keys($atributos));
            $query .= " ) VALUES ( '";
            $query .= join("', '",array_values($atributos));
            $query.= "')";
    
                $resultado = self::$db->query($query);
    
                if ($resultado){
                    header('Location: /admin?resultado=1');  
                }
        } 
        public function actualizar(){
    
            $atributos = $this->sanitizarAtributos();
    
            $valores=[];
            foreach($atributos as $key => $value){
                $valores[] = " $key = '$value'";
            }
            
            $query = "UPDATE " . static::$tabla . " SET";
            $query .= join(', ', $valores);
            $query .= " WHERE id= '" . self::$db->escape_string($this->id) . "' ";
            $query .= "LIMIT 1";
    
            $resultado = self::$db->query($query);
    
            if ($resultado) {
                header('Location: /admin?resultado=2');
            }
        }
        public function eliminar(){
            $query = "DELETE FROM " . static::$tabla . " WHERE id = ". self::$db->escape_string($this->id) . " LIMIT 1";
            $resultado = self::$db->query($query);
            $this->borrarImagen();
            if($resultado){
                header('location: /admin?resultado=3');
            }
        }
        
    
    
        // IDENTIFICAMOS Y UNIMOS LOS ATRIBUTOS DE LA BASE DE DATOS
        public function atributos(){
            $atributos =[];
            foreach (self::$columnasDB as $columna){
                if($columna === 'id')continue;
                $atributos[$columna] = $this->$columna;
            }
            return $atributos;
        }
    
        public function sanitizarAtributos(){
            $atributos = $this-> atributos();
            $sanitizado = []; 
            foreach($atributos as $key=> $value){
                $sanitizado[$key] = self::$db->escape_string($value);
            }
            return $sanitizado;
        }
    
        //SUBIDA DE ARCHIVOS
        public function setImagen($imagen){
            //elimina la imagen previa
            if(!is_null($this->id)){
                $this->borrarImagen();
            }
            //Asignar al atributo de imagen el nombre de la imagen
            if($imagen){
                $this->imagen = $imagen;
            }
        }
        //ELIMINAR ARCHIVOS
        public function borrarImagen(){
            $existeArchivo = file_exists(CARPETA_IMAGENES . $this->imagen);
            if($existeArchivo){
                unlink(CARPETA_IMAGENES . $this->imagen);
            }
        }
    
        //validacion
    
        public static function getErrores(){
            return static::$errores;
        }
    
        public function validar(){
            static::$errores = [];
            return static::$errores;
        }
    
        //Lista todos los registros
        public static function all(){
            $query = "SELECT * FROM " . static::$tabla;

            $resultado = self::consultarSQL($query);
            return $resultado;
        }
    
        //Busca un registro por su id
        public static function find($id){
            $query = "SELECT * FROM " . static::$tabla . "WHERE id = $id";
            $resultado = self::consultarSQL($query);
            return array_shift($resultado);
        }
    
    
    
        public static function consultarSQL($query){
            //CONSULTAR LA BASE DE DATOS
            $resultado = self::$db->query($query);
    
    
            //ITERAR LA BASE DE DATOS
            $array  = [];
            while ($registro = $resultado->fetch_assoc()){
                $array[] = self::crearObjeto($registro);
            }
            //LIBERAR LA MEMORIA
            $resultado ->free();
    
    
            //RETORNAR LOS RESULTADOS
            return $array;
        }
    
        protected static function crearObjeto($registro){
            $objeto = new static;
            foreach ($registro as $key=>$value){
                if(property_exists($objeto, $key)){
                    $objeto->$key = $value;
                }
            }
    
            return $objeto;
        }
    
        //Sincroniza el objeto en memoria con los cambios realizados por el usuario
        public function sincronizar($args=[]){
            foreach($args as $key=>$value){
                if(property_exists($this, $key) && !is_null ($value)){
                    $this->$key = $value;
                }
            }
        }
    
}