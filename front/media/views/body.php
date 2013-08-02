 <link rel="stylesheet" type="text/css" href="<?= front_asset('css/style_slide_media.css') ?>" />
<!-- jmpress plugin -->
<script type="text/javascript" src="js/jmpress.min.js"></script>
<!-- jmslideshow plugin : extends the jmpress plugin -->
<script type="text/javascript" src="js/jquery.jmslideshow.js"></script>
<style type="text/css">
  #msdrpdd20_titletext, #msdrpdd21_titletext{
    background-image: none;
  }
  .media_sections{
    padding: 10px 20px 10px 40px;
    background-color: #d3d6d6;
    clear: both;
    height: 140px;
    margin-top: 20px;
  }
  .media_tumb{
    margin-right: 43px;
    float: left
  }
  .description-artist{
    width: 350px;
    background-color: #F4F5F8;
    float: right;
    text-align: justify;
    color: #000;
    padding: 10px 20px;
    font-size: 15px;
    border-radius: 7px;
    -moz-border-radius: 7px;
    -webkit-border-radius: 7px;
  }
  .description-artist b{
    font-family: 'BebasNeueRegular';
    color: #E82E7C;
    font-size: 30px;
  }
</style>
<div class="bgEncabezado">
  <div class="conEncabezado">
    <div id="txSeccion">
      <div class="encabezado-tit">Media</div>
      <div class="encabezado-subtit">Videos, fotos y más!</div>
    </div>
  </div>
</div>
<div class="contenido">
  
  <div id="slideshow" style="height: 265px">
    <?php if($destacados->exists()) : ?>
    <!-- slideshow de videos -->
    <section id="jms-slideshow" class="jms-slideshow">
      <?php foreach ($destacados as $banner) : $banner->get_oembed() ?>
        <div class="step" data-color="color" >
          <div class="jms-content">
          <h3><?= $banner->oembed->title ?></h3>
          <p><?= $banner->description ?></p>
          <a class="jms-link" href="#">Ver más</a>
          </div>
          <img src="<?= $banner->oembed->thumbnail_url ?>" />
        </div>    
      <?php endforeach; ?>
    </section>
    <script type="text/javascript">
    $(function() {

        var jmpressOpts	= {
               animation		: { transitionDuration : '0.8s' }
        };

        $( '#jms-slideshow' ).jmslideshow( $.extend( true, { jmpressOpts : jmpressOpts }, {
               autoplay	: true,
               bgColorSpeed: '0.8s',
               arrows		: false
        }));

    });
    </script>
    <!-- fin slideshow -->
    <?php endif; ?>
  </div>
  
  <div class="bgEncabezado" style="height: 50px; margin-top: 10px;">
    <div class="conEncabezado">
      <div id="txSeccion">
        <div class="encabezado-tit" style="padding-top: 0px; font-size: 35px">Artístas</div>
      </div>
    </div>
  </div>  
  <div class="clr"></div>
  <?php if (!empty($alert_messages)) : ?>
    <div><?php echo $alert_messages ?></div>
  <?php endif; ?>
  <div class="clr"></div>
  <form action="<?php echo site_url('media/buscar') ?>">
    <div class="campo-reg-lab" style="width: 425px;">
      <label style="padding-left: 4px;">Artista o Banda</label>
      <div class="select-large" style="margin-left: -7px; float: left">
        <?= form_dropdown('artist', $select_artistas, null, 'style="width:385px;"   class="comboBox1"') ?>
        <div class="clr"></div>
      </div>
    </div>
    <div class="campo-reg-lab" style="width: 420px;">
      <label style="padding-left: 4px;">Género Musical</label>
      <div class="select-large" style="margin-left: -7px; float: left">
        <?= form_dropdown('musical_gender', $select_genero, null, 'style="width:385px;"   class="comboBox1"') ?>
        <div class="clr"></div>
      </div>
    </div>
    <div class="clr"></div>
    <input type="submit" class="bot-buscar" value="buscar" style="margin-bottom: 10px; margin-top: 7px; float:left;"/>
    <a class="bot-registro2 cambia-cont" href="<?= site_url('media/buscar/pagina/1?artist=0&musical-gender=0') ?>" style="margin-bottom: 10px; margin-top: 7px; float:left; padding-left: 8px; width: 90px;">Restablecer</a>
  </form>
  <div class="clr"></div>
  <div class="clear"></div>
  <div id="resultados" style=" width: 987px; margin: 0 auto; padding: 10px">
    <?php if (!empty($datos)): ?>
      <?php if ($datos->exists()): ?>
        <?php foreach ($datos as $artista) : ?>
        <div class="res-perfil" style="margin: 25px 0px 15px; width: 145px; padding: 10px 20px; background-color: #dddddd">
          <div class="foto-banda">
            <a href="<?= site_url('media/detalle/'.$artista->var) ?>" style="display:block; height:144px; overflow:hidden;">
              <?php if(empty($artista->image)) : ?>
                <img src="images/imagensino.png" width="140" height="140" >
              <?php else: ?>
               <img width="140" height="140" src="<?= uploads_url($artista->image) ?>">
              <?php endif; ?>
            </a>
            <div class="res-datos">
              <div class="res-txt" style="font-size: 17px;">Nombre: <b><?= strlen($artista->name) <= 15 ? $artista->name : substr($artista->name, 0, 15)?></b></div>
              <div class="res-txt" style="font-size: 17px;">Género: <b><?= $artista->musical_gender->name ?></b></div>
            </div>
          </div>
        </div>
        <?php endforeach; ?>
        <div class="clear"></div>
        <?php if ($datos->paged->total_pages > 1) : ?>
          <!-- Paginador -->
          <div class="paginador">
            <?php if ($datos->paged->has_previous) : ?>
              <a href="<?php echo sprintf($paginator_url, $datos->paged->previous_page) ?>"><div class="pag-prev"></div></a>
            <?php endif; ?>
            <div class="numeros">
              <?php for ($i = 1, $total_pages = $datos->paged->total_pages; $i <= $total_pages; $i++) : ?>
                <div class="<?php echo $i == $datos->paged->current_page ? 'numero-act' : 'numero' ?>">
                  <a href="<?php  echo $i != $datos->paged->current_page ? sprintf($paginator_url, $i) : 'javascript:;' ?>">
                    <?php echo $i ?>
                  </a>
                </div>
              <?php endfor; ?>
            </div>
            <?php if ($datos->paged->has_next) : ?>
              <a href="<?php echo sprintf($paginator_url, $datos->paged->next_page) ?>"><div class="pag-next"></div></a>
            <?php endif; ?>
          </div>
          <!-- // Paginador -->
        <?php endif; ?>
      <?php else : ?>
        <div class="resultados">Su búsqueda no produjo resultados.</div>
      <?php endif; ?>
    <?php endif; ?>
  </div>
</div>