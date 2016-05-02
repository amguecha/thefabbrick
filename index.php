<?php
/**
 * The main template file
 *
 */
?>
<?php get_header(); ?>
<div class="content-wrapper <?php if ( ! is_active_sidebar( 'sidebar' ) ) : echo 'no-widgets'; endif; ?>">
   <div id="content" class="site-content">
      <div id="primary" class="content-area">
         <main id="main" class="site-main" role="main">
         <?php if ( have_posts() ) { ?>
            <?php if ( is_home() && ! is_front_page() ) { ?>
               <!-- Front page header, in case it is set -->
               <header class="page-header screen-reader-text">
                  <h1 class="page-title"><?php single_post_title(); ?></h1>
               </header>
            <?php } ?>
            <?php while ( have_posts() ) : the_post(); ?>

               <!-- Index loop -->
               <article id="post-<?php the_ID(); ?>" <?php post_class(); ?> >
                  <header class="entry-header">
                     <?php thefabbrick_post_date(); ?>
                     <?php if ( is_single() ) {
                        the_title( '<h1 class="entry-title">', '</h1>' );
                     } else {
                        the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' );
                     } ?>
                  </header>
                  <?php if ( has_post_thumbnail() ): if ( ! get_post_format() ) : the_post_thumbnail(); endif; endif; ?>
                  <div class="entry-content">
                     <!-- Index content -->
                     <?php $readmorelink = __( 'Read more &hellip;', 'thefabbrick' ); ?>
                     <?php if ( get_post_format() ) { the_content( $readmorelink ); ?>
                        <?php wp_link_pages( array(
                           'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'thefabbrick' ) . '</span>',
                           'after'       => '</div>',
                           'link_before' => '<span>',
                           'link_after'  => '</span>',
                           'pagelink'    => '<span class="screen-reader-text">' . __( 'Page', 'thefabbrick' ) . '</span>%',
                         ) ); ?>
                     <?php } else { the_excerpt(); thefabbrick_readmore_button(); } ?>
                     <!-- End index content -->
                  </div>
                  <footer class="entry-footer" >
                     <!-- Index meta post information -->
                     <?php thefabbrick_entry_meta(); ?>
                     <?php edit_post_link( __( 'Edit', 'thefabbrick' ), '<span class="edit-link">', '</span>' ); ?>
                  </footer>
               </article>
               <!-- End loop -->

            <?php endwhile; ?>
            <!-- Index page pagination -->
            <?php the_posts_pagination( array(
               'prev_text'               => __( 'Previous page', 'thefabbrick' ),
               'next_text'               => __( 'Next page', 'thefabbrick' ),
               'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'thefabbrick' ) . ' </span>',
            ) );
         } else { ?>
            <!-- If nothing found -->
            <section class="no-results not-found">
               <header class="page-header">
                   <!-- Content none header -->
                   <h1 class="page-title"><?php _e( 'Nothing Found', 'thefabbrick' ); ?></h1>
               </header>
               <div class="page-content">
                  <!-- Content none message -->
                  <?php if ( is_search() ) { ?>
                     <p><?php _e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'thefabbrick' ); ?></p>
                  <?php get_search_form();
                  } else { ?>
                     <p><?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'thefabbrick' ); ?></p>
                  <?php get_search_form(); } ?>
               </div>
            </section>
         <?php } ?>
         </main>
      </div>
   </div>
   <div id="widgets-container" class="site-widgets-container">
      <?php get_sidebar(); ?>
   </div>
</div>
<?php get_footer(); ?>