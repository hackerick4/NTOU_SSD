<?php
	session_start();
?>
<?php
  //載入剛剛下載的 SDK 檔案
  require_once('src/facebook.php');
  $config = array(
    'appId' => '170135173146497',
    'secret' => '922f39421a4bd2c114acc5c286a1f23a',
  );

  //Facebook 連線
  $facebook = new Facebook($config);
  $user_id = $facebook->getUser();
?>
<html>
<meta charset="utf-8">

<style type="text/css">
body {
	background-color: #FFFFFF;
}
body,td,th {
	color: #000000;
}
</style>
<head></head>
<body onUnload="opener.location.href='login.php' ">
<h3 align='center' valign='center'><br/><br/><br/><br/>您已成功登出，頁面將於三秒後跳轉</h3>
	<?php
			$facebook->destroySession();
			$logout = $facebook->getLogoutUrl();
			$facebook->setAccessToken('');
			echo "<meta http-equiv='refresh' content='3; url=javascript:top.window.close()'>";
			session_destroy();
	?>
<div align='center'>
	<a onclick="opener.location.href='login.php'" href='javascript:top.window.close()' align='center'>直接跳轉</a>
</div>
</body>
</html>