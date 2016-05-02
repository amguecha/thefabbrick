<?php
/**
 * TheFabbrick functions and definitions
 * Set up the theme and provides some helper functions, which are used in the theme
 * TheFabbrick only works in WordPress 4.1 or later.
 *
 */


 /**
 * TABLE OF CONTENTS:
 *
 * 01 - THEME SETUP
 *
 * 02 - CONTENT WIDTH
 *
 * 03 - JAVASCRIPT DETECTION
 *
 * 04 - BLOG ENTRIES META INFORMATION
 *
 * 05 - THEFABBRICK POST DATE
 *
 * 06 - READ MORE BUTTON
 *
 * 07 - COMMENT NAVIGATION NEXT/PREVIOUS
 *
 * 08 - REGISTERED WIDGET AREAS
 *
 * 09 - REGISTERED MENU LOCATIONS
 *
 * 10 - ENQUEUE SCRIPTS AND STYLES
 *
 * 11 - VIDEO WRAPPER
 *
 * 12 - RELATED POSTS NAVIGATION
 *
 * 13 - POST FORMATS THUMBNAILS
 *
 * 14 - ADAPTATIVE SOCIAL NAVIGATION
 *
 */



/**
 * 01 - THEME SETUP
 * Sets up theme defaults and registers support for various WordPress features
 */
if ( ! function_exists( 'thefabbrick_setup' ) ) {
    function thefabbrick_setup() {
        
        load_theme_textdomain( 'thefabbrick', get_template_directory() . '/languages' ); // Make theme available for translation
        
        add_theme_support( 'automatic-feed-links' ); // Add default posts and comments RSS feed links to head
        
        add_theme_support( 'title-tag' ); // Let WordPress manage the document title

        add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption' ) ); // Switch default core markup for search form, comment form, and comments to output valid HTML5

        add_theme_support( 'post-formats', array( 'aside', 'image', 'video', 'quote', 'link', 'gallery', 'status', 'audio', 'chat' ) ); // Enable support for Post Formats

        add_theme_support( 'custom-background', array( // Adds a customizer section to change the site's background
            'default-image' => get_stylesheet_directory_uri() . '/inc/default-bg.png',
        ) );

        add_theme_support( 'post-thumbnails' ); // Enable support for Post Thumbnails on posts and pages
        set_post_thumbnail_size( 625, 400, true );

        $header_background_image_defaults = array( // Activates WordPress title text color and header background image functionalities
            'flex-width'    => true,
            'flex-height'    => true,
            'width'         => 1366,
            'height'        => 384,
        );
        add_theme_support( 'custom-header', $header_background_image_defaults  );

        if ( current_user_can( 'edit_posts' ) ) {
        add_editor_style( '/inc/editor-style.css' ); // Editor Styles
        }

    }
    add_action( 'after_setup_theme', 'thefabbrick_setup' );
}



/**
 * 02 - CONTENT WIDTH
 * Set the content width based on the theme's design and style-sheet
 */
if ( ! isset( $content_width ) ) {
    $content_width = 560;
}



/**
 * 03 - JAVASCRIPT DETECTION
 * Adds a .js class to the root <html> element when JavaScript is detected
 */
if ( ! function_exists( 'thefabbrick_javascript_detection' ) ) {
    function thefabbrick_javascript_detection() {
        echo "<script>(function(html){html.className = html.className.replace(/\bno-js\b/,'js')})(document.documentElement);</script>\n";
    }
    add_action( 'wp_head', 'thefabbrick_javascript_detection', 0 );
}



/**
 * 04 - BLOG ENTRIES META INFORMATION
 * Prints HTML with META information about post's categories, tags, author, formats.. etc
 */
