<?php
header("Content-Type:text/html; charset=utf-8");
include 'DB_service.php';


//echo PHP_VERSION;
$con = new SSD_DB_Service;
//echo $con -> getAllCourse();  
//echo $con -> getCourseRate("10");
//echo $con -> getCurrentCourses(1, 6,'exchange');
//echo $con -> getCurrentCourses(1, 6,'transaction');
//echo $con -> postACourse('123456789569874', '654','135');
//echo $con -> setCourseRate('123456789987654','4',3);
//$con -> Login('詹肥肥3號', '123456789981234');
//echo $con -> getCourseID('線性代數') ;
//echo $con -> getCourseName('50');
//echo $con -> getPersonalURL('1','123456789569874');
//$con -> getRatedCourses('123456789123456');
echo $con -> fuzzySearch('微分');
//$con -> deleteFromCurrentCourse('32');
//echo $con -> fuzzySearch('302');
//echo $con -> fuzzySearch('軟工','current_posts','transaction');
//$con -> getHistory('123456789569874');
//$con -> setCourseState(18,'processing')
?>