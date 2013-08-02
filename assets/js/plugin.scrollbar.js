/************ Plugin JQuery ************* */
/* R�alis� par Creamama - Matthieu L�orat */
/* ************ juillet 2010 ************ */ 
/* ******** http://www.creamama.fr ****** */

/********** NECESSITE ************/
/* ******************************** 
jquery-1.4.2.min.js
ui.core-1.7.2.js
ui.draggable-1.7.2.js
jquery.mousewheel.min.js
******************************** */

(function($) {
	
	$.fn.scrollbar = function(params) {
		alt_scroll = params;
		// Fusionner les param�tres par d�faut et ceux de l'utilisateur
		params = $.extend( {
			taille_englobe: alt_scroll,			//Taille de l'espace visible - /!\ Doit �tre un nombre ou 'auto'
			taille_scrollbar: "auto",		//Taille de la scrollbar - /!\ Doit �tre un nombre ou 'auto'
			taille_bouton: 50,				//Taille du bouton - /!\ Doit �tre un nombre
			pas:75,							//Pas du scroll molette - /!\ Doit �tre un nombre ou 'auto'
			molette: true,					//D�tection du scroll molette - /!\ true ou false
			drag: true,						//Bouton de la scrollbar d�placable � la souris - /!\ true ou false
			debug: true,					//Afficher la console de debug - /!\ true ou false
			style: 'basic',					//Choix des styles - /!\ Par d�fault, il n'y a que le style 'basic'
			position:'droite',				//Position de la scrollBar - /!\ 'gauche' ou 'droite'
			alignement_scrollbar:'haut',	//Alignement de la scrollBar. Utilis� uniquement si elle � une taille inf�rieur � celle de taille_englobe
			orientation: 'vertical',		//Orientation du contenu, 'vertical' ou 'horizontal'
			marge_scroll_contenu: 5,		//Marge entre la scrollBar et le contenu - /!\ Doit �tre un nombre
			largeur_scrollbar:5				//Largeur de la scrollbar
		}, params);
		
		return this.each(function() {
			var $$ = $(this);
			var taille_englobe_init = params.taille_englobe;
			var taille_scrollbar_init = params.taille_scrollbar;
			
			//Fonction de calcul de position top maximum du contenu
			function calcul_contenu_top_max(){
				return  params.taille_englobe - taille_contenu ;
			}
			
			//Fonction de calcul de position top maximum du bouton
			function calcul_bouton_top_max(){
				return params.taille_scrollbar - params.taille_bouton
			}
			
			//Fonction de calcul du d�placement du bouton
			function deplacement_bouton(info_top_contenu){
				//On calcul la nouvelle position du bouton
				var depl_bouton = (info_top_contenu/calcul_contenu_top_max())*(calcul_bouton_top_max());
				//On v�rifie que ca d�borde pas en haut
				if(depl_bouton < 0){depl_bouton = 0;}
				//On v�rifie que ca d�borde pas en bas
				if(depl_bouton > calcul_bouton_top_max()){depl_bouton = calcul_bouton_top_max();}
				$('#bouton').css({'top':depl_bouton+"px"});
			}
			
			function deplacement_contenu(info_top_bouton){
				//On calcul la nouvelle position du contenu
				var depl_contenu = (info_top_bouton/calcul_bouton_top_max())*(calcul_contenu_top_max());
				//On v�rifie que ca d�borde pas en haut
				if (depl_contenu > 0){depl_contenu = 0}
				//On v�rifie que ca d�borde pas en bas
				if (depl_contenu < calcul_contenu_top_max()){depl_contenu = calcul_contenu_top_max()}
				$('#englobe').css({'top':depl_contenu+"px"});
			}
			
			function styler_scrollbar(position,orientation){
				var type_marge_position;
				var marge_position;
				var marge_orientation;
				switch (position){
					case 'droite':
						$('#englobe').after('<div id="scrollbar"><div id="bouton">&nbsp;</div></div>');
						$('#scrollbar').css({'margin-left':params.marge_scroll_contenu+'px'});
					break;
					case 'gauche':
						$('#englobe').before('<div id="scrollbar"><div id="bouton">&nbsp;</div></div>');
						$('#scrollbar').css({'margin-right':params.marge_scroll_contenu+'px'});
					break;
				}
				switch (orientation){
					case 'haut':
						$('#scrollbar').css({'margin-top':'0px'});
					break;
					case 'centre':
						var marge = (params.taille_englobe -params.taille_scrollbar)/2;
						$('#scrollbar').css({'margin-top':marge+'px'});
					break;
					case 'bas':
						var marge = params.taille_englobe -params.taille_scrollbar;
						$('#scrollbar').css({'margin-top':marge+'px'});
					break;
				}
			}
			var padTop=0;
			var padBot=0;
			//Hauteur du contenu
            var taille_contenu = $$.height()+40;
			
			function calcul_hauteur_auto(){
				if(params.taille_englobe == "auto"){
					padTop = $('#contenu').css('padding-top');
					padTop = padTop.substring(0,padTop.length-2);
					
					padBot = $('#contenu').css('padding-bottom');
					padBot = padBot.substring(0,padBot.length-2);
					
					params.taille_englobe = $(window).height()-40-padBot-padTop;
					
				}else{return false}
			}
			calcul_hauteur_auto();
			//La hauteur de l'espace visible est la hauteur de la fenetre du navigateur si taille_englobe="auto"
			
			
			function controle_donnee(){
				calcul_hauteur_auto();
				//La taille du contenu doit �tre sup�rieur � celle de l'espace visible (taille_englobe)
				if(taille_contenu > params.taille_englobe){
					//La hauteur de la scroll bar est �gale � la hauteur de "englobe" si hauteur_srollbar="auto"
					if(params.taille_scrollbar == "auto"){params.taille_scrollbar = params.taille_englobe;}
					//La taille de la scrollbar doit �tre inf�rieur ou �gale � la taille de taille_englobe
					if(params.taille_scrollbar > params.taille_englobe){						
						params.taille_scrollbar = params.taille_englobe;	
					}
					return true;
				}else{return false;}		
			}
			
			//Si la hauteur du contenu est sup�rieur � la hauteur de l'espace visible
			if(controle_donnee()){
				//Au redimensionnement de la fenetre
				//N'est concern� par cette fonction que les �l�ments en 'auto'
				window.onresize = function() {
					if(taille_englobe_init == "auto"){
						params.taille_englobe = $(window).height()-40-padBot-padTop;
						$$.css({'height':params.taille_englobe+'px'});
						if(taille_scrollbar_init == "auto"){
							params.taille_scrollbar = params.taille_englobe;
							$('#scrollbar').css({'height':params.taille_scrollbar+'px'});
							deplacement_bouton($("#englobe").css('top').substring(0,$("#englobe").css('top').length-2));
							if(params.debug){affiche_position();}
						}
					}	
				};
				
				//calcul des largeurs
				var temp = $$.width();
				$$.css({'width':params.marge_scroll_contenu+params.largeur_scrollbar+temp+'px'});
				//On construit une div autour du contenu, mais � l'int�rieur de la div
				$$.wrapInner('<div id="englobe"></div>');
				$$.css({'height':params.taille_englobe+'px','overflow':'hidden','position':'relative'});
				$("#englobe").css({'top':0+'px','float':'left','position':'relative','width':temp+'px'});	
				
				//On construit la scrollBar
				styler_scrollbar(params.position,params.alignement_scrollbar);
				
				$$.append('<div class="clear"></div>');
				$(".clear").css({'clear':'both'});
				
				
				switch (params.style) {
					case 'basic':
						//Style de la scrollBar
						$('#scrollbar').css({'width':params.largeur_scrollbar+'px',
											'float':'left',
											'height':params.taille_scrollbar+'px',
											'background':'#ebd9b3'		
						});
				
						//Style du bouton de la scrollBar
						$("#bouton").css({'width':params.largeur_scrollbar+'px',
										'height':params.taille_bouton+'px',
										'background':'#cda042',
										'top':0+'px',
										'cursor':'pointer'
										});
					break;
				}

				
				
				//Si le drag du bouton est activ�(true)
				if(params.drag){
					$("#bouton").draggable({ 
						containment: 'parent',
						axis: 'y',
						start:function(){},
						drag: function(event, ui) {
							//ui.position.top est la valeur renvoy� par le plugin JQuery UI
							deplacement_contenu(ui.position.top);
							if(params.debug){affiche_position();}
						},
						stop: function(){}
					});
				}
				
				if(params.molette){
					$$.mousewheel(function(event, delta) {
						//On r�cup�re la position du contenu
						var top_contenu = $('#englobe').css('top');
						
						//On enl�ve le 'px' et on le convertit en entier pour pouvoir le manipuler
						top_contenu = parseInt( top_contenu.substring(0,(top_contenu.length-2)) );
						
						//On r�cup�re la position du bouton
						var top_bouton = $('#bouton').css('top');
						//On enl�ve le 'px' et on le convertit en entier pour pouvoir le manipuler
						top_bouton = parseInt( top_bouton.substring(0,(top_bouton.length-2)) );
						
						//Si le delta est positif, c'est � dire que l'on "pousse" la molette
						if (delta > 0) {							
							top_contenu = top_contenu + params.pas;
							//On v�rifie que l'on n'a pas atteint le haut du contenu
							if(top_contenu > 0){top_contenu = 0}
							$('#englobe').css({'top':top_contenu+"px"});
						//Si le delta est n�gatif, c'est � dire que l'on "ram�ne" la molette
						}else if (delta < 0){							
							top_contenu = top_contenu - params.pas;
							//On v�rifie que l'on n'a pas atteint le bas du contenu
							if(top_contenu < calcul_contenu_top_max()){top_contenu = calcul_contenu_top_max()}
							$('#englobe').css({'top':top_contenu+"px"});							
						}
						
						//calcul de d�placement du bouton					
						deplacement_bouton(top_contenu);
						
						if(params.debug){affiche_position();}
					});
				}
				
				//Affiche la console de debug
				if(params.debug){
					$$.after('<div id="debug"></div>');
					$('#debug').css({'position':'fixed','top':'200px','right':'50px', 'border':'2px solid #EF9700','background':'#FFDC9F','padding':'0px'})				
					.append('<p id="hauteurcontenu">Hauteur du contenu:'+taille_contenu+'</p>')
					.append('<p id="hauteurenglobe">Hauteur de l\'espace visible:'+params.taille_englobe+'</p>')
					.append('<p id="hauteurscrollbar">Hauteur du srcoll:'+params.taille_scrollbar+'</p>')
					.append('<p id="hauteurbouton">Hauteur du bouton:'+params.taille_bouton+'</p>')
					.append('<p id="topcontenu">Top du contenu:'+$$.css('top')+'</p>')
					.append('<p id="topbouton">Top du bouton:'+$('#bouton').css('top')+'</p>')
					.append('<p id="topmaxbouton">Top max du bouton:'+calcul_contenu_top_max()+'</p>')
					.append('<p id="topmaxcontenu">Top max du contenu:'+calcul_bouton_top_max()+'</p>')
					.children().css({'margin':'0','padding':'5px'});
					
					//Fonction de mise � jour des infos de la console de debug
					function affiche_position(){
						$("#hauteurcontenu").html('Hauteur du contenu:'+taille_contenu);
						$("#hauteurenglobe").html('Hauteur de l\'espace visible:'+params.taille_englobe);
						$("#hauteurscrollbar").html('Hauteur du srcoll:'+params.taille_scrollbar);
						$("#hauteurbouton").html('Hauteur du bouton:'+params.taille_bouton);
						$("#topcontenu").html('Top du contenu:'+$('#englobe').css('top'));
						$("#topbouton").html('Top du bouton:'+$('#bouton').css('top'));
						$("#topmaxbouton").html('Top max du bouton:'+calcul_contenu_top_max());
						$("#topmaxcontenu").html('Top max du contenu:'+calcul_bouton_top_max());
					}
				}	
			}else{
			}
        });
	}
})(jQuery);


