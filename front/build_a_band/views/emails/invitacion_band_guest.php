<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title></title>
  </head>
  <body>
    <div id="content">
     <img src="http://www.inshaka.com/nuevo/assets/images/email/header_mail.png" width="749" height="136"/>
     <div id="contenido">
       <div id="left" style="float: left; margin-top: -3px">
         <img src="http://www.inshaka.com/nuevo/assets/images/email/left_mail.png" width="132" height="334"/>
       </div>
       <div id="center" style="float: left; width:292px; height: 331px; font-family: 'Arial';">
         Hola, <strong style="color:#E01D71"><?= $email_invitado ?></strong><br>
         <p style="text-align: justify">
           <strong style="color:#E01D71"><?= $nombre_creador ?></strong> te ha invitado a formar parte de su banda!.<br>
           Este es el mensaje que te dejó.
         </p>
         <p style="text-align: justify">
           <em>"<?php echo $message ?>"</em>
         </p>
         <p>
           Desafortunadamente aún no haces parte de nuestro sitio. Así que te invitamos a que te <a href="http://inshaka.com/~inshaka/nuevo/usuarios/registro/index/individual" style="color:#E01D71; text-decoration: none"><strong style="color:#E01D71">registres en InShaka</strong></a>, y puedas acceder a audiciones, conciertos, crear tu banda, buscar músicos y mucho más.
         </p>
         <p>
           Una vez hayas creado tu perfil en <a href="http://inshaka.com/~inshaka/nuevo/usuarios/registro/index/individual" style="color:#E01D71; text-decoration: none"><strong style="color:#E01D71">InShaka</strong></a> ingresa al Mis Bandas y dale click en <strong style="color:#E01D71">pertenezco a una banda</strong>, para registrar la banda a la que pertences y el instrumento que tocas. Si quieres saber más sobre nosotros o tienes alguna duda o pregunta <a href="http://inshaka.com/~inshaka/nuevo/entertainment" style="color:#E01D71; text-decoration: none"><strong style="color:#E01D71">haz click aquí</strong></a> y dejanos tu pregunta o escribenos a <strong style="color:#E01D71">info@inshaka.com</strong>
         </p>
         <p style="text-align: justify">
           Para ver el perfil de <?= $nombre_creador ?>,<br>
           haz click en: <a href="<?= $url_creador ?>"><img src="http://www.inshaka.com/nuevo/assets/images/email/ver_mas.png" /></a>
         </p>
         <p style="text-align: justify">
           Team InShaka<br>
           <strong style="color:#E01D71">InShaka Entertainment</strong>
         </p>
       </div>
       <div id="right" style="float: left; margin-top: -3px">
         <img src="http://www.inshaka.com/nuevo/assets/images/email/right_mail.png" width="325" height="334"/>
       </div>
     </div>
     <div style="margin-top: -6px;">
      <img src="http://www.inshaka.com/nuevo/assets/images/email/footer_mail.png" width="749" height="123" style="margin-top: -15px"/>
     </div>
    </div>
  </body>
</html>

