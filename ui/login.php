<?php
	session_start();
	$_SESSION['logout'] = 0 ;
	$_SESSION['userID'] ="";
	$_SESSION['userName'] = "";
	require_once('src/facebook.php');
	require_once('DB_Service.php');
	$con = new SSD_DB_Service;
	//APP的 ID 與 secret
	$config = array(
	'appId' => '170135173146497',
	'secret' => '922f39421a4bd2c114acc5c286a1f23a',
	);

	$facebook = new Facebook($config);
	$user_id = $facebook->getUser();
?>
<html>
<meta charset="utf-8">

<style type="text/css">
body {
	background-color: white;
}
</style>
<head>
<script language="JavaScript" src="logoutEvent.js">
</script>
</head>
<body id='main'>
	<div align='left'>
   
    		  <div align="center" style=' font-size:40; color:brown;font-weight: bold'><img width="780" height="80" src='title.jpg' align='center'></img></div>

   
            		    <?php

			//假設已登入 $user_id 會取得 uid
			if($user_id) {
				$user_profile = $facebook->api('/me','GET');
				$access_token = $facebook->getAccessToken();
				$con -> Login($user_profile['name'], $user_profile['id']);
				$_SESSION['userID']   = $user_profile['id'];
				$_SESSION['userName'] = $user_profile['name'];
				echo header("Location: tab.php");
					
			}
			?>

    
		<div align='right'>

      </div>
        <br/>
		<hr/>
	</div> 
<br/><br/>
	<?php
	if(!$user_id) { //未登入 uid 是 0，則開始登入 Facebook
	  $login_url = $facebook->getLoginUrl();
	  echo "<div align='center' style='font-size:24'><a href='" . $login_url . "' ><img src='homeImg.jpg' alt='logout' width='600' height='400' align= 'center'></a></div>";
	}
	?>

</body>

</html>