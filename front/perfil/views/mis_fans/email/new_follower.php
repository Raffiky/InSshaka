<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title></title>
  </head>
  <body>
    <p><img src="http://inshaka.com/imagenes_mailing/templatehigh.png" width="749" /></p>
    <p style="text-align: justify">
      Hola, <strong style="color:#E01D71"><?= $user_follow->first_name, ' ', $user_follow->last_name ?></strong><br>
      Tienes un nuevo fan en <strong style="color:#E01D71">InShaka</strong>!
    </p><br>
    <div style="width: 70%; margin-bottom: 15px; height: 120px; background-color: #F5F5F5; border: 1px solid #E5E5E5; padding: 10px 20px; border-radius: 10px;">
      <div style="float:left">
        <?php if(!$photo->get_photo($user->id)) : ?>
          <img width="114" src="http://inshaka.com/images/imagensino.png" />
        <?php else: ?>
          <img width="114" src="<?php echo uploads_url($photo->get_photo($user->id)) ?>" />
        <?php endif; ?>
      </div>
      <div style="float: left; margin-left: 20px; font-family: 'Times New Roman'">
        <p><strong style="color:#E01D71; font-family: 'Arial'; font-size: 18px;"><?= $user->first_name.' '.$user->last_name ?></strong></p>
        <p><i><?= strlen($user->bio) > 250 ? substr($user->bio, 0, 250)."..." : $user->bio ?></i></p>
        <p>
          <a href='http://inshaka.com/perfil/<?= $user_follow->inshaka_url ?>' style='background-color: #E82E7C; border-radius: 7px; -moz-border-radius: 7px; -webkit-border-radius: 7px; padding: 5px 15px; color:#FFF; border: 0px; cursor: pointer; float: left; font-family: "Arial"; text-decoration: none;' >Aceptar</a>
          <a href='http://inshaka.com/perfil/<?= $user_follow->inshaka_url ?>' style='background-color: #999; border-radius: 7px; -moz-border-radius: 7px; -webkit-border-radius: 7px; padding: 5px 15px; color:#FFF; border: 0px; cursor: pointer; float: left; font-family: "Arial"; text-decoration: none; margin-left: 20px;' >Rechazar</a>
        </p>
      </div>
    </div>
  
    <p> Para ver a las personas que son <strong style="color:#E01D71">fans</strong> tuyos en <strong style="color:#E01D71">InShaka</strong>, o aquellos usuarios de los que tú  eres <strong style="color:#E01D71">fan</strong> haz clic  <a href="http://inshaka.com/perfil/social" strong style="color:#E01D71">acá</a>
    </p>
    <p style="text-align: justify">
      Team InShaka<br>
      <strong style="color:#E01D71">InShaka Entertainment</strong>
    </p>
    <p><img src="http://inshaka.com/imagenes_mailing/templatelow.png"></p>
  </body>
</html>
