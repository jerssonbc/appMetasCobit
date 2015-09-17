<?php

include_once '../modelo/modeloCascada.php';

$param = array();
session_start();


$param['idempresa']=$_SESSION['idempresa'];
$param['param_opcion']='';


if (isset($_POST['param_opcion']))
    $param['param_opcion'] = $_POST['param_opcion'];





$Cascada=new ModeloCascada();
echo $Cascada->gestionar($param);
?>