if ( ! function_exists( 'thefabbrick_entry_meta' ) ) {
    function thefabbrick_entry_meta() {

        // Sticky posts meta-data
        if ( is_sticky() ) { 
            printf( '<span class="sticky-post">%s </span>', __( 'Featured', 'thefabbrick' ) );
        }

        // Formats meta-data
        $format = get_post_format();
        if ( current_theme_supports( 'post-formats', $format ) ) {
            printf( '<span class="entry-format">%1$s <a href="%2$s">%3$s</a> </span>',
             sprintf( '%s ', _x( 'Format:', 'Used before post format.', 'thefabbrick' ) ),
             esc_url( get_post_format_link( $format ) ),
             get_post_format_string( $format )
             );
         }

        if ( 'post' == get_post_type() ) {

            // Author
            if ( ! the_author_meta() && ! is_single() ) {
                printf( '<span class="author vcard byline">%1$s <a class="url fn n" href="%2$s">%3$s</a> </span>',
                    _x( 'Author:', 'Used before post author name.', 'thefabbrick' ),
                    esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
                    get_the_author()
                );
            }
            
            // Tags
            $tags_list = get_the_tag_list( '', _x( ', ', 'Used between list items, there is a space after the comma.', 'thefabbrick' ) );
            if ( $tags_list ) {
                printf( '<span class="tags-links">%1$s %2$s </span>',
                    _x( 'Tags:', 'Used before tag names.', 'thefabbrick' ),
                    $tags_list
                );
            }

            // Categories meta-data, excluding Uncategorized
            if ( get_the_category_list() ) {

                // Detecting Uncategorized
                $has_uncat_cat = "";
                $categories_list = get_the_category_list();
                if ( strpos( $categories_list, 'Uncategorized') ) : $has_uncat_cat = true ; endif;

                // Detecting number of categories in post
                $cat_names = "";
                foreach((get_the_category()) as $category) {
                    $cat_names .= $category->cat_name . " ";
                }
                $cats_number = str_word_count( $cat_names );

                // Post's categories output
                if ( ! $has_uncat_cat || $cats_number >= 2 ) {
                    $cat_array = array();
                        foreach((get_the_category( )) as $category) {
                            if ($category->cat_name != 'Uncategorized') {
                                $cat_array[] = '<a href="' . get_category_link( $category->term_id ) . '" title="' . sprintf( __( "View all posts in %s", 'thefabbrick' ), $category->name ) . '" ' . '>' . $category->name.'</a>';
                            }
                        }
                    $cats_output_without_uncat = implode(', ', $cat_array );
                    printf( '<span class="cat-links">%1$s %2$s</span>',
                        _x( 'Categories:', 'Used before category names.', 'thefabbrick' ),
                        $cats_output_without_uncat
                    );
                }
            }        
        }

        // Retrieve attachment meta-data
        if ( is_attachment() && wp_attachment_is_image() ) {
            $metadata = wp_get_attachment_metadata();
            printf( '<span class="full-size-link">%1$s <a href="%2$s">%3$s &times; %4$s </a></span>',
                _x( 'Full size', 'Used before full size attachment link.', 'thefabbrick' ),
                esc_url( wp_get_attachment_url() ),
                $metadata['width'],
                $metadata['height']
            );
        }

        // Comments meta-data
        if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
            echo '<span class="comments-link">';
            comments_popup_link( sprintf( __( 'Leave a comment on %s', 'thefabbrick' ), get_the_title() ) );
            echo '</span>';
        }
    }
}



/**
 * 05 - THEFABBRICK POST DATE
 * Prints the date beside every post/entry title
 */
if ( ! function_exists( 'thefabbrick_post_date' ) ) {
    function thefabbrick_post_date() {

        $time_string = '<time class="entry-date published updated" datetime="%1$s"><span class="post-month">%2$s</span><span class="post-day">%3$s</span><span class="post-year">%4$s</span></time>';
        if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
            $time_string = '<time class="entry-date published" datetime="%1$s"><span class="post-month">%2$s</span><span class="post-day">%3$s</span><span class="post-year">%4$s</span></time><time class="updated" datetime="%5$s" style="display:none;">%6$s</time>';
        }

        $time_string = sprintf( $time_string,
            esc_attr( get_the_date( 'c' ) ),
            get_the_date( 'M' ),
            get_the_date( 'd' ),
            get_the_date( 'Y' ),
            esc_attr( get_the_modified_date( 'c' ) ),
            get_the_modified_date( 'c' ) 
        );

        // Print date without permalink on single and page view
        if ( is_single() || is_page() ) {
            printf( '<span class="post-date"><p>%1$s</p></span>',
                $time_string
            );

        // Print date and its permalink on the rest of templates
        } else {
            $screen_reader = '<span class="screen-reader-text">' . __( 'Entry date of ', 'thefabbrick') . get_the_title() . '. ' . '</span>';
            printf( '<span class="post-date"><a href="%1$s" rel="bookmark">%2$s %3$s</a></span>',
                esc_url( get_permalink() ),
                $screen_reader,
                $time_string
            );
        }
    }
}



/**
 * 06 - READ MORE BUTTON
 * Output a link to the full post/entry underneath excerpts
 */
if ( ! function_exists( 'thefabbrick_readmore_button' ) ) {
    function thefabbrick_readmore_button() {
        if ( ! get_post_format() ) {
            $words = count( explode(' ', get_the_excerpt() ) );
            if ( $words > 55 || strpos(get_the_content(),'more-link') ) : // Check entry length & manual <!--more--> insertions, wheter to output the button or not ?> 
                <span class="read-more-link">
                    <a href="<?php echo get_permalink(); ?>" class="ghostbutton"><?php echo __( 'Read more &hellip;', 'thefabbrick' ); ?><span class="screen-reader-text"><?php echo __( ' about ', 'thefabbrick' ) . get_the_title() . '. '; ?></span></a>
                </span>
            <?php endif;
        }
    }
}



