
<?php if ($datos->exists()) : ?>
    <div class="show-cont" id="all-shows">

        <?php foreach ($datos as $dato) : ?>
          <?= $dato->id ?>
          <div class="clear"></div>
        <?php endforeach; ?>
    </div>
    <div class="clear"></div>

    <script>
        $(function() {           
          var alto_show = ($('.conDestacadoPerfil').height() - 150);
          
          $('#all-shows').css('height', alto_show);
          $('#all-shows').jScrollPane();
          
        });
    </script>

<?php else: ?>
    <p><small>No anuncios favoritos para este usuario.</small></p>
<?php endif; ?>