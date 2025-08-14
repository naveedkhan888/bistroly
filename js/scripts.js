( function( $ ) {
	'use strict';
	
	/* rtl check */
	function rtl_owl(){
	if ($('body').hasClass("rtl")) {
		return true;
	} else {
		return false;
	}};

	/* Check rtl isotop*/
    function rtl_isotop() {
        if ( $( 'body' ).hasClass( 'rtl' ) ) {
           return false;
        } else {
           return true;
        }
    };

	/* --------------------------------------------------
    * preloader
    * --------------------------------------------------*/
	if ( $('#royal_preloader').length ) {
		var $selector       = $('#royal_preloader'),
			$width          = $selector.data('width'),
			$height         = $selector.data('height'),
			$color          = $selector.data('color'),
			$bgcolor        = $selector.data('bgcolor'),
			$logourl        = $selector.data('url');
		
		Royal_Preloader.config({
			mode           : 'logo',
			logo           : $logourl,
			logo_size      : [$width, $height],
			showProgress   : true,
			showPercentage : true,
			text_colour: $color,
			background:  $bgcolor,
		});        
	};

    /* --------------------------------------------------
    * sticky header
    * --------------------------------------------------*/
	// Append a clone of the header for spacing adjustment
    $('.header-static .is-fixed').parent().append('<div class="header-clone"></div>');
    
    // Set the height of the header clone to match the fixed header
    $('.header-clone').height($('#site-header .is-fixed').outerHeight());
    $('.header-static .header-clone').hide();

    let previousScroll = 0; // Store the previous scroll position

    // Scroll event listener
    $(window).on("scroll", function() {
        var currentScroll = $(window).scrollTop(); // Current scroll position
        var site_header = $('#site-header').outerHeight(); // Header height
        
        if (currentScroll > site_header && currentScroll < previousScroll) {
            // Scrolling up: Add sticky class and show header clone
            $('.site-header .is-fixed').addClass('is-stuck');
            $('.header-static .header-clone').show();
        } else if (currentScroll <= site_header || currentScroll > previousScroll) {
            // Scrolling down or above the header: Remove sticky class and hide header clone
            $('.site-header .is-fixed').removeClass('is-stuck');
            $('.header-static .header-clone').hide();
        }

        // Update the previous scroll position
        previousScroll = currentScroll;
    });

    /* --------------------------------------------------
    * mobile menu
    * --------------------------------------------------*/
    $('.mmenu_wrapper li:has(ul)').prepend('<span class="arrow"><i class="xp-webicon-signs-1"></i></span>');
    $(".mmenu_wrapper .mobile_mainmenu > li span.arrow").on('click',function() {
        $(this).parent().find("> ul").stop(true, true).slideToggle()
        $(this).toggleClass( "active" ); 
    });
	
	$( "#mmenu_toggle" ).on('click', function() {
		$(this).toggleClass( "active" );
		$(this).parents('.header_mobile').toggleClass( "open" );
		if ($(this).hasClass( "active" )) {
			$('.mobile_nav').stop(true, true).slideDown(100);
		}else{
			$('.mobile_nav').stop(true, true).slideUp(100);
		}		
	});

	/* --------------------------------------------------
    * gallery post
    * --------------------------------------------------*/
	$('.gallery-post').each( function () {
		var selector = $(this);
		selector.owlCarousel({
			rtl: rtl_owl(),
			autoplay:true,
			autoplayTimeout: 6000,
			loop:true,
			margin:0,
			responsiveClass:true,
			items:1,
			dots:true,
			nav:false,
			navText:['<i class="xp-webicon-left-arrow-2"></i>', '<i class="xp-webicon-arrowsoutline"></i>']
		});
	});

	/* --------------------------------------------------
    * popup video
    * --------------------------------------------------*/
  	var video_popup = $('.video-popup');
   	if (video_popup.length > 0 ) {
	   	video_popup.each( function(){
		   	$(this).lightGallery({
			   selector: '.btn-play',
		   	});
	   	});
	};

	/* --------------------------------------------------
    * filter projects
    * --------------------------------------------------*/
	function updateFilter() {
		$('.project_filters a').each(function() {
			var data_filter = this.getAttribute('data-filter');
			var num = $(this)
				.closest('.project-filter-wrapper')
				.find('.project-item')
				.filter(data_filter).length;
			$(this)
				.find('.filter-count')
				.text( num );
			if ( num != 0 && $(this).hasClass('empty') ) {
				$(this).removeClass('empty');
			}
		});
	}
	$('.project-filter-wrapper').each( function(){
		var $container = $(this).find('.projects-grid'); 
		$container.isotope({ 
			itemSelector : '.project-item', 
			animationEngine : 'css',
			masonry: {
				columnWidth: '.grid-sizer'
			},
		});

		var $optionSets  = $(this).find('.project_filters'),
			$optionLinks = $optionSets.find('a');

		$optionLinks.on('click', function(){
			var $this = $(this);

			if ( $this.hasClass('selected') ) {
				return false;
			}
			var $optionSet = $this.parents('.project_filters');
				$optionSet.find('.selected').removeClass('selected');
				$this.addClass('selected');

			var selector = $(this).attr('data-filter');
				$container.isotope({ 
					filter: selector 
				});
			return false;
		});
		/* count filters */
		updateFilter();
	});

	/* load more button */    
	$('#btn-loadmore').on('click',function(){
		var btn		= $(this),
			grid    = $(this).parents('.project-filter-wrapper').find('.projects-grid'),
			offset  = grid.find('.project-item').length,
			more    = grid.data('load'),
			loaded  = $(this).data('loaded'),
			loading = $(this).data('loading'),
			cat 	= $(this).data('category'),
			count   = grid.data('count');
		$.ajax({
			url : skinetic_loadmore_params.ajaxurl, // AJAX handler
			data : {
				'action': 'loadmore', // the parameter for admin-ajax.php
				'ppp'	: more,
				'cat'	: cat,
				'offset': offset,
			},
			type : 'POST',
			beforeSend : function ( xhr ) {
				btn.text(loading).append('<i class="xp-webicon-refresh fas fa-spin"></i>'); // some type of preloader
			},
			success : function( data ){
				if( data ) {
					var items = $(data);
					btn.text(loaded);
					grid.append(items).isotope('appended', items); // insert new posts
					updateFilter();
				} else {
					btn.hide(); // if no data, HIDE the button as well
				}
			}
		});
		offset += more;
		if( count <= offset ){
			btn.fadeOut(1000);
		}
		return false;
	});

	/* --------------------------------------------------
    * related projects
    * --------------------------------------------------*/
	$('.portfolio-related-posts').each( function () {
		var selector = $(this).find('.owl-carousel');
		selector.owlCarousel({
			rtl: rtl_owl(),
			autoplay:false,
			responsiveClass:true,
			dots:true,
			nav:false,
			navText:['<i class="xp-webicon-left-arrow-2"></i>', '<i class="xp-webicon-arrowsoutline"></i>'],
			responsive : {
				0 : {
					margin:0,
					items:1,
				},
				600 : {
					margin:15,
					items:2,
				},
				768 : {
					margin:30,
					items:2,
				},
				1024 : {
					margin:30,
					items:3,
				}
			}
		});
	});

	/* --------------------------------------------------
	* switcher
	* --------------------------------------------------*/
	var swt = $('.xp-switcher').find('.switch input');
	$('.skinetic_block_hidden').hide();
	swt.on( 'change', function() {
		var parent = $(this).parents('.e-parent');
		if(this.checked) {
			parent.find('.r-switch').addClass('active');
			parent.find('.l-switch').removeClass('active');
			parent.find('.skinetic_block_show').hide();
			parent.find('.skinetic_block_hidden').show();
		}else{
			parent.find('.l-switch').addClass('active');
			parent.find('.r-switch').removeClass('active');
			parent.find('.skinetic_block_hidden').hide();
			parent.find('.skinetic_block_show').show();
		}
	});

	/* --------------------------------------------------
    * big tabs
    * --------------------------------------------------*/
	$('.tab-titles .title-item a').on( 'click', function(){
		$('.tab-active').removeClass('tab-active');
		$(this).addClass('tab-active');
		$('.content-tab').hide();
		$($(this).attr('href')).show();

		return false;
	});
	$('.tab-titles .title-item:first a').trigger('click');

	/* --------------------------------------------------
    * Post Grid Isotop
    * --------------------------------------------------*/
    $(window).load( function () {
        if( $('.blog-grid').length > 0 ){
            var container = $('.blog-grid'); 
            container.isotope({ 
                itemSelector : '.masonry-post-item',
                isOriginLeft: rtl_isotop(),
                percentPosition: true,
            });
        };
    });

    /* --------------------------------------------------
    * back to top
    * --------------------------------------------------*/
    if ($('#back-to-top').length) {
	    var scrollTrigger = 500, // px
	        backToTop = function () {
	            var scrollTop = $(window).scrollTop();
	            if (scrollTop > scrollTrigger) {
	                $('#back-to-top').addClass('show');
	            } else {
	                $('#back-to-top').removeClass('show');
	            }
	        };
	    backToTop();
	    $(window).on('scroll', function () {
	        backToTop();
	    });
	    $('#back-to-top').on('click', function (e) {
	        e.preventDefault();
	        $('html,body').animate({
	            scrollTop: 0
	        }, 700);
	    });	
	}

	/*
	* Footer fixed
	*/
	var bumpIt = function () {
        if ($(window).width() > 1024) {
            $(".footer-fixed .site-content").css("margin-bottom", parseInt($(".footer-fixed .site-footer").height()));
        } else {
            $(".footer-fixed .site-content").css("margin-bottom", 0);
        }
    },
    didResize = false;
    setInterval(function () {
        bumpIt();
    }, 250);
    $(window).resize(function () {
        didResize = true;
    });
    setInterval(function () {
        if (didResize) {
            didResize = false;
            bumpIt();
        }
    }, 250);



    // Namespace setup with null check optimization
    if (typeof window.xptheme === 'undefined') {
        window.xptheme = {};
    }
    window.xpthemeCore = window.xpthemeCore || {};
    
    // Cached selectors and optimized initialization
    const SELECTORS = {
        holder: '.xptheme-interactive-link-showcase.xptheme-layout--list',
        images: '.xptheme-m-image',
        items: '.xptheme-m-item',
        active: 'xptheme--active',
        init: 'xptheme--init'
    };
    
    // Debounce function for performance
    function debounce(func, wait) {
        let timeout;
        return function executedFunction(...args) {
            const later = () => {
                clearTimeout(timeout);
                func.apply(this, args);
            };
            clearTimeout(timeout);
            timeout = setTimeout(later, wait);
        };
    }
    
    // Optimized interactive link showcase functionality
    xpthemeCore.shortcodes = {
        xp_core_interactive_link_showcase: {
            xpthemeInteractiveLinkShowcaseList: {
                // Cache for initialized elements to prevent re-initialization
                initializedElements: new WeakSet(),
                
                init: function() {
                    // Use modern selector with early return
                    const holders = document.querySelectorAll(SELECTORS.holder);
                    if (!holders.length) return;
                    
                    // Use DocumentFragment for batch DOM operations if needed
                    const fragment = document.createDocumentFragment();
                    
                    holders.forEach((holder) => {
                        // Skip if already initialized
                        if (this.initializedElements.has(holder)) return;
                        
                        this.initializeHolder(holder);
                        this.initializedElements.add(holder);
                    });
                },
                
                initializeHolder: function(holder) {
                    const images = holder.querySelectorAll(SELECTORS.images);
                    const items = holder.querySelectorAll(SELECTORS.items);
                    
                    if (!images.length || !items.length) return;
                    
                    // Batch DOM updates
                    requestAnimationFrame(() => {
                        // Set initial active states
                        if (images[0]) images[0].classList.add(SELECTORS.active);
                        if (items[0]) items[0].classList.add(SELECTORS.active);
                        
                        // Use event delegation for better performance
                        this.attachEventListeners(holder, images, items);
                        
                        // Mark as initialized
                        holder.classList.add(SELECTORS.init);
                    });
                },
                
                attachEventListeners: function(holder, images, items) {
                    // Debounced mouse enter handler for performance
                    const debouncedHandler = debounce((targetItem) => {
                        const index = Array.from(items).indexOf(targetItem);
                        if (index === -1) return;
                        
                        // Batch class operations
                        requestAnimationFrame(() => {
                            // Remove active classes efficiently
                            images.forEach(img => img.classList.remove(SELECTORS.active));
                            items.forEach(item => item.classList.remove(SELECTORS.active));
                            
                            // Add active classes
                            if (images[index]) images[index].classList.add(SELECTORS.active);
                            if (items[index]) items[index].classList.add(SELECTORS.active);
                        });
                    }, 16); // ~60fps throttling
                    
                    // Use event delegation on the holder
                    holder.addEventListener('mouseenter', (e) => {
                        const targetItem = e.target.closest(SELECTORS.items);
                        if (targetItem && holder.contains(targetItem)) {
                            debouncedHandler(targetItem);
                        }
                    }, { passive: true, capture: true });
                },
                
                // Method to reinitialize if needed
                reinit: function() {
                    this.initializedElements = new WeakSet();
                    this.init();
                }
            }
        }
    };
    
    // Optimized initialization with multiple fallbacks
    function initializeShowcase() {
        if (document.readyState === 'loading') {
            // DOM is still loading
            document.addEventListener('DOMContentLoaded', () => {
                xpthemeCore.shortcodes.xp_core_interactive_link_showcase.xpthemeInteractiveLinkShowcaseList.init();
            }, { once: true });
        } else {
            // DOM is already loaded
            xpthemeCore.shortcodes.xp_core_interactive_link_showcase.xpthemeInteractiveLinkShowcaseList.init();
        }
    }
    
    // Initialize immediately if possible, otherwise wait for DOM
    initializeShowcase();
    
    // Expose reinit method globally if needed
    window.xpthemeReinitShowcase = function() {
        xpthemeCore.shortcodes.xp_core_interactive_link_showcase.xpthemeInteractiveLinkShowcaseList.reinit();
    };

} )( jQuery );


