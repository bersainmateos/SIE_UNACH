<?php 

	$Catalogo = new OpenConexion();

	$variable=$Catalogo->Conn->prepare("select nom_respuesta,idrespuesta, (CURRENT_DATE-fecha) AS fecha from respuesta where idrespuesta > 1 and status > 0  order by fecha asc");
	$variable->execute();

 ?>

<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog  modal-sm modal-lg">
    <!-- Contenido del modal -->
    <div class="modal-content">
       <div class="modal-header unach">
        <h2 style="color: white;" class="text-center" >Respuestas del cátalogo<button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button> </h2>
      </div>
      <div class="modal-body">
        <p id="dt"></p>
      </div>
      <div class="modal-footer" id="footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-info pcatalogo_rx" data-dismiss="modal" >Confirmar</button>
      </div>
    </div>
  </div>
</div>

<h2 class="text-center">
	<font size=5 color="#741086">CATÁLOGO DE RESPUESTAS</font>
</h2>

	<div  class="row well  col-lg-12" style="height: 71%;">
		<div class="col-lg-8">
			 <div class="form-group c_catalogo">
	  			<input type="text" placeholder="Nombre del catálogo" class="form-control" autocomplete="off" id="nom_catalogo"> 
		    			<h5 class="text-success text-center">Selecciona el tipo de respuestas del catálogo.</h5>
		    			<select class="select form-control" id="tipo_catalogo"  style="cursor: pointer;" >
		    				    <option value="0" >Seleccione</option>
      							<option value="1" >Respuestas Únicas</option>
        						<option value="2" >Respuestas Multiples</option>
		    			</select>
		  		</div>
		  		<div class="form-group">
		    			<input type="search" placeholder="Busquedar respuesta..." class="form-control" autocomplete="off" data-id_catalogo="null" tipo="1" id="Busqueda2">
		  			</div>
					<div style="width: 98%; height: 65%; overflow-y: scroll;" class="tabla_respuesta">
				<table class='table table-bordered'>
					<tbody class="resultado">
<?php

	$Datos=$variable->fetchAll(PDO::FETCH_ASSOC);				
	foreach ($Datos as $datos) {
	//while($datos=pg_fetch_array($variable)){
	echo "<tr class='resaltar' ><td  >".$datos['nom_respuesta']."</td>";
					if ($datos['fecha'] > 1) {
							echo "<td class='c' >Agregada hace ".$datos['fecha']." Dias.</td>";
						}else if ($datos['fecha']==0) {
							echo "<td class='c'>Agregada Hoy.</td>";
						}else{
							echo "<td class='c' >Agregada Ayer.</td>";
						}
						echo "<td><input data-id_valor='".$datos['idrespuesta']."' data-id_nom='".$datos['nom_respuesta']."' class='check rs' data-id_valor='".$datos['idrespuesta']."' type='checkbox' ></td></tr>";
					}
				?>
				</tbody>
				</table>
			</div>
				</div>

				<div  class="col-lg-4" style="height: 100%; overflow-y: scroll;">
					<h2 class="text-center">
					<font size=5 color="#741086">CATÁLOGOS CREADOS</font>
				</h2>

				<div class="contenido_catalogo">
					
				</div>
				</div>

				</div>
				<button style="margin-left: 87%; position: absolute;" class="r btn btn-success">Agregar al cátalogo</button>

				<button type="submit" class="btn btn-danger fixed-bottom" style="width: 50%; margin-left: 25%;"  id="pcatalogo_r" data-toggle='modal' data-target='.bd-example-modal-lg' >Guardar</button>
