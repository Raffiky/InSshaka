


<div class="bgEncabezado">
  <div class="conEncabezado">
    <div id="txSeccion">
      <div class="encabezado-tit">Noticias</div>
      <div class="encabezado-subtit">Noticias actualizadas del mundo de la música</div>
    </div>
  </div>
</div>

<div class="contenido">


  <div class="clear"></div>
  <div class="tab_container">
    <div id="tab1" class="tab_content">
      <div style="float: left; margin-left: -90px">
      <?php foreach ($news as $noticia) : ?>
      <div class="selectores-directorio">
          <article class="noticia-mini">
            <header class="publi-header">
              <div class="publi-tit"><a style="font-size: 26px;" href="<?= site_url(array('noticias', $noticia->var)) ?>" alt="<?= $noticia->title ?>"><?php echo $noticia->title ?></a></div>
            </header>
            <div class="publi-subtit" style="margin-left: -105px;"><time datetime="<?php echo $noticia->created_on ?>" pubdate="pubdate"><?php echo fecha_spanish_full($noticia->created_on, true) ?></time></div>
            <div class="noticias-info">
              <div class="publi-nom"><?= substr($noticia->content, 0, 200) ?>...</div>
              <div class="audicion-img"><img style="position: absolute;margin-left: 106px;margin-top: -104px;width: 400px;height: 209px;" src="<?php echo cms_upload_url($noticia->news_images->image) ?>" /></div>
              <div class="clr"></div>
              <div class="conBtMas">
                <div id="txBtMas"><a href="<?php echo site_url(array('noticias', $noticia->var)) ?>" alt="<?= $noticia->title ?>"><span class="verMas">Leer Más</span></a></div>
                <a href="<?php echo site_url(array('noticias', $noticia->var)) ?>" alt="<?= $noticia->title ?>"><div id="imgBtMas"></div></a>
              </div>
            </div>
          </article>
        <div class="clr"></div>
      </div>
      <?php endforeach; ?>
      </div>
</div>    
    <!-- prueba -->
    <div id="file-news">
    <div class="acotacion-campo2">Archivo de noticias</div>
    <div class="scroll-news">
      <?php foreach ($list_news as $lista) : ?>
      <div class="publi-header" style="text-align: left; clear: both; padding: 7px; ">
        <div class="triangulo_der"></div>
        <a class="publi-tit" href="<?php echo site_url(array('noticias', $lista->var)) ?>" ><?php echo $lista->title ?> </a>
      </div>
      <?php endforeach; ?>
    </div>
    </div>
    <!-- fin prueba -->
    </div>
    <div class="clr"></div>
  </div>
<script type="text/javascript">
  $(function(){
    $('.scroll-news').jScrollPane();
  });
</script>
<style type="text/css">
  #file-news {
    float: right;
    width: 200px;
    margin-left: 10px;
    margin-right: -130px;
  }
  .triangulo_der {
    width: 0;
    height: 0;
    float: left;
    margin-top: 3px;
    border-top: 4px solid transparent;
    border-left: 8px solid #E82E7C;
    border-bottom: 4px solid transparent;
}
  .scroll-news {
    width: 200px;
    max-height: 300px;
  }
  
  .publi-tit {
    font-size: 18px; 
    margin-left: 5px;
  }
  .publi-tit:hover{
    color:#555c5b;
  }
</style>