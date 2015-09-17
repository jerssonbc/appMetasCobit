function cargar() {

    name=$('#name').val();
    user=$('#user').val();
    password=$('#password').val();
     
        $.ajax({
            type: "POST",
            data: {name,user,password,param_opcion:'grabar'},
            url: "../control/controlUsuario.php",
            success: function(datos) {
                if (datos == '') {
                    alert(datos+"Error");
                } else {
                    alert(datos+" Correcto");
                }
            },
            error: function(datos) {
                alert( datos+" Error Fatal");
            }
        });
}
function cargarProceso(){

    tipo = $("#TipoProceso  option:selected").val();

    $.ajax({
                    type:'POST',
                    url:'../control/controlSeguimiento.php',
                    data:{param_opcion:'listarTipoProceso',tipoProceso:tipo},
                    success:function(data){
                        //if(data)
                        //{
                            //alert(data);
                            $('#proceso').html(data);
                            $('#tabla2').html("");
                            $('#tabla1').html("");
                            //$('#cursos').removeAttr('disabled');
                                                                    
                        //}
                                        
                    }
            });
}
function agregarActividad(){
    //alert("hola");
    actividad=$("#actividadT").val();
    proceso = $("#procesos  option:selected").val();
    tipoProceso = $("#TipoProceso  option:selected").val();
    //alert(actividad+"::"+proceso+"::"+tipoProceso);
    if (actividad=="") 
    {
            alert("Llenar Campos");
    }else
    {
        if (proceso==null) 
        {
            alert("Seleccionar  Proceso");
        }else{
            //alert(actividad+"::"+proceso+"::"+tipoProceso);

           $.ajax({
                    type:'POST',
                    url:'../control/controlSeguimiento.php',
                    data:{param_opcion:'agregarActividad',proceso:proceso,actividad:actividad,tipoProceso:tipoProceso},
                    success:function(data){
                        //if(data)
                        //{
                            //alert(data);
                            $('#tabla1').html(data);
                            $('#actividadT').val("");
                                                                    
                        //}
                                        
                    }
            });

        }

    }

}
function listarTabla1(){

    //alert(actividad+" proceso: "+proceso);
    proceso = $("#procesos  option:selected").val();
    tipoProceso = $("#TipoProceso  option:selected").val();
    
        if (proceso==null) 
        {
            alert("Seleccionar  Proceso");
        }else{

           $.ajax({
                    type:'POST',
                    url:'../control/controlSeguimiento.php',
                    data:{param_opcion:'listarTabla1',proceso:proceso,tipoProceso:tipoProceso},
                    success:function(data){
                        //if(data)
                        //{
                            //alert(data);
                            $('#tabla1').html(data);
                            //$('#cursos').removeAttr('disabled');
                                                                    
                        //}
                                        
                    }
            });


    }

}
function listarTabla2(){

    proceso = $("#procesos  option:selected").val();
    tipoProceso = $("#TipoProceso  option:selected").val();
  
        if (proceso==null) 
        {
            alert("Seleccionar  Proceso");
        }else{

           $.ajax({
                    type:'POST',
                    url:'../control/controlSeguimiento.php',
                    data:{param_opcion:'listarTabla2',proceso:proceso,tipoProceso:tipoProceso},
                    success:function(data){
                        //if(data)
                        //{
                            //alert(data);
                            $('#tabla2').html(data);
                            //$('#cursos').removeAttr('disabled');
                                                                    
                        //}
                                        
                    }
            });


    }

}
function cambiarFlujo(idActividad,f){
    proceso = $("#procesos  option:selected").val();
    tipoProceso = $("#TipoProceso  option:selected").val();
    if (f==1) {flujo="demora"};
    if (f==2) {flujo="operacion"};
    if (f==3) {flujo="inspeccion"};
    if (f==4) {flujo="almacenaje"};
    if (f==5) {flujo="trasporte"};
    if (f==6) {flujo="combo"};
    //alert(proceso+"::"+tipoProceso+"::"+idActividad+"::"+flujo);


    $.ajax({
                    type:'POST',
                    url:'../control/controlSeguimiento.php',
                    data:{param_opcion:'cambiarFlujo',proceso:proceso,tipoProceso:tipoProceso,idActividad:idActividad,flujo:flujo},
                    success:function(data){
                        //if(data)
                        //{
                            //alert(data);
                            $('#tabla1').html(data);
                            //$('#cursos').removeAttr('disabled');
                                                                    
                        //}
                                        
                    }
            });
}
function editarActividad(idActividad,columna){

    //alert('si entra');
    proceso = $("#procesos  option:selected").val();
    tipoProceso = $("#TipoProceso  option:selected").val();
    var a='';
    $("#tabla01 tr").click(function(){
        
        //a = $("#td_"+columna+":first").val();
        //alert(a);
        var actividad = $(this).find("td").eq(1).html();
        if (proceso==null) 
        {
                alert("Seleccionar  Proceso");
        }else{

               $.ajax({
                        type:'POST',
                        url:'../control/controlSeguimiento.php',
                        data:{param_opcion:'editarActividad',idActividad:idActividad,proceso:proceso,tipoProceso:tipoProceso,actividad:actividad},
                        success:function(data){
                            //if(data)
                            //{
                                //alert(data);
                                $('#tabla1').html(data);
                                //$('#cursos').removeAttr('disabled');
                                                                        
                            //}
                                            
                        }
                });

        }   
    });

}
function editarActividad1(idActividad,columna){


    proceso = $("#procesos  option:selected").val();
    tipoProceso = $("#TipoProceso  option:selected").val();
    actividad=$("#DatoActiviad").val();

        if (proceso==null) 
        {
                alert("Seleccionar  Proceso");
        }else{

               $.ajax({
                        type:'POST',
                        url:'../control/controlSeguimiento.php',
                        data:{param_opcion:'editarActividad1',idActividad:idActividad,proceso:proceso,tipoProceso:tipoProceso,actividad:actividad},
                        success:function(data){
                            //if(data)
                            //{
                                //alert(data);
                                $('#tabla1').html(data);
                                //$('#cursos').removeAttr('disabled');
                                                                        
                            //}               
                        }
                });
        }
}

