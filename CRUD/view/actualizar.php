 <!-- Content Header (Page header) -->
<section class="content-header">  
	<h1>
		Modulo Administracion
	</h1>
	<ol class="breadcrumb">
            <li><a href="index.php"><i class="fa fa-dashboard"></i> Inicio</a></li>
            <li><a href="index.php?c=OperadorTelefonia">Operador Telefonico</a></li>
            <li class="active">Actualizar</li>
          </ol>	
</section>
<?php



 if (!isset($_REQUEST['idOperadorTelf'])==''){

$operador_tel= $this->Consultar($_REQUEST['idOperadorTelf']);

  ?>
<section class="content">
	<div class="row">
		<div class="col-sm-12 col-md-6 col-md-offset-3">
	  		<div class="box">
	    		<div class='box-header with-border'>
	      			<h3 class='box-title'><i class="fa fa-briefcase"></i> Actualizar Operador Telefonico</h3>
	    		</div>
	    		<div class="box-body">
	    			<form id="frmActualizarOperadorTelefonico" action="?c=OperadorTelefonia&a=Actualizar" method="post" enctype="multipart/form-data" role="form">
	    				<input type="hidden" name="idOperadorTelf" value="<?php echo $operador_tel->__GET('idOperadorTelf'); ?>" /> 
					    <div class="form-group col-md-12">
					        <label>Descripcion</label>
					        <input type="text" id="txtDescripcionOperadorTelefonico" name="descripcion" value="<?php echo $operador_tel->__GET('descripcion'); ?>" data-nombreAnterior="<?php echo $operador_tel->__GET('descripcion'); ?>" class="form-control" placeholder=""  required />
					    </div>
					    					    
					    <div class="form-group col-md-12">
					      <label>Activo</label>
					      <label class="radio-inline">
					          <input type="radio" name="activo" id="estado_activo" value="1" <?php if ($operador_tel->__GET('activo')==1) { echo 'checked';  } ?>> SI
					      </label>
					      <label class="radio-inline">
					          <input type="radio" name="activo" id="estado_inactivo" value="0" <?php if ($operador_tel->__GET('activo')==0) { echo 'checked'; }  ?>> NO
					      </label>					    
					    </div>
					  

					  <div class="col-md-12" style="margin-top:2em;">
					    <div class="col-md-6 col-sm-12">
					        
					        <button type="button" id="btnSubmit" class="btn btn-primary col-md-12 col-xs-12"><i class="fa fa-save"></i> Actualizar</button>    
					      
					    </div>
					     <div class="col-md-6 col-sm-12">

					       
					    
					        <a href="index.php?c=OperadorTelefonia" class="btn btn-danger col-md-12 col-xs-12 "><i class="fa fa-times-circle"></i> Cancelar</a>
					    </div>  
					  </div>
					</form>                   
                </div>
            </div><!-- /.box -->
        </div><!-- /.col -->
    </div><!-- /.row -->
</section><!-- /.content -->
<script>
	
	$(document).ready(function() {
				
		$("#btnSubmit").click(function(event) {

			bootbox.dialog({
	            message: "¿Estas seguro de actualizar el Operador Telefonico " + "<b>" + $("#txtDescripcionOperadorTelefonico").attr('data-nombreAnterior') + "?</b>",
	            title: "Actualizar Operador Telefonico",
	            buttons: {
	                main: {
	                    label: "Actualizar",
	                    className: "btn-primary",
	                    callback: function() {
	                        //console.log('Eliminado al usuario');
	                        
	                              $( "#frmActualizarOperadorTelefonico" ).submit();
	                         

	                       
	                    }
	                },
	                danger: {
	                    label: "Cancelar",
	                    className: "btn-danger",
	                    callback: function() {
	                        bootbox.hideAll();
	                    }
	                }
	            }
        	}); 
		});

		
	});
</script>
<?php }/*--- END REQUESt*/ ?>