<div class="bgEncabezado">
    <div class="conEncabezado">
        <div id="txSeccion">
            <div class="encabezado-tit">Que estas buscando?</div>
            <div class="encabezado-subtit">Encuentra músicos, audiciones, bandas, clasificados y más...</div>
        </div>
    </div>
</div>
<div class="contenido">
  <?php if(!empty($find_user) || !empty($find_band) || !empty($find_audiciones) || !empty($find_clasificados) || !empty($find_directorio)): ?>
  <!-- Cargando usuarios -->
  <?php if(!empty($find_user)) : ?>
    <?php if($find_user->exists()) : ?>
    <div class="resultados-perfil">
      <div class="resultados">Resultados encontrados <b>(<?php echo $find_user->paged->total_rows; ?>)</b> para músicos</div>
      <?php foreach ($find_user as $f_user) : ?>
      <div class="res-perfil">
        <div class="foto-banda">
          <a href="<?php echo site_url('perfil/' . $f_user->inshaka_url) ?>" style="display:block; height:201px; overflow:hidden;">
            <?php if(!$user_photo->get_photo($f_user->id)) : ?>
              <img src="images/imagensino.png" style="width:253px;" >
            <?php else: ?>
             <img width="253" height="205" src="<?php echo uploads_url($user_photo->get_photo($f_user->id)) ?>" style="width:253px;">
            <?php endif; ?>
          </a>
          <div class="res-datos">
            <div class="res-txt">Nombre: <b><?php echo $f_user->first_name.' '.$f_user->last_name ?></b></div>
            <div class="res-txt">Género: 
              <?php if ($f_user->musical_gender->limit(3)->get()->exists()) : ?>
                <b>
                  <?php foreach ($f_user->musical_gender as $musical_gender) : ?>
                      <?php echo $musical_gender->name . (next($f_user->musical_gender) == true ? ',' : null) ?>
                  <?php endforeach; ?>
                </b>
              <?php else: ?>
                <b>No definido(s)</b>
              <?php endif; ?>
            </div>
            <div class="res-txt">Talento: 
              <?php if ($f_user->talent->limit(3)->get()->exists()) : ?>
                <b>
                  <?php foreach ($f_user->talent as $talent) : ?>
                    <?php echo $talent->talents_category->name, ' ', $talent->name . (next($f_user->talent) == true ? ',' : null) ?>
                  <?php endforeach; ?>
                </b>
              <?php else: ?>
                <b>No definido(s)</b>
              <?php endif; ?>
            </div>
          </div>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
    <?php else : ?>
      <div class="resultados">Su búsqueda no produjo resultados.</div>
    <?php endif; ?>
  <?php endif; ?>
  <!-- Fin de usuarios -->
  <div class="clear"></div>
  <!-- Cargando bandas -->
  <?php if(!empty($find_band)) : ?>
    <?php if($find_band->exists()) : ?>
    <div class="resultados-perfil">
      <div class="resultados">Resultados encontrados <b>(<?php echo $find_band->paged->total_rows; ?>)</b> para bandas</div>
      <?php foreach ($find_band as $f_band) : ?>
        <div class="res-perfil">
          <div class="foto-banda">
            <a href="<?php echo site_url('perfil/pagina/' . $f_band->var) ?>" style="display:block; height:201px; overflow:hidden;">
              <?php $profile_band = $f_band->page->pages_photo->where('profile_active', true)->get() ?>
              <?php if($profile_band->exists()) : ?>
                <img  src="<?= uploads_url($profile_band->thumb) ?>" style="width: 253px; height: 205px;" />
              <?php else :?>
                <img  src="images/imagensino.png" style="width: 253px; height: 205px;" />
              <?php endif; ?>
            </a>
            <div class="res-datos">
              <div class="res-txt">Banda: <b><?php echo $f_band->name ?></b></div>
              <div class="res-txt">Género principal: <b><?php echo $f_band->musical_gender->name ?></b></div>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
    <?php endif; ?>
  <?php endif; ?>
  <!-- Fin de bandas -->
  <div class="clear"></div>
  <!-- Cargando audiciones -->
  <?php if(!empty($find_audiciones)) : ?>
    <?php if($find_audiciones->exists()) : ?>
    <div class="resultados-perfil">
      <div class="resultados">Resultados encontrados <b>(<?= $find_audiciones->paged->total_rows; ?>)</b> para audiciones</div>
      <?php foreach ($find_audiciones as $f_audiciones) : ?>
        <div class="res-perfil">
          <div class="foto-banda">
            <a href="<?= sprintf($urls->audicion_detalle, $f_audiciones->id, $f_audiciones->var) ?>" style="display:block; height:201px; overflow:hidden;">
              <?php if (!empty($f_audiciones->imagen)) : ?>
                <img  src="<?= uploads_url($f_audiciones->imagen) ?>" style="width: 253px; height: 205px;" />
              <?php else :?>
                <img  src="images/imagensino.png" style="width: 253px; height: 205px;" />
              <?php endif; ?>
            </a>
            <div class="res-datos">
              <div class="res-txt">Audición: <b><?php echo $f_audiciones->titulo ?></b></div>
              <?php if($f_audiciones->tipo_audicion == 'Individual') : ?>
                <div class="res-txt">Talento: <b><?php echo $f_audiciones->talent->name ?></b></div>
              <?php else: ?>
                <div class="res-txt">Género: <b><?php echo $f_audiciones->musical_gender->name ?></b></div>
              <?php endif; ?>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
    <?php endif; ?>
  <?php endif; ?>
  <!-- Fin audiciones -->
  <div class="clear"></div>
  <!-- Cargando clasificados -->
  <?php if(!empty($find_clasificados)) : ?>
    <?php if($find_clasificados->exists()) : ?>
    <div class="resultados-perfil">
      <div class="resultados">Resultados encontrados <b>(<?= $find_clasificados->paged->total_rows; ?>)</b> para clasificados</div>
      <?php foreach ($find_clasificados as $f_clasificado) : ?>
      <div class="res-perfil">
        <div class="foto-banda">
          <a href="<?= sprintf($urls->clasificado_detalle, $f_clasificado->id, $f_clasificado->var) ?>" style="display:block; height:201px; overflow:hidden;">
            <?php if (!empty($f_clasificado->imagen)) : ?>
              <img  src="<?= uploads_url($f_clasificado->imagen) ?>" style="width: 253px; height: 205px;" />
            <?php else :?>
              <img  src="images/imagensino.png" style="width: 253px; height: 205px;" />
            <?php endif; ?>
          </a>
          <div class="res-datos">
            <div class="res-txt">Clasificado: <b><?php echo $f_clasificado->titulo ?></b></div>
          </div>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
    <?php endif; ?>
  <?php endif; ?>
  <!-- Fin clasificados -->
  <div class="clear"></div>
  <!-- Cargando directorio -->
  <?php if(!empty($find_directorio)) : ?>
    <?php if($find_directorio->exists()) : ?>
    <div class="resultados-perfil">
      <div class="resultados">Resultados encontrados <b>(<?php echo $find_directorio->paged->total_rows; ?>)</b> para directorio</div>
      <?php foreach ($find_directorio as $f_directorio) : ?>
      <div class="res-perfil">
        <div class="foto-banda">
          <a href="<?php echo site_url('perfil/' . $f_directorio->inshaka_url) ?>" style="display:block; height:201px; overflow:hidden;">
            <?php if(!$user_photo->get_photo($f_directorio->id)) : ?>
              <img src="images/imagensino.png" style="width:253px;" >
            <?php else: ?>
             <img width="253" height="205" src="<?php echo uploads_url($user_photo->get_photo($f_directorio->id)) ?>" style="width:253px;">
            <?php endif; ?>
          </a>
          <div class="res-datos">
            <div class="res-txt">Nombre: <b><?php echo $f_directorio->name_proveedor ?></b></div>
          </div>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
    <?php else : ?>
      <div class="resultados">Su búsqueda no produjo resultados.</div>
    <?php endif; ?>
  <?php endif; ?>
  <!-- Fin de directorio -->
  <?php else : ?>
  <div class="resultados">Su búsqueda no produjo resultados.</div>
  <?php endif; ?>
</div>