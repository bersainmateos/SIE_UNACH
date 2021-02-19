$(function (){
  $(document).on("click",".manejador",function (){
    location.href="./"+this.id;
  });
  carga_datos();
})

 
var titulo='';
var p =new Array();
var id =new Array(); 
var contador=0;


$(document).on("click",".apertura_dis",function (){
  $(".apertura").removeClass('show');
  $(this).addClass('show');
})


function carga_datos(){
  if (ruta=="Preguntas") {
     var tabla=$('#encuestas').DataTable();
     $.post('./php/files_preguntas/web-service_preguntas.php', function(respuesta) {
        tabla.clear().destroy();
        $(".contend").html(respuesta);
        tabla=$('#encuestas').DataTable();
     });
   }else if(ruta=="Respuestas"){
    var tabla=$('#encuestas').DataTable();
     $.post('./php/files_respuestas/web-service_respuesta.php', function(respuesta) {
        tabla.clear().destroy();
        $(".contend").html(respuesta);
        tabla=$('#encuestas').DataTable();
     });
  }else if(ruta=="Editar_catalogo_pregunta"){
    var tabla=$('#encuestas').DataTable();
     $.post('./php/files_preguntas/files_catalogo/web-service_editar.php', function(respuesta) {
        tabla.clear().destroy();
        $(".contend").html(respuesta);
        tabla=$('#encuestas').DataTable();
     });
  }else if(ruta=="Editar_catalogo_respuesta"){
     $.post('./php/files_respuestas/files_catalogo/web-service.php',{tipo:$(".tipo_catalogo").val()}, function(respuesta) {
     
        $(".catalogo_respuesta").html(respuesta);
     });
  }else if(ruta=="Encuestas_creadas"){
     var tabla=$("#encuestas").DataTable();
     $.post('./php/files_encuesta/web-service_encuesta.php', function(respuesta) {
        tabla.clear().destroy();
        $(".informacion").html(respuesta);
        tabla=$("#encuestas").DataTable();
     });
  }else if(ruta=="Mostrar_encuestadores"){
    var tabla=$('#encuestadores').DataTable();
  }


}




$(document).on("keyup","#bus",function(){
    $.ajax({
        url:"./php/assets/select_institucion.php",
        method:"post",
        global:false,
        data:{id:institucion.value,nom:$(this).val()},
        success:function(respuesta){
            $("#contenido").html(respuesta);
        }
      });
});


$(document).on("click","#finalizar",function(){
  var institucion ={'nombre' :[] };
    var contenido=document.getElementsByClassName("generar");

    for (var i = 0; i < contenido.length; i++) {
        if($(contenido[i]).val() > 0){
          institucion.nombre.push({
                            "localidad":$(contenido[i]).attr("localidad"),
                            "tipo":$(contenido[i]).val()
                          });
        }
    }

    $.ajax({
      url:"./php/assets/guardar_institucion.php",
      method:"POST",
      data:{valor:JSON.stringify(institucion)},
      global:false,
      success:function(res){
        bus.focus();
        $("#bus").val("");
        console.log(res);
        alert (res);
      }
    });

});

$(document).on('change', '#institucion', function(event) {
      $.ajax({
        url:"./php/assets/select_institucion.php",
        method:"post",
        global:false,
        data:{id:$(this).val()},
        success:function(respuesta){
            $("#contenido").html(respuesta);
        }
      });
});
 

$(document).on("click",".Rq",function(){

  var pregunta= document.getElementsByClassName('informacion');
   
  var html="<br><h4 class='text-success'><center>PREGUNTAS OBLIGATORIAS</center></h4><table class='table table-bordered'>";
      html+="<thead class='unach-table'><tr style='color:white;'>";
      html+="<th><center>PREGUNTAS</center></th><th><center>All <input class='all' type='checkbox'></center></th></tr></thead>";
       
        for (var i = 0; i < pregunta.length; i++) {
                if($(pregunta[i]).data('id_control')=='pregunta'){
                  html+='<tr>';
                  html+='<td>'+$(pregunta[i]).text()+'</td><td><input class="rqd" type="checkbox"></td>';
                  html+='</tr>';
                }
        }
       
        html+='</table>';
        $(".requerido").html(html);
        alert("Nota: Debe selecionar las preguntas que desea que respondan Obligatoriamente!");
});



$(document).on("click",".all",function(){
  if ($(this).prop('checked')) {
    $('.rqd').prop('checked', true);
  }else{
    $('.rqd').prop('checked', false);
  }
})


$(document).on('click', '.r', function() {
    var bandera=0;
  $(".rs:checked").each(function(){
    bandera++;
      id[contador]=$(this).data('id_valor');
      p[contador]=$(this).data('id_nom');
      contador++
    });

    if (bandera > 0) {
      $('.rs').prop('checked', false);
      alertify.success(bandera+" Respuestas Fueron Agregadas Correctamente",2);
    }else{
      alertify.error("Debes seleccionar respuestas",2);
    }
});


