<style>
  .new_follower{
    width: 100%;
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
  .new_follower img{
    float: left;
  }
  .content_follower{
    float: left;
    width: 90%;
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
    width: 100%;
    border: 1px solid #E5E5E5;
    border-radius: 4px;
    -moz-border-radius: 4px;
    -webkit-border-radius: 4px;
    margin-top: 3px;
    padding: 5px;
    position: relative;
    overflow: hidden;
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
  .btn-sociales:hover{
    opacity: 0.85;
  }
  a.btn-sociales:hover{
    color: #FFF;
    text-decoration: none;
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
  .capa-comentarios{
    width: 582px !important;
  }
</style>
<script type="text/javascript">

  $(function(){
    $(".comments-intelligence").each(function(){
      $(this).load($(this).attr('data-load-url'));
    });

          /************************************************/

      function last_msg_funtion(){
        var datos = {
          id: $(".new_follower:last").attr("data-dni")
        };    
        $('div#last_msg_loader').html('<img src="<?= front_asset('images/load_notifications.gif') ?>">');
        $.ajax({
          type : "post",
          url: "<?= site_url('perfil/social/load_self_data/'.$is_inshaka_url) ?>",
          data: datos,
          beforeSend: function(){
            if(repetir === false){
              return false;
            }
          },
          success: function(datos){
            if (datos != "") {
              $(".new_follower:last").after(datos);
            }
            $('div#last_msg_loader').empty();
            repetir = true;
          },
          error : function(){
            alert("hubo un error con la aplicación");
          }
        });
        return false; 
      };
      var repetir = true;

      if(repetir === true){
        $(window).scroll(function(){
          if ($(window).scrollTop() >= ($('.new_follower:last').offset().top) ){                
            last_msg_funtion();
            repetir = false;
          }
        });
      }

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
<?php if($datos->exists()) : ?>
  <?php foreach ($datos as $dato) : ?>
    <div class="new_follower" data-dni="<?= $dato->id ?>">
      <?php $dato->user->users_photo->where(array('user_id' => $dato->user->id, 'profile_active' => true))->get(); ?>
      <div style="float:left">
        <?php if ($dato->user->users_photo->exists()) : ?>
          <img  src="<?= uploads_url($dato->user->users_photo->get_photo($dato->user->id)) ?>" width="40" />
        <?php else :?>
          <img  src="<?= front_asset('images/foto-perfil.png') ?>" width="40" />
        <?php endif; ?>
      </div>
      <div class="content_follower">
        <a href="<?= site_url('perfil/'.$dato->user->inshaka_url) ?>">
          <span><?= !$dato->user->is_proveedor ? $dato->user->first_name.' '.$dato->user->last_name : $dato->user->name_proveedor ?></span>
        </a>
        <?php if(!empty($dato->audicion_id)) : ?>
          Ha creado una nueva audición
        <?php elseif(!empty($dato->clasificado_id)) : ?>
          Ha creado un nuevo clasificado
        <?php elseif(!empty($dato->band_id)) : ?>
          Ha creado una nueva banda
        <?php elseif(!empty($dato->statu_id)) : ?>
          Ha cambiado su estado
        <?php elseif(!empty($dato->audiciones_aplicacion_id)) : ?>
          Ha aplicado a una audición
        <?php elseif(!empty($dato->users_show_id)) : ?>
          Te invita a un evento
        <?php elseif(!empty($dato->users_photo_id)) : ?>
          Ha subido una imágen a su album
        <?php elseif(!empty($dato->users_follow_id)) : ?>
          Tiene un nuevo fan
        <?php endif; ?>
        <span style="font-family: 'Arial'; font-style: italic; font-size: 0.85em; float: right;">
          <?= fecha_spanish_full_short($dato->update_on).' - '. get_hour($dato->update_on) ?>
        </span>
        <div class="clear"></div>
        <div class="follower_new">
          <div style="float:left">
            <?php if(!empty($dato->audicion_id)) : ?>
              <?php if (!empty($dato->audicion->imagen)) : ?>
                <img  src="<?= uploads_url($dato->audicion->imagen) ?>" style="width: 40px; height: 40px;" />
              <?php else :?>
                <img  src="<?= front_asset('images/imagensino.png') ?>" width="40" />
              <?php endif; ?>
            <?php elseif(!empty($dato->users_follow_id)) : ?>
              <?php if ($dato->users_follow->user->users_photo->exists()) : ?>
                <img  src="<?= uploads_url($dato->users_follow->user->users_photo->get_photo($dato->users_follow->user->id)) ?>" width="40" />
              <?php else :?>
                <img  src="<?= front_asset('images/foto-perfil.png') ?>" width="40" />
              <?php endif; ?>
            <?php elseif(!empty($dato->clasificado_id)) : ?>
              <?php if (!empty($dato->clasificado->imagen)) : ?>
                <img  src="<?= uploads_url($dato->clasificado->imagen) ?>" style="width: 40px; height: 40px;" />
              <?php else :?>
                <img  src="<?= front_asset('images/imagensino.png') ?>" width="40" />
              <?php endif; ?>
            <?php elseif(!empty($dato->audiciones_aplicacion_id)) : ?>
              <?php if (!empty($dato->audiciones_aplicacion->audicion->imagen)) : ?>
                <img  src="<?= uploads_url($dato->audiciones_aplicacion->audicion->imagen) ?>" style="width: 40px; height: 40px;" />
              <?php else :?>
                <img  src="<?= front_asset('images/imagensino.png') ?>" width="40" />
              <?php endif; ?>
            <?php elseif(!empty($dato->band_id)) : ?>
              <?php $profile_band = $dato->band->page->pages_photo->where('profile_active', true)->get() ?>
              <?php if($profile_band->exists()) : ?>
                <img  src="<?= uploads_url($profile_band->thumb) ?>" style="width: 40px; height: 40px;" />
              <?php else :?>
                <img  src="<?= front_asset('images/imagensino.png') ?>" width="40" />
              <?php endif; ?>
            <?php elseif(!empty($dato->users_show_id)) : ?>
                <?php $date = fecha_spanish($dato->users_show->date); ?>
                <div class="show-fecha" style="padding: 5px; width: 50px; height: 52px;">
                  <b style="font-size: 23px;"><?php echo $date['dia_text_short'] ?></b></br><span style="font-size: 1em; color: #FFF;"><?php echo $date['dia'], ' ', $date['mes'] ?></span>
                </div>
            <?php elseif(!empty($dato->users_photo_id)) : ?>
              <a class="group" href="<?php echo uploads_url($dato->users_photo->image) ?>" rel="fancy-gallery">
                <img id="photo-<?= $dato->id ?>" src="<?php echo uploads_url($dato->users_photo->thumb) ?>" style="max-height: 204px; max-width: 270px;"/>
                <div id="mas-<?= $dato->id ?>" class="mas" style="position: absolute;"><img src="images/mas.png" /></div>
                <script>
                  $(function(){
                    alto = $("#photo-<?= $dato->id ?>").innerHeight();
                    ancho = $("#photo-<?= $dato->id ?>").innerWidth();
                    $("#mas-<?= $dato->id ?>").css({
                      "margin-top" : alto - 44 + "px",
                      "margin-left": ancho -43 + "px"
                    });
                  });
                </script>
              </a>
            <?php elseif(!empty($dato->statu_id)) : ?>
                <?php if(is_youtube_url($dato->statu->status)) :  $dato->statu->get_oembed()?>
                <a class="group iframe" href="<?php echo $dato->statu->oembed->status ?>" rel="fancy-gallery-iframe">
                    <img src="<?= $dato->statu->oembed->thumbnail_url ?>" style="width: 40px; height: 40px; position: absolute" />
                    <div class="mas" style=" margin-left: 37px; margin-top: 36px;"><img src="<?= front_asset('images/mas.png') ?>" /></div>
                </a>
                <?php endif; ?>
          <?php endif; ?>
          </div>
          <div class="subcontent_follower" style="float:left; margin-left: 10px; width: 72%; <?= !empty($dato->users_photo_id) ? "display:none" : null ?>">
            <?php if(!empty($dato->audicion_id)) : ?>
              <a href="<?php echo sprintf($urls->audicion_detalle, $dato->audicion->id, $dato->audicion->var) ?>">
                <span><?= $dato->audicion->titulo ?></span>
              </a>
            <?php elseif(!empty($dato->users_follow_id)) : ?>
              <a href="<?= site_url('perfil/'.$dato->users_follow->user->inshaka_url) ?>">
                <span><?= $dato->users_follow->user->first_name." ".$dato->users_follow->user->last_name ?></span>
              </a>
            <?php elseif(!empty($dato->clasificado_id)) : ?>
              <a href="<?php echo sprintf($urls->clasificado_detalle, $dato->clasificado->id, $dato->clasificado->var) ?>">
                <span><?= $dato->clasificado->titulo ?></span>
              </a>
            <?php elseif(!empty($dato->audiciones_aplicacion_id)) : ?>
              <a href="<?php echo sprintf($urls->audicion_detalle, $dato->audiciones_aplicacion->audicion->id, $dato->audiciones_aplicacion->audicion->var) ?>">
                <span><?= $dato->audiciones_aplicacion->audicion->titulo ?></span>
              </a>
            <?php elseif(!empty($dato->band_id)) : ?>
              <a href="<?php echo site_url('perfil/pagina/'.$dato->band->var) ?>">
                <span><?= $dato->band->name ?></span>
              </a>
            <?php elseif(!empty($dato->users_show_id)) : ?>
              <span><?= $dato->users_show->place ?></span>
            <?php endif; ?>
            <div class="clear"></div>
            <p style="font-style: italic; text-align: justify; height: 25px;">
              <?php if(!empty($dato->audicion_id)) : ?>
                <?= strlen($dato->audicion->descripcion) >= 140 ? substr($dato->audicion->descripcion, 0, 140)."..." : $dato->audicion->descripcion ?>
              <?php elseif(!empty($dato->users_follow_id)) : ?>
                <p style="font-style: italic; text-align: justify; height: 25px;">
                  <?= strlen($dato->users_follow->user->bio) >= 140 ? substr($dato->users_follow->user->bio, 0, 140)."..." : $dato->users_follow->user->bio ?>
                </p>
              <?php elseif(!empty($dato->clasificado_id)) : ?>
                <?= strlen($dato->clasificado->descripcion) >= 140 ? substr($dato->clasificado->descripcion, 0, 140)."..." : $dato->clasificado->descripcion ?>
              <?php elseif(!empty($dato->audiciones_aplicacion_id)) : ?>
                <?= strlen($dato->audiciones_aplicacion->audicion->descripcion) >= 140 ? substr($dato->audiciones_aplicacion->audicion->descripcion, 0, 140)."..." : $dato->audiciones_aplicacion->audicion->descripcion ?>
              <?php elseif(!empty($dato->band_id)) : ?>
                <?= strlen($dato->band->page->bio) >= 140 ? substr($dato->band->page->bio, 0, 140)."..." : $dato->band->page->bio ?>
              <?php elseif(!empty($dato->statu_id)) : ?>
                <?php if(is_youtube_url($dato->statu->status)) :  $dato->statu->get_oembed()?>
                  <?= $dato->statu->oembed->title ?>
                <?php else : ?>
                  <?php 
                    $patron = "/@_?[a-z0-9]+(_?)([a-z0-9]?)+/i";
                    if(preg_match_all($patron, $dato->statu->status, $coincidencias, PREG_OFFSET_CAPTURE)) {
                      foreach ($coincidencias[0] as $coincide) {
                        $words_search[] = $coincide[0];
                        $url_status = str_replace($coincide[0], "<a href='".site_url("perfil/".$dato->user->get_by_username(trim($coincide[0], "@"))->inshaka_url)."' style='color: #e82e7c; font-style: normal;' >".$coincide[0]."</a>", $coincide[0]);
                        $mension[] = $url_status;
                      }
                      $status_replace = str_replace($words_search, $mension, $dato->statu->status);
                    }else{
                      $status_replace = $dato->statu->status;
                    }
                  ?>

                  <?= strlen($status_replace) >= 900 ? substr($status_replace, 0, 900)."..." : $status_replace ?>
                <?php endif; ?>
              <?php elseif(!empty($dato->users_show_id)) : ?>
              <?php $date = fecha_spanish($dato->users_show->date); ?>
                <span style="color: #666; font-style: normal; font-size: 1em;"><span style="margin-right: 35px;">Hora: </span><?= $date['hora'] ?></span><br>
                <span style="color: #666; font-style: normal; font-size: 1em;"><span style="margin-right: 5px;">Dirección: </span><?= $dato->users_show->adress ?></span><br>
                <span style="color: #666; font-style: normal; font-size: 1em;"><?= $dato->users_show->city ?></span>
              <?php endif; ?>
            </p>
          </div>
        </div>
        <div class="clear"></div>
        <?php if($is_usuario) : ?>
        <div class="btn-share-like-comment">
          <?php if(!empty($dato->audicion_id)) : ?>
            <a class="btn-sociales" href="<?= sprintf($urls->audicion_detalle, $dato->audicion->id, $dato->audicion->var) ?>" >
              Aplicar
            </a>
          <?php elseif(!empty($dato->clasificado_id)) : ?>
          <a class="btn-sociales" href="<?= sprintf($urls->clasificado_detalle, $dato->clasificado->id, $dato->clasificado->var) ?>" >
              Aplicar
            </a>
          <?php elseif(!empty($dato->audiciones_aplicacion_id)) : ?>
            <a class="btn-sociales" href="<?= sprintf($urls->audicion_detalle, $dato->audiciones_aplicacion->audicion->id, $dato->audiciones_aplicacion->audicion->var) ?>" >
              Aplicar
            </a>
          <?php endif; ?>
          <div class="btn-sociales" onclick="comment_share('#share-<?= $dato->id ?>', '#comment-<?= $dato->id ?>');">
            Compartir
          </div>
          <div class="btn-sociales" onclick="comment_share('#comment-<?= $dato->id ?>', '#share-<?= $dato->id ?>');">
            Comentar
          </div>
          <?php $cant_comentarios = $datos->intelligence_comments; ?>
          <div style="float: right; margin-top: 8px; color: #E82E7C; font-weight: bold;">
            <?= $cant_comentarios ? 'Total comentarios: '.$cant_comentarios->result_count() : null  ?>
          </div>
        </div>
        <?php endif; ?>
        <div class="clear"></div>
        <div id="comment-<?= $dato->id ?>" style="display:none; padding: 10px; min-height: 40px;">
          <textarea name="comment-intelligence" id="comment-intelligence-<?= $dato->id ?>" cols="20" rows="3" maxlength="145" style="font-family: 'Arial'; background:#E4E7E7; border-color: #C7C9CA; width: 100%;" placeholder="Deja aquí su comentario (máx. 140 caracteres)"></textarea>
          <input class="bot-aceptar" type="submit" onclick="save_comment(<?= $dato->id ?>, '#comment-intelligence-<?= $dato->id ?>', '#ajax-load-<?= $dato->id ?>', '#comentarios-<?= $dato->id ?>' );" value="Enviar">
          <script>
            $(function(){
              $("#comment-intelligence-<?= $dato->id ?>").keypress(function(e){                
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
        <div id="share-<?= $dato->id ?>" style="display:none; padding: 20px;">
        <?php 
          if(!empty($dato->audicion_id)) {
            $url = sprintf($urls->audicion_detalle, $dato->audicion->id, $dato->audicion->var);
            $text = $dato->audicion->titulo;
          }elseif(!empty ($dato->clasificado_id)){
            $url = sprintf($urls->clasificado_detalle, $dato->clasificado->id, $dato->clasificado->var);
            $text = $dato->clasificado->titulo;
          }elseif(!empty ($dato->band_id)){
            $url = site_url('perfil/pagina/'.$dato->band->var);
            $text = "Una nueva banda con el power InShaka se ha creado recientemente. Éxitos para esta banda ";
          }elseif(!empty ($dato->audiciones_aplicacion_id)){
            $url = sprintf($urls->audicion_detalle, $dato->audiciones_aplicacion->audicion->id, $dato->audiciones_aplicacion->audicion->var);
            $text = "Estamos aplicando a esta audición ".$dato->audiciones_aplicacion->audicion->titulo." en Inshaka.com";
          }elseif(!empty ($dato->users_show_id)){
            $url = sprintf($urls->inshaka_url, $dato->users_show->user->inshaka_url);
            $date = fecha_spanish($dato->users_show->date);
            $text = "Nuevo show en ".$dato->users_show->place." el ".$date['dia']." de ".$date['mes']. " a las ".$date['hora'];
          }elseif(!empty ($dato->users_song_id)){
            $url = sprintf($urls->inshaka_url, $dato->users_song->user->inshaka_url);
            $text = "Un nuevo single con el power InShaka ".$dato->users_song->url ;
          }elseif(!empty ($dato->users_photo_id)){
            $url = sprintf($urls->inshaka_url, $dato->users_photo->user->inshaka_url);
          }elseif(!empty ($dato->users_video_id)){
            $url = sprintf($urls->inshaka_url, $dato->users_video->user->inshaka_url);
          }elseif(!empty ($dato->statu_id)){
            $url = sprintf($urls->inshaka_url, $dato->statu->user->inshaka_url);
            $text = $dato->statu->user->first_name." ".$dato->statu->user->last_name.' ha cambiado su estado en InShaka.com';
          }elseif(!empty ($dato->users_follow_id)){
            $url = sprintf($urls->inshaka_url, $dato->users_follow->user->inshaka_url);
            $text = $dato->users_follow->user->first_nam." ".$dato->users_follow->user->last_name." tiene un nuevo fan";
          }
        ?>
          <!-- Enlaces de compartir -->
          <!-- Facebook -->
          <div class="share-social-network" style="float: left; width: 100px;"> 
            <div class="fb-like" data-send="false" data-href="<?= $url ?>" data-layout="button_count" data-width="100" data-show-faces="false" data-action="like" ></div>
          </div>
          <!-- Twitter --> <!--
        <div class="share-social-network" style="float: left; width: 100px;"> 
          <a href="https://twitter.com/share" class="twitter-share-button" data-url="<?= $url ?>" data-text="<?= $text ?>" data-via="inshaka" data-lang="es" data-hashtags="TryInshaka">Twittear</a>
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
        </script> -->

          <!-- Google + -->
          <div class="share-social-network" style="float: left; margin-left: 20px; width: 100px;"> 
            <div class="g-plusone" data-size="medium" data-href="<?= $url ?>"></div>
          </div>
          <!-- Fin enlaces de compartir -->
        </div>
        <div class="clear"></div>
        <div class="comments-intelligence" style="width: 560px;" id="comentarios-<?= $dato->id ?>" data-load-url="<?= site_url('perfil/social/load_comments/'.$dato->id) ?>">
        </div>
        <div class="ajax-load-comments" id="ajax-load-<?= $dato->id ?>" style="display:none"></div>
      </div>
    </div>
  <?php endforeach; ?>
  
<?php endif; ?>