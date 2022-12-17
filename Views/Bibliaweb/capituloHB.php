<?php 
  headerWeb($data); 
?> 
<main>
	<br>
	<!--? About Area Start -->
    <div class="about-low-area padding-bottom">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <div class="about-caption mb-50 text-center">
                        <!-- Section Tittle -->
                        <div class="section-tittle mb-35 text-center">
                            <h2><?= $data['libro'].' '.$data['capitulo'];?></h2>
                        </div>     
                    </div>
                    <div class="row col-lg-12"><button data-toggle="modal" data-target="#modalVer" class="genric-btn primary circle">Capítulos</button></div>
                    <br>
                    <div class="list-group text-dark">
                        <?php foreach ($data['versiculos'] as $key => $versiculo) {  ?>
                                <a href="<?= base_url()?>/Bibliaweb/VersiculoHB/<?= $data['idlibro']; ?>/<?= $data['capitulo']; ?>/<?= $key; ?>" class="list-group-item list-group-item-action"><?php echo $versiculo?></a>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- About Area End -->
</main>
<?php footerWeb($data); ?>



<?php $totalCap = $data['totalcap']; ?>
<div class="modal fade" id="modalVer" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
        <div class="modal-header bg-primary">
            <h5 class="modal-title text-white" id="exampleModalCenterTitle"><i class="fas fa-fw fa-eye"></i>   Capitulos</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
            </button>
        </div>
        
        <div class="modal-body" id="modalVerbody">  
            <div class="list-group">
            <?php                            
                for ($i=1; $i <= $totalCap; $i++) {                                
            ?>
                <a href="<?= base_url()?>/Bibliaweb/Book/<?= $data['idlibro']; ?>/<?= $i;?>" class="list-group-item list-group-item-action"><?php echo "Capitulo ".$i?></a>
            <?php } ?>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="genric-btn primary circle" data-dismiss="modal"> Cerrar</button>
        </div>

        </div>
    </div>
</div>