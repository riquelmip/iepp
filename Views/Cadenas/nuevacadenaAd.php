<?php 
  headerAdmin($data); 
 // getModal('modalCadenasAv',$data);
?> 
<main class="app-content">
      <div class="app-title">
        <div>
            <h1><i class="fas fa-user-tag"></i> <?= $data['page_title'] ?>
            </h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="<?= base_url(); ?>/Cadenas/CadenasAd"><?= $data['page_title'] ?></a></li>
        </ul>
      </div>
        <div class="row">
            <div class="col-md-12">
              <div class="tile">
                <div class="tile-body">
                  <form id="formCadenaAd" name="formCadenaAd" class="form-horizontal">
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
                        <input type="hidden" id="listaCoros" name="listaCoros">
                      <div id="divDetalles" name="divDetalles"></div>
                      </div>
                    </div>
                  
                    <div class="form-row text-center">
                      <div class="form-group col-md-12">
                        <div class="tile-footer">
                          <button id="btnActionForm" class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i><span id="btnText">Guardar</span></button>&nbsp;&nbsp;&nbsp;
                        </div>
                      </div>
                    </div>
                  </form>

                  <p class="text-primary">Seleccione los coros que llevará la cadena.</p>
                  <div class="form-row">
                      <div class="form-group col-md-12">
                        <div class="table-responsive">
                          <table class="table" id="tableDetallesCadenaAd">
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
                </div>
              </div>
            </div>
        </div>
</main>
<?php footerAdmin($data); ?>
    