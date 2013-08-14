<style type="text/css">
  .c2{
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
  .res-perfil {
    margin: 0 21px 31px;
    width: 200px;
  }
  .res-datos {
    margin-top: 16px;
  }
  .res-txt {
    font-size: 17px;
  }
</style>
<script type="text/javascript">
  $(function(){
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
        
        $( "#search_users_followers" ).autocomplete({ 
          source: "<?php echo site_url('perfil/social/get_users') ?>"
        });
        
        $( "#search_users_fan" ).autocomplete({ 
          source: "<?php echo site_url('perfil/social/get_fans') ?>"
        });
  });
  function follow(id, elemento){
    $("#follow-her-him").dialog({
      resizable : false,
      modal     : true,
      show      : 'drop',
      hide      : 'drop',
      width     : '400px',
      buttons   : {
        "Aceptar" : function(){
          var datos = {
            id  : id
          };
          
          $.ajax({
            type  : "get",
            url   : "<?= site_url("perfil/ajax/delete_follow") ?>",
            data  : datos,
            success : function(){
              $(elemento).fadeOut("slow");
            },
           error    : function(){
              alert("Se ha producido un error. Inténtelo más tarde");
           }
          });
          return $(this).dialog('close');
        },
        "Cancelar"  : function(){
          $(this).dialog('close');
        }
      }
    });
  } 
</script>
<div class="contenido">
  <div class="audiciones-cont">
        <ul class="tabs">
            <li class="t1 active"><a href="#tab1">Mis Fans</a></li>
            <li class="t7"><a href="#tab2">Soy Fan de...</a></li>
        </ul>
    </div>

    <div class="clear"></div>
    <div class="tab_container">
      
      <!-- Mis fans -->
      <div id="tab1" class="tab_content">
        <div class="selectores-buscador">
          <?= form_open(site_url('perfil/social/buscar'), null) ?>
            <input id="search_users_followers" name="s" class="campo4" type="text" placeholder="Digite para buscar personas" >
            <input class="bot-buscar" type="submit" value="buscar" style="margin-bottom: 0px; float:left; margin-left: 20px;">
            <div class="clr"></div>
          <?= form_close() ?>
        </div>
         <div id="resultados" style=" width: 987px; margin: 0 auto; padding: 10px">
          <?php if (!empty($datos)): ?>
            <?php if ($datos->exists()): ?>
              <?php foreach ($datos as $dato) : ?>
              <div class="res-perfil">
                <div class="foto-banda">
                  <a href="<?php echo site_url('perfil/' . $dato->user->inshaka_url) ?>" style="display:block; height:151px; overflow:hidden;">
                    <?php if(!$user_photo->get_photo($dato->user->id)) : ?>
                      <img width="170" height="150" src="images/imagensino.png" >
                    <?php else: ?>
                      <img width="170" height="150" src="<?php echo uploads_url($user_photo->get_photo($dato->user->id)) ?>">
                    <?php endif; ?>
                  </a>
                  <div class="res-datos">
                    <div class="res-txt">Nombre: <b><?php echo $dato->user->first_name.' '.$dato->user->last_name ?></b></div>
                    <div class="bot-acc"><a href="<?php echo site_url(array('perfil', $dato->user->inshaka_url)) ?>">Ver perfil</a></div>
                  </div>
                </div>
              </div>
              <?php endforeach; ?>
              <div class="clear"></div>
              <?php if ($datos->paged->total_pages > 1) : ?>
                <!-- Paginador -->
                <div class="paginador">
                  <?php if ($datos->paged->has_previous) : ?>
                    <a href="<?php echo sprintf($paginator_url, $datos->paged->previous_page) ?>"><div class="pag-prev"></div></a>
                  <?php endif; ?>
                  <div class="numeros">
                    <?php for ($i = 1, $total_pages = $datos->paged->total_pages; $i <= $total_pages; $i++) : ?>
                      <div class="<?php echo $i == $datos->paged->current_page ? 'numero-act' : 'numero' ?>">
                        <a href="<?php  echo $i != $datos->paged->current_page ? sprintf($paginator_url, $i) : 'javascript:;' ?>">
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
            <?php else : ?>
              <div class="resultados">Su búsqueda no produjo resultados.</div>
            <?php endif; ?>
          <?php endif; ?>
        </div>
      </div>      
      <!-- Fin mis fans -->
      
      <!-- Soy fan de -->
      <div id="tab2" class="tab_content">
        <div class="selectores-buscador">
          <?= form_open(site_url('perfil/social/buscar'), null) ?>
            <input id="search_users_fan" name="g" class="campo4" type="text" placeholder="Digite para buscar personas" >
            <input class="bot-buscar" type="submit" value="buscar" style="margin-bottom: 0px; float:left; margin-left: 20px;">
          <?= form_close() ?>
          <button class="bot-aceptar" onclick="$('.elemento-check-list').slideToggle('fast');" style="margin-left: 10px;">Editar</button>
          <div class="clr" style="margin-bottom: 20px;"></div>
        </div>
         <div id="resultados" style=" width: 987px; margin: 0 auto; padding: 10px">
          <?php if (!empty($i_am_fan)): ?>
            <?php if ($i_am_fan->exists()): ?>
              <?php foreach ($i_am_fan as $i_fan) : ?>
              <div class="res-perfil" id="soy-fan-<?= $i_fan->id ?>">
                <div class="foto-banda">
                  <a href="<?php echo site_url('perfil/' . $usuario_fan->get_url_inshaka($i_fan->user_follow_id)) ?>" style="display:block; height:151px; overflow:hidden;">
                    <?php if(!$user_photo->get_photo($i_fan->user_follow_id)) : ?>
                      <img width="170" height="150" src="images/imagensino.png" >
                    <?php else: ?>
                      <img width="170" height="150" src="<?php echo uploads_url($user_photo->get_photo($i_fan->user_follow_id)) ?>">
                    <?php endif; ?>
                  </a>
                  <div class="res-datos">
                    <div class="res-txt">Nombre: <b><?= $usuario_fan->get_name($i_fan->user_follow_id) ?></b></div>
                    <div class="bot-acc"><a href="<?= site_url('perfil/'.$usuario_fan->get_url_inshaka($i_fan->user_follow_id)) ?>">Ver perfil</a></div>
                    <div class="elemento-check elemento-check-list" style="float: none; display: none; margin-top: 13px;">
                      <input type="submit" class="bot-logout" value="Dejar de seguir" onclick="follow(<?= $i_fan->id ?>, '#soy-fan-<?= $i_fan->id ?>')" style="float:left; border: 0px; font-size: 0.9em; margin-top: -4px;"/>
                    </div>
                  </div>
                </div>
              </div>
              <?php endforeach; ?>
              <div class="clear"></div>
              <?php if ($i_am_fan->paged->total_pages > 1) : ?>
                <!-- Paginador -->
                <div class="paginador">
                  <?php if ($i_am_fan->paged->has_previous) : ?>
                    <a href="<?php echo sprintf($paginator_url, $i_am_fan->paged->previous_page) ?>"><div class="pag-prev"></div></a>
                  <?php endif; ?>
                  <div class="numeros">
                    <?php for ($i = 1, $total_pages = $i_am_fan->paged->total_pages; $i <= $total_pages; $i++) : ?>
                      <div class="<?php echo $i == $i_am_fan->paged->current_page ? 'numero-act' : 'numero' ?>">
                        <a href="<?php  echo $i != $i_am_fan->paged->current_page ? sprintf($paginator_url, $i) : 'javascript:;' ?>">
                          <?php echo $i ?>
                        </a>
                      </div>
                    <?php endfor; ?>
                  </div>
                  <?php if ($i_am_fan->paged->has_next) : ?>
                    <a href="<?php echo sprintf($paginator_url, $i_am_fan->paged->next_page) ?>"><div class="pag-next"></div></a>
                  <?php endif; ?>
                </div>
                <!-- // Paginador -->
              <?php endif; ?>
            <?php else : ?>
              <div class="resultados">Su búsqueda no produjo resultados.</div>
            <?php endif; ?>
          <?php endif; ?>
        </div>
      </div>
      <!-- Fin soy fan de -->
    </div>
    <div id="follow-her-him" title="Dejar de Seguir" style="display:none">
        <p>
          Estás seguro que deseas dejar de seguir a este usuario?
        </p>
      </div>
</div>
