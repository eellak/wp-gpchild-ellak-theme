<?php

/* functions, filters and hooks for ellak.gr child theme */

// remove generatepress action hooks
add_action( 'after_setup_theme', 'ellak_remove_actions' );
function ellak_remove_actions() {
	// remove featured image for single post header
	remove_action( 'generate_before_content',
		'generate_featured_page_header_inside_single', 10 );
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

?>
