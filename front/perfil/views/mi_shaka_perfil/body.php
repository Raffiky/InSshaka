<script src="<?= front_asset('/js/mishaka.js') ?>"></script>
<script>
    var songs_all_urls = <?php echo json_encode($datos->users_songs->get_all_songs_urls()) ?>;
    var songs_urls = <?php echo json_encode($datos->users_songs->get_songs_urls()) ?>;

  // Formulario para comentar
  $("form#create-comment-form").on("submit", function(){
    var datos = $(this).serialize();
    $.ajax({
      type  : "post",
      url   : "<?= site_url("perfil/ajax/create_comment") ?>",
      data  : datos,
      beforeSend  : function(){
        $("#btn-send-comment").val("Enviando...").css("opacity", "0.6");
      },
      success : function(){
        $.fancybox.close();
      },
      complete  : function(){
        $("#btn-send-comment").val("Enviar").css("opacity", "1");
        $.fancybox.close();
      },
      error   : function(){
        $.fancybox.close();
        $("#btn-send-comment").val("Enviar").css("opacity", "1");
      }
    });
  });
</script>
<script defer src="<?php echo front_asset('js/perfil-usuario.js') ?>"></script>
<style>
  .bgSlider{
    display:none;
  }
/*  .login{
    display:none;
  }*/
  #form_directorio label.error {
    float: left;
    color: red;
    font-weight: normal;
    padding-left: .5em;
    vertical-align: top;
    font-size: .72em;
    width: 345px;
    margin-bottom: 10px;
  }
  .b2{
    color:#333 !important;	
  }
  .c1{
    color:#333 !important;	
  }
  .can-cont{
    height:auto;
    max-height: 340px;
    overflow: hidden;
  }
  .area-msg {
    border: 1px solid #CCCCCC;
    height: 60px;
    width: 360px;
    color: black;
  }
  .rating-txt{
    color: #666666;
    font-size: 12px;
    width: 470px;
  }
  .rating-nom{
    color: #666;
    font-family: 'BebasNeueRegular';
    font-size: 20px;
    float:left;
  }
  .rating-dato{
    color: #E82E7C;
    font-family: 'BebasNeueRegular';
    font-size: 20px;
  }
  .rating-list{
    margin: 30px auto 0;
    width: 350px;
  }
  .rating-valor{
    height: 22px;
    margin-bottom: 2em;
    clear: both;
    display: block;
  }
  .bot-acc {
    background-color: #666666;
    color: #FFFFFF;
    cursor: pointer;
    float: right;
    font-family: 'BebasNeueRegular';
    font-size: 18px;
    margin-right: 25px;
    margin-top: 30px;
    padding: 3px 10px;
  }
  .form-usuario {
    background-color: transparent;
    border-radius: 10px 10px 10px 10px;
    height: 99px;
    margin-left: 22px;
    padding-left: 17px;
    padding-top: 12px;
    width: 393px;
  }
  .rating-campo{
    float: right;
    margin-right: -10px;
    text-align: center;
    width: 20px;
    display:none;
  }
  .show:hover .borrar{
    display:block;
  }
  .show:hover .editar{
    display:block;
  }
  .song:hover .delete_song{
    display: block;
  }
  .borrar{
    width: 30px; margin-top: 5px;background-color: #F3F4F7;
    display:none;
    position: absolute;
    margin-left: 240px;
  }
  .editar{
    width: 30px;margin-right: 8px; margin-top: 5px;background-color: #F3F4F7;
    display:none;
    position: absolute;
    margin-left: 206px;
  }
  .date-picker {
    background-color: transparent;

    border: 0 none;
    height: 30px;
    width: 150px;
  }
  .slider.ui-widget-content{ background: #E93580; }
  .slider .ui-slider-range{ background: #666; }
  .campos-show input[type="text"]{
    background-color: #E5E8E9 !important;
    background-image: none !important;
    border: 1px solid #D0D2D4 !important;
    border-radius: 5px 5px 5px 5px !important;
    color: #585858 !important;
    margin-bottom: 7px;
    padding-left: 10px !important;
    padding-right: 10px !important;
    width: 270px !important;
  }
 .thumb-album-img > img{

  }
  #contenu {
    overflow-x: auto;
    overflow-y: hidden;
    width: 650px;
    height: 150px;
  }
  .banda {
          font-family: 'BebasNeueRegular';
          font-size: 1.1em;
          text-align: center;
          color: #666;
          width: 130px; 
          height: 90px; 
          float: left; 
          margin-right: 7px;
          padding: 7px;
          border: 3px solid #DEDEDE;
          border-radius: 10px;
          -moz-border-radius: 10px;
          -webkit-border-radius: 10px;
        }
  #fans-count{
    background-color: #E82E7C; 
    border-radius: 4px; 
    -moz-border-radius: 4px; 
    -webkit-border-radius: 4px;
  }
  .alert{
    margin-bottom: 0px;
  }
</style>
<div id="fb-root"></div>
<script>
  (function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id))
        return;
    js = d.createElement(s);
    js.id = id;
    js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=420842527964948";
    fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));
</script>
<script>
  $(function() {
    $(".more-songs").fancybox({
        onClosed: function(){ 
            $('#songs-url-list').show('slow');
        }
    });
    
    $(function() {
      var alto_show = ($('.conDestacadoPerfil').height() - 150);
      
      if( alto_show <= 200 ){
        alto_show = 250;
      };
          
      $('#scroll20').css('height', alto_show);
      $('#scroll20').jScrollPane();
    });

    $(function() {
      $('#scroll22').jScrollPane();
    });

  });
 
