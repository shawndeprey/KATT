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
<script type="text/javascript" src="tiny_mce/tiny_mce.js"></script>
</head>
<body>
<div class="wrapperHead">
	<div class="containerHead">
    	<div class="header">
			<div class="login_form">
				<?php
				if($user->data['is_registered'])
				{
					echo("<span class='usr'>" . $user->data['username'] . "</span> &nbsp;&nbsp; <a class='bar_link' href=" . $phpbb_root_path . 'ucp.php?mode=logout' . '&sid=' . $user->data['session_id'] . "&redirect=http://www.blackmodulestudio.com" . $_SERVER['REQUEST_URI'] . "><span>Logout</span></a>");
				}
				else
				{
					echo('<form action="' . $phpbb_root_path . 'ucp.php" method="post" enctype="multipart/form-data">
					<input type="text" name="username" value="username" onblur="if(this.value == \'\') { this.value=\'username\';}" onfocus="if (this.value == \'username\') {this.value=\'\';}" />
					<input type="password" name="password" value="password"  onblur="if(this.value == \'\') { this.value=\'password\';}" onfocus="if (this.value == \'password\') {this.value=\'\';}" />
					<input type="hidden" name="redirect" value="http://www.blackmodulestudio.com' . $_SERVER['REQUEST_URI'] . '" />
					<input class="submit_btn" id="submit" type="submit" value="login" name="login" />
					<a href="http://forum.blackmodulestudio.com/ucp.php?mode=register">Register</a>
					</form>');
				}
				?>
			</div>
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

<?php if(!$user->data['is_registered']) : ?>
	<h3 style="color:#991111">You must login to submit highscores. Register for a Blackmodule Studio account above and join the fun!</h2>
	<br />
<?php endif ?>

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