(function($) {
	
	$.fn.scrollbar2 = function(params) {
		alt_scroll = params;
		// Fusionner les param�tres par d�faut et ceux de l'utilisateur
		params = $.extend( {
			taille_englobe: alt_scroll,			//Taille de l'espace visible - /!\ Doit �tre un nombre ou 'auto'
			taille_scrollbar: "auto",		//Taille de la scrollbar - /!\ Doit �tre un nombre ou 'auto'
			taille_bouton: 50,				//Taille du bouton - /!\ Doit �tre un nombre
			pas:75,							//Pas du scroll molette - /!\ Doit �tre un nombre ou 'auto'
			molette: true,					//D�tection du scroll molette - /!\ true ou false
			drag: true,						//Bouton de la scrollbar d�placable � la souris - /!\ true ou false
			debug: true,					//Afficher la console de debug - /!\ true ou false
			style: 'basic',					//Choix des styles - /!\ Par d�fault, il n'y a que le style 'basic'
			position:'droite',				//Position de la scrollBar - /!\ 'gauche' ou 'droite'
			alignement_scrollbar:'haut',	//Alignement de la scrollBar. Utilis� uniquement si elle � une taille inf�rieur � celle de taille_englobe
			orientation: 'vertical',		//Orientation du contenu, 'vertical' ou 'horizontal'
			marge_scroll_contenu: 5,		//Marge entre la scrollBar et le contenu - /!\ Doit �tre un nombre
			largeur_scrollbar:5				//Largeur de la scrollbar
		}, params);
		
		return this.each(function() {
			var $$ = $(this);
			var taille_englobe_init = params.taille_englobe;
			var taille_scrollbar_init = params.taille_scrollbar;
			
			//Fonction de calcul de position top maximum du contenu
			function calcul_contenu_top_max(){
				return  params.taille_englobe - taille_contenu ;
			}
			
			//Fonction de calcul de position top maximum du bouton
			function calcul_bouton_top_max(){
				return params.taille_scrollbar - params.taille_bouton
			}
			
			//Fonction de calcul du d�placement du bouton
			function deplacement_bouton(info_top_contenu){
				//On calcul la nouvelle position du bouton
				var depl_bouton = (info_top_contenu/calcul_contenu_top_max())*(calcul_bouton_top_max());
				//On v�rifie que ca d�borde pas en haut
				if(depl_bouton < 0){depl_bouton = 0;}
				//On v�rifie que ca d�borde pas en bas
				if(depl_bouton > calcul_bouton_top_max()){depl_bouton = calcul_bouton_top_max();}
				$('#bouton2').css({'top':depl_bouton+"px"});
			}
			
			function deplacement_contenu(info_top_bouton){
				//On calcul la nouvelle position du contenu
				var depl_contenu = (info_top_bouton/calcul_bouton_top_max())*(calcul_contenu_top_max());
				//On v�rifie que ca d�borde pas en haut
				if (depl_contenu > 0){depl_contenu = 0}
				//On v�rifie que ca d�borde pas en bas
				if (depl_contenu < calcul_contenu_top_max()){depl_contenu = calcul_contenu_top_max()}
				$('#englobe2').css({'top':depl_contenu+"px"});
			}
			
			function styler_scrollbar(position,orientation){
				var type_marge_position;
				var marge_position;
				var marge_orientation;
				switch (position){
					case 'droite':
						$('#englobe2').after('<div id="scrollbar2"><div id="bouton2">&nbsp;</div></div>');
						$('#scrollbar2').css({'margin-left':params.marge_scroll_contenu+'px'});
					break;
					case 'gauche':
						$('#englobe2').before('<div id="scrollbar2"><div id="bouton2">&nbsp;</div></div>');
						$('#scrollbar2').css({'margin-right':params.marge_scroll_contenu+'px'});
					break;
				}
				switch (orientation){
					case 'haut':
						$('#scrollbar2').css({'margin-top':'0px'});
					break;
					case 'centre':
						var marge = (params.taille_englobe -params.taille_scrollbar)/2;
						$('#scrollbar2').css({'margin-top':marge+'px'});
					break;
					case 'bas':
						var marge = params.taille_englobe -params.taille_scrollbar;
						$('#scrollbar2').css({'margin-top':marge+'px'});
					break;
				}
			}
			var padTop=0;
			var padBot=0;
			//Hauteur du contenu
            var taille_contenu = $$.height()+40;
			
			function calcul_hauteur_auto(){
				if(params.taille_englobe == "auto"){
					padTop = $('#contenu').css('padding-top');
					padTop = padTop.substring(0,padTop.length-2);
					
					padBot = $('#contenu').css('padding-bottom');
					padBot = padBot.substring(0,padBot.length-2);
					
					params.taille_englobe = $(window).height()-40-padBot-padTop;
					
				}else{return false}
			}
			calcul_hauteur_auto();
			//La hauteur de l'espace visible est la hauteur de la fenetre du navigateur si taille_englobe="auto"
			
			
			function controle_donnee(){
				calcul_hauteur_auto();
				//La taille du contenu doit �tre sup�rieur � celle de l'espace visible (taille_englobe)
				if(taille_contenu > params.taille_englobe){
					//La hauteur de la scroll bar est �gale � la hauteur de "englobe" si hauteur_srollbar="auto"
					if(params.taille_scrollbar == "auto"){params.taille_scrollbar = params.taille_englobe;}
					//La taille de la scrollbar doit �tre inf�rieur ou �gale � la taille de taille_englobe
					if(params.taille_scrollbar > params.taille_englobe){						
						params.taille_scrollbar = params.taille_englobe;	
					}
					return true;
				}else{return false;}		
			}
			
			//Si la hauteur du contenu est sup�rieur � la hauteur de l'espace visible
			if(controle_donnee()){
				//Au redimensionnement de la fenetre
				//N'est concern� par cette fonction que les �l�ments en 'auto'
				window.onresize = function() {
					if(taille_englobe_init == "auto"){
						params.taille_englobe = $(window).height()-40-padBot-padTop;
						$$.css({'height':params.taille_englobe+'px'});
						if(taille_scrollbar_init == "auto"){
							params.taille_scrollbar = params.taille_englobe;
							$('#scrollbar2').css({'height':params.taille_scrollbar+'px'});
							deplacement_bouton($("#englobe2").css('top').substring(0,$("#englobe2").css('top').length-2));
							if(params.debug){affiche_position();}
						}
					}	
				};
				
				//calcul des largeurs
				var temp = $$.width();
				$$.css({'width':params.marge_scroll_contenu+params.largeur_scrollbar+temp+'px'});
				//On construit une div autour du contenu, mais � l'int�rieur de la div
				$$.wrapInner('<div id="englobe2"></div>');
				$$.css({'height':params.taille_englobe+'px','overflow':'hidden','position':'relative'});
				$("#englobe2").css({'top':0+'px','float':'left','position':'relative','width':temp+'px'});	
				
				//On construit la scrollBar
				styler_scrollbar(params.position,params.alignement_scrollbar);
				
				$$.append('<div class="clear"></div>');
				$(".clear").css({'clear':'both'});
				
				
				switch (params.style) {
					case 'basic':
						//Style de la scrollBar
						$('#scrollbar2').css({'width':params.largeur_scrollbar+'px',
											'float':'left',
											'height':params.taille_scrollbar+'px',
											'background':'#ebd9b3'		
						});
				
						//Style du bouton de la scrollBar
						$("#bouton2").css({'width':params.largeur_scrollbar+'px',
										'height':params.taille_bouton+'px',
										'background':'#cda042',
										'top':0+'px',
										'cursor':'pointer'
										});
					break;
				}

				
				
				//Si le drag du bouton est activ�(true)
				if(params.drag){
					$("#bouton2").draggable({ 
						containment: 'parent',
						axis: 'y',
						start:function(){},
						drag: function(event, ui) {
							//ui.position.top est la valeur renvoy� par le plugin JQuery UI
							deplacement_contenu(ui.position.top);
							if(params.debug){affiche_position();}
						},
						stop: function(){}
					});
				}
				
				if(params.molette){
					$$.mousewheel(function(event, delta) {
						//On r�cup�re la position du contenu
						var top_contenu = $('#englobe2').css('top');
						
						//On enl�ve le 'px' et on le convertit en entier pour pouvoir le manipuler
						top_contenu = parseInt( top_contenu.substring(0,(top_contenu.length-2)) );
						
						//On r�cup�re la position du bouton
						var top_bouton = $('#bouton2').css('top');
						//On enl�ve le 'px' et on le convertit en entier pour pouvoir le manipuler
						top_bouton = parseInt( top_bouton.substring(0,(top_bouton.length-2)) );
						
						//Si le delta est positif, c'est � dire que l'on "pousse" la molette
						if (delta > 0) {							
							top_contenu = top_contenu + params.pas;
							//On v�rifie que l'on n'a pas atteint le haut du contenu
							if(top_contenu > 0){top_contenu = 0}
							$('#englobe2').css({'top':top_contenu+"px"});
						//Si le delta est n�gatif, c'est � dire que l'on "ram�ne" la molette
						}else if (delta < 0){							
							top_contenu = top_contenu - params.pas;
							//On v�rifie que l'on n'a pas atteint le bas du contenu
							if(top_contenu < calcul_contenu_top_max()){top_contenu = calcul_contenu_top_max()}
							$('#englobe2').css({'top':top_contenu+"px"});							
						}
						
						//calcul de d�placement du bouton					
						deplacement_bouton(top_contenu);
						
						if(params.debug){affiche_position();}
					});
				}
				
				//Affiche la console de debug
				if(params.debug){
					$$.after('<div id="debug"></div>');
					$('#debug').css({'position':'fixed','top':'200px','right':'50px', 'border':'2px solid #EF9700','background':'#FFDC9F','padding':'0px'})				
					.append('<p id="hauteurcontenu">Hauteur du contenu:'+taille_contenu+'</p>')
					.append('<p id="hauteurenglobe">Hauteur de l\'espace visible:'+params.taille_englobe+'</p>')
					.append('<p id="hauteurscrollbar">Hauteur du srcoll:'+params.taille_scrollbar+'</p>')
					.append('<p id="hauteurbouton">Hauteur du bouton:'+params.taille_bouton+'</p>')
					.append('<p id="topcontenu">Top du contenu:'+$$.css('top')+'</p>')
					.append('<p id="topbouton">Top du bouton:'+$('#bouton2').css('top')+'</p>')
					.append('<p id="topmaxbouton">Top max du bouton:'+calcul_contenu_top_max()+'</p>')
					.append('<p id="topmaxcontenu">Top max du contenu:'+calcul_bouton_top_max()+'</p>')
					.children().css({'margin':'0','padding':'5px'});
					
					//Fonction de mise � jour des infos de la console de debug
					function affiche_position(){
						$("#hauteurcontenu").html('Hauteur du contenu:'+taille_contenu);
						$("#hauteurenglobe").html('Hauteur de l\'espace visible:'+params.taille_englobe);
						$("#hauteurscrollbar").html('Hauteur du srcoll:'+params.taille_scrollbar);
						$("#hauteurbouton").html('Hauteur du bouton:'+params.taille_bouton);
						$("#topcontenu").html('Top du contenu:'+$('#englobe2').css('top'));
						$("#topbouton").html('Top du bouton:'+$('#bouton2').css('top'));
						$("#topmaxbouton").html('Top max du bouton:'+calcul_contenu_top_max());
						$("#topmaxcontenu").html('Top max du contenu:'+calcul_bouton_top_max());
					}
				}	
			}else{
				//alert('Pas de scrollbar');
			}
        });
	}
})(jQuery);


