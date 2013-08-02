<div class="bgEncabezado">
  <div class="conEncabezado">
    <div id="txSeccion">
      <div class="encabezado-tit">Audiciones</div>
      <div class="encabezado-subtit">&nbsp;</div>
    </div>
  </div>
</div>

<div class="contenido">
  <div class="clear"></div>
  <a class="bot-rosa2 cambia-cont" href="<?php echo site_url('audiciones') ?>">Volver al listado</a>
  <div class="clear"></div>
  <div class="tab_container">

    <div id="tab3" class="tab_content">
      <?php if (!empty($alert_messages)) : ?>
        <div><?php echo $alert_messages ?></div>
      <?php endif; ?>
      <div class="nuevas-audiciones">
        <div class="audicion">
          <?php if (!empty($datos->imagen)) { ?>
            <div class="audicion-img">
              <img src="<?php echo uploads_url($datos->imagen) ?>" alt="" width="200" />
            </div>
          <?php } else { ?>
            <div class="audicion-img">
              <img src="<?php echo site_url('assets/images/logo-anuncio.png') ?>" width="200" />
            </div>
          <?php }
          ?>
          
          <div class="audicion-info2">
            <div class="audicion-tit2"><?php echo $datos->titulo ?>
              <div class="audicion-post" style="font-size: 11px; font-weight: bold;">
                <a href="<?= site_url('perfil/'.$datos->user->inshaka_url) ?>" target="_blank">Por: <?= $user ?></a>
              </div>
              <div class="audicion-post">Creado el <?php echo fecha_spanish_full($datos->created_on) ?></div>
            </div>
            <div class="audicion-datos2">
              <div class="num-cupos">No. Aplicaciones</br><b><?php echo $datos->total_aplicaciones ?>/<?php echo $datos->numero_aplicaciones ?></b></div>
              <div class="audicion-lugar">Ciudad </br><b><?php echo $datos->ciudad ?></b></div>
              <div class="audicion-fecha1">Fecha de inicio </br><b><?php echo fecha_spanish_full_short($datos->fecha_inicio) ?></b></div>
              <div class="audicion-fecha2">Fecha de cierre </br><b><?php echo fecha_spanish_full_short($datos->fecha_cierre) ?></b></div><div class="clr" style="height: 15px;"></div>
              <div class="audicion-fecha1" style="margin-right: 20px;">Fecha de audición </br><b><?php echo fecha_spanish_full_short($datos->fecha_audicion) ?></b></div>
              <div class="audicion-fecha1">Número de Contacto </br><b><?php echo $datos->contacto ?></b></div>
              <?php if($datos->tipo_audicion == "Individual") : ?>
              <div class="num-cupos">Talento</br><b style="font-size: 14px; color:#666"><?php echo $talento ?></b></div>
              <?php else : ?>
              <div class="num-cupos">Género de Banda</br><b style="font-size: 14px; color:#666"><?php echo $banda->name ?></b></div>
              <?php endif; ?>
            </div>
          </div>
          <div class="audicion-txt2">
              <?php echo $datos->descripcion ?>
            <br>
            <br>

            <!--  <div id="final_apps" class="audicion-tit2" style="position: absolute;margin-left: -210px;margin-top: 14px;">hola a todso jejejje</div>  -->



          </div>

          <div class="fb-like"  data-send="false" data-layout="button_count" data-width="100" data-show-faces="false"></div>
          <div class="clr"></div>
        </div>
        <?php if (false === $is_owner) : ?>
          <?php if (true === $can_apply) : ?>
            <div class="clear"></div>
            <div class="regis-tit">Aplicar a audición</div>
            <div class="clear"></div>
            <div class="clr"></div>
            <?php echo form_open('audiciones/aplicar', 'style="float:left;"', array('audicion_id' => $datos->id)) ?>
            <div class="area-cont2">
            <textarea style="resize: none; height: 50px;" name="presentacion" class="area2" placeholder="Escribe aquí tu carta de presentación (Opcional)"></textarea>
            </div>
            <div class="clear"></div>
            <div class="clear"></div>
            <input class="bot-publicar" type="submit" value="aplicar" style="margin-top:10px; float: left;">
            <?php echo form_close() ?>
            <div class="clr"></div>
          <?php elseif($can_apply_band->exists()) : ?>
          <a class="bot-rosa2 cambia-cont" id="apply-band" href="#bandas">Aplicar con banda</a>
          <?php else: ?>
            <div class="regis-subtit"><?php echo $dias_restantes ?></div>            
          <?php endif; ?>
        <?php endif; ?>
      </div>
    </div>


    <div class="clr"></div>
  </div>
</div>

<!-- Ventanas modal -->
<div id="bandas" style="display: none">
  <?php if($mis_bandas->exists()) : ?>
    <div class="musicos-cont">
    <div class="mensaje-tit">Mis Bandas</div>
    <?php foreach($mis_bandas as $mi_banda) : ?>
      <div class="lista-check2" style="position: absolute; clear: both; float: left; margin-left: 0px; ">
        <input id="img-perfil-<?= $mi_banda->id ?>" type="checkbox" name="img-perfil-<?= $mi_banda->id ?>">
        <label for="img-perfil-<?= $mi_banda->id ?>">
          Nombre de la banda: <b><?php echo $mi_banda->name ?></b>
      </div><br><br>
      <script type="text/javascript">
         $(function(){
            $('#img-perfil-<?= $mi_banda->id ?>').on('change', function(){
              $( "#dialog-confirm" ).dialog({
                resizable: false,
                modal: true,
                show : 'drop',
                hide : 'drop',
                width: '400px',
                buttons: {
                  "Aceptar": function() {
                    $.getJSON('<?= site_url('audiciones/applyband') ?>', {
                      band_id : <?= $mi_banda->id ?>,
                      audicion_id : <?= $datos->id ?>
                    }, function() {
                      location.reload();
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
    <?php endforeach; ?>
    </div>
  <?php endif; ?>
</div>

<div id="dialog-confirm" title="Aplicar a audición" style="display:none">
  <p>
    Estás seguro que quieres aplicar a la audición con esta banda?
  </p>
</div>
<!-- Fin ventanas modal -->
<style type="text/css">
  .info-banda{
        margin: 0 auto;
        width: 420px;
    }
</style>
<script type="text/javascript">
  $(function(){
    $('#apply-band').fancybox();
  });
</script>