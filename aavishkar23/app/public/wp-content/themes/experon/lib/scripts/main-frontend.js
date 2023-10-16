/**
/**
 * Wordpress Front End Enhancements.
 *
 * jQuery effects used in theme.
 */

/* ----------------------------------------------------------------------------------
	FORMAT FOOTER LAYOUT
---------------------------------------------------------------------------------- */
jQuery(document).ready(function(){

	jQuery('#footer-core .widget-area:last-child').addClass("last");

	/* Footer - Footer Widgets Layout (Options 1 - 6) */
	jQuery('#footer-core.option2 .widget-area').addClass("one_half");
	jQuery('#footer-core.option3 .widget-area').addClass("one_third");
	jQuery('#footer-core.option4 .widget-area').addClass("one_fourth");
	jQuery('#footer-core.option5 .widget-area').addClass("one_fifth");
	jQuery('#footer-core.option6 .widget-area').addClass("one_sixth");

	/* Footer - Footer Widgets Layout (Option 7) */
	jQuery('#footer-core.option7 #footer-col1.widget-area').addClass("one_third");
	jQuery('#footer-core.option7 #footer-col2.widget-area').addClass("two_third");

	/* Footer - Footer Widgets Layout (Option 8) */
	jQuery('#footer-core.option8 #footer-col1.widget-area').addClass("two_third");
	jQuery('#footer-core.option8 #footer-col2.widget-area').addClass("one_third");

	/* Footer - Footer Widgets Layout (Option 9) */
	jQuery('#footer-core.option9 #footer-col1.widget-area').addClass("one_fourth");
	jQuery('#footer-core.option9 #footer-col2.widget-area').addClass("three_fourth");

	/* Footer - Footer Widgets Layout (Option 10) */
	jQuery('#footer-core.option10 #footer-col1.widget-area').addClass("three_fourth");
	jQuery('#footer-core.option10 #footer-col2.widget-area').addClass("one_fourth");

	/* Footer - Footer Widgets Layout (Option 11) */
	jQuery('#footer-core.option11 #footer-col1.widget-area').addClass("one_fifth");
	jQuery('#footer-core.option11 #footer-col2.widget-area').addClass("four_fifth");

	/* Footer - Footer Widgets Layout (Option 12) */
	jQuery('#footer-core.option12 #footer-col1.widget-area').addClass("four_fifth");
	jQuery('#footer-core.option12 #footer-col2.widget-area').addClass("one_fifth");

	/* Footer - Footer Widgets Layout (Option 13) */
	jQuery('#footer-core.option13 #footer-col1.widget-area').addClass("one_sixth");
	jQuery('#footer-core.option13 #footer-col2.widget-area').addClass("one_sixth");
	jQuery('#footer-core.option13 #footer-col3.widget-area').addClass("one_sixth");
	jQuery('#footer-core.option13 #footer-col4.widget-area').addClass("one_half");

	/* Footer - Footer Widgets Layout (Option 14) */
	jQuery('#footer-core.option14 #footer-col1.widget-area').addClass("one_half");
	jQuery('#footer-core.option14 #footer-col2.widget-area').addClass("one_sixth");
	jQuery('#footer-core.option14 #footer-col3.widget-area').addClass("one_sixth");
	jQuery('#footer-core.option14 #footer-col4.widget-area').addClass("one_sixth");

	/* Footer - Footer Widgets Layout (Option 15) */
	jQuery('#footer-core.option15 #footer-col1.widget-area').addClass("one_sixth");
	jQuery('#footer-core.option15 #footer-col2.widget-area').addClass("one_third");
	jQuery('#footer-core.option15 #footer-col3.widget-area').addClass("one_half");

	/* Footer - Footer Widgets Layout (Option 16) */
	jQuery('#footer-core.option16 #footer-col1.widget-area').addClass("one_half");
	jQuery('#footer-core.option16 #footer-col2.widget-area').addClass("one_third");
	jQuery('#footer-core.option16 #footer-col3.widget-area').addClass("one_sixth");

	/* Footer - Footer Widgets Layout (Option 17) */
	jQuery('#footer-core.option17 #footer-col1.widget-area').addClass("one_fourth");
	jQuery('#footer-core.option17 #footer-col2.widget-area').addClass("one_fourth");
	jQuery('#footer-core.option17 #footer-col3.widget-area').addClass("one_sixth");
	jQuery('#footer-core.option17 #footer-col4.widget-area').addClass("one_sixth");
	jQuery('#footer-core.option17 #footer-col5.widget-area').addClass("one_sixth");

	/* Footer - Footer Widgets Layout (Option 18) */
	jQuery('#footer-core.option18 #footer-col1.widget-area').addClass("one_sixth");
	jQuery('#footer-core.option18 #footer-col2.widget-area').addClass("one_sixth");
	jQuery('#footer-core.option18 #footer-col3.widget-area').addClass("one_sixth");
	jQuery('#footer-core.option18 #footer-col4.widget-area').addClass("one_fourth");
	jQuery('#footer-core.option18 #footer-col5.widget-area').addClass("one_fourth");
});