(function($) {
	
	$.fn.scrollbar3 = function(params) {
		alt_scroll = params;
		// Fusionner les param�tres par d�faut et ceux de l'utilisateur
		params = $.extend( {
			taille_englobe: alt_scroll,			//Taille de l'espace visible - /!\ Doit �tre un nombre ou 'auto'
			taille_scrollbar: "auto",		//Taille de la scrollbar - /!\ Doit �tre un nombre ou 'auto'
			taille_bouton: 50,				//Taille du bouton - /!\ Doit �tre un nombre
			pas:75,							//Pas du scroll molette - /!\ Doit �tre un nombre ou 'auto'
			molette: true,					//D�tection du scroll molette - /!\ true ou false
			drag: true,						//Bouton de la scrollbar d�placable � la souris - /!\ true ou false
			debug: true,					//Afficher la console de debug - /!\ true ou false
			style: 'basic',					//Choix des styles - /!\ Par d�fault, il n'y a que le style 'basic'
			position:'droite',				//Position de la scrollBar - /!\ 'gauche' ou 'droite'
			alignement_scrollbar:'haut',	//Alignement de la scrollBar. Utilis� uniquement si elle � une taille inf�rieur � celle de taille_englobe
			orientation: 'vertical',		//Orientation du contenu, 'vertical' ou 'horizontal'
			marge_scroll_contenu: 5,		//Marge entre la scrollBar et le contenu - /!\ Doit �tre un nombre
			largeur_scrollbar:5				//Largeur de la scrollbar
		}, params);
		return this.each(function() {
			var $$ = $(this);
			var taille_englobe_init = params.taille_englobe;
			var taille_scrollbar_init = params.taille_scrollbar;
			
			//Fonction de calcul de position top maximum du contenu
			function calcul_contenu_top_max(){
				return  params.taille_englobe - taille_contenu ;
			}
			
			//Fonction de calcul de position top maximum du bouton
			function calcul_bouton_top_max(){
				return params.taille_scrollbar - params.taille_bouton
			}
			
			//Fonction de calcul du d�placement du bouton
			function deplacement_bouton(info_top_contenu){
				//On calcul la nouvelle position du bouton
				var depl_bouton = (info_top_contenu/calcul_contenu_top_max())*(calcul_bouton_top_max());
				//On v�rifie que ca d�borde pas en haut
				if(depl_bouton < 0){depl_bouton = 0;}
				//On v�rifie que ca d�borde pas en bas
				if(depl_bouton > calcul_bouton_top_max()){depl_bouton = calcul_bouton_top_max();}
				$('#bouton3').css({'top':depl_bouton+"px"});
			}
			
			function deplacement_contenu(info_top_bouton){
				//On calcul la nouvelle position du contenu
				var depl_contenu = (info_top_bouton/calcul_bouton_top_max())*(calcul_contenu_top_max());
				//On v�rifie que ca d�borde pas en haut
				if (depl_contenu > 0){depl_contenu = 0}
				//On v�rifie que ca d�borde pas en bas
				if (depl_contenu < calcul_contenu_top_max()){depl_contenu = calcul_contenu_top_max()}
				$('#englobe3').css({'top':depl_contenu+"px"});
			}
			
			function styler_scrollbar(position,orientation){
				var type_marge_position;
				var marge_position;
				var marge_orientation;
				switch (position){
					case 'droite':
						$('#englobe3').after('<div id="scrollbar3"><div id="bouton3">&nbsp;</div></div>');
						$('#scrollbar3').css({'margin-left':params.marge_scroll_contenu+'px'});
					break;
					case 'gauche':
						$('#englobe3').before('<div id="scrollbar3"><div id="bouton3">&nbsp;</div></div>');
						$('#scrollbar3').css({'margin-right':params.marge_scroll_contenu+'px'});
					break;
				}
				switch (orientation){
					case 'haut':
						$('#scrollbar3').css({'margin-top':'0px'});
					break;
					case 'centre':
						var marge = (params.taille_englobe -params.taille_scrollbar)/2;
						$('#scrollbar3').css({'margin-top':marge+'px'});
					break;
					case 'bas':
						var marge = params.taille_englobe -params.taille_scrollbar;
						$('#scrollbar3').css({'margin-top':marge+'px'});
					break;
				}
			}
			var padTop=0;
			var padBot=0;
			//Hauteur du contenu
            var taille_contenu = $$.height()+40;
			
			function calcul_hauteur_auto(){
				if(params.taille_englobe == "auto"){
					padTop = $('#contenu').css('padding-top');
					padTop = padTop.substring(0,padTop.length-2);
					
					padBot = $('#contenu').css('padding-bottom');
					padBot = padBot.substring(0,padBot.length-2);
					
					params.taille_englobe = $(window).height()-40-padBot-padTop;
					
				}else{return false}
			}
			calcul_hauteur_auto();
			//La hauteur de l'espace visible est la hauteur de la fenetre du navigateur si taille_englobe="auto"
			
			
			function controle_donnee(){
				calcul_hauteur_auto();
				//La taille du contenu doit �tre sup�rieur � celle de l'espace visible (taille_englobe)
				if(taille_contenu > params.taille_englobe){
					//La hauteur de la scroll bar est �gale � la hauteur de "englobe" si hauteur_srollbar="auto"
					if(params.taille_scrollbar == "auto"){params.taille_scrollbar = params.taille_englobe;}
					//La taille de la scrollbar doit �tre inf�rieur ou �gale � la taille de taille_englobe
					if(params.taille_scrollbar > params.taille_englobe){						
						params.taille_scrollbar = params.taille_englobe;	
					}
					return true;
				}else{return false;}		
			}
			
			//Si la hauteur du contenu est sup�rieur � la hauteur de l'espace visible
			if(controle_donnee()){
				//Au redimensionnement de la fenetre
				//N'est concern� par cette fonction que les �l�ments en 'auto'
				window.onresize = function() {
					if(taille_englobe_init == "auto"){
						params.taille_englobe = $(window).height()-40-padBot-padTop;
						$$.css({'height':params.taille_englobe+'px'});
						if(taille_scrollbar_init == "auto"){
							params.taille_scrollbar = params.taille_englobe;
							$('#scrollbar3').css({'height':params.taille_scrollbar+'px'});
							deplacement_bouton($("#englobe3").css('top').substring(0,$("#englobe3").css('top').length-2));
							if(params.debug){affiche_position();}
						}
					}	
				};
				
				//calcul des largeurs
				var temp = $$.width();
				$$.css({'width':params.marge_scroll_contenu+params.largeur_scrollbar+temp+'px'});
				//On construit une div autour du contenu, mais � l'int�rieur de la div
				$$.wrapInner('<div id="englobe3"></div>');
				$$.css({'height':params.taille_englobe+'px','overflow':'hidden','position':'relative'});
				$("#englobe3").css({'top':0+'px','float':'left','position':'relative','width':temp+'px'});	
				
				//On construit la scrollBar
				styler_scrollbar(params.position,params.alignement_scrollbar);
				
				$$.append('<div class="clear"></div>');
				$(".clear").css({'clear':'both'});
				
				
				switch (params.style) {
					case 'basic':
						//Style de la scrollBar
						$('#scrollbar3').css({'width':params.largeur_scrollbar+'px',
											'float':'left',
											'height':params.taille_scrollbar+'px',
											'background':'#ebd9b3'		
						});
				
						//Style du bouton de la scrollBar
						$("#bouton3").css({'width':params.largeur_scrollbar+'px',
										'height':params.taille_bouton+'px',
										'background':'#cda042',
										'top':0+'px',
										'cursor':'pointer'
										});
					break;
				}

				
				
				//Si le drag du bouton est activ�(true)
				if(params.drag){
					$("#bouton3").draggable({ 
						containment: 'parent',
						axis: 'y',
						start:function(){},
						drag: function(event, ui) {
							//ui.position.top est la valeur renvoy� par le plugin JQuery UI
							deplacement_contenu(ui.position.top);
							if(params.debug){affiche_position();}
						},
						stop: function(){}
					});
				}
				
				if(params.molette){
					$$.mousewheel(function(event, delta) {
						//On r�cup�re la position du contenu
						var top_contenu = $('#englobe3').css('top');
						
						//On enl�ve le 'px' et on le convertit en entier pour pouvoir le manipuler
						top_contenu = parseInt( top_contenu.substring(0,(top_contenu.length-2)) );
						
						//On r�cup�re la position du bouton
						var top_bouton = $('#bouton3').css('top');
						//On enl�ve le 'px' et on le convertit en entier pour pouvoir le manipuler
						top_bouton = parseInt( top_bouton.substring(0,(top_bouton.length-2)) );
						
						//Si le delta est positif, c'est � dire que l'on "pousse" la molette
						if (delta > 0) {							
							top_contenu = top_contenu + params.pas;
							//On v�rifie que l'on n'a pas atteint le haut du contenu
							if(top_contenu > 0){top_contenu = 0}
							$('#englobe3').css({'top':top_contenu+"px"});
						//Si le delta est n�gatif, c'est � dire que l'on "ram�ne" la molette
						}else if (delta < 0){							
							top_contenu = top_contenu - params.pas;
							//On v�rifie que l'on n'a pas atteint le bas du contenu
							if(top_contenu < calcul_contenu_top_max()){top_contenu = calcul_contenu_top_max()}
							$('#englobe3').css({'top':top_contenu+"px"});							
						}
						
						//calcul de d�placement du bouton					
						deplacement_bouton(top_contenu);
						
						if(params.debug){affiche_position();}
					});
				}
				
				//Affiche la console de debug
				if(params.debug){
					$$.after('<div id="debug"></div>');
					$('#debug').css({'position':'fixed','top':'200px','right':'50px', 'border':'2px solid #EF9700','background':'#FFDC9F','padding':'0px'})				
					.append('<p id="hauteurcontenu">Hauteur du contenu:'+taille_contenu+'</p>')
					.append('<p id="hauteurenglobe">Hauteur de l\'espace visible:'+params.taille_englobe+'</p>')
					.append('<p id="hauteurscrollbar">Hauteur du srcoll:'+params.taille_scrollbar+'</p>')
					.append('<p id="hauteurbouton">Hauteur du bouton:'+params.taille_bouton+'</p>')
					.append('<p id="topcontenu">Top du contenu:'+$$.css('top')+'</p>')
					.append('<p id="topbouton">Top du bouton:'+$('#bouton3').css('top')+'</p>')
					.append('<p id="topmaxbouton">Top max du bouton:'+calcul_contenu_top_max()+'</p>')
					.append('<p id="topmaxcontenu">Top max du contenu:'+calcul_bouton_top_max()+'</p>')
					.children().css({'margin':'0','padding':'5px'});
					
					//Fonction de mise � jour des infos de la console de debug
					function affiche_position(){
						$("#hauteurcontenu").html('Hauteur du contenu:'+taille_contenu);
						$("#hauteurenglobe").html('Hauteur de l\'espace visible:'+params.taille_englobe);
						$("#hauteurscrollbar").html('Hauteur du srcoll:'+params.taille_scrollbar);
						$("#hauteurbouton").html('Hauteur du bouton:'+params.taille_bouton);
						$("#topcontenu").html('Top du contenu:'+$('#englobe3').css('top'));
						$("#topbouton").html('Top du bouton:'+$('#bouton3').css('top'));
						$("#topmaxbouton").html('Top max du bouton:'+calcul_contenu_top_max());
						$("#topmaxcontenu").html('Top max du contenu:'+calcul_bouton_top_max());
					}
				}	
			}else{
				//alert('Pas de scrollbar');
			}
        });
	}
})(jQuery);


