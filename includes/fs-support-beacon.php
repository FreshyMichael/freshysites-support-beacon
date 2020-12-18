<?php

if ( ! defined( 'ABSPATH' ) ) {
	die();
}

function fs_body_admin () {
?>
<script>
jQuery(document).ready(function(){

!function(e,t,n){function a(){var e=t.getElementsByTagName("script")[0],n=t.createElement("script");n.type="text/javascript",n.async=!0,n.src="https://beacon-v2.helpscout.net",e.parentNode.insertBefore(n,e)}if(e.Beacon=n=function(t,n,a){e.Beacon.readyQueue.push({method:t,options:n,data:a})},n.readyQueue=[],"complete"===t.readyState)return a();e.attachEvent?e.attachEvent("onload",a):e.addEventListener("load",a,!1)}(window,document,window.Beacon||function(){});
window.Beacon('init', 'e6022068-33c2-46d5-88d8-74ba6ee09ff4');

Beacon("navigate", "/ask/");
});</script>

   <button style="valign:center;position:fixed;bottom:0;right:100px;clear:both; background-color:white;border:none;border-radius:5px 5px 0px 0px!important;padding:0px 10px 0px 10px;color:white;font-size:15px; line-height:1.9em; cursor:pointer; -webkit-box-shadow: 0px 2px 11px 3px rgba(0,0,0,0.15); box-shadow: 0px 2px 11px 3px rgba(0,0,0,0.15);" onclick="return Beacon('toggle')"><img src="<?php echo plugins_url('freshysites-support-beacon/includes/assets/FS_Horizontal_RGB.svg');?>" style=" min-width:125px; vertical-align: middle; margin-bottom:4px; margin-top:4px;"><div>
	   </div></button> <?php
}

add_action('admin_footer', 'fs_body_admin');

?>
