jQuery.fn.topLink = function (settings) {
     settings = jQuery.extend({
         min: 1,
         fadeSpeed: 200,
         ieOffset: 50
     }, settings);
     return this.each(function () {
         //listen for scroll
         var el = jQuery(this);
         el.css('display', 'none'); //in case the user forgot
         jQuery(window).scroll(function () {
             if (!jQuery.support.hrefNormalized) {
                 el.css({
                     //'position': 'absolute',
                     //'top': jQuery(window).scrollTop() + jQuery(window).height() - settings.ieOffset
                 });
             }
             if (jQuery(window).scrollTop() >= settings.min) {
                 el.fadeIn(settings.fadeSpeed);
             } else {
                el.fadeOut(settings.fadeSpeed);
             }
         });
     });
 };
 
 jQuery(document).ready(function () {
     jQuery("footer").append('<a href="#skip" title="Top of page" id="auto-top-link"><span class="dashicons dashicons-arrow-up"><span><p>Top of Page</p></span></span></a>');
     jQuery('#auto-top-link').topLink({
         min: 400,
         fadeSpeed: 500
     });
 
     //smoothscroll
     jQuery('#auto-top-link').click(function (e) {
         e.preventDefault();
         jQuery('html,body').animate({scrollTop:0},400);
     });
 });