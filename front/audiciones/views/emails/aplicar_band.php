<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title></title>
  </head>
  <body>
<p><img src="http://inshaka.com/imagenes_mailing/templatehigh.png" width="749"/></p>
         Hola, <strong style="color:#E01D71"><?= $user_owner->first_name, ' ', $user_owner->last_name ?></strong><br>
         <p style="text-align: justify">
           <strong style="color:#E01D71"><?= $user_apply->first_name, ' ', $user_apply->last_name ?></strong> ha aplicado a una audición que tu creaste con la banda <?= $band ?>!
         </p>
         <p style="text-align: justify">
           Para ver el perfil de <strong style="color:#E01D71"><?= $user_apply->username ?> </strong>, haz click en: <a href="http://inshaka.com/perfil/<?= $user_apply->inshaka_url ?>"><img src="http://www.inshaka.com/assets/images/email/ver_mas.png" /></a>
         </p>
         <p style="text-align: justify">
           Para ver el perfil de <strong style="color:#E01D71"><?= $band ?> </strong>, haz click en: <a href="http://inshaka.com/~inshaka/perfil/pagina/<?= $url_band ?>"><img src="http://www.inshaka.com/assets/images/email/ver_mas.png" /></a>
         </p>         
         <p style="text-align: justify">
           Para ver tus audiciones creadas y aceptar/rechazar usuarios, haz click en: <a href="http://inshaka.com/perfil/audiciones"><img src="http://www.inshaka.com/assets/images/email/audiciones.png" /></a>
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
