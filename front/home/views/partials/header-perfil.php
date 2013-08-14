<?php if ($show_header_perfil) : ?>
<?php if($es_usuario) : ?>
  <?php if($userinfo->is_proveedor): ?>
    <div class="menu-perfil">
      <ul>
        <a href="<?php echo site_url('perfil') ?>"><li class="c1">Mishaka</li></a>
        <a href="<?php echo site_url('perfil/social') ?>"><li class="c2">Mis Fans</li></a>
<!--        <a href="<?php //echo site_url('perfil/conciertos') ?>"><li class="c3">Mis conciertos</li></a>-->
        <a href="<?php echo site_url('perfil/audiciones') ?>"><li class="c4">Mis audiciones</li></a>
        <a href="<?php echo site_url('perfil/directorios') ?>"><li  class="c5">Mis directorios</li></a>
        <a href="<?php echo site_url('perfil/clasificados') ?>"><li class="c6">Mis clasificados</li></a>
        <div class="clr"></div>
        <div class="perfil-tit">perfil privado de proveedor: <?php echo $current_username ?></div>
      </ul>
    </div>
  <?php else: ?>
    <div class="menu-perfil">
      <ul>
        <a href="<?php echo site_url('perfil') ?>"><li class="c1">Mishaka</li></a>
        <a href="<?php echo site_url('perfil/social') ?>"><li class="c2">Mis Fans</li></a>
        <a href="<?php echo site_url('perfil/build-a-band') ?>"><li class="c3">Mis bandas</li></a>
        <!-- <a href="<?php //echo site_url('perfil/conciertos') ?>"><li class="c3">Mis conciertos</li></a> -->
        <a href="<?php echo site_url('perfil/audiciones') ?>"><li class="c4">Mis audiciones</li></a>
        <a href="<?php echo site_url('perfil/directorios/favoritos') ?>"><li  class="c5">Mis directorios</li></a>
        <a href="<?php echo site_url('perfil/clasificados') ?>"><li class="c6">Mis clasificados</li></a>
        <a href="<?php echo site_url('perfil/configuracion') ?>"><li class="c7">Ajustes</li></a>
        <div class="clr"></div>
        <div class="perfil-tit">perfil privado de músico: <?php echo $current_username ?></div>
      </ul>
    </div>
  <?php endif; ?>
<?php endif; ?>
<?php endif; ?>