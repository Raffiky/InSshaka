
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
    .c3{
        color:#333 !important;	
    }
    input[type="checkbox"] + label {
        background: url("images/fondo-check.png") no-repeat scroll 0 0 transparent;
        height: 14px;
        margin-top: -14px;
        padding-left: 26px;
        padding-top: 3px;
    }
    input[type="checkbox"] {
        cursor: pointer;
        left: 0;
        margin-bottom: -10px;
        margin-right: 20px;
        opacity: 0.01;
    }
    .ver-mas{
        margin-top:0;
    }
    .bot-buscar {
        float:right;
        margin-top:30px;
        margin-bottom:50px;
    }
    .m-nombre {

        padding-left: 0;
    }
    .integrantes-modal, .musicos{
        width:1000px;
        display:block;
    }
    .musicos{
        width:980px;
    }
</style>

<div class="contenido">

    <div class="mi-clasificado-cont">
        <ul class="tabs">
            <li class="t6 active"><a href="#">Mis Conciertos</a></li>
            <li class="t8"><a href="<?php echo site_url('build-a-band/crear-concierto') ?>">Crear Concierto</a></li>
        </ul>
    </div>

    <div class="clear"></div>
    <div class="tab_container">

        <div id="tab1" class="tab_content">
          
            <?php if ($datos->exists()) : ?>

                <div class="resultados"></div>
                <div id="contenu3">

                    <?php foreach ($datos as $dato) : ?>
                      
                        <div class="bandas">
                            <div class="banda-nom"><a href="<?php echo site_url(array('build-a-band', 'editar_concierto', $dato->id, $dato->nombre_concierto)) ?>"><?php echo $dato->nombre_concierto ?></a></div>

                            <div class="opciones-ico">
                                <div class="borrar"><a href="<?php echo site_url('perfil/conciertos/eliminar/' . $dato->id) ?>" onclick="return confirm('¿Está seguro de eliminar la banda?');">Borrar</a></div>
                                <a href="<?php echo site_url(array('build-a-band', 'editar_concierto', $dato->id, $dato->nombre_concierto)) ?>"><div class="editar">Editar</div></a>
                            </div>
                            <div class="clr"></div>
                        </div>

                    <?php endforeach; ?>

                </div>

            <?php else: ?>

                <div><p>No tienes ningun concierto creado. Crea el primero dando <a href="<?php echo site_url('build-a-band/crear-banda') ?>">click acá.</a></p></div>

            <?php endif; ?>

            <div class="clr"></div>
        </div>


    </div>

</div>