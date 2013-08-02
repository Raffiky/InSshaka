<div class="bgEncabezado">
    <div class="conEncabezado">
        <div id="txSeccion">
            <div class="encabezado-tit">Información personal</div>
            <div class="encabezado-subtit">&nbsp;</div>
        </div>
    </div>
</div>
<div class="contenido">
     <div class="registro-campos">
            <a class="bot-rosa2 cambia-cont" href="<?php echo site_url('perfil/pagina/'.$datos->var) ?>">Volver al perfil</a>
            <a class="bot-rosa2 cambia-cont" href="<?php echo sprintf($urls->current_inshaka_url_format, 'fotos') ?>">Editar album de fotos</a>
            <a class="bot-rosa2 cambia-cont" href="<?php echo sprintf($urls->current_inshaka_url_format, 'videos') ?>">Editar album de videos</a>
            <div class="clr"></div>
        </div>
    
    <?php echo form_open_multipart('perfil/editar/save_informacion_personal_page', null, array('id' => $datos->id, 'band' => $datos->band->id)) ?>
    
    <?php if (!empty($alert_messages)) : ?>
        <div><?php echo $alert_messages ?></div>
    <?php endif; ?>
        
    
    <div class="selectores" id="registro">

        <div class="registro-campos">
        	<div class="campo-reg-lab">
            	<label>Nombre banda</label>
            	<input type="text" class="campo" name="name" value="<?php echo $datos->band->name ?>"  />
            </div>
            <div class="clr"></div>
        </div>
        <div class="registro-campos">
            
            <div class="clr"></div>
        </div>
        <div class="registro-campos">
        	<div class="campo-reg-lab">
            	<label>Biografía</label>
            	<textarea name="bio" id="" cols="30" rows="10" placeholder="Biografía..." style="width:939px;"><?= $datos->bio ?></textarea>
            </div>
            <div class="clr"></div>
        </div>
       
    </div>


    <div class="clr"></div>


</div>
<div class="contenido">
    <input type="submit" class="bot-registrar" value="actualizar"/>
</div>