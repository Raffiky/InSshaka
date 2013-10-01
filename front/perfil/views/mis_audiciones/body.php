
<script type="text/javascript">
    $(document).ready(function() {
        $(".comboBox1").msDropDown().data("dd");


        $("#contenu3").scrollbar(430);
        /******************************************/
        
        $("#contactar-inbox").fancybox();
        $("#direct-message").on("submit", function(e){
            e.preventDefault();
            var url = $(this).attr("action");
            var datos = {
              user_id : $(this).data("id"),
              message : $(this).find("#message").val() 
            };
            
            $.ajax({
              type      : "post",
              url       : url,
              dataType  : "json",
              data      : datos,
              success   : function(json){
                if(json.ok){
                  alert("Tu mensaje se ha enviado satisfactoriamente!.");
                }
              },
              error   : function(){
                alert("Se ha producido un error. Inténtelo más tarde!.");
              }
            });        
          });
        
        /*****************************************/
        
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
        
        $('#ver-aplicaciones').fancybox();
    });
    
    function DefineEstado (id) {
    $("#estado-" + id).dialog({
      resizable: false,
      modal: true,
      show : 'drop',
      hide : 'drop',
      width: '400px',
      buttons: {
        "Aceptar": function()  { 
          $.getJSON('<?= site_url("perfil/audiciones/aceptar_aplicacion") ?>', {
            id : id,
            aceptar : 1
          }, function() {
            location.reload();
          });
          return $(this).dialog('close');
        },
        "Rechazar": function() {
          $.getJSON('<?= site_url("perfil/audiciones/aceptar_aplicacion") ?>', {
            id : id,
            aceptar : 0
          }, function() {
            location.reload();
          });
          return $(this).dialog('close');
        },
        Cancel: function()  {
          $( this ).dialog("close");
        }
      }
    })
  }
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
    .c4{
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
    #icons-conversiones{
      width: 300px;
      float: right;
      margin-top: -35px;
    }
    .ico-en-espera{
      background: transparent url('<?= front_asset('images/ico-reloj.png') ?>') no-repeat;
    }
    .ico-admitido{
      background: transparent url('<?= front_asset('images/ico-aceptar.png') ?>') no-repeat;
    }
    .ico-rechazar{
      background: transparent url('<?= front_asset('images/ico-rechazar.png') ?>') no-repeat;
    }
    .ico-en-espera, .ico-admitido, .ico-rechazar{      
      background-position: left; 
      height: 20px;
      padding-left: 25px;
      margin-right: 10px;
      font-family: 'Arial';
      font-size: 12px;
      color: #666;
      line-height: 2;
      float: left;
    }
    .form-usuario {
    background-color: transparent;
    border-radius: 10px 10px 10px 10px;
    height: 99px;
    margin-left: 22px;
    padding-left: 17px;
    padding-top: 12px;
    width: 393px;
  }
    .area-msg {
      border: 1px solid #CCCCCC;
      height: 60px;
      width: 360px;
      color: black;
    }
</style>


<div class="contenido" id="page-mis-audiciones">
    <div class="directorio-cont">
        <ul class="tabs">
            <li class="t1 active"><a href="#tab1">Mis Audiciones</a></li>
            <li class="t7"><a href="#tab2">Mis aplicaciones</a></li>
            <li class="t2"><a href="<?php echo site_url('audiciones/crear') ?>">Crear</a></li>
        </ul>
    </div>

    <div class="clear"></div>
    <div class="tab_container">
        <div id="tab1" class="tab_content">

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
                    <div id="contenu3">
                        <?php foreach ($datos as $dato) : ?>
                            <div class="audicion">
                                <div class="audicion-info">
                                    <div class="audicion-ico"><a href="<?php echo sprintf($urls->audicion_detalle, $dato->id, $dato->var) ?>"><img src="<?php echo uploads_url($dato->imagen) ?>" width="41" /></a></div>
                                    <div class="audicion-tit"><a href="<?php echo sprintf($urls->audicion_detalle, $dato->id, $dato->var) ?>"><?php echo $dato->titulo ?></a>
                                        <div class="audicion-post">Creado el <?php echo fecha_spanish_full($dato->created_on) ?></div>
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
                                <p style="margin-top:2em;"><em style="opacity:.9;"><?php echo $dato->introduccion ?></em></p>
                                <div class="audicion-txt"><?php echo $dato->intruduccion ?></div>
                                <div class="opciones-ico">
                                    <div class="ver-mas"><a href="<?php echo sprintf($urls->audicion_detalle, $dato->id, $dato->var) ?>">Ver más</a></div>
                                    <a href="<?php echo site_url('perfil/audiciones/eliminar/'.$dato->id) ?>" onclick="return confirm('¿Está seguro de eliminar la audición?')"><div class="borrar">Borrar</div></a>
                                    <a href="<?php echo site_url('audiciones/editar/'.$dato->id) ?>"><div class="editar">Editar</div></a>
                                    <a href="#aplicaciones-<?= $dato->id ?>" id="ver-aplicaciones"><div class="miembros" style="margin-top: 20px;">Aplicaciones</div></a>
                                </div>
                                <div class="clr"></div>
                            </div>
                      
                            <!-- Modal para postulantes a la audición -->
                            <div id="aplicaciones-<?= $dato->id ?>" style="display: none; width: 950px;">      
                            <div class="musicos-cont" style="width: 97%">
                              <div class="mensaje-tit">Audición -  <?= $dato->titulo ?></div>
                              <div class="musicos" style="width: 100%;">
                                  <?php if ($quien_aplico->exists()) : ?>
                                      <?php foreach ($quien_aplico as $postulante) : ?>
                                          <div class="musico">
                                              <div class="estado-ico">
                                                  <?php if ($postulante->estado == NULL) : ?>
                                                      <img src="images/ico-reloj.png" />
                                                  <?php else : ?>
                                                      <?php if ($postulante->estado == TRUE) : ?>
                                                          <img src="images/ico-aceptar.png" />
                                                      <?php else : ?>
                                                          <img src="images/ico-rechazar.png" />
                                                      <?php endif; ?>
                                                  <?php endif; ?>
                                              </div>
                                              <div class="mus-sel">
                                                  <label for="check_01" class="m-nombre"><?php echo $postulante->get_user_aplication($postulante->user_id)->first_name, ' ', $postulante->get_user_aplication($postulante->user_id)->last_name ?></label>
                                              </div>
                                              <div class="m-dato"><b><?php echo calculate_years_old($postulante->get_user_aplication($postulante->user_id)->birthday) ?></b></div>
                                              <div class="m-dato"><?php echo $postulante->get_user_aplication($postulante->user_id)->city ?></div>
                                              <a href="#contactar-cont" id="contactar-inbox" onclick="$(this).trigger('click');"><div class="inbox">Contactar</div></a>
                                              <a href="<?php echo site_url('perfil/' . $postulante->get_user_aplication($postulante->user_id)->inshaka_url) ?>"><div class="ver-mas" style="margin-top: 0px;">Ver más</div></a>
                                              
                                              <div class="editar definir-estado" style="margin-top: 0px;" onclick="DefineEstado(<?= $postulante->id ?>);">Estado</div>
                                              <div id="estado-<?= $postulante->id ?>" title="Definir estado" style="display:none">
                                                <p>
                                                  Que desea hacer con este usuario?
                                                </p>
                                              </div>
                                          </div>
                                      <?php endforeach; ?>
                                  <?php else: ?>
                                      <strong>Sin postulantes</strong>
                                  <?php endif; ?>

                              </div>
                            </div>
                          </div>
                          <!-- Fin modal -->
                          
