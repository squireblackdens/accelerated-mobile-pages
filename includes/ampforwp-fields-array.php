<?php 
global $amp_ux_fields;
$analytics_options = array();
$pages = get_pages();
foreach ($pages as $page ) {
	$options[$page->ID] = $page->post_title;
}
$analytics_options = array(''=>'Add Analytics Type','ampforwp-ga-switch'=>'Google Analytics','ampforwp-Segment-switch'=>'Segment Analytics','ampforwp-Piwik-switch'=>'Matomo (Piwik) Analytics','ampforwp-Quantcast-switch'=>'Quantcast Measurement','ampforwp-comScore-switch'=>'comScore', 'ampforwp-Effective-switch'=>'Effective Measure','ampforwp-StatCounter-switch'=>'StatCounter','ampforwp-Histats-switch'=>'Histats Analytics','ampforwp-Yandex-switch'=>'Yandex Metrika','ampforwp-Chartbeat-switch'=>'Chartbeat Analytics','ampforwp-Alexa-switch'=>'Alexa Metrics','ampforwp-afs-analytics-switch'=>'AFS Analytics','amp-fb-pixel'=>'Facebook Pixel','amp-clicky-switch'=>'Clicky Analytics');
$analytics_default_option = ampforwp_get_setting('amp-analytics-select-option');
$analytics_default = 'ampforwp-ga-switch';
switch ($analytics_default_option) {
	case '1': 
		$analytics_default = 'ampforwp-ga-switch';
		break;
	case '2': 
		$analytics_default = 'ampforwp-Segment-switch';
		break;
	case '3': 
		$analytics_default = 'ampforwp-Piwik-switch';
		break;
	case '4': 
		$analytics_default = 'ampforwp-Quantcast-switch';
		break;
	case '5': 
		$analytics_default = 'ampforwp-comScore-switch';
		break;
	case '6': 
		$analytics_default = 'ampforwp-Effective-switch';
		break;
	case '7': 
		$analytics_default = 'ampforwp-StatCounter-switch';
		break;
	case '8': 
		$analytics_default = 'ampforwp-Histats-switch';
		break;
	case '9': 
		$analytics_default = 'ampforwp-Yandex-switch';
		break;
	case '10': 
		$analytics_default = 'ampforwp-Chartbeat-switch';
		break;
	case '11': 
		$analytics_default = 'ampforwp-Alexa-switch';
		break;
	case '12': 
		$analytics_default = 'ampforwp-afs-analytics-switch';
		break;
	case '13': 
		$analytics_default = 'amp-fb-pixel';
		break;
	case '14': 
		$analytics_default = 'amp-clicky-switch';
		break;
	default:
		break;
}
 if ( ! function_exists('ampforwp_get_seo_default') ) {
        function ampforwp_get_seo_default() {
            $default = '';
            include_once( ABSPATH . 'wp-admin/includes/plugin.php' ); 
            if ( is_plugin_active('wordpress-seo/wp-seo.php') ) {
                $default = 'yoast';
            }
            elseif ( is_plugin_active('all-in-one-seo-pack/all_in_one_seo_pack.php') ) {
                $default = 'aioseo';
            }
            elseif ( defined( 'RANK_MATH_FILE' ) ) {
                $default = 'rank_math';
            }
            elseif ( function_exists('genesis_theme_support') ) {
                $default = 'genesis';
            }
            elseif ( is_plugin_active('wp-seopress/seopress.php') ) {
                $default = 'seopress';
            }
            elseif ( function_exists( 'the_seo_framework' ) ) {
                $default = 'seo_framework';
            }
            elseif ( class_exists('SQ_Classes_ObjController') ) {
                $default = 'squirrly';
            }elseif ( class_exists('Smartcrawl_Loader')){
                $default = 'smartcrawl';
            }
            return $default;
        }
    }
$structure_data_options =  array(
					                ''   			=> 'Select Option',
					                'BlogPosting'   => 'Blog',
					                'NewsArticle'   => 'News',
					                'Local Business' => 'Local Business',
					                'Product'       => 'Ecommerce',
					                'Other'       	=> 'Other'
					            );

$amp_ux_common = array(
						'field_type'=>'footer', 
						'field_data'=>array(
											array(
												'desc'=>"Send Feedback",
												'icon'=>'ux-send-feedback-icon',
												'url'=>'https://ampforwp.com/support/',
											),array(
												'desc'=>"Help",
												'icon'=>'ux-help-icon',
												'url'=>'https://ampforwp.com/tutorials/',
											),array(
												'desc'=>"Review",
												'icon'=>'ux-review-icon',
												'url'=>'https://wordpress.org/support/plugin/accelerated-mobile-pages/reviews/?rate=5#new-post',
											),
										)
					);

array_unshift($seo_options,"Select SEO");
$amp_ux_loader = array(
						'field_type'=>'loader', 
						'field_data'=>array('title'=>'','class'=>'','id'=>'','default'=>0)
					);
$amp_website_type = ampforwp_get_setting('ampforwp-setup-ux-website-type');
$amp_ws_other_type = '';
if(strpos("Other",$amp_website_type)){
	$other = explode("-", $amp_website_type);
	$amp_website_type=$other[0];
	$amp_ws_other_type = $other[1];
}
if($amp_website_type==""){
	$amp_website_type = "Other";
	$amp_ws_other_type = "WebPage";
}
function ampforwp_check_analytics_setup($type = ''){
	$analytics_txt = ampforwp_get_setup_info('ampforwp-ux-analytics-section');
	$check_analytics = explode(', ', $analytics_txt);
   	if(in_array($type, $check_analytics)){
   		return 1;
   	}else{
   		return 0;
   	}
}