$(document).on('click', '.q', function() {
    var bandera=0;
  $(".p:checked").each(function(){
    bandera++;
      id[contador]=$(this).data('id_valor');
      p[contador]=$(this).data('id_nom');
      contador++
    });

    if (bandera > 0) {
      $('.p').prop('checked', false);
      alertify.success(bandera+" Preguntas Fueron Agregadas Correctamente",2);
    }else{
      alertify.error("Debes seleccionar preguntas",2);
    }
});


$(document).on("ajaxStart",function(){
    $(".datax").css("display","none");
    $(".espera").css("display","block");
    $(".espera").html("<img class='f' style='margin:auto 45%;' src='../imagenes/espera.gif'></img>");
}).on("ajaxStop",function(){
  $(".espera").css("display","none");
  $(".datax").css("display","block");
})

$(document).on('keyup', '#buscar_alumno', function() {
   $.ajax({
    url:"php/files_encuesta/buscar_alumno.php",
    method:"POST",
    global:false,
    beforeSend:function(){
      $(".informacion").html("<img class='f' style='margin:auto 45%; position:absolute;' src='../imagenes/espera.gif'></img>");
    },
    data:{nombre:$(this).val().trim(),encuesta:$(this).attr('encuesta')},
    success:function(respuesta){
          $(".f").css("display","none");
          $(".informacion").html(respuesta);
    }
  })
});



$(document).on('keyup', '#buscar_encuesta', function() {//sd
   $.ajax({
    url:"php/files_encuesta/buscar_encuesta.php",
    method:"POST",
    global:false,
    beforeSend:function(){
      $(".informacion").html("<img class='f' style='margin:auto 45%; position:absolute;' src='../imagenes/espera.gif'></img>");
    },
    data:{nombre:$(this).val().trim()},
    success:function(respuesta){
          $(".f").css("display","none");
          $(".informacion").html(respuesta);
    }
  })
}); 

 
$(document).on('keyup', '#Busqueda', function() {
   $.ajax({
    url:"php/files_preguntas/files_catalogo/busqueda.php",
    method:"POST",
    global:false,
    beforeSend:function(){
      $(".resultado").html("<img class='f' style='margin:auto 45%; position:absolute;' src='../imagenes/espera.gif'></img>");
    },
    data:{busqueda:$(this).val().trim(),tipo:$(this).attr('tipo'),catalogo:$("#catalogo").data("id_catalogo")},
    success:function(respuesta){
          $(".f").css("display","none");
          $(".resultado").html(respuesta);
    } 
  })
});
 
  
$(document).on('keyup', '#Busqueda2', function() {
   $.ajax({
    url:"php/files_respuestas/files_catalogo/busqueda.php",
    method:"POST",
    global:false,
    beforeSend:function(){
      $(".resultado").html("<img class='f' style='margin:auto 45%; position:absolute;' src='../imagenes/espera.gif'></img>");
    },
    data:{busqueda:$(this).val().trim(),tipo:$(this).attr('tipo'),catalogo:$("#catalogo").data("id_catalogo")},
    success:function(respuesta){
          $(".f").css("display","none");
          $(".resultado").html(respuesta);
    }
  })
});


$(document).on('click', '.agregar_new_respuesta', function() {
  var id_r=$(this).data('id_catalogo');
   alertify.confirm('CONFIRMACIÓN','¿DESEAS AGREGAR MÁS RESPUESTAS AL catálogo?',function(){
    location.href=url+'Add_cat_respuesta-'+id_r;
  },'');
});


$(document).on('click', '.agregar_new', function() {
  var id_p=$(this).data('id_catalogo');
   alertify.confirm('CONFIRMACIÓN','¿DESEAS AGREGAR MÁS PREGUNTAS AL catálogo?',function(){
    location.href=url+'Add_cat_pregunta-'+id_p;
  },'');
});

$(document).on("click",".mostrar_data",function(){
  var id_encuesta=$(this).val();
  $.ajax({
    url:"php/files_encuesta/Conteo.php",
    method:"POST",
    data:{idencuesta:id_encuesta},
    success:function(respuesta){
      $(".c").text("Conteo de preguntas");
          $("#dt").html(respuesta);
    }
  })
})

$(document).on("click",".bono_agregado",function(){
  $.ajax({
    url:"php/files_encuesta/mostrar_ganadores.php",
    method:"POST",
    data:{id_encuesta:$(this).data("id_encuesta")},
    success:function(respuesta){
          $(".c").text("Detalles del Bono");
          $("#dt").html(respuesta);
    }
  })
})


