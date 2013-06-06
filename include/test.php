<?php
header("Content-Type:text/html; charset=utf-8");
include 'DB_service.php';


//echo PHP_VERSION;
$con = new SSD_DB_Service;
//$con -> getAllCourse();  
//$con -> getCourseRate("B1234567");
//$con -> getCurrentCourses(1, 6,'exchange');
//$con -> getCurrentCourses(1, 6,'transaction');
//$con -> postACourse('123456789569874', 'B1234567','B7654321');
//$con -> postACourse('123456789569874', 'B7654321','B1234567');
//$con -> setCourseRate('123456789987654','B1234888',3);
//$con -> Login('詹肥肥3號', '123456789981234');
//$con -> getCourseID('軟體工程');
//$con -> getCourseName('B1234567');
//echo $con -> getPersonalURL('33','123456789987654');
//$con -> getRatedCourses('123456789123456');
//echo $con -> fuzzySearch('C++');
//$con -> deleteFromCurrentCourse('32');
echo $con -> fuzzySearch('軟工');
//echo $con -> fuzzySearch('軟工','current_posts','transaction');
//$con -> getHistory('123456789569874');
//$con -> setCourseState(18,'processing')
?>