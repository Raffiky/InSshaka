<style type="text/css">
/*  .header, #seguidores, #permitido{
    position: fixed;
    z-index: 999999;
  }*/
  nav ul{
    padding: 10px;
    width: 43%;
    margin: 0 auto;
  }
  nav ul li{
    display: inline-block;
    margin-left: 20px;
  }
  nav ul li .nav-social{
    padding: 10px 30px;
    background-color: #E82E7C;
    border-radius: 7px;
    -moz-border-radius: 7px;
    -webkit-border-radius: 7px;
    color: #FFF;
    font-family: "BebasNeueRegular";
    font-size: 18px;
    cursor: pointer;
  }
  nav ul li .nav-social:hover{
    opacity: 0.8;
  }
  nav ul li:first-child{
    margin-left: 0px;
  }
  .social{
    float: left;
    width: 65%;
    padding: 10px 0px;
  }
  .tags_social{
    float: left;
    width: 33%;
    padding: 28px 10px;
  }
  .new_follower{
    padding: 10px;
    border: 1px solid #999;
    background-color: #EEE;
    border-radius: 7px;
    -moz-border-radius: 7px;
    -webkit-border-radius: 7px;
    width: 60%;
    height: auto;
    margin-top: 20px;
    position: relative;
    clear: both;
    float: left;
  }
  .new_follower img{
    float: left;
  }
  .content_follower{
    float: left;
    width: 83%;
    margin-left: 10px;
    font-family: "Arial";
    color: #666;
    font-size: 0.8em;
  }
  .content_follower a:hover{
    text-decoration: underline;
    color: #E82E7C;
  }
  .content_follower span{
    color: #E82E7C; 
    font-family: 'BebasNeueRegular'; 
    font-size: 1.25em;
  }
  .follower_new{
    width: 90%;
    border: 1px solid #F5F5F5;
    border-radius: 8px;
    -moz-border-radius: 8px;
    -webkit-border-radius: 8px;
    margin-top: 3px;
    min-height: 80px;
    padding: 10px 20px;
    background-color: #E5E5E5;
    position: relative;
    overflow: hidden;
  }
  
  #blq-publicitario{
    width: 320px;
    height: 230px;
    background-color: #E82E7C;
    z-index: 3;
    margin: 15px 18px;
    position: relative;
  }
  .btn_follow_follower{
    padding: 5px 10px;
    background-color: #E82E7C;
    border-radius: 7px;
    -moz-border-radius: 7px;
    -webkit-border-radius: 7px;
    color: #FFF;
    position: relative;
    float: right;
    margin-top: 5px;
    cursor: pointer;
  }
  
  #img-recomendaciones{
    width: 288px;
    height: 325px;
    background-color: #EAEBEB;
    border-radius: 7px;
    -moz-border-radius: 7px;
    -webkit-border-radius: 7px;
    padding: 15px;
    margin-left: 19px;
    position: relative;
    z-index: 3;
    margin-top: 15px;
  }
  .random_user{
    background-color: #E5E5E5;
    border: 1px solid #F5F5F5;
    border-radius: 4px;
    -moz-border-radius: 4px;
    -webkit-border-radius: 4px;
    padding: 10px;
    width: 93%;
    height: 30px;
    float: left;
    box-shadow: 22px 20px 35px #dfe2e1
  }
  .content-random{
    float: left;
    margin-left: 10px;
    text-align: justify;
  }
  .content-random a:hover, .content-random p span:hover {
    text-decoration: underline;
  }
  .btn-share-like-comment{
    width: 97%;
    height: 20px;
    padding: 5px;
  }
  .btn-sociales{
    float: right;
    color: #FFF;
    cursor: pointer;
    background-color: #E82E7C;
    width: 70px;
    padding: 6px 10px;
    text-align: center;
    border-radius: 7px;
    -webkit-border-radius: 7px;
    -moz-border-radius: 7px;
    margin-left: 15px;
  }
  
  .ajax-load-comments{
    background: #FFF url('<?= front_asset('images/loading.gif') ?>') no-repeat;
    opacity: 0.75;
    width: 480px;
    height: 248px;
    position: absolute;
    z-index: 777;
    margin-top: -230px;
    background-position: center;
    border-radius: 8px;
    -moz-border-radius: 8px;
    -webkit-border-radius: 8px;
  }
  .comments-intelligence{
    height: auto;
    min-height: 30px;
  }
  .btn-sociales:hover{
    opacity: 0.85;
  }
  a.btn-sociales:hover{
    color: #FFF;
    text-decoration: none;
  }