/* ----------------------------------------------------------------------------------
	FORMAT SUB-FOOTER LAYOUT
---------------------------------------------------------------------------------- */
jQuery(document).ready(function(){

	jQuery('#sub-footer-widgets .widget-area:last-child').addClass("last");
	jQuery('#sub-footer-widgets .widget-area:last-child').after( '<div class="clearboth"></div>' );

	/* Footer - Footer Widgets Layout (Option 2) */
	jQuery('#sub-footer-widgets.option2 .widget-area').addClass("one_half");

	/* Footer - Footer Widgets Layout (Option 3) */
	jQuery('#sub-footer-widgets.option3 #sub-footer-col1.widget-area').addClass("one_third");
	jQuery('#sub-footer-widgets.option3 #sub-footer-col2.widget-area').addClass("two_third");

	/* Footer - Footer Widgets Layout (Option 4) */
	jQuery('#sub-footer-widgets.option4 #sub-footer-col1.widget-area').addClass("two_third");
	jQuery('#sub-footer-widgets.option4 #sub-footer-col2.widget-area').addClass("one_third");

	/* Footer - Footer Widgets Layout (Option 5) */
	jQuery('#sub-footer-widgets.option5 #sub-footer-col1.widget-area').addClass("one_fourth");
	jQuery('#sub-footer-widgets.option5 #sub-footer-col2.widget-area').addClass("three_fourth");

	/* Footer - Footer Widgets Layout (Option 6) */
	jQuery('#sub-footer-widgets.option6 #sub-footer-col1.widget-area').addClass("three_fourth");
	jQuery('#sub-footer-widgets.option6 #sub-footer-col2.widget-area').addClass("one_fourth");

	/* Footer - Footer Widgets Layout (Option 7) */
	jQuery('#sub-footer-widgets.option7 #sub-footer-col1.widget-area').addClass("one_fifth");
	jQuery('#sub-footer-widgets.option7 #sub-footer-col2.widget-area').addClass("four_fifth");

	/* Footer - Footer Widgets Layout (Option 8) */
	jQuery('#sub-footer-widgets.option8 #sub-footer-col1.widget-area').addClass("four_fifth");
	jQuery('#sub-footer-widgets.option8 #sub-footer-col2.widget-area').addClass("one_fifth");
});


/* ----------------------------------------------------------------------------------
	MASONRY - LOAD AFTER IMAGES HAVE LOADED
---------------------------------------------------------------------------------- */

jQuery(document).ready(function() {

	// Call imagedLoaded for Masonry if imagedLoaded function is available
	(function ( $ ) {
		if ( $.isFunction($.fn.imagesLoaded) ) {

			// Different target for masonry on portfolio pages than any other page
			if ( $( '#container' ).hasClass( 'portfolio-wrapper' ) ) {
				var $container = $('#container-inner');
			} else if ( $( 'body' ).hasClass( 'woo-shop-grid' ) ) {
				var $container = $('#main-core .products');
			} else {
				var $container = $('#container');
			}

			$container.imagesLoaded( function() {
				if ( $.isFunction($.fn.masonry) ) {
					$container.masonry();
				}
			});
		}
	}( jQuery ));
});


/* ----------------------------------------------------------------------------------
	FORMAT MAIN HEADER MENU
---------------------------------------------------------------------------------- */

