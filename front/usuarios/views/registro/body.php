<script type="text/javascript">  
  $(function() {
    $(".bot-registrar").click(function(){     
     var saber = $('#check1').attr("checked");
     if(saber){       
     }else{
       alert("No activo terminos y condiciones");
       return false;
     }     
    });
    
    function log( message ) {
            $( "<div>" ).text( message ).prependTo( "#log" );
            $( "#log" ).scrollTop( 0 );
        }
    
    $( "#city" ).autocomplete({
      source: function( request, response ) {
          $.ajax({
              url: "http://ws.geonames.org/searchJSON",
              dataType: "json",
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
                          value: item.name + ", " + item.countryName
                      };
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
<div class="bgEncabezado">
  <div class="conEncabezado">
    <div id="txSeccion">
      <div class="encabezado-tit">Registro <?php if($is_banda) : ?> 
        nueva banda 
        <?php elseif($is_proveedor): ?> 
        nuevo proveedor
        <?php else: ?>
        nuevo usuario
        <?php endif; ?>
      </div>
      <div class="encabezado-subtit">&nbsp;</div>
    </div>
  </div>
</div>

<?php echo form_open(null, null, $form_hidden) ?>

<div class="contenido">
  <?php if (!empty($alert_messages)) : ?>
    <div><?php echo $alert_messages ?></div>
  <?php endif; ?>
  <div class="clear"></div>


  <?php if (!$logged_with_facebook) : ?>
    <a href="<?php echo $facebook_connect_url ?>"><div class="f-conect"></div></a>
  <?php endif; ?>


  <div class="selectores" id="registro">

    <?php if ($is_banda) : ?>
      <div class="registro-nombre-banda">
        <div class="campo-reg-lab" >
          <label style="padding-left: 15px;">*Nombre banda</label>
          <input type="text" name="band_name" class="campo" placeholder="Nombre de la banda"  />
        </div>
        <div class="clr"></div>
      </div>
    <?php endif; ?>
    
    <?php if ($is_proveedor) : ?>
      <div class="registro-nombre-banda">
        <div class="campo-reg-lab" >
          <label style="padding-left: 15px;">*Nombre empresa</label>
          <input type="text" name="name_proveedor" class="campo" placeholder="Nombre de la empresa"  />
        </div>

        <div class="clr"></div>
      </div>
    <?php endif; ?>


    <div class="registro-campos">
      <div class="campo-reg-lab" >
        <label style="padding-left: 15px;">*<?= $is_proveedor ? 'Nombre de contacto' : 'Nombre' ?></label>
        <input type="text" name="first_name" class="campo"  value="<?php echo set_value('first_name', $logged_with_facebook ? $user_profile_facebook['first_name'] : null) ?>" autocomplete="off" autofocus  />
      </div>

      <div class="campo-reg-lab" >
        <label style="padding-left: 15px;">*<?= $is_proveedor ? 'Apellido de contacto' : 'Apellido' ?></label>
        <input type="text" name="last_name" class="campo" value="<?php echo set_value('last_name', $logged_with_facebook ? $user_profile_facebook['last_name'] : null) ?>" autocomplete="off"  />
      </div>

      <div class="campo-reg-lab" >
        <label style="padding-left: 15px;">*<?= $is_proveedor ? 'E-mail de contacto' : 'E-mail' ?></label>
        <input type="email" name="email" class="campo" style="margin-right:0;" value="<?php echo set_value('email', $logged_with_facebook ? $user_profile_facebook['email'] : null) ?>" autocomplete="off" />
        <div class="clr"></div>
      </div>
    </div>

    <div class="registro-campos">
      <div class="campo-reg-lab" style="margin-top:30px;">
        <label style="padding-left: 15px;">*Ciudad - País</label>
        <input type="text" name="city" id="city" class="campo" placeholder="Ciudad, País" value="<?php echo set_value('city', $logged_with_facebook ? (!empty($user_profile_facebook['city']) ? $user_profile_facebook['city'] : null ) : $this->input->post('city')) ?>"  />
      </div>

      <div class="campo-reg-lab" style="width:210px;margin-top:30px;">
        <label style="padding-left: 15px;">*<?= $is_proveedor ? 'Fecha de inicio' : 'Fecha de nacimiento' ?></label>
        <input type="text" name="birthday" class="campo date-picker" value="<?php echo set_value('birthday', $logged_with_facebook ? $user_profile_facebook['birthday'] : null) ?>" autocomplete="off" readonly="true" />
      </div>

      <div class="campo-reg-lab" style="width:111px;margin-top:30px; <?= $is_proveedor ? 'display:none' :  null ?>" >
        <label style="padding-left: 5px;">Sexo</label>
        <div class="selectBox"  id="select-peq2" style="margin-left: 0;">
          <?php echo form_dropdown('gender', array(0 => 'Sexo', 'Masculino' => 'Masculino', 'Femenino' => 'Femenino'), $logged_with_facebook ? $user_profile_facebook['gender'] : $this->input->post('gender'), 'style="width:122px;" class="comboBox1"') ?>
          <div class="clr"></div>
        </div>
        <div class="clr"></div>
      </div>
      <div class="campo-reg-lab" style="margin-top:30px; <?= $is_proveedor ? 'display:none' : null ?>">
        <label style="padding-left: 15px;">Teléfono</label>
        <input type="text" name="phone" class="campo"  value="<?php echo set_value('phone', $logged_with_facebook ? $user_profile_facebook['phone'] : $this->input->post('phone')) ?>"  />

      </div>
      
      <div class="campo-reg-lab" style="margin-top:30px; <?= !$is_proveedor ? 'display:none' : null ?>">
        <label style="padding-left: 15px;">*Dirección empresa</label>
        <input type="text" name="adress_provider" class="campo" placeholder="Ej: Calle 10 # 10 - 10"  />
      </div>

      <div class="clr"></div>

    </div>
    <div class="clr"></div>
    <div class="registro-campos">

      <div class="clr"></div>
      <div class="acotacion-campo">inshaka.com/<b>perfil/</b></div>
      <input type="text" name="inshaka_url" class="campo" placeholder="Dirección INSHAKA" value="<?php echo set_value('inshaka_url', $logged_with_facebook ? $user_profile_facebook['inshaka_url'] : $this->input->post('inshaka_url')) ?>" autocomplete="off"  />
      <div class="clr"></div>
    </div>
    
    
    
    
    <div class="registro-campos" style="margin-bottom: 100px;">
      <div class="acotacion-campo2">crear un usuario y contraseña</div>
      <div class="campo-reg-lab" >
        <label style="padding-left: 15px;">*Nombre de Usuario</label>
        <input type="text" name="username" placeholder="Digite su usuario" class="campo" value="<?php echo set_value('username', $logged_with_facebook ? $user_profile_facebook['username'] : $this->input->post('username')) ?>" autocomplete="off"  />
      </div>

      <div class="campo-reg-lab" >
        <label style="padding-left: 15px;">*Contraseña</label>
        <input type="password" name="password" placeholder="Digite su contraseña" class="campo" autocomplete="off"  />
      </div>

      <div class="campo-reg-lab" >
        <label style="padding-left: 15px;">*Repetir contraseña</label>
        <input type="password" name="password_confirm" class="campo" placeholder="Confirme la contraseña"  style="margin-right:0;" autocomplete="off" />
        <div class="clr"></div>
      </div>

    </div>
    
    <?php if ($is_proveedor) : ?>
    <div class="clr"></div>
    <div class="clr"></div>
      <div class="band-op">
        <div class="acotacion-campo2">Servicios y/o productos</div>
        <div class="band-info">
            <div class="campo-reg-lab">
              <label style="padding-left: 4px;">*Seleccione la categoría</label>
              <div class="selectBox no-ico" id="select-largo">
                <?php echo form_dropdown('id_categoria_proveedor', $select_categorias, null, 'style="width:386px;" class="comboBox1"') ?>
                <div class="clr"></div>
              </div>
              <div class="clr"></div>
            </div>
            <div class="clr"></div>
            <div class="clr"></div>
        </div>
        <div class="clr"></div>
    </div>
    <?php endif; ?>
    <div class="terminos-tit" style="float:none; margin-left: 10px;">Todos los campos marcados con (*) son obligatorios.</div>

    <div class="clr"></div>
  </div>


  <div class="clr"></div>
</div>


<div class="clr"></div>


<div class="bgEncabezado">
  <div class="conEncabezado">
    <div id="txSeccion">
      <div class="encabezado-tit" style="padding-top: 12px;">Control de seguridad</div>
    </div>
  </div>
</div>

<div class="contenido">


  <div class="clear"></div>
  <div class="selectores" id="registro2">
    <div class="reg-bot-iz">
      <div class="terminos-tit" style="float:none;">Este campo es obligatorio, escriba las letras que aparecen abajo</div>
      <div class="clr"></div>
      <div><?php echo $recaptcha ?></div>
      <div class="clr"></div>
    </div>
    <div class="reg-bot-de">
      <div class="terminos">
        <div class="terminos-tit">*He leido y acepto los <a href="<?php echo site_url('terminos') ?>" target="_blank">términos y condiciones</a></div><br>
        <br>
        <div class="elemento-check">
          <input id="check1" class="check1" type="checkbox" name="subscribe_news" value="no" onclick="saber();">
          <label for="check_prim_02">Acepto terminos y condiciones</label>
        </div>
        <div class="elemento-check">
          <input id="check_prim_02" type="checkbox" name="subscribe_news" value="1">
          <label for="check_prim_02">Quiero recibir las noticias de INSHAKA </label>
        </div>
        <div class="elemento-check">
          <input id="check_prim_01" type="checkbox" name="subscribe_offers" value="1">
          <label for="check_prim_01">Quiero recibir las ofertas de INSHAKA </label>
        </div>
      </div>
      <div class="reg-bots">
        <input type="submit" class="bot-registrar" value="registrar">
      </div>
    </div>
    <div class="clr"></div>


  </div>

  <div class="clr"></div>
</div>

<?php echo form_close() ?>

   <!-- <input type="reset" class="bot-borrar" value="borrar"> -->