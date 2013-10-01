

<div class="widget">
    <div class="header">
        <span><span class="ico gray window"></span>Editar Preguntas</span>
    </div><!-- End header -->
    <div class="content">
        <div class="formEl_b">
            <div>
                <fieldset>
                    <div class="clearfix">

                        <?php echo form_open($save_url, 'data-action="ajax-form" data-after-save="reload"') ?>
                        <div class="section">
                            <label>Usuario</label>
                            <div>
                              <?php if(!empty($datos->full_name)) : ?>
                              <input type="text" name="full_name" id="full_name"  class="large" value="<?= $datos->full_name ?>" disabled="disabled">
                              <?php else : ?>
                              <input type="text" name="user_id" id="user_id"  class="large" value="<?= $datos->user->first_name." ".$datos->user->last_name ?>" disabled="disabled">
                              <?php endif; ?>
                            </div>
                        </div>
                        <div class="section">
                            <label>Email</label>
                            <div>
                              <?php if(!empty($datos->email)) : ?>
                              <input type="email" name="email" id="email" class="large" value="<?= $datos->email ?>" disabled="disabled">
                              <?php else : ?>
                              <input type="email" name="email" id="email" class="large" value="<?= $datos->user->email ?>" disabled="disabled">
                              <?php endif; ?>
                            </div>
                        </div>
                        <div class="section">
                            <label>Fecha</label>
                            <div>
                              <?php if(!empty($datos->created_on)) : ?>
                              <input type="text" name="created_on" id="created_on" class="large" value="<?= $datos->created_on ?>" disabled="disabled">
                              <?php endif; ?>
                            </div>
                        </div>
                        <div class="section">
                          <label for="categoria">Categoría</label>
                          <?= form_dropdown("id_categoria_faq", $categoria, $datos->id_categoria_faq) ?>
                        </div>
                        <div class="section">
                            <label for="name">Pregunta</label>
                            <div><input type="text" name="titulo_faq" id="name"  class="large" placeholder="Escriba el nombre acá..." value="<?php echo $datos->titulo_faq ?>" autofocus="true" required="true"></div>
                        </div>
                        
                        <div class="section">
                            <label for="description">Respuesta</label>
                            <div> <textarea name="respuesta_faq" id="description" class="large" placeholder="Escriba la descripción acá..."><?php echo $datos->respuesta_faq ?></textarea> </div>
                        </div>
                       <div class="section">
                            <label for="activo">Estado</label>
                            <div><?= form_dropdown("activo", array( 0 => "Seleccione...", 1 => "Activo", 0 => "Inactivo"), $datos->activo) ?></div>
                        </div>
                       

                        <br><br>

                        <button type="submit" class="uibutton">Guardar</button>

                        <?php echo form_close() ?>

                    </div>

                </fieldset>
            </div>

        </div>

    </div>	
</div>
