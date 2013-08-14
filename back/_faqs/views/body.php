<div class="widget">
  
  <div class="header">
    <span><span class="ico gray window"></span>Crear Pregunta</span>
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
              <label for="titulo_faq">Pregunta</label>
              <div><input type="text" name="titulo_faq" id="name"  class="large" placeholder="Escriba el nombre acá..."></div>
            </div>

            <div class="section">
              <label for="respuesta_faq">Respuesta</label>
              <div> <textarea name="respuesta_faq" id="description" class="large" placeholder="Escriba la descripción acá..."></textarea> </div>
            </div>
            
            <div class="section">
              <label for="activo">Estado</label>
              <select style="width: 250px; height: 28px" name="activo">
                <option value = "" selected="selected">Seleccione el estado...</option>
                <option value = "true">Activo</option>
                <option value = "false">Inactivo</option>
              </select>
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
    <span><span class="ico gray window"></span>Todas las preguntas</span>
  </div><!-- End header -->
  <div class="content">

    <section class="clearfix">
      <div class="tableName toolbar">
        <table class="display data_table2" >
          <thead>
            <tr>
              <th><div class="th_wrapp">Pregunta</div></th>
              <th><div class="th_wrapp">Respuesta</div></th>
              <th><div class="th_wrapp">Categoría</div></th>
              <th><div class="th_wrapp">Estado</div></th>
          <th style="width:200px;"><div class="th_wrapp">Acciones</div></th>
          </tr>
          </thead>
          <tbody>
            <?php if ($datos->exists()) : ?>
              <?php foreach ($datos as $dato) : ?>
                <tr class="odd gradeX parent-delete">
                  <td class="center"><?php echo $dato->titulo_faq ?></td>
                  <td class="center"><em><?php echo $dato->respuesta_faq ?></em></td>
                  <td class="center"><em><?php echo $categoria->get_cat_faq($dato->id_categoria_faq) ?></em></td>
                  <td class="center"><em><?= $dato->activo ? "Activo" : "Inactivo" ?></em></td>
                  <td class="center">
                    <span class="tip">
                      <a href="<?php echo sprintf($edit_url, $dato->id) ?>" class="uibutton special">Editar</a>
                      <a href="<?php echo cms_url('admin/actions/delete') ?>" class="uibutton special" data-action="special-delete" data-table="faqs" data-field="id" data-value="<?= $dato->id ?>">
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
