<script>
    $(document).ready(function() {
        $(".album").hover(function(){
				
            $(".b_cerrar", this).css({
					
                'display':'block'	
            })
				
        },function(){
            $(".b_cerrar", this).css({
                'display':'none'	
            })
        })
    });
</script>

<div class="bgEncabezado2" >
    <div class="conEncabezado2">
        <div class="ico-seccion"><img src="images/ico-seccion1.png" /></div>
        <div id="txSeccion2">
            <div class="encabezado-tit2">Álbum de fotos de <?php echo $datos->username ?></div>
           
        </div>
    </div>
</div>




<div class="perfil-cont" >
    <div class="perfil-cont-iz2" id="perfil-cont-iz">
        <a class="bot-rosa2 cambia-cont" href="<?php echo site_url('perfil/'.$datos->inshaka_url) ?>" style="margin-left: 0;">Volver al perfil</a>
          <?php if ($is_owner_usuario) : ?>
          <a class="bot-rosa2 cambia-cont" href="<?php echo sprintf($urls->current_inshaka_url_format, 'videos') ?>">Editar album de videos</a>          
            
                <?php echo form_open(current_url(), 'id="form"') ?>
                <a id="pickfiles" class="bot-rosa2 cambia-cont" href="#">Agregar imagenes</a>
                <div class="clr"></div>
                <div id="filelist" class="filelist" ></div>
                <input style="display:none;" type="submit" class="btn-primary" value="Iniciar subida" />
                <?php echo form_close() ?>
             <div id="container" style="margin-bottom:2em;">
             
                <?php echo form_close() ?>
            </div>
            <div class="clr"></div>

        <?php endif; ?>
            <div class="clr"></div>
        <?php if ($datos->users_photo->exists()) : ?>

            <div class="album-cont">
              <div id="contenu">
                <div class="albumes">
                  <?php foreach ($datos->users_photo as $user_photo) : ?>
                  
                    <div class="album">
                      <?php if ($is_owner_usuario) : ?>
                      <a href="<?php echo site_url('perfil/actions/remove_users_photo/' . $user_photo->id.'?next=' . uri_string()) ?>" class="b_cerrar" style="display: none;margin-left: 170px;margin-right: 0;margin-top: -9px;position: absolute;z-index: 9999;"></a>
                      <?php endif; ?>
                      <a class="group" href="<?php echo uploads_url($user_photo->image) ?>" rel="fancy-gallery">
                          <img src="<?php echo uploads_url($user_photo->thumb) ?>" height="233"/>
                          <div class="mas" style="margin-left: 136px;margin-top: -47px;"><img src="images/mas.png" /></div>
                      </a>
                      <?php if ($is_owner_usuario) : ?>
                        <?php if(!$user_photo->profile_active) : ?>
                        <div class="lista-check2" style="position: absolute; clear: both; float: left; margin-left: 0px; ">
                          <input id="img-perfil-<?= $user_photo->id ?>" type="checkbox" name="img-perfil-<?= $user_photo->id ?>">
                          <label for="img-perfil-<?= $user_photo->id ?>">Imágen de perfil</label>
                        </div>
                        <?php else: ?>
                        <div class="establecido_perfil" style="position: absolute; clear: both; float: left; height: 17px; ">
                          <label for="img-perfil-<?= $user_photo->id ?>" style="color: #666; font-size: 13px">Imágen de perfil</label>
                        </div>
                        <?php endif; ?>
                      <?php endif; ?>
                    </div>
                  <script type="text/javascript">
                    $(function($, globals){
                      $('#img-perfil-<?= $user_photo->id ?>').on('change', function(){
                        $( "#dialog-confirm" ).dialog({
                          resizable: false,
                          modal: true,
                          show : 'drop',
                          hide : 'drop',
                          width: '400px',
                          buttons: {
                            "Aceptar": function() {
                              $.getJSON('<?= site_url("perfil/ajax/photo_profile") ?>', {
                                id : <?= $user_photo->id ?>,
                                user : <?= $user_photo->user_id ?>
                              }, function(json) {
                                if (json.ok === true) {
                                  location.reload();
                                } else {
                                  location.reload();
                                }
                              });
                              return $(this).dialog('close');
                            },
                            Cancel: function() {
                              $( this ).dialog( "close" );
                            }
                          }
                        });
                      });
                    });
                  </script>
                  <?php endforeach; ?>
                    <div id="dialog-confirm" title="Cambiar foto de perfil" style="display:none">
                      <p>
                        Estás seguro que quieres establecer esta imágen como perfil?
                      </p>
                    </div>
                    <div class="clr"></div>
                </div>
              </div>
            </div>

        <?php endif; ?>

    </div>
    <div class="clr"></div>
</div>


<div class="clr"></div>


<?php if ($is_owner_usuario) : ?>
    <script>
        $(document).ready(function() {
    			
            $('.listImages li').hover(function() {
                $(this).find('.closeImg').css('display', 'block');
            }, function() {
                $(this).find('.closeImg').css('display', 'none');
            });
    			
            $(".album").hover(function(){
    				
                $(".b_cerrar", this).css({
    					
                    'display':'block'	
                })
    				
            },function(){
                $(".b_cerrar", this).css({
                    'display':'none'	
                })
            })
        });
        
        /* Delete */
        $('.album .b_cerrar').click(function(){
            return confirm('¿Seguro que quieres eliminar la imagen?');
        });
        
        var uploader = new plupload.Uploader({
            runtimes: 'html5, flash, gears, html4',
            browse_button: 'pickfiles',
            container: 'container',
            unique_names: true,
            resize: {width: 1200, height: 1200, quality: 90},
            multipart: true,
            multi_selection: true,
            url: <?php echo json_encode(cms_url('users/upload')) ?>,
            flash_swf_url: <?php echo json_encode(global_asset('plupload/js/plupload.flash.swf')) ?>,
            silverlight_xap_url: <?php echo json_encode(global_asset('plupload/js/plupload.silverlight.xap')) ?>,
            filters: [
                {title: "Archivos de imagen", extensions: "jpg,gif,png,jpeg"}
            ]

        });

        uploader.bind('Init', function(up, params) {
        });


        uploader.init();

        uploader.bind('FilesAdded', function(up, files) {
            $.each(files, function(i, file) {
                $('#filelist').append(
                '<div id="' + file.id + '">' +
                    file.name + ' (' + plupload.formatSize(file.size) + ') <b></b>' +
                    '</div>');
            });
                
            $('#form [type="submit"]').show();

            up.refresh();
        });

        uploader.bind('UploadProgress', function(up, file) {
            $('#' + file.id + " b").html(file.percent + "%");
        });

        uploader.bind('Error', function(up, err) {
            $('#filelist').append("<div>Error: " + err.code +
                ", Message: " + err.message +
                (err.file ? ", File: " + err.file.name : "") +
                "</div>"
        );

            up.refresh();
        });

        uploader.bind('FileUploaded', function(up, file) {
            $('#' + file.id + " b").html("100%");
        });

        $('#form').on('submit', function() {

            var $this = $(this);
            if (uploader.files.length > 0) {
                uploader.bind('StateChanged', function() {
                    if (uploader.files.length === (uploader.total.uploaded + uploader.total.failed)) {
                        window.location.reload();
                    }
                });
                uploader.start();
            } else {
                $('#form')[0].submit();
            }
            return false;
        });

           
    </script>

<?php endif; ?>