var mapBehavior = function(){
	jQuery('.map-city').hide().show(0); // force redraw to gaurantee placement on window resize
	if (jQuery(window).width()>992){
		jQuery('#map').click(function() {
			jQuery('.point').removeClass('glyphicon-minus').addClass('glyphicon-plus');
			jQuery('.map-city-about').fadeOut('fast');
		});
		jQuery('.point').mouseover(function() {
			if (!jQuery(this).is(jQuery('.glyphicon-minus'))) {
				jQuery('.point').removeClass('glyphicon-minus').addClass('glyphicon-plus');
				jQuery('.map-city-about').fadeOut('fast');
				jQuery(this).siblings('.map-city-about').fadeIn('fast');
				jQuery(this).removeClass('glyphicon-plus').addClass('glyphicon-minus');
			}
		});
	} else {
		jQuery('.point').click(function(){
			jQuery('span.glyphicon.point').removeClass('glyphicon-minus').addClass('glyphicon-plus');
			var cityName = jQuery(this).parent().attr('id');
			var infoCityName = '#info-'+cityName;
			
			if (jQuery(''+infoCityName+'').is(':visible')){
				jQuery(''+infoCityName+'').slideUp('fast',function(){
					jQuery('#'+cityName+' span.glyphicon').removeClass('glyphicon-minus').addClass('glyphicon-plus');
					jQuery('#map-copy').fadeIn('fast');
				});
			} else {
				jQuery('.map-info').contents().hide();
				jQuery(''+infoCityName+'').slideDown('fast');
				jQuery('#'+cityName+' span.glyphicon').removeClass('glyphicon-plus').addClass('glyphicon-minus');
			}
		});
		jQuery('.map-narrow-info span.glyphicon').click(function(){
			jQuery(this).closest('.map-narrow-info').slideUp('fast',function(){
				jQuery('span.glyphicon.point').removeClass('glyphicon-minus').addClass('glyphicon-plus');
				jQuery('#map-copy').fadeIn('fast');
			});
		
		});
	}
};


jQuery(document).ready(function(jQuery) {
	$('.slick-element').slick({dots: true});
	
	//presentational map copy placement on narrow
	var $mapCopy = jQuery('#map-copy');
	var mapCopyHeight = jQuery('#map-copy').height();
	$mapCopy.css({
		'position'	 : 'absolute',
		'top'		 : '50%',
		'margin-top' : -mapCopyHeight/2
	});
	
	jQuery('#featured-events img, .artists-featured-image img').each(function() {
		var image = jQuery(this);
		//console.log(image.attr('src')+" - "+image.width()+" x "+image.height());
		if (image.width() > image.height()) {
			image.addClass('landscape');        
		} else {
			image.addClass('portrait');        
		}
	});
	
	//initial call of mapBehavior()
	mapBehavior();
	
});


jQuery(window).resize(function(){
    if (jQuery(window).width()>992){
	    //artist
	    jQuery('#overflow').css('left', 0);
	    jQuery('#faq-overflow').css('left', 0);
	    
	    //map
	    jQuery('.map-city-about').hide();	    
    }else{
	    //map
	    jQuery('.point').unbind('click');
	    jQuery('.map-narrow-info').hide();
    }
    //resize call on mapBehavior()
	mapBehavior();
});


jQuery(function() {
  jQuery('a[href*=#]:not([href=#])').click(function() {
    if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname && !jQuery(this).hasClass('unmove')) {
      var target = jQuery(this.hash);
      target = target.length ? target : jQuery('[name=' + this.hash.slice(1) +']');
      if (target.length) {
        jQuery('html,body').animate({
          scrollTop: target.offset().top-jQuery('.navbar-top').height()-jQuery('#wpadminbar').height()
        }, 500);
        return false;
      }
    }
  });
});
scrollready = document.body.scrollTop; 

jQuery(window).load(function(){
    // scroll at doc ready is 0 if we have never been here before even though 
    // there is a hash. hash height gets computed at window load
    if(window.location.hash.length>1 && document.body.scrollTop!==scrollready){
        window.scrollTo(0,document.body.scrollTop-jQuery('.navbar-top').height()-jQuery('#wpadminbar').height());
    }
});
