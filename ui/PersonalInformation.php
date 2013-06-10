<?php
	session_start();
	header("Content-Type:text/html; charset=utf-8");
	require_once('DB_Service.php');

//echo $_SESSION['userID'];
$con = new SSD_DB_Service;

$jstring = $con -> getHistory($_SESSION['userID']);
$personInfo = json_decode($jstring);

?>
<html>
<meta charset="utf-8">
<head>
</head>
<body>
<?php
echo "使用者名稱:".$_SESSION['userName']."<br/>";
echo "您尚有  ".$con -> getRightPoint($_SESSION['userID'])." 點權力點數";
echo "紀錄:<br/>";
echo "<ul>";

if($jstring=="true")
{
	echo"尚無任何換課紀錄</ul>";
}

else
{
	if(count($personInfo)==1)
		$personInfo = array(json_decode( $jstring));

	for( $i=0; $i< count($personInfo); $i++)
	{
		echo "<li>"	;
		echo "<b style='color:blue;'>";
		if($personInfo[$i]-> state=='ready')
		echo "<image width='20' height='20' src='image/ready.png'>";
		else
		echo "<image width='20' height='20' src='image/complete.png'>";
		echo "</b>&nbsp&nbsp";
		echo date("Y / m / d  ",strtotime($personInfo[$i]-> post_time))."&nbsp&nbsp";
		if($personInfo[$i]-> recieve_course_ID =="NULL")
		{
			echo "送出&nbsp&nbsp";
			echo "".$con->getCourseName($personInfo[$i]-> send_course_ID)." ";
		}
		else
		{
				echo $con->getCourseName($personInfo[$i]-> send_course_ID)." ";
				echo "&nbsp&nbsp交換&nbsp&nbsp";
				echo $con->getCourseName($personInfo[$i]-> recieve_course_ID);
		}
		if($personInfo[$i]-> state=='ready')
		{
			echo "<input type='submit' name = 'submit' value='Cancel'  onclick='javascript:confirmSubmit(".$personInfo[$i]-> PostID.");'/>";
		}
		echo "<br/></li>";
	}
		echo "</ul>";
}
?>
<form action='CancelTransaction.php' method='POST' name='form1' id='form1'  target='cancel' style='display:none;'>
	<input type='hidden' id='postID' name='postID' value='PostID' />
</form>
<iframe src='' name='cancel' id='cancel' width="0" height="0"></iframe>
</body>
<script language="JavaScript" src="logoutEvent.js"></script>
<script>

		function confirmSubmit(parameter) 
		{
			document.getElementById("postID").value = parameter;
			if (confirm("Are you sure you want to submit the form?"))
			{
				document.getElementById("form1").submit();				
				alert("delete successful");
			}
			return false;
		}

</script>
