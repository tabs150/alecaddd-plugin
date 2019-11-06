<?php 

/**
 * @package AlecadddPlugin
 */

namespace Inc\Pages;

use \Inc\Api\SettingsApi;
use \Inc\Base\BaseController;
use \Inc\Api\Callbacks\AdminCallbacks;

class Admin extends BaseController
{	
	public $settings;

	public $callbacks;

	public $pages = array();

	public $subpages = array();

	
	public function register() {
		// add_action( 'admin_menu', array( $this, 'add_admin_pages' ) );
		$this->settings = new SettingsApi();

		$this->callbacks = new AdminCallbacks();

		$this->setPages();

		$this->setSubPages();

		$this->setSettings();

		$this->setSections();

		$this->setFields();

		$this->settings->addPages( $this->pages )->withSubPage( 'Dashboard' )->addSubPages( $this->subpages )->register();
	}

	public function setPages() 
	{
		$this->pages = [
			[
			'page_title' =>  'Alecaddd Plugin', 
			'menu_title' => 'Alecaddd',
			'capability' => 'manage_options', 
			'menu_slug' => 'alecaddd_plugin', 
			'callback' => array( $this->callbacks, 'adminDashboard' ), 
			'icon_url' => 'dashicons-store', 
			'position' => 40
			]
		];
	}

	public function setSubPages()
	{
		$this->subpages = [
			[
                'parent_slug' => 'alecaddd_plugin',
                'page_title' =>  'Custom Post Type', 
                'menu_title' => 'CPT',
                'capability' => 'manage_options',
                'menu_slug' => 'alecaddd_cpt',
                'callback' => array( $this->callbacks, 'adminCpt' )
			],
			[
                'parent_slug' => 'alecaddd_plugin',
                'page_title' =>  'Custom Taxonomies', 
                'menu_title' => 'Taxonomies',
                'capability' => 'manage_options',
                'menu_slug' => 'alecaddd_taxonomies',
                'callback' => array( $this->callbacks, 'adminTaxonomy' )
			],
			[
                'parent_slug' => 'alecaddd_plugin',
                'page_title' =>  'Custom Widgets', 
                'menu_title' => 'Widgets',
                'capability' => 'manage_options',
                'menu_slug' => 'alecaddd_widgets',
                'callback' => array( $this->callbacks, 'adminWidget' )
			],
		];
	}

	public function setSettings() 
	{
		$args = array(
			array(
				'option_group' => 'alecaddd_options_group',
				'option_name' => 'text_example',
				'callback' => array($this->callbacks, 'alecadddOptionsGroup' )
			),
			array(
				'option_group' => 'alecaddd_options_group',
				'option_name' => 'first_name'
			)
		);

		$this->settings->setSettings( $args );
	}


	public function setSections() 
	{
		$args = array(
			array(
				'id' => 'alecaddd_admin_index',
				'title' => 'Settings',
				'callback' => array($this->callbacks, 'alecadddAdminSection' ),
				'page' => 'alecaddd_plugin'
			)
		);

		$this->settings->setSections( $args );

	}

	public function setFields() 
	{
		$args = array(
			array(
				'id' => 'text_example',
				'title' => 'Settings',
				'callback' => array($this->callbacks, 'alecadddTextExample' ),
				'page' => 'alecaddd_plugin',
				'section' => 'alecaddd_admin_index', 
				'args' => array(
					'label for' => 'text_example', 
					'class' => 'example-class'
				)
				),
				array(
					'id' => 'first_name',
					'title' => 'First Name',
					'callback' => array($this->callbacks, 'alecadddFirstName' ),
					'page' => 'alecaddd_plugin',
					'section' => 'alecaddd_admin_index', 
					'args' => array(
						'label for' => 'first_name', 
						'class' => 'example-class'
					)
				)
		);

		$this->settings->setFields( $args );

	}

	/* public function add_admin_pages() {
		add_menu_page( 'Alecaddd Plugin', 'Alecaddd', 'manage_options', 'alecaddd_plugin', array( $this, 'admin_index' ), 'dashicons-store', 40 );
	} */

	/* public function admin_index() {
		require_once $this->plugin_path . 'templates/admin.php';
	} */
}