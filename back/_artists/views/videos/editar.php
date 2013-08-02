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
              <input type="url" class="large" name="url" id="url" value="<?= !empty($datos->url) ? $datos->url : null ?>" style="width: 50%">
            </div>
            
            <div class="section">
              <label for="artist_id">Artísta o Banda</label>
              <div class="select-large">
                <?= form_dropdown('artist_id', $select_artist, (!empty($datos->artist_id) ? $datos->artist_id : null), 'style="width:385px;"   class="comboBox1"') ?>
              </div>
            </div>
            
            <div class="section">
              <label for="media_categoria_id">Categoría</label>
              <div class="select-large">
                <?= form_dropdown('media_categoria_id', $select_category, (!empty($datos->media_categoria_id) ? $datos->media_categoria_id : null), 'style="width:385px;"   class="comboBox1"') ?>
              </div>
            </div>
            
            <div class="section">
              <label for="description">Descripción</label>
              <div> <textarea name="description" id="description" class="large" value="<?= !empty($datos->description) ? $datos->description : null ?>" ></textarea> </div>
            </div>
            
            <div class="section">
              <label>Activo</label>
              <div>
                  <input type="checkbox" id="active" name="active" class="active_media" value="<?= $datos->active == 1 ? 1 : 0?>">
              </div>
            </div>
            
            <div class="section">
              <label>Destacado</label>
              <div>
                  <input type="checkbox" id="destacado" name="destacado" class="destacado_media" value="<?= $datos->description == 1 ? 1 : 0 ?>">
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