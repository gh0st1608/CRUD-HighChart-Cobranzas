<?php
require_once 'model/operadortelefonia.model.php';
require_once 'entity/operadortelefonia.entity.php';


class OperadorTelefoniaController{    
  
    private $model;
    
    public function __CONSTRUCT()
    {
        $this->model = new OperadorTelefoniaModel();
    }
    /**==========================Vistas=======================================*/
    public function Index(){        
        require_once 'view/header.php';
        require_once 'view/administracion/operadortelefonia/index.php';
        require_once 'view/footer.php';       
    }

    public function v_Actualizar(){        
        require_once 'view/header.php';
        require_once 'view/administracion/operadortelefonia/actualizar.php';
        require_once 'view/footer.php';       
    }

    public function v_Registrar(){        
        require_once 'view/header.php';
        require_once 'view/administracion/operadortelefonia/registrar.php';
        require_once 'view/footer.php';       
    }
    /**=======================================================================*/   
    public function Listar()
    {
        $operadores_tel = $this->model->Listar();
        return $operadores_tel;
    }

    public function Consultar($idOperadorTelf)
    {
        $operador_tel = new OperadorTelefonia();
        $operador_tel->__SET('idOperadorTelf',$idOperadorTelf);

        $consulta = $this->model->Consultar($operador_tel);
        return $consulta;
    }

    public function Actualizar(){
        $operador_tel = new OperadorTelefonia();
        $operador_tel->__SET('idOperadorTelf',$_REQUEST['idOperadorTelf']);
        $operador_tel->__SET('descripcion',$_REQUEST['descripcion']);              
        $operador_tel->__SET('modificado_por',$_SESSION['Usuario_Actual']);
        $operador_tel->__SET('activo',$_REQUEST['activo']);       
        $actualizar_operador_tel = $this->model->Actualizar($operador_tel);  
         
        if($actualizar_operador_tel=='error'){
            header('Location: index.php?c=OperadorTelefonia&a=v_Actualizar&idProveedor='. $operador_tel->__GET('idOperadorTelf'));
            echo 'No se Ha Podido Actualizar el proveedor';
        }else{
            echo 'Operador Telefonico actualizado Correctamente';
            header('Location: index.php?c=OperadorTelefonia');
         }
    }

    public function Registrar(){
        
        $operador_tel = new OperadorTelefonia();
        $operador_tel->__SET('descripcion',$_REQUEST['descripcion']);
        $operador_tel->__SET('ingresado_por',$_SESSION['Usuario_Actual']);     
       
        $registrar_operador_tel = $this->model->Registrar($operador_tel);  
         
        if($registrar_operador_tel=='error'){
            header('Location: index.php?c=Cartera&a=v_OperadorTelefonia');
            echo 'No se Ha Podido Registrar el Operador Telefonico';
         }else{
            echo 'Operador Telefonico Registrado Correctamente';
            header('Location: index.php?c=OperadorTelefonia');
         }
    }

    public function Eliminar(){
        $operador_tel = new OperadorTelefonia();
        $operador_tel->__SET('idOperadorTelf',$_REQUEST['idOperadorTelf']);      
        $operador_tel->__SET('modificado_por',$_SESSION['Usuario_Actual']);
        $operador_tel->__SET('eliminado',1); 
        $eliminar_operador_tel = $this->model->Eliminar($operador_tel);  
         
        if($eliminar_operador_tel=='error'){
            echo 'No se Ha Podido Eliminar el Operador Telefonico';
            header('Location: index.php?c=OperadorTelefonia');            
         }else{
            echo 'Operador Telefonico Eliminado Correctamente';
            header('Location: index.php?c=OperadorTelefonia');
         }
    }



}