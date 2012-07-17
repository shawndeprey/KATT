<?php
define('IN_PHPBB', true);
$phpbb_root_path = (defined('PHPBB_ROOT_PATH')) ? PHPBB_ROOT_PATH : '../../forum/';
$phpEx = substr(strrchr(__FILE__, '.'), 1);
include($phpbb_root_path . 'common.' . $phpEx);

// Start session management
$user->session_begin();
$auth->acl($user->data);
$user->setup();

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Blackmodule Studio</title>
<link rel="stylesheet" href="../../template/pix.css" type="text/css" />

<!-- TinyMCE -->
<script type="text/javascript" src="tiny_mce/tiny_mce.js"></script>
<!--
<script type="text/javascript">
	tinyMCE.init({
		// General options
		mode : "textareas",
		theme : "advanced",
		plugins : "autolink,lists,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,wordcount,advlist,autosave",

		// Theme options
		theme_advanced_buttons1 : "bold,italic,underline,strikethrough,|,bullist,numlist,|,link,unlink,image,|,fontselect,fontsizeselect,|,emotions,code",
		theme_advanced_buttons2 : "",
        theme_advanced_buttons3 : "",
		theme_advanced_toolbar_location : "bottom",
		theme_advanced_toolbar_align : "center",
		theme_advanced_statusbar_location : "bottom",
		theme_advanced_resizing : true,

		// Example content CSS (should be your site CSS)
		content_css : "css/content.css",

		// Drop lists for link/image/media/template dialogs
		template_external_list_url : "lists/template_list.js",
		external_link_list_url : "lists/link_list.js",
		external_image_list_url : "lists/image_list.js",
		media_external_list_url : "lists/media_list.js",

		// Style formats
		style_formats : [
			{title : 'Bold text', inline : 'b'},
			{title : 'Red text', inline : 'span', styles : {color : '#ff0000'}},
			{title : 'Red header', block : 'h1', styles : {color : '#ff0000'}},
			{title : 'Example 1', inline : 'span', classes : 'example1'},
			{title : 'Example 2', inline : 'span', classes : 'example2'},
			{title : 'Table styles'},
			{title : 'Table row 1', selector : 'tr', classes : 'tablerow1'}
		],

		// Replace values for the template plugin
		template_replace_values : {
			username : "Some User",
			staffid : "991234"
		}
	});
</script>-->
<!-- /TinyMCE -->

</head>
<body>

<!--Preload div is to load imaged before browser displays them, allowing for more consistent load times-->
<div class="preload">

</div>
<!--End Preload-->

<div class="wrapperHead">
	<div class="containerHead">
    	<div class="header">
        
        </div>
    </div>
</div>

<div class="wrapperNav">
	<div class="head_nav">
    	<?php include '../../template/nav.txt';?>
    </div>
</div>

<div class="wrapperContent">
	<div class="containerContent">
    	<div class="sidebar">
        	<?php include '../../template/sidebar.txt';?>
        </div><!--End Navbar-->
        <div class="content">
        
<!--
******************************************************************************
*** Blackmodule Studio template version 2.0
*** Developed by Pix North Productions
*** Template is property of Pix North Productions.
*** Re-creation/Re-use of template is strictly prohibited.
******************************************************************************
-->

<!--
******************************************************************************
*** CONTENT SECTION. 
*** Adding content into this section adds to the main content area of the website
******************************************************************************
-->
<br />
<?php
$username = "downloadbms";
$password2 = "Never4get";
$hostname = "downloadbms.db.8856365.hostedresource.com";	
$dbh = mysql_connect($hostname, $username, $password2) 
	or die("Unable to connect to MySQL");
$selected = mysql_select_db("downloadbms",$dbh) 
	or die("Could not select first_test");

$out_mode = $_GET['mode'];
$out_count = 0;
$result = mysql_query ("SELECT * FROM `KATT` ORDER BY highest_score DESC") or die("Could not select from KATT");

if($user->data['user_id'] == ANONYMOUS)
{
	echo '
	<div style="display:none;" id="addcomment">
	<h2 class="h2_1">Please <a href="http://forum.blackmodulestudio.com/ucp.php?mode=login">Login</a> become part of Kill all the Things!</h2>
	</div><br />
	';
}

echo '
<center>
<table class="highscores" border="0" cellpadding="" cellspacing="0" style="text-align:left;">
<tr>
	<td width="135"><h2 class="h2_1">Player</h2></td>
	<td width="135"><h2 class="h2_1">High Score</h2></td>
	<td width="135"><h2 class="h2_1">Acc. Score</h2></td>
	<td width="135"><h2 class="h2_1">Kills</h2></td>
	<td width="135"><h2 class="h2_1">Total Cores</h2></td>
	<td width="135"><h2 class="h2_1">Items Used</h2></td>
	<td width="135"><h2 class="h2_1">Wins</h2></td>
  </tr>
';
while($row = mysql_fetch_array($result))
{
	echo '
	<tr>
		<td><p style="font-size:18px; padding:0px;">' . $row['user'] . '</p></td>
		<td><p style="text-align:left; padding:0px;"><b>' . $row['highest_score'] . '</b></p></td>
		<td><p style="text-align:left; padding:0px;"><b>' . $row['acc_score'] . '</b></p></td>
		<td><p style="text-align:left; padding:0px;"><b>' . $row['kills'] . '</b></p></td>
		<td><p style="text-align:left; padding:0px;"><b>' . $row['cores'] . '</b></p></td>
		<td><p style="text-align:left; padding:0px;"><b>' . $row['items_used'] . '</b></p></td>
		<td><p style="text-align:left; padding:0px;"><b>' . $row['wins'] . '</b></p></td>
	</tr>
	';
	$out_count += 1;
	if($out_mode != 'full' && $out_count > 24){ break; }
}
echo '</table></center>';
?>
<br />  

<!--
******************************************************************************
*** END CONTENT SECTION. 
*** Adding content beyond this point may cause template to function abnormally.
******************************************************************************
-->    
<script language="javascript">
function togglediv(divid){
	if(document.getElementById(divid).style.display == 'none'){
		document.getElementById(divid).style.display = 'block';
	}else{
		document.getElementById(divid).style.display = 'none';
	}
}
</script>
            
        </div><!--End Content-->
    </div>
</div>

<div class="wrapperFooter">
	<div class="containerFooter">
    	<div class="footer">
        
        </div>
    </div>
</div>

</body>
</html>