function mainmenu(){

	// Add menu-hover class
	jQuery("header .header-links ul.menu > li").hover(function(){
		jQuery(this).find('ul.sub-menu:first').parent().addClass('menu-hover');
	},function(){
		jQuery(this).find('ul.sub-menu:first').parent().removeClass('menu-hover');
	});

	// Add menu-parent class
	jQuery("header .header-links ul.menu > li").each(function(){
		jQuery(this).find('ul.sub-menu').parent().addClass('menu-parent');
	});

	// Correct menu for below header when navigating down page.
	if( jQuery( 'body' ).hasClass( 'header-below' ) ) {
		jQuery('#header').waypoint(function(direction) {
			if (direction === 'down') {
				jQuery( 'body' ).addClass( 'header-below2' );
				jQuery( 'body' ).removeClass( 'header-below1' );
			}
			else {
				jQuery( 'body' ).removeClass( 'header-below2' );
				jQuery( 'body' ).addClass( 'header-below1' );
			}
		}, {
			offset: '50%'
		});
	}
}
jQuery(document).ready(function(){
	mainmenu();
});


/* ----------------------------------------------------------------------------------
	RESPONSIVE MENU - TOGGLE SUB MENUS & ACCESSIBILITY
---------------------------------------------------------------------------------- */

jQuery(document).ready(function (){

	jQuery( '#header-responsive .menu-item-has-children > a' ).after( '<span class="sub-menu-toggle" tabindex="0"></span>' );

	jQuery( '#header-responsive .menu-item-has-children .sub-menu-toggle' ).click(function(e){

		var parentmenu = jQuery( this ).closest('.menu-item-has-children');

		if( parentmenu.hasClass( 'sub-menu-show' ) ) {
			jQuery( parentmenu ).removeClass('sub-menu-show');
		} else {
			jQuery( parentmenu ).addClass('sub-menu-show');
		}

	});

	// Open navigation menu on enter when focused
	jQuery( '#header-nav .btn-navbar, #header-responsive .menu-item-has-children .sub-menu-toggle' ).keyup(function(e){

		// "Enter" button on keyboard has been pressed
		if( e.keyCode == 13 ) {

			// Trigger click event
			jQuery( this ).trigger( 'click' );

			// Add aria-expanded attribute
			var valueAriaExpanded = jQuery( this ).attr( 'aria-expanded' );

			// Toggle aria-expanded attribute value
			if( ! valueAriaExpanded || valueAriaExpanded == 'false' ) {
				jQuery( this ).attr( 'aria-expanded', 'true' )
			} else {
				jQuery( this ).attr( 'aria-expanded', 'false' )
			}
		}
	});
});


