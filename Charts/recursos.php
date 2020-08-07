 <!-- Content Header (Page header) -->
<section class="content-header">  
	<h1>
		Modulo Administracion
	</h1>
	<ol class="breadcrumb">
		<li><a href="index.php"><i class="fa fa-dashboard"></i> Inicio</a></li>           
	    <li class="active">Herramientas Tecnológicas</li>
	</ol>
</section>


<?php
require 'controller/cartera.controller.php';


$obj_cartera = new CarteraController();


//<section class="content-header">  
//    <h1>
//        Dashboard <small>Pagos</small>
//    </h1>
//    <ol class="breadcrumb">
//        <li><a href="index.php"><i class="fa fa-dashboard"></i> Inicio</a></li>           
//    </ol>
//</section>
 $Campana_id = $this->Consultas("SELECT idCampana FROM campana 
            WHERE  activo=1 and eliminado=0;");
           
            $array_Campana= array();
            foreach ($Campana_id as  $item) {
                array_push($array_Campana,$item['idCampana']);
                //print_r($item);
                //print_r($array_Campana);
            }

             $Campanas=implode(",",$array_Campana);


            $fecha_inicial = new DateTime();
            $fecha_inicial->modify('first day of this month');
            $txt_fecha_inicial=$fecha_inicial->format('Y-m-d'); // imprime por ejemplo: 01/12/2012

            $fecha_final = new DateTime();
            $fecha_final->modify('last day of this month');

            $txt_fecha_final=$fecha_final->format('Y-m-d'); // imprime por ejemplo: 31/12/2012
            $week = 1;
            $numberdayswork=0;
  //$day_start=  $fecha_inicial; 
  //$day_end  =  $fecha_final;
  //$i=$day_start;

  $i=$fecha_inicial;
  $numberdayscurrent=0;
    
  while(strtotime($txt_fecha_inicial) <= strtotime($txt_fecha_final)){

    //echo $i.'<br>';
    $day_week = date('N', strtotime($txt_fecha_inicial));
    //echo date('Y-m-d', strtotime(date('Y-m').'-'.$i));
    $calendar[$week][$day_week] = $i;
    $calendar[$week][$day_week] =  date('Y-m-d', strtotime($txt_fecha_inicial));
    $calendar_day[$txt_fecha_inicial]['Dia']=date('Y-m-d', strtotime($txt_fecha_inicial));
    if ($day_week == 7) { $week++; };
    if ($day_week != 7) { $numberdayswork++; };
    if (date('Y-m-d', strtotime($txt_fecha_inicial))==date('Y-m-d')) {
       $numberdayscurrent=$numberdayswork;
    };
    $txt_fecha_inicial=date("Y-m-d  ", strtotime($txt_fecha_inicial . " + 1 day"));
    $i++;
}//endwhile;*/          




$array_recursosxcarteraxfecha = $this-> Consultas("SELECT 
cartera.nombre as Cartera,
gestion.fecha_gestion,
tipogestion.descripcion,
COUNT(deudor.Documento) as NroGestiones

FROM gestion
inner join campana on campana.idCampana=gestion.Campana_id
inner join cartera on cartera.idCartera=campana.Cartera_id
inner join deudor on deudor.idDeudor=gestion.Deudor_id
inner join tipogestion  on tipogestion.idTipoGestion = gestion.tipoGestion_id
INNER JOIN   resultado ON resultado.idResultado = gestion.Resultado_id
where gestion.eliminado=0 
and campana.idCampana in (".$Campanas.") 
and gestion.tipogestion_id in(5,6,7) 
and resultado.idresultado in (42,43,82,88,44,45,116)
GROUP BY cartera,fecha_gestion 
;");


$arrayTblGestCarteraFechaIVR = array();
$arrayTblGestCarteraFechaSMS = array();
foreach ($array_recursosxcarteraxfecha as $item ) {
 
  if ( $item['descripcion'] == "Ivr" ) {
    $arrayTblGestCarteraFechaIVR[$item['Cartera']][$item['fecha_gestion']][$item['descripcion']]=$item['NroGestiones'];

  }
  if ( $item['descripcion'] == "Sms"  ){
    $arrayTblGestCarteraFechaSMS[$item['Cartera']][$item['fecha_gestion']][$item['descripcion']]=$item['NroGestiones'];
    
  }
}



$arrayUniqueCarteras=$this->orderMultiDimensionalArray($this->super_unique($array_recursosxcarteraxfecha,'Cartera'),'Cartera', $inverse = false);

//$arrayUniqueCarteras=$this->orderMultiDimensionalArray($this->super_unique($array_recursosxcarteraxfecha,'Cartera'),'Cartera', $inverse = false);

$arrayUniqueFechasSMS=$this->orderMultiDimensionalArray($this->super_unique($array_recursosxcarteraxfecha,'fecha_gestion'),'fecha_gestion', $inverse = false);
//echo '<pre>';
//print_r($arrayTblGestCarteraFecha);
//print_r($arrayTblGestCarteraFechaIVR);
//print_r($arrayTblGestCarteraFechaSMS);
//print_r($arrayUniqueCarterasIVR);
//print_r($arrayUniqueCarterasSMS);
//print_r($arrayUniqueCarteras);
//print_r($arrayTblGestCarteraFechaIVR);
//print_r($arrayTblGestCarteraFechaSMS);
//print_r($arrayTblGestCarteraFechaIVR);
//echo '</pre>';
setlocale(LC_ALL,"es_ES");
$mes = STRFTIME("%B");
print_r($mes);
?>

<section>
    <div id="container" ></div>

    <div id="ChartRecursosIVR"></div>  
</section>
<section>
    <div id="container" ></div>

    <div id="ChartRecursosSMS"></div>  
</section>
<section>
    <div id="container" ></div>

    <div id="ChartRecursosHTML"></div>  
</section>


<script>
 $(function () {
    $('#ChartRecursosIVR').highcharts({
        title: {
            text: "Grafica de IVR",
            x: -20 //center
        },
        subtitle: {
            text: '',
            x: -20
        },
        xAxis: {
            categories: [
            <?php  foreach($calendar_day as $dia){?> 
                    
             <?php echo "'".$dia['Dia']."'," ?>
               
             <?php }?> 
           

                ]
        },
        yAxis: {
            title: {
                text: 'Total '
            },
            plotLines: [{
                value: 0,
                width: 1,
                color: '#808080'
            }]
        },
        tooltip: {
        },
        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'middle',
            borderWidth: 0
        },
        series: [
     <?php foreach ($arrayUniqueCarteras as $item2){?>
    {
       name: <?php echo "'".$item2['Cartera']."'" ?>, //  linea por cartera
       data: [
            <?php  foreach($calendar_day as $dia){ ?>

            <?php if (isset($arrayTblGestCarteraFechaIVR[$item2['Cartera']][$dia['Dia']]['Ivr'])){?> 

            //<?php  //print_r($arrayTblGestCarteraFecha[$item['Cartera']][$item['fecha_gestion']]);?>//
            <?php echo $arrayTblGestCarteraFechaIVR[$item2['Cartera']][$dia['Dia']]['Ivr'].","; ?>
        
             <?php if ($dia['Dia'] == date('Y-m-d')) {
              //echo '<pre>';
              //print_r($dia['Dia']);
              //echo '</pre>';
              break;} ?>
             <?php }else {echo "0,";} ?> 
              <?php }?> 
            ]
          }, 
      <?php }?>
  ]

});

});

//-----------------------------------------------------------------------------------------------------------------------------

 $(function () {
    $('#ChartRecursosSMS').highcharts({
        title: {
            text: "Grafica de SMS",
            x: -20 //center
        },
        subtitle: {
            text: '',
            x: -20
        },
        xAxis: {
            categories: [
            <?php  foreach($calendar_day as $dia){?> 
                    
             <?php echo "'".$dia['Dia']."'," ?>
               
             <?php }?> 
                ]
        },
        yAxis: {
            title: {
                text: 'Total'
            },
            plotLines: [{
                value: 0,
                width: 1,
                color: '#808080'
            }]
        },
        tooltip: {
        },
        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'middle',
            borderWidth: 0
        },
        series: [
     <?php foreach ($arrayUniqueCarteras as $item){?>
    {
       name: <?php echo "'".$item['Cartera']."'" ?>, //  linea por cartera
       data: [
            <?php  foreach($calendar_day as $dia){ ?>
            <?php if (isset($arrayTblGestCarteraFechaSMS[$item['Cartera']][$dia['Dia']]['Sms'])){?> 
            <?php  //print_r($arrayTblGestCarteraFecha[$item['Cartera']][$item['fecha_gestion']]);?>
            <?php echo $arrayTblGestCarteraFechaSMS[$item['Cartera']][$dia['Dia']]['Sms'].","; ?>
        
             <?php if ($dia['Dia'] == date('Y-m-d')) {
              //echo '<pre>';
              //print_r($dia['Dia']);
              //echo '</pre>';
              break;} ?>
             <?php }else {echo "0,";} ?> 
              <?php }?> 
            ]
          }, 
      <?php }?>
  ]

});

});


