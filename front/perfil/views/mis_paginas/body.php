<script src="js/mishaka.js"></script>
<style>
  .bgSlider{
    display:none;
  }
  .login{
    display:none;
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
</style>
<div class="perfil-cont" style="height: auto; min-height: 1340px">
  <div class="perfil-cont-iz">
    
    <!-- Botón de editar y tooltip de ayuda -->
    <?php if ($is_owner): ?>
      <div class="lapiz2" style="margin-top: 50px;">
        <a href="<?php echo site_url('perfil/editar/informacion_personal_page/'.$datos->var) ?>">
          <img src="images/editar.png" />
        </a>
      </div>
      <div class="help-inshaka" title="<span class='title-help'>Editar información personal</span>
          <div class='content-help'>
          <p>Haz click acá para editar tu información personal como:</p><br>
          <p>Ubicación<br>Teléfono<br>Biografía</p>
          </div>" 
          style="float:right; margin-right: -10px; margin-top: 21px; ">
     </div>
    <?php endif; ?>
    <!-- Fin botón de editar y tooltip de ayuda -->
    
    <!-- Género musical -->
    <?php if ($datos->band->musical_gender->exists()) : ?>
      <div class="genero">
        <b>Género(s):</b> 
        <?php foreach ($datos->band->musical_gender as $musical_gender) : ?>
          <?php echo $musical_gender->name, ($sub_one_musical_gender ? ', '.$sub_one_musical_gender : null), ($sub_two_musical_gender ? ', '.$sub_two_musical_gender : null) ?>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>
    <!-- Fin género musical -->
    
    <!-- Imágen de perfil -->
    <div class="foto-banda">
      <?php if ($datos->pages_photo->get_photo($datos->id)) : ?>
        <img  src="<?php echo uploads_url($datos->pages_photo->get_photo($datos->id)) ?>" width="250" />
      <?php else : ?>
        <img  src="images/imagensino.png" width="250" />
        <?php endif; ?>
    </div>
    <!-- Fin imágen de perfil -->
    
    <!-- Like de facebook y rating -->
    <div style="float:left; margin-top:1.5em;">
      <div class="fb-like" data-send="false" data-layout="button_count" data-width="100" data-show-faces="false"></div>
    </div>
    <div class="rating">
      <?php echo $datos->get_rating(); ?>
    </div>
    <!-- Fin like de facebook y rating -->
    
    <div class="clear"></div>
    
    <!-- Botones de contactar, rating y favoritos -->
    <?php if (!$is_owner): ?>
      <div class="bot-acciones">
        <a href="#contactar-cont" class="contactar-m"><div class="bot-acc2">Contactar</div></a>
        <a href="#contratar-cont" class="contratar-m"><div class="bot-acc2">Contratar</div></a>
        <a href="#rating-cont" class="valorar-m"><div class="bot-acc2">Rating</div></a>
        <div class="clear"></div>
      </div>
    <?php endif; ?>
    <!-- Fin botones de contactar, rating y favoritos -->
    
    <!-- Datos de información personal -->
    <div class="genero"><b>Experiencia:</b> Sin definir</div>
    <div class="genero"><b>Genero Principal:</b> <?= $datos->band->musical_gender ? $datos->band->musical_gender->name : 'Sin definir' ?></div>
      <div class="genero"><b>Subgenero uno:</b> <?= $sub_one_musical_gender ? $sub_one_musical_gender : 'Sin definir' ?></div>
      <div class="genero"><b>Subgenero dos:</b> <?= $sub_two_musical_gender ? $sub_two_musical_gender : 'Sin definir' ?></div>
    <!-- Fin datos de información personal -->
    
    <!-- Links de contacto -->
    <div class="link-perfil">
      <div class="link-perfil-tit">Links de contacto</div>
      <div class="link-perfil-icos">
        <ul>
          <?php if (!empty($datos->pages_info->social_facebook)) : ?>
            <li>
              <a href="<?php echo $datos->pages_info->social_facebook ?>" target="_blank" class="ico-perfil1"></a>
            </li>
          <?php endif; ?>
          <?php if (!empty($datos->pages_info->social_twitter)) : ?>
            <li>
              <a href="<?php echo $datos->pages_info->social_twitter ?>" target="_blank"  class="ico-perfil2"></a>
            </li>
          <?php endif; ?>
          <?php if (!empty($datos->pages_info->social_youtube)) : ?>
            <li>
              <a href="<?php echo$datos->pages_info->social_youtube ?>" target="_blank" class="ico-perfil3"></a>
            </li>
          <?php endif; ?>
          <li> <?php echo mailto($datos->pages_info->email, ' ', array('class' => 'ico-perfil6')); ?> </li>
          <div class="clr"></div>
        </ul>
      </div>
    </div>
    <!-- Fin links de contacto -->
    
    <!-- Album de fotografias y videos -->
    <div class="regis-tit" id="misAlbumes">Mis Álbumes</div>
    
    <!-- Botón de editar y tooltip de ayuda -->
    <?php if ($is_owner): ?>
      <div class="lapiz3" style="display: none; ">
         <a href="#">
           <img src="images/editar.png" />
         </a>
      </div>
      <div class="help-inshaka" title="<span class='title-help'>Editar Fotos y Videos</span>
        <div class='content-help'>
        <p>Haz click acá para subir tus fotos y videos</p>
        </div>" 
        style="float:right; margin-right: 20px; margin-top: -29px;">
      </div>
    <?php endif; ?>
    <!-- Fin botón de editar y tooltip de ayuda -->
    
    <!-- Albúm de fotos -->
    <?php if ($datos->pages_photo->exists()): ?>
      <div class="thumb-album">
        <div class="regis-subtit">Fotos</div>
        <a href="<?= site_url('perfil/'.$datos->var.'/fotos_page') ?>">
          <div class="thumb-album-img">
            <div class="mas"><img src="images/mas.png" /></div>
            <img src="<?php echo uploads_url($datos->pages_photo->thumb) ?>" height="86px" width="115" />
          </div>
        </a>
      </div>
    <?php else : ?>
      <div class="thumb-album">
        <div class="regis-subtit">Fotos</div>
        <a href="<?= site_url('perfil/'.$datos->var.'/fotos_page') ?>">
          <div class="thumb-album-img">
            <div class="mas"><img src="images/mas.png" /></div>
            <img src="images/imagensino.png" height="101px" width="115" />
          </div>
        </a>
      </div>
    <?php endif; ?>
    <!-- Fin álbum de fotos -->
    
    <!-- Álbum de videos -->
    <?php if ($datos->pages_video->exists()): $datos->pages_video->get_oembed(); ?>

      <div class="thumb-album">
        <div class="regis-subtit">Videos</div>
        <a href="<?= site_url('perfil/'.$datos->var.'/videos_page') ?>">
          <div class="thumb-album-img">
            <div class="mas"><img src="images/mas.png" /></div>
            <img src="<?php echo $datos->pages_video->oembed->thumbnail_url ?>"  width="115"/>

          </div>
        </a>
      </div>
    <?php else : ?>
      <div class="thumb-album">
        <div class="regis-subtit">Videos</div>
        <a href="<?= site_url('perfil/'.$datos->var.'/videos_page') ?>">
          <div class="thumb-album-img">
            <div class="mas"><img src="images/mas.png" /></div>
            <img src="images/imagensino.png"  width="115"/>

          </div>
        </a>
      </div>
    <?php endif; ?>
    <!-- Fin álbum de videos -->
    
    <!-- Fin álbum de fotografias y videos -->
    
    <!-- Información profesional -->
    <div class="conDestacadoPerfil">
      <div class="titColumnas">
        <?php if ($is_owner): ?>
        <div class="lapiz4" style="display: none; margin-top: 42px;">
          <a href="<?php echo site_url('perfil/editar/informacion_profesional_page/'.$datos->var) ?>">
            <img src="images/editar.png" />
          </a>
        </div>
        <div class="help-inshaka" title="<span class='title-help'>Editar información profesional</span>
          <div class='content-help'>
          <p>Haz click acá para editar tu información profesional como:</p><br>
          <p>
            <table border='0'>
              <tr>
                <td width='160px'>Nivel de experiencia</td>
                <td width='160px'>Influencias</td>
              </tr>
              <tr>
                <td width='160px'>Años de experiencia</td>
                <td width='160px'>Links de contacto</td>
              </tr>
              <tr>
                <td width='160px'>Número de conciertos</td>
                <td width='160px'>Sitio web</td>
              </tr>
            </table>
          </p>
          </div>" 
          style="float:right; margin-right: 20px; margin-top: -1px;">
        </div>
        <?php endif; ?>
        <span class="titDestacados"><?php echo $datos->band->name ?></span><br>
      </div>
      <div class="txLista">
        <span class="tLista">Años de experiencia: <b><?php echo $datos->pages_info->anos_experiencia ?></b></span><br>
      </div>
      <div class="txLista">
        <span class="tLista">No. de conciertos: <b><?php echo $datos->pages_info->numero_concierto  ?></b></span><br>
      </div>
	   <div class="txLista">
        <span class="tLista">Influencias: <b><?php echo $datos->pages_info->influencias  ?></b></span><br>
      </div>
      <div class="txLista">
        <?php if ($datos->band->musical_gender->exists()) : ?>
          <span class="tLista">Género(s):
            <?php foreach ($datos->band->musical_gender as $musical_gender) : ?>
              <strong><?php echo $musical_gender->name . (next($datos->band->musical_gender) == true ? ',' : null) ?></strong>
            <?php endforeach; ?>
          <?php endif; ?>
      </div>	
    </div>
    <div class="clear"></div>
    <!-- Fin información profesional -->    
  </div>
  
  <div class="perfil-cont-de">
    <div class="usuario-tit">
      <?php echo $datos->band->name ?>
    </div>
    
    <!-- Status -->
    <div class="usuario-subtit close-form" style="position:relative;">
      <div class="edit-profile-status" data-profile-status="inline"></div>
      <span id="profile-status">
        <?php if (!empty($datos->status)) : ?>
          <?php echo $datos->status ?>
        <?php else: ?>
          <?php if ($is_owner) : ?>
            Escribe tu “status” aca.       
          <?php endif; ?>
        <?php endif; ?>
      </span>
      <?php if ($is_owner) : ?>
        <?php echo form_open('perfil/ajax/update_status_page', 'id="profile-status-form" style="display:none;"', array('id' => $datos->id)) ?> 
        <div>
          <?php echo form_textarea(array('name' => 'status', 'required' => 'required', 'maxlength' => 100)) ?>
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
    <!-- Fin status -->
    
    <!-- Biografia -->
    <div class="usaurio-desc"><?php echo $datos->bio ?></div>
    <!-- Fin biografia -->
      
    <!-- Espacio para integrantes-banda o banda-músico -->
      <?php if($datos->band->bands_instrument->exists()) : ?>
      <div class="clr"></div>
      <div class="regis-tit">Integrantes</div>
      <div class="clr"></div>
      <div id="scroll-band-int" style="height: 150px; margin-bottom: 30px;">
        <div class="band-int" >
          <?php foreach ($datos->band->bands_instrument as $member) : ?>
            <?php if ($member->bands_instruments_user->invitation_accepted) : ?>
          <a href="<?php echo site_url(array('perfil', $member->bands_instruments_user->user->inshaka_url)) ?>" target="_blank">
            <div class="banda">
              <span style="float:left; width: 100%; text-align: center;">
                <?= $member->bands_instruments_user->user->first_name .' '.$member->bands_instruments_user->user->last_name ?>
              </span><div class="clr"></div>
              <?php if($member->bands_instruments_user->user->users_photo->get_by_profile_active(true)->exists()) : ?>
              <img src="<?php echo uploads_url($member->bands_instruments_user->user->users_photo->get_by_profile_active(true)->thumb) ?>" width="60" height="60"/>
              <?php else : ?>
              <img src="<?= front_asset("images/foto-perfil.png") ?>" width="60" height="60"/>
              <?php endif; ?>
              <div class="clr"></div>
              <div class="generos" style="clear: both;">
                <?php $user_instruments_on_band = $member->bands_instruments_user->user->get_instruments_on_band($datos->band->id); ?>
                <?php if ($user_instruments_on_band->exists()) : ?>
                <div class="m-exp" style="margin-top: 0; float: none;">
                  <?php 
                  $count = 1;
                  foreach ($user_instruments_on_band as $instrument_user) : 
                      ?>
                  <b>
                    <?php echo $instrument_user->bands_instrument->instrument->name, $count < $user_instruments_on_band->result_count() ? ',' : null ?>
                  </b>
                  <?php 
                  $count++;
                  endforeach; 
                  ?>
                </div>
                <?php endif; ?>
              </div>
            </div>
          </a>
            <?php endif; ?>
          <?php endforeach; ?>
        </div>
      </div>
      <style type="text/css">
        .banda {
          font-family: 'BebasNeueRegular';
          font-size: 1.1em;
          text-align: center;
          color: #666;
          width: 130px; 
          height: 125px; 
          float: left; 
          margin-right: 7px;
          padding: 7px;
          border: 3px solid #DEDEDE;
          border-radius: 10px;
          -moz-border-radius: 10px;
          -webkit-border-radius: 10px;
        }
      </style>
      <script type="text/javascript">
        $(function(){
          var numThumbs = $(".band-int div.banda").size();
          var thumbsWidth = $(".band-int div.banda").width();
          var marg_tot = numThumbs * 130;
          var widthBox = thumbsWidth * 2 + marg_tot;
          $(".band-int").width(widthBox);
          $('#scroll-band-int').jScrollPane();
        });
      </script>
      <?php endif; ?>
    <!-- Fin integrantes - banda -->
    
    <!-- Grilla de canciones -->
    <div class="regis-tit">Canciones</div>
    <?php if ($is_owner): ?>
      <div class="conBtMas agrCancion">
        <div id="txBtMas">
          <a style="float: right;">
            <span class="verMas ">Agregar canción</span>
          </a>
        </div>
        <a href="#">
          <div id="imgBtMas"></div>
        </a>
      </div>
      <div class="help-inshaka" title="<span class='title-help'>Agregar canciones</span>
        <div class='content-help'>
        <p>
        Pega acá el link a tu canción en soundcloud<br><br>
        <strong style='font-size:9px;'>Si no tienes cuenta en soundcloud, haz <a href='https://soundcloud.com/' target='_blank'><strong style='color: #E82E7C'>click acá</strong></a> para crear una.</strong>       
        </p>
        </div>" 
        style="float:right; margin-right: 158px; margin-top: -55px;">
      </div>
    
      <div class="cancionesInputBox" id="agrCancion" style="float: left;margin-top: -21px; display: none">
        <form id="save-song-url-form" action="<?php echo site_url('perfil/ajax/save_song_url_page/'.$datos->id) ?>">
          <small style="float:left; font-size:.8em; margin-top:.6em;margin-right: 32px;">URL de la canción en Soundcloud.com: </small><input name="url" type="url" class="campo" placeholder="Ej: http://soundcloud.com/user/song"  required="required" />
          <input class="bot-aceptar" type="submit" value="Guardar">
        </form>
      </div>

      <div id="delete-song-confirm" title="Eliminar canción de soundcloud" style="display:none;">
        <p>¿Estás seguro que quieres eliminar la canción?</p>
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
    <div class="clr"></div>
    <!-- Fin grilla de canciones -->
    
    <!-- Slider de videos -->
    <div class="regis-tit">Videos</div>
    <div class="clr"></div>
    <div class="album-cont">
      <div id="contenu">
        <div class="albumes">
          <?php foreach ($datos->pages_video as $user_video) : $user_video->get_oembed() ?>
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
    <!-- Fin slider de videos -->
    <div class="clear" ></div>
    
    <!-- Shows -->
    <div class="perfil-extra-iz">
      <div class="regis-tit">Shows</div>

      <div id="shows-list" data-load-url="<?php echo site_url('perfil/ajax/load_shows_page/'.$datos->var) ?>">
        <p><small>Cargando shows...</small></p>
      </div>

      <?php if ($is_owner): ?>
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
        <div class="help-inshaka" title="<span class='title-help'>Agregar Show</span>
          <div class='content-help'>
          <p>Haz click acá para agregar los próximos toques/show que tengas</p>
          </div>" 
          style="float:right; margin-right: 158px; margin-top: -26px;">
        </div>
        <div class="campos-show" style="display:none;">
          <form id="add-shows-form" action="<?php echo site_url('perfil/ajax/save_show_page') ?>">

            <div class="messages" style="display:none;"></div>

            <div class="calendar">
              <div class="calendar-tit">Fechas próximos toques</div>
              <input name="date" type="text" id="basic_example_1" class="date-picker campo" placeholder="Fecha y hora del show">
            </div>

            <div class="selectBox"  id="select-largo2">
              <input name="place" type="text" class="campo" placeholder="Lugar del show"  />
            </div>
            <div class="selectBox"  id="select-largo2">

              <input name="address" type="text" class="campo" placeholder="Dirección del show"  />
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
    </div>
    <!-- Fin shows -->
    
    <!-- Comentarios -->
    <div class="perfil-extra-de">
      <div class="regis-tit">Comentarios</div>
      <?php if ($is_owner): ?>
      <div class="help-inshaka" title="<span class='title-help'>Comentarios</span>
          <div class='content-help'>
          <p>Otros usuarios te pueden dejar mensajes y ponerte un rating de acuerdo a tu presentación en vivo, profesionalismo y más. Este rating se ve reflejado en el círculo abajo de tu imágen</p>
          </div>" 
          style="float:right; margin-right: 156px; margin-top: -29px;">
     </div>
      <?php endif; ?>
      <?php if (!$is_owner): ?>
        <a class="valorar-m" href="#rating-cont">
          <div class="bot-acc2">Rating</div></a>
        <div class="clear"></div>
      <?php endif; ?>


      <?php if ($datos->comment->exists()): ?>

        <div class="coment-cont" id="scroll20" style="min-height: 200px">
          <div class="coment-list">
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
                      Publicado por: <?php echo $comment->get_id_user_comment($comment->user_creator_id) ?>
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
    <div class="clear"></div>
    <!-- Fin comentarios -->
    
  </div>
</div>

<!-- Ventanas modal -->

<!-- Modal formulario de comentarios -->
<?php if (!$is_owner): ?>
<div id="rating-cont" class="rating-cont" style="display:none;">
<?php echo form_open('perfil/ajax/create_comment_page', 'id="create-comment-form"', array('ui' => base64_encode($datos->id))) ?>

  <div class="mensaje-tit">Rating</div>
  <div class="rating-txt">Conoces a esta banda? Que piensas de ellos? Lo has visto tocar en Vivo? Dale un Rating o déjale un comentario!</div>

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
        <input class="bot-enviar" type="submit" value="enviar">
      </div>
      <div class="clr"></div>
    </div>
  </div>
<?php echo form_close() ?>
</div>
<?php endif; ?>
<!-- Fin formulario comentarios -->

<!-- Modal formulario de contactar -->
<div id="contactar-cont" style="display:none">
  <div class="mensaje-tit">Contactar</div>
  <div class="form-usuario">
    <div class="form-top">
      <div class="form-foto"> 
      <?php if ($datos->pages_photo->exists()) { ?>
        <img  src="<?php echo uploads_url($datos->pages_photo->get_photo($datos->id)) ?>" width="225" />
      <?php } else { ?>
        <img  src="images/imagensino.png" width="225" />
        <?php }
      ?>
    <form action="<?php site_url("front/perfil/mis_paginas/submit") ?>" method="post" id="envios_form_os1">
      <div class="form-campos">        
        <div class="campo-msg_SZ" >De:</div>
        <input type="text" id="nombres" class="campo-msg" value="<?php echo $current_username ?>"  />
        <p style="line-height:10px">&nbsp;</p>
        <div class="campo-msg_SZ">Para:</div>
        <input type="text" class="campo-msg" value="<?php echo $datos->band->name ?>"  />
        <textarea id="textos" class="area-msg" placeholder="Escribele un mensaje a este usuario en este espacio..."></textarea>
      </div>
      <div class="clr"></div>     
	 <div class="lista-check2">
        <input class="bot-enviar"  id="envios_fi1" type="submit" value="enviar">		
      </div>	  
    </form>
    <div class="clr"></div>
  </div>
</div>
</div>

</div>
<!-- Fin formulario de contactar -->

<!-- Fin ventanas modal -->

<script>
  var songs_urls = <?php echo json_encode($datos->pages_song->get_songs_urls()) ?>;
</script>

<script defer src="<?php echo front_asset('js/perfil-usuario.js') ?>"></script>
<script type="text/javascript">
  $(function() {
    $('.contactar-m').fancybox();
    $('.valorar-m').fancybox();
    $(".slider").slider({
      range: "max",
      min: 0,
      max: 10,
      value: 0,
      slide: function(event, ui) {
        var parent = $(this).parent();
        return parent.find('input').val(ui.value).end().find('.rating-dato').text(ui.value);
      }
    });
    $(".more-songs").fancybox({
        'onClosed': function(){ 
            $('#songs-url-list').show('slow')
        }
    });
    
    var alto_show = ($('.conDestacadoPerfil').height() - 150);
          
    $('#scroll20').css('height', alto_show);
    $('#scroll20').jScrollPane();      
    $('#scroll22').jScrollPane();
    
    function log(message) {
      $("<div>").text(message).prependTo("#log");
      $("#log").scrollTop(0);
    }

    $("#city").autocomplete({
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
  });
</script>