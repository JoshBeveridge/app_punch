// Foundation JavaScript
// Documentation can be found at: http://foundation.zurb.com/docs
$(document).foundation();

// OnClick =====================================================================

	$('.person').click(function() {

		if($(this).hasClass('active')) {
			$(this).removeClass('active');
		}
		else {
			$(this).addClass('active');
		}

	});

// Applying header height to firstName margin-top ==============================

	var headerHeight = $('header').outerHeight();

	$('#firstPerson').css('margin-top', headerHeight + 'px');
