function agregarMeta(){
    //alert("hola");
    descripcion=$("#descripcion").val();
    dimension = $("#dimension  option:selected").val();

    //alert(actividad+"::"+proceso+"::"+tipoProceso);
    if (descripcion=="") 
    {
            alert("Llenar Campos");
    }else
    {
        if (dimension==null) 
        {
            alert("Seleccionar  dimensión");
        }else{
            //alert(actividad+"::"+proceso+"::"+tipoProceso);

           $.ajax({
                    type:'POST',
                    url:'../control/controlMeta.php',
                    data:{param_opcion:'agregarMeta',descripcion:descripcion,dimension:dimension},
                    success:function(data){
                        //if(data)
                        //{
                            //alert(data);
                            $('#tablaMetas').html(data);
                            $("#descripcion").val('');
                                                                    
                        //}
                                        
                    }
            });

        }

    }

}

function listarTablaMetas(){

   
    

           $.ajax({
                    type:'POST',
                    url:'../control/controlMeta.php',
                    data:{param_opcion:'listarTablaMetas'},
                    success:function(data){
                        //if(data)
                        //{
                            //alert(data);
                            $('#tablaMetas').html(data);
                            //$('#cursos').removeAttr('disabled');
                                                                    
                        //}
                                        
                    }
            });


    

}

function agregarObjetivo(){
    //alert("hola");
    descripcion=$("#descripcion").val();
    dimension = $("#dimension  option:selected").val();

    //alert(actividad+"::"+proceso+"::"+tipoProceso);
    if (descripcion=="") 
    {
            alert("Llenar Campos");
    }else
    {
        if (dimension==null) 
        {
            alert("Seleccionar  dimensión");
        }else{
            //alert(actividad+"::"+proceso+"::"+tipoProceso);

           $.ajax({
                    type:'POST',
                    url:'../control/controlObjetivo.php',
                    data:{param_opcion:'agregarObjetivo',descripcion:descripcion,dimension:dimension},
                    success:function(data){
                        //if(data)
                        //{
                            //alert(data);
                            $('#tablaMetas').html(data);
                            $("#descripcion").val('');
                                                                    
                        //}
                                        
                    }
            });

        }

    }

}

function listarTablaObjetivos(){

   
    

           $.ajax({
                    type:'POST',
                    url:'../control/controlObjetivo.php',
                    data:{param_opcion:'listarTablaObjetivos'},
                    success:function(data){
                        //if(data)
                        //{
                            //alert(data);
                            $('#tablaMetas').html(data);
                            //$('#cursos').removeAttr('disabled');
                                                                    
                        //}
                                        
                    }
            });


    

}

function listarCascada(){

   
    

           $.ajax({
                    type:'POST',
                    url:'../control/controlCascada.php',
                    data:{param_opcion:'listarCascada'},
                    success:function(data){
                        //if(data)
                        //{
                            //alert(data);
                            $('#tablaCascada').html(data);
                            //$('#cursos').removeAttr('disabled');
                                                                    
                        //}
                                        
                    }
            });


    

}