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
                    <div class="about-caption mb-50">
                        <!-- Section Tittle -->
                        <div class="section-tittle mb-35 text-center">
                            <h2>Privilegios Semanales </h2></div>
                        
                        
                        <!-- Grid column -->
                    <div class="col-lg-12 mb-4 mb-xl-0">
                        <!-- Section: Live preview -->
                        <section>

                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item waves-effect waves-light">
                                    <a class="nav-link active text-primary" id="home-tab" data-toggle="tab" href="#todos" role="tab" aria-controls="todos" aria-selected="false">Todos</a>
                                </li>
                                <li class="nav-item waves-effect waves-light">
                                    <a class="nav-link text-primary" id="profile-tab" data-toggle="tab" href="#domingo" role="tab" aria-controls="domingo" aria-selected="false">Domingo</a>
                                </li>
                                <li class="nav-item waves-effect waves-light">
                                    <a class="nav-link text-primary" id="martes-tab" data-toggle="tab" href="#martes" role="tab" aria-controls="contact" aria-selected="true">Martes</a>
                                </li>
                                <li class="nav-item waves-effect waves-light">
                                    <a class="nav-link text-primary" id="jueves-tab" data-toggle="tab" href="#jueves" role="tab" aria-controls="contact" aria-selected="true">Jueves</a>
                                </li>
                                <li class="nav-item waves-effect waves-light">
                                    <a class="nav-link text-primary" id="sabado-tab" data-toggle="tab" href="#sabado" role="tab" aria-controls="contact" aria-selected="true">Sábado</a>
                                </li>
                            </ul>
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade active show text-center" id="todos" role="tabpanel" aria-labelledby="todos-tab">
                                    <br><div><h3>DOMINGO</h3></div>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <br>
                                            <div><h4>Culto en la Mañana</h4></div>
                                            <?php if (isset($data['domingom'])) { ?>
                                                    
                                                <br>    
                                                <div>
                                                    <div class="font-weight-bold">Fecha: </div>
                                                    <div><?=  $data['domingom']['diasemana'] . ' '. $data['domingom']['dia'] . ' de ' . getMesString($data['domingom']['mes']) . ' del ' .  $data['domingom']['anio'] ?></div> 
                                                </div>
                                                <br>    
                                                <div>
                                                    <div class="font-weight-bold">Inicio: </div>
                                                    <div><?= $data['domingom']['inicio'] ?></div> 
                                                </div>
                                                <br>
                                                <div>
                                                    <div class="font-weight-bold">Alabanzas: </div>
                                                    <div><?= $data['domingom']['alabanzas'] ?></div> 
                                                </div>
                                                <br>
                                                <div>
                                                    <div class="font-weight-bold">Coros de Avivamiento: </div>
                                                    <div><?= $data['domingom']['avivamiento'] ?></div> 
                                                </div>
                                                <br>
                                                <div>
                                                    <div class="font-weight-bold">Ofrenda: </div>
                                                    <div><?= $data['domingom']['ofrenda'] ?></div> 
                                                </div>

                                                <br>
                                                <div>
                                                    <div class="font-weight-bold">Alabanza Especial: </div>
                                                    <div><?= $data['domingom']['alabanzaespecial'] ?></div> 
                                                </div>
                                                <br>
                                                <div>
                                                    <div class="font-weight-bold">Coros de Adoración: </div>
                                                    <div><?= $data['domingom']['adoracion'] ?></div> 
                                                </div>
                                                <br>
                                                <div>
                                                    <div class="font-weight-bold">Mensaje: </div>
                                                    <div><?= $data['domingom']['mensaje'] ?></div> 
                                                </div>
                                                <br>
                                                <div>
                                                    <div class="font-weight-bold">Aseo: </div>
                                                    <div><?= $data['domingom']['ngrupoaseo'] ?></div> 
                                                    <div><?= $data['domingom']['grupoaseo'] ?></div> 
                                                </div>
                                                <br>
                                                <div>
                                                    <div class="font-weight-bold">Flores: </div>
                                                    <div><?= $data['domingom']['ngrupoflores'] ?></div> 
                                                    <div><?= $data['domingom']['grupoflores'] ?></div> 
                                                </div>

                                            <?php } else{?>
                                                <div>
                                                    <div class="font-weight-bold">No se han registrado privilegios </div>
                                                </div>
                                                <br>
                                            <?php } ?>
                                        </div>


                                        <div class="col-lg-6">

                                            <br>
                                            <div><h4>Culto en la Tarde</h4></div>
                                            <?php if (isset($data['domingot'])) { ?>
                                                    
                                                <br>    
                                                <div>
                                                    <div class="font-weight-bold">Fecha: </div>
                                                    <div><?=  $data['domingot']['diasemana'] . ' '. $data['domingot']['dia'] . ' de ' . getMesString($data['domingot']['mes']) . ' del ' .  $data['domingot']['anio'] ?></div> 
                                                </div>
                                                <br>    
                                                <div>
                                                    <div class="font-weight-bold">Inicio: </div>
                                                    <div><?= $data['domingot']['inicio'] ?></div> 
                                                </div>
                                                <br>
                                                <div>
                                                    <div class="font-weight-bold">Alabanzas: </div>
                                                    <div><?= $data['domingot']['alabanzas'] ?></div> 
                                                </div>
                                                <br>
                                                <div>
                                                    <div class="font-weight-bold">Coros de Avivamiento: </div>
                                                    <div><?= $data['domingot']['avivamiento'] ?></div> 
                                                </div>
                                                <br>
                                                <div>
                                                    <div class="font-weight-bold">Ofrenda: </div>
                                                    <div><?= $data['domingot']['ofrenda'] ?></div> 
                                                </div>

                                                <br>
                                                <div>
                                                    <div class="font-weight-bold">Alabanza Especial: </div>
                                                    <div><?= $data['domingot']['alabanzaespecial'] ?></div> 
                                                </div>
                                                <br>
                                                <div>
                                                    <div class="font-weight-bold">Coros de Adoración: </div>
                                                    <div><?= $data['domingot']['adoracion'] ?></div> 
                                                </div>
                                                <br>
                                                <div>
                                                    <div class="font-weight-bold">Mensaje: </div>
                                                    <div><?= $data['domingot']['mensaje'] ?></div> 
                                                </div>
                                                <br>
                                                <div>
                                                    <div class="font-weight-bold">Aseo: </div>
                                                    <div><?= $data['domingot']['ngrupoaseo'] ?></div> 
                                                    <div><?= $data['domingot']['grupoaseo'] ?></div> 
                                                </div>
                                                <br>
                                                <div>
                                                    <div class="font-weight-bold">Flores: </div>
                                                    <div><?= $data['domingot']['ngrupoflores'] ?></div> 
                                                    <div><?= $data['domingot']['grupoflores'] ?></div> 
                                                </div>

                                            <?php } else{?>
                                                <div>
                                                    <div class="font-weight-bold">No se han registrado privilegios </div>
                                                </div>
                                                <br>
                                            <?php } ?>
                                        </div>
                                    </div>

                                    
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <br><div><h3>SABADO</h3></div>
                                            <br>
                                            <?php if (isset($data['sabado'])) { ?>
                                                <br>    
                                                <div>
                                                    <div class="font-weight-bold">Fecha: </div>
                                                    <div><?=  $data['sabado']['diasemana'] . ' '. $data['sabado']['dia'] . ' de ' . getMesString($data['sabado']['mes']) . ' del ' .  $data['sabado']['anio'] ?></div> 
                                                </div>
                                                <br>    
                                                <div>
                                                    <div class="font-weight-bold">Inicio: </div>
                                                    <div><?= $data['sabado']['inicio'] ?></div> 
                                                </div>
                                                <br>
                                                <div>
                                                    <div class="font-weight-bold">Alabanzas: </div>
                                                    <div><?= $data['sabado']['alabanzas'] ?></div>  
                                                </div>
                                                <br>
                                                <div>
                                                    <div class="font-weight-bold">Coros de Avivamiento: </div>
                                                    <div><?= $data['sabado']['avivamiento'] ?></div>  
                                                </div>
                                                <br>
                                                <div>
                                                    <div class="font-weight-bold">Presentación: </div>
                                                    <div><?= $data['sabado']['presentacion'] ?></div> 
                                                </div>
                                                <br>
                                                <div>
                                                    <div class="font-weight-bold">Ofrenda: </div>
                                                    <div><?= $data['sabado']['ofrenda'] ?></div> 
                                                </div>
                                                <br>
                                                <div>
                                                    <div class="font-weight-bold">Talento: </div>
                                                    <div><?= $data['sabado']['talento'] ?></div> 
                                                </div>
                                                <br>
                                                <div>
                                                    <div class="font-weight-bold">Alabanza Especial: </div>
                                                    <div><?= $data['sabado']['alabanzaespecial'] ?></div> 
                                                </div>
                                                <br>
                                                <div>
                                                    <div class="font-weight-bold">Coros de Adoración: </div>
                                                    <div><?= $data['sabado']['adoracion'] ?></div> 
                                                </div>
                                                <br>
                                                <div>
                                                    <div class="font-weight-bold">Mensaje: </div>
                                                    <div><?= $data['sabado']['mensaje'] ?></div>  
                                                </div>
                                                <br>
                                                <div>
                                                    <div class="font-weight-bold">Aseo: </div>
                                                    <div><?= $data['sabado']['aseo'] ?></div>  
                                                </div>
                                            <?php } else{?>
                                                <div>
                                                <br>
                                                    <div class="font-weight-bold">No se han registrado privilegios </div>
                                                </div>
                                            <?php } ?>
                                            
                                        </div>

                                        <div class="col-lg-4">
                                            <br><div><h3>MARTES</h3></div>
                                            <br>
                                            <?php if (isset($data['martes'])) { ?>
                                                <br>    
                                                <div>
                                                    <div class="font-weight-bold">Fecha: </div>
                                                    <div><?=  $data['martes']['diasemana'] . ' '. $data['martes']['dia'] . ' de ' . getMesString($data['martes']['mes']) . ' del ' .  $data['martes']['anio'] ?></div> 
                                                </div>
                                                <br>    
                                                <div>
                                                    <div class="font-weight-bold">Inicio: </div>
                                                    <div><?= $data['martes']['inicio'] ?></div> 
                                                </div>
                                                <br>
                                                <div>
                                                    <div class="font-weight-bold">Alabanzas: </div>
                                                    <div><?= $data['martes']['alabanzas'] ?></div>  
                                                </div>
                                                <br>
                                                <div>
                                                    <div class="font-weight-bold">Coros de Avivamiento: </div>
                                                    <div><?= $data['martes']['avivamiento'] ?></div>  
                                                </div>
                                                <br>
                                                <div>
                                                    <div class="font-weight-bold">Presentación: </div>
                                                    <div><?= $data['martes']['presentacion'] ?></div> 
                                                </div>
                                                <br>
                                                <div>
                                                    <div class="font-weight-bold">Ofrenda: </div>
                                                    <div><?= $data['martes']['ofrenda'] ?></div> 
                                                </div>
                                                <br>
                                                <div>
                                                    <div class="font-weight-bold">Talento: </div>
                                                    <div><?= $data['martes']['talento'] ?></div> 
                                                </div>
                                                <br>
                                                <div>
                                                    <div class="font-weight-bold">Alabanza Especial: </div>
                                                    <div><?= $data['martes']['alabanzaespecial'] ?></div> 
                                                </div>
                                                <br>
                                                <div>
                                                    <div class="font-weight-bold">Coros de Adoración: </div>
                                                    <div><?= $data['martes']['adoracion'] ?></div> 
                                                </div>
                                                <br>
                                                <div>
                                                    <div class="font-weight-bold">Mensaje: </div>
                                                    <div><?= $data['martes']['mensaje'] ?></div>  
                                                </div>
                                                <br>
                                                <div>
                                                    <div class="font-weight-bold">Aseo: </div>
                                                    <div><?= $data['martes']['aseo'] ?></div>  
                                                </div>
                                            <?php } else{?>
                                                <div>
                                                <br>
                                                    <div class="font-weight-bold">No se han registrado privilegios </div>
                                                </div>
                                            <?php } ?>
                                            
                                        </div>

                                        <div class="col-lg-4">
                                            <br><div><h3>JUEVES</h3></div>
                                            <br>
                                            <?php if (isset($data['jueves'])) { ?>
                                                <br>    
                                                <div>
                                                    <div class="font-weight-bold">Fecha: </div>
                                                    <div><?=  $data['jueves']['diasemana'] . ' '. $data['jueves']['dia'] . ' de ' . getMesString($data['jueves']['mes']) . ' del ' .  $data['jueves']['anio'] ?></div> 
                                                </div>
                                                <br>    
                                                <div>
                                                    <div class="font-weight-bold">Inicio: </div>
                                                    <div><?= $data['jueves']['inicio'] ?></div> 
                                                </div>
                                                <br>
                                                <div>
                                                    <div class="font-weight-bold">Alabanzas: </div>
                                                    <div><?= $data['jueves']['alabanzas'] ?></div>  
                                                </div>
                                                <br>
                                                <div>
                                                    <div class="font-weight-bold">Coros de Avivamiento: </div>
                                                    <div><?= $data['jueves']['avivamiento'] ?></div>  
                                                </div>
                                                <br>
                                                <div>
                                                    <div class="font-weight-bold">Presentación: </div>
                                                    <div><?= $data['jueves']['presentacion'] ?></div> 
                                                </div>
                                                <br>
                                                <div>
                                                    <div class="font-weight-bold">Ofrenda: </div>
                                                    <div><?= $data['jueves']['ofrenda'] ?></div> 
                                                </div>
                                                <br>
                                                <div>
                                                    <div class="font-weight-bold">Talento: </div>
                                                    <div><?= $data['jueves']['talento'] ?></div> 
                                                </div>
                                                <br>
                                                <div>
                                                    <div class="font-weight-bold">Alabanza Especial: </div>
                                                    <div><?= $data['jueves']['alabanzaespecial'] ?></div> 
                                                </div>
                                                <br>
                                                <div>
                                                    <div class="font-weight-bold">Coros de Adoración: </div>
                                                    <div><?= $data['jueves']['adoracion'] ?></div> 
                                                </div>
                                                <br>
                                                <div>
                                                    <div class="font-weight-bold">Mensaje: </div>
                                                    <div><?= $data['jueves']['mensaje'] ?></div>  
                                                </div>
                                                <br>
                                                <div>
                                                    <div class="font-weight-bold">Aseo: </div>
                                                    <div><?= $data['jueves']['aseo'] ?></div>  
                                                </div>
                                            <?php } else{?>
                                                <div>
                                                    <br>
                                                    <div class="font-weight-bold">No se han registrado privilegios </div>
                                                </div>
                                            <?php } ?>
                                            
                                        </div>

                                        
                                    </div>
                                </div>

                                <div class="tab-pane fade  text-center" id="domingo" role="tabpanel" aria-labelledby="domingo-tab">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <br>
                                            <div><h4>Culto en la Mañana</h4></div>
                                            <?php if (isset($data['domingom'])) { ?>
                                                    
                                                <br>    
                                                <div>
                                                    <div class="font-weight-bold">Fecha: </div>
                                                    <div><?=  $data['domingom']['diasemana'] . ' '. $data['domingom']['dia'] . ' de ' . getMesString($data['domingom']['mes']) . ' del ' .  $data['domingom']['anio'] ?></div> 
                                                </div>
                                                <br>    
                                                <div>
                                                    <div class="font-weight-bold">Inicio: </div>
                                                    <div><?= $data['domingom']['inicio'] ?></div> 
                                                </div>
                                                <br>
                                                <div>
                                                    <div class="font-weight-bold">Alabanzas: </div>
                                                    <div><?= $data['domingom']['alabanzas'] ?></div> 
                                                </div>
                                                <br>
                                                <div>
                                                    <div class="font-weight-bold">Coros de Avivamiento: </div>
                                                    <div><?= $data['domingom']['avivamiento'] ?></div> 
                                                </div>
                                                <br>
                                                <div>
                                                    <div class="font-weight-bold">Ofrenda: </div>
                                                    <div><?= $data['domingom']['ofrenda'] ?></div> 
                                                </div>

                                                <br>
                                                <div>
                                                    <div class="font-weight-bold">Alabanza Especial: </div>
                                                    <div><?= $data['domingom']['alabanzaespecial'] ?></div> 
                                                </div>
                                                <br>
                                                <div>
                                                    <div class="font-weight-bold">Coros de Adoración: </div>
                                                    <div><?= $data['domingom']['adoracion'] ?></div> 
                                                </div>
                                                <br>
                                                <div>
                                                    <div class="font-weight-bold">Mensaje: </div>
                                                    <div><?= $data['domingom']['mensaje'] ?></div> 
                                                </div>
                                                <br>
                                                <div>
                                                    <div class="font-weight-bold">Aseo: </div>
                                                    <div><?= $data['domingom']['ngrupoaseo'] ?></div> 
                                                    <div><?= $data['domingom']['grupoaseo'] ?></div> 
                                                </div>
                                                <br>
                                                <div>
                                                    <div class="font-weight-bold">Flores: </div>
                                                    <div><?= $data['domingom']['ngrupoflores'] ?></div> 
                                                    <div><?= $data['domingom']['grupoflores'] ?></div> 
                                                </div>

                                            <?php } else{?>
                                                <div>
                                                    <div class="font-weight-bold">No se han registrado privilegios </div>
                                                </div>
                                                <br>
                                            <?php } ?>
                                        </div>


                                        <div class="col-lg-6">

                                            <br>
                                            <div><h4>Culto en la Tarde</h4></div>
                                            <?php if (isset($data['domingot'])) { ?>
                                                    
                                                <br>    
                                                <div>
                                                    <div class="font-weight-bold">Fecha: </div>
                                                    <div><?=  $data['domingot']['diasemana'] . ' '. $data['domingot']['dia'] . ' de ' . getMesString($data['domingot']['mes']) . ' del ' .  $data['domingot']['anio'] ?></div> 
                                                </div>
                                                <br>    
                                                <div>
                                                    <div class="font-weight-bold">Inicio: </div>
                                                    <div><?= $data['domingot']['inicio'] ?></div> 
                                                </div>
                                                <br>
                                                <div>
                                                    <div class="font-weight-bold">Alabanzas: </div>
                                                    <div><?= $data['domingot']['alabanzas'] ?></div> 
                                                </div>
                                                <br>
                                                <div>
                                                    <div class="font-weight-bold">Coros de Avivamiento: </div>
                                                    <div><?= $data['domingot']['avivamiento'] ?></div> 
                                                </div>
                                                <br>
                                                <div>
                                                    <div class="font-weight-bold">Ofrenda: </div>
                                                    <div><?= $data['domingot']['ofrenda'] ?></div> 
                                                </div>

                                                <br>
                                                <div>
                                                    <div class="font-weight-bold">Alabanza Especial: </div>
                                                    <div><?= $data['domingot']['alabanzaespecial'] ?></div> 
                                                </div>
                                                <br>
                                                <div>
                                                    <div class="font-weight-bold">Coros de Adoración: </div>
                                                    <div><?= $data['domingot']['adoracion'] ?></div> 
                                                </div>
                                                <br>
                                                <div>
                                                    <div class="font-weight-bold">Mensaje: </div>
                                                    <div><?= $data['domingot']['mensaje'] ?></div> 
                                                </div>
                                                <br>
                                                <div>
                                                    <div class="font-weight-bold">Aseo: </div>
                                                    <div><?= $data['domingot']['ngrupoaseo'] ?></div> 
                                                    <div><?= $data['domingot']['grupoaseo'] ?></div> 
                                                </div>
                                                <br>
                                                <div>
                                                    <div class="font-weight-bold">Flores: </div>
                                                    <div><?= $data['domingot']['ngrupoflores'] ?></div> 
                                                    <div><?= $data['domingot']['grupoflores'] ?></div> 
                                                </div>

                                            <?php } else{?>
                                                <div>
                                                    <div class="font-weight-bold">No se han registrado privilegios </div>
                                                </div>
                                                <br>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="tab-pane fade  text-center" id="martes" role="tabpanel" aria-labelledby="martes-tab">
                                    <?php if (isset($data['martes'])) { ?>
                                        <br>    
                                        <div>
                                            <div class="font-weight-bold">Fecha: </div>
                                            <div><?=  $data['martes']['diasemana'] . ' '. $data['martes']['dia'] . ' de ' . getMesString($data['martes']['mes']) . ' del ' .  $data['martes']['anio'] ?></div> 
                                        </div>
                                        <br>    
                                        <div>
                                            <div class="font-weight-bold">Inicio: </div>
                                            <div><?= $data['martes']['inicio'] ?></div> 
                                        </div>
                                        <br>
                                        <div>
                                            <div class="font-weight-bold">Alabanzas: </div>
                                            <div><?= $data['martes']['alabanzas'] ?></div>  
                                        </div>
                                        <br>
                                        <div>
                                            <div class="font-weight-bold">Coros de Avivamiento: </div>
                                            <div><?= $data['martes']['avivamiento'] ?></div>  
                                        </div>
                                        <br>
                                        <div>
                                            <div class="font-weight-bold">Presentación: </div>
                                            <div><?= $data['martes']['presentacion'] ?></div> 
                                        </div>
                                        <br>
                                        <div>
                                            <div class="font-weight-bold">Ofrenda: </div>
                                            <div><?= $data['martes']['ofrenda'] ?></div> 
                                        </div>
                                        <br>
                                        <div>
                                            <div class="font-weight-bold">Talento: </div>
                                            <div><?= $data['martes']['talento'] ?></div> 
                                        </div>
                                        <br>
                                        <div>
                                            <div class="font-weight-bold">Alabanza Especial: </div>
                                            <div><?= $data['martes']['alabanzaespecial'] ?></div> 
                                        </div>
                                        <br>
                                        <div>
                                            <div class="font-weight-bold">Coros de Adoración: </div>
                                            <div><?= $data['martes']['adoracion'] ?></div> 
                                        </div>
                                        <br>
                                        <div>
                                            <div class="font-weight-bold">Mensaje: </div>
                                            <div><?= $data['martes']['mensaje'] ?></div>  
                                        </div>
                                        <br>
                                        <div>
                                            <div class="font-weight-bold">Aseo: </div>
                                            <div><?= $data['martes']['aseo'] ?></div>  
                                        </div>
                                    <?php } else{?>
                                        <div>
                                        <br>
                                            <div class="font-weight-bold">No se han registrado privilegios </div>
                                        </div>
                                    <?php } ?>
                                </div>

                                <div class="tab-pane fade  text-center" id="jueves" role="tabpanel" aria-labelledby="jueves-tab">
                                    <?php if (isset($data['jueves'])) { ?>
                                        <br>    
                                        <div>
                                            <div class="font-weight-bold">Fecha: </div>
                                            <div><?=  $data['jueves']['diasemana'] . ' '. $data['jueves']['dia'] . ' de ' . getMesString($data['jueves']['mes']) . ' del ' .  $data['jueves']['anio'] ?></div> 
                                        </div>
                                        <br>    
                                        <div>
                                            <div class="font-weight-bold">Inicio: </div>
                                            <div><?= $data['jueves']['inicio'] ?></div> 
                                        </div>
                                        <br>
                                        <div>
                                            <div class="font-weight-bold">Alabanzas: </div>
                                            <div><?= $data['jueves']['alabanzas'] ?></div>  
                                        </div>
                                        <br>
                                        <div>
                                            <div class="font-weight-bold">Coros de Avivamiento: </div>
                                            <div><?= $data['jueves']['avivamiento'] ?></div>  
                                        </div>
                                        <br>
                                        <div>
                                            <div class="font-weight-bold">Presentación: </div>
                                            <div><?= $data['jueves']['presentacion'] ?></div> 
                                        </div>
                                        <br>
                                        <div>
                                            <div class="font-weight-bold">Ofrenda: </div>
                                            <div><?= $data['jueves']['ofrenda'] ?></div> 
                                        </div>
                                        <br>
                                        <div>
                                            <div class="font-weight-bold">Talento: </div>
                                            <div><?= $data['jueves']['talento'] ?></div> 
                                        </div>
                                        <br>
                                        <div>
                                            <div class="font-weight-bold">Alabanza Especial: </div>
                                            <div><?= $data['jueves']['alabanzaespecial'] ?></div> 
                                        </div>
                                        <br>
                                        <div>
                                            <div class="font-weight-bold">Coros de Adoración: </div>
                                            <div><?= $data['jueves']['adoracion'] ?></div> 
                                        </div>
                                        <br>
                                        <div>
                                            <div class="font-weight-bold">Mensaje: </div>
                                            <div><?= $data['jueves']['mensaje'] ?></div>  
                                        </div>
                                        <br>
                                        <div>
                                            <div class="font-weight-bold">Aseo: </div>
                                            <div><?= $data['jueves']['aseo'] ?></div>  
                                        </div>
                                    <?php } else{?>
                                        <div>
                                            <br>
                                            <div class="font-weight-bold">No se han registrado privilegios </div>
                                        </div>
                                    <?php } ?>
                                </div>

                                <div class="tab-pane fade text-center" id="sabado" role="tabpanel" aria-labelledby="sabado-tab">
                                    
                                    <?php if (isset($data['sabado'])) { ?>
                                        <br>    
                                        <div>
                                            <div class="font-weight-bold">Fecha: </div>
                                            <div><?=  $data['sabado']['diasemana'] . ' '. $data['sabado']['dia'] . ' de ' . getMesString($data['sabado']['mes']) . ' del ' .  $data['sabado']['anio'] ?></div> 
                                        </div>
                                        <br>    
                                        <div>
                                            <div class="font-weight-bold">Inicio: </div>
                                            <div><?= $data['sabado']['inicio'] ?></div> 
                                        </div>
                                        <br>
                                        <div>
                                            <div class="font-weight-bold">Alabanzas: </div>
                                            <div><?= $data['sabado']['alabanzas'] ?></div>  
                                        </div>
                                        <br>
                                        <div>
                                            <div class="font-weight-bold">Coros de Avivamiento: </div>
                                            <div><?= $data['sabado']['avivamiento'] ?></div>  
                                        </div>
                                        <br>
                                        <div>
                                            <div class="font-weight-bold">Presentación: </div>
                                            <div><?= $data['sabado']['presentacion'] ?></div> 
                                        </div>
                                        <br>
                                        <div>
                                            <div class="font-weight-bold">Ofrenda: </div>
                                            <div><?= $data['sabado']['ofrenda'] ?></div> 
                                        </div>
                                        <br>
                                        <div>
                                            <div class="font-weight-bold">Talento: </div>
                                            <div><?= $data['sabado']['talento'] ?></div> 
                                        </div>
                                        <br>
                                        <div>
                                            <div class="font-weight-bold">Alabanza Especial: </div>
                                            <div><?= $data['sabado']['alabanzaespecial'] ?></div> 
                                        </div>
                                        <br>
                                        <div>
                                            <div class="font-weight-bold">Coros de Adoración: </div>
                                            <div><?= $data['sabado']['adoracion'] ?></div> 
                                        </div>
                                        <br>
                                        <div>
                                            <div class="font-weight-bold">Mensaje: </div>
                                            <div><?= $data['sabado']['mensaje'] ?></div>  
                                        </div>
                                        <br>
                                        <div>
                                            <div class="font-weight-bold">Aseo: </div>
                                            <div><?= $data['sabado']['aseo'] ?></div>  
                                        </div>
                                    <?php } else{?>
                                        <div>
                                        <br>
                                            <div class="font-weight-bold">No se han registrado privilegios </div>
                                        </div>
                                    <?php } ?>
                                </div>


                            </div>

                        </section>
                        <!-- Section: Live preview -->
                    </div>
                        


						

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- About Area End -->
</main>

<?php footerWeb($data); ?>