</script>
<div class="perfil-cont">
  <!-- Contenido del lado izquierdo -->
  <div class="perfil-cont-iz">
    <?php if ($is_owner_usuario): ?>
      <!-- Bóton para editar la información personal -->
      <div class="lapiz2" style="margin-top: 50px;">
        <a href="<?php echo site_url('perfil/editar/informacion_personal') ?>">
          <img src="<?= front_asset('images/editar.png') ?>" />
        </a>
      </div>
      <div id="first-help" class="help-inshaka" title="<span class='title-help'><?= lang('tooltip_edit_personal_info') ?></span>
          <div class='content-help'>
          <?= lang('tooltip_content_edit_personal_info') ?>
          <button class='bot-logout' data-next-help='#secound_help' style='border: 0px;' onclick='disparador($(this));'><?= lang('next_tooltip_button') ?></button>
          </div>" 
          style="float:right; margin-right: -10px; margin-top: 21px; ">
     </div>
    <?php endif; ?>
    
    <!-- Género musical -->
    <?php if ($datos->musical_gender->exists()) : ?>
      <div class="genero">
        <b>Género(s):</b> 
        <?php foreach ($datos->musical_gender as $musical_gender) : ?>
          <?php echo $musical_gender->name . (next($datos->musical_gender)== true ? ',' : null) ?>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>
    
    <!-- Imágen de perfil -->
    <div class="foto-banda">
      <?php $datos->users_photo->get_by_profile_active(true)?>
      <?php if ($datos->users_photo->exists()) :?>
        <img  src="<?php echo uploads_url($datos->users_photo->get_photo($datos->id)) ?>" width="250" />
      <?php else : ?>
        <img  src="images/imagensino.png" width="250" />
      <?php endif; ?>
    </div>
    
    <!-- Botón para compartir en facebook -->
    <div style="float:left; margin-top:1.5em;">
      <div class="fb-like" data-send="false" data-layout="button_count" data-width="100" data-show-faces="false"></div>
    </div>
    
    <!-- Obtenemos el rating -->
    <div class="rating">
      <?php echo $datos->get_rating(); ?>
    </div>
    <div class="clear"></div>
    <?php if($is_usuario) : ?>
      <?php if(!$is_owner_usuario) : ?>
        <!-- Botones de contactar, rating y seguir -->
        <div class="bot-acciones">
          <!-- Botón de contactar -->
          <a href="#contactar-cont" class="form-m"><div class="bot-acc2">Contactar</div></a>
          
          <!-- Botón de seguir -->
          <?php $follow->where(array('user_follow_id' => $datos->id, 'user_id' => $userinfo->id))->get() ?>
          <div id="btn-follow-user" class="bot-acc2" style="<?= !$follow->exists() ? null : 'display:none;' ?>" onclick="follow(<?= $datos->id ?>, '#follow-him-her', '#btn-follow-user', '#cancelar_solicitud-user', '<?= site_url("perfil/social/follow") ?>');">Seguir</div>
          
          <!-- Botón de siguiendo, con ajax cambia a dejar de seguir -->
          <div id="siguiendo-user" class="bot-logout" style="margin: -3px 20px 0px 0px; <?= $follow->allow_follow == true ? null : 'display:none;' ?>" onclick="follow(<?= $datos->id ?>, '#follow-her-him','#siguiendo-user', '#btn-follow-user', '<?= site_url("perfil/social/follow") ?>')">Siguiendo</div>
          
          <!-- Botón de enviada -->
          <div id="cancelar_solicitud-user" class="bot-acc2" style="<?= $follow->exists() && $follow->allow_follow == false ? null : 'display:none' ?>" onclick="follow(<?= $datos->id ?>, '#follow-her-him', '#cancelar_solicitud-user', '#btn-follow-user', '<?= site_url("perfil/social/follow") ?>')">Enviada</div>
          
          <!-- Botón de rating -->
          <a href="#rating-cont" class="form-m"><div class="bot-acc2">Rating</div></a>
          <div class="clear"></div>
        </div>
      <?php endif; ?>
    <?php endif; ?>
    <!-- Bloque de información personal -->
    <?php if(!$datos->is_proveedor) : ?>
      <!-- Información de músico -->
      <div class="genero"><b>Experiencia:</b> <?php echo!empty($datos->users_personal_info->nivel_experiencia) ? $datos->users_personal_info->nivel_experiencia : 'Sin definir' ?></div>
      <?php if($datos->is_band) : ?>
      <!-- Información de banda -->
      <div class="genero"><b>Genero Principal:</b> <?= $band_gender->get_name_gender("Genero Principal", $datos->id) ? $band_gender->get_name_gender("Genero Principal", $datos->id) : 'Sin definir' ?></div>
      <div class="genero"><b>Subgenero uno:</b> <?= $band_gender->get_name_gender("Subgenero uno", $datos->id) ? $band_gender->get_name_gender("Subgenero uno", $datos->id) : 'Sin definir' ?></div>
      <div class="genero"><b>Subgenero dos:</b> <?= $band_gender->get_name_gender("Subgenero dos", $datos->id) ? $band_gender->get_name_gender("Subgenero dos", $datos->id) : 'Sin definir' ?></div>
      <?php endif; ?>
    <?php else : ?>
      <?php if ($is_owner_usuario): ?>
        <div class="lapiz4" style="display: none;">
          <a href="<?php echo site_url('perfil/editar/informacion_profesional') ?>"><img src="<?= front_asset('images/editar.png') ?>" /></a>
        </div>
      <?php endif; ?>
      <div class="genero"><b>Información profesional</b></div>
      <?php if ($is_owner_usuario): ?>
        <div class="help-inshaka" title="<span class='title-help'>Editar información profesional</span>
          <div class='content-help'>
          <p>Haz click acá para editar tu información profesional como:</p><br>
          <p>
            <table border='0'>
              <tr>
                <td width='160px'>Teléfono de la empresa</td>
                <td width='160px'>Influencias</td>
              </tr>
              <tr>
                <td width='160px'>Años de experiencia</td>
                <td width='160px'>Links de contacto</td>
              </tr>
              <tr>
                <td width='160px'>Dirección</td>
                <td width='160px'>Sitio web</td>
              </tr>
            </table>
          </p>
          </div>" 
          style="float:right; margin-right: 65px; margin-top: -22px;">
        </div>
      <?php endif; ?>
      <br>
      <!-- Información de proveedor -->
      <div class="genero"><b>Teléfono:</b> <?php echo!empty($datos->users_personal_info->phone_provider) ? $datos->users_personal_info->phone_provider: 'Sin definir' ?></div>
      <div class="genero"><b>Dirección:</b> <?php echo!empty($datos->adress_provider) ? $datos->adress_provider : 'Sin definir' ?></div>
      <div class="genero"><b>Ciudad:</b> <?php echo!empty($datos->city) ? $datos->city : 'Sin definir' ?></div>
      <div class="genero"><b>Sitio web:</b> <?php echo!empty($datos->users_personal_info->sitio_web) ? $datos->users_personal_info->sitio_web : 'Sin definir' ?></div>
      <div class="genero"><b>Experiencia:</b> <?php echo!empty($datos->users_personal_info->anos_experiencia) ? $datos->users_personal_info->anos_experiencia.' años' : 'Sin definir' ?></div>
    <?php endif; ?>
    <div class="clear" style="margin-top: 10px;"></div>
    
    <!-- Botón de listado de fans -->
    <?php if(!$is_owner_usuario) : ?>
    <a href="#fans-cont" class="form-m"><div class="bot-acc2" id="fans-count">Fans de <?= $datos->username ?> [<?= $follow->where(array('user_follow_id' => $datos->id, 'allow_follow' => true))->get()->result_count() ?>]</div></a>
    <div class="clear" style="margin-bottom: 10px;"></div>
    <?php endif; ?>
    
    <!-- Links de contacto -->
    <?php if($is_usuario) : ?>
      <div class="link-perfil" style="<?= $datos->is_proveedor ? 'margin-bottom: 5px;' : null?>">
        <div class="link-perfil-tit">Links de contacto</div>
        <div class="link-perfil-icos">
          <ul>
            <?php if (!empty($datos->users_personal_info->social_facebook)) : ?>
              <li><a href="<?php echo $datos->users_personal_info->social_facebook ?>" target="_blank" class="ico-perfil1"></a></li>
            <?php endif; ?>
            <?php if (!empty($datos->users_personal_info->social_twitter)) : ?>
              <li><a href="<?php echo $datos->users_personal_info->social_twitter ?>" target="_blank"  class="ico-perfil2"></a></li>
            <?php endif; ?>
            <?php if (!empty($datos->users_personal_info->social_youtube)) : ?>
              <li><a href="<?php echo$datos->users_personal_info->social_youtube ?>" target="_blank" class="ico-perfil3"></a></li>
            <?php endif; ?>
            <li> <?php echo mailto($datos->email, ' ', array('class' => 'ico-perfil6')); ?> </li>
            <div class="clr"></div>
          </ul>
        </div>
      </div>
    <?php endif; ?>
    
    <!-- Bloque de fotos y videos -->
    <?php if(!$datos->is_proveedor) : ?>
      <div class="regis-tit" id="misAlbumes">Mis Álbumes</div>
    <?php endif; ?>
    <?php if ($is_owner_usuario): ?>
      <div class="lapiz3" style="display: none; ">
        <a href="<?php echo sprintf($urls->current_inshaka_url_format, 'fotos') ?>"><img src="<?= front_asset('images/editar.png') ?>" /></a>
      </div>
      <div id="secound_help" class="help-inshaka" title="<span class='title-help'><?= lang('tooltip_edit_photos_and_videos') ?></span>
        <div class='content-help'>
        <?= lang('tooltip_content_edit_photos_and_videos') ?>
        <button class='bot-logout' data-next-help='#third_help' style='border: 0px;' onclick='disparador($(this));'><?= lang('next_tooltip_button') ?></button>
        </div>" 
        style="float:right; margin-right: 20px; margin-top: -29px;">
      </div>
    <?php endif; ?>
    <!-- Bloque de fotos -->
    <div class="thumb-album">
      <div class="regis-subtit">Fotos</div>
      <a href="<?= site_url('perfil/'.$datos->inshaka_url.'/fotos') ?>">
        <div class="thumb-album-img">
          <div class="mas"><img src="<?= front_asset('images/mas.png') ?>" /></div>
          <?php if ($datos->users_photo->exists()): ?>
            <img src="<?php echo uploads_url($datos->users_photo->thumb) ?>" height="86px" width="115" />
          <?php else : ?>
            <img src="images/imagensino.png" height="101px" width="115" />
          <?php endif; ?>
        </div>
      </a>
    </div>
    <!-- Bloque de videos -->
    <div class="thumb-album">
      <div class="regis-subtit">Videos</div>
      <a href="<?= site_url('perfil/'.$datos->inshaka_url.'/videos') ?>">
        <div class="thumb-album-img">
          <div class="mas"><img src="<?= front_asset('images/mas.png') ?>" /></div>
          <?php if ($datos->users_video->exists()): $datos->users_video->get_oembed(); ?>
          <img src="<?php echo $datos->users_video->oembed->thumbnail_url ?>"  width="115"/>
          <?php else : ?>
          <img src="images/imagensino.png"  width="115"/>
          <?php endif; ?>
        </div>
      </a>
    </div>
    
    <!-- Bloque de mapa de proveedor -->
    <?php if($datos->is_proveedor) : ?>
      <div class="mapa"><div id="map_canvas" style="width:260px; height:280px; margin-top: 10px; border: 1px solid #000;"></div></div>
      <script src="https://maps.google.com/maps/api/js?sensor=true"></script>
      <script src="<?= front_asset('js/jquery.gmap.js') ?>"></script>      
      <script type="text/javascript">
        $('#map_canvas').gMap({
           markers: [
            {
               address: '<?= $datos->adress_provider,' , ', $datos->city ?>',
               html: '<span style="color: #E82E7C; font-size:2.1em;"> <?= json_encode($datos->name_proveedor)?> </span>'
            }
           ],
           address: '<?= $datos->adress_provider,' , ', $datos->city ?>',
           zoom:12
       });
     </script>
    <?php else : ?>
     <!-- Información profesional de músico -->
     <div class="conDestacadoPerfil"> 
      <div class="titColumnas">
        <?php if ($is_owner_usuario): ?>
          <div class="lapiz4" style="display: none; margin-top: 42px;">
            <a href="<?php echo site_url('perfil/editar/informacion_profesional') ?>"><img src="<?= front_asset('images/editar.png') ?>" /></a>
          </div>
          <div id="third_help" class="help-inshaka" title="<span class='title-help'><?= lang('tooltip_edit_professional_info') ?></span>
            <div class='content-help'>
            <?= lang('tooltip_content_edit_professional_info') ?>
            <button class='bot-logout' data-next-help='#fourth_help' style='border: 0px;' onclick='disparador($(this));'><?= lang('next_tooltip_button') ?></button>
            </div>" 
            style="float:right; margin-right: 20px; margin-top: -1px;">
          </div>
        <?php endif; ?>
        <?php if ($datos->is_band) : ?>
          <span class="titDestacados"><?php echo $datos->band_name ?></span><br>
        <?php else : ?>
          <span class="titDestacados"><?php echo $datos->username ?></span><br>
          <span class="subDestacados"><?php echo $datos->first_name, ' ', $datos->last_name ?></span>
        <?php endif; ?>
      </div>
      <div class="txLista">
        <span class="tLista">Edad: <b><?php echo calculate_years_old($datos->birthday) ?></b></span><br>
      </div>
      <div class="txLista">
        <?php if ($datos->talent->exists()) : ?>
          <span class="tLista">Talentos:</span><br><br>
          <span class="pLista">
            <?php foreach ($datos->talent as $talent) : ?>
              <div><?php echo $talent->talents_category->name, ': ', $talent->name ?></div><br>
            <?php endforeach; ?>
          </span>
        <?php endif; ?>
      </div>
      <div class="txLista">
        <span class="tLista">Años de experiencia: <b><?php echo $datos->users_personal_info->anos_experiencia ?></b></span><br>
      </div>
      <div class="txLista">
        <span class="tLista">No. de conciertos: <b><?php echo $datos->users_personal_info->numero_conciertos ?></b></span><br>
      </div>
	   <div class="txLista">
        <span class="tLista">Influencias: <b><?php echo $datos->users_personal_info->influencias ?></b></span><br>
      </div>
      <div class="txLista">
        <span class="tLista">
          <?php if ($datos->users_personal_info->musico_sesion) : ?>
            Músico de sesión <br>
          <?php endif; ?>
          <?php if ($datos->users_personal_info->necesitas_band) : ?>
            Busco band
          <?php endif; ?>
        </span>
      </div>
      <div class="txLista">
        <?php if ($datos->musical_gender->exists()) : ?>
          <span class="tLista">Género(s):
            <?php foreach ($datos->musical_gender as $musical_gender) : ?>
              <strong><?php echo $musical_gender->name . (next($datos->musical_gender) == true ? ',' : null) ?></strong>
            <?php endforeach; ?>
          <?php endif; ?>
      </div>	
    </div>
    <?php endif; ?>
    <div class="clear"></div>
        <!-- Shows -->
    <?php if(!$datos->is_proveedor) : ?>
    <div class="perfil-extra-iz">
      <div class="regis-tit">Shows</div>
      <?php if ($is_owner_usuario): ?>
        <div class="conBtMas ver-campos-show">
          <div id="txBtMas">
            <a>
              <span class="verMas ">Agregar show</span>
            </a>
          </div>
          <a href="#">
            <div id="imgBtMas"></div>
          </a>
        </div>
        <div id='fifth_help' class="help-inshaka" title="<span class='title-help'><?= lang('tooltip_add_show') ?></span>
          <div class='content-help'>
          <?= lang('tooltip_content_add_show') ?>
          <button class='bot-logout' data-next-help='#sixth_help' style='border: 0px;' onclick='disparador($(this));'><?= lang('next_tooltip_button') ?></button>
          </div>" 
          style="float:right; margin-right: 158px; margin-top: -26px;">
        </div>
        <div class="campos-show" style="display:none;">
          <form id="add-shows-form" action="<?php echo site_url('perfil/ajax/save_show') ?>">

            <div class="messages" style="display:none;"></div>

            <div class="calendar">
              <div class="calendar-tit">Fechas próximos toques</div>
              <input name="date" type="text" id="basic_example_1" class="date-picker campo" placeholder="Fecha y hora del show">
            </div>

            <div class="selectBox"  id="select-largo2">

              <input name="place" type="text" class="campo" placeholder="Lugar del show"  />
            </div>
            <div class="selectBox"  id="select-largo2">

              <input name="adress" type="text" class="campo" placeholder="Dirección del show"  />
            </div>

            <div class="selectBox" id="select-largo2">
              <div class="ui-widget">
                <input name="city" type="text" id="city" class="campo" placeholder="Ciudad"/>
              </div>
            </div>
            <div class="clear"></div>
            <input class="bot-aceptar" type="submit" value="Enviar">
          </form><!-- // Formulario para agregar shows -->
        </div>
      <?php endif; ?>
      <div class="clear"></div>
      <div id="shows-list" data-load-url="<?php echo site_url('perfil/' . $datos->inshaka_url . '/load_shows') ?>" style="width: 280px;">
        <p><small>Cargando shows...</small></p>
      </div>
    </div>
    <?php endif; ?>
    <!-- Fin shows -->
    <!-- Comentarios -->
    <div class="clear"></div>
    <div class="perfil-extra-de">
      <div class="regis-tit">Comentarios</div>
      <?php if ($is_owner_usuario): ?>
      <div id='sixth_help' class="help-inshaka" title="<span class='title-help'><?= lang('tooltip_comments') ?></span>
          <div class='content-help'>
          <?= lang('tooltip_content_comments') ?>
          <a id='close-help' class='bot-logout' href='#help-modal'><?= lang('close_tooltip_button') ?></a>
          </div>" 
          style="float:right; margin-right: 156px; margin-top: -29px;">
     </div>
      <?php endif; ?>
      <?php if($is_usuario) : ?>
        <?php if (!$is_owner_usuario): ?>
          <a class="form-m" href="#rating-cont">
            <div class="bot-acc2">Rating</div></a>
          <div class="clear"></div>
        <?php endif; ?>
      <?php endif; ?>
      <?php if ($datos->comment->exists()): ?>
        <div class="coment-cont" id="scroll20" style="width: 280px; <?php echo !$datos->is_proveedor ? '' : 'height: 260px !important; margin-bottom: 50px;' ?>">
          <div class="coment-list" style="width: 250px;">
            <ul>
              <?php foreach ($datos->comment as $comment): ?>
                <?php $date = fecha_spanish($comment->created_on); ?>
                <li style="min-height: 35px;">
                  <?php echo $comment->comentario ?>
                  <div class="clear"></div>
                  <div style="padding-top:10px;">
                    <?php if($comment->get_rating($comment->id) <= 2 && $comment->get_rating($comment->id) >= 1 ) : ?> 
                    <img src="images/star.png">
                    <img src="images/star-disabled.png">
                    <img src="images/star-disabled.png">
                    <img src="images/star-disabled.png">
                    <img src="images/star-disabled.png">
                    <?php elseif($comment->get_rating($comment->id) <= 4 && $comment->get_rating($comment->id) > 2 ) :?>
                    <img src="images/star.png">
                    <img src="images/star.png">
                    <img src="images/star-disabled.png">
                    <img src="images/star-disabled.png">
                    <img src="images/star-disabled.png">
                    <?php elseif($comment->get_rating($comment->id) <= 6 && $comment->get_rating($comment->id) > 4 ) :?>
                    <img src="images/star.png">
                    <img src="images/star.png">
                    <img src="images/star.png">
                    <img src="images/star-disabled.png">
                    <img src="images/star-disabled.png">
                    <?php elseif($comment->get_rating($comment->id) <= 8 && $comment->get_rating($comment->id) > 6 ) :?>
                    <img src="images/star.png">
                    <img src="images/star.png">
                    <img src="images/star.png">
                    <img src="images/star.png">
                    <img src="images/star-disabled.png">
                    <?php elseif($comment->get_rating($comment->id) <= 10 && $comment->get_rating($comment->id) > 8 ) :?>
                    <img src="images/star.png">
                    <img src="images/star.png">
                    <img src="images/star.png">
                    <img src="images/star.png">
                    <img src="images/star.png">
                    <?php endif; ?>
                  </div>
                  <div class="clear"></div>
                  <div style="padding-top: 4px;">
                    <div class="show-txt" style="color:#E82E7C; font-size: 11px;">
                      Publicado por:<a href="<?= site_url('perfil/'.$comment->get_id_user_comment($comment->user_creator_id)->inshaka_url) ?>" target="_blank"> <?php echo $comment->get_id_user_comment($comment->user_creator_id)->username ?></a>
                      <?php echo ', '.$date['dia'].'-'.$date['mes_short'].'-'.$date['año'].' : '. $date['hora'] ?>
                    </div>
                  </div>
                  
                </li>
              <?php endforeach; ?>
            </ul>
          </div>
        </div>
      <?php endif; ?>
    </div>
    <!-- Fin comentarios -->
  </div>
  <!-- Contenido del lado derecho -->
  <div class="perfil-cont-de">
    <!-- Nombre del proveedor o músico -->
    <?php if(!$datos->is_proveedor) : ?>
      <div class="usuario-tit"><?php echo $datos->is_band ? $datos->band_name : $datos->first_name.' '.$datos->last_name ?></div>
    <?php else: ?>
      <?php if ($is_owner_usuario): ?>
      <a id="pub_directorio" class="bot-rosa2 cambia-cont" style="float: right; <?php $datos->directorio->exists() ? "display:none" : null ?>" href="#publicar">Publicar en directorio</a>
      <?php endif; ?>
      <div class="usuario-tit"><?php echo $datos->name_proveedor ?></div>
    <?php endif; ?>
    <!-- Formulario de status -->
    <div class="usuario-subtit close-form" style="position:relative;">
      <div class="edit-profile-status" data-profile-status="inline"></div>
      <span id="profile-status">
        <?php if (!empty($datos->status)) : ?>
          <?php echo $datos->status ?>
        <?php else: ?>
          <?php if ($is_owner_usuario) : ?>
            Escribe tu “status” aca.       
          <?php endif; ?>
        <?php endif; ?>
      </span>
      <?php if ($is_owner_usuario) : ?>
        <?php echo form_open('perfil/ajax/update_status', 'id="profile-status-form" style="display:none;"') ?> 
        <div>
          <?php echo form_textarea(array('name' => 'status', 'required' => 'required', 'maxlength' => 200)) ?>
          <input class="btn-primary" type="submit" value="Actualizar" />
          <a class="cancel" href="#">Cancelar</a>
        </div>
        <?php echo form_close() ?>
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
        </script>
      <?php endif; ?>
    </div>
    <!-- Biografía del usuario -->
    <div class="usaurio-desc"><?php echo $datos->bio ?></div>
    <!-- Bloque de integrantes-banda o banda-músico -->
    <?php if(!$datos->is_proveedor && !$datos->is_band) : ?>
      <?php if($datos->band->exists()) : ?>
      <div class="clr"></div>
      <div class="regis-tit">Mis bandas</div>
      <div class="clr"></div>
      <div id="scroll-band-int" style="height: 160px;">
        <div class="band-int" >
          <?php foreach ($datos->band->all as $my_bands) : ?>
          <a href="<?= site_url('perfil/pagina/'.$my_bands->var) ?>" target="_blank">
          <div class="banda">
            <span style="float:left; width: 100%; text-align: center;"><?= $my_bands->name ?></span>
            <?php $profile_band = $my_bands->page->pages_photo->get_by_profile_active(true) ?>
            <?php if($profile_band->exists()) : ?>
            <img src="<?= uploads_url($profile_band->thumb) ?>" width="60" height="60"/>
            <?php else : ?>
            <img src="images/imagensino.png" width="60" height="60"/>
            <?php endif; ?>
            <div class="clr"></div>
            <div class="generos" style="clear: both; float: left; font-size: 16px; width: 100%; text-align: center; color: #E82E7C;">
              <?php 
                $genero_uno = $my_bands->sub_uno_musical_gender_id ? $genero_banda->get_by_id($my_bands->sub_uno_musical_gender_id)->name : null; 
                $genero_dos = $my_bands->sub_dos_musical_gender_id ? $genero_banda->get_by_id($my_bands->sub_dos_musical_gender_id)->name : null;
              ?>
              <?= $my_bands->musical_gender->name, $genero_uno ? ', '.$genero_uno : null, $genero_dos ? ', '.$genero_dos : null ?>
            </div>
          </div>
          </a>
          <?php endforeach; ?>
        </div>
      </div>
      <?php endif; ?>
    <?php endif; ?>
    <!-- Fin integrantes - banda -->
    <div class="clr"></div>

    <!-- Inicio div de fotografias para proveedores -->
      <?php if($datos->is_proveedor) : ?>
        <?php if ($datos->users_photo->exists()) : ?>
          <div class="regis-tit">Fotos</div>
          <div class="clr"></div>
          <div class="album-cont">
            <div id="contenu">
              <div class="albumes">
                <?php foreach ($datos->users_photo as $user_photo) : ?>
                  <div class="album">
                    <a href="<?php echo site_url('perfil/actions/remove_users_photo/' . $user_photo->id.'?next=' . uri_string()) ?>" class="b_cerrar" style="display: none;margin-left: 170px;margin-right: 0;margin-top: -9px;position: absolute;z-index: 9999;"></a>
                    <a class="group" href="<?php echo uploads_url($user_photo->image) ?>" rel="fancy-gallery">
                      <img src="<?php echo uploads_url($user_photo->thumb) ?>" height="233"/>
                      <div class="mas" style="margin-left: 136px;margin-top: -47px;"><img src="<?php echo base_url('assets/images/mas.png') ?>" /></div>
                    </a>
                  </div>
                <?php endforeach; ?>
                <div class="clr"></div>
              </div>
            </div>
          </div>
      <?php endif; ?>
    <?php endif; ?>
    <!-- Fin fotografias -->
    <!-- Listado de canciones -->
    <?php if(!$datos->is_proveedor) : ?>
      <div class="regis-tit">Canciones</div>
      <?php if ($is_owner_usuario): ?>
        <div class="conBtMas agrCancion">
          <div id="txBtMas">
            <a style="float: right;"><span class="verMas ">Agregar canción</span></a>
          </div>
          <a href="#"><div id="imgBtMas"></div></a>
        </div>
        <div id='fourth_help' class="help-inshaka" title="<span class='title-help'><?= lang('tooltip_add_songs') ?></span>
          <div class='content-help'>
          <?= lang('tooltip_content_add_songs') ?>
          <button class='bot-logout' data-next-help='#fifth_help' style='border: 0px;' onclick='disparador($(this));'><?= lang('next_tooltip_button') ?></button>
          </div>" 
          style="float:right; margin-right: 158px; margin-top: -55px;">
        </div>
        <div class="cancionesInputBox" id="agrCancion" style="float: left;margin-top: -21px; display: none">
          <form id="save-song-url-form" action="<?php echo site_url('perfil/ajax/save_song_url') ?>">
            <small style="float:left; font-size:.8em; margin-top:.6em;margin-right: 32px;">URL de la canción en Soundcloud.com: </small><input name="url" type="url" class="campo" placeholder="Ej: http://soundcloud.com/user/song"  required="required" />
            <input class="bot-aceptar" type="submit" value="Guardar">
            <div class="bot-aceptar" onclick="$('#agrCancion').hide()" style="width: 77px; padding-top: 4px; height: 23px; cursor: pointer;">Cancelar</div>
          </form>
        </div>
      <?php endif; ?>
    <div class="clear"></div>
    <div id="songs-url-list" class="can-cont scroll22 no-result" >
      <p>Ninguna canción agregada.</p>
    </div>
    <div class="conBtMas" style="margin-top: -10px; width: 120px;">
      <div id="txBtMas" style="width: 90px;"><a class="more-songs" href="#list-songs"><span class="verMas">Más canciones</span></a></div>
      <a class="more-songs" href="#list-songs"><div id="imgBtMas"></div></a>
    </div>
    <div id="list-songs" style="display: none; width: 660px;"></div>
    <?php endif; ?>
    <div class="clear"></div>
    
    <!-- Bloque de videos -->
    <?php if($datos->users_video->exists()) : ?>
    <div class="regis-tit">Videos</div>
    <div class="clr"></div>
    <div class="album-cont">
        <div id="contenu">
            <div class="albumes">
                <?php foreach ($datos->users_video as $user_video) : $user_video->get_oembed() ?>
                    <div class="album">
                        <a href="<?php echo site_url('perfil/actions/remove_users_video/' . $user_video->id . '?next=' . uri_string()) ?>" class="b_cerrar" style="display: none;margin-left: 170px;margin-right: 0;margin-top: -9px;position: absolute;z-index: 9999;"></a>
                        <a class="group iframe" href="<?php echo $user_video->oembed->url ?>" rel="fancy-gallery-iframe">
                            <img src="<?php echo $user_video->oembed->thumbnail_url ?>" />
                            <div class="mas" style=" margin-left: 136px; margin-top: -45px;"><img src="images/mas.png" /></div>
                        </a>

                    </div>
                <?php endforeach; ?>
                <div class="clr"></div>
            </div>
        </div>
    </div>
    <?php endif; ?>
    <div class="clr"></div>
    
    <!-- Bloque de posts -->
    <div class="perfil-extra-iz" style="width: 98%;">
      <div class="regis-tit">Mis Posts</div>
      <div id="posts-list" data-load-url="<?php echo site_url('perfil/' . $datos->inshaka_url . '/load_posts') ?>">
        <p><small>Cargando posts...</small></p>
      </div>
      <div id="last_msg_loader" style="margin: 28px 230px;"></div>
    </div>
    <!-- Fin bloque de posts -->
    <div class="clr"></div>
  </div>
  <div class="clr"></div>
