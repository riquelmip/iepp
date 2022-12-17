<!-- Modal -->
<div class="modal fade" id="modalformPrivilegiosDomingos" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg" >
    <div class="modal-content">
      <div class="modal-header headerRegister">
        <h5 class="modal-title" id="titleModal">Nuevos Privilegios</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            <form id="formPrivilegiosDomingos" name="formPrivilegiosDomingos" class="form-horizontal">
              <input type="hidden" id="idPrivilegios" name="idPrivilegios" value="">
              <p class="text-primary">Todos los campos son obligatorios.</p>
            
              <div class="form-row">
                <div class="form-group col-md-4">
                  <label for="listDiaS">Dia</label>
                  <select class="form-control" id="listDiaS" name="listDiaS" required>
                    <option value="0">Seleccione dia del culto</option>
                    <option value="1">Domingo</option>
                    <option value="2">Lunes</option>
                    <option value="3">Martes</option>
                    <option value="4">Miercoles</option>
                    <option value="5">Jueves</option>
                    <option value="6">Viernes</option>
                    <option value="7">Sabado</option>
                  </select>
                </div>
                <div class="form-group col-md-4">
                  <label for="txtFecha">Fecha</label>
                  <input type="date" class="form-control" id="txtFecha" name="txtFecha" required="">
                </div>
                <div class="form-group col-md-4">
                  <label for="listTurno">Turno</label>
                  <select class="form-control" id="listTurno" name="listTurno" required>
                    <option value="1">Mañana</option>
                    <option value="2">Tarde</option>
                  </select>
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-md-3">
                  <label for="txtInicio">Inicio</label>
                </div>
                <div class="form-group col-md-9">
                  <input name="txtInicio" id="txtInicio" class="form-control valid validText" required>
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-md-3">
                  <label for="txtAlabanzas">Alabanzas</label>
                </div>
                <div class="form-group col-md-9">
                  <input name="txtAlabanzas" id="txtAlabanzas" class="form-control valid validText" required>
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-md-3">
                  <label for="txtCorosav">Coros de Avivamiento</label>
                </div>
                <div class="form-group col-md-9">
                  <input name="txtCorosav" id="txtCorosav" class="form-control valid validText" required>
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-md-3">
                  <label for="txtOfrenda">Ofrenda</label>
                </div>
                <div class="form-group col-md-9">
                  <input name="txtOfrenda" id="txtOfrenda" class="form-control valid validText" required>
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-md-3">
                  <label for="txtAlabanzaespecial">Alabanza Especial</label>
                </div>
                <div class="form-group col-md-9">
                  <input name="txtAlabanzaespecial" id="txtAlabanzaespecial" class="form-control valid" required>
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-md-3">
                  <label for="txtCorosad">Coros de Adoración</label>
                </div>
                <div class="form-group col-md-9">
                  <input name="txtCorosad" id="txtCorosad" class="form-control valid validText" required>
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-md-3">
                  <label for="txtMensaje">Mensaje</label>
                </div>
                <div class="form-group col-md-9">
                  <input name="txtMensaje" id="txtMensaje" class="form-control valid validText" required>
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-md-3">
                  <label for="txtAseoDomingos">Grupo de Aseo</label>
                </div>
                <div class="form-group col-md-9">
                  <select class="form-control" data-live-search="true" id="listGAseo" name="listGAseo" required>
                
                  </select>
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-md-3">
                  <label for="txtFloresDomingos">Grupo de Flores</label>
                </div>
                <div class="form-group col-md-9">
                <select class="form-control" id="listGFlores" data-live-search="true" name="listGFlores" required></select>
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
<div class="modal fade" id="modalViewPrivilegios" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" >
    <div class="modal-content">
      <div class="modal-header header-primary">
        <h5 class="modal-title" id="titleModalVC"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="modalViewBodyC">
      <table class="table table-bordered">
          <tbody>
            <tr>
              <td class="font-weight-bold">Inicio:</td>
              <td id="celInicio"></td>
            </tr>
            <tr>
              <td class="font-weight-bold">Alabanzas:</td>
              <td id="celAlabanzas"></td>
            </tr>
            <tr>
              <td class="font-weight-bold">Coros Avivamiento:</td>
              <td id="celCorosav"></td>
            </tr>
            <tr>
              <td class="font-weight-bold">Ofrenda:</td>
              <td id="celOfrenda">Larry</td>
            </tr>
            <tr>
              <td class="font-weight-bold">Alabanza Especial:</td>
              <td id="celAlabanzaespecial">Larry</td>
            </tr>
            <tr>
              <td class="font-weight-bold">Coros Adoración:</td>
              <td id="celCorosad">Larry</td>
            </tr>
            <tr>
              <td class="font-weight-bold">Mensaje:</td>
              <td id="celMensaje">Larry</td>
            </tr>
            <tr>
              <td class="font-weight-bold">Aseo:</td>
              <td id="celAseo">Larry</td>
            </tr>
            <tr>
              <td class="font-weight-bold">Flores:</td>
              <td id="celFlores">Larry</td>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

