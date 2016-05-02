<?php
/**
 * The part for displaying comments and the comment form
 *
 */
if ( post_password_required() ) : return; endif; ?>
<div id="comments" class="comments-area">
   <?php if ( have_comments() ) { ?>
      <h2 class="comments-title">
         <!-- Comments title -->
         <?php printf( _nx( 'One thought on &ldquo;%2$s&rdquo;', '%1$s thoughts on &ldquo;%2$s&rdquo;',
         get_comments_number(), 'comments title', 'thefabbrick' ),
         number_format_i18n( get_comments_number() ), get_the_title() ); ?>
      </h2>
      <ol class="comment-list">
         <!-- Comments list -->
         <?php wp_list_comments( array(
            'style'          => 'ol',
            'short_ping'   => true,
            'avatar_size' => 48,
         ) ); ?>
         <!-- End comments list -->
      </ol>
      <?php thefabbrick_comment_nav(); ?>
   <?php } ?>
   <?php if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) { ?>
      <p class="no-comments">
         <?php _e( 'Comments are closed.', 'thefabbrick' ); ?>
      </p>
   <?php } ?>
   <!-- Comment form -->
   <?php comment_form(); ?>
</div>