/* ----------------------------------------------------------------------------------
	STICKY HEADER - ONLY ON SCREENS SMALLER THAN 768px
---------------------------------------------------------------------------------- */
jQuery(window).load(function(){

	// Trigger sticky header on devices wider than 768px
	if ( jQuery(window).width() > 768 && jQuery( 'body' ).hasClass( 'header-sticky' ) ) {

	// Assign variables & data attributed for header links
	var preheader_height = parseInt( jQuery( '#pre-header' ).css( 'height' ) );
	var header_height    = parseInt( jQuery( '#header' ).css( 'height' ) );
	var header_pad_top   = parseInt( jQuery( '#header .header-links > ul > li > a' ).css( 'padding-top' ) );
	var header_pad_bot   = parseInt( jQuery( '#header .header-links > ul > li > a' ).css( 'padding-bottom' ) );

	jQuery( '#header .header-links > ul > li > a' ).attr( { 'data-padtop': header_pad_top } );
	jQuery( '#header .header-links > ul > li > a' ).attr( { 'data-padbot': header_pad_bot } );

	// Assign variables & data attributed for header logo
	var logo_mar_top  = parseInt( jQuery( '#header #logo' ).css( 'margin-top' ) );
	var logo_max_size = parseInt( jQuery( '#header #logo img' ).css( 'max-height' ) );

	jQuery( '#header' ).attr( { 'data-height': header_height } );
	jQuery( '#header #logo' ).attr( { 'data-martop': logo_mar_top } );
	jQuery( '#header #logo img' ).attr( { 'data-maxsize': logo_max_size } );

	// Add #header-sticky-space to control spacing when sticky header is activated
	if( ( jQuery( 'body' ).hasClass( 'header-style1' ) && ! jQuery( 'body' ).hasClass( 'header-below' ) ) ) {
		jQuery( '#site-header' ).prepend( '<div id="header-sticky-space"></div>' );
		jQuery( '#header-sticky-space' ).css( { 'height': preheader_height + header_height } );
		jQuery( '#header-sticky-space' ).attr( { 'data-height': preheader_height + header_height } );
	}

	// Move #header below from #pre-header
	if( ( jQuery( 'body' ).hasClass( 'header-style1' ) && ! jQuery( 'body' ).hasClass( 'header-below' ) ) || jQuery( 'body' ).hasClass( 'header-style2' ) && jQuery( 'body' ).hasClass( 'home' ) ) {
			jQuery( '#header' ).attr( { 'data-top': preheader_height } );
			jQuery( '#header' ).css( 'margin-top', preheader_height );
	}

		// Resize on scroll
		jQuery(window).scroll(function() {

			// Change padding on header link & logo when resized
			if( ( jQuery( 'body' ).hasClass( 'header-style1' ) && ! jQuery( 'body' ).hasClass( 'header-below' ) ) || jQuery( 'body' ).hasClass( 'header-style2' ) ) {

				// Assign variable values for sticky header
				var header_padtop_end = 15;
				var header_padbot_end = 15;
				var logo_martop_end   = 10;
				var logo_maxsize_end  = 35;

				// Assign header height and position variables - used to mathematically change padding
				var preheader_offset = jQuery( '#pre-header' ).offset();
				var preheader_height = jQuery( '#pre-header' ).height();				

				var header_offset = jQuery( '#header' ).offset();
				var header_height = jQuery( '#header' ).height();
				var preheader_top = jQuery( '#header' ).attr( 'data-top' );

				// Move #header to cover #pre-header when scrolling down
				if ( header_offset.top < preheader_height ) {
					var preheader_offset_top = header_offset.top / preheader_height;

					// Resize padding on header links
					if( ( preheader_top * ( 1 - preheader_offset_top ) ) >= preheader_top ) {
						if ( jQuery( 'body' ).hasClass( 'header-style1' ) || jQuery( 'body' ).hasClass( 'header-style2' ) && jQuery( 'body' ).hasClass( 'home' ) ) {
							jQuery( '#header' ).css( { 'margin-top': preheader_top * ( 1 - preheader_offset_top ) } );
						}
						jQuery( '#header-sticky-space' ).css( { 'margin-top': preheader_top * ( preheader_offset_top ) * -1 } );
					}

					// Add header-stickyactive class to body tag - Header Style 1 (above slider) & 2
					jQuery( 'body' ).removeClass( 'header-stickyactive' );

				} else {
					if ( jQuery( 'body' ).hasClass( 'header-style1' ) || jQuery( 'body' ).hasClass( 'header-style2' ) && jQuery( 'body' ).hasClass( 'home' ) ) {
						jQuery( '#header' ).css( { 'margin-top': 0 } );
					}
					jQuery( '#header-sticky-space' ).css( { 'margin-top': preheader_top * -1 } );

					// Remove header-stickyactive class to body tag - Header Style 1 (above slider) & 2
					jQuery( 'body' ).addClass( 'header-stickyactive' );
				}

				// Resize #header elements
				if ( header_offset.top <= header_height ) {
					var header_offset_top = header_offset.top / header_height;
					
					var header_space   = jQuery( '#header-sticky-space' ).attr( 'data-height' );
					var header_pad_top = jQuery( '#header .header-links > ul > li > a' ).attr( 'data-padtop' );
					var header_pad_bot = jQuery( '#header .header-links > ul > li > a' ).attr( 'data-padbot' );

					var logo_mar_top  = jQuery( '#header #logo' ).attr( 'data-martop' );
					var logo_max_size = jQuery( '#header #logo img' ).attr( 'data-maxsize' );

					// Resize padding on header links
					if( ( header_pad_top * ( 1 - header_offset_top ) ) > header_padtop_end ) {
						jQuery( '#header .header-links > ul > li > a' ).css( { 'padding-top': header_pad_top * ( 1 - header_offset_top ) } );
						jQuery( '#header .header-links > ul > li > a' ).css( { 'padding-bottom': header_pad_bot * ( 1 - header_offset_top ) } );

						if( ( jQuery( 'body' ).hasClass( 'header-style1' ) ) ) {
							jQuery( '#header-sticky-space' ).css( { 'height': header_space * ( 1 - header_offset_top ) } );
						}
					}

					// Resize margin on logo top
					if( ( logo_mar_top * ( 1 - header_offset_top ) ) > logo_martop_end ) {
						jQuery( '#header #logo' ).css( { 'margin-top': logo_mar_top * ( 1 - header_offset_top ) } );
					}

					// Resize logo image
					if( ( logo_max_size * ( 1 - header_offset_top ) ) >= logo_maxsize_end ) {
						jQuery( '#header #logo img' ).css( { 'max-height': logo_max_size * ( 1 - header_offset_top ) } );
					}

				} else if ( header_offset.top > header_height ) {
					var header_offset_top = header_offset.top / header_height;
					jQuery( '#header .header-links > ul > li > a' ).css( { 'padding-top': header_padtop_end } );
					jQuery( '#header .header-links > ul > li > a' ).css( { 'padding-bottom': header_padbot_end } );
						
					jQuery( '#header #logo' ).css( { 'margin-top': logo_martop_end } );
					jQuery( '#header #logo img' ).css( { 'max-height': logo_maxsize_end } );	

					if( ( jQuery( 'body' ).hasClass( 'header-style1' ) ) ) {
						jQuery( '#header-sticky-space' ).css( { 'height': 0 } );;
					}
				}
			}
		});
	}
});


