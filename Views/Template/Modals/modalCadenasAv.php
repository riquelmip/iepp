<div class="modal fade" id="modalFormCadenaAv" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg" >
    <div class="modal-content">
      <div class="modal-header headerRegister">
        <h5 class="modal-title" id="titleModal">Nueva Cadena</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            <form id="formCadenaAv" name="formCadenaAv" class="form-horizontal">
              <input type="hidden" id="idCadena" name="idCadena" value="">
              <p class="text-primary">Todos los campos son obligatorios.</p>

              <div class="form-row">
                <div class="form-group col-md-12">
                  <label for="txtNombre">Nombre</label>
                  <input type="text" class="form-control valid" id="txtNombre" name="txtNombre" required="">
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-md-12">
                  <label for="divDetalles">Cadena Creada</label>
                 <div id="divDetalles"></div>
                </div>
              </div>
              <p class="text-primary">Seleccione los coros que llevará la cadena.</p>
             
              <div class="form-row">
                <div class="form-group col-md-6">
                  <div class="table-responsive">
                    <table class="table" id="tableDetallesCadenasAv">
                      <thead>
                          <tr>
                          <th>ID</th>
                            <th>Nombre</th>
                            <th>Acciones</th>
                          </tr>
                      </thead>
                      <tbody>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
              
              <div class="tile-footer">
                <button id="btnActionForm" class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i><span id="btnText">Guardar</span></button>&nbsp;&nbsp;&nbsp;
                <button class="btn btn-danger" type="button" data-dismiss="modal"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cerrar</button>
              </div>
            </form>
      </div>
    </div>
  </div>
</div>




<!-- Modal -->
<div class="modal fade" id="modalViewCadenaAv" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" >
    <div class="modal-content">
      <div class="modal-header header-primary">
        <h5 class="modal-title" id="titleModalV"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="modalViewBody">
        <p id="cadena"></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

