<?php
include_once 'conexion.php';
class OperadorTelefoniaModel 
{
	
 private $bd;

   

    public function Listar()
    {
        $this->bd = new Conexion();
        $stmt = $this->bd->prepare("SELECT * FROM operadortelefonia where eliminado = 0" );
        $stmt->execute();

        if (!$stmt->execute()) {
                
        }else{ 
            //return 'error';     
            //print_r($stmt->errorInfo());      
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        

    }
    public function Consultar(OperadorTelefonia $operador_tel)
    {
        $this->bd = new Conexion();

        $stmt = $this->bd->prepare("SELECT * FROM operadortelefonia WHERE idOperadorTelf = :idOperadorTelf");    
        $stmt->bindParam(':idOperadorTelf', $operador_tel->__GET('idOperadorTelf'));
        
        
        $stmt->execute();
       $row = $stmt->fetch(PDO::FETCH_OBJ);      

        $objOperador_tel = new OperadorTelefonia();     
        $objOperador_tel->__SET('idOperadorTelf',$row->idOperadorTelf);
        $objOperador_tel->__SET('descripcion',$row->descripcion);
        $objOperador_tel->__SET('activo',$row->activo); 
        return $objOperador_tel;
    }

    public function Actualizar(OperadorTelefonia $operador_tel)
    {
      
        $this->bd = new Conexion();
        $stmt = $this->bd->prepare("UPDATE operadortelefonia SET  descripcion=:descripcion,modificado_por=:modificado_por,activo=:activo WHERE idOperadorTelf = :idOperadorTelf;");

        $stmt->bindParam(':idOperadorTelf',$operador_tel->__GET('idOperadorTelf'));
        $stmt->bindParam(':descripcion',$operador_tel->__GET('descripcion'));         
        $stmt->bindParam(':modificado_por',$operador_tel->__GET('modificado_por'));
        $stmt->bindParam(':activo',$operador_tel->__GET('activo'));    
        if (!$stmt->execute()) {
          return 'error';
      // print_r($stmt->errorInfo());
        }else{
            
            return 'exito';
        }
    }    

    public function Registrar(OperadorTelefonia $operador_tel)
    {
       
  
        $this->bd = new Conexion();
        $stmt = $this->bd->prepare("INSERT INTO operadortelefonia(descripcion,ingresado_por) VALUES(:descripcion,:ingresado_por)");
        $stmt->bindParam(':descripcion', $operador_tel->__GET('descripcion'));
        $stmt->bindParam(':ingresado_por', $operador_tel->__GET('ingresado_por'));     

        if (!$stmt->execute()) {
            $errors = $stmt->errorInfo();
             //echo($errors[2]);
           return $errors[2];          
            //print_r($stmt->errorInfo());
        }else{
            
            return 'exito';
        }
    }

    public function Eliminar(OperadorTelefonia $operador_tel)
    {
       
        $this->bd = new Conexion();
        $stmt = $this->bd->prepare("UPDATE operadortelefonia SET  modificado_por=:modificado_por,eliminado=:eliminado WHERE idOperadorTelf = :idOperadorTelf");
        $stmt->bindParam(':idOperadorTelf',$operador_tel->__GET('idOperadorTelf'));
        $stmt->bindParam(':modificado_por',$operador_tel->__GET('modificado_por'));
        $stmt->bindParam(':eliminado',$operador_tel->__GET('eliminado'));    
        if (!$stmt->execute()) {
            return 'error';
        //print_r($stmt->errorInfo());
        }else{
            
            return 'exito';
        }
         
    }
 
}