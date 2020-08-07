 <!-- Content Header (Page header) -->
<section class="content-header">  
	<h1>
		Modulo Administracion
	</h1>
	<ol class="breadcrumb">
		<li><a href="index.php"><i class="fa fa-dashboard"></i> Inicio</a></li>           
	    <li class="active">Operadores Telefonicos</li>
	</ol>
</section>

<section class="content">
	<div class="row">
		<div class="col-xs-12">
	  		<div class="box">	
	    		<div class='box-header with-border'>
	      			<h3 class='box-title'><i class="fa fa-briefcase"></i> Lista Operadores Telefonicos</h3> <a class="btn btn-sm btn-primary pull-right" href="?c=OperadorTelefonia&a=v_Registrar"> Nuevo Operador Telefonico</a>
	    		</div>
	    		<div class="box-body box-body_table">
	    		 <?php  $operadores_tel = $this->Listar();  ?>
                  	<table id="TablaEntidad" class="table table-bordered table-hover dataTable no-footer" width="100%">
	                    <thead>
	                      	<tr>                      
		                    	<th>ID</th>                    
			                    <th style="vertical-align: middle;">Operador Telefonico</th>
			                    <th style="vertical-align: middle;">Estado</th>
			                    <th style="vertical-align: middle;">Acciones</th>
	                     	</tr>
	                    </thead>
	                    <tbody>
	                    	<?php foreach ($operadores_tel as $operador_tel): ?>
	                    	<tr>
	                    		<td><?php echo $operador_tel['idOperadorTelf']; ?></td>
	                    		<td><?php echo $operador_tel['descripcion']; ?></td>
	                    		<?php if ($operador_tel['activo']==1): ?>
                                <td class=""><span class="label label-success"><i class="fa fa-check-square-	o" aria-hidden="true"></i> Activo</span></td>
                                <?php else: ?>
                                <td class=""><span class="label label-danger"><i class="fa fa-square-o" aria-hidden="true"></i> Inactivo</span></td>
                                <?php endif ?>
                            	<td class="a_center">                            		
                            		<a href="?c=OperadorTelefonia&a=v_Actualizar&idOperadorTelf=<?php echo $operador_tel['idOperadorTelf']; ?>" class="btn btn-primary btn-xs ">
                                   		<i class="fa fa-pencil"></i>   
                               		</a>
                               		<a class="btn btn-danger btn-xs EliminarOperadorTelefonico" data-id="<?php echo $operador_tel['idOperadorTelf']; ?>" data-descripcion="<?php echo $operador_tel['descripcion']; ?>">
                                   		<i class="fa fa-trash"></i>   
                               		</a>

                               	</td>
	                    	</tr>
	                    	<?php endforeach; ?>
	                    </tbody>
                	</table>                    
                </div>
            </div><!-- /.box -->
        </div><!-- /.col -->
    </div><!-- /.row -->
</section><!-- /.content -->

<script>
	
	$(document).ready(function() {
		$(".EliminarOperadorTelefonico").click(function(event) {
			idOperadorTelf=$(this).attr('data-id');
			bootbox.dialog({
            message: "¿Estas seguro de eliminar el proveedor <b>"+$(this).attr('data-descripcion')+"</b>?",
            title: "Eliminar Operador Telefonico",
            buttons: {
                main: {
                    label: "Eliminar",
                    className: "btn-primary",
                    callback: function() {
                        //console.log('Eliminado al usuario');
                        window.location.href = "?c=OperadorTelefonia&a=Eliminar&idOperadorTelf="+idOperadorTelf;
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

