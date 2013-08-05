
<script type="text/javascript">
  $(document).ready(function() {
    $(".comboBox1").msDropDown().data("dd");


    $("#contenu3").scrollbar(430);
    
     var estado = 1;
        var estado2 = 0;
        $(".tab_content").hide();
        $(".t1").addClass("active").show();
		
        $(".tab_content:first").show();
        $("ul.tabs li").click(function()
        {
            if ($(this).is('.t3')) {
			  
            } else {
                $("ul.tabs li").removeClass("active");
                $(this).addClass("active");
                $(".tab_content").hide();
                $(".t3").css({
                    'opacity': "0.4"
                });
                var activeTab = $(this).find("a").attr("href");
                $(activeTab).fadeIn();
                return false;
            }
        });
       
    $(".t7").click(function()
        {
           
            if (estado2 == 0){
                $("#contenu4").scrollbar2(428);
                estado2 = 1;
            }
		
			
        });
  });
</script>


<style>
  .bgSlider{
    display:none;
  }
  .login{
    display:none;
  }
  .b2{
    color:#333 !important;	
  }
  .c6{
    color:#333 !important;	
  }
  .t4{
    display:none !important;		
  }
  .t4-active{
    display:none !important;	
  }
  #contenu3 {
    margin-bottom: 40px;
    width: 990px !important;
    margin-top: 40px;
  }
  #contenu3 #englobe {
    width: 970px !important;
  }
  .nuevas-audiciones {
    margin-top: 0;

  }
</style>


