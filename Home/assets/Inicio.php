  <div  class="modal-dialog col-md-12" >
      <div class="modal-content " > 
          <div class="modal-header">
             <h2><font size=6 color="#741086"><i class="glyphicon glyphicon-log-in"></i> Acceso </font></h2>  
          </div>
          <div class="modal-body col-md-12">
              <div class="row " style="display: flex;" >
                  <div class="col-md-6">
                      <div class="well">


    <form  action="./php/login.php" method="POST">

      <div class="form-group">
        <label for="matricula">Correo</label>
        <input type="text" class="form-control" id="usuario" name="matricula" placeholder="Correo ">
      </div>
      <div class="form-group">
        <label for="password">Contraseña</label>
        <input type="password" class="form-control" id="password" name="password" placeholder="Contraseña">
      </div>
  <button type="submit" id="login" class="btn btn-success btn-block">Log In</button>  
      
    </form>
             </div>
                  </div>
                  <div class="col-md-6">
                      <b style="color:741086; font-size: 25px;">Información</b><br>
                      <ul class="list-unstyled" style="line-height: 2">
                                <li><span class="fa fa-check text-success"></span><b><font size=3 color="#741086">El acceso </font></b> 
              <div align="justify">
              a esta página es únicamente para la administración del 
              contenido del Sistema de Información de Recolección de Información.
              </div>
            </li>
                           
                      </ul>
                  </div>
              </div>
              </div>
              </div>
          </div>
        