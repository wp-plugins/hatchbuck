<?php
add_action('admin_menu', 'hatchbuck_menu');
function hatchbuck_menu(){
	
	add_menu_page('hatchbuck', 'Hatchbuck', 'manage_options', 'hatchbuck-manage','hatchbuck_snippets',plugins_url(basename(dirname(dirname(__FILE__))).'/images/logo.png'));

	add_submenu_page('hatchbuck-manage', 'Forms', 'Forms', 'manage_options', 'hatchbuck-manage','hatchbuck_snippets');
	add_submenu_page('hatchbuck-manage', 'Hatchbuck - Manage settings', 'Settings', 'manage_options', 'hatchbuck-settings' ,'hatchbuck_settings');	
	add_submenu_page('hatchbuck-manage', 'Hatchbuck - Help', 'Help', 'manage_options', 'hatchbuck-help' ,'hatchbuck_help');
	add_submenu_page('hatchbuck-manage', 'Hatchbuck - Tutorial', 'Tutorial', 'manage_options', 'hatchbuck-tutorial' ,'hatchbuck_tutorial');
	
}

function hatchbuck_snippets(){
	$formflag = 0;
	if(isset($_GET['action']) && $_GET['action']=='snippet-delete' )
	{
		include(dirname( __FILE__ ) . '/snippet-delete.php');
		$formflag=1;
	}
	if(isset($_GET['action']) && $_GET['action']=='snippet-edit' )
	{
		require( dirname( __FILE__ ) . '/header.php' );
		include(dirname( __FILE__ ) . '/snippet-edit.php');
		require( dirname( __FILE__ ) . '/footer.php' );
		$formflag=1;
	}
	if(isset($_GET['action']) && $_GET['action']=='snippet-add' )
	{
		require( dirname( __FILE__ ) . '/header.php' );
		require( dirname( __FILE__ ) . '/snippet-add.php' );
		require( dirname( __FILE__ ) . '/footer.php' );
		$formflag=1;
	}
	if(isset($_GET['action']) && $_GET['action']=='snippet-status' )
	{
		require( dirname( __FILE__ ) . '/snippet-status.php' );
		$formflag=1;
	}
	if($formflag == 0){
		require( dirname( __FILE__ ) . '/header.php' );
		require( dirname( __FILE__ ) . '/snippets.php' );
		require( dirname( __FILE__ ) . '/footer.php' );
	}
}

function hatchbuck_settings()
{
	require( dirname( __FILE__ ) . '/header.php' );
	require( dirname( __FILE__ ) . '/settings.php' );
	require( dirname( __FILE__ ) . '/footer.php' );
	
}

function hatchbuck_help(){
	require( dirname( __FILE__ ) . '/header.php' );
	require( dirname( __FILE__ ) . '/about.php' );
	require( dirname( __FILE__ ) . '/footer.php' );
}

function hatchbuck_tutorial(){
	require( dirname( __FILE__ ) . '/header.php' );
	require( dirname( __FILE__ ) . '/tutorial.php' );
	require( dirname( __FILE__ ) . '/footer.php' );
}

function hatchbuck_add_style_script(){

	wp_enqueue_script('jquery');
	
	wp_register_script( 'hatchbuck_notice_script', plugins_url(basename(dirname(dirname(__FILE__))).'/js/notice.js'),'',HATCHBUCK_VERSION);
  wp_enqueue_script( 'hatchbuck_notice_script' );
  
  wp_register_script( 'hatchbuck_help_script', plugins_url(basename(dirname(dirname(__FILE__))).'/js/help_button.js'),'',HATCHBUCK_VERSION);

  if(get_option('hatchbuck_help_script')) {
    wp_enqueue_script( 'hatchbuck_help_script' );
  }
	
	// Register stylesheets
	wp_register_style('hatchbuck_style', plugins_url(basename(dirname(dirname(__FILE__))).'/css/hatchbuck_styles.css'),'',HATCHBUCK_VERSION);
	wp_enqueue_style('hatchbuck_style');
}
add_action('admin_enqueue_scripts', 'hatchbuck_add_style_script');


wp_enqueue_script( 'jquery-ui-tabs' );
wp_enqueue_script( 'jquery-ui-dialog' );
wp_enqueue_style( 'jquery-ui-tabs' );
wp_enqueue_style( 'wp-jquery-ui-dialog' );

/*
 * Ajax call
 */
add_action('wp_ajax_subscribe', 'hatchbuck_ajaxSubscribe');
function hatchbuck_ajaxSubscribe() {
  require( dirname( __FILE__ ).'/ajax-subscribe.php');
  exit();
}
?>

<?php
add_action( 'admin_footer', 'hatchbuck_my_action_javascript' ); // Write our JS below here

function hatchbuck_my_action_javascript() { ?>
	<script type="text/javascript" >
	jQuery(document).ready(function($) {
    $('#signup-form').submit(function(){
      var data = {
        'action': 'subscribe',
        'name': $('.subscribe #name').val(),
        'lname': $('.subscribe #LastName').val(),
        'email': $('.subscribe #email').val()
      };

      // since 2.8 ajaxurl is always defined in the admin header and points to admin-ajax.php
      $.post(ajaxurl, data, function(response) {
        if(response == 1){
          $('.subscribe #name').val('');
          $('.subscribe #LastName').val('');
          $('.subscribe #email').val('');
          $('.subscribe #status').
            html('Thank you for Subscribing! ').
            removeClass('danger').
            addClass('success');
        }else{
          $('.subscribe #status').
            html(response).
            removeClass('success').
            addClass('danger');
        }
      });
      return false;
    });
	});
	</script> <?php
}