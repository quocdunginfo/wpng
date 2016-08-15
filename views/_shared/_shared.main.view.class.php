<?php
/**
 * Created by PhpStorm.
 * User: mac
 * Date: 13/8/16
 * Time: 3:41 PM
 */
Wpng::loadView('_base');
class _SharedMainView extends _BaseView {
    public function renderInPlaceHolder($childView){
        ?>
        <style>
            /*
            Test Angular Loading Bar

            #wpadminbar{
                display: none;
            }
            */
            #loading-bar .bar {
                z-index: 1000000; /*Must be grater than WP Top Bar 999999*/
                color: white;
                background-color: #ffffff;
            }
        </style>
        <div>
            <p>
                This is Main Shared View which define ngApp
            </p>
            <script>
                var Wpng = {};
                Wpng.App = angular.module(
                    'WpngApp',
                    [
                        'ngRoute',
                        'ngDialog',

                        // Loading bar
                        'angular-loading-bar',
                        'ngAnimate'
                    ]
                );
                Wpng.BaseUrl = '<?php echo SITECOOKIEPATH; ?>';//userSettings.url; // TODO:
            </script>
            <div ng-app="WpngApp">
                <?php
                    $childView();
                ?>
            </div>
        </div>

        <?php
    }
    public function render($model){
        // Must be overwrite in child class
    }
}