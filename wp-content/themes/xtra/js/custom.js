/* Superfish 1.7.5 */
!function(e,s){"use strict";var o=function(){var o={bcClass:"sf-breadcrumb",menuClass:"sf-js-enabled",anchorClass:"sf-with-ul",menuArrowClass:"sf-arrows"},n=function(){var s=/^(?![\w\W]*Windows Phone)[\w\W]*(iPhone|iPad|iPod)/i.test(navigator.userAgent);return s&&e("html").css("cursor","pointer").on("click",e.noop),s}(),t=function(){var e=document.documentElement.style;return"behavior"in e&&"fill"in e&&/iemobile/i.test(navigator.userAgent)}(),i=function(){return!!s.PointerEvent}(),r=function(e,s){var n=o.menuClass;s.cssArrows&&(n+=" "+o.menuArrowClass),e.toggleClass(n)},a=function(s,n){return s.find("li."+n.pathClass).slice(0,n.pathLevels).addClass(n.hoverClass+" "+o.bcClass).filter(function(){return e(this).children(n.popUpSelector).hide().show().length}).removeClass(n.pathClass)},l=function(e){e.children("a").toggleClass(o.anchorClass)},h=function(e){var s=e.css("ms-touch-action"),o=e.css("touch-action");o=o||s,o="pan-y"===o?"auto":"pan-y",e.css({"ms-touch-action":o,"touch-action":o})},u=function(e){return e.closest("."+o.menuClass)},p=function(e){return u(e).data("sf-options")},c=function(){var s=e(this),o=p(s);clearTimeout(o.sfTimer),s.siblings().superfish("hide").end().superfish("show")},f=function(s){s.retainPath=e.inArray(this[0],s.$path)>-1,this.superfish("hide"),this.parents("."+s.hoverClass).length||(s.onIdle.call(u(this)),s.$path.length&&e.proxy(c,s.$path)())},d=function(){var s=e(this),o=p(s);n?e.proxy(f,s,o)():(clearTimeout(o.sfTimer),o.sfTimer=setTimeout(e.proxy(f,s,o),o.delay))},v=function(s){var o=e(this),n=p(o),t=o.siblings(s.data.popUpSelector);return n.onHandleTouch.call(t)===!1?this:void(t.length>0&&t.is(":hidden")&&(o.one("click.superfish",!1),"MSPointerDown"===s.type||"pointerdown"===s.type?o.trigger("focus"):e.proxy(c,o.parent("li"))()))},m=function(s,o){var r="li:has("+o.popUpSelector+")";e.fn.hoverIntent&&!o.disableHI?s.hoverIntent(c,d,r):s.on("mouseenter.superfish",r,c).on("mouseleave.superfish",r,d);var a="MSPointerDown.superfish";i&&(a="pointerdown.superfish"),n||(a+=" touchend.superfish"),t&&(a+=" mousedown.superfish"),s.on("focusin.superfish","li",c).on("focusout.superfish","li",d).on(a,"a",o,v)};return{hide:function(s){if(this.length){var o=this,n=p(o);if(!n)return this;var t=n.retainPath===!0?n.$path:"",i=o.find("li."+n.hoverClass).add(this).not(t).removeClass(n.hoverClass).children(n.popUpSelector),r=n.speedOut;if(s&&(i.show(),r=0),n.retainPath=!1,n.onBeforeHide.call(i)===!1)return this;i.stop(!0,!0).animate(n.animationOut,r,function(){var s=e(this);n.onHide.call(s)})}return this},show:function(){var e=p(this);if(!e)return this;var s=this.addClass(e.hoverClass),o=s.children(e.popUpSelector);return e.onBeforeShow.call(o)===!1?this:(o.stop(!0,!0).animate(e.animation,e.speed,e.easing,function(){e.onShow.call(o)}),this)},destroy:function(){return this.each(function(){var s,n=e(this),t=n.data("sf-options");return t?(s=n.find(t.popUpSelector).parent("li"),clearTimeout(t.sfTimer),r(n,t),l(s),h(n),n.off(".superfish").off(".hoverIntent"),s.children(t.popUpSelector).attr("style",function(e,s){return s.replace(/display[^;]+;?/g,"")}),t.$path.removeClass(t.hoverClass+" "+o.bcClass).addClass(t.pathClass),n.find("."+t.hoverClass).removeClass(t.hoverClass),t.onDestroy.call(n),void n.removeData("sf-options")):!1})},init:function(s){return this.each(function(){var n=e(this);if(n.data("sf-options"))return!1;var t=e.extend({},e.fn.superfish.defaults,s),i=n.find(t.popUpSelector).parent("li");t.$path=a(n,t),n.data("sf-options",t),r(n,t),l(i),h(n),m(n,t),i.not("."+o.bcClass).superfish("hide",!0),t.onInit.call(this)})}}}();e.fn.superfish=function(s,n){return o[s]?o[s].apply(this,Array.prototype.slice.call(arguments,1)):"object"!=typeof s&&s?e.error("Method "+s+" does not exist on jQuery.fn.superfish"):o.init.apply(this,arguments)},e.fn.superfish.defaults={popUpSelector:"ul,.sf-mega",hoverClass:"sfHover",pathClass:"overrideThisToUse",pathLevels:1,delay:300,easing:'linear',animation:{opacity:"show"},animationOut:{opacity:"hide"},speed:100,speedOut:100,cssArrows:!0,disableHI:!1,onInit:e.noop,onBeforeShow:e.noop,onShow:e.noop,onBeforeHide:e.noop,onHide:e.noop,onIdle:e.noop,onDestroy:e.noop,onHandleTouch:e.noop}}(jQuery,window);

