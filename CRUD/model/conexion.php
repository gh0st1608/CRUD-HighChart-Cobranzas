<?php 
 class Conexion extends PDO { 
   private $tipo_de_base = 'mysql';
   private $host = '192.168.1.51';
   //private $host = '190.117.148.184';
   private $nombre_de_base = 'bd_cobranzas';
   private $usuario = 'root';
   //private $contrasena = ''; 
   private $contrasena = 'JPuS0LUC10N3S';
   public function __construct() {
      //Sobreescribo el método constructor de la clase PDO.
      try{
         parent::__construct($this->tipo_de_base.':host='.$this->host.';dbname='.$this->nombre_de_base, $this->usuario, $this->contrasena,array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES  \'UTF8\''));
      }catch(PDOException $e){

         // para ver el error $e->getMessage()
         echo '<pre> Ha surgido un error y no se puede conectar a la base de datos.  Detalle: </br> Comunicarse con Soporte Tecnico</pre>';
         //echo '<pre> Ha surgido un error y no se puede conectar a la base de datos.  Detalle: </br>' . $e->getMessage().'</pre>';
         exit;
      }
   } 
 } 


 class ConexionReniec extends PDO { 
   private $tipo_de_base = 'mysql';
   private $host = '191.168.1.51';
   //private $host = '190.117.148.184';
   private $nombre_de_base = 'bd_busquedas';
   private $usuario = 'root';
   private $contrasena = 'JPuS0LUC10N3S';
   public function __construct() {
      //Sobreescribo el método constructor de la clase PDO.
      try{
         parent::__construct($this->tipo_de_base.':host='.$this->host.';dbname='.$this->nombre_de_base, $this->usuario, $this->contrasena,array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES  \'UTF8\''));
      }catch(PDOException $e){
         echo '<pre> Ha surgido un error y no se puede conectar a la base de datos.  error bd_busDetalle: </br>' . $e->getMessage().'</pre>';
         exit;
      }
   } 
 } 

 class ConexionBusquedas extends PDO { 
   private $tipo_de_base = 'mysql';
   private $host = '191.168.1.51';
   //private $host = '190.117.148.184';
   private $nombre_de_base = 'bd_busquedas';
   private $usuario = 'root';
   private $contrasena = 'JPuS0LUC10N3S';
   public function __construct() {
      //Sobreescribo el método constructor de la clase PDO.
      try{
         parent::__construct($this->tipo_de_base.':host='.$this->host.';dbname='.$this->nombre_de_base, $this->usuario, $this->contrasena,array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES  \'UTF8\''));
      }catch(PDOException $e){
         echo '<pre> Ha surgido un error y no se puede conectar a la base de datos.  Detalle: </br>' . $e->getMessage().'</pre>';
         exit;
      }
   } 
 } 

 

?>