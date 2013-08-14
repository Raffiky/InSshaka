    <!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" class="ie9" xmlns:fb="http://ogp.me/ns/fb#"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

        <title><?php echo $template['title']; ?></title>
        <meta content="266785850134055" property="fb:admins">
        <meta content="<?= front_asset('images/imagensino.png') ?>" property="og:image"> 
		
        <link rel="caninocal" href="<?php echo current_url() ?>" />
       

        <link rel="shortcut icon" type="image/x-icon" href="<?php echo front_asset('images/favicon.ico') ?>" />
        <meta name="keywords" lang="es" content="Inshaka, Música, Comunidad musical, géneros musicales, musica, Colombia, Rock" />
        <meta name="description" lang="es" content="<?php echo $template['title']; ?>" />
        <meta name="date" content="2013" />
        <meta name="author" content="crisdanilo@gmail.com" />
        <meta name="robots" content="All" />

        <link href="<?php echo front_asset('css/style.css') ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo front_asset('css/jquery.jscrollpane.css') ?>" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="<?php echo front_asset('css/colorbox.css') ?>" type="text/css" />
        <link href="<?php echo front_asset('css/dd.css') ?>" rel="stylesheet" type="text/css" />
        <!--<link href="css/calendario.css" rel="stylesheet" type="text/css">
        -->        <link rel="stylesheet" href="<?php echo front_asset('css/colorbox.css') ?>" type="text/css"/>
        <link rel="stylesheet" href="<?php echo front_asset('css/feature-carousel.css') ?>" charset="utf-8" type="text/css"/>
        <link rel="stylesheet" type="text/css" href="<?php echo front_asset('css/jquery.fancybox.css') ?>" media="screen" />
        <!--<link rel="stylesheet" href="css/jquery-ui.css" /> -->

        <link rel="stylesheet" href="<?php echo front_asset('css/jquery-ui/jquery-ui-1.9.1.custom.css') ?>" type="text/css"/>

        <link rel="stylesheet" href="<?php echo front_asset('css/inshaka.css') ?>" type="text/css"/>
        <link rel="stylesheet" href="<?php echo front_asset('css/tabs.css') ?>" type="text/css"/>
        <link href="<?php echo front_asset('css/demotable.css') ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo front_asset('css/demopage.css') ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo front_asset('css/tooltipster.css') ?>" rel="stylesheet" type="text/css" />

        <!-- Modernizr -->
        <script src="<?php echo global_asset('js/modernizr-2.6.1-custom.js') ?>"></script>

        <!-- Plupload CSS -->
        <link rel="stylesheet" href="<?php echo global_asset('plupload/js/jquery.ui.plupload/css/jquery.ui.plupload.css') ?>"  type="text/css"/>

<!--        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="<?php echo global_asset('js/jquery.js') ?>"><\/script>')</script>
        <script src="http://code.jquery.com/ui/1.9.1/jquery-ui.js"></script>
        <script>window.jQuery.ui || document.write('<script src="<?php echo global_asset('js/jquery.ui.js') ?>"><\/script>')</script>-->

        <script src="<?php echo global_asset('js/jquery.js') ?>"></script>
        <script src="<?php echo global_asset('js/jquery.ui.js') ?>"></script>


        <script type="text/javascript" src="<?php echo base_url('assets/js/banner.js') ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('assets/js/menu.js') ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('assets/js/slides.min.jquery.js') ?>"></script>

        <script type="text/javascript" src="<?php echo base_url('assets/js/plugin.scrollbar.js') ?>"></script>
        <script src="<?php echo base_url('assets/js/jquery.jscrollpane.js') ?>"></script>
        <script src="<?php echo base_url('assets/js/jquery.mousewheel.js') ?>"></script>
        <script src="<?php echo base_url('assets/js/jquery.colorbox.js') ?>"></script>
        <script src="<?php echo base_url('assets/js/jquery.dd.js') ?>"></script>

        <script src="<?php echo base_url('assets/js/jquery.si.js') ?>" type="text/javascript"></script>
        <script type="text/javascript">document.documentElement.className += "js";</script>
        <script type="text/javascript" src="<?php echo base_url('assets/js/jquery.tabs.js') ?>"></script>
        <script src="<?php echo base_url('assets/js/jquery.featureCarousel.js') ?>" type="text/javascript" charset="utf-8"></script>
        <script type="text/javascript" src="<?php echo base_url('assets/js/jquery.mousewheel-3.0.6.pack.js') ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('assets/js/jquery.fancybox.js') ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('assets/js/timepicker.js') ?>"></script>
        <script src="<?php echo base_url('assets/js/jquery.dataTables.js') ?>"></script>
        <script src="<?php echo base_url('assets/js/acordeon.js') ?>"></script>
        <script type='text/javascript' src="<?php echo base_url('assets/js/jquery.scrollto.js') ?>"></script>
        <script type='text/javascript' src="<?php echo base_url('assets/js/jquery.nav.js') ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('assets/js/jquery.carouFredSel.js') ?>"></script>
        <script type="text/javascript" src="js/jquery.tooltipster.min.js"></script>
        
