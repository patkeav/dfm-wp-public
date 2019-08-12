<?php
require_once( $this->plugin_path . 'includes/class-admin-page.php' );

class ADD_ADMIN_PAGES {

  /**
   * An array of pages to add to the admin
   *
   * @since 1.0.0
   * @access public
   * @var string
   */
  public $pages;

  /**
   * The current page the user is on
   *
   * @since 1.0.0
   * @access public
   * @var string
   */
  public $current_page;
  
  /**
   * Define the core functionality of the class.
   *
   * Build array of pages to add to the admin
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
        'limit' => 25,
        'zero_state' => 'There are no Sports posts. Check back later'
      )),
      'animals' => new ADMIN_PAGE( array(
        'name' => 'Animals',
        'title' => 'Animals Content',
        'url' => 'animals',
        'category' => 'animals',
        'limit' => 10,
        'zero_state' => 'There are no Animals posts. Check back later'
      )),
      'business' => new ADMIN_PAGE( array(
        'name' => 'Business',
        'title' => 'Business Content',
        'url' => 'business',
        'category' => 'business',
        'limit' => 12,
        'zero_state' => 'There are no Business posts. Check back later'
      )),
      'entertainment' => new ADMIN_PAGE( array(
        'name' => 'Entertainment',
        'title' => 'Entertainment Content',
        'url' => 'entertainment',
        'category' => 'entertainment',
        'limit' => 50,
        'zero_state' => 'There are no Entertainment posts. Check back later'
      )),
      'world-and-news' => new ADMIN_PAGE( array(
        'name' => 'World and News',
        'title' => 'World and News Content',
        'url' => 'world-and-news',
        'category' => 'world-and-news',
        'limit' => 100,
        'zero_state' => 'There are no World and News posts. Check back later'
      ))
    );
  }

  /**
   * Enqueues scripts to be used by the plugin
   *
   * @since 1.0.0
   * @access public
   */
  public function enqueue() {
    wp_register_style( 'dfm-css', plugins_url('/css/dfm.css', __DIR__), false, '1.0');
    wp_enqueue_style( 'dfm-css' );
  }
  
  /**
   * Register actions and filters
   *
   * @since 1.0.0
   * @access public
   * @return void
   */
  public function setup() {
    add_action('admin_menu', array ($this, 'setup_menu'), 10, 2);
    add_action('admin_enqueue_scripts', array ($this, 'enqueue'));
  }
  
  /**
   * Adds pages to the admin navigation menu
   *
   * @since 1.0.0
   * @access public
   * @return void
   */
  public function setup_menu() {
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

  /**
   * Callback function used by add_menu_page
   * 
   * Sets the current page, includes template file to display
   *
   * @since 1.0.0
   * @access public
   * @return ADMIN_PAGE
   */
  public function display_stuff() {
    $page = get_current_screen()->parent_base;
    $this->setCurrent($page);
    $currentPage = $this->getCurrent();
    $query = $this->getPosts($this->getCurrent());
    include 'templates/admin-menu-page-template.php';
  }

  /**
   * Gets current page user is on
   *
   * @since 1.0.0
   * @access private
   * @return ADMIN_PAGE
   */
  private function getCurrent() {
    return $this->current_page;
  }

  /**
   * Sets current page user is on
   *
   * @since 1.0.0
   * @access private
   * @return void
   */
  private function setCurrent($page) {
    $this->current_page = $this->pages[$page];
  } 

  /**
   * Helper function for getting posts associated with the current page category
   *
   * @since 1.0.0
   * @access private
   * @return WP_QUERY
   */
  private function getPosts($page) {
    $args = array(
      'post_type' => 'post',
      'posts_per_page' => $page->limit,
      'tax_query' => array(
          array(
              'taxonomy' => 'category',
              'field' => 'slug',
              'terms' => array( $page->category ) )
          )
    );
    return new WP_Query($args);
  }
}