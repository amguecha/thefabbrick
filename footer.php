<?php
/**
 * The part for displaying the footer
 *
 */
?>
         <div class="search-form-footer">
            <span id="search-form-container" class="search-form-container">
               <form role="search" aria-label="<?php esc_attr_e( 'Bottom search area', 'thefabbrick' ); ?>" method="get" class="search-form" action="<?php echo home_url( '/' ); ?>">
                  <!-- Search form label -->
                  <label class="search-form-label" tabindex="0">
                     <?php echo _x( "Didn't you find what you are looking for?", 'label', 'thefabbrick' ) ?>
                     <span class="screen-reader-text"><?php echo _x( "Try on the search form below", 'label', 'thefabbrick' ) ?></span>
                  </label>
                  <!-- Search form inputs -->
                  <input type="search" class="search-field" placeholder="<?php echo esc_attr_x( 'Search &hellip;', 'placeholder', 'thefabbrick' ) ?>" value="<?php echo get_search_query() ?>" name="s" title="<?php echo esc_attr_x( 'Search for:', 'label', 'thefabbrick' ) ?>" />
                  <span class="search-submit-logo genericon genericon-search"></span>
               </form>
            </span>
         </div>
         <footer id="colophon" class="site-footer" role="contentinfo">
            <div class="site-info">
               <?php do_action( 'thefabbrick_credits' ); ?>
               <!-- Site footer links -->
               <a href="<?php echo esc_url( __( 'https://wordpress.org/', 'thefabbrick' ) ); ?>"><?php printf( __( 'Proudly powered by %s', 'thefabbrick' ), 'WordPress' ); ?></a>
               <a href="<?php echo esc_url( __( 'https://github.com/amguecha/thefabbrick', 'thefabbrick' ) ); ?>"><?php printf( __( 'Designed by <i>amguechA</i>', 'thefabbrick' ) ); ?></a>
            </div>
         </footer>
      </div>
      <?php wp_footer(); ?>
   </body>
</html>