/**
 * Reaktion.js
 * Version: 1.0
 * URL: https://github.com/ryantbrown/reaktion.js
 * Description: A lightweight responsive, nested navigation plugin for jQuery
 * Author: Ryan Brown (http://me@ryantbrown.io) (http://ryantbrown.io)
 * Demo URL: http://ryantbrown.io/code/reaktionjs
 * License: MIT
 */

;(function(jQuery, document, window, undefined) {

    var reaktion, nav, menu, defaults = {
        breakPoint: 768,
        navIcon: '',
        arrows: true,
        arrowIcon: '<span class="genericon genericon-expand"></span>',
        arrowsToggleOnly: true,
        animate: true,
        effect: 'slide',
        speed: 300,
        animateSubNav: true,
        subNavEffect: 'slide',
        subNavSpeed: 300,
        onOpen: function(){jQuery( ".mmenu" ).addClass( "opened" );},
        onClose: function(){jQuery( ".mmenu" ).removeClass( "opened" );}
    };

    function Reaktion(element, options) {
        this.element = element;
        this.options = jQuery.extend({}, defaults, options);
        this._defaults = defaults;

        this._init();
    }

    Reaktion.prototype = {

        _init: function() {

            nav = jQuery(this.element);
            reaktion = this;
            menu = jQuery(this.element).find('ul:first');

            nav.append('<div class="nav-bars">'+this.options.navIcon+'</div>');

            jQuery('.nav-bars').click(function() {
                menu.is(':visible') ? reaktion.close() : reaktion.open();
            });

            if(this.options.arrows) {
                nav.find('ul > li.menu-item-has-children')
                      .prepend('<span class="arrow">'+this.options.arrowIcon+'</span>');
                menu.on('click', 'span.arrow', function() {
                    reaktion._toggleSubNav(jQuery(this));
                });
            } else {
                nav.find('ul > li').not('ul > li > ul li').has('ul')
                      .prepend('<span class="arrow" style="padding:0;"></span>');
            }

            if(!this.options.arrows || !this.options.arrowsToggleOnly) {
                nav.find('ul > li').not('ul > li > ul li').has('ul').find('a').on('click', function(){
                    reaktion._toggleSubNav(jQuery(this));
                });
            }

            reaktion._resize();

            jQuery(window).resize(function(){
                reaktion._resize();
            });

        },

        _resize: function() {
            if(jQuery(window).width() > this.options.breakPoint) {
                nav.removeClass('mobile');
                nav.find('ul:first').show().find('.arrow').removeClass('arrow-rotate')
                .parent().find('ul').hide();

                nav.find('ul:first > li').hover(function() {
                    if(!nav.hasClass('mobile')) {
                        jQuery(this).find('ul').show();
                    }
                }, function(){
                    if(!nav.hasClass('mobile')) {
                        jQuery(this).find('ul').hide();
                    }
                });

            } else {
                if(!jQuery(this.element).hasClass('mobile')) {
                    jQuery(this.element).addClass('mobile');
                }
                jQuery(this.element).unbind('mouseenter mouseleave');
            }
        },

        _toggleSubNav: function(arrow) {
            if(jQuery('.nav-bars').is(':visible')) {
                if(this.options.animateSubNav) {
                    this.options.subNavEffect == 'slide' ?
                        arrow.siblings('ul').slideToggle(this.options.subNavSpeed) :
                        arrow.siblings('ul').fadeToggle(this.options.subNavSpeed);
                } else {
                    arrow.siblings('ul').toggle();
                }
                if(this.options.arrows) {
                    arrow.toggleClass('arrow-rotate');
                }
            }
        },

        open: function() {
            if(!menu.is(':visible')) {
                if(this.options.animate) {
                    this.options.effect == 'slide' ?
                        menu.slideDown(this.options.speed, function(){
                            if(typeof reaktion.options.onOpen === 'function'){
                                reaktion.options.onOpen.call(this);
                            }
                        }) :
                        menu.fadeIn(this.options.speed, function(){
                           if(typeof reaktion.options.onOpen === 'function'){
                                reaktion.options.onOpen.call(this);
                            }
                        });
                } else {
                    menu.show(function(){
                        if(typeof reaktion.options.onOpen === 'function'){
                            reaktion.options.onOpen.call(this);
                        }
                    });
                }
            }
        },

        close: function() {
            if(menu.is(':visible')) {
                if(this.options.animate) {
                   this.options.effect == 'slide' ?
                        menu.slideUp(this.options.speed, function(){
                            if(typeof reaktion.options.onClose === 'function'){
                                reaktion.options.onClose.call(this);
                            }
                        }) :
                        menu.fadeOut(this.options.speed, function(){
                            if(typeof reaktion.options.onClose === 'function'){
                                reaktion.options.onClose.call(this);
                            }
                        });
                } else {
                    menu.hide(function(){
                        if(typeof reaktion.options.onClose === 'function'){
                            reaktion.options.onClose.call(this);
                        }
                    });
                }
            }
        },

        toggle: function(){
            menu.is(':visible') ? this.close() : this.open();
        }

    };

    jQuery.fn['reaktion'] = function(args) {
        if (!jQuery(this).length) {
            return jQuery(this);
        }
        var instance = jQuery(this).data('reaktion');

        if(instance && instance[args]  && args.indexOf('_') != 0 && typeof instance[args] === 'function') {
            return instance[args].apply(instance, Array.prototype.slice.call(arguments, 1));
        } else if(typeof args === 'object' || !args) {
            instance = new Reaktion(jQuery(this), args);
            jQuery(this).data('reaktion', instance);
            return this;
        } else if(args.indexOf('_') == 0) {
            jQuery.error('The ' + args + ' method is private and cannot be called publicly');
        } else {
            jQuery.error('Method ' + args + ' does not exist in reaktion');
        }
    };

})(jQuery, document, window);
jQuery(document).ready(function(jQuery) {
			jQuery('.mmenu').reaktion();
		});