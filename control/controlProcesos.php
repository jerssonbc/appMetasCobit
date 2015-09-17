<?php
session_start();
include_once '../modelo/modeloProcesos.php';

$param = array();

$param['mySavedModel']='';
$param['param_opcion']='';
$param['idempresa']=$_SESSION['idempresa'];
$datos=array();
$procesos=array();
$relaciones=array();
$key=array();
$category=array();
$loc=array();
$category=array();


if (isset($_POST['param_opcion']))
    $param['param_opcion'] = $_POST['param_opcion'];
if (isset($_POST['mySavedModel'])){
	$datos= json_decode($_POST['mySavedModel']);
	$proceso=$datos->{'nodeDataArray'};
	$relaciones=$datos->{'linkDataArray'};
	//var_dump($datos);
	/*foreach ( $procesos as $obj ) {
        $key[] =$obj->key ;
        $category[] =$obj->category ;
        $loc[] =$obj->loc ;
        $text[] =$obj->text ;
	}
	foreach ( $relaciones as $obj ) {
        $from[] =$obj->from ;
        $to[] =$obj->to ;
        $fromPort[] =$obj->fromPort ;
        $toPort[] =$obj->toPort ;
        $points[] =$obj->points ;
	}*/

}
$procesos=new ModeloProcesos();
if(isset($_POST['Guardar'])) 
{
	$param['param_opcion']='grabar'; 
    echo $procesos->gestionar($param,$proceso,$relaciones,$datos);
} 
else if(isset($_POST['Cargar'])) 
{
	$param['param_opcion']='Cargar'; 
  	echo $procesos->gestionar($param,$proceso,$relaciones,$datos);
}  

?>


