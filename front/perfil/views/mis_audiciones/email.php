<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title></title>
  </head>
  <body>
    <p><img src="http://inshaka.com/imagenes_mailing/templatehigh.png" width="749" /></p>   
    <p>Hola, <strong style="color:#E01D71"><?= $username ?></strong></p><br>
    <p style="text-align: justify">
      <?php if($aceptado == 1) : ?>
     <strong style="color:#E01D71">Felicitaciones!</strong> Tu aplicación ha sido aceptada.
   <?php else : ?>
     <strong style="color:#E01D71">Lamentablemente</strong> Tu aplicación ha sido rechazada.
   <?php endif; ?>
    </p>
    <p style="text-align: justify">
      Los datos de la audición son los siguientes:
    </p>
    <p style="text-align: justify">
      Nombre : <?= $audicion ?><br>
      Fecha  : <?= $fecha ?><br>
      Dirección  : <?= $direccion ?><br>
      Talento  : <?= $talento ?>
    </p>
    <p style="text-align: justify">
      Para ver esta y otras audiciones a las que haz aplicado, haz click en <a href="http://inshaka.com/~inshaka/nuevo/perfil/audiciones"><img src="http://www.inshaka.com/nuevo/assets/images/email/mis_audiciones.png" /></a>
    </p>
    <p style="text-align: justify">
      Team InShaka<br>
      <strong style="color:#E01D71">InShaka Entertainment</strong>
    </p>

    <p><img src="http://inshaka.com/imagenes_mailing/templatelow.png"></p>
  </body>
</html>