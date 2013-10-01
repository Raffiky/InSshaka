<style>
  ul.message-pub li{
    width: 97%;
    overflow: hidden;
    background: #F5F5F5;
    border: 1px solid #E5E5E5;
    box-shadow: inset 0 0 0 1px #F9F9F9;
    border-radius: 4px;
    -webkit-border-radius: 4px;
    -moz-border-radius: 4px;
    margin-top: 3px;
    padding: 7px;
  }
</style>
<script type="text/javascript">
  $(function(){
    $('.favorite-advertisement, .myself_favorites').tooltipster({
      theme: '.my-custom-theme',
      arrow: true,
      animation: 'grow',
      arrowColor: '#DE2773'
    });   
  });
  function addfavorite(elemento, id) {
    $("#anuncio-" + elemento).dialog({
      resizable: false,
      modal: true,
      show : 'drop',
      hide : 'drop',
      width: '400px',
      buttons: {
        "Aceptar": function() { 
          $.getJSON('<?= site_url("clasificados/clasificados/add_favorite") ?>', {
            id : id
          }, function() {
            location.reload();
          });
          return $(this).dialog('close');
        },
        Cancel: function() {
          $( this ).dialog("close");
        }
      }
    })
  }
</script>
<div class="bgEncabezado">
  <div class="conEncabezado">
    <div id="txSeccion">
      <div class="encabezado-tit">Clasificados</div>
      <div class="encabezado-subtit">Ofertas armónicas</div>
    </div>
  </div>
