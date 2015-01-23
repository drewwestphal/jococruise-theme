jQuery(document).ready(function(jQuery) {
	//hero
	jQuery('#hero-more-info-button').click(function(){
		jQuery('#hero-more-info-button span').toggleClass('rotate');
		jQuery('#hero-travel-description_narrow').toggleClass('hidden');
	});
	
	//news
	var newsCount = jQuery('#news-cell a').length;
	var newsPosition = 1;
	var newsMove = function(){
		jQuery('#news-cell').css('left', -newsPosition+'00%');	
	};
	jQuery('.news-nav').click(function(){
		var newsSpanPosition = jQuery('.news-nav').index(this);
		if (newsSpanPosition > 0){
			newsPosition++;
			if (newsPosition > newsCount) {
				jQuery('#news-cell').css('left', 0);
				newsPosition=1;
			} else {
				jQuery('#news-cell').css('left', -((newsPosition-1)*100)+'%');
			}
		} else {
			newsPosition--;
			if (newsPosition < 1) {
				jQuery('#news-cell').css('left', -((newsCount-1)*100)+'%');
				newsPosition=newsCount;
			} else {
				jQuery('#news-cell').css('left', -((newsPosition-1)*100)+'%');
			}
		}
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
	    position = jQuery(this).index();
	    var adjusted = -(position-1)*100;
        jQuery('#overflow').css('left', adjusted+'%');
        jQuery('#artist-carousel a').removeClass('orange-text');
        jQuery(this).addClass('orange-text');
        
	    event.preventDefault();
    });
    jQuery('#artist-carousel span').click(function(){
	    var overflowWidth = jQuery('#overflow').width();
	    var overflowLeft = jQuery('#overflow').css('left');
	    var windowWidth = jQuery(window).width();
	    var spanPosition = jQuery(this).index();
	    var orange = function(){
		    jQuery('#artist-carousel a').removeClass('orange-text');
		    jQuery('#artist-carousel a:nth-child('+(position+1)+')').addClass('orange-text');
	    };
		
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
	});
    
    
    //faq small
    var faqCount = jQuery('#faq-overflow .faq-item-container').length;
	faqPosition = 0;
	jQuery('.faq-carousel a').click(function(event){
	    faqPosition = jQuery(this).index();
	    var faqAdjusted = -(faqPosition-1)*100;
        jQuery('#faq-overflow').css('left', faqAdjusted+'%');
        jQuery('#faq-carousel-small a').removeClass('orange-text');
        jQuery(this).addClass('orange-text');
        
	    event.preventDefault();
    });
    jQuery('#faq-carousel-small span').click(function(){
	    var faqOverflowWidth = jQuery('#faq-overflow').width();
	    var faqOverflowLeft = jQuery('#faq-overflow').css('left');
	    var faqWindowWidth = jQuery(window).width();
	    var faqSpanPosition = jQuery(this).index();
	    var faqOrange = function(){
		    jQuery('#faq-carousel-small a').removeClass('orange-text');
		    jQuery('#faq-carousel-small a:nth-child('+(faqPosition+1)+')').addClass('orange-text');
	    };
		
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
	jQuery('#faq-carousel-wide span').click(function(){
	    var faqOverflowWidth = jQuery('#faq-overflow').width();
	    var faqOverflowLeft = jQuery('#faq-overflow').css('left');
	    var faqWindowWidth = jQuery(window).width();
	    var faqSpanPosition = jQuery(this).index();
	    var faqOrange = function(){
		    jQuery('#faq-carousel-wide a').removeClass('orange-text');
		    jQuery('#faq-carousel-wide a:nth-child('+(faqWidePosition+1)+')').addClass('orange-text');
	    };
		
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
	});
	
	//smooth scroll
	jQuery(function() {
	  jQuery('a[href*=#]:not([href=#])').click(function() {
	    if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
          var target_hash = this.hash;
          var target = jQuery(this.hash);
	      target = target.length ? target : jQuery('[name=' + this.hash.slice(1) +']');
	      if (target.length) {
	        jQuery('html,body').animate({
	          scrollTop: target.offset().top-jQuery('.navbar-nav').height()-jQuery('#wpadminbar').height()
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
});
jQuery(window).load(function(){
    // scroll at doc ready is 0 if we have never been here before even though 
    // there is a hash. hash height gets computed at window load
    if(window.location.hash.length>1 && document.body.scrollTop!==scrollready){
        window.scrollTo(0,document.body.scrollTop-jQuery('.navbar-nav').height()-jQuery('#wpadminbar').height());
    }
});

jQuery(window).resize(function(){
	//artist
    if (jQuery(window).width()>767){
	    jQuery('#overflow').css('left', 0);
	    jQuery('#faq-overflow').css('left', 0);
    }
});