</div>

<!-- 
-------- Modales y cuadros de diálogos ------------ 
-->
<!-- Cuadros de diálogo -->
<div id="follow-him-her" title="Seguir" style="display:none">
  <p>
    <?php if(!$datos->is_proveedor) : ?>
    Estás seguro que deseas seguir a este usuario?
    <?php else : ?>
    Estás seguro que deseas seguir a este proveedor, y agregarlo a tus favoritos?
    <?php endif; ?>
  </p>
</div>
<div id="follow-her-him" title="Dejar de Seguir" style="display:none">
  <p>
    Estás seguro que deseas dejar de seguir a este usuario?
  </p>
</div>
<div id="delete-song-confirm" title="Eliminar canción de soundcloud" style="display:none;">
  <p>¿Estás seguro que quieres eliminar la canción?</p>
</div>
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

<!-- Show delete dialog -->
<div id="shows-delete-dialog" style="display:none;">
  <p>Test</p>
</div>

<!-- Formulario modal para contactar un usuario -->
<div id="contactar-cont" style="display:none;">
  <div class="mensaje-tit">Mensaje directo</div>
  <div id="success-message"></div>
  <div class="form-usuario">
    <div class="form-foto">
      <?= form_open(site_url("perfil/mensajes/response_message"), "id='direct-message' data-id='".$datos->id."'") ?>
        <textarea id="message" name="message" class="area-msg" placeholder="Escribele un mensaje a este usuario en este espacio..."></textarea>
        <input class="bot-enviar" type="submit" value="enviar">
      <?= form_close() ?>
      <div class="clr"></div>
    </div>
  </div>
