
<div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">INDICADOR DE <?php echo $_POST['nombre'] ?></h3>
                                </div><!-- /.box-header -->
                                <!-- form start -->
                                <a class = "btn btn-info" href="indicadores.php">Regresar</a>
                                <form role="form">
                                    <div class="box-body">
            
                                        <div class="box">
                                            <div class="nav-tabs-custom">
                                                <ul class="nav nav-tabs">
                                                    <li class="active"><a href="#tab_1" data-toggle="tab" onclick="listarTablaComandos(<?php echo $_POST['indicador'] ?>,<?php echo $_POST['proceso'] ?>,<?php echo $_POST['tipoProceso'] ?>)">Tablero de Comando</a></li>
                                                    <li><a href="#tab_2" data-toggle="tab" onclick="listarEditarTablaComandos(<?php echo $_POST['proceso'] ?>,<?php echo $_POST['tipoProceso'] ?>,<?php echo $_POST['indicador'] ?>)">Administrar</a></li>
                                                    <li><a href="#tab_3" data-toggle="tab" onclick="cargarGraficos(<?php echo $_POST['indicador'] ?>);">Resultados</a></li>
                                                    <li class="pull-right"><a href="#" class="text-muted"><i class="fa fa-gear"></i></a></li>
                                                </ul>
                                                <div class="tab-content">
                                                    <div class="tab-pane active" id="tab_1">
                                                            
                                                            <div class="box-header">
                                                                <h3 class="box-title">Cuadro de Comandos </h3>
                                                            </div><!-- /.box-header -->
                                                            <div class="box-body" id="CuadroComando">
                                                                
                                                            </div><!-- /.box-body -->
                                                            <div class="box-footer clearfix">
                                                                <ul class="pagination pagination-sm no-margin pull-right">
                                                                    <li><a href="#">&laquo;</a></li>
                                                                    <li><a href="#">1</a></li>
                                                                    <li><a href="#">2</a></li>
                                                                    <li><a href="#">3</a></li>
                                                                    <li><a href="#">&raquo;</a></li>
                                                                </ul>
                                                            </div>

                                                    </div><!-- /.tab-pane -->
                                                    <div class="tab-pane" id="tab_2">
                                                            <div class="box-header">
                                                                <h3 class="box-title">Editar Cuadro Comandos</h3>
                                                            </div><!-- /.box-header -->
                                                            <div class="box-body" id="EditCuadroComando">
                                                                
                                                            </div><!-- /.box-body -->
                                                            <div class="box-footer clearfix">
                                                                <ul class="pagination pagination-sm no-margin pull-right">
                                                                    <li><a href="#">&laquo;</a></li>
                                                                    <li><a href="#">1</a></li>
                                                                    <li><a href="#">2</a></li>
                                                                    <li><a href="#">3</a></li>
                                                                    <li><a href="#">&raquo;</a></li>
                                                                </ul>
                                                            </div>

                                                    </div>
                                                    <div class="tab-pane" id="tab_3">
                                                            <div class="col-xs-12" id="Graficos">
                                                                
                                                            </div><!-- /.col -->
                                                            

                                                    </div><!-- /.tab-pane -->
                                                </div><!-- /.tab-content -->
                                            </div>
                                            
                                        </div><!-- /.box -->
                                        
                                    </div><!-- /.box-body -->

                                    
                                </form>
                            </div><!-- /.box -->

     <script src="../js/raphael-min.js" type="text/javascript">></script>
     <script src="../js/morris.min.js" type="text/javascript"></script>                       
                        
                        <!--<button onclick="guardarImages()" class="btn btn-info btn-lg"  >IMAGEN</button>-->



