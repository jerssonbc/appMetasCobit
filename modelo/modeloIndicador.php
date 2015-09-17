<?php
include_once 'modeloConexion.php';

class ModeloIndicador{

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
            
            case "listarTipoProceso":
                echo $this->listarTipoProceso();
                break;  
            case "listarTablaIndicadores":
                echo $this->listarTablaIndicadores();
                break;
            case "tablaComandos":
                echo $this->tablaComandos();
                break;
            case "EdittablaComandos":
                echo $this->EdittablaComandos();
                break;
            case "EditartablaComandos":
                echo $this->EditartablaComandos();
                break;
            case "AgregarIndicador":
                echo $this->AgregarIndicador();
                break;
            case "cargarGraficos":
                echo $this->cargarGraficos();
                break;   
            case "cargarGraficaCalidad1":
                echo $this->cargarGraficaCalidad1();
                break;
                case "cargarGraficaProduccion1":
                echo $this->cargarGraficaProduccion1();
                break;
            case "SemaforoCalidad1":
                echo $this->SemaforoCalidad1();
                break; 
            case "cargarGraficaFinanciero1" :
                echo $this->cargarGraficaFinanciero1();
                break;

            case "SemaforoFinanciero1":
                echo $thi->SemaforoFinanciero1();
                break;

        }
    }
    
    function listarTipoProceso(){

        $idempresa=$this->param['idempresa'];
        $tipoProceso=$this->param['tipoProceso'];
        $this->cerrarAbrir();
        if ($tipoProceso==1) {
            
            $consultaSql="SELECT idestrategico,text from estrategico where category='Estrategicos' and  idempresa='$idempresa' ";
        }elseif ($tipoProceso==2) {
            
            $consultaSql="SELECT idprimarios,text from primarios where  idempresa='$idempresa' ";
        }elseif ($tipoProceso==3) {
            
            $consultaSql="SELECT idapoyo,text from apoyo where  idempresa='$idempresa' ";
        }

        $this->result = mysql_query($consultaSql);
        echo '<label>PROCESO</label>
                <select class="form-control" id="procesos" onchange="listarTablaIndicadores();" >';
        if($this->result){
            while($row=mysql_fetch_row($this->result)){
                echo '<option value="'.$row[0].'" >'.$row[1].'</option>';
                //echo '<option value="'.$row[0].'" onClick="listarTabla1('.$row[0].','.$tipoProceso.');">'.$row[1].'</option>';
        }
        echo '<select>';
        
               

        }
    }
    function listarTablaIndicadores(){
        $proceso=$this->param['proceso'];
        $tipoProceso=$this->param['tipoProceso'];

        $this->cerrarAbrir();
        if ($tipoProceso==1) {
            
            $consultaSql="SELECT i.id,a.text,i.codigo,i.nombre,i.unidad,i.responsable FROM indicador i inner join estrategico a on i.proceso_id=a.idestrategico WHERE proceso_id='$proceso' ";
        }elseif ($tipoProceso==2) {
            
            $consultaSql="SELECT i.id,a.text,i.codigo,i.nombre,i.unidad,i.responsable FROM indicador i inner join primarios a on i.proceso_id=a.idPrimarios WHERE proceso_id='$proceso' ";
        }elseif ($tipoProceso==3) {
            
            $consultaSql="SELECT i.id,a.text,i.codigo,i.nombre,i.unidad,i.responsable FROM indicador i inner join apoyo a on i.proceso_id=a.idapoyo WHERE proceso_id='$proceso' ";
        }
            $this->result = mysql_query($consultaSql);
            if($this->result){
                $cont=1;
                while($row=mysql_fetch_row($this->result)){
                    echo '<tr>  
                        <td>'.$cont.'</td>
                        <td>'.$row[1].'</td>
                        <td>'.$row[2].'</td>
                        <td>'.$row[3].'</td>
                        <td>'.$row[4].'</td>
                        <td>'.$row[5].'</td>
                        <td><a class = "btn btn-info" onClick="cargarDetalleIndicador('.$row[0].','."'$row[1]'".');">Ver</a></td>
                  </tr>';
                  $cont++;

                }
            }

    }
    function agregarIndicador(){
        $responsable=$this->param['responsable'];
        $Nindicador=$this->param['Nindicador'];
        $unidad=$this->param['unidad'];
        $codigo=$this->param['codigo'];
        $proceso=$this->param['proceso'];
        $tipoProceso=$this->param['tipoProceso'];
        $fecha_created=date("Y-m-d");

        
        $this->cerrarAbrir();
            $consultaSql="INSERT INTO `indicador`(`nombre`, `codigo`, `unidad`, `responsable`, `formula`, `proceso_id`, `created_at`) VALUES ('$Nindicador','$codigo','$unidad','$responsable','$codigo','$proceso','$fecha_created') ";
            $this->result = mysql_query($consultaSql);
            if($this->result){

               echo 'Agregado Correcto!';
            }else{
                echo $consultaSql;
            }

    }
    function listarTablaComandos(){
        $proceso=$this->param['proceso'];
        $tipoProceso=$this->param['tipoProceso'];

        $this->cerrarAbrir();
        if ($tipoProceso==1) {
            
            $consultaSql="SELECT i.id,a.text,i.codigo,i.nombre,i.unidad,i.responsable FROM indicador i inner join estrategico a on i.proceso_id=a.idestrategico WHERE proceso_id='$proceso' ";
        }elseif ($tipoProceso==2) {
            
            $consultaSql="SELECT i.id,a.text,i.codigo,i.nombre,i.unidad,i.responsable FROM indicador i inner join primarios a on i.proceso_id=a.idPrimarios WHERE proceso_id='$proceso' ";
        }elseif ($tipoProceso==3) {
            
            $consultaSql="SELECT i.id,a.text,i.codigo,i.nombre,i.unidad,i.responsable FROM indicador i inner join apoyo a on i.proceso_id=a.idapoyo WHERE proceso_id='$proceso' ";
        }
            $this->result = mysql_query($consultaSql);
            if($this->result){
                $cont=1;
                while($row=mysql_fetch_row($this->result)){
                    echo '<tr>  
                        <td>'.$cont.'</td>
                        <td>'.$row[1].'</td>
                        <td>'.$row[2].'</td>
                        <td>'.$row[3].'</td>
                        <td>'.$row[4].'</td>
                        <td>'.$row[5].'</td>
                        <td><a class = "btn btn-info" onClick="cargarDetalleIndicador('.$row[0].','."'$row[1]'".');">Ver</a></td>
                  </tr>';
                  $cont++;

                }
            }

    }
    function tablaComandos(){

        $proceso=$this->param['proceso'];
        $tipoProceso=$this->param['tipoProceso'];
        $indicador=$this->param['indicador'];

        

        $this->cerrarAbrir();
        if ($tipoProceso==1) {
            
            $consultaSql="SELECT i.id,a.text,i.responsable,i.objetivo,i.nombre,i.formula,i.lineaBase,i.valorMeta,i.Frecuencia,i.rojo,i.amarillo,i.verde FROM indicador i inner join estrategico a on i.proceso_id=a.idestrategico WHERE i.id='$indicador' ";
        }elseif ($tipoProceso==2) {
            
            $consultaSql="SELECT i.id,a.text,i.responsable,i.objetivo,i.nombre,i.formula,i.lineaBase,i.valorMeta,i.Frecuencia,i.rojo,i.amarillo,i.verde FROM indicador i inner join primarios a on i.proceso_id=a.idPrimarios WHERE i.id='$indicador' ";
        }elseif ($tipoProceso==3) {
            
            $consultaSql="SELECT i.id,a.text,i.responsable,i.objetivo,i.nombre,i.formula,i.lineaBase,i.valorMeta,i.Frecuencia,i.rojo,i.amarillo,i.verde FROM indicador i inner join apoyo a on i.proceso_id=a.idapoyo WHERE i.id='$indicador' ";
        }
            $this->result = mysql_query($consultaSql);
            if($this->result){
                $cont=1;
                while($row=mysql_fetch_row($this->result)){
                    echo'<table class="table table-bordered" >
                                                                    
                <tr>
                        <th  style="width: 10px;background-color:#81d4fa;">PROCESO</th>
                        <td colspan="3"  style="width: 40px">'.$row[1].'</td>
                        <th  style="width: 40px;background-color:#81d4fa;">RESPONSABLE</th>    
                        <td colspan="4" style="width: 40px">'.$row[2].'</td>
                                                                
                </tr>
                <tr>
                        <th style="width: 40px;background-color:#81d4fa;">OBJETIVO</th>
                        <td colspan="8" style="width: 40px">'.$row[3].'</td>
                        
                                                                
                </tr>                                                
                <tr>
                        <th rowspan="2" style="width: 10px;background-color:#81d4fa;">INDICADOR</th>
                        <th rowspan="2" style="width: 40px;background-color:#81d4fa;">FORMULA</th>
                        <th rowspan="2" style="width: 40px;background-color:#81d4fa;">LINEA BASE</th>
                        <th rowspan="2" style="width: 40px;background-color:#81d4fa;">VALOR META</th>
                        <th rowspan="2" style="width: 40px;background-color:#81d4fa;">FRECUENCIA DE MEDICION</th>
                        <th colspan="3" style="width: 40px;background-color:#81d4fa;">SEMAFORO</th>
                        <th rowspan="2"  style="width: 40px;background-color:#81d4fa;">Acción</th>
                                                                
                </tr>
                <tr>
                                                                            
                        <th style="width: 40px;background-color:#ef5350;">ROJO</th>
                        <th style="width: 40px;background-color:#ffc107;">AMARILLO</th>
                        <th style="width: 40px;background-color:#4caf50;">VERDE</th>
                                                                
                </tr>
                <tbody>';
                    echo'<tr>  
                            <td>'.$row[4].'</td>
                            <td><img id="Imagen" src="../img/formulas/'.$row[5].'.png"></td>
                            <td>'.$row[6].'</td>
                            <td>'.$row[7].'</td>
                            <td>'.$row[8].'</td>
                            <td>'.$row[9].'</td>
                            <td>'.$row[10].'</td>
                            <td>'.$row[11].'</td>
                            <td><a class = "btn btn-info" onClick="cargarDetalleIndicador();">Ver</a></td>
                </tr> ';
                }
            }    
                

                echo'
                                                                        
                </tbody>
            </table>
        ';

    }
    function EdittablaComandos(){
        $proceso=$this->param['proceso'];
        $tipoProceso=$this->param['tipoProceso'];
        $indicador=$this->param['indicador'];

        

        $this->cerrarAbrir();
        if ($tipoProceso==1) {
            
            $consultaSql="SELECT i.id,a.text,i.responsable,i.objetivo,i.nombre,i.formula,i.lineaBase,i.valorMeta,i.Frecuencia,i.rojo,i.amarillo,i.verde FROM indicador i inner join estrategico a on i.proceso_id=a.idestrategico WHERE i.id='$indicador' ";
        }elseif ($tipoProceso==2) {
            
            $consultaSql="SELECT i.id,a.text,i.responsable,i.objetivo,i.nombre,i.formula,i.lineaBase,i.valorMeta,i.Frecuencia,i.rojo,i.amarillo,i.verde FROM indicador i inner join primarios a on i.proceso_id=a.idPrimarios WHERE i.id='$indicador' ";
        }elseif ($tipoProceso==3) {
            
            $consultaSql="SELECT i.id,a.text,i.responsable,i.objetivo,i.nombre,i.formula,i.lineaBase,i.valorMeta,i.Frecuencia,i.rojo,i.amarillo,i.verde FROM indicador i inner join apoyo a on i.proceso_id=a.idapoyo WHERE i.id='$indicador' ";
        }
            $this->result = mysql_query($consultaSql);
            if($this->result){
                $cont=1;
                while($row=mysql_fetch_row($this->result)){
                    echo'<table class="table table-bordered" >
                                                                    
                <tr>
                        <th  style="width: 10px;background-color:#81d4fa;">PROCESO</th>
                        <td colspan="3"  style="width: 40px">'.$row[1].'</td>
                        <th  style="width: 40px;background-color:#81d4fa;">RESPONSABLE</th>    
                        <td colspan="4" style="width: 40px"><input type="text" id="responsable" value="'.$row[2].'"></td>
                                                                
                </tr>
                <tr>
                        <th style="width: 40px;background-color:#81d4fa;">OBJETIVO</th>
                        <td colspan="8" style="width: 40px"><input type="text" id="objetivo" size="90%" value="'.$row[3].'"></td>
                        
                                                                
                </tr>                                                
                <tr>
                        <th rowspan="2" style="width: 10px;background-color:#81d4fa;">INDICADOR</th>
                        <th rowspan="2" style="width: 40px;background-color:#81d4fa;">FORMULA</th>
                        <th rowspan="2" style="width: 40px;background-color:#81d4fa;">LINEA BASE</th>
                        <th rowspan="2" style="width: 40px;background-color:#81d4fa;">VALOR META</th>
                        <th rowspan="2" style="width: 40px;background-color:#81d4fa;">FRECUENCIA DE MEDICION</th>
                        <th colspan="3" style="width: 40px;background-color:#81d4fa;">SEMAFORO</th>
                        <th rowspan="2"  style="width: 40px;background-color:#81d4fa;">Acción</th>
                                                                
                </tr>
                <tr>
                                                                            
                        <th style="width: 40px;background-color:#ef5350;">ROJO</th>
                        <th style="width: 40px;background-color:#ffc107;">AMARILLO</th>
                        <th style="width: 40px;background-color:#4caf50;">VERDE</th>
                                                                
                </tr>
                <tbody>';
                    echo'<tr>  
                            <td><input type="text" id="Nindicador" size="15%" value="'.$row[4].'"></td>
                            <td><img id="Imagen" src="../img/formulas/'.$row[5].'.png"></td>
                            <td><input type="text" id="lineaBase" size="6%" value="'.$row[6].'"></td>
                            <td><input type="text" id="valorMeta" size="8%" value="'.$row[7].'"></td>
                            <td><input type="text" id="frecuencia" size="7%" value="'.$row[8].'"></td>
                            <td><input type="text" id="rojo" size="5%" value="'.$row[9].'"></td>
                            <td><input type="text" id="amarillo" size="5%" value="'.$row[10].'"></td>
                            <td><input type="text" id="verde" size="5%" value="'.$row[11].'"></td>
                            <td><a class = "btn btn-info" onClick="cargarDetalleIndicador();">Ver</a></td>
                </tr> ';
                }
            }    
                

                echo'
                                                                        
                </tbody>
            </table>
            <a class = "btn btn-info" onClick="editarCuadroMando('.$indicador.');">EDITAR</a>
        ';

    }
    function EditartablaComandos(){
        $responsable=$this->param['responsable'];
        $objetivo=$this->param['objetivo'];
        $Nindicador=$this->param['Nindicador'];
        $indicador=$this->param['indicador'];
        $lineaBase=$this->param['lineaBase'];
        $valorMeta=$this->param['valorMeta'];
        $frecuencia=$this->param['frecuencia'];
        $rojo=$this->param['rojo'];
        $amarillo=$this->param['amarillo'];
        $verde=$this->param['verde'];

        $this->cerrarAbrir();
            $consultaSql="UPDATE `indicador` SET `nombre`='$Nindicador',`responsable`='$responsable',`lineaBase`='$lineaBase',`valorMeta`='$valorMeta',`Frecuencia`='$frecuencia',`rojo`='$rojo',`amarillo`='$amarillo',`verde`='$verde',`objetivo`='$objetivo' WHERE id='$indicador' ";
            $this->result = mysql_query($consultaSql);
            if($this->result){

               echo 'Edicion exitosa!';
            }else{
                echo $consultaSql;
            }
            

    }

    function cargarGraficos(){
        $indicador=$this->param['indicador'];
        if($indicador==1){
            $this->indicadorCalidad1();
        }
        if($indicador==4){
            $this->indicadorProduccion1();
        }
        if($indicador==9){
                $this->indicadorFinanciero();
            }



    }
    function indicadorCalidad1(){

        echo'
        <div class="box box-solid">
                                                                    <div class="box-header">
                                                                        <i class="fa fa-bar-chart-o"></i>
                                                                        <h3 class="box-title">Grafico Calidad</h3>
                                                                        
                                                                    </div><!-- /.box-header -->
                                                                    <div class="box-body">
                                                                        <div class="col-xs-6">
                                                                            <div class="form-group">
                                                                                <label>AÑO</label>
                                                                                <select class="form-control" id="anio" onchange="cargarGraficaCalidad1();SemaforoCalidad1();">
                                                                                    <option value="2009">2009</option>
                                                                                    <option value="2010">2010</option>
                                                                                    <option value="2011">2011</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                    
                                                                        
                                                                    </div>
                                                                
                                                                    <div class="box-body chart-responsive">
                                                                        <div class="chart" id="bar-chart" style="height: 300px;"></div>
                                                                    </div><!-- /.box-body -->
                                                                    
                                                                    <div class="box-body chart-responsive">
                                                                        <div  id="semaforo" ></div>
                                                                    </div><!-- /.box-body -->


                        </div><!-- /.box -->


        ';

    }
    function indicadorProduccion1(){

        echo'
        <div class="box box-solid">
                                                                    <div class="box-header">
                                                                        <i class="fa fa-bar-chart-o"></i>
                                                                        <h3 class="box-title">Grafico Produccion</h3>
                                                                        
                                                                    </div><!-- /.box-header -->
                                                                    <div class="box-body">
                                                                        <div class="col-xs-6">
                                                                            <div class="form-group">
                                                                                <label>AÑO</label>
                                                                                <select class="form-control" id="anio" onchange="cargarGraficaProduccion1();">
                                                                                    <option value="2009">2009</option>
                                                                                    <option value="2010">2010</option>
                                                                                    <option value="2011">2011</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                    
                                                                        
                                                                    </div>
                                                                
                                                                    <div class="box-body chart-responsive">
                                                                        <div class="chart" id="bar-chart" style="height: 300px;"></div>
                                                                    </div><!-- /.box-body -->
                                                                    
                                                                    <div class="box-body chart-responsive">
                                                                        <div class="chart" id="semaforo" style="height: 100px;"></div>
                                                                    </div><!-- /.box-body -->


                        </div><!-- /.box -->


        ';

    }
    function cargarGraficaCalidad1(){


        //$month=$this->param['mes'];
        $year=$this->param['anio'];
        
        $year=(int)$year;
        /*$*/
        
         
        $meses=['ENE','FEB', 'MAR', 'ABR', 'MAY', 'JUN', 'JUL', 'AGS', 'SET', 'OCT', 'NOV', 'DIC'];
        for ($i=1; $i <=12; $i++) { 
            # code...

            $this->cerrarAbrir();
                    $consultaSql="SELECT 
                            SUM(case when (a.tipo_bebida='INCA') then a.botellas_producidas end )as INCA,
                            SUM(case when (a.tipo_bebida='COCA COLA') then a.botellas_producidas end )as  COCA,
                            SUM(case when (a.tipo_bebida='FANTA') then a.botellas_producidas end )as  FANTA,
                            SUM(case when (a.tipo_bebida='SPRITE') then a.botellas_producidas end )as  SPRITE
                        from produccion a where  DATE_FORMAT(a.fecha,'%m')=$i and DATE_FORMAT(a.fecha,'%Y')=$year";
                    $this->result = mysql_query($consultaSql);
                    if($this->result){
                            
                            $row=mysql_fetch_row($this->result);
                            $INCA=$row[0];
                            $COCA=$row[1];
                            $FANTA=$row[2];
                            $SPRITE=$row[3];
                            $objeto= new stdClass();
                               $objeto->y=$meses[$i-1];
                               $objeto->a=(int)$INCA;
                               $objeto->b=(int)$COCA;
                               $objeto->c=(int)$FANTA;
                               $objeto->d=(int)$SPRITE;
                            $datos[]=$objeto;

                    }


        }
        echo json_encode($datos);  

   
    }
    function cargarGraficaProduccion1(){


        //$month=$this->param['mes'];
        $year=$this->param['anio'];
        
        $year=(int)$year;
        /*$*/
        
         
        $meses=['ENE','FEB', 'MAR', 'ABR', 'MAY', 'JUN', 'JUL', 'AGS', 'SET', 'OCT', 'NOV', 'DIC'];
        for ($i=1; $i <=12; $i++) { 
            # code...

            $this->cerrarAbrir();
                    $consultaSql="SELECT 
                            SUM(a.botellas_lavadas)as INCA,
                            SUM(a.lavadas_defectuosas)as  COCA
                        from produccion a where  DATE_FORMAT(a.fecha,'%m')=$i and DATE_FORMAT(a.fecha,'%Y')=$year";
                    $this->result = mysql_query($consultaSql);
                    if($this->result){
                            
                            $row=mysql_fetch_row($this->result);
                            $INCA=$row[0];
                            $COCA=$row[1];
                            $objeto= new stdClass();
                               $objeto->y=$meses[$i-1];
                               $objeto->a=(int)$INCA;
                               $objeto->b=(int)$COCA;
                              
                            $datos[]=$objeto;

                    }


        }
        echo json_encode($datos);  

   
    }
    function SemaforoCalidad1(){
        //$month=$this->param['mes'];
        $year=$this->param['anio'];
        $year=(int)$year;
        $INDICADOR=0;
        /*$*/
            # code...

            $this->cerrarAbrir();
                    $consultaSql="SELECT ((sum(botellas_producidas)-sum(botellas_defecto))/sum(botellas_producidas))*100 FROM `produccion` where DATE_FORMAT(fecha,'%Y')=$year";
                    $this->result = mysql_query($consultaSql);
                    if($this->result){
                            
                            $row=mysql_fetch_row($this->result);
                            $INDICADOR=(double)$row[0];
                            $objeto= new stdClass();
                            $objeto->value=number_format((double)$INDICADOR,3);
                    }


        echo json_encode($objeto); 
        
        
                

   
    }

    function loadAniosVentas(){
        $this->cerrarAbrir();
        $consultaSql="SELECT distinct(YEAR(fecha)) as 
            anio from ingresoventas order by year(fecha)";
        $this->result = mysql_query($consultaSql);
        if($this->result){
                echo '<option value="0">---Seleccion Año--</option>';
            while($row=mysql_fetch_row($this->result)){
                echo '<option value="'.$row[0].'">'.$row[0].'</option>';
            }
        }
    }
    function indicadorFinanciero(){

        echo'
        <div class="box box-solid">
            <div class="box-header">
                <i class="fa fa-bar-chart-o"></i>
                <h3 class="box-title">Grafico Calidad</h3>
                
            </div><!-- /.box-header -->
            <div class="box-body">
                <div class="col-xs-6">
                    <div class="form-group">
                        <label>AÑO</label>
                        <select class="form-control" id="anio" onchange="cargarGraficaFinanciero1();SemaforoFinanciero1();">';
          
          $this->loadAniosVentas();            
         echo'           </select>
                    </div>
                </div>
                                                    
                                                        
            </div>
                                                
            <div class="box-body chart-responsive">
                <div class="chart" id="bar-chart" style="height: 300px;"></div>
            </div><!-- /.box-body -->
            <div class="box-body chart-responsive">
                <div class="chart" id="line-chart" style="height: 300px;"></div>
            </div><!-- /.box-body -->

            <div class="box-body chart-responsive">
                 <div class="chart" id="semaforo" style="height: 100px;"></div>
            </div><!-- /.box-body -->

        </div><!-- /.box -->
    ';

    }
    function cargarGraficaFinanciero1(){

        $year=$this->param['anio'];
        
        $year=(int)$year;
     
        $meses=['ENE','FEB', 'MAR', 'ABR', 'MAY', 'JUN', 'JUL', 'AGS', 'SET', 'OCT', 'NOV', 'DIC'];
         
            # code...

            $this->cerrarAbrir();
                   
                    $consultaSql="SELECT YEAR(iv.fecha) as Anio, 
                                    MONTH(iv.fecha) as Mes , sum(iv.ventas) as montoVenas
                                    from ingresoventas iv 
                                         where YEAR(iv.fecha)='$year'
                                        group by YEAR(iv.fecha), MONTH(iv.fecha)";
                    $this->result = mysql_query($consultaSql);
                    if($this->result){
                            $i=1;
                            while($row=mysql_fetch_row($this->result)){
                            
                            $VENTA=$row[2];
                           
                            $objeto= new stdClass();
                               $objeto->y=$meses[$i-1];
                               $objeto->a=(double)$VENTA;
                            $datos[]=$objeto;
                            $i++;
                        }

                    }


        
        echo json_encode($datos); 

    }

    function SemaforoFinanciero1(){
        $year=$this->param['anio'];
        $year=(int)$year;
        $INDICADOR=0;
        $this->cerrarAbrir();
    }

   

    
    
    

    
}

?>
