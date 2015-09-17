<?php
include_once 'modeloConexion.php';

class ModeloProcesos{

    private $param = array();
    private $conexion = null;
    private $result = null;

    function __construct() {
        $this->conexion = Conexion_Model::getConexion();
    }
    function cerrarAbrir()
    {
        mysql_close($this->conexion);
        $this->conexion = Conexion_Model::getConexion();
    }
    function gestionar($param,$procesos,$relaciones,$datos) {
        $this->param = $param;
        switch ($this->param['param_opcion']) {
            
            case "grabar":
                echo $this->grabar($param,$procesos,$relaciones);
                break;
             case "Cargar":
                echo $this->Cargar($param,$datos);
                break;      
        }
    }
    function grabar($param,$procesos,$relaciones) {
        
        $idempresa=$this->param['idempresa'];
    	
        $this->cerrarAbrir();
        $consultaSql="SELECT idapoyo from apoyo where idempresa='$idempresa' ";
        $this->result = mysql_query($consultaSql);
        if(mysql_num_rows($this->result)!=0){
            $this->cerrarAbrir();
            $consultaSql="DELETE FROM apoyo where idempresa='$idempresa' ";
            $this->result = mysql_query($consultaSql);
        }
        $this->cerrarAbrir();
        $consultaSql="SELECT idestrategico from estrategico where idempresa='$idempresa' ";
        $this->result = mysql_query($consultaSql);
        if(mysql_num_rows($this->result)!=0){
            $this->cerrarAbrir();
            $consultaSql="DELETE FROM estrategico where idempresa='$idempresa' ";
            $this->result = mysql_query($consultaSql);
        }
        $this->cerrarAbrir();
        $consultaSql="SELECT idprimarios from primarios where idempresa='$idempresa' ";
        $this->result = mysql_query($consultaSql);
        if(mysql_num_rows($this->result)!=0){
            $this->cerrarAbrir();
            $consultaSql="DELETE FROM primarios where idempresa='$idempresa' ";
            $this->result = mysql_query($consultaSql);
        }
        $this->cerrarAbrir();
        $consultaSql="SELECT idrelacion from relacion where idempresa='$idempresa' ";
        $this->result = mysql_query($consultaSql);
        if(mysql_num_rows($this->result)!=0){
            $this->cerrarAbrir();
            $consultaSql="DELETE FROM relacion where idempresa='$idempresa' ";
            $this->result = mysql_query($consultaSql);
        }
        $this->cerrarAbrir();
        $consultaSql="SELECT idmacro from macroprocesos where idempresa='$idempresa' ";
        $this->result = mysql_query($consultaSql);
        if(mysql_num_rows($this->result)!=0){
            $this->cerrarAbrir();
            $consultaSql="DELETE FROM macroprocesos where idempresa='$idempresa' ";
            $this->result = mysql_query($consultaSql);
        }
        
        foreach ($procesos as $obj ) {

            $key =$obj->key;
            $category =$obj->category;
            if ($category!="MacroProceso") {
                $loc =$obj->loc;
            }
            if ($obj->group!=null) {
                $group =$obj->group ;
            }else{
               $group = 0; 
            }
                
            $text =$obj->text;

            if($category=="Apoyo"){
                $this->cerrarAbrir();
                $consultaSql="INSERT INTO `apoyo`(`key`, `category`, `loc`, `text`, `group`, `idempresa`) VALUES ('$key','$category','$loc','$text','$group','$idempresa')";
                $this->result = mysql_query($consultaSql);
            }elseif($category=="Primario"){
                $this->cerrarAbrir();
                $consultaSql="INSERT INTO `primarios`(`key`, `category`, `loc`, `text`,`group`, `idempresa`) VALUES ('$key','$category','$loc','$text','$group','$idempresa')";
                $this->result = mysql_query($consultaSql);
            }elseif($category=="MacroProceso"){
                $this->cerrarAbrir();
                $consultaSql="INSERT INTO `macroprocesos`(`key`, `category`, `text`, `idempresa`) VALUES ('$key','$category','$text','$idempresa')";
                $this->result = mysql_query($consultaSql);
            }else
            {
                $this->cerrarAbrir();
                $consultaSql="INSERT INTO `estrategico`(`key`, `category`, `loc`, `text`,`group`,`idempresa`) VALUES ('$key','$category','$loc','$text','$group','$idempresa')";
                $this->result = mysql_query($consultaSql);
            } 
        }
        foreach ( $relaciones as $obj ) {
            $from=$obj->from;
            $to =$obj->to;
            $fromPort =$obj->fromPort;
            $toPort =$obj->toPort;
            $points =$obj->points;
            $this->cerrarAbrir();
            $consultaSql="INSERT INTO `relacion`(`from`, `to`, `fromPort`, `toPort`, `points`, `idempresa`) VALUES ('$from','$to','$fromPort','$toPort','','$idempresa')";
            $this->result = mysql_query($consultaSql);

        }
        //header("Location:../index.php");
    }

    function Cargar($param,$datos){

        $idempresa=$this->param['idempresa'];

        $datos= json_decode($_POST['mySavedModel']);
        $proceso=$datos->{'nodeDataArray'};
        $relaciones=$datos->{'linkDataArray'};
        $procesosData=array();
        $relacionesData=array();

        $this->cerrarAbrir();
        $consultaSql="SELECT `key`, `category`, `loc`, `text`,`group`, `idempresa` from estrategico where idempresa='$idempresa' union
                        SELECT `key`, `category`,NULL , `text`,NULL , `idempresa` from macroprocesos where idempresa='$idempresa' union
                        SELECT `key`, `category`, `loc`, `text`,`group`, `idempresa` from apoyo where idempresa='$idempresa' union
                        SELECT `key`, `category`, `loc`, `text`,`group`, `idempresa` from primarios where idempresa='$idempresa' ";
        $this->result = mysql_query($consultaSql);
        $total=mysql_num_rows($this->result);
        if($this->result){
            while($row=mysql_fetch_row($this->result)){

                $objeto= new stdClass();
                $objeto->key=$row[0];
                $objeto->category=$row[1];
                if ($row[2]!=null) {
                    $objeto->loc=$row[2];
                }
                if ($row[4]==null) {
                    $objeto->isGroup=true;
                }else{
                    $objeto->group=$row[4];
                }
                $objeto->text=$row[3];  
                $procesosData[]=$objeto;     
            }
            $datos->{'nodeDataArray'}=$procesosData;
        }

        $this->cerrarAbrir();
        $consultaSql="SELECT `from`, `to`, `fromPort`, `toPort`, `idempresa` from relacion where idempresa='$idempresa' ";
        $this->result = mysql_query($consultaSql);
        if($this->result){
            while($row=mysql_fetch_row($this->result)){

                $objeto= new stdClass();
                $objeto->from=$row[0];
                $objeto->to=$row[1];
                $objeto->fromPort=$row[2];
                $objeto->toPort=$row[3];
                $points=array();
                $objeto->points=$points;

                $relacionesData[]=$objeto;     
            }
            $datos->{'linkDataArray'}=$relacionesData;
        }
        if($total==0){
            echo 'Error';
        }else{
            echo json_encode($datos);
        }
        
    }
    
}

?>