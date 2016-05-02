<?php
/**
 * The template for displaying pages
 *
 */
?>
<?php get_header(); ?>
<div class="content-wrapper <?php if ( ! is_active_sidebar( 'sidebar' ) ) : echo 'no-widgets'; endif; ?>">
   <div id="content" class="site-content">
      <div id="primary" class="content-area">
         <main id="main" class="site-main" role="main">
            <?php while ( have_posts() ) : the_post(); ?>

               <!-- Pages loop -->
               <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                  <header class="entry-header">
                     <!-- Page header -->
                     <?php thefabbrick_post_date(); ?>
                     <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
                  </header>
                  <?php if ( has_post_thumbnail() ): if ( ! get_post_format() ) : the_post_thumbnail(); endif; endif; ?>
                  <div class="entry-content">
                     <!-- Page content -->
                     <?php $readmorelink = __( 'Read more &hellip;', 'thefabbrick' ); ?>
                     <?php the_content( $readmorelink ); ?>
                     <?php wp_link_pages( array(
                        'before'         => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'thefabbrick' ) . '</span>',
                        'after'          => '</div>',
                        'link_before' => '<span>',
                        'link_after'   => '</span>',
                        'pagelink'      => '<span class="screen-reader-text">' . __( 'Page', 'thefabbrick' ) . '</span>%',
                     ) ); ?>
                  </div>
                  <?php edit_post_link( __( 'Edit', 'thefabbrick' ), '<footer class="entry-footer"><span class="edit-link">', '</span></footer>' ); ?>
               </article>
               <?php if ( comments_open() || get_comments_number() ) {
                  // Comments part
                  comments_template();
               } ?>
               <!-- End loop -->

            <?php endwhile; ?>
         </main>
      </div>
   </div>
   <div id="widgets-container" class="site-widgets-container">
      <?php get_sidebar(); ?>
   </div>
</div>
<?php get_footer(); ?>