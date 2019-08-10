<?php

class ADMIN_PAGE {

  /**
	 * The string used to uniquely identify this plugin.
	 *
	 * @since 1.0.0
	 * @access public
	 * @var string
	 */
	public $name;

	/**
	 * The plugin_url
	 *
	 * @since 1.0.0
	 * @access public
	 * @var string
	 */
	public $title;

	/**
	 * The plugin_url
	 *
	 * @since 1.0.0
	 * @access public
	 * @var string
	 */
	public $url;
	
	/**
	 * The plugin_url
	 *
	 * @since 1.0.0
	 * @access public
	 * @var string
	 */
	public $category;
	
	/**
	 * The plugin_url
	 *
	 * @since 1.0.0
	 * @access public
	 * @var string
	 */
  public $zero_state;
  
  /**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name, url, path and plugin version that can be used throughout the plugin.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function __construct( $opts ) {
		$this->name = $opts['name'];
		$this->title = $opts['title'];
		$this->url = $opts['url'];
		$this->category = $opts['category'];
		$this->zero_state = $opts['zero_state'];
	}
}