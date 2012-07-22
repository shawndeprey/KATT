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
<!DOCTYPE html>
<html class="game_page">
<head>
    <title>Blackmodule's Space Game</title>
	<link rel="stylesheet" href="../../template/pix.css" type="text/css" />
	<script src="Game.js"></script>
	<script type="text/javascript">
		function soundsLoaded() { play.InitSounds(); }
		window.onkeydown=function(e){
		  if(e.keyCode==32){ return false; }
		  if(e.keyCode==37){ return false; }
		  if(e.keyCode==38){ return false; }
		  if(e.keyCode==39){ return false; }
		  if(e.keyCode==40){ return false; }
		};
	</script>
</head>
<body class="game_page_bg">

<div class="game_menu">
	<div class="left">
		<div class="game_login_form">
			<?php
			if($user->data['is_registered'])
			{
				echo("<span class='usr'>" . $user->data['username'] . "</span> &nbsp;&nbsp; <a class='bar_link bar_left' href=" . $phpbb_root_path . 'ucp.php?mode=logout' . '&sid=' . $user->data['session_id'] . "&redirect=http://www.blackmodulestudio.com" . $_SERVER['REQUEST_URI'] . "><span>Logout</span></a>");
			}
			else
			{
				echo('<form action="' . $phpbb_root_path . 'ucp.php" method="post" enctype="multipart/form-data">
				<input type="text" name="username" value="username" onblur="if(this.value == \'\') { this.value=\'username\';}" onfocus="if (this.value == \'username\') {this.value=\'\';}" />
				<input type="password" name="password" value="password"  onblur="if(this.value == \'\') { this.value=\'password\';}" onfocus="if (this.value == \'password\') {this.value=\'\';}" />
				<input type="hidden" name="redirect" value="http://www.blackmodulestudio.com' . $_SERVER['REQUEST_URI'] . '" />
				<input class="submit_btn" id="submit" type="submit" value="login" name="login" />
				</form>');
			}
			?>
		</div>
	</div>
	
	<div class="right">
		<a href="highscores.php?mode=limited" class="bar_link bar_right"><span>Highscores</span></a>
		<a href="../../index.php" class="bar_link bar_right"><span>Home</span></a>
	</div>
</div>
<!-- The browser will automatically choose the format it supports. -->
<audio id="bgm_square" onloadeddata="soundsLoaded()" preload="auto" autobuffer>
	<source src="Audio/bgm_square.mp3" type="audio/mp3"> 
	<source src="Audio/bgm_square.ogg" type="audio/ogg">
	HTML5 audio not supported. Please Upgrade your web browser.
</audio>
<audio id="bgm_fast" preload="auto" autobuffer>
	<source src="Audio/fast.mp3" type="audio/mp3"> 
	<source src="Audio/fast.ogg" type="audio/ogg">
</audio>
<audio id="bgm_soar" preload="auto" autobuffer>
	<source src="Audio/soar.mp3" type="audio/mp3">
	<source src="Audio/soar.ogg" type="audio/ogg">
</audio>
<audio id="bgm_dorian" preload="auto" autobuffer>
	<source src="Audio/Dorian.mp3" type="audio/mp3">
	<source src="Audio/Dorian.ogg" type="audio/ogg">
</audio>

<audio id="bgm_boss" preload="auto" autobuffer>
	<source src="Audio/swim_or_sink.mp3" type="audio/mp3">
	<source src="Audio/swim_or_sink.ogg" type="audio/ogg">
</audio>
<!-- End Audio -->

<div align="center">
    <canvas id="canvas" width="800" height="600">
        Your browser does not support the canvas element, sorry.
    </canvas>
<script type="text/javascript">
	var play = new Game();
	play.Init();
	play.Run();
</script>
</div>

</body>
</html>