$(document).on("click",".buscar_ganador",function(){
   $.ajax({
    url:'php/files_encuesta/Datos_ganador.php',
    method:'POST',
    data:{codigo:codigo.value},
    success:function(respuesta){
      $("#dt").html(respuesta);
    }
  })
})



$(document).on('click','.g_bono',function(){
  var bono=$(".bono").val();
  var numero=$(".numero").val();
  var encuesta=$(".encuesta").data('id_encuesta');
  if (bono == 0) {
    alertify.error("Debe seleccionar un Articulo.");
  } else if(parseInt(numero) < 1 || numero.trim()==='') {
    alertify.error("Los Articulos deben ser mayor a cero!");
  }else{
    $.ajax({
        url:'php/files_encuesta/Agregar_bono.php',
        method:'POST',
        data:{id_encuesta:encuesta,bono:bono,numero:numero},
        success:function(respuesta){
           if (respuesta==1) {
            alert('Bono Agregado Correctamente!');
            $("#dt").text('');
            location.href=url+'Encuestas_creadas';
           }else{
            alert(respuesta);
           }
        }
      })
  }
});

$(document).on('click',".agree-bono",function(){
  $(".c").text('Agregar Bonos');
  $.ajax({
    url:'php/files_encuesta/Agregar_bono_a_encuesta.php',
    method:'POST',
    data:{id_encuesta:$(this).data('id_encuesta')},
    success:function(respuesta){
      $("#dt").html(respuesta);
    }
  });
});




$(document).on('click','#registro_bono',function(){
  if(nom.value.trim()===''){
    alertify.error('Error verificar nombre');
    nom.focus()
  }else if(desc.value.trim()===''){
    alertify.error('Error verificar la descripción');
    desc.focus();
  }else{
    $.ajax({
      url:'php/bono/insertar_bono.php',
      method:'POST',
      data:{nom:nom.value.trim(),desc:desc.value.trim()},
      success:function(respuesta){
          if(respuesta==1){
              $("#nom").val('');
              $("#desc").val('');
              alertify.success('Bono agregado correctamente');
          }else{
            alertify.error('Ocurrio un error!'+respuesta);
          }
      }
    })

  }
}) 
 


$(document).on("click",".resultados",function(){
  $.post('php/files_encuesta/respuestas_encuesta_alumno.php', { matricula:$(this).data('id_matricula')}).done(function(respuesta){
  $("#dt").html(respuesta);
 })
})

 
$(document).on("click",".status",function(){
    var id_encuesta=$(this).data('id_encuesta');  
    var status=$(this).data('id_valor');
 
 $.post('php/files_encuesta/otro.php', {id_encuesta:id_encuesta,status:status }).done(function(respuesta){
   carga_datos();
 })
 
}) 

$('#registro_alumno').click(function() {
  var date=new Array();
  var datos=document.getElementsByClassName('form-control');

      for (var i = 0; i < datos.length; i++) {
        if($(datos[i]).val().trim()==='' || $(datos[i]).val()== 0 || (i==5 && isNaN($(datos[i]).val()))){
            datos[i].focus();
            alertify.error('Verifica los datos');
             break;
        }else{
          date[i]=$(datos[i]).val();
        }
      }
      if(date.length== datos.length){
        $.post('./php/registros/registrar_encuestador.php', {alumno: date}).done(function(respuesta){
            console.log(respuesta);
            if(respuesta==1){
              alertify.success('Registro Exitoso');
              for (var i = 0; i < datos.length; i++) {
                if(i==4){
                    $(datos[i]).val('0');
                }else{
                  $(datos[i]).val('');
                }
              }
            }else{
              alert('Ocurrio un Error, es posible que la matricula ya se encuentre registrada!'+ respuesta);
            }
        });
      }
}); 

 
 
$(document).on("change","#tipo_catalogo",function(){
      if($(this).val() > 0){
         $.ajax({ 
            url:"php/files_respuestas/files_catalogo/mostrar_catalogos_creados.php",
            method:"POST",
            global:false,
            beforeSend:function(){
               $(".contenido_catalogo").html("<img class='f' style='margin:auto 45%; position:absolute;' src='../imagenes/espera.gif'></img>");
              },
            data:{id_encuesta:$(this).val()},
            success:function(respuesta){
                $(".f").css('display', 'none');
                $(".contenido_catalogo").html(respuesta);
            }
          })
      }else{
        $(".contenido_catalogo").html('');
      }
})

$(document).on("click",".mostrar_encuesta",function(){
 $(".c").text('ENCUESTA CREADA');
     $.ajax({
        url:"php/files_encuesta/mostrar_encuesta.php",
        method:"POST",
        data:{id_encuesta:$(this).data('id_encuesta')},
        success:function(respuesta){
            $("#dt").html(respuesta);
        }
    }) 
})
 

