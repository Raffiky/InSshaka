 <link rel="stylesheet" type="text/css" href="<?= front_asset('css/style_slide_media.css') ?>" />
<!-- jmpress plugin -->
<script type="text/javascript" src="js/jmpress.min.js"></script>
<!-- jmslideshow plugin : extends the jmpress plugin -->
<script type="text/javascript" src="js/jquery.jmslideshow.js"></script>
<style type="text/css">
  #msdrpdd20_titletext{
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
    font-size: 13px;
    border-radius: 7px;
    -moz-border-radius: 7px;
    -webkit-border-radius: 7px;
    height: 119px;
    overflow: hidden;
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
        <div class="encabezado-tit" style="padding-top: 0px; font-size: 35px"><?= $datos->name ?></div>
      </div>
    </div>
  </div>  
  <div class="clr"></div>
  <div class="clr"></div>

  <div class="clr"></div>
  <div class="clear"></div>
  <!-- Sesiones inshaka -->
    <?php if(!empty($sesiones)) : ?>
    <div class="media_sections"> 
      <?php foreach ($datos->artists_media as $media) : $media->get_oembed() ?>
        <?php if($media->media_categoria_id == $sesiones->media_categoria->id) : ?>
          <div class="media_tumb">
            <a class="group iframe" href="<?php echo $media->oembed->url ?>" rel="fancy-gallery-iframe">
              <img src="<?= $media->oembed->thumbnail_url ?>" width="140" height="140" />
            </a>
          </div>
        <?php endif; ?>
      <?php endforeach; ?>
      <div class="description-artist">
        <b><?= $sesiones->media_categoria->name ?></b>
        <p style="margin-top: 10px;">
          <?= $sesiones->media_categoria->description ?>
        </p>
      </div>
    </div>
  <?php endif; ?>
  <!-- Fin sesiones inshaka -->
  
  <!-- Contando historias -->
  <?php if(!empty($contando_historias)) : ?>
    <div class="media_sections"> 
      <?php foreach ($datos->artists_media as $media) : $media->get_oembed() ?>
        <?php if($media->media_categoria_id == $contando_historias->media_categoria->id) : ?>
          <div class="media_tumb">
            <a class="group iframe" href="<?php echo $media->oembed->url ?>" rel="fancy-gallery-iframe">
              <img src="<?= $media->oembed->thumbnail_url ?>" width="140" height="140" />
            </a>
          </div>
        <?php endif; ?>
      <?php endforeach; ?>
      <div class="description-artist">
        <b><?= $contando_historias->media_categoria->name ?></b>
        <p style="margin-top: 10px;">
          <?= $contando_historias->media_categoria->description ?>
        </p>
      </div>
    </div>
  <?php endif; ?>
  <!-- Fin contando historias -->
  
  <!-- Detrás de escena -->
  <?php if(!empty($detras_escena)) : ?>
    <div class="media_sections"> 
      <?php foreach ($datos->artists_media as $media) : $media->get_oembed() ?>
        <?php if($media->media_categoria_id == $detras_escena->media_categoria->id) : ?>
          <div class="media_tumb">
            <a class="group iframe" href="<?php echo $media->oembed->url ?>" rel="fancy-gallery-iframe">
              <img src="<?= $media->oembed->thumbnail_url ?>" width="140" height="140" />
            </a>
          </div>
        <?php endif; ?>
      <?php endforeach; ?>
      <div class="description-artist">
        <b><?= $detras_escena->media_categoria->name ?></b>
        <p style="margin-top: 10px;">
          <?= $detras_escena->media_categoria->description ?>
        </p>
      </div>
    </div>
  <?php endif; ?>
  <!-- Fin detras de escena -->
</div>