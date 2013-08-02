<div id="dialog-message" title="Banda" style="display: none;">
  <p>
    <span class="ui-icon ui-icon-circle-check" style="float: left; margin: 0 7px 50px 0;"></span>
    Tu banda fue guardada satisfactoriamente. 
  </p><br>
  <p>
    Cuando esté totalmente conformada, no olvides crear su perfil. 
  </p>
</div>
<style>
    #scroll4 .jspContainer .jspVerticalBar{
        visibility:hidden !important;
        display:none !important;
        height:0 !important;
        filter:alpha(opacity=1) !important;
        -moz-opacity:1 !important;
        -khtml-opacity: 1 !important;
        opacity: 0.01 !important;
        overflow:hidden;
    }
</style>
<div class="selectores-band">
    <?php if (!empty($alert_messages)) : ?>
      <div><?php echo $alert_messages ?></div>
    <?php endif; ?>

    <?php echo form_open('build-a-band/ajax/save_band/' . (!empty($datos->band->id) ? $datos->band->id : null), 'id="save-band-form"') ?>

    <div class="messages"></div><div class="clr"></div>

    <div class="selector-iz">
        <div class="band-op">
            <div class="band-ico">1</div>
            <div class="band-info">
                <div class="band-tit">Selecciona para iniciar los criterios de búsqueda </div>
                <div class="help-inshaka" title="<span class='title-help'>Crear banda: Paso 1</span>
                  <div class='content-help'>
                  <p>Este el primer paso para crear tu banda. Selecciona el nombre, la ubicación y los géneros que ayudarán a definir tu banda.</p>
                  </div>" 
                  style="float:right; margin-right: 10px; margin-top: -45px;">
                 </div>
                <div class="band-cont">
                    
                    <div class="campo-reg-lab">
                        <label style="padding-left: 4px;">Nombre de la Banda</label>
                        <input name="name" type="text" id="name" class="campo3" value="<?php echo (!empty($datos->band->name) ? $datos->band->name : null) ?>" />
                    </div>
                    
                    <div class="campo-reg-lab">
                        <label style="padding-left: 4px;">Ciudad</label>
                        <input name="city" id="city" class="campo3" value="<?php echo (!empty($datos->band->city) ? $datos->band->city : null) ?>" />
                    </div>


                    <div class="campo-reg-lab">
                        <label style="padding-left: 4px;">Género principal</label>
                        <div class="selectBox" id="select-largo">
                            <?php echo form_dropdown('musical_gender_id', $datos->genders, (!empty($datos->band->musical_gender_id) ? $datos->band->musical_gender_id : null), 'style="width:386px;"   class="comboBox1"') ?>
                            <div class="clr"></div>
                        </div>
                    </div>
                    
                    <div class="campo-reg-lab">
                	<label style="padding-left: 4px;">Subgénero uno</label>
                    <div class="selectBox" id="select-largo">
                        <?php echo form_dropdown('sub_uno_musical_gender_id', $datos->genders, (!empty($datos->band->sub_uno_musical_gender_id) ? $datos->band->sub_uno_musical_gender_id : null), 'style="width:386px;"   class="comboBox1" '); ?>
                        <div class="clr"></div>
                    </div>
                </div>
              
                <div class="campo-reg-lab">
                	<label style="padding-left: 4px;">Subgénero dos</label>
                    <div class="selectBox" id="select-largo">
                        <?php echo form_dropdown('sub_dos_musical_gender_id', $datos->genders, (!empty($datos->band->sub_dos_musical_gender_id) ? $datos->band->sub_dos_musical_gender_id : null), 'style="width:386px;"   class="comboBox1" '); ?>
                        <div class="clr"></div>
                    </div>
                </div>
                    
                    
                </div>
            </div>
            <div class="clr"></div>
        </div>
        <!--
        <div class="band-op">
            <div class="band-ico">2</div>
            <div class="band-info">
                <div class="band-tit">Selecciona un set-up para tu banda </div>
                <div class="band-cont" id="scroll1">
                    <div class="escenarios" data-stage="thumbs">

                        <?php //foreach ($datos->stages->all as $stage) : ?>
                            <div class="escenario">
                                <img src="<?php //echo uploads_url($stage->thumb) ?>" data-stage-large="<?php //echo uploads_url($stage->image) ?>" data-stage-id="<?php //echo $stage->id ?>">
                            </div>
                        <?php //endforeach; ?>

                        <input type="hidden" name="stage_id" value="<?php echo $datos->stages->id ?>" />
                        <div class="clr"></div>
                    </div>
                </div>
            </div>
            <div class="clr"></div>
        </div> -->

        <div class="band-op">
            <div class="band-ico">2</div>
            <div class="band-info">
                <div class="band-tit">Selecciona los instrumentos para tu banda</div>
                <div class="help-inshaka" title="<span class='title-help'>Crear banda: Paso 2</span>
                  <div class='content-help'>
                  <p>En este paso, selecciona los instrumentos que harán parte de tu banda. Haz click sobre la imágen del instrumento y ésta va a aparecer en el escenario. Si deseas borrar el instrumento que elegiste, haz click en la <strong style='color:#E82E7C'>(X)</strong> sobre la imágen</p>
                  </div>" 
                  style="float:right; margin-right: 10px; margin-top: -45px;">
                 </div>
                <div class="band-cont" id="scroll2">
                    <div class="instrumentos" data-instruments="thumbs">
                        <?php foreach ($datos->instruments->all as $instrument) : ?>
                            <div class="instrumento" style="background-image: url('<?php echo uploads_url($instrument->image) ?>');" title="<?php echo $instrument->name ?>" data-instrument-name="<?php echo $instrument->name ?>" data-instrument-id="<?php echo $instrument->id ?>" data-instruments="select"></div>
                        <?php endforeach; ?>
                        <div class="clr"></div>
                    </div>
                </div>
            </div>
            <div class="clr"></div>
        </div>

    </div>
    <div class="selector-de">
        <div class="band-op">
            <div class="band-ico">3</div>
            <div class="band-info">
                <div class="band-tit">Selecciona el perfil del músico que <br> estas buscando</div>
                <div class="help-inshaka" title="<span class='title-help'>Crear banda: Paso 3</span>
                  <div class='content-help'>
                  <p>Ya casi creas tu banda!. Ahora, haz click en el instrumento para el cual quieres buscar músicos. Si conoces la información de la persona que quieres agregar (usuario inshaka, nombre, correo, etc), haz click en <strong style='color:#E82E7C'>INVITAR UN AMIGO</strong>, de lo contrario busca músico en InShaka haciendo click en <strong style='color:#E82E7C'>BUSCAR EN INSHAKA</strong></p>
                  </div>" 
                  style="float:right; margin-right: 10px; margin-top: -45px;">
                 </div>

                <div class="img-resultado" data-stage="background">
                    <?php if (!empty($datos->band->stage->image)) : ?>
                        <img class="background-stage" src="<?php echo uploads_url($datos->band->stage->image) ?>" />
                    <?php else: ?>
                        <img class="background-stage" src="<?php echo uploads_url($datos->stages->image) ?>" />
                    <?php endif; ?>

                </div>
                <div class="cont-sup">
                    <div class="sel-inst" id="scroll4" data-instruments="wrapper-scroll">
                        <div class="sel-inst-cont" data-instruments="list"> 
                            <?php
                            if (!empty($datos->band)) :
                                foreach ($datos->band->bands_instrument as $band_instrument) :
                                    ?>
                                    <div class="instrumento" style="background-image: url('<?php echo uploads_url($band_instrument->instrument->image) ?>');" title="<?php echo $band_instrument->instrument->name ?>" data-instrument-id="<?php echo $band_instrument->instrument->id ?>" data-instruments="select"><span class="b_cerrar"></span>
                                    </div>
                                    <?php
                                endforeach;
                            endif;
                            ?>
                        </div>
                    </div>
                </div>
                <div class="acota-click">Haz click en los instrumentos seleccionados e invita a otros músicos</div>
                <div class="filtros-inst-cont" style="display:none;">
                    <div class="band-tit">¿Qué quieres hacer con este instrumento?</div>

                    <a href="#musicos-cont" class="elegir-m" data-action="show-search-users-dialog"><div class="bot-buscar" id="buscar-m">Buscar</div></a>
                    <div class="clr"></div>

                    <div id="musicos">
                        <?php
                        if (!empty($datos->band)) :
                            foreach ($datos->band->bands_instrument as $band_instrument) :
                                ?>
                                <div class="lista-musicos" data-instrument-id="<?php echo $band_instrument->instrument->id ?>" data-build-a-band="lista-musicos" style="display:none;">
                                    <div class="lista-musicos-tit">Músicos Seleccionados</div>
                                    <div class="musicos2 users">
                                        <?php foreach ($band_instrument->bands_instruments_user as $band_instrument_user) : ?>
                                            <div class="musico2 user"  data-user-id="<?php echo $band_instrument_user->user->id ?>">
                                                <div class="mus-sel2">
                                                    <div class="m-nombre2 name-user"><?php echo $band_instrument_user->user->first_name, ' ', $band_instrument_user->user->last_name ?></div>
                                                </div>
                                                <div class="ver-mas-musico">
                                                    <a class="url-user" href="<?php echo sprintf($urls->inshaka_url, $band_instrument_user->user->inshaka_url) ?>" target="_blank">Ver más</a>
                                                </div>
                                                <div data-action="eliminar-musico-lista-musicos" class="eliminar-musico">Eliminar</div>
                                                <input type="hidden" name="users[<?php $band_instrument->instrument->id ?>][]" value="<?php echo $band_instrument_user->user->id ?>" />
                                            </div>
                                            <?php
                                        endforeach;
                                        ?>
                                    </div>
                                </div>

                                <?php
                            endforeach;
                        endif;
                        ?>
                    </div>

                    <div class="clr"></div>
                </div>
            </div>

            <textarea name="message" id="" cols="30" rows="10" style="background:#E4E7E7; border-color: #C7C9CA; width: 100%;" placeholder="Envía un mensaje a los músicos seleccionados y empieza tu nueva banda!..."></textarea>
            
            <div class="help-inshaka" title="<span class='title-help'>Crear banda: Crear</span>
              <div class='content-help'>
              <p>Ya casi terminas! Si estas seguro que deseas crear una banda con estos usuarios, escribeles un mensaje de invitación para que sean parte de tu banda, y haz clic en <strong style='color:#E82E7C'>“Crear”</strong>, les va a llegar un correo con la invitación, y tendrán que decidir si quieren ser parte de tu banda o no.</p><br>
              <p>Para ver a que bandas perteneces y las bandas que has creado, haz clic en <strong style='color:#E82E7C'>Perfil/Mis Bandas</strong>, o <strong style='color:#E82E7C'>Inicio/Mis Bandas</strong></p>
              </div>" 
              style="float:right; margin-right: 97px; margin-top: 33px;">
             </div>
            <?php if($es_usuario) : ?>
            <input type="submit" value="crear" class="bot-crear" />
            <?php else : ?>
            <div class="clr"></div>
            <a href="<?= site_url('usuarios/login?continue-uri=build-a-band') ?>" class="bot-crear" style="padding: 6px 72px 3px 14px;">crear</a>
            <?php endif; ?>
            
        </div>
        <div class="clr"></div>
    </div>
    <div class="clr"></div>
    <?php echo form_close(); ?>
    <div class="clr"></div>