/* ----------------------------------------------------------------------------------
	FLUID MEDIA SIZES (Modified from http://bavotasan.com/2012/better-way-to-resize-video-using-jquery)
---------------------------------------------------------------------------------- */

/* Videos */
jQuery(document).ready(function() {

	/* Supported Platforms */
	var all_videos = jQuery( 'iframe[src*="//player.vimeo.com"], iframe[src*="//www.youtube.com"], iframe[src*="//blip.tv"], iframe[src*="//www.slideshare.net"], iframe[src*="//www.scribd.com"], iframe[src*="//revision3.com"], iframe[src*="//www.hulu.com"], iframe[src*="//www.funnyordie.com"], iframe[src*="//www.dailymotion.com"], iframe[src*="//maps.google.com"], embed[src*="//v.wordpress.com"], object, embed' );

	all_videos.each(function() {
		var el = jQuery(this);
		el
			.attr( 'data-aspectRatio', 360 / 640 )
			.attr( 'data-oldWidth', el.width() );
	} );

	jQuery(document).ready(function() {
		all_videos.each( function() {
		var el = jQuery(this),
			newWidth    = el.parents().width(),
			oldWidth    = el.attr( 'data-oldWidth' );
			ratioHeight = el.height() / el.outerHeight(),

			el
				.removeAttr( 'height' )
				.removeAttr( 'width' )
				.width( newWidth * ratioHeight )
				.outerHeight( newWidth * el.attr( 'data-aspectRatio' ) );
		});
	}).resize();

	jQuery(window)
		.resize( function() {
			all_videos.each( function() {
			var el = jQuery(this),
				newWidth    = el.parents().width(),
				oldWidth    = el.attr( 'data-oldWidth' );
				ratioHeight = el.height() / el.outerHeight(),

				el
					.removeAttr( 'height' )
					.removeAttr( 'width' )
					.width( newWidth * ratioHeight )
		    		.outerHeight( newWidth * el.attr( 'data-aspectRatio' ) );
			});
		}).resize();
});

/* SoundCloud */
jQuery(document).ready(function() {

	/* Supported Platforms */
	var all_sounds = jQuery( 'iframe[src^="http://w.soundcloud.com"]' );

	all_sounds.each(function() {
		var el = jQuery(this);
		el
			.attr( 'data-aspectRatio', el.attr( 'height' ) / el.attr( 'width' )  )
			.attr( 'data-oldWidth', el.width() );
	});

	jQuery(document).ready(function() {
		all_sounds.each( function() {
		var el = jQuery(this),
			newWidth = el.parents().width(),
			oldWidth = el.attr( 'data-oldWidth' );

			el
				.removeAttr( 'width' )
				.width( newWidth )
		});
	}).resize();

	jQuery(window)
		.resize( function() {
			all_sounds.each( function() {
			var el = jQuery(this),
				newWidth = el.parents().width(),
				oldWidth = el.attr( 'data-oldWidth' );

				el
					.removeAttr( 'width' )
					.width( newWidth )
			});
		}).resize();
});


/* ----------------------------------------------------------------------------------
	ADD PRETTYPHOTO TO PORTFOLIO PAGE
---------------------------------------------------------------------------------- */

