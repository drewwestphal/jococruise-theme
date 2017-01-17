// JavaScript included on every theme page
// Code for single pages included in Twig templates

jQuery(document).ready(function() {
	jQuery('.slick-element').slick({dots: true, focusOnSelect: false});

    // Assign circle images landscape/portrain classes to ensure they fill the cirle
	jQuery('#featured-events img, .artists-featured-image img').each(function() {
		var image = jQuery(this);
		//console.log(image.attr('src')+" - "+image.width()+" x "+image.height());
		if (image.width() > image.height()) {
			image.addClass('landscape');        
		} else {
			image.addClass('portrait');        
		}
	});
});


// Scroll to hash behavior
jQuery(function() {
    if (!on_forums_page) {
        jQuery('a[href*=\\#]:not([href=\\#])').click(function () {
            if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname && !jQuery(this).hasClass('unmove')) {
                var target = jQuery(this.hash);
                target = target.length ? target : jQuery('[name=' + this.hash.slice(1) + ']');
                if (target.length) {
                    jQuery('html,body').animate({
                        scrollTop: target.offset().top - jQuery('.navbar-top').height() - jQuery('#wpadminbar').height()
                    }, 500);
                    return false;
                }
            }
        });
    }
});
scrollready = document.body.scrollTop;

jQuery(window).on('load', function(){
    // scroll at doc ready is 0 if we have never been here before even though 
    // there is a hash. hash height gets computed at window load
    if(window.location.hash.length>1 && document.body.scrollTop!==scrollready){
        window.scrollTo(0,document.body.scrollTop-jQuery('.navbar-fixed-top').height()-jQuery('#wpadminbar').height());
    }
});

// open external links in new tab
jQuery('#wrapper').find('a').filter(function() {
    return this.hostname && this.hostname.indexOf(location.hostname)===-1
}).attr({
    target : "_blank"
});