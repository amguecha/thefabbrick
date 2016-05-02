/**
* TheFabbrick keyboard navigation script
*
*/


jQuery(function () {
  'use strict';

  // Keyboard navigation on full nav menu
  jQuery('.menu-item-has-children a').focus(function () {
    jQuery(this).siblings('.sub-menu').addClass('focused');
  }).blur(function () {
    jQuery(this).siblings('.sub-menu').removeClass('focused');
  });
  jQuery('.sub-menu a').focus(function () {
    jQuery(this).parents('.sub-menu').addClass('focused');
  }).blur(function () {
    jQuery(this).parents('.sub-menu').removeClass('focused');
  });

  // Keyboard navigation on button nav menu
  jQuery('#label-menu').keypress(function (event) {
    if (event.which === 13) {
      jQuery('#button-menu').is(':checked') ?
          jQuery('#button-menu').prop('checked', false) :
          jQuery('#button-menu').prop('checked', true);
    }
    jQuery('.nav-menu-container a').last().blur(function() {
    jQuery('#button-menu').prop('checked', false);
    });
  });
});