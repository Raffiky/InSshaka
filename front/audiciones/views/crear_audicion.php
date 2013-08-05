<style type="text/css">
  #msdrpdd20_titletext, #msdrpdd21_titletext, #msdrpdd22_titletext, #msdrpdd23_titletext {
    background-image: none;
  }
</style>
<div class="selectores">
  <?php echo form_open_multipart('audiciones/save/' . ($edit_mode ? $datos->id : null), 'id="crear-form"', array('edit_mode' => $edit_mode)) ?>

  <?php if (!empty($alert_messages)) : ?>
    <div><?php echo $alert_messages ?></div>
  <?php endif; ?>


  <div class="clr"></div>
  <div class="campo-reg-lab" style="width: 320px;">
    <label style="padding-left: 4px;">Título</label>
     <div id='first-help' class="help-inshaka" title="<span class='title-help'>Título de la audición</span>
        <div class='content-help'>
        <p>Escríbe un título para la audición. Entre más creativo y directo, mejor!</p>
           <button class='bot-logout' data-next-help='#second-help' style='border: 0px;' onclick='disparador($(this));'>siguiente</button>
           </div>" 
        style="float:right; margin-left: 45px; margin-top: -20px; position:absolute">
   </div>
    <input name="titulo" type="text" class="campo" placeholder="Cual es el nombre de tu audición?" value="<?php echo $edit_mode ? $datos->titulo : $this->input->post('titulo') ?>" />
  </div>

  <div class="campo-reg-lab" style="width: 320px;">
    <label style="padding-left: 4px;">Ciudad, Municipio o barrio</label>
         <div id='second-help' class="help-inshaka" title="<span class='title-help'>Ubicación de la Audición</span>
        <div class='content-help'>
        <p>En que ciudad va a ser tu audición?</p>
           <button class='bot-logout' data-next-help='#third-help' style='border: 0px;' onclick='disparador($(this));'>siguiente</button>
           </div>" 
        style="float:right; margin-left: 176px; margin-top: -20px; position: absolute">
   </div>
    <input name="ciudad" id="city"  type="text" class="campo" value="<?php echo $edit_mode ? $datos->ciudad : $this->input->post('ciudad') ?>"  />
  </div>

  <div class="campo-reg-lab" style="width: 320px;">
    <label style="padding-left: 4px;">Contacto</label>
    <div id='third-help' class="help-inshaka" title="<span class='title-help'>Información de Contacto</span>
        <div class='content-help'>
        <p>Ingresa un número para que te contacten.</p>
           <button class='bot-logout' data-next-help='#fourth-help' style='border: 0px;' onclick='disparador($(this));'>siguiente</button>
           </div>" 
        style="float:right; margin-left: 66px; margin-top: -20px;position:absolute">
   </div>
    <input name="contacto" type="text" class="campo" placeholder="Ingresa un número de contacto" value="<?php echo $edit_mode ? $datos->contacto : $this->input->post('contacto') ?>" />
    <div class="clr"></div>
  </div>
  <div class="fecha2" ><div class="audicion-fecha1" style=" margin-top: 21px;"><label for="fecha_inicial">Fecha inicial<br><b>de Publicación</b></label></div></div>
  
  <div class="clr"></div>
   </div>
  <input name="fecha_inicio" id="fecha_inicial" type="text" class="campo2" placeholder="Año - Mes - Día" readonly="true" value="<?php echo $edit_mode ? $datos->fecha_inicio : $this->input->post('fecha_inicio') ?>"  />
  <div class="campo-reg-lab" style="margin-top: -16px; width: 190px;">
    <label style="padding-left: 4px;">Días de publicación</label>
    <div id='fourth-help' class="help-inshaka" title="<span class='title-help'>Días de publicación</span>
        <div class='content-help'>
        <p>Ingresa acá los días que va a estar disponible la audición para que la gente aplique a ella.</p>
        <button class='bot-logout' data-next-help='#fifth-help' style='border: 0px;' onclick='disparador($(this));'>siguiente</button>
        </div>" 
        style="float:right; margin-left: 133px; margin-top: -20px;position:absolute">
   </div>
    <div class="selectBox" id="select-medio">
      <select style="width:190px;" class="comboBox1" name="dias_publicacion" >
        <option  value="">Seleccione</option>
        <?php for ($i = 1; $i <= 30; $i++): ?>
          <option value="<?php echo $i ?>"><?php echo $i ?></option>
        <?php endfor; ?>
      </select>
      <div class="clr"></div>
    </div>
  </div>  
  
  <div class="campo-reg-lab" style="width: 175px;margin-top: -16px;">
    <label style="padding-left: 4px;">Talento</label>
    <div id='fifth-help' class="help-inshaka" title="<span class='title-help'>Talento</span>
        <div class='content-help'>
        <p>Elige acá si es una audición para banda, solista, o un talento específico</p>
        <button class='bot-logout' data-next-help='#sixth-help' style='border: 0px;' onclick='disparador($(this));'>siguiente</button>
        </div>" 
        style="float:right; margin-left: 56px; margin-top: -20px;position:absolute">
   </div>
    
    <div class="selectBox" id="select-medio">
        <?php echo form_dropdown('talent_id', $talents, (!empty($datos->talent_id) ? $datos->talent_id : null), 'style="width:188px;"   class="comboBox1"') ?>
        <div class="clr"></div>
    </div>
