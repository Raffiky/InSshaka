<style>
  .triangle-border {
    position: relative;
    padding: 15px;
    margin: 0.5em 0;
    border: 1px solid #9E9D9D;
    color: #333;
    -webkit-border-radius: 3px;
    -moz-border-radius: 3px;
    border-radius: 3px;
    width: 565px;
    font-size: 0.8em;
    color: #444;
    text-align: justify;
  }
/*  .triangle-border:before {
    content: "";
    position: absolute;
    bottom: -16px;
    left: 47px;
    border-width: 15px 13px 0;
    border-style: solid;
    border-color: #9E9D9D rgba(0, 0, 0, 0);
    display: none;
    width: 0;
  }
  .triangle-border:after {
    content: "";
    position: absolute;
    bottom: -13px;
    left: 49px;
    border-width: 13px 11px 0;
    border-style: solid;
    border-color: #F1F1F4 rgba(0, 0, 0, 0);
    display: block;
    width: 0;
  }*/
/*  .triangle-border.top:before {
    top: -18px;
    bottom: auto;
    left: auto;
    right: 40px;
    border-width: 0 14px 18px;
  }
  .triangle-border.top:after {
    top: -16px;
    bottom: auto;
    left: auto;
    right: 39px;
    border-width: 0 15px 21px;
  }*/
  .triangle-border > span:first-child{
    float: left; 
    margin-right: 5px; 
    color: #E82E7C; 
    font-weight: bold;
  }
  ul.message-pub li{
    width: 97%;
    overflow: hidden;
    background: #F5F5F5;
    border: 1px solid #E5E5E5;
    box-shadow: inset 0 0 0 1px #F9F9F9;
    border-radius: 4px;
    -webkit-border-radius: 4px;
    -moz-border-radius: 4px;
    margin-top: 3px;
    padding: 7px;
  }
  #blq-load-message{
    overflow: auto;
    max-height: 400px;
    padding: 20px !important;
    width: 93%;
    margin-bottom: 10px;
  }
  .delete-message{
    position: absolute;
    float: right;
    margin-left: 457px;
    margin-top: -28px;
  }
</style>
<script>
  $(function(){
      $("#blq-load-message").animate({scrollTop: $(".triangle-border:last").position().top});
      // Formulario para responder un mensaje
      $("#form-message").on("submit", function(event){
        event.preventDefault();
        url = $(this).attr("action");
        $.ajax({
          type    : "post",
          url     : url,
          data    : $(this).serialize(),
          beforeSend : function(){
            $("#response-message").text("Enviando").attr("disabled", "disabled");
          },
          success : function(json){
            if(json.ok){
              $("#load-here").load("<?= site_url("perfil/mensajes/load_message/$user_id") ?>");
              $("#response-message").text("Responder").removeAttr("disabled");
            }
          },
          error   : function(){
            alert("Se ha producido un error. Inténtelo más tarde!.");
          }
        });
      });
      $("#message").keypress(function(e){
        if(e.which === 13)
           $("#form-message").trigger("submit");
      });
      $(".triangle-border").hover(function(){
        $(this).find("a.delete-message").show();
      },function(){
        $(this).find("a.delete-message").hide();
      });
      $("a.delete-message").on("click", function(event){
        event.preventDefault();
        
        var url = $(this).attr("href");
        var elemento = $(this).parent();
        var id = $(this).data("id");
        
        $("#delete-message").dialog({
          modal : true,
          show  : "drop",
          hide  : "drop",
          buttons : {
            Ok: function(){
              $.ajax({
                type  : "post",
                url   : url,
                dataType : "json",
                data  : {id: id},
                success : function(json){
                  if(json.ok)
                    elemento.fadeOut("slow");
                },
                error   : function(){
                  alert("Se ha producido un error. Inténtelo más tarde.");
                }
              });
              $( this ).dialog( "close" );
            },
            Cancel: function(){
              $( this ).dialog( "close" );
            }
          }
        });
      });
  });
</script>
<?php if($datos->exists()) : ?>
<div id="blq-load-message">
  <?php foreach ($datos as $dato) : ?>
    <div class="triangle-border">
      <a class="delete-message" data-id="<?= $dato->id ?>" href="<?php echo site_url('perfil/mensajes/delete_message/') ?>" style="display:none">
        <div class="borrar"></div>
      </a>
      <?php $date = fecha_spanish_full_short($dato->created_on, TRUE); ?>
      <span style="color: #E82E7C; font-weight: bold;"><?= $usuario->get_username($dato->user_id)." - ".$date ?> : </span><br><br>
      <?php 
        $patron = '%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i';
        if(preg_match_all($patron, $dato->message, $coincidencias, PREG_OFFSET_CAPTURE)) {
          foreach ($coincidencias[0] as $coincide) {
            $words_search[] = "http://".$coincide[0];
            if(is_youtube_url("http://".$coincide[0])){
              $dato->get_oembed("http://".$coincide[0]);  
              $url_status = str_replace($coincide[0], "<a class='group iframe' href='".$dato->oembed->url."' rel='fancy-gallery-iframe' style='float:left;'><img src='".$dato->oembed->thumbnail_url."' style='height: 60px; margin: 0px 3px;' /></a><div style='float:left; width: 410px; margin-left: 15px; font-size: 0.85em;'><span style='color:#E82E7C; font-weight: bold'>".$dato->oembed->title."</span><p> Autor: ".$dato->oembed->author_name."</p><p>".$dato->oembed->description."</p></div>", $coincide[0]);
              $url_reemplazar = str_replace($coincide[0], "<a href='".$dato->oembed->url."' target='_blank' style='color: #E82E7C;'>".$coincide[0]."</a>", $coincide[0]);
            } 
            $mension[] = $url_status;
            $videos[] = $url_reemplazar;
          }
          $video = true;
          $status_replace = str_replace($words_search, $videos, $dato->message);
        }else{
          $video = false;
          $status_replace = $dato->message;
        }
      ?>      
      <div style="float: left;">
        <p><?= $status_replace ?></p>
        <?php if($video === true) : ?>
        <div class="clear" style="margin-top: 10px;"></div>
        <ul class="message-pub">
          <?php foreach ($mension as $video) : ?>
            <li><?= $video ?></li>
          <?php endforeach; ?>
        </ul>
        <?php endif; ?>
      </div>
      <div class="clr"></div>
    </div>
    <?php $mension = null ?>
  <?php endforeach; ?>
<?php else : ?>
  no hay mensajes
</div>
<?php endif; ?>
<div class="clr"></div>
<?= form_open(site_url("perfil/mensajes/response_message"), "id='form-message'", array("user_id" => $user_id)) ?>
  <textarea rows="5" style="width: 575px;" id="message" name="message" placeholder="Escribe aquí tu mensaje"></textarea>
  <div class="clr"></div>
  <input id="response-message" type="submit" class="bot-publicar" value="Responder" style="font-size: 25px;" />
<?= form_close() ?>

  <!-- Modal para eliminar un mensaje -->
  <div id="delete-message" title="Eliminar mensaje" style="display:none">
    Estás seguro que deseas eliminar este mensaje?.
  </div>