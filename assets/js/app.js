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

	function setHeaderMargin(){
		var headerHeight = $('header').outerHeight();

		$('.person').first().css('margin-top', headerHeight + 'px');
	}

	setHeaderMargin();

	$(window).on('resize', setHeaderMargin);

// Click Response ==============================================================

	$('.person').on("touchend click", function(event) {

		var clickDimension = $('.click-response').outerHeight() / 2;
		var topOffset = $(this).offset().top;

		$(this).find('.click-response').css('position', 'absolute').css('top', event.pageY - topOffset - clickDimension).css('left', event.pageX - clickDimension);

		setTimeout(function() {
			$('.clicked').removeClass('active clicked');
		}, 200);

		$.ajax({
			url: 'functions.php',
			type: 'GET',
			data: {action: 'changeStatus', userid: $(this).data('userid'), dir: ($(this).hasClass('active') ? 'in' : 'out')}
		}).done(function(msg) {
			console.log(msg);
		});

		$(this).find('.click-response').addClass('active clicked');

	});

/*window.addEventListener('load', function() {
    new FastClick(document.body);
}, false);*/
