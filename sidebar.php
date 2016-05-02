<?php
/**
 * The part for displaying the Widgets area.
 *
 */
?>
<?php if ( is_active_sidebar( 'sidebar' ) ) { ?>
   <div id="widget-area" class="widget-area" role="complementary">
      <?php dynamic_sidebar( 'sidebar' ); ?>
   </div>
<?php } ?>