<div class="modal fade DATOS" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog  modal-sm modal-lg">
    <!-- Contenido del modal -->
    <div class="modal-content">
      <div class="modal-header"><h1 class="text-info" >DATOS DEL GANADOR</h1>
      </div>
      <div class="modal-body">
        <p id="dt"></p>
      </div>
      <div class="modal-footer">
      	<button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

<div class="container">
	<div class="form-group">
		<h5 class="text-success">BUSQUEDA DE PREMIOS POR CÓDIGO!</h5>
		<input type="search" class="form-control" id="codigo" placeholder="Buscar ...">
		<br>
		<center><button data-toggle='modal' data-target='.DATOS' class="btn btn-danger btn-block buscar_ganador"><span class="glyphicon glyphicon-search">Buscar</span></button></center>
	</div>
</div>