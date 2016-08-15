<?php
/**
 * Created by PhpStorm.
 * User: mac
 * Date: 13/8/16
 * Time: 2:54 AM
 */
namespace Wpng;

class WpngRouter {
    public static function init(){
        self::registerVars();
        self::registerRouter();
    }
    private static function registerVars(){
        // Register query var
        add_filter('query_vars', function(){
            $vars[] = 'module';
            $vars[] = 'controller';
            $vars[] = 'action';
            $vars[] = 'api';
            $vars[] = 'id';
            return $vars;
        }, 10, 1);
    }
    private static function registerRouter(){
        // Redirect to wanted controller
        add_action('parse_request', function(&$wp)
        {
            if (array_key_exists('module', $wp->query_vars)) {
                if (array_key_exists('controller', $wp->query_vars)) {
                    if (array_key_exists('action', $wp->query_vars)) {
                        Wpng::runController($wp->query_vars['module'], $wp->query_vars['controller'], $wp->query_vars['action']);
                    } else {
                        Wpng::runController($wp->query_vars['module'], $wp->query_vars['controller']);
                    }
                    exit(0);
                }
                if (array_key_exists('api', $wp->query_vars)) {
                    if (array_key_exists('action', $wp->query_vars)) {
                        Wpng::runApiController($wp->query_vars['module'], $wp->query_vars['api'], $wp->query_vars['action']);
                    } else {
                        Wpng::runApiController($wp->query_vars['module'], $wp->query_vars['api']);
                    }
                    exit(0);
                }
                Wpng::runController($wp->query_vars['module']);
                exit(0);
            }
        });
    }
}