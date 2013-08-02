

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
                          <label for="categoria">Categoría</label>
                            <select style="width: 455px; height: 28px" name="id_categoria_faq">
                              <?php if($categoria->exists()) : ?>
                                <option value = "" selected="selected">Seleccione la categoría...</option>
                                <?php foreach ($categoria as $cat) : ?>
                                  <option value = "<?=$cat->id ?>"><?=$cat->categoria_faq ?></option>
                                <?php endforeach; ?>
                              <?php endif; ?>
                            </select>
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
                            <div><select name="activo">
                                <option value="true" selected="selected">Activo</option> 
                                <option value="false">Inactivo</option>
                              </select></div>
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
