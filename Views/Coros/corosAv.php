<?php 
  headerAdmin($data); 
  getModal('modalCorosAv',$data);
?> 
<main class="app-content">
      <div class="app-title">
        <div>
            <h1><i class="fas fa-user-tag"></i> <?= $data['page_title'] ?>
            <?php if (!empty($_SESSION['permisosMod']['w'])) { ?>
                <button class="btn btn-primary" type="button" onclick="openModalAv();" ><i class="fas fa-plus-circle"></i> Nuevo</button>
            <?php } ?>
            </h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="<?= base_url(); ?>/Coros/CorosAv"><?= $data['page_title'] ?></a></li>
        </ul>
      </div>
        <div class="row">
            <div class="col-md-12">
              <div class="tile">
                <div class="tile-body">
                  <div class="table-responsive">
                    <table class="table table-hover table-bordered" id="tableCorosAv">
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
</main>
<?php footerAdmin($data); ?>
    