jQuery(document).ready(function() {
	jQuery('#container.portfolio-wrapper a').has('img.hover-zoom').addClass('prettyPhoto');
	jQuery('#container.portfolio-wrapper a').has('img.hover-zoom').attr('rel','portfolio[gallery]');
	jQuery('a.prettyPhoto').has('img').attr('rel','portfolio[gallery]');
	jQuery('a.prettyPhoto').prettyPhoto();
});


/* ----------------------------------------------------------------------------------
	ADD PRETTYPHOTO TO POST IMAGE PAGE
---------------------------------------------------------------------------------- */

jQuery(document).ready(function() {
	jQuery('body.attachment .entry-attachment .attachment a').has('img').addClass('prettyPhoto');
	jQuery('a.prettyPhoto').prettyPhoto();
});


/* ----------------------------------------------------------------------------------
	ADD _BLANK TO OUTGOING LINKS
---------------------------------------------------------------------------------- */

jQuery(document).ready(function(){
	jQuery('.thinkup_widget_flickr a[href^="http://"], .thinkup_widget_flickr a[href^="https://"]').attr('target','_blank');
	jQuery('.thinkup_widget_socialshare a[href^="http://"], .thinkup_widget_socialshare a[href^="https://"]').attr('target','_blank');
	jQuery('.thinkup_widget_socialprofiles a[href^="http://"], .thinkup_widget_socialprofiles a[href^="https://"]').attr('target','_blank');
	jQuery('#pre-header-social a[href^="http://"], #pre-header-social a[href^="https://"]').attr('target','_blank');
	jQuery('#shareicons a[href^="http://"], #shareicons a[href^="https://"]').attr('target','_blank');
});


/* ----------------------------------------------------------------------------------
	SHORTCODES
---------------------------------------------------------------------------------- */

