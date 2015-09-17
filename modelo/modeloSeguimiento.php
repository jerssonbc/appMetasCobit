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
            
            case "listarTipoProceso":
                echo $this->listarTipoProceso();
                break;
            case "cambiarFlujo":
                echo $this->cambiarFlujo();
                break;
            case "listarTabla1":
                echo $this->listarTabla1();
                break;
            case "listarTabla2":
                echo $this->listarTabla2();
                break;
            case "agregarActividad":
                echo $this->agregarActividads();
                break;
            case "editarActividad":
                echo $this->editarActividad();
                break;
            case "editarActividad1":
                echo $this->editarActividad1();
                break;
            case "editarRol":
                echo $this->editarRol();
                break;
            case "editarRol1":
                echo $this->editarRol1();
                break;
            case "editarTiempo":
                echo $this->editarTiempo();
                break;
            case "editarTiempo1":
                echo $this->editarTiempo1();
                break;
             case "entrar":
                echo $this->entrar();
                break;      
        }
    }
    function cambiarFlujo(){
        $flujo=$this->param['flujo'];
        $idActividad=$this->param['idActividad'];

        $this->cerrarAbrir();
            $consultaSql="UPDATE `actividades` SET `flujo`='$flujo' WHERE `idActividad`='$idActividad' ";
            $this->result = mysql_query($consultaSql);
            if($this->result){

                $this->listarTabla1();
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
                <select class="form-control" id="procesos">';
        if($this->result){
            while($row=mysql_fetch_row($this->result)){
                echo '<option value="'.$row[0].'" onClick="listarTabla1();listarTabla2();">'.$row[1].'</option>';
                //echo '<option value="'.$row[0].'" onClick="listarTabla1('.$row[0].','.$tipoProceso.');">'.$row[1].'</option>';
        }
        echo '<select>';
        
               

        }
    }
   

    function listarTabla1(){

        $proceso=$this->param['proceso'];
        $tipoProceso=$this->param['tipoProceso'];
            # code...
            $this->cerrarAbrir();
            $consultaSql="SELECT idActividad,Actividad,flujo from actividades where  tipoProceso='$tipoProceso' and idproceso='$proceso' ";
            $this->result = mysql_query($consultaSql);
            if($this->result){
                $cont=1;
                while($row=mysql_fetch_row($this->result)){
                    echo '<tr>  
                            <td>'.$cont.'</td>
                            <td id="td_'.$cont.'" onDblClick ="editarActividad('.$row[0].','.$cont.')" >'.$row[1].'</td>';
                            if ($row[2]=="demora") {
                                # code...
                                echo'<td bgcolor="#FF0000" onClick="cambiarFlujo('.$row[0].',1);listarTabla2();"></td>';
                            }else{
                                echo'<td onClick="cambiarFlujo('.$row[0].',1);listarTabla2();">   </td>';
                            }
                            if ($row[2]=="operacion") {
                                # code...
                                echo'<td bgcolor="#FF0000" onClick="cambiarFlujo('.$row[0].',2);listarTabla2();">    </td>';
                            }else{
                                echo'<td onClick="cambiarFlujo('.$row[0].',2);listarTabla2();">    </td>';
                            }
                            if ($row[2]=="inspeccion") {
                                # code...
                                echo'<td bgcolor="#FF0000" onClick="cambiarFlujo('.$row[0].',3);listarTabla2();">    </td>';
                            }else{
                                echo'<td onClick="cambiarFlujo('.$row[0].',3);listarTabla2();">    </td>';
                            }
                            if ($row[2]=="almacenaje") {
                                # code...
                                echo'<td bgcolor="#FF0000" onClick="cambiarFlujo('.$row[0].',4);listarTabla2();">    </td>';
                            }else{
                                echo'<td onClick="cambiarFlujo('.$row[0].',4);listarTabla2();">    </td>';
                            }
                            if ($row[2]=="trasporte") {
                                # code...
                                echo'<td bgcolor="#FF0000" onClick="cambiarFlujo('.$row[0].',5);listarTabla2();">    </td>';
                            }else{
                                echo'<td onClick="cambiarFlujo('.$row[0].',5);listarTabla2();">    </td>';
                            }
                            if ($row[2]=="combo") {
                                # code...
                                echo'<td bgcolor="#FF0000" onClick="cambiarFlujo('.$row[0].',6);listarTabla2();">    </td>';
                            }else{
                                echo'<td onClick="cambiarFlujo('.$row[0].',6);listarTabla2();">    </td>';
                            }
                            

                    echo'</tr>';
                    $cont++;
                }
        }

    }
    function listarTabla2(){

        $proceso=$this->param['proceso'];
        $tipoProceso=$this->param['tipoProceso'];
            # code...
            $this->cerrarAbrir();
            $consultaSql="SELECT sum(tiempo) from actividades where  tipoProceso='$tipoProceso' and idproceso='$proceso' ";
            $this->result = mysql_query($consultaSql);
            $T=1;
            $bar=1;
            if($this->result){
                while($row=mysql_fetch_row($this->result)){
                    $T=$row[0];
                    if($T==0){
                        $T=1;
                        $bar=0;
                    }
                }
            }
            $this->cerrarAbrir();
            $consultaSql="SELECT idActividad,Actividad,Rol,flujo,tiempo from actividades where  tipoProceso='$tipoProceso' and idproceso='$proceso' ";
            $this->result = mysql_query($consultaSql);
            if($this->result){
                $cont=1;
                $total=0;
                $demora=0;
                $operacion=0;
                $inspeccion=0;
                $almacenaje=0;
                $trasporte=0;
                $combo=0;
                while($row=mysql_fetch_row($this->result)){
                    echo '<tr>  
                            <td>'.$cont.'</td>
                            <td id="td_'.$cont.'" onDblClick ="editarActividad('.$row[0].','.$cont.')" >'.$row[1].'</td>';
                            
                            echo'<td id="rol_'.$cont.'" onDblClick ="editarRol('.$row[0].','.$cont.')" >'.$row[2].'</td>';
                            if ($row[3]=="demora") {
                                # code...
                                echo'<td><img id="Imagen" src="../img/demora2.png"></td>';
                                $demora=$demora+$row[4];
                            }
                            if ($row[3]=="operacion") {
                                # code...
                                echo'<td><img id="Imagen" src="../img/operacion2.png"></td>';
                                $operacion=$operacion+$row[4];
                            }
                            if ($row[3]=="inspeccion") {
                                # code...
                                echo'<td><img id="Imagen" src="../img/inspeccion2.png"></td>';
                                $inspeccion=$inspeccion+$row[4];
                            }
                            if ($row[3]=="almacenaje") {
                                # code...
                                echo'<td><img id="Imagen" src="../img/almacenaje2.png"></td>';
                                $almacenaje=$almacenaje+$row[4];
                            }
                            if ($row[3]=="trasporte") {
                                # code...
                                echo'<td><img id="Imagen" src="../img/transporte2.png"></td>';
                                $trasporte=$trasporte+$row[4];
                            }
                            if ($row[3]=="combo") {
                                # code...
                                echo'<td><img id="Imagen" src="../img/combo2.png"></td>';
                                $combo=$combo+$row[4];
                            }
                            echo '<td id="tiempo_'.$cont.'" onDblClick ="editarTiempo('.$row[0].','.$cont.')" >'.$row[4].'</td>';
                            echo '<td  >'.number_format(($row[4]/$T)*100,3).' %</td>';
                            

                    echo'</tr>';
                    $cont++;
                    $total=$total+$row[4];
                }
                echo '<tr>
                        <td colspan="4" > TOTAL </td>
                        <td> '.$total.' </td>
                        <td> '; if ($bar==0){echo '0';}else{echo '100';} echo ' % </td>
                    </tr>';
                echo '<tr>
                        <td colspan="5" style="border-left: hidden;border-right: hidden;"> </td>
                    </tr>';
                echo '<tr>
                        <td colspan="2" style="border-left: hidden;border-bottom: hidden;border-top: hidden;"> </td>
                        <td colspan="2">OPERACIÓN</td>
                        <td >'.$operacion.'</td>
                        <td >'.number_format(($operacion/$T)*100,3).' %</td>
                    </tr>';
                echo '<tr>
                        <td colspan="2" style="border-left: hidden;border-bottom: hidden;border-top: hidden;"> </td>
                        <td colspan="2">TRASPORTE</td>
                        <td >'.$trasporte.'</td>
                        <td >'.number_format(($trasporte/$T)*100,3).' %</td>
                    </tr>';
                echo '<tr>
                        <td colspan="2" style="border-left: hidden;border-bottom: hidden;border-top: hidden;"> </td>
                        <td colspan="2">DEMORA</td>
                        <td >'.$demora.'</td>
                        <td >'.number_format(($demora/$T)*100,3).' %</td>
                    </tr>';
                echo '<tr>
                        <td colspan="2" style="border-left: hidden;border-bottom: hidden;border-top: hidden;"> </td>
                        <td colspan="2">INSPECCION</td>
                        <td >'.$inspeccion.'</td>
                        <td >'.number_format(($inspeccion/$T)*100,3).' %</td>
                    </tr>';
                echo '<tr>
                        <td colspan="2" style="border-left: hidden;border-bottom: hidden;border-top: hidden;"> </td>
                        <td colspan="2">ALMACENAJE</td>
                        <td >'.$almacenaje.'</td>
                        <td >'.number_format(($almacenaje/$T)*100,3).' %</td>
                    </tr>';
                echo '<tr>
                        <td colspan="2" style="border-left: hidden;border-bottom: hidden;border-top: hidden;"> </td>
                        <td colspan="2">COMBINACION</td>
                        <td >'.$combo.'</td>
                        <td >'.number_format(($combo/$T)*100,3).' %</td>
                </tr>';
                echo '<tr>
                        <td colspan="2" style="border-left: hidden;border-bottom: hidden;border-top: hidden;"> </td>
                        <td colspan="2"><b>TOTAL</b></td>
                        <td >'.$total.' Min</td>
                        <td >';if ($bar==0){echo '0';}else{echo '100';} echo ' % </td>
                    </tr>';

        }

    }

    function agregarActividads(){


        //$this->listarTabla1();
        $proceso=$this->param['proceso'];
        $actividad=$this->param['actividad'];
        $tipoProceso=$this->param['tipoProceso'];

        
        $this->cerrarAbrir();
        $consultaSql="INSERT INTO `actividades`(`Actividad`, `Rol`, `flujo`, `tiempo`, `tipoProceso`, `idProceso`) VALUES ('$actividad','Asignar','Asignar','0','$tipoProceso','$proceso')";
        $this->result = mysql_query($consultaSql);

        if ($this->result) {
            # code...
            $this->cerrarAbrir();
            $consultaSql="SELECT idActividad,Actividad,flujo from actividades where  tipoProceso='$tipoProceso' and idproceso='$proceso' ";
            $this->result = mysql_query($consultaSql);
            if($this->result){

                $this->listarTabla1();
                    
            }


        }else{echo "error";}


    }

    function editarActividad(){

        $proceso=$this->param['proceso'];
        $actividad=$this->param['actividad'];
        $idActividad=$this->param['idActividad'];
        $tipoProceso=$this->param['tipoProceso'];
        $columna=$this->param['columna'];

        $proceso=$this->param['proceso'];
        $tipoProceso=$this->param['tipoProceso'];
            # code...
            $this->cerrarAbrir();
            $consultaSql="SELECT idActividad,Actividad,flujo from actividades where  tipoProceso='$tipoProceso' and idproceso='$proceso' ";
            $this->result = mysql_query($consultaSql);
            if($this->result){
                $cont=1;
                while($row=mysql_fetch_row($this->result)){
                    echo '<tr>  
                            <td>'.$cont.'</td>';
                            if ($idActividad==$row[0]) {
                                echo '<td><input type="text" size="40" id="DatoActiviad" onblur="editarActividad1('.$row[0].','.$cont.');listarTabla2();"  value="'.$actividad.'"/></td>';
                            }else{
                                echo '<td id="td_'.$cont.'">'.$row[1].'</td>';
                            }
                            if ($row[2]=="demora") {
                                # code...
                                echo'<td bgcolor="#FF0000" onClick="cambiarFlujo('.$row[0].',1);listarTabla2();"></td>';
                            }else{
                                echo'<td onClick="cambiarFlujo('.$row[0].',1);listarTabla2();">   </td>';
                            }
                            if ($row[2]=="operacion") {
                                # code...
                                echo'<td bgcolor="#FF0000" onClick="cambiarFlujo('.$row[0].',2);listarTabla2();">    </td>';
                            }else{
                                echo'<td onClick="cambiarFlujo('.$row[0].',2);listarTabla2();">    </td>';
                            }
                            if ($row[2]=="inspeccion") {
                                # code...
                                echo'<td bgcolor="#FF0000" onClick="cambiarFlujo('.$row[0].',3);listarTabla2();">    </td>';
                            }else{
                                echo'<td onClick="cambiarFlujo('.$row[0].',3);listarTabla2();">    </td>';
                            }
                            if ($row[2]=="almacenaje") {
                                # code...
                                echo'<td bgcolor="#FF0000" onClick="cambiarFlujo('.$row[0].',4);listarTabla2();">    </td>';
                            }else{
                                echo'<td onClick="cambiarFlujo('.$row[0].',4);listarTabla2();">    </td>';
                            }
                            if ($row[2]=="trasporte") {
                                # code...
                                echo'<td bgcolor="#FF0000" onClick="cambiarFlujo('.$row[0].',5);listarTabla2();">    </td>';
                            }else{
                                echo'<td onClick="cambiarFlujo('.$row[0].',5);listarTabla2();">    </td>';
                            }
                            if ($row[2]=="combo") {
                                # code...
                                echo'<td bgcolor="#FF0000" onClick="cambiarFlujo('.$row[0].',6);listarTabla2();">    </td>';
                            }else{
                                echo'<td onClick="cambiarFlujo('.$row[0].',6);listarTabla2();">    </td>';
                            }
                            

                    echo'</tr>';
                    $cont++;
                }
        }
 
        

    }
    function editarActividad1(){

        $flujo=$this->param['flujo'];
        $idActividad=$this->param['idActividad'];
        $actividad=$this->param['actividad'];
        $this->cerrarAbrir();
            $consultaSql="UPDATE `actividades` SET `Actividad`='$actividad' WHERE `idActividad`='$idActividad' ";
            $this->result = mysql_query($consultaSql);
            if($this->result){

                $this->listarTabla1();
            }

    }

    function editarRol(){

        $proceso=$this->param['proceso'];
        $rol=$this->param['rol'];
        $idActividad=$this->param['idActividad'];
        $tipoProceso=$this->param['tipoProceso'];
        $columna=$this->param['columna'];

        $proceso=$this->param['proceso'];
        $tipoProceso=$this->param['tipoProceso'];
           # code...
            $this->cerrarAbrir();
            $consultaSql="SELECT idActividad,Actividad,Rol,flujo,tiempo from actividades where  tipoProceso='$tipoProceso' and idproceso='$proceso' ";
            $this->result = mysql_query($consultaSql);
            if($this->result){
                $cont=1;
                while($row=mysql_fetch_row($this->result)){
                    echo '<tr>  
                            <td>'.$cont.'</td>
                            <td id="td_'.$cont.'" onDblClick ="editarActividad('.$row[0].','.$cont.')" >'.$row[1].'</td>';

                            if ($idActividad==$row[0]) {
                                echo '<td><input type="text" size="10" id="DatoRol" onblur="editarRol1('.$row[0].','.$cont.');"  value="'.$rol.'"/></td>';
                            }else{
                                echo '<td id="rol_'.$cont.'" >'.$row[2].'</td>';
                            }
                            //echo'<td id="rol_'.$cont.'" onDblClick ="editarRol('.$row[0].','.$cont.')" >'.$row[2].'</td>';
                            if ($row[3]=="demora") {
                                # code...
                                echo'<td><img id="Imagen" src="../img/demora2.png"></td>';
                            }
                            if ($row[3]=="operacion") {
                                # code...
                                echo'<td><img id="Imagen" src="../img/operacion2.png"></td>';
                            }
                            if ($row[3]=="inspeccion") {
                                # code...
                                echo'<td><img id="Imagen" src="../img/inspeccion2.png"></td>';
                            }
                            if ($row[3]=="almacenaje") {
                                # code...
                                echo'<td><img id="Imagen" src="../img/almacenaje2.png"></td>';
                            }
                            if ($row[3]=="trasporte") {
                                # code...
                                echo'<td><img id="Imagen" src="../img/transporte2.png"></td>';
                            }
                            if ($row[3]=="combo") {
                                # code...
                                echo'<td><img id="Imagen" src="../img/combo2.png"></td>';
                            }
                            echo '<td id="tiempo_'.$cont.'" onDblClick ="editarTiempo('.$row[0].','.$cont.')" >'.$row[4].'</td>';
                            

                    echo'</tr>';
                    $cont++;
                }
        }

    }
    function editarRol1(){

        $idActividad=$this->param['idActividad'];
        $rol=$this->param['rol'];
        $this->cerrarAbrir();
            $consultaSql="UPDATE `actividades` SET `Rol`='$rol' WHERE `idActividad`='$idActividad' ";
            $this->result = mysql_query($consultaSql);
            if($this->result){

                $this->listarTabla2();
            }

    }
    function editarTiempo(){

        $proceso=$this->param['proceso'];
        $tiempo=$this->param['tiempo'];
        $idActividad=$this->param['idActividad'];
        $tipoProceso=$this->param['tipoProceso'];
        $columna=$this->param['columna'];

           # code...
            $this->cerrarAbrir();
            $consultaSql="SELECT idActividad,Actividad,Rol,flujo,tiempo from actividades where  tipoProceso='$tipoProceso' and idproceso='$proceso' ";
            $this->result = mysql_query($consultaSql);
            if($this->result){
                $cont=1;
                while($row=mysql_fetch_row($this->result)){
                    echo '<tr>  
                            <td>'.$cont.'</td>
                            <td id="td_'.$cont.'" onDblClick ="editarActividad('.$row[0].','.$cont.')" >'.$row[1].'</td>';
                            echo '<td id="rol_'.$cont.'" onDblClick ="editarRol('.$row[0].','.$cont.')" >'.$row[2].'</td>';
                            //echo'<td id="rol_'.$cont.'" onDblClick ="editarRol('.$row[0].','.$cont.')" >'.$row[2].'</td>';
                            if ($row[3]=="demora") {
                                # code...
                                echo'<td><img id="Imagen" src="../img/demora2.png"></td>';
                            }
                            if ($row[3]=="operacion") {
                                # code...
                                echo'<td><img id="Imagen" src="../img/operacion2.png"></td>';
                            }
                            if ($row[3]=="inspeccion") {
                                # code...
                                echo'<td><img id="Imagen" src="../img/inspeccion2.png"></td>';
                            }
                            if ($row[3]=="almacenaje") {
                                # code...
                                echo'<td><img id="Imagen" src="../img/almacenaje2.png"></td>';
                            }
                            if ($row[3]=="trasporte") {
                                # code...
                                echo'<td><img id="Imagen" src="../img/transporte2.png"></td>';
                            }
                            if ($row[3]=="combo") {
                                # code...
                                echo'<td><img id="Imagen" src="../img/combo2.png"></td>';
                            }
                            //echo '<td id="tiempo_'.$cont.'" onDblClick ="editarTiempo('.$row[0].','.$cont.')" >'.$row[4].'</td>';
                            if ($idActividad==$row[0]) {
                                echo '<td><input type="text" size="5" id="DatoTiempo" onblur="editarTiempo1('.$row[0].','.$cont.');"  value="'.$tiempo.'"/></td>';
                            }else{
                                echo '<td id="tiempo_'.$cont.'" >'.$row[4].'</td>';
                            }
                            

                    echo'</tr>';
                    $cont++;
                }
        }

    }
    function editarTiempo1(){

        $idActividad=$this->param['idActividad'];
        $tiempo=$this->param['tiempo'];
        $this->cerrarAbrir();
            $consultaSql="UPDATE `actividades` SET `tiempo`='$tiempo' WHERE `idActividad`='$idActividad' ";
            $this->result = mysql_query($consultaSql);
            if($this->result){

                $this->listarTabla2();
            }

    }
    

    
}

?>