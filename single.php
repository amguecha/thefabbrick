<?php
/**
 * The template for displaying all single posts and attachments.
 *
 */
?>
<?php get_header(); ?>
<div class="content-wrapper <?php if ( ! is_active_sidebar( 'sidebar' ) ) : echo 'no-widgets'; endif; ?>">
   <div id="content" class="site-content">
      <div id="primary" class="content-area">
         <main id="main" class="site-main" role="main">
            
            <!-- Single loop -->
            <?php while ( have_posts() ) : the_post(); ?>
               <article id="post-<?php the_ID(); ?>" <?php post_class(); ?> >
                  <header class="entry-header">
                     <!-- Single entry header -->
                     <?php thefabbrick_post_date(); ?>
                     <?php if ( is_single() ) {
                        the_title( '<h1 class="entry-title">', '</h1>' );
                     } else {
                        the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' );
                     } ?>
                  </header>
                  <?php if ( has_post_thumbnail() ): if ( ! get_post_format() ) : the_post_thumbnail(); endif; endif; ?>
                  <div class="entry-content">
                     <!-- Single content -->
                     <?php $readmorelink = __( 'Read more &hellip;', 'thefabbrick' ); ?>
                     <?php the_content( $readmorelink ); ?>
                     <?php
                     wp_link_pages( array(
                     'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'thefabbrick' ) . '</span>',
                     'after'       => '</div>',
                     'link_before' => '<span>',
                     'link_after'  => '</span>',
                     'pagelink'    => '<span class="screen-reader-text">' . __( 'Page', 'thefabbrick' ) . '</span>%',
                     ) ); ?>
                  </div>
                  <footer class="entry-footer">
                     <!-- Single footer -->
                     <?php thefabbrick_entry_meta(); ?>
                     <?php edit_post_link( __( 'Edit', 'thefabbrick' ), '<span class="edit-link">', '</span>' ); ?>
                  </footer>
               </article>
               <!-- Author biography -->
               <?php if ( get_the_author_meta( 'description' ) ) { ?>
                  <div class="author-info">
                     <h2 class="author-heading">
                        <?php _e( 'Published by:', 'thefabbrick' ); ?>
                     </h2>
                     <div class="author-avatar the-post-author">
                        <!-- Author avatar -->
                        <?php
                        $author_bio_avatar_size = apply_filters( 'thefabbrick_author_bio_avatar_size', 48 );
                        echo get_avatar( get_the_author_meta( 'user_email' ), $author_bio_avatar_size );
                        ?>
                        <h3 class="author-title"><?php echo get_the_author(); ?></h3>
                     </div>
                     <div class="author-description">
                        <p class="author-bio">
                           <!-- The author biography description -->
                           <?php the_author_meta( 'description' ); ?>
                           <span class="author-link-wrap">
                           <!-- Link to all author's posts -->
                              <a class="author-link" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author">
                                 <?php printf( __( 'All posts by %s', 'thefabbrick' ), get_the_author() ); ?>
                              </a>
                           </span>
                        </p>
                     </div>
                  </div>
               <?php } ?>
               <!-- Related/More posts links -->
               <nav class="nav-links-wrapper" role="navigation" aria-label="<?php esc_attr_e( 'More posts navigation', 'thefabbrick' ); ?>" >
                  <?php thefabbrick_single_posts_nav(); ?>
               </nav>
               <!-- Comments part -->
               <?php if ( comments_open() || get_comments_number() ) : comments_template(); endif; ?>
               <!-- End single loop -->

            <?php endwhile; ?>
         </main>
      </div>
   </div>
   <div id="widgets-container" class="site-widgets-container">
      <?php get_sidebar(); ?>
   </div>
</div>
<?php get_footer(); ?>