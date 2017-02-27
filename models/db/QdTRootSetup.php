<?php

class QdTRootSetup extends QdRootSetup
{
    static $table_name = 'mpd_setup_theme_root';

    public static function getFieldsConfig()
    {
        return array_merge(parent::getFieldsConfig(), array(
            'topleft_tuvan' => array(
                'DataType' => 'WYSIWYG',
            ),
            'seo_description_struct' => array(
                'Description' => array(
                    'vi-VN' => 'Cấu hình Template cho mô tả trang Web'
                ),
            ),
            'seo_title_struct' => array(
                'Description' => array(
                    'vi-VN' => 'Cấu hình Template cho tiêu đề trang SP - Template 1'
                ),
            ),
            'seo_title_struct_2' => array(
                'Description' => array(
                    'vi-VN' => 'Cấu hình Template cho tiêu đề trang SP - Template 2'
                ),
            ),
            'seo_title_struct_3' => array(
                'Description' => array(
                    'vi-VN' => 'Cấu hình Template cho tiêu đề trang Web - Template 3 (HomePage only)'
                ),
            ),
            'seo_title_struct_4' => array(
                'Description' => array(
                    'vi-VN' => 'Cấu hình Template cho tiêu đề trang Web - Template 4 (Title các trang khác)'
                ),
            ),
            'seo_keywords_struct' => array(
                'Description' => array(
                    'vi-VN' => 'Cấu hình Keywork cho trang Web'
                ),
            ),
            'topcenter_promotion' => array(
                'DataType' => 'WYSIWYG',
                'Description' => array(
                    'vi-VN' => 'Cấu hình dòng chữ góc trên bên trái của Theme'
                ),
            ),
            'topright_navs' => array(
                'DataType' => 'WYSIWYG',
                'Description' => array(
                    'vi-VN' => 'Cấu hình dòng chữ góc trên bên phải của Theme'
                ),
            ),
            'bottomleft_footer_note' => array(
                'DataType' => 'WYSIWYG',
                'Description' => array(
                    'vi-VN' => 'Cấu hình dòng chữ giới thiệu cho Footer (góc dưới bên trái)'
                ),
            ),
            'vnc_logo' => array(
                'DataType' => 'Image',
                'Description' => array(
                    'vi-VN' => 'Cấu hình Logo chính giữa của Theme'
                ),
            ),
            'commercial_logo' => array(
                'DataType' => 'Image',
                'Description' => array(
                    'vi-VN' => 'Cấu hình Logo đã đăng ký với Bộ công thương (góc dưới bên phải) - dòng Footer note'
                ),
            ),
            'banner_service_page' => array(
                'Name' => 'banner_service_page',
                'Caption' => array('en-US' => 'Banner Service Page', 'vi-VN' => 'Banner trang DV'),
                'DataType' => 'Code',
                'Numeric' => true,
                'Description' => array(
                    'vi-VN' => 'Chọn Banner (1 nhóm các hình) cho trang Dịch vụ, Hướng dẫn, FAQs...<br>Định nghĩa Banner trong \'Widget Nav Cat\''
                ),
                'Editable' => true,
                'InitValue' => '0',
                'FieldClass' => 'Normal',//'FlowField'
                'TableRelation' => array(
                    'Table' => 'QdWidgetNavCat',
                    'Field' => 'id',
                    'TableFilter' => array()
                )
            ),
            'widgetnavcat_id' => array(
                'Name' => 'widgetnavcat_id',
                'Caption' => array('en-US' => 'Widget Nav Cat', 'vi-VN' => 'Widget Nav Cat'),
                'DataType' => 'Code',
                'Numeric' => true,
                'Description' => array(
                    'vi-VN' => 'Chọn Widget Nav Cat để hiển thị mục: Mua sắm, Ký gửi, Thu mua, Tài chính<br>Nằm ngay trên phần Nhận tin ưu đãi<br>Định nghĩa trong \'Widget Nav Cat\''
                ),
                'Editable' => true,
                'InitValue' => '0',
                'FieldClass' => 'Normal',//'FlowField'
                'TableRelation' => array(
                    'Table' => 'QdWidgetNavCat',
                    'Field' => 'id',
                    'TableFilter' => array(/*array(
                            'Condition' => array(
                                'Field' => '',
                                'Type' => 'CONST',//'FIELD'
                                'Value' => ''
                            ),
                            'Field' => 'type',
                            'Type' => 'FIELD',
                            'Value' => QdPostCat::$TYPE_WIDGETNAV
                        )*/
                    )
                )
            ),
            'partnergrp_id' => array(
                'Name' => 'partnergrp_id',
                'Caption' => array('en-US' => 'Partner Group', 'vi-VN' => 'Nhóm Đối tác'),
                'DataType' => 'Code',
                'Numeric' => true,
                'Description' => array(
                    'vi-VN' => 'Chọn Banner để hiển thị Danh mục Đối tác<br>Nằm ngay trên Footer<br>Định nghĩa trong \'Widget Nav Cat\''
                ),
                'Editable' => true,
                'InitValue' => '0',
                'FieldClass' => 'Normal',//'FlowField'
                'TableRelation' => array(
                    'Table' => 'QdPartnerGrp',
                    'Field' => 'id',
                    'TableFilter' => array(/*array(
                            'Condition' => array(
                                'Field' => '',
                                'Type' => 'CONST',//'FIELD'
                                'Value' => ''
                            ),
                            'Field' => 'type',
                            'Type' => 'FIELD',
                            'Value' => QdPostCat::$TYPE_WIDGETNAV
                        )*/
                    )
                )
            ),
            'img_slider' => array(
                'Name' => 'img_slider',
                'Caption' => array('en-US' => 'Banner', 'vi-VN' => 'Banner'),
                'DataType' => 'Code',
                'Numeric' => true,
                'Description' => array(
                    'vi-VN' => 'Banner chính chạy chạy trên Trang chủ<br>Nằm ngay dưới Menu chính',
                    'en-US' => 'Main big Banner placed on Home Page'
                ),
                'Editable' => true,
                'InitValue' => '0',
                'FieldClass' => 'Normal',//'FlowField'
                'TableRelation' => array(
                    'Table' => 'QdImgGrp',
                    'Field' => 'id',
                    'TableFilter' => array(/*array(
                            'Condition' => array(
                                'Field' => '',
                                'Type' => 'CONST',//'FIELD'
                                'Value' => ''
                            ),
                            'Field' => 'type',
                            'Type' => 'FIELD',
                            'Value' => QdPostCat::$TYPE_WIDGETNAV
                        )*/
                    )
                )
            ),
            'social_icon' => array(
                'Name' => 'social_icon',
                'Caption' => array('en-US' => 'Social Icon', 'vi-VN' => 'Social Icon'),
                'DataType' => 'Code',
                'Numeric' => true,
                'Description' => array(
                    'vi-VN' => 'Chọn Widget Nav Cat để hiển thị kết nối mạng xã hội (cột thứ 4 trong Footer Menu)<br>Nằm ngay dưới phần Nhận tin ưu đãi<br>Định nghĩa trong \'Widget Nav Cat\''
                ),
                'Editable' => true,
                'InitValue' => '0',
                'FieldClass' => 'Normal',//'FlowField'
                'TableRelation' => array(
                    'Table' => 'QdWidgetNavCat',
                    'Field' => 'id',
                    'TableFilter' => array(/*array(
                            'Condition' => array(
                                'Field' => '',
                                'Type' => 'CONST',//'FIELD'
                                'Value' => ''
                            ),
                            'Field' => 'type',
                            'Type' => 'FIELD',
                            'Value' => QdPostCat::$TYPE_WIDGETNAV
                        )*/
                    )
                )
            ),
            'latest_product_label' => array(
                'Caption' => array('en-US' => 'Latest Product Label', 'vi-VN' => 'SP Mới nhất Label'),
                'Description' => array(
                    'vi-VN' => 'Cấu hình Label cho mục \'SP mới nhất\' ở trang chủ'
                ),
            ),
            'latest_product_segment' => array(
                'Caption' => array('en-US' => 'Latest Product Segment', 'vi-VN' => 'SL SP Mới nhất'),
                'Description' => array(
                    'vi-VN' => 'Cấu hình số lượng SP cần hiển thị cho mục \'SP mới nhất\' ở trang chủ'
                ),
            ),
            'bigsalecat_id' => array(
                'Name' => 'bigsalecat_id',
                'Caption' => array('en-US' => 'Big Sale', 'vi-VN' => 'Big Sale'),
                'DataType' => 'Code',
                'Numeric' => true,
                'Description' => '',
                'Editable' => true,
                'InitValue' => '0',
                'FieldClass' => 'Normal',//'FlowField'
                'TableRelation' => array(
                    'Table' => 'QdBigSaleCat',
                    'Field' => 'id',
                    'TableFilter' => array(
                        /*array(
                            'Field' => 'active',
                            'Type' => 'CONST',
                            'Value' => true
                        )
                        */
                    )
                )
            ),

        ));
    }

}