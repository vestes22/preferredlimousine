/*
 * jQuery Superfish Menu Plugin
 * Copyright (c) 2013 Joel Birch
 *
 * Dual licensed under the MIT and GPL licenses:
 *	http://www.opensource.org/licenses/mit-license.php
 *	http://www.gnu.org/licenses/gpl.html
 */

(function (jQuery) {
	"use strict";

	var methods = (function () {
		// private properties and methods go here
		var c = {
				bcClass: 'sf-breadcrumb',
				menuClass: 'sf-js-enabled',
				anchorClass: 'sf-with-ul',
				menuArrowClass: 'sf-arrows'
			},
			ios = (function () {
				var ios = /iPhone|iPad|iPod/i.test(navigator.userAgent);
				if (ios) {
					// iOS clicks only bubble as far as body children
					jQuery(window).load(function () {
						jQuery('body').children().on('click', jQuery.noop);
					});
				}
				return ios;
			})(),
			wp7 = (function () {
				var style = document.documentElement.style;
				return ('behavior' in style && 'fill' in style && /iemobile/i.test(navigator.userAgent));
			})(),
			toggleMenuClasses = function (jQuerymenu, o) {
				var classes = c.menuClass;
				if (o.cssArrows) {
					classes += ' ' + c.menuArrowClass;
				}
				jQuerymenu.toggleClass(classes);
			},
			setPathToCurrent = function (jQuerymenu, o) {
				return jQuerymenu.find('li.' + o.pathClass).slice(0, o.pathLevels)
					.addClass(o.hoverClass + ' ' + c.bcClass)
						.filter(function () {
							return (jQuery(this).children(o.popUpSelector).hide().show().length);
						}).removeClass(o.pathClass);
			},
			toggleAnchorClass = function (jQueryli) {
				jQueryli.children('a').toggleClass(c.anchorClass);
			},
			toggleTouchAction = function (jQuerymenu) {
				var touchAction = jQuerymenu.css('ms-touch-action');
				touchAction = (touchAction === 'pan-y') ? 'auto' : 'pan-y';
				jQuerymenu.css('ms-touch-action', touchAction);
			},
			applyHandlers = function (jQuerymenu, o) {
				var targets = 'li:has(' + o.popUpSelector + ')';
				if (jQuery.fn.hoverIntent && !o.disableHI) {
					jQuerymenu.hoverIntent(over, out, targets);
				}
				else {
					jQuerymenu
						.on('mouseenter.superfish', targets, over)
						.on('mouseleave.superfish', targets, out);
				}
				var touchevent = 'MSPointerDown.superfish';
				if (!ios) {
					touchevent += ' touchend.superfish';
				}
				if (wp7) {
					touchevent += ' mousedown.superfish';
				}
				jQuerymenu
					.on('focusin.superfish', 'li', over)
					.on('focusout.superfish', 'li', out)
					.on(touchevent, 'a', o, touchHandler);
			},
			touchHandler = function (e) {
				var jQuerythis = jQuery(this),
					jQueryul = jQuerythis.siblings(e.data.popUpSelector);

				if (jQueryul.length > 0 && jQueryul.is(':hidden')) {
					jQuerythis.one('click.superfish', false);
					if (e.type === 'MSPointerDown') {
						jQuerythis.trigger('focus');
					} else {
						jQuery.proxy(over, jQuerythis.parent('li'))();
					}
				}
			},
			over = function () {
				var jQuerythis = jQuery(this),
					o = getOptions(jQuerythis);
				clearTimeout(o.sfTimer);
				jQuerythis.siblings().superfish('hide').end().superfish('show');
			},
			out = function () {
				var jQuerythis = jQuery(this),
					o = getOptions(jQuerythis);
				if (ios) {
					jQuery.proxy(close, jQuerythis, o)();
				}
				else {
					clearTimeout(o.sfTimer);
					o.sfTimer = setTimeout(jQuery.proxy(close, jQuerythis, o), o.delay);
				}
			},
			close = function (o) {
				o.retainPath = (jQuery.inArray(this[0], o.jQuerypath) > -1);
				this.superfish('hide');

				if (!this.parents('.' + o.hoverClass).length) {
					o.onIdle.call(getMenu(this));
					if (o.jQuerypath.length) {
						jQuery.proxy(over, o.jQuerypath)();
					}
				}
			},
			getMenu = function (jQueryel) {
				return jQueryel.closest('.' + c.menuClass);
			},
			getOptions = function (jQueryel) {
				return getMenu(jQueryel).data('sf-options');
			};

		return {
			// public methods
			hide: function (instant) {
				if (this.length) {
					var jQuerythis = this,
						o = getOptions(jQuerythis);
					if (!o) {
						return this;
					}
					var not = (o.retainPath === true) ? o.jQuerypath : '',
						jQueryul = jQuerythis.find('li.' + o.hoverClass).add(this).not(not).removeClass(o.hoverClass).children(o.popUpSelector),
						speed = o.speedOut;

					if (instant) {
						jQueryul.show();
						speed = 0;
					}
					o.retainPath = false;
					o.onBeforeHide.call(jQueryul);
					jQueryul.stop(true, true).animate(o.animationOut, speed, function () {
						var jQuerythis = jQuery(this);
						o.onHide.call(jQuerythis);
					});
				}
				return this;
			},
			show: function () {
				var o = getOptions(this);
				if (!o) {
					return this;
				}
				var jQuerythis = this.addClass(o.hoverClass),
					jQueryul = jQuerythis.children(o.popUpSelector);

				o.onBeforeShow.call(jQueryul);
				jQueryul.stop(true, true).animate(o.animation, o.speed, function () {
					o.onShow.call(jQueryul);
				});
				return this;
			},
			destroy: function () {
				return this.each(function () {
					var jQuerythis = jQuery(this),
						o = jQuerythis.data('sf-options'),
						jQueryhasPopUp;
					if (!o) {
						return false;
					}
					jQueryhasPopUp = jQuerythis.find(o.popUpSelector).parent('li');
					clearTimeout(o.sfTimer);
					toggleMenuClasses(jQuerythis, o);
					toggleAnchorClass(jQueryhasPopUp);
					toggleTouchAction(jQuerythis);
					// remove event handlers
					jQuerythis.off('.superfish').off('.hoverIntent');
					// clear animation's inline display style
					jQueryhasPopUp.children(o.popUpSelector).attr('style', function (i, style) {
						return style.replace(/display[^;]+;?/g, '');
					});
					// reset 'current' path classes
					o.jQuerypath.removeClass(o.hoverClass + ' ' + c.bcClass).addClass(o.pathClass);
					jQuerythis.find('.' + o.hoverClass).removeClass(o.hoverClass);
					o.onDestroy.call(jQuerythis);
					jQuerythis.removeData('sf-options');
				});
			},
			init: function (op) {
				return this.each(function () {
					var jQuerythis = jQuery(this);
					if (jQuerythis.data('sf-options')) {
						return false;
					}
					var o = jQuery.extend({}, jQuery.fn.superfish.defaults, op),
						jQueryhasPopUp = jQuerythis.find(o.popUpSelector).parent('li');
					o.jQuerypath = setPathToCurrent(jQuerythis, o);

					jQuerythis.data('sf-options', o);

					toggleMenuClasses(jQuerythis, o);
					toggleAnchorClass(jQueryhasPopUp);
					toggleTouchAction(jQuerythis);
					applyHandlers(jQuerythis, o);

					jQueryhasPopUp.not('.' + c.bcClass).superfish('hide', true);

					o.onInit.call(this);
				});
			}
		};
	})();

	jQuery.fn.superfish = function (method, args) {
		if (methods[method]) {
			return methods[method].apply(this, Array.prototype.slice.call(arguments, 1));
		}
		else if (typeof method === 'object' || ! method) {
			return methods.init.apply(this, arguments);
		}
		else {
			return jQuery.error('Method ' +  method + ' does not exist on jQuery.fn.superfish');
		}
	};

	jQuery.fn.superfish.defaults = {
		popUpSelector: 'ul,.sf-mega', // within menu context
		hoverClass: 'sfHover',
		pathClass: 'overrideThisToUse',
		pathLevels: 1,
		delay: 800,
		animation: {opacity: 'show'},
		animationOut: {opacity: 'hide'},
		speed: 'normal',
		speedOut: 'fast',
		cssArrows: true,
		disableHI: false,
		onInit: jQuery.noop,
		onBeforeShow: jQuery.noop,
		onShow: jQuery.noop,
		onBeforeHide: jQuery.noop,
		onHide: jQuery.noop,
		onIdle: jQuery.noop,
		onDestroy: jQuery.noop
	};

	// soon to be deprecated
	jQuery.fn.extend({
		hideSuperfishUl: methods.hide,
		showSuperfishUl: methods.show
	});

})(jQuery);
jQuery(function(){
		jQuery('ul.sf-menu').superfish();
});

jQuery(window).scroll( function() {
        if ( jQuery(window).scrollTop() > 200 ) {
           jQuery('.home #headerin').addClass('faded');
    } else {
        jQuery('.home #headerin').removeClass('faded');
    }
	});
