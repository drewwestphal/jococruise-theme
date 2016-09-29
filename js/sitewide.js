// JavaScript included on every theme page
// Code for single pages included in Twig templates

$(document).ready(function() {
	$('.slick-element').slick({dots: true, focusOnSelect: false});

    // Assign circle images landscape/portrain classes to ensure they fill the cirle
	$('#featured-events img, .artists-featured-image img').each(function() {
		var image = $(this);
		//console.log(image.attr('src')+" - "+image.width()+" x "+image.height());
		if (image.width() > image.height()) {
			image.addClass('landscape');        
		} else {
			image.addClass('portrait');        
		}
	});
});

// Scroll to hash behavior
$(function() {
  $('a[href*=\\#]:not([href=\\#])').click(function() {
    if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname && !$(this).hasClass('unmove')) {
      var target = $(this.hash);
      target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
      if (target.length) {
        $('html,body').animate({
          scrollTop: target.offset().top-$('.navbar-top').height()-$('#wpadminbar').height()
        }, 500);
        return false;
      }
    }
  });
});
scrollready = document.body.scrollTop; 

$(window).on('load', function(){
    // scroll at doc ready is 0 if we have never been here before even though 
    // there is a hash. hash height gets computed at window load
    if(window.location.hash.length>1 && document.body.scrollTop!==scrollready){
        window.scrollTo(0,document.body.scrollTop-$('.navbar-fixed-top').height()-$('#wpadminbar').height());
    }
});

// open external links in new tab
$('#wrapper').find('a').filter(function() {
    return this.hostname && this.hostname.indexOf(location.hostname)===-1
}).attr({
    target : "_blank"
});