</div>

<!-- Formulario modal para el rating de un usuario -->
<div id="rating-cont" class="rating-cont" style="display:none;">
  <?php echo form_open(site_url("perfil/ajax/create_comment"), 'id="create-comment-form"', array('ui' => base64_encode($datos->id))) ?>

    <div class="mensaje-tit">Rating</div>
    <div class="rating-txt">Conoces a este artista? Que piensas de él? Lo has visto tocar en Vivo? Dale un Rating o déjale un comentario!</div>

    <div class="clear"></div>
    <div class="rating-list">

      <div class="rating-valor">
        <div class="rating-nom">Sonido: <span class="rating-dato">0</span></div>
        <div class="clear"></div>
        <div class="slider"></div>
        <input name="sonido" type="hidden" value="0" />

        <div class="clear"></div>
      </div>

      <div class="rating-valor">
        <div class="rating-nom">Presentación: <span class="rating-dato">0</span></div>
        <div class="clear"></div>
        <div class="slider"></div>
        <input name="presentacion" type="hidden" value="0" />

        <div class="clear"></div>
      </div>

      <div class="rating-valor">
        <div class="rating-nom">Profesionalismo: <span class="rating-dato">0</span></div>
        <div class="clear"></div>
        <div class="slider"></div>
        <input name="profesionalismo" type="hidden" value="0" />

        <div class="clear"></div>
      </div>

      <div class="rating-valor">
        <div class="rating-nom">Actitud: <span class="rating-dato">0</span></div>
        <div class="clear"></div>
        <div class="slider"></div>
        <input name="actitud" type="hidden" value="0" />

        <div class="clear"></div>
      </div>
    </div>

    <div class="form-usuario">
      <div class="form-top">
        <div class="form-campos">
          <textarea name="comentario" class="area-msg" placeholder="Escribe aquí tu comentario..."></textarea>
        </div>
        <div class="clr"></div>
        <div class="messages"></div>
        <div class="lista-check2">
          <input id="btn-send-comment" class="bot-enviar" type="submit" value="enviar">
        </div>
        <div class="clr"></div>
      </div>
    </div>
  <?php echo form_close() ?>
