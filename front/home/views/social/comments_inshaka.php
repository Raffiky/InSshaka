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
          <img  src="<?= front_asset('images/imagensino.png') ?>" width="35" height="35" />
        <?php endif; ?>
      </div>
      <div class="content-random" style="width: 88%;">
        <a href="<?= site_url('perfil/'.$dato->user->inshaka_url) ?>" style="color: #E82E7C;">
          <?= $dato->user->first_name.' '.$dato->user->last_name ?>
        </a>
        <div class="clr"></div>
        <?= substr($dato->comentario, 0, 145) ?>
        <div class="clr"></div>
        <span style="font-family: 'Arial'; font-style: italic; font-size: 0.75em; float: right;"><?= fecha_spanish_full_short($dato->created_on).' - '. get_hour($dato->created_on) ?></span>
      </div>  
    </div>
  <?php endforeach; ?>
  </div>
<?php endif; ?>

