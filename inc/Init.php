<?php
/**
 * @package AlecadddPlugin
 */

namespace Inc;

final class Init
{    
    static function get_services() {
        return [
            Pages\Admin::class,
            Base\Enqueue::class,
            Base\SettingsLinks::class           
        ];
    }
    
    public static function register_services() {
        foreach( self::get_services() as $class ) {
            $service = self::instantiate( $class );
            if ( method_exists( $service, 'register' ) ) {
                $service->register();
            }
        }
    }
/**
 * 
 */
    private static function instantiate( $class ) {
        $service = new $class();
        return $service;
    }
}
// use Inc\Activate;
// use Inc\Deactivate;
// use Inc\Admin\AdminPages;
// if ( !class_exists( 'AlecadddPlugin' ) ) {
// 	class AlecadddPlugin
// 	{
// 		public $plugin;
// 		function __construct() {
// 			$this->plugin = plugin_basename( __FILE__ );
// 		}
// 		function register() {
// 			
// 			add_action( 'admin_menu', array( $this, 'add_admin_pages' ) );
// 			
// 		}
// 		public function settings_link( $links ) {
// 			
// 		}
// 		
// 		protected function create_post_type() {
// 			add_action( 'init', array( $this, 'custom_post_type' ) );
// 		}
// 		function custom_post_type() {
// 			register_post_type( 'book', ['public' => true, 'label' => 'Books'] );
// 		}
// 		
// 		function activate() {
// 			Activate::activate();
// 		}
// 	}
// 	$alecadddPlugin = new AlecadddPlugin();
// 	$alecadddPlugin->register();
// 	// activation
// 	register_activation_hook( __FILE__, array( $alecadddPlugin, 'activate' ) );
// 	// deactivation
// 	register_deactivation_hook( __FILE__, array( 'Deactivate', 'deactivate' ) );
// }