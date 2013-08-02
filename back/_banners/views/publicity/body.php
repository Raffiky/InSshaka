

<div class="widget">
  <div class="header">
      <span><span class="ico gray window"></span>Crear publicidad</span>
  </div><!-- End header -->
  <div class="content">
    <div class="formEl_b">
      <div>
        <fieldset>
          <div class="clearfix">
            <?php echo form_open($save_url, 'id="uploader_form"') ?>
            
            <div class="section">
              <label for="titulo">Título y/o Cliente</label>
              <input class="large" name="titulo" id="titulo" placeholder="Digite el título o encabezado.." style="width: 50%">
            </div>
            
            <div class="section">
              <label>Cargar imágen</label>    
              <div id="container">
                <div id="drag-drop-area">
                  <div class="drag-drop-inside">
                    <p>
                      Arrastre la imágen acá <br> o <br> 
                      <a id="pickfiles" class="uibutton" href="#">Seleccione</a>
                    </p>
                  </div>
                </div>
                <div id="uploader-file-list"></div>
              </div>
            </div>

            <div class="section">
              <label for="url">Sitio web</label>
              <input class="large" name="url" id="url" type="url" placeholder="http://www.sitioweb.com" style="width: 40%">
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
        <span><span class="ico gray window"></span>Toda la publicidad</span>
    </div><!-- End header -->
    <div class="content">

        <section class="clearfix">
            <div class="tableName toolbar">
                <table class="display data_table2" >
                    <thead>
                        <tr>
                          <th><div class="th_wrapp">Cliente</div></th>
                          <th><div class="th_wrapp">Sitio web</div></th>
                          <th><div class="th_wrapp">Imágen</div></th>
                          <th style="width:200px;"><div class="th_wrapp">Acciones</div></th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php if ($datos->exists()) : ?>
                            <?php foreach ($datos as $dato) : ?>
                                <tr class="odd gradeX parent-delete">
                                  <td class="center"><?= $dato->title ?></td>
                                  <td class="center"><?= $dato->url ?></td>
                                  <td class="center"><img src = "<?= uploads_url($dato->thumb) ?>" width="80" /></td>

                                    <td class="center">
                                        <span class="tip">
                                            <a href="<?php echo cms_url('admin/actions/delete') ?>" class="uibutton special" data-action="special-delete" data-table="publicity_banners" data-field="id" data-value="<?= $dato->id ?>" data-delete-files='<?= json_encode(array($dato->image, $dato->thumb)) ?>'>
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


<script>
    /*  */
    var uploader = new plupload.Uploader({
        runtimes : 'html5, flash, gears, html4',
        browse_button : 'pickfiles',
        container : 'container',
        drop_element : 'drag-drop-area',
        unique_names : true,
        
        multipart : true,
        multi_selection: true,
        
        resize : {width : 1010, height : 110, quality : 90},

        
        url : <?php echo json_encode($upload_url) ?>,
        flash_swf_url : <?php echo json_encode(global_asset('plupload/js/plupload.flash.swf')) ?>,
        silverlight_xap_url : <?php echo json_encode(global_asset('plupload/js/plupload.silverlight.xap')) ?>,
        
        filters : [
            {title : "Archivos de imagen", extensions : "jpg,gif,png,jpeg"}
        ]
        
    });
    
    var edit_mode = false, can_submit = true;
    
    CMS.Uploader.queueMaxima = 1;
    uploader.bind('init', CMS.Uploader.init);
    uploader.bind('FilesAdded', CMS.Uploader.filesAdded);
    uploader.bind('UploadProgress', CMS.Uploader.UploadProgress);
    uploader.bind('Error', CMS.Uploader.Error);
    uploader.init();
    
    
    
    
    $('#uploader_form').on('submit', function() {
        var $this = $(this); 
        
        if (uploader.files.length > 0) {

         
            /* Setteando el ID del nuevo elemento como parametro para la subida */
            uploader.settings.multipart_params = { folder  : 'publicidad' };
                        
            /* Cuando haya subido redireccionar segun la url devuelta del AJAX */
            uploader.bind('StateChanged', function() {
                if (uploader.files.length === (uploader.total.uploaded + uploader.total.failed)){
                    $this[0].submit(); 
                }
            });
        
            uploader.bind('FileUploaded', function(up, file, info){
                var json = JSON.parse(info.response);
                $('<input name="images['+json.id+'][image]" type="hidden" value="'+json.image+'" />').appendTo($this);
                $('<input name="images['+json.id+'][thumb]" type="hidden" value="'+json.thumb+'" />').appendTo($this);
            });
                        
            /* Inciar subida */
            uploader.start();
           
            CMS.Loading.start('Creando...');   
        } else {
            CMS.Modals.alerta('Debe seleccionar al menos 1 imagen', 'Error al crear publicidad');
        }

        return false;
    });
</script>