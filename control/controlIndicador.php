<?php

include_once '../modelo/modeloIndicador.php';

$param = array();
session_start();
$param['tipoProceso']='';
$param['proceso']='';
$param['actividad']='';
$param['flujo']='';
$param['rol']='';
$param['tiempo']='';
$param['idActividad']='';
$param['columna']='';
$param['indicador']='';
$param['idempresa']=$_SESSION['idempresa'];
$param['param_opcion']='';

$param['responsable']='';
$param['objetivo']='';
$param['Nindicador']='';
$param['lineaBase']='';
$param['valorMeta']='';
$param['frecuencia']='';
$param['rojo']='';
$param['amarillo']='';
$param['verde']='';

$param['codigo']='';
$param['unidad']='';

$param['anio']='';
$param['mes']='';


if (isset($_POST['param_opcion']))
    $param['param_opcion'] = $_POST['param_opcion'];

if (isset($_POST['tipoProceso']))
    $param['tipoProceso'] = $_POST['tipoProceso'];
if (isset($_POST['actividad']))
    $param['actividad'] = $_POST['actividad'];
if (isset($_POST['columna']))
    $param['columna'] = $_POST['columna'];
if (isset($_POST['rol']))
    $param['rol'] = $_POST['rol'];
if (isset($_POST['tiempo']))
    $param['tiempo'] = $_POST['tiempo'];
if (isset($_POST['idActividad']))
    $param['idActividad'] = $_POST['idActividad'];
if (isset($_POST['flujo']))
    $param['flujo'] = $_POST['flujo'];
if (isset($_POST['proceso']))
    $param['proceso'] = $_POST['proceso'];
if (isset($_POST['indicador']))
    $param['indicador'] = $_POST['indicador'];

if (isset($_POST['responsable']))
    $param['responsable'] = $_POST['responsable'];
if (isset($_POST['objetivo']))
    $param['objetivo'] = $_POST['objetivo'];
if (isset($_POST['Nindicador']))
    $param['Nindicador'] = $_POST['Nindicador'];
if (isset($_POST['lineaBase']))
    $param['lineaBase'] = $_POST['lineaBase'];
if (isset($_POST['valorMeta']))
    $param['valorMeta'] = $_POST['valorMeta'];
if (isset($_POST['frecuencia']))
    $param['frecuencia'] = $_POST['frecuencia'];
if (isset($_POST['rojo']))
    $param['rojo'] = $_POST['rojo'];
if (isset($_POST['amarillo']))
    $param['amarillo'] = $_POST['amarillo'];
if (isset($_POST['verde']))
    $param['verde'] = $_POST['verde'];

if (isset($_POST['codigo']))
    $param['codigo'] = $_POST['codigo'];
if (isset($_POST['unidad']))
    $param['unidad'] = $_POST['unidad'];

if (isset($_POST['anio']))
    $param['anio'] = $_POST['anio'];
if (isset($_POST['mes']))
    $param['mes'] = $_POST['mes'];


$Indicador=new ModeloIndicador();
echo $Indicador->gestionar($param);
?>
