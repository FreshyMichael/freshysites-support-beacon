<?php
if ( ! defined( 'ABSPATH' ) ) {
	die();
}

class FreshySites_Support_Plugin {

    public function __construct() {
    	// Hook into the admin menu
    	add_action( 'admin_menu', array( $this, 'create_plugin_settings_page' ) );
		//add_action( 'admin_menu', array( $this, 'create_plugin_kb_page' ) );

        // Add Settings and Fields
    	add_action( 'admin_init', array( $this, 'setup_sections' ) );
    	add_action( 'admin_init', array( $this, 'setup_fields' ) );
    }

    public function create_plugin_settings_page() {
    	// Add the menu item and page
    	$page_title = '';
    	$menu_title = 'FS Support';
    	$capability = 'manage_options';
    	$slug = 'fs_admin_settings';
    	$callback = array( $this, 'fs_plugin_settings_page_content' );
    	$icon = plugins_url( 'freshysites-support-beacon/includes/assets/FS_Lime_wht.svg');
    	$position = 3;

    	add_menu_page( $page_title, $menu_title, $capability, $slug, $callback, $icon, $position );
    }

    public function fs_plugin_settings_page_content() {?>

<!-- Begin FS Admin Page Content -->
		<style>
			body{
				background-color:white;
			}
			.wp-core-ui .button-primary{
				background-color:#00B140!important;
				border-color:#00B140!important;
			}
			.wp-core-ui .button-primary:hover{
				background-color:#00B140!important;
				border-color:#00B140!important;
				opacity:.9;
			}
			#admin_theme_select{
				min-width:300px;
				border:none;
				background-color:#eee;
				line-height: 2.9em;
			}
			#admin_theme_select:active{
				min-width:300px;
				border:none;
				background-color:#eee;
				line-height: 2.9em;
			}
			#fs_token_field{
				min-width:300px;
				min-width:300px;
				border:none;
				background-color:#eee;
				line-height: 2.9em;
			}
			#adminmenu li.current a.menu-top{
				background:#00B140!important;
			}
			@import url("https://use.typekit.net/wpj7qhk.css");
	body{/*font-family: sofia pro,sans-serif; */
	}

	h2{
	font-family: sofia pro,sans-serif;
    text-align: center;
    color: #363636;
    font-size: 32px;
    line-height: 1em;
    font-weight: 700;
	}
	h3{
	font-family: sofia pro,sans-serif;	
	color: #333;
    font-size: 20px;
    font-weight: 400;
    line-height: 1.3em;
    margin:0;

}
 p{
	font-family: sofia pro,sans-serif;
    font-size: 18px!important;
    color:#5a5a5a;
    margin:0;
    padding-top:1em;
 }
.kb-container {
  display: flex;
  width:90%;
  background-color: white;
  flex-wrap: wrap;
  padding:0 1% 0% 1%;
}

.kb-container > a {
	font-family: sofia pro,sans-serif;
  background-color: white;
  margin: 1%;
  padding: 20px;
  font-size: 30px;
  min-width:27.25%;
  max-width:27.25%;
  text-decoration:none;
  -webkit-transition: background .5s;
  -moz-transition: background .5s;
  -o-transition: background .5s;
  transition: background .5s;
-webkit-box-shadow: 0 2px 8px rgba(0,0,0,0.10);
box-shadow: 0 2px 8px rgba(0,0,0,0.10);
}
.kb-container > a:nth-child(odd) {
  padding: 20px;
  font-size: 30px;
  border-top: 3px solid #dbe442;
}
.kb-container > a:nth-child(odd):hover {
background-color:#dbe442;
}
.kb-container > a:nth-child(even) {
    border-top: 3px solid #00b140;
}
.kb-container > a:nth-child(even):hover {
background-color:#00b140;
}
@media (max-width:782px){			
	.kb-container > a {
		min-width:90%;
		max-width:90%;
	}
	.settings-button{
		top:46px !important;
	}

}
.hidden {
     display:none;
     padding-top:15px;

}
.settings-button{
font-family: sofia pro,sans-serif;
position:fixed;
top:32px;
right:10%;
background:#00b140;;
text-decoration:none;
padding:5px 15px 5px 15px;
color: white!important;
border-radius: 0 0px 5px 5px;
-webkit-box-shadow: 0 2px 8px rgba(0,0,0,0.10);
box-shadow: 0 2px 8px rgba(0,0,0,0.10);
font-size:18px;
text-transform:uppercase;

}
			.settings-button:active{
				border:none!important;
			}
			.settings-button:focus{
				box-shadow:none;
			}
			
