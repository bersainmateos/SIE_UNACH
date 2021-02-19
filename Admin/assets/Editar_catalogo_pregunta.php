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
         <p id="dt"></p>
        <div class="form-group" id="pregunta" style="display: none;">
          <input type="text" class="form-control " id="update_cat_pregunta" id_catpregunta="n" value="">
        </div>
      </div>
      <div class="modal-footer" id="footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
        <input type="button" value="Update" id="update_catalogo_pregunta"  data-dismiss="modal" class="btn btn-success" name="">
      </div>
    </div>
  </div>
</div>

		<div class="col-md-12 col-lg-12">
		<table id="encuestas" class='table table-bordered table-hover'>
            <thead class="unach-table">
             <tr style="color:white;">
              <th><center>NOMBRE CATÁLOGO</center></th>
              <th><center>OPCIONES</center></th>
              <th></th>
              <th></th>
              <th></th>
            </tr>
            </thead>
            <tbody class="contend">
            </tbody>    
        </table>
		</div>