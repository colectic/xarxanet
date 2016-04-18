jQuery(document).ready(function() {
    var subdomini = "prova.";

	if ( jQuery.browser.msie ) {

		/* Arregla les columnes dels llistats */ 
		var clearer = '<div style="clear:both;">&nbsp;</div>';
		
		/* Esborra l'opció de redimensionar el textarea de comentaris */
		jQuery('.grippie').remove();

		/* Converteix la llista d'etiquetes en div span per evitar problemes hasLayout IE7 */
		
		var lim = nCols();

		if (lim.px > 0) {
			var list = jQuery('.view-content .views-row');		//console.log(list);
			//console.log(list);
			var nelems = list.length;
			var i= 1;
			//var lim = 4; // 3 elems per fila
			//var lim = nc ; // amplada dels elements
			//console.log('limits');
			//console.log(lim);
			var sumaParcial = {px:0, cols:0};

			//console.log('aaa');
			list.each(function() {
				//console.log('it' + i);
				sumaParcial.px += parseInt( jQuery('.views-row-' + i + ' div a img').attr('width') );
				sumaParcial.cols++;
				//console.log(sumaParcial);
				
				if (sumaParcial.px > lim.px || sumaParcial.cols > lim.cols) {
					jQuery('.views-row-' + parseInt(i-1)).after(clearer);
					sumaParcial.px = 0;
					sumaParcial.cols = 0;
				} else if (sumaParcial.px == lim.px || sumaParcial.cols == lim.cols) {
					jQuery('.views-row-' + i).after(clearer);
					sumaParcial.px = 0;
					sumaParcial.cols = 0;
					}  
				++i;
			});
			
			
		} else {

				// el cas especial d'agafar 2 blocs grans i un clear both entre mig
				if (lim.px == -1) {

				   jQuery('.views-row-3').after(clearer);
				   jQuery('.views-row-6').after(clearer);
				   jQuery('.views-row-last').after(clearer);//.css({backgroundColor: 'red', borderLeft: '1px solid cyan'})
				} else if (lim.px == -2) {

                    jQuery('#portada-cursos').after(clearer);
                    jQuery('.portada-superior-dreta').after(clearer);
				} 
		}
	
	//quatreCols();
	function nCols() {
		var loc = window.location;
		var input = loc.href;// loc.href


		if (input === "http://"+subdomini +"xarxanet.org" || input === "http://"+subdomini +"www.xarxanet.org" 
		   || input === "http://"+subdomini +"xarxanet.org/" || input === "http://"+subdomini +"www.xarxanet.org/") return {px: -1, cols: -1};
		
		if (input === "http://"+subdomini +"xarxanet.org/agenda" || input === "http://"+subdomini +"www.xarxanet.org/agenda" 
		   || input === "http://"+subdomini +"xarxanet.org/agenda/" || input === "http://"+subdomini +"www.xarxanet.org/agenda/") return {px: -2, cols: -2};
		
		var patt = /\/((agenda\/[a-z]|(etiquetes\/[a-z]))(\/|))/i;
		if (patt.test(input)) return {px: 377+179*2, cols: 4};
		   
		// tinc subseccions per recursos i noticies -- 4 cols?
		patt = /\/([a-z]\/(recursos|noticies))|(noticies)/i;
		if (patt.test(input)) return {px: 377+179*2, cols: 4};
	
		
		//if (input == "http://"+subdomini +"xarxanet.org/noticies" || input == "http://www."+ subdomini+"xarxanet.org/noticies/") return {px: 377+179*2, cols: 4};

		// tinc una subsecció sola que ncecessiti 1 clearboth cada 2 grups grans?
		var patt3=/\/(economic$|projectes$|juridic$|formacio$|informatic$|recursos$)(\/|)/i;
		if (patt3.test(input)) return 0; 
		
		return 0;
	}

	
	}
});
