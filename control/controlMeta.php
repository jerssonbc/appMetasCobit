<?php

include_once '../modelo/modeloMeta.php';

$param = array();
session_start();
$param['descripcion']='';
$param['dimension']='';

$param['idempresa']=$_SESSION['idempresa'];
$param['param_opcion']='';


if (isset($_POST['param_opcion']))
    $param['param_opcion'] = $_POST['param_opcion'];


if (isset($_POST['descripcion']))
    $param['descripcion'] = $_POST['descripcion'];
if (isset($_POST['dimension']))
    $param['dimension'] = $_POST['dimension'];


$Seguimiento=new ModeloSeguimiento();
echo $Seguimiento->gestionar($param);
?>
