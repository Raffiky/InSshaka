<style type="text/css">
    #menu-horizontal li a.active {
        color: #333 !important;	
    }

    .musicos-cont{
        height: 190px;
        margin-left: 4px;
        margin-top: 20px;
        width: 480px;
    }

    .mensaje-tit{
        color: #E82E7C;
        font-family: 'BebasNeueRegular';
        font-size: 36px;
        margin-bottom: 21px;
        text-align: center;
    }
    .musicos{
        margin: 0 auto;
        width: 320px;
    }
    .bot-buscar {

        float: right;

        margin-bottom: 60px;

    }
    .bot{
        color: #666666;
        cursor: pointer;
        float: left;
        font-family: 'BebasNeueRegular';
        font-size: 28px;
        margin-bottom: 61px;
        margin-left: 107px;
        margin-top: 10px;
        text-align: center;
    }
    .bot:hover{
        color: #E82E7C;
    }
    #user-panel{
        font-size: .8em;
        float: right;
        text-align: right;
    }
    
    #notificaciones, #solicitudes{
      width: 17px;
      height: 17px;
      float: right;
      padding: 6px;
      cursor: pointer;
      background-color: #F5F5F5;
      margin-left: 10px;
      border: 1px solid #D5D5D5;
      border-radius: 5px;
    }
    
    #cant_not, #notify_not{
      background-color: #E82E7C;
      border-radius: 10px;
      -moz-border-radius: 10px;
      -webkit-border-radius: 10px;
      width: 10px;
      height: 10px;
      margin-top: -36px;
      margin-left: 12px;
      color: #FFF;
      font-size: 11px;
      font-weight: bold;
      padding: 3px;
      text-align: center;
    }
    
    #seguidores{
      left: 936px;
    }
    #permitido{
      left: 980px;
    }
    #seguidores, #permitido{
     background-color: #FFF;
     width: 335px;
     padding: 10px;
     position: absolute;
     z-index: 99999;
     top: 42px;
     max-height: 324px;
     overflow: auto;
     border: 1px solid #e5e5e5;
     border-radius: 4px;
     -moz-border-radius: 4px;
     -webkit-border-radius: 4px;
   }  
  .my_follow{
    background-color: #f5f5f5;
    width: 95%;
    height: 75px;
    margin-bottom: 5px;
    border: 1px solid #e5e5e5;
    border-radius: 7px;
    -moz-border-radius: 7px;
    -webkit-border-radius: 7px;
    font-family: 'Arial';
    color: #333;
    font-size: 12px;
    padding: 7px;
  }
  .notify:hover{
    background-color: #D5D5D5;
  }
  .sobre_notificacion{
    background-color: #F5F5F5;
    border: 1px solid #E5E5E5;
    padding: 7px;
    border-radius: 7px;
    -moz-border-radius: 7px;
    -webkit-border-radius: 7px;
    height: 40px;
    overflow: hidden;
  }
  #search-inshaka-users{
    float: right;
  }
  #find-inshaka-users{
    width: 200px;
    border: 1px solid #FFF;
    background-color: #EEE;
    border-radius: 3px;
    padding: 3px 9px;
  }