</div>

<div class="clr"></div>
</div>

<script type="text/javascript">
  $(function(){
    $('#search_in_inshaka').on('click', function(){
      if($('#invitation_friend').show()){
        $('#invitation_friend').hide();
      }
      $('#search_inshaka').slideToggle('slow');
      return false;
    });
    
    $('#invitation_a_friend').on('click', function(){
      if($('#search_inshaka').show()){
        $('#search_inshaka').hide();
      }
      $('#invitation_friend').slideToggle('slow');
      return false;
    });

  });
</script>

<div id="musicos-cont" style="display:none;width:970px; min-height: 300px; height: auto;">
  <div class="mensaje-tit">Buscar músicos<div id="titulo-buscar-musicos"></div></div>
  <div class="clr"></div>
  <a id="search_in_inshaka" class="bot-rosa2 cambia-cont" href="#">Buscar en inshaka</a>
  <a id="invitation_a_friend" class="bot-rosa2 cambia-cont" href="#">Invitar un amigo</a>
  <div class="clr"></div>
  <!-- Formulario buscar en inshaka -->
  <div id="search_inshaka" style="display:none; margin-top: 15px; height: 100px;">
    <div class="clr"></div>
    <?= form_open('build-a-band/ajax/search_users', 'id="search-users-form"'); ?>
    <div class="musicos-cont" id="busqueda-avanzada">
      <div class="registro-campos">
        <div class="campo-reg-lab" style="width: 170px;" >
          <div class="selectBox s1">
            <label for="num_conciertos" style="padding-left: 5px;">No. de conciertos</label><br>
            <select  style="width:160px;" class="comboBox1" name="num_conciertos" >
              <option selected="selected" value="0">Seleccione...</option>
              <option value="0-10">0-10</option>
              <option value="10-30">10-30</option>
              <option value="30-50">30-50</option>
              <option value="50-100">50-100</option>
              <option value="100+">100 o más</option>
            </select>
          </div>
        </div>
        <div class="campo-reg-lab" style="width: 170px;" >
          <div class="selectBox s1">
            <label for="nivel_experiencia" style="padding-left: 5px;">Nivel de experiencia</label><br>
            <select  style="width:160px;" class="comboBox1" name="nivel_experiencia" >
              <option selected="selected" value="">Seleccione...</option>
              <option value="principiante">Principiante</option>
              <option value="intermedio">Intermedio</option>
              <option value="avanzado">Avanzado</option>                       
            </select>
          </div>   
        </div>
        <div class="campo-reg-lab" style="width: 170px;" >
          <div class="selectBox s1">
            <label for="experiencia" style="padding-left: 5px;">Experiencia</label><br>
            <select  style="width:160px;" class="comboBox1" name="experiencia" >
              <option selected="selected" value="">Seleccione...</option>
              <option value="0-2">0-2 años</option>
              <option value="2-4">2-4 años</option>
              <option value="4-6">4-6 años</option> 
              <option value="6-8">6-8 años</option>
              <option value="8-10">8-10 años</option>
              <option value="10+">10 o más años</option>
            </select>
          </div>
        </div>
        <div class="campo-reg-lab" style="width: 170px;" >
          <div class="selectBox s1">
            <label for="necesitas_band" style="padding-left: 5px;">Necesitas banda</label><br>
            <select  style="width:160px;" class="comboBox1" name="necesitas_band" >
              <option selected="selected" value="">Seleccione...</option>
              <option value="1">Si</option>
              <option value="0">No</option>
            </select>
          </div>
        </div>
        <div class="campo-reg-lab" style="width: 170px">
          <label for="city" style="padding-left: 5px;">Ciudad</label><br>
          <input class="campo2" name="city" id="city2" type="text" placeholder="Ciudad" style="margin-right: 4px;">
          <div class="clr"></div>
        </div>
        <div class="clr"></div>
        <div class="campo-reg-lab" style="width: 170px;" >
          <div class="clr"></div>
          <input type="submit" class="bot-aceptar" value="Buscar" style="margin-left: 12px; float: left;"/>
          <div class="clr"></div>
        </div>
        <div class="clr"></div>
      </div>
    </div>
    <?= form_close(); ?>
  </div>
  <!-- Fin formulario buscar en inshaka -->
  
  <!-- Formulario invitar un amigo -->
  <div id="invitation_friend" style="display:none; margin-top: -24px; padding-left: 20px; height: 100px;">
    <div class="clr"></div>
    <?= form_open('build-a-band/ajax/search_users_inshaka', 'id="search-users-form"'); ?>
    <div class="registro-campos">
      <div class="campo-reg-lab" style="width: 170px;" >
        <label for="username" style="padding-left: 5px;">Usuario</label><br>
        <input class="campo2" name="username" id="username" type="text" placeholder="Username" style="margin-right: 4px;">
      </div>
      <div class="campo-reg-lab" style="width: 170px;" >
        <label for="first_name" style="padding-left: 5px;">Nombre</label><br>
        <input class="campo2" name="first_name" id="first_name" type="text" placeholder="Nombre" style="margin-right: 4px;">
      </div>
      <div class="campo-reg-lab" style="width: 170px;" >
        <label for="last_name" style="padding-left: 5px;">Apellido</label><br>
        <input class="campo2" name="last_name" id="last_name" type="text" placeholder="Apellido" style="margin-right: 4px;">
      </div>
      <div class="campo-reg-lab" style="width: 345px" >
        <label for="email" style="padding-left: 5px;">E-mail</label><br>
        <input class="campo" name="email" id="email_guest" type="email" placeholder="correo@mail.com" style="margin-right: 4px; margin-left: 0px;">
      </div>
      <div class="campo-reg-lab" style="width: 170px;" >
        <input type="submit" class="bot-aceptar" value="Buscar" style="margin-right: 12px; float: left;"/>
      </div>
    </div>
    <?= form_close(); ?>
  </div>
  <!-- Fin fomulario invitar un amigo -->
  <div id="search-users-result">
        <div class="mensaje-tit">Resultados</div>
        <div id="non-results" style="display:none;">
            <small>No hay resultados para la búsqueda.</small>
        </div>
        <div id="error-result" style="display:none;">
            <small>Hubo un error en la búsqueda, por favor inténtalo de nuevo.</small>
        </div>
    </div>
