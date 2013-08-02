

<div class="widget">
  <div class="header">
      <span><span class="ico gray window"></span>Nuevo video</span>
  </div><!-- End header -->
  <div class="content">
    <div class="formEl_b">
      <div>
        <fieldset>
          <div class="clearfix">
            <?php echo form_open($save_url, 'id="uploader_form"') ?>
            
            <div class="section">
              <label for="url">Url</label>
              <input type="url" class="large" name="url" id="url" placeholder="http://www.youtube.com/url_video" style="width: 50%">
            </div>
            
            <div class="section">
              <label for="artist_id">Artísta o Banda</label>
              <div class="select-large">
                <?= form_dropdown('artist_id', $select_artist, null, 'style="width:385px;"   class="comboBox1"') ?>
              </div>
            </div>
            
            <div class="section">
              <label for="media_categoria_id">Categoría</label>
              <div class="select-large">
                <?= form_dropdown('media_categoria_id', $select_category, null, 'style="width:385px;"   class="comboBox1"') ?>
              </div>
            </div>
            
            <div class="section">
              <label for="description">Descripción</label>
              <div> <textarea name="description" id="description" class="large" placeholder="Escriba una breve descripción aquí.."></textarea> </div>
            </div>
            
            <div class="section">
              <label>Activo</label>
              <div>
                  <input type="checkbox" id="active" name="active" class="active_media" value="1">
              </div>
            </div>
            
            <div class="section">
              <label>Destacado</label>
              <div>
                  <input type="checkbox" id="destacado" name="destacado" class="destacado_media" value="0">
              </div>
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
        <span><span class="ico gray window"></span>Todos los videos</span>
    </div><!-- End header -->
    <div class="content">

        <section class="clearfix">
            <div class="tableName toolbar">
                <table class="display data_table2" >
                    <thead>
                        <tr>
                          <th><div class="th_wrapp">Artísta o Banda</div></th>
                          <th><div class="th_wrapp">Categoría</div></th>
                          <th><div class="th_wrapp">Video</div></th>
                          <th><div class="th_wrapp">Activo</div></th>
                          <th><div class="th_wrapp">Destacado</div></th>
                          <th style="width:200px;"><div class="th_wrapp">Acciones</div></th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php if ($datos->exists()) : ?>
                            <?php foreach ($datos as $dato) : $dato->get_oembed();?>
                                <tr class="odd gradeX parent-delete">
                                  <td class="center"><?= $dato->artist->name ?></td>
                                  <td class="center"><?= $dato->media_categoria->name ?></td>
                                  <td class="center"><img src = "<?= $dato->oembed->thumbnail_url ?>" width="80" /></td>
                                  <td class="center"><?= $dato->active == 1 ? 'Activo' : 'Desactivado'?></td>
                                  <td class="center"><?= $dato->destacado == 1 ? 'Destacado' : 'No destacado' ?></td>
                                  <td class="center">
                                    <span class="tip">
                                      <a href="<?php echo sprintf($edit_url, $dato->id) ?>" class="uibutton special">Editar</a>
                                      <a href="<?php echo cms_url('admin/actions/delete') ?>" class="uibutton special" data-action="special-delete" data-table="artists_medias" data-field="id" data-value="<?= $dato->id ?>" data-delete-files='<?= json_encode(array($dato->url, $dato->media_categoria_id, $dato->code, $dato->created_on, $dato->artist_id, $dato->description)) ?>'>
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