<?php

namespace Wpng;
class WpngHelper
{
    private static $operator_mapping = array(
        'EQUAL' => '=',
        'NOT_EQUAL' => '!=',
        'GREATER_THAN_OR_EQUAL' => '>=',
        'LESS_THAN_OR_EQUAL' => '<=',
        'LESS_THAN' => '<',
        'GREATER_THAN' => '>',
        'CONTAINS' => 'LIKE'
    );
    public static $data_type = array(
        'image' => 'image',
        'flowfield' => 'flowfield'
    );

    public static function loadPHPDOMLibrary()
    {
        require('simple_html_dom.php');
    }

    public static function getDataPortPath($name, $pre_filter_arr = null)
    {
        // .../?qd-api != ...?qd-api [VERY IMPORTANT SINCE AJAX POST NOT WORK]
        $tmp = '';
        if ($pre_filter_arr != null) {
            $count = 99;
            foreach ($pre_filter_arr as $key => $value) {
                $condition = 'EQUAL';
                $f_value = $value;
                $f_field = $key;
                if (is_array($value)) {
                    $f_value = $value['value'];
                    $f_field = $value['field'];
                    $condition = $value['operator'];
                }
                $f_value = $f_value === true ? 1 : ($f_value === false ? 0 : $f_value);
                //must encode value first to avoid special char or white space
                $f_value = urlencode($f_value);
                $tmp .= "&filterdatafield{$count}={$f_field}&filtervalue{$count}={$f_value}&filtercondition{$count}={$condition}";
                $count++;
            }
        }
        return get_site_url() . "/?qd-api={$name}" . $tmp;
    }

    function __construct()
    {

    }

    public static function getNoneText()
    {
        return '[Not set]';
    }

    public function callServerFn($class, $fn, $params)
    {
        return $class::$fn;
    }
    public static function getCompactPageNavigateLink($page_name, $filter_array=array(), $mode = 'navigate', $return_id=null, $getfield=null, $lookupid=null){
        return static::getCompactPageListLink($page_name, $filter_array, $mode, $return_id, $getfield, $lookupid);
    }

    public static function getCompactPageListLink($page_name, $filter_array = array(), $mode='navigate', $return_id=null, $getfield=null, $lookupid=null)
    {
        $filter_string = '';
        $count = 0;
        $form = "&filterdatafield%s=%s&filtervalue%s=%s";
        foreach ($filter_array as $key => $value) {
            if (!is_array($value)) {
                $filter_string .= sprintf($form, $count, $key, $count, $value);// "&filterdatafield{$count}={$key}&filtervalue{$count}={$value}";
            } else {
                $filter_string .= sprintf($form, $count, $value['field'], $count, $value['value']);// "&filterdatafield{$count}={$key}&filtervalue{$count}={$value}";
            }
            $count++;
        }
        $tmp = admin_url("admin.php?page={$page_name}&qdrole={$mode}{$filter_string}");
        if($return_id!=null && $getfield!=null){
            $tmp .= "&qdreturnid={$return_id}&qdgetfield={$getfield}";
        }
        if($lookupid!=null){
            $tmp .= "&qdlookupid={$lookupid}";
        }
        return $tmp;
    }

    /*
    public static function getCompactPagePartLink($page_name, $filterfield, $filtervalue)
    {
        return admin_url("admin.php?page={$page_name}&filterfield={$filterfield}&filtervalue={$filtervalue}");//quocdunginfo
    }*/

    public static function getNoneLink()
    {
        return 'javascript:void(0)';
    }

    public static function getLookupPath($page_list, $return_id, $prefilter = array(), $getfield = 'id', $multi = 0)
    {
        $filter = '';
        $count = 0;
        foreach ($prefilter as $key => $val) {
            $filter .= "&filterdatafield{$count}={$key}&filtervalue{$count}={$val}";
            $count++;
        }
        return get_admin_url(null, "admin.php?page={$page_list}&qdrole=lookup&qdreturnid={$return_id}&qdgetfield={$getfield}&qdmulti={$multi}{$filter}");
    }

    public static function getSlider($metaslider_shortcode)
    {
        self::loadPHPDOMLibrary();
        if ($metaslider_shortcode != '') {
            $slider_html = do_shortcode($metaslider_shortcode);
            $html = str_get_html($slider_html);
            $ret = $html->find('img');
            return $ret;
        } else {
            return array();
        }
    }

