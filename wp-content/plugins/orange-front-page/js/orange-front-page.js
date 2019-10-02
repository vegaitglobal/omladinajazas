jQuery(function($) { 

	jQuery('#portfolio .ot-portfolio-item').on('click', function() {
		jQuery("."+jQuery(this).data('id')).slideDown(300).addClass('in');
		jQuery('body').addClass('modal-open');
		jQuery('body').append('<div class="modal-backdrop in"></div>');

	});


	jQuery('#portfolio .modal .close').on('click', function() {
		jQuery(this).closest('.modal').slideUp().removeClass('in');
		jQuery('body').removeClass('modal-open');
		jQuery('body').find('.modal-backdrop').remove();
	});

	$('.testimonials-slider').slick({
		autoplay: false,
		autoplaySpeed: 2000,
		dots: true,
		arrows: false,
	});
	$('.stats-bar').appear();

	$('.stats-bar').on('appear', function() {
		
		var fx = function fx() {

			$(".stat-number").each(function (i, el) {
					var data = parseInt(this.dataset.n, 10);
					var props = {
						"from": {
						"count": 0
					},
						"to": {
						"count": data
					}
				};
				$(props.from).animate(props.to, {
					duration: 1000 * 1,
					step: function (now, fx) {
						$(el).text(Math.ceil(now));
					},
					complete:function() {
					if (el.dataset.sym !== undefined) {
							el.textContent = el.textContent.concat(el.dataset.sym)
						}
					}
				});
			});
			

		};

		var reset = function reset() {
	        if (typeof executed == 'undefined') {
				executed = true;
				if ($(this).scrollTop() > 90) {
					
					fx()
				}
			}
		};

		$(window).on("scroll", reset);
	});

});