</style>
<div class="contenido">
  <div class="new_follower">
    <?php $photo->where(array('user_id' => $datos->intelligence->user->id, 'profile_active' => true))->get(); ?>
    <div style="float:left">
      <?php if ($photo->exists()) : ?>
        <img  src="<?= uploads_url($photo->get_photo($datos->intelligence->user->id)) ?>" width="80" />
      <?php else :?>
        <img  src="images/foto-perfil.png" width="80" />
      <?php endif; ?>
    </div>
    <div class="content_follower" style="<?= empty($datos->intelligence->users_follow_id) ? 'display:none' : null ?>">
      <a href="<?= site_url('perfil/'.$datos->intelligence->user->inshaka_url) ?>">
        <span><?= $datos->intelligence->user->first_name.' '.$datos->intelligence->user->last_name ?></span>
      </a>
      <div class="follower_new">
        <p style="font-style: italic; text-align: justify; height: 25px;">
          <?= strlen($datos->intelligence->user->bio) >= 140 ? substr($datos->intelligence->user->bio, 0, 140)."..." : $datos->intelligence->user->bio?>
        </p>
        <div class="clear"></div>
        <div class="btn-share-like-comment">
          <a href="<?= site_url('perfil/'.$datos->intelligence->user->inshaka_url) ?>" class="btn-sociales">
            Ver Perfil
          </a>
        </div>
      </div>
    </div>
    <div class="content_follower" style="<?= !empty($datos->intelligence->users_follow_id) ? 'display:none' : null ?>">
      <a href="<?= site_url('perfil/'.$datos->intelligence->user->inshaka_url) ?>">
        <span><?= $datos->intelligence->user->first_name.' '.$datos->intelligence->user->last_name ?></span>
      </a>
      <?php if(!empty($datos->intelligence->audicion_id)) : ?>
        Ha creado una nueva audición
      <?php elseif (!empty($datos->intelligence->band_id)) : ?>
        Ha creado una nueva banda
      <?php elseif (!empty($datos->intelligence->clasificado_id)) : ?>
        Ha creado un nuevo clasificado
      <?php elseif (!empty($datos->intelligence->statu_id)) : ?>
        Ha cambiado su estado
      <?php elseif (!empty($datos->intelligence->audiciones_aplicacion_id)) : ?>
        Ha aplicado a una audición
      <?php elseif (!empty($datos->intelligence->users_show_id)) : ?>
        Ha creado un evento
      <?php endif; ?>
      <span style="font-family: 'Arial'; font-style: italic; font-size: 0.85em; float: right;">
        <?= fecha_spanish_full_short($datos->intelligence->update_on).' - '. get_hour($datos->intelligence->update_on) ?>
      </span>
      <div class="clear"></div>
      <div class="follower_new">
        <?php if (!empty($datos->intelligence->band_id)) : ?>
        <div style="float:left">                    
          <?php $profile_band = $datos->intelligence->band->page->pages_photo->where('profile_active', true)->get() ?>
          <?php if($profile_band->exists()) : ?>
            <img  src="<?= uploads_url($profile_band->thumb) ?>" width="80" />
          <?php else :?>
            <img  src="images/imagensino.png" width="80" />
          <?php endif; ?>
        </div>
        <?php else : ?>
        <div style="float:left; <?= !empty($datos->intelligence->statu_id) && !is_youtube_url($datos->intelligence->statu->status) ? 'display: none' : null  ?>">
          <?php if (!empty($datos->intelligence->audicion->imagen)) : ?>
            <img  src="<?= uploads_url($datos->intelligence->audicion->imagen) ?>" width="80" />
          <?php elseif (!empty($datos->intelligence->audiciones_aplicacion->audicion->imagen)) : ?>
            <img  src="<?= uploads_url($datos->intelligence->audiciones_aplicacion->audicion->imagen) ?>" width="80" />
          <?php elseif (!empty($datos->intelligence->clasificado->imagen)) : ?>
            <img  src="<?= uploads_url($datos->intelligence->clasificado->imagen) ?>" width="80" />
          <?php elseif(is_youtube_url($datos->intelligence->statu->status)) :  $datos->intelligence->statu->get_oembed()?>
            <a class="group iframe" href="<?php echo $datos->intelligence->statu->oembed->status ?>" rel="fancy-gallery-iframe">
                <img src="<?= $datos->intelligence->statu->oembed->thumbnail_url ?>" style="width: 80px; height: 80px; position: absolute" />
                <div class="mas" style=" margin-left: 37px; margin-top: 36px;"><img src="<?= front_asset('images/mas.png') ?>" /></div>
            </a>
          <?php elseif(!empty($datos->intelligence->users_photo_id)) : ?>
            <a class="group" href="<?php echo uploads_url($datos->intelligence->users_photo->image) ?>" rel="fancy-gallery">
              <img id="photo-<?= $datos->intelligence->id ?>" src="<?php echo uploads_url($datos->intelligence->users_photo->thumb) ?>" style="max-height: 163px; width: 270px;"/>
              <div id="mas-<?= $datos->intelligence->id ?>" class="mas" style="margin-left: 227px; position: absolute;"><img src="images/mas.png" /></div>
              <script>
                $(function(){
                  alto = $("#photo-<?= $datos->intelligence->id ?>").innerHeight();
                  $("#mas-<?= $datos->intelligence->id ?>").css("margin-top", alto - 44 + "px");
                });
              </script>
            </a>
          <?php elseif(!empty($datos->intelligence->users_show_id)) : ?>
             <?php $date = fecha_spanish($datos->intelligence->users_show->date); ?>
            <div class="show-fecha" style="padding: 15px 5px; width: 80px; height: 50px; margin-right: 0px;">
              <b><?php echo $date['dia_text_short'] ?></b></br><?php echo $date['dia'], ' ', $date['mes'] ?>
            </div>
          <?php else :?>
            <img  src="images/imagensino.png" width="80" />
          <?php endif; ?>
        </div>
        <?php endif; ?>
        <div class="subcontent_follower" style="float:left; margin-left: 10px; width: 77%;">
          <?php if(!empty($datos->intelligence->audicion_id)) : ?>
            <a href="<?php echo sprintf($urls->audicion_detalle, $datos->intelligence->audicion->id, $datos->intelligence->audicion->var) ?>">
              <span><?= $datos->intelligence->audicion->titulo ?></span>
            </a>
            <div class="clear"></div><br>
            <p style="font-style: italic; text-align: justify; height: 25px;">
              <?= strlen($datos->intelligence->audicion->descripcion) >= 140 ? substr($datos->intelligence->audicion->descripcion, 0, 140)."..." : $datos->intelligence->audicion->descripcion ?>
            </p>
          <?php elseif(!empty($datos->intelligence->audiciones_aplicacion_id)) : ?>
            <a href="<?php echo sprintf($urls->audicion_detalle, $datos->intelligence->audiciones_aplicacion->audicion->id, $datos->intelligence->audiciones_aplicacion->audicion->var) ?>">
              <span><?= $datos->intelligence->audiciones_aplicacion->audicion->titulo ?></span>
            </a>
            <div class="clear"></div><br>
            <p style="font-style: italic; text-align: justify; height: 25px;">
              <?= strlen($datos->intelligence->audiciones_aplicacion->audicion->descripcion) >= 140 ? substr($datos->intelligence->audiciones_aplicacion->audicion->descripcion, 0, 140)."..." : $datos->intelligence->audiciones_aplicacion->audicion->descripcion ?>
            </p>
          <?php elseif(!empty($datos->intelligence->band_id)) : ?>
            <a href="<?= site_url('perfil/pagina/'.$datos->intelligence->band->var) ?>">
              <span><?= $datos->intelligence->band->name ?></span>
            </a>
            <div class="clear"></div><br>
            <p style="font-style: italic; text-align: justify; height: 25px;">
              <?= strlen($datos->intelligence->band->page->bio) >= 140 ? substr($datos->intelligence->band->page->bio, 0, 140)."..." : $datos->intelligence->band->page->bio ?>
            </p>
          <?php elseif(!empty($datos->intelligence->clasificado_id)) : ?>
            <a href="<?= sprintf($urls->clasificado_detalle, $datos->intelligence->clasificado->id, $datos->intelligence->clasificado->var) ?>">
              <span><?= $datos->intelligence->clasificado->titulo ?></span>
            </a>
            <div class="clear"></div><br>
            <p style="font-style: italic; text-align: justify; height: 25px;">
              <?= strlen($datos->intelligence->clasificado->descripcion) >= 140 ? substr($datos->intelligence->clasificado->descripcion, 0, 140)."..." : $datos->intelligence->clasificado->descripcion ?>
            </p>
          <?php elseif(!empty($datos->intelligence->users_show_id)) : ?>
            <?php $date = fecha_spanish($datos->intelligence->users_show->date); ?>
              <span style="color: #666; font-style: normal;"><span style="margin-right: 35px;">Hora: </span><?= $date['hora'] ?></span><br>
              <span style="color: #666; font-style: normal;"><span style="margin-right: 5px;">Dirección: </span><?= $datos->intelligence->users_show->adress ?></span><br>
              <span style="color: #666; font-style: normal;"><?= $datos->intelligence->users_show->city ?></span>
          <?php elseif(!empty($datos->intelligence->statu_id)) : ?>
            <p style="font-style: italic; text-align: justify; height: 25px;">
            <?php if(is_youtube_url($datos->intelligence->statu->status)) :  $datos->intelligence->statu->get_oembed()?>
              <?= $datos->intelligence->statu->oembed->title ?>
            <?php else : ?>
              <?php 
                $patron = "/@_?[a-z0-9]+(_?)([a-z0-9]?)+/i";
                if(preg_match_all($patron, $datos->intelligence->statu->status, $coincidencias, PREG_OFFSET_CAPTURE)) {
                  foreach ($coincidencias[0] as $coincide) {
                    $words_search[] = $coincide[0];
                    $url_status = str_replace($coincide[0], "<a href='".site_url("perfil/".$usuario->get_by_username(trim($coincide[0], "@"))->inshaka_url)."' style='color: #e82e7c; font-style: normal;' >".$coincide[0]."</a>", $coincide[0]);
                    $mension[] = $url_status;
                  }
                  $status_replace = str_replace($words_search, $mension, $datos->intelligence->statu->status);
                }else{
                  $status_replace = $datos->intelligence->statu->status;
                }
              ?>

              <?= strlen($status_replace) >= 500 ? substr($status_replace, 0, 500)."..." : $status_replace ?>
            <?php endif; ?>
            </p>
          <?php endif; ?>
        </div>
      </div>
      <div class="clear"></div>
      <div class="btn-share-like-comment">
        <?php if(!empty($datos->intelligence->audicion_id)) : ?>
          <a class="btn-sociales" href="<?= sprintf($urls->audicion_detalle, $datos->intelligence->audicion->id, $datos->intelligence->audicion->var) ?>" >
            Aplicar
          </a>
        <?php elseif(!empty($datos->intelligence->audiciones_aplicacion_id)) : ?>
          <a class="btn-sociales" href="<?= sprintf($urls->audicion_detalle, $datos->intelligence->audiciones_aplicacion->audicion->id, $datos->intelligence->audiciones_aplicacion->audicion->var) ?>" >
            Aplicar
          </a>
        <?php elseif(!empty($datos->intelligence->clasificado_id)) : ?>
        <a class="btn-sociales" href="<?= sprintf($urls->clasificado_detalle, $datos->intelligence->clasificado->id, $datos->intelligence->clasificado->var) ?>" >
            Aplicar
          </a>
        <?php endif; ?>
        <div class="btn-sociales" onclick="comment_share('#share-<?= $datos->intelligence->id ?>', '#comment-<?= $datos->intelligence->id ?>');">
          Compartir
        </div>
        <div class="btn-sociales" onclick="comment_share('#comment-<?= $datos->intelligence->id ?>', '#share-<?= $datos->intelligence->id ?>');">
          Comentar
        </div>
        <?php $cant_comentarios = $intelligence_comments->get_by_intelligence_id($datos->intelligence->id); ?>
        <div style="float: right; margin-top: 8px; color: #E82E7C; font-weight: bold;">
          <?= $cant_comentarios->exists() ? 'Total comentarios: '.$cant_comentarios->result_count() : null  ?>
        </div>
      </div>
      <div class="clear"></div>
      <div id="comment-<?= $datos->intelligence->id ?>" style="display:none; padding: 10px; min-height: 40px;">
          <textarea name="comment-intelligence" id="comment-intelligence-<?= $datos->intelligence->id ?>" cols="20" rows="3" maxlength="145" style="font-family: 'Arial'; background:#E4E7E7; border-color: #C7C9CA; width: 100%;" placeholder="Deja aquí su comentario (máx. 140 caracteres)"></textarea>
          <input class="bot-aceptar" type="submit" onclick="save_comment(<?= $datos->intelligence->id ?>, '#comment-intelligence-<?= $datos->intelligence->id ?>', '#ajax-load-<?= $datos->intelligence->id ?>', '#comentarios-<?= $datos->intelligence->id ?>' );" value="Enviar">
          <script>
            $(function(){
              $("#comment-intelligence-<?= $datos->intelligence->id ?>").keypress(function(e){                
                if(e.which === 64){         
                  $(this).autocomplete({
                    source: "<?= site_url("home/get_users") ?>"
                  });
                }
              });
            });
          </script>
      </div>
      <div class="clear"></div>
      <div id="share-<?= $datos->intelligence->id ?>" style="display:none; padding: 20px;">
        <div class="share-social-network" style="float: left; width: 100px;"> 
          <fb:like href="<?= site_url('audiciones/audiciones/detalle/'.$datos->intelligence->audicion->id) ?>" send="false" layout="button_count" width="450" show_faces="false" colorscheme="light" action="like"></fb:like>
        </div>
        <div class="share-social-network" style="float: left; width: 100px;"> 
          <a href="https://twitter.com/share" class="twitter-share-button" data-via="inshaka" data-lang="es">Twittear</a>
        </div>
        <script>
          !function(d,s,id){
            var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';
            if(!d.getElementById(id)){
              js=d.createElement(s);
              js.id=id;
              js.src=p+'://platform.twitter.com/widgets.js';
              fjs.parentNode.insertBefore(js,fjs);
            }
          }(document, 'script', 'twitter-wjs');
        </script>
        <script type="text/javascript" src="https://apis.google.com/js/plusone.js"></script>
        <div class="share-social-network" style="float: left; margin-left: 20px; width: 100px;"> 
          <div class="g-plusone" data-size="medium" data-href="<?= site_url('audiciones/audiciones/detalle/'.$datos->intelligence->audicion->id) ?>"></div>
        </div>
      </div>
      <div class="clear"></div>
      <div class="comments-intelligence" id="comentarios-<?= $datos->intelligence->id ?>" data-load-url="<?= site_url('perfil/social/load_comments/'.$datos->intelligence->id) ?>">

      </div>
      <div class="ajax-load-comments" id="ajax-load-<?= $datos->intelligence->id ?>" style="display:none"></div>
    </div>
  </div>
