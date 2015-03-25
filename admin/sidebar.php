<?php
function hatchbuck_getFeed(){
  $url = 'https://www.projectarmy.net/feed/';
  $rss = fetch_feed($url);
  if(is_wp_error($rss)){
    return false;
  }
  $maxitems = $rss->get_item_quantity(5);
  $rss_items = $rss->get_items(0,$maxitems);
  $html = '<ul>';
  if($maxitems != 0){
    foreach($rss_items as $item){
      $html .= '<li><a href="'.esc_url($item->get_permalink()).'?utm_source=Blog%20Feed&utm_medium=Text%20Link&utm_campaign=HB%20for%20WP%20Plugin" target="_blank">'.esc_html($item->get_title()).'</a></li>';
    }
  }
  $html .= '</ul>';
  return $html;
}
?>

<div id="postbox-container-1" class="postbox-container">
   <div class="hatchbuck-training"><a href="https://edu.projectarmy.net/hatchbuck/?utm_source=Hatchbuck%20for%20WordPress%20plugin&utm_medium=Image%20Banner&utm_campaign=Plugin%20Training%20Banner" target="_blank"><img src="<?php echo plugins_url(basename(dirname(dirname(__FILE__))).'/images/hatchbuck-training.png')?>" alt="Go to free Hatchbuck and marketing training resources" /></a></div>
   <div class="postbox subscribe">
    <h3 class="hndle"><span>FREE Hatchbuck Insider Updates!</span></h3>
    <div class="inside">
    <p>The Hatchbuck Insider newsletter includes how-to's, templates and many other resources to help you use Hatchbuck to generate leads and sales!</p>
        <form method="POST" accept-charset="utf-8" name="signup-form" id="signup-form">
         <p id="status" align="center"></p>
        <table style="width:100%;">
          <tr>
            <td><label for="name">Your first name</label>
            	<input type="text" name="name" id="name"/></td>
          </tr>
          <tr>
            <td><label for="lname">Your last name</label>
            	<input type="text" name="lname" id="LastName"/></td>
          </tr>
          <tr>
            <td><label for="email">Your email</label>
            	<input type="text" name="email" id="email"/></td>
          </tr>
          <tr>
          	<td><input type="submit" value="Sign up now &raquo;" class="button-primary" id="submit-btn"/></td>
          </tr>
        </table>
        <small style="color:#999;">Privacy guaranteed!</small>
      </form>
    </div><!-- inside -->
  </div><!-- postbox -->
  
  <div class="postbox ">
    <h3 class="hndle"><span>ProjectArmy Blog</span></h3>
    <div class="inside">
      <?php echo hatchbuck_getFeed(); ?>
    </div><!-- inside -->
  </div><!-- postbox -->
  
</div><!-- postbox-container-1 -->