$amp_ux_fields = array(
					array('field_type'=>'main_section_start', 'field_data'=>array('id'=>'amp-ux-main-section','class'=>'amp-ux-main-section')),
					$amp_ux_loader,
					// Website type 
					array('field_type'=>'section_start',
						'field_data'=>array('id'=>'ampforwp-ux-website-type-section','class'=>'section-1 amp-ux-website-type-section')
					),
					array('field_type'=>'select',
						'field_data'=>array('title'=>'What\'s your Website Type?','class'=>'ampforwp-ux-select','id'=>'ampforwp-ux-select','data-value'=>$amp_ws_other_type,'data-value-id'=>'ampforwp-website-type-other','options'=>$structure_data_options,'default'=>$amp_website_type)
					),
					$amp_ux_common,
					array('field_type'=>'section_end','field_data'=>array()),

					// AMP Need Section
				    array('field_type'=>'section_start',
				    	'field_data'=>array('id'=>'ampforwp-ux-need-type-section',
						'class'=>'section-2 amp-ux-need-section')
				    ),
				    array('field_type'=>'text',
						'field_data'=>array('title'=>'Where do you need AMP?','class'=>'ampforwp-ux-select emty-input','id'=>'ampforwp-ux-select')
					),
					array('field_type'=>'checkbox',
						'field_data'=>array('title'=>'Homepage','class'=>'amp-ux-homepage','id'=>'amp-ux-homepage','default'=>ampforwp_get_setting('ampforwp-homepage-on-off-support'))
					),
					array('field_type'=>'checkbox',
						'field_data'=>array('title'=>'FrontPage','class'=>'amp-ux-frontpage','id'=>'amp-ux-frontpage','required'=>array('amp-ux-homepage','=','1'),'default'=>ampforwp_get_setting('amp-frontpage-select-option'))
					),
					array('field_type'=>'select',
						'field_data'=>array('title'=>'Select Custom Front Page','class'=>'amp-ux-frontpage-select child_opt child_opt_arrow','id'=>'amp-ux-frontpage-select', 'options'=>$options, 'required'=>array('amp-ux-frontpage','=','1'),'element-class'=>'ux-label frp','default'=>ampforwp_get_setting('amp-frontpage-select-option-pages')
						)
					),
					array('field_type'=>'checkbox',
						'field_data'=>array('title'=>'Posts','class'=>'amp-ux-posts','id'=>'amp-ux-posts','default'=>ampforwp_get_setting('amp-on-off-for-all-posts'))
					),
					array('field_type'=>'checkbox',
						'field_data'=>array('title'=>'Pages','class'=>'amp-ux-pages','id'=>'amp-ux-pages','default'=>ampforwp_get_setting('amp-on-off-for-all-pages'))
					),
					array('field_type'=>'checkbox',
						'field_data'=>array('title'=>'Archives','class'=>'amp-ux-archives','id'=>'amp-ux-archives','default'=>ampforwp_get_setting('ampforwp-archive-support'))
					),
			
					$amp_ux_common ,
					array('field_type'=>'section_end','field_data'=>array()),

					// Design Section
					array('field_type'=>'section_start',
						'field_data'=>array('id'=>'ampforwp-ux-design-section','class'=>'section-1 ampforwp-ux-design-section')
					),
					array('field_type'=>'media',
						'field_data'=>array('title'=>'Setup Your Logo','class'=>'amp-ux-opt-media-container','id'=>'amp-ux-opt-media', 'default'=>array('id'=>ampforwp_get_setting('opt-media','id'),'url'=>ampforwp_get_setting('opt-media','url'),'width'=>ampforwp_get_setting('opt-media','width'),'height'=>ampforwp_get_setting('opt-media','height')))
					),
					array('field_type'=>'color',
						'field_data'=>array('title'=>'Global Color Scheme','class'=>'amp-ux-color-scheme','id'=>'amp-ux-color-scheme','default'=>ampforwp_get_setting('swift-color-scheme','color'))
					),
				
					$amp_ux_common ,
					array('field_type'=>'section_end', 'field_data'=>array()),

					//Analytics
					array('field_type'=>'section_start',
						'field_data'=>array('id'=>'ampforwp-ux-analytics-section','class'=>'section-1 ampforwp-ux-analytics-section')
					),
					array('field_type'=>'sub_section_start',
						'field_data'=>array('id'=>'ampforwp-ux-analytics-sub-section','class'=>'ampforwp-ux-sup-sub-section','default'=>1,'closable'=>0)
					),
					array('field_type'=>'heading',
					'field_data'=>array('title'=>'Setup Analytics Tracking','class'=>'child_opt child_opt_arrow')
					),
					array('field_type'=>'sub_section_start',
						'field_data'=>array('id'=>'ampforwp-ux-google-analytics-section','class'=>'ampforwp-ux-sub-section ampforwp-ux-ana-sub','default'=>1,'closable'=>1,'data-href'=>'ampforwp-ga-switch')
					),
					array('field_type'=>'heading',
					'field_data'=>array('title'=>'Google Analytics','class'=>'child_opt child_opt_arrow')
					),
					array('field_type'=>'text', 'field_data'=>array('title'=>'Tracking ID','id'=>'amp-ux-ga','class'=>'amp-ux-ga google-analytics analytics-text','required'=>array(),'data-text'=>'ga-feild','element-class'=>'ux-label trac-id','default'=>ampforwp_get_setting('ga-feild'))
					),
					array('field_type'=>'sub_section_end','field_data'=>array()),
					array('field_type'=>'sub_section_start',
						'field_data'=>array('id'=>'ampforwp-ux-segment-analytics-section','class'=>'ampforwp-ux-sub-section ampforwp-ux-ana-sub','default'=>ampforwp_check_analytics_setup('Segment Analytics'),'closable'=>1,'data-href'=>'ampforwp-Segment-switch')
					),
					array('field_type'=>'heading',
					'field_data'=>array('title'=>'Segment Analytics','class'=>'child_opt child_opt_arrow')
					),
					array('field_type'=>'text', 'field_data'=>array('title'=>'Segment Write Key','id'=>'amp-ux-sw','class'=>'amp-ux-sw analytics-text','required'=>array(),'data-text'=>'sa-feild','element-class'=>'ux-label trac-id','default'=>ampforwp_get_setting('sa-feild'))
					),
					array('field_type'=>'sub_section_end','field_data'=>array()),
					array('field_type'=>'sub_section_start',
						'field_data'=>array('id'=>'ampforwp-ux-piwik-analytics-section','class'=>'ampforwp-ux-sub-section ampforwp-ux-ana-sub','default'=>ampforwp_check_analytics_setup('Matomo Analytics'),'closable'=>1,'data-href'=>'ampforwp-Piwik-switch')
					),
					array('field_type'=>'heading',
					'field_data'=>array('title'=>'Matomo (Piwik) Analytics','class'=>'child_opt child_opt_arrow')
					),
					array('field_type'=>'text', 'field_data'=>array('title'=>'Tracking ID','id'=>'amp-ux-mp','class'=>'amp-ux-mp analytics-text','required'=>array(),'data-text'=>'pa-feild','element-class'=>'ux-label trac-id','default'=>ampforwp_get_setting('pa-feild'))
					),
					array('field_type'=>'sub_section_end','field_data'=>array()),
					array('field_type'=>'sub_section_start',
						'field_data'=>array('id'=>'ampforwp-ux-quantcast-analytics-section','class'=>'ampforwp-ux-sub-section ampforwp-ux-ana-sub','default'=>ampforwp_check_analytics_setup('Quantcast Measurement'),'closable'=>1,'data-href'=>'ampforwp-Quantcast-switch')
					),
					array('field_type'=>'heading',
					'field_data'=>array('title'=>'Quantcast Measurement','class'=>'child_opt child_opt_arrow')
					),
					array('field_type'=>'text', 'field_data'=>array('title'=>'Tracking ID','id'=>'amp-ux-qm','class'=>'amp-ux-qm analytics-text','element-class'=>'ux-label trac-id','required'=>array(),'data-text'=>'amp-quantcast-analytics-code','default'=>ampforwp_get_setting('amp-quantcast-analytics-code'))
					),
					array('field_type'=>'sub_section_end','field_data'=>array()),
					array('field_type'=>'sub_section_start',
						'field_data'=>array('id'=>'ampforwp-ux-comscore-analytics-section','class'=>'ampforwp-ux-sub-section ampforwp-ux-ana-sub','default'=>ampforwp_check_analytics_setup('comScore'),'closable'=>1,'data-href'=>'ampforwp-comScore-switch')
					),
					array('field_type'=>'heading',
					'field_data'=>array('title'=>'comScore','class'=>'child_opt child_opt_arrow')
					),
					array('field_type'=>'text', 'field_data'=>array('title'=>'C1','id'=>'amp-ux-cs-1','class'=>'amp-ux-cs analytics-text','element-class'=>'ux-label trac-id','required'=>array(),'data-text'=>'amp-comscore-analytics-code-c1','default'=>ampforwp_get_setting('amp-comscore-analytics-code-c1'))
					),
					array('field_type'=>'text', 'field_data'=>array('title'=>'C2','id'=>'amp-ux-cs-2','class'=>'amp-ux-cs analytics-text','required'=>array(),'element-class'=>'ux-label trac-id','data-text'=>'amp-comscore-analytics-code-c2','default'=>ampforwp_get_setting('amp-comscore-analytics-code-c2'))
					),
					array('field_type'=>'sub_section_end','field_data'=>array()),
					array('field_type'=>'sub_section_start',
						'field_data'=>array('id'=>'ampforwp-ux-effective-measure-analytics-section','class'=>'ampforwp-ux-sub-section ampforwp-ux-ana-sub','default'=>ampforwp_check_analytics_setup('Effective Measure'),'closable'=>1,'data-href'=>'ampforwp-Effective-switch')
					),
					array('field_type'=>'heading',
					'field_data'=>array('title'=>'Effective Measure','class'=>'child_opt child_opt_arrow')
					),
					array('field_type'=>'text', 'field_data'=>array('title'=>'Tracking ID','id'=>'amp-ux-em','class'=>'amp-ux-em analytics-text','required'=>array(),'data-text'=>'eam-feild','element-class'=>'ux-label trac-id','default'=>ampforwp_get_setting('eam-feild'))
					),
					array('field_type'=>'sub_section_end','field_data'=>array()),
					array('field_type'=>'sub_section_start',
						'field_data'=>array('id'=>'ampforwp-ux-sc-analytics-section','class'=>'ampforwp-ux-sub-section ampforwp-ux-ana-sub','default'=>ampforwp_check_analytics_setup('StatCounter'),'closable'=>1,'data-href'=>'ampforwp-StatCounter-switch')
					),
					array('field_type'=>'heading',
					'field_data'=>array('title'=>'StatCounter','class'=>'child_opt child_opt_arrow')
					),
					array('field_type'=>'text', 'field_data'=>array('title'=>'Tracking ID','id'=>'amp-ux-sc','class'=>'amp-ux-sc analytics-text','element-class'=>'ux-label trac-id','required'=>array(),'data-text'=>'sc-feild','default'=>ampforwp_get_setting('sc-feild'))
					),
					array('field_type'=>'sub_section_end','field_data'=>array()),
					array('field_type'=>'sub_section_start',
						'field_data'=>array('id'=>'ampforwp-ux-histats-analytics-section','class'=>'ampforwp-ux-sub-section ampforwp-ux-ana-sub','default'=>ampforwp_check_analytics_setup('Histats Analytics'),'closable'=>1,'data-href'=>'ampforwp-Histats-switch')
					),
					array('field_type'=>'heading',
					'field_data'=>array('title'=>'Histats Analytics','class'=>'child_opt child_opt_arrow')
					),
					array('field_type'=>'text', 'field_data'=>array('title'=>'Tracking ID','element-class'=>'ux-label trac-id','id'=>'amp-ux-ha','class'=>'amp-ux-ha analytics-text','required'=>array(),'data-text'=>'histats-field','default'=>ampforwp_get_setting('histats-field'))
					),
					array('field_type'=>'sub_section_end','field_data'=>array()),
					array('field_type'=>'sub_section_start',
						'field_data'=>array('id'=>'ampforwp-ux-yandex-analytics-section','class'=>'ampforwp-ux-sub-section ampforwp-ux-ana-sub','default'=>ampforwp_check_analytics_setup('Yandex Metrika'),'closable'=>1,'data-href'=>'ampforwp-Yandex-switch')
					),
					array('field_type'=>'heading',
					'field_data'=>array('title'=>'Yandex Metrika Analytics','class'=>'child_opt child_opt_arrow')
					),
					array('field_type'=>'text', 'field_data'=>array('title'=>'Yandex Metrika Analytics ID','id'=>'amp-ux-ym','class'=>'amp-ux-ym analytics-text','element-class'=>'ux-label trac-id','required'=>array(),'data-text'=>'amp-Yandex-Metrika-analytics-code','default'=>ampforwp_get_setting('amp-Yandex-Metrika-analytics-code'))
					),
					array('field_type'=>'sub_section_end','field_data'=>array()),
					array('field_type'=>'sub_section_start',
						'field_data'=>array('id'=>'ampforwp-ux-chartbeat-analytics-section','class'=>'ampforwp-ux-sub-section ampforwp-ux-ana-sub','default'=>ampforwp_check_analytics_setup('Chartbeat Analytics'),'closable'=>1,'data-href'=>'ampforwp-Chartbeat-switch')
					),
					array('field_type'=>'heading',
					'field_data'=>array('title'=>'Chartbeat Analytics','class'=>'child_opt child_opt_arrow')
					),
					array('field_type'=>'text', 'field_data'=>array('title'=>'Tracking ID','element-class'=>'ux-label trac-id','id'=>'amp-ux-ca','class'=>'amp-ux-ca analytics-text','required'=>array(),'data-text'=>'amp-Chartbeat-analytics-code','default'=>ampforwp_get_setting('amp-Chartbeat-analytics-code'))
					),
					array('field_type'=>'sub_section_end','field_data'=>array()),
					array('field_type'=>'sub_section_start',
						'field_data'=>array('id'=>'ampforwp-ux-alexa-analytics-section','class'=>'ampforwp-ux-sub-section ampforwp-ux-ana-sub','default'=>ampforwp_check_analytics_setup('Alexa Metrics'),'closable'=>1,'data-href'=>'ampforwp-Alexa-switch')
					),
					array('field_type'=>'heading',
					'field_data'=>array('title'=>'Alexa Metrics','class'=>'child_opt child_opt_arrow')
					),
					array('field_type'=>'text', 'field_data'=>array('title'=>'Alexa Metrics Account','id'=>'amp-ux-am-1','class'=>'amp-ux-am analytics-text','element-class'=>'ux-label trac-id','required'=>array(),'data-text'=>'ampforwp-alexa-account','default'=>ampforwp_get_setting('ampforwp-alexa-account'))
					),
					array('field_type'=>'text', 'field_data'=>array('title'=>'Alexa Metrics Domain','id'=>'amp-ux-am-2','class'=>'amp-ux-am analytics-text','element-class'=>'ux-label trac-id','required'=>array(),'data-text'=>'ampforwp-alexa-domain','default'=>ampforwp_get_setting('ampforwp-alexa-domain'))
					),
					array('field_type'=>'sub_section_end','field_data'=>array()),
					array('field_type'=>'sub_section_start',
						'field_data'=>array('id'=>'ampforwp-ux-afs-analytics-section','class'=>'ampforwp-ux-sub-section ampforwp-ux-ana-sub','default'=>ampforwp_check_analytics_setup('AFS Analytics'),'closable'=>1,'data-href'=>'ampforwp-afs-analytics-switch')
					),
					array('field_type'=>'heading',
					'field_data'=>array('title'=>'AFS Analytics','class'=>'child_opt child_opt_arrow')
					),
					array('field_type'=>'text', 'field_data'=>array('title'=>'Website ID','id'=>'amp-ux-afs','class'=>'amp-ux-afs analytics-text','required'=>array(),'element-class'=>'ux-label trac-id','data-text'=>'ampforwp-afs-siteid','default'=>ampforwp_get_setting('ampforwp-afs-siteid'))
					),
					array('field_type'=>'sub_section_end','field_data'=>array()),
						array('field_type'=>'sub_section_start',
						'field_data'=>array('id'=>'ampforwp-ux-fb-analytics-section','class'=>'ampforwp-ux-sub-section ampforwp-ux-ana-sub','default'=>ampforwp_check_analytics_setup('Facebook Pixel'),'closable'=>1,'data-href'=>'amp-fb-pixel')
					),
					array('field_type'=>'heading',
					'field_data'=>array('title'=>'Facebook Pixel','class'=>'child_opt child_opt_arrow')
					),
					array('field_type'=>'text', 'field_data'=>array('title'=>'Facebook Pixel ID','id'=>'amp-ux-fp','class'=>'amp-ux-fp analytics-text','required'=>array(),'data-text'=>'amp-fb-pixel-id','element-class'=>'ux-label trac-id','default'=>ampforwp_get_setting('amp-fb-pixel-id'))
					),
					array('field_type'=>'sub_section_end','field_data'=>array()),
					array('field_type'=>'sub_section_start',
						'field_data'=>array('id'=>'ampforwp-ux-cl-analytics-section','class'=>'ampforwp-ux-sub-section ampforwp-ux-ana-sub','default'=>ampforwp_check_analytics_setup('Clicky Analytics'),'closable'=>1,'data-href'=>'amp-clicky-switch')
					),
					array('field_type'=>'heading',
					'field_data'=>array('title'=>'Clicky Analytics','class'=>'child_opt child_opt_arrow')
					),
					array('field_type'=>'text', 'field_data'=>array('title'=>'Clicky Site ID','id'=>'amp-ux-cl','class'=>'amp-ux-cl analytics-text','required'=>array(),'element-class'=>'ux-label','data-text'=>'clicky-site-id','default'=>ampforwp_get_setting('clicky-site-id'))
					),
					array('field_type'=>'sub_section_end','field_data'=>array()),
					array('field_type'=>'sub_section_start',
						'field_data'=>array('id'=>'ampforwp-ux-ano-analytics-section','class'=>'ampforwp-ux-sub-section','default'=>1,'closable'=>0)
					),
					array('field_type'=>'select',
					'field_data'=>array('title'=>'Add more Analytics Tracking','class'=>'ampforwp-ux-analytics-more child_opt child_opt_arrow','id'=>'ampforwp-ux-analytics-more', 'options'=>$analytics_options,'default'=>'','data-href'=>'','element-class'=>'ux-more-analyt','data-href-id'=>'amp-ux-analytics-more-hidden')
					),
					array('field_type'=>'sub_section_end','field_data'=>array()),
					array('field_type'=>'sub_section_end','field_data'=>array()),
					$amp_ux_common,
					array('field_type'=>'section_end', 'field_data'=>array()),

					// Privacy Settings
					array('field_type'=>'section_start',
						'field_data'=>array('id'=>'ampforwp-ux-privacy-section','class'=>'section-1 ampforwp-ux-privacy-section')
					),
					array('field_type'=>'switch','field_data'=>array('title'=>'Cookie Notice Bar','id'=>'amp-ux-notice-switch','class'=>'amp-ux-notice-switch amp-ux-switch-on-off','data-id'=>'amp-ux-notice-switch','desc'=>'Cookie Bar allows you to discreetly inform visitors that your website uses cookies.','parent-class'=>'ux-notice-bar','default'=>ampforwp_get_setting('amp-enable-notifications'))
					),
					array('field_type'=>'switch','field_data'=>array('title'=>'GDPR','id'=>'amp-ux-gdpr-switch','class'=>'amp-ux-gdpr-switch amp-ux-switch-on-off','data-id'=>'amp-ux-gdpr-switch','desc'=>'Comply with European privacy regulations(GDPR). Recommended for EU Citizens.','parent-class'=>'ux-notice-bar','default'=>ampforwp_get_setting('amp-gdpr-compliance-switch'))
					),
					
					$amp_ux_common,
					array('field_type'=>'section_end', 'field_data'=>array()),

					 // 3rd Party
					 array('field_type'=>'section_start',
					 	'field_data'=>array('id'=>'ampforwp-ux-thirdparty-section','class'=>'section-1 ampforwp-ux-thirdparty-section')
					 ),
					 array('field_type'=>'heading',
					'field_data'=>array('title'=>'Compatibility Section','class'=>'child_opt child_opt_arrow')
					),
					 array('field_type'=>'select',
						'field_data'=>array('title'=>'SEO','class'=>'ampforwp-ux-select','id'=>'ampforwp-ux-seo-select','options'=>$seo_options,'element-class'=>'ux-align','default'=>ampforwp_get_seo_default())
					 ),
				);