</div>
<script type="text/javascript">
      
  $(function(){
    $(".comments-intelligence").each(function(){
      $(this).load($(this).attr('data-load-url'));
    });
  });

  function follow(id, status, elemento){
    $(elemento).dialog({
      resizable : false,
      modal     : true,
      show      : 'drop',
      hide      : 'drop',
      width     : '400px',
      buttons   : {
        "Aceptar" : function(){
          $.getJSON('<?= site_url("perfil/social/follow") ?>', {
            id : id,
            status : status
          }, function(){
            location.reload();
          });
          return $(this).dialog('close');
        },
        Cancel  : function(){
          $(this).dialog('close');
        }
      }
    });
  }

  function comment_share(abrir, cerrar){
    if($(cerrar).show){
      $(cerrar).slideUp("slow");
    }
    $(abrir).slideToggle("slow");
  }

  function save_comment(id, comentario, ajax, load){
    $(ajax).show();
    var datos = {
      id: id,
      comentario: $(comentario).val()
    };
    $.ajax({
      url: "<?= site_url('perfil/social/save_comment') ?>",
      type: "post",
      data: datos,
      success: function(){      
        $(load).load($(load).attr('data-load-url'));            
      },
      complete: function(){
        $(comentario).val('');
        $(ajax).hide();
      },
      error: function(){
        alert("Se ha producido un error. Inténtelo más tarde.");
      }
    });
  }

</script>