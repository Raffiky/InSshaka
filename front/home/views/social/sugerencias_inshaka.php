<span class="titDestacados">Sugerencias</span><br>
<span class="subDestacados">Usuarios InShaka</span>
<?php if($random_users->exists()) : ?>
<?php foreach ($random_users as $random_user) : ?>
  <div class="random_user" id="inshaka-musik-<?= $random_user->id ?>">
    <?php $photo->where(array('user_id' => $random_user->id, 'profile_active' => true))->get(); ?>
    <div style="float:left">
      <?php if ($photo->exists()) : ?>
        <img  src="<?= uploads_url($photo->get_photo($random_user->id)) ?>" width="35" height="35" />
      <?php else :?>
        <img  src="<?= front_asset('images/foto-perfil.png') ?>" width="35" height="35" />
      <?php endif; ?>
    </div>
    <div class="content-random">
      <a href="<?= site_url('perfil/'.$random_user->inshaka_url) ?>">
        <span style="color: #666; font-size: 0.8em;"><?= ucwords(strtolower($random_user->first_name." ".$random_user->last_name)) ?></span>
      </a><br>
      <p style="color: #E82E7C; font-size: 0.7em; font-weight: bold; margin-top:8px;">
        Número de Fans: <?= $seguidos_por_mi->where(array('user_follow_id' => $random_user->id, 'allow_follow' => true))->get()->result_count() ?>
        <div style="font-size: 0.7em; margin: -20px 0 0 168px; position:absolute" class="btn_follow_follower" onclick="follow_search(<?= $random_user->id ?>, '#inshaka-musik-<?= $random_user->id ?>')">
          Seguir
        </div>                
      </p>
    </div>
  </div>
  <script type="text/javascript">
    function follow_search(id, elemento){
      var data = {
        id: id,
        status: "Follow"
      };
      $.ajax({
        url   : "<?= site_url('perfil/social/follow') ?>",
        type  : "get",
        data  : data,
        success     : function(){
          $(elemento).fadeOut("slow");
        },
        complete    : function(){
          var sugerencias_list = $('#img-recomendaciones');
          sugerencias_list.load(sugerencias_list.attr('data-load-url'));
        }
      });
    }
  </script>
<?php endforeach; ?>
<?php endif; ?>