/**
 * 07 - COMMENT NAVIGATION NEXT/PREVIOUS
 * Display navigation to next/previous comments when applicable
 */
if ( ! function_exists( 'thefabbrick_comment_nav' ) ) {
    function thefabbrick_comment_nav() {
        if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) { ?>
            <nav class="navigation comment-navigation" role="navigation">
                <div class="nav-links">
                    <?php if ( $prev_link = get_previous_comments_link( __( 'Older Comments', 'thefabbrick' ) ) ) {
                        printf( '<div class="nav-previous">%s</div>', $prev_link );
                    }
                    if ( $next_link = get_next_comments_link( __( 'Newer Comments', 'thefabbrick' ) ) ) {
                        printf( '<div class="nav-next">%s</div>', $next_link );
                    } ?>
                </div>
            </nav><?php
        }
    }
}



/**
 * 08 - REGISTERED WIDGET AREAS
 * Register the theme widget area 
 */
if ( ! function_exists( 'thefabbrick_widgets_init' ) ) {
    function thefabbrick_widgets_init() {
        register_sidebar( array(
            'name'          => __( 'Widget Area', 'thefabbrick' ),
            'id'            => 'sidebar',
            'description'   => __( 'Add widgets here for the left side vertical bar.', 'thefabbrick' ),
            'before_widget' => '<aside id="%1$s" class="widget %2$s">',
            'after_widget'  => '</aside>',
            'before_title'  => '<h2 class="widget-title">',
            'after_title'   => '</h2>',
            ) );
    }
    add_action( 'widgets_init', 'thefabbrick_widgets_init' );
}



/**
 * 09 - REGISTERED MENU LOCATIONS
 * Register the theme navigation menu locations (Main navigation bar & Social navigation)
 */
if ( ! function_exists( 'thefabbrick_reg_menu' ) ) {
    function thefabbrick_reg_menu() {
        register_nav_menus( array( 'primary' => __( 'Primary Menu', 'thefabbrick' ) ) );
        register_nav_menus( array( 'social'  => __( 'Social Links Menu', 'thefabbrick' ) ) );
    }
    add_action( 'after_setup_theme', 'thefabbrick_reg_menu' );
}



/**
 * 10 - ENQUEUE SCRIPTS AND STYLES
 */
if ( ! function_exists( 'thefabbrick_scripts' ) ) {
    function thefabbrick_scripts() {

        // Site Fonts
        wp_register_style('googleFonts', 'https://fonts.googleapis.com/css?family=Crete+Round|Ubuntu:700|Roboto+Mono|Droid+Sans:400,700' );
        wp_enqueue_style( 'googleFonts');

        // Load the main stylesheet
        wp_enqueue_style( 'thefabbrick-style', get_stylesheet_uri() );

        // Load genericons
        wp_enqueue_style( 'thefabbrick-genericons', get_template_directory_uri() . '/inc/genericons/genericons.css' );

        // Comment reply
        if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) : wp_enqueue_script( 'comment-reply' ); endif;
        
        // Load Parallax Scroll if header image is set
        if ( get_header_image() ) : wp_enqueue_script( 'thefabbrick-parallax', get_template_directory_uri() . '/inc/parallax.js', array( 'jquery') ); endif;

        // Load keyboard navigation compatibility scripts
        if ( has_nav_menu( 'primary' ) ) : wp_enqueue_script( 'thefabbrick-keyboardnav', get_template_directory_uri() . '/inc/keyboardnav.js', array( 'jquery') ); endif;
    }
    add_action( 'wp_enqueue_scripts', 'thefabbrick_scripts' );
}


/**
 * 11 - IFRAME WRAPPER
 * Wraps embeds into a div
 */
if ( ! function_exists( 'thefabbrick_embed_filter' ) ) {
    function thefabbrick_embed_filter( $html ) {
        if ( strpos( $html, 'twitter.com') ) { 
            $return = '<div class="iframe-container-tweet">'.$html.'</div>';
            return $return;
        } else {
        $return = '<div class="iframe-container">'.$html.'</div>';
        return $return;
        }
    }
    add_filter( 'embed_oembed_html', 'thefabbrick_embed_filter', 10 );
}



/**
 * 12 - SINGLE POSTS NAVIGATION
 * Related & adjacent single posts section to be displayed just below single views
 */
