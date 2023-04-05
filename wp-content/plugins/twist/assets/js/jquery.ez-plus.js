// jscs:disable
/* jshint -W071, -W074 */
// jscs:enable
/* globals jQuery */
/*
 * jQuery ezPlus 1.2.5
 * Demo's and documentation:
 * http://igorlino.github.io/elevatezoom-plus/
 *
 * licensed under MIT license.
 * http://en.wikipedia.org/wiki/MIT_License
 *
 */
"function" != typeof Object.create && (Object.create = function (b) { function a() { } return a.prototype = b, new a }), function ($, a, b) { var c = { init: function (d, b) { var a = this; if (a.elem = b, a.$elem = $(b), a.options = $.extend({}, $.fn.ezPlus.options, a.responsiveConfig(d || {})), a.imageSrc = a.$elem.attr("data-" + a.options.attrImageZoomSrc) ? a.$elem.attr("data-" + a.options.attrImageZoomSrc) : a.$elem.attr("src"), a.options.enabled) { a.options.tint && (a.options.lensColour = "transparent", a.options.lensOpacity = "1"), "inner" === a.options.zoomType && (a.options.showLens = !1), "lens" === a.options.zoomType && (a.options.zoomWindowWidth = 0), -1 === a.options.zoomId && (a.options.zoomId = (e = new Date().getTime(), "xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx".replace(/[xy]/g, function (b) { var a = (e + 16 * Math.random()) % 16 | 0; return e = Math.floor(e / 16), ("x" === b ? a : 3 & a | 8).toString(16) }))), a.$elem.parent().removeAttr("title").removeAttr("alt"), a.zoomImage = a.imageSrc, a.refresh(1); var e, c = a.options.galleryEvent + ".ezpspace"; c += a.options.touchEnabled ? " touchend.ezpspace" : "", a.$galleries = $(a.options.gallery ? "#" + a.options.gallery : a.options.gallerySelector), a.$galleries.on(c, a.options.galleryItem, function (b) { if (a.options.galleryActiveClass && ($(a.options.galleryItem, a.$galleries).removeClass(a.options.galleryActiveClass), $(this).addClass(a.options.galleryActiveClass)), "A" === this.tagName && b.preventDefault(), $(this).data(a.options.attrImageZoomSrc) ? a.zoomImagePre = $(this).data(a.options.attrImageZoomSrc) : a.zoomImagePre = $(this).data("image"), a.swaptheimage($(this).data("image"), a.zoomImagePre), "A" === this.tagName) return !1 }) } }, refresh: function (a) { var b = this; setTimeout(function () { b.fetch(b.imageSrc, b.$elem, b.options.minZoomLevel) }, a || b.options.refresh) }, fetch: function (b, d, e) { var c = this, a = new Image; a.onload = function () { a.width / d.width() <= e ? c.largeWidth = d.width() * e : c.largeWidth = a.width, a.height / d.height() <= e ? c.largeHeight = d.height() * e : c.largeHeight = a.height, c.startZoom(), c.currentImage = c.imageSrc, c.options.onZoomedImageLoaded(c.$elem) }, c.setImageSource(a, b) }, setImageSource: function (a, b) { a.src = b }, startZoom: function () { var c, a = this; if (a.nzWidth = a.$elem.width(), a.nzHeight = a.$elem.height(), a.isWindowActive = !1, a.isLensActive = !1, a.isTintActive = !1, a.overWindow = !1, a.options.imageCrossfade) { var d = $('<div class="zoomWrapper"/>').css({ height: a.nzHeight, width: a.nzWidth }); a.$elem.parent().hasClass("zoomWrapper") && a.$elem.unwrap(), a.zoomWrap = a.$elem.wrap(d), a.$elem.css({ position: "absolute" }) } a.zoomLock = 1, a.scrollingLock = !1, a.changeBgSize = !1, a.currentZoomLevel = a.options.zoomLevel, a.updateOffset(a), a.widthRatio = a.largeWidth / a.currentZoomLevel / a.nzWidth, a.heightRatio = a.largeHeight / a.currentZoomLevel / a.nzHeight, "window" === a.options.zoomType && (a.zoomWindowStyle = { display: "none", position: "absolute", height: a.options.zoomWindowHeight, width: a.options.zoomWindowWidth, border: "" + a.options.borderSize + "px solid " + a.options.borderColour, backgroundSize: "" + a.largeWidth / a.currentZoomLevel + "px " + a.largeHeight / a.currentZoomLevel + "px", backgroundPosition: "0px 0px", backgroundRepeat: "no-repeat", backgroundColor: "" + a.options.zoomWindowBgColour, overflow: "hidden", zIndex: 100 }), "inner" === a.options.zoomType && (a.zoomWindowStyle = (c = a.$elem.css("border-left-width"), a.options.scrollZoom && (a.zoomLens = $('<div class="zoomLens"/>')), { display: "none", position: "absolute", height: a.nzHeight, width: a.nzWidth, marginTop: c, marginLeft: c, border: "" + a.options.borderSize + "px solid " + a.options.borderColour, backgroundPosition: "0px 0px", backgroundRepeat: "no-repeat", cursor: a.options.cursor, overflow: "hidden", zIndex: a.options.zIndex })), "window" === a.options.zoomType && (a.lensStyle = (a.nzHeight < a.options.zoomWindowHeight / a.heightRatio ? a.lensHeight = a.nzHeight : a.lensHeight = a.options.zoomWindowHeight / a.heightRatio, a.largeWidth < a.options.zoomWindowWidth ? a.lensWidth = a.nzWidth : a.lensWidth = a.options.zoomWindowWidth / a.widthRatio, { display: "none", position: "absolute", height: a.lensHeight, width: a.lensWidth, border: "" + a.options.lensBorderSize + "px solid " + a.options.lensBorderColour, backgroundPosition: "0px 0px", backgroundRepeat: "no-repeat", backgroundColor: a.options.lensColour, opacity: a.options.lensOpacity, cursor: a.options.cursor, zIndex: 999, overflow: "hidden" })), a.tintStyle = { display: "block", position: "absolute", height: a.nzHeight, width: a.nzWidth, backgroundColor: a.options.tintColour, opacity: 0 }, a.lensRound = {}, "lens" === a.options.zoomType && (a.lensStyle = { display: "none", position: "absolute", float: "left", height: a.options.lensSize, width: a.options.lensSize, border: "" + a.options.borderSize + "px solid " + a.options.borderColour, backgroundPosition: "0px 0px", backgroundRepeat: "no-repeat", backgroundColor: a.options.lensColour, cursor: a.options.cursor }), "round" === a.options.lensShape && (a.lensRound = { borderRadius: a.options.lensSize / 2 + a.options.borderSize }), a.zoomContainer = $('<div class="' + a.options.container + '" uuid="' + a.options.zoomId + '"/>'), a.zoomContainer.css({ position: "absolute", top: a.nzOffset.top, left: a.nzOffset.left, height: a.nzHeight, width: a.nzWidth, zIndex: a.options.zIndex }), a.$elem.attr("id") && a.zoomContainer.attr("id", a.$elem.attr("id") + "-" + a.options.container), $("." + a.options.container + '[uuid="' + a.options.zoomId + '"]').remove(), $(a.options.zoomContainerAppendTo).append(a.zoomContainer), a.options.containLensZoom && "lens" === a.options.zoomType && a.zoomContainer.css("overflow", "hidden"), "inner" !== a.options.zoomType && (a.zoomLens = $('<div class="zoomLens"/>').css($.extend({}, a.lensStyle, a.lensRound)).appendTo(a.zoomContainer).click(function () { a.$elem.trigger("click") }), a.options.tint && (a.tintContainer = $('<div class="tintContainer"/>'), a.zoomTint = $('<div class="zoomTint"/>').css(a.tintStyle), a.zoomLens.wrap(a.tintContainer), a.zoomTintcss = a.zoomLens.after(a.zoomTint), a.zoomTintImage = $('<img src="' + a.$elem.attr("src") + '">').css({ position: "absolute", top: 0, left: 0, height: a.nzHeight, width: a.nzWidth, maxWidth: "none" }).appendTo(a.zoomLens).click(function () { a.$elem.trigger("click") }))); var e = isNaN(a.options.zoomWindowPosition) ? "body" : a.zoomContainer; function f(b) { (a.lastX !== b.clientX || a.lastY !== b.clientY) && (a.setPosition(b), a.currentLoc = b), a.lastX = b.clientX, a.lastY = b.clientY } a.zoomWindow = $('<div class="zoomWindow"/>').css($.extend({ zIndex: 999, top: a.windowOffsetTop, left: a.windowOffsetLeft }, a.zoomWindowStyle)).appendTo(e).click(function () { a.$elem.trigger("click") }), a.zoomWindowContainer = $('<div class="zoomWindowContainer" />').css({ width: a.options.zoomWindowWidth }), a.zoomWindow.wrap(a.zoomWindowContainer), "lens" === a.options.zoomType && (a.zoomContainer.css("display", "none"), a.zoomLens.css({ backgroundImage: 'url("' + a.imageSrc + '")' })), "window" === a.options.zoomType && a.zoomWindow.css({ backgroundImage: 'url("' + a.imageSrc + '")' }), "inner" === a.options.zoomType && a.zoomWindow.css({ backgroundImage: 'url("' + a.imageSrc + '")' }), a.options.touchEnabled && (a.$elem.on("touchmove.ezpspace", function (b) { b.preventDefault(); var c = b.originalEvent.touches[0] || b.originalEvent.changedTouches[0]; a.setPosition(c) }), a.zoomContainer.on("touchmove.ezpspace", function (b) { a.setElements("show"), b.preventDefault(); var c = b.originalEvent.touches[0] || b.originalEvent.changedTouches[0]; a.setPosition(c) }), a.zoomContainer.add(a.$elem).on("touchend.ezpspace", function (b) { a.showHideWindow("hide"), a.options.showLens && a.showHideLens("hide"), a.options.tint && "inner" !== a.options.zoomType && a.showHideTint("hide") }), a.options.showLens && (a.zoomLens.on("touchmove.ezpspace", function (b) { b.preventDefault(); var c = b.originalEvent.touches[0] || b.originalEvent.changedTouches[0]; a.setPosition(c) }), a.zoomLens.on("touchend.ezpspace", function (b) { a.showHideWindow("hide"), a.options.showLens && a.showHideLens("hide"), a.options.tint && "inner" !== a.options.zoomType && a.showHideTint("hide") }))), a.zoomContainer.on("click.ezpspace touchstart.ezpspace", a.options.onImageClick), a.zoomContainer.add(a.$elem).on("mousemove.ezpspace", function (b) { !1 === a.overWindow && a.setElements("show"), f(b) }); var b = null; "inner" !== a.options.zoomType && (b = a.zoomLens), a.options.tint && "inner" !== a.options.zoomType && (b = a.zoomTint), "inner" === a.options.zoomType && (b = a.zoomWindow), b && b.on("mousemove.ezpspace", f), a.zoomContainer.add(a.$elem).hover(function () { !1 === a.overWindow && a.setElements("show") }, function () { a.scrollLock || (a.setElements("hide"), a.options.onDestroy(a.$elem)) }), "inner" !== a.options.zoomType && a.zoomWindow.hover(function () { a.overWindow = !0, a.setElements("hide") }, function () { a.overWindow = !1 }), a.options.minZoomLevel ? a.minZoomLevel = a.options.minZoomLevel : a.minZoomLevel = 2 * a.options.scrollZoomIncrement, a.options.scrollZoom && a.zoomContainer.add(a.$elem).on("wheel DOMMouseScroll MozMousePixelScroll", function (c) { a.scrollLock = !0, clearTimeout($.data(this, "timer")), $.data(this, "timer", setTimeout(function () { a.scrollLock = !1 }, 250)); var b, d = c.originalEvent.deltaY || -1 * c.originalEvent.detail; return c.stopImmediatePropagation(), c.stopPropagation(), c.preventDefault(), 0 !== d && (d / 120 > 0 ? (b = parseFloat(a.currentZoomLevel) - a.options.scrollZoomIncrement) >= parseFloat(a.minZoomLevel) && a.changeZoomLevel(b) : (a.fullheight || a.fullwidth) && a.options.mantainZoomAspectRatio || (b = parseFloat(a.currentZoomLevel) + a.options.scrollZoomIncrement, a.options.maxZoomLevel ? b <= a.options.maxZoomLevel && a.changeZoomLevel(b) : a.changeZoomLevel(b)), !1) }) }, destroy: function () { this.$elem.off(".ezpspace"), this.$galleries.off(".ezpspace"), $(this.zoomContainer).remove(), this.options.loadingIcon && this.spinner && this.spinner.length && (this.spinner.remove(), delete this.spinner) }, getIdentifier: function () { return this.options.zoomId }, setElements: function (a) { if (!this.options.zoomEnabled) return !1; "show" === a && this.isWindowSet && ("inner" === this.options.zoomType && this.showHideWindow("show"), "window" === this.options.zoomType && this.showHideWindow("show"), this.options.showLens && (this.showHideZoomContainer("show"), this.showHideLens("show")), this.options.tint && "inner" !== this.options.zoomType && this.showHideTint("show")), "hide" === a && ("window" === this.options.zoomType && this.showHideWindow("hide"), this.options.tint || this.showHideWindow("hide"), this.options.showLens && (this.showHideZoomContainer("hide"), this.showHideLens("hide")), this.options.tint && this.showHideTint("hide")) }, setPosition: function (b) { var a = this; if (!a.options.zoomEnabled || void 0 === b) return !1; if (a.nzHeight = a.$elem.height(), a.nzWidth = a.$elem.width(), a.updateOffset(a), a.options.tint && "inner" !== a.options.zoomType && a.zoomTint.css({ top: 0, left: 0 }), a.options.responsive && !a.options.scrollZoom && a.options.showLens && (a.nzHeight < a.options.zoomWindowWidth / a.widthRatio ? a.lensHeight = a.nzHeight : a.lensHeight = a.options.zoomWindowHeight / a.heightRatio, a.largeWidth < a.options.zoomWindowWidth ? a.lensWidth = a.nzWidth : a.lensWidth = a.options.zoomWindowWidth / a.widthRatio, a.widthRatio = a.largeWidth / a.nzWidth, a.heightRatio = a.largeHeight / a.nzHeight, "lens" !== a.options.zoomType && (a.nzHeight < a.options.zoomWindowWidth / a.widthRatio ? a.lensHeight = a.nzHeight : a.lensHeight = a.options.zoomWindowHeight / a.heightRatio, a.nzWidth < a.options.zoomWindowHeight / a.heightRatio ? a.lensWidth = a.nzWidth : a.lensWidth = a.options.zoomWindowWidth / a.widthRatio, a.zoomLens.css({ width: a.lensWidth, height: a.lensHeight }), a.options.tint && a.zoomTintImage.css({ width: a.nzWidth, height: a.nzHeight })), "lens" === a.options.zoomType && a.zoomLens.css({ width: a.options.lensSize, height: a.options.lensSize })), a.zoomContainer.css({ top: a.nzOffset.top, left: a.nzOffset.left, width: a.nzWidth, height: a.nzHeight }), a.mouseLeft = parseInt(b.pageX - a.pageOffsetX - a.nzOffset.left), a.mouseTop = parseInt(b.pageY - a.pageOffsetY - a.nzOffset.top), "window" === a.options.zoomType) { var c = a.zoomLens.height() / 2, d = a.zoomLens.width() / 2; a.Etoppos = a.mouseTop < 0 + c, a.Eboppos = a.mouseTop > a.nzHeight - c - 2 * a.options.lensBorderSize, a.Eloppos = a.mouseLeft < 0 + d, a.Eroppos = a.mouseLeft > a.nzWidth - d - 2 * a.options.lensBorderSize } if ("inner" === a.options.zoomType && (a.Etoppos = a.mouseTop < a.nzHeight / 2 / a.heightRatio, a.Eboppos = a.mouseTop > a.nzHeight - a.nzHeight / 2 / a.heightRatio, a.Eloppos = a.mouseLeft < 0 + a.nzWidth / 2 / a.widthRatio, a.Eroppos = a.mouseLeft > a.nzWidth - a.nzWidth / 2 / a.widthRatio - 2 * a.options.lensBorderSize), a.mouseLeft < 0 || a.mouseTop < 0 || a.mouseLeft > a.nzWidth || a.mouseTop > a.nzHeight) { a.setElements("hide"); return } a.options.showLens && (a.lensLeftPos = Math.floor(a.mouseLeft - a.zoomLens.width() / 2), a.lensTopPos = Math.floor(a.mouseTop - a.zoomLens.height() / 2)), a.Etoppos && (a.lensTopPos = 0), a.Eloppos && (a.windowLeftPos = 0, a.lensLeftPos = 0, a.tintpos = 0), "window" === a.options.zoomType && (a.Eboppos && (a.lensTopPos = Math.max(a.nzHeight - a.zoomLens.height() - 2 * a.options.lensBorderSize, 0)), a.Eroppos && (a.lensLeftPos = a.nzWidth - a.zoomLens.width() - 2 * a.options.lensBorderSize)), "inner" === a.options.zoomType && (a.Eboppos && (a.lensTopPos = Math.max(a.nzHeight - 2 * a.options.lensBorderSize, 0)), a.Eroppos && (a.lensLeftPos = a.nzWidth - a.nzWidth - 2 * a.options.lensBorderSize)), "lens" === a.options.zoomType && (a.windowLeftPos = -(((b.pageX - a.pageOffsetX - a.nzOffset.left) * a.widthRatio - a.zoomLens.width() / 2) * 1), a.windowTopPos = -(((b.pageY - a.pageOffsetY - a.nzOffset.top) * a.heightRatio - a.zoomLens.height() / 2) * 1), a.zoomLens.css({ backgroundPosition: "" + a.windowLeftPos + "px " + a.windowTopPos + "px" }), a.changeBgSize && (a.nzHeight > a.nzWidth ? ("lens" === a.options.zoomType && a.zoomLens.css({ backgroundSize: "" + a.largeWidth / a.newvalueheight + "px " + a.largeHeight / a.newvalueheight + "px" }), a.zoomWindow.css({ backgroundSize: "" + a.largeWidth / a.newvalueheight + "px " + a.largeHeight / a.newvalueheight + "px" })) : ("lens" === a.options.zoomType && a.zoomLens.css({ backgroundSize: "" + a.largeWidth / a.newvaluewidth + "px " + a.largeHeight / a.newvaluewidth + "px" }), a.zoomWindow.css({ backgroundSize: "" + a.largeWidth / a.newvaluewidth + "px " + a.largeHeight / a.newvaluewidth + "px" })), a.changeBgSize = !1), a.setWindowPosition(b)), a.options.tint && "inner" !== a.options.zoomType && a.setTintPosition(b), "window" === a.options.zoomType && a.setWindowPosition(b), "inner" === a.options.zoomType && a.setWindowPosition(b), a.options.showLens && (a.fullwidth && "lens" !== a.options.zoomType && (a.lensLeftPos = 0), a.zoomLens.css({ left: a.lensLeftPos, top: a.lensTopPos })) }, showHideZoomContainer: function (a) { "show" === a && this.zoomContainer && this.zoomContainer.show(), "hide" === a && this.zoomContainer && this.zoomContainer.hide() }, showHideWindow: function (b) { var a = this; "show" === b && !a.isWindowActive && a.zoomWindow && (a.options.onShow(a), a.options.zoomWindowFadeIn ? a.zoomWindow.stop(!0, !0, !1).fadeIn(a.options.zoomWindowFadeIn) : a.zoomWindow.show(), a.isWindowActive = !0), "hide" === b && a.isWindowActive && (a.options.zoomWindowFadeOut ? a.zoomWindow.stop(!0, !0).fadeOut(a.options.zoomWindowFadeOut, function () { a.loop && (clearInterval(a.loop), a.loop = !1) }) : a.zoomWindow.hide(), a.options.onHide(a), a.isWindowActive = !1) }, showHideLens: function (b) { var a = this; "show" !== b || a.isLensActive || (a.zoomLens && (a.options.lensFadeIn ? a.zoomLens.stop(!0, !0, !1).fadeIn(a.options.lensFadeIn) : a.zoomLens.show()), a.isLensActive = !0), "hide" === b && a.isLensActive && (a.zoomLens && (a.options.lensFadeOut ? a.zoomLens.stop(!0, !0).fadeOut(a.options.lensFadeOut) : a.zoomLens.hide()), a.isLensActive = !1) }, showHideTint: function (b) { var a = this; "show" === b && !a.isTintActive && a.zoomTint && (a.options.zoomTintFadeIn ? a.zoomTint.css("opacity", a.options.tintOpacity).animate().stop(!0, !0).fadeIn("slow") : (a.zoomTint.css("opacity", a.options.tintOpacity).animate(), a.zoomTint.show()), a.isTintActive = !0), "hide" === b && a.isTintActive && (a.options.zoomTintFadeOut ? a.zoomTint.stop(!0, !0).fadeOut(a.options.zoomTintFadeOut) : a.zoomTint.hide(), a.isTintActive = !1) }, setLensPosition: function (a) { }, setWindowPosition: function (c) { var a = this; if (isNaN(a.options.zoomWindowPosition)) a.externalContainer = $(a.options.zoomWindowPosition), a.externalContainer.length || (a.externalContainer = $("#" + a.options.zoomWindowPosition)), a.externalContainerWidth = a.externalContainer.width(), a.externalContainerHeight = a.externalContainer.height(), a.externalContainerOffset = a.externalContainer.offset(), a.windowOffsetTop = a.externalContainerOffset.top, a.windowOffsetLeft = a.externalContainerOffset.left; else switch (a.options.zoomWindowPosition) { case 1: a.windowOffsetTop = a.options.zoomWindowOffsetY, a.windowOffsetLeft = +a.nzWidth; break; case 2: a.options.zoomWindowHeight > a.nzHeight ? (a.windowOffsetTop = -((a.options.zoomWindowHeight / 2 - a.nzHeight / 2) * 1), a.windowOffsetLeft = a.nzWidth) : $.noop(); break; case 3: a.windowOffsetTop = a.nzHeight - a.zoomWindow.height() - 2 * a.options.borderSize, a.windowOffsetLeft = a.nzWidth; break; case 4: a.windowOffsetTop = a.nzHeight, a.windowOffsetLeft = a.nzWidth; break; case 5: a.windowOffsetTop = a.nzHeight, a.windowOffsetLeft = a.nzWidth - a.zoomWindow.width() - 2 * a.options.borderSize; break; case 6: a.options.zoomWindowHeight > a.nzHeight ? (a.windowOffsetTop = a.nzHeight, a.windowOffsetLeft = -((a.options.zoomWindowWidth / 2 - a.nzWidth / 2 + 2 * a.options.borderSize) * 1)) : $.noop(); break; case 7: a.windowOffsetTop = a.nzHeight, a.windowOffsetLeft = 0; break; case 8: a.windowOffsetTop = a.nzHeight, a.windowOffsetLeft = -((a.zoomWindow.width() + 2 * a.options.borderSize) * 1); break; case 9: a.windowOffsetTop = a.nzHeight - a.zoomWindow.height() - 2 * a.options.borderSize, a.windowOffsetLeft = -((a.zoomWindow.width() + 2 * a.options.borderSize) * 1); break; case 10: a.options.zoomWindowHeight > a.nzHeight ? (a.windowOffsetTop = -((a.options.zoomWindowHeight / 2 - a.nzHeight / 2) * 1), a.windowOffsetLeft = -((a.zoomWindow.width() + 2 * a.options.borderSize) * 1)) : $.noop(); break; case 11: a.windowOffsetTop = a.options.zoomWindowOffsetY, a.windowOffsetLeft = -((a.zoomWindow.width() + 2 * a.options.borderSize) * 1); break; case 12: a.windowOffsetTop = -((a.zoomWindow.height() + 2 * a.options.borderSize) * 1), a.windowOffsetLeft = -((a.zoomWindow.width() + 2 * a.options.borderSize) * 1); break; case 13: a.windowOffsetTop = -((a.zoomWindow.height() + 2 * a.options.borderSize) * 1), a.windowOffsetLeft = 0; break; case 14: a.options.zoomWindowHeight > a.nzHeight ? (a.windowOffsetTop = -((a.zoomWindow.height() + 2 * a.options.borderSize) * 1), a.windowOffsetLeft = -((a.options.zoomWindowWidth / 2 - a.nzWidth / 2 + 2 * a.options.borderSize) * 1)) : $.noop(); break; case 15: a.windowOffsetTop = -((a.zoomWindow.height() + 2 * a.options.borderSize) * 1), a.windowOffsetLeft = a.nzWidth - a.zoomWindow.width() - 2 * a.options.borderSize; break; case 16: a.windowOffsetTop = -((a.zoomWindow.height() + 2 * a.options.borderSize) * 1), a.windowOffsetLeft = a.nzWidth; break; default: a.windowOffsetTop = a.options.zoomWindowOffsetY, a.windowOffsetLeft = a.nzWidth }if (a.isWindowSet = !0, a.windowOffsetTop = a.windowOffsetTop + a.options.zoomWindowOffsetY, a.windowOffsetLeft = a.windowOffsetLeft + a.options.zoomWindowOffsetX, a.zoomWindow.css({ top: a.windowOffsetTop, left: a.windowOffsetLeft }), "inner" === a.options.zoomType && a.zoomWindow.css({ top: 0, left: 0 }), a.windowLeftPos = -(((c.pageX - a.pageOffsetX - a.nzOffset.left) * a.widthRatio - a.zoomWindow.width() / 2) * 1), a.windowTopPos = -(((c.pageY - a.pageOffsetY - a.nzOffset.top) * a.heightRatio - a.zoomWindow.height() / 2) * 1), a.Etoppos && (a.windowTopPos = 0), a.Eloppos && (a.windowLeftPos = 0), a.Eboppos && (a.windowTopPos = -((a.largeHeight / a.currentZoomLevel - a.zoomWindow.height()) * 1)), a.Eroppos && (a.windowLeftPos = -((a.largeWidth / a.currentZoomLevel - a.zoomWindow.width()) * 1)), a.fullheight && (a.windowTopPos = 0), a.fullwidth && (a.windowLeftPos = 0), "window" === a.options.zoomType || "inner" === a.options.zoomType) { if (1 === a.zoomLock && (a.widthRatio <= 1 && (a.windowLeftPos = 0), a.heightRatio <= 1 && (a.windowTopPos = 0)), a.options.easing) { a.xp || (a.xp = 0), a.yp || (a.yp = 0); var d = 16, b = parseInt(a.options.easing); "number" == typeof b && isFinite(b) && Math.floor(b) === b && (d = b), a.loop || (a.loop = setInterval(function () { a.xp += (a.windowLeftPos - a.xp) / a.options.easingAmount, a.yp += (a.windowTopPos - a.yp) / a.options.easingAmount, a.scrollingLock ? (clearInterval(a.loop), a.xp = a.windowLeftPos, a.yp = a.windowTopPos, a.xp = -(((c.pageX - a.pageOffsetX - a.nzOffset.left) * a.widthRatio - a.zoomWindow.width() / 2) * 1), a.yp = -(((c.pageY - a.pageOffsetY - a.nzOffset.top) * a.heightRatio - a.zoomWindow.height() / 2) * 1), a.changeBgSize && (a.nzHeight > a.nzWidth ? ("lens" === a.options.zoomType && a.zoomLens.css({ backgroundSize: "" + a.largeWidth / a.newvalueheight + "px " + a.largeHeight / a.newvalueheight + "px" }), a.zoomWindow.css({ backgroundSize: "" + a.largeWidth / a.newvalueheight + "px " + a.largeHeight / a.newvalueheight + "px" })) : ("lens" !== a.options.zoomType && a.zoomLens.css({ backgroundSize: "" + a.largeWidth / a.newvaluewidth + "px " + a.largeHeight / a.newvalueheight + "px" }), a.zoomWindow.css({ backgroundSize: "" + a.largeWidth / a.newvaluewidth + "px " + a.largeHeight / a.newvaluewidth + "px" })), a.changeBgSize = !1), a.zoomWindow.css({ backgroundPosition: "" + a.windowLeftPos + "px " + a.windowTopPos + "px" }), a.scrollingLock = !1, a.loop = !1) : 1 > Math.round(Math.abs(a.xp - a.windowLeftPos) + Math.abs(a.yp - a.windowTopPos)) ? (clearInterval(a.loop), a.zoomWindow.css({ backgroundPosition: "" + a.windowLeftPos + "px " + a.windowTopPos + "px" }), a.loop = !1) : (a.changeBgSize && (a.nzHeight > a.nzWidth ? ("lens" === a.options.zoomType && a.zoomLens.css({ backgroundSize: "" + a.largeWidth / a.newvalueheight + "px " + a.largeHeight / a.newvalueheight + "px" }), a.zoomWindow.css({ backgroundSize: "" + a.largeWidth / a.newvalueheight + "px " + a.largeHeight / a.newvalueheight + "px" })) : ("lens" !== a.options.zoomType && a.zoomLens.css({ backgroundSize: "" + a.largeWidth / a.newvaluewidth + "px " + a.largeHeight / a.newvaluewidth + "px" }), a.zoomWindow.css({ backgroundSize: "" + a.largeWidth / a.newvaluewidth + "px " + a.largeHeight / a.newvaluewidth + "px" })), a.changeBgSize = !1), a.zoomWindow.css({ backgroundPosition: "" + a.xp + "px " + a.yp + "px" })) }, d)) } else a.changeBgSize && (a.nzHeight > a.nzWidth ? ("lens" === a.options.zoomType && a.zoomLens.css({ backgroundSize: "" + a.largeWidth / a.newvalueheight + "px " + a.largeHeight / a.newvalueheight + "px" }), a.zoomWindow.css({ backgroundSize: "" + a.largeWidth / a.newvalueheight + "px " + a.largeHeight / a.newvalueheight + "px" })) : ("lens" === a.options.zoomType && a.zoomLens.css({ backgroundSize: "" + a.largeWidth / a.newvaluewidth + "px " + a.largeHeight / a.newvaluewidth + "px" }), a.largeHeight / a.newvaluewidth < a.options.zoomWindowHeight ? a.zoomWindow.css({ backgroundSize: "" + a.largeWidth / a.newvaluewidth + "px " + a.largeHeight / a.newvaluewidth + "px" }) : a.zoomWindow.css({ backgroundSize: "" + a.largeWidth / a.newvalueheight + "px " + a.largeHeight / a.newvalueheight + "px" })), a.changeBgSize = !1), a.zoomWindow.css({ backgroundPosition: "" + a.windowLeftPos + "px " + a.windowTopPos + "px" }) } }, setTintPosition: function (b) { var a = this, c = a.zoomLens.width(), d = a.zoomLens.height(); a.updateOffset(a), a.tintpos = -((b.pageX - a.pageOffsetX - a.nzOffset.left - c / 2) * 1), a.tintposy = -((b.pageY - a.pageOffsetY - a.nzOffset.top - d / 2) * 1), a.Etoppos && (a.tintposy = 0), a.Eloppos && (a.tintpos = 0), a.Eboppos && (a.tintposy = -((a.nzHeight - d - 2 * a.options.lensBorderSize) * 1)), a.Eroppos && (a.tintpos = -((a.nzWidth - c - 2 * a.options.lensBorderSize) * 1)), a.options.tint && (a.fullheight && (a.tintposy = 0), a.fullwidth && (a.tintpos = 0), a.zoomTintImage.css({ left: a.tintpos, top: a.tintposy })) }, swaptheimage: function (e, d) { var a = this, b = new Image; if (a.options.loadingIcon && !a.spinner) { var c = { background: 'url("' + a.options.loadingIcon + '") no-repeat', height: a.nzHeight, width: a.nzWidth, zIndex: 2e3, position: "absolute", backgroundPosition: "center center" }; "inner" === a.options.zoomType && c.setProperty("top", 0), a.spinner = $('<div class="ezp-spinner"></div>').css(c), a.$elem.after(a.spinner) } else a.spinner && a.spinner.show(); a.options.onImageSwap(a.$elem), b.onload = function () { a.largeWidth = b.width, a.largeHeight = b.height, a.zoomImage = d, a.zoomWindow.css({ backgroundSize: "" + a.largeWidth + "px " + a.largeHeight + "px" }), a.swapAction(e, d) }, a.setImageSource(b, d) }, swapAction: function (g, d) { var a = this, c = a.$elem.width(), b = a.$elem.height(), j = new Image; if (j.onload = function () { a.nzHeight = j.height, a.nzWidth = j.width, a.options.onImageSwapComplete(a.$elem), a.doneCallback() }, a.setImageSource(j, g), a.currentZoomLevel = a.options.zoomLevel, a.options.maxZoomLevel = !1, "lens" === a.options.zoomType && a.zoomLens.css("background-image", 'url("' + d + '")'), "window" === a.options.zoomType && a.zoomWindow.css("background-image", 'url("' + d + '")'), "inner" === a.options.zoomType && a.zoomWindow.css("background-image", 'url("' + d + '")'), a.currentImage = d, a.options.imageCrossfade) { var k = a.$elem, l = k.clone(); if (a.$elem.attr("src", g), a.$elem.after(l), l.stop(!0).fadeOut(a.options.imageCrossfade, function () { $(this).remove() }), a.$elem.width("auto").removeAttr("width"), a.$elem.height("auto").removeAttr("height"), k.fadeIn(a.options.imageCrossfade), a.options.tint && "inner" !== a.options.zoomType) { var m = a.zoomTintImage, n = m.clone(); a.zoomTintImage.attr("src", d), a.zoomTintImage.after(n), n.stop(!0).fadeOut(a.options.imageCrossfade, function () { $(this).remove() }), m.fadeIn(a.options.imageCrossfade), a.zoomTint.css({ height: b, width: c }) } a.zoomContainer.css({ height: b, width: c }), "inner" !== a.options.zoomType || a.options.constrainType || (a.zoomWrap.parent().css({ height: b, width: c }), a.zoomWindow.css({ height: b, width: c })), a.options.imageCrossfade && a.zoomWrap.css({ height: b, width: c }) } else a.$elem.attr("src", g), a.options.tint && (a.zoomTintImage.attr("src", d), a.zoomTintImage.attr("height", b), a.zoomTintImage.css("height", b), a.zoomTint.css("height", b)), a.zoomContainer.css({ height: b, width: c }), a.options.imageCrossfade && a.zoomWrap.css({ height: b, width: c }); if (a.options.constrainType) { if ("height" === a.options.constrainType) { var h = { height: a.options.constrainSize, width: "auto" }; a.zoomContainer.css(h), a.options.imageCrossfade ? (a.zoomWrap.css(h), a.constwidth = a.zoomWrap.width()) : (a.$elem.css(h), a.constwidth = c); var e = { height: a.options.constrainSize, width: a.constwidth }; "inner" === a.options.zoomType && (a.zoomWrap.parent().css(e), a.zoomWindow.css(e)), a.options.tint && (a.tintContainer.css(e), a.zoomTint.css(e), a.zoomTintImage.css(e)) } if ("width" === a.options.constrainType) { var i = { height: "auto", width: a.options.constrainSize }; a.zoomContainer.css(i), a.options.imageCrossfade ? (a.zoomWrap.css(i), a.constheight = a.zoomWrap.height()) : (a.$elem.css(i), a.constheight = b); var f = { height: a.constheight, width: a.options.constrainSize }; "inner" === a.options.zoomType && (a.zoomWrap.parent().css(f), a.zoomWindow.css(f)), a.options.tint && (a.tintContainer.css(f), a.zoomTint.css(f), a.zoomTintImage.css(f)) } } }, doneCallback: function () { var a = this; a.options.loadingIcon && a.spinner && a.spinner.length && a.spinner.hide(), a.updateOffset(a), a.nzWidth = a.$elem.width(), a.nzHeight = a.$elem.height(), a.currentZoomLevel = a.options.zoomLevel, a.widthRatio = a.largeWidth / a.nzWidth, a.heightRatio = a.largeHeight / a.nzHeight, "window" === a.options.zoomType && (a.nzHeight < a.options.zoomWindowHeight / a.heightRatio ? a.lensHeight = a.nzHeight : a.lensHeight = a.options.zoomWindowHeight / a.heightRatio, a.nzWidth < a.options.zoomWindowWidth ? a.lensWidth = a.nzWidth : a.lensWidth = a.options.zoomWindowWidth / a.widthRatio, a.zoomLens && a.zoomLens.css({ width: a.lensWidth, height: a.lensHeight })) }, getCurrentImage: function () { return this.zoomImage }, getGalleryList: function () { var a = this; return a.gallerylist = [], a.options.gallery ? $("#" + a.options.gallery + " a").each(function () { var b = ""; $(this).data(a.options.attrImageZoomSrc) ? b = $(this).data(a.options.attrImageZoomSrc) : $(this).data("image") && (b = $(this).data("image")), b === a.zoomImage ? a.gallerylist.unshift({ href: "" + b, title: $(this).find("img").attr("title") }) : a.gallerylist.push({ href: "" + b, title: $(this).find("img").attr("title") }) }) : a.gallerylist.push({ href: "" + a.zoomImage, title: $(this).find("img").attr("title") }), a.gallerylist }, changeZoomLevel: function (f) { var a = this; a.scrollingLock = !0, a.newvalue = parseFloat(f).toFixed(2); var b = a.newvalue, c = a.largeHeight / (a.options.zoomWindowHeight / a.nzHeight * a.nzHeight), d = a.largeWidth / (a.options.zoomWindowWidth / a.nzWidth * a.nzWidth); "inner" !== a.options.zoomType && (c <= b ? (a.heightRatio = a.largeHeight / c / a.nzHeight, a.newvalueheight = c, a.fullheight = !0) : (a.heightRatio = a.largeHeight / b / a.nzHeight, a.newvalueheight = b, a.fullheight = !1), d <= b ? (a.widthRatio = a.largeWidth / d / a.nzWidth, a.newvaluewidth = d, a.fullwidth = !0) : (a.widthRatio = a.largeWidth / b / a.nzWidth, a.newvaluewidth = b, a.fullwidth = !1), "lens" === a.options.zoomType && (c <= b ? (a.fullwidth = !0, a.newvaluewidth = c) : (a.widthRatio = a.largeWidth / b / a.nzWidth, a.newvaluewidth = b, a.fullwidth = !1))), "inner" === a.options.zoomType && (c = parseFloat(a.largeHeight / a.nzHeight).toFixed(2), d = parseFloat(a.largeWidth / a.nzWidth).toFixed(2), b > c && (b = c), b > d && (b = d), c <= b ? (a.heightRatio = a.largeHeight / b / a.nzHeight, b > c ? a.newvalueheight = c : a.newvalueheight = b, a.fullheight = !0) : (a.heightRatio = a.largeHeight / b / a.nzHeight, b > c ? a.newvalueheight = c : a.newvalueheight = b, a.fullheight = !1), d <= b ? (a.widthRatio = a.largeWidth / b / a.nzWidth, b > d ? a.newvaluewidth = d : a.newvaluewidth = b, a.fullwidth = !0) : (a.widthRatio = a.largeWidth / b / a.nzWidth, a.newvaluewidth = b, a.fullwidth = !1)); var e = !1; "inner" === a.options.zoomType && (a.nzWidth >= a.nzHeight && (a.newvaluewidth <= d ? e = !0 : (e = !1, a.fullheight = !0, a.fullwidth = !0)), a.nzHeight > a.nzWidth && (a.newvaluewidth <= d ? e = !0 : (e = !1, a.fullheight = !0, a.fullwidth = !0))), "inner" !== a.options.zoomType && (e = !0), e && (a.zoomLock = 0, a.changeZoom = !0, a.options.zoomWindowHeight / a.heightRatio <= a.nzHeight && (a.currentZoomLevel = a.newvalueheight, "lens" !== a.options.zoomType && "inner" !== a.options.zoomType && (a.changeBgSize = !0, a.zoomLens.css({ height: a.options.zoomWindowHeight / a.heightRatio })), ("lens" === a.options.zoomType || "inner" === a.options.zoomType) && (a.changeBgSize = !0)), a.options.zoomWindowWidth / a.widthRatio <= a.nzWidth && ("inner" !== a.options.zoomType && a.newvaluewidth > a.newvalueheight && (a.currentZoomLevel = a.newvaluewidth), "lens" !== a.options.zoomType && "inner" !== a.options.zoomType && (a.changeBgSize = !0, a.zoomLens.css({ width: a.options.zoomWindowWidth / a.widthRatio })), ("lens" === a.options.zoomType || "inner" === a.options.zoomType) && (a.changeBgSize = !0)), "inner" === a.options.zoomType && (a.changeBgSize = !0, a.nzWidth > a.nzHeight ? a.currentZoomLevel = a.newvaluewidth : a.nzHeight >= a.nzWidth && (a.currentZoomLevel = a.newvaluewidth))), a.setPosition(a.currentLoc) }, closeAll: function () { this.zoomWindow && this.zoomWindow.hide(), this.zoomLens && this.zoomLens.hide(), this.zoomTint && this.zoomTint.hide() }, updateOffset: function (a) { if ("body" !== a.options.zoomContainerAppendTo) { a.nzOffset = a.$elem.offset(); var b = $(a.options.zoomContainerAppendTo).offset(); a.nzOffset.top = a.$elem.offset().top - b.top, a.nzOffset.left = a.$elem.offset().left - b.left, a.pageOffsetX = b.left, a.pageOffsetY = b.top } else a.nzOffset = a.$elem.offset(), a.pageOffsetX = 0, a.pageOffsetY = 0 }, changeState: function (a) { var b = this; "enable" === a && (b.options.zoomEnabled = !0), "disable" === a && (b.options.zoomEnabled = !1) }, responsiveConfig: function (a) { return a.respond && a.respond.length > 0 ? $.extend({}, a, this.configByScreenWidth(a)) : a }, configByScreenWidth: function (b) { var d = $(a).width(), c = $.grep(b.respond, function (b) { var a = b.range.split("-"); return d >= a[0] && d <= a[1] }); return c.length > 0 ? c[0] : b } }; $.fn.ezPlus = function (a) { return this.each(function () { var b = Object.create(c); b.init(a, this), $.data(this, "ezPlus", b) }) }, $.fn.ezPlus.options = { container: "ZoomContainer", attrImageZoomSrc: "zoom-image", borderColour: "#888", borderSize: 4, constrainSize: !1, constrainType: !1, containLensZoom: !1, cursor: "inherit", debug: !1, easing: !1, easingAmount: 12, enabled: !0, gallery: !1, galleryActiveClass: "zoomGalleryActive", gallerySelector: !1, galleryItem: "a", galleryEvent: "click", imageCrossfade: !1, lensBorderColour: "#000", lensBorderSize: 1, lensColour: "white", lensFadeIn: !1, lensFadeOut: !1, lensOpacity: .4, lensShape: "square", lensSize: 200, lenszoom: !1, loadingIcon: !1, mantainZoomAspectRatio: !1, maxZoomLevel: !1, minZoomLevel: 1.01, onComplete: $.noop, onDestroy: $.noop, onImageClick: $.noop, onImageSwap: $.noop, onImageSwapComplete: $.noop, onShow: $.noop, onHide: $.noop, onZoomedImageLoaded: $.noop, preloading: 1, respond: [], responsive: !0, scrollZoom: !1, scrollZoomIncrement: .1, showLens: !0, tint: !1, tintColour: "#333", tintOpacity: .4, touchEnabled: !0, zoomActivation: "hover", zoomContainerAppendTo: "body", zoomId: -1, zoomLevel: 1, zoomTintFadeIn: !1, zoomTintFadeOut: !1, zoomType: "window", zoomWindowAlwaysShow: !1, zoomWindowBgColour: "#fff", zoomWindowFadeIn: !1, zoomWindowFadeOut: !1, zoomWindowHeight: 400, zoomWindowOffsetX: 0, zoomWindowOffsetY: 0, zoomWindowPosition: 1, zoomWindowWidth: 400, zoomEnabled: !0, zIndex: 999 } }(window.jQuery, window, document)