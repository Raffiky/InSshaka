<div class="widget">
  
  <div class="header">
    <span><span class="ico gray window"></span>Crear Categoría FAQ</span>
  </div><!-- End header -->
  <div class="content">
    <div class="formEl_b">
      <div>
        <fieldset>
          <div class="clearfix">
            <?php echo form_open($save_url, 'data-action="ajax-form" data-after-save="reload"') ?>
            
            <div class="section">
              <label for="categoria_faq">Categoría</label>
              <div><input type="text" name="categoria_faq" id="name"  class="large" placeholder="Escriba el nombre de la categoría..."></div>
            </div>

            <div class="section">
              <label for="descripcion">Descripción</label>
              <div> <textarea name="descripcion" id="description" class="large" placeholder="Escriba la descripción..."></textarea> </div>
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

<div class="widget">
  <div class="header">
    <span><span class="ico gray window"></span>Todas las categorías</span>
  </div><!-- End header -->
  <div class="content">

    <section class="clearfix">
      <div class="tableName toolbar">
        <table class="display data_table2" >
          <thead>
            <tr>
              <th><div class="th_wrapp">Categoría</div></th>
              <th><div class="th_wrapp">Descripción</div></th>
          <th style="width:200px;"><div class="th_wrapp">Acciones</div></th>
          </tr>
          </thead>
          <tbody>
            <?php if ($datos->exists()) : ?>
              <?php foreach ($datos as $dato) : ?>
                <tr class="odd gradeX parent-delete">
                  <td class="center"><?php echo $dato->categoria_faq ?></td>
                  <td class="center"><em><?php echo $dato->descripcion ?></em></td>
                  <td class="center">
                    <span class="tip">
                      <a href="<?php echo sprintf($edit_url, $dato->id) ?>" class="uibutton special">Editar</a>
                      <a href="<?php echo cms_url('admin/actions/delete') ?>" class="uibutton special" data-action="special-delete" data-table="categoria_faqs" data-field="id" data-value="<?= $dato->id ?>">
                        Eliminar
                      </a>
                    </span>
                  </td>
                </tr>
              <?php endforeach; ?>
            <?php endif; ?>
          </tbody>
        </table>
      </div>
    </section>
  </div>	
</div>