$is_sdfwp = "not-exist";
$ampforwp_admin_url = admin_url();
$stdfwp_active_url = '';
$sd_default = 0;

if(file_exists(AMPFORWP_MAIN_PLUGIN_DIR."schema-and-structured-data-for-wp/structured-data-for-wp.php")){
	if(!is_plugin_active('schema-and-structured-data-for-wp/structured-data-for-wp.php')){
		$is_sdfwp = "inactive";
		$plugin_file = "schema-and-structured-data-for-wp/structured-data-for-wp.php";
		$stdfwp_active_url = ampforwp_wp_plugin_action_link( $plugin_file, 'activate' );

	}else{
		$is_sdfwp = "active";
		$stdfwp_active_url = $ampforwp_admin_url.'admin.php?page=structured_data_options&amp;tab=general&amp;reference=ampforwp';
		$sd_default = 2;
	}
}
$is_afwp = "not-exist";
$afwp_active_url = '';
$afwp_default = 0;
if(file_exists(AMPFORWP_MAIN_PLUGIN_DIR."ads-for-wp/ads-for-wp.php")){
	if(!is_plugin_active('ads-for-wp/ads-for-wp.php')){
		$is_afwp = "inactive";
		$plugin_file = "ads-for-wp/ads-for-wp.php";
		$afwp_active_url = ampforwp_wp_plugin_action_link( $plugin_file, 'activate' );
	}else{
		$is_afwp = "active";
		$afwp_active_url = $ampforwp_admin_url.'admin.php?page=adsforwp&amp;tab=general&amp;reference=ampforwp';
		$afwp_default = 2;
	}
}

