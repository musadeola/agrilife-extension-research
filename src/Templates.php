<?php
namespace AgriLife\ExtensionResearch;

/**
 * Redirects to correct template files based on query variables.
 * Also provides static methods to pull certain views
 */

class Templates {

	private $post_type;
	private $single_file;
	private $archive_file;

	public function __construct( $posttype, $single, $archive ) {

		$this->post_type = $posttype;
		$this->single_file = $single;
		$this->archive_file = $archive;

		add_filter( 'archive_template', array( $this, 'get_archive_template' ) );
		add_filter( 'single_template', array( $this, 'get_single_template' ) );

	}

	/**
	 * Shows the archive template when needed
	 * @param  string $archive_template The default archive template
	 * @return string                   The correct archive template
	 */
	public function get_archive_template( $archive_template ) {

		global $post;

		if ( is_post_type_archive( $this->post_type ) ) {
			$archive_template = AG_EXTRES_TEMPLATE_PATH . '/' . $this->archive_file;
		}

		return $archive_template;

	}

	/**
	 * Shows the single template when needed
	 * @param  string $single_template The default single template
	 * @return string                  The correct single template
	 */
	public function get_single_template( $single_template ) {

		global $post;

		if ( get_query_var( 'post_type' ) == $this->post_type ) {
			$single_template = AG_EXTRES_TEMPLATE_PATH . '/' . $this->single_file;
		}

		return $single_template;

	}

}