<!--        <script src="http://bp.yahooapis.com/2.4.21/browserplus-min.js"></script>-->

        <script src="<?php echo global_asset('plupload/js/plupload.full.js') ?>"></script>
        <script src="<?php echo global_asset('plupload/js/jquery.ui.plupload/jquery.ui.plupload.js') ?>"></script>

        <!-- Datepicker en espaÃ±ol -->
        <script src="<?php echo global_asset('js/jquery.ui.datepicker-es.js') ?>"></script>
        
       

        <script>
            $(function() {
                $(".tabs").accessibleTabs({
                    tabhead: 'h2',
                    fx: "fadeIn"
                });
                $('#slides').slides({
                    preload: true,
                    preloadImage: 'assets/images/loading.gif',
                    play: 5000,
                    pause: 4000,
                    hoverPause: true
                });
            });
                
        function disparador(elemento){
          var next_help = elemento.data('next-help');
          $(next_help).trigger('click');
        }
        
        </script>

        <script type="text/javascript">
            $(document).ready(function() {
               
                $('.help-inshaka').tooltipster({
                  theme: '.theme-help',
                  arrow: true,
                  animation: 'slide',
                  arrowColor: '#FFF',
                  position: 'bottom-right',
                  interactive : true,
                  trigger: 'click',
                  functionBefore : function(origin, continueTooltip){
                    var ancho_ventana = $(window).width();
                    var alto_ventana = $(document).height();
                    $('#capa-help').css({
                      'width' : ancho_ventana,
                      'height' : alto_ventana
                    });
                    $("#capa-help").fadeIn("slow");
                    continueTooltip();
                  },
                  functionAfter : function(){
                    $("#capa-help").fadeIn("slow");
                    $("#capa-help").fadeOut("slow");
                  }
                });
                
                $("#publicidad").carouFredSel({
                  circular: true,
                  infinite: true,
                  auto    : false,
                  prev    : {	
                    button  : "#publicidad_prev",
                    key     : "left"
                  },
                  next    : { 
                    button  : "#publicidad_next",
                    key     : "right"
                  }
                });
                $('#basic_example_1').datetimepicker();

                $('#scroll1').jScrollPane({
                    autoReinitialise: true
                });

                $(function() {
                    $('#scroll2').jScrollPane();
                });
                $(function() {
                    $('#scroll3').jScrollPane();
                });
                $('#scroll4').jScrollPane({
                    autoReinitialise: true
                });
                $('#mis_bandas').jScrollPane();
                $(function() {
                    $('#scroll9').jScrollPane();
                });

                $('input').attr('checked', false);



                $(".comboBox1").msDropDown().data("dd");

                $('.date-picker').datepicker({
                    dateFormat: "yy-mm-dd",
                    changeMonth: true,
                    changeYear: true,
                    yearRange: "1900:2012",
                    showAnim: "drop",
                    showOn: "button",
                    buttonImage: <?php echo json_encode(front_asset("imagenes/picker-date.jpg")) ?>,
                    buttonImageOnly: true,
                    showOtherMonths: true,
                    selectOtherMonths: true
                });

            });
        </script>

        <script>var globals = <?php echo json_encode(array('site_url' => site_url(), 'current_profile' => !empty($urls->current_profile) ? $urls->current_profile : null)) ?>;</script>
        <script>
          (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
          (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
          m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
          })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

          ga('create', 'UA-42572933-1', 'inshaka.com');
          ga('send', 'pageview');

        </script>
    <style>
            #capa-help{
            background-color: rgba(0,0,0, 0.6);
            z-index: 9999;
            position: absolute;
            display: none;
    }
    </style>
    </head>

    <body>
      <div id="capa-help"></div>
        <?php echo $template['partials']['header'], $template['partials']['banner'], $template['partials']['header-perfil'] ?>

        <div role="main">
          
            <?php echo $template['body'] ?>
        </div>

        <div class="clr"></div>
        <?php echo $template['partials']['footer'] ?>

        <div id="fb-root"></div>
        <script>(function(d, s, id) {
          var js, fjs = d.getElementsByTagName(s)[0];
          if (d.getElementById(id)) return;
          js = d.createElement(s); js.id = id;
          js.src = "//connect.facebook.net/es_ES/all.js#xfbml=1";
          fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));</script>


        <script defer src="<?php echo global_asset('js/jquery.bbq.js') ?>"></script>

        <script>
        (function($) {
            $('.tabs-ui').tabs();

            /* GalerÃ­a de imagenes en dialogo con FancyBox */
            var fancy_gallery = $("a[rel=fancy-gallery]");

            fancy_gallery.fancybox({
                transitionIn: 'elastic',
                transitionOut: 'elastic',
                overlayShow: true,
                cyclic: true
            });

            $("a[rel=fancy-gallery-iframe]").fancybox({
                transitionIn: 'elastic',
                transitionOut: 'elastic',
                type: 'iframe'
            });

            /* Cerrar alertas */
            $(document).on('click', '.alert .close', function(e){
                $(this).parent().slideUp(function(){
                    return $(this).remove();
                });
                return e.preventDefault();
            });
        })(jQuery);
        </script>
    </body>
</html>