if ( ! function_exists( 'thefabbrick_single_posts_nav' ) ) {
    function thefabbrick_single_posts_nav() {
        
        // Related single posts section
        if ( has_tag() ) {

            // Get next post ID
            $if_next_post_exists = "";
            if ( get_next_post() ) :  $if_next_post_exists = get_next_post()->ID; endif;

            // Get previous post ID
            $if_prev_post_exists = "";
            if ( get_previous_post() ) :  $if_prev_post_exists = get_previous_post()->ID; endif;

            // Get related tag IDs
            $tags = wp_get_post_terms( get_queried_object_id(), 'post_tag', ['fields' => 'ids'] );
            $args = [
                'post__not_in'   => array( get_queried_object_id(), $if_prev_post_exists, $if_next_post_exists ), // Exclude the actuall post, as well as the previous and next post
                'posts_per_page' => 2,
                'orderby'        => 'rand',
                'tax_query'      => [ [ 'taxonomy' => 'post_tag', 'terms'    => $tags ] ]
                ];

            // Querying $args and output related posts
            $my_query = new wp_query( $args );
            if( $my_query->have_posts() ) { ?>
                <div class="navigation post-navigation" >
                    <h2 class="screen-reader-text"><?php echo __( 'Related posts: ', 'thefabbrick' ); ?></h2>
                    <div class="nav-links">

                    <?php while( $my_query->have_posts() ) { 

                        $my_query->the_post();
                        $tag = get_the_tags();

                        // Get the first tag only
                        if ( $tag ) : $tag = $tag[0]; endif;
                            // Prints the link ?>
                            <div class="nav-related">
                                <a href="<?php the_permalink(); ?>" rel="tag" >
                                    <span class="related-label-post"><?php echo 'TAG: ' . $tag->name . ' '; ?></span>
                                    <span class="post-title"><?php the_title(); ?></span>
                                </a>
                            </div>

                    <?php } wp_reset_postdata();

                echo '</div></div>';
            }
        }

        // Adjacent single posts section, in order to wrap this section all together in a unique role="navigation" section for accesibility purposes
        if ( get_previous_post() || get_next_post() ) { 
            $prev_post = get_previous_post(); 
            $next_post = get_next_post(); ?>

            <div class="navigation post-navigation" >
                <h2 class="screen-reader-text"><?php echo __( 'More posts: ', 'thefabbrick' ); ?></h2>
                <div class="nav-links">

                <?php if ( $prev_post ) { ?>
                    <div class="nav-previous">
                        <a href="<?php echo get_permalink($prev_post->ID); ?>" rel="previous" >
                        <span class="related-label-post"><?php echo __( 'Previous post: ', 'thefabbrick' ); ?></span>
                        <span class="post-title"><?php echo '&laquo; ' . $prev_post->post_title; ?></span>
                        </a>
                    </div>

                <?php } if ( $next_post ) { ?>
                    <div class="nav-next">
                        <a href="<?php echo get_permalink($next_post->ID); ?>" rel="next" >
                        <span class="related-label-post"><?php echo __( 'Next post: ', 'thefabbrick' ); ?></span>
                        <span class="post-title"><?php echo $next_post->post_title . ' &raquo;'; ?></span>
                        </a>
                    </div>

        <?php } echo '</div></div>'; }
    }
}



/*
 * 13 - POST FORMATS THUMBNAILS
 * Posts set with a Format do not display thumbnails. Simple script to hide 'Featured Image' post options in order to avoid users' confusion
 */
if ( ! function_exists( 'thefabbrick_formats_thumbail_options' ) && ! function_exists( 'thefabbrick_media_uploader_thumbnails' ) ) {
    if ( current_user_can( 'edit_posts' ) ) { // Hide featured image box for post formats
        function thefabbrick_formats_thumbail_options() {
            wp_enqueue_script( 'thefabbrick-hide-thumbnails', get_template_directory_uri() . '/inc/thumbnails.js', array( 'jquery') );
        }
        add_action('admin_footer', 'thefabbrick_formats_thumbail_options');
        function thefabbrick_media_uploader_thumbnails( $strings ) { // Hide featured image link in media library 
            unset( $strings['setFeaturedImageTitle'] );
            return $strings;
        }
        add_filter( 'media_view_strings', 'thefabbrick_media_uploader_thumbnails' );
    }
}



/**
 * 14 - ADAPTATIVE SOCIAL NAVIGATION
 * It modifies the default colour of social links if the header text colour is changed in customizer, adopting it
 */
if ( ! function_exists( 'thefabbrick_adaptative_socialnav' ) ) {
    function thefabbrick_adaptative_socialnav() {
        
        $textcolor = "";
        $less_padding = "";
            if( get_header_textcolor() ) : $textcolor = 'textcolor-on'; endif; 
            if ( ! get_header_image() && has_nav_menu( 'primary' ) ) : $less_padding = 'less-padding-on'; endif;
        
        echo $textcolor . ' ' . $less_padding;
    }
}