function editarRol(idActividad,columna){

    //alert('si entra');
    proceso = $("#procesos  option:selected").val();
    tipoProceso = $("#TipoProceso  option:selected").val();
    var a='';
    $("#tabla02 tr").click(function(){
        
        //a = $("#td_"+columna+":first").val();
        //alert(a);
        var rol = $(this).find("td").eq(2).html();
        if (proceso==null) 
        {
                alert("Seleccionar  Proceso");
        }else{
                //alert(rol);
               $.ajax({
                        type:'POST',
                        url:'../control/controlSeguimiento.php',
                        data:{param_opcion:'editarRol',idActividad:idActividad,proceso:proceso,tipoProceso:tipoProceso,rol:rol},
                        success:function(data){
                            //if(data)
                            //{
                                //alert(data);
                                $('#tabla2').html(data);
                                //$('#cursos').removeAttr('disabled');
                                                                        
                            //}
                                            
                        }
                });

        }   
    });

}
function editarRol1(idActividad,columna){


    proceso = $("#procesos  option:selected").val();
    tipoProceso = $("#TipoProceso  option:selected").val();
    rol=$("#DatoRol").val();
    //alert(proceso+"::"+tipoProceso+"::"+rol+"::"+idActividad);
        if (proceso==null) 
        {
                alert("Seleccionar  Proceso");
        }else{

               $.ajax({
                        type:'POST',
                        url:'../control/controlSeguimiento.php',
                        data:{param_opcion:'editarRol1',idActividad:idActividad,proceso:proceso,tipoProceso:tipoProceso,rol:rol},
                        success:function(data){
                            //if(data)
                            //{
                                //alert(data);
                                $('#tabla2').html(data);
                                //$('#cursos').removeAttr('disabled');
                                                                        
                            //}               
                        }
                });
        }
}
function editarTiempo(idActividad,columna){

    //alert('si entra');
    proceso = $("#procesos  option:selected").val();
    tipoProceso = $("#TipoProceso  option:selected").val();
    $("#tabla02 tr").click(function(){
        
        //a = $("#td_"+columna+":first").val();
        //alert(a);
        var tiempo = $(this).find("td").eq(4).html();
        if (proceso==null) 
        {
                alert("Seleccionar  Proceso");
        }else{
                //alert(rol);
               $.ajax({
                        type:'POST',
                        url:'../control/controlSeguimiento.php',
                        data:{param_opcion:'editarTiempo',idActividad:idActividad,proceso:proceso,tipoProceso:tipoProceso,tiempo:tiempo},
                        success:function(data){
                            //if(data)
                            //{
                                //alert(data);
                                $('#tabla2').html(data);
                                //$('#cursos').removeAttr('disabled');
                                                                        
                            //}
                                            
                        }
                });

        }   
    });

}
function editarTiempo1(idActividad,columna){


    proceso = $("#procesos  option:selected").val();
    tipoProceso = $("#TipoProceso  option:selected").val();
    tiempo=$("#DatoTiempo").val();
    //alert(proceso+"::"+tipoProceso+"::"+rol+"::"+idActividad);
        if (proceso==null) 
        {
                alert("Seleccionar  Proceso");
        }else{

               $.ajax({
                        type:'POST',
                        url:'../control/controlSeguimiento.php',
                        data:{param_opcion:'editarTiempo1',idActividad:idActividad,proceso:proceso,tipoProceso:tipoProceso,tiempo:tiempo},
                        success:function(data){
                            //if(data)
                            //{
                                //alert(data);
                                $('#tabla2').html(data);
                                //$('#cursos').removeAttr('disabled');
                                                                        
                            //}               
                        }
                });
        }
}