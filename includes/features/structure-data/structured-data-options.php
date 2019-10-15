<?php
use ReduxCore\ReduxFramework\Redux;
    //Get options for Structured Data Type
    if( !function_exists('ampforwp_get_sd_types') ){
        function ampforwp_get_sd_types(){
            $options = array();
            $options = array(
                'BlogPosting'   => 'BlogPosting',
                'NewsArticle'   => 'NewsArticle',
                'Recipe'        => 'Recipe',
                'Product'       => 'Product',
                'VideoObject'   => 'VideoObject',
                'Article'       => 'Article',
                'WebPage'       => 'WebPage'
            );
            return $options;
        }
    }
 

add_filter('ampforwp_sd_custom_fields', 'ampforwp_add_sd_fields');
function ampforwp_add_sd_fields($fields){ 
    if( is_plugin_active('structured-data-for-wp/structured-data-for-wp.php') ) {
           $fields[] = array(
                       'id' => 'amp-cf7-SSL-info',
                       'type' => 'info',
                       'desc' =>"<div style='background: #FFF9C4;padding: 12px;line-height: 1.6;margin:-30px -14px -18px -17px;'><span style='color:#303F9F;'> Note: </span> Structure data Extension is activated, you can setup the <a href=".admin_url( 'admin.php?page=structured_data_options&tab=5' )." target='_blank' >Schema Type Here</a></div>"
                   );

           return $fields;
    }
    else {
        
             $fields[] =    array(
                                'id' => 'ampforwp-sd_modules_section',
                                'type' => 'section',
                                'title' => esc_html__('Structured Data has been Improved!', 'accelerated-mobile-pages'),
                                'indent' => true,
                                'layout_type' => 'accordion',
                                'accordion-open'=> 1, 
                            );
                $fields[] =   array(
                          'id'       => 'ampforwp-sd-module',
                          'type'     => 'raw',
                          'content'  => '<div class="ampforwp-st-data-update">
                                                '.(!is_plugin_active('schema-and-structured-data-for-wp/structured-data-for-wp.php')? 'New Update available for Structured data:': 'Thank you for upgrading the Structured data').'
                                                <div class="row">
                                                    
                                                        '.(!is_plugin_active('schema-and-structured-data-for-wp/structured-data-for-wp.php')? '
                                                        <div class="col-3"><ul>
                                                            <li>Add Unlimited Schemas</li>
                                                            <li>New Schema Types</li>
                                                            <li>Advanced Structured data options</li>
                                                        </ul> </div>' : '')
                                                    .'
                                                    <div class="col-1">
                                                        '.(!is_plugin_active('schema-and-structured-data-for-wp/structured-data-for-wp.php')? 
                                                            '
                                <div class="install-now ampforwp-activation-call-module-upgrade button  " id="ampforwp-structure-data-activation-call" data-secure="'.wp_create_nonce('verify_module').'">
                                    <p>Upgrade for Free</p>
                                </div>' :
                                                            '<a href="'.admin_url('admin.php?page=structured_data_options&tab=general&reference=ampforwp').'"><div class="ampforwp-recommendation-btn updated-message"><p>Go to Structure Data settings</p></div></a>'
                                                        )
                                                        .'
                                                         &nbsp;<a href="https://ampforwp.com/tutorials/article/what-is-the-structured-data-update-all-about/" class="amp_recommend_learnmore" target="_blank">Learn more</a>
                                                    </div>
                                            </div>' 
                                            
                );
        if( !is_plugin_active('schema-and-structured-data-for-wp/structured-data-for-wp.php') ) {
                $fields[] =         array(
                      'id' => 'ampforwp-sd_1',
                      'type' => 'section',
                      'title' => esc_html__('Schema & Structured Data', 'accelerated-mobile-pages'),
                      'indent' => true,
                      'layout_type' => 'accordion',
                        'accordion-open'=> 1, 
                  );
                $fields[] =   array(
                              'id'       => 'ampforwp-sd-type-posts',
                              'type'     => 'select',
                              'title'    => esc_html__('Posts', 'accelerated-mobile-pages'),
                              'tooltip-subtitle' => esc_html__('Select the Structured Data Type for Posts', 'accelerated-mobile-pages'),
                              'options'  => ampforwp_get_sd_types(),
                              'default'  => 'BlogPosting',
                    );
                $fields[] =   array(
                              'id'       => 'ampforwp-sd-type-pages',
                              'type'     => 'select',
                              'title'    => esc_html__('Pages', 'accelerated-mobile-pages'),
                              'tooltip-subtitle' => esc_html__('Select the Structured Data Type for Pages', 'accelerated-mobile-pages'),
                              'options'  =>  ampforwp_get_sd_types(),
                              'default'  => 'BlogPosting',
                    );
                  $fields[] = array(
                              'id' => 'ampforwp-sd_2',
                              'type' => 'section',
                              'title' => esc_html__('Default Values Setup', 'accelerated-mobile-pages'),
                              'indent' => true,
                              'layout_type' => 'accordion',
                                'accordion-open'=> 1, 
                          );

                $fields[] =   array(
                              'id'       => 'amp-structured-data-logo',
                              'type'     => 'media',
                              'url'      => true,
                              'title'    => esc_html__('Default Structured Data Logo', 'accelerated-mobile-pages'),
                              'tooltip-subtitle' => esc_html__('Upload the logo you want to show in Google Structured Data. ', 'accelerated-mobile-pages'),
                               'default' => array('url' => ampforwp_default_logo_settings() ),
                    );
                $fields[] =   array(
                              'id'       => 'ampforwp-sd-logo-dimensions',
                              'title'    => esc_html__('Custom Logo Size', 'accelerated-mobile-pages'),
                              'type'     => 'switch',
                              'default'  => 0,
                    );
                $fields[] =   array(
                            'class'=>'child_opt child_opt_arrow',
                              'id'       => 'ampforwp-sd-logo-width',
                              'type'     => 'text',
                              'title'    => esc_html__('Logo Width', 'accelerated-mobile-pages'),
                              'tooltip-subtitle'    => esc_html__('Default width is 600 pixels', 'accelerated-mobile-pages'),
                              'default' => '600',
                              'required'=>array('ampforwp-sd-logo-dimensions','=','1'),
                    );
                $fields[] =   array(
                            'class'=>'child_opt',
                            'id'       => 'ampforwp-sd-logo-height',
                            'type'     => 'text',
                            'title'    => esc_html__('Logo Height', 'accelerated-mobile-pages'),
                            'tooltip-subtitle'    => esc_html__('Default height is 60 pixels', 'accelerated-mobile-pages'),
                            'default' => '60',
                            'required'=>array('ampforwp-sd-logo-dimensions','=','1'),
                    );
                $fields[] =   array(
                              'id'      => 'amp-structured-data-placeholder-image',
                              'type'    => 'media',
                              'url'     => true,
                              'title'   => esc_html__('Default Post Image', 'accelerated-mobile-pages'),
                              'tooltip-subtitle'    => esc_html__('Upload the Image you want to show as Placeholder Image.', 'accelerated-mobile-pages'),
                              'placeholder'  => esc_html__('when there is no featured image set in the post','accelerated-mobile-pages'),
                              'default' => array('url' => AMPFORWP_IMAGE_DIR . '/SD-default-image.png' ),
                    );
                $fields[] =   array(
                              'id'       => 'amp-structured-data-placeholder-image-width',
                              'title'    => esc_html__('Default Post Image Width', 'accelerated-mobile-pages'),
                              'type'     => 'text',
                              'placeholder' => '550',
                              'tooltip-subtitle' => esc_html__('Please don\'t add "PX" in the image size.','accelerated-mobile-pages'),
                              'default'  => '1280'
                    );
                $fields[] =   array(
                              'id'       => 'amp-structured-data-placeholder-image-height',
                              'title'    => esc_html__('Default Post Image Height', 'accelerated-mobile-pages'),
                              'type'     => 'text',
                              'placeholder' => '350',
                              'tooltip-subtitle' => esc_html__('Please don\'t add "PX" in the image size.','accelerated-mobile-pages'),
                              'default'  => '720'
                     );
                $fields[] =   array(
                              'id'      => 'amporwp-structured-data-video-thumb-url',
                              'type'    => 'media',
                              'url'     => true,
                              'title'   => esc_html__('Default Thumbnail for VideoObject', 'accelerated-mobile-pages'),
                              'tooltip-subtitle'    => esc_html__('Upload the Thumbnail you want to show as Video Thumbnail.', 'accelerated-mobile-pages'),
                              'placeholder'  => esc_html__('When there is no thumbnail set for the video','accelerated-mobile-pages'),
                              'default' => array('url' => AMPFORWP_IMAGE_DIR . '/SD-default-image.png' ),
                    );
                $fields[] =   array(  
                              'id'       => 'ampforwp-sd-multiple-images',  
                              'title'    => esc_html__('High-resolution Images', 'accelerated-mobile-pages'), 
                              'type'     => 'switch', 
                              'default'  => 0,  
                              'tooltip-subtitle' => esc_html__('For best results, provide multiple high-resolution images (minimum of 800,000 pixels when multiplying width and height) with the following aspect ratios: 16x9, 4x3, and 1x1 ', 'accelerated-mobile-pages'). '<a href="https://developers.google.com/search/docs/data-types/article#article_types" target="_blank">'.esc_html__('Read more','accelerated-mobile-pages').'</a>' 
                    );
        }// is_plugin_active('schema-and-structured-data-for-wp/structured-data-for-wp.php') Closed
          
    return $fields;
    }
}
if( ! is_plugin_active('structured-data-for-wp/structured-data-for-wp.php') ) {
    add_filter('ampforwp_sd_custom_fields', 'ampforwp_add_extra_fields');
    function ampforwp_add_extra_fields($fields){
        $post_types = '';
        $custom_fields = array();
        $extra_fields = array();
        $post_types = get_option('ampforwp_custom_post_types');
        if($post_types){
            foreach ($post_types as $post_type) {
                if( $post_type == 'post' || $post_type == 'page' ) {
                            continue;
                }
                $custom_fields[] = array(
                  'id'       => 'ampforwp-sd-type-'. $post_type,
                  'type'     => 'select',
                  'title'    => __($post_type, 'accelerated-mobile-pages'),
                  'tooltip-subtitle' => __('Select the Structured Data Type for '.$post_type, 'accelerated-mobile-pages'),
                  'options'  =>  ampforwp_get_sd_types(),
                  'default'  => 'BlogPosting',
                );
                $extra_fields = array_merge($extra_fields, $custom_fields);
            }
        }
        array_splice($fields, 5, 0,  $extra_fields);
        return $fields;
     }
}

// Structured Data
function ampforwp_structure_data_options($opt_name){
    Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Structured Data', 'accelerated-mobile-pages' ),
        'id'         => 'opt-structured-data',
        'subsection' => true,
        'fields'     => apply_filters('ampforwp_sd_custom_fields', $fields = array()
        ),
    ) );
}