</div>

<div id="lista-musicos-base" class="lista-musicos" style="display:none;">
    <div class="lista-musicos-tit">Músicos Seleccionados</div>
    <div class="musicos2 users">

        <div id="lista-musicos-user-base" class="musico2 user" style="display:none;">
            <div class="mus-sel2">
                <div class="m-nombre2 name-user"></div>
            </div>
            <div class="ver-mas-musico">
                <a class="url-user" href="#" target="_blank">Ver más</a>
            </div>
            <div data-action="eliminar-musico-lista-musicos" class="eliminar-musico">Eliminar</div>
        </div>
    </div>
</div>

<!-- Base del músico que va dentro de la lista -->
<div id="lista-musicos-user-base" class="musico2 user" style="display:none;">
    <div class="mus-sel2">
        <div class="m-nombre2 name-user"></div>
    </div>
    <div class="ver-mas-musico">
        <a class="url-user" href="#" target="_blank">Ver más</a>
    </div>
    <div data-action="eliminar-musico-lista-musicos" class="eliminar-musico">Eliminar</div>
</div>
<style>
    .jspHorizontalBar .jspTrack {
        margin-left: 16px;
        margin-right: 16px;
        width: 360px !important;
    }
    .jspHorizontalBar {
        width: 93% !important;
    }
    .jspHorizontalBar .jspDrag {
        margin-left: -14px !important;
    }
    .ico-perfil6{
      width: 27px;
      height: 27px;
      float: right;
      background-position: 0px -27px;
      margin-top: -82px;
      cursor: pointer;
      margin-right: 97px;
    }
    .ico-perfil6:hover{
      background-position: 0px 0px;
    }
</style>

<script>
    $(function(){
        var $this = $(this), sText = $this.html();
        $('#avanzada-button').ready(function(){			
            $('#busqueda-avanzada').toggle().parents('form')[0].reset();
        });
        $('#avanzada-button1').click(function(){			
            $('#cambiotabla').toggle().parents('table')[0].reset();
        });
        $('#mail_guest').on('click', function(){
          $('#modal_guest').dialog({
            resizable: false,
            modal: true,
            show : 'drop',
            hide : 'drop',
            width: '400px',
            buttons: {
              "Aceptar": function() {
                $.getJSON('<?= site_url("build_a_band/ajax/send_email_guest") ?>', {
                  email_invitado : $('email_guest').val(),
                  url_creador : <?= sprintf($urls->inshaka_url, $datos->inshaka_url) ?>,
                  nombre_creador : <?= $datos->first_name.' '.$datos->last_name ?>,
                  nombre_banda: $('#name_band').val()
                }, function() {
                  alert('Se ha enviado un email con la invitación a formar parte de tu banda, satisfactoriamente.!');
                });
                return $(this).dialog('close');
              },
              Cancel: function() {
                $( this ).dialog( "close" );
              }
            }
          });
        });
    });
</script>