jQuery(window).load(function() {

	/* Accordion - Fix Bootstrap Toggle Issue */
	jQuery('.accordion-toggle').click(function() {
	    if(jQuery(this).hasClass('collapsed')) {
	        jQuery(this).closest('.accordion').find('.accordion-toggle').not(this).addClass('collapsed');
	    }
	});

	/* Divider - Scroll To Top */
	jQuery('.backtotop').click(function(){
		jQuery('html, body').animate({scrollTop:0}, 'slow');
	});

	/* Tooltip - Activate Bootstrap */
	jQuery('[data-tip]').each( function() {jQuery(this).tooltip({ placement: jQuery(this).data('tip') }); });

	/* Blog Post - Carousel (used for identifying if input variable is an integer */
	function isNumber(n) {
		return !isNaN(parseFloat(n)) && isFinite(n);
	}

	/* Blog Post - Activate CarouFredSel */
	jQuery(window).bind( 'load resize', function() {
		jQuery( '.sc-carousel' ).each( function(i) {

			// Don't run caroufredsel code if the following classes are present.
			if ( jQuery( this ).hasClass( 'sc-postitem' ) || 
				 jQuery( this ).hasClass( 'sc-featured' ) || 
				 jQuery( this ).hasClass( 'sc-image' ) ) {
					return;
			};

			var instanceID = 'sc-carousel-' + i;

			jQuery( this ).attr( 'id', instanceID );

			jQuery( this ).children( 'ul').attr( 'id', instanceID + '-inner' );

			var show   = jQuery( '#' + instanceID + '.sc-carousel' ).data( 'show' );
			var scroll = jQuery( '#' + instanceID + '.sc-carousel' ).data( 'scroll' );
			var speed  = jQuery( '#' + instanceID + '.sc-carousel' ).data( 'speed' );
			var effect = jQuery( '#' + instanceID + '.sc-carousel' ).data( 'effect' );

			if ( show == 0 || isNaN( show ) == true ) show = '3';
			if ( scroll == 0 || isNaN( scroll ) == true ) scroll = '1';
			if ( speed == 0 ) speed = '500';
			if ( effect == 0 ) {
				effect = '"scroll"'; 
			} else {
				effect = '"' + effect + '"';
			}

			var showItems = show;
			var scrollItems = scroll;
			var speedItems = speed;
			var fxItems = effect;

			var width = jQuery(window).width();

			if ( jQuery( 'body' ).hasClass( 'layout-responsive' ) ) {
				if(width <=685) {
						showItems = 2;
						if( scrollItems >= 2 ) {
							scrollItems = 2;
						}
				}
				if(width <=480) {
					showItems = 1;
					scrollItems = 1;
				}
			}

				// Apply carousel code if needed				
				if ( jQuery( this ).find( '#' + instanceID + '-inner' ).length ) {

					jQuery( this ).find( '#' + instanceID + '-inner' ).carouFredSel({
						width: '100%',
						items			: {
								visible         : showItems,
								minimum         : 3,
								minimum         : 3,
								start: 0
						},
						scroll			: {
								items           : scrollItems,
								fx              : fxItems,
								easing          : "swing",
								duration        : speedItems,
						},
						responsive      : true,
						circular        : true,
						infinite        : false,
						auto 	        : false,
						prev	: {	
							button	: '#' + instanceID + ' .prev',
							key		: 'left'
						},
						next	: { 
							button	: '#' + instanceID + ' .next',
							key		: 'right'
						},
						pagination	: '#' + instanceID + ' .pagination',
						onCreate: function () {
							jQuery(window).bind("load resize", function() {
							
							// Set height to testimonial carousel elements - All
							parentWidthTestimonial = jQuery( '#' + instanceID + '.carousel-testimonial li').outerHeight();
							jQuery( '#' + instanceID + '.carousel-testimonial' ).height( 'auto' );
							jQuery( '#' + instanceID + '.carousel-testimonial .caroufredsel_wrapper' ).css( { 'height': parentWidthTestimonial } );

							// Set height to testimonial carousel elements - Fix Style 1
							parentWidthTestimonial_1 = jQuery( '#' + instanceID + '.carousel-testimonial.style1 .caroufredsel_wrapper').outerHeight();
							parentWidthTestimonial_2 = jQuery( '#' + instanceID + '.carousel-testimonial.style1 .sc-carousel-thumbs').outerHeight();

							jQuery( '#' + instanceID + '.carousel-testimonial.style1' ).height( parentWidthTestimonial_1 + parentWidthTestimonial_2 );
							jQuery( '#' + instanceID + '.carousel-testimonial.style1 .sc-carousel-thumbs' ).parent().height( parentWidthTestimonial_2 );
							});
						}
					});
				}

				// Used for adding thumbnails to slider - Currently only for Testimonials slider
				if ( jQuery( this ).find('.sc-carousel-thumbs').length ) {

					jQuery( this ).find('.sc-carousel-thumbs').carouFredSel({
						responsive: true,
						circular: false,
						infinite: false,
						auto: false,
						prev: '#prev',
						next: '#next',
						items: {
							visible: {
								min: 2,
								max: 6
							},
							width: 150,
							height: 70
						}
					});
				}

				jQuery( this ).find('.sc-carousel-thumbs a').click(function() {
					jQuery('#' + instanceID + '-inner').trigger('slideTo', '#' + this.href.split('#').pop() );
					jQuery('.sc-carousel-thumbs a').removeClass('selected');
					jQuery( this ).addClass('selected');
					return false;
				});

			// Set carousel container height
			parentHeight = jQuery( '#' + instanceID + ' li').height();
			jQuery( '#' + instanceID + ' li' ).each(function() {
				var elementHeight = jQuery(this).height(); 
				parentHeight = elementHeight > parentHeight ? elementHeight : parentHeight;
			});

			// Add addition height if carousel thumbnails are showing
			if( jQuery( '#' + instanceID ).closest('.sc-carousel').find('.sc-carousel-thumbs').length > 0 ) {
				parentHeightThumb = parentHeight + jQuery( '#' + instanceID ).closest('.sc-carousel').find('.sc-carousel-thumbs').height();
			} else {
				parentHeightThumb = parentHeight;
			}

			// Assign height to unique carousel ID (Max used to ensure thumbnail carousel displays correctly)
			jQuery( '#' + instanceID ).height( Math.max( parentHeight, parentHeightThumb ) );
			jQuery( '#' + instanceID + '-inner' ).height( parentHeight );
			jQuery( '#' + instanceID + '-inner' ).parent().height( parentHeight );

			// Set carousel container height to auto if iframe exists in featured images
			if ( jQuery( '#' + instanceID + ' iframe').length > 0 ) {
				jQuery( '#' + instanceID ).addClass('carousel-iframe');
			}
		});

	}).resize();

	/* Make ThinkUpSlider shortcode full width if specified */
	jQuery( '.thinkupslider-sc' ).each(function( index, element ){

		jQuery( element ).attr( 'id', 'thinkupbuilder-thinkupsliderimage-' + index );

			// Collect slider parameter values
			var wide = jQuery( element ).data( 'wide' );
			
			// Format row section for full-screen slider
			if ( wide == 'on' ) {		
				jQuery( element ).closest( '.panel-grid' ).css( 'padding', 0 );
				jQuery( element ).closest( '.panel-grid-core' ).css( 'margin', 0 ).css( 'maxWidth', '100%' );
				jQuery( element ).closest( '.panel-grid-cell' ).css( 'padding', 0 );
			}
	});

	/* Make slider full width if specified */
	jQuery( '.rslides-sc' ).each(function( index, element ){

		jQuery( element ).attr( 'id', 'thinkupbuilder-sliderimage-' + index );

			// Collect slider parameter values
			var wide = jQuery( element ).data( 'wide' );
			
			// Format row section for full-screen slider
			if ( wide == 'on' ) {		
				jQuery( element ).closest( '.panel-grid' ).css( 'padding', 0 );
				jQuery( element ).closest( '.panel-grid-core' ).css( 'margin', 0 ).css( 'maxWidth', '100%' );
				jQuery( element ).closest( '.panel-grid-cell' ).css( 'padding', 0 );
			}
	});
});


