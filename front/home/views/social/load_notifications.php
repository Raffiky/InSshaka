<!-- Blq de notificaciones -->  
  <?php foreach ($interacciones as $intelligence) : ?>    
        <!-- Blq nuevo fan -->
        <?php if(!empty($intelligence->users_follow_id)): ?>
          <div class="new_follower" data-dni="<?= $intelligence->id ?>">
            <?php $photo->where(array('user_id' => $intelligence->user->id, 'profile_active' => true))->get(); ?>
            <div style="float:left">
              <?php if ($photo->exists()) : ?>
                <img  src="<?= uploads_url($photo->get_photo($intelligence->user->id)) ?>" width="80" />
              <?php else :?>
                <img  src="<?= front_asset('images/imagensino.png') ?>" width="80" />
              <?php endif; ?>
            </div>
            <div class="content_follower">
              <a href="<?= site_url('perfil/'.$intelligence->user->inshaka_url) ?>">
                <span><?= !$intelligence->user->is_proveedor ? $intelligence->user->first_name.' '.$intelligence->user->last_name : $intelligence->user->name_proveedor ?></span>
              </a> tiene un nuevo fan <span style="font-family: 'Arial'; font-style: italic; font-size: 0.85em; float: right;"><?= fecha_spanish_full_short($intelligence->update_on).' - '. get_hour($intelligence->update_on) ?></span>
              <div class="follower_new">
                <?php $photo->where(array('user_id' => $intelligence->users_follow->user->id, 'profile_active' => true))->get(); ?>
                <div style="float:left">
                  <?php if ($photo->exists()) : ?>
                    <img  src="<?= uploads_url($photo->get_photo($intelligence->users_follow->user->id)) ?>" style="width: 80px; height: 80px;" />
                  <?php else :?>
                    <img  src="<?= front_asset('images/imagensino.png') ?>" width="80" />
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
                      <div id="follow-him-her" title="Seguir" style="display:none">
                        <p>
                          Estás seguro que deseas seguir a este usuario?
                        </p>
                      </div>
                    <?php else : ?>
                      <div class="btn_follow_follower" style="<?= ($intelligence->users_follow->user->id == $userinfo->id) ? 'display:none' : null ?>" onclick="follow(<?= $intelligence->users_follow->user->id ?>, 'Unfollow', '#unfollow-him-her')">
                        Dejar de seguir
                      </div>
                      <div id="unfollow-him-her" title="Dejar de seguir" style="display:none">
                        <p>
                          Estás seguro que deseas dejar de seguir a este usuario?
                        </p>
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
                <img  src="<?= front_asset('images/imagensino.png') ?>" width="80" />
              <?php endif; ?>
            </div>
            <div class="content_follower">
              <a href="<?= site_url('perfil/'.$intelligence->user->inshaka_url) ?>">
                <span><?= !$intelligence->user->is_proveedor ? $intelligence->user->first_name.' '.$intelligence->user->last_name : $intelligence->user->name_proveedor ?></span>
              </a>
              <?php if(!empty($intelligence->audicion_id)) : ?>
                ha creado una nueva audición
              <?php elseif(!empty($intelligence->clasificado_id)) : ?>
                ha creado un nuevo clasificado
              <?php elseif(!empty($intelligence->band_id)) : ?>
                ha creado una nueva banda
              <?php elseif(!empty($intelligence->statu_id)) : ?>
                ha cambiado su estado
              <?php elseif(!empty($intelligence->audiciones_aplicacion_id)) : ?>
                ha aplicado a una audición
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
                  <?php endif; ?>
                </div>
                <div class="subcontent_follower" style="float:left; margin-left: 10px; width: 77%;">
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
                    <?= strlen($intelligence->statu->status) >= 140 ? substr($intelligence->statu->status, 0, 140)."..." : $intelligence->statu->status ?>
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
              </div>
              <div class="clear"></div>
              <div id="share-<?= $intelligence->id ?>" style="display:none; padding: 20px;">
              <?php if(!empty($intelligence->audicion_id)) : ?>
                <div class="share-social-network" style="float: left; width: 100px;"> 
                  <div class="fb-like" data-send="false" data-href="<?= sprintf($urls->audicion_detalle, $intelligence->audicion->id, $intelligence->audicion->var) ?>" data-layout="button_count" data-width="100" data-show-faces="false" data-action="like" ></div>
                </div>
                <div class="share-social-network" style="float: left; width: 100px;"> 
                  <a href="https://twitter.com/share" class="twitter-share-button" data-url="<?= sprintf($urls->audicion_detalle, $intelligence->audicion->id, $intelligence->audicion->var) ?>" data-text="<?= $intelligence->audicion->titulo ?>" data-via="inshaka" data-lang="es" data-hashtags="TryInshaka">Twittear</a>
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
                  <div class="g-plusone" data-size="medium" data-href="<?= sprintf($urls->audicion_detalle, $intelligence->audicion->id, $intelligence->audicion->var) ?>"></div>
                </div>
              <?php elseif(!empty($intelligence->clasificado_id)) : ?>
                <div class="share-social-network" style="float: left; width: 100px;"> 
                  <div class="fb-like" data-send="false" data-href="<?= sprintf($urls->clasificado_detalle, $intelligence->clasificado->id, $intelligence->clasificado->var) ?> ?>" data-layout="button_count" data-width="100" data-show-faces="false"></div>
                </div>
                <div class="share-social-network" style="float: left; width: 100px;"> 
                  <a href="https://twitter.com/share" class="twitter-share-button" data-url="<?= sprintf($urls->clasificado_detalle, $intelligence->clasificado->id, $intelligence->clasificado->var) ?>" data-text="<?= $intelligence->clasificado->titulo ?>" data-via="inshaka" data-lang="es" data-hashtags="TryInshaka">Twittear</a>
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
                  <div class="g-plusone" data-size="medium" data-href="<?= sprintf($urls->clasificado_detalle, $intelligence->clasificado->id, $intelligence->clasificado->var) ?>"></div>
                </div>
              <?php elseif(!empty($intelligence->audiciones_aplicacion_id)) : ?>
                <div class="share-social-network" style="float: left; width: 100px;"> 
                  <div class="fb-like" data-send="false" data-href="<?= sprintf($urls->audicion_detalle, $intelligence->audiciones_aplicacion->audicion->id, $intelligence->audiciones_aplicacion->audicion->var) ?>" data-layout="button_count" data-width="100" data-show-faces="false" data-action="like" ></div>
                </div>
                <div class="share-social-network" style="float: left; width: 100px;"> 
                  <a href="https://twitter.com/share" class="twitter-share-button" data-url="<?= sprintf($urls->audicion_detalle, $intelligence->audiciones_aplicacion->audicion->id, $intelligence->audiciones_aplicacion->audicion->var) ?>" data-text="<?= $intelligence->audiciones_aplicacion->audicion->titulo ?>" data-via="inshaka" data-lang="es" data-hashtags="TryInshaka">Twittear</a>
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
                  <div class="g-plusone" data-size="medium" data-href="<?= sprintf($urls->audicion_detalle, $intelligence->audiciones_aplicacion->audicion->id, $intelligence->audicion->var) ?>"></div>
                </div>
              <?php elseif(!empty($intelligence->band_id)) : ?>
                <div class="share-social-network" style="float: left; width: 100px;">
                  <div class="fb-like" data-send="false" data-href="<?= site_url('perfil/pagina/'.$intelligence->band->var) ?>" data-layout="button_count" data-width="100" data-show-faces="false" data-action="like" data-stream="false" data-show-border="false" data-header="false" ></div>
                </div>
                <div class="share-social-network" style="float: left; width: 100px;"> 
                  <a href="https://twitter.com/share" class="twitter-share-button" data-url="<?= site_url('perfil/pagina/'.$intelligence->band->var) ?>" data-text="<?= $intelligence->band->name ?>" data-via="inshaka" data-lang="es" data-hashtags="TryInshaka">Twittear</a>
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
                  <div class="g-plusone" data-size="medium" data-href="<?= site_url('perfil/pagina/'.$intelligence->band->var) ?>"></div>
                </div>
              <?php endif; ?>
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
  <script type="text/javascript">      
    $(function(){
      $(".comments-intelligence").each(function(){
        $(this).load($(this).attr('data-load-url'));
      });
    });
  </script>

<!-- Fin Blq notificaciones -->