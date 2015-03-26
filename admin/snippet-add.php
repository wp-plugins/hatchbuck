<?php 

global $wpdb;

$_POST = stripslashes_deep($_POST);
$_POST = hatchbuck_trim_deep($_POST);

if(isset($_POST) && isset($_POST['addSubmit'])){

// 		echo '<pre>';
// 		print_r($_POST);
// 		die("JJJ");

	$temp_hatchbuck_title = str_replace(' ', '', $_POST['snippetTitle']);
	$temp_hatchbuck_title = str_replace('-', '', $temp_hatchbuck_title);
	
	$hatchbuck_title = str_replace(' ', '-', $_POST['snippetTitle']);
	$hatchbuck_content = $_POST['snippetContent'];
	
	if($hatchbuck_title != "" && $hatchbuck_content != ""){
		if(ctype_alnum($temp_hatchbuck_title))
		{
		
		$snippet_count = $wpdb->query( 'SELECT * FROM '.$wpdb->prefix.HATCHBUCK_TABLE.' WHERE title="'.$hatchbuck_title.'"' ) ;
		if($snippet_count == 0){
			$hatchbuck_shortCode = '[hatchbuck form="'.$hatchbuck_title.'"]';
			$wpdb->insert($wpdb->prefix.HATCHBUCK_TABLE, array('title' =>$hatchbuck_title,'content'=>$hatchbuck_content,'short_code'=>$hatchbuck_shortCode,'status'=>'1'),array('%s','%s','%s','%d'));
			
			header("Location:".admin_url('admin.php?page=hatchbuck-manage&hatchbuck_msg=1'));
		}else{
			?>
			<div class="system_notice_area_style0" id="system_notice_area">
			Form already exists. &nbsp;&nbsp;&nbsp;<span id="system_notice_area_dismiss">Dismiss</span>
			</div>
			<?php	
	
		}
		}
		else
		{
			?>
		<div class="system_notice_area_style0" id="system_notice_area">
		Form title can have only letters, numbers or hyphens. &nbsp;&nbsp;&nbsp;<span id="system_notice_area_dismiss">Dismiss</span>
		</div>
		<?php
		
		}
		
		
	}else{
?>		
		<div class="system_notice_area_style0" id="system_notice_area">
			Fill all mandatory fields. &nbsp;&nbsp;&nbsp;<span id="system_notice_area_dismiss">Dismiss</span>
		</div>
<?php 
	}

}

?>

<div id="poststuff">
<div id="post-body" class="metabox-holder columns-2">

<div id="postbox-container-2" class="postbox-container">
  <div class="postbox">
    <h3 class="hndle"><span>Add Hatchbuck Form</span></h3>
    <div class="inside">
		<form name="frmmainForm" id="frmmainForm" method="post">
			
			<div>
				<table
					style="width: 99%; margin: 0 auto">
					<tr valign="top">
						<td style="border-bottom: none;width:10%;">&nbsp;&nbsp;&nbsp;Form Name&nbsp;<font color="red">*</font></td>
						<td style="border-bottom: none;width:1px;">&nbsp;:&nbsp;</td>
						<td><input style="width:80%;"
							type="text" name="snippetTitle"
							value="<?php if(isset($_POST['snippetTitle'])){ echo esc_attr($_POST['snippetTitle']);}?>"></td>
					</tr>
					<tr>
						<td style="border-bottom: none;width:10%; ">&nbsp;&nbsp;&nbsp;Form Code &nbsp;<font color="red">*</font></td>
						<td style="border-bottom: none;width:1px;">&nbsp;:&nbsp;</td>
						<td >
							<textarea name="snippetContent" style="width:80%;height:150px;"><?php if(isset($_POST['snippetContent'])){ echo esc_textarea($_POST['snippetContent']);}?></textarea>
						</td>
					</tr>				

				<tr>
				<td></td><td></td>
					<td><input class="button button-primary" style="cursor: pointer;"
							type="submit" name="addSubmit" value="Create Your Form"></td>
				</tr>
				<tr><td><br/></td></tr>
				</table>
			</div>

		</form>
    </div><!-- inside -->
  </div><!-- postbox -->
</div><!-- postbox-container-2 -->
<?php require( dirname( __FILE__ ) . '/sidebar.php' ); ?>
<div id="postbox-container-3" class="postbox-container">
	<div id="top-sortables" class="meta-box-sortables ui-sortable"></div>
<div id="normal-sortables" class="meta-box-sortables ui-sortable">
  <div class="postbox"><div class="handlediv" title="Click to toggle"><br></div>
    <h3 class="hndle ui-sortable-handle"><span>What form code should I use?</span></h3>
    <div class="inside">
	<h3>Option #1: IFRAME</h3>
	<p>If you are happy with form design that you created inside Hatchbuck - colors, fonts, sizes, etc. - than choos IFRAME option.</p>
	<p><img src="<?php echo plugins_url(basename(dirname(dirname(__FILE__))).'/images/hatchbuck-form-iframe.png')?>" alt="Hatchbuck form IFRAME" /></p>
	<hr />
	<h3>Option #2: HTML/CSS</h3>
	<p>If you want your form to match your theme styling, choose HTML/CSS form option. BUT!</P>
	<p><strong>IMPORTANT:</strong> Do NOT copy/paste everything. You only need to copy and paste form code that starts with <code>&#x3C;form</code> and ends with <code>&#x3C;/form&#x3E;</code></p>
    <p><img src="<?php echo plugins_url(basename(dirname(dirname(__FILE__))).'/images/hatchbuck-form-html-2.png')?>" alt="Hatchbuck form HTML/CSS" /></p>
    </div><!-- inside -->
  </div><!-- postbox -->
</div>
</div>



</div><!-- postbody -->
</div><!-- poststuff -->