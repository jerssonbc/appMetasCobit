<?php
include_once 'modeloConexion.php';

class ModeloSeguimiento{

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
            
            
            case "agregarObjetivo":
                echo $this->agregarObjetivo();
                break;
            case "listarTablaObjetivos":
                echo $this->listarTablaObjetivos();
                break;
                
        }
    }
    

    function agregarObjetivo(){


        //$this->listarTabla1();
        $descripcion=$this->param['descripcion'];
        $dimension=$this->param['dimension'];
        $idempresa=$this->param['idempresa'];

        
        $this->cerrarAbrir();
        $consultaSql="INSERT INTO `objetivocorporativo`(`idEmpresa`, `nombre`, `iddimension`) VALUES ('$idempresa','$descripcion','$dimension')";
        $this->result = mysql_query($consultaSql);

        if ($this->result) {
            # code...
            

                $this->listarTablaObjetivos();
                    
            


        }else{echo "error";}


    }
    function listarTablaObjetivos(){

        $idempresa=$this->param['idempresa'];

        
    

        echo '<div class="box-header">
                  <h3 class="box-title">Metas Corporativas en Cascada hacia Metas TI</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="tablaMetasz" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>Nro</th>
                        <th>Objetivos de las TI COBIT</th>
                        <th>Dimensión del CMI</th>
                        <th>Opciones</th>
                      </tr>
                    </thead>
                    <tbody>';


        


                # code...
                $this->cerrarAbrir();
                $consultaSql="SELECT oti.idObjetivocorporativo,oti.nombre,d.nombre FROM objetivocorporativo oti inner join dimensiones d on oti.iddimension=d.iddimension WHERE idEmpresa='$idempresa' ";
                $this->result = mysql_query($consultaSql);
                if($this->result){
                                
                    $cont=1;
                    while($row=mysql_fetch_row($this->result)){
                        echo'<tr>
                                            
                                            
                                            <td>'.$cont.'</td>
                                            <td>'.$row[1].'</td>
                                            <td>'.$row[2].'</td>
                                            <td><button class="btn btn-primary" data-toggle="modal" data-target="#compose-modal" onClick="cargarEditar('.$row[0].');"><icon class="glyphicon glyphicon-pencil"></button></td>
                                            
                                        </tr>';
                        $cont++;
                    }


                }
        


        
            echo    '</tbody>
                                        
                                    </table>
                                    ';

        echo '<script src="../plugins/datatables/jquery.dataTables.min.js"></script>
            <script src="../plugins/datatables/dataTables.bootstrap.min.js"></script>

                  ';
            echo "<script>
      $(function () {
        $('#tablaMetasz').DataTable();
        $('#example2').DataTable({
          'paging': true,
          'lengthChange': false,
          'searching': false,
          'ordering': true,
          'info': true,
          'autoWidth': false
        });
      });
    </script>"; 

    }

  
    

    
}

?>