#settings{
border-bottom: 3px solid #00b140;
padding:15px;

}
.settings_content{

}
			
			#docsSearch {
    /* background-image: linear-gradient(to right, #50b849 , #d7e040); */
    border: none;
		
	}
	
	#searchBar button {
    color: white;
    background: #DCE342;
    border-radius: 0 5px 5px 0;
    border: 1px solid #407FB3;
    font-size: 18px;
    padding: 0 1.5em;
    height: 50px;
    top: 24px;
    right: -1px;
	font-weight:400;
	border:none;
	box-shadow: 0 2px 8px rgba(0,0,0,0.10);
	cursor:pointer;
	font-family: helvetica,sans-serif;

}
	#searchBar button:hover{
	background: #00b140;		
	}
	#searchBar .search-query {
    border-radius: 5px;
    font-size: 18px;
    line-height: 22px;
    width: 40%;
    height: 50px;
    -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
    box-sizing: border-box;
	margin-right:-7px;
	border:none;
	box-shadow: 0 2px 8px rgba(0,0,0,0.10);
	font-family: helvetica,sans-serif;
}

		</style>
    <a class="settings-button" href="#" onclick="toggler('settings');">Settings</a>
    <div id="settings" class='hidden'>
      <div class="settings_content"><h2 style="text-align:left;">FreshySettings</h2></div>
      <center>
      	<div class="wrap" style="max-width:70%;">
  			<div style="padding-bottom:75px;">
  			</div>

        <?php
              if ( isset( $_GET['settings-updated'] ) && $_GET['settings-updated'] ){
                    $this->admin_notice();
              } ?>

      		<form method="POST" action="options.php">
  				<div class="admin_inner" style="margin-top:0px;">
                  <?php
                      settings_fields( 'FreshySites_fields' );
                      do_settings_sections( 'FreshySites_fields' );
                      submit_button();
                  ?></div>
      		</form>
      	</div>
  		</center>

    </div>
	<div style="margin:50px;max-width:70%;height:97px">
	<img src="https://freshysites.com/wp-content/uploads/FS-Horizontal.svg" width="300px" style="float:left;">


  			</div><center><div style="clear:both;">
				
				
				<div id="docsSearch">
	<h2>How can we help?</h2>

	<form action="https://kb.freshysites.com/search" method="GET" id="searchBar" autocomplete="off" target="_blank">
    
                <input type="text" name="query" title="search-query" class="search-query" placeholder="Search the knowledge base" aria-labelledby="Search the knowledge base" value="">
		<button type="submit" aria-labelledby="Search"><i class="icon-search lp"></i><span>Search</span></button></form> 