    public static function getPageIdByTemplate($template_path_from_theme)
    {
        $re = 0;
        $args = array(
            'post_type' => 'page',//it is a Page right?
            'post_status' => 'publish',
            'meta_query' => array(
                array(
                    'key' => '_wp_page_template',
                    'value' => $template_path_from_theme, // template name as stored in the dB
                )
            )
        );
        $the_query = new WP_Query($args);
        // The Loop
        if ($the_query->have_posts()) {
            $the_query->the_post();
            $re = get_the_ID();
        } else {
            // no posts found
        }
        /* Restore original Post Data */
        wp_reset_postdata();
        return $re;
    }

    public static function qd_datetime_to_js($datetime)
    {
        if ($datetime != null) {
            $year = $datetime->format("Y");
            $month_0 = $datetime->format("m") - 0;
            $day = $datetime->format("d");
            return $year . ', ' . $month_0 . ', ' . $day;
        }
        return '';
    }

    public static function qd_js_to_datetime($year_month_date)
    {
        $arr = explode(',', $year_month_date);
        $tmp = DateTime::createFromFormat('Y, m, d', $arr[0] . ', ' . ($arr[1] + 1) . ', ' . $arr[2]);
        return $tmp;
    }

    /**
     * Init media uploader
     */
    public static function qd_media_choose($btnID, $txtID, $getID = false)
    {
        wp_enqueue_media();
        ?>
        <script>
            // Uploading files
            var <?=$btnID?>_file_frame;

            jQuery('#<?=$btnID?>').live('click', function (event) {

                event.preventDefault();

                // If the media frame already exists, reopen it.
                if (<?=$btnID?>_file_frame) {
                    <?=$btnID?>_file_frame.open();
                    return;
                }

                // Create the media frame.
                <?=$btnID?>_file_frame = wp.media.frames.<?=$btnID?>_file_frame = wp.media({
                    title: jQuery(this).data('uploader_title'),
                    button: {
                        text: jQuery(this).data('uploader_button_text')
                    },
                    multiple: false  // Set to true to allow multiple files to be selected
                });

                // When an image is selected, run a callback.
                <?=$btnID?>_file_frame.on('select', function () {
                    //alert('<?=$txtID?>');
                    // We set multiple to false so only get one image from the uploader
                    attachment = <?=$btnID?>_file_frame.state().get('selection').first().toJSON();
                    //jQuery('#<?=$txtID?>').val(<?=$getID===true?'attachment.id':'attachment.url'?>);
                    eval('MYAPP.viewModel.' + '<?=$txtID?>')(<?=$getID===true?'attachment.id':'attachment.url'?>);
                    // Do something with attachment.id and/or attachment.url here
                });

                // Finally, open the modal
                <?=$btnID?>_file_frame.open();
            });
        </script>
    <?php
    }

    public static function getImgURL($path)
    {
        return plugins_url('../views/imgs/' . $path, __FILE__);
    }

    public static function sanitize_title_with_dashes($string)
    {
        //chuyen co dau thanh khong dau
        return sanitize_title_with_dashes(static::coDauThanhKhongDau($string));
    }

