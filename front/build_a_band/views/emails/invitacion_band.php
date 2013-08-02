<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title></title>
  </head>
  <body>
<p><img src="http://inshaka.com/imagenes_mailing/templatehigh.png" width="749"/></p>
         Hola, <strong style="color:#E01D71"><?= $nombre_invitado ?></strong><br>
         <p style="text-align: justify">
           <strong style="color:#E01D71"><?= $nombre_creador ?></strong> te ha invitado a formar parte de su banda <strong style="color:#E01D71"><?= $nombre_banda ?></strong>.<br>
           Este es el mensaje que te dejó.
         </p>
         <p style="text-align: justify">
           <em>"<?php echo $message ?>"</em>
         </p>
         <p style="text-align: justify">
           Para ver el perfil de <?= $nombre_creador ?>, haz click en: <a href="<?= $url_creador ?>"><img src="http://www.inshaka.com/assets/images/email/ver_mas.png" /></a>
         </p>
         <p style="text-align: justify">
           Para <strong style="color:#E01D71">aceptar</strong> ésta invitación haz click acá: <a href="<?php echo $url_accept ?>"><img src="http://www.inshaka.com/assets/images/email/aceptar.png" /></a><br>
           Para <strong style="color:#E01D71">rechazar</strong> ésta invitación haz click acá: <a href="<?php echo $url_decline ?>"><img src="http://www.inshaka.com/assets/images/email/rechazar.png" /></a><br>
         </p>
         <p style="text-align: justify">
           Team InShaka<br>

           <strong style="color:#E01D71">InShaka Entertainment</strong>
         </p>
         <p><img src="http://inshaka.com/imagenes_mailing/templatelow.png"></p>
       </div>
    </div>
  </body>
</html>
