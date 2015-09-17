<?php

include_once '../modelo/modeloSeguimiento.php';

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
$param['idempresa']=$_SESSION['idempresa'];
$param['param_opcion']='';


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

$Seguimiento=new ModeloSeguimiento();
echo $Seguimiento->gestionar($param);
?>