$is_pwa = "not-exist";
$pwa_active_url = '';
$pwa_default = 0;
if(file_exists(AMPFORWP_MAIN_PLUGIN_DIR."pwa-for-wp/pwa-for-wp.php")){
	if(!is_plugin_active('pwa-for-wp/pwa-for-wp.php')){
		$is_pwa = "inactive";
		$plugin_file = "pwa-for-wp/pwa-for-wp.php";
		$pwa_active_url = ampforwp_wp_plugin_action_link( $plugin_file, 'activate' );
	}else{
		$is_pwa = "active";
		$pwa_active_url = $ampforwp_admin_url.'admin.php?page=pwaforwp&amp;reference=ampforwp';
		$pwa_default = 2;
	}
}

$sasd_class = "amp-ux-extension-switch amp-ux-switch-on-off ampforwp_install_ux_plugin $is_sdfwp";
$afwp_class = "amp-ux-extension-switch amp-ux-switch-on-off ampforwp_install_ux_plugin $is_afwp";
$pwa_class = "amp-ux-extension-switch amp-ux-switch-on-off ampforwp_install_ux_plugin $is_pwa";

$ux_secure = wp_create_nonce('verify_module');
$check_extension = ampforwp_get_setup_info('ampforwp_ux_extension_check');
$amp_ux_fields[] = array('field_type'=>'switch','field_data'=>array('title'=>"Structured Data",'id'=>"amp-ux-ext-ssd",'class'=>$sasd_class,'data-id'=>'amp-ux-ext-ssd-switch','desc'=>'','data-secure'=>$ux_secure,'element-class'=>'third-pp','parent-class'=>'ux-seo-blk','default'=>$sd_default,'data-url'=>esc_url($stdfwp_active_url)));