/* lightgallery 1.3.4 + zoom + video */
!function(a,b){"function"==typeof define&&define.amd?define(["jquery"],function(a){return b(a)}):"object"==typeof exports?module.exports=b(require("jquery")):b(jQuery)}(this,function(a){!function(a,b,c,d){"use strict";function e(b,d){if(this.el=b,this.$el=a(b),this.s=a.extend({},f,d),this.s.dynamic&&"undefined"!==this.s.dynamicEl&&this.s.dynamicEl.constructor===Array&&!this.s.dynamicEl.length)throw"When using dynamic mode, you must also define dynamicEl as an Array.";return this.modules={},this.lGalleryOn=!1,this.lgBusy=!1,this.hideBartimeout=!1,this.isTouch="ontouchstart"in c.documentElement,this.s.slideEndAnimatoin&&(this.s.hideControlOnEnd=!1),this.s.dynamic?this.$items=this.s.dynamicEl:"this"===this.s.selector?this.$items=this.$el:""!==this.s.selector?this.s.selectWithin?this.$items=a(this.s.selectWithin).find(this.s.selector):this.$items=this.$el.find(a(this.s.selector)):this.$items=this.$el.children(),this.$slide="",this.$outer="",this.init(),this}var f={mode:"lg-slide",cssEasing:"ease",easing:"linear",speed:600,height:"100%",width:"100%",addClass:"",startClass:"lg-start-zoom",backdropDuration:150,hideBarsDelay:6e3,useLeft:!1,closable:!0,loop:!0,escKey:!0,keyPress:!0,controls:!0,slideEndAnimatoin:!0,hideControlOnEnd:!1,mousewheel:!0,getCaptionFromTitleOrAlt:!0,appendSubHtmlTo:".lg-sub-html",subHtmlSelectorRelative:!1,preload:1,showAfterLoad:!0,selector:"",selectWithin:"",nextHtml:"",prevHtml:"",index:!1,iframeMaxWidth:"100%",download:!0,counter:!0,appendCounterTo:".lg-toolbar",swipeThreshold:50,enableSwipe:!0,enableDrag:!0,dynamic:!1,dynamicEl:[],galleryId:1};e.prototype.init=function(){var c=this;c.s.preload>c.$items.length&&(c.s.preload=c.$items.length);var d=b.location.hash;d.indexOf("lg="+this.s.galleryId)>0&&(c.index=parseInt(d.split("&slide=")[1],10),a("body").addClass("lg-from-hash"),a("body").hasClass("lg-on")||(setTimeout(function(){c.build(c.index)}),a("body").addClass("lg-on"))),c.s.dynamic?(c.$el.trigger("onBeforeOpen.lg"),c.index=c.s.index||0,a("body").hasClass("lg-on")||setTimeout(function(){c.build(c.index),a("body").addClass("lg-on")})):c.$items.on("click.lgcustom",function(b){try{b.preventDefault(),b.preventDefault()}catch(d){b.returnValue=!1}c.$el.trigger("onBeforeOpen.lg"),c.index=c.s.index||c.$items.index(this),a("body").hasClass("lg-on")||(c.build(c.index),a("body").addClass("lg-on"))})},e.prototype.build=function(b){var c=this;c.structure(),a.each(a.fn.lightGallery.modules,function(b){c.modules[b]=new a.fn.lightGallery.modules[b](c.el)}),c.slide(b,!1,!1),c.s.keyPress&&c.keyPress(),c.$items.length>1&&(c.arrow(),setTimeout(function(){c.enableDrag(),c.enableSwipe()},50),c.s.mousewheel&&c.mousewheel()),c.counter(),c.closeGallery(),c.$el.trigger("onAfterOpen.lg"),c.$outer.on("mousemove.lg click.lg touchstart.lg",function(){c.$outer.removeClass("lg-hide-items"),clearTimeout(c.hideBartimeout),c.hideBartimeout=setTimeout(function(){c.$outer.addClass("lg-hide-items")},c.s.hideBarsDelay)})},e.prototype.structure=function(){var c,d="",e="",f=0,g="",h=this;for(a("body").append('<div class="lg-backdrop"></div>'),a(".lg-backdrop").css("transition-duration",this.s.backdropDuration+"ms"),f=0;f<this.$items.length;f++)d+='<div class="lg-item"></div>';if(this.s.controls&&this.$items.length>1&&(e='<div class="lg-actions"><div class="lg-prev lg-icon">'+this.s.prevHtml+'</div><div class="lg-next lg-icon">'+this.s.nextHtml+"</div></div>"),".lg-sub-html"===this.s.appendSubHtmlTo&&(g='<div class="lg-sub-html"></div>'),c='<div class="lg-outer '+this.s.addClass+" "+this.s.startClass+'"><div class="lg" style="width:'+this.s.width+"; height:"+this.s.height+'"><div class="lg-inner">'+d+'</div><div class="lg-toolbar group"><span class="lg-close lg-icon"></span></div>'+e+g+"</div></div>",a("body").append(c),this.$outer=a(".lg-outer"),this.$slide=this.$outer.find(".lg-item"),this.s.useLeft?(this.$outer.addClass("lg-use-left"),this.s.mode="lg-slide"):this.$outer.addClass("lg-use-css3"),h.setTop(),a(b).on("resize.lg orientationchange.lg",function(){setTimeout(function(){h.setTop()},100)}),this.$slide.eq(this.index).addClass("lg-current"),this.doCss()?this.$outer.addClass("lg-css3"):(this.$outer.addClass("lg-css"),this.s.speed=0),this.$outer.addClass(this.s.mode),this.s.enableDrag&&this.$items.length>1&&this.$outer.addClass("lg-grab"),this.s.showAfterLoad&&this.$outer.addClass("lg-show-after-load"),this.doCss()){var i=this.$outer.find(".lg-inner");i.css("transition-timing-function",this.s.cssEasing),i.css("transition-duration",this.s.speed+"ms")}setTimeout(function(){a(".lg-backdrop").addClass("in")}),setTimeout(function(){h.$outer.addClass("lg-visible")},this.s.backdropDuration),this.s.download&&this.$outer.find(".lg-toolbar").append('<a id="lg-download" target="_blank" download class="lg-download lg-icon"></a>'),this.prevScrollTop=a(b).scrollTop()},e.prototype.setTop=function(){if("100%"!==this.s.height){var c=a(b).height(),d=(c-parseInt(this.s.height,10))/2,e=this.$outer.find(".lg");c>=parseInt(this.s.height,10)?e.css("top",d+"px"):e.css("top","0px")}},e.prototype.doCss=function(){var a=function(){var a=["transition","MozTransition","WebkitTransition","OTransition","msTransition","KhtmlTransition"],b=c.documentElement,d=0;for(d=0;d<a.length;d++)if(a[d]in b.style)return!0};return!!a()},e.prototype.isVideo=function(a,b){var c;if(c=this.s.dynamic?this.s.dynamicEl[b].html:this.$items.eq(b).attr("data-html"),!a&&c)return{html5:!0};var d=a.match(/\/\/(?:www\.)?youtu(?:\.be|be\.com)\/(?:watch\?v=|embed\/)?([a-z0-9\-\_\%]+)/i),e=a.match(/\/\/(?:www\.)?vimeo.com\/([0-9a-z\-_]+)/i),f=a.match(/\/\/(?:www\.)?dai.ly\/([0-9a-z\-_]+)/i),g=a.match(/\/\/(?:www\.)?(?:vk\.com|vkontakte\.ru)\/(?:video_ext\.php\?)(.*)/i);return d?{youtube:d}:e?{vimeo:e}:f?{dailymotion:f}:g?{vk:g}:void 0},e.prototype.counter=function(){this.s.counter&&a(this.s.appendCounterTo).append('<div id="lg-counter"><span id="lg-counter-current">'+(parseInt(this.index,10)+1)+'</span> / <span id="lg-counter-all">'+this.$items.length+"</span></div>")},e.prototype.addHtml=function(b){var c,d,e=null;if(this.s.dynamic?this.s.dynamicEl[b].subHtmlUrl?c=this.s.dynamicEl[b].subHtmlUrl:e=this.s.dynamicEl[b].subHtml:(d=this.$items.eq(b),d.attr("data-sub-html-url")?c=d.attr("data-sub-html-url"):(e=d.attr("data-sub-html"),this.s.getCaptionFromTitleOrAlt&&!e&&(e=d.attr("title")||d.find("img").first().attr("alt")))),!c)if("undefined"!=typeof e&&null!==e){var f=e.substring(0,1);"."!==f&&"#"!==f||(e=this.s.subHtmlSelectorRelative&&!this.s.dynamic?d.find(e).html():a(e).html())}else e="";".lg-sub-html"===this.s.appendSubHtmlTo?c?this.$outer.find(this.s.appendSubHtmlTo).load(c):this.$outer.find(this.s.appendSubHtmlTo).html(e):c?this.$slide.eq(b).load(c):this.$slide.eq(b).append(e),"undefined"!=typeof e&&null!==e&&(""===e?this.$outer.find(this.s.appendSubHtmlTo).addClass("lg-empty-html"):this.$outer.find(this.s.appendSubHtmlTo).removeClass("lg-empty-html")),this.$el.trigger("onAfterAppendSubHtml.lg",[b])},e.prototype.preload=function(a){var b=1,c=1;for(b=1;b<=this.s.preload&&!(b>=this.$items.length-a);b++)this.loadContent(a+b,!1,0);for(c=1;c<=this.s.preload&&!(0>a-c);c++)this.loadContent(a-c,!1,0)},e.prototype.loadContent=function(c,d,e){var f,g,h,i,j,k,l=this,m=!1,n=function(c){for(var d=[],e=[],f=0;f<c.length;f++){var h=c[f].split(" ");""===h[0]&&h.splice(0,1),e.push(h[0]),d.push(h[1])}for(var i=a(b).width(),j=0;j<d.length;j++)if(parseInt(d[j],10)>i){g=e[j];break}};if(l.s.dynamic){if(l.s.dynamicEl[c].poster&&(m=!0,h=l.s.dynamicEl[c].poster),k=l.s.dynamicEl[c].html,g=l.s.dynamicEl[c].src,l.s.dynamicEl[c].responsive){var o=l.s.dynamicEl[c].responsive.split(",");n(o)}i=l.s.dynamicEl[c].srcset,j=l.s.dynamicEl[c].sizes}else{if(l.$items.eq(c).attr("data-poster")&&(m=!0,h=l.$items.eq(c).attr("data-poster")),k=l.$items.eq(c).attr("data-html"),g=l.$items.eq(c).attr("href")||l.$items.eq(c).attr("data-src"),l.$items.eq(c).attr("data-responsive")){var p=l.$items.eq(c).attr("data-responsive").split(",");n(p)}i=l.$items.eq(c).attr("data-srcset"),j=l.$items.eq(c).attr("data-sizes")}var q=!1;l.s.dynamic?l.s.dynamicEl[c].iframe&&(q=!0):"true"===l.$items.eq(c).attr("data-iframe")&&(q=!0);var r=l.isVideo(g,c);if(!l.$slide.eq(c).hasClass("lg-loaded")){if(q)l.$slide.eq(c).prepend('<div class="lg-video-cont" style="max-width:'+l.s.iframeMaxWidth+'"><div class="lg-video"><iframe class="lg-object" frameborder="0" src="'+g+'"  allowfullscreen="true"></iframe></div></div>');else if(m){var s="";s=r&&r.youtube?"lg-has-youtube":r&&r.vimeo?"lg-has-vimeo":"lg-has-html5",l.$slide.eq(c).prepend('<div class="lg-video-cont '+s+' "><div class="lg-video"><span class="lg-video-play"></span><img class="lg-object lg-has-poster" src="'+h+'" /></div></div>')}else r?(l.$slide.eq(c).prepend('<div class="lg-video-cont "><div class="lg-video"></div></div>'),l.$el.trigger("hasVideo.lg",[c,g,k])):l.$slide.eq(c).prepend('<div class="lg-img-wrap"><img class="lg-object lg-image" src="'+g+'" /></div>');if(l.$el.trigger("onAferAppendSlide.lg",[c]),f=l.$slide.eq(c).find(".lg-object"),j&&f.attr("sizes",j),i){f.attr("srcset",i);try{picturefill({elements:[f[0]]})}catch(t){console.error("Make sure you have included Picturefill version 2")}}".lg-sub-html"!==this.s.appendSubHtmlTo&&l.addHtml(c),l.$slide.eq(c).addClass("lg-loaded")}l.$slide.eq(c).find(".lg-object").on("load.lg error.lg",function(){var b=0;e&&!a("body").hasClass("lg-from-hash")&&(b=e),setTimeout(function(){l.$slide.eq(c).addClass("lg-complete"),l.$el.trigger("onSlideItemLoad.lg",[c,e||0])},b)}),r&&r.html5&&!m&&l.$slide.eq(c).addClass("lg-complete"),d===!0&&(l.$slide.eq(c).hasClass("lg-complete")?l.preload(c):l.$slide.eq(c).find(".lg-object").on("load.lg error.lg",function(){l.preload(c)}))},e.prototype.slide=function(b,c,d){var e=this.$outer.find(".lg-current").index(),f=this;if(!f.lGalleryOn||e!==b){var g=this.$slide.length,h=f.lGalleryOn?this.s.speed:0,i=!1,j=!1;if(!f.lgBusy){if(this.s.download){var k;k=f.s.dynamic?f.s.dynamicEl[b].downloadUrl!==!1&&(f.s.dynamicEl[b].downloadUrl||f.s.dynamicEl[b].src):"false"!==f.$items.eq(b).attr("data-download-url")&&(f.$items.eq(b).attr("data-download-url")||f.$items.eq(b).attr("href")||f.$items.eq(b).attr("data-src")),k?(a("#lg-download").attr("href",k),f.$outer.removeClass("lg-hide-download")):f.$outer.addClass("lg-hide-download")}if(this.$el.trigger("onBeforeSlide.lg",[e,b,c,d]),f.lgBusy=!0,clearTimeout(f.hideBartimeout),".lg-sub-html"===this.s.appendSubHtmlTo&&setTimeout(function(){f.addHtml(b)},h),this.arrowDisable(b),c){var l=b-1,m=b+1;0===b&&e===g-1?(m=0,l=g-1):b===g-1&&0===e&&(m=0,l=g-1),this.$slide.removeClass("lg-prev-slide lg-current lg-next-slide"),f.$slide.eq(l).addClass("lg-prev-slide"),f.$slide.eq(m).addClass("lg-next-slide"),f.$slide.eq(b).addClass("lg-current")}else f.$outer.addClass("lg-no-trans"),this.$slide.removeClass("lg-prev-slide lg-next-slide"),e>b?(j=!0,0!==b||e!==g-1||d||(j=!1,i=!0)):b>e&&(i=!0,b!==g-1||0!==e||d||(j=!0,i=!1)),j?(this.$slide.eq(b).addClass("lg-prev-slide"),this.$slide.eq(e).addClass("lg-next-slide")):i&&(this.$slide.eq(b).addClass("lg-next-slide"),this.$slide.eq(e).addClass("lg-prev-slide")),setTimeout(function(){f.$slide.removeClass("lg-current"),f.$slide.eq(b).addClass("lg-current"),f.$outer.removeClass("lg-no-trans")},50);f.lGalleryOn?(setTimeout(function(){f.loadContent(b,!0,0)},this.s.speed+50),setTimeout(function(){f.lgBusy=!1,f.$el.trigger("onAfterSlide.lg",[e,b,c,d])},this.s.speed)):(f.loadContent(b,!0,f.s.backdropDuration),f.lgBusy=!1,f.$el.trigger("onAfterSlide.lg",[e,b,c,d])),f.lGalleryOn=!0,this.s.counter&&a("#lg-counter-current").text(b+1)}}},e.prototype.goToNextSlide=function(a){var b=this;b.lgBusy||(b.index+1<b.$slide.length?(b.index++,b.$el.trigger("onBeforeNextSlide.lg",[b.index]),b.slide(b.index,a,!1)):b.s.loop?(b.index=0,b.$el.trigger("onBeforeNextSlide.lg",[b.index]),b.slide(b.index,a,!1)):b.s.slideEndAnimatoin&&(b.$outer.addClass("lg-right-end"),setTimeout(function(){b.$outer.removeClass("lg-right-end")},400)))},e.prototype.goToPrevSlide=function(a){var b=this;b.lgBusy||(b.index>0?(b.index--,b.$el.trigger("onBeforePrevSlide.lg",[b.index,a]),b.slide(b.index,a,!1)):b.s.loop?(b.index=b.$items.length-1,b.$el.trigger("onBeforePrevSlide.lg",[b.index,a]),b.slide(b.index,a,!1)):b.s.slideEndAnimatoin&&(b.$outer.addClass("lg-left-end"),setTimeout(function(){b.$outer.removeClass("lg-left-end")},400)))},e.prototype.keyPress=function(){var c=this;this.$items.length>1&&a(b).on("keyup.lg",function(a){c.$items.length>1&&(37===a.keyCode&&(a.preventDefault(),c.goToPrevSlide()),39===a.keyCode&&(a.preventDefault(),c.goToNextSlide()))}),a(b).on("keydown.lg",function(a){c.s.escKey===!0&&27===a.keyCode&&(a.preventDefault(),c.$outer.hasClass("lg-thumb-open")?c.$outer.removeClass("lg-thumb-open"):c.destroy())})},e.prototype.arrow=function(){var a=this;this.$outer.find(".lg-prev").on("click.lg",function(){a.goToPrevSlide()}),this.$outer.find(".lg-next").on("click.lg",function(){a.goToNextSlide()})},e.prototype.arrowDisable=function(a){!this.s.loop&&this.s.hideControlOnEnd&&(a+1<this.$slide.length?this.$outer.find(".lg-next").removeAttr("disabled").removeClass("disabled"):this.$outer.find(".lg-next").attr("disabled","disabled").addClass("disabled"),a>0?this.$outer.find(".lg-prev").removeAttr("disabled").removeClass("disabled"):this.$outer.find(".lg-prev").attr("disabled","disabled").addClass("disabled"))},e.prototype.setTranslate=function(a,b,c){this.s.useLeft?a.css("left",b):a.css({transform:"translate3d("+b+"px, "+c+"px, 0px)"})},e.prototype.touchMove=function(b,c){var d=c-b;Math.abs(d)>15&&(this.$outer.addClass("lg-dragging"),this.setTranslate(this.$slide.eq(this.index),d,0),this.setTranslate(a(".lg-prev-slide"),-this.$slide.eq(this.index).width()+d,0),this.setTranslate(a(".lg-next-slide"),this.$slide.eq(this.index).width()+d,0))},e.prototype.touchEnd=function(a){var b=this;"lg-slide"!==b.s.mode&&b.$outer.addClass("lg-slide"),this.$slide.not(".lg-current, .lg-prev-slide, .lg-next-slide").css("opacity","0"),setTimeout(function(){b.$outer.removeClass("lg-dragging"),0>a&&Math.abs(a)>b.s.swipeThreshold?b.goToNextSlide(!0):a>0&&Math.abs(a)>b.s.swipeThreshold?b.goToPrevSlide(!0):Math.abs(a)<5&&b.$el.trigger("onSlideClick.lg"),b.$slide.removeAttr("style")}),setTimeout(function(){b.$outer.hasClass("lg-dragging")||"lg-slide"===b.s.mode||b.$outer.removeClass("lg-slide")},b.s.speed+100)},e.prototype.enableSwipe=function(){var a=this,b=0,c=0,d=!1;a.s.enableSwipe&&a.isTouch&&a.doCss()&&(a.$slide.on("touchstart.lg",function(c){a.$outer.hasClass("lg-zoomed")||a.lgBusy||(c.preventDefault(),a.manageSwipeClass(),b=c.originalEvent.targetTouches[0].pageX)}),a.$slide.on("touchmove.lg",function(e){a.$outer.hasClass("lg-zoomed")||(e.preventDefault(),c=e.originalEvent.targetTouches[0].pageX,a.touchMove(b,c),d=!0)}),a.$slide.on("touchend.lg",function(){a.$outer.hasClass("lg-zoomed")||(d?(d=!1,a.touchEnd(c-b)):a.$el.trigger("onSlideClick.lg"))}))},e.prototype.enableDrag=function(){var c=this,d=0,e=0,f=!1,g=!1;c.s.enableDrag&&!c.isTouch&&c.doCss()&&(c.$slide.on("mousedown.lg",function(b){c.$outer.hasClass("lg-zoomed")||(a(b.target).hasClass("lg-object")||a(b.target).hasClass("lg-video-play"))&&(b.preventDefault(),c.lgBusy||(c.manageSwipeClass(),d=b.pageX,f=!0,c.$outer.scrollLeft+=1,c.$outer.scrollLeft-=1,c.$outer.removeClass("lg-grab").addClass("lg-grabbing"),c.$el.trigger("onDragstart.lg")))}),a(b).on("mousemove.lg",function(a){f&&(g=!0,e=a.pageX,c.touchMove(d,e),c.$el.trigger("onDragmove.lg"))}),a(b).on("mouseup.lg",function(b){g?(g=!1,c.touchEnd(e-d),c.$el.trigger("onDragend.lg")):(a(b.target).hasClass("lg-object")||a(b.target).hasClass("lg-video-play"))&&c.$el.trigger("onSlideClick.lg"),f&&(f=!1,c.$outer.removeClass("lg-grabbing").addClass("lg-grab"))}))},e.prototype.manageSwipeClass=function(){var a=this.index+1,b=this.index-1,c=this.$slide.length;this.s.loop&&(0===this.index?b=c-1:this.index===c-1&&(a=0)),this.$slide.removeClass("lg-next-slide lg-prev-slide"),b>-1&&this.$slide.eq(b).addClass("lg-prev-slide"),this.$slide.eq(a).addClass("lg-next-slide")},e.prototype.mousewheel=function(){var a=this;a.$outer.on("mousewheel.lg",function(b){b.deltaY&&(b.deltaY>0?a.goToPrevSlide():a.goToNextSlide(),b.preventDefault())})},e.prototype.closeGallery=function(){var b=this,c=!1;this.$outer.find(".lg-close").on("click.lg",function(){b.destroy()}),b.s.closable&&(b.$outer.on("mousedown.lg",function(b){c=!!(a(b.target).is(".lg-outer")||a(b.target).is(".lg-item ")||a(b.target).is(".lg-img-wrap"))}),b.$outer.on("mouseup.lg",function(d){(a(d.target).is(".lg-outer")||a(d.target).is(".lg-item ")||a(d.target).is(".lg-img-wrap")&&c)&&(b.$outer.hasClass("lg-dragging")||b.destroy())}))},e.prototype.destroy=function(c){var d=this;c||d.$el.trigger("onBeforeClose.lg"),a(b).scrollTop(d.prevScrollTop),c&&(d.s.dynamic||this.$items.off("click.lg click.lgcustom"),a.removeData(d.el,"lightGallery")),this.$el.off(".lg.tm"),a.each(a.fn.lightGallery.modules,function(a){d.modules[a]&&d.modules[a].destroy()}),this.lGalleryOn=!1,clearTimeout(d.hideBartimeout),this.hideBartimeout=!1,a(b).off(".lg"),a("body").removeClass("lg-on lg-from-hash"),d.$outer&&d.$outer.removeClass("lg-visible"),a(".lg-backdrop").removeClass("in"),setTimeout(function(){d.$outer&&d.$outer.remove(),a(".lg-backdrop").remove(),c||d.$el.trigger("onCloseAfter.lg")},d.s.backdropDuration+50)},a.fn.lightGallery=function(b){return this.each(function(){if(a.data(this,"lightGallery"))try{a(this).data("lightGallery").init()}catch(c){console.error("lightGallery has not initiated properly")}else a.data(this,"lightGallery",new e(this,b))})},a.fn.lightGallery.modules={}}(jQuery,window,document)});!function(a,b){"function"==typeof define&&define.amd?define([],function(){return b()}):"object"==typeof exports?module.exports=b():b()}(this,function(){!function(a,b,c,d){"use strict";var e={videoMaxWidth:"855px",youtubePlayerParams:!1,vimeoPlayerParams:!1,dailymotionPlayerParams:!1,vkPlayerParams:!1,videojs:!1,videojsOptions:{}},f=function(b){return this.core=a(b).data("lightGallery"),this.$el=a(b),this.core.s=a.extend({},e,this.core.s),this.videoLoaded=!1,this.init(),this};f.prototype.init=function(){var b=this;b.core.$el.on("hasVideo.lg.tm",function(a,c,d,e){if(b.core.$slide.eq(c).find(".lg-video").append(b.loadVideo(d,"lg-object",!0,c,e)),e)if(b.core.s.videojs)try{videojs(b.core.$slide.eq(c).find(".lg-html5").get(0),b.core.s.videojsOptions,function(){b.videoLoaded||this.play()})}catch(a){console.error("Make sure you have included videojs")}else b.core.$slide.eq(c).find(".lg-html5").get(0).play()}),b.core.$el.on("onAferAppendSlide.lg.tm",function(a,c){b.core.$slide.eq(c).find(".lg-video-cont").css("max-width",b.core.s.videoMaxWidth),b.videoLoaded=!0});var c=function(a){if(a.find(".lg-object").hasClass("lg-has-poster")&&a.find(".lg-object").is(":visible"))if(a.hasClass("lg-has-video")){var c=a.find(".lg-youtube").get(0),d=a.find(".lg-vimeo").get(0),e=a.find(".lg-dailymotion").get(0),f=a.find(".lg-html5").get(0);if(c)c.contentWindow.postMessage('{"event":"command","func":"playVideo","args":""}',"*");else if(d)try{$f(d).api("play")}catch(a){console.error("Make sure you have included froogaloop2 js")}else if(e)e.contentWindow.postMessage("play","*");else if(f)if(b.core.s.videojs)try{videojs(f).play()}catch(a){console.error("Make sure you have included videojs")}else f.play();a.addClass("lg-video-playing")}else{a.addClass("lg-video-playing lg-has-video");var g,h,i=function(c,d){if(a.find(".lg-video").append(b.loadVideo(c,"",!1,b.core.index,d)),d)if(b.core.s.videojs)try{videojs(b.core.$slide.eq(b.core.index).find(".lg-html5").get(0),b.core.s.videojsOptions,function(){this.play()})}catch(a){console.error("Make sure you have included videojs")}else b.core.$slide.eq(b.core.index).find(".lg-html5").get(0).play()};b.core.s.dynamic?(g=b.core.s.dynamicEl[b.core.index].src,h=b.core.s.dynamicEl[b.core.index].html,i(g,h)):(g=b.core.$items.eq(b.core.index).attr("href")||b.core.$items.eq(b.core.index).attr("data-src"),h=b.core.$items.eq(b.core.index).attr("data-html"),i(g,h));var j=a.find(".lg-object");a.find(".lg-video").append(j),a.find(".lg-video-object").hasClass("lg-html5")||(a.removeClass("lg-complete"),a.find(".lg-video-object").on("load.lg error.lg",function(){a.addClass("lg-complete")}))}};b.core.doCss()&&b.core.$items.length>1&&(b.core.s.enableSwipe&&b.core.isTouch||b.core.s.enableDrag&&!b.core.isTouch)?b.core.$el.on("onSlideClick.lg.tm",function(){var a=b.core.$slide.eq(b.core.index);c(a)}):b.core.$slide.on("click.lg",function(){c(a(this))}),b.core.$el.on("onBeforeSlide.lg.tm",function(c,d,e){var f=b.core.$slide.eq(d),g=f.find(".lg-youtube").get(0),h=f.find(".lg-vimeo").get(0),i=f.find(".lg-dailymotion").get(0),j=f.find(".lg-vk").get(0),k=f.find(".lg-html5").get(0);if(g)g.contentWindow.postMessage('{"event":"command","func":"pauseVideo","args":""}',"*");else if(h)try{$f(h).api("pause")}catch(a){console.error("Make sure you have included froogaloop2 js")}else if(i)i.contentWindow.postMessage("pause","*");else if(k)if(b.core.s.videojs)try{videojs(k).pause()}catch(a){console.error("Make sure you have included videojs")}else k.pause();j&&a(j).attr("src",a(j).attr("src").replace("&autoplay","&noplay"));var l;l=b.core.s.dynamic?b.core.s.dynamicEl[e].src:b.core.$items.eq(e).attr("href")||b.core.$items.eq(e).attr("data-src");var m=b.core.isVideo(l,e)||{};(m.youtube||m.vimeo||m.dailymotion||m.vk)&&b.core.$outer.addClass("lg-hide-download")}),b.core.$el.on("onAfterSlide.lg.tm",function(a,c){b.core.$slide.eq(c).removeClass("lg-video-playing")})},f.prototype.loadVideo=function(b,c,d,e,f){var g="",h=1,i="",j=this.core.isVideo(b,e)||{};if(d&&(h=this.videoLoaded?0:1),j.youtube)i="?wmode=opaque&autoplay="+h+"&enablejsapi=1",this.core.s.youtubePlayerParams&&(i=i+"&"+a.param(this.core.s.youtubePlayerParams)),g='<iframe class="lg-video-object lg-youtube '+c+'" width="560" height="315" src="//www.youtube.com/embed/'+j.youtube[1]+i+'" frameborder="0" allowfullscreen></iframe>';else if(j.vimeo)i="?autoplay="+h+"&api=1",this.core.s.vimeoPlayerParams&&(i=i+"&"+a.param(this.core.s.vimeoPlayerParams)),g='<iframe class="lg-video-object lg-vimeo '+c+'" width="560" height="315"  src="//player.vimeo.com/video/'+j.vimeo[1]+i+'" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>';else if(j.dailymotion)i="?wmode=opaque&autoplay="+h+"&api=postMessage",this.core.s.dailymotionPlayerParams&&(i=i+"&"+a.param(this.core.s.dailymotionPlayerParams)),g='<iframe class="lg-video-object lg-dailymotion '+c+'" width="560" height="315" src="//www.dailymotion.com/embed/video/'+j.dailymotion[1]+i+'" frameborder="0" allowfullscreen></iframe>';else if(j.html5){var k=f.substring(0,1);"."!==k&&"#"!==k||(f=a(f).html()),g=f}else j.vk&&(i="&autoplay="+h,this.core.s.vkPlayerParams&&(i=i+"&"+a.param(this.core.s.vkPlayerParams)),g='<iframe class="lg-video-object lg-vk '+c+'" width="560" height="315" src="http://vk.com/video_ext.php?'+j.vk[1]+i+'" frameborder="0" allowfullscreen></iframe>');return g},f.prototype.destroy=function(){this.videoLoaded=!1},a.fn.lightGallery.modules.video=f}(jQuery,window,document)});!function(a,b){"function"==typeof define&&define.amd?define(["jquery"],function(a){return b(a)}):"object"==typeof exports?module.exports=b(require("jquery")):b(jQuery)}(this,function(a){!function(){"use strict";var b=function(){var a=!1,b=navigator.userAgent.match(/Chrom(e|ium)\/([0-9]+)\./);return b&&parseInt(b[2],10)<54&&(a=!0),a},c={scale:1,zoom:!0,actualSize:!0,enableZoomAfter:300,useLeftForZoom:b()},d=function(b){return this.core=a(b).data("lightGallery"),this.core.s=a.extend({},c,this.core.s),this.core.s.zoom&&this.core.doCss()&&(this.init(),this.zoomabletimeout=!1,this.pageX=a(window).width()/2,this.pageY=a(window).height()/2+a(window).scrollTop()),this};d.prototype.init=function(){var b=this,c='<span id="lg-zoom-in" class="lg-icon"></span><span id="lg-zoom-out" class="lg-icon"></span>';b.core.s.actualSize&&(c+='<span id="lg-actual-size" class="lg-icon"></span>'),b.core.s.useLeftForZoom?b.core.$outer.addClass("lg-use-left-for-zoom"):b.core.$outer.addClass("lg-use-transition-for-zoom"),this.core.$outer.find(".lg-toolbar").append(c),b.core.$el.on("onSlideItemLoad.lg.tm.zoom",function(c,d,e){var f=b.core.s.enableZoomAfter+e;a("body").hasClass("lg-from-hash")&&e?f=0:a("body").removeClass("lg-from-hash"),b.zoomabletimeout=setTimeout(function(){b.core.$slide.eq(d).addClass("lg-zoomable")},f+30)});var d=1,e=function(c){var d,e,f=b.core.$outer.find(".lg-current .lg-image"),g=(a(window).width()-f.prop("offsetWidth"))/2,h=(a(window).height()-f.prop("offsetHeight"))/2+a(window).scrollTop();d=b.pageX-g,e=b.pageY-h;var i=(c-1)*d,j=(c-1)*e;f.css("transform","scale3d("+c+", "+c+", 1)").attr("data-scale",c),b.core.s.useLeftForZoom?f.parent().css({left:-i+"px",top:-j+"px"}).attr("data-x",i).attr("data-y",j):f.parent().css("transform","translate3d(-"+i+"px, -"+j+"px, 0)").attr("data-x",i).attr("data-y",j)},f=function(){d>1?b.core.$outer.addClass("lg-zoomed"):b.resetZoom(),d<1&&(d=1),e(d)},g=function(c,e,g,h){var i,j=e.prop("offsetWidth");i=b.core.s.dynamic?b.core.s.dynamicEl[g].width||e[0].naturalWidth||j:b.core.$items.eq(g).attr("data-width")||e[0].naturalWidth||j;var k;b.core.$outer.hasClass("lg-zoomed")?d=1:i>j&&(k=i/j,d=k||2),h?(b.pageX=a(window).width()/2,b.pageY=a(window).height()/2+a(window).scrollTop()):(b.pageX=c.pageX||c.originalEvent.targetTouches[0].pageX,b.pageY=c.pageY||c.originalEvent.targetTouches[0].pageY),f(),setTimeout(function(){b.core.$outer.removeClass("lg-grabbing").addClass("lg-grab")},10)},h=!1;b.core.$el.on("onAferAppendSlide.lg.tm.zoom",function(a,c){var d=b.core.$slide.eq(c).find(".lg-image");d.on("dblclick",function(a){g(a,d,c)}),d.on("touchstart",function(a){h?(clearTimeout(h),h=null,g(a,d,c)):h=setTimeout(function(){h=null},300),a.preventDefault()})}),a(window).on("resize.lg.zoom scroll.lg.zoom orientationchange.lg.zoom",function(){b.pageX=a(window).width()/2,b.pageY=a(window).height()/2+a(window).scrollTop(),e(d)}),a("#lg-zoom-out").on("click.lg",function(){b.core.$outer.find(".lg-current .lg-image").length&&(d-=b.core.s.scale,f())}),a("#lg-zoom-in").on("click.lg",function(){b.core.$outer.find(".lg-current .lg-image").length&&(d+=b.core.s.scale,f())}),a("#lg-actual-size").on("click.lg",function(a){g(a,b.core.$slide.eq(b.core.index).find(".lg-image"),b.core.index,!0)}),b.core.$el.on("onBeforeSlide.lg.tm",function(){d=1,b.resetZoom()}),b.zoomDrag(),b.zoomSwipe()},d.prototype.resetZoom=function(){this.core.$outer.removeClass("lg-zoomed"),this.core.$slide.find(".lg-img-wrap").removeAttr("style data-x data-y"),this.core.$slide.find(".lg-image").removeAttr("style data-scale"),this.pageX=a(window).width()/2,this.pageY=a(window).height()/2+a(window).scrollTop()},d.prototype.zoomSwipe=function(){var a=this,b={},c={},d=!1,e=!1,f=!1;a.core.$slide.on("touchstart.lg",function(c){if(a.core.$outer.hasClass("lg-zoomed")){var d=a.core.$slide.eq(a.core.index).find(".lg-object");f=d.prop("offsetHeight")*d.attr("data-scale")>a.core.$outer.find(".lg").height(),e=d.prop("offsetWidth")*d.attr("data-scale")>a.core.$outer.find(".lg").width(),(e||f)&&(c.preventDefault(),b={x:c.originalEvent.targetTouches[0].pageX,y:c.originalEvent.targetTouches[0].pageY})}}),a.core.$slide.on("touchmove.lg",function(g){if(a.core.$outer.hasClass("lg-zoomed")){var h,i,j=a.core.$slide.eq(a.core.index).find(".lg-img-wrap");g.preventDefault(),d=!0,c={x:g.originalEvent.targetTouches[0].pageX,y:g.originalEvent.targetTouches[0].pageY},a.core.$outer.addClass("lg-zoom-dragging"),i=f?-Math.abs(j.attr("data-y"))+(c.y-b.y):-Math.abs(j.attr("data-y")),h=e?-Math.abs(j.attr("data-x"))+(c.x-b.x):-Math.abs(j.attr("data-x")),(Math.abs(c.x-b.x)>15||Math.abs(c.y-b.y)>15)&&(a.core.s.useLeftForZoom?j.css({left:h+"px",top:i+"px"}):j.css("transform","translate3d("+h+"px, "+i+"px, 0)"))}}),a.core.$slide.on("touchend.lg",function(){a.core.$outer.hasClass("lg-zoomed")&&d&&(d=!1,a.core.$outer.removeClass("lg-zoom-dragging"),a.touchendZoom(b,c,e,f))})},d.prototype.zoomDrag=function(){var b=this,c={},d={},e=!1,f=!1,g=!1,h=!1;b.core.$slide.on("mousedown.lg.zoom",function(d){var f=b.core.$slide.eq(b.core.index).find(".lg-object");h=f.prop("offsetHeight")*f.attr("data-scale")>b.core.$outer.find(".lg").height(),g=f.prop("offsetWidth")*f.attr("data-scale")>b.core.$outer.find(".lg").width(),b.core.$outer.hasClass("lg-zoomed")&&a(d.target).hasClass("lg-object")&&(g||h)&&(d.preventDefault(),c={x:d.pageX,y:d.pageY},e=!0,b.core.$outer.scrollLeft+=1,b.core.$outer.scrollLeft-=1,b.core.$outer.removeClass("lg-grab").addClass("lg-grabbing"))}),a(window).on("mousemove.lg.zoom",function(a){if(e){var i,j,k=b.core.$slide.eq(b.core.index).find(".lg-img-wrap");f=!0,d={x:a.pageX,y:a.pageY},b.core.$outer.addClass("lg-zoom-dragging"),j=h?-Math.abs(k.attr("data-y"))+(d.y-c.y):-Math.abs(k.attr("data-y")),i=g?-Math.abs(k.attr("data-x"))+(d.x-c.x):-Math.abs(k.attr("data-x")),b.core.s.useLeftForZoom?k.css({left:i+"px",top:j+"px"}):k.css("transform","translate3d("+i+"px, "+j+"px, 0)")}}),a(window).on("mouseup.lg.zoom",function(a){e&&(e=!1,b.core.$outer.removeClass("lg-zoom-dragging"),!f||c.x===d.x&&c.y===d.y||(d={x:a.pageX,y:a.pageY},b.touchendZoom(c,d,g,h)),f=!1),b.core.$outer.removeClass("lg-grabbing").addClass("lg-grab")})},d.prototype.touchendZoom=function(a,b,c,d){var e=this,f=e.core.$slide.eq(e.core.index).find(".lg-img-wrap"),g=e.core.$slide.eq(e.core.index).find(".lg-object"),h=-Math.abs(f.attr("data-x"))+(b.x-a.x),i=-Math.abs(f.attr("data-y"))+(b.y-a.y),j=(e.core.$outer.find(".lg").height()-g.prop("offsetHeight"))/2,k=Math.abs(g.prop("offsetHeight")*Math.abs(g.attr("data-scale"))-e.core.$outer.find(".lg").height()+j),l=(e.core.$outer.find(".lg").width()-g.prop("offsetWidth"))/2,m=Math.abs(g.prop("offsetWidth")*Math.abs(g.attr("data-scale"))-e.core.$outer.find(".lg").width()+l);(Math.abs(b.x-a.x)>15||Math.abs(b.y-a.y)>15)&&(d&&(i<=-k?i=-k:i>=-j&&(i=-j)),c&&(h<=-m?h=-m:h>=-l&&(h=-l)),d?f.attr("data-y",Math.abs(i)):i=-Math.abs(f.attr("data-y")),c?f.attr("data-x",Math.abs(h)):h=-Math.abs(f.attr("data-x")),e.core.s.useLeftForZoom?f.css({left:h+"px",top:i+"px"}):f.css("transform","translate3d("+h+"px, "+i+"px, 0)"))},d.prototype.destroy=function(){var b=this;b.core.$el.off(".lg.zoom"),a(window).off(".lg.zoom"),b.core.$slide.off(".lg.zoom"),b.core.$el.off(".lg.tm.zoom"),b.resetZoom(),clearTimeout(b.zoomabletimeout),b.zoomabletimeout=!1},a.fn.lightGallery.modules.zoom=d}()});

