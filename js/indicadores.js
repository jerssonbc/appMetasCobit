

function cargarProcesoIndicadores(){

    tipo = $("#TipoProceso  option:selected").val();

    $.ajax({
                    type:'POST',
                    url:'../control/controlIndicador.php',
                    data:{param_opcion:'listarTipoProceso',tipoProceso:tipo},
                    success:function(data){
                        //if(data)
                        //{
                            //alert(data);
                            $('#proceso').html(data);
                            $('#tablaIndicadores').html("");
                            //$('#cursos').removeAttr('disabled');
                                                                    
                        //}
                                        
                    }
            });
}
function listarTablaIndicadores(){

    
    proceso = $("#procesos  option:selected").val();
    tipoProceso = $("#TipoProceso  option:selected").val();
    //alert(" proceso: "+proceso);
        if (proceso==null) 
        {
            alert("Seleccionar  Proceso");
        }else{

           $.ajax({
                    type:'POST',
                    url:'../control/controlIndicador.php',
                    data:{param_opcion:'listarTablaIndicadores',proceso:proceso,tipoProceso:tipoProceso},
                    success:function(data){
                        //if(data)
                        //{
                            //alert(data);
                            $('#tablaIndicadores').html(data);
                            //$('#cursos').removeAttr('disabled');
                                                                    
                        //}
                                        
                    }
            });


    }

}
function cargarDetalleIndicador(indicador,nombre){

    //alert(indicador);
    
    proceso = $("#procesos  option:selected").val();
    tipoProceso = $("#TipoProceso  option:selected").val();
        if (proceso==null) 
        {
            alert("Seleccionar  Proceso");
        }else{

           $.ajax({
                    type:'POST',
                    url:'indicadorDetalle.php',
                    data:{param_opcion:'listarTablaIndicadores',proceso:proceso,tipoProceso:tipoProceso,indicador:indicador,nombre:nombre},
                    success:function(data){
                        //if(data)
                        //{
                            //alert(data);
                            $('#ContenidoIndicadores').html(data);

                            listarTablaComandos(indicador,proceso,tipoProceso);

                            //$('#cursos').removeAttr('disabled');
                                                                    
                        //}
                                        
                    }
            });


    }
}
function listarTablaComandos(indicador,proceso,tipoProceso){

        if (proceso==null) 
        {
            alert("Seleccionar  Proceso");
        }else{

           $.ajax({
                    type:'POST',
                    url:'../control/controlIndicador.php',
                    data:{param_opcion:'tablaComandos',proceso:proceso,tipoProceso:tipoProceso,indicador:indicador},
                    success:function(data){
                        //if(data)
                        //{
                            //alert(data);
                            $('#CuadroComando').html(data);
                            //$('#cursos').removeAttr('disabled');
                                                                    
                        //}
                                        
                    }
            });


    }


}
function listarEditarTablaComandos(proceso,tipoProceso,indicador){


    //alert(indicador+'::'+proceso+'::'+tipoProceso);
       if (proceso==null) 
        {
            alert("Seleccionar  Proceso");
        }else{

           $.ajax({
                    type:'POST',
                    url:'../control/controlIndicador.php',
                    data:{param_opcion:'EdittablaComandos',proceso:proceso,tipoProceso:tipoProceso,indicador:indicador},
                    success:function(data){
                        //if(data)
                        //{
                            //alert(data);
                            $('#EditCuadroComando').html(data);
                            //$('#cursos').removeAttr('disabled');
                                                                    
                        //}
                                        
                    }
            });


    }


}
function editarCuadroMando(indicador){

    responsable = $("#responsable").val();
    objetivo = $("#objetivo").val();
    Nindicador = $("#Nindicador").val();
    lineaBase = $("#lineaBase").val();
    valorMeta = $("#valorMeta").val();
    frecuencia = $("#frecuencia").val();
    rojo = $("#rojo").val();
    amarillo = $("#amarillo").val();
    verde = $("#verde").val();
    $.ajax({
                    type:'POST',
                    url:'../control/controlIndicador.php',
                    data:{param_opcion:'EditartablaComandos',
                            responsable,
                            objetivo,
                            Nindicador,
                            lineaBase,
                            valorMeta,
                            frecuencia,
                            rojo,
                            amarillo,
                            verde,
                            indicador},
                    success:function(data){
                        //if(data)
                        //{
                            alert(data);
                            //$('#EditCuadroComando').html(data);
                            //$('#cursos').removeAttr('disabled');
                                                                    
                        //}
                                        
                    }
            });

}
function AgregarIndicador(){

    proceso = $("#procesos  option:selected").val();
    tipoProceso = $("#TipoProceso  option:selected").val();
    responsable = $("#responsable").val();
    Nindicador = $("#Nindicador").val();
    codigo = $("#codigo").val();
    unidad = $("#unidad").val();
    //alert(responsable+'::'+Nindicador+'::'+codigo+'::'+unidad);
    $.ajax({
                    type:'POST',
                    url:'../control/controlIndicador.php',
                    data:{param_opcion:'AgregarIndicador',
                            responsable,
                            Nindicador,
                            codigo,
                            unidad,proceso,tipoProceso},
                    success: function(datos) {
                        if (datos == '') {
                            alert('vacio');
                        } else {
                            //$('#listarMenu1').html(datos);
                            alert(datos);
                             $("#responsable").val('');
                             $("#Nindicador").val('');
                             $("#codigo").val('');
                             $("#unidad").val('');

                        }
                    },
                    error: function(datos) {
                        alert(datos+" Error Fatal2");
                    }
            });

}
function cargarGraficaCalidad1(){
    //alert('hola');
    anio = $("#anio  option:selected").val();
    //alert(anio);
    $.ajax({
            type: "POST",
            data: {param_opcion:'cargarGraficaCalidad1',anio:anio},
            url: "../control/controlIndicador.php",
            success: function(datos) {
                    //alert(datos);
                if (datos == '') {

                    
                } else {
                    var d=JSON.parse(datos);
                    var bar = new Morris.Bar({
                    element: 'bar-chart',
                    resize: true,
                    data:d,
                    barColors: ['#00a65a', '#f56954', '#056354', '#0FF3A4'],
                    xkey: "y",
                    ykeys: ['a', 'b','c','d'],
                    labels: ['INCA', 'COCA','FANTA','SPRITE'],
                    hideHover: 'auto'
                })
                    
                    
                    //$('#bar-chart').html(datos);
                    //alert(datos);
                    
                }
            },
            error: function(datos) {
                alert(datos+" Error Fatal3");
            }
     });
    
}
function cargarGraficaProduccion1(){
    //alert('hola');
    anio = $("#anio  option:selected").val();
    //alert(anio);
    $.ajax({
            type: "POST",
            data: {param_opcion:'cargarGraficaProduccion1',anio:anio},
            url: "../control/controlIndicador.php",
            success: function(datos) {
                    //alert(datos);
                if (datos == '') {

                    
                } else {
                    var d=JSON.parse(datos);
                    var bar = new Morris.Bar({
                    element: 'bar-chart',
                    resize: true,
                    data:d,
                    barColors: ['#00a65a', '#f56954'],
                    xkey: "y",
                    ykeys: ['a', 'b'],
                    labels: ['LAB BUENAS', 'LAB MALAS'],
                    hideHover: 'auto'
                })
                    
                    
                    //$('#bar-chart').html(datos);
                    //alert(datos);
                    
                }
            },
            error: function(datos) {
                alert(datos+" Error Fatal3");
            }
     });
    
}
function cargarGraficos(indicador){
    //alert(indicador);
    $.ajax({
                    type:'POST',
                    url:'../control/controlIndicador.php',
                    data:{param_opcion:'cargarGraficos',
                            indicador},
                    success: function(datos) {
                        if (datos == '') {
                            alert('vacio');
                        } else {
                            $('#Graficos').html(datos);
                            //alert(datos);
                             

                        }
                    },
                    error: function(datos) {
                        alert(datos+" Error Fatal2");
                    }
            });

}
function SemaforoCalidad1(){
    //alert(indicador);
    anio = $("#anio  option:selected").val();
    $.ajax({
                    type:'POST',
                    url:'../control/controlIndicador.php',
                    data:{param_opcion:'SemaforoCalidad1',anio},
                    success: function(datos) {
                        if (datos == '') {
                            alert('vacio');
                        } else {
                            //$('#semaforo').html(datos);
                            var d=JSON.parse(datos);
                            FusionCharts.ready(function () {
                            var cSatScoreChart = new FusionCharts({
                                type: 'angulargauge',
                                renderAt: 'semaforo',
                                width: '450',
                                height: '300',
                                dataFormat: 'json',
                                dataSource: {
                                    "chart": {                                
                                        "caption": "Indicador",
                                        "subcaption": "Año "+anio,
                                        "plotToolText": "Valor: $value",
                                        "theme": "fint",                              
                                        "chartBottomMargin": "50",                
                                        "showValue": "0.1"
                                    },
                                    "colorRange": {
                                        "color": [{
                                            "minValue": "0",
                                            "maxValue": "90",
                                            "code": "#e44a00"
                                        }, {
                                            "minValue": "90",
                                            "maxValue": "98",
                                            "code": "#f8bd19"
                                        }, {
                                            "minValue": "98",
                                            "maxValue": "100",
                                            "code": "#6baa01"
                                        }]
                                    },
                                    "dials": {
                                        "dial": [d]
                                    },
                                    "annotations": {
                                        "origw": "450",
                                        "origh": "300",
                                        "autoscale": "1", 
                                        "showBelow": "0",
                                        "groups": [
                                            {
                                                "id": "arcs",
                                                "items": [                            
                                                    {
                                                        "id": "national-cs-bg",                                
                                                        "type": "rectangle",
                                                        "x" : "$chartCenterX+2",
                                                        "y": "$chartEndY - 45",
                                                        "tox": "$chartCenterX + 130",
                                                        "toy": "$chartEndY - 25",
                                                        "fillcolor": "#f8bd19"
                                                    },
                                                    {
                                                        "id": "national-cs-text",                                
                                                        "type": "Text",
                                                        "color": "#ffffff",                                
                                                        "label": "Entre 90% y 99%",
                                                        "fontSize": "12",
                                                        "align": "left",                               
                                                        "x": "$chartCenterX + 7",
                                                        "y": "$chartEndY - 35"
                                                    },
                                                    {
                                                        "id": "state-cs-bg",                                
                                                        "type": "rectangle",
                                                        "x" : "$chartCenterX-2",
                                                        "y": "$chartEndY - 45",
                                                        "tox": "$chartCenterX - 103",
                                                        "toy": "$chartEndY - 25",
                                                        "fillcolor": "#6baa01"
                                                    },
                                                    {
                                                        "id": "state-cs-text",                                
                                                        "type": "Text",
                                                        "color": "#ffffff",                                
                                                        "label": "Menora 90%",
                                                        "fontSize": "12",
                                                        "align": "right",                               
                                                        "x": "$chartCenterX - 7",
                                                        "y": "$chartEndY - 35"
                                                    },
                                                    {
                                                        "id": "store-cs-bg",                                
                                                        "type": "rectangle",
                                                        "x" : "$chartCenterX-130",
                                                        "y": "$chartEndY - 22",
                                                        "tox": "$chartCenterX + 150",
                                                        "toy": "$chartEndY - 2",
                                                        "fillcolor": "#0075c2"
                                                    },
                                                    {
                                                        "id": "state-cs-text",                                
                                                        "type": "Text",
                                                        "color": "#ffffff",                                
                                                        "label": "Mayor a 99%",
                                                        "fontSize": "12",
                                                        "align": "center",                               
                                                        "x": "$chartCenterX + 10",
                                                        "y": "$chartEndY - 12"
                                                    }
                                                ]
                                            }                                                           
                                        ]
                                    }            
                                }
                            }).render();
                        });
                            
                        }
                    },
                    error: function(datos) {
                        alert(datos+" Error Fatal2");
                    }
            });

}

function cargarGraficaFinanciero1(){
    //alert('hola');
    var aniof = $("#anio  option:selected").val();
    if(aniof>0)
    {
         $.ajax({
            type: "POST",
            data: {param_opcion:'cargarGraficaFinanciero1',anio:aniof},
            url: "../control/controlIndicador.php",
            success: function(datos) {
                    console.log(datos);
                if (datos == '') {

                    
                } else {
                    var d=JSON.parse(datos);
                    var bar = new Morris.Bar({
                    element: 'bar-chart',
                    resize: true,
                    data:d,
                    barColors: ['#00a65a'],
                    xkey: "y",
                    ykeys: ['a'],
                    labels: ['VENTA'],
                    hideHover: 'auto'
                })
                    
                    
                    //$('#bar-chart').html(datos);
                    //alert(datos);
                    
                }
            },
            error: function(datos) {
                alert(datos+" Error Fatal3");
            }
        });
    }
       
}