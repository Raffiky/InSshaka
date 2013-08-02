


<div class="bgEncabezado">
  <div class="conEncabezado">
    <div id="txSeccion">
      <div class="encabezado-tit">Noticias</div>
      <div class="encabezado-subtit">Lorem ipsum dolor sit amet</div>
    </div>
  </div>
</div>

<div class="contenido">


  <div class="clear"></div>
  <div class="tab_container">
    <a class="bot-rosa2 cambia-cont" href="<?php echo site_url('noticias') ?>">Regresar al blog</a>
    <div id="tab3" class="tab_content">
      <div class="nuevas-audiciones" style="float: left; margin-left: -100px;">
        <div class="audicion">
          <div class="audicion-img"><img src="<?php echo cms_upload_url($news->news_image->thumb) ?>" /></div>
          <div class="audicion-info2">

            <div class="audicion-tit2"><?php echo $news->title ?>
              <div class="audicion-post">Creado el <?php echo fecha_spanish_full($news->created_on, true) ?></div>
            </div>
          </div>
          <div class="audicion-txt2"> <?php echo $news->content ?></div>
          <div class="bot-like" style="float:right;"></div>
          <a href="https://twitter.com/share" class="twitter-share-button" data-url="http://www.inshaka.com" data-text="Inshaka" data-via="inshaka" data-lang="es">Twittear</a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
          <div class="clr"></div>
        </div>


        <div class="clr"></div>
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

      <div class="clr"></div>
    </div>
  </div>
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