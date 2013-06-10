<?php
include 'DB_service.php';
header("Content-Type:text/html; charset=utf-8");

$con = new SSD_DB_Service;

$type = $_POST["type"];
if($type==="exchange"||$type==="transaction")
{
$page = $_POST["page"];
echo $con -> getCurrentCourses($page, 10,$type);
}
else if($type ==='search')
{
$keyWord = $_POST["keyWord"];
echo $con -> fuzzySearch($keyWord);
}
else if($type ==='find')
{
	$keyWord = $_POST["keyWord"];
	echo $con -> fuzzySearch($keyWord,'current_posts','transaction');
}
else if($type ==='buy')
{
	$id = $_POST["keyWord"];
    $uId = $_POST["uID"];
	$state = $con -> getPersonalURL($id ,$uId);
	if($state==="權力點數不足")
		;
	else
	$con ->setCourseState($id,'complete');
	echo $state;
	//echo $uId;
}
else if($type ==='post')
{
$courseName = $_POST["keyWord"];
echo $con -> getCourseID($courseName);
}
else if($type ==='send')
{
$courseID = $_POST["keyWord"];
$userID = $_POST["userID"];
$con -> postACourse($userID, $courseID);
echo "成功";
}
else if($type ==='ex')
{
$courseID1 = $_POST["keyWord1"];
$courseID2 = $_POST["keyWord2"];
$userID = $_POST["userID"];
echo $con -> postACourse($userID,$courseID1,$courseID2);
}
else if($type ==='rate')
{
	$rate = $_POST["uRate"];
	$uId = $_POST["userID"];
	$cId = $_POST["cID"];
	echo $con -> setCourseRate($uId,$cId ,$rate);
	
}
else if($type ==='buyEx')
{
	$id = $_POST["keyWord"];
	echo $con -> getPersonalURLInEC($id);
	$con ->setCourseState($id,'complete');
}
//echo $con -> getPersonalURL('40' ,'100001587848190');
//echo $con -> postACourse('100001587848190', '654','135');
//echo $con -> setCourseRate('123456789981234','B1234568',"3");
//echo $con -> fuzzySearch('軟');
//echo PHP_VERSION;
//echo $con -> fuzzySearch("軟",'current_posts','transaction');
//$con -> getAllCourse();  
//echo $con -> getCourseRate("B1234567");
//echo $con -> getCurrentCourses(1, 6,'exchange');
//
//echo $con -> getCurrentCourses(1, 6,'transaction');
//$con -> postACourse('123456789569874', 'B1234578');
//echo $con -> postACourse('123456789987654', 'B7654321','B7654321');
//$con -> setCourseRate('123456789987654','B1234888',3);
//$con -> Login('詹肥肥3號', '123456789981234');
//echo $con -> getCourseID('微積分');
//$con -> getCourseName('B1234567');
//$con -> getPersonalURL('123456789123456','123456789987654');
//echo $con -> getPersonalURL('100004033365714','123456789987654');
//$con -> getRatedCourses('123456789123456');
//echo $con -> fuzzySearch('302');
//$con -> getHistory('123456789569874');
?>