</div>
  
  <div class="campo-reg-lab" style="width: 190px; margin-top: -16px; margin-left: 20px;">
    <label style="padding-left: 4px;">Tipo de audición</label>
     <div id='sixth-help' class="help-inshaka" title="<span class='title-help'>Que tipo de Audición es?</span>
        <div class='content-help'>
        <p><br>Elige acá si es una audición para banda ó un talento específico.</p>
        <button class='bot-logout' data-next-help='#seventh-help' style='border: 0px;' onclick='disparador($(this));'>siguiente</button>
        </div>" 
        style="float:right; margin-left: 116px; margin-top: -20px;position:absolute">
   </div>
    <div class="selectBox" id="select-medio">
      <?php echo form_dropdown('tipo_audicion', array('Individual' => 'Músico', 'Banda' => 'Banda'), (!empty($datos->tipo_audicion) ? $datos->tipo_audicion : 'Individual'), 'onchange="mostrar_ocultar(this.value);" style="width:190px;" class="comboBox1"') ?>
    </div>
  </div>  
  
  
   <div class="campo-reg-lab" id="genero_banda" style="width: 190px; margin-top: -16px; margin-left: 6px; display: none">
    <label style="padding-left: 4px;">Género</label>
    <div class="help-inshaka" title="<span class='title-help'>Género</span>
        <div class='content-help'>
        <p>Elige un género musical para tu audición.</p>
        <p>Selecciona el género de la banda que quieres audicionar, si no quieres limitarte a un solo género, haz click en <span style='color: #E82E7C'>'Todos'.</span></p>
        </div>" 
        style="float:right; margin-left: 56px; margin-top: -20px;position:absolute">
   </div>
    <div class="selectBox" id="select-medio">
      <?php echo form_dropdown('musical_gender_id', $genders, (!empty($datos->musical_gender_id) ? $datos->musical_gender_id : 36), 'style="width:190px;"   class="comboBox1"') ?>
      <div class="clr"></div>
    </div>
  </div>
  
  <div class="clr"></div>
  <div class="fecha-audicion" style="margin-top: 42px; width: 163px; float: left; height: 32px;">
  <div class="fecha2"><div class="audicion-fecha1" style=" margin-top: -42px; width: 90px;"><label for="fecha_audicion">Fecha y hora de<br><b> Audición</b></label></div></div>
  <input style="margin-top: -53px;" name="fecha_audicion" id="fecha_audicion" type="text" class="campo2" placeholder="Año - Mes - Día" readonly="true" value="<?php echo $edit_mode ? $datos->fecha_audicion : $this->input->post('fecha_audicion') ?>"  />
  </div>
  <div class="campo-reg-lab" style="margin-top: 25px; width: 320px;">
    <label style="padding-left: 4px;">Dirección</label>
    <div id='seventh-help' class="help-inshaka" title="<span class='title-help'>Dónde va a ser la Audición?</span>
        <div class='content-help'>
        <p><br>Ingresa la dirección del lugar de la audición.</p>
        <button class='bot-logout' data-next-help='#eighth-help' style='border: 0px;' onclick='disparador($(this));'>siguiente</button>
        </div>" 
        style="float:right; margin-left: 66px; margin-top: -20px;position:absolute">
   </div>
    <input name="direccion_audicion" type="text" class="campo" placeholder="Dirección para presentar la audición" value="<?php echo $edit_mode ? $datos->direccion_audicion : $this->input->post('direccion_audicion') ?>" />
  </div>
  
  
  <div class="campo-reg-lab" style="width: 175px; margin-left: 0px; margin-top: 25px;">
    <label style="padding-left: 4px;">Nº aplicaciones</label>
    <div id='eighth-help' class="help-inshaka" title="<span class='title-help'>Cuantos cupos disponibles hay para la audición?</span>
        <div class='content-help'>
        <p><br>Escóge el número máximo de personas que pueden aplicar a tu audición.</p>
        <button class='bot-logout' data-next-help='#ninth-help' style='border: 0px;' onclick='disparador($(this));'>siguiente</button>
        </div>" 
        style="float:right; margin-left: 106px; margin-top: -20px;position:absolute">
   </div>
    <input name="numero_aplicaciones" type="number" class="campo2" min="1" max="100"  value="<?php echo $edit_mode ? $datos->numero_aplicaciones : $this->input->post('numero_aplicaciones') ?>"  />

    <div class="clr"></div>
  </div>
    
  
  <div class="clr"></div>
  <div id='ninth-help' class="help-inshaka" title="<span class='title-help'>Carta de Presentacíon</span>
        <div class='content-help'>
        <p><br>Escríbe un mensaje con datos adicionales que puedan complementar tu perfil.</p>
        <button class='bot-logout' style='border: 0px;' onclick='closetooltip (this)'>Cerrar</button>
        </div>" 
        style="float:right; margin-left: 6px; margin-top: -0px;position:absolute">
   </div>
  <div class="area-cont1"><textarea name="descripcion" class="area1" placeholder="Descripción (220 Caracteres)" maxlength="220"><?php echo $edit_mode ? $datos->descripcion : $this->input->post('descripcion') ?></textarea></div>
  
  <div class="clr"></div>
  <div style="margin: 2em 0;" class="carga-tit">
    <h3>Imagen de la audición:</h3>
    <?php if ($edit_mode && !empty($datos->imagen)) : ?>
      <img src="<?php echo uploads_url($datos->imagen) ?>" />
    <?php endif; ?>


    <div class="clear"></div>
    <small style="font-size: .8em;"><?php echo $edit_mode ? 'Cambiar: ' : null ?></small><input type="file" name="imagen" id="imagen" />
    <div class="acotacion-campo3">Tamaño de la imagen: ( 40x40 px )</div>
  </div>
  
  <input type="submit" class="bot-publicar" style="float: left;" value="<?php echo $edit_mode ? 'Guardar' : 'Publicar' ?>"/>
  <?php echo form_close() ?>
  <div class="clr"></div>
</div>
<div class="clr"></div>

<div id="dialog" style="display:none;">
  <p>Esta seguro</p>
</div>

<script type="text/javascript">


  $(function() {
    $('#fecha_inicial').datepicker({
      'minDate': 0,
      'showAnim' : 'drop'
    });
    $('#fecha_audicion').datetimepicker({
      'showAnim' : 'drop'
    });
    $('#first-help').trigger('click');
    
  });

  $('#crear-form').on('submit', function() {
    var ok = true;
    if ($('[name="edit_mode"]').val() === 0) {
      ok = confirm('¿Está seguro de crear la audición?');
    }
    return ok;
    
  });  
 
  
  
  function mostrar_ocultar(valor){
    var cadena_ids='';
    switch(valor){
         case 'Individual':cadena_ids = 'genero_banda|none'; break;
         case 'Banda':cadena_ids = 'genero_banda|block'; break;
    }
    var tmp = cadena_ids.split(',');
    for(i=0; i<tmp.length; i++){
      document.getElementById(tmp[i].split('|')[0]).style.display=tmp[i].split('|')[1];
   }
  }
  
  function log( message ) {
            $( "<div>" ).text( message ).prependTo( "#log" );
            $( "#log" ).scrollTop( 0 );
        }
  
</script>