<?php

/* functions, filters and hooks for ellak.gr child theme */

// remove generatepress action hooks
add_action( 'after_setup_theme', 'ellak_remove_actions' );
function ellak_remove_actions() {
	// remove featured image for single post header
	remove_action( 'generate_before_content',
		'generate_featured_page_header_inside_single', 10 );
}