(function($) {
	
	$.fn.scrollbar4 = function(params) {
		alt_scroll = params;
		// Fusionner les param�tres par d�faut et ceux de l'utilisateur
		params = $.extend( {
			taille_englobe: alt_scroll,			//Taille de l'espace visible - /!\ Doit �tre un nombre ou 'auto'
			taille_scrollbar: "auto",		//Taille de la scrollbar - /!\ Doit �tre un nombre ou 'auto'
			taille_bouton: 50,				//Taille du bouton - /!\ Doit �tre un nombre
			pas:75,							//Pas du scroll molette - /!\ Doit �tre un nombre ou 'auto'
			molette: true,					//D�tection du scroll molette - /!\ true ou false
			drag: true,						//Bouton de la scrollbar d�placable � la souris - /!\ true ou false
			debug: true,					//Afficher la console de debug - /!\ true ou false
			style: 'basic',					//Choix des styles - /!\ Par d�fault, il n'y a que le style 'basic'
			position:'droite',				//Position de la scrollBar - /!\ 'gauche' ou 'droite'
			alignement_scrollbar:'haut',	//Alignement de la scrollBar. Utilis� uniquement si elle � une taille inf�rieur � celle de taille_englobe
			orientation: 'vertical',		//Orientation du contenu, 'vertical' ou 'horizontal'
			marge_scroll_contenu: 5,		//Marge entre la scrollBar et le contenu - /!\ Doit �tre un nombre
			largeur_scrollbar:5				//Largeur de la scrollbar
		}, params);
		
		return this.each(function() {
			var $$ = $(this);
			var taille_englobe_init = params.taille_englobe;
			var taille_scrollbar_init = params.taille_scrollbar;
			
			//Fonction de calcul de position top maximum du contenu
			function calcul_contenu_top_max(){
				return  params.taille_englobe - taille_contenu ;
			}
			
			//Fonction de calcul de position top maximum du bouton
			function calcul_bouton_top_max(){
				return params.taille_scrollbar - params.taille_bouton
			}
			
			//Fonction de calcul du d�placement du bouton
			function deplacement_bouton(info_top_contenu){
				//On calcul la nouvelle position du bouton
				var depl_bouton = (info_top_contenu/calcul_contenu_top_max())*(calcul_bouton_top_max());
				//On v�rifie que ca d�borde pas en haut
				if(depl_bouton < 0){depl_bouton = 0;}
				//On v�rifie que ca d�borde pas en bas
				if(depl_bouton > calcul_bouton_top_max()){depl_bouton = calcul_bouton_top_max();}
				$('#bouton4').css({'top':depl_bouton+"px"});
			}
			
			function deplacement_contenu(info_top_bouton){
				//On calcul la nouvelle position du contenu
				var depl_contenu = (info_top_bouton/calcul_bouton_top_max())*(calcul_contenu_top_max());
				//On v�rifie que ca d�borde pas en haut
				if (depl_contenu > 0){depl_contenu = 0}
				//On v�rifie que ca d�borde pas en bas
				if (depl_contenu < calcul_contenu_top_max()){depl_contenu = calcul_contenu_top_max()}
				$('#englobe4').css({'top':depl_contenu+"px"});
			}
			
			function styler_scrollbar(position,orientation){
				var type_marge_position;
				var marge_position;
				var marge_orientation;
				switch (position){
					case 'droite':
						$('#englobe4').after('<div id="scrollbar4"><div id="bouton4">&nbsp;</div></div>');
						$('#scrollbar4').css({'margin-left':params.marge_scroll_contenu+'px'});
					break;
					case 'gauche':
						$('#englobe4').before('<div id="scrollbar4"><div id="bouton4">&nbsp;</div></div>');
						$('#scrollbar4').css({'margin-right':params.marge_scroll_contenu+'px'});
					break;
				}
				switch (orientation){
					case 'haut':
						$('#scrollbar4').css({'margin-top':'0px'});
					break;
					case 'centre':
						var marge = (params.taille_englobe -params.taille_scrollbar)/2;
						$('#scrollbar4').css({'margin-top':marge+'px'});
					break;
					case 'bas':
						var marge = params.taille_englobe -params.taille_scrollbar;
						$('#scrollbar4').css({'margin-top':marge+'px'});
					break;
				}
			}
			var padTop=0;
			var padBot=0;
			//Hauteur du contenu
            var taille_contenu = $$.height()+40;
			
			function calcul_hauteur_auto(){
				if(params.taille_englobe == "auto"){
					padTop = $('#contenu').css('padding-top');
					padTop = padTop.substring(0,padTop.length-2);
					
					padBot = $('#contenu').css('padding-bottom');
					padBot = padBot.substring(0,padBot.length-2);
					
					params.taille_englobe = $(window).height()-40-padBot-padTop;
					
				}else{return false}
			}
			calcul_hauteur_auto();
			//La hauteur de l'espace visible est la hauteur de la fenetre du navigateur si taille_englobe="auto"
			
			
			function controle_donnee(){
				calcul_hauteur_auto();
				//La taille du contenu doit �tre sup�rieur � celle de l'espace visible (taille_englobe)
				if(taille_contenu > params.taille_englobe){
					//La hauteur de la scroll bar est �gale � la hauteur de "englobe" si hauteur_srollbar="auto"
					if(params.taille_scrollbar == "auto"){params.taille_scrollbar = params.taille_englobe;}
					//La taille de la scrollbar doit �tre inf�rieur ou �gale � la taille de taille_englobe
					if(params.taille_scrollbar > params.taille_englobe){						
						params.taille_scrollbar = params.taille_englobe;	
					}
					return true;
				}else{return false;}		
			}
			
			//Si la hauteur du contenu est sup�rieur � la hauteur de l'espace visible
			if(controle_donnee()){
				//Au redimensionnement de la fenetre
				//N'est concern� par cette fonction que les �l�ments en 'auto'
				window.onresize = function() {
					if(taille_englobe_init == "auto"){
						params.taille_englobe = $(window).height()-40-padBot-padTop;
						$$.css({'height':params.taille_englobe+'px'});
						if(taille_scrollbar_init == "auto"){
							params.taille_scrollbar = params.taille_englobe;
							$('#scrollbar4').css({'height':params.taille_scrollbar+'px'});
							deplacement_bouton($("#englobe4").css('top').substring(0,$("#englobe4").css('top').length-2));
							if(params.debug){affiche_position();}
						}
					}	
				};
				
				//calcul des largeurs
				var temp = $$.width();
				$$.css({'width':params.marge_scroll_contenu+params.largeur_scrollbar+temp+'px'});
				//On construit une div autour du contenu, mais � l'int�rieur de la div
				$$.wrapInner('<div id="englobe4"></div>');
				$$.css({'height':params.taille_englobe+'px','overflow':'hidden','position':'relative'});
				$("#englobe4").css({'top':0+'px','float':'left','position':'relative','width':temp+'px'});	
				
				//On construit la scrollBar
				styler_scrollbar(params.position,params.alignement_scrollbar);
				
				$$.append('<div class="clear"></div>');
				$(".clear").css({'clear':'both'});
				
				
				switch (params.style) {
					case 'basic':
						//Style de la scrollBar
						$('#scrollbar4').css({'width':params.largeur_scrollbar+'px',
											'float':'left',
											'height':params.taille_scrollbar+'px',
											'background':'#ebd9b3'		
						});
				
						//Style du bouton de la scrollBar
						$("#bouton4").css({'width':params.largeur_scrollbar+'px',
										'height':params.taille_bouton+'px',
										'background':'#cda042',
										'top':0+'px',
										'cursor':'pointer'
										});
					break;
				}

				
				
				//Si le drag du bouton est activ�(true)
				if(params.drag){
					$("#bouton4").draggable({ 
						containment: 'parent',
						axis: 'y',
						start:function(){},
						drag: function(event, ui) {
							//ui.position.top est la valeur renvoy� par le plugin JQuery UI
							deplacement_contenu(ui.position.top);
							if(params.debug){affiche_position();}
						},
						stop: function(){}
					});
				}
				
				if(params.molette){
					$$.mousewheel(function(event, delta) {
						//On r�cup�re la position du contenu
						var top_contenu = $('#englobe4').css('top');
						
						//On enl�ve le 'px' et on le convertit en entier pour pouvoir le manipuler
						top_contenu = parseInt( top_contenu.substring(0,(top_contenu.length-2)) );
						
						//On r�cup�re la position du bouton
						var top_bouton = $('#bouton4').css('top');
						//On enl�ve le 'px' et on le convertit en entier pour pouvoir le manipuler
						top_bouton = parseInt( top_bouton.substring(0,(top_bouton.length-2)) );
						
						//Si le delta est positif, c'est � dire que l'on "pousse" la molette
						if (delta > 0) {							
							top_contenu = top_contenu + params.pas;
							//On v�rifie que l'on n'a pas atteint le haut du contenu
							if(top_contenu > 0){top_contenu = 0}
							$('#englobe4').css({'top':top_contenu+"px"});
						//Si le delta est n�gatif, c'est � dire que l'on "ram�ne" la molette
						}else if (delta < 0){							
							top_contenu = top_contenu - params.pas;
							//On v�rifie que l'on n'a pas atteint le bas du contenu
							if(top_contenu < calcul_contenu_top_max()){top_contenu = calcul_contenu_top_max()}
							$('#englobe4').css({'top':top_contenu+"px"});							
						}
						
						//calcul de d�placement du bouton					
						deplacement_bouton(top_contenu);
						
						if(params.debug){affiche_position();}
					});
				}
				
				//Affiche la console de debug
				if(params.debug){
					$$.after('<div id="debug"></div>');
					$('#debug').css({'position':'fixed','top':'200px','right':'50px', 'border':'2px solid #EF9700','background':'#FFDC9F','padding':'0px'})				
					.append('<p id="hauteurcontenu">Hauteur du contenu:'+taille_contenu+'</p>')
					.append('<p id="hauteurenglobe">Hauteur de l\'espace visible:'+params.taille_englobe+'</p>')
					.append('<p id="hauteurscrollbar">Hauteur du srcoll:'+params.taille_scrollbar+'</p>')
					.append('<p id="hauteurbouton">Hauteur du bouton:'+params.taille_bouton+'</p>')
					.append('<p id="topcontenu">Top du contenu:'+$$.css('top')+'</p>')
					.append('<p id="topbouton">Top du bouton:'+$('#bouton4').css('top')+'</p>')
					.append('<p id="topmaxbouton">Top max du bouton:'+calcul_contenu_top_max()+'</p>')
					.append('<p id="topmaxcontenu">Top max du contenu:'+calcul_bouton_top_max()+'</p>')
					.children().css({'margin':'0','padding':'5px'});
					
					//Fonction de mise � jour des infos de la console de debug
					function affiche_position(){
						$("#hauteurcontenu").html('Hauteur du contenu:'+taille_contenu);
						$("#hauteurenglobe").html('Hauteur de l\'espace visible:'+params.taille_englobe);
						$("#hauteurscrollbar").html('Hauteur du srcoll:'+params.taille_scrollbar);
						$("#hauteurbouton").html('Hauteur du bouton:'+params.taille_bouton);
						$("#topcontenu").html('Top du contenu:'+$('#englobe4').css('top'));
						$("#topbouton").html('Top du bouton:'+$('#bouton4').css('top'));
						$("#topmaxbouton").html('Top max du bouton:'+calcul_contenu_top_max());
						$("#topmaxcontenu").html('Top max du contenu:'+calcul_bouton_top_max());
					}
				}	
			}else{
				//alert('Pas de scrollbar');
			}
        });
	}
})(jQuery);// JavaScript Document


