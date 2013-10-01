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
              box.css({
                "background-color" : "transparent",
                "color" : "#E82E7C"
              });
            }else{
              alert("Se ha producido un error. Inténtelo más tarde!.");
            }
          }
        });
      });
    });
  });
</script>
<?php if($datos->exists()) : ?>
  <?php foreach ($datos as $dato) : ?>
    <a class="response-message" href="<?= site_url("perfil/mensajes/load_message/$dato->user_id") ?>" >
      <div class="user-message">
        <?php $_photo = $photo->get_photo($dato->user_id) ?>
        <?php if($_photo) : ?>
          <img src="<?= uploads_url($_photo) ?>" alt="<?= $usuario->get_name($dato->user_id) ?>" style="height: 35px; float: left;" />
        <?php else : ?>
          <img src="<?= front_asset("images/foto-perfil.png") ?>" alt="<?= $usuario->get_name($dato->user_id) ?>" style="height: 35px; float: left;" />
        <?php endif; ?>
        <span style="color: #E82E7C;"><?= $usuario->get_name($dato->user_id) ?></span><br>
        <p style="color: rgba(232, 46, 124, 0.6);"><?= strlen($dato->get_message($dato->id)->inbox_message) > 45 ? substr($dato->get_message($dato->id)->inbox_message, 0, 45)."..." : $dato->get_message($dato->id)->inbox_message ?></p>
      </div>
    </a>
  <?php endforeach; ?>
<?php endif; ?>