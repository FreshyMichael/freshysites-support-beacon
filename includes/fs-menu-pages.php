<?php
if ( ! defined( 'ABSPATH' ) ) {
	die();
}

function fs_admin_menu() {
		add_menu_page(
			__( 'FS Admin Page', 'my-textdomain' ),
			__( 'FS Support', 'my-textdomain' ),
			'manage_options',
			'fs-admin-page',
			'fs_admin_page_contents',
			plugins_url( 'freshysites-support-beacon/includes/assets/fs-icon-180w.svg'),
			3
		);
	}

	add_action( 'admin_menu', 'fs_admin_menu' );


	function fs_admin_page_contents() {
		?>


<!-- Admin Page Styles -->
<style>
	
	h3{
		text-size:2.5em;
	}
	.error{
		display:none;
	}
	#wpcontent {
		padding-left:0px !important;
	}
	#adminmenu li.current a.menu-top{
		background:#00B140 !important;
	}
	
	#wpbody-content{
		min-height:89vh;
		background-image:url("https://freshysites.com/wp-content/uploads/big-lime-tile-black-3-percent.png");
		background-size:cover;
		background-attachment:fixed;
		background-position:middle;
	}
	/* Flex Grid Style */
	.flex-grid {
 		display: flex;
		width:80%;
	}
	.col {
 		flex: 1;
		background:white;
		padding:2em;
		text-align:center;
		margin:3%;
	
	}
	.grn:hover{
		background:#00B140!important;
		color:#000!important;
		
	}
	.grn:hover h3{
		color:#000!important;
		
	}

	.yllw:hover{
		background:#DCE342!important;
		color:#000!important;
		
	}
	.yllw:hover h3{
		color:#000!important;
		
	}
	#docsSearch {
    background-image: url(https://freshysites.com/wp-content/uploads/fs-kb-header.png);
    /* background-image: linear-gradient(to right, #50b849 , #d7e040); */
    border: none;
	padding-top: 175px;	
	height:28vh;
	background-size:cover;
		
	}
	
	#searchBar button {
    color: #000;
    background: #DCE342;
    border-radius: 0 5px 5px 0;
    border: 1px solid #407FB3;
    font-size: 18px;
    padding: 0 1.5em;
    height: 50px;
    top: 24px;
    right: -1px;
	font-weight:600;
	border:none;
	box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.05), 0 6px 20px 0 rgba(0, 0, 0, 0.05);
	cursor:pointer;

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
	box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.05), 0 6px 20px 0 rgba(0, 0, 0, 0.05);
}

	
	a.collection {
	margin:50px;
    text-align: center!important;
    color: #555555;
    font-size: 2.5em;
    font-weight: 600;
	text-decoration:none;
	font-family: "Roboto", sans-serif;
		
}
	a.collection:hover {
    text-align: center;
    color: #00B140 ;
    font-size: 2.5em;
    font-weight: 600;
	text-decoration:none;
}

	.get-started-icon{
	content: '\f011';
    font-family: 'ETModules';
	color:#000000;
	min-height:45px;
	}
	
</style>


<!-- End Admin Page Styles -->

<div style="position:fixed;width:100%;min-width:100%;height:75px;background-color:white;padding-top:10px;box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.05), 0 6px 20px 0 rgba(0, 0, 0, 0.05);">
	<div class="fs-nav-left" style="position:relative; max-width:30%;">
		
	<img src="<?php echo plugins_url( '/assets/fs-formal-horizontal.svg', __FILE__ ); ?>" style="max-height:60px; align:left;">
	</div>
	</div>
<div id="docsSearch">
	<center><h1 style="color:white; font-family:'Roboto', sans-serif; font-weight:600; font-size:2.5em;">How can we help?</h1>

	<form action="https://kb.freshysites.com/search" method="GET" id="searchBar" autocomplete="off" target="_blank">
    
                <input type="text" name="query" title="search-query" class="search-query" placeholder="Search the knowledge base" aria-labelledby="Search the knowledge base" value="">
		<button type="submit" aria-labelledby="Search"><i class="icon-search lp"></i><span>Search</span></button></form> </center>
</div><center><br>
<h2 class="collection-1"><a class="collection" href="https://kb.freshysites.com/collection/1-knowledge-base" target="_blank">Knowledge Base</a></h2>
	<div class="fs-admin-conent" style="padding-left:10%; padding-right:10%;">
</div>
		<div class="flex-grid">
 
	  <a href="https://kb.freshysites.com/category/35-getting-started" target="_blank" style="text-decoration:none; color:#000;min-width:32%;">
		   <div class="col yllw" style="border-top:#DCE342 5px solid;">
			   
			   <h3>Getting Started</h3>
	  <p>Find out how to login, update user info &amp; get started using your site.</p></div></a>
			
			
<a href="https://kb.freshysites.com/category/83-training-registration" target="_blank" style="text-decoration:none; color:#000;min-width:32%;">
		   <div class="col grn" style="border-top:5px #00B140 solid;">
			  <h3>Training Resources</h3>
                                <p>Basic training resources available 24/7! Learn how to edit and manage your site.</p></div></a>
			
<a href="https://kb.freshysites.com/category/10-terms-processes" target="_blank" style="text-decoration:none; color:#000;min-width:32%;">
		   <div class="col yllw" style="border-top:#DCE342 5px solid;">
			   <h3>Account Terms &amp; Information</h3>
                                <p>Find more about our Support Terms &amp; Account Management Information.</p></div></a>
</div></center>
		

	

<!-- Help Desk --><center>
<h2 class="collection-1"><a class="collection" href="https://kb.freshysites.com/collection/119-help-desk" target="_blank"><center>Help Desk</center></a></h2>
		<div class="flex-grid">
 
	  <a href="https://kb.freshysites.com/category/186-update-billing-online" target="_blank" style="text-decoration:none; color:#000;min-width:20%;">
		   <div class="col grn" style="border-top:#00B140 5px solid;">
			   <h3>Update Billing Online</h3>
	  <p></p></div></a>
			
			
<a href="https://kb.freshysites.com/category/183-fs-support-beacon" target="_blank" style="text-decoration:none; color:#000;min-width:20%;">
		   <div class="col yllw" style="border-top:#DCE342 5px solid;">
			  <h3>FS Support Beacon</h3>
	  <p></p></div></a>
			
<a href="https://kb.freshysites.com/category/131-how-to-clear-browser-cache" target="_blank" style="text-decoration:none; color:#000;min-width:20%;">
		   <div class="col grn" style="border-top:#00B140 5px solid;">
			   <h3>Clear Browser Cache</h3>
	  <p></p></div></a>
			<a href="https://kb.freshysites.com/category/122-troubleshooting" target="_blank" style="text-decoration:none; color:#000;min-width:20%;">
		   <div class="col yllw" style="border-top:#DCE342 5px solid;">
			   <h3>Troubleshooting</h3>
	  <p></p></div></a>
			<a href="https://kb.freshysites.com/category/123-email" target="_blank" style="text-decoration:none; color:#000;min-width:20%; ">
		   <div class="col grn" style="border-top:#00B140 5px solid; ">
			  <h3>Email</h3>
	  </div></a>
</div>
	</center>


		
	
		<?php
	}

  ?>