/* ----------------------------------------------------------------------------------
	HEADER SEARCH
---------------------------------------------------------------------------------- */

jQuery(document).ready(function() {
	jQuery('#header-search a').click(function() {	
		if ( ! jQuery( '#header-search' ).hasClass( 'active' ) ) {
			jQuery( '#header-search' ).addClass( 'active' );
		} else { 
			jQuery( '#header-search' ).removeClass( 'active' );	
		}
	});
});


/* ----------------------------------------------------------------------------------
	SCROLL TO TOP BUTTON
---------------------------------------------------------------------------------- */

jQuery(document).ready(function() {
	if ( jQuery( 'body' ).hasClass( 'scrollup-on' ) ) {
		(function($) {
			$(function () {
				$.scrollUp({
				scrollName: 'scrollUp', // Element ID
				scrollText: '', // Text for element, can contain HTML
			});
		});
		} (jQuery) );
	}
});


/* ----------------------------------------------------------------------------------
	SUB-FOOTER WIDGETS - CLOSE BUTTON
---------------------------------------------------------------------------------- */

// Sub-Footer Widget - Close Button
jQuery('#sub-footer-close-core').click(function() {
    if(jQuery( this ).hasClass('collapsed')) {
        jQuery( this ).removeClass('collapsed');
        jQuery( '#sub-footer-widgets' ).removeClass('collapsed');
    } else {
        jQuery( this ).addClass('collapsed');
        jQuery( '#sub-footer-widgets' ).addClass('collapsed');
	}
});


/* ----------------------------------------------------------------------------------
	SLIDER ICON - SMOOTH SCROLL
---------------------------------------------------------------------------------- */

jQuery(document).ready(function (){

	// Add #thinkupslider-after
	if ( jQuery( '.featured-icon' ) ) {
		jQuery( '#slider' ).after( '<div id="thinkupslider-after"></div>' );
	}

	// Scroll To #thinkupslider-after
	jQuery('.featured-icon a').click(function(e){
		e.preventDefault(); 
		jQuery('html, body').animate( { scrollTop: jQuery( '#thinkupslider-after' ).offset().top },  1000 );
	});
});


/* ----------------------------------------------------------------------------------
	WOOCOMMERCE - SOCIAL SHARING
---------------------------------------------------------------------------------- */

jQuery(document).ready(function (){

	// Add active class to social sharing button
	jQuery('.woo-share').click(function(e){ 
	
		if ( jQuery( this ).hasClass( 'active' ) ) {
			jQuery( this ).removeClass( 'active' );
			jQuery( this ).closest( '.woo-meta' ).find( '.woo-meta-social' ).removeClass( 'active' );
		} else {
			jQuery( this ).addClass( 'active' );
			jQuery( this ).closest( '.woo-meta' ).find( '.woo-meta-social' ).addClass( 'active' );
		}
	});
});

