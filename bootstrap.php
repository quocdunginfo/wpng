<?php

class Wpng
{
	private static $initiated = false;
	private static $admin_initiated = false;

	public static function pluginActivation()
	{
		// Set first msg
		update_option('wpng_first_msg', __('Wpng installed successfully!', 'wpng'));
	}

	public static function pluginDeactivation()
	{
		// Do nothing
	}

	public static function init()
	{
		if (!self::$initiated) {
			self::initHooks();
		}
	}

	public static function initAdmin()
	{
		if (!self::$admin_initiated) {
			self::initHooksAdmin();
		}
	}

	/**
	 * Initializes WordPress hooks for All
	 */
	private static function initHooks()
	{
		// Add Action, Filter
		//...
		// Translate using PO, MO
		load_plugin_textdomain( 'wpng', false, basename(dirname(__FILE__)) . '/languages');

		// Final
		self::$initiated = true;
	}
	/**
	 * Initializes WordPress hooks for Admin only
	 */
	private static function initHooksAdmin()
	{
		// Add Action, Filter. Register libraries
		require_once(WPNG_PLUGIN_DIR . 'plugins/wp-admin-notification/bootstrap.php');
		// Show first msg after installed
		{
			$firstMsg = get_option('wpng_first_msg');
			if($firstMsg) {
				wp_admin_notification('wpng_first_msg', $firstMsg);
				delete_option('wpng_first_msg');
			}
		}
		// Register Main Page
		add_action('admin_menu', function(){
			add_menu_page(__('Wpng Page Title', 'wpng'), __('Wpng Menu', 'wpng'), 'manage_options', 'wpng', function(){
				self::runController();
			});
		});

		// Run under Wpng domain only
		$page = $_GET['page'];
		if('wpng' == $page){

			// Register JS
			{
				$scripts = array(
					'/plugins/angularjs/angular.min.js',
					'/plugins/angularjs/angular-route.min.js'
				);
				foreach($scripts as $item){
					$fullURL = plugins_url($item, __FILE__);
					wp_register_script($item, $fullURL);
					wp_enqueue_script($item);
				}
			}

			//		// Load all .class file to domain
			//		{
			//			$dir = new RecursiveDirectoryIterator(__DIR__);
			//			$itr = new RecursiveIteratorIterator($dir);
			//			$regex = new RegexIterator($itr, '/^.+\.class.php$/i', RecursiveRegexIterator::GET_MATCH);
			//			foreach($regex as $item){
			//				//self::loadFileAbsPath($item[0]);
			//				include_once($item[0]);
			//			}
			//		}

			// Add hook to html > Head
			{
				add_action('admin_head', function(){

				});
			}
		}

		// Final
		self::$admin_initiated = true;
	}
	public static function loadFileAbsPath($absPath){
		require_once($absPath);
	}
	public static function loadFile($relativePath){
		require_once(WPNG_PLUGIN_DIR . $relativePath);
	}
	public static function loadController($controllerName, $subName=''){
		if($subName == ''){
			self::loadFile('controllers/' . $controllerName . '/' . $controllerName . '.controller.class.php');
		}else{
			self::loadFile('controllers/' . $controllerName . '/' . $controllerName . '.' . $subName . '.controller.class.php');
		}
		$className = $controllerName . $subName . 'controller';
		return $className;
	}
	public static function loadApiController($apiControllerName, $subName=''){
		if($subName == ''){
			self::loadFile('api/' . $apiControllerName . '/' . $apiControllerName . '.controller.class.php');
		}else{
			self::loadFile('api/' . $apiControllerName . '/' . $apiControllerName . '.' . $subName . '.controller.class.php');
		}

		$className = $apiControllerName . $subName . 'controller';
		return $className;
	}
	public static function loadView($controllerName, $viewName = ''){
		if($viewName == ''){
			self::loadFile('views/' . $controllerName . '/' . $controllerName . '.view.class.php');
		}else{
			self::loadFile('views/' . $controllerName . '/' . $controllerName . '.' . $viewName . '.view.class.php');
		}

		$className = $controllerName . $viewName . 'view';
		return $className;
	}
	public static function runController($controllerName='', $actionName=''){
		if($controllerName == ''){
			$controllerName = 'wpng';
		}
		if($actionName == ''){
			$actionName = 'index';
		}
		$controllerClass = self::loadController($controllerName);
		$ins = new $controllerClass();
		$ins->$actionName();
	}
	public static function runApiController($apiControllerName='', $actionName=''){
		if($apiControllerName == ''){
			$apiControllerName = 'wpngapi';
		}
		if($actionName == ''){
			$actionName = 'get';
		}
		$apiControllerClass = self::loadApiController($apiControllerName);
		$ins = new $apiControllerClass();
		$ins->$actionName();
	}
}