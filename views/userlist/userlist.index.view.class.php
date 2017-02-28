<?php
/**
 * Created by PhpStorm.
 * User: mac
 * Date: 13/8/16
 * Time: 3:28 AM
 */
namespace Wpng;
Wpng::loadView(WPNG_MODULE, '_base');
class UserListIndexView extends _BaseView {
    public function render($model) {
        $this->renderInPlaceHolder(function() use ($model){
            ?>
            <script type="text/javascript">
                $(document).ready(function () {
                    // prepare the data
                    var source =
                    {
                        datatype: "json",
                        datafields: [
                            { name: 'username', type: 'string' }
                        ],
                        url: "http://local.wpng/?module=wpng&api=userapi&action=getUsers",
                        root: 'results',
                        type: 'POST'
                    };
                    var dataAdapter = new $.jqx.dataAdapter(source);
                    $("#jqxgrid").jqxGrid(
                        {
                            source: dataAdapter,
                            columnsresize: true,
                            columns: [
                                { text: 'User Name', datafield: 'username'}
                            ]
                        });
                });
            </script>
            <div id="jqxgrid"></div>
            <?php
        });
    }
}