    public static function coDauThanhKhongDau($string)
    {
        $trans = array('à' => 'a', 'á' => 'a', 'ả' => 'a', 'ã' => 'a', 'ạ' => 'a',
            'ă' => 'a', 'ằ' => 'a', 'ắ' => 'a', 'ẳ' => 'a', 'ẵ' => 'a', 'ặ' => 'a',
            'â' => 'a', 'ầ' => 'a', 'ấ' => 'a', 'ẩ' => 'a', 'ẫ' => 'a', 'ậ' => 'a',
            'À' => 'a', 'Á' => 'a', 'Ả' => 'a', 'Ã' => 'a', 'Ạ' => 'a',
            'Ă' => 'a', 'Ằ' => 'a', 'Ắ' => 'a', 'Ẳ' => 'a', 'Ẵ' => 'a', 'Ặ' => 'a',
            'Â' => 'a', 'Ầ' => 'a', 'Ấ' => 'a', 'Ẩ' => 'a', 'Ẫ' => 'a', 'Ậ' => 'a',
            'đ' => 'd', 'Đ' => 'd',
            'è' => 'e', 'é' => 'e', 'ẻ' => 'e', 'ẽ' => 'e', 'ẹ' => 'e',
            'ê' => 'e', 'ề' => 'e', 'ế' => 'e', 'ể' => 'e', 'ễ' => 'e', 'ệ' => 'e',
            'È' => 'e', 'É' => 'e', 'Ẻ' => 'e', 'Ẽ' => 'e', 'Ẹ' => 'e',
            'Ê' => 'e', 'Ề' => 'e', 'Ế' => 'e', 'Ể' => 'e', 'Ễ' => 'e', 'Ệ' => 'e',
            'ì' => 'i', 'í' => 'i', 'ỉ' => 'i', 'ĩ' => 'i', 'ị' => 'i',
            'Ì' => 'i', 'Í' => 'i', 'Ỉ' => 'i', 'Ĩ' => 'i', 'Ị' => 'i',
            'ò' => 'o', 'ó' => 'o', 'ỏ' => 'o', 'õ' => 'o', 'ọ' => 'o',
            'ô' => 'o', 'ồ' => 'o', 'ố' => 'o', 'ổ' => 'o', 'ỗ' => 'o', 'ộ' => 'o',
            'ơ' => 'o', 'ờ' => 'o', 'ớ' => 'o', 'ở' => 'o', 'ỡ' => 'o', 'ợ' => 'o',
            'Ò' => 'o', 'Ó' => 'o', 'Ỏ' => 'o', 'Õ' => 'o', 'Ọ' => 'o',
            'Ô' => 'o', 'Ồ' => 'o', 'Ố' => 'o', 'Ổ' => 'o', 'Ỗ' => 'o', 'Ộ' => 'o',
            'Ơ' => 'o', 'Ờ' => 'o', 'Ớ' => 'o', 'Ở' => 'o', 'Ỡ' => 'o', 'Ợ' => 'o',
            'ù' => 'u', 'ú' => 'u', 'ủ' => 'u', 'ũ' => 'u', 'ụ' => 'u',
            'ư' => 'u', 'ừ' => 'u', 'ứ' => 'u', 'ử' => 'u', 'ữ' => 'u', 'ự' => 'u',
            'Ù' => 'u', 'Ú' => 'u', 'Ủ' => 'u', 'Ũ' => 'u', 'Ụ' => 'u',
            'Ư' => 'u', 'Ừ' => 'u', 'Ứ' => 'u', 'Ử' => 'u', 'Ữ' => 'u', 'Ự' => 'u',
            'ỳ' => 'y', 'ý' => 'y', 'ỷ' => 'y', 'ỹ' => 'y', 'ỵ' => 'y',
            'Y' => 'y', 'Ỳ' => 'y', 'Ý' => 'y', 'Ỷ' => 'y', 'Ỹ' => 'y', 'Ỵ' => 'y'
        );
        return strtr($string, $trans);
    }

    public static function requestCompact()
    {
        ?>
        <style id="qd-compact-style">
            @media all, screen {
                /*Hide built-in WP elements*/
                #wpadminbar, #adminmenuback, #adminmenuwrap, #wpfooter, #update-nag, .update-nag {
                    display: none !important;
                }

                html.wp-toolbar {
                    padding: 0 !important;
                }

                /*jqspliter stretch width 100% not horizontal scroll bar => 19052015*/
                #wpbody-content {
                    overflow-x: hidden !important;
                }

