<script type="text/javascript">
  $(function(){
    $('.favorite-advertisement, .myself_favorites').tooltipster({
      theme: '.my-custom-theme',
      arrow: true,
      animation: 'grow',
      arrowColor: '#DE2773'
    });   
  });
  function addfavorite(elemento, id) {
    $("#anuncio-" + elemento).dialog({
      resizable: false,
      modal: true,
      show : 'drop',
      hide : 'drop',
      width: '400px',
      buttons: {
        "Aceptar": function() { 
          $.getJSON('<?= site_url("directorios/directorios/add_favorite") ?>', {
            id : id
          }, function() {
            location.reload();
          });
          return $(this).dialog('close');
        },
        Cancel: function() {
          $( this ).dialog("close");
        }
      }
    })
  }
</script>
<div class="bgEncabezado">
    <div class="conEncabezado">
        <div id="txSeccion">
            <div class="encabezado-tit"><?php echo $datos->name ?></div>
            <div class="encabezado-subtit"><?php echo $datos->description ?></div>
        </div>
    </div>
</div>

<div class="contenido">

    <div id="contenu5">
        <?php if ($datos->anuncios->exists()) : ?>
            <?php foreach ($datos->anuncios as $directorio) : ?>
                <div class="resultado">
                  <?php if($es_usuario) : ?>
                    <?php if(!$favorito->get_favorite($directorio->id)->exists()) : ?>
                    <div class="favorite-advertisement" title="Añadir este anuncio a mis favoritos." onclick="addfavorite('<?= $directorio->code ?>', <?= $directorio->id ?>);"></div>
                    <div id="anuncio-<?= $directorio->code ?>" title="Agregar a favoritos" style="display:none">
                      <p>
                        Estás seguro que deseas agregar este anuncio a tus favoritos?
                      </p>
                    </div>
                    <?php else : ?>
                    <div class="myself_favorites" title="Este anuncio ya es uno de tus favoritos"></div>
                    <?php endif; ?>
                  <?php endif; ?>
                    <a href="<?php echo site_url('perfil/'.$user->get_provider($directorio->user_id)) ?>">
                        <?php if (!empty($directorio->logo)) : ?>
                            <div class="logo-anuncio" style="float:left;">
                                <img width="120" src="<?php echo uploads_url($directorio->logo) ?>" alt="Logo de anuncio: <?php echo $directorio->empresa ?>" /> 
                            </div>
                        <?php else: ?>
                            <div class="resultado-ico"></div>
                        <?php endif; ?>
                    </a>
                    <a href="<?php echo site_url('perfil/'.$user->get_provider($directorio->user_id)) ?>">
                        <div class="resultado-nom">
                            <div class="resultado-empresa"><?php echo $directorio->empresa ?></div>
                            <div class="resultado-calle"><?php echo $directorio->direccion ?></div>
                            <div class="resultado-tel">Tel. <?php echo $directorio->telefono ?></div>
                        </div>
                    </a>
                    <div class="resultado-desc" style="overflow: hidden"><?php echo substr($directorio->descripcion , 0, 250) ?> ...</div>

                    <div class="opciones-ico">
                        <div class="ver-mas"><a href="<?php echo site_url('perfil/'.$user->get_provider($directorio->user_id)) ?>">Ver más</a></div>

                    </div>

                    <div class="resultado-redes" style="display:none;">
                        <div class="resultado-red"><img src="images/logo-face.png" /></div>
                        <div class="resultado-red"><img src="images/logo-twit.png" /></div>
                        <div class="resultado-red"><img src="images/logo-you.png" /></div>
                    </div>
                    <div class="clr"></div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <h4>No hay ningún anuncio disponible para esta categoria, regrese al <a href="<?php echo site_url('directorio') ?>">directorio para seguir navegando.</a></h4>
        <?php endif; ?>
    </div>

    <?php if ($datos->anuncios->exists() && $datos->anuncios->paged->total_rows > 10) : ?>
        <!-- Paginador -->
        <div class="paginador">
            <?php if ($datos->anuncios->paged->has_previous) : ?>
                <a href="<?= site_url(array('directorio', 'categoria', 'index', $datos->var,  $datos->anuncios->paged->previous_page )) ?>"><div class="pag-prev"></div></a>
            <?php endif; ?>

            <div class="numeros">
                <?php for ($i = 1, $total_pages = $datos->anuncios->paged->total_pages; $i <= $total_pages; $i++) : ?>
                    <a href="<?= site_url(array('directorio', 'categoria', 'index', $datos->var,  $i )) ?>"><div class="numero"><?php echo $i ?></div></a>
                <?php endfor; ?>
            </div>

            <?php if ($datos->anuncios->paged->has_next) : ?>
                <a href="<?= site_url(array('directorio', 'categoria', 'index', $datos->var,  $datos->anuncios->paged->next_page )) ?>"><div class="pag-next"></div></a>
            <?php endif; ?>
        </div>
        <!-- // Paginador -->
    <?php endif; ?>

    <div class="clr"></div>
</div>