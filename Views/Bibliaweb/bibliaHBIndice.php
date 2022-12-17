<?php 
  headerWeb($data); 
?> 
<?php 
$url = base_url().'/Biblias/indiceBible.json';
  $indiceB = @file_get_contents($url);
  $datos = json_decode($indiceB, true);
  

  foreach ($datos as $i => $dat) {
	$numero=(int) $dat['numero']; 
	//anadiendo los libros del antiguo testamento a la posicion at del array
	if ($numero<=39 || $numero>66) {
		
			$indicefinal['biblia'][$i] = $dat;
		
	}
	//anadiendo los libros del antiguo testamento a la posicion at del array
	if ($numero<1 || $numero>39) {
	
			$indicefinal['biblia'][$i] = $dat;
		
	}
  }
  //dep($indicefinal);
?>
<main>
	<br>
	<!--? About Area Start -->
    <div class="about-low-area padding-bottom">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <div class="about-caption mb-50">
                        <!-- Section Tittle -->
                        <div class="section-tittle mb-35 text-center">
                            <h2>Holy Bible</h2>
							              <span>Indice</span>
										  <button href="#" class="genric-btn primary circle">New Testament</button>
										  <button href="#" class="genric-btn primary circle">Old Testament</button>
                        </div>
                        
						<table class="table table-bordered">
							<tbody>
								<?php     
								$i=1;
								while ($i <= 66) { 
									$numero=(int) $indicefinal['biblia'][$i]['numero'];
									if ($numero<=39 || $numero>66) {  
									if ($numero > 0) {                                        
								?>
									<tr>
										<td><a class="btn-block genric-btn default" href="<?= base_url()?>/Bibliaweb/Book/<?= $indicefinal['biblia'][$i]['numero']; ?>/1"><?= $indicefinal['biblia'][$i]['titulo']; ?></a></td>
										<?php
											$i=$i+40;
											if (isset($indicefinal['biblia'][$i]['numero'])) {
										?>
										<td><a class="btn-block genric-btn default" href="<?= base_url()?>/Bibliaweb/Book/<?= $indicefinal['biblia'][$i]['numero']; ?>/1"><?= $indicefinal['biblia'][$i]['titulo']; ?></a></td>
										<?php } ?>
									</tr>
								<?php 
									$i=$i-40;
									}}
									$i++;} ?>
								
							</tbody>
						</table>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- About Area End -->
</main>

<?php footerWeb($data); ?>