</style>
<div class="header">
    <div class="conMenu">
        <div class="menu">
            <ul id="menu-horizontal">
              <li><a class="b1 <?php echo $current_page == 'home' ? 'active' : null ?>" href="<?php echo site_url('/') ?>"><?= lang('home') ?></a></li>
              <li><a class="b2 <?php echo $current_page == 'mishaka' ? 'active' : null ?>" href="<?php echo site_url('mishaka/buscar?city=&edad=0&anos_experiencia=0&necesitas_band=&numero_conciertos=0&talent=0&gender=0') ?>"><?= lang('mishaka') ?></a></li>
              <li><a class="b3 <?php echo $current_page == 'build-a-band' ? 'active' : null ?>" href="<?php echo site_url('build-a-band') ?>"><?= lang('build_a_band') ?></a></li>
              <li><a class="b4 <?php echo $current_page == 'audiciones' ? 'active' : null ?>" href="<?php echo site_url('audiciones') ?>"><?= lang('audition') ?></a></li>
              <li><a class="b5 <?php echo $current_page == 'directorio' ? 'active' : null ?>" href="<?php echo site_url('directorio') ?>"><?= lang('directory') ?></a></li>
               <!-- <li><a class="b6 <?php echo $current_page == 'media' ? 'active' : null ?>" href="<?php echo site_url('media/buscar/pagina/1?artist=0&musical_gender=0') ?>">MEDIA</a></li> -->
              <li><a class="b7 <?php echo $current_page == 'clasificados' ? 'active' : null ?>" href="<?php echo site_url('clasificados') ?>"><?= lang('classified') ?></a></li>
                <li><a class="b8 <?php echo $current_page == 'faqs' ? 'active' : null ?>" href="<?php echo site_url('faqs') ?>"><?= lang('faq') ?></a></li>
            </ul>
            <?php if (!$is_usuario) : ?>
              <div class="login" style="top:0px; right: 0px;">  
                  <?php echo form_open('usuarios/login?do', 'autocomplete="off"') ?>
                  <input name="username" type="text" class="textField" placeholder="Usuario..."/>
                  <input name="password" type="password" class="textPass" placeholder="Contraseña..." />
                  <input type="submit" class="submit" value="" />
                  <?php echo form_close() ?>
              </div>
          <?php endif; ?>
            <a href="#seleccion-registro" class="registro-modal" style="display:<?php echo ($is_usuario ? 'none' : 'block') ?>;"><div class="bot-registro" style="margin-left: 1067px;position: absolute;">Regístrate</div></a>
            <script type="text/javascript">
              $(document).ready(function(){

                  $("#notificaciones").on('click', function(){
                    if($("#seguidores").show())
                      $("#seguidores").hide();

                    $("#permitido").slideToggle('slow');
                  });

                  $("#solicitudes").on('click', function(){
                    if($("#permitido").show())
                      $("#permitido").hide();

                    $("#seguidores").slideToggle('slow');
                  });

                  if(<?= $follow_me->result_count() ?> >= 1){
                    $("#cant_not").show();
                    $("#cant_not").text(<?= $follow_me->result_count() ?>);
                  }

                  var notificacion = <?= $notifications->where(array('ready' => false, 'user_id' => $userinfo->id))->get()->result_count() ?>;

                  if( notificacion >= 1){
                    $("#notify_not").show();
                    $("#notify_not").text(notificacion);
                  }

              });

              function allow_follow(elemento, id, status){
                var cantidad = parseInt($("#cant_not").text());
                var datos = {
                  id: id,
                  status: status
                };
                $.ajax({
                  url : "<?= site_url('perfil/social/allow_follow') ?>",
                  type : "get",
                  data : datos,
                  beforeSend : function(){
                    if(cantidad == 0){
                      $("#cant_not").hide();
                    }
                  },
                  success : function(){
                    $(elemento).fadeOut("slow");
                    $("#cant_not").fadeOut("slow").fadeIn("slow").text(cantidad - 1);
                  },
                  complete : function(){
                    if(cantidad == 0){
                      $("#cant_not").hide();
                      $("#seguidores").hide();
                    }
                  }
                });      
              }

              function ready_notify(elemento, id){
                var cant = parseInt($("#notify_not").text());
                var data = {
                  id: id
                };
                $.ajax({
                  url   : "<?= site_url('perfil/social/ready_notify') ?>",
                  type  : "get",
                  data  : data,
                  beforeSend  : function(){
                    if(cant == 0){
                      $("#notify_not").hide();
                    }
                  },
                  success     : function(){
                    $(elemento).css("background-color", "#D5D5D5");
                    $("#notify_not").fadeOut("slow").fadeIn("slow").text(cant - 1);
                    $(location).attr('href', "<?= site_url('perfil/social/detalle?id=') ?>" +id  );
                  },
                  complete    : function(){
                    if(cant == 0){
                      $("#notify_not").hide();
                      $("#permitido").hide();
                    }
                  }
                });
              }
            </script>
            
            <a href="<?php echo site_url('usuarios/logout') ?>" style="display:<?php echo (!$is_usuario ? 'none' : 'block') ?>;"><div class="bot-logout">Logout</div></a>
            <a href="<?php echo site_url('perfil/' . $this->session->userdata('inshaka_url')) ?>" style="display:<?php echo (!$is_usuario ? 'none' : 'block') ?>;"><div class="bot-logout" style="margin-right: .5em">Perfil</div></a>
            <?php if($is_usuario) : ?>
            <div id="notificaciones" style="margin-right: 20px;"><img src="images/ico1.png"><div id="notify_not" style="display:none"></div></div>
            <div id="solicitudes"><img src="images/ico2.png"><div id="cant_not" style="display:none"></div></div>
            <div id="search-inshaka-users">
              <?= form_open(site_url('perfil/social/find_inshaka'), null) ?>
              <input id="find-inshaka-users" name="find-inshaka-users" placeholder="Que estás buscando..." />
              <?= form_close() ?>
            </div>
            <script type="text/javascript">
              $(function(){
                $( "#find-inshaka-users" ).autocomplete({ 
                  source: "<?= site_url('home/get_all') ?>"
                });
              })
            </script>
            <?php endif; ?>
        </div>
    </div>