//-----------------------------------------------------------------------------------------------------------------------------

 $(function () {
    $('#ChartRecursosHTML').highcharts({
        title: {
            text: '<?php echo $mes; ?>',
            x: -20 //center
        },
        subtitle: {
            text: '',
            x: -20
        },
        xAxis: {
            categories: [
            <?php  foreach($calendar_day as $dia){?> 
                    
             <?php echo "'".$dia['Dia']."'," ?>
               
             <?php }?> 
                ]
        },
        yAxis: {
            title: {
                text: 'Total'
            },
            plotLines: [{
                value: 0,
                width: 1,
                color: '#808080'
            }]
        },
        tooltip: {
        },
        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'middle',
            borderWidth: 0
        },
        series: [
     <?php foreach ($arrayUniqueCarteras as $item){?>
    {
       name: <?php echo "'".$item['Cartera']."'" ?>, //  linea por cartera
       data: [
            <?php  foreach($calendar_day as $dia){ ?>
            <?php if (isset($arrayTblGestCarteraFechaHTML[$item['Cartera']][$dia['Dia']]['Sms'])){?> 
            <?php  //print_r($arrayTblGestCarteraFecha[$item['Cartera']][$item['fecha_gestion']]);?>
            <?php echo $arrayTblGestCarteraFechaHTML[$item['Cartera']][$dia['Dia']]['Sms'].","; ?>
        
             <?php if ($dia['Dia'] == date('Y-m-d')) {
              //echo '<pre>';
              //print_r($dia['Dia']);
              //echo '</pre>';
              break;} ?>
             <?php }else {echo "0,";} ?> 
              <?php }?> 
            ]
          }, 
      <?php }?>
  ]

});

});




</script>




<!--
Pasos para usar AJAX en los reportes de HT 
1 Importar Gestiones HT
2 Exportar Resultados HT
3 Crear CSV Consulta HT
4 Invocar CSV con AJAX
5 Adaptar Codigo para uso de AJAX
-->
