(function($){
	"use strict";

	// Dump die
    function dd(...args) {
        args.forEach( arg => {
            console.log(arg);
        });
    } // END func

	// Login & register forms
	$('.ova-my-account-button a').on( 'click', function() {
		const type = $(this).data('type');

		// Remove active class
		$('.ova-login-register-woo').find('li').removeClass('active');

		// Add active class
		$('.ova-login-register-woo').find('a[data-type="'+type+'"]').closest('li').addClass('active');

		// Show form
		if ( 'login' === type ) {
			$('.woocommerce #customer_login .woocommerce-form.woocommerce-form-login').css('display', 'block');
			$('.woocommerce #customer_login .woocommerce-form.woocommerce-form-register').css('display', 'none');
		} else if( type === 'register' ){
			$('.woocommerce #customer_login .woocommerce-form.woocommerce-form-register').css('display', 'block');
			$('.woocommerce #customer_login .woocommerce-form.woocommerce-form-login').css('display', 'none');
		}
	});

	$('.ova-login-register-woo').each( function() {
		// Switch forms
		$(this).find('li a').on( 'click', function() {
			const type = $(this).data('type');

			// Remove active class
			$(this).closest('.ova-login-register-woo').find('li').removeClass('active');

			// Add active class
			$(this).closest('li').addClass('active');

			// Show form
			if ( 'login' === type ) {
				$('.woocommerce #customer_login .woocommerce-form.woocommerce-form-login').css('display', 'block');
				$('.woocommerce #customer_login .woocommerce-form.woocommerce-form-register').css('display', 'none');
			} else if( type === 'register' ){
				$('.woocommerce #customer_login .woocommerce-form.woocommerce-form-register').css('display', 'block');
				$('.woocommerce #customer_login .woocommerce-form.woocommerce-form-login').css('display', 'none');
			}
		}); // END click

		// Get current URL
		if ( window.location.href.indexOf('#register') !== -1 ) {
			$(this).find('a[data-type="register"]').click();
		} else if ( window.location.href.indexOf('#login') !== -1 ) {
			$(this).find('a[data-type="login"]').click();
		}
	}); // END login & register form

	// URL change
	$(window).on('hashchange', function() {
	    if ( window.location.href.indexOf('#register') !== -1 ) {
			$('.ova-login-register-woo a[data-type="register"]').click();
		} else if ( window.location.href.indexOf('#login') !== -1 ) {
			$('.ova-login-register-woo a[data-type="login"]').click();
		}
	});

	/* Video & Gallery */
	$('.ova-video-gallery').each( function() {
    	var that = $(this);

    	// Video
    	var btn_video 		= that.find('.btn-video');
    	var video_container = that.find('.video-container');
    	var modal_close 	= that.find('.ovaicon-cancel');
    	var modal_video 	= that.find('.modal-video');

    	// btn video click
    	btn_video.on( 'click', function() {
    		var url 		= get_url( $(this).data('src') );
    		var controls 	= $(this).data('controls');
    		var option		= '?';
    		option += ( 'yes' == controls.autoplay ) ? 'autoplay=1' 	: 'autoplay=0';
    		option += ( 'yes' == controls.mute ) 	? '&mute=1' 	: '&mute=0';
    		option += ( 'yes' == controls.loop ) 	? '&loop=1' 	: '&loop=0';
    		option += ( 'yes' == controls.controls ) ? '&controls=1' : '&controls=0';
    		option += ( 'yes' == controls.rel ) 		? '&rel=1' 		: '&rel=0';
    		option += ( 'yes' == controls.modest ) 	? '&modestbranding=1' : '&modestbranding=0';

    		if ( url != 'error' ) {
    			option += '&playlist='+url;
    			modal_video.attr('src', "https://www.youtube.com/embed/" + url + option );
    			video_container.css('display', 'flex');
    		}
    	});

    	// close video
    	modal_close.on('click', function() {
    		video_container.hide();
    		modal_video.removeAttr('src');
    	});

    	// window click
    	$(window).click( function(e) {
    		if ( e.target.className == 'video-container' ) {
    			video_container.hide();
    			modal_video.removeAttr('src');
    		}
		});

		// Gallery
		var btn_gallery = that.find('.btn-gallery');

        btn_gallery.on('click', function(){
        	var gallery_data = $(this).data('gallery');
            Fancybox.show(gallery_data, {
            	Image: {
				    Panzoom: {
				      	zoomFriction: 0.7,
				      	maxScale: function () {
				        	return 3;
				      	},
				    },
			  	},
			});
        });
    });

	function get_url( url ) {
	    var regExp = /^.*(youtu.be\/|v\/|u\/\w\/|embed\/|watch\?v=|\&v=)([^#\&\?]*).*/;
	    var match = url.match(regExp);

	    if (match && match[2].length == 11) {
	        return match[2];
	    } else {
	        return 'error';
	    }
	}

	/* Gallery Slideshow */
	$('.ova-gallery-slideshow').each( function() {
		var that 	= $(this);
		var options = that.data('options') ? that.data('options') : {};

		var responsive_value = {
            0:{
                items:1,
                nav:false,
          		slideBy: 1,
            },
            768:{
              	items: 2,
              	slideBy: 1,
            },
            1025:{
              	items: 3,
              	slideBy: 1,
            },
            1300:{
              	items: options.items,
            }
        };
        
        that.owlCarousel({
        	autoWidth: options.autoWidth,
			margin: options.margin,
			items: options.items,
			loop: options.loop,
			autoplay: options.autoplay,
			autoplayTimeout: options.autoplayTimeout,
			center: options.center,
			lazyLoad: options.lazyLoad,
			nav: options.nav,
			dots: options.dots,
			autoplayHoverPause: options.autoplayHoverPause,
			slideBy: options.slideBy,
			smartSpeed: options.smartSpeed,
			rtl: options.rtl,
			navText:[
	          	'<i aria-hidden="true" class="'+ options.nav_left +'"></i>',
	          	'<i aria-hidden="true" class="'+ options.nav_right +'"></i>'
	        ],
			responsive: responsive_value,
        });

        that.find('.gallery-fancybox').off('click').on('click', function() {
			var index = $(this).data('index');
			var gallery_data = $(this).closest('.ova-gallery-popup').find('.ova-data-gallery').data('gallery');

			Fancybox.show(gallery_data, {
            	Image: {
				    Panzoom: {
				      	zoomFriction: 0.7,
				      	maxScale: function () {
				        	return 3;
				      	},
				    },
			  	},
			  	startIndex: index,
			});
		});
	});

	/* Forms */
	$('.ova-forms-product').each( function() {
		var that = $(this);
		var item = that.find('.tabs .item');

		// Loading
		if ( item.length > 0 ) {
			// Hide all forms
			that.find('.ovabrw-product-form').hide();

			item.each( function( index ) {
			  	if ( index == 0 ) {
			  		$(this).addClass('active');
			  		var id = $(this).data('id');
			  		$(id).show();
			  	}
			});
		}

		// Click
		item.on( 'click', function() {
			// Remove all 'active' class
			item.removeClass('active');

			// Add 'active' class
			$(this).addClass('active');

			// Hide all forms
			that.find('.ovabrw-product-form').hide();

			// Get id
			var id = $(this).data('id');
			
			// Show form
			$(id).show();
		});
	});

	/* Tabs */
	$('.ova-tabs-product').each( function() {
		var that = $(this);
		var item = that.find('.tabs .item');

		if ( item.length > 0 ) {
			item.each( function( index ) {
			  	if ( index == 0 ) {
			  		$(this).addClass('active');
			  		var id = $(this).data('id');
			  		$(id).show();
			  	}
			});
		}

		item.on('click', function() {
			item.removeClass('active');
			$(this).addClass('active');
			var id = $(this).data('id');

			if ( id == '#tour-description' ) {
				that.find('#tour-included-excluded, #tour-plan, #ova-tour-map, #ova-tour-review ').hide();
			}

			if ( id == '#tour-included-excluded' ) {
				that.find('#tour-description, #tour-plan, #ova-tour-map, #ova-tour-review ').hide();
			}

			if ( id == '#tour-plan' ) {
				that.find('#tour-included-excluded, #tour-description, #ova-tour-map, #ova-tour-review ').hide();
			}

			if ( id == '#ova-tour-map' ) {
				that.find('#tour-included-excluded, #tour-plan, #tour-description, #ova-tour-review ').hide();
			}

			if ( id == '#ova-tour-review' ) {
				that.find('#tour-included-excluded, #tour-plan, #ova-tour-map, #tour-description ').hide();
			}
			
			$(id).show();
		});
	});

	/* Tour Plan Toggled */
	$('.ova-content-single-product .item-tour-plan').each( function() {

		var that = $(this);
		var item = that.find('.tour-plan-title');

		item.on('click', function() {
			$(this).closest('.item-tour-plan').toggleClass('active');
			// change icon
        	if ( that.hasClass('active') ) {
        		$(this).find('i').removeClass('icomoon-chevron-down');
        		$(this).find('i').addClass('icomoon-chevron-up');
        	} else {
        		$(this).find('i').removeClass('icomoon-chevron-up');
        		$(this).find('i').addClass('icomoon-chevron-down');
        	}
		});

	});

	// Tour Location
	$('.tripgo-tour-map').each( async function() {
        // Get google loaded
        const googleLoaded = await ovabrwGoogleLoaded();

        // That
        var that = $(this);

        // Map data
        var mapData = that.find('input[name="ovabrw-map-data"]');
        
        // Address
        var address = mapData.val();

        // Latitude
        var latitude = mapData.data('latitude');

        // Longitude
        var longitude = mapData.data('longitude');

        // Zoom
        var zoom = mapData.data('zoom');
        if ( !zoom ) zoom = 17;
        
        if ( googleLoaded && latitude && longitude ) {
            var map = new google.maps.Map( $('#tour-show-map')[0], {
                center: {
                    lat: parseFloat(latitude),
                    lng: parseFloat(longitude)
                },
                zoom: zoom,
                gestureHandling: 'cooperative',
            });

            // infowindow
            var infowindow = new google.maps.InfoWindow({
               content: address,
            });

            // Marker
            var marker = new google.maps.Marker({
               map: map,
               position: map.getCenter()
            }); // END

            // Open
            infowindow.open(map, marker);

            // Click
            marker.addListener( 'click', function() {
                infowindow.close();
                infowindow.open(map, marker);
            }); // END
        }
    });

    // Google loaded
    function ovabrwGoogleLoaded() {
        return new Promise((resolve) => {
            const check = setInterval(() => {
                try {
                    if ( typeof google == 'object' && typeof google.maps == 'object' && typeof google.maps.places == 'object' ) {
                        clearInterval(check);
                        resolve(true);
                    }
                } catch (e) {
                    // do something
                }
            }, 100 );

            // Stop check google map after 5s
            setTimeout(() => {
                clearInterval(check);
                resolve(false);
            }, 1500 ); // END
        });
    } // END google loaded

	$(".ova-content-single-product .elementor-ralated-slide .elementor-ralated").each(function(){
        var owlsl      = $(this) ;
        var owlsl_ops  = owlsl.data('options') ? owlsl.data('options') : {};

        var responsive_value = {
            0:{
                items:1,
            },
            576:{
                items:1,
            },
            767: {
            	items:2,
            },
            960:{
                items:owlsl_ops.items - 1,
            },
            1200:{
                items:owlsl_ops.items
            }
        };
        
        owlsl.owlCarousel({
            margin: owlsl_ops.margin,
            items: owlsl_ops.items,
            loop: owlsl_ops.loop,
            autoplay: owlsl_ops.autoplay,
            autoplayTimeout: owlsl_ops.autoplayTimeout,
            nav: owlsl_ops.nav,
            dots: true,
            autoplayHoverPause: owlsl_ops.autoplayHoverPause,
            slideBy: owlsl_ops.slideBy,
            smartSpeed: owlsl_ops.smartSpeed,
            rtl: owlsl_ops.rtl,
            navText:[
	            '<i class="icomoon icomoon-pre-small"></i>',
	            '<i class="icomoon icomoon-next-small"></i>'
            ],
            responsive: responsive_value,
        });

      	/* Fixed WCAG */
		owlsl.find(".owl-nav button.owl-prev").attr("title", "Previous");
		owlsl.find(".owl-nav button.owl-next").attr("title", "Next");
		owlsl.find(".owl-dots button").attr("title", "Dots");

    });

 
})(jQuery);