</div>

<div class="musicos-cont" style="display:none;" id="seleccion-registro">
    <div class="mensaje-tit">¿Cuál perfil deseas crear?</div>
    <div class="bot"><a href="<?php echo site_url('usuarios/registro/index/individual') ?>">Músico</a></div>
    <div class="bot"><a href="<?php echo site_url('usuarios/registro/index/proveedor') ?>">Proveedor</a></div>
</div>

<!-- Capa de seguidores -->

<div id="seguidores" style="display:none">
  <div class="b_cerrar" style="margin-right: 0px; display: block; cursor: pointer" onclick="$('#seguidores').slideUp('slow')"></div>
  <div class="mensaje-tit" style="text-align: left; color: #666; border-bottom: 1px solid #666; font-size: 25px;">Solicitudes de amistad</div>
  <?php if($follow_me->exists()) : ?>
    <?php foreach($follow_me as $my_follow) : ?>
      <div id="follower_<?= $my_follow->id ?>" class="my_follow">
        <?php $photo_user->where(array('user_id' => $my_follow->user_id, 'profile_active' => true))->get(); ?>
        <div style="float:left">
          <?php if ($photo_user->exists()) : ?>
            <img  src="<?= uploads_url($photo_user->get_photo($my_follow->user_id)) ?>" width="77" height="73"/>
          <?php else :?>
            <img  src="images/foto-perfil.png" width="77" height="73" />
          <?php endif; ?>
        </div>
        <div style="float:left; margin-left: 10px;">
          <p><span style="font-weight: bold;"><?= $my_follow->user->first_name.' '.$my_follow->user->last_name ?></span></p><br>
          <p style="text-align: justify;">
            <?= strlen($my_follow->user->status) >= 30 ? substr($my_follow->user->status, 0, 30).'...' : $my_follow->user->status ?>
          </p>
          <p>
            <div class="bot-logout" style="margin-top: 18px; float:left; font-size: 1.2em" onclick="allow_follow('#follower_<?= $my_follow->id ?>', <?= $my_follow->id ?>, 'Allow');">Aceptar</div>
            <div class="bot-logout" style="margin-top: 18px; float:left; font-size: 1.2em; margin-left: 15px; background-color: #999" onclick="allow_follow('#follower_<?= $my_follow->id ?>', <?= $my_follow->id ?>, 'Deny');">Rechazar</div>
          </p>
        </div>
      </div>
    <?php endforeach; ?>
  <?php endif; ?>
