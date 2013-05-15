<?php
header("Content-Type:text/html; charset=utf-8");
include 'DB_service.php';

/*SSD_DB_Service()  建構元*/
$con = new SSD_DB_Service;

/*Get_all_course()  取得全部的課程資訊
   回傳範例 : 
      [{"department":"資工系","course_ID":"B1234567","course_name":"軟體工程","course_time":"202,203,204","teacher":"馬上冰","rating":"2"},{"department":"商船系","course_ID":"B7654321","course_name":"微積分","course_time":"102,203,204","teacher":"程懷懷","rating":"4"}]
*/
$con -> Get_all_course();  
/*
   Get_course_rate($courseID)  取得某課程的評比分數
   參數 : $courseID:課程ID
   回傳範例 : 2
*/
$con -> Get_course_rate("B1234567");


/*
   Get_current_courses($page, $count)
   取得目前張貼的資訊
   參數 : $page : 第幾頁
              $count : 需要幾筆
		    EX : (1,6) 為第一頁，每筆頁數為6，也就會回傳1~6筆
			        (3,6) 為第三頁，每筆頁數為6，也就會回傳13~18筆
					
	回傳範例 : [{"fb_ID":"123456789123456","post_time":"2013-05-13 02:12:04","send_course_ID":"B1234567","state":"ready","recieve_course_ID":"B7654321","PostID":"1"},{"fb_ID":"123654987456214","post_time":"2013-05-15 00:29:41","send_course_ID":"M897542","state":"ready","recieve_course_ID":"B8547896","PostID":"4"}]
	
*/
$con -> Get_current_courses(3, 6);

/* Post_a_course($fbID, $want_send_courseID, $want_recieve_courseID)
    張貼一則新資訊
	參數 : $fbID: FBID
	           $want_send_courseID : 要送出的課程之ID
			   $want_recieve_courseID : 想要得到課程之ID
*/
$con -> Post_a_course('123654987456214', 'M897542');


$con -> Login('詹肥肥2號', '123456789987654', 'LoginSuccess11156');
?>