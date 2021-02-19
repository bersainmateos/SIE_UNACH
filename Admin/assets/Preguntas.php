<div class="modal fade addpregunta" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog  modal-sm modal-lg">
    <div class="modal-content">
      <div class="modal-header unach">
        <h2 style="color: white;" class="text-center" >AGREGAR PREGUNTA<button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button></h2>
      </div> 
      <div class="modal-body"> 
        <hr>
		  <div class="form-group">
		     <div class="form-group">
		    	<input type="text" class="form-control" autocomplete="off" id="pregunta">
		  </div>
		  </div>
		 
      </div><br><br>
      <div class="modal-footer" id="footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
      	<button type="submit" data-dismiss="modal" class="btn btn-success" id="pinsert">Insertar</button>
      </div>
    </div>
  </div>
</div>



<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog  modal-sm modal-lg">
    <div class="modal-content">
      <div class="modal-header unach">
        <h2 style="color: white;" class="text-center" >ACTUALIZACIÓN DE PREGUNTAS<button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button></h2>
      </div> 
      <div class="modal-body">
        <div class="form-group">
          <input type="text" class="form-control " id="update_pregunta" id_pregunta="n" value="">
        </div> 
      </div><br><br>
      <div class="modal-footer" id="footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
      	<input type="button" value="¡Listo!" id="update"  data-dismiss="modal" class="btn btn-success" name="">
      </div>
    </div>
  </div>
</div>


<div class="col-md-12 col-lg-12">
<button class="btn btn-lg btn-primary" data-toggle="modal" data-target=".addpregunta" ><span style="font-size: 28px;" class="glyphicon glyphicon-plus-sign"></span></button> <br>
<hr>
	<table id="encuestas" class='table table-bordered table-hover'>
		<thead class="unach-table">
			<tr style="color:white;">
				<th>#</th>
				<th><center>PREGUNTA</center></th>
				<th><center>Actualizar</center></th>
				<th><center>Eliminar</center></th>
			</tr>
		</thead>
		<tbody class="contend">
		</tbody>
	</table>
</div>

<!---->