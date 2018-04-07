<?php
/**
 * The custom class for preg_replace_callback.
 *
 * @since 1.5.1
 * @package Coldbox
 */

/**
 * Class Cd_Preg_Replace_Callback
 *
 * Used as helper class for cd_single_content_replace().
 *
 * @since 1.5.1
 */
class Cd_Preg_Replace_Callback {
	/**
	 * Variable passed from callback.
	 *
	 * @var string $count
	 */
	private $count;
	/**
	 * Variable passed from callback.
	 *
	 * @var string $content
	 */
	private $content;
	/**
	 * Variable passed from callback.
	 *
	 * @var string $array_length
	 */
	private $array_length;

	/**
	 * __construct.
	 *
	 * @param string $count Count number.
	 * @param string $content Some content.
	 * @param string $array_length Array length.
	 */
	public function __construct( $count, $content, $array_length = null ) {
		$this->count        = $count;
		$this->content      = $content;
		$this->array_length = $array_length;
	}

	/**
	 * Callback function to search for 2nd occurrence.
	 *
	 * @param string $matches Matches.
	 * @return string
	 *
	 * @since 1.5.1
	 */
	public function cd_single_content_replace( $matches ) {
		$this->count++;

		if ( 2 === $this->count ) {
			return $this->content . $matches[0];
		} else {
			return $matches[0];
		}
	}

	/**
	 * Callback function to search for the last occurrence.
	 *
	 * @param string $matches Matches.
	 * @return string
	 *
	 * @since 1.5.1
	 */
	public function cd_single_content_replace_last( $matches ) {
		$this->count++;

		if ( $this->count === $this->array_length ) {
			return $this->content . $matches[0];
		} else {
			return $matches[0];
		}
	}
}