</div></div>
	<br/>
  	<div class="kb_heading"><h2>Knowledge Base</h2></div>
    <div class="kb-container">

      <a href="https://kb.freshysites.com/category/35-getting-started" target="blank">
        <h3>Getting Started</h3>
        <p>Learn how to Login and update your username and password.</p></a>
        <a class="category" id="category-83" href="https://kb.freshysites.com/category/83-training-registration" target="_blank">
                          <h3>Training Resources</h3>
                <p>Basic training resources available 24/7!</p></a>
       <a class="category" href="https://kb.freshysites.com/category/10-terms-processes" target="_blank">
                                    <h3>Account Information</h3>
                                    <p>Support Terms &amp; Account Management Information.</p></a>

                                    <!-- The Help Desk -->
    </div>
    <div class="kb_heading"><h2>Help Desk</h2></div>
    <div class="kb-container">

     <a class="category" href="https://kb.freshysites.com/category/186-update-billing-online" target="_blank">
                                    <h3>Account Billing:  Update Online</h3>
                                </a>
     							<a class="category" href="https://kb.freshysites.com/category/183-fs-support-beacon" target="_blank">
                                    <h3>FS Support Beacon</h3>
                                </a>
                                 <a class="category" href="https://kb.freshysites.com/category/131-how-to-clear-browser-cache" target="_blank">
                                    <h3>How to Clear Browser Cache</h3>
                                </a>
                                  <a class="category" href="https://kb.freshysites.com/category/122-troubleshooting" target="_blank">
                                    <h3>Troubleshooting</h3>
                                </a>
                                  <a class="category" href="https://kb.freshysites.com/category/123-email" target="_blank">
                                    <h3>Email</h3>
                                </a>
    </div>
				
				<!-- How-To Guides -->
	<div class="kb_heading"><h2>How-To Guides</h2></div>
    <div class="kb-container">

     <a class="category" href="https://kb.freshysites.com/category/113-basic-wordpress" target="_blank">
                                    <h3>Basic Wordpress</h3>
                                </a>
     							<a class="category" href="https://kb.freshysites.com/category/98-editing" target="_blank">
                                    <h3>Page Editing</h3>
                                </a>
                                 <a class="category" href="https://kb.freshysites.com/category/174-blog-post-editing" target="_blank">
                                    <h3>Blog &#x26; Post Editing</h3>
                                </a>
                                  <a class="category" href="https://kb.freshysites.com/category/175-form-editing" target="_blank">
                                    <h3>Form Editing</h3>
                                </a>
                                  <a class="category" href="https://kb.freshysites.com/category/176-main-menu-footer-sidebar-editing" target="_blank">
                                    <h3>Main Menu &#x26; Footer Editing</h3>
                                </a>
								<a class="category" href="https://kb.freshysites.com/category/133-best-practices" target="_blank">
                                    <h3>Best Practices</h3>
                                </a>
    </div>
				
				
				<!-- Search Engine Optimization (SEO) -->
				
				
	<div class="kb_heading"><h2>Search Engine Optimization (SEO)</h2></div>
    <div class="kb-container">

     							<a class="category" href="https://kb.freshysites.com/category/103-getting-started" target="_blank">
                                    <h3>SEO Basics</h3>
                                </a>
     							<a class="category" href="https://kb.freshysites.com/category/106-improving-seo-rankings" target="_blank">
                                    <h3>SEO Rankings</h3>
                                </a>
                                 <a class="category" href="https://kb.freshysites.com/category/104-local-seo" target="_blank">
                                    <h3>Local SEO</h3>
                                </a>
                                  <a class="category" href="https://kb.freshysites.com/category/105-on-page-seo" target="_blank">
                                    <h3>On-Page SEO</h3>
                                </a>
                                  <a class="category" href="https://kb.freshysites.com/category/107-ecommerce-seo" target="_blank">
                                    <h3>eCommerce SEO</h3>
                                </a>
						
    </div>
				
				<!-- Google Analytics -->
				
	<div class="kb_heading"><h2>Google Analytics</h2></div>
    <div class="kb-container">

     							<a class="category" href="https://kb.freshysites.com/category/111-getting-started" target="_blank">
                                    <h3>Getting Started</h3>
                                </a>
     							<a class="category" href="https://kb.freshysites.com/category/126-tools-training-resources" target="_blank">
                                    <h3> Tools &#x26; Training Resources</h3>
                                </a>
                                 <a class="category" href="https://kb.freshysites.com/category/112-navigating-google-analytics" target="_blank">
                                    <h3>Navigating Google Analytics</h3>
                                </a>
    </div>
				
				<!--  eCommerce -->
				
	<div class="kb_heading"><h2>eCommerce</h2></div>
    <div class="kb-container">

     							<a class="category" href="https://kb.freshysites.com/category/117-product-how-to-guides" target="_blank">
                                    <h3>Product How-To Guides</h3>
                                </a>
     							<a class="category" href="https://kb.freshysites.com/category/118-shop-management" target="_blank">
                                    <h3>Shop Management</h3>
                                </a>
                                 <a class="category" href="https://kb.freshysites.com/category/139-payment-processors" target="_blank">
                                    <h3>Payement Processors</h3>
                                </a>
		 						<a class="category" href="https://kb.freshysites.com/category/141-shipping-faqs" target="_blank">
                                    <h3>Shipping FAQs</h3>
                                </a>
    </div>
				
				
    </center>
