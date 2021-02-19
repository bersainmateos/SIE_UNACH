<div class="container">
	<div class="row">
<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true"> 
  <div class="modal-dialog  modal-sm modal-lg">
    <!-- Contenido del modal --> 
    <div class="modal-content">
      <div class="modal-header unach">
           <h2 style="color: white;" class="text-center"> <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button> <label class="text-"></label></h2>
      </div>
      <div class="modal-body">
        <p id="dt">Texto del modal</p>
        <div class="form-group" id="respuesta" style="display: none;">
          <input type="text" class="form-control " id="update_cat_respuesta" id_catrespuesta="n" value="">
        </div>
      </div>
      <div class="modal-footer" id="footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
        <input type="button" value="Update" id="update_catalogo_respuesta"  data-dismiss="modal" class="btn btn-success" name="">
      </div>
    </div> 
  </div>
</div>

<div class="form-group col-md-10 col-lg-12">
  <center><h3>Seleccione el tipo de catálogo</h3></center>
  <select class="form-control tipo_catalogo" onchange="carga_datos();" style=" cursor: pointer;">
   <!-- <option value="-1">Seleccione</option> -->
    <option value="0">Todos</option>
    <option value="1" >Respuesta Única</option>
    <option value="2" >Respuesta Multiple</option>
  </select>
</div>
		<div class="col-md-12 catalogo_respuesta"></div>

	</div>

</div>