$amp_ux_fields[] = array('field_type'=>'notification', 'field_data'=>array('type'=>'notice','desc'=>'Please wait until process completes.','required'=>array('amp-ux-ext-ssd','=',0),'default'=>0));

$amp_ux_fields[] = array('field_type'=>'switch','field_data'=>array('title'=>"Ads for WP",'id'=>"amp-ux-ext-afwp",'class'=>$afwp_class,'data-id'=>'amp-ux-ext-afwp-switch','desc'=>'','data-secure'=>$ux_secure,'element-class'=>'third-pp','parent-class'=>'ux-seo-blk','default'=>$afwp_default,'data-url'=>esc_url($afwp_active_url)));

$amp_ux_fields[] = array('field_type'=>'notification', 'field_data'=>array('type'=>'notice','desc'=>'Please wait until process completes.','required'=>array('amp-ux-ext-afwp','=',0),'default'=>0));

$amp_ux_fields[] = array('field_type'=>'switch','field_data'=>array('title'=>"PWA for WP",'id'=>"amp-ux-ext-pwafwp",'class'=>$pwa_class,'data-id'=>'amp-ux-ext-pwafwp-switch','desc'=>'','data-secure'=>$ux_secure,'element-class'=>'third-pp','parent-class'=>'ux-seo-blk','default'=>$pwa_default,'data-url'=>esc_url($pwa_active_url)));

$amp_ux_fields[] = array('field_type'=>'notification', 'field_data'=>array('type'=>'notice','desc'=>'Please wait until process completes.','required'=>array('amp-ux-ext-pwafwp','=',0),'default'=>0));