$(document).on("click",".elim_respuesta",function(){
  var uno=$(this).data('id_catalogo');
  var dos=$(this).data('id_respuesta');
  var tres=$(this).data('id_update');
  alertify.confirm('CONFIRMACIÓN','¿ESTAS SEGURO DE DESHABILITAR ESTA RESPUESTA?',function(){
    $.ajax({
      url:"php/files_respuestas/files_catalogo/delete_respuesta.php",
      method:"POST",
      global:false,
      data:{id_catalogo:uno,id_respuesta:dos,tres:tres},
      success:function(respuesta){
        $("#dt").html(respuesta);
      }
    })
  },'');
})


$(document).on("click",".detalle_catalogo_respuesta",function(){
$.ajax({
    url:"php/files_respuestas/files_catalogo/detalle_catalogo.php",
    method:"POST",
    global:false,
    data:{id_catalogo:$(this).data('id_catalogo_respuesta')},
    success:function(respuesta){
      $("#respuesta").hide();
      $("#update_catalogo_respuesta").css('display','none');
      $(".text-center").html('¡DESHABILITAR RESPUESTA!<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>');
      $("#dt").html(respuesta);
    }
  })

})
 
$(document).on("click",".elim_catalogo_respuesta",function(){
  var uno =$(this).data('id_catalogo_respuesta');
  var dos=$(".tipo_catalogo").val();
  var tres=$(this).data('id_update');
 
 alertify.confirm('CONFIRMACIÓN','¿ESTAS SEGURO DE DESHABILITAR ESTE CATALOGO',function (){
  $.ajax({
    url:"php/files_respuestas/files_catalogo/delete.php",
    method:"POST",
    data:{id_catalogo:uno,tipo:dos,tres:tres},
    success:function(respuesta){
      carga_datos();
    }
  })
 },'');

})


$(document).on("click","#update_catalogo_respuesta",function(){
  $.ajax({
    url:"php/files_respuestas/files_catalogo/actualizar.php",
    method:"POST",
    global:false,
    data:{tipo:$('.tipo_catalogo').val(),id_catalogo:$("#update_cat_respuesta").attr('id_catrespuesta'),catalogo:$("#update_cat_respuesta").val()},
    success:function(respuesta){
      carga_datos();
    }
  })
})


$(document).on('click',".renom_catalogo_respuesta",function(){
  $(".text-center").html('¡RENOMBRAR CATALOGO!<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>');
  $.ajax({
    url:"php/files_respuestas/files_catalogo/update.php",
    method:"POST",
    global:false,
    data:{id_catalogo_respuesta:$(this).data('id_catalogo_respuesta')},
    success:function(respuesta){
      var datos=JSON.parse(respuesta);
      $("#dt").html("");
      $("#update_catalogo_respuesta").css('display','block');
      $("#respuesta").css("display","block");
      $("#update_cat_respuesta").val(datos['nom_cat_respuesta']);
      $("#update_cat_respuesta").attr("id_catrespuesta",datos['idcatalogo_r'])
    }
  })
})


$(document).on("click",".elim_pregunta",function(){
  var id_pregunta=$(this).data('id_pregunta');
  var id_catalogo=$(this).data('id_catalogo');
  var update=$(this).data('id_update');
  
    if (update==1) {
        var texto="¿ESTAS SEGURO DE DESHABILITAR ESTA PREGUNTA?";
    } else {
        var texto="¿ESTAS SEGURO DE HABILITAR ESTA PREGUNTA?";
    }

   alertify.confirm('CONFIRMACIÓN',texto,function(){
  $.ajax({
    url:"php/files_preguntas/files_catalogo/delete_pregunta.php",
    method:"POST",
    global:false,
    data:{id_pregunta:id_pregunta,id_catalogo:id_catalogo,update:update},
    success:function(respuesta){
      $("#dt").html(respuesta);
    }
  })
},"");
})



$(document).on('click',".renom_catalogo_pregunta",function(){
  $(".text-").text('Renombrar catálogo');
  $.ajax({
    url:"php/files_preguntas/files_catalogo/update.php",
    method:"POST",
    global:false,
    data:{id_catalogo:$(this).data('id_catalogo')},
    success:function(respuesta){
      var datos=JSON.parse(respuesta);
      $("#update_catalogo_pregunta").css('display','block');
      $("#dt").html("");
      $("#pregunta").css("display","block");
      $("#update_cat_pregunta").val(datos['nom_cat_pregunta']);
      $("#update_cat_pregunta").attr("id_catpregunta",datos['idcatalogo_p'])
     
    }
  })
})
 