                /*jqspliter stretch height 100% => 19052015*/
                html, body, #wpbody, #wpbody-content, #wpwrap, #wpcontent {
                    height: 100% !important;
                    width: 100% !important;
                    margin: 0 !important;
                    padding: 0 !important;
                }

                #wpwrap .screen-reader-shortcut {
                    display: none !important;
                }
            }
        </style>
    <?php
    }

    /**
     * Check null
     * @param $obj
     * @return bool
     */
    public static function isNullOrEmpty($obj)
    {
        return (!isset($obj) || $obj === null || $obj === false || $obj === '' || (is_array($obj) && empty($obj)));
    }

    public static function sendEmail($email, $title, $content, $html = true)
    {
        error_reporting(0);
        if ($html == true) {
            add_filter('wp_mail_content_type', 'set_html_content_type');
        }
        $re = wp_mail($email, $title, $content);
        return $re;
    }
    /**
     * Ensures an ip address is both a valid IP and does not fall within
     * a private network range.
     *
     * Used for: getClientIP (quocdunginfo)
     */
    private static function validate_ip($ip) {
        if (strtolower($ip) === 'unknown')
            return false;

        // generate ipv4 network address
        $ip = ip2long($ip);

        // if the ip is set and not equivalent to 255.255.255.255
        if ($ip !== false && $ip !== -1) {
            // make sure to get unsigned long representation of ip
            // due to discrepancies between 32 and 64 bit OSes and
            // signed numbers (ints default to signed in PHP)
            $ip = sprintf('%u', $ip);
            // do private network range checking
            if ($ip >= 0 && $ip <= 50331647) return false;
            if ($ip >= 167772160 && $ip <= 184549375) return false;
            if ($ip >= 2130706432 && $ip <= 2147483647) return false;
            if ($ip >= 2851995648 && $ip <= 2852061183) return false;
            if ($ip >= 2886729728 && $ip <= 2887778303) return false;
            if ($ip >= 3221225984 && $ip <= 3221226239) return false;
            if ($ip >= 3232235520 && $ip <= 3232301055) return false;
            if ($ip >= 4294967040) return false;
        }
        return true;
    }

    public static function getClientIP()
    {
        // check for shared internet/ISP IP
        if (!empty($_SERVER['HTTP_CLIENT_IP']) && static::validate_ip($_SERVER['HTTP_CLIENT_IP'])) {
            return $_SERVER['HTTP_CLIENT_IP'];
        }

        // check for IPs passing through proxies
        if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            // check if multiple ips exist in var
            if (strpos($_SERVER['HTTP_X_FORWARDED_FOR'], ',') !== false) {
                $iplist = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
                foreach ($iplist as $ip) {
                    if (static::validate_ip($ip))
                        return $ip;
                }
            } else {
                if (static::validate_ip($_SERVER['HTTP_X_FORWARDED_FOR']))
                    return $_SERVER['HTTP_X_FORWARDED_FOR'];
            }
        }
        if (!empty($_SERVER['HTTP_X_FORWARDED']) && static::validate_ip($_SERVER['HTTP_X_FORWARDED']))
            return $_SERVER['HTTP_X_FORWARDED'];
        if (!empty($_SERVER['HTTP_X_CLUSTER_CLIENT_IP']) && static::validate_ip($_SERVER['HTTP_X_CLUSTER_CLIENT_IP']))
            return $_SERVER['HTTP_X_CLUSTER_CLIENT_IP'];
        if (!empty($_SERVER['HTTP_FORWARDED_FOR']) && static::validate_ip($_SERVER['HTTP_FORWARDED_FOR']))
            return $_SERVER['HTTP_FORWARDED_FOR'];
        if (!empty($_SERVER['HTTP_FORWARDED']) && static::validate_ip($_SERVER['HTTP_FORWARDED']))
            return $_SERVER['HTTP_FORWARDED'];

        // return unreliable ip since all else failed
        return $_SERVER['REMOTE_ADDR'];
    }

    public static function getFullURLFromAbsPath($abs_path = '')
    {
        $tmp = is_ssl() ? 'https' : 'http';
        $tmp .= '://';
        $tmp .= $_SERVER['HTTP_HOST'];
        $tmp .= $abs_path;
        return $tmp;
    }

    public static function getCurrentUserName()
    {
        $current_user = wp_get_current_user();
        if ($current_user != null) {
            return $current_user->user_login;
        }
        return null;
    }
    public static function deleteUserCache($uid=null){
        //delete Qdmvc User Permission Cache, Transient
        $key = static::getUserCacheKey($uid);
        delete_transient($key);
    }
    public static function getUserCacheKey($uid=null){
        if($uid==null){
            $uid = get_current_user_id();
        }
        return 'qdmvc_user_group_of_'.$uid;
    }
    public static function getCurrentUser(){
        $key = static::getUserCacheKey();
        $obj = get_transient($key);
        if($obj==null){
            $obj = QdUser::GET(get_current_user_id());
            $obj->getPermissions();
            set_transient($key, $obj);
        }

        return $obj;
    }

    public static function subStringByWord($body, $maxlength){
        if (strlen($body)<$maxlength) return $body;
        $body = substr($body, 0, $maxlength);
        $rpos = strrpos($body,' ');
        if ($rpos>0) $body = substr($body, 0, $rpos);
        return $body;
    }


    public static function getOperator($mask = 'EQUAL')
    {
        if (isset(static::$operator_mapping[$mask])) {
            return static::$operator_mapping[$mask];
        }
        return '=';
    }
    public static function num_as_group_vn($num, $after=''){
        return number_format($num, 0, '.', ',') . $after;
    }
}

function set_html_content_type()
{
    return 'text/html';
}
