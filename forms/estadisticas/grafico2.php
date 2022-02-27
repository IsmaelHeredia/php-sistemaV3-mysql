<?php  

while (! file_exists("functions") ) {
    chdir("..");
}

include_once("functions/Conexion.php");
include_once("functions/Helper.php");

$helper = new Helper();

$helper->verificar_usuario_logeado();

?>

<div class="card card-primary contenedor">
<div class="card-header bg-primary">Gráfico 2</div>
  <div class="card-body">

<?php

$conexion = new Conexion();
$conexion->abrir_conexion();
$conn = $conexion->retornar_conexion();

$sql = $conn->prepare('SELECT prov.nombre AS nombre,count(prod.id_proveedor) AS cantidad FROM productos prod,proveedores prov WHERE prod.id_proveedor=prov.id GROUP BY prov.nombre');
$sql->execute();

$resultado = $sql->fetchAll();

$titulo    = "Reporte de cantidad de productos por proveedores";

$ids        = array();
$textos       = array();
$datos = array();

foreach ($resultado as $fila) {
    $nombre = $fila['nombre'];
    $cantidad = $fila['cantidad'];
    array_push($textos,$nombre);
    array_push($datos,$cantidad);
}

$nombres = array();
$series  = array();

for ($i = 0; $i <= count($textos) - 1; $i++) {
    
    $nombre = $textos[$i];
    $valor  = $datos[$i];
    $serie  = array(
        'name' => $nombre,
        'y' => (int) $valor
    );
    array_push($nombres, $nombre);
    array_push($series, $serie);
}

$conexion->cerrar_conexion();
                     
?> 

<script type="text/javascript">
$(function () {
    $('#grafico2').highcharts({
        chart: {
            type: 'bar'
        },
        title: {
            text: '<?php echo $titulo; ?>'
        },
        xAxis: {
            categories: <?php echo json_encode($nombres); ?>,
            title: {
            text: 'Empresas'
            }
        },
                
        yAxis: {
            min: 0,
            title: {
                text: 'Productos',
                align: 'high'
            },
            labels: {
                overflow: 'justify'
            }
        },
        tooltip: {
        useHTML: true,
        formatter: function() {
            return 'Cantidad de productos : '+this.point.y;
        }},
        plotOptions: {
        
        series: {
            dataLabels:{
                //enabled:true,
            },events: {
                legendItemClick: function () {
                        return false; 
                }
            }
        }
          },
        legend: {
            reversed: true
        },
        credits: {
            enabled: false
        },
        series: [{
        name:'Productos',
        data: <?php
            echo json_encode($series);
?>
 }]
    });
});
</script>    

<div id="grafico2" style="width: 800px; height: 400px;"></div>

</div>
</div>