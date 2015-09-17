<?php
include_once 'modeloConexion.php';

class ModeloCascada{

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
            
            
            case "cambiarRelacion":
                echo $this->cambiarRelacion();
                break;
            case "listarCascada":
                echo $this->listarCascada();
                break;
                
        }
    }
    

    function cambiarRelacion(){


        //$this->listarTabla1();
        $descripcion=$this->param['descripcion'];
        $dimension=$this->param['dimension'];
        $idempresa=$this->param['idempresa'];

        
        $this->cerrarAbrir();
        $consultaSql="INSERT INTO `objetivoti`(`idEmpresa`, `nombre`, `iddimension`) VALUES ('$idempresa','$descripcion','$dimension')";
        $this->result = mysql_query($consultaSql);

        if ($this->result) {
            # code...
            

                $this->listarCascada();
                    
            


        }else{echo "error";}


    }
    function listarCascada(){

        $idempresa=$this->param['idempresa'];

        
    
               echo' <thead>
                      <tr>
                      <th ><div><span>________________________</span></div></th>';
                        
                        
                        
                        
                     
        

        


                # code...
                $this->cerrarAbrir();
                $consultaSql="SELECT oti.idObjetivo,oti.nombre,d.nombre FROM objetivoti oti inner join dimensiones d on oti.iddimension=d.iddimension WHERE idEmpresa='$idempresa' ";
                $this->result = mysql_query($consultaSql);
                if($this->result){
                                
                    $contTI=1;
                    while($row=mysql_fetch_row($this->result)){
                            echo '<th class="rotate-45"><div><span>'.$row[1].'</span></div></th>';
                        $contTI++;
                    }


                }
                 echo'</tr>
                    </thead>';

                # code...
                $this->cerrarAbrir();
                $consultaSql="SELECT oti.idObjetivo,oti.nombre,d.nombre FROM objetivoti oti inner join dimensiones d on oti.iddimension=d.iddimension WHERE idEmpresa='$idempresa' ";
                $this->result = mysql_query($consultaSql);
                if($this->result){
                                
                    $cont=1;
                    while($row=mysql_fetch_row($this->result)){
                        echo'<tr>
                                            
                                            
                                            
                                            <td>'.$row[1].'</td>';
                                            for ($i=1; $i < $contTI; $i++) { 
                                                # code...
                                                echo '<td>P</td>';
                                            }
                                            echo '
                                            
                                            
                                            
                                        </tr>';
                        $cont++;
                    }


                }
         

    }

  
    

    
}

?>