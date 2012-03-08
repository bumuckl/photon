$(document).ready(function(){
	
	//Lightbox Settings
	var lightbox_settings = {
		imageLoading: 	'/photon/img/lightbox-ico-loading.gif',
		imageBtnClose: 	'/photon/img/lightbox-btn-close.gif',
		imageBtnPrev: 	'/photon/img/lightbox-btn-prev.gif',
		imageBtnNext: 	'/photon/img/lightbox-btn-next.gif',
		imageBlank: 	'/photon/img/lightbox-blank.gif',
		txtImage: 		'Image',
		txtOf: 			'of'
	}

	//Add lightbox to any pictures wearing this class
	$('div[id^=gallery] a.big').lightBox(lightbox_settings);
	$('a.single_thumb').lightBox(lightbox_settings);
	$('a.slider').lightBox(lightbox_settings);
	$('#slider li a').lightBox(lightbox_settings);
	
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