<script>
function toggler(divId) {
    $("#" + divId).toggle('slow');
}
</script>


<!-- End of FS Admin Page Content -->

<?php
    }



    public function admin_notice() { ?>
        <div class="notice notice-success is-dismissible">
            <p>Your settings have been updated!</p>
        </div><?php
    }

    public function setup_sections() {
        add_settings_section( 'our_first_section', /*add title */ '', array( $this, 'section_callback' ), 'FreshySites_fields' );
        add_settings_section( 'our_second_section', /*add title */ '', array( $this, 'section_callback' ), 'FreshySites_fields' );
        add_settings_section( 'our_third_section', /*add title */ '', array( $this, 'section_callback' ), 'FreshySites_fields' );
    }

    public function section_callback( $arguments ) {
    	switch( $arguments['id'] ){
    		case 'our_first_section':
    			echo '';
    			break;
    		case 'our_second_section':
    			echo '';
    			break;
    		case 'our_third_section':
    			echo '';
    			break;
    	}
    }

    public function setup_fields() {
        $fields = array(
        	/*
        	 * array(
        		'uid' => 'awesome_text_field',
        		'label' => 'Sample Text Field',
        		'section' => 'our_first_section',
        		'type' => 'text',
        		'placeholder' => 'Some text',
        		'helper' => 'Does this help?',
        		'supplimental' => 'I am underneath!',
        	),
        	array(
        		'uid' => 'awesome_number_field',
        		'label' => 'Sample Number Field',
        		'section' => 'our_first_section',
        		'type' => 'number',
        	),
        	array(
        		'uid' => 'awesome_textarea',
        		'label' => 'Sample Text Area',
        		'section' => 'our_first_section',
        		'type' => 'textarea',
        	),*/

			array(
        		'uid' => 'fs_token_field',
        		'label' => 'FreshySites Support Key',
        		'section' => 'our_first_section',
        		'type' => 'password',
				'default' => '64f1767c1100462355552d6b96d55a22f9751b5d',
				//'supplimental' => 'Private Key required to receive updates.',
        	),
			// For later inclusion of dashboard themes
        	/*array(
        		'uid' => 'admin_theme_select',
        		'label' => 'WordPress Dashboard Theme',
        		'section' => 'our_first_section',
        		'type' => 'select',
        		'options' => array(
        			'option1' => 'FreshySites Clean Whites',
        			'option2' => 'FreshySites Green Limes',
        			'option3' => 'WordPress at Night',
					'option4' => 'Default WordPress User'
				), 
                'default' => array()
        	),*/

			array(
        		'uid' => 'hide_jetpack_threat_select',
        		'label' => 'Hide Jetpack\'s "Threats Found"',
        		'section' => 'our_third_section',
        		'type' => 'select',
        		'options' => array(
        			'option1' => 'Yes',
        			'option2' => 'No',
        		),
                'default' => array()
        	),


			/*
        	array(
        		'uid' => 'awesome_multiselect',
        		'label' => 'Sample Multi Select',
        		'section' => 'our_first_section',
        		'type' => 'multiselect',
        		'options' => array(
        			'option1' => 'Option 1',
        			'option2' => 'Option 2',
        			'option3' => 'Option 3',
        			'option4' => 'Option 4',
        			'option5' => 'Option 5',
        		),
                'default' => array()
        	), */
        	/*array(
        		'uid' => 'awesome_radio',
        		'label' => 'Sample Radio Buttons',
        		'section' => 'our_first_section',
        		'type' => 'radio',
        		'options' => array(
        			'option1' => 'Option 1',
        			'option2' => 'Option 2',
        			'option3' => 'Option 3',
        			'option4' => 'Option 4',
        			'option5' => 'Option 5',
        		),
                'default' => array()
        	),
        	array(
        		'uid' => 'awesome_checkboxes',
        		'label' => 'Sample Checkboxes',
        		'section' => 'our_first_section',
        		'type' => 'checkbox',
        		'options' => array(
        			'option1' => 'checked',
        		),
                'default' => array()
        	)*/
        );
    	foreach( $fields as $field ){

        	add_settings_field( $field['uid'], $field['label'], array( $this, 'field_callback' ), 'FreshySites_fields', $field['section'], $field );
            register_setting( 'FreshySites_fields', $field['uid'] );
    	}
    }

    public function field_callback( $arguments ) {

        $value = get_option( $arguments['uid'] );

        if( ! $value ) {
            $value = $arguments['default'];
        }

        switch( $arguments['type'] ){
            case 'text':
            case 'password':
            case 'number':
                printf( '<input name="%1$s" id="%1$s" type="%2$s" placeholder="%3$s" value="%4$s" />', $arguments['uid'], $arguments['type'], $arguments['placeholder'], $value );
                break;
            case 'textarea':
                printf( '<textarea name="%1$s" id="%1$s" placeholder="%2$s" rows="5" cols="50">%3$s</textarea>', $arguments['uid'], $arguments['placeholder'], $value );
                break;
            case 'select':
            case 'multiselect':
                if( ! empty ( $arguments['options'] ) && is_array( $arguments['options'] ) ){
                    $attributes = '';
                    $options_markup = '';
                    foreach( $arguments['options'] as $key => $label ){
                        $options_markup .= sprintf( '<option value="%s" %s>%s</option>', $key, selected( $value[ array_search( $key, $value, true ) ], $key, false ), $label );
                    }
                    if( $arguments['type'] === 'multiselect' ){
                        $attributes = ' multiple="multiple" ';
                    }
                    printf( '<select name="%1$s[]" id="%1$s" %2$s>%3$s</select>', $arguments['uid'], $attributes, $options_markup );
                }
                break;
            case 'radio':
            case 'checkbox':
                if( ! empty ( $arguments['options'] ) && is_array( $arguments['options'] ) ){
                    $options_markup = '';
                    $iterator = 0;
                    foreach( $arguments['options'] as $key => $label ){
                        $iterator++;
                        $options_markup .= sprintf( '<label for="%1$s_%6$s"><input id="%1$s_%6$s" name="%1$s[]" type="%2$s" value="%3$s" %4$s /> %5$s</label><br/>', $arguments['uid'], $arguments['type'], $key, checked( $value[ array_search( $key, $value, true ) ], $key, false ), $label, $iterator );
                    }
                    printf( '<fieldset>%s</fieldset>', $options_markup );
                }
                break;
        }

        if( $helper = $arguments['helper'] ){
            printf( '<span class="helper"> %s</span>', $helper );
        }

        if( $supplimental = $arguments['supplimental'] ){
            printf( '<p class="description">%s</p>', $supplimental );
        }

    }

}



new FreshySites_Support_Plugin();
