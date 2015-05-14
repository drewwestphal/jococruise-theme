var mapBehavior = function(){
	jQuery('.map-city').hide().show(0); // force redraw to gaurantee placement on window resize
	if (jQuery(window).width()>767){
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
		//.mouseleave(function() {
			//jQuery(this).siblings('.map-city-about').fadeOut('fast');
			//jQuery(this).removeClass('glyphicon-minus').addClass('glyphicon-plus');
		//});
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
	//hero
	jQuery('#hero-more-info-button').click(function(){
		jQuery('#hero-more-info-button span').toggleClass('rotate');
		jQuery('#hero-travel-description_narrow').toggleClass('hidden');
	});
	
	//news
	jQuery('#news-items').css('left', 0);
	var newsCount = jQuery('#news-carousel a').length;
	var newsPosition = 1;
    jQuery('#news-carousel a').click(function(event){
		event.preventDefault();
		
	    newsPosition = jQuery(this).index();
	    var adjusted = -(newsPosition-1)*100;
        jQuery('#news-items').css('left', adjusted+'%');
        jQuery('#news-carousel a').removeClass('orange-text');
        jQuery(this).addClass('orange-text');
    });
    var newsOrange = function(){
	    jQuery('#news-carousel a').removeClass('orange-text');
	    jQuery('#news-carousel a:nth-child('+(newsPosition+1)+')').addClass('orange-text');
    };
    var updateNewsPosition = function(spanNewsPosition,windowWidth,newsOverflowLeft,newsOverflowWidth) {
    	if (spanNewsPosition > 0){
			newsPosition++;
			if (newsPosition > newsCount) {
				jQuery('#news-items').css('left', 0);
				newsPosition=1;
				newsOrange();
			} else {
				jQuery('#news-items').css('left', -((newsPosition-1)*100)+'%');
				newsOrange();
			}
		} else {
			newsPosition--;
			if (newsPosition < 1) {
				jQuery('#news-items').css('left', -((newsCount-1)*100)+'%');
				newsPosition=newsCount;
				newsOrange();
			} else {
				jQuery('#news-items').css('left', -((newsPosition-1)*100)+'%');
				newsOrange();
			}
		}
    };
    jQuery('#news-carousel span').click(function(){
	    var newsOverflowWidth = jQuery('#news-items').width();
	    var newsOverflowLeft = jQuery('#news-items').css('left');
	    var windowWidth = jQuery(window).width();
	    var spanNewsPosition = jQuery(this).index();
	    updateNewsPosition(spanNewsPosition,windowWidth,newsOverflowLeft,newsOverflowWidth);
	});
    jQuery('#news, #featured-events').on('swipeleft',function() {
	    var newsOverflowWidth = jQuery('#news-items').width();
	    var newsOverflowLeft = jQuery('#news-items').css('left');
	    var windowWidth = jQuery(window).width();
	    var spanNewsPosition = 1;
	    updateNewsPosition(spanNewsPosition,windowWidth,newsOverflowLeft,newsOverflowWidth);
	});
    jQuery('#news, #featured-events').on('swiperight',function() {
	    var newsOverflowWidth = jQuery('#news-items').width();
	    var newsOverflowLeft = jQuery('#news-items').css('left');
	    var windowWidth = jQuery(window).width();
	    var spanNewsPosition = 0;
	    updateNewsPosition(spanNewsPosition,windowWidth,newsOverflowLeft,newsOverflowWidth);
	});
		
	//artist
	jQuery('.artist-more-info-button').click(function(){
		jQuery('.artist-more-info-button span').toggleClass('rotate');
		jQuery('.artists-description').toggleClass('nope');
	});
	
	jQuery('#overflow').css('left', 0);
	var count = jQuery('#artist-carousel a').length;
	var position = 1;
    jQuery('#artist-carousel a').click(function(event){
		event.preventDefault();
		
	    position = jQuery(this).index();
	    var adjusted = -(position-1)*100;
        jQuery('#overflow').css('left', adjusted+'%');
        jQuery('#artist-carousel a').removeClass('orange-text');
        jQuery(this).addClass('orange-text');
    });
    var orange = function(){
	    jQuery('#artist-carousel a').removeClass('orange-text');
	    jQuery('#artist-carousel a:nth-child('+(position+1)+')').addClass('orange-text');
    };
    var updateArtistPosition = function(overflowWidth,overflowLeft,windowWidth,spanPosition) {
    	if (spanPosition > 0){
			position++;
			if (position > count) {
				jQuery('#overflow').css('left', 0);
				position=1;
				orange();
			} else {
				jQuery('#overflow').css('left', -((position-1)*100)+'%');
				orange();
			}
		} else {
			position--;
			if (position < 1) {
				jQuery('#overflow').css('left', -((count-1)*100)+'%');
				position=count;
				orange();
			} else {
				jQuery('#overflow').css('left', -((position-1)*100)+'%');
				orange();
			}
		}
    };
    jQuery('#artist-carousel span').click(function(){
	    var overflowWidth = jQuery('#overflow').width();
	    var overflowLeft = jQuery('#overflow').css('left');
	    var windowWidth = jQuery(window).width();
	    var spanPosition = jQuery(this).index();
	    updateArtistPosition(overflowWidth,overflowLeft,windowWidth,spanPosition);
	});
	jQuery('#artists').on('swipeleft',function() {
		var overflowWidth = jQuery('#overflow').width();
	    var overflowLeft = jQuery('#overflow').css('left');
	    var windowWidth = jQuery(window).width();
	    var spanPosition = 1;
	    if (windowWidth<767) {
		    updateArtistPosition(overflowWidth,overflowLeft,windowWidth,spanPosition);
		}
	});
	jQuery('#artists').on('swiperight',function() {
		var overflowWidth = jQuery('#overflow').width();
	    var overflowLeft = jQuery('#overflow').css('left');
	    var windowWidth = jQuery(window).width();
	    var spanPosition = 0;
	    if (windowWidth<767) {
		    updateArtistPosition(overflowWidth,overflowLeft,windowWidth,spanPosition);
		}
	});
    
    
    // faq
    var faqOrange = function(){
    	if (jQuery(window).width() < 767) {
		    jQuery('#faq-carousel-small a').removeClass('orange-text');
		    jQuery('#faq-carousel-small a:nth-child('+(faqPosition+1)+')').addClass('orange-text');
		} else {
			jQuery('#faq-carousel-wide a').removeClass('orange-text');
		    jQuery('#faq-carousel-wide a:nth-child('+(faqWidePosition+1)+')').addClass('orange-text');
		}
    };
    
    //faq small
    var faqCount = jQuery('#faq-overflow .faq-item-container').length;
	faqPosition = 1;
	jQuery('.faq-carousel a').click(function(event){
	    faqPosition = jQuery(this).index();
	    var faqAdjusted = -(faqPosition-1)*100;
        jQuery('#faq-overflow').css('left', faqAdjusted+'%');
        jQuery('#faq-carousel-small a').removeClass('orange-text');
        jQuery(this).addClass('orange-text');
        
	    event.preventDefault();
    });
    var updateSmallFaqPosition = function(faqCount,faqSpanPosition,faqWindowWidth,faqOverflowLeft,faqOverflowWidth) {
    	if (faqSpanPosition > 0){
			faqPosition++;
			if (faqPosition > faqCount) {
				jQuery('#faq-overflow').css('left', 0);
				faqPosition=1;
				faqOrange();
			} else {
				jQuery('#faq-overflow').css('left', -((faqPosition-1)*100)+'%');
				faqOrange();
			}
		} else {
			faqPosition--;
			if (faqPosition < 1) {
				jQuery('#faq-overflow').css('left', -((faqCount-1)*100)+'%');
				faqPosition=faqCount;
				faqOrange();
			} else {
				jQuery('#faq-overflow').css('left', -((faqPosition-1)*100)+'%');
				faqOrange();
			}
		}
    };
    jQuery('#faq-carousel-small span').click(function(){
	    var faqOverflowWidth = jQuery('#faq-overflow').width();
	    var faqOverflowLeft = jQuery('#faq-overflow').css('left');
	    var faqWindowWidth = jQuery(window).width();
	    var faqSpanPosition = jQuery(this).index();
	    updateSmallFaqPosition(faqCount,faqSpanPosition,faqWindowWidth,faqOverflowLeft,faqOverflowWidth);
	});
	jQuery('#faq').on('swipeleft',function() {
		var faqOverflowWidth = jQuery('#faq-overflow').width();
	    var faqOverflowLeft = jQuery('#faq-overflow').css('left');
	    var faqWindowWidth = jQuery(window).width();
	    //var faqSpanPosition = jQuery(this).index();
	    if (faqWindowWidth<767) {
		    updateSmallFaqPosition(faqCount,1,faqWindowWidth,faqOverflowLeft,faqOverflowWidth);
		} else {
			updateWideFaqPosition(faqCount,1,faqWindowWidth,faqOverflowLeft,faqOverflowWidth);
		}
	});
	jQuery('#faq').on('swiperight',function() {
		var faqOverflowWidth = jQuery('#faq-overflow').width();
	    var faqOverflowLeft = jQuery('#faq-overflow').css('left');
	    var faqWindowWidth = jQuery(window).width();
	    //var faqSpanPosition = jQuery(this).index();
	    if (faqWindowWidth<767) {
		    updateSmallFaqPosition(faqCount,0,faqWindowWidth,faqOverflowLeft,faqOverflowWidth);
		} else {
			updateWideFaqPosition(faqCount,0,faqWindowWidth,faqOverflowLeft,faqOverflowWidth);
		}
	});
	//faq wide
    var faqWideCount = jQuery('#faq-overflow .faq-group').length;
	faqWidePosition = 1;
	jQuery('.faq-carousel a').click(function(event){
	    faqWidePosition = jQuery(this).index();
	    var faqAdjusted = -(faqWidePosition-1)*100;
        jQuery('#faq-overflow').css('left', faqAdjusted+'%');
        jQuery('#faq-carousel-wide a').removeClass('orange-text');
        jQuery(this).addClass('orange-text');        
	    event.preventDefault();
    });
    var updateWideFaqPosition = function(faqWideCount,faqSpanPosition,faqWindowWidth,faqOverflowLeft,faqOverflowWidth) {
    	if (faqSpanPosition > 0){
			faqWidePosition++;
			if (faqWidePosition > faqWideCount) {
				jQuery('#faq-overflow').css('left', 0);
				faqWidePosition=1;
				faqOrange();
			} else {
				jQuery('#faq-overflow').css('left', -((faqWidePosition-1)*100)+'%');
				faqOrange();
			}
		} else {
			faqWidePosition--;
			if (faqWidePosition < 1) {
				jQuery('#faq-overflow').css('left', -((faqWideCount-1)*100)+'%');
				faqWidePosition=faqWideCount;
				faqOrange();
			} else {
				jQuery('#faq-overflow').css('left', -((faqWidePosition-1)*100)+'%');
				faqOrange();
			}
		}
    };
	jQuery('#faq-carousel-wide span').click(function(){
	    var faqOverflowWidth = jQuery('#faq-overflow').width();
	    var faqOverflowLeft = jQuery('#faq-overflow').css('left');
	    var faqWindowWidth = jQuery(window).width();
	    var faqSpanPosition = jQuery(this).index();
	    updateWideFaqPosition(faqWideCount,faqSpanPosition,faqWindowWidth,faqOverflowLeft,faqOverflowWidth);
	});
	
	//menu swap behavior
	if (jQuery('#navbar-title-headline').length){
		var offset = jQuery('#news').offset();
		if (jQuery(document).scrollTop() > offset.top) {
			jQuery('#navbar-title-headline').hide(function(){
				jQuery('#navbar-title').fadeIn('slow',function(){
					jQuery('#nav-arrow-to-top').fadeIn('slow');
				});
			});
			var toggled = true;	
		} else {
			var toggled = false;	
		}
		jQuery(document).scroll(function(){
			if ((jQuery(document).scrollTop() > offset.top) && (!toggled)) {
				jQuery('#navbar-title-headline').fadeOut('slow',function(){
					jQuery('#navbar-title').fadeIn('slow',function(){
						jQuery('#nav-arrow-to-top').fadeIn('slow');
					});
				});
				toggled = true;
			} else if ((jQuery(document).scrollTop() < offset.top)  && (toggled)) {
				jQuery('#nav-arrow-to-top').fadeOut('slow');
				jQuery('#navbar-title').fadeOut('slow',function(){
					jQuery('#navbar-title-headline').fadeIn('slow');
				});
				toggled = false;
			}
		});
	}	

	jQuery(document).click(function(e){
	    if ((jQuery(e.target).closest("#nav-dropdown").length > 0) || (jQuery(e.target).closest('#nav-button').length > 0)) {
	        
	    } else if (jQuery('.navbar-collapse').hasClass('in')){
		    jQuery('#nav-button-inner').click();
	    }
	});
	
	//presentational move of the carousel to avoid rewriting and making messy DB calls
	//JS disabled people will see carousel after (still looks nice, just doesn't match comp)
	jQuery('#artist-carousel').insertAfter(jQuery('#artists-header'));
	jQuery('#artist-carousel span').addClass('js-positioned');
	
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
	
	gallery_spacing_adjust();
	//jQuery('.gallery-item').css('height',100);
	//jQuery('.gallery-item').addClass('testing!');
	
	//initial call of mapBehavior()
	mapBehavior();
	
});

