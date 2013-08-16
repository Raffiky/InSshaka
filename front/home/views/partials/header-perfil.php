<?php if ($show_header_perfil) : ?>
<?php if($es_usuario) : ?>
  <?php if($userinfo->is_proveedor): ?>
    <div class="menu-perfil">
      <ul>
        <a href="<?php echo site_url('perfil') ?>"><li class="c1"><?= lang('mishaka') ?></li></a>
        <a href="<?php echo site_url('perfil/social') ?>"><li class="c2"><?= lang('my_fans') ?></li></a>
<!--        <a href="<?php //echo site_url('perfil/conciertos') ?>"><li class="c3">Mis conciertos</li></a>-->
        <a href="<?php echo site_url('perfil/audiciones') ?>"><li class="c4"><?= lang('my_audition') ?></li></a>
        <a href="<?php echo site_url('perfil/directorios') ?>"><li  class="c5"><?= lang('my_directory') ?></li></a>
        <a href="<?php echo site_url('perfil/clasificados') ?>"><li class="c6"><?= lang('my_classified') ?></li></a>
        <div class="clr"></div>
        <div class="perfil-tit"><?= lang('text_profile_provider') ?>perfil privado de proveedor: <?php echo $current_username ?></div>
      </ul>
    </div>
  <?php else: ?>
    <div class="menu-perfil">
      <ul>
        <a href="<?php echo site_url('perfil') ?>"><li class="c1"><?= lang('mishaka') ?></li></a>
        <a href="<?php echo site_url('perfil/social') ?>"><li class="c2"><?= lang('my_fans') ?></li></a>
        <a href="<?php echo site_url('perfil/build-a-band') ?>"><li class="c3"><?= lang('my_band') ?></li></a>
        <!-- <a href="<?php //echo site_url('perfil/conciertos') ?>"><li class="c3">Mis conciertos</li></a> -->
        <a href="<?php echo site_url('perfil/audiciones') ?>"><li class="c4"><?= lang('my_audition') ?></li></a>
        <a href="<?php echo site_url('perfil/directorios/favoritos') ?>"><li  class="c5"><?= lang('my_directory') ?></li></a>
        <a href="<?php echo site_url('perfil/clasificados') ?>"><li class="c6"><?= lang('my_classified') ?></li></a>
        <a href="<?php echo site_url('perfil/configuracion') ?>"><li class="c7"><?= lang('settings') ?></li></a>
        <div class="clr"></div>
        <div class="perfil-tit"><?= lang('text_profile_player') ?>perfil privado de músico: <?php echo $current_username ?></div>
      </ul>
    </div>
  <?php endif; ?>
<?php endif; ?>
<?php endif; ?>