<?php

class ADMIN_PAGE {

  /**
	 * The name of the page
	 *
	 * @since 1.0.0
	 * @access public
	 * @var string
	 */
	public $name;

	/**
	 * The page title
	 *
	 * @since 1.0.0
	 * @access public
	 * @var string
	 */
	public $title;

	/**
	 * The page url
	 *
	 * @since 1.0.0
	 * @access public
	 * @var string
	 */
	public $url;
	
	/**
	 * The page category
	 *
	 * @since 1.0.0
	 * @access public
	 * @var string
	 */
	public $category;

	/**
	 * The number of posts to display
	 *
	 * @since 1.0.0
	 * @access public
	 * @var string
	 */
	public $limit;
	
	/**
	 * The page zero state text
	 *
	 * @since 1.0.0
	 * @access public
	 * @var string
	 */
  public $zero_state;
  
  /**
	 * Sets up the field for this class
	 *
	 * $opts = array of options to set
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function __construct( $opts ) {
		$this->name = $opts['name'];
		$this->title = $opts['title'];
		$this->url = $opts['url'];
		$this->category = $opts['category'];
		$this->limit = $opts['limit'];
		$this->zero_state = $opts['zero_state'];
	}
}