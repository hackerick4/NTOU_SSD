<?php
	require_once('DB_Service.php');
	$con = new SSD_DB_Service;
	$con -> deleteFromCurrentCourse ($_POST['postID']);
	echo "刪除成功，頁面將於三秒後跳轉";
?>
<html>
<script language="JavaScript">

</script>
<meta charset="utf-8">
<head>
</head>
<body onload="javascript:parent.window.location.reload();" >

</body>
