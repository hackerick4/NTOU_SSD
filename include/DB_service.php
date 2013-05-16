<?php
    header("Content-Type:text/html; charset=utf-8");
	include 'sql.php';
	class SSD_DB_Service{
		var $DB;
	    var $result;
		var $dataArray;
		
	  function SSD_DB_Service(){
	            
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
		
		
	    function Post_a_course($fbID, $want_send_courseID, $want_recieve_courseID='NULL'){
			$newCourse = array('fb_ID' => $fbID, 'send_course_ID' => $want_send_courseID , 'recieve_course_ID' =>$want_recieve_courseID, 'state' => 'ready');
		    $this->DB->Insert($newCourse,'current_posts');
		}
		
		function Login($userName, $fbID, $FB_token){
			 $fbID = $this->DB->SecureData($fbID);
			 $dataArray = array();
			 $dataArray = $this->DB->Select('user',"`fb_ID` = '{$fbID}'");
			// print_r($dataArray);
		if ($dataArray==1) { 
		  // echo "新增使用者";
		    $newUser= array('user_name' => $userName, 'fb_ID' => $fbID, 'login_token' => $FB_token);
			$this->DB->Insert($newUser, 'user');
			}else{ //the user have registered, just update the token
			   $updateArray = array('login_token' => $FB_token);
			   $conditionArray = array('fb_ID' => $fbID);
			   $this -> DB -> Update('user',$updateArray,$conditionArray);
			}
		}
		
		function Set_CoureRate($courseID,$newValue){
		     $courseID = $this->DB->SecureData($courseID);
			 $dataArray = array();
			 $dataArray = $this->DB->Select('course_info',"`course_ID` = '{$courseID}'");
			 $newValue = ($dataArray["rating"]+$newValue)/($dataArray["rateCount"]+1);
			 //prepare var
			 $newRatingArray = array('rating' => $newValue, 'rateCount' => $dataArray["rateCount"]+1);
			  $conditionArray = array('course_ID' => $courseID);
			 $this -> DB -> Update('course_info',$newRatingArray,$conditionArray);
		}
		
		function Get_CourseID($courseName){
			$courseName = $this -> DB -> SecureData($courseName);
			$dataArray = array();
			$dataArray = $this->DB->Select('course_info',"`course_name` = '{$courseName}'");
			//echo $dataArray["course_ID"];
			return $dataArray["course_ID"];
		}
		
		function Get_CourseName($courseID){
			$courseID = $this -> DB -> SecureData($courseID);
			$dataArray = array();
			$dataArray = $this->DB->Select('course_info',"`course_ID` = '{$courseID}'");
			//echo $dataArray["course_name"];
			return $dataArray["course_name"];
		}
		
		function Get_personalURL ($want_person, $post_person){
		    if ($want_person == $post_person) return '參數不可相同';
		    // 查看post個人網址的人 權力點數需要-1
		    $dataArray = array();
			$dataArray = $this->DB->Select('user',"`fb_ID` = '{$want_person}'");
			if ($dataArray['right_point']-1 < 0) return '權力點數不足';
			$decreasePointArray = array ('right_point' => $dataArray['right_point']-1);
			$decreaseConditionArray = array ('fb_ID' => $want_person);
			$this -> DB -> Update('user',$decreasePointArray,$decreaseConditionArray);
			
			$dataArray = array();
			$dataArray = $this->DB->Select('user',"`fb_ID` = '{$post_person}'");
			//echo 'http://www.facebook.com/profile.php?id='.$dataArray['fb_ID'];
			return 'http://www.facebook.com/profile.php?id='.$dataArray['fb_ID'];
		}
	}
?>