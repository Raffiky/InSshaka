<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title></title>
  </head>
  <body>
<p><img src="http://inshaka.com/imagenes_mailing/templatehigh.png" width="749" /></p>
         Hola, <strong style="color:#E01D71"><?= $user->first_name, ' ', $user->last_name ?></strong><br>
         <p style="text-align: justify">
           <strong style="color:#E01D71"><?= $user_creator->first_name, ' ', $user_creator->last_name ?></strong> te ha dejado el siguiente comentario en tu perfil:
           </p>
         <p style="text-align: justify">
           <em>"<?php echo $message ?>"</em>
         </p>
         </p>
         <p style="text-align: justify">
           Para ver el perfil de <strong style="color:#E01D71"><?= $user_creator->username ?> </strong>, haz click en: <a href="http://inshaka.com/perfil/<?= $user_creator->inshaka_url ?>"><img src="http://www.inshaka.com/assets/images/email/ver_mas.png" /></a>
         </p>
         
         <p style="text-align: justify">
           Para ver <strong style="color:#E01D71">tu</strong> perfil haz click en: <a href="http://inshaka.com/perfil/<?= $user->inshaka_url ?>"><img src="http://www.inshaka.com/assets/images/email/ver_mas.png" /></a>
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

