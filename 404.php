<?php
/**
 * The template for displaying 404 pages (not found)
 *
 */
?>
<?php get_header(); ?>
<div class="content-wrapper <?php if ( ! is_active_sidebar( 'sidebar' ) ) : echo 'no-widgets'; endif; ?>">
   <div id="content" class="site-content">
      <main id="main" class="site-main">
         <section class="error-404 not-found">
            <header class="page-header">
               <h1 class="page-title"><?php _e( 'Oops! That page can&rsquo;t be found.', 'thefabbrick' ); ?></h1>
            </header>
            <div class="page-content">
               <!-- 404 message and search form -->
               <p><?php _e( 'It looks like nothing was found at this location. Maybe try a search?', 'thefabbrick' ); ?></p>
               <?php get_search_form(); ?>
            </div>
         </section>
      </main>
   </div>
   <div id="widgets-container" class="site-widgets-container">
      <?php get_sidebar(); ?>
   </div>
</div>
<?php get_footer(); ?>