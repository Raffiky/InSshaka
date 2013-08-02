<html>
  <head>
    <link href="<?php echo front_asset('css/style.css') ?>" rel="stylesheet" type="text/css" />
    <style>
      #herramientas{
        float: right; 
        width: 200px; 
        background-color: #D5D5D5; 
        border: 1px solid #999; 
        padding: 10px;
      }
    </style>
    <script src="<?= front_asset('js/jquery-1.7.2.min.js') ?>"></script>
    <script src="<?= front_asset('js/fabric.js') ?>"></script>
    <script>
      $(function(){
          $("#stage").on("change", function(){
              var stage = $(this).val();
              $("#c1").css({
                "background-image"  : "url(<?= front_asset('images/app_inshaka/stages') ?>/" + stage + ")",
                "background-clip"   : "content-box",
                "background-size"   : "contain",
                "background-repeat" : "no-repeat"
              });
          });
          
          var canvas = new fabric.Canvas('c1');
          canvas.add(new fabric.Circle({ radius: 30, fill: '#f55', top: 100, left: 100 }));

          canvas.selectionColor = 'rgba(0,255,0,0.3)';
          canvas.selectionBorderColor = 'red';
          canvas.selectionLineWidth = 5;
          
          $("#btn_agregar_singer").on("click", function(){
            fabric.Image.fromURL('http://local.inshaka.com/uploads/crisdanilo/photos/p17orqgnn6167jqc51mn21q9l138t3.png', function(img) {
          img.set('left', fabric.util.getRandomInt(200, 600)).set('top', -50);
          img.movingLeft = !!Math.round(Math.random());
          canvas.add(img);
          });
          });
      });
      
      var canvas = new fabric.Canvas('c1');
      canvas.add(new fabric.Circle({ radius: 30, fill: '#f55', top: 100, left: 100 }));

      canvas.selectionColor = 'rgba(0,255,0,0.3)';
      canvas.selectionBorderColor = 'red';
      canvas.selectionLineWidth = 5;
      
      //Agregar imagen a canvas
      function agregaImg(uploadedFile) {
        fabric.Image.fromURL('http://local.inshaka.com/uploads/crisdanilo/photos/p17orqgnn6167jqc51mn21q9l138t3.png', function(img) {
          img.set('left', fabric.util.getRandomInt(200, 600)).set('top', -50);
          img.movingLeft = !!Math.round(Math.random());
          canvas.add(img);
        });
      }
      
      //Funcion para Obtener un numero aleatorio
      function random(min, max) {
        return Math.floor(Math.random() * (max - min + 1)) + min;
      }
    </script>
  </head>
  <body>
    <div class="contenido" style="padding: 20px;">
      <div id="herramientas">
        <?= form_dropdown('stage', array('' => 'Seleccione un escenario','stage_one.jpg' => 'escenario uno', 'stage_two.jpg' => 'escenario dos', 'stage_three.jpg' => 'escenario tres'), null, 'id="stage"') ?>
        <div class="clr"></div>
        <button id="btn_agregar_singer">Agregar</button>
        <div class="clr"></div>
      </div>
      <canvas id="c1" width="750" height="400"></canvas>
    </div>
  </body>
</html>