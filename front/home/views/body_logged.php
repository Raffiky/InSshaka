<script type="text/javascript" src="https://apis.google.com/js/plusone.js"></script>
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
<link href="<?= front_asset('css/dropzone.css') ?>" type="text/css" rel="stylesheet" />
<script src="<?= front_asset('js/dropzone.js') ?>"></script>
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
    width: 90%;
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
  .btn-sociales:hover{
    opacity: 0.85;
  }
  a.btn-sociales:hover{
    color: #FFF;
    text-decoration: none;
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
  .pregunta{
        color: #505050;
        font-family: 'BebasNeueRegular';
        font-size: 20px;
        margin-bottom: 20px;
        margin-top: 20px;
        text-align: center;
    }
  .btn-adicionales{
    background-color: #E9E9E9;
    height: 19px;
    border-bottom: 1px solid #FFF;
    border-left: 1px solid #FFF;
    border-right: 1px solid #FFF;
    border-top: 1px solid #DBDBDB;
    padding: 5px 10px;
  }
</style>
<div class="bgEncabezado">
    <div class="conEncabezado">
        <div id="txEncabezado" style="padding: 16px 0;">
            <span class="pEncabezado">Inshaka Music: <span class="pEncabezadoN">Amplifica tu Sonido</span></span>
        </div>
    </div>
</div>
<div class="contenido">
  
  <!-- Campo de status -->
  <div class="regis-tit" style="text-align: center;">Actualizar estado</div>
  <div class="usuario-subtit close-form" style="position:relative; background-color: #EEE; border-top: 1px solid #FFF; border-left: 1px solid #FFF; border-right: 1px solid #FFF; padding: 7px;">
    <div class="edit-profile-status" data-profile-status="inline"></div>
    <span id="profile-status" style="text-align: center; min-height: 33px;">
      <?php if (!empty($userinfo->status)) : ?>
        <?php echo $userinfo->status ?>
      <?php else: ?>
          Escribe tu “status” aca.
      <?php endif; ?>
    </span>
    <?php echo form_open('perfil/ajax/update_status', 'id="profile-status-form" style="display:none;"') ?> 
    <div>
      <?php echo form_textarea(array('name' => 'status', 'required' => 'required', 'maxlength' => 500, 'id' => 'status')) ?>
      <div class="clr"></div>
      <input class="btn-primary bot-logout" type="submit" value="Publicar" style="font-size: 0.6em; border: 0px; float: none; padding: .3em 1em;" />
      <div class="cancel bot-logout" style="display: inline-block; height: 17px; font-size: 0.6em; margin-left: 20px; cursor:pointer; float: none" >Cancelar</div>
    </div>
    <?php echo form_close() ?>
      <!-- Drag and Drop para imágenes-->
      <form action="<?= site_url("perfil/ajax/do_upload") ?>" class="dropzone" id="form" style="display: none;"></form>
      
      <!-- Formulario de shows -->
      <div class="campos-show" style="display:none;">
        <form id="add-shows-form">

          <div class="messages" style="display:none;"></div>

          <div class="calendar">
            <div class="calendar-tit">Fecha próximo evento</div>
            <input name="date" type="text" id="basic_example_1" class="date-picker campo" placeholder="Fecha y hora del show">
          </div>

          <div class="selectBox"  id="select-largo2">

            <input name="place" id="place" type="text" class="campo" placeholder="Lugar del show"  />
          </div>
          <div class="selectBox"  id="select-largo2">

            <input name="adress" type="text" id="adress" class="campo" placeholder="Dirección del show"  />
          </div>

          <div class="selectBox" id="select-largo2">
            <div class="ui-widget">
              <input name="city-add" type="text" id="city-add" class="campo" placeholder="Ciudad"/>
            </div>
          </div>
          <div class="clear"></div>
          <div id="btn-show" class="bot-aceptar" style="cursor: pointer; width: 78px; height: 22px; padding-top: 4px; float: right; margin-top: -30px; margin-right: 242px;">Publicar</div>
        </form><!-- // Formulario para agregar shows -->
      </div>
    <script>
      var form_status = $('#profile-status-form'),
         status_inline = '[data-profile-status="inline"]',
         profile_status = $('#profile-status'),
         parent = $('.usuario-subtit');

      $(document).on('click', status_inline, function(){

        var actual_status = profile_status.text();

        profile_status.hide();
        form_status.find('textarea').val(actual_status).end().show();

        parent.removeClass('close-form');

      });

      $('.cancel', form_status).on('click', hide_form);

      $(form_status).on('submit', function(){
        var $this = $(this),
           status_inline_text = $(status_inline).html();

        $.ajax({
          url : $this.attr('action'),
          dataType : 'json',
          type : $this.attr('method'),
          data : $this.serialize(),

          beforeSend : function(){
            $(status_inline).html('Cargando...').show();
          },

          success : function(json){
            if(json.ok === true){
              profile_status.text($this.find('textarea').val());
              hide_form();
            }
          },

          complete : function(){
            $(status_inline).html(status_inline_text).removeAttr('style');
          }
        });

        return false;
      });

      function hide_form(){
        profile_status.show();
        form_status.hide();
        parent.addClass('close-form');
      }
      
      function attach(elemento, elemento2, elemento3){
        $(elemento).slideToggle("slow");
        if($(elemento2).show())
          $(elemento2 + ", " + elemento3).hide();
      }

    </script>
  </div>
  <div class="btn-adicionales">
    <div class="btn-adjuntar help-add" id="add-image" title="Click aquí para compartir imágenes" onclick="attach('#form', '.campos-show', '.campos-show')"></div>
    <div class="btn-adjuntar help-add" id="add-show" title="Click aquí para compartir tus eventos" onclick="attach('.campos-show', '#form', '#form')"></div>
    <div class="btn-adjuntar help-add" id="add-user" title="Click aquí para mencionar un amigo en tu post" onclick="attach('.campos-show', '#form', '#form')"></div>
  </div>
  <!-- Fin campos status -->
  
  <nav>
    <ul>
      <li>
        <div class="nav-social my-btn-social-active" data-div="#bandas-social" >Mis Bandas</div>
      </li>
      <li>
        <div class="nav-social" data-div="#audiciones-social" >Audiciones</div>
      </li>
      <li>
        <div class="nav-social" data-div="#clasificados-social" >Clasificados</div>
      </li>
    </ul>
    <script type="text/javascript">
      $(function(){
        
        $("#status").keypress(function(e){                
          if(e.which === 64){         
            $(this).autocomplete({
              source: "<?= site_url("home/get_users") ?>"
            });
          }
        });
        
        $("#btn-show").on("click", function(){
          var datos = {
            date  : $("#basic_example_1").val(),
            place : $("#place").val(),
            adress: $("#adress").val(),
            city : $("#city-add").val()
          };

          $.ajax({
           type   : "get" ,
           url    : "<?= site_url("perfil/ajax/save_show_loader") ?>",
           data   : datos,
           success  : function(){
            $(".campos-show").delay(500).fadeOut("slow");
           },
           error    : function(){
            alert("Se ha producido un error. Inténtelo más tarde!");
           }
          });
        });
        function log(message) {
          $("<div>").text(message).prependTo("#log");
          $("#log").scrollTop(0);
        }
        $("#city-add").autocomplete({
          source: function(request, response) {
            $.ajax({
              url: "http://ws.geonames.org/searchJSON",
              dataType: "jsonp",
              data: {
                featureClass: "P",
                style: "full",
                maxRows: 12,
                name_startsWith: request.term
              },
              success: function(data) {
                response($.map(data.geonames, function(item) {
                  return {
                    label: item.name + (item.adminName1 ? ", " + item.adminName1 : "") + ", " + item.countryName,
                    value: item.name
                  };
                }));
              }
            });
          },
          minLength: 2,
          select: function(event, ui) {
            log(ui.item ?
              "Selected: " + ui.item.label :
              "Nothing selected, input was " + this.value);
          },
          open: function() {
            $(this).removeClass("ui-corner-all").addClass("ui-corner-top");
          },
          close: function() {
            $(this).removeClass("ui-corner-top").addClass("ui-corner-all");
          }
        });
        $('.help-add').tooltipster({
          theme: '.theme-help',
          arrow: true,
          arrowColor: '#FFF'
        });
        
        $(".nav-social").on("click", function(){            
            var ref1 = $(".my-btn-social-active").attr("data-div");
            $(ref1).slideUp("slow");            
            $(".my-btn-social-active").removeClass("my-btn-social-active");
            
            var ref2 = $(this).attr("data-div");
            $(ref2).slideDown("slow");
            $(this).addClass("my-btn-social-active");
            
            return false;
         });
         
        var sugerencias_list = $('#img-recomendaciones');
        sugerencias_list.load(sugerencias_list.data('load-url'));
        
        var div_recomendaciones = $("#div-recomendaciones");
        div_recomendaciones.load(div_recomendaciones.data('load-url'));
      });
    </script>
  </nav>
  <div class="clear"></div> 
  
  <!-- Blq de notificaciones -->
  <div class="social">
    
    <!-- Blq de sugerencias si aún no sigue a nadie -->
    <?php if((!$seguidos_por_mi->exists() || $seguidos_por_mi->result_count() < 5)) : ?>
    
    <div id="first-sugerencias" style="background-color: #eee; border: 1px solid #D5D5D5; border-radius: 7px; -moz-border-radius: 7px; -webkit-border-radius: 7px; padding: 10px; width: 95%; height: 530px;">
      <div class="regis-tit" style="color: #444">Mejora tu experiencia InShaka siguiendo otros usuarios</div>
      <div class='clr'></div>
      <div class="regis-tit" style="color: #E82E7C; font-size: 18px">
        Debes seguir al menos a 5 usuarios para poder continuar
      </div>
      <!-- Blq Recomendaciones -->
      <div id="div-recomendaciones" data-load-url="<?php echo site_url('home/home/random_sugerencias') ?>">
            Cargando...
      </div>
    </div>
    <?php endif; ?>
    
    <?php if($interacciones->exists()) : ?>    
    <?php foreach ($interacciones as $intelligence) : ?>    
          <!-- Blq nuevo fan -->
          <?php if(!empty($intelligence->users_follow_id)): ?>
            <div class="new_follower" data-dni="<?= $intelligence->id ?>">
              <?php $photo->where(array('user_id' => $intelligence->user->id, 'profile_active' => true))->get(); ?>
              <div style="float:left">
                <?php if ($photo->exists()) : ?>
                  <img  src="<?= uploads_url($photo->get_photo($intelligence->user->id)) ?>" width="80" />
                <?php else :?>
                  <img  src="<?= front_asset('images/foto-perfil.png') ?>" width="80" />
                <?php endif; ?>
              </div>
              <div class="content_follower">
                <a href="<?= site_url('perfil/'.$intelligence->user->inshaka_url) ?>">
                  <span><?= !$intelligence->user->is_proveedor ? $intelligence->user->first_name.' '.$intelligence->user->last_name : $intelligence->user->name_proveedor ?></span>
                </a> Tiene un nuevo fan <span style="font-family: 'Arial'; font-style: italic; font-size: 0.85em; float: right;"><?= fecha_spanish_full_short($intelligence->update_on).' - '. get_hour($intelligence->update_on) ?></span>
                <div class="follower_new">
                  <?php $photo->where(array('user_id' => $intelligence->users_follow->user->id, 'profile_active' => true))->get(); ?>
                  <div style="float:left">
                    <?php if ($photo->exists()) : ?>
                      <img  src="<?= uploads_url($photo->get_photo($intelligence->users_follow->user->id)) ?>" style="width: 80px; height: 80px;" />
                    <?php else :?>
                      <img  src="<?= front_asset('images/foto-perfil.png') ?>" width="80" />
                    <?php endif; ?>
                  </div>
                  <div class="subcontent_follower" style="float:left; margin-left: 10px; width: 77%;">
                    <a href="<?= site_url('perfil/'.$intelligence->users_follow->user->inshaka_url) ?>">
                      <span><?= $intelligence->users_follow->user->first_name." ".$intelligence->users_follow->user->last_name ?></span>
                    </a>
                    <div class="clr"></div><br>
                    <p style="font-style: italic; text-align: justify; height: 25px;">
                      <?= strlen($intelligence->users_follow->user->bio) >= 140 ? substr($intelligence->users_follow->user->bio, 0, 140)."..." : $intelligence->users_follow->user->bio ?>
                    </p>
                    <p>
                      <?php $clone_f->where(array('user_id' => $userinfo->id, 'user_follow_id' => $intelligence->users_follow->user->id ))->get(); ?>
                      <?php if(!$clone_f->exists()) : ?>
                        <div class="btn_follow_follower" style="<?= ($intelligence->users_follow->user->id == $userinfo->id) ? 'display:none' : null ?>" onclick="follow(<?= $intelligence->users_follow->user->id ?>, 'Follow', '#follow-him-her')">
                          Seguir
                        </div>
                      <?php else : ?>
                        <div class="btn_follow_follower" style="<?= ($intelligence->users_follow->user->id == $userinfo->id) ? 'display:none' : null ?>" onclick="follow(<?= $intelligence->users_follow->user->id ?>, 'Unfollow', '#unfollow-him-her')">
                          Dejar de seguir
                        </div>
                      <?php endif; ?>
                    </p>
                  </div>
                </div>
              </div>
            </div>
            <div class="clear"></div>
          <!-- Fin nuevo fan -->
          
          <!-- Blq nueva audición, clasificado, banda, status, show, aplicación a audición -->
          <?php else: ?>
            <div class="new_follower" id="label-comment-<?= $intelligence->id ?>" data-dni="<?= $intelligence->id ?>">
              <?php $photo->where(array('user_id' => $intelligence->user->id, 'profile_active' => true))->get(); ?>
              <div style="float:left">
                <?php if ($photo->exists()) : ?>
                  <img  src="<?= uploads_url($photo->get_photo($intelligence->user->id)) ?>" width="80" />
                <?php else :?>
                  <img  src="<?= front_asset('images/foto-perfil.png') ?>" width="80" />
                <?php endif; ?>
              </div>
              <div class="content_follower">
                <a href="<?= site_url('perfil/'.$intelligence->user->inshaka_url) ?>">
                  <span><?= !$intelligence->user->is_proveedor ? $intelligence->user->first_name.' '.$intelligence->user->last_name : $intelligence->user->name_proveedor ?></span>
                </a>
                <?php if(!empty($intelligence->audicion_id)) : ?>
                  Ha creado una nueva audición
                <?php elseif(!empty($intelligence->clasificado_id)) : ?>
                  Ha creado un nuevo clasificado
                <?php elseif(!empty($intelligence->band_id)) : ?>
                  Ha creado una nueva banda
                <?php elseif(!empty($intelligence->statu_id)) : ?>
                  Ha cambiado su estado
                <?php elseif(!empty($intelligence->audiciones_aplicacion_id)) : ?>
                  Ha aplicado a una audición
                <?php elseif(!empty($intelligence->users_show_id)) : ?>
                  Te invita a un evento
                <?php elseif(!empty($intelligence->users_photo_id)) : ?>
                  Ha subido una imágen a su album
                <?php endif; ?>
                <span style="font-family: 'Arial'; font-style: italic; font-size: 0.85em; float: right;">
                  <?= fecha_spanish_full_short($intelligence->update_on).' - '. get_hour($intelligence->update_on) ?>
                </span>
                <div class="clear"></div>
                <div class="follower_new">
                  <div style="float:left">
                    <?php if(!empty($intelligence->audicion_id)) : ?>
                      <?php if (!empty($intelligence->audicion->imagen)) : ?>
                        <img  src="<?= uploads_url($intelligence->audicion->imagen) ?>" style="width: 80px; height: 80px;" />
                      <?php else :?>
                        <img  src="<?= front_asset('images/imagensino.png') ?>" width="80" />
                      <?php endif; ?>
                    <?php elseif(!empty($intelligence->clasificado_id)) : ?>
                      <?php if (!empty($intelligence->clasificado->imagen)) : ?>
                        <img  src="<?= uploads_url($intelligence->clasificado->imagen) ?>" style="width: 80px; height: 80px;" />
                      <?php else :?>
                        <img  src="<?= front_asset('images/imagensino.png') ?>" width="80" />
                      <?php endif; ?>
                    <?php elseif(!empty($intelligence->audiciones_aplicacion_id)) : ?>
                      <?php if (!empty($intelligence->audiciones_aplicacion->audicion->imagen)) : ?>
                        <img  src="<?= uploads_url($intelligence->audiciones_aplicacion->audicion->imagen) ?>" style="width: 80px; height: 80px;" />
                      <?php else :?>
                        <img  src="<?= front_asset('images/imagensino.png') ?>" width="80" />
                      <?php endif; ?>
                    <?php elseif(!empty($intelligence->band_id)) : ?>
                      <?php $profile_band = $intelligence->band->page->pages_photo->where('profile_active', true)->get() ?>
                      <?php if($profile_band->exists()) : ?>
                        <img  src="<?= uploads_url($profile_band->thumb) ?>" style="width: 80px; height: 80px;" />
                      <?php else :?>
                        <img  src="<?= front_asset('images/imagensino.png') ?>" width="80" />
                      <?php endif; ?>
                    <?php elseif(!empty($intelligence->users_show_id)) : ?>
                        <?php $date = fecha_spanish($intelligence->users_show->date); ?>
                        <div class="show-fecha" style="padding: 15px 5px; width: 80px; height: 50px;">
                          <b><?php echo $date['dia_text_short'] ?></b></br><?php echo $date['dia'], ' ', $date['mes'] ?>
                        </div>
                    <?php elseif(!empty($intelligence->users_photo_id)) : ?>
                      <a class="group" href="<?php echo uploads_url($intelligence->users_photo->image) ?>" rel="fancy-gallery">
                        <img id="photo-<?= $intelligence->id ?>" src="<?php echo uploads_url($intelligence->users_photo->thumb) ?>" style="max-height: 163px; width: 270px;"/>
                        <div id="mas-<?= $intelligence->id ?>" class="mas" style="margin-left: 227px; position: absolute;"><img src="images/mas.png" /></div>
                        <script>
                          $(function(){
                            alto = $("#photo-<?= $intelligence->id ?>").innerHeight();
                            $("#mas-<?= $intelligence->id ?>").css("margin-top", alto - 44 + "px");
                          });
                        </script>
                      </a>
                    <?php elseif(!empty($intelligence->statu_id)) : ?>
                        <?php if(is_youtube_url($intelligence->statu->status)) :  $intelligence->statu->get_oembed()?>
                        <a class="group iframe" href="<?php echo $intelligence->statu->oembed->status ?>" rel="fancy-gallery-iframe">
                            <img src="<?= $intelligence->statu->oembed->thumbnail_url ?>" style="width: 80px; height: 80px; position: absolute" />
                            <div class="mas" style=" margin-left: 37px; margin-top: 36px;"><img src="<?= front_asset('images/mas.png') ?>" /></div>
                        </a>
                        <?php endif; ?>
                  <?php endif; ?>
                  </div>
                  <div class="subcontent_follower" style="float:left; margin-left: 10px; width: 72%; <?= !empty($intelligence->users_photo_id) ? "display:none" : null ?>">
                    <?php if(!empty($intelligence->audicion_id)) : ?>
                      <a href="<?php echo sprintf($urls->audicion_detalle, $intelligence->audicion->id, $intelligence->audicion->var) ?>">
                        <span><?= $intelligence->audicion->titulo ?></span>
                      </a>
                    <?php elseif(!empty($intelligence->clasificado_id)) : ?>
                      <a href="<?php echo sprintf($urls->clasificado_detalle, $intelligence->clasificado->id, $intelligence->clasificado->var) ?>">
                        <span><?= $intelligence->clasificado->titulo ?></span>
                      </a>
                    <?php elseif(!empty($intelligence->audiciones_aplicacion_id)) : ?>
                      <a href="<?php echo sprintf($urls->audicion_detalle, $intelligence->audiciones_aplicacion->audicion->id, $intelligence->audiciones_aplicacion->audicion->var) ?>">
                        <span><?= $intelligence->audiciones_aplicacion->audicion->titulo ?></span>
                      </a>
                    <?php elseif(!empty($intelligence->band_id)) : ?>
                      <a href="<?php echo site_url('perfil/pagina/'.$intelligence->band->var) ?>">
                        <span><?= $intelligence->band->name ?></span>
                      </a>
                    <?php elseif(!empty($intelligence->users_show_id)) : ?>
                      <span><?= $intelligence->users_show->place ?></span>
                    <?php endif; ?>
                    <div class="clear"></div><br>
                    <p style="font-style: italic; text-align: justify; height: 25px;">
                      <?php if(!empty($intelligence->audicion_id)) : ?>
                        <?= strlen($intelligence->audicion->descripcion) >= 140 ? substr($intelligence->audicion->descripcion, 0, 140)."..." : $intelligence->audicion->descripcion ?>
                      <?php elseif(!empty($intelligence->clasificado_id)) : ?>
                        <?= strlen($intelligence->clasificado->descripcion) >= 140 ? substr($intelligence->clasificado->descripcion, 0, 140)."..." : $intelligence->clasificado->descripcion ?>
                      <?php elseif(!empty($intelligence->audiciones_aplicacion_id)) : ?>
                        <?= strlen($intelligence->audiciones_aplicacion->audicion->descripcion) >= 140 ? substr($intelligence->audiciones_aplicacion->audicion->descripcion, 0, 140)."..." : $intelligence->audiciones_aplicacion->audicion->descripcion ?>
                      <?php elseif(!empty($intelligence->band_id)) : ?>
                        <?= strlen($intelligence->band->page->bio) >= 140 ? substr($intelligence->band->page->bio, 0, 140)."..." : $intelligence->band->page->bio ?>
                      <?php elseif(!empty($intelligence->statu_id)) : ?>
                        <?php if(is_youtube_url($intelligence->statu->status)) :  $intelligence->statu->get_oembed()?>
                          <?= $intelligence->statu->oembed->title ?>
                        <?php else : ?>
                          <?php 
                            $patron = "/@_?[a-z0-9]+(_?)([a-z0-9]?)+/i";
                            if(preg_match_all($patron, $intelligence->statu->status, $coincidencias, PREG_OFFSET_CAPTURE)) {
                              foreach ($coincidencias[0] as $coincide) {
                                $words_search[] = $coincide[0];
                                $url_status = str_replace($coincide[0], "<a href='".site_url("perfil/".$usuario->get_by_username(trim($coincide[0], "@"))->inshaka_url)."' style='color: #e82e7c; font-style: normal;' >".$coincide[0]."</a>", $coincide[0]);
                                $mension[] = $url_status;
                              }
                              $status_replace = str_replace($words_search, $mension, $intelligence->statu->status);
                            }else{
                              $status_replace = $intelligence->statu->status;
                            }
                          ?>
                      
                          <?= strlen($status_replace) >= 900 ? substr($status_replace, 0, 900)."..." : $status_replace ?>
                        <?php endif; ?>
                      <?php elseif(!empty($intelligence->users_show_id)) : ?>
                      <?php $date = fecha_spanish($intelligence->users_show->date); ?>
                        <span style="color: #666; font-style: normal;"><span style="margin-right: 35px;">Hora: </span><?= $date['hora'] ?></span><br>
                        <span style="color: #666; font-style: normal;"><span style="margin-right: 5px;">Dirección: </span><?= $intelligence->users_show->adress ?></span><br>
                        <span style="color: #666; font-style: normal;"><?= $intelligence->users_show->city ?></span>
                      <?php endif; ?>
                    </p>
                  </div>
                </div>
                <div class="clear"></div>
                <div class="btn-share-like-comment">
                  <?php if(!empty($intelligence->audicion_id)) : ?>
                    <a class="btn-sociales" href="<?= sprintf($urls->audicion_detalle, $intelligence->audicion->id, $intelligence->audicion->var) ?>" >
                      Aplicar
                    </a>
                  <?php elseif(!empty($intelligence->clasificado_id)) : ?>
                  <a class="btn-sociales" href="<?= sprintf($urls->clasificado_detalle, $intelligence->clasificado->id, $intelligence->clasificado->var) ?>" >
                      Aplicar
                    </a>
                  <?php elseif(!empty($intelligence->audiciones_aplicacion_id)) : ?>
                    <a class="btn-sociales" href="<?= sprintf($urls->audicion_detalle, $intelligence->audiciones_aplicacion->audicion->id, $intelligence->audiciones_aplicacion->audicion->var) ?>" >
                      Aplicar
                    </a>
                  <?php endif; ?>
                  <div class="btn-sociales" onclick="comment_share('#share-<?= $intelligence->id ?>', '#comment-<?= $intelligence->id ?>');">
                    Compartir
                  </div>
                  <div class="btn-sociales" onclick="comment_share('#comment-<?= $intelligence->id ?>', '#share-<?= $intelligence->id ?>');">
                    Comentar
                  </div>
                  <?php $cant_comentarios = $intelligence_comments->get_by_intelligence_id($intelligence->id); ?>
                  <div style="float: right; margin-top: 8px; color: #E82E7C; font-weight: bold;">
                    <?= $cant_comentarios->exists() ? 'Total comentarios: '.$cant_comentarios->result_count() : null  ?>
                  </div>
                </div>
                <div class="clear"></div>
                <div id="comment-<?= $intelligence->id ?>" style="display:none; padding: 10px; min-height: 40px;">
                    <textarea name="comment-intelligence" id="comment-intelligence-<?= $intelligence->id ?>" cols="20" rows="3" maxlength="145" style="font-family: 'Arial'; background:#E4E7E7; border-color: #C7C9CA; width: 100%;" placeholder="Deja aquí su comentario (máx. 140 caracteres)"></textarea>
                    <input class="bot-aceptar" type="submit" onclick="save_comment(<?= $intelligence->id ?>, '#comment-intelligence-<?= $intelligence->id ?>', '#ajax-load-<?= $intelligence->id ?>', '#comentarios-<?= $intelligence->id ?>' );" value="Enviar">
                    <script>
                      $(function(){
                        $("#comment-intelligence-<?= $intelligence->id ?>").keypress(function(e){                
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
                <div id="share-<?= $intelligence->id ?>" style="display:none; padding: 20px;">
                <?php 
                  if(!empty($intelligence->audicion_id)) {
                    $url = sprintf($urls->audicion_detalle, $intelligence->audicion->id, $intelligence->audicion->var);
                    $text = $intelligence->audicion->titulo;
                  }elseif(!empty ($intelligence->clasificado_id)){
                    $url = sprintf($urls->clasificado_detalle, $intelligence->clasificado->id, $intelligence->clasificado->var);
                    $text = $intelligence->clasificado->titulo;
                  }elseif(!empty ($intelligence->band_id)){
                    $url = site_url('perfil/pagina/'.$intelligence->band->var);
                    $text = "Una nueva banda con el power InShaka se ha creado recientemente. Éxitos para esta banda ";
                  }elseif(!empty ($intelligence->audiciones_aplicacion_id)){
                    $url = sprintf($urls->audicion_detalle, $intelligence->audiciones_aplicacion->audicion->id, $intelligence->audiciones_aplicacion->audicion->var);
                    $text = "Estamos aplicando a esta audición ".$intelligence->audiciones_aplicacion->audicion->titulo." en Inshaka.com";
                  }elseif(!empty ($intelligence->users_show_id)){
                    $url = sprintf($urls->inshaka_url, $intelligence->users_show->user->inshaka_url);
                    $date = fecha_spanish($intelligence->users_show->date);
                    $text = "Nuevo show en ".$intelligence->users_show->place." el ".$date['dia']." de ".$date['mes']. " a las ".$date['hora'];
                  }elseif(!empty ($intelligence->users_song_id)){
                    $url = sprintf($urls->inshaka_url, $intelligence->users_song->user->inshaka_url);
                    $text = "Un nuevo single con el power InShaka ".$intelligence->users_song->url ;
                  }elseif(!empty ($intelligence->users_photo_id)){
                    $url = sprintf($urls->inshaka_url, $intelligence->users_photo->user->inshaka_url);
                  }elseif(!empty ($intelligence->users_video_id)){
                    $url = sprintf($urls->inshaka_url, $intelligence->users_video->user->inshaka_url);
                  }elseif(!empty ($intelligence->statu_id)){
                    $url = sprintf($urls->inshaka_url, $intelligence->statu->user->inshaka_url);
                    $text = $intelligence->statu->user->first_name." ".$intelligence->statu->user->last_name.' ha cambiado su estado en InShaka.com';
                  }
                ?>
                  <!-- Enlaces de compartir -->
                  <!-- Facebook -->
                  <div class="share-social-network" style="float: left; width: 100px;"> 
                    <div class="fb-like" data-send="false" data-href="<?= $url ?>" data-layout="button_count" data-width="100" data-show-faces="false" data-action="like" ></div>
                  </div>
                  <!-- Twitter --><!--
                  <div class="share-social-network" style="float: left; width: 100px;"> 
                    <a href="https://twitter.com/share" class="twitter-share-button" data-url="<?= $url ?>" data-text="<?= $text ?>" data-via="inshaka" data-lang="es" data-hashtags="TryInshaka">Twittear</a>
                  </div> -->
                  <!-- Google + -->
                  <div class="share-social-network" style="float: left; margin-left: 20px; width: 100px;"> 
                    <div class="g-plusone" data-size="medium" data-href="<?= $url ?>"></div>
                  </div>
                  <!-- Fin enlaces de compartir -->
                </div>
                <div class="clear"></div>
                <div class="comments-intelligence" id="comentarios-<?= $intelligence->id ?>" data-load-url="<?= site_url('perfil/social/load_comments/'.$intelligence->id) ?>">
                  
                </div>
                <div class="ajax-load-comments" id="ajax-load-<?= $intelligence->id ?>" style="display:none"></div>
              </div>
            </div>
            <div class="clear"></div>
          <!-- Fin nueva audición, clasificado, banda, status, show -->
          <?php endif; ?>
    <?php endforeach; ?>
   
    <div id="last_msg_loader" style="margin: 28px 230px;"></div>
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
              url: "<?= site_url('perfil/social/load_data') ?>",
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
    <div id="post-compartido" title="Compartir post" style="display:none">
      <p>
        Este post ha sido compartido en tu muro!.
      </p>
    </div>
    <div id="aplicar-compartido" title="Aplicar audición" style="display:none">
      <p>
        Haz aplicado a la audición correctamente!.
      </p>
    </div>
    <?php endif; ?>
    
  </div>
  
  <!-- Fin Blq notificaciones -->

  <div class="tags_social">
    <!-- Blq dinámico de audiciones, bandas y clasificados -->
    <!-- Modal bandas -->
    <div class="conDestacadoCen" id="bandas-social" style="height: 460px">
      <div class="conImgDestacados">
        <div class="imgDestacado">
          <img src="<?php echo base_url('assets/images/destacadoBanda.jpg') ?>" alt="" />
        </div>
        <div class="labelDestacado">
          <a href="<?php echo site_url('perfil/build-a-band') ?>"><img src="<?php echo base_url('assets/images/labelDestacados.png') ?>" alt="" /></a>
        </div>
      </div>

      <div class="titColumnas" style="margin-bottom: 10px">
        <span class="titDestacados">Mis bandas</span><br>
        <span class="subDestacados">Vibrando con</span>
        <div class="help-inshaka" title="<span class='title-help'>Mis Bandas</span>
             <div class='content-help'>
             <p>En este cuadro te aparecen las bandas a las que perteneces e invitaciones a tocar en bandas nuevas</p><br>
             <p>También las puedes ver haciendo click en <i>Perfil/Mis Bandas</i></p>
             </div>" 
             style="float:right; margin-right: 24px; margin-top: -37px;">
        </div>
      </div>
      <div id="mis_bandas" style="overflow:auto; height:150px;">
      <?php if ($mis_invitaciones->exists()): ?>
        <div style="color: #E82E7C; margin-left: 20px; font-family: 'BebasNeueRegular'; font-size: 21px;">Invitaciones</div>
          <?php foreach ($mis_invitaciones as $invitaciones): ?>
            <div class="txLista">
              <a href="#invitation<?php echo $invitaciones->bands_instrument->band->id ?>" class="invitation-modal">
                <span class="tLista"><?php echo $invitaciones->bands_instrument->band->name ?></span>
              </a>
              <div id="invitation<?php echo $invitaciones->bands_instrument->band->id ?>" style="display:none;">
                <div class="musicos-cont">
                  <div class="mensaje-tit">Invitación a Banda</div>
                  <div class="info-banda">
                      <div class="dato-banda">Nombre de la banda: <b><?php echo $invitaciones->bands_instrument->band->name ?></b></div>
                      <div class="dato-banda">Ciudad: <b><?php echo $invitaciones->bands_instrument->band->city ?></b></div>
                      <div class="dato-banda">Género: <b><?php echo $invitaciones->bands_instrument->band->musical_gender->name ?></b></div>
                      <div class="dato-banda">Integrantes: <b><?php echo $invitaciones->bands_instrument->band->bands_instrument->bands_instruments_user->count() ?></b></div>
                  </div>
                  <div class="pregunta">¿Quieres formar parte de esta banda?</div>
                  <div class="bots">
                    <a href="<?php echo site_url(array('build-a-band', 'accept-invitation', $invitaciones->invitation_code)) ?>" class="bot-registro">Aceptar</a>
                    <a href="<?php echo site_url(array('build-a-band', 'decline-invitation', $invitaciones->invitation_code)) ?>" class="bot-registro">Rechazar</a>
                    <div class="clear"></div>
                  </div>
                </div>
              </div>
            </div>
            <?php endforeach; ?>
          <?php endif; ?>
        
          <?php if ($banda_pertenezco->exists()): ?>
          <span class="pLista">&nbsp;</span>
            <div style="color: #E82E7C; margin-left: 20px; font-family: 'BebasNeueRegular'; font-size: 21px;">Bandas a las que pertenezco</div>
            <?php foreach ($banda_pertenezco as $pertenezco): ?>
              <div class="txLista">
                <a href="<?= site_url('perfil/pagina/'.  seo_name($pertenezco->banda)) ?>">
                  <span class="tLista" style="cursor:pointer;"><?php echo $pertenezco->banda ?></span>
                </a>
              </div>
            <?php endforeach; ?>
          <?php endif; ?>
            
          <?php if ($mis_bandas->exists()): ?>
          <span class="pLista">&nbsp;</span>
            <div style="color: #E82E7C; margin-left: 20px; font-family: 'BebasNeueRegular'; font-size: 21px;">Mis bandas</div>
            <?php foreach ($mis_bandas as $banda): ?>
              <div class="txLista">
                <a href="<?= site_url('perfil/pagina/'.  seo_name($banda->name)) ?>">
                  <span class="tLista" style="cursor:pointer;"><?php echo $banda->name ?></span>
                </a>
              </div>
            <?php endforeach; ?>
          <?php endif; ?>
        </div>
        <div class="clear"></div>
        <div class="conBtMas">
          <div id="txBtMas"><a href="<?php echo site_url('perfil/build-a-band') ?>"><span class="verMas">Ver Más</span></a></div>
          <a href="<?php echo site_url('perfil/build-a-band') ?>"><div id="imgBtMas"></div></a>
        </div>
      </div>    
      <!-- Fin bandas -->
      
      <!-- Modal audiciones -->
      <div class="conDestacadoIzq" id="audiciones-social" style="display:none; margin-left: 17px; height: 460px;">

        <div class="conImgDestacados">
            <div class="imgDestacado"><img src="<?php echo base_url('assets/images/destacadoIzq.jpg') ?>" alt="" /></div>
            <div class="labelDestacado"><a href="#"><img src="<?php echo base_url('assets/images/labelDestacados.png') ?>" alt="" /></a></div>
        </div>

        <div class="titColumnas">
            <span class="titDestacados">AUDICIONES</span><br>
            <span class="subDestacados">Conecta tu sonido</span>
            <div class="help-inshaka" title="<span class='title-help'>Audiciones</span>
                 <div class='content-help'>
                 <p>Este es tu acceso directo a todas las audiciones que se van creando en InShaka</p><br>
                 <p>Encuentra audiciones para Bandas, Artístas y Más!</p>
                 </div>" 
                 style="float:right; margin-right: 24px; margin-top: -37px;">
            </div>
        </div>
      
        
            <div id="audiciones_activas" style="overflow:auto; height:150px;">
              <?php if ($audiciones->exists()): ?>
                <?php foreach ($audiciones as $audicion): ?>
                    <div class="txLista">
                        <div class="audicion-ico">
                            <img src="images/audicion-ico.png">
                        </div>
                        <div class="mini-audi">
                            <a href="<?php echo sprintf($urls->audicion_detalle, $audicion->id, $audicion->var) ?>"><span class="tLista"><?php echo $audicion->titulo ?></span></a><br>
                            <span class="pLista"><?php echo substr($audicion->introduccion, 0, 100) ?></span>
                        </div>
                        <div class="clear"></div>
                    </div>
                <?php endforeach; ?>
              <?php endif; ?>
            </div>
        


        <div class="clear"></div>

        <div class="conBtMas">
            <div id="txBtMas"><a href="<?php echo site_url('perfil/audiciones') ?>"><span class="verMas">Ver Más</span></a></div>
            <a href="<?php echo site_url('perfil/audiciones') ?>"><div id="imgBtMas"></div></a>
        </div>

    </div>
      
      <!-- Fin audiciones -->
      
      <!-- Modal clasificados -->
      
      <div class="conDestacadoDer" id="clasificados-social" style="display: none; margin-left: 17px; height: 460px; box-shadow:22px 20px 35px #dfe2e1;">

        <div class="titColumnas">
            <span class="titDestacados">CLASIFICADOS</span><br>
            <span class="subDestacados">Clasificados según tus gustos</span>
            <div class="help-inshaka" title="<span class='title-help'>Clasificados</span>
                 <div class='content-help'>
                 <p>Este es tu acceso directo a todos los clasificados que se van creando en InShaka</p><br>
                 <p>Encuentra clasificados de compra,venta, alquiler y más opciones</p>
                 </div>" 
                 style="float:right; margin-right: 24px; margin-top: -63px;">
            </div>
        </div>

        <div class="tabs">
            <h2>CATEGORIAS</h2>
            <div id="cat_clasificados" class="tabbody" style="margin-top:10px !important; height: 275px;">              

                <?php if ($clasificados_categoria->exists()) : ?>
                    <?php foreach ($clasificados_categoria as $clasificado_categoria) : ?>
                        <a href="<?php echo site_url(array('clasificados', 'categoria', $clasificado_categoria->var)) ?>"> 
                            <div class="tabInfo">
                                <div class="imgTabClasificado1"></div>
                                <div class="clasificado-list-tit"><?php echo $clasificado_categoria->nombre ?></div><br>
                            </div>
                        </a>
                    <?php endforeach; ?>
                <?php endif; ?>

            </div>
            <h2>SUGERENCIAS</h2>
            <div id="sug_clasificados" class="tabbody" style="height: 275px;">              

                <?php if ($clasificados->exists()) : ?>
                    <div style="overflow:auto;max-height:260px;">
                        <?php foreach ($clasificados as $clasificado) : ?>
                            <div class="tabInfo">
                                <div class="imgTabClasificado" style="background: url(<?php echo uploads_url($clasificado->imagen)?>);"></div>
                                <a class="clasificado" href="<?php echo site_url(array('clasificados', 'detalle', $clasificado->id)) ?>"><?php echo $clasificado->titulo ?></a><br>
                                <span class="fechaClasificado"><?php echo fecha_spanish_full_short($clasificado->created_on) ?></span>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>


            </div>
        </div>
    </div>
      
      <!-- Fin clasificados -->
      <div class="clr"></div>
      <div class="clear"></div>
      <!-- Fin Blq dinámico -->
      
      <!-- Blq Recomendaciones -->
      <div id="img-recomendaciones" data-load-url="<?php echo site_url('home/home/random_user') ?>">
            Cargando...
      </div>
      <!-- Fin Blq Recomendaciones -->
      
      <!-- Blq publicitario -->
      <div id="blq-publicitario">
        
      </div>
      <div class="clr"></div>
      <div class="clear"></div>
      <!-- Fin Blq publicitario -->
      
      <!-- Blq Noticias -->
      <div class="conDestacadoCen" style="height: 460px;">

        <div class="conImgDestacados">
            <div class="imgDestacado"><img src="<?php echo base_url('assets/images/destacadoCen.jpg') ?>" alt="" /></div>
            <div class="labelDestacado"><a href="#"><img src="<?php echo base_url('assets/images/labelDestacados.png') ?>" alt="" /></a></div>
        </div>

        <div class="titColumnas">
            <span class="titDestacados">ULTIMAS NOTICIAS</span><br>
            <span class="subDestacados">Vibraciones Inshaka</span>
            <div class="help-inshaka" title="<span class='title-help'>Ultimas Noticias</span>
                 <div class='content-help'>
                 <p>Encuentra las últimas noticias de InShaka y seguimientos de lo que movemos en las redes sociales</p>
                 </div>" 
                 style="float:right; margin-right: 24px; margin-top: -37px;">
            </div>
        </div>

        <?php if ($news->exists()): ?>
            <div id="news_inshaka" style="max-height:150px;">
                <?php foreach ($news->all as $new) : ?>
                    <div class="txLista">
                        <span class="tLista"><a href="<?= site_url(array('noticias', $new->var)) ?>"><?php echo $new->title ?></a></span><br>
                        <span class="sLista"><?php echo fecha_spanish_full_short($new->created_on); ?></span><br>
                        <span class="pLista"><?php echo strip_tags(substr($new->content,0,120)) ?> ...</span>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
      
      <script type="text/javascript">
        $(function(){
          $("#news_inshaka, #my_favorites").jScrollPane();
        })
      </script>

        <div class="conBtMas">
            <div id="txBtMas"><a href="<?php echo site_url('noticias') ?>"><span class="verMas">Ver Más</span></a></div>
            <a href="<?php echo site_url('noticias') ?>"><div id="imgBtMas"></div></a>
        </div>

    </div>
      <div class="clr"></div>
      <div class="clear"></div>
      <!-- Fin Blq Noticias -->
      
      <!-- Blq Directorio -->
      <div class="conDestacadoIz" style="height: 460px; margin-top: 15px;">

        <div class="conImgDestacados">
            <div class="imgDestacado"><img src="<?php echo base_url('assets/images/destacadoDirect.jpg') ?>" alt="" /></div>
            <div class="labelDestacado"><a href="#"><img src="<?php echo base_url('assets/images/labelDestacados.png') ?>" alt="" /></a></div>
        </div>

        <div class="titColumnas">
            <span class="titDestacados">Directorio</span><br>
            <span class="subDestacados">Guía del Músico</span>
            <div class="help-inshaka" title="<span class='title-help'>Directorio</span>
                 <div class='content-help'>
                 <p>En este cuadro encuentras todos los directorios a los que les has puesto favorito para fácil acceso.</p>
                 </div>" 
                 style="float:right; margin-right: 24px; margin-top: -37px;">
            </div>
        </div>

        <?php if ($mis_favoritos->exists()): ?>
            <div id="my_favorites" style="overflow:auto;max-height:150px;">
                <?php foreach ($mis_favoritos as $d): ?>
                    <div class="txLista">
                        <a href="#"><span class="tLista"><?php echo $d->directorio->empresa ?></span></a><br>
                        <span class="sLista"><?php echo fecha_spanish_full_short($d->directorio->updated_on) ?></span><br>
                        <span class="pLista"><?php echo character_limiter($d->directorio->descripcion, 100) ?></span>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>


        <div class="conBtMas">
            <div id="txBtMas"><a href="<?php echo site_url('perfil/directorios') ?>"><span class="verMas">Ver Más</span></a></div>
            <a href="<?php echo site_url('perfil/directorios') ?>"><div id="imgBtMas"></div></a>
        </div>

    </div>
      <!-- Fin blq directorio -->
    </div>  
</div>
<script>
    $(function(){
        $('.invitation-modal').fancybox(); 
        $('#audiciones_activas').jScrollPane();
    });
</script>
<!-- Modales -->
<div id="follow-him-her" title="Seguir" style="display:none">
  <p>
    Estás seguro que deseas seguir a este usuario?
  </p>
</div>
<div id="unfollow-him-her" title="Dejar de seguir" style="display:none">
  <p>
    Estás seguro que deseas dejar de seguir a este usuario?
  </p>
</div>