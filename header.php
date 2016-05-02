<?php
/**
 * The part for displaying the header
 *
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js transition">
   <head>
      <meta charset="<?php bloginfo( 'charset' ); ?>">
      <meta name="viewport" content="width=device-width">
      <link rel="profile" href="http://gmpg.org/xfn/11">
      <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
      <!--[if lt IE 9]>
        <script src="<?php echo esc_url( get_template_directory_uri() ); ?>/inc/html5shiv.js"></script>
      <![endif]-->
      <?php wp_head(); ?>
   </head>
   <body <?php body_class(); ?> >
      <div id="page" class="hfeed site">
      <a class="skip-link screen-reader-text" href="#content"><?php esc_attr_e( 'Skip to content', 'thefabbrick' ); ?></a>
         <header id="masthead" class="site-header" role="banner">
         <?php $header_text_color = get_header_textcolor(); $description = get_bloginfo( 'description', 'display' ); ?>
            <!-- Header -->
            <div class="site-branding-wrapper" <?php if ( get_header_image() ) : ?>style="background-image: url( '<?php echo( get_header_image() ); ?>' ) !important;"<?php endif; ?> >
               <?php if ( display_header_text() ) { ?>
                  <div class="site-branding" >
                     <!-- Site title -->
                     <?php if ( is_front_page() && is_home() ) { ?>
                        <h1 class="site-title">
                           <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" <?php if ( $header_text_color ) { ?>style="color: <?php echo '#' . $header_text_color; ?> !important;"<?php } ?> ><?php bloginfo( 'name' ); ?></a>
                        </h1>
                     <?php } else { ?>
                        <p class="site-title">
                           <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" <?php if ( $header_text_color ) { ?>style="color: <?php echo '#' . $header_text_color; ?> !important;"<?php } ?> ><?php bloginfo( 'name' ); ?></a>
                        </p>
                     <?php }
                     // Site description
                     if ( $description || is_customize_preview() ) { ?>
                        <p class="site-description" <?php if ( $header_text_color ) { ?>style="color: <?php echo '#' . $header_text_color; ?> !important;"<?php } ?> ><?php echo $description; ?></p>
                     <?php } ?>
                     <?php $extra_color = 'color: #' . get_header_textcolor() . ' !important;'; if ( has_nav_menu( 'social' ) ) { ?>
                        <nav id="social-navigation" class="social-navigation <?php thefabbrick_adaptative_socialnav(); // Adds extra space when a header image is set ?>" role="navigation" aria-label="<?php esc_attr_e( 'Social navigation', 'thefabbrick' ); ?>" 
                           <?php if ( get_header_textcolor() ) : echo "style='" .  $extra_color . "'"; endif; // Sets Social Links Menu with the user's custom color ?> >
                           <!-- Social icons menu -->
                           <?php wp_nav_menu( array(
                              'container_class' => 'social-menu-container',
                              'theme_location'  => 'social',
                              'depth'           => 1,
                           ) ); ?>
                        </nav>
                     <?php } ?>
                  </div>      
               <?php } else { ?>
                  <div class="site-branding-no-text">
                     <!-- Site without title -->
                     <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" <?php if ( $header_text_color ) { ?>style="color: <?php echo '#' . $header_text_color; ?> !important;"<?php } ?> ></a>
                  </div>
                     <?php $extra_color = 'color: #' . get_header_textcolor() . ' !important;'; if ( has_nav_menu( 'social' ) ) { ?>
                     <nav id="social-navigation" class="social-navigation <?php thefabbrick_adaptative_socialnav(); // Adds extra space when a header image is set ?>" role="navigation" aria-label="<?php esc_attr_e( 'Social navigation', 'thefabbrick' ); ?>" 
                        <?php if ( get_header_textcolor() ) : echo "style='" .  $extra_color . "'"; endif; // Sets Social Links Menu with the user's custom color ?> >
                        <!-- Social icons menu -->
                        <?php wp_nav_menu( array(
                           'container_class' => 'social-menu-container',
                           'theme_location'  => 'social',
                           'depth'           => 1,
                        ) ); ?>
                     </nav>
                  <?php } ?>
               <?php } ?>
               <?php if ( has_nav_menu( 'primary' ) ) { // Main navigation menu ?>
                  <nav id="site-navigation" class="main-navigation" <?php if ( get_header_image() ) : echo "style='background-color: rgba(255,255,255,.4) !important;'"; endif; // Adds background color if header image is set ?> role="navigation" aria-label="<?php esc_attr_e( 'Main navigation', 'thefabbrick' ); ?>" >
                     <!-- Button (input + label) for small screens -->
                     <input id="button-menu" type="checkbox" ></input>
                     <label id="label-menu" tabindex="0" class="genericon genericon-menu" for="button-menu" ><span class="screen-reader-text"><?php echo __( 'Press enter to open/close the navigation menu', 'thefabbrick') ?></span></label>
                     <!-- Navigation menu -->
                     <?php wp_nav_menu( array(
                        'container_class' => 'nav-menu-container',
                        'theme_location'  => 'primary',
                     ) ); ?>
                  </nav>
               <?php } ?>
            </div>
         </header>