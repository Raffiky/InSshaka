<script src="<?php echo base_url('assets/js/mi-build-a-band.js') ?>"></script>
<script>
  $(function(){
      $('#first-help').trigger('click');
    var estado = 1;
        var estado2 = 0;
        $(".tab_content").hide();
        $(".t6").addClass("active").show();
		
        $(".tab_content:first").show();
        $("ul.tabs li").click(function()
        {
            if ($(this).is('.t3')) {
			  
            } else {
                $("ul.tabs li").removeClass("active");
                $(this).addClass("active");
                $(".tab_content").hide();
                $(".t3").css({
                    'opacity': "0.4"
                });
                var activeTab = $(this).find("a").attr("href");
                $(activeTab).fadeIn();
                return false;
            }
        });
       
        $("#contenu3").scrollbar(428);
        $(".t7").click(function()
        {
           
            if (estado2 == 0){
                $("#contenu4").scrollbar2(428);
                estado2 = 1;
            }
		
			
        });
  })
</script>
<style>
  #msdrpdd20_titletext {
    background-image: none;
  }
    .bgSlider{
        display:none;
    }
    .login{
        display:none;
    }
    .b2{
        color:#333 !important;	
    }
    .c3{
        color:#333 !important;	
    }
    input[type="checkbox"] + label {
        background: url("images/fondo-check.png") no-repeat scroll 0 0 transparent;
        height: 14px;
        margin-top: -14px;
        padding-left: 26px;
        padding-top: 3px;
    }
    input[type="checkbox"] {
        cursor: pointer;
        left: 0;
        margin-bottom: -10px;
        margin-right: 20px;
        opacity: 0.01;
    }
    .ver-mas{
        margin-top:0;
    }
    .bot-buscar {
        float:right;
        margin-top:30px;
        margin-bottom:50px;
    }
    .m-nombre {

        padding-left: 0;
    }
    .integrantes-modal, .musicos{
        width:1000px;
        display:block;
    }
    .musicos{
        width:980px;
    }
    .info-banda{
        margin: 0 auto;
        width: 420px;
    }
    .dato-banda{
        color: #505050;
        font-family: 'BebasNeueRegular';
        font-size: 28px;
    }
    .dato-banda b{
        color: #E82E7C;
    }
</style>