function gallery_spacing_adjust() {
	var box_height = jQuery('#gallery-experience').outerHeight() - jQuery('.gallery-bull:first').innerHeight();
	jQuery('.gallery-item').css('height', box_height);
	jQuery('#gallery-experience img').each(function() {
		var image = jQuery(this);
		var img_height = image.height();
		//console.log(jQuery(this).attr('src')+" - "+img_height);
		if (img_height > 0) {
			jQuery(this).css("margin-top", (box_height-img_height)/2 + 20);
		}
	});
}

jQuery(window).resize(function(){
	gallery_spacing_adjust();
    if (jQuery(window).width()>767){
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



/*
//smooth scroll
jQuery(function() {
  jQuery('a[href*=#]:not([href=#])').click(function() {
    if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
      var target_hash = this.hash;
      var target = jQuery(this.hash);
      target = target.length ? target : jQuery('[name=' + this.hash.slice(1) +']');
      if (target.length) {
        jQuery('html,body').animate({
          scrollTop: target.offset().top-jQuery('.navbar-top').height()-jQuery('#wpadminbar').height()
        }, 500);
        // set hash when the time is right
        // http://stackoverflow.com/questions/3870057/how-can-i-update-window-location-hash-without-jumping-the-document
        // no workaround for older browsers.
        history.pushState(null, null, this.hash);
        
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
*/


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
