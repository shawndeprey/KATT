<?php
define('IN_PHPBB', true);
$phpbb_root_path = (defined('PHPBB_ROOT_PATH')) ? PHPBB_ROOT_PATH : '../../forum/';
//echo $phpbb_root_path;
$phpEx = substr(strrchr(__FILE__, '.'), 1);
include($phpbb_root_path . 'common.' . $phpEx);
// Start session management
$user->session_begin();
$auth->acl($user->data);
$user->setup();

//Connect to the database
$username = "downloadbms";
$password2 = "Never4get";
$hostname = "downloadbms.db.8856365.hostedresource.com";	
$dbh = mysql_connect($hostname, $username, $password2) 
	or die("Unable to connect to MySQL");
$selected = mysql_select_db("downloadbms",$dbh) 
	or die("Could not select first_test");
	
$from_game = $_POST["from_game"];
$kills = $_POST["kills"];
$cores = $_POST["cores"];
$highest_score = $_POST["highest_score"];
$acc_score = $highest_score;
$items_used = $_POST["items_used"];
$wins = 1;

if($from_game == "fromgame")
{
	if($user->data['user_id'] != ANONYMOUS)
	{//if user isn't logged in and isn't submitting from the game, redirect to login screen
		$user_record = mysql_query("SELECT * FROM KATT WHERE user = '" . $user->data['username'] . "' LIMIT 1");
		if(mysql_num_rows($user_record) != 0)
		{//if user has existing record, update that record
			$row = mysql_fetch_array($user_record) or die(mysql_error());
			$kills += $row['kills'];
			$cores += $row['cores'];
			if($highest_score <= $row['highest_score']){ $highest_score = $row['highest_score']; }
			$acc_score += $row['acc_score'];
			$items_used += $row['items_used'];
			$wins += $row['wins'];
			$result = mysql_query("UPDATE KATT SET kills=".$kills.",cores=".$cores.",highest_score=".$highest_score."
								   ,acc_score=".$acc_score.",items_used=".$items_used.",wins=".$wins." WHERE user='".$user->data['username']."'") or die(mysql_error());
		} else
		{//if user doesn't have existing record, make a new record
			$result = mysql_query("INSERT DELAYED INTO KATT(user, kills, cores, highest_score, acc_score, items_used, wins, count) 
								   VALUES('".$user->data['username']."', $kills, $cores, $highest_score, $acc_score, $items_used, $wins, '')") or die(mysql_error());
		}
		header('Location: http://www.blackmodulestudio.com/games/katt');
	}
}
header('Location: http://www.blackmodulestudio.com/games/katt/highscores.php?mode=limited');
?>