/* Theia Sticky 1.6.0 */
!function(i){"use strict";i.fn.theiaStickySidebar=function(t){function e(t,e){var a=o(t,e);a||(console.log("TSS: Body width smaller than options.minWidth. Init is delayed."),i(document).on("scroll."+t.namespace,function(t,e){return function(a){var n=o(t,e);n&&i(this).unbind(a)}}(t,e)),i(window).on("resize."+t.namespace,function(t,e){return function(a){var n=o(t,e);n&&i(this).unbind(a)}}(t,e)))}function o(t,e){return t.initialized===!0||!(i("body").width()<t.minWidth)&&(a(t,e),!0)}function a(t,e){t.initialized=!0;var o=i("#theia-sticky-sidebar-stylesheet-"+t.namespace);0===o.length&&i("head").append(i('<style id="theia-sticky-sidebar-stylesheet-'+t.namespace+'">.theiaStickySidebar:after {content: ""; display: table; clear: both;}</style>')),e.each(function(){function e(){a.fixedScrollTop=0,a.sidebar.css({"min-height":"1px"}),a.stickySidebar.css({position:"static",width:"",transform:"none"})}function o(t){var e=t.height();return t.children().each(function(){e=Math.max(e,i(this).height())}),e}var a={};if(a.sidebar=i(this),a.options=t||{},a.container=i(a.options.containerSelector),0==a.container.length&&(a.container=a.sidebar.parent()),a.sidebar.parents().css("-webkit-transform","none"),a.sidebar.css({position:a.options.defaultPosition,overflow:"visible","-webkit-box-sizing":"border-box","-moz-box-sizing":"border-box","box-sizing":"border-box"}),a.stickySidebar=a.sidebar.find(".theiaStickySidebar"),0==a.stickySidebar.length){var s=/(?:text|application)\/(?:x-)?(?:javascript|ecmascript)/i;a.sidebar.find("script").filter(function(i,t){return 0===t.type.length||t.type.match(s)}).remove(),a.stickySidebar=i("<div>").addClass("theiaStickySidebar").append(a.sidebar.children()),a.sidebar.append(a.stickySidebar)}a.marginBottom=parseInt(a.sidebar.css("margin-bottom")),a.paddingTop=parseInt(a.sidebar.css("padding-top")),a.paddingBottom=parseInt(a.sidebar.css("padding-bottom"));var r=a.stickySidebar.offset().top,d=a.stickySidebar.outerHeight();a.stickySidebar.css("padding-top",1),a.stickySidebar.css("padding-bottom",1),r-=a.stickySidebar.offset().top,d=a.stickySidebar.outerHeight()-d-r,0==r?(a.stickySidebar.css("padding-top",0),a.stickySidebarPaddingTop=0):a.stickySidebarPaddingTop=1,0==d?(a.stickySidebar.css("padding-bottom",0),a.stickySidebarPaddingBottom=0):a.stickySidebarPaddingBottom=1,a.previousScrollTop=null,a.fixedScrollTop=0,e(),a.onScroll=function(a){if(a.stickySidebar.is(":visible")){if(i("body").width()<a.options.minWidth)return void e();if(a.options.disableOnResponsiveLayouts){var s=a.sidebar.outerWidth("none"==a.sidebar.css("float"));if(s+50>a.container.width())return void e()}var r=i(document).scrollTop(),d="static";if(r>=a.sidebar.offset().top+(a.paddingTop-a.options.additionalMarginTop)){var c,p=a.paddingTop+t.additionalMarginTop,b=a.paddingBottom+a.marginBottom+t.additionalMarginBottom,l=a.sidebar.offset().top,f=a.sidebar.offset().top+o(a.container),h=0+t.additionalMarginTop,g=a.stickySidebar.outerHeight()+p+b<i(window).height();c=g?h+a.stickySidebar.outerHeight():i(window).height()-a.marginBottom-a.paddingBottom-t.additionalMarginBottom;var u=l-r+a.paddingTop,S=f-r-a.paddingBottom-a.marginBottom,y=a.stickySidebar.offset().top-r,m=a.previousScrollTop-r;"fixed"==a.stickySidebar.css("position")&&"modern"==a.options.sidebarBehavior&&(y+=m),"stick-to-top"==a.options.sidebarBehavior&&(y=t.additionalMarginTop),"stick-to-bottom"==a.options.sidebarBehavior&&(y=c-a.stickySidebar.outerHeight()),y=m>0?Math.min(y,h):Math.max(y,c-a.stickySidebar.outerHeight()),y=Math.max(y,u),y=Math.min(y,S-a.stickySidebar.outerHeight());var k=a.container.height()==a.stickySidebar.outerHeight();d=(k||y!=h)&&(k||y!=c-a.stickySidebar.outerHeight())?r+y-a.sidebar.offset().top-a.paddingTop<=t.additionalMarginTop?"static":"absolute":"fixed"}if("fixed"==d){var v=i(document).scrollLeft();a.stickySidebar.css({position:"fixed",width:n(a.stickySidebar)+"px",transform:"translateY("+y+"px)",left:a.sidebar.offset().left+parseInt(a.sidebar.css("padding-left"))-v+"px",top:"0px"})}else if("absolute"==d){var x={};"absolute"!=a.stickySidebar.css("position")&&(x.position="absolute",x.transform="translateY("+(r+y-a.sidebar.offset().top-a.stickySidebarPaddingTop-a.stickySidebarPaddingBottom)+"px)",x.top="0px"),x.width=n(a.stickySidebar)+"px",x.left="",a.stickySidebar.css(x)}else"static"==d&&e();"static"!=d&&1==a.options.updateSidebarHeight&&a.sidebar.css({"min-height":a.stickySidebar.outerHeight()+a.stickySidebar.offset().top-a.sidebar.offset().top+a.paddingBottom}),a.previousScrollTop=r}},a.onScroll(a),i(document).on("scroll."+a.options.namespace,function(i){return function(){i.onScroll(i)}}(a)),i(window).on("resize."+a.options.namespace,function(i){return function(){i.stickySidebar.css({position:"static"}),i.onScroll(i)}}(a)),"undefined"!=typeof ResizeSensor&&new ResizeSensor(a.stickySidebar[0],function(i){return function(){i.onScroll(i)}}(a))})}function n(i){var t;try{t=i[0].getBoundingClientRect().width}catch(i){}return"undefined"==typeof t&&(t=i.width()),t}var s={containerSelector:"",additionalMarginTop:0,additionalMarginBottom:0,updateSidebarHeight:!0,minWidth:0,disableOnResponsiveLayouts:!0,sidebarBehavior:"modern",defaultPosition:"relative",namespace:"TSS"};return t=i.extend(s,t),t.additionalMarginTop=parseInt(t.additionalMarginTop)||0,t.additionalMarginBottom=parseInt(t.additionalMarginBottom)||0,e(t,this),this}}(jQuery);