<div class="contenido">

    <div class="directorio-cont">
        <ul class="tabs">
            <li class="t6 active"><a href="#tab1">Mis Bandas</a></li>
            <?php if(!$usuario->is_proveedor && !$usuario->is_band) : ?>
            <?php endif; ?>
            <li class="t8"><a href="<?php echo site_url('build-a-band/crear-banda') ?>">Crear Banda</a></li>
        </ul>
    </div>

    <div class="clear"></div>
    <div class="tab_container">

        <div id="tab1" class="tab_content">
          <?php if (!empty($alert_messages)) : ?>
              <div><?php echo $alert_messages ?></div>
            <?php endif; ?>
          </div>
          <!-- Formulario pertenece a banda -->
          <script type='text/javascript'>
            $(function(){
              $('.tooltip').tooltipster({
                  theme: '.theme-help',
                  arrow: true,
                  animation: 'fall',
                  arrowColor: '#FFF',
                  position: 'bottom-right',
                  interactive : true
                });
            })
          </script>

          <?php if(!$is_band && !$is_proveedor) : ?>
          <div class="conBtMas agrBanda" style="float: left; margin-left: 87px;">
            <div id="txBtMas">
              <a style="float: right; width: 150px">
                <span class="verMas ">Pertenezco a una banda</span>
              </a>
            </div>
            <a href="#">
              <div id="imgBtMas"></div>
            </a>
          </div>
          <div id="first-help" class="help-inshaka" title="<span class='title-help'>Pertenezco a una banda</span>
              <div class='content-help'>
              <p>Si perteneces a una banda, haz clic en la manito de InShaka para buscar la banda y aparecer como un integrante de la banda en InShaka</p><br>
              <p>Si no haz creado tu banda, haz clic en <span style='color:#E82E7C'>'Crear Banda'</span> para crearla</p>
               <button class='bot-logout' style='border: 0px;' onclick='closetooltip (this)'>Cerrar</button>
              </div>" 
              style="float:left; margin-right: 24px; margin-top: 5px;">
         </div>
          
          <div class="clr"></div>
          <div class="cancionesInputBox" id="agrBanda" style="float: left;margin-top: 10px; margin-bottom: 15px; display: none">
            <div class="terminos-tit" style="float:none; margin-left: 10px;">Si la banda no está registrada en inshaka, debe ser creada antes</div>
            <form id="save-song-url-form" action="<?php echo site_url('perfil/build-a-band/save_my_band') ?>">
              <small style="float:left; font-size:.8em; margin-top:.6em;margin-right: 32px;">Nombre de la banda: </small>
              <input id="banda" name="banda" class="campo" placeholder="Digite el nombre de la banda"  required="required" />
              <div class="clear"></div>
              <small style="float:left; font-size:.8em; margin-top:.6em;margin-right: 32px;">Instrumento que toca: </small>
              <div class="selectBox" style="margin-left: -7px;">
                <?= form_dropdown('bands_instrument_id', $instrumentos, (!empty($datos->bands_instrument_id) ? $datos->band_instrument_id : null), 'style="width:162px;"   class="comboBox1"') ?>
              </div>
              <div class="clear"></div>
              <input class="bot-aceptar" type="submit" value="Guardar">
            </form>
          </div>
          <div class="clear"></div>
          <script type="text/javascript">
            $(function(){
              $('.agrBanda').on('click', function(){
                $('#agrBanda').slideToggle('slow');
                return false;
              });
              
              $( "#banda" ).autocomplete({ 
                source: "<?php echo site_url('usuarios/registro/get_band') ?>"
              });
            })
          </script>
          <!-- Fin formulario pertenece a banda -->
          <!-- grilla bandas pertenezco -->
          <?php if ($band_instrument_user->exists()) : ?>
            <div class="bgEncabezado" style="height: 40px; margin-top: 10px;">
              <div class="conEncabezado">
                <div id="txSeccion">
                  <div class="encabezado-tit" style="padding-top: 0px; font-size: 30px">Bandas a las que pertenezco</div>
                </div>
              </div>
            </div>           
            <?php foreach ($band_instrument_user as $member) : ?>
              <div class="bandas" style="padding-top: 27px; padding-bottom: 40px;">
                <div class="banda-nom">
                  <a href="<?= site_url('perfil/pagina/'.$member->var) ?>"><?= $member->banda ?></a>
                </div>
                <div class="opciones-ico">
                  <a href="#integrantes-banda-pertenezco-<?php echo $member->var ?>" class="fancybox-modal">
                    <div class="miembros">Integrantes</div>
                  </a>
                </div>
              </div>
          
              <!-- Modal integrantes banda pertenezco -->
              <div class="integrantes-modal" id="integrantes-banda-pertenezco-<?php echo $member->var ?>" style="display:none" >
                <div class="musicos-cont">
                    <div class="mensaje-tit">Banda <?php echo $member->banda ?>  -  Integrantes</div>
                    <?php $player = $players->get_players_band($member->id) ?>
                    <?php if($player->exists()) : ?>
                    <div class="musicos">
                      <?php foreach ($player as $musico) : ?>
                      <div class="musico">
                        <div class="mus-sel">
                          <label for="check_01" class="m-nombre">
                            <?= $musico->user->first_name, ' ', $musico->user->last_name ?>
                          </label>
                        </div>
                        <div class="m-dato"><?php echo $musico->city ?></div>
                         <?php $user_instruments_on_band = $musico->user->get_instruments_on_band($member->id); ?>
                            <?php if ($user_instruments_on_band->exists()) : ?>
                            <div class="m-exp">
                                <?php 
                                $count = 1;
                                foreach ($user_instruments_on_band as $instrument_user) : 
                                    ?>
                                    <b><?php echo $instrument_user->bands_instrument->instrument->name, $count < $user_instruments_on_band->result_count() ? ',' : null ?></b>
                                <?php 
                                $count++;
                                endforeach; 
                                ?>
                            </div>
                            <?php endif; ?>
                        <div class="opciones-ico">
                          <a href="<?php echo site_url('perfil/' . $musico->user->inshaka_url) ?>">
                            <div class="ver-mas">Ver más</div>
                          </a>
                        </div>
                      </div>
                      <?php endforeach; ?>
                    </div>
                    <?php endif; ?>
                </div>
              </div>
              <!-- Fin modal banda pertenezco -->
            <?php endforeach; ?>
        <?php endif; ?>
        <!-- fin bandas pertenezco -->
        <?php endif; ?>
            <?php if ($datos->exists()) : ?>
                <?php if(!$is_band && !$is_proveedor) : ?>
                <div class="bgEncabezado" style="height: 40px; margin-top: 20px;">
                  <div class="conEncabezado">
                    <div id="txSeccion">
                      <div class="encabezado-tit" style="padding-top: 0px; font-size: 30px">Mis bandas</div>
                    </div>
                  </div>
                </div>
                <?php endif; ?>
                <div class="resultados"></div>
                <div id="contenu3">

                    <?php foreach ($datos as $dato) : ?>

                        <div class="bandas">
                            <div class="banda-nom"><a href="<?php echo site_url(array('build-a-band', 'editar', $dato->id, $dato->var)) ?>"><?php echo $dato->name ?></a><div class="help-inshaka" title="<span class='title-help'>Perfil de banda</span>
              <div class='content-help'>
              <p>Si ya tienes tu banda conformada. Crea un nuevo registro para tu banda</p><br>
              <p>Haz click en registro/banda e ingresa los datos para registrar el perfíl de tu banda</p>
              </div>" 
              style="float:left; margin-right: 10px; ">
         </div></div>

                            <div class="opciones-ico">
                                <div class="borrar"><a href="<?php echo site_url('perfil/build-a-band/eliminar/' . $dato->id) ?>" onclick="return confirm('¿Está seguro de eliminar la banda?');">Borrar</a></div>
                                <a href="<?php echo site_url(array('build-a-band', 'editar', $dato->id, $dato->var)) ?>"><div class="editar">Editar</div></a>
                                <a href="#integrantes-<?php echo $dato->var ?>" class="fancybox-modal"><div class="miembros">Integrantes</div></a>
                                <a href="#perfil-<?php echo $dato->var ?>" class="fancybox-modal" style="<?= $perfil->search_page($dato->id) ? 'display:none' : null ?>"><div class="miembros">Crear perfil</div></a>
                                
                                <a href="<?= site_url('perfil/pagina/'.$perfil->var) ?>" style="<?= $perfil->search_page($dato->id) ? null : 'display:none' ?>"><div class="ver-mas" style="width: 112px; margin-right: 21px;">Ver perfil</div></a>
                                
                            </div>
                          
        <!-- Modal para crear perfil de banda -->
                          
        <div id="perfil-<?= $dato->var ?>" style="display:none">
          <div class="musicos-cont">
             <div class="mensaje-tit">Crear perfil</div>
             <div class="info-banda">
               <div class="dato-banda">
                 Nombre de la banda: <b><?php echo $dato->name ?></b>
               </div>
               <div class="dato-banda">
                 Género principal: <b><?php echo $dato->musical_gender->name ?></b>
               </div>
             </div>
             <div style="margin-top: 20px">
               <?= form_open('perfil/build_a_band/save_profile_band', null, array('band_id' => $dato->id, )) ?>
                <input type="submit" class="bot-publicar" value="Publicar" >
              <?= form_close() ?>
             </div>
          </div>
        </div>
        
        <!-- Fin de modal -->

        <div class="integrantes-modal" id="integrantes-<?php echo $dato->var ?>" style="display:none;">
            <div class="musicos-cont">
                <div class="mensaje-tit">Banda <?php echo $dato->name ?>  -  Integrantes</div>

                <div class="musicos">
                    <?php if ($dato->bands_instrument->bands_instruments_user->exists()) : ?>
                        <?php foreach ($dato->bands_instrument->bands_instruments_user as $member) : ?>
                            <div class="musico">
                                <div class="estado-ico">
                                    <?php if ($member->is_invited) : ?>
                                        <img src="images/ico-reloj.png" />
                                    <?php else : ?>
                                        <?php if ($member->invitation_accepted) : ?>
                                            <img src="images/ico-aceptar.png" />
                                        <?php else : ?>
                                            <img src="images/ico-rechazar.png" />
                                        <?php endif; ?>
                                    <?php endif; ?>
                                </div>
                                <div class="mus-sel">
                                    <label for="check_01" class="m-nombre"><?php echo $member->user->first_name, ' ', $member->user->last_name ?></label>
                                </div>
                                <div class="m-dato"><b><?php echo calculate_years_old($member->user->birthday) ?></b></div>
                                <div class="m-dato"><?php echo!empty($member->user->gender) ? $member->user->gender : 'Sin definir' ?></div>
                                <div class="m-dato"><?php echo $member->city ?></div>

                                <?php $user_instruments_on_band = $member->user->get_instruments_on_band($dato->id); ?>

                                <?php if ($user_instruments_on_band->exists()) : ?>
                                    <div class="m-exp">
                                        <?php 
                                        $count = 1;
                                        foreach ($user_instruments_on_band as $instrument_user) : 
                                            ?>
                                            <b><?php echo $instrument_user->bands_instrument->instrument->name, $count < $user_instruments_on_band->result_count() ? ',' : null ?></b>
                                        <?php 
                                        $count++;
                                        endforeach; 
                                        ?>
                                    </div>

                                <?php endif; ?>
  <div class="opciones-ico">

  <a href="<?php echo site_url('perfil/' . $member->user->inshaka_url) ?>"><div class="ver-mas">Ver más</div></a>
  <a href="<?= site_url('perfil/build-a-band/delete_member/' . $member->id) ?>"><div class="borrar" style="margin-top: 0px">Borrar</div></a>

                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <strong>Sin integrantes</strong>
                    <?php endif; ?>

                </div>

            </div>
        </div>

                            <div class="clr"></div>
                        </div>

                    <?php endforeach; ?>

                </div>

            <?php else: ?>

                <div><p><p><br>No has creado ninguna banda. Crea la primera haciendo <a href="<?php echo site_url('build-a-band/crear-banda') ?>" style="color: #E31873">click acá.</a></p></div>

            <?php endif; ?>

            <div class="clr"></div>
        </div>

    </div>

</div>
<script type="text/javascript">  
  $(function() {
    $(".iframe").fancybox();
    
  })
</script>