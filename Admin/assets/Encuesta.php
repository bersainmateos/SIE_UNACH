<div >
<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true"> 
  <div class="modal-dialog  modal-sm modal-lg">
    <!-- Contenido del modal --> 
    <div class="modal-content">
      <div class="modal-header unach">
        <h2 style="color: white;" class="text-center" >Detalles de la Encuesta <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button> </h2>
      </div>
      <div class="modal-body"> 
        <label class="text-success font-weight-bold">Nombre:</label>
        <input type="text" class="form-control" id="nom_encuesta" placeholder="Nombre de la Encuesta">
        <label class="text-success font-weight-bold">Descripción:</label>
        <input type="text" class="form-control" id="descripcion" placeholder="Descripción">
        <label class="text-success font-weight-bold">Fecha fin de la encuesta:</label>
        <input type="date" min="<?php echo date("Y-m-d");?>" class="form-control" id="tiempo" value="<?php echo date('Y-m-d');?>">
        <div class="requerido">
          
        </div>
        <!-- <p id="dt">Texto del modal</p> -->
      </div>
      <div class="modal-footer" id="footer">
        <input type="button" value="Guardar" id="Guardarx" data-dismiss="modal" class="btn btn-success" name="">
      </div>
    </div> 
  </div>
</div>



<div class="modal fade x" id="dependencia" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
     <div class="modal-header unach">
        <h4 style="color: white;" class="text-center" >CREAR DEPENDENCIA <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button> </h4>
      </div>
      <div class="modal-body">
        
        <div class="dp">
          
        </div>
        <div class="dp2">
          
        </div>

      </div>
      <div class="modal-footer" id="footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button id="busqueda" type="button" class="btn btn-primary"><i style="font-size: 24;" class="glyphicon glyphicon-search"></i></button>
      </div>
    </div>
  </div>
</div>



    <div style="display: flex; height: 70%;"  >
    <div class="col-md-4" >
    <h2 class="text-center text-success" >PREGUNTAS</h2> <input id="busqueda_pregunta_" type="search" class="form-control" placeholder="Search..."><!--Aqui se realizará la busqueda de preguntas-->
<div style="overflow-y: scroll; width: 100%; height: 45%;"  >
  <div class="busqueda_pregunta">
   </div>

</div>

<div style="overflow-y: scroll; width: 100%; height: 50%;"  >
    
     <div id="acordeon">

 <?php
    $Encuesta=new OpenConexion();
    $indice=1;
    $variable=$Encuesta->cat_preguntas();
    foreach ($variable as $key => $value):
  ?>
  
   <div class="card">
        <div class="card-header encuestav">
           <center> <a href="#<?php echo $indice; ?>" class="btn btn-block" data-toggle="collapse" data-parent="#acordeon" ><?php echo $key; ?></a></center>
        </div>
         <div id="<?php echo $indice; ?>" class="collapse"> 
        <div class="card-body">
        <?php foreach ($value as $k => $op): ?>
              <div id="pregunta_<?php echo $op{'idpregunta'}; ?>" draggable="true" style="cursor: pointer; padding:5px; border-radius:8px; margin-top:3px;" data-id_control="pregunta" data-idcat="null"  data-id_encuesta="<?php echo $op{'idpregunta'}; ?>" class="pregunta"><?php echo $op{'nom_pregunta'}; ?></div> 
            
        <?php endforeach; ?>
        </div> </div> </div>
        <?php $indice++; endforeach; ?>
            <!--Fin-->
    </div> 


</div>
</div>
<div class="col-md-5 contenedor">
 <div class="superior well"  style="box-shadow: 0px 0px 7px 3px rgba(0,0,0,.4); scale:(1,1);   overflow-y: scroll; border-radius: 10px;">
    <div id="con" ondragover="allowDrop(event)" >
        
    </div>

    </div>
</div>

<div class="col-md-3" id="dc">
    
    <h2 class="text-center text-success" >RESPUESTAS</h2>
<select class="form-control" id="seleccion" style="cursor: pointer;" >
        <option value="0" >Seleccione</option>
        <option value="1" >Respuestas Única</option>
        <option value="2" >Respuestas Múltiples</option>
        <option value="3" >Fecha</option>
        <option value="4" >Libre</option>
        <option value="5" >Número</option>
    </select><br>
<div style="overflow-y: scroll; width: 100%; height: 90%;" id="resp">
     <div class="data">
       
     </div>

</div>
</div>
</div>
</div>

    <input type="button"  data-toggle='modal' data-target='.bd-example-modal-lg' value="Guardar" style="width: 50%; margin-left: 25%;" class="btn btn-danger fixed-bottom Rq ">
