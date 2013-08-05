<script>
$(function() {
  $( "#city_audicion" ).autocomplete({
    source: function( request, response ) {
        $.ajax({
            url: "http://ws.geonames.org/searchJSON",
            dataType: "jsonp",
            data: {
                featureClass: "P",
                style: "full",
                maxRows: 12,
                name_startsWith: request.term
            },
            success: function( data ) {
                response( $.map( data.geonames, function( item ) {
                    return {
                        label: item.name + (item.adminName1 ? ", " + item.adminName1 : "") + ", " + item.countryName,
                        value: item.name
                    }
                }));
            }
        });
    },
    minLength: 2,
    select: function( event, ui ) {
        log( ui.item ?
            "Selected: " + ui.item.label :
            "Nothing selected, input was " + this.value);
    },
    open: function() {
        $( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
    },
    close: function() {
        $( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
    }
  });
})
</script>
<!-- Buscador -->
<div class="selectores">
  <form action="<?php echo site_url('audiciones/buscar_band') ?>" method="get" accept-charset="utf8" class="buscar">    
    <div class="clr"></div>
    <div class="sebusca2">
      <div class="band-ico2">1</div>
      <div class="band-tit">Selecciona de los siguientes criterios la opción adecuada para iniciar tu búsqueda</div>
      <div class="campo-reg-lab" style="width: 165px;">
        <label style="padding-left: 4px;">Ciudad</label>
        <div class="selectBox">
          <input type="text" name="ciudad" id="city_audicion" class="campo2" placeholder="Ciudad"/>
        </div>
      </div>
      <div class="campo-reg-lab" style="width: 165px;">
        <label style="padding-left: 4px;">Género</label>
        <div class="selectBox" id="select-medio">
          <?php echo form_dropdown('musical_gender_id',$genders, null,'style="width:188px;" class="comboBox1"') ?>
        </div>
      </div>
      <div class="campo-reg-lab" style="width: 165px; margin-left: 30px;">
        <label style="padding-left: 4px;">Nº aplicaciones</label>
        <input name="numero_aplicaciones" type="number" class="campo2" min="1" max="100" value="<?=$this->input->get('numero_aplicaciones') ?>"  />
      </div>
      <div class="campo-reg-lab" style="width: 165px; margin-top: 15px;">
        <input class="bot-buscar" type="submit" value="buscar" style="float:left;">
      </div>
    </div>
  </form>
  <div class="clr"></div>
</div>
<!-- // Buscador -->

<?php if ($datos->exists()) : ?>

  <div class="ordena-lista">
      <div class="ordena-lista-tit">Ordenar resultados por:</div>
      <div class="ordena-lista-filtro"><a href="?order=numero_aplicaciones&type=<?php echo $this->input->get('order') == 'numero_aplicaciones' ? ($this->input->get('type') == 'asc' ? 'desc' : 'asc') : 'asc' ?>">No. Aplicaciones</a></div>
      <div class="ordena-lista-filtro"><a href="?order=ciudad&type=<?php  echo $this->input->get('order') == 'ciudad' ? ($this->input->get('type') == 'asc' ? 'desc' : 'asc') : 'asc' ?>">Ciudad</a></div>
      <div class="ordena-lista-filtro"><a href="?order=fecha_inicio&type=<?php echo $this->input->get('order') == 'fecha_inicio' ? ($this->input->get('type') == 'asc' ? 'desc' : 'asc') : 'asc' ?>">Fecha de inicio</a></div>
      <div class="ordena-lista-filtro"><a href="?order=fecha_cierre&type=<?php echo $this->input->get('order') == 'fecha_cierre' ? ($this->input->get('type') == 'asc' ? 'desc' : 'asc') : 'asc' ?>">Fecha de cierre</a></div>
      <div class="ordena-lista-filtro" style="margin-right:0;"><a href="?order=fecha_audicion&type=<?php echo $this->input->get('order') == 'fecha_audicion' ? ($this->input->get('type') == 'asc' ? 'desc' : 'asc') : 'asc' ?>">Fecha de audición</a></div>
      <div class="clear"></div>
  </div>
  <div class="clear"></div>
  <div class="nuevas-audiciones">
    <div id="contenu3" style="z-index:600 !important;">
      <?php foreach ($datos as $dato) : ?>
        <div class="audicion">
          <div class="audicion-info">
            <?php if (!empty($dato->imagen)){ ?>
              <div class="audicion-ico">
                <img src="<?php echo uploads_url($dato->imagen) ?>" width="41" />
              </div>
            <?php }else{ ?>
             <div class="audicion-ico">
                 <img src="<?php echo base_url('assets/images/imagensino.png') ?>" width="41" />
              </div>               
              <?php
            } ?>
            <div class="audicion-tit" style="width: 300px">
              <a href="<?= $es_usuario ? sprintf($urls->audicion_detalle, $dato->id, $dato->var) :  site_url('usuarios/login?continue-uri=audicion/'.$dato->id.'/'.$dato->var)?>">
                <?= $dato->tipo_audicion == "Individual" ? $dato->titulo." : <span style='color:#E82E7C'> Talento ".$dato->talent->talents_category->name." ".$dato->talent->name."</span>" : $dato->titulo." : <span style='color:#E82E7C'>Genero ".$dato->musical_gender->name."</span>" ?>
              </a>
              <div class="audicion-post">Creado el <?php echo fecha_spanish_full($dato->created_on) ?></div>
              
              <div class="fb-like" data-href="<?php echo sprintf($urls->audicion_detalle, $dato->id, $dato->var) ?>" data-layout="button_count" data-width="100" data-show-faces="false" style="margin:10px 0 0 0;"></div>
              
			  
            </div>
            <div class="clr"></div>
            <div class="audicion-datos">
              <div class="num-cupos">No. Aplicaciones
                <b>
                  <?php if ($dato->total_aplicaciones <= $dato->numero_aplicaciones) : ?>
                    <?php echo $dato->audiciones_aplicacion->count() ?>/<?php echo $dato->numero_aplicaciones ?>
                  <?php else: ?>
                    Sin cupo
                  <?php endif; ?>
                </b>
              </div>
              <div class="audicion-lugar">Ciudad </br><b><?php echo $dato->ciudad ?></b></div>
              <div class="audicion-fecha1">Fecha de inicio </br><b><?php echo fecha_spanish_full_short($dato->fecha_inicio) ?></b></div>
              <div class="audicion-fecha1">Fecha de cierre </br><b><?php echo fecha_spanish_full_short($dato->fecha_cierre) ?></b></div>
              <div class="audicion-fecha2">Fecha de audición </br><b><?php echo fecha_spanish_full_short($dato->fecha_audicion) ?></b></div>
            </div>
          </div>
          <div class="clr"></div>
          <div class="audicion-txt"><?php echo $dato->descripcion ?>.</div>
          <div class="ver-mas"><a href="<?= $es_usuario ? sprintf($urls->audicion_detalle, $dato->id, $dato->var) :  site_url('usuarios/login?continue-uri=audicion/'.$dato->id.'/'.$dato->var)?>">Ver más</a></div>
          <div class="clr"></div>
        </div>

      <?php endforeach; ?>

    </div>
    
  </div>


<?php endif; ?>

<div class="clr"></div>

