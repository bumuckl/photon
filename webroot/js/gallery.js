$(document).ready(function(){

	//Add lightbox to any pictures wearing this class
	$('div[id^=gallery] a.big').lightBox();
	$('a.single_thumb').lightBox();
	$('a.slider').lightBox();
	$('#slider li a').lightBox();
	
	//Image replacement Gallery for #gallery
	$("div[class^=gallery] a.thumb").click(function(){
		event.preventDefault();
		var gallery_id = parseInt($(this).closest("div").attr("class").replace("gallery", ""));
		var largePath = $(this).attr("href");
		var largeAlt = $(this).attr("title");
		
		$(".gallery" + gallery_id + " a.big img").hide();
		
		$(".gallery" + gallery_id + " a.big img").attr({ src: largePath, alt: largeAlt });
		$(".gallery" + gallery_id + " a.big").attr({ href: largePath, title: largeAlt });
		
		$(".gallery" + gallery_id + " a.big img").fadeIn("slow");
	});
	
	//PopEye
	$('div[class^=popeye]').popeye();
	
	//nivoSlider
	$('div[class^=slider]').easySlider( {
		continuous: true
	});
	$('#slider li').css('width', $('#slider').css('width'));
	
});
