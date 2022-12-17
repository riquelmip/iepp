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
                            <h2><?= $data['nombre'];?></h2>
                        </div>
                        
						<div><?= $data['alabanza'];?></div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- About Area End -->
</main>
<?php footerWeb($data); ?>