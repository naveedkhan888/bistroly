(function($) {
    'use strict';

    const AnimatedImageReveal = {
        init: function() {
            this.setupObserver();
            this.bindEvents();
        },

        bindEvents: function() {
            $(window).on('elementor/frontend/init', function() {
                elementorFrontend.hooks.addAction('frontend/element_ready/animated-image-reveal.default', function($scope) {
                    AnimatedImageReveal.initWidget($scope);
                });
            });
        },

        setupObserver: function() {
            if ('IntersectionObserver' in window) {
                this.observer = new IntersectionObserver(
                    this.handleIntersection.bind(this),
                    {
                        threshold: [0, 0.1, 0.2, 0.3, 0.4, 0.5, 0.6, 0.7, 0.8, 0.9, 1.0],
                        rootMargin: '0px'
                    }
                );
            }
        },

        initWidget: function($scope) {
            const $imageContainer = $scope.find('.xp-animated-image');
            
            if ($imageContainer.length && this.observer) {
                this.observer.observe($imageContainer[0]);
            }
        },

        handleIntersection: function(entries) {
            entries.forEach(entry => {
                const $element = $(entry.target);
                const triggerOffset = parseFloat($element.data('trigger-offset')) / 100 || 0.8;

                if (entry.intersectionRatio >= triggerOffset && !$element.hasClass('revealed')) {
                    this.animateReveal($element);
                }
            });
        },

        animateReveal: function($element) {
            const direction = $element.data('reveal-direction') || 'left';
            const duration = parseInt($element.data('duration')) || 1200;
            const delay = parseInt($element.data('delay')) || 0;
            const easing = $element.data('easing') || 'ease-out';
            const overlayColor = $element.data('overlay-color') || '#000000';

            const $overlay = $element.find('.reveal-overlay');
            const $image = $element.find('img');

            // Set overlay color
            $overlay.css('background-color', overlayColor);

            // Mark as being animated
            $element.addClass('animating');

            // Set initial states based on direction
            this.setInitialState($overlay, $image, direction);

            // Trigger animation after delay
            setTimeout(() => {
                this.performAnimation($overlay, $image, direction, duration, easing, $element);
            }, delay);
        },

        setInitialState: function($overlay, $image, direction) {
            const directions = {
                'left': {
                    overlay: { left: '0', right: 'auto', width: '0%', height: '100%', top: '0' },
                    image: { transform: 'translateX(-50px)', opacity: 0 }
                },
                'right': {
                    overlay: { right: '0', left: 'auto', width: '0%', height: '100%', top: '0' },
                    image: { transform: 'translateX(50px)', opacity: 0 }
                },
                'top': {
                    overlay: { top: '0', bottom: 'auto', height: '0%', width: '100%', left: '0' },
                    image: { transform: 'translateY(-50px)', opacity: 0 }
                },
                'bottom': {
                    overlay: { bottom: '0', top: 'auto', height: '0%', width: '100%', left: '0' },
                    image: { transform: 'translateY(50px)', opacity: 0 }
                },
                'center': {
                    overlay: { top: '50%', left: '50%', width: '0%', height: '0%', transform: 'translate(-50%, -50%)' },
                    image: { transform: 'scale(0.8)', opacity: 0 }
                },
                'zoom': {
                    overlay: { top: '0', left: '0', width: '100%', height: '100%', opacity: 1 },
                    image: { transform: 'scale(1.2)', opacity: 0 }
                }
            };

            const config = directions[direction] || directions['left'];

            $overlay.css({
                position: 'absolute',
                'z-index': 2,
                ...config.overlay
            });

            $image.css({
                ...config.image,
                transition: 'none'
            });
        },

        performAnimation: function($overlay, $image, direction, duration, easing, $element) {
            const halfDuration = duration / 2;

            // Step 1: Expand overlay
            setTimeout(() => {
                this.expandOverlay($overlay, direction, halfDuration, easing);
            }, 50);

            // Step 2: Show image and contract overlay
            setTimeout(() => {
                this.revealImage($image, $overlay, direction, halfDuration, easing);
            }, halfDuration + 100);

            // Step 3: Complete animation
            setTimeout(() => {
                $element.addClass('revealed').removeClass('animating');
                $overlay.remove();
            }, duration + 200);
        },

        expandOverlay: function($overlay, direction, duration, easing) {
            const expansions = {
                'left': { width: '100%' },
                'right': { width: '100%' },
                'top': { height: '100%' },
                'bottom': { height: '100%' },
                'center': { width: '100%', height: '100%' },
                'zoom': { opacity: 0 }
            };

            $overlay.css({
                transition: `all ${duration}ms ${easing}`
            }).css(expansions[direction] || expansions['left']);
        },

        revealImage: function($image, $overlay, direction, duration, easing) {
            // Reveal image
            $image.css({
                transition: `all ${duration}ms ${easing}`,
                transform: direction === 'zoom' ? 'scale(1)' : direction === 'center' ? 'scale(1)' : 'translate(0, 0)',
                opacity: 1
            });

            // Contract overlay
            const contractions = {
                'left': { left: 'auto', right: '0', width: '0%' },
                'right': { right: 'auto', left: '0', width: '0%' },
                'top': { top: 'auto', bottom: '0', height: '0%' },
                'bottom': { bottom: 'auto', top: '0', height: '0%' },
                'center': { width: '0%', height: '0%' },
                'zoom': { opacity: 0 }
            };

            $overlay.css(contractions[direction] || contractions['left']);
        }
    };

    // Initialize on DOM ready
    $(window).on('load', function() {
        AnimatedImageReveal.init();
    });

})(jQuery);