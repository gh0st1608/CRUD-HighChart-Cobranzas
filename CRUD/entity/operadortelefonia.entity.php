<?php

class OperadorTelefonia
{
    private $idOperadorTelf;
    private $descripcion;
    private $fecha_registro;
    private $ingresado_por;
    private $fecha_modificacion;
    private $modificado_por;
    private $activo;
    private $eliminado;

 

    public function __GET($atributo){ 

      return $this->$atributo; 
      
    }

    public function __SET($atributo, $variable){

      return $this->$atributo = $variable; 

    }


}

