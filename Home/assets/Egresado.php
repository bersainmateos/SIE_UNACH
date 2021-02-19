<?php   $Data = new OpenConexion(); ?>

<div class="modal fade x" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
     <div class="modal-header unach">
        <h4 style="color: white;" class="text-center" >INGRESA CURP <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button> </h4>
      </div>
      <div class="modal-body">
        <input type="search" class="form-control" id="curp">
        <div id="respuesta"></div>
      </div>
      <div class="modal-footer" id="footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button id="busqueda" type="button" class="btn btn-primary"><i style="font-size: 24;" class="glyphicon glyphicon-search"></i></button>
      </div>
    </div>
  </div>
</div>


<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true"> 
  <div class="modal-dialog  modal-sm modal-lg">
    <!-- Contenido del modal --> 
    <div class="modal-content">
      <div class="modal-header unach">
        <h2 style="color: white;" class="text-center" >Registro de personas<button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button> </h2>
      </div>
      <div class="modal-body"> 

      <div class="row ">
        <div class="col-md-4">
          <label>Nombre:</label>
          <input type="text" id="nom" class="col-md-12 form-control" name="">
        </div>
        <div class="col-md-4">
          <label>Apellido paterno:</label>
          <input type="text" id="ape_pat" class="col-md-12 form-control" name="">
        </div>
         <div class="col-md-4">
          <label>Apellido materno:</label>
          <input type="text" id="ape_mat" class="col-md-12 form-control" name="">
        </div>
      </div>
 
       <div class="row ">
        <div class="col-md-4">
           <label>Municipio:</label>
          <select class="form-control" id="municipio">
                  <option value="0">Seleccione</option>
                  <?php 

                      $municipio=$Data->Conn->query("select * from municipio");
                      while($nom=$municipio->fetch(PDO::FETCH_ASSOC)){
                        echo "<option value='".$nom['id_municipio']."'>".$nom['nom_municipio']."</option>";
                      } 
                   ?>
          </select>
        </div>
        <div class="col-md-4">
          <label>Localidad:</label>
          <select class="form-control" id="localidad">
                  <option value="0">Seleccione</option>
          </select>
        </div>
      </div>
       <div class="row ">
        <div class="col-md-4">
          <label># Jurisdicción sanitaria:</label>
          <input type="number" id="jsanit" class="col-md-12 form-control" name="">
        </div>
        <div class="col-md-4">
          <label>Curp</label>
          <input type="text" id="curp_d" disabled class="col-md-12 form-control" name="">
        </div>
      </div>
      </div>
      <div class="modal-footer" id="footer">
        <input type="button" value="Guardar" id="Guardarp"  class="btn btn-success" name="">
      </div>
    </div> 
  </div>
</div>

<br>
 <h2 class="text-muted">
    <font size="4" color="#741086">SISTEMA DE RECOLECCIÓN DE INFORMACIÓN</font>
  </h2>
        <br>
  <div class="card-deck text-center">
        <div class="card box-shadow">
          <div class="card-header bg-info">
            <h4 class="font-weight-normal">APLICAR ENCUESTA</h4>
          </div>
          <div class="card-body">
            <h5 class="card-title pricing-card-title text-muted">Aqui encontraras las diferentes encuestas</h5>
          </div>
          <div class="card-footer">
            <button data-toggle='modal' data-target='#exampleModalCenter' class="btn btn-block btn-success"> Buscar</button> </div>
        </div>
        <div class="card box-shadow">
         <div class="card-header bg-info">
            <h4 class="my-0 font-weight-normal">ADMINISTRAR PERFIL</h4>
          </div>
          <div class="card-body">
            <h5 class="card-title pricing-card-title text-muted">Realiza cambios en tú perfil de encuestador </h5>
            
          </div>
          <div class="card-footer"><a href="#" class="btn btn-lg btn-block btn-success">IR</a></div>
        </div>
      </div>
<br><br><br><br>