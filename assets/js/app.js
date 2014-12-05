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

// Click Response ==============================================================

	$('.person').on("touchStart click", function(event) {

		var clickDimension = $('.click-response').outerHeight() / 2;
		var topOffset = $(this).offset().top;

		$(this).find('.click-response').css('position', 'absolute').css('top', event.pageY - topOffset - clickDimension).css('left', event.pageX - clickDimension);
		$(this).find('.click-response').addClass('active clicked');
		setTimeout(function() {
			$('.clicked').removeClass('active clicked');
		}, 200);

	});