</div>

<!-- Modal de fans -->
<div id="fans-cont" style="display:none">
  <div class="regis-tit" style="margin-bottom: 30px;">Fans de <?= $datos->first_name." ".$datos->last_name ?></div>
  <?php $mis_fans = $follow->where(array('user_follow_id' => $datos->id, 'allow_follow' => true))->get() ?>
  <?php if($mis_fans->exists()) : ?>
    <?php foreach ($mis_fans as $fans) : ?>
      <a href="<?= site_url('perfil/'.$fans->user->inshaka_url) ?>" target="_blank">
      <div style="clear: both; width: 370px; height: 45px; background-color: #F5F5F5; border: 1px solid #999; border-radius: 7px; -webkit-border-radius: 7px; padding: 10px 20px; margin-top: 5px;">
        <div style="float: left">
          <?php $fans->user->users_photo->where(array('user_id' => $fans->user_id, 'profile_active' => true))->get(); ?>
          <?php if ($fans->user->users_photo->exists()) : ?>
            <img  src="<?php echo uploads_url($fans->user->users_photo->get_photo($fans->user->id)) ?>" style="width: 50px; height: 51px;" />
          <?php else :?>
            <img  src="images/imagensino.png" style="width: 50px; height: 51px;" />
          <?php endif; ?>
        </div>
        <div style="float: left; margin-left: 7px; width: 313px;">
          <span class="genero"><?= $fans->user->first_name." ".$fans->user->last_name ?></span><br>
          <p style="color: #666; text-align: justify; font-size: 0.75em;"><?=  strlen($fans->user->bio) > 100 ? substr($fans->user->bio, 0, 100)."..." : $fans->user->bio ?></p>
        </div>
      </div>
      </a>
    <?php endforeach; ?>
  <?php endif; ?>
