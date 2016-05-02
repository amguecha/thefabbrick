/**
* Simple parallax scrolling script
*
*/


function parallax() {
  "use strict";
  var scrolled = jQuery(window).scrollTop();
  jQuery('.site-branding-wrapper').css('background-position', 'center ' + (scrolled * 0.5) + 'px');
}
jQuery(window).scroll(function () { "use strict"; parallax(); });