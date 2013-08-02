<style>
  .random_sugerencias{
    background-color: #E5E5E5;
    border: 1px solid #F5F5F5;
    border-radius: 4px;
    -moz-border-radius: 4px;
    -webkit-border-radius: 4px;
    padding: 10px;
    width: 96.5%;
    height: 60px;
    float: left;
    margin-top: 3px;
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
  a.btn-continuar, .btn-continuar{
    background-color: #E82E7C;
    border-radius: 7px;
    -moz-border-radius: 7px;
    -webkit-border-radius: 7px;
    color: #FFF;
    font-family: "BebasNeueRegular";
    font-size: 18px;
    text-align: center;
    padding: 5px 18px;
    float: right;
    margin-top: -15px;
  }
  
</style>
<?php if($datos->exists()) : ?>
<?php foreach ($datos as $dato) : ?>
  <div class="random_sugerencias" id="inshaka-musik-<?= $dato->id ?>">
    <?php $photo->where(array('user_id' => $dato->id, 'profile_active' => true))->get(); ?>
    <div style="float:left">
      <?php if ($photo->exists()) : ?>
        <img  src="<?= uploads_url($photo->get_photo($dato->id)) ?>" width="64" height="64" />
      <?php else :?>
        <img  src="<?= front_asset('images/foto-perfil.png') ?>" width="64" height="64" />
      <?php endif; ?>
    </div>
    <div class="content-random">
      <a href="<?= site_url('perfil/'.$dato->inshaka_url) ?>">
        <span style="color: #444; font-size: 0.8em; font-weight: bold;"><?= ucwords(strtolower($dato->first_name." ".$dato->last_name)) ?></span>
      </a><br>
      <p style="color: #666; font-size: 0.8em; text-align: justify; width: 445px; padding-top: 7px;">
        <?= substr($dato->bio, 0, 130)."..." ?>
      </p>
      <p style="color: #E82E7C; font-size: 0.7em; font-weight: bold; margin-top:8px;">
        Número de Fans: <?= $seguidos_por_mi->where(array('user_follow_id' => $dato->id, 'allow_follow' => true))->get()->result_count() ?>                
      </p>
    </div>
    <div style="float: right; position: relative">
      <div style="font-size: 0.8em;" class="btn_follow_follower" onclick="follow_sugerencia_user(<?= $dato->id ?>, '#inshaka-musik-<?= $dato->id ?>')">
        Seguir
      </div>
      <div class="clr"></div>
      <div id="hidden-<?= $dato->id ?>" style="color: #a9a9a9; font-size: 0.8em; margin-top: 10px; font-weight: bold; display: none; cursor: pointer" onclick="hiden_user('#inshaka-musik-<?= $dato->id ?>');">
        <img src="<?= front_asset('images/esconder.png') ?>" style="height: 12px; margin-right: 3px; margin-top: 3px" />Esconder
      </div>
    </div>
  </div>
  <script type="text/javascript">
    $(function(){
      $("#inshaka-musik-<?= $dato->id ?>").hover(function(){
        $("#hidden-<?= $dato->id ?>").show();
      }, function(){
        $("#hidden-<?= $dato->id ?>").hide();
      });
    });
    function follow_sugerencia_user(id, elemento){
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
          var div_recomendaciones = $("#div-recomendaciones");
          div_recomendaciones.load(div_recomendaciones.data('load-url'));
        },
        complete    : function(){
          var div_recomendaciones = $("#div-recomendaciones");
          div_recomendaciones.load(div_recomendaciones.data('load-url'));
        }
      });
    }
  </script>
<?php endforeach; ?>
<?php endif; ?>
<div class='clr'></div>
<div class="regis-tit" style="color: #333; font-size: 15px; margin-top: 15px;">
  Te hacen faltan <span style="color: #E82E7C; font-size: 17px"><?= 5 - $cuantos_sigo->result_count() ?></span> usuarios
</div>
<?php if($cuantos_sigo->result_count() <= 4 ) : ?>
<div class="btn-continuar" style="opacity: 0.5; cursor: pointer" >Continuar</div>
<?php else : ?>
<a href="<?= site_url('perfil') ?>" class="btn-continuar" >Continuar</a>
<?php endif; ?>
<script>
  function hiden_user(elemento){
    $(elemento).fadeOut("slow");
    var div_recomendaciones = $("#div-recomendaciones");
    div_recomendaciones.load(div_recomendaciones.data('load-url'));
  }
</script>