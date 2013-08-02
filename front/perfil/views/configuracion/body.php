<script type="text/javascript">
  $(document).ready(function() {
    var estado2 = 0;
 
    $(".t1").addClass("active").show();

    $("ul.tabs li").click(function(){
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
    $(".t8").click(function(){
      if (estado2 == 0){
        $("#contenu4").scrollbar2(428);
        estado2 = 1;
      }
    });
  });
</script>
<script type="text/javascript">
  $(function(){        
    var btn_checkbox = $(".check1");

    $.each(btn_checkbox, function(i){
      if($("#checkbox-" + i).val() == 1){ 
        $("#checkbox-" + i).attr('checked', true);
      }
    });

    btn_checkbox.on('click', function(){
      if($(this).val() == 1){
        $(this).attr('checked', false);
        $(this).val(0);
      }else{
        $(this).attr('checked', true);
        $(this).val(1);
      }
    });

  });
</script>
<style type="text/css">
  .c7{
        color:#333 !important;	
    }
  ul.tabs{
      width: 440px;
      background-color: #D5D5D5;
      border-top-left-radius: 7px;
      border-top-right-radius: 7px;
      -moz-border-top-left-radius: 7px;
      -moz-border-top-right-radius: 7px;
      -webkit-border-top-left-radius: 7px;
      -webkit-border-top-right-radius: 7px;
      border: 1px solid #FFF;
      border-bottom: 0px;
    }
    .bot-logout{
      border: 0px;
    }
</style>
<div class="contenido">
  <div class="directorio-cont">
    <ul class="tabs">
      <li class="t6 <?= $tab_content_active == 'correos' ? 'active' : null ?>"><a href="#tab1">Recibir correos</a></li>
      <li class="t8 <?= $tab_content_active == 'password' ? 'active' : null ?>"><a href="#tab2">Cambiar password</a></li>
      <li class="t8 <?= $tab_content_active == 'email' ? 'active' : null ?>"><a href="#tab3">Cambiar email</a></li>
    </ul>
  </div>
  <div class="clr" style="margin-top: 20px;"></div>
  <div class="tab_container">
    <div id="tab1" class="tab_content" style="display: <?= $tab_content_active == 'correos' ? 'block' : 'none' ?>" >
      <!-- Cargando los errores de validación -->
      <?php if($tab_content_active == 'correos') : ?>
        <?php if (!empty($alert_messages)) : ?>
            <div><?php echo $alert_messages ?></div>
        <?php endif; ?>
      <?php endif; ?>
      
      <!-- Fin errores de validación -->
      <div class="band-ico2">1</div>
      <div class="band-tit">Seleccione los correos que desea recibir</div>
      <?= form_open(site_url('perfil/configuracion/save_settings')) ?>
        <div class="elemento-check">
          <input id="checkbox-1" class="check1" type="checkbox" name="aplicacion_audiciones" value="<?= $datos->aplicacion_audiciones ?>" >
          <label for="aplicacion_audiciones">Aplicación a mis audiciones</label>
        </div>
        <div class="clr"></div>
        <div class="elemento-check">
          <input id="checkbox-2" class="check1" type="checkbox" name="audiciones_soy_fan" value="<?= $datos->audiciones_soy_fan ?>">
          <label for="audiciones_soy_fan">Audiciones nuevas de quienes soy fan</label>
        </div>
        <div class="clr"></div>
        <div class="elemento-check">
          <input id="checkbox-3" class="check1" type="checkbox" name="invitacion_bandas" value="<?= $datos->invitacion_bandas ?>">
          <label for="invitacion_bandas">Invitaciones a bandas</label>
        </div>
        <div class="clr"></div>
        <div class="elemento-check">
          <input id="checkbox-4" class="check1" type="checkbox" name="bandas_soy_fan" value="<?= $datos->bandas_soy_fan ?>">
          <label for="bandas_soy_fan">Bandas nuevas de quienes soy fan</label>
        </div>
        <div class="clr"></div>
        <div class="elemento-check">
          <input id="checkbox-5" class="check1" type="checkbox" name="aplicacion_clasificados" value="<?= $datos->aplicacion_clasificados ?>">
          <label for="aplicacion_clasificados">Aplicación a mis clasificados</label>
        </div>
        <div class="clr"></div>
        <div class="elemento-check">
          <input id="checkbox-6" class="check1" type="checkbox" name="clasificados_soy_fan" value="<?= $datos->clasificados_soy_fan ?>">
          <label for="clasificados_soy_fan">Clasificados nuevos de quienes soy fan</label>
        </div>
        <div class="clr"></div>
        <div class="elemento-check">
          <input id="checkbox-7" class="check1" type="checkbox" name="nuevo_fan" value="<?= $datos->nuevo_fan ?>">
          <label for="nuevo_fan">Nuevos fans</label>
        </div>
        <div class="clr"></div>
        <input type="submit" class="bot-logout" value="Guardar cambios" style="float:left; margin-top: 20px;"/>
      <?= form_close() ?>
    </div>
    <div id="tab2" class="tab_content" style="display: <?= $tab_content_active == 'password' ? 'block' : 'none' ?>" >
      <!-- Cargando los errores de validación -->
      <?php if($tab_content_active == 'password') : ?>
        <?php if (!empty($alert_messages)) : ?>
            <div><?php echo $alert_messages ?></div>
        <?php endif; ?>
      <?php endif; ?>
      <div class="selectores" id="registro">
        <div class="registro-campos">
          <div class="band-ico2">2</div>
          <div class="band-tit">Cambiar contraseña</div>
          <?= form_open(site_url('perfil/configuracion/change_password'), null) ?>
          <div class="campo-reg-lab">
            <label>Contraseña actual</label>
            <input name="old" type="password" class="campo" /><div class="clear"></div>
          </div>

          <div class="campo-reg-lab">
            <label>Nueva contraseña</label>
            <input name="new" type="password" class="campo"  /><div class="clear"></div>
          </div>
          <div class="campo-reg-lab">
            <label>Repetir nueva contraseña</label>
            <input name="new_confirm" type="password" class="campo"  style="margin-right:0;" /><div class="clear"></div>
          </div>
          <div class="clr"></div>
          <input type="submit" class="bot-logout" value="Guardar cambios" style="float:left; margin-top: 20px;"/>
          <?= form_close() ?>
          <div class="clr"></div>
        </div>
      </div>
    </div>
    <div id="tab3" class="tab_content" style="display: <?= $tab_content_active == 'email' ? 'block' : 'none' ?>" >
      <!-- Cargando los errores de validación -->
      <?php if($tab_content_active == 'email') : ?>
        <?php if (!empty($alert_messages)) : ?>
            <div><?php echo $alert_messages ?></div>
        <?php endif; ?>
      <?php endif; ?>
      <div class="selectores" id="registro">
        <div class="registro-campos">
          <div class="band-ico2">3</div>
          <div class="band-tit">Cambiar email</div>
          <?= form_open(site_url('perfil/configuracion/change_email'), null) ?>
          <div class="campo-reg-lab">
            <label>Email actual</label>
            <input name="old_email" type="email" class="campo" /><div class="clear"></div>
          </div>
          <div class="campo-reg-lab">
            <label>Nuevo email</label>
            <input name="new_email" type="email" class="campo" /><div class="clear"></div>
          </div>
          <div class="clr"></div>
          <input type="submit" class="bot-logout" value="Guardar cambios" style="float:left; margin-top: 20px;"/>
          <?= form_close() ?>
        </div>
      </div>
    </div>
  </div>
</div>