<!-- Formulario modal para contactar un usuario -->
<div id="contactar-cont" style="display:none;">
  <div class="mensaje-tit">Mensaje directo a: 
    <br><?= $postulante->get_user_aplication($postulante->user_id)->first_name, ' ', $postulante->get_user_aplication($postulante->user_id)->last_name ?>
  </div>
  <div class="form-usuario">
    <div class="form-foto">
      <?= form_open(site_url("perfil/mensajes/response_message"), "id='direct-message' data-id='".$postulante->user_id."'") ?>
        <div id="success-message"></div>
        <textarea id="message" name="message" class="area-msg" placeholder="Escribele un mensaje a este usuario en este espacio..."></textarea>
        <input class="bot-enviar" type="submit" value="enviar">
      <?= form_close() ?>
      <div class="clr"></div>
    </div>
  </div>
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
                    <div><p>No tienes ninguna audición creada. Crea la primera dando <a href="<?php echo site_url('audiciones/crear') ?>" style="color: #E31873">click acá.</a></p></div>
            <?php endif; ?>

            <div class="clr"></div>
        </div>
      
        <div id="tab2" class="tab_content">
        <?php if(!$aplicaciones->exists()) : ?>
          <div><p>Aún no has aplicado a ningúna audición, haz <a href="<?php echo site_url('audiciones') ?>" style="color: #E31873">click acá.</a> para ver las audiciones abiertas hasta este momento</p></div>
        <?php else : ?>
          <div id="icons-conversiones">
            <div class="ico-en-espera">
              <span>En espera</span>
            </div>
            <div class="ico-admitido">
              <span>Admitido</span>
            </div>
            <div class="ico-rechazar">
              <span>No admitido</span>
            </div>
          </div>
          
          <?php foreach ($aplicaciones as $aplicacion) : ?>
            <div class="bandas" style="padding-top: 27px; padding-bottom: 40px;">
              <div class="banda-nom" style="<?= $aplicacion->estado == TRUE ? 'width: 350px;' : 'width: 500px;' ?>">
                <?= $aplicacion->audicion->titulo ?>
              </div>
              <?php if ($aplicacion->estado == TRUE) : ?>
                <div class="audicion-lugar">
                  Lugar </br>
                  <b><?php echo $aplicacion->audicion->direccion_audicion ?></b>
                </div>
                <div class="audicion-fecha1">
                  Hora de audición </br>
                  <b><?= get_hour($aplicacion->audicion->fecha_audicion) ?></b>
                </div>
                <div class="audicion-fecha1">
                  Fecha de audición </br>
                  <b><?php echo fecha_spanish_full_short($aplicacion->audicion->fecha_audicion) ?></b>
                </div>
              <?php else : ?>
                <div class="audicion-fecha1" style="margin-right: 72px; margin-left: 60px;">
                  Fecha de cierre </br>
                  <b><?php echo fecha_spanish_full_short($aplicacion->audicion->fecha_cierre) ?></b>
                </div>
                <div class="audicion-fecha1">
                  Fecha de audición </br>
                  <b><?php echo fecha_spanish_full_short($aplicacion->audicion->fecha_audicion) ?></b>
                </div>
              <?php endif; ?>
              <div class="estado-ico">
                  <?php if ($aplicacion->estado == NULL) : ?>
                      <img src="images/ico-reloj.png" />
                  <?php else : ?>
                      <?php if ($aplicacion->estado == TRUE) : ?>
                          <img src="images/ico-aceptar.png" />
                      <?php else : ?>
                          <img src="images/ico-rechazar.png" />
                      <?php endif; ?>
                  <?php endif; ?>
              </div>
            </div>            
          <?php endforeach; ?>
        <?php endif; ?>
          
      </div>



        <div class="clr"></div>
    </div>
    <div class="clr"></div>
    
</div>