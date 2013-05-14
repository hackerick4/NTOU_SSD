<?php
    header("Content-Type:text/html; charset=utf-8");
	include 'sql.php';
	class SSD_DB_Service{
		var $DB;
	    var $result;
		var $dataArray;
		var $currentPostCountAt;
		
	  function SSD_DB_Service(){
	            $currentPostCountAt =1;
		        $this->DB = new MySQL('ssd', 'root','', 'localhost');
		}
		
      function Get_all_course(){
		     $dataArray = array();
			 $dataArray = $this->DB->Select('course_info');
			// echo json_encode($dataArray,JSON_UNESCAPED_UNICODE);
			return json_encode($dataArray,JSON_UNESCAPED_UNICODE);
		}
		function Get_course_rate($courseID){
		     $courseID = $this->DB->SecureData($courseID);
			 $dataArray = array();
			 $dataArray = $this->DB->Select('course_info',"`course_ID` = '{$courseID}'");
			// echo $dataArray["rating"];
			 return   $dataArray["rating"];
		}
		
		function Get_current_courses($page, $count){
		   $dataArray = array();
		   $from = $count*($page-1);
		   $to = $page*$count;
		  $dataArray = $this->DB->Select('current_posts',''," '{$from}','{$to}' ");
		 // echo json_encode($dataArray,JSON_UNESCAPED_UNICODE);
		  return json_encode($dataArray,JSON_UNESCAPED_UNICODE);
		}
	    function Post_a_course($fbID, $want_send_courseID, $want_recieve_courseID){
			$newUser = array('fb_ID' => $fbID, 'send_course_ID' => $want_send_courseID , 'recieve_course_ID' =>$want_recieve_courseID, 'state' => 'ready');
		    $this->DB->Insert($newUser,'current_posts');
		}
	}
?>