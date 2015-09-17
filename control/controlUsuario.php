<?php

include_once '../modelo/modeloUsuario.php';

$param = array();

$param['name']='';
$param['user']='';
$param['password']='';
$param['empresa']='';
$param['ruc']='';
$param['direccion']='';
$param['param_opcion']='';


if (isset($_POST['param_opcion']))
    $param['param_opcion'] = $_POST['param_opcion'];
if (isset($_POST['name']))
    $param['name'] = $_POST['name'];
if (isset($_POST['user']))
    $param['user'] = $_POST['user'];
if (isset($_POST['password']))
    $param['password'] = $_POST['password'];
if (isset($_POST['empresa']))
    $param['empresa'] = $_POST['empresa'];
if (isset($_POST['ruc']))
    $param['ruc'] = $_POST['ruc'];
if (isset($_POST['direccion']))
    $param['direccion'] = $_POST['direccion'];

$Usuario=new ModeloUsuario();
echo $Usuario->gestionar($param);
?>