/* Codevz do once 1.0 */
!function(t){"use strict";t.fn.czOnce=function(n,i){var a=this,n="js_"+n;a.length&&a.each(function(a){(!t(this).hasClass(n)||t(".vc_editor").length)&&i.apply(t(this).addClass(n,1),[a])})}}(jQuery);

/* Custom Scripts */
var Codevz = (function($) {
	"use strict";

	var body = $( 'body' ),
		wind = $( window ),
		inla = $( '.inner_layout' ),
		abar = ( $( '.admin-bar' ).length ? 32 : 0 ),
		debounce = function(n,t){var i;return function(){var e=arguments;clearTimeout(i),i=setTimeout(function(){n.apply(this,e)}.bind(this),t)}};

	return {
		init: function() {
			this.search();
			this.loading();
			this.extra_panel();
			this.lightGallery();
			this.header_shape();
			this.woo_quantity();

			// Posts equality
			$( '.cz_default_loop_grid' ).closest( '.cz_posts_container' ).addClass( 'cz_posts_equal' );

			// Title Parallax
			$( '[data-title-parallax]' ).czOnce( 'pt_paralalx', function() {
				var en = $( this ), 
					p = en.parent().height() + 200;
				if ( en.css( 'background-image' ) && en.css( 'background-image' ) !== 'none' ) {
					wind.on( 'scroll', function() {
						if ( p >= wind.scrollTop() ) {
							en.css( 'background-position-y', wind.scrollTop() / en.data( 'title-parallax' ) );
						}
					});
				}
			});

			// Fixed Side
			$( '.fixed_side' ).czOnce( 'fixed_side', function() {
				var en = $( this ),
					ff_pos = en.hasClass( 'fixed_side_left' ) ? 'left' : 'right';

				// Sticky
				en.theiaStickySidebar({additionalMarginTop: 0,updateSidebarHeight: false});

				// Size's
				wind.on( 'resize', debounce(function() {
					if ( en.css( 'display' ) === 'none' ) {
						inla.css( 'width', '100%' );
					} else {
						en.css( 'height', wind.height() - parseInt( $( '#layout' ).css( 'marginTop' ) + body.css( 'marginTop' ) ) );
						inla.css( 'width', 'calc( 100% - ' + en.outerWidth() + 'px )' );
					}
				}, 100 ));
			});

			// Sticky sidebars & content
			$( '.cz_sticky .row > section, .cz_sticky .row > aside, .cz_sticky_col' ).czOnce( 'sticky', function() {
				$( this ).theiaStickySidebar({additionalMarginTop: ( $( '.header_is_sticky:not(.smart_sticky)' ).height() + 60 ),updateSidebarHeight: false});
			});

			// Fixed Footer
			$( '.cz_fixed_footer' ).czOnce( 'fixed_footer', function() {
				wind.on( 'resize', debounce(function() {
					body.css( 'margin-bottom', $( '.cz_fixed_footer' ).height() );
				}, 500 ));

				// Temp fix
				setTimeout(function() {
					body.css( 'margin-bottom', $( '.cz_fixed_footer' ).height() );
				}, 1000 );
			});

			// Header line full height
			$( '.header_line_1' ).czOnce( 'header_line', function() {
				$( this ).height( $( this ).closest( '.row' ).height() );
			});

			// Menus
			$( '.sf-menu' ).czOnce( 'sf_menu', function() {
				var disMenu 	= $( this ),
					indicator 	= disMenu.data( 'indicator' ),
					default_ind = disMenu.hasClass( 'offcanvas_menu' ) ? 'fa fa-angle-down' : '',
					indicator 	= indicator ? indicator : default_ind,
					indicator2 	= disMenu.data( 'indicator2' ),
					indicator2 	= indicator2 ? indicator2 : default_ind,
					opa = $( '.page_content, .page_cover, footer' );

				// Super Fish
				disMenu.superfish({
					onInit: function() {

						// Menu Indicators
						$( '.sf-with-ul, h6', this ).each(function() {
							var en = $( this );
							if ( ! $( '.cz_indicator', en ).length ) {
								en.append( '<i class="cz_indicator"></i>' );
							}
							if ( ( indicator && indicator.length ) || ( indicator2 && indicator2.length ) ) {
								$( '.cz_indicator', en ).addClass( ( en.parent().parent().hasClass( 'sf-menu' ) ? indicator : indicator2 ) );
							}
						});

						// Fix menus width
						Codevz.fixMenusWidthBreaks();
					},
					//onBeforeHide: function() {
						//if ( ! $( '.sfHover', disMenu ).length ) {
							//opa.animate({opacity: 1});
						//}
					//},
					onBeforeShow: function() {
						var dis = $( this );

						//opa.animate({opacity: .5});

						if ( ! dis.is(':visible') ) {
							Codevz.showOneByOne( $( '> .cz', this ), 8 );
							Codevz.showOneByOne( $( '> .cz .cz', this ), 8 );
						}

						if ( dis.hasClass('sub-menu') ) {
							var ul_offset = 200;

							// Check if mega menu is fullwide
							if ( dis.parent().hasClass( 'cz_megamenu_width_fullwide' ) ) {
								dis.css( 'cssText', 'width: ' + wind.width() + 'px !important' );
								ul_offset = 0;
							}

							// Sub-menu styling
							setTimeout(function() {
								dis.attr( 'style', dis.attr( 'style' ) + dis.parent().data( 'sub-menu' ) );
							}, 50 );

							// Megamenu
							if ( dis.parent().hasClass( 'cz_parent_megamenu' ) ) {
								dis.addClass( 'cz_megamenu_' + $( '> .cz', dis ).length ).find( 'ul' ).addClass( 'cz_megamenu_inner_ul clr' );
							}

							// Megamenu width offset than window
							var parent_li_offset = wind.width() - dis.parent().offset().left,
								dis_ul_width = dis.width() + ul_offset;
							if ( parent_li_offset < dis_ul_width ) {
								var new_ul_offset = dis_ul_width - parent_li_offset;
								dis.css( 'left', -new_ul_offset + 'px' );
								if ( dis.parent().parent().hasClass('sub-menu') ) {
									dis.addClass( 'cz_open_menu_reverse' ).css('left', '');
								}
							} else {
								dis.removeClass( 'cz_open_menu_reverse' );
							}

							// Megamenu full row
							if ( dis.parent().hasClass( 'cz_megamenu_width_full_row' ) ) {
								var megamenu_row = $( '.row' ),
									megamenu_row_offset = megamenu_row.offset().left;
								dis.css( 'cssText', 'width: ' + megamenu_row.width() + 'px !important' ).css( 'left', ( megamenu_row_offset - dis.parent().offset().left ) + 'px' );
								ul_offset = 0;
							}

						}

						if ( dis.closest('.fixed_side').length ) {
							var pwidth = dis.parent().closest( '.sub-menu' ).length ? '.sub-menu' : '.sf-menu',
								ff_pos = $( '.fixed_side' ).hasClass( 'fixed_side_left' ) ? 'left' : 'right';
							dis.css( ff_pos, dis.closest( pwidth ).width() );
						}
					}
				});

				// Fullscreen Menu
				$( '.icon_fullscreen_menu' ).czOnce( 'fulls_menu', function() {
					$( this ).off( 'click' ).on( 'click', function() {
						var sf_f = $( '.fullscreen_menu' );
						sf_f.fadeIn( 'fast', function() {
							body.addClass( 'cz_noscroll' );
						}).on( 'click', function() {
							$( this ).fadeOut( 'fast', function() {
								body.removeClass( 'cz_noscroll' );
							});
						});
						if ( sf_f.is(':visible') ) {
							Codevz.showOneByOne( $( '> .cz', sf_f ), 100 );
						}
						wind.on( 'resize', debounce(function() {
							sf_f.css( 'padding-top', ( wind.height() / 2 - sf_f.height() / 4 ) );
						}, 50 ));
					});
				});

				// Fullscreen
				$( 'ul.fullscreen_menu' ).czOnce( 'ul_fulls_menu', function() {
					$( '.cz', this ).on( 'hover', function(e) {
						e.stopPropagation();
					}).off( 'click' ).on( 'click', function(e) {
						if ( $( e.target ).hasClass( 'cz_indicator' ) ) {
							$( this ).closest( 'li' ).find('> ul').fadeToggle( 'fast' );
							e.preventDefault();
							e.stopPropagation();
						}
					});
				});

				// Dropdown Menu
				$( '.icon_dropdown_menu' ).czOnce( 'dropdown_menu', function() {
					$( this ).off( 'click' ).on( 'click', function(e) {
						var dis = $( this ),
							pos = dis.position(),
							nav = dis.next().next('.sf-menu'),
							row = $( this ).closest('.row').height(),
							offset = ( ( inla.outerWidth() + inla.offset().left ) - dis.offset().left );

						if ( nav.is(':visible') ) {
							nav.fadeOut( 'fast' );
							return;
						}

						nav.fadeToggle( 'fast' );

						body.on( 'click.cz_idm', function(e) {
							nav.fadeOut( 'fast' );
							body.off( 'click.cz_idm' );
						});

						$( '.cz', nav ).on( 'hover', function(e) {
							e.stopPropagation();
						}).off( 'click' ).on( 'click', function(e) {
							if ( $( e.target ).hasClass( 'cz_indicator' ) ) {
								$( this ).closest( 'li' ).find('> ul').fadeToggle( 'fast' );
								e.preventDefault();
								e.stopPropagation();
							}
						});

						e.stopPropagation();
					});
				});

				// Open Menu Horizontal
				$( '.icon_open_horizontal' ).czOnce( 'iohor', function() {
					$( this ).off( 'click' ).on( 'click', function(e) {
						var dis = $( this ),
							pos = dis.position(),
							nav = dis.next().next('.sf-menu'),
							row = $( this ).closest('.row').height(),
							offset = ( ( inla.outerWidth() + inla.offset().left ) - dis.offset().left );

						if ( nav.is(':visible') ) {
							nav.fadeOut( 'fast' );
							return;
						}

						nav.fadeToggle( 'fast' );
						Codevz.showOneByOne( $( '> .cz', nav ), 16, ( nav.hasClass( 'inview_left' ) ? 'left' : 'right' ) );

						body.on( 'click.cz_ioh', function(e) {
							nav.fadeOut( 'fast' );
							body.off( 'click.cz_ioh' );
						});

						e.stopPropagation();
					});
				});

				// Mobile Menu
				disMenu.prev( 'i.icon_mobile_offcanvas_menu' ).czOnce( 'imom', function() {
					var en = $( this );

					en.removeClass( 'hide' ).on( 'click', function() {
						if ( ! $( this ).hasClass( 'done' ) ) {
							$( this ).addClass( 'done' );
							Codevz.offCanvas( $( this ), 1 );
							
							// Add mobile menus indicator
							if ( indicator.length || indicator2.length ) {
								$( this ).next( '.sf-menu' ).find( '.sf-with-ul' ).each(function() {
									$( '.cz_indicator', this ).addClass( ( $( this ).parent().parent().hasClass( 'sf-menu' ) ? indicator : indicator2 ) );
								});
							}

							var ul_offcanvas = $( 'ul.offcanvas_area' );
							$( '.sf-with-ul, .cz > h6', ul_offcanvas ).on( 'click', function(e) {
								if ( $( e.target ).hasClass( 'cz_indicator' ) ) {
									$( this ).next().slideToggle();
									e.preventDefault();
								}
							});
						}
					});
				});
			});

			// OffCanvas
			$( '.offcanvas_container > i' ).czOnce( 'offcanvas_i', function() {
				$( this ).on( 'click', function() {
					if ( ! $( this ).hasClass( 'done' ) ) {
						$( this ).addClass( 'done' );
						Codevz.offCanvas( $( this ), 1 );
					}
				});
			});

			// WPML
			$( '.cz_language_switcher' ).czOnce( 'lang_switcher', function() {
				var dis = $( this ),
					div = $( 'div', dis );

				$( '.cz_current_language', dis ).prependTo( dis );

				dis.on( 'click', '.cz_current_language', function(e) {
					e.preventDefault();
					div.slideToggle();
				}).on( 'click', function(e) {
					e.stopPropagation();
				});

				body.on( 'click', function() {
					div.slideUp();
				});
			});

			// Hidden fullwidth content
			$( '.hf_elm_icon' ).czOnce( 'hf_elm_icon', function() {
				$( this ).on( 'click', function(e) {
					var dis = $( this );

					dis.next( '.hf_elm_area' ).slideToggle().css({
						width: inla.outerWidth(),
						left: inla.offset().left,
						top: dis.offset().top + dis.outerHeight()
					});

					e.preventDefault();
					e.stopPropagation();
				});

				body.on( 'click', function() {
					$( '.hf_elm_area' ).slideUp();
				});
			});

			// Header on title
			$( '.header_onthe_cover' ).czOnce( 'header_otc', function() {
				var en = $( this );
				wind.on( 'resize', function() {
					var height = $('.page_header').outerHeight(),
						margin = $('.header_after_cover').length ? 'margin-bottom' : 'margin-top';
					
					en.css( margin, - height ).css('transform', 'none');
					$('.page_header img').on('load', function(){
						height = $('.page_header').outerHeight();
						en.css( margin, - height );

						// Fix header_onthe_cover in customizer page
						setTimeout( function() {
							wind.resize();
						}, 1000 );
					});
				});

				Codevz.heightChanged( '.page_header', function() {
					wind.resize();
				});
			});

			// iframes auto size
			$( '.cz_iframe, object, embed' ).not('.wp-embedded-content').czOnce( 'cz_iframe', function() {
				var en = $( this ), newWidth;
				wind.on( 'resize', debounce(function() {
					en.attr( 'data-aspectRatio', en.height() / en.width() ).removeAttr( 'height width' );
					newWidth = en.parent().width();
					en.width( newWidth ).height( newWidth * en.attr( 'data-aspectRatio' ) );
				}, 200 ));
			});

			// Back to top
			$( '.backtotop, a[href*="#top"]' ).czOnce( 'backtotop', function() {
				var en = $( this );

				en.on( 'click', function( e ) {
					$( 'html, body' ).animate({scrollTop: 0}, 1000, 'swing');
					e.preventDefault();
				});

				if ( en.hasClass( 'backtotop' ) ) {
					wind.on( 'scroll', debounce(function() {
						if ( $( this ).scrollTop() < 400 ) {
							en.fadeOut( 'fast' ).next( '.fixed_contact' ).css({right: 10});
						} else {
							en.fadeIn( 'fast' ).next( '.fixed_contact' ).css({right: ( en.outerHeight() + 14 )});
						}
					}, 200 ));
				}
			});

			// Fixed contact form
			$( '.fixed_contact' ).czOnce( 'fixed_contact', function() {
				$( this ).on( 'click', function(e) {
					$( this ).next('.fixed_contact').fadeToggle( 'fast' ).css({bottom: $( this ).height() + parseInt( $( this ).css('margin-bottom') ) + 20 });
					e.stopPropagation();
				});
				body.on( 'click', function (e) {
					if ( $( 'div.fixed_contact' ).is(':visible') ) {
						$( 'div.fixed_contact' ).fadeOut( 'fast' );
					}
				});
			});

			// Extra
			$( '.tagcloud' ).length && $( '.tagcloud' ).addClass( 'clr' );

			// Input buttons to button tag
			$( '.form-submit .submit, input.search-submit, .wpcf7-submit' ).czOnce( 'button', function() {
				var en = $( this );
				$('<button name="submit" type="submit" class="' + en.attr('class') + '">' + en.val() + '</button>').insertAfter( en );
				en.detach();
			});

			/* Sticky */
			$( '.header_is_sticky' ).czOnce( 'header_sticky', function(n) {
				var header_sticky = $( this ),
					header_5 = $( '.header_5' ),
					lastScrollTop = 0,
					st, stickyNav, sticky_func, 
					scrollTop = header_sticky.offset().top,
					smart_sticky = function( scroll ) {
						if ( header_sticky.hasClass( 'smart_sticky' ) ) {
							st = scroll.scrollTop();

							if ( st > 400 && st > lastScrollTop ) {
								header_sticky.addClass( 'smart_sticky_on' );
							} else if ( st < lastScrollTop ) {
								header_sticky.removeClass( 'smart_sticky_on' );
							}

							lastScrollTop = st;
						}
					};

				if ( header_5.length ) {
					
					header_5.addClass( 'onSticky' );
					wind.on( 'scroll', debounce(function(e){
						if ( wind.scrollTop() >= $( '.page_header' ).height() ) {
							header_5.css( 'transform', 'translateY(0)' );
						} else {
							header_5.css( 'transform', 'translateY(-120%)' );
						}

						smart_sticky( $( this ) );
					}, 10 ));

				} else if ( header_sticky.length ) {

					/* Add corpse */
					if ( ! header_sticky.prev( '.Corpse_Sticky').length ) {
						header_sticky.before( '<div class="Corpse_Sticky' + ( header_sticky.hasClass( 'header_4' ) ? ' cz_sticky_corpse_for_header_4' : '' ) + '"></div>' );
					}

					var scroll_down,
						new_scrollTop,
						cz_sticky_h12 = $( '.cz_sticky_h12' ).length,
						cz_sticky_h13 = $( '.cz_sticky_h13' ).length,
						cz_sticky_h23 = $( '.cz_sticky_h23' ).length,
						cz_sticky_h123 = $( '.cz_sticky_h123' ).length;

					sticky_func = function(e) {
						if ( header_sticky.hasClass( 'header_4' ) && header_sticky.css( 'display' ) == 'none' ) {
							return;
						}

						new_scrollTop = scrollTop;
						if ( cz_sticky_h12 && header_sticky.hasClass( 'header_2' ) ) {
							new_scrollTop = scrollTop+1 - $( '.header_1' ).outerHeight();
						} else if ( cz_sticky_h13 && header_sticky.hasClass( 'header_3' ) ) {
							new_scrollTop = scrollTop+1 - $( '.header_1' ).outerHeight();
						} else if ( cz_sticky_h23 && header_sticky.hasClass( 'header_3' ) ) {
							new_scrollTop = scrollTop+1 - $( '.header_2' ).outerHeight();
						} else if ( cz_sticky_h123 ) {
							if ( header_sticky.hasClass( 'header_2' ) ) {
								new_scrollTop = scrollTop+1 - $( '.header_1' ).outerHeight();
							}
							if ( header_sticky.hasClass( 'header_3' ) ) {
								new_scrollTop = scrollTop+1 - ( $( '.header_1' ).outerHeight() + $( '.header_2' ).outerHeight() );
							}
						}

						scroll_down = ( wind.scrollTop() + abar ) > new_scrollTop;

						if ( scroll_down && cz_sticky_h12 && header_sticky.hasClass( 'header_2' ) ) {
							$( '.header_2' ).css( 'marginTop', $( '.header_1' ).outerHeight() );
						} else if ( scroll_down && cz_sticky_h13 && header_sticky.hasClass( 'header_3' ) ) {
							$( '.header_3' ).css( 'marginTop', $( '.header_1' ).outerHeight() );
						} else if ( scroll_down && cz_sticky_h23 && header_sticky.hasClass( 'header_3' ) ) {
							$( '.header_3' ).css( 'marginTop', $( '.header_2' ).outerHeight() );
						} else if ( cz_sticky_h123 ) {
							if ( scroll_down && header_sticky.hasClass( 'header_2' ) ) {
								$( '.header_2' ).css( 'marginTop', $( '.header_1' ).outerHeight() );
							}
							if ( scroll_down && header_sticky.hasClass( 'header_3' ) ) {
								$( '.header_3' ).css( 'marginTop', ( $( '.header_1' ).outerHeight() + $( '.header_2' ).outerHeight() ) );
							}
						}

						if ( scroll_down ) {
							header_sticky.addClass( 'onSticky' ).prev( '.Corpse_Sticky' ).css( 'height', header_sticky.outerHeight() + 'px' );
						} else {
							header_sticky.removeClass( 'onSticky' ).prev( '.Corpse_Sticky').css( 'height', 'auto' );
							header_sticky.css( 'marginTop', '' );
						}

						smart_sticky( $( this ) );
						header_sticky.css( 'width', inla.width() + 'px' );
					};

					wind.off( 'scroll.cz_sticky_' + n ).on( 'scroll.cz_sticky_' + n, debounce(sticky_func, 10 ));
					wind.off( 'resize.cz_sticky_' + n ).on( 'resize.cz_sticky_' + n, debounce(sticky_func, 100 ));
				}
			});

			// Fixed banner ads
			$( '.cz_fixed_ad_1' ).czOnce( 'fixed_ad', function() {
				var en = $( this ), 
					on = $( '.cz_fixed_ad_2' );

				wind.on( 'resize', debounce(function() {
					var cz_row_left = $( '.row' ).offset().left - 100;
					en.css({
						top: 200,
						left: cz_row_left - $( '.cz_fixed_ad_1' ).width(),
					}).removeClass( 'hide' );
					on.css({
						top: 200,
						right: cz_row_left - $( '.cz_fixed_ad_2' ).width(),
					}).removeClass( 'hide' );
				}, 50 ));
			});

			this.menu_anchor();
		},

		/*
		*   Menu Anchor
		*/
		menu_anchor: function() {
			var mPage = $( '.sf-menu' ),
				mLink = $( "a[href*='#'], a[href*='$']" ).not( '.wc-tabs a, .cz_edit_popup_link, .page-numbers a' ),
				sticky = $( '.header_is_sticky:not(.smart_sticky)' ).outerHeight() + abar, 
				sticky = sticky ? sticky + abar : '', t, offset;
			if ( mLink.length ) {
				mLink.off( 'click.cz_manchor' ).on( 'click.cz_manchor', function(e) {
					if ( location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname ) {
						t = $( this.hash );
						if ( t.length ) {
							offset = offset = t.offset().top;
							$( 'html, body' ).animate({ scrollTop: offset - sticky }, 1000, function() {
								sticky = $( '.onSticky:not(.smart_sticky)' ).outerHeight(),
								sticky = sticky ? sticky + abar : '';
								$( 'html, body' ).animate({ scrollTop: offset - sticky }, 250 );
							});
						}
					} else {
						location = $( this ).attr( 'href' );
					}
					e.preventDefault();
				});

				var mPageH = mPage.outerHeight() + 15,
					mItems = mPage.find( "a[href*='#']" ),
					sItems = mItems.map(function(){
						var item = $( $( this ).attr( "href" ).replace( /^.*\#(.*)$/, "#$1" ) );
						if ( item.length ) { return item; }
					});

				wind.on( 'scroll', debounce(function() {
					var ft = $( this ).scrollTop() + mPageH + sticky,
						cur = sItems.map(function() {
							if ( $(this).offset().top < ft )
								return this;
							});

					cur = cur[cur.length-1];
					var id = cur && cur.length ? cur[0].id : "";
					if ( id && !$( '#' + id + '.cz_popup_modal' ).length && $( '#' + id ).length ) {
						body.trigger( 'click' );
						mItems.parent().removeClass( "current_menu" ).end().filter( "[href='#" + id + "']" ).parent().addClass( "current_menu" );
					} else {
						mItems.parent().removeClass( "current_menu" );
					}
				}, 100 ));
			}
		},

		/*
		*   Fix menus lenght related to parent width
		*/
		fixMenusWidthBreaks: function() {
			wind.off( 'resize.cz_fix_menu_width' ).on( 'resize.cz_fix_menu_width', debounce(function() {
				$( '.cz_menu_default' ).not( '#menu_header_4, #menu_fixed_side_1, footer .sf-menu' ).each(function() {
					var en = $( this ), parent_width, items_width = 0, need_move = 0, nw, nw_ul;

					en.append( en.find( '.cz-extra-menus > .sub-menu > li' ) ).find( '.cz-extra-menus' ).remove();

					parent_width = en.parent().parent().parent().outerWidth() - 60 - ( parseInt( en.parent().css( 'marginLeft' ) ) + parseInt( en.parent().css( 'marginRight' ) ) );

					//en.parent().parent().find( '> div' ).each(function() {
					//	var enn = $( this );
					//	if ( enn.attr( 'class' ) !== en.parent().attr( 'class' ) ) {
					//		parent_width = parent_width - enn.outerWidth() - ( parseInt( enn.parent().css( 'marginLeft' ) ) + parseInt( enn.parent().css( 'marginRight' ) ) );
					//	}
					//});

					if ( ! en.find( '.cz-extra-menus' ).length ) {
						en.append( '<li class="cz-extra-menus cz"><a href="#" class="sf-with-ul"><i class="fa fa-ellipsis-h"></i></a><ul class="sub-menu"></ul></li>');
					}

					nw = en.find( '.cz-extra-menus' ), nw_ul = nw.find( '> ul' );

					en.find( '> li' ).each(function( i ) {
						var li = $(this);
						li.data( 'w', li.outerWidth() ).data( 'i', i );
						items_width += li.hasClass( 'cz-extra-menus' ) ? 0 : li.outerWidth();
						need_move = ( items_width > parent_width ) ? 1 : 0;
					});

					if ( need_move ) {
						items_width = nw.outerWidth();
						en.find( '> li' ).not( '.cz-extra-menus' ).each(function( i ) {
							var li = $( this ), li_width = li.outerWidth();
							if ( items_width <= parent_width ) {
								items_width += li_width;
							}
							if ( items_width > parent_width ) {
								var moved = 0;
								nw_ul.find( '> li' ).each(function() {
									if ( ! moved && Number( $( this ).data( 'i' ) ) > i ) {
										li.data( 'w', li_width ).insertBefore( $( this ) );
										moved = true;
									}
								});

								if ( ! moved ) {
									li.data( 'w', li_width ).appendTo( nw_ul );
								}
							}
						});
						nw.show();
						
					} else {
						var items = nw_ul.find( '> li' ), ii = 0, need_move = true;

						items.each(function() {
							if ( ! need_move ) {
								return;
							}
							if ( items.length - ii == 1 ) {
								items_width -= nw.outerWidth();
							}
							items_width += parseFloat( $( this ).data( 'w' ) );
							if ( items_width < parent_width ) {
								$( this ).insertBefore( nw );
								ii++;
							} else {
								need_move = 0;
							}
						});
						if ( items.length - ii == 0 ) {
							nw.hide();
						}
					}
				});
			}, 50 ));
		},

		/*
		*   Height changed = run callback
		*/
		heightChanged: function( elm, callback ) {
			var elm = ( typeof elm == 'string' ) ? $( elm ) : elm,
				lastHeight = elm.outerHeight(), newHeight;

			// First
			callback();

			// Height detection
			(function run() {
				newHeight = elm.outerHeight();
				if ( lastHeight != newHeight ) {
					callback();
					lastHeight = newHeight;
				}

				if ( elm.onElementHeightChangeTimer ) {
					clearTimeout( elm.onElementHeightChangeTimer );
				}

				elm.onElementHeightChangeTimer = setTimeout( run, 300 );
			})();
		},

		/*
		*   lightGallery
		*/
		lightGallery: function() {
			'use strict';

			var a = '.cz_lightbox:not(.cz_no_lighbox),.cz_a_lightbox:not(.cz_no_lighbox) a,a[href*="youtube.com/watch?"],a[href*="youtu.be/"],a[href*="vimeo.com/"],a[href$=".jpg"]:not(.esgbox,.jg-entry),a[href$=".jpeg"]:not(.esgbox,.jg-entry),a[href$=".png"]:not(.esgbox,.jg-entry),a[href$=".gif"]:not(.esgbox,.jg-entry)',
			    b = $( 'body' ),
			    d = b.data( 'lightGallery' );
			if ( d ) {
			    d.destroy( true );
			}
			if ( $.fn.lightGallery ) {
				b.attr( 'data-lightGallery', 1 ).lightGallery({selector: a});
			}
		},

		/*
		*   Woo Quantity
		*/
		woo_quantity: function() {
			if ( $( '.quantity' ).length ) {
				if ( ! $( '.quantity-nav' ).length ) {
					$('<div class="quantity-nav"><div class="quantity-button quantity-up">+</div><div class="quantity-button quantity-down">-</div></div>').insertAfter( '.quantity input' );
				}
				$( '.quantity' ).czOnce( 'quantity', function() {
					var spinner = $(this),
						input = spinner.find('input[type="number"]'),
						btnUp = spinner.find('.quantity-up'),
						btnDown = spinner.find('.quantity-down'),
						min = input.attr('min') || 1,
						max = input.attr('max') || 999;

					$( '.quantity-nav' ).css( 'color', input.css( 'color' ) );

					btnUp.on( 'click', function() {
						var oldValue = parseFloat(input.val());
						if (oldValue >= max) {
							var newVal = oldValue;
						} else {
							var newVal = oldValue + 1;
						}
						spinner.find("input").val( newVal ).trigger("change");
					});

					btnDown.on( 'click', function() {
						var oldValue = parseFloat(input.val());
						if (oldValue <= min) {
							var newVal = oldValue;
						} else {
							var newVal = oldValue - 1;
						}
						spinner.find( "input" ).val( newVal ).trigger( "change" );
					});
				});
			}
		},

		/*
		*   Ajax Search
		*/
		search: function() {
			var time = false;

			// Input changes
			if ( $( '.cz_ajax_search' ).length ) {
				$( '.cz_ajax_search' ).on('keyup', '[name="s"]', function() {
					clearTimeout( time );
					var form    = $( this ).parent(),
						results = form.next( '.ajax_search_results' ),
						icon 	= $( 'button i', form ).attr('class'),
						ajax 	= $( '#intro' ).data( 'ajax' ),
						sIcon 	= 'fa-search',
						sLoad 	= 'fa-superpowers fa-pulse';

					if ( $( this ).val().length < 3 ) {
						$( '.ajax_search_results' ).slideUp();
						$( 'button i', form ).addClass( sIcon ).removeClass( sLoad );
						return;
					}
					$( 'button i', form ).removeClass( sIcon ).addClass( sLoad );

					// Send request
					time = setTimeout(
						function() {
							$.ajax({
								type: "GET",
								url: ajax,
								data: "action=codevz_ajax_search&" + form.serialize(),
								success: function( data ) {
									results.html( data ).slideDown();
									$( 'button i', form ).removeClass( sLoad ).addClass( sIcon );
								},
								error: function( xhr, status, error ) {
									results.html( '<b class="ajax_search_error">' + error + '</b>' ).slideDown();
									$( 'button i', form ).removeClass( sLoad ).addClass( sIcon );
									console.log( xhr, status, error );
								}
							});
						},
						500
					);
				});
			}

			// Search icon
			$( '.search_with_icon' ).czOnce( 'search_wi', function() {
				$( this ).on( 'click', function(e) {
					e.stopPropagation();
				}).on( 'click', '[name="s"]', function() {
					if ( $( this ).val() ) {
						$( '.ajax_search_results' ).slideDown();
					}
				});
			});

			// Search dropdown and shop quick cart
			$( '.search_style_icon_dropdown, .elms_shop_cart' ).czOnce( 'dr_search_cart', function() {
				var en = $( this );

				if ( ( wind.width() / 2 ) > ( en.offset().left + 300 ) ) {
					en.addClass( 'inview_right' );
				}
			});

			// Search dropdown and full row
			$( '.search_style_icon_dropdown > i, .search_style_icon_fullrow > i' ).czOnce( 'sdr_fullwor', function() {
				$( this ).on( 'click', function() {
					var dis     = $( this ),
						outer   = dis.parent().find('.outer_search'),
						fullrow = dis.parent().hasClass( 'search_style_icon_fullrow' ),
						row_h   = dis.closest('.row').height(),
						clr     = dis.closest('.clr');

					if ( outer.is( ':visible' ) ) {
						if ( fullrow ) {
							dis.fadeIn( 'fast' );
							clr.find('> div').children().animate({opacity: 1});
						}
						outer.fadeOut( 'fast' );
					} else {
						if ( fullrow ) {
							outer.css({
								'top': clr.offset().top,
								'left': clr.offset().left,
								'width': clr.width(),
								'height': row_h
							});
							clr.css('height', row_h);
							clr.find('> div').css( 'z-index', 'initial' );
							dis.fadeOut( 'fast' );
							clr.find('> div').children().not('.search_header_1, .search_header_2, .search_header_3, .search_header_4, .search_header_5').animate({opacity: 0});
						}
						outer.fadeIn( 'fast' ).find('input').focus();
					}
				});
			});

			// Search fullscreen
			$( '.search_style_icon_full > i' ).czOnce( 'ssifi', function() {
				$( this ).on( 'click', function() {
					$( this ).closest( '.header_1,.header_2,.header_3' ).css( 'z-index', '9999' );
					$( this ).parent().find( '.outer_search' ).fadeIn( 'fast' ).find('input').focus();
					wind.off( 'resize.cz_search_full' ).on( 'resize.cz_search_full', debounce(function() {
						var w = wind.width(),
							h = wind.height(),
							s = $( this ).find('.outer_search .search');
						s.css({
							'top': h / 4 - s.height() / 2,
							'left': w / 2 - s.width() / 2
						});
					}, 100 ));
				});
			});

			$( 'body, .outer_search' ).on( 'click', function(e) {
				if ( $( e.target ).closest('.outer_search .search').length || $( e.target ).closest('.search_style_icon_fullrow').length ) {
					return;
				}

				$('.ajax_search_results').fadeOut( 'fast' );
				$( '.search_style_icon_dropdown, .search_style_icon_fullrow, .search_style_icon_full' ).find('.outer_search').fadeOut( 'fast' );

				if ( $( '.search_style_icon_fullrow' ).length ) {
					$( '.search_style_icon_fullrow > i' ).fadeIn( 'fast' );
					$( '.search_style_icon_fullrow > i' ).closest('.clr').find('> div').children().animate({opacity: 1});
				}
			});

		},

		/*
		*   Loading
		*/
		loading: function() {
			var p = $( '.pageloader' );

			if ( p.length ) {
				wind.on( 'load', function() {
					p.fadeOut( 'fast', 'linear' );
				});

				if ( p.data( 'time' ) ) {
					setTimeout( function(){
						p.fadeOut( 'fast', 'linear' );
					}, p.data( 'time' ) );
				}

				// Loader on links
				if ( p.data( 'out' ) ) {
					$('a[href*="//"]').not( '.add_to_cart_button,.cart_list .remove,a[target="_blank"],[href^="#"],[href*="wp-login"],[id^="wpadminb"] a,[href*="wp-admin"],[data-rel^="prettyPhoto"],a[href$=".jpg"],a[href$=".jpeg"],a[href$=".png"],a[href$=".gif"],a[href$=".mp3"],a[href$=".zip"],a[href$=".rar"],a[href$=".mov"],a[href$=".mp4"],a[href$=".pdf"],a[href$=".mpeg"],.comment-reply-link' ).on( 'click', function() {
						$( '.pageloader' ).fadeIn( 'fast' );
					});
				}
			}
		},

		/*
		*   offCanvas area
		*/
		offCanvas: function( selector, click ) {
			var parent  = selector.parent(),
				area    = selector.next(),
				layout  = $('#layout'),
				overlay = '.cz_overlay',
				isRight, i;

			if ( area.length ) {
				var area = area.clone(),
					isRight = area.hasClass( 'inview_right' ),
					new_class = area.hasClass('sf-menu') ? 'sf-menu offcanvas_area' : 'offcanvas_area offcanvas_original';

				body.prepend( area.removeClass().addClass( 'sidebar_offcanvas_area' ).addClass( new_class + ( isRight ? ' inview_right' : ' inview_left' ) ) );
				var area_w = area.width() + 80;

				$( '.sub-menu', area ).hide();
			} else {
				return;
			}

			selector.on( 'click', function(e) {
				if ( area.hasClass( 'active_offcanvas' ) ) {
					body.trigger( 'click' );
				} else {
					body.addClass( 'active_offcanvas' + ( isRight ? '' : ' cz_offcanvas_left' ) );
					area.addClass( 'active_offcanvas' );
					$( overlay ).fadeIn();
					e.stopPropagation();
				}
			});

			if ( click ) {
				selector.trigger( 'click' );
			}

			area.on( 'click', function(e) {
				e.stopPropagation();
			});

			// reCall anchors
			this.menu_anchor();

			body.on( 'click', function(e) {
				if ( $( '.active_offcanvas' ).length && e.target.className.indexOf( 'fa' ) !== 0 ) {
					body.removeClass( 'active_offcanvas' );
					area.removeClass( 'active_offcanvas' );
					
					$( overlay ).fadeOut();
					setTimeout(function() {
						wind.trigger( 'resize' );
					}, 1000 );
				}
			});

			// reload codevzplus script
			if ( typeof cz_scripts.cp && ! area.hasClass( 'cz_plus_done' ) ) {
				i = document.createElement("script");
				i.type = "text/javascript";
				i.src = cz_scripts.cp;
				document.getElementsByTagName("body")[0].appendChild(i);
				area.addClass( 'cz_plus_done' );
			}
		},

		/*
		*   Check if element is inview on scrolling
		*/
		inView: function(e) {
			return ( wind.scrollTop() + wind.height() ) >= e.offset().top - 100;
		},

		/*
		*   Show one by one with delay
		*/
		showOneByOne: function( e, s, d ) {
			var e = ( d == 'left' ) ? $( e.get().reverse() ) : e,
				b = ( d == 'left' ) ? {opacity:0,right:10} : {opacity: 0,right:-10};

			e.css( b ).each(function( i ) {
				$( this ).delay( s * i ).animate({opacity:1,right:0});
			});
		},

		/*
		*   Header shape size
		*/
		header_shape: function() {
			$( 'div[class*="cz_row_shape_"]' ).czOnce( 'row_shape', function() {
				var en = $( this ), cls, css, hei;
				Codevz.heightChanged( en, function() {
					cls = en.attr( 'class' ) || 'cz_no_class',
					cls = '.' + cls.replace(/  /g, '.').replace(/ /g, '.'),
					hei = en.height();

					if ( ! $( '> style', en ).length ) {
						en.append('<style></style>');
					}
					$( '> style', en ).html( cls + ' .row:before,' + cls + ' .row:after{width:' + hei + 'px}.elms_row ' + cls + ':before, .elms_row ' + cls + ':after{width:' + hei + 'px}' );
				});
			});
		},

		/*
		*   Extra panel
		*/
		extra_panel: function() {
			var h_top_bar = $( '.hidden_top_bar' ),
				c_overlay = '.cz_overlay';

			if ( h_top_bar.length ) {
				h_top_bar.on( 'click', function(e) {
					e.stopPropagation();
				});
				$( '> i', h_top_bar ).on( 'click', function (e) {
					$( c_overlay ).fadeToggle( 'fast' );
					$( this ).toggleClass( 'fa-angle-down fa-angle-up' );
					h_top_bar.toggleClass( 'show_hidden_top_bar' );
				});
				body.on( 'click', function (e) {
					if ( $( '.show_hidden_top_bar' ).length ) {
						$( '> i', h_top_bar ).addClass( 'fa-angle-down' ).removeClass( 'fa-angle-up' );
						h_top_bar.removeClass( 'show_hidden_top_bar' );
						$( c_overlay ).fadeOut( 'fast' );
					}
				});
			}
		},

	};
})(jQuery);

jQuery(document).ready(function($) {
	Codevz.init();
});