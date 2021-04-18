<?php
/**
 * Extra functions for this theme.
 *
 * @package Egesto Lite
 */

/**
 * Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
 *
 * @param array $args Configuration arguments.
 * @return array
 */
function egesto_page_menu_args( $args ) {
	if ( ! isset( $args['show_home'] ) )
		$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'egesto_page_menu_args' );

/**
* Defines new blog excerpt length and link text.
*/
function egesto_new_excerpt_length($length) {
	return 50;
}
add_filter('excerpt_length', 'egesto_new_excerpt_length');

add_filter( 'the_excerpt', 'egesto_read_more_custom_excerpt' );
function egesto_read_more_custom_excerpt( $text ) {
   if ( strpos( $text, '[&hellip;]') ) {
      $excerpt = str_replace( '[&hellip;]', '<a class="more-link" href="' . get_permalink() . '">'. __('Read More', 'egesto-lite') .' <span>&#8594;</span></a>', $text );
   } else {
      $excerpt = $text . '<a class="more-link" href="' . get_permalink() . '">'. __('Read More', 'egesto-lite') .' <span>&#8594;</span></a>';
   }
   return $excerpt;
}


/**
* Adds excerpt support for pages.
*/
add_post_type_support( 'page', 'excerpt');


/**
* Manages display of archive titles.
*/
function egesto_get_the_archive_title( $title ) {
   if ( is_category() ) {
        $title = single_cat_title( '', false );
    } elseif ( is_tag() ) {
        $title = single_tag_title( '', false );
    } elseif ( is_author() ) {
        $title = '<span class="vcard">' . get_the_author() . '</span>';
    } elseif ( is_year() ) {
        $title = get_the_date( _x( 'Y', 'yearly archives date format','egesto-lite' ) );
    } elseif ( is_month() ) {
        $title = get_the_date( _x( 'F Y', 'monthly archives date format','egesto-lite' ) );
    } elseif ( is_day() ) {
        $title = get_the_date( _x( 'F j, Y', 'daily archives date format','egesto-lite' ) );
    } elseif ( is_post_type_archive() ) {
        $title = post_type_archive_title( '', false );
    } elseif ( is_tax() ) {
        $title = single_term_title( '', false );
    } else {
        $title = esc_html__( 'Archives', 'egesto-lite' );
    }
    return $title;
};
add_filter( 'get_the_archive_title', 'egesto_get_the_archive_title', 10, 1 );

// display custom admin notice
function egesto_admin_notice__success() {
    ?>
    <div class="notice notice-success is-dismissible">
        <p><?php esc_html_e( 'Thanks for installing Egesto Lite! Want more features?','egesto-lite'); ?> <a href="https://www.vivathemes.com/wordpress-theme/egesto/" target="blank"><?php esc_html_e( 'Check out the Pro Version  &#8594;','egesto-lite'); ?></a></p>
    </div>
    <?php
}
add_action( 'admin_notices', 'egesto_admin_notice__success' );