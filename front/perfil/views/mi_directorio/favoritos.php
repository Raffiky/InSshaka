


<script type="text/javascript">
    $(document).ready(function(){
        var estado = 1;
        var estado2 = 0;
        $(".tab_content").hide();
        $(".t6").addClass("active").show();
		
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
       
        $("#contenu3").scrollbar(428);
        $(".t6").click(function()
        {
            if (estado == 0){
                $("#contenu3").scrollbar(428);
                estado = 1;
            }
		
			
        });
        $(".t7").click(function()
        {
           
            if (estado2 == 0){
                $("#contenu4").scrollbar2(428);
                estado2 = 1;
            }
		
			
        });
        $(".comboBox1").msDropDown().data("dd");
        /*$(".ver-mas").click(function()
           {
			
            $("ul.tabs li").removeClass("active");
            $(".t4").addClass("active");
            $(".tab_content").hide();
    		

            var activeTab = $("#tab4");
            $(activeTab).fadeIn();
            return false;
			
        });
        $(".resultado").click(function()
           {
			
            $("ul.tabs li").removeClass("active");
            $(".t4").addClass("active");
            $(".tab_content").hide();
    		
            var activeTab = $("#tab4");
            $(activeTab).fadeIn();
            return false;
			
        });*/
		
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
    .c5{
        color:#333 !important;	
    }
    .t4{
        display:none !important;		
    }
    .t4-active{
        display:none !important;	
    }
</style>


<div class="contenido">
    <div class="mi-directorio-cont">
        <ul class="tabs">
            <li class="t6"><a href="#tab1">Mi Directorio</a></li>
            <li class="t8"><a href="#tab2">Crear Anuncio</a></li>

        </ul>
    </div>

    <div class="clear"></div>
    <div class="tab_container">

        <div id="tab1" class="tab_content">
          
            <?php if (!empty($alert_messages)) : ?>
              <div><?php echo $alert_messages ?></div>
            <?php endif; ?>
                
            <div class="resultados"></div>
            <?php if ($datos->exists()) : ?>
                <div id="contenu3">
                    <?php foreach ($datos as $directorio) : ?>
                        <div class="resultado">
                            <a href="#">
                                <?php if (!empty($anuncio->get_anuncio($directorio->directorio_id)->logo)) : ?>
                                    <div class="logo-anuncio" style="float:left;">
                                        <img width="120" src="<?php echo uploads_url($anuncio->get_anuncio($directorio->directorio_id)->logo) ?>" alt="Logo de anuncio: <?php echo $anuncio->get_anuncio($directorio->directorio_id)->empresa ?>" /> 
                                    </div>
                                <?php else: ?>
                                    <div class="resultado-ico"></div>
                                <?php endif; ?>
                            </a>
                            <a href="#">
                                <div class="resultado-nom">
                                    <div class="resultado-empresa"><?php echo $anuncio->get_anuncio($directorio->directorio_id)->empresa ?></div>
                                    <div class="resultado-calle"><?php echo $anuncio->get_anuncio($directorio->directorio_id)->direccion ?></div>
                                    <div class="resultado-tel">Tel. <?php echo $anuncio->get_anuncio($directorio->directorio_id)->telefono ?></div>
                                </div>
                            </a>
                            <div class="resultado-desc"><?php echo substr($anuncio->get_anuncio($directorio->directorio_id)->descripcion, 0, 250) ?> ...</div>
                            <a href="<?= site_url('perfil/directorios/delete_favorite/'.$directorio->id) ?>"> <div class="borrar">Borrar</div></a>
                            <div class="clr"></div>
                        </div>
                    <?php endforeach; ?>
                </div>

                <?php if ($datos->paged->total_pages > 1) : ?>
                    <!-- Paginador -->
                    <div class="paginador">
                        <?php if ($datos->paged->has_previous) : ?>
                            <a href=""><div class="pag-prev"></div></a>
                        <?php endif; ?>

                        <div class="numeros">
                            <?php for ($i = 1, $total_pages = $datos->paged->total_pages; $i <= $total_pages; $i++) : ?>
                                <div class="numero"><?php echo $i ?></div>
                            <?php endfor; ?>
                        </div>

                        <?php if ($datos->paged->has_next) : ?>
                            <a href=""><div class="pag-next"></div></a>
                        <?php endif; ?>
                    </div>
                    <!-- // Paginador -->
                <?php endif; ?>

            <?php else: ?>
                <h4>Aún no tienes anuncios establecidos como favoritos.</h4>
            <?php endif; ?>


            <div class="clr"></div>
        </div>


        <div id="tab2" class="tab_content">
           Para crear un anuncio dentro de directorio, debe crear un perfil como proveedor.
        </div>

        <div class="clr"></div>
    </div>
</div>

<script defer src="<?php echo front_asset('js/directorio.js') ?>"></script>