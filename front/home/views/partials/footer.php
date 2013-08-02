<style type="text/css">
  .image_carousel {
    padding: 30px 0 15px 40px;
    position: relative;
    width: 915px;
    margin: 0 auto;
  }
  .image_carousel li img {
    border: 1px solid #ccc;
    background-color: white;
    margin: 7px;
    display: block;
    float: left;
  }
  .image_carousel ul {
	margin: 0;
	padding: 0;
	list-style: none;
	display: block;
}
.image_carousel .link_publicity { 
  background: transparent url("<?php echo base_url('assets/images/zc.png') ?>") no-repeat;
  width: 138px;
  height: 44px;
  position: relative;
  margin-top: 119px;
}
.image_carousel li a{
  clear:both; 
  float: left; 
  width: 134px; 
  text-align: center;
}
.image_carousel li {
	font-size: 12px;
	color: #666;
	background-color: #f0f0f0;
	padding: 0;
	margin: 6px;
	display: block;
	float: left;
}
.timer {
	background-color: #9E1F63;
	width: 0;
	height: 10px;
       max-width: 400px;
}
  a.prev, a.next {
    background: url(/assets/images/miscellaneous_sprite.png) no-repeat transparent;
    width: 45px;
    height: 50px;
    display: block;
    position: absolute;
    top: 85px;
  }
  a.prev {			
    left: -22px;
    background-position: 0 0; 
  }
  a.prev:hover {background-position: 0 -50px; }
  a.prev.disabled {background-position: 0 -100px !important;  }
  a.next {			
    right: -22px;
    background-position: -50px 0; 
  }
  a.next:hover {background-position: -50px -50px; }
  a.next.disabled {background-position: -50px -100px !important;  }
  a.prev.disabled, a.next.disabled {
    cursor: default;
  }

  a.prev span, a.next span {
    display: none;
  }
  .clearfix {
    float: none;
    clear: both;
  }
  
  
  
</style>
<div id="footer-main" class="image_carousel">
  <span style="font-size: 10px; color: #666; font-weight: bold; margin-left: -52px;">Zona comercial</span>
  <?php if ($publicity_banner->exists()) : ?>
  <ul id="publicidad">
    <?php foreach ($publicity_banner as $publicity) : ?>
    <li>
    <img src="<?= uploads_url($publicity->image) ?>" alt="<?= $publicity->title ?>" width="120" height="120" style="float:left;" /><div class="link_publicity"><a href="<?= $publicity->url ?>" target="_blank"><?= $publicity->title ?></a></div>
    </li>
    <?php endforeach; ?>
  </ul>
  <div class="clearfix"></div>
  <div class="timer" id="publicidad_timer"></div>
  <!--
  <a class="prev" id="publicidad_prev" href="#"><span>prev</span></a>
  <a class="next" id="publicidad_next" href="#"><span>next</span></a> -->
  <?php endif; ?>
</div>
<?php if ($footer_banner->exists()) : ?>
    <div class="banner">	
            <div class="logoBanner"><!--<img src="images/logoBanner.png" alt="" />--></div>
        <ul class="slideshow">
            <?php
            $first_footer_banner = true;
            foreach ($footer_banner as $banner) :
                ?>
                <li class="<?php echo $first_footer_banner ? 'show' : null ?>"><a href="#"><img src="<?php echo uploads_url($banner->image) ?>" title="" alt=""/></a></li>
                <?php
                $first_footer_banner = false;
            endforeach;
            ?> 
        </ul>
    </div>
<?php endif; ?>

<div class="conFooter">
    <div class="conLogoFooter"><a href="<?php echo site_url() ?>"><img src="<?php echo base_url('assets/images/logoFooter.png') ?>" alt="" /></a></div>   
    <div class="conMenuFooter">
        <ul id="menu-footer">
            <li><a class="b1" href="<?php echo site_url() ?>">INICIO</a></li>
            <li><a class="b2" href="<?php echo site_url('perfil') ?>">MISHAKA</a></li>
            <li><a class="b3" href="<?php echo site_url('build-a-band') ?>">CREAR BANDA</a></li>
            <li><a class="b4" href="<?php echo site_url('audiciones') ?>">AUDICIONES</a></li>
            <li><a class="b5" href="<?php echo site_url('directorio') ?>">DIRECTORIO</a></li>
            <li><a class="b6" href="<?php echo site_url('clasificados') ?>">CLASIFICADOS</a></li>
            <li style="border-right:none;"><a href="<?php echo site_url('faqs') ?>">FAQ</a></li>
        </ul>
    </div>
    <div class="conDerechos">
        <div class="txDerechos" style="line-height: 27px; width: 279px">
            <span class="derechos">&copy; 2012 Todos los derechos reservados por INSHAKA</span>
        </div>
        <div class="copyHome" style="width:404px;">
            <div class="footer-autor" style="float:left; width:210px">
              <a href="http://www.inshaka.com">Programación: </a>
              <a href="http://www.inshaka.com">In<span style="color: #E82E7C">S</span>haka Development</a>
            </div>
            <div class="footer-autor" style="width: 175px;">
                <span id="ahorranito2"></span>
                <a href="http://www.imaginamos.com">Diseño: </a>
                <a href="http://www.imaginamos.com">imagin<span>a</span>mos.com</a>
            </div>
        </div>
    </div>
    <div class="conRedesFooter">
        <a href="http://www.facebook.com/Inshakaco" target="_blank"><div class="red1"></div></a>
        <a href="http://twitter.com/inshaka" target="_blank"><div class="red2"></div></a>
        <a href="http://youtube.com/inshaka" target="_blank"><div class="red3"></div></a>
    </div>
</div>