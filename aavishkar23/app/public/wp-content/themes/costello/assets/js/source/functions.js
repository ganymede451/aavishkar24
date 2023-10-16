/* global costelloOptions */
 /*
 * Custom scripts
 * Description: Custom scripts for costello
 */

( function( $ ) {
	$( window ).on( 'load.costello resize.costello', function() {
		$('#primary-menu-wrapper .menu-inside-wrapper').on( 'focusout', function () {
			var $elem = $(this);

			// let the browser set focus on the newly clicked elem before check
			setTimeout(function () {
				if ( ! $elem.find(':focus').length ) {
					$( '#site-header-menu .menu-toggle' ).trigger( 'focus' );
				}
			}, 0);
		});

		$('#primary-search-wrapper .menu-inside-wrapper').on( 'focusout', function () {
			$( '#primary-search-wrapper #social-search-toggle' ).trigger( 'focus' );
		});
	});
	
	// Search Toggle
	$( '#social-search-toggle' ).on( 'click.costello', function( e ){
		$( 'body' ).removeClass( 'menu-open' );
		$( '#site-header-menu .menu-toggle' ).removeClass( 'selected' );
		$( '#site-header-menu .menu-wrapper' ).removeClass( 'is-open' );
		
		$( '#primary-search-wrapper' ).toggleClass('is-open');
		$( this ).toggleClass('selected');
		$( body ).removeClass( 'menu-open' );
		return false;
	});
	
	// Owl Carousel
	if ( typeof $.fn.owlCarousel === "function" ) {
		// Featured Slider
		var sliderOptions = {
			rtl:costelloOptions.rtl ? true : false,
			autoHeight:true,
			margin: 0,
			items: 1,
			nav: true,
			dots: true,
			autoplay: true,
			autoplayTimeout: 4000,
			loop: true,
			navText: [costelloOptions.iconNavPrev,costelloOptions.iconNavNext]
		};

		$(".main-slider").owlCarousel(sliderOptions);

		// Testimonial Section
		var testimonialOptions = {
			rtl:costelloOptions.rtl ? true : false,
			autoHeight: true,
			margin: 0,
			items: 1,
			nav: true,
			dots: true,
			autoplay: true,
			autoplayTimeout: 4000,
			loop: true,
			navText: [costelloOptions.testimonialNavPrev,costelloOptions.testimonialNavNext],
		};

		$( '.testimonial-slider' ).owlCarousel(testimonialOptions);

		$('#testimonial-content-section .owl-dot').on( 'click',function () {
			$( '.testimonial-slider' ).trigger('to.owl.carousel', [$(this).index(), 300]);
		});
	}

	//Adding padding top for header to match with custom header
	$( window ).on( 'load resize', function () {
        if( $( 'body' ).hasClass( 'has-header-media' ) || $( 'body' ).hasClass( 'absolute-header' )) {
            headerheight = $('#masthead').height();
            $('.absolute-header #masthead + .custom-header, .absolute-header #masthead + #feature-slider-section .post-thumbnail').css('padding-top', headerheight );
        }
    });

	if ( typeof $.fn.masonry === "function" && typeof $.fn.imagesLoaded === "function" ) {
		/*
		* Masonry
		*/
		//Masonry blocks
		$blocks = $('.grid');
		$blocks.imagesLoaded(function(){
			$blocks.masonry({
				itemSelector: '.grid-item',
				columnWidth: '.grid-item',
				// slow transitions
				transitionDuration: '1s'
			});

			// Fade blocks in after images are ready (prevents jumping and re-rendering)
			$('.grid-item').fadeIn();

			$blocks.find( '.grid-item' ).animate( {
				'opacity' : 1
			} );
		});

		$( function() {
			setTimeout( function() { $blocks.masonry(); }, 2000);
		});

		$(window).on( 'resize', function () {
			$blocks.masonry();
		});
	}

	$('body').on('click touch','.scroll-down', function(e){
		var Sclass = $(this).parents('.feature-slider-section, .custom-header').next();
		var scrollto = Sclass.offset().top;

		$('html, body').animate({
			scrollTop: scrollto
		}, 1000);

	});

	// Add header video class after the video is loaded.
	$( document ).on( 'wp-custom-header-video-loaded', function() {
		$( 'body' ).addClass( 'has-header-video' );
	});

	/*
	 * Test if inline SVGs are supported.
	 * @link https://github.com/Modernizr/Modernizr/
	 */
	function supportsInlineSVG() {
		var div = document.createElement( 'div' );
		div.innerHTML = '<svg/>';
		return 'http://www.w3.org/2000/svg' === ( 'undefined' !== typeof SVGRect && div.firstChild && div.firstChild.namespaceURI );
	}

	$( function() {
		$( document ).ready( function() {
			if ( true === supportsInlineSVG() ) {
				document.documentElement.className = document.documentElement.className.replace( /(\s*)no-svg(\s*)/, '$1svg$2' );
			}
		});
	});

	$( '.search-toggle' ).on( 'click', function() {
		$( this ).toggleClass( 'open' );
		$( this ).attr( 'aria-expanded', $( this ).attr( 'aria-expanded' ) === 'false' ? 'true' : 'false' );
		$( '.search-wrapper' ).toggle();
	});

	/* Menu */
	var body, masthead, menuToggle, siteNavigation, socialNavigation, siteHeaderMenu, resizeTimer;

	function initMainNavigation( container ) {

		// Add dropdown toggle that displays child menu items.
		var dropdownToggle = $( '<button />', { 'class': 'dropdown-toggle', 'aria-expanded': false })
		.append( costelloOptions.dropdownIcon )
			.append( $( '<span />', { 'class': 'screen-reader-text', text: costelloOptions.screenReaderText.expand }) );

		container.find( '.menu-item-has-children > a, .page_item_has_children > a' ).after( dropdownToggle );
		container.find( '.menu-item-has-children > a, .page_item_has_children > a' ).append( costelloOptions.dropdownIcon );

		// Toggle buttons and submenu items with active children menu items.
		container.find( '.current-menu-ancestor > button' ).addClass( 'toggled-on' );
		container.find( '.current-menu-ancestor > .sub-menu' ).addClass( 'toggled-on' );

		// Add menu items with submenus to aria-haspopup="true".
		container.find( '.menu-item-has-children, .page_item_has_children' ).attr( 'aria-haspopup', 'true' );

		container.find( '.dropdown-toggle' ).on( 'click', function( e ) {
			var _this            = $( this ),
				screenReaderSpan = _this.find( '.screen-reader-text' );

			e.preventDefault();
			_this.toggleClass( 'toggled-on' );
			_this.next( '.children, .sub-menu' ).toggleClass( 'toggled-on' );

			// jscs:disable
			_this.attr( 'aria-expanded', _this.attr( 'aria-expanded' ) === 'false' ? 'true' : 'false' );
			// jscs:enable
			screenReaderSpan.text( screenReaderSpan.text() === costelloOptions.screenReaderText.expand ? costelloOptions.screenReaderText.collapse : costelloOptions.screenReaderText.expand );
		} );
	}

	initMainNavigation( $( '.main-navigation' ) );

	masthead         = $( '#masthead' );
	siteHeaderMenu   = masthead.find( '#site-header-menu' );
	menuToggle       = siteHeaderMenu.find( '.menu-toggle' );
	siteNavigation   = masthead.find( '#site-navigation' );
	socialNavigation = masthead.find( '#social-navigation' );


	// Enable menuToggle.
	( function() {

		// Assume the initial scroll position is 0.
		var scroll = 0;

		// Return early if menuToggle is missing.
		if ( ! menuToggle.length ) {
			return;
		}

		menuToggle.on( 'click.costello', function() {
			// jscs:disable
			$( this ).add( siteNavigation ).attr( 'aria-expanded', $( this ).add( siteNavigation ).attr( 'aria-expanded' ) === 'false' ? 'true' : 'false' );
			// jscs:enable
		} );


		// Add an initial values for the attribute.
		menuToggle.add( siteNavigation ).attr( 'aria-expanded', 'false' );
		menuToggle.add( socialNavigation ).attr( 'aria-expanded', 'false' );

		// Wait for a click on one of our menu toggles.
		menuToggle.on( 'click.costello', function() {

			// Assign this (the button that was clicked) to a variable.
			var button = this;

			// Gets the actual menu (parent of the button that was clicked).
			var menu = $( this ).parents( '.menu-wrapper' );

			// Remove selected classes from other menus.
			$( '.menu-toggle' ).not( button ).removeClass( 'selected' );
			$( '.menu-wrapper' ).not( menu ).removeClass( 'is-open' );

			// Toggle the selected classes for this menu.
			$( button ).toggleClass( 'selected' );
			$( menu ).toggleClass( 'is-open' );

			// Is the menu in an open state?
			var is_open = $( menu ).hasClass( 'is-open' );

			// If the menu is open and there wasn't a menu already open when clicking.
			if ( is_open && ! jQuery( 'body' ).hasClass( 'menu-open' ) ) {

				// Get the scroll position if we don't have one.
				if ( 0 === scroll ) {
					scroll = $( 'body' ).scrollTop();
				}

				// Add a custom body class.
				$( 'body' ).addClass( 'menu-open' );

			// If we're closing the menu.
			} else if ( ! is_open ) {

				$( 'body' ).removeClass( 'menu-open' );
				$( 'body' ).scrollTop( scroll );
				scroll = 0;
			}
		} );

		// Close menus when somewhere else in the document is clicked.
		$( document ).on( 'click touchstart', function() {
			$( 'body' ).removeClass( 'menu-open' );
			$( '.menu-toggle' ).removeClass( 'selected' );
			$( '.menu-wrapper' ).removeClass( 'is-open' );
		} );

		// Stop propagation if clicking inside of our main menu.
		$( '.site-header-menu,.menu-toggle, .dropdown-toggle, .search-field, #site-navigation, #social-search-wrapper, #social-navigation .search-submit' ).on( 'click touchstart', function( e ) {
			e.stopPropagation();
		} );
	} )();

	//For Footer Menu
	menuToggleFooter       = $( '#menu-toggle-footer' ); // button id
	siteFooterMenu         = $( '#footer-menu-wrapper' ); // wrapper id
	siteNavigationFooter   = $( '#site-footer-navigation' ); // nav id
	initMainNavigation( siteNavigationFooter );

	// Enable menuToggleFooter.
	( function() {
		// Return early if menuToggleFooter is missing.
		if ( ! menuToggleFooter.length ) {
			return;
		}

		// Add an initial values for the attribute.
		menuToggleFooter.add( siteNavigationFooter ).attr( 'aria-expanded', 'false' );

		menuToggleFooter.on( 'click', function() {
			$( this ).add( siteFooterMenu ).toggleClass( 'toggled-on selected' );

			// jscs:disable
			$( this ).add( siteNavigationFooter ).attr( 'aria-expanded', $( this ).add( siteNavigationFooter ).attr( 'aria-expanded' ) === 'false' ? 'true' : 'false' );
			// jscs:enable
		} );
	} )();

	// Fix sub-menus for touch devices and better focus for hidden submenu items for accessibility.
	( function() {
		if ( ! siteNavigation.length || ! siteNavigation.children().length ) {
			return;
		}

		// Toggle `focus` class to allow submenu access on tablets.
		function toggleFocusClassTouchScreen() {
			if ( window.innerWidth >= 910 ) {
				$( document.body ).on( 'touchstart.costello', function( e ) {
					if ( ! $( e.target ).closest( '.main-navigation li' ).length ) {
						$( '.main-navigation li' ).removeClass( 'focus' );
					}
				} );
				siteNavigation.find( '.menu-item-has-children > a, .page_item_has_children > a' ).on( 'touchstart.costello', function( e ) {
					var el = $( this ).parent( 'li' );

					if ( ! el.hasClass( 'focus' ) ) {
						e.preventDefault();
						el.toggleClass( 'focus' );
						el.siblings( '.focus' ).removeClass( 'focus' );
					}
				} );
			} else {
				siteNavigation.find( '.menu-item-has-children > a, .page_item_has_children > a' ).unbind( 'touchstart.costello' );
			}
		}

		if ( 'ontouchstart' in window ) {
			$( window ).on( 'resize.costello', toggleFocusClassTouchScreen );
			toggleFocusClassTouchScreen();
		}

		siteNavigation.find( 'a' ).on( 'focus.costello blur.costello', function() {
			$( this ).parents( '.menu-item' ).toggleClass( 'focus' );
		} );
	} )();

	$(document).ready(function() {
		/*Search and Social Container*/
		$('.toggle-top').on('click', function(e){
			$(this).toggleClass('toggled-on');
		});
	});

	/* Playlist On Scroll For Mobile */
	var PlaylistOnScroll = function(){

		var scrollTop = $(window).scrollTop();

		if (scrollTop > 46) {
			$('body').addClass('playlist-fixed');
		} else {
			$('body').removeClass('playlist-fixed');
		}
	};

	/*Onload*/
	PlaylistOnScroll();

	/*On Scroll*/
	$(window).on( 'scroll',function() {
		PlaylistOnScroll();
	});

	// Show count in header if count is more than 0
	if (parseInt($(".site-header-cart .cart-contents .count").text()) !== 0) {
		$(".site-header-cart .cart-contents .count").show();
	}

	$(window).on( 'load resize', function() {
	    var thumbHeight = $('#featured-video-section .featured').height();
	    if ( $(window).width() > 1024 ) {
	        $('#featured-video-section .side-posts-wrap').css('height', thumbHeight);
	    } else {
	        $('#featured-video-section .side-post-wrap').removeAttr('style');
	    }
	});
	$(window).on( 'load resize', function() {
	    var thumbHeight = $('#featured-video-section .featured .video-thumbnail').height();
	    $('#featured-video-section .side-posts-wrap').css('height', thumbHeight);
	});

	if (typeof $.fn.masonry === "function" && typeof $.fn.imagesLoaded === "function") {
		/*
		 * Masonry
		 */
		//Masonry blocks
		$blocks = $('.grid');
		$blocks.imagesLoaded(function () {
			$blocks.masonry({
				itemSelector: '.grid-item',
				columnWidth: '.grid-item',
				// slow transitions
				transitionDuration: '1s'
			});

			// Fade blocks in after images are ready (prevents jumping and re-rendering)
			$('.grid-item').fadeIn();

			$blocks.find('.grid-item').animate({
				'opacity': 1
			});
		});

		$(function () {
			setTimeout(function () { $blocks.masonry(); }, 2000);
		});

		$(window).on('resize', function () {
			$blocks.masonry();
		});
	}

	/* Sticky Menu */

	$(document).ready(function () {
	
	'use strict';
	
	var c, currentScrollTop = 0,
		navbar = $('.site-header');

	/*$(window).scroll(function ()*/
	$(window).on( 'scroll resize load', function () {
		var a = $(window).scrollTop();
		var b = navbar.height();
		
		currentScrollTop = a;

		navbar.removeClass("scrollDown");
		
		if (c < currentScrollTop && a > b) {
			navbar.addClass("scrollUp");
			navbar.removeClass("scrollDown");
		} else if (c > currentScrollTop && !(a <= b)) {
			navbar.addClass("scrollDown");
			navbar.removeClass("scrollUp");
		}
		c = currentScrollTop;
	});
	
	});

	/**
	 * Simple Vanilla Javascript MatchHeight of selected elements
	 * https://codepen.io/jonescr/pen/QvEZpQ
	 */
	(function matchTheHeight(elements) {
		for (j = 0; j < elements.length; j++) {
			var getDivs = document.querySelectorAll(elements[j]);

			if (getDivs.length) {
				//Find out how my divs there are with the query selector getDivs
				var arrayLength = getDivs.length;
				var heights = [];

				//Create a loop that iterates through the getDivs variable and pushes the heights of the divs into an empty array
				for (var i = 0; i < arrayLength; i++) {
					heights.push(getDivs[i].offsetHeight);
				}

				//Find the largest of the divs
				function getHighest() {
					return Math.max(...heights);
				}

				//Set a variable equal to the tallest div
				var tallest = getHighest();

				//Iterate through getDivs and set all their height style equal to the tallest variable
				for (var i = 0; i < getDivs.length; i++) {
					getDivs[i].style.height = tallest + "px";
				}
			}
		}
	})([
		'.testimonial-content-section .hentry-inner'
	]);

} )( jQuery );
