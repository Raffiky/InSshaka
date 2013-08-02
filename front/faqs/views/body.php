<script type="text/javascript">
$(function(){
    $('.sup a:first').addClass('active');
  }
)
</script>
<style>
  .header {
    position: fixed;
    z-index: 1000;
  }
  .bgEncabezado {
    position: fixed;
    top: 50px;
    z-index: 1000;
  }
  #question-faq{
    position: fixed;
    top: 130px;
    padding: 30px 70px 8px 164px;
    z-index: 1000;
    height: 118px;
    background-color: #eeefed;
  }
p,
ul {
  margin: 0;
  padding: 0;
}
p {
  margin-bottom: 20px;
  font-size: 12px;
  color: #444;
}
.acitem .current a {
  background: #E82E7C;
  color: #FFF;
}
.current {
  background: #FFF;
}
#container {
  top: 350px;
  width: 800px;
}
.section {
  border-bottom: 5px solid #ccc;
  padding: 20px;
  width: 680px;
  text-align: justify;  
  font-family: 'arial';
}
.section p:last-child {
  margin-bottom: 0;
}
#faq {
  width: 800px;
  float: right;
  position: relative;
  top: 270px;
  z-index: 1;
  margin-bottom: 400px;
}
</style>
<script>
  $(document).ready(function(){
    $('.list-acordeon li:first').addClass('current');
    $('.list-acordeon').onePageNav({
      scrollOffset: 290
    });
  
    /*  Caja flotante de publicidad */
    var posicion = $("#fin-faq").offset();
     $(window).scroll(function() {
        if ($(window).scrollTop() >= (posicion.top - (150 + $('.list-acordeon').outerHeight()))) {
     
          $('.list-acordeon, #question-faq, .header, .bgEncabezado').css('position', 'absolute');
        } else {
          $('.list-acordeon, #question-faq, .header, .bgEncabezado').css('position', 'fixed');
        };
     });
  });  

</script>
<div class="bgEncabezado">
  <div class="conEncabezado">
    <div id="txSeccion">
      <div class="encabezado-tit">FAQ</div>
      <div class="encabezado-subtit">&nbsp;</div>
    </div>
  </div>
</div>
<div class="contenido">
  <div id="question-faq">
  <?php echo form_open('faqs/save_question', 'id="save-question-form"') ?>
    <div class="area-cont2">
    <textarea style="resize: none; width: 650px;" id="pregunta" name="pregunta" class="area2" placeholder="Ingresa aquí tu pregunta y el grupo de INSHAKA la responderá lo antes posible"></textarea>
    <input class="bot-publicar" type="submit" value="Enviar" style="margin-top:70px;margin-right:10px;">
    </div>
    <div class="clear"></div> 
  <?php echo form_close(); ?>
  </div>
  <div class="clear"></div>
  <?php if ($categoria->exists()) : ?>
    <div class="faq-list1">
      <ul id="navigation " class="acordeon collapsible list-acordeon">
        <?php foreach ($categoria as $cat) : ?>
        <li class="sup">
          <a  href="#" ><?=$cat->categoria_faq ?></a>
            <ul class="acitem" style="display: block; ">
              <?php foreach ($faqs as $question) : ?>
                <?php if($question->id_categoria_faq == $cat->id): ?>
                  <li><a  href="#section-<?= $question->id ?>"> <?=$question->titulo_faq ?></a></li>
                <?php endif; ?>
              <?php endforeach; ?>
            </ul>
        </li>
        <?php endforeach; ?>
      </ul>
    </div>
    <div id="faq">
      <?php foreach ($faqs as $answer) : ?>
        <div class="section" id="section-<?=$answer->id?>">
          <h1 style="color:#E82E7C; font-size: 1.3em; height: 30px; font-family: 'BebasNeueRegular'"><?=$answer->titulo_faq ?></h1>
          <p><?=$answer->respuesta_faq?></p>
        </div>
      <?php endforeach; ?> 
      <div id="fin-faq" style="height: 30px;"></div>
    </div>
  <?php endif; ?>
</div>