</div>
<!-- Formulario crear directorio -->
<div id="publicar" style="display: none">
  <div class="regis-tit" style="margin-bottom: 30px;">Publicar en directorio</div>
  <div class="clr"></div>
  <div class="clr"></div>
  <?= form_open('perfil/ajax/save_directorio', 'id="form_directorio" style="width: 785px;"', array('user_id' => $datos->id) ) ?>
  <div id="perfil_empresa" style="width: 100%; height: 160px;">
    <div id="img_empresa" style="float:left; height: 150px; overflow: hidden;">
      <div class="form-foto"> 
        <?php if ($profile_photo->get_photo($datos->id) == "") : ?>
        <img src="images/imagensino.png" width="150px" />
        <?php else :?>            
        <img src="<?php echo uploads_url($profile_photo->get_photo($datos->id)) ?>"  width="150px" />
        <input name="logo_provider" value="<?= $profile_photo->get_photo($datos->id) ?>" style="display:none" > 
        <?php endif; ?>
      </div><br><br>
    </div>
    <div id="campos_empresa" style="float:left; margin-left: 16px; width: 600px;">
      <div class="campo-reg-lab">
        <label style="padding-left: 4px;">Nombre empresa</label>
        <input name="empresa_provider" id="empresa_provider" class="campo3" value="<?php echo (!empty($datos->name_proveedor) ? $datos->name_proveedor : null) ?>" disabled="disabled" />
      </div>
      <div class="clr"></div>
      <div class="campo-reg-lab">
        <label style="padding-left: 4px;">Categoria</label>
        <input name="directorio_categoria" id="categoria" class="campo3" value="<?php echo (!empty($datos->id_categoria_proveedor) ? $categoria_provider->get_cat_provider($datos->id_categoria_proveedor) : null) ?>" disabled="disabled"/>
      </div>
      <div class="clr"></div>
      <div class="campo-reg-lab">
        <label style="padding-left: 4px;">Dirección empresa</label>
        <input name="direccion_empresa" id="direccion_empresa" class="campo3" value="<?php echo (!empty($datos->adress_provider) ? $datos->adress_provider : null) ?>"  />
      </div>
      <div class="campo-reg-lab" style="margin-left: 71px; width: 170px;">
        <label style="padding-left: 4px;">Teléfono empresa</label>
        <div class="clr"></div>
        <input name="phone_provider" id="phone_provider" class="campo2" value="<?php echo (!empty($datos->users_personal_info->phone_provider) ? $datos->users_personal_info->phone_provider : null) ?>"  />
      </div>
    </div>
  </div>
  <div class="clr"></div> 
  <div class="campo-reg-lab">
    <label style="padding-left: 4px;">E-mail</label>
    <input name="email_provider" id="email_provider" value="<?php echo (!empty($datos->email) ? $datos->email : null) ?>" class="campo3" />
  </div>
  <div class="clr"></div> 
  <div class="campo-reg-lab">
    <label style="padding-left: 4px;">Sitio web</label>
    <input name="sitio_web" id="sitio_web" class="campo3" value="<?php echo (!empty($datos->users_personal_info->sitio_web) ? $datos->users_personal_info->sitio_web : null) ?>"  />
  </div>
  <div class="campo-reg-lab" style="margin-left: 75px;">
    <label style="padding-left: 4px;">Facebook</label>
    <div class="clr"></div>
    <input name="facebook_provider" id="facebook_provider" class="campo3" placeholder="http://www.facebook.com/usuario" value="<?php echo (!empty($datos->users_personal_info->social_facebook) ? $datos->users_personal_info->social_facebook : null) ?>" />
  </div>
  <div class="clr"></div>
  <div class="campo-reg-lab">
    <label style="padding-left: 4px;">Twitter</label>
    <div class="clr"></div>
    <input name="twitter_provider" id="twitter_provider" class="campo3" placeholder="http://www.twitter.com/usuario" value="<?php echo (!empty($datos->users_personal_info->social_twitter) ? $datos->users_personal_info->social_twitter : null) ?>"  />
  </div>
  <div class="campo-reg-lab" style="margin-left: 75px;">
    <label style="padding-left: 4px;">YouTube</label>
    <div class="clr"></div>
    <input name="youtube_provider" id="youtube_provider" class="campo3" placeholder="http://www.youtube.com/usuario" value="<?php echo (!empty($datos->users_personal_info->social_youtube) ? $datos->users_personal_info->social_youtube : null) ?>"  />
  </div>
  <div class="clr"></div>
  <div class="campo-reg-lab">
    <label style="padding-left: 4px;">Descripción</label>
    <textarea class="area-cont2" name="description_provider" placeholder="Quienes somos..." style="width:768px; float: none" ><?php echo $datos->bio ?></textarea>
  </div>
  <div class="clr"></div>
  <input type="submit" id="btn_directorio" class="bot-aceptar" value="Publicar" style="margin-right: 12px; margin-top: 15px;"/>
  <?= form_close(); ?>
</div>
<!-- Fin formulario directorio -->
<div id="help-modal" style="display:none; width: 520px; height: 140px;">
  <div class="mensaje-tit">Primeros pasos</div>
  <div class="clr"></div>
  <div style="font-family: 'BebasNeueRegular'; color: #585858; font-size: 18px; text-align: justify; width: 510px; line-height: 27px;">
En la mayoría de las páginas de InShaka.Com, vas a encontrar unos signos de pregunta como este: (<span style="width: 20px; height: 20px; color: transparent" class="help-inshaka">hel</span>).Si haces clic sobre este icono, se desplegará una pequeña ventana con información sobre lo que puedes hacer en esa sección de Inshaka.
  </div>
</div>