$(document).on("click","#update_catalogo_pregunta",function(){
  $.ajax({
    url:"php/files_preguntas/files_catalogo/actualizar.php",
    method:"POST",
    data:{id_catalogo:$("#update_cat_pregunta").attr("id_catpregunta"),catalogo:$("#update_cat_pregunta").val()},
    success:function(respuesta){
     carga_datos();
    }
  })
})

$(document).on("click",".elim_catalogo_pregunta",function(){
 var id_catalogo=$(this).data('id_catalogo');
 var update=$(this).data('id_update');

  if (update==1) {
      var texto='¿ESTAS SEGURO DE DESHABILITAR ESTE CATÁLOGO?';
  } else {
      var texto='¿ESTAS SEGURO DE HABILITAR ESTE CATÁLOGO?';
  }


 alertify.confirm('CONFIRMACIÓN',texto,function(){
 $.ajax({
    url:"php/files_preguntas/files_catalogo/delete.php",
    method:"POST",
    data:{id_catalogo:id_catalogo,update:update},
    success:function(respuesta){
      console.log(respuesta);
      if (respuesta == 1) {
        carga_datos();
      } else {
        alertify.error("Ocurrio un error");
      }
    }
  })
},"");

})
 
 
$(document).on("click",".detalle_catalogo_pregunta",function(){
$.ajax({
    url:"php/files_preguntas/files_catalogo/detalle_catalogo.php",
    method:"POST",
    data:{id_catalogo:$(this).data('id_catalogo')},
    success:function(respuesta){
      $("#pregunta").hide();
      $("#update_catalogo_pregunta").css('display','none');
      $(".text-").text('¡Deshabilitación de preguntas!');
      $("#dt").html(respuesta); 
    } 
  })
})


$(document).on("click","#updateresp",function(){

  var id_respuesta=$("#update_respuesta").data('id_respuesta');
 
  if(update_respuesta.value.trim()===''){
    alertify.error('Ocurrio un error y no se actualizo la pregunta.');
  }else{
    $.ajax({ 
      url:'php/files_respuestas/update.php',
      method:"POST",
      data:{respuesta:$("#update_respuesta").val(),id_respuesta:$("#update_respuesta").attr("id_respuesta")},
      global:false,
      success:function(respuesta){
        if (respuesta==1) {
            alertify.success("Actualización Exitosa!!",2);
            carga_datos();
        } else {
            alertify.error("Ocurrio un Error!!",2);
        }
      }
    })
  }

})

  
$(document).on("click","#update",function(){
  console.log(update_pregunta.value);
  var id_pregunta=$("#update_pregunta").data('id_pregunta');
  if(update_pregunta.value.trim() === ''){
    alertify.error('Ocurrio un error y no se actualizo la pregunta.');
  }else{
    $.ajax({
      url:'php/files_preguntas/update.php',
      method:"POST",
      data:{pregunta:$("#update_pregunta").val(),id_pregunta:$("#update_pregunta").attr("id_pregunta")},
      global:false,
      success:function(respuesta){
        console.log(respuesta);
          if (respuesta==1) {
              alertify.success("Actualización Exitosa!!",2);
            carga_datos();
           } else {
              alertify.error("Ocurrio un Error!!",2);
          }
      }
    })
  }
})

$(document).on("click","#Borrar",function(){
  var id=$(this).data('id_pregunta');
   alertify.confirm('CONFIRMACIÓN','¿ESTAS SEGURO DE BORRAR ESTA PREGUNTA?',function(){
     
      $.ajax({
        url:'php/files_preguntas/delete.php',
        method:"POST",
        data:{id_:id},
        success:function(respuesta){
             if(respuesta==1){
                alertify.success("Pregunta eliminada correctamente!!",2);
                
                carga_datos();
              }else{
                alertify.error("Ocurrio un error al eliminar!",2);
              }
         }
  })
   },'');
})


$(document).on("click","#Borrarrespuesta",function(){
 
  var id=$(this).data('id_respuesta');
    alertify.confirm('CONFIRMACIÓN','¿ESTAS SEGURO DE BORRAR ESTA RESPUESTA?', function(){ 
          $.ajax({
            url:'php/files_respuestas/delete.php',
            method:"POST",
            data:{id_:id},
            global:false,
            success:function(respuesta){
              //console.log(respuesta);
                if (respuesta==1) {
                  alertify.success("Respuesta eliminada correctamente!!",2);
                  carga_datos();
                } else {
                  alertify.error("Ocurrio un Error!!",2);
                }
              }})
    },'');
})

 
$(document).on('click','#Editar',function (){
  console.log($(this).data('id_pregunta'));
  $.ajax({
    url:'php/files_preguntas/actualizar.php',
    method:'POST',
    data:{id_pregunta:$(this).data('id_pregunta')},
    success:function(respuesta){
            //$('.modal-body').html(respuesta);
          var data= JSON.parse(respuesta);
          $("#update_pregunta").val(data['nom_pregunta']);
          $("#update_pregunta").attr('id_pregunta',data['idpregunta']);
        }
  })
})


