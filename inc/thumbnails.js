/**
* jQuery script that hides post's Featured Images options in editor when formats are active
*
*/


jQuery(document).ready(function () { 
  
  // Live behavior
  "use strict";
  jQuery('input[value="0"]').click(function () {
    jQuery('label[for="postimagediv-hide"]').show();
    jQuery('input[id="postimagediv-hide"]').is(':checked') ?
        jQuery('div[id="postimagediv"]').show() :
        jQuery('div[id="postimagediv"]').hide();
  });
  jQuery('input[value="aside"], input[value="image"], input[value="video"], input[value="quote"], input[value="link"], input[value="gallery"], input[value="status"], input[value="audio"], input[value="chat"]').click(function () {
    jQuery('div[id="postimagediv"]').hide();
    jQuery('label[for="postimagediv-hide"]').hide();
  });
});
jQuery(document).ready(function () {
  
  // After saving behavior
  "use strict";
  jQuery('input[value="0"]').is(':checked') && jQuery('input[id="postimagediv-hide"]').is(':checked') ?
      jQuery('div[id="postimagediv"]').show() :
      jQuery('div[id="postimagediv"]').hide();
  jQuery('input[value="0"]').is(':checked') ?
      jQuery('label[for="postimagediv-hide"]').show() :
      jQuery('label[for="postimagediv-hide"]').hide();
});