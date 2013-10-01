$(document).ready(function() {


    $('.perfil-cont-iz').hover(
        function() {
            $(".lapiz2", this).css({
                "display": 'block'
            })
            $(".lapiz3", this).css({
                "display": 'block'
            })
            $(".lapiz4", this).css({
                "display": 'block'
            })
        },
        function() {
            $(".lapiz2", this).css({
                "display": 'none'
            })
            $(".lapiz3", this).css({
                "display": 'none'
            })
            $(".lapiz4", this).css({
                "display": 'none'
            })
        }
        );

    $('.perfil-cont-de').hover(
        function() {
            $(".lapiz1", this).css({
                "display": 'block'
            })
        },
        function() {
            $(".lapiz1", this).css({
                "display": 'none'
            })
        }
        );

    /*Agregar cancion en perfil*/
    var agrCancionIsOpen = false
    $('.agrCancion').click(function() {
        if (agrCancionIsOpen == false) {
            $('#agrCancion').css('display', 'block');
            agrCancionIsOpen = true
        } else {
            $('#agrCancion').css('display', 'none');
            agrCancionIsOpen = false
        }
    })



    var carousel = $("#carousel").featureCarousel({

        smallFeatureWidth: 150,
        smallFeatureHeight: 150,
        smallFeatureOffset: 20,
        autoPlay: 0,
        leftButtonTag: '#carousel-left',
        rightButtonTag: '#carousel-right'
    });



    $("#but_prev").click(function() {
        carousel.prev();
    });
    $("#but_pause").click(function() {
        carousel.pause();
    });
    $("#but_start").click(function() {
        carousel.start();
    });
    $("#but_next").click(function() {
        carousel.next();
    });
    
    $(function() {
        $('[data-autocomplete="cities"]').autocomplete({
            source: function(request, response) {
                $.ajax({
                    url: "http://ws.geonames.org/searchJSON",
                    dataType: "jsonp",
                    data: {
                        featureClass: "P",
                        style: "full",
                        maxRows: 12,
                        name_startsWith: request.term
                    },
                    success: function(data) {
                        response($.map(data.geonames, function(item) {
                            return {
                                label: item.name + (item.adminName1 ? ", " + item.adminName1 : "") + ", " + item.countryName,
                                value: item.name
                            }
                        }));
                    }
                });
            },
            minLength: 2,
            select: function(event, ui) {
                log(ui.item ?
                    "Selected: " + ui.item.label :
                    "Nothing selected, input was " + this.value);
            },
            open: function() {
                $(this).removeClass("ui-corner-all").addClass("ui-corner-top");
            },
            close: function() {
                $(this).removeClass("ui-corner-top").addClass("ui-corner-all");
            }
        });
    });
    
    // Posts del usuario
    $("#posts-list").load($("#posts-list").data('load-url'));
    // Enviar mensaje directo al usuario
    $("#direct-message").on("submit", function(e){
        e.preventDefault();
        var url = $(this).attr("action");
        var datos = {
          user_id : $(this).data("id"),
          message : $("#message").val() 
        };
        
        $.ajax({
          type      : "post",
          url       : url,
          dataType  : "json",
          data      : datos,
          success   : function(json){
            if(json.ok){
              $("#success-message").append($("<div>", {
                  class   : "alert alert-success fade in"
                }).append($("<a>",{
                    class   : "close",
                    href    : "#"
                  }).html("x")
                ).html("Tu mensaje se ha enviado satisfactoriamente!.")
              );
            }
          },
          error   : function(){
            alert("Se ha producido un error. Inténtelo más tarde!.");
          }
        });        
      });
    // Formularios modales (Contactar y Rating)
    $('.form-m').fancybox();
    // Función necesario para el autocomplete de ciudades
    function log(message) {
      $("<div>").text(message).prependTo("#log");
      $("#log").scrollTop(0);
    }
    // Autocomplete de ciudades
    $("#city").autocomplete({
      source: function(request, response) {
        $.ajax({
          url: "http://ws.geonames.org/searchJSON",
          dataType: "jsonp",
          data: {
            featureClass: "P",
            style: "full",
            maxRows: 12,
            name_startsWith: request.term
          },
          success: function(data) {
            response($.map(data.geonames, function(item) {
              return {
                label: item.name + (item.adminName1 ? ", " + item.adminName1 : "") + ", " + item.countryName,
                value: item.name
              };
            }));
          }
        });
      },
      minLength: 2,
      select: function(event, ui) {
        log(ui.item ?
          "Selected: " + ui.item.label :
          "Nothing selected, input was " + this.value);
      },
      open: function() {
        $(this).removeClass("ui-corner-all").addClass("ui-corner-top");
      },
      close: function() {
        $(this).removeClass("ui-corner-top").addClass("ui-corner-all");
      }
    });
    // Hover para el botón de seguiendo --- Cambia texto a dejar de seguir ---    
    $("#siguiendo-user").hover(function(){
      $(this).fadeIn(500, function(){
        $(this).css('margin', '-3px -9px 0px 0px');
        $(this).text('Dejar de seguir');
      });
    }, function(){
      $(this).fadeOut(100, function(){
        $(this).css('margin', '-3px 20px 0px 0px');
        $(this).text('Siguiendo');
      });
      $(this).fadeIn(500);
    });
    // Hover para el botón de cancelar solitud de seguir
    $("#cancelar_solicitud").hover(function(){
      $(this).fadeIn(500, function(){
        $(this).text('Cancelar');
      });
    },function(){
      $(this).fadeOut(100, function(){
        $(this).text('Enviada');
      });
      $(this).fadeIn(500);
    });
    // Trigger para mostrar el primer tooltip en el perfil
    $('#first-help').trigger('click');
    // Ajax para enviar un comentario
    $("form#create-comment-form").on("submit", function(){
      var datos = $(this).serialize();
      $.ajax({
        type  : "post",
        url   : "'" + $(this).attr("action") + "'",
        data  : datos,
        beforeSend  : function(){
          $("#btn-send-comment").val("Enviando...").css("opacity", "0.6");
        },
        success : function(){
          $.fancybox.close();
        },
        complete  : function(){
          $("#btn-send-comment").val("Enviar").css("opacity", "1");
          $.fancybox.close();
        },
        error   : function(){
          $.fancybox.close();
          $("#btn-send-comment").val("Enviar").css("opacity", "1");
        }
      });
    });
    // Sliders para el formulario de rating
    $(".slider").slider({
      range: "max",
      min: 0,
      max: 10,
      value: 0,
      slide: function(event, ui) {
        var parent = $(this).parent();
        return parent.find('input').val(ui.value).end().find('.rating-dato').text(ui.value);
      }
    });
    // Slider para integrantes-banda y/o banda-músico
    var numThumbs = $(".band-int div.banda").size();
    var thumbsWidth = $(".band-int div.banda").width();
    var marg_tot = numThumbs * 130;
    var widthBox = thumbsWidth * 2 + marg_tot;
    $(".band-int").width(widthBox);
    $('#scroll-band-int').jScrollPane();

});
// Función para hacer favorito un proveedor
function addfavorite(id) {
  $("#anuncio").dialog({
    resizable: false,
    modal: true,
    show : 'drop',
    hide : 'drop',
    width: '400px',
    buttons: {
      "Aceptar": function() { 
        $.getJSON('<?= site_url("directorios/directorios/add_favorite_provider") ?>', {
          id : id
        }, function() {
          location.reload();
        });
        return $(this).dialog('close');
      },
      Cancel: function() {
        $( this ).dialog("close");
      }
    }
  });
}
// Función para seguir un usuario y/o proveedor
function follow(id, elemento1, elemento2, elemento3, url){
  $(elemento1).dialog({
    resizable : false,
    modal     : true,
    show      : 'drop',
    hide      : 'drop',
    width     : '400px',
    buttons   : {
      "Aceptar" : function(){
        var datos = {
          id : id
        };
        $.ajax({
          type  : "get",
          url   : url,
          data  : datos,
          success : function(){
            $(elemento2).fadeOut("slow");
            $(elemento3).fadeIn("slow");
          },
          error   : function(){
            alert("Se ha producido un error. Inténtelo más tarde");
          }
        });
        $(this).dialog('close');
      },
      Cancel  : function(){
        $(this).dialog('close');
      }
    }
  });
} 
// Función para boton de siguiente en los tooltips
function disparador(elemento){
 var next_help = elemento.data('next-help');
 $(next_help).trigger('click');

}
// Funcion para cerrar los tooltips
function closetooltip(elemento){
  $(elemento).tooltipster('hide');
  console.log(elemento);
}
// Compartir posts
function comment_share(abrir, cerrar){
    if($(cerrar).show){
      $(cerrar).slideUp("slow");
    }
    $(abrir).slideToggle("slow");
  }
// Guardar comentarios
function save_comment(id, comentario, ajax, load, url){
  $(ajax).show();
  var datos = {
    id: id,
    comentario: $(comentario).val()
  };
  $.ajax({
    url: url,
    type: "post",
    data: datos,
    success: function(){      
      $(load).load($(load).attr('data-load-url'));            
    },
    complete: function(){
      $(comentario).val('');
      $(ajax).hide();
    },
    error: function(){
      alert("Se ha producido un error. Inténtelo más tarde.");
    }
  });
}
  