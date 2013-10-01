<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title></title>
  </head>
  <body>
<p><img src="http://inshaka.com/imagenes_mailing/templatehigh.png" width="749" /></p>
    Hola, <strong style="color:#E01D71"><?= $user ?></strong>, ha comentado una de tus actividades en InShaka!<br><br>
    <span style="font-style: italic; text-align: justify;">"<?= $comment ?>"</span><br><br>
           Para ver el perfil de <strong style="color:#E01D71"><?= $user ?> </strong>,
           haz click en: <a href="http://inshaka.com/perfil/<?= $inshaka_url ?>"><img src="http://www.inshaka.com/assets/images/email/ver_mas.png" /></a>
         </p>
         <p style="text-align: justify">
           Para ver la actividad en la que ha comentado, haz click en: <a href="http://inshaka.com/perfil/social/detalle?id=<?= $post ?>"><img src="http://www.inshaka.com/assets/images/email/ver_mas.png" /></a>
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