$(document).on('click','#Editarrespuesta',function (){
  $.ajax({
    url:'php/files_respuestas/actualizar.php',
    method:'POST',
    data:{id_respuesta:$(this).data('id_respuesta')},
    success:function(respuesta){
            var data= JSON.parse(respuesta);
          $("#update_respuesta").val(data['nom_respuesta']);
          $("#update_respuesta").attr('id_respuesta',data['idrespuesta']);
        }
  })
})


$(document).on("click","#pinsert",function(){
    var palabra=pregunta.value.trim();
 
    if(pregunta.value.trim()===''){
        alert("Error, Debes escribir una pregunta!");
        pregunta.focus();
      }else{
        
        if (palabra[0]!== String.fromCharCode(191)) {
            palabra='¿'+pregunta.value;
          }
      
        if (palabra[((palabra.length)-1)] !== String.fromCharCode(63)) {
            palabra=palabra+'?';
          }
 
      $.ajax({
           url:'php/files_preguntas/preguntas.php',
           method:"POST",
           data:{pregunta:palabra.trim()},
           global:false,
           success:function(data){
            console.log(data);
                  if(data > 0){
                      alert("Esta pregunta ya se encuetra registrada");
                  }else{
                      $("#pregunta").val("");
                      carga_datos();
                  }
          }
        })
    }
});


  $(document).on("click","#insertrespuesta",function(){
    var respuesta=$("#respuesta").val(); 

    if(respuesta.trim()===''){
        alert("Error, favor de verificar los datos!");
      }else{

    $.ajax({
      url:'php/files_respuestas/respuestas.php',
      method:"POST",
      data:{respuesta:respuesta.trim()},
      success:function(data){
         if(data == 0){
            alertify.error("Esta respuesta ya se encuetra registrada");
         }else if (data == 1){
          alertify.success("¡¡Se agregó correctamente!!",1.5);
            $("#respuesta").val("");
            carga_datos();

         }else{
            alertify.error("Ocurrio un error!!");
         }
      }
    });
      }

  });



$('.pcatalogo_rx').click(function() { 

      if(nom_catalogo.value.trim()===''){
        alertify.error('Error verificar el nombre del catálogo');
        nom_catalogo.focus();
    }else if(tipo_catalogo.value==0){
        alertify.error('Error debe seleccionar un tipo');
        tipo_catalogo.focus();
    }else if(id.length==0){
        alertify.error('Error debe seleccionar respuestas');
    }else{
      $.post("php/files_respuestas/creacion_catalogo.php",{id:JSON.stringify(id),nombre:nom_catalogo.value,tipo:tipo_catalogo.value}).done(function(data){
      console.log(data);
      if(data==0){
        alertify.error('El nombre del catálogo ya existe!');
      }else {
            contador=0;
            p.splice(0,p.length);
            id.splice(0,id.length);
            $("#dt").text('');
            $(tipo_catalogo).val("0");
            $("#nom_catalogo").val("");
            alertify.success(data);

      }
    });
    }
});


  function mostrar(){
    $("#dt").text('');
    var html="<table class='table table-bordered'> <thead class='unach-table'> <tr style='color:white;'><td>#</td><th>"+titulo+"</th><th>Eliminar</th></tr></thead>";
   
    $.each(p, function(index, val) {
       html+="<tr><td>"+(index+1)+"</td><td>"+val+"</td><td><button class='btn btn-danger btn-block' onclick='eliminar("+index+")' >Eliminar</button></td></tr>";
    });
    html+="</table>";
     $("#dt").html(html);
  }

function eliminar(index){
  if (index > -1) {
    p.splice(index,1);
    id.splice(index,1);
    contador--;
  }
  mostrar();
}
  

