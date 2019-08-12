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
        'category' => 'world-and-news',
        'zero_state' => 'There are no World and News posts. Check back later'
      ))
    );
  }

  public function enqueue() {
    wp_register_style( 'dfm-css', plugins_url('/css/dfm.css', __DIR__), false, '1.0');
    wp_enqueue_style( 'dfm-css' );
  }
  
  /**
	 * Register the actions and filters
	 *
	 * @since 1.0.0
	 * @access public
	 * @return void
	 */
	public function setup() {
    add_action('admin_menu', array ($this, 'setup_menu'), 10, 2);
    add_action('admin_enqueue_scripts', array ($this, 'enqueue'));
  }

  

  private function getCurrent() {
    return $this->current_page;
  }

  private function setCurrent($page) {
    $this->current_page = $this->pages[$page];
  }
  
  function setup_menu() {
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
    $currentPage = $this->getCurrent();
    $query = $this->getPosts($this->getCurrent()->category);
    include 'templates/admin-menu-page-template.php';
  }

  private function getPosts($page) {
    $args = array(
      'post_type' => 'post',
      'posts_per_page' => 25,
      'tax_query' => array(
          array(
              'taxonomy' => 'category',
              'field' => 'slug',
              'terms' => array( $page ) )
          )
    );
    return new WP_Query($args);
  }
}