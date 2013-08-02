<div class="bgEncabezado">
    <div class="conEncabezado">
        <div id="txSeccion">
            <div class="encabezado-tit">Información personal</div>
            <div class="encabezado-subtit">&nbsp;</div>
        </div>
    </div>
</div>
<div class="contenido">
    <?php if(empty($go_register)) : ?>
     <div class="registro-campos">
            <a class="bot-rosa2 cambia-cont" href="<?php echo site_url('perfil') ?>">Volver al perfil</a>
            <?php if(isset($_GET['val'])){
              $val=$_GET['val'];
              if($val!=1){ ?>
                <a class="bot-rosa2 cambia-cont" href="<?php echo site_url('usuarios/change-password') ?>">Cambiar contraseña</a>
                <?php
              }              
              }?>
            <a class="bot-rosa2 cambia-cont" href="<?php echo sprintf($urls->current_inshaka_url_format, 'fotos') ?>">Editar album de fotos</a>
            <a class="bot-rosa2 cambia-cont" href="<?php echo sprintf($urls->current_inshaka_url_format, 'videos') ?>">Editar album de videos</a>
            <div class="clr"></div>
        </div>
    <?php endif; ?>
    <?php $registro = !empty($go_register) ? "registro" : null ?>
    <?php echo form_open_multipart('perfil/editar/save_informacion_personal/'.$registro, null) ?>
    
    <?php if (!empty($alert_messages)) : ?>
        <div><?php echo $alert_messages ?></div>
    <?php endif; ?>
        
    
    <div class="selectores" id="registro">

        <div class="registro-campos">
        	<div class="campo-reg-lab">
            	<label><?= $datos->is_proveedor ? 'Nombre contacto' : 'Nombre' ?></label>
            	<input type="text" class="campo" value="<?php echo $datos->first_name ?>"  />
            </div>
            <div class="campo-reg-lab">
            	<label><?= $datos->is_proveedor ? 'Apellido contacto' : 'Apellido' ?></label>
            	<input type="text" class="campo" value="<?php echo $datos->last_name ?>"  />
			</div>
            
             <div class="campo-reg-lab">
            	<label>E-mail</label>
            	<input type="text" class="campo" style="margin-right:0;" value="<?php echo $datos->email ?>" />
             </div>
            <div class="clr"></div>
        </div>

        <div class="registro-campos" >
        	<div class="campo-reg-lab" >
            	<label>Ciudad</label>
                <div class="selectBox" id="select-largo2">
                    <div class="ui-widget">
                        <input id="city" class="campo"  value="<?php echo $datos->city ?>"  />
                    </div>
                </div>
            </div>
            <div class="campo-reg-lab" style="width:190px;margin-left: 10px;">
            	<label><?= $datos->is_proveedor ? 'Fecha de inicio/creación' : 'Fecha de nacimiento' ?></label>
            	<input type="text" name="birthday" class="campo date-picker" value="<?php echo $datos->birthday ?>"  autocomplete="off" readonly="true" style="margin:0;"/>
            </div>
          
          <div class="campo-reg-lab" style="<?= !$datos->is_proveedor ? 'display:none' : null ?>">
            	<label>Dirección</label>
            	<input type="text" class="campo" value="<?php echo $datos->adress_provider ?>"  />
          </div>
			
            <div class="campo-reg-lab" style="margin-left: -6px; width: 128px; <?= $datos->is_proveedor ? 'display:none' : null ?>">
            	<label>Sexo</label>
                <div class="selectBox"  id="select-peq2" style="margin-left: 6px;">
                    <?php echo form_dropdown('gender', array(0 => 'Sexo', 'Masculino' => 'Masculino', 'Femenino' => 'Femenino'), (!empty($datos->gender) ? $datos->gender : 0), 'style="width:122px;" class="comboBox1"') ?>
                    <div class="clr"></div>
                </div>
            </div>
            <div class="campo-reg-lab" style="<?= $datos->is_proveedor ? 'display:none' : null ?>">
            	<label>Teléfono</label>
            	<input type="text" class="campo"  value="<?php echo $datos->phone ?>"  style="float:left;"/>
            	<div class="clr"></div>
            </div>
        </div>
        <div class="registro-campos">
            
            <div class="clr"></div>
        </div>
        <div class="registro-campos">
        	<div class="campo-reg-lab">
            	<label><?= $datos->is_proveedor ? '¿Quienes somos?' : '*Biografía' ?></label>
            	<textarea name="bio" id="" cols="30" rows="10" placeholder="<?= $datos->is_proveedor ? 'Quienes somos...' : 'Biografía...' ?>" style="width:939px;"><?php echo $datos->bio ?></textarea>
            </div>
            <div class="clr"></div>
        </div>
       
    </div>


    <div class="clr"></div>


</div>
<div class="contenido">
  <?php if(!empty($go_register)) : ?>
    <input type="submit" class="bot-registrar" value="continuar"/>
  <?php else : ?>
    <input type="submit" class="bot-registrar" value="actualizar"/>
  <?php endif; ?>
</div>