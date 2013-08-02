<?php echo form_open('perfil/editar/save_informacion_profesional_page', null, array('page_id' => $datos->id)) ?>

<div class="bgEncabezado">
  <div class="conEncabezado">
    <div id="txSeccion">
      <div class="encabezado-tit">Información Profesional</div>
      <div class="encabezado-subtit">&nbsp;</div>
    </div>
  </div>
</div>

<div class="contenido edit-perfil-cont">

  <div class="registro-campos">
    <a class="bot-rosa2 cambia-cont" href="<?php echo site_url('perfil/pagina/'.$datos->var) ?>">Volver al perfil</a>
    <div class="clr"></div>
  </div>


  <?php if (!empty($alert_messages)) : ?>
    <div><?php echo $alert_messages ?></div>
  <?php endif; ?>


  <div class="clear"></div>
  <div class="selectores profesional" id="registro">

    <div class="registro-campos">
      <div class="campo-reg-lab">
        <label>Nivel de experiencia</label>
        <div class="selectBox"  id="select-largo2">

          <?php echo form_dropdown('nivel_experiencia', $options['nivel_experiencia'], $datos->pages_info->nivel_experiencia, 'style="width:314px;" class="comboBox1"') ?>
          <div class="clr"></div>
        </div>
      </div>

      <div class="campo-reg-lab">
        <label>Años de experiencia</label>
        <div class="selectBox"  id="select-largo2">
          <?php echo form_dropdown('anos_experiencia', $options['anos_experiencia'], $datos->pages_info->anos_experiencia, 'style="width:314px;" class="comboBox1"') ?>
          <div class="clr"></div>
        </div>
      </div>

      <div class="campo-reg-lab">
        <label>Número de conciertos</label>
        <div class="selectBox"  id="select-largo2">
          <?php echo form_dropdown('numero_concierto', $options['numero_conciertos'], $datos->pages_info->numero_concierto, 'style="width:314px;" class="comboBox1"') ?>
          <div class="clr"></div>
        </div>
      </div>

      <div class="clr"></div>
    </div>

    <div class="registro-campos">

      <div class="campo-reg-lab">
        <label>Influencias</label>
        <div class="selectBox"  id="select-largo2">
          <input name="influencias" type="text"  class="campo" placeholder="influencia 1, influencia 2, ..." value="<?php echo $datos->pages_info->influencias ?>"  />
        </div>
      </div>
      
      <div class="campo-reg-lab">
        <label>Sitio web</label>
        <div class="selectBox"  id="select-largo2">
          <input name="sitio_web" type="url" class="campo" placeholder="http://www.misitio.com" value="<?php echo $datos->pages_info->sitio_web ?>" />
        </div>
      </div>
      
      <div class="campo-reg-lab">
        <label>Email</label>
        <div class="selectBox"  id="select-largo2">
          <input name="email" type="email" class="campo" placeholder="usuario@tusitio.com" value="<?php echo $datos->pages_info->email ?>"  />
        </div>
      </div>

      <div class="clr"></div>
    </div>

    <div class="registro-campos">

      

      

      <div class="clr"></div>
    </div>

    <div class="registro-campos">
      
      <div class="campo-reg-lab">
        <label>URL de Facebook</label>
        <div class="selectBox"  id="select-largo2">
          <input name="social_facebook" type="url" class="campo" placeholder="URL de Facebook" value="<?php echo $datos->pages_info->social_facebook ?>"  />
        </div>
      </div>

      <div class="campo-reg-lab">
        <label>URL de Twitter</label>
        <div class="selectBox" id="select-largo2">
          <input name="social_twitter" type="url" class="campo" placeholder="URL de Twitter" value="<?php echo $datos->pages_info->social_twitter ?>"  />
        </div>
      </div>

      <div class="campo-reg-lab">
        <label>URL de Youtube</label>
        <div class="selectBox"  id="select-largo2">
          <input name="social_youtube" type="url" class="campo" placeholder="URL de Youtube" value="<?php echo $datos->pages_info->social_youtube ?>"  />
        </div>
      </div>
      <div class="clr"></div>
    </div>


    <div class="registro-campos">

      <div class="campo-reg-lab">
        <label>Disquera</label>
        <div class="selectBox"  id="select-largo2">
          <input name="disquera" type="text" class="campo" placeholder="Disquera"  value="<?php echo $datos->pages_info->disquera ?>" />
        </div>
      </div>

      <div class="campo-reg-lab">
        <label>Manager</label>
        <div class="selectBox"  id="select-largo2">
          <input name="manager" type="text" class="campo" placeholder="Manager" value="<?php echo $datos->pages_info->manager ?>" />
        </div>
      </div>





      <div class="clr"></div>
    </div>
    <div class="clear"></div>
  </div>
  <div class="contenido">
    <input type="submit" class="bot-registrar" value="actualizar"/>
  </div>

  <?php echo form_close(); ?>
  
  <script>
  
  $(document).ready(function() {
    $(".b-ch").click(function(){
      if($('span', this).text() == "+ "){
        $('span', this).text("- ");
        $('.el-ch-cont',$(this).parent().parent()).css({
               'display':'block'	
        })
      }else{
        $('span', this).text("+ ");
        $('.el-ch-cont',$(this).parent().parent()).css({
               'display':'none'	
        })
      }
    })
  })
  </script>