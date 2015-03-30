(function($){ 

$('#contact-form').submit(function(){
	function validateEmail($email) {
		var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
		if( !emailReg.test( $email ) ) {
			return false;
		} else {
			return true;
		}
	}
	
	$('.contact-input p, .contact-comments p').remove();
	$('#name,#email,#comments').removeClass('orange-border');
	var name = false;
	var email = false;
	var comments = false;
	
	if ($('#comments').val().length == 0)  {
		$('#comments').addClass('orange-border');
		$('#comments').focus();
		$('#contact-comments').append('<p class="plain-text">Please enter your message.</p>');
		comments = false;
	} else {
		comments = true;
	}
	
	if ($('#name').val().length == 0)  {
		$('#name').addClass('orange-border');
		$('#name').focus();
		$('#contact-input-name').append('<p class="plain-text">Please enter your name.</p>');
		name = false;
	} else {
		name = true;
	}
	
	var emailString = $('#email').val();
	if ((emailString.length == 0) || !validateEmail(emailString)) {
		$('#email').addClass('orange-border');
		$('#email').focus();
		$('#contact-input-email').append('<p class="plain-text">Please enter a valid email address.</p>');
		email = false;
	} else {
		email = true;
	}
	
	
	if (name && email && comments) {
		$.post(js_contact_data.contact_post_url, $("#contact-form").serialize(),function(data){console.log(data);});
		$('#name, #email').removeClass('orange-border');
		$('#contact button').after('<div id="contact-received">Thank you! Your message has been sent.</div>');
	}
	
	return false; 

});

})(jQuery);