<style>
  .c8{
    color:#333 !important;	
  }
  #blq-izq{
    float: left;
    width: 30%;
    max-height: 350px;
    overflow: hidden;
    border: 1px solid #E5E5E5;
    border-radius: 3px;
    -webkit-border-radius: 3px;
    -moz-border-radius: 3px;
    padding: 10px 7px;
  }
  #blq-der{
    float: left;
    width: 65%;
    margin-left: 10px;
    overflow: hidden;
    border: 1px solid #E5E5E5;
    max-height: 575px;
    padding-bottom: 50px;
  }
  .user-message{
    padding: 7px;
    border: 1px solid #E5E5E5;
    border-radius: 3px;
    -webkit-border-radius: 3px;
    -moz-border-radius: 3px;
    overflow: hidden;
  }
  .user-message > span{
    float: left;
    font-family: "BebasNeueRegular";
    margin-left: 10px;
  }
  .user-message > p{
    font-size: 0.7em;
    text-align: left;
    color: rgba(255, 255, 255, 0.6);
    margin-left: 75px;
  }
  #see-all{
    height: 9px;
    padding: 10px;
    text-align: center;
    background: rgba(194, 194, 194, 0.4);
    border: 1px dashed #999;
    color: #777;
    font-size: 0.9em;
  }
  fieldset{
    border: 1px solid #999;
    padding: 30px;
  }
  legend{
    padding: 0px 20px;
    color: #999;
    font-weight: bold;
    font-size: 1.05em;
  }
  label{
    font-family: "Arial";
    font-size: 0.8em;
    color: #666;
  }
  input[type="text"]{
    padding: 4px 10px !important;
    width: 360px;
  }
  textarea, input[type="text"]{
    border: 1px solid #999;
    border-radius: 4px;
    background-color: #F5F5F5;
    color: #000;
    font-family: "Arial";
    padding: 7px 10px;
  }
  .btn-plus{
    border: 0px;
    border-radius: 4px;
    padding: 10px 10px;
    color: #FFF;
    font-family: "BebasNeueRegular";
    font-size: 1.1em;
    width: 90px;
    float: left;
    text-align: center;
    margin-bottom: 5px;
    background: #EC5092;
    background: -moz-linear-gradient(top, #ec5092 0%, #e51b68 100%);
    background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#EC5092), color-stop(100%,#E51B68));
    background: -webkit-linear-gradient(top, #EC5092 0%,#E51B68 100%);
    background: -o-linear-gradient(top, #ec5092 0%,#e51b68 100%);
    background: -ms-linear-gradient(top, #ec5092 0%,#e51b68 100%);
    background: linear-gradient(to bottom, #EC5092 0%,#E51B68 100%);
    filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#ec5092', endColorstr='#e51b68',GradientType=0 );
    text-shadow: 0px 1px 2px #999;
  }
</style>
<script>
  $(function(){    
    $("a.response-message").on("click", function(event){
      event.preventDefault();
      url = $(this).children(".user-message").data("url");
      box = $(this).children(".user-message");
      var datos = {user_id : $(this).data("user-id")};
      $("#loading-messages").show();
      
      $("#load-here").load($(this).attr("href"), function(){
        $("#loading-messages").hide();
        $.ajax({
          type    :   "post",
          url     :   url,
          dataType:   "json",
          data    :   datos,
          success :   function(json){
            if(json.ok){
              $('#message_not').hide();
              box.css({
                "background-color" : "transparent",
                "color" : "#E82E7C"
              });
              box.find("p").css("color", "#E82E7C");
            }
          }
        });
      });
    });
    
    $("a#load-all").on("click", function(event){
      event.preventDefault();
      $("#all-message").load($(this).attr("href"));
    });
  });
</script>
<div class="contenido">
  <?php if (!empty($alert_messages)) : ?>
    <div><?php echo $alert_messages ?></div>
  <?php endif; ?>
  <!-- Bloque izquierdo - Usuarios con mensajes -->
  <div id="blq-izq">
    <!-- Botón para crear un nuevo mensaje -->
    <a id="form-modal" class="btn-plus" href="#formulario-nuevo-mensaje">Nuevo mensaje</a>
    <script>
      $(function(){         
        $("#user_id").keypress(function(e){                
          if(e.which === 64){         
            $(this).autocomplete({
              source: "<?= site_url("home/get_users") ?>"
            });
          }
        });
        $("#form-modal").fancybox({scrolling: "no" });
      });
    </script>
    <div class="clr"></div>
    <?php if($datos->exists()) : ?>
      <?php foreach ($datos as $dato) : ?>
        <a class="response-message" data-user-id="<?= $dato->id ?>" href="<?= site_url("perfil/mensajes/load_message/$dato->id") ?>" >
          <div data-url="<?= site_url("perfil/mensajes/update_message") ?>" class="user-message" style="<?= $dato->get_message($dato->id)->inbox_ready ==  false ? "background-color: #E82E7C; color: #FFF;" : "color: #E82E7C;" ?>">
            <?php $_photo = $photo->get_photo($dato->id) ?>
            <?php if($_photo) : ?>
              <img src="<?= uploads_url($_photo) ?>" alt="<?= $dato->id ?>" style="height: 35px; float: left;" />
            <?php else : ?>
              <img src="<?= front_asset("images/foto-perfil.png") ?>" alt="<?= $dato->id ?>" style="height: 35px; float: left;" />
            <?php endif; ?>
            <span><?= $dato->get_name($dato->id)?></span><br>
            <p <?= $dato->get_message($dato->id)->inbox_ready ==  true ? "style='color: #E82E7C'" : null ?>>
              <?= strlen($dato->get_message($dato->id)->inbox_message) > 45 ? substr($dato->get_message($dato->id)->inbox_message, 0, 45)."..." : $dato->get_message($dato->id)->inbox_message ?>
            </p>
          </div>
        </a>
      <?php endforeach; ?>
    <?php endif; ?>
    <div id="all-message"></div>
    <div class="clr"></div>
    <div id="see-all" <?= $datos->result_count() <= 15 ? "style='display:none'" : null ?> >
      <a id="load-all" href="<?= site_url("perfil/mensajes/load_all") ?>">
        Ver todos
      </a>
    </div>
  </div>
  <!-- Fin Bloque izquierdo -->
  
  <!-- Bloque derecho - Mensajes de usuarioa -->
  <div id="blq-der">
    <div id="loading-messages" style="width: 66px; height: 66px; padding-top: 30px; margin: 0 auto; display: none; ">
      <img src="<?= front_asset("images/loading.gif") ?>" />
    </div>
    <div id="load-here"></div>
    <div class="clr"></div>
  </div>
  <!-- Fin Bloque derecho -->
</div>

<!-- Modal de nuevo mensaje -->
<div id="formulario-nuevo-mensaje"  style='display:none'>
  <?= form_open(site_url("perfil/mensajes/send_message"), "id='form-message'") ?>
  <fieldset>
    <legend>Nuevo mensaje</legend>
    <label>Para :</label>
    <input type="text" id="user_id" name="user_id" placeholder="Digita @ para enviarle un mensaje a un usuario" />
    <div class="clr"></div>
    <textarea rows="5" cols="63" id="message" name="message" placeholder="Escribe aquí tu mensaje"></textarea>
    <div class="clr"></div>
    <input type="submit" class="bot-publicar" value="Enviar" />
  </fieldset>
  <?= form_close() ?>
</div>