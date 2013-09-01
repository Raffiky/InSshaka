<style type="text/css">
  .capa-comentarios{
    margin-top: 10px;
    max-height: 230px;
    height: auto;
    width: 480px;
    overflow: hidden;
  }
</style>
<script type="text/javascript">
  $(document).ready(function(){
    $(".capa-comentarios").jScrollPane();
  });
</script>
<?php if($datos->exists()) : ?>
  <div class="capa-comentarios" id="capa-comentarios-<?= $datos->id ?>">
  <?php foreach ($datos as $dato) : ?>
    <div class="random_user" style="box-shadow: none; height: 47px;">
      <?php $photo->where('user_id', $dato->user->id)->get(); ?>
      <div style="float:left">
        <?php if ($photo->exists()) : ?>
          <img  src="<?= uploads_url($photo->get_photo($dato->user->id)) ?>" width="35" height="35" />
        <?php else :?>
          <img  src="<?= front_asset('images/foto-perfil.png') ?>" width="35" height="35" />
        <?php endif; ?>
      </div>
      <div class="content-random" style="width: 88%;">
        <a href="<?= site_url('perfil/'.$dato->user->inshaka_url) ?>" style="color: #E82E7C;">
          <?= $dato->user->first_name.' '.$dato->user->last_name ?>
        </a>
        <div class="clr"></div>
        <?php
        $patron = "/@_?[a-z0-9]+(_?)([a-z0-9]?)+/i";
          if(preg_match_all($patron, $dato->comentario, $coincidencias, PREG_OFFSET_CAPTURE)) {
            foreach ($coincidencias[0] as $coincide) {
              $words_search[] = $coincide[0];
              $url_status = str_replace($coincide[0], "<a href='".site_url("perfil/".$usuario->get_by_username(trim($coincide[0], "@"))->inshaka_url)."' style='color: #e82e7c; font-style: normal;' >".$coincide[0]."</a>", $coincide[0]);
              $mension[] = $url_status;
            }
            $status_replace = str_replace($words_search, $mension, $dato->comentario);
          }else{
            $status_replace = $dato->comentario;
          }
        ?>
        <?= substr($status_replace, 0, 500) ?>
        <div class="clr"></div>
        <span style="font-family: 'Arial'; font-style: italic; font-size: 0.75em; float: right; margin-top: 17px;"><?= fecha_spanish_full_short($dato->created_on).' - '. get_hour($dato->created_on) ?></span>
      </div>  
    </div>
  <?php endforeach; ?>
  </div>
<?php endif; ?>