</div>
<div class="contenido">
  <div class="clear"></div>
  <div class="tab_container">
    <div id="tab6" class="tab_content">
      <div id="contenu3">
        <div class="resultado-detalle">
          <?php if (false === $is_owner) : ?>
            <?php if(!$favorito->get_favorite($datos->id)->exists()) : ?>
          <div class="favorite-advertisement" title="Añadir este clasificado a mis favoritos." onclick="addfavorite('<?= $datos->var ?>', <?= $datos->id ?>);"></div>
          <div id="anuncio-<?= $datos->var ?>" title="Agregar a favoritos" style="display:none">
            <p>
              Estás seguro que deseas agregar este anuncio a tus favoritos?
            </p>
          </div>
          <?php else : ?>
          <div class="myself_favorites" title="Este anuncio ya es uno de tus favoritos"></div>
          <?php endif; ?>
        <?php endif; ?>
          <div class="resultado-tit"><?php echo $datos->titulo ?></div>
          <div class="clr"></div>
          <div class="resultado-desc3">
            <?php 
              $patron = '%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i';
              if(preg_match_all($patron, $datos->descripcion, $coincidencias, PREG_OFFSET_CAPTURE)) {
                foreach ($coincidencias[0] as $coincide) {
                  $words_search[] = "http://".$coincide[0];
                  if(is_youtube_url("http://".$coincide[0])){
                    $datos->get_oembed("http://".$coincide[0]);  
                    $url_status = str_replace($coincide[0], "<a class='group iframe' href='".$datos->oembed->url."' rel='fancy-gallery-iframe' style='float:left;'><img src='".$datos->oembed->thumbnail_url."' style='height: 60px; margin: 0px 3px;' /></a><div style='float:left; width: 410px; margin-left: 15px; font-size: 0.85em;'><span style='color:#E82E7C; font-weight: bold'>".$datos->oembed->title."</span><p> Autor: ".$datos->oembed->author_name."</p><p>".$datos->oembed->description."</p></div>", $coincide[0]);
                    $url_reemplazar = str_replace($coincide[0], "<a href='".$datos->oembed->url."' target='_blank' style='color: #E82E7C;'>".$coincide[0]."</a>", $coincide[0]);
                  } 
                  $mension[] = $url_status;
                  $videos[] = $url_reemplazar;
                }
                $video = true;
                $status_replace = str_replace($words_search, $videos, $datos->descripcion);
              }else{
                $video = false;
                $status_replace = $datos->descripcion;
              }
            ?>     
              <p><?= $status_replace ?></p>
              <?php if($video === true) : ?>
              <div class="clear" style="margin-top: 10px;"></div>
              <ul class="message-pub">
                <?php foreach ($mension as $video) : ?>
                  <li><?= $video ?></li>
                <?php endforeach; ?>
              </ul>
              <?php endif; ?>
              <div class="clr"></div>
            <div class="anuncio-datos">
              <div><b>Publicado por:</b> <?php echo $datos->user->first_name, ' ', $datos->user->last_name ?></div>
              <div><b>Ciudad:</b> <?php echo $datos->ciudad ?></div>
              <div><b>Fecha inicio:</b> <?php echo fecha_spanish_full($datos->created_on) ?></div>
              <?php if (!empty($datos->precio)) : ?>
                <div><b>Precio:</b> <?php echo price_format($datos->precio) ?></div>
              <?php endif; ?>
              <div><b>Fecha de cierre:</b> <?php echo fecha_spanish_full($datos->fecha_cierre) ?></div>
              <?php
              // dia actual y dia anterior
              $hoy = date("d-m-Y");
              $ant = $datos->fecha_cierre;
              $hoy1 = explode("-", $hoy);
              $diahoy = $hoy1[0];
              $meshoy = $hoy1[1];
              $anohoy = $hoy1[2];
              $diaant = explode("-", $ant);
              $anoant = $diaant[0];
              $mesant = $diaant[1];
              $diaant = $diaant[2];
              $timestamp1 = mktime(0, 0, 0, $meshoy, $diahoy, $anohoy);
              $timestamp2 = mktime(0, 0, 0, $mesant, $diaant, $anoant);
              //resto a una fecha la otra 
              $segundos_diferencia = $timestamp2 - $timestamp1;
              //  echo $segundos_diferencia; 
              //var_dump($diaant[2]);                                             
              //convierto segundos en días 
              $dias_diferencia = $segundos_diferencia / (60 * 60 * 24);
              //echo $dias_diferencia;                       
              if ($dias_diferencia > 0) {
                ?>
                <div class="regis-subtit"><b>Todavía puedes aplicar a este clasificado por <?php echo $dias_diferencia ?> días más.</b></div> 
              <?php } else { ?>
                <div class="regis-subtit"><b>Tiempo agotado para aplicar a este clasificado</b></div> 
              <?php } ?>
              <div class="fb-like"  data-send="false" data-layout="button_count" data-width="100" data-show-faces="false"></div>
            </div>
            <div class="clr"></div>
          </div>
          <?php if (!empty($datos->imagen)) : ?>
            <div class="anuncio-img">
              <img src="<?php echo uploads_url($datos->imagen) ?>" />
            </div>
          <?php endif; ?>
          <div class="clr"></div>
          <?php if (false === $is_owner) : ?>
            <?php if (true === $can_apply) : ?>
              <div class="regis-tit">Contáctar al clasificado</div>
              <div class="regis-subtit">&nbsp;</div>
              <?php echo form_open('clasificados/aplicar', null, array('clasificado_id' => $datos->id)) ?>
              <textarea style="resize: none;" name="presentacion" class="area2" placeholder="Carta de presentación (opcional)"></textarea>
              <input class="bot-publicar" type="submit" value="contactar">
              <?php echo form_close() ?>

              <div class="clr"></div>
              <?php
            else:
              // dia actual y dia anterior
              $hoy = date("d-m-Y");
              $ant = $datos->fecha_cierre;
              $hoy1 = explode("-", $hoy);
              $diahoy = $hoy1[0];
              $meshoy = $hoy1[1];
              $anohoy = $hoy1[2];
              $diaant = explode("-", $ant);
              $anoant = $diaant[0];
              $mesant = $diaant[1];
              $diaant = $diaant[2];

              $timestamp1 = mktime(0, 0, 0, $meshoy, $diahoy, $anohoy);
              $timestamp2 = mktime(0, 0, 0, $mesant, $diaant, $anoant);

              //resto a una fecha la otra 
              $segundos_diferencia = $timestamp2 - $timestamp1;
              //  echo $segundos_diferencia; 
              //var_dump($diaant[2]);                                             
              //convierto segundos en días 
              $dias_diferencia = $segundos_diferencia / (60 * 60 * 24);
              //echo $dias_diferencia;                       
              if ($dias_diferencia > 0) {
                ?>
                <!--  <div class="regis-subtit">Todavía puedes aplicar a este clasificado por <?php echo $dias_diferencia ?> días más.</div> -->
              <?php } else { ?>
                <!--   <div class="regis-subtit">Tiempo agotado para aplicar a esta audicion</div> --><b>
                <?php } ?>

              <?php endif; ?>
            <?php endif; ?>
        </div>
      </div>
      <div class="clr"></div>
    </div>
    <div class="clr"></div>
  </div>
</div>

<div class="clr"></div>