$(document).on('click', '.Add_catalogo_r', function() {
    
    if(id.length==0){
        alertify.error('Debe tener respuestas en el catálogo');
    }else{
      $.post("php/files_respuestas/files_catalogo/Add_catalogo_respuesta.php",{id:JSON.stringify(id),id_:$(catalogo).data('id_catalogo')}).done(function(data){
          if(data==1){
            contador=0;
            p.splice(0,p.length);
            id.splice(0,id.length);
            $("#dt").text('');
            alert('SE HAN AGREGADO CORRECTAMENTE');
            location.reload();
          }else{
              alertify.error('Ocurrio un error! '+data);
          }
      });
  }
 });


 $(document).on('click', '.Add_catalogo_p', function() {
    
    if(id.length==0){
        alertify.error('Debe tener preguntas en el catálogo');
    }else{
      $.post("php/files_preguntas/files_catalogo/Add_catalogo_pregunta.php",{id:JSON.stringify(id),id_:$(catalogo).data('id_catalogo')}).done(function(data){
          console.log(data);
          if(data==1){
            contador=0;
            p.splice(0,p.length);
            id.splice(0,id.length);
           alert('SE HAN AGREGADO CORRECTAMENTE');
          location.reload();
           $("#dt").text('');
          }else{
              alertify.error('Ocurrio un error!');
          }
      });
  }
 });
 

 $(document).on('click', '.Guardar_catalogo_p', function() {
     // console.log(JSON.stringify(id));
      if(nom_catalogo.value.trim()===''){
        nom_catalogo.focus();
        alertify.error('Error verificar el nombre');
    }else if(id.length==0){
        alertify.error('Debe tener preguntas en el catálogo');
    }else{
      $.post("php/files_preguntas/catalogo_pregunta.php",{id:JSON.stringify(id),nombre:nom_catalogo.value}).done(function(data){
         console.log(data);
          if(data==0){
            alertify.error('El nombre del catálogo ya existe!');
          }else{
            $("#nom_catalogo").val("");
            contador=0;
            p.splice(0,p.length);
            id.splice(0,id.length);
            alert('CATÁLOGO CREADO CORRECTAMENTE');
          }
      });
  }//Cambio para el sistema
 });

$('#pcatalogo_').click(function() {
    titulo='Preguntas';
    mostrar();
});

$('#pcatalogo_r').click(function() {
  titulo='Respuestas';
    mostrar();
});


////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////
    var pre = document.getElementsByClassName('pregunta');
    var contenedor = document.getElementById('con'); 
    var contador =0;
    var tam = 460;
    var control = 0;
    var caja = new Array();
    var aux = 0;