</div>

<!-- Fin capa de seguidores -->

<!-- Capa de notificaciones -->
<div id="permitido" style="display:none">
  <div class="b_cerrar" style="margin-right: 0px; display: block; cursor: pointer" onclick="$('#permitido').slideUp('slow')"></div>
  <div class="mensaje-tit" style="text-align: left; color: #666; border-bottom: 1px solid #666; font-size: 25px;">Notificaciones</div>
  <?php $notifications->where('user_id', $userinfo->id)->order_by('ready, update_on DESC')->limit(20)->get(); ?>
  <?php if($notifications->exists()) : ?>
    <?php foreach($notifications as $allowed) : ?>
      <?php if(!empty($allowed->intelligence->users_follow_id)) : ?>
      <div id="allowed_<?= $allowed->id ?>" class="my_follow notify" style="cursor: pointer;" onclick="ready_notify('#allowed_<?= $allowed->id ?>', <?= $allowed->id ?>)">
        <?php $photo_user->where(array('user_id' => $allowed->intelligence->users_follow->user_follow_id, 'profile_active' => true))->get(); ?>
        <div style="float:left">
          <?php if ($photo_user->exists()) : ?>
            <img  src="<?= uploads_url($photo_user->get_photo($allowed->intelligence->users_follow->user_follow_id)) ?>" width="77" height="73"/>
          <?php else :?>
            <img  src="images/foto-perfil.png" width="77" height="73" />
          <?php endif; ?>
        </div>
        <div style="float:left; margin-left: 10px;">
          <p><span style="font-weight: bold;"><?= $usuario_->get_name($allowed->intelligence->users_follow->user_follow_id) ?></span></p><br>
          <p style="text-align: justify; color: #E82E7C;">
            Ha aceptado tu solicitud de amistad
          </p>
        </div>
      </div>
      <?php elseif(!empty($allowed->intelligence->audiciones_aplicacion_id)) : ?>
        <?php foreach ($allowed->intelligence->audiciones_aplicacion as $apply_audition) : ?>
          <div id="allowed_<?= $allowed->id ?>" class="my_follow notify" style="cursor: pointer;  <?= !$allowed->ready ? 'background-color: #D5D5D5' : null ?>" onclick="ready_notify('#allowed_<?= $allowed->id ?>', <?= $allowed->id ?>)">
            <?php $photo_user->where(array('user_id' => $apply_audition->user_id, 'profile_active' => true))->get(); ?>
            <div style="float:left">
              <?php $photo_profile = $photo_user->get_photo($apply_audition->user_id) ?>
              <?php if ($photo_profile) : ?>
                <img  src="<?= uploads_url($photo_profile) ?>" width="77" height="73"/>
              <?php else :?>
                <img  src="images/foto-perfil.png" width="77" height="73" />
              <?php endif; ?>
            </div>
            <div style="float:left; margin-left: 10px; width: 214px;">
              <p><span style="font-weight: bold;"><?= $usuario_->get_name($apply_audition->user_id) ?></span> Aplicó a...</p>
              <div class="clear" style='margin-top: 10px;'></div>
              <div class="sobre_notificacion" style='<?= !$allowed->ready ? 'background-color: #D5D5D5' : null ?>'>
                <div style="float:left">
                  <?php if(!empty($apply_audition->audicion->imagen)) : ?>
                    <img  src="<?= uploads_url($apply_audition->audicion->imagen) ?>" style="width: 40px; height: 40px;" />
                  <?php else :?>
                    <img  src="images/imagensino.png" style="width: 40px; height: 40px;" />
                  <?php endif; ?>
                </div>
                <div class="subcontent_follower" style="float:left; margin-left: 10px; width: 70%; color: #E82E7C">
                  <span><?= $apply_audition->audicion->titulo ?></span>
                </div>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      <?php elseif(!empty($allowed->intelligence->statu_id)) : ?>
        <?php foreach ($allowed->intelligence->statu as $mencionado) : ?>
          <div id="allowed_<?= $allowed->id ?>" class="my_follow notify" style="cursor: pointer;  <?= !$allowed->ready ? 'background-color: #D5D5D5' : null ?>" onclick="ready_notify('#allowed_<?= $allowed->id ?>', <?= $allowed->id ?>)">
            <?php $photo_user->where(array('user_id' => $mencionado->user_id, 'profile_active' => true))->get(); ?>
            <div style="float:left">
              <?php $photo_profile = $photo_user->get_photo($mencionado->user_id) ?>
              <?php if ($photo_profile) : ?>
                <img  src="<?= uploads_url($photo_profile) ?>" width="77" height="73"/>
              <?php else :?>
                <img  src="images/foto-perfil.png" width="77" height="73" />
              <?php endif; ?>
            </div>
            <div style="float:left; margin-left: 10px; width: 214px;">
              <p><span style="font-weight: bold;"><?= $usuario_->get_name($mencionado->user_id) ?></span> Te han mencionado en su estado</p>
              <div class="clear" style='margin-top: 10px;'></div>
              <div class="sobre_notificacion" style='height: 25px; <?= !$allowed->ready ? 'background-color: #D5D5D5' : null ?>'>
                <?= strlen($allowed->intelligence->statu->status) > 50 ? substr($allowed->intelligence->statu->status, 0, 50)."..." : $allowed->intelligence->statu->status ?>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      <!-- Bloq. de comentarios -->
      <?php else : ?>
        <?php $comentarios = $allowed->intelligence->intelligences_comment->get() ?>
        <?php foreach ($comentarios as $comentario) :?>
          <div id="allowed_<?= $allowed->id ?>" class="my_follow notify" style="cursor: pointer;  <?= !$allowed->ready ? 'background-color: #D5D5D5' : null ?>" onclick="ready_notify('#allowed_<?= $allowed->id ?>', <?= $allowed->id ?>)">
            <?php $photo_user->where(array('user_id' => $comentario->user_id, 'profile_active' => true))->get(); ?>
            <div style="float:left">
              <?php $photo_profile = $photo_user->get_photo($comentario->user_id) ?>
              <?php if ($photo_profile) : ?>
                <img  src="<?= uploads_url($photo_profile) ?>" width="77" height="73"/>
              <?php else :?>
                <img  src="images/foto-perfil.png" width="77" height="73" />
              <?php endif; ?>
            </div>
            <div style="float:left; margin-left: 10px; width: 214px;">
              <p><span style="font-weight: bold;"><?= $usuario_->get_name($comentario->user_id) ?></span> Ha comentado en...</p>
              <div class="clear" style='margin-top: 10px;'></div>
              <div class="sobre_notificacion" style='<?= !$allowed->ready ? 'background-color: #D5D5D5' : null ?>'>
                <div style="float:left">
                  
                  <!-- Bloq. audiciones -->
                  <?php if(!empty($allowed->intelligence->audicion_id)) : ?>
                    <?php if(!empty($comentario->intelligence->audicion->imagen)) : ?>
                      <img  src="<?= uploads_url($comentario->intelligence->audicion->imagen) ?>" style="width: 40px; height: 40px;" />
                    <?php else :?>
                      <img  src="images/imagensino.png" style="width: 40px; height: 40px;" />
                    <?php endif; ?>
                  <!-- Fin bloq. audidiciones -->
                  
                  <!-- Bloq. audiciones aplicacion -->
                  <?php elseif(!empty($allowed->intelligence->audiciones_aplicacion_id)) : ?>
                    <?php if(!empty($comentario->intelligence->audiciones_aplicacion->audicion->imagen)) : ?>
                      <img  src="<?= uploads_url($comentario->intelligence->audiciones_aplicacion->audicion->imagen) ?>" style="width: 40px; height: 40px;" />
                    <?php else :?>
                      <img  src="images/imagensino.png" style="width: 40px; height: 40px;" />
                    <?php endif; ?>
                  <!-- Fin bloq. audidiciones aplicacion -->
                  
                  <!-- Bloq. bandas -->
                  <?php elseif(!empty($allowed->intelligence->band_id)) : ?>
                    <?php $profile_band = $allowed->intelligence->band->page->pages_photo->where('profile_active', true)->get() ?>
                    <?php if($profile_band->exists()) : ?>
                      <img  src="<?= uploads_url($profile_band->thumb) ?>" style="width: 40px; height: 40px;" />
                    <?php else :?>
                      <img  src="images/imagensino.png" style="width: 40px; height: 40px;" />
                    <?php endif; ?>
                  <!-- Fin bloq. bandas -->
                  
                  <!-- Bloq. clasificados -->
                  <?php elseif(!empty($allowed->intelligence->clasificado_id)) : ?>
                    <?php if(!empty($comentario->intelligence->clasificado->imagen)) : ?>
                      <img  src="<?= uploads_url($comentario->intelligence->clasificado->imagen) ?>" style="width: 40px; height: 40px;" />
                    <?php else :?>
                      <img  src="images/imagensino.png" style="width: 40px; height: 40px;" />
                    <?php endif; ?>
                  <!-- Fin bloq. clasificados -->
                      
                  <?php endif; ?>
                </div>
                <div class="subcontent_follower" style="float:left; margin-left: 10px; width: 70%; color: #E82E7C">
                  <span>
                    <!-- Bloq. audiciones -->
                    <?php if(!empty($allowed->intelligence->audicion_id)) : ?>
                      <?= $comentario->intelligence->audicion->titulo ?>
                    <!-- Fin bloq. audiciones -->
                    
                    <!-- Bloq. bandas -->
                    <?php elseif(!empty($allowed->intelligence->band_id)) : ?>
                      <?= $allowed->intelligence->band->name ?>
                    <!-- Fin bloq. bandas -->
                    
                    <!-- Bloq. clasificados -->
                    <?php elseif(!empty($allowed->intelligence->clasificado_id)) : ?>
                      <?= $comentario->intelligence->clasificado->titulo ?>
                    <!-- Fin bloq. clasificados -->
                    
                    <!-- Bloq. status -->
                    <?php elseif(!empty($allowed->intelligence->statu_id)) : ?>
                      <?= strlen($allowed->intelligence->statu->status) > 50 ? substr($allowed->intelligence->user->status, 0, 50)."..." : $allowed->intelligence->statu->status ?>
                    <!-- Fin bloq. status -->
                    
                    <!-- Bloq. shows -->
                    <?php elseif(!empty($allowed->intelligence->users_show_id)) : ?>
                      <?php $date = fecha_spanish($allowed->intelligence->users_show->date); ?>
                      <div class="show-fecha" style="padding: 7px 5px; width: 40px; height: 30px; margin-right: 5px; float:left;">
                        <b style="font-size: 23px"><?php echo $date['dia_text_short'] ?></b></br><?php echo $date['dia'], ' ', $date['mes'] ?>
                      </div>
                      <span><?= $allowed->intelligence->users_show->place ?></span>
                    <!-- Fin bloq. shows -->
                    
                    <!-- Bloq. photo -->
                    <?php elseif(!empty($allowed->intelligence->users_photo_id)) : ?>
                    <img src="<?= uploads_url($allowed->intelligence->users_photo->thumb) ?>" style="width: 181px;">
                    <!-- Fin bloq. photo -->
                    
                    <?php endif; ?>
                  </span>
                </div>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      <!-- Bloq. de comentarios -->
      <?php endif; ?>
    <?php endforeach; ?>
  <?php endif; ?>
</div>

<!-- Fin capa de notificaciones -->