for($ex=0;$ex<count($check_extension);$ex++){
	$active_ext = $check_extension[$ex];
	if($active_ext=="wpml"){
		$is_active = 0;
		if(function_exists('ampforwp_auto_add_amp_menu_link_insert_wpml') ){
			$is_active = 1;
		}
		$amp_ux_fields[] = array('field_type'=>'switch','field_data'=>array('title'=>"WPML for AMP",'id'=>"amp-ux-ext-wpml",'class'=>'amp-ux-extension-switch amp-ux-switch-on-off','data-id'=>'amp-ux-ext-wpml-switch','desc'=>'','data-secure'=>$ux_secure,'element-class'=>'third-pp','parent-class'=>'ux-seo-blk','default'=>$is_active)
		);
		if($is_active==0){
		$amp_ux_fields[] = array('field_type'=>'notification', 'field_data'=>array('type'=>'warning','desc'=>sprintf( 'This feature requires <a href="https://ampforwp.com/wpml-for-amp/" target="_blank">%s</a> extension. <a href="https://ampforwp.com/wpml-for-amp/" target="_blank">%s</a>',esc_html__('WPML for AMP extension','accelerated-mobile-pages' ),esc_html__('Click here for more info','accelerated-mobile-pages' )),'required'=>array('amp-ux-ext-wpml','=',0),'default'=>$is_active));
		}
	}
	if($active_ext=="ratings"){
		$is_active = 0;
		if(function_exists('the_amp_rating_rating_markup') ){
			$is_active = 1;
		}
		$amp_ux_fields[] = array('field_type'=>'switch','field_data'=>array('title'=>"Ratings for AMP",'id'=>"amp-ux-ext-star-ratings",'class'=>'amp-ux-extension-switch amp-ux-switch-on-off','data-id'=>'amp-ux-ext-star-ratings-switch','desc'=>'','data-secure'=>$ux_secure,'element-class'=>'third-pp','parent-class'=>'ux-seo-blk','default'=>$is_active)
		);
		if($is_active==0){
		$amp_ux_fields[] = array('field_type'=>'notification', 'field_data'=>array('type'=>'warning','desc'=>sprintf( 'This feature requires <a href="https://ampforwp.com/amp-ratings/" target="_blank">%s</a> extension. <a href="https://ampforwp.com/amp-ratings/" target="_blank">%s</a>',esc_html__('Ratings for AMP extension','accelerated-mobile-pages' ),esc_html__('Click here for more info','accelerated-mobile-pages' )),'required'=>array('amp-ux-ext-star-ratings','=',0),'default'=>$is_active));
		}
	}
	if($active_ext=="elementor"){
		$is_active = 0;
		if(function_exists('amp_pagebuilder_compatibility_init') ){
			$is_active = 1;
		}
		$amp_ux_fields[] = array('field_type'=>'switch','field_data'=>array('title'=>"Elementor for AMP",'id'=>"amp-ux-ext-elementor",'class'=>'amp-ux-extension-switch amp-ux-switch-on-off','data-id'=>'amp-ux-ext-elementor-ratings-switch','desc'=>'','data-secure'=>$ux_secure,'element-class'=>'third-pp','parent-class'=>'ux-seo-blk','default'=>$is_active)
		);
		if($is_active==0){
		$amp_ux_fields[] = array('field_type'=>'notification', 'field_data'=>array('type'=>'warning','desc'=>sprintf( 'This feature requires <a href="https://ampforwp.com/amp-pagebuilder-compatibility/" target="_blank">%s</a> extension. <a href="https://ampforwp.com/amp-pagebuilder-compatibility/" target="_blank">%s</a>',esc_html__('Elementor & Divi support for AMP extension','accelerated-mobile-pages' ),esc_html__('Click here for more info','accelerated-mobile-pages' )),'required'=>array('amp-ux-ext-elementor','=',0),'default'=>$is_active));
		}
	}
	if($active_ext=="classipress"){
		$is_active = 0;
		if(function_exists('amp_classi_press_compatibility') ){
			$is_active = 1;
		}
		$amp_ux_fields[] = array('field_type'=>'switch','field_data'=>array('title'=>"Classipress",'id'=>"amp-ux-ext-classipress",'class'=>'amp-ux-extension-switch amp-ux-switch-on-off','data-id'=>'amp-ux-ext-classipress-switch','desc'=>'','data-secure'=>$ux_secure,'element-class'=>'third-pp','parent-class'=>'ux-seo-blk','default'=>$is_active)
		);
		if($is_active==0){
		$amp_ux_fields[] = array('field_type'=>'notification', 'field_data'=>array('type'=>'warning','desc'=>sprintf( 'This feature requires <a href="https://ampforwp.com/classipress-for-amp/" target="_blank">%s</a> extension. <a href="https://ampforwp.com/classipress-for-amp/" target="_blank">%s</a>',esc_html__('Classipress Theme for AMP extension','accelerated-mobile-pages' ),esc_html__('Click here for more info','accelerated-mobile-pages' )),'required'=>array('amp-ux-ext-classipress','=',0),'default'=>$is_active));
		}
	}
	if($active_ext=="eventcalendar"){
		$is_active = 0;
		if(function_exists('tec_amp_compatibility_orgs_venues_support') ){
			$is_active = 1;
		}
		$amp_ux_fields[] = array('field_type'=>'switch','field_data'=>array('title'=>"The Event Calender",'id'=>"amp-ux-ext-eventcalendar",'class'=>'amp-ux-extension-switch amp-ux-switch-on-off','data-id'=>'amp-ux-ext-eventcalendar-switch','desc'=>'','data-secure'=>$ux_secure,'element-class'=>'third-pp','parent-class'=>'ux-seo-blk','default'=>$is_active)
		);
		if($is_active==0){
		$amp_ux_fields[] = array('field_type'=>'notification', 'field_data'=>array('type'=>'warning','desc'=>sprintf( 'This feature requires <a href="https://ampforwp.com/addons/the-event-calender-for-amp/" target="_blank">%s</a> extension. <a href="https://ampforwp.com/addons/the-event-calender-for-amp/" target="_blank">%s</a>',esc_html__('The Event Calender for AMP extension','accelerated-mobile-pages' ),esc_html__('Click here for more info','accelerated-mobile-pages' )),'required'=>array('amp-ux-ext-eventcalendar','=',0),'default'=>$is_active));
		}
	}
	if($active_ext=="gravityform"){
		$is_active = 0;
		if(function_exists('amp_gravity_forms_plugin_init') ){
			$is_active = 1;
		}
		$amp_ux_fields[] = array('field_type'=>'switch','field_data'=>array('title'=>"Gravity Form",'id'=>"amp-ux-ext-gravityform",'class'=>'amp-ux-extension-switch amp-ux-switch-on-off','data-id'=>'amp-ux-ext-gravityform-switch','desc'=>'','data-secure'=>$ux_secure,'element-class'=>'third-pp','parent-class'=>'ux-seo-blk','default'=>$is_active)
		);
		if($is_active==0){
		$amp_ux_fields[] = array('field_type'=>'notification', 'field_data'=>array('type'=>'warning','desc'=>sprintf( 'This feature requires <a href="https://ampforwp.com/gravity-forms/" target="_blank">%s</a> extension. <a href="https://ampforwp.com/gravity-forms/" target="_blank">%s</a>',esc_html__('Gravity Form extension','accelerated-mobile-pages' ),esc_html__('Click here for more info','accelerated-mobile-pages' )),'required'=>array('amp-ux-ext-gravityform','=',0),'default'=>$is_active));
		}
	}
	if($active_ext=="contact_form_7"){
		$is_active = 0;
		if(function_exists('amp_cf7_plugin_init') ){
			$is_active = 1;
		}
		$amp_ux_fields[] = array('field_type'=>'switch','field_data'=>array('title'=>"Contact Form 7",'id'=>"amp-ux-ext-contact-form7",'class'=>'amp-ux-extension-switch amp-ux-switch-on-off','data-id'=>'amp-ux-ext-contact-form7-switch','desc'=>'','data-secure'=>$ux_secure,'element-class'=>'third-pp','parent-class'=>'ux-seo-blk','default'=>$is_active)
		);
		if($is_active==0){
		$amp_ux_fields[] = array('field_type'=>'notification', 'field_data'=>array('type'=>'warning','desc'=>sprintf( 'This feature requires <a href="https://ampforwp.com/contact-form-7/" target="_blank">%s</a> extension. <a href="https://ampforwp.com/contact-form-7/" target="_blank">%s</a>',esc_html__('Contact Form 7 extension','accelerated-mobile-pages' ),esc_html__('Click here for more info','accelerated-mobile-pages' )),'required'=>array('amp-ux-ext-contact-form7','=',0),'default'=>$is_active));
		}
	}
	if($active_ext=="ninja_forms"){
		$is_active = 0;
		if(function_exists('ampforwp_ninja_initiate_plugin') ){
			$is_active = 1;
		}
		$amp_ux_fields[] = array('field_type'=>'switch','field_data'=>array('title'=>"Ninja Form",'id'=>"amp-ux-ext-ninja-form",'class'=>'amp-ux-extension-switch amp-ux-switch-on-off','data-id'=>'amp-ux-ext-ninja-form-switch','desc'=>'','data-secure'=>$ux_secure,'element-class'=>'third-pp','parent-class'=>'ux-seo-blk','default'=>$is_active)
		);
		if($is_active==0){
		$amp_ux_fields[] = array('field_type'=>'notification', 'field_data'=>array('type'=>'warning','desc'=>sprintf( 'This feature requires <a href="https://ampforwp.com/ninja-forms/" target="_blank">%s</a> extension. <a href="https://ampforwp.com/ninja-forms/" target="_blank">%s</a>',esc_html__('Ninja Forms extension','accelerated-mobile-pages' ),esc_html__('Click here for more info','accelerated-mobile-pages' )),'required'=>array('amp-ux-ext-ninja-form','=',0),'default'=>$is_active));
		}
	}
	if($active_ext=="caldera_forms"){
		$is_active = 0;
		if(function_exists('amp_cf_plugin_init') ){
			$is_active = 1;
		}
		$amp_ux_fields[] = array('field_type'=>'switch','field_data'=>array('title'=>"Caldera Forms",'id'=>"amp-ux-ext-caldera-form",'class'=>'amp-ux-extension-switch amp-ux-switch-on-off','data-id'=>'amp-ux-ext-caldera-form-switch','desc'=>'','data-secure'=>$ux_secure,'element-class'=>'third-pp','parent-class'=>'ux-seo-blk','default'=>$is_active)
		);
		if($is_active==0){
		$amp_ux_fields[] = array('field_type'=>'notification', 'field_data'=>array('type'=>'warning','desc'=>sprintf( 'This feature requires <a href="https://ampforwp.com/caldera-forms-for-amp/" target="_blank">%s</a> extension. <a href="https://ampforwp.com/caldera-forms-for-amp/" target="_blank">%s</a>',esc_html__('Caldera Forms for AMP extension','accelerated-mobile-pages' ),esc_html__('Click here for more info','accelerated-mobile-pages' )),'required'=>array('amp-ux-ext-caldera-form','=',0),'default'=>$is_active));
		}
	}
	if($active_ext=="wpforms"){
		$is_active = 0;
		if(function_exists('ampforwp_wpforms_forms_shortcode') ){
			$is_active = 1;
		}
		$amp_ux_fields[] = array('field_type'=>'switch','field_data'=>array('title'=>"WP Forms",'id'=>"amp-ux-ext-wp-form",'class'=>'amp-ux-extension-switch amp-ux-switch-on-off','data-id'=>'amp-ux-ext-wp-form-switch','desc'=>'','data-secure'=>$ux_secure,'element-class'=>'third-pp','parent-class'=>'ux-seo-blk','default'=>$is_active)
		);
		if($is_active==0){
		$amp_ux_fields[] = array('field_type'=>'notification', 'field_data'=>array('type'=>'warning','desc'=>sprintf( 'This feature requires <a href="https://ampforwp.com/wp-forms/" target="_blank">%s</a> extension. <a href="https://ampforwp.com/wp-forms/" target="_blank">%s</a>',esc_html__('WP Forms for AMP extension','accelerated-mobile-pages' ),esc_html__('Click here for more info','accelerated-mobile-pages' )),'required'=>array('amp-ux-ext-wp-form','=',0),'default'=>$is_active));
		}
	}
	if($active_ext=="woocommerce"){
		$is_active = 0;
		if(function_exists('amp_woocommerce_pro_add_woocommerce_support') ){
			$is_active = 1;
		}
		$amp_ux_fields[] = array('field_type'=>'switch','field_data'=>array('title'=>"WooCommerce",'id'=>"amp-ux-ext-woocommerce",'class'=>'amp-ux-extension-switch amp-ux-switch-on-off','data-id'=>'amp-ux-ext-woocommerce-switch','desc'=>'','data-secure'=>$ux_secure,'element-class'=>'third-pp','parent-class'=>'ux-seo-blk','default'=>$is_active)
		);
		if($is_active==0){
		$amp_ux_fields[] = array('field_type'=>'notification', 'field_data'=>array('type'=>'warning','desc'=>sprintf( 'This feature requires <a href="https://ampforwp.com/woocommerce/" target="_blank">%s</a> extension. <a href="https://ampforwp.com/woocommerce/" target="_blank">%s</a>',esc_html__('AMP WooCommerce PRO extension','accelerated-mobile-pages' ),esc_html__('Click here for more info','accelerated-mobile-pages' )),'required'=>array('amp-ux-ext-woocommerce','=',0),'default'=>$is_active));
		}
	}
	if($active_ext=="easy_digital_downloads"){
		$is_active = 0;
		if(function_exists('amp_edd_post_support')){
			$is_active = 1;
		}
		$amp_ux_fields[] = array('field_type'=>'switch','field_data'=>array('title'=>"Easy Digital Downloads",'id'=>"amp-ux-ext-edd",'class'=>'amp-ux-extension-switch amp-ux-switch-on-off','data-id'=>'amp-ux-ext-edd-switch','desc'=>'','data-secure'=>$ux_secure,'element-class'=>'third-pp','parent-class'=>'ux-seo-blk','default'=>$is_active)
		);
		if($is_active==0){
		$amp_ux_fields[] = array('field_type'=>'notification', 'field_data'=>array('type'=>'warning','desc'=>sprintf( 'This feature requires <a href="https://ampforwp.com/edd-for-amp/" target="_blank">%s</a> extension. <a href="https://ampforwp.com/edd-for-amp/" target="_blank">%s</a>',esc_html__('EDD for AMP extension','accelerated-mobile-pages' ),esc_html__('Click here for more info','accelerated-mobile-pages' )),'required'=>array('amp-ux-ext-edd','=',0),'default'=>$is_active));
		}
	}
	if($active_ext=="polylang"){
		$is_active = 0;
		if(function_exists('amp_polylang_plugin_updater')){
			$is_active = 1;
		}
		$amp_ux_fields[] = array('field_type'=>'switch','field_data'=>array('title'=>"Polylan",'id'=>"amp-ux-ext-polylang",'class'=>'amp-ux-extension-switch amp-ux-switch-on-off','data-id'=>'amp-ux-ext-polylang-switch','desc'=>'','data-secure'=>$ux_secure,'element-class'=>'third-pp','parent-class'=>'ux-seo-blk','default'=>$is_active)
		);
		if($is_active==0){
		$amp_ux_fields[] = array('field_type'=>'notification', 'field_data'=>array('type'=>'warning','desc'=>sprintf( 'This feature requires <a href="https://ampforwp.com/polylang-for-amp/" target="_blank">%s</a> extension. <a href="https://ampforwp.com/polylang-for-amp/" target="_blank">%s</a>',esc_html__('Polylang for AMP extension','accelerated-mobile-pages' ),esc_html__('Click here for more info','accelerated-mobile-pages' )),'required'=>array('amp-ux-ext-polylang','=',0),'default'=>$is_active));
		}
	}
	if($active_ext=="bbpress"){
		$is_active = 0;
		if(function_exists('amp_bbpress_plugin_updater')){
			$is_active = 1;
		}
		$amp_ux_fields[] = array('field_type'=>'switch','field_data'=>array('title'=>"bbPress",'id'=>"amp-ux-ext-bbpress",'class'=>'amp-ux-extension-switch amp-ux-switch-on-off','data-id'=>'amp-ux-ext-bbpress-switch','desc'=>'','data-secure'=>$ux_secure,'element-class'=>'third-pp','parent-class'=>'ux-seo-blk','default'=>$is_active)
		);
		if($is_active==0){
		$amp_ux_fields[] = array('field_type'=>'notification', 'field_data'=>array('type'=>'warning','desc'=>sprintf( 'This feature requires <a href="https://ampforwp.com/bbpress/" target="_blank">%s</a> extension. <a href="https://ampforwp.com/bbpress/" target="_blank">%s</a>',esc_html__('bbPress for AMP extension','accelerated-mobile-pages' ),esc_html__('Click here for more info','accelerated-mobile-pages' )),'required'=>array('amp-ux-ext-bbpress','=',0),'default'=>$is_active));
		}
	}
	if($active_ext=="shortcodes"){
		$is_active = 0;
		if(function_exists('amp_su_shortcodes_ulitmate_notices')){
			$is_active = 1;
		}
		$amp_ux_fields[] = array('field_type'=>'switch','field_data'=>array('title'=>"Shortcode",'id'=>"amp-ux-ext-shortcodes",'class'=>'amp-ux-extension-switch amp-ux-switch-on-off','data-id'=>'amp-ux-ext-shortcodes-switch','desc'=>'','data-secure'=>$ux_secure,'element-class'=>'third-pp','parent-class'=>'ux-seo-blk','default'=>$is_active)
		);
		if($is_active==0){
		$amp_ux_fields[] = array('field_type'=>'notification', 'field_data'=>array('type'=>'warning','desc'=>sprintf( 'This feature requires <a href="https://ampforwp.com/shortcodes-ultimate/" target="_blank">%s</a> extension. <a href="https://ampforwp.com/shortcodes-ultimate/" target="_blank">%s</a>',esc_html__('Shortcodes Ultimate for AMP extension','accelerated-mobile-pages' ),esc_html__('Click here for more info','accelerated-mobile-pages' )),'required'=>array('amp-ux-ext-shortcodes','=',0),'default'=>$is_active));
		}
	}
	if($active_ext=="toc"){
		$is_active = 0;
		if(function_exists('toc_amp_initiate')){
			$is_active = 1;
		}
		$amp_ux_fields[] = array('field_type'=>'switch','field_data'=>array('title'=>"Table of content",'id'=>"amp-ux-ext-toc",'class'=>'amp-ux-extension-switch amp-ux-switch-on-off','data-id'=>'amp-ux-ext-toc-switch','desc'=>'','data-secure'=>$ux_secure,'element-class'=>'third-pp','parent-class'=>'ux-seo-blk','default'=>$is_active)
		);
		if($is_active==0){
		$amp_ux_fields[] = array('field_type'=>'notification', 'field_data'=>array('type'=>'warning','desc'=>sprintf( 'This feature requires <a href="https://ampforwp.com/table-of-contents-plus/" target="_blank">%s</a> extension. <a href="https://ampforwp.com/table-of-contents-plus/" target="_blank">%s</a>',esc_html__('Table of Content Plus for AMP extension','accelerated-mobile-pages' ),esc_html__('Click here for more info','accelerated-mobile-pages' )),'required'=>array('amp-ux-ext-toc','=',0),'default'=>$is_active));
		}
	}
	if($active_ext=="liveblog"){
		$is_active = 0;
		if(function_exists('liveblogforamp_plugin_updater')){
			$is_active = 1;
		}
		$amp_ux_fields[] = array('field_type'=>'switch','field_data'=>array('title'=>"LiveBlog",'id'=>"amp-ux-ext-lb",'class'=>'amp-ux-extension-switch amp-ux-switch-on-off','data-id'=>'amp-ux-ext-lb-switch','desc'=>'','data-secure'=>$ux_secure,'element-class'=>'third-pp','parent-class'=>'ux-seo-blk','default'=>$is_active)
		);
		if($is_active==0){
		$amp_ux_fields[] = array('field_type'=>'notification', 'field_data'=>array('type'=>'warning','desc'=>sprintf( 'This feature requires <a href="https://ampforwp.com/addons/liveblog-for-amp/" target="_blank">%s</a> extension. <a href="https://ampforwp.com/addons/liveblog-for-amp/" target="_blank">%s</a>',esc_html__('LiveBlog for AMP extension','accelerated-mobile-pages' ),esc_html__('Click here for more info','accelerated-mobile-pages' )),'required'=>array('amp-ux-ext-lb','=',0),'default'=>$is_active));
		}
	}
}
array_push($amp_ux_fields, $amp_ux_common);
$close_extenstion = array('field_type'=>'section_end', 'field_data'=>array());
$close_field = array('field_type'=>'main_section_end','field_data'=>array());
array_push($amp_ux_fields, $close_extenstion);
array_push($amp_ux_fields, $close_field);
