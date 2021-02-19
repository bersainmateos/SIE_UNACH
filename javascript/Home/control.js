const url=$('.socket').attr('url');
 
$("#login").click(function(ev){ 
	 ev.preventDefault();
			$.ajax({
				url:"./php/login.php",
				method:"POST",
				data:{usuario:usuario.value.trim(),password:password.value.trim()},
				success:function(respuesta){
					console.log(respuesta);
					if (respuesta==1) {
						location.href=url+'Egresado';
					}else{
						alertify.error('¡Lo sentimos usuario y/ó contraseña es incorrecta !');
					}
				}
			})
		}

	)


function capturar(nombre, required, inicio, fin) {
	var id_encuesta=nombre;
	var cont=0;
	var lista ={'datos' :[] };
	var numero=required;
 	var contador=0;

	for (var i = inicio; i < fin; i++) {
			contador++;
			if($("."+i).data('ver_tipo')=='libre' && $("."+i).data('requerida')==1 ){
				if ($("."+i).val().trim()==='') {
					alertify.error("Te falta la pregunta # "+contador,3);
				} else{
					cont++;
				}
		}else if($("."+i).data('ver_tipo')=='radio' && $("."+i).data('requerida')==1 ){
			var x=0;
			$("."+i+":checked").each(function(){
				x++;
   			});
   			if (x > 0) {
   				cont++;
   			}else{
   				alertify.error("Te falta la pregunta # "+contador,3);
   			}
		}else if($("."+i).data('ver_tipo')=='multi' && $("."+i).data('requerida')==1){
			var y=0;
			$("."+i+":checked").each(function(){
				++y;
   			});
   				if (y > 0) {
   					cont++;
   			}else{
   				alertify.error("Te falta la pregunta # "+contador,3);
   			}
		}

	}

console.log("Total de preguntas obligatorias= "+numero+" "+"Preguntas respondidas= "+cont);

if (numero==cont) {

	for (var i = inicio; i < fin; i++) {
			
		if($("."+i).data('ver_tipo')=='libre'){
			lista.datos.push({
   				"pregunta": $("."+i).data('id_pregunta'),
   				"respuesta":$("."+i).val(),
   				"idrespuesta":'null'
 	 		});
		}else if($("."+i).data('ver_tipo')=='radio'){
			$("."+i+":checked").each(function(){
		      		lista.datos.push({
   						 "pregunta": $(this).data('id_pregunta'),
   						 "respuesta": $(this).data('id_res'),
   						 "idrespuesta":$(this).data('id_respuesta')
 	 					});
   			});
		}else if($("."+i).data('ver_tipo')=='multi'){
		    $("."+i+":checked").each(function(){
		      		lista.datos.push({
   						 "pregunta": $(this).data('id_pregunta'),
   						 "respuesta": $(this).data('id_res'),
   						 "idrespuesta":$(this).data('id_respuesta')
 	 					});
   			});
		}             
	}
 
	$.ajax({
		url:'php/aplicacion_encuesta/guardar_encuesta_resuelta.php',
		method:'POST',
		data:{json:JSON.stringify(lista),id_encuesta:id_encuesta},
		beforeSend:function(){
			$('.oculto'+id_encuesta).css('display','none');
			$('.img').css('display','block');
		},
		success:function(data){
			$('.img').css('display','none');
			console.log(data);
		if(data==0){
			alert("Error, Intente nuevamente y si continua este error hable con el Administrador!"+data);
			$('.oculto'+id_encuesta).css('display','block');
		}else if (data==1) {
			$('.c'+id_encuesta).addClass('-completed');
			$('.mensaje'+id_encuesta).css('display','block');
			$('.panels').css('height','170');
			send(id_encuesta);
			alertify.success("Encuesta Resuelta",3);

		}else if(data==2){
			alertify.error("Encuesta desactivada ó el tiempo para responderla se termino",2);
			$('.oculto'+id_encuesta).css('display','block');
		}else{
			$('.oculto'+id_encuesta).css('display','block');
			alertify.error('Ocurrio un error!',2);
		}
	}})

}}




$(document).on("click","#exampleModalCenter",function(){
	$("#respuesta").html("");
})

 

$(document).on("click","#busqueda",function(){
	
	if(curp.value.trim()==='' || curp.value.length < 18){
		alert("Escriba el formato correcto de la curp");
	}else{
		$.ajax({
		url:"php/persona/buscar_persona.php",
		method:"POST",
		data:{curp:$("#curp").val()},
		success:function(respuesta){
			if (respuesta==0) {
				$("#respuesta").html("<br><button class='btn btn-danger btn-block pasar' data-toggle='modal' data-target='.bd-example-modal-lg'> Registrar</button>");
			} else if(respuesta==1) {
				location.href=url+'Encuesta';
			}else{
				alert("Ocurrio un error"+respuesta);
			}
		}
	})
	}
})



$(document).on("click",".pasar",function(){
	$("#curp_d").val($("#curp").val());
})
 
$(document).on("click","#Guardarp",function(){
	if (nom.value.trim()==='') {
		alertify.error("Escriba un nombre");
		nom.focus();
	}else if(ape_pat.value.trim()===''){
		alertify.error("Escribe el apellido paterno");
		ape_pat.focus();
	}else if(ape_mat.value.trim()===''){
		alertify.error("Escribe el apellido materno");
		ape_mat.focus();
	}else if($("#municipio").val() == 0){
		alertify.error("Selecciona el municipio");
		municipio.focus();
	}else if($("#localidad").val() == 0){
		alertify.error("Selecciona la localidad");
		localidad.focus();
	}else if(jsanit.value.trim() === ''){
		alertify.error("Agrega el # de jurisdicción sanitaria");
		jsanit.focus();
	}else {
		$.ajax({
		url:"php/persona/guardar.php",
		method:"POST",
		data:{nombre:nom.value.trim(),ape_pat:ape_pat.value.trim(), ape_mat:ape_mat.value.trim(),localidad:localidad.value,curp:curp.value.trim(),jsanit:jsanit.value.trim()},
		success:function(respuesta){
			if (respuesta==1) {
				alert("Registro exitoso");
				location.href=url+'Encuesta';
			} else{
				alert("Ocurrio un error"+respuesta);
			}
		}
	})
	}
})

$(document).on("change","#municipio",function (){
	$.ajax({
		url:"php/persona/localidad.php",
		method:"POST",
		data:{id:$(this).val()},
		success:function (respuesta){
				$("#localidad").html(respuesta);
			
		}
	})


})