<?php
include_once 'modeloConexion.php';

class ModeloUsuario{

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
    function gestionar($param) {
        $this->param = $param;
        switch ($this->param['param_opcion']) {
            
            case "grabar":
                echo $this->grabar();
                break;
             case "entrar":
                echo $this->entrar();
                break;      
        }
    }
    function grabar() {
    	$this->cerrarAbrir();
    	$User=$this->param['user'];
    	$password=$this->param['password'];
        $passwordmd5=md5($password);
    	$empresa=$this->param['empresa'];
    	$ruc=$this->param['ruc'];
    	$direccion=$this->param['direccion'];
    	$consultaSql="INSERT INTO `usuario`( `usu_nick`, `usu_clave`, `usu_estado`) VALUES ('$User','$passwordmd5',1)";
    	$this->result = mysql_query($consultaSql);
    	$rs = mysql_query("SELECT @@identity AS idUsuario");
    	if ($row = mysql_fetch_row($rs)) {
			$idUsuario = trim($row[0]);
		}
        if($this->result){
        	$this->cerrarAbrir();
        	$consultaSql="INSERT INTO `empresa`( `nombre`, `ruc`, `direccion`, `idUsuario`) VALUES ('$empresa','$ruc','$direccion','$idUsuario')";
    		$this->result = mysql_query($consultaSql);
    		if($this->result){
    			header("Location:../vista/login.php");
    		}else{
    			header("Location:../vista/register.php");
    		}
        	
        }else
        {
        	header("Location:../vista/register.php");
        }
    }
    function entrar()
    {
    	$this->cerrarAbrir();
    	$User=$this->param['user'];
    	$password=$this->param['password'];
        $passwordmd5=md5($password);
    	$consultaSql="SELECT u.idUsuario,e.idempresa,e.nombre,u.usu_nick FROM usuario u inner join empresa e on e.idUsuario=u.idUsuario where u.usu_nick='$User' and u.usu_clave='$passwordmd5' ";
    	$this->result = mysql_query($consultaSql);
    	echo mysql_num_rows($this->result);
    	if(mysql_num_rows($this->result)==1){
    		session_start();
    		$row=mysql_fetch_row($this->result);
    		$_SESSION['idUsuario'] = $row[0];
            $_SESSION['idempresa'] = $row[1];
            $_SESSION['nombre'] = $row[2];
            $_SESSION['user'] = $row[3];
            header("Location:../index.php");
    	}else{
    		header("Location:../vista/login.php");
    	}
    }

    
}

?>