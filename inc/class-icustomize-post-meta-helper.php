<?php
 /**
 * iCustomize_Post_Meta_Helper class.
 *
 * @package     iCustomize
 * @category    Core
 * @author      wplovr
 * @copyright   Copyright (c) 2016, Philip Ingram, wplovr, wplovr.com
 * @license     http://www.gnu.org/licenses/gpl-3.0.en.html
 * @since       0.01
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Early exit if the class already exists
if ( class_exists( 'iCustomize_Post_Meta_Helper' ) ) {
	return;
}

/**
 * Class iCustomize_Post_Meta_Helper.
 */
class iCustomize_Post_Meta_Helper {

	/**
	 * Add hooks for plugin.
	 */
	public function init() {
		add_action( 'customize_preview_init', array( $this, 'customize_preview_init' ) );
		add_action( 'customize_controls_enqueue_scripts', array( $this, 'enqueue_control_scripts' ) );
	}

	/**
	 * Enqueue Customizer control scripts.
	 */
	public function enqueue_control_scripts() {
	    wp_enqueue_script( 'icustomize-codemirror-search-script', '//cdnjs.cloudflare.com/ajax/libs/codemirror/5.11.0/addon/search/search.min.js', array( 'codemirror' ), null, true );
	    wp_enqueue_script( 'icustomize-codemirror-search-cursor-script', '//cdnjs.cloudflare.com/ajax/libs/codemirror/5.11.0/addon/search/searchcursor.min.js', array( 'codemirror' ), null, true );
	    wp_enqueue_script( 'icustomize-codemirror-search-jumptoline-script', '//cdnjs.cloudflare.com/ajax/libs/codemirror/5.11.0/addon/search/jump-to-line.min.js', array( 'codemirror' ), null, true );
	    wp_enqueue_script( 'icustomize-codemirror-search-matchhighlight-script', '//cdnjs.cloudflare.com/ajax/libs/codemirror/5.11.0/addon/search/match-highlighter.min.js', array( 'codemirror' ), null, true );
	    wp_enqueue_script( 'icustomize-codemirror-search-matchesonscrollbar-script', '//cdnjs.cloudflare.com/ajax/libs/codemirror/5.11.0/addon/search/matchesonscrollbar.min.js', array( 'codemirror' ), null, true );

		$handle = 'icustomize-previewed-controls';
		$opt = 'min.';

		if ( IC_DEBUG == true ) $opt = '';
        $src = plugins_url( '../js/customize-controls.' . $opt . 'js', __FILE__ );
		$deps = array( 'customize-controls', 'jquery-ui-resizable', 'jquery-ui-widget', 'jquery-ui-mouse' );
		$ver = false;
		$in_footer = true;
		wp_enqueue_script( $handle, $src, $deps, $ver, $in_footer );
	}

	/**
	 * Initialize Customizer preview.
	 */
	public function customize_preview_init() {
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_preview_scripts' ) );
	}

	/**
	 * Enqueue script for Customizer preview.
	 */
	public function enqueue_preview_scripts() {
		$handle = 'icustomize-previewed-preview';
		$opt = 'min.';

		if ( IC_DEBUG == true ) $opt = '';
		$src = plugins_url( '../js/customize-preview.' . $opt . 'js', __FILE__ );
		$deps = array( 'customize-preview' );
		$ver = false;
		$in_footer = true;
		wp_enqueue_script( $handle, $src, $deps, $ver, $in_footer );

		$wp_scripts = wp_scripts();
		$queried_post = null;

		if ( is_singular() && get_queried_object() ) {
			$queried_post = get_queried_object();
			$queried_post->meta = get_post_custom( $queried_post->id );
			$queried_post->theme = CURRENT_THEME_NAME;
		}
		$wp_scripts->add_data( $handle, 'data', sprintf( 'var _iCustomizePreviewedQueriedObject = %s;', wp_json_encode( $queried_post ) ) );
	}
}