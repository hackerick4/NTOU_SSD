<?php
header("Content-Type:text/html; charset=utf-8");
include 'DB_service.php';

$con = new SSD_DB_Service;
//$con -> getAllCourse();  
//$con -> getCourseRate("B1234567");
//$con -> getCurrentCourses(1, 6);
//$con -> postACourse('123456789569874', 'M897542');
//$con -> setCoutseRate('123456789987654','B1234888',3);
//$con -> Login('詹肥肥3號', '123456789981234');
//$con -> getCourseID('軟體工程');
//$con -> getCourseName('B1234567');
//$con -> getPersonalURL('123456789123456','123456789987654');
$con -> getRatedCourses('123456789123456');
?>