<div class="contenido" id="page-mis-audiciones">
  <div class="directorio-cont">
    <ul class="tabs">
      <li class="t1 active"><a href="#tab1">Mis Clasificados</a></li>
      <li class="t7"><a href="#tab2">Mis favoritos</a></li>
      <li class="t2"><a href="<?php echo site_url('clasificados/crear_anuncio') ?>">Crear</a></li>
    </ul>
  </div>

  <div class="clear"></div>
  <div class="tab_container">
    <div id="tab1" class="tab_content">
      
      <?php if (!empty($alert_messages)) : ?>
        <div><?php echo $alert_messages ?></div>
      <?php endif; ?>

      <?php if ($datos->exists()) : ?>

        <div class="nuevas-audiciones">
          <div id="contenu3">
            <?php foreach ($datos as $dato) : ?>


              <div class="resultado">
                <div class="audicion-info">
                  <div class="resultado-tit"><a href="<?php echo sprintf($urls->clasificado_detalle, $dato->id, $dato->var) ?>"><?php echo $datos->titulo ?></a></div>
                  <div class="audicion-datos">

                    <div class="audicion-lugar">Ciudad </br><b><?php echo $dato->ciudad ?></b></div>
                    <div class="audicion-fecha1">Fecha de inicio </br><b><?php echo fecha_spanish_full_short($dato->fecha_inicio) ?></b></div>
                    <div class="audicion-fecha2">Fecha de cierre </br><b><?php echo fecha_spanish_full_short($dato->fecha_cierre) ?></b></div>
                  </div>
                  <div class="clear"></div>
                </div>
                <div class="clr"></div>
                <div class="resultado-desc2"><?php echo $dato->descripcion ?></div>

                <div class="clr"></div>
                <div class="opciones-ico">
                  <div class="ver-mas"><a href="<?php echo sprintf($urls->clasificado_detalle, $dato->id, $dato->var) ?>">Ver más</a></div>
                  <a href="<?php echo site_url('perfil/clasificados/eliminar/' . $dato->id) ?>" onclick="return confirm('¿Está seguro de eliminar el clasificado?')"><div class="borrar">Borrar</div></a>
                  <a href="<?php echo site_url('clasificados/editar/' . $dato->id) ?>"><div class="editar">Editar</div></a>
                </div>

                <div class="clr"></div>
              </div>
            <?php endforeach; ?>

          </div>
        </div>
        <?php if ($datos->paged->total_pages > 1) : ?>
          <!-- Paginador -->
          <div class="paginador">
            <?php if ($datos->paged->has_previous) : ?>
              <a href="<?php echo sprintf($paginator_url, $datos->paged->previous_page) ?>"><div class="pag-prev"></div></a>
            <?php endif; ?>

            <div class="numeros">
              <?php for ($i = 1, $total_pages = $datos->paged->total_pages; $i <= $total_pages; $i++) : ?>
                <div class="<?php echo $i == $datos->paged->current_page ? 'numero-act' : 'numero' ?>">
                  <a href="<?php echo $i != $datos->paged->current_page ? sprintf($paginator_url, $i) : 'javascript:;' ?>">
                    <?php echo $i ?>
                  </a>
                </div>
              <?php endfor; ?>
            </div>

            <?php if ($datos->paged->has_next) : ?>
              <a href="<?php echo sprintf($paginator_url, $datos->paged->next_page) ?>"><div class="pag-next"></div></a>
            <?php endif; ?>
          </div>
          <!-- // Paginador -->
        <?php endif; ?>
        <?php else: ?>
        <div><p>
               No has creado ningún clasificado. Haz <a href="<?php echo site_url('clasificados/crear_anuncio') ?>" style="color: #E31873">click acá.</a> para crear un clasificado</p></div>
          <?php endif; ?>

      <div class="clr"></div>
    </div>
    
    <div id="tab2" class="tab_content">
      <?php if($favoritos->exists()) : ?>
      <div class="nuevas-audiciones">
        <div id="contenu3">
        <?php foreach ($favoritos as $clasificado) : ?>
        <div class="resultado">
          <div class="audicion-info">
            <div class="resultado-tit">
                <?= $clasificado->get_clasificado($clasificado->clasificados_id)->titulo ?>
            </div>
            <div class="audicion-datos">
              <div class="audicion-lugar">Ciudad </br><b><?= $clasificado->get_clasificado($clasificado->clasificados_id)->ciudad ?></b></div>
              <div class="audicion-fecha1">Fecha de inicio </br><b><?= fecha_spanish_full_short($clasificado->get_clasificado($clasificado->clasificados_id)->fecha_inicio) ?></b></div>
              <div class="audicion-fecha2">Fecha de cierre </br><b><?= fecha_spanish_full_short($clasificado->get_clasificado($clasificado->clasificados_id)->fecha_cierre) ?></b></div>
            </div>
            <div class="clear"></div>
          </div>
          <div class="clr"></div>
          <div class="resultado-desc2"><?= $clasificado->get_clasificado($clasificado->clasificados_id)->descripcion ?></div>
          <div class="clr"></div>
          <div class="opciones-ico">
            <div class="ver-mas"><a href="<?php echo sprintf($urls->clasificado_detalle, $clasificado->clasificados_id, $clasificado->get_clasificado($clasificado->clasificados_id)->var) ?>">Ver más</a></div>
            <a href="<?php echo site_url('perfil/clasificados/eliminar_favorito/'.$clasificado->id) ?>">
              <div class="borrar">Borrar</div>
            </a>
          </div>

          <div class="clr"></div>
        </div>
        <?php endforeach; ?>
        </div>
      </div>
       <?php if ($favoritos->paged->total_pages > 1) : ?>
          <!-- Paginador -->
          <div class="paginador">
            <?php if ($favoritos->paged->has_previous) : ?>
              <a href="<?php echo sprintf($paginator_url, $favoritos->paged->previous_page) ?>"><div class="pag-prev"></div></a>
            <?php endif; ?>

            <div class="numeros">
              <?php for ($i = 1, $total_pages = $favoritos->paged->total_pages; $i <= $total_pages; $i++) : ?>
                <div class="<?php echo $i == $favoritos->paged->current_page ? 'numero-act' : 'numero' ?>">
                  <a href="<?php echo $i != $favoritos->paged->current_page ? sprintf($paginator_url, $i) : 'javascript:;' ?>">
                    <?php echo $i ?>
                  </a>
                </div>
              <?php endfor; ?>
            </div>

            <?php if ($favoritos->paged->has_next) : ?>
              <a href="<?php echo sprintf($paginator_url, $favoritos->paged->next_page) ?>"><div class="pag-next"></div></a>
            <?php endif; ?>
          </div>
          <!-- // Paginador -->
        <?php endif; ?>
        <?php else: ?>
        <div><p> <h4>Aún no tienes ningun clasificado elegido como favorito. Para elegir un clasificado que te gusta, haz clic en <span style='color:#E82E7C'>'Clasificados'</span> en el menu. 
                        Luego, selecciona una categoria, un clasificado y haz clic en la estrella que aparece al lado del anuncio. El clasificado te aparecerá en <span style='color:#E82E7C'>'Mis Clasificados>Mis Favoritos'</span> para acceso directo.</h4>
      <?php endif; ?>

      <div class="clr"></div>
    </div>



    <div class="clr"></div>
  </div>
  <div class="clr"></div>
</div>