/////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////
    function movimiento(ObjetoHtml){
        
        for (var i = 0; i < ObjetoHtml.length; i++) {
            
            ObjetoHtml[i].addEventListener('dragstart',function (ev) {
            var clon= document.getElementById(ev.target.id).cloneNode(true);
            
            $(clon).removeAttr('id');
            $(clon).removeClass(ev.target.className);
            clon.classList.add('col-md-12');
            clon.classList.add('informacion');
            clon.classList.add('elim'+contador);
            $(clon).append('<button type="button" data-id_busqueda="'+aux+'" data-id_pegar="datos" data-id_mostrar=".dev'+contador+'"  data-id_borrar=".elim'+contador+'" class="close">&times;</button>');
             
            ev.dataTransfer.setData("Data", clon.outerHTML);
            ev.dataTransfer.setData("text", ev.target.innerHTML);
            contador++;
            console.log(clon);
        },false);
            
        } 

    }

    movimiento(pre);
    
    $(document).on("click",".close",function(){

      var pregunta= document.getElementsByClassName('informacion');

      $(pre).attr('draggable', 'true');
      if(pregunta.length >= 9){
          tam=tam-40;
      }
      
      caja.splice($(this).data('id_busqueda'),1);
      $("#con").css('height', tam+'px');
      $($(this).data('id_borrar')).removeClass('informacion');
      
      if($($(this).data('id_borrar')).data('id_control')=="pregunta"){
        aux--;
      }
      
      $($(this).data('id_borrar')).hide();
      console.log(caja); 
    });

    function allowDrop(ev) {
        ev.preventDefault();
    }

 
    contenedor.addEventListener('drop',function(ev){ev.preventDefault();
      console.log(ev);
      var pregunta= document.getElementsByClassName('informacion');
      var resp=document.getElementsByClassName('respuesta');
      var boolean=false;
      
      if(caja.length > 0){
        for (var i = 0; i < caja.length; i++) {
          if (caja[i]==ev.dataTransfer.getData("text")) {
            alert("Esta pregunta ya se encuentra registrada");
            boolean=true;
          }
        }
        if(!boolean){
          $(this).append(ev.dataTransfer.getData("Data"));
          
          if(ev.dataTransfer.getData("Data").trim()!==''){
            if(pregunta.length >= 9){
              tam=tam+40;
              $(this).css('height', tam+'px');
              $(".superior").animate({scrollTop:tam, scrollLeft:0},1);
            }
          }
        }
      }else{
        $(this).append(ev.dataTransfer.getData("Data"));
        if(ev.dataTransfer.getData("Data").trim()!==''){
           if(pregunta.length >= 9){
              tam=tam+40;
              $(this).css('height', tam+'px');
              $(".superior").animate({scrollTop:tam, scrollLeft:0},1);
            }
        }

      }

          
        if($(pregunta[(pregunta.length)-1]).data('id_control') =='pregunta') {
          
          control=control+1;
          caja[aux]=ev.dataTransfer.getData("text");
          pregunta[(pregunta.length)-1].classList.add(control);
          $(pregunta[(pregunta.length)-1]).css('background', 'rgba(163,43,37,1)');
          $(pregunta[(pregunta.length)-1]).css('color', 'white');
          $(pre).removeAttr('draggable');          
          var resp=document.getElementsByClassName('respuesta');
          movimiento(resp);
          aux++;
        }else{
          pregunta[(pregunta.length)-1].classList.add(control);
          $(pregunta[(pregunta.length)-1]).css('background', 'rgba(158,186,33,1)');
          $(pregunta[(pregunta.length)-1]).css('color', 'white');
          $(pre).attr('draggable', 'true');
        }
      //  $(pregunta[(pregunta.length)-1]).attr('ondragenter', 'MovePanelEnter(event)');
       // $(pregunta[(pregunta.length)-1]).attr('ondrop', 'MovePanelExit(event)');


    },false);
 /*

  function MovePanelEnter(element){
    element.target.style.marginLeft="10px";
  }

  function MovePanelExit(element){
    console.log("Lo solto");
  }
*/





  $('#Guardarx').click(function() {
    var nombre=$("#nom_encuesta").val();
    var descripcion=$("#descripcion").val();
    var tiempo=$("#tiempo").val();

    if (nombre.trim()==='') {
        alertify.error('Error, debe darle un nombre a la encuesta');
    } else if (descripcion.trim()==='') {
      alertify.error('Error, Agrege una breve descripción');
    }else{

      var pregunta= document.getElementsByClassName('informacion');
      var requeridas=document.getElementsByClassName('rqd');
      var contenido=new Array();
      var acumulado=0; 
    
    if (pregunta.length > 1) {

      for (var i = 0; i < requeridas.length; i++) {
          if ($(requeridas[i]).prop("checked")) {
              contenido[i]=1;
          }else{
              contenido[i]=0; 
          }
      }

      var lista ={'datos' :[] };
      var lista2 ={'datox' :[] };
      var id='';

        for (var i = 0; i < pregunta.length; i++) {
                
                if($(pregunta[i]).data('id_control')=='pregunta'){
                  
                   id=$(pregunta[i]).data('id_encuesta');
                   lista2.datox.push({
                      "pregunta":id,
                      "status":contenido[acumulado++]
                    });
                
                }else{
                  lista.datos.push({
                    "pregunta":id,
                    "respuesta":$(pregunta[i]).data('idcat')
                  });
                }
          }
$.post("php/assets/diseno.php",{pregunta:JSON.stringify(lista2),json:JSON.stringify(lista),nom:nombre,desc:descripcion,tiempo:tiempo}).done(function(data){
    console.log(data);
    if (data==0) {
      alertify.error('Este nombre ya existe');
    } else if(data==1) {
        alert('Encuesta Creada Correctamente!');
        location.reload();
    }else{
      alertify.error('Ocurrio un error!');
    }

}); 
  
  }else{
    alertify.error("Debes crear una encuesta. Correctamente!");
  }

}

});
 
 
$('#seleccion').change(function() {

if($(this).val() > 0){
    $.ajax({
      url: 'php/assets/datos.php',
      method:'POST',
      global:false,
      beforeSend:function(){
        $(".data").html("<img class='f' style='margin:auto 15%;' src='../imagenes/espera.gif'></img>");
      },
      data: {id:$(this).val()},
      success:function(data){
        $(".f").css('display', 'none');
        $('.data').html(data);
    }
  }).done(function(){
     
     var numero= document.getElementsByClassName('informacion');
  
      if(numero.length > 0){
        var resp=document.getElementsByClassName('respuesta');
        movimiento(resp);
      }
  })

  }else{
    $('.data').text('');
  }

});

$(document).on('keyup','#busqueda_pregunta_', function() {
  $.ajax({
    url:'php/files_encuesta/buscar_pregunta.php',
    method:'POST',
    global:false,
    data:{pregunta:$(this).val()},
    beforeSend:function(){
       $(".busqueda_pregunta").html("<img class='f' style='position:absolute; margin:auto 0;' src='../imagenes/espera.gif'></img>");
    },
    success:function(respuesta){
      var datos=JSON.parse(respuesta);
      $(".f").css('display', 'none');
      var html="";
      $.each(datos, function(index, val) {
         html+="<div id='pregunta_"+val['idpregunta']+"' draggable='true' style='cursor: pointer; padding:5px; border-radius:8px; margin-top:3px;' data-id_control='pregunta' data-idcat='null'  data-id_encuesta='"+val['idpregunta']+"' class='pregunta'>"+val['nom_pregunta']+"</div>";
      });
      $(".busqueda_pregunta").html(html);
    }
  }).done(function(){
    var pregunta=document.getElementsByClassName('pregunta');
    movimiento(pregunta);
  })
});





