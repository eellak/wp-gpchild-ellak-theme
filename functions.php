<?php

/* functions, filters and hooks for ellak.gr child theme */

add_action( 'after_setup_theme', 'ellak_theme_setup' );
function ellak_theme_setup() {
	// remove generatepress action hooks
	remove_action( 'generate_before_content',
		'generate_featured_page_header_inside_single', 10 );
	remove_action( 'generate_credits', 'generate_add_footer_info' );

	// child theme translations in /languages
	load_child_theme_textdomain( 'ellakgr', get_stylesheet_directory()
		. '/languages' );

	// hide admin bar for subscribers
	$user = wp_get_current_user();
	if( in_array( 'subscriber', $user->roles ) ) {
		show_admin_bar( false );
	}
}

// enqueue extra scripts and styles
add_action( 'wp_enqueue_scripts', 'ellak_font_awesome' );
function ellak_font_awesome() {
	// Font Awesome
	wp_enqueue_style( 'font-awesome',
		'//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css' );

	// Facebook SDK
	wp_enqueue_script( 'facebook-sdk', get_stylesheet_directory_uri() . '/js/facebook.js', array(), '2.3', true );
}

// add clearfix class in the header container
add_filter( 'generate_inside_header_class', 'ellak_inside_header_classes' );
function ellak_inside_header_classes( $classes ) {
	$classes[] = 'clearfix';
	return $classes;
}

// add greek subset in embedded fonts
add_filter( 'generate_fonts_subset', 'ellak_fonts_subset' );
function ellak_fonts_subset() {
	return 'latin,latin-ext,greek';
}

// add slider in #primary, only in home. requires 'Advanced Post Slider' plugin
add_action( 'generate_before_main_content', 'ellak_slider' );
function ellak_slider() {
	if( is_front_page() && shortcode_exists( 'advps-slideshow' ) ) {
		echo do_shortcode( '[advps-slideshow optset="1"]' );
	}
}

// social links
add_action( 'generate_before_header_content', 'ellak_social_links' );
function ellak_social_links() { ?>
	<div class="header-social-links">
		<ul class="social-links">
			<li class="social-link-facebook"><a href="https://www.facebook.com/eellak" target="_blank"><span>Facebook</span></a></li>
			<li class="social-link-twitter"><a href="https://www.twitter.com/eellak" target="_blank"><span>Twitter</span></a></li>
			<li class="social-link-github"><a href="https://github.com/eellak" target="_blank"><span>GitHub</span></a></li>
			<li class="social-link-vimeo"><a href="https://www.vimeo.com/eellak" target="_blank"><span>Vimeo</span></a></li>
			<li class="social-link-flickr"><a href="https://flickr.com/photos/eellak" target="_blank"><span>Flickr</span></a></li>
		</ul>
	</div><!-- .header-social-links -->
<?php }

// footer
add_action( 'generate_credits', 'ellak_credits' );
function ellak_credits() {
	echo __( 'Built with open source software', 'ellakgr' )
		. ' <a href="https://wordpress.org/" target="_blank">Wordpress</a> | '
		. '<a href="' . home_url( '/ori-chrisis' ) . '">'
		. __( 'Terms of use and privacy statement', 'ellakgr' ) . '</a> | '
		. __( 'Content License:', 'ellakgr' )
		. ' <a href="https://creativecommons.org/licenses/by-sa/4.0/">'
		. __( 'CC-BY-SA', 'ellakgr' ) . '</a>';
}

?>