(function($) {
	
	$.fn.scrollbar5 = function(params) {
		alt_scroll = params;
		// Fusionner les param�tres par d�faut et ceux de l'utilisateur
		params = $.extend( {
			taille_englobe: alt_scroll,			//Taille de l'espace visible - /!\ Doit �tre un nombre ou 'auto'
			taille_scrollbar: "auto",		//Taille de la scrollbar - /!\ Doit �tre un nombre ou 'auto'
			taille_bouton: 50,				//Taille du bouton - /!\ Doit �tre un nombre
			pas:75,							//Pas du scroll molette - /!\ Doit �tre un nombre ou 'auto'
			molette: true,					//D�tection du scroll molette - /!\ true ou false
			drag: true,						//Bouton de la scrollbar d�placable � la souris - /!\ true ou false
			debug: true,					//Afficher la console de debug - /!\ true ou false
			style: 'basic',					//Choix des styles - /!\ Par d�fault, il n'y a que le style 'basic'
			position:'droite',				//Position de la scrollBar - /!\ 'gauche' ou 'droite'
			alignement_scrollbar:'haut',	//Alignement de la scrollBar. Utilis� uniquement si elle � une taille inf�rieur � celle de taille_englobe
			orientation: 'vertical',		//Orientation du contenu, 'vertical' ou 'horizontal'
			marge_scroll_contenu: 5,		//Marge entre la scrollBar et le contenu - /!\ Doit �tre un nombre
			largeur_scrollbar:5				//Largeur de la scrollbar
		}, params);
		
		return this.each(function() {
			var $$ = $(this);
			var taille_englobe_init = params.taille_englobe;
			var taille_scrollbar_init = params.taille_scrollbar;
			
			//Fonction de calcul de position top maximum du contenu
			function calcul_contenu_top_max(){
				return  params.taille_englobe - taille_contenu ;
			}
			
			//Fonction de calcul de position top maximum du bouton
			function calcul_bouton_top_max(){
				return params.taille_scrollbar - params.taille_bouton
			}
			
			//Fonction de calcul du d�placement du bouton
			function deplacement_bouton(info_top_contenu){
				//On calcul la nouvelle position du bouton
				var depl_bouton = (info_top_contenu/calcul_contenu_top_max())*(calcul_bouton_top_max());
				//On v�rifie que ca d�borde pas en haut
				if(depl_bouton < 0){depl_bouton = 0;}
				//On v�rifie que ca d�borde pas en bas
				if(depl_bouton > calcul_bouton_top_max()){depl_bouton = calcul_bouton_top_max();}
				$('#bouton5').css({'top':depl_bouton+"px"});
			}
			
			function deplacement_contenu(info_top_bouton){
				//On calcul la nouvelle position du contenu
				var depl_contenu = (info_top_bouton/calcul_bouton_top_max())*(calcul_contenu_top_max());
				//On v�rifie que ca d�borde pas en haut
				if (depl_contenu > 0){depl_contenu = 0}
				//On v�rifie que ca d�borde pas en bas
				if (depl_contenu < calcul_contenu_top_max()){depl_contenu = calcul_contenu_top_max()}
				$('#englobe5').css({'top':depl_contenu+"px"});
			}
			
			function styler_scrollbar(position,orientation){
				var type_marge_position;
				var marge_position;
				var marge_orientation;
				switch (position){
					case 'droite':
						$('#englobe5').after('<div id="scrollbar5"><div id="bouton5">&nbsp;</div></div>');
						$('#scrollbar5').css({'margin-left':params.marge_scroll_contenu+'px'});
					break;
					case 'gauche':
						$('#englobe5').before('<div id="scrollbar5"><div id="bouton5">&nbsp;</div></div>');
						$('#scrollbar5').css({'margin-right':params.marge_scroll_contenu+'px'});
					break;
				}
				switch (orientation){
					case 'haut':
						$('#scrollbar5').css({'margin-top':'0px'});
					break;
					case 'centre':
						var marge = (params.taille_englobe -params.taille_scrollbar)/2;
						$('#scrollbar5').css({'margin-top':marge+'px'});
					break;
					case 'bas':
						var marge = params.taille_englobe -params.taille_scrollbar;
						$('#scrollbar5').css({'margin-top':marge+'px'});
					break;
				}
			}
			var padTop=0;
			var padBot=0;
			//Hauteur du contenu
            var taille_contenu = $$.height()+40;
			
			function calcul_hauteur_auto(){
				if(params.taille_englobe == "auto"){
					padTop = $('#contenu').css('padding-top');
					padTop = padTop.substring(0,padTop.length-2);
					
					padBot = $('#contenu').css('padding-bottom');
					padBot = padBot.substring(0,padBot.length-2);
					
					params.taille_englobe = $(window).height()-40-padBot-padTop;
					
				}else{return false}
			}
			calcul_hauteur_auto();
			//La hauteur de l'espace visible est la hauteur de la fenetre du navigateur si taille_englobe="auto"
			
			
			function controle_donnee(){
				calcul_hauteur_auto();
				//La taille du contenu doit �tre sup�rieur � celle de l'espace visible (taille_englobe)
				if(taille_contenu > params.taille_englobe){
					//La hauteur de la scroll bar est �gale � la hauteur de "englobe" si hauteur_srollbar="auto"
					if(params.taille_scrollbar == "auto"){params.taille_scrollbar = params.taille_englobe;}
					//La taille de la scrollbar doit �tre inf�rieur ou �gale � la taille de taille_englobe
					if(params.taille_scrollbar > params.taille_englobe){						
						params.taille_scrollbar = params.taille_englobe;	
					}
					return true;
				}else{return false;}		
			}
			
			//Si la hauteur du contenu est sup�rieur � la hauteur de l'espace visible
			if(controle_donnee()){
				//Au redimensionnement de la fenetre
				//N'est concern� par cette fonction que les �l�ments en 'auto'
				window.onresize = function() {
					if(taille_englobe_init == "auto"){
						params.taille_englobe = $(window).height()-40-padBot-padTop;
						$$.css({'height':params.taille_englobe+'px'});
						if(taille_scrollbar_init == "auto"){
							params.taille_scrollbar = params.taille_englobe;
							$('#scrollbar5').css({'height':params.taille_scrollbar+'px'});
							deplacement_bouton($("#englobe5").css('top').substring(0,$("#englobe5").css('top').length-2));
							if(params.debug){affiche_position();}
						}
					}	
				};
				
				//calcul des largeurs
				var temp = $$.width();
				$$.css({'width':params.marge_scroll_contenu+params.largeur_scrollbar+temp+'px'});
				//On construit une div autour du contenu, mais � l'int�rieur de la div
				$$.wrapInner('<div id="englobe5"></div>');
				$$.css({'height':params.taille_englobe+'px','overflow':'hidden','position':'relative'});
				$("#englobe5").css({'top':0+'px','float':'left','position':'relative','width':temp+'px'});	
				
				//On construit la scrollBar
				styler_scrollbar(params.position,params.alignement_scrollbar);
				
				$$.append('<div class="clear"></div>');
				$(".clear").css({'clear':'both'});
				
				
				switch (params.style) {
					case 'basic':
						//Style de la scrollBar
						$('#scrollbar5').css({'width':params.largeur_scrollbar+'px',
											'float':'left',
											'height':params.taille_scrollbar+'px',
											'background':'#ebd9b3'		
						});
				
						//Style du bouton de la scrollBar
						$("#bouton5").css({'width':params.largeur_scrollbar+'px',
										'height':params.taille_bouton+'px',
										'background':'#cda042',
										'top':0+'px',
										'cursor':'pointer'
										});
					break;
				}

				
				
				//Si le drag du bouton est activ�(true)
				if(params.drag){
					$("#bouton5").draggable({ 
						containment: 'parent',
						axis: 'y',
						start:function(){},
						drag: function(event, ui) {
							//ui.position.top est la valeur renvoy� par le plugin JQuery UI
							deplacement_contenu(ui.position.top);
							if(params.debug){affiche_position();}
						},
						stop: function(){}
					});
				}
				
				if(params.molette){
					$$.mousewheel(function(event, delta) {
						//On r�cup�re la position du contenu
						var top_contenu = $('#englobe5').css('top');
						
						//On enl�ve le 'px' et on le convertit en entier pour pouvoir le manipuler
						top_contenu = parseInt( top_contenu.substring(0,(top_contenu.length-2)) );
						
						//On r�cup�re la position du bouton
						var top_bouton = $('#bouton5').css('top');
						//On enl�ve le 'px' et on le convertit en entier pour pouvoir le manipuler
						top_bouton = parseInt( top_bouton.substring(0,(top_bouton.length-2)) );
						
						//Si le delta est positif, c'est � dire que l'on "pousse" la molette
						if (delta > 0) {							
							top_contenu = top_contenu + params.pas;
							//On v�rifie que l'on n'a pas atteint le haut du contenu
							if(top_contenu > 0){top_contenu = 0}
							$('#englobe5').css({'top':top_contenu+"px"});
						//Si le delta est n�gatif, c'est � dire que l'on "ram�ne" la molette
						}else if (delta < 0){							
							top_contenu = top_contenu - params.pas;
							//On v�rifie que l'on n'a pas atteint le bas du contenu
							if(top_contenu < calcul_contenu_top_max()){top_contenu = calcul_contenu_top_max()}
							$('#englobe5').css({'top':top_contenu+"px"});							
						}
						
						//calcul de d�placement du bouton					
						deplacement_bouton(top_contenu);
						
						if(params.debug){affiche_position();}
					});
				}
				
				//Affiche la console de debug
				if(params.debug){
					$$.after('<div id="debug"></div>');
					$('#debug').css({'position':'fixed','top':'200px','right':'50px', 'border':'2px solid #EF9700','background':'#FFDC9F','padding':'0px'})				
					.append('<p id="hauteurcontenu">Hauteur du contenu:'+taille_contenu+'</p>')
					.append('<p id="hauteurenglobe">Hauteur de l\'espace visible:'+params.taille_englobe+'</p>')
					.append('<p id="hauteurscrollbar">Hauteur du srcoll:'+params.taille_scrollbar+'</p>')
					.append('<p id="hauteurbouton">Hauteur du bouton:'+params.taille_bouton+'</p>')
					.append('<p id="topcontenu">Top du contenu:'+$$.css('top')+'</p>')
					.append('<p id="topbouton">Top du bouton:'+$('#bouton5').css('top')+'</p>')
					.append('<p id="topmaxbouton">Top max du bouton:'+calcul_contenu_top_max()+'</p>')
					.append('<p id="topmaxcontenu">Top max du contenu:'+calcul_bouton_top_max()+'</p>')
					.children().css({'margin':'0','padding':'5px'});
					
					//Fonction de mise � jour des infos de la console de debug
					function affiche_position(){
						$("#hauteurcontenu").html('Hauteur du contenu:'+taille_contenu);
						$("#hauteurenglobe").html('Hauteur de l\'espace visible:'+params.taille_englobe);
						$("#hauteurscrollbar").html('Hauteur du srcoll:'+params.taille_scrollbar);
						$("#hauteurbouton").html('Hauteur du bouton:'+params.taille_bouton);
						$("#topcontenu").html('Top du contenu:'+$('#englobe5').css('top'));
						$("#topbouton").html('Top du bouton:'+$('#bouton5').css('top'));
						$("#topmaxbouton").html('Top max du bouton:'+calcul_contenu_top_max());
						$("#topmaxcontenu").html('Top max du contenu:'+calcul_bouton_top_max());
					}
				}	
			}else{
				//alert('Pas de scrollbar');
			}
        });
	}
})(jQuery);// JavaScript Document



(function($) {
	
	$.fn.scrollbar6 = function(params) {
		alt_scroll = params;
		// Fusionner les param�tres par d�faut et ceux de l'utilisateur
		params = $.extend( {
			taille_englobe: alt_scroll,			//Taille de l'espace visible - /!\ Doit �tre un nombre ou 'auto'
			taille_scrollbar: "auto",		//Taille de la scrollbar - /!\ Doit �tre un nombre ou 'auto'
			taille_bouton: 50,				//Taille du bouton - /!\ Doit �tre un nombre
			pas:75,							//Pas du scroll molette - /!\ Doit �tre un nombre ou 'auto'
			molette: true,					//D�tection du scroll molette - /!\ true ou false
			drag: true,						//Bouton de la scrollbar d�placable � la souris - /!\ true ou false
			debug: true,					//Afficher la console de debug - /!\ true ou false
			style: 'basic',					//Choix des styles - /!\ Par d�fault, il n'y a que le style 'basic'
			position:'droite',				//Position de la scrollBar - /!\ 'gauche' ou 'droite'
			alignement_scrollbar:'haut',	//Alignement de la scrollBar. Utilis� uniquement si elle � une taille inf�rieur � celle de taille_englobe
			orientation: 'vertical',		//Orientation du contenu, 'vertical' ou 'horizontal'
			marge_scroll_contenu: 5,		//Marge entre la scrollBar et le contenu - /!\ Doit �tre un nombre
			largeur_scrollbar:5				//Largeur de la scrollbar
		}, params);
		
		return this.each(function() {
			var $$ = $(this);
			var taille_englobe_init = params.taille_englobe;
			var taille_scrollbar_init = params.taille_scrollbar;
			
			//Fonction de calcul de position top maximum du contenu
			function calcul_contenu_top_max(){
				return  params.taille_englobe - taille_contenu ;
			}
			
			//Fonction de calcul de position top maximum du bouton
			function calcul_bouton_top_max(){
				return params.taille_scrollbar - params.taille_bouton
			}
			
			//Fonction de calcul du d�placement du bouton
			function deplacement_bouton(info_top_contenu){
				//On calcul la nouvelle position du bouton
				var depl_bouton = (info_top_contenu/calcul_contenu_top_max())*(calcul_bouton_top_max());
				//On v�rifie que ca d�borde pas en haut
				if(depl_bouton < 0){depl_bouton = 0;}
				//On v�rifie que ca d�borde pas en bas
				if(depl_bouton > calcul_bouton_top_max()){depl_bouton = calcul_bouton_top_max();}
				$('#bouton6').css({'top':depl_bouton+"px"});
			}
			
			function deplacement_contenu(info_top_bouton){
				//On calcul la nouvelle position du contenu
				var depl_contenu = (info_top_bouton/calcul_bouton_top_max())*(calcul_contenu_top_max());
				//On v�rifie que ca d�borde pas en haut
				if (depl_contenu > 0){depl_contenu = 0}
				//On v�rifie que ca d�borde pas en bas
				if (depl_contenu < calcul_contenu_top_max()){depl_contenu = calcul_contenu_top_max()}
				$('#englobe6').css({'top':depl_contenu+"px"});
			}
			
			function styler_scrollbar(position,orientation){
				var type_marge_position;
				var marge_position;
				var marge_orientation;
				switch (position){
					case 'droite':
						$('#englobe6').after('<div id="scrollbar6"><div id="bouton6">&nbsp;</div></div>');
						$('#scrollbar6').css({'margin-left':params.marge_scroll_contenu+'px'});
					break;
					case 'gauche':
						$('#englobe6').before('<div id="scrollbar6"><div id="bouton6">&nbsp;</div></div>');
						$('#scrollbar6').css({'margin-right':params.marge_scroll_contenu+'px'});
					break;
				}
				switch (orientation){
					case 'haut':
						$('#scrollbar6').css({'margin-top':'0px'});
					break;
					case 'centre':
						var marge = (params.taille_englobe -params.taille_scrollbar)/2;
						$('#scrollbar6').css({'margin-top':marge+'px'});
					break;
					case 'bas':
						var marge = params.taille_englobe -params.taille_scrollbar;
						$('#scrollbar6').css({'margin-top':marge+'px'});
					break;
				}
			}
			var padTop=0;
			var padBot=0;
			//Hauteur du contenu
            var taille_contenu = $$.height()+40;
			
			function calcul_hauteur_auto(){
				if(params.taille_englobe == "auto"){
					padTop = $('#contenu').css('padding-top');
					padTop = padTop.substring(0,padTop.length-2);
					
					padBot = $('#contenu').css('padding-bottom');
					padBot = padBot.substring(0,padBot.length-2);
					
					params.taille_englobe = $(window).height()-40-padBot-padTop;
					
				}else{return false}
			}
			calcul_hauteur_auto();
			//La hauteur de l'espace visible est la hauteur de la fenetre du navigateur si taille_englobe="auto"
			
			
			function controle_donnee(){
				calcul_hauteur_auto();
				//La taille du contenu doit �tre sup�rieur � celle de l'espace visible (taille_englobe)
				if(taille_contenu > params.taille_englobe){
					//La hauteur de la scroll bar est �gale � la hauteur de "englobe" si hauteur_srollbar="auto"
					if(params.taille_scrollbar == "auto"){params.taille_scrollbar = params.taille_englobe;}
					//La taille de la scrollbar doit �tre inf�rieur ou �gale � la taille de taille_englobe
					if(params.taille_scrollbar > params.taille_englobe){						
						params.taille_scrollbar = params.taille_englobe;	
					}
					return true;
				}else{return false;}		
			}
			
			//Si la hauteur du contenu est sup�rieur � la hauteur de l'espace visible
			if(controle_donnee()){
				//Au redimensionnement de la fenetre
				//N'est concern� par cette fonction que les �l�ments en 'auto'
				window.onresize = function() {
					if(taille_englobe_init == "auto"){
						params.taille_englobe = $(window).height()-40-padBot-padTop;
						$$.css({'height':params.taille_englobe+'px'});
						if(taille_scrollbar_init == "auto"){
							params.taille_scrollbar = params.taille_englobe;
							$('#scrollbar6').css({'height':params.taille_scrollbar+'px'});
							deplacement_bouton($("#englobe6").css('top').substring(0,$("#englobe6").css('top').length-2));
							if(params.debug){affiche_position();}
						}
					}	
				};
				
				//calcul des largeurs
				var temp = $$.width();
				$$.css({'width':params.marge_scroll_contenu+params.largeur_scrollbar+temp+'px'});
				//On construit une div autour du contenu, mais � l'int�rieur de la div
				$$.wrapInner('<div id="englobe6"></div>');
				$$.css({'height':params.taille_englobe+'px','overflow':'hidden','position':'relative'});
				$("#englobe6").css({'top':0+'px','float':'left','position':'relative','width':temp+'px'});	
				
				//On construit la scrollBar
				styler_scrollbar(params.position,params.alignement_scrollbar);
				
				$$.append('<div class="clear"></div>');
				$(".clear").css({'clear':'both'});
				
				
				switch (params.style) {
					case 'basic':
						//Style de la scrollBar
						$('#scrollbar6').css({'width':params.largeur_scrollbar+'px',
											'float':'left',
											'height':params.taille_scrollbar+'px',
											'background':'#ebd9b3'		
						});
				
						//Style du bouton de la scrollBar
						$("#bouton6").css({'width':params.largeur_scrollbar+'px',
										'height':params.taille_bouton+'px',
										'background':'#cda042',
										'top':0+'px',
										'cursor':'pointer'
										});
					break;
				}

				
				
				//Si le drag du bouton est activ�(true)
				if(params.drag){
					$("#bouton6").draggable({ 
						containment: 'parent',
						axis: 'y',
						start:function(){},
						drag: function(event, ui) {
							//ui.position.top est la valeur renvoy� par le plugin JQuery UI
							deplacement_contenu(ui.position.top);
							if(params.debug){affiche_position();}
						},
						stop: function(){}
					});
				}
				
				if(params.molette){
					$$.mousewheel(function(event, delta) {
						//On r�cup�re la position du contenu
						var top_contenu = $('#englobe6').css('top');
						
						//On enl�ve le 'px' et on le convertit en entier pour pouvoir le manipuler
						top_contenu = parseInt( top_contenu.substring(0,(top_contenu.length-2)) );
						
						//On r�cup�re la position du bouton
						var top_bouton = $('#bouton6').css('top');
						//On enl�ve le 'px' et on le convertit en entier pour pouvoir le manipuler
						top_bouton = parseInt( top_bouton.substring(0,(top_bouton.length-2)) );
						
						//Si le delta est positif, c'est � dire que l'on "pousse" la molette
						if (delta > 0) {							
							top_contenu = top_contenu + params.pas;
							//On v�rifie que l'on n'a pas atteint le haut du contenu
							if(top_contenu > 0){top_contenu = 0}
							$('#englobe6').css({'top':top_contenu+"px"});
						//Si le delta est n�gatif, c'est � dire que l'on "ram�ne" la molette
						}else if (delta < 0){							
							top_contenu = top_contenu - params.pas;
							//On v�rifie que l'on n'a pas atteint le bas du contenu
							if(top_contenu < calcul_contenu_top_max()){top_contenu = calcul_contenu_top_max()}
							$('#englobe6').css({'top':top_contenu+"px"});							
						}
						
						//calcul de d�placement du bouton					
						deplacement_bouton(top_contenu);
						
						if(params.debug){affiche_position();}
					});
				}
				
				//Affiche la console de debug
				if(params.debug){
					$$.after('<div id="debug"></div>');
					$('#debug').css({'position':'fixed','top':'200px','right':'50px', 'border':'2px solid #EF9700','background':'#FFDC9F','padding':'0px'})				
					.append('<p id="hauteurcontenu">Hauteur du contenu:'+taille_contenu+'</p>')
					.append('<p id="hauteurenglobe">Hauteur de l\'espace visible:'+params.taille_englobe+'</p>')
					.append('<p id="hauteurscrollbar">Hauteur du srcoll:'+params.taille_scrollbar+'</p>')
					.append('<p id="hauteurbouton">Hauteur du bouton:'+params.taille_bouton+'</p>')
					.append('<p id="topcontenu">Top du contenu:'+$$.css('top')+'</p>')
					.append('<p id="topbouton">Top du bouton:'+$('#bouton6').css('top')+'</p>')
					.append('<p id="topmaxbouton">Top max du bouton:'+calcul_contenu_top_max()+'</p>')
					.append('<p id="topmaxcontenu">Top max du contenu:'+calcul_bouton_top_max()+'</p>')
					.children().css({'margin':'0','padding':'5px'});
					
					//Fonction de mise � jour des infos de la console de debug
					function affiche_position(){
						$("#hauteurcontenu").html('Hauteur du contenu:'+taille_contenu);
						$("#hauteurenglobe").html('Hauteur de l\'espace visible:'+params.taille_englobe);
						$("#hauteurscrollbar").html('Hauteur du srcoll:'+params.taille_scrollbar);
						$("#hauteurbouton").html('Hauteur du bouton:'+params.taille_bouton);
						$("#topcontenu").html('Top du contenu:'+$('#englobe6').css('top'));
						$("#topbouton").html('Top du bouton:'+$('#bouton6').css('top'));
						$("#topmaxbouton").html('Top max du bouton:'+calcul_contenu_top_max());
						$("#topmaxcontenu").html('Top max du contenu:'+calcul_bouton_top_max());
					}
				}	
			}else{
				//alert('Pas de scrollbar');
			}
        });
	}
})(jQuery);// JavaScript Document



(function($) {
	
	$.fn.scrollbar7 = function(params) {
		alt_scroll = params;
		// Fusionner les param�tres par d�faut et ceux de l'utilisateur
		params = $.extend( {
			taille_englobe: alt_scroll,			//Taille de l'espace visible - /!\ Doit �tre un nombre ou 'auto'
			taille_scrollbar: "auto",		//Taille de la scrollbar - /!\ Doit �tre un nombre ou 'auto'
			taille_bouton: 50,				//Taille du bouton - /!\ Doit �tre un nombre
			pas:75,							//Pas du scroll molette - /!\ Doit �tre un nombre ou 'auto'
			molette: true,					//D�tection du scroll molette - /!\ true ou false
			drag: true,						//Bouton de la scrollbar d�placable � la souris - /!\ true ou false
			debug: true,					//Afficher la console de debug - /!\ true ou false
			style: 'basic',					//Choix des styles - /!\ Par d�fault, il n'y a que le style 'basic'
			position:'droite',				//Position de la scrollBar - /!\ 'gauche' ou 'droite'
			alignement_scrollbar:'haut',	//Alignement de la scrollBar. Utilis� uniquement si elle � une taille inf�rieur � celle de taille_englobe
			orientation: 'vertical',		//Orientation du contenu, 'vertical' ou 'horizontal'
			marge_scroll_contenu: 5,		//Marge entre la scrollBar et le contenu - /!\ Doit �tre un nombre
			largeur_scrollbar:5				//Largeur de la scrollbar
		}, params);
		
		return this.each(function() {
			var $$ = $(this);
			var taille_englobe_init = params.taille_englobe;
			var taille_scrollbar_init = params.taille_scrollbar;
			
			//Fonction de calcul de position top maximum du contenu
			function calcul_contenu_top_max(){
				return  params.taille_englobe - taille_contenu ;
			}
			
			//Fonction de calcul de position top maximum du bouton
			function calcul_bouton_top_max(){
				return params.taille_scrollbar - params.taille_bouton
			}
			
			//Fonction de calcul du d�placement du bouton
			function deplacement_bouton(info_top_contenu){
				//On calcul la nouvelle position du bouton
				var depl_bouton = (info_top_contenu/calcul_contenu_top_max())*(calcul_bouton_top_max());
				//On v�rifie que ca d�borde pas en haut
				if(depl_bouton < 0){depl_bouton = 0;}
				//On v�rifie que ca d�borde pas en bas
				if(depl_bouton > calcul_bouton_top_max()){depl_bouton = calcul_bouton_top_max();}
				$('#bouton7').css({'top':depl_bouton+"px"});
			}
			
			function deplacement_contenu(info_top_bouton){
				//On calcul la nouvelle position du contenu
				var depl_contenu = (info_top_bouton/calcul_bouton_top_max())*(calcul_contenu_top_max());
				//On v�rifie que ca d�borde pas en haut
				if (depl_contenu > 0){depl_contenu = 0}
				//On v�rifie que ca d�borde pas en bas
				if (depl_contenu < calcul_contenu_top_max()){depl_contenu = calcul_contenu_top_max()}
				$('#englobe7').css({'top':depl_contenu+"px"});
			}
			
			function styler_scrollbar(position,orientation){
				var type_marge_position;
				var marge_position;
				var marge_orientation;
				switch (position){
					case 'droite':
						$('#englobe7').after('<div id="scrollbar7"><div id="bouton7">&nbsp;</div></div>');
						$('#scrollbar7').css({'margin-left':params.marge_scroll_contenu+'px'});
					break;
					case 'gauche':
						$('#englobe7').before('<div id="scrollbar7"><div id="bouton7">&nbsp;</div></div>');
						$('#scrollbar7').css({'margin-right':params.marge_scroll_contenu+'px'});
					break;
				}
				switch (orientation){
					case 'haut':
						$('#scrollbar7').css({'margin-top':'0px'});
					break;
					case 'centre':
						var marge = (params.taille_englobe -params.taille_scrollbar)/2;
						$('#scrollbar7').css({'margin-top':marge+'px'});
					break;
					case 'bas':
						var marge = params.taille_englobe -params.taille_scrollbar;
						$('#scrollbar7').css({'margin-top':marge+'px'});
					break;
				}
			}
			var padTop=0;
			var padBot=0;
			//Hauteur du contenu
            var taille_contenu = $$.height()+40;
			
			function calcul_hauteur_auto(){
				if(params.taille_englobe == "auto"){
					padTop = $('#contenu').css('padding-top');
					padTop = padTop.substring(0,padTop.length-2);
					
					padBot = $('#contenu').css('padding-bottom');
					padBot = padBot.substring(0,padBot.length-2);
					
					params.taille_englobe = $(window).height()-40-padBot-padTop;
					
				}else{return false}
			}
			calcul_hauteur_auto();
			//La hauteur de l'espace visible est la hauteur de la fenetre du navigateur si taille_englobe="auto"
			
			
			function controle_donnee(){
				calcul_hauteur_auto();
				//La taille du contenu doit �tre sup�rieur � celle de l'espace visible (taille_englobe)
				if(taille_contenu > params.taille_englobe){
					//La hauteur de la scroll bar est �gale � la hauteur de "englobe" si hauteur_srollbar="auto"
					if(params.taille_scrollbar == "auto"){params.taille_scrollbar = params.taille_englobe;}
					//La taille de la scrollbar doit �tre inf�rieur ou �gale � la taille de taille_englobe
					if(params.taille_scrollbar > params.taille_englobe){						
						params.taille_scrollbar = params.taille_englobe;	
					}
					return true;
				}else{return false;}		
			}
			
			//Si la hauteur du contenu est sup�rieur � la hauteur de l'espace visible
			if(controle_donnee()){
				//Au redimensionnement de la fenetre
				//N'est concern� par cette fonction que les �l�ments en 'auto'
				window.onresize = function() {
					if(taille_englobe_init == "auto"){
						params.taille_englobe = $(window).height()-40-padBot-padTop;
						$$.css({'height':params.taille_englobe+'px'});
						if(taille_scrollbar_init == "auto"){
							params.taille_scrollbar = params.taille_englobe;
							$('#scrollbar7').css({'height':params.taille_scrollbar+'px'});
							deplacement_bouton($("#englobe7").css('top').substring(0,$("#englobe7").css('top').length-2));
							if(params.debug){affiche_position();}
						}
					}	
				};
				
				//calcul des largeurs
				var temp = $$.width();
				$$.css({'width':params.marge_scroll_contenu+params.largeur_scrollbar+temp+'px'});
				//On construit une div autour du contenu, mais � l'int�rieur de la div
				$$.wrapInner('<div id="englobe7"></div>');
				$$.css({'height':params.taille_englobe+'px','overflow':'hidden','position':'relative'});
				$("#englobe7").css({'top':0+'px','float':'left','position':'relative','width':temp+'px'});	
				
				//On construit la scrollBar
				styler_scrollbar(params.position,params.alignement_scrollbar);
				
				$$.append('<div class="clear"></div>');
				$(".clear").css({'clear':'both'});
				
				
				switch (params.style) {
					case 'basic':
						//Style de la scrollBar
						$('#scrollbar7').css({'width':params.largeur_scrollbar+'px',
											'float':'left',
											'height':params.taille_scrollbar+'px',
											'background':'#ebd9b3'		
						});
				
						//Style du bouton de la scrollBar
						$("#bouton7").css({'width':params.largeur_scrollbar+'px',
										'height':params.taille_bouton+'px',
										'background':'#cda042',
										'top':0+'px',
										'cursor':'pointer'
										});
					break;
				}

				
				
				//Si le drag du bouton est activ�(true)
				if(params.drag){
					$("#bouton7").draggable({ 
						containment: 'parent',
						axis: 'y',
						start:function(){},
						drag: function(event, ui) {
							//ui.position.top est la valeur renvoy� par le plugin JQuery UI
							deplacement_contenu(ui.position.top);
							if(params.debug){affiche_position();}
						},
						stop: function(){}
					});
				}
				
				if(params.molette){
					$$.mousewheel(function(event, delta) {
						//On r�cup�re la position du contenu
						var top_contenu = $('#englobe7').css('top');
						
						//On enl�ve le 'px' et on le convertit en entier pour pouvoir le manipuler
						top_contenu = parseInt( top_contenu.substring(0,(top_contenu.length-2)) );
						
						//On r�cup�re la position du bouton
						var top_bouton = $('#bouton7').css('top');
						//On enl�ve le 'px' et on le convertit en entier pour pouvoir le manipuler
						top_bouton = parseInt( top_bouton.substring(0,(top_bouton.length-2)) );
						
						//Si le delta est positif, c'est � dire que l'on "pousse" la molette
						if (delta > 0) {							
							top_contenu = top_contenu + params.pas;
							//On v�rifie que l'on n'a pas atteint le haut du contenu
							if(top_contenu > 0){top_contenu = 0}
							$('#englobe7').css({'top':top_contenu+"px"});
						//Si le delta est n�gatif, c'est � dire que l'on "ram�ne" la molette
						}else if (delta < 0){							
							top_contenu = top_contenu - params.pas;
							//On v�rifie que l'on n'a pas atteint le bas du contenu
							if(top_contenu < calcul_contenu_top_max()){top_contenu = calcul_contenu_top_max()}
							$('#englobe7').css({'top':top_contenu+"px"});							
						}
						
						//calcul de d�placement du bouton					
						deplacement_bouton(top_contenu);
						
						if(params.debug){affiche_position();}
					});
				}
				
				//Affiche la console de debug
				if(params.debug){
					$$.after('<div id="debug"></div>');
					$('#debug').css({'position':'fixed','top':'200px','right':'50px', 'border':'2px solid #EF9700','background':'#FFDC9F','padding':'0px'})				
					.append('<p id="hauteurcontenu">Hauteur du contenu:'+taille_contenu+'</p>')
					.append('<p id="hauteurenglobe">Hauteur de l\'espace visible:'+params.taille_englobe+'</p>')
					.append('<p id="hauteurscrollbar">Hauteur du srcoll:'+params.taille_scrollbar+'</p>')
					.append('<p id="hauteurbouton">Hauteur du bouton:'+params.taille_bouton+'</p>')
					.append('<p id="topcontenu">Top du contenu:'+$$.css('top')+'</p>')
					.append('<p id="topbouton">Top du bouton:'+$('#bouton7').css('top')+'</p>')
					.append('<p id="topmaxbouton">Top max du bouton:'+calcul_contenu_top_max()+'</p>')
					.append('<p id="topmaxcontenu">Top max du contenu:'+calcul_bouton_top_max()+'</p>')
					.children().css({'margin':'0','padding':'5px'});
					
					//Fonction de mise � jour des infos de la console de debug
					function affiche_position(){
						$("#hauteurcontenu").html('Hauteur du contenu:'+taille_contenu);
						$("#hauteurenglobe").html('Hauteur de l\'espace visible:'+params.taille_englobe);
						$("#hauteurscrollbar").html('Hauteur du srcoll:'+params.taille_scrollbar);
						$("#hauteurbouton").html('Hauteur du bouton:'+params.taille_bouton);
						$("#topcontenu").html('Top du contenu:'+$('#englobe7').css('top'));
						$("#topbouton").html('Top du bouton:'+$('#bouton7').css('top'));
						$("#topmaxbouton").html('Top max du bouton:'+calcul_contenu_top_max());
						$("#topmaxcontenu").html('Top max du contenu:'+calcul_bouton_top_max());
					}
				}	
			}else{
				//alert('Pas de scrollbar');
			}
        });
	}
})(jQuery);// JavaScript Document