<?php
namespace Wpng;

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
				self::runController(WPNG_MODULE);
			});
		});

		// Run under Wpng domain only
		$page = $_GET['page'];
		if('wpng' == $page){

			// Register JS
			{
				$scripts = array(
					'/plugins/angularjs/angular.min.js' => array(),
					'/plugins/angularjs/angular-route.min.js' => array(),
					'/plugins/ngDialog/ngDialog.js' => array(),

					'/plugins/bootstrap/bootstrap.min.js' => array(),

					'/plugins/angularjs/angular-animate.min.js' => array(),
					'/plugins/angular-loading-bar/loading-bar.js' => array(),
					
					// BEGIN jQWidget
					'/plugins/disable-wp-jquery-noconflict/disable-wp-jquery-noconflict.js' => array('jquery'),
					'/plugins/jqwidgets/jqx-all.js' => array('/plugins/disable-wp-jquery-noconflict/disable-wp-jquery-noconflict.js'),
					'/plugins/jqwidgets/globalization/globalize.js' => array('/plugins/jqwidgets/jqx-all.js')
					// END jQWidget
				);
				foreach($scripts as $rPath => $dep){
					$fullURL = plugins_url($rPath, __FILE__);
					wp_register_script($rPath, $fullURL, $dep);
					wp_enqueue_script($rPath);
				}
			}

			// Register CSS
			{
				$styles = array(
					'/plugins/ngDialog/ngDialog-theme-default.css',
					'/plugins/ngDialog/ngDialog.css',

					'/plugins/bootstrap/bootstrap.min.css',
					'/plugins/bootstrap/bootstrap-theme.min.css',

					'/plugins/angular-loading-bar/loading-bar.css',
					
					// BEGIN jQWidget
					'/plugins/jqwidgets/styles/jqx.base.css',
					'/plugins/jqwidgets/styles/jqx.bootstrap.css'
					// END jQWidget
				);
				foreach($styles as $item){
					$fullURL = plugins_url($item, __FILE__);
					wp_register_style($item, $fullURL);
					wp_enqueue_style($item);
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
	public static function loadFileAbsPath($module, $absPath){
		require_once($absPath);
	}
	public static function loadFile($module, $relativePath){
		require_once(WPNG_PLUGIN_DIR . '../' . $module . '/' . $relativePath);
	}
	public static function loadUIControl($module, $controlName){
		Wpng::loadFile($module, 'models/ui.control/ui.' . $controlName . '.class.php');
	}
	public static function loadController($module, $controllerName, $subName=''){
		if($subName == ''){
			self::loadFile($module, 'controllers/' . $controllerName . '/' . $controllerName . '.controller.class.php');
		}else{
			self::loadFile($module, 'controllers/' . $controllerName . '/' . $controllerName . '.' . $subName . '.controller.class.php');
		}
		$className = $module . '\\' . $controllerName . $subName . 'controller';
		return $className;
	}
	public static function loadApiController($module, $apiControllerName, $subName=''){
		if($subName == ''){
			self::loadFile($module, 'api/' . $apiControllerName . '/' . $apiControllerName . '.controller.class.php');
		}else{
			self::loadFile($module, 'api/' . $apiControllerName . '/' . $apiControllerName . '.' . $subName . '.controller.class.php');
		}

		$className = $module . '\\' . $apiControllerName . $subName . 'controller';
		return $className;
	}
	public static function loadView($module, $controllerName, $viewName = ''){
		if($viewName == ''){
			self::loadFile($module, 'views/' . $controllerName . '/' . $controllerName . '.view.class.php');
		}else{
			self::loadFile($module, 'views/' . $controllerName . '/' . $controllerName . '.' . $viewName . '.view.class.php');
		}

		$className = $module . '\\' . $controllerName . $viewName . 'view';
		return $className;
	}
	public static function runController($module, $controllerName='', $actionName=''){
		if($controllerName == ''){
			$controllerName = 'wpng';
		}
		if($actionName == ''){
			$actionName = 'index';
		}
		$controllerClass = self::loadController($module, $controllerName);
		$ins = new $controllerClass();
		$ins->$actionName();
	}
	public static function runApiController($module, $apiControllerName='', $actionName=''){
		if($apiControllerName == ''){
			$apiControllerName = 'wpngapi';
		}
		if($actionName == ''){
			$actionName = 'get';
		}
		$apiControllerClass = self::loadApiController($module, $apiControllerName);
		$ins = new $apiControllerClass();
		$ins->$actionName();
	}
	public static function getUrl($module, $relativePath){
		return WPNG_PLUGIN_URL . '../' . $module . '/' . $relativePath;
	}
}