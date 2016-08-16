<?php
namespace Wpng;
class WpngBundle {
	public static function getAngularJs(){
		$absUrl = array();
		$cssAbsUrl = array();
		{
			$files = array(
				'plugins/angularjs/angular.min.js',
				'plugins/angularjs/angular-animate.min.js',
				'plugins/angularjs/angular-route.min.js',
				'plugins/ngDialog/ngDialog.js',

				'plugins/angular-loading-bar/loading-bar.js'
			);
			foreach($files as $item){
				$absUrl[] = Wpng::getUrl(WPNG_MODULE, $item);
			}
		}
		{
			$cssFiles = array(
				'plugins/ngDialog/ngDialog.css',
				'plugins/ngDialog/ngDialog-theme-default.css',

				'plugins/angular-loading-bar/loading-bar.css'
			);
			foreach($cssFiles as $item){
				$cssAbsUrl[] = Wpng::getUrl(WPNG_MODULE, $item);
			}
		}

		return array(
			'js' => $absUrl,
			'css' => $cssAbsUrl
		);
	}
	public static function getJquery(){
		$files = array(
			'jquery-2.1.1.min.js'
		);
		$absUrl = array();
		foreach($files as $item){
			$absUrl[] = Wpng::getUrl(WPNG_MODULE, 'plugins/jquery/' . $item);
		}
		return array(
			'js' => $absUrl,
			'css' => array(
				
			)
		);
	}
	public static function getJqWidget(){
		$absUrl = array();
		$cssAbsUrl = array();
		{
			$files = array(
				'jqx-all.js',
				'globalization/globalize.js'
			);
			foreach($files as $item){
				$absUrl[] = Wpng::getUrl(WPNG_MODULE, 'plugins/jqwidgets/' . $item);
			}
		}
		{
			$cssFiles = array(
				'jqx.base.css',
				'jqx.bootstrap.css',
			);
			foreach($cssFiles as $item){
				$cssAbsUrl[] = Wpng::getUrl(WPNG_MODULE, 'plugins/jqwidgets/styles/' . $item);
			}
		}		

		return array(
			'js' => $absUrl,
			'css' => $cssAbsUrl
		);
	}
	public static function renderBundle($bundles){
		if(isset($bundles['js'])){
			foreach($bundles['js'] as $item){
				?>
				<script type="text/javascript" src="<?php echo $item ?>" ></script>
				<?php
			}
		}
		if(isset($bundles['css'])){
			foreach($bundles['css'] as $item){
				?>
				<link type="text/css" rel="stylesheet" href="<?php echo $item ?>">
				<?php
			}
		}
	}
}