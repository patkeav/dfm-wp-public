<?php
require_once( $this->plugin_path . 'includes/class-admin-page.php' );

class ADD_ADMIN_PAGES {

  /**
	 * The string used to uniquely identify this plugin.
	 *
	 * @since 1.0.0
	 * @access public
	 * @var string
	 */
	public $pages;

	/**
	 * The plugin_url
	 *
	 * @since 1.0.0
	 * @access public
	 * @var string
	 */
  public $current_page;
  
  /**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name, url, path and plugin version that can be used throughout the plugin.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function __construct(  ) {
		$this->pages = array(
      'sports' => new ADMIN_PAGE( array(
        'name' => 'Sports',
        'title' => 'Sports Content',
        'url' => 'sports',
        'category' => 'sports',
        'zero_state' => 'There are no Sports posts. Check back later'
      )),
      'animals' => new ADMIN_PAGE( array(
        'name' => 'Animals',
        'title' => 'Animals Content',
        'url' => 'animals',
        'category' => 'animals',
        'zero_state' => 'There are no Animals posts. Check back later'
      )),
      'business' => new ADMIN_PAGE( array(
        'name' => 'Business',
        'title' => 'Business Content',
        'url' => 'business',
        'category' => 'business',
        'zero_state' => 'There are no Business posts. Check back later'
      )),
      'entertainment' => new ADMIN_PAGE( array(
        'name' => 'Entertainment',
        'title' => 'Entertainment Content',
        'url' => 'entertainment',
        'category' => 'entertainment',
        'zero_state' => 'There are no Entertainment posts. Check back later'
      )),
      'world-and-news' => new ADMIN_PAGE( array(
        'name' => 'World and News',
        'title' => 'World and News Content',
        'url' => 'world-and-news',
        'category' => 'world_and_news',
        'zero_state' => 'There are no World and News posts. Check back later'
      ))
      );
  }
  
  /**
	 * Register the actions and filters
	 *
	 * @since 1.0.0
	 * @access public
	 * @return void
	 */
	public function setup() {
    add_action('admin_menu', array ($this, 'test_plugin_setup_menu'), 10, 2);
  }

  private function getCurrent() {
    return $this->current_page;
  }

  private function setCurrent($page) {
    $this->current_page = $this->pages[$page];
  }
  
  function test_plugin_setup_menu() {
    $i = 1;
    foreach ($this->pages as $page) {
      add_menu_page( 
        $page->title,
        $page->name,
        'manage_options',
        $page->url,
        array($this, 'display_stuff'),
        'dashicons-media-code',
        $i);
      $i++;
    } 
  }

  public function display_stuff() {
    $page = get_current_screen()->parent_base;
    $this->setCurrent($page);
    include 'templates/admin-menu-page-template.php';
  }
}