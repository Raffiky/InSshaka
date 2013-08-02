

<div class="widget">
    <div class="header">
        <span><span class="ico gray window"></span>Editar categoría</span>
    </div><!-- End header -->
    <div class="content">
        <div class="formEl_b">
            <div>
                <fieldset>
                    <div class="clearfix">

                        <?php echo form_open($save_url, 'data-action="ajax-form" data-after-save="reload"') ?>
                        <div class="section">
                            <label for="categoria_faq">Categoría</label>
                            <div><input type="text" name="categoria_faq" id="name"  class="large" placeholder="Escriba el nombre de la categoría..." value="<?php echo $datos->categoria_faq ?>" autofocus="true" required="true"></div>
                        </div>
                        
                        <div class="section">
                            <label for="descripcion">Descripción</label>
                            <div> <textarea name="descripcion" id="descripcion" class="large" placeholder="Escriba la descripción acá..."><?php echo $datos->descripcion ?></textarea> </div>
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
