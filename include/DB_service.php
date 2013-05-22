<?php
    header("Content-Type:text/html; charset=utf-8");
	include 'sql.php';
	class SSD_DB_Service{
		
	  function SSD_DB_Service(){
	            $this->DB = new MySQL('ssd', 'root','', 'localhost');
		}
		
        function getAllCourse(){
		     $dataArray = array();
			 $dataArray = $this->DB->Select('course_info');
			 //print_r ($dataArray);
			// echo json_encode($dataArray,JSON_UNESCAPED_UNICODE);
			return json_encode($dataArray,JSON_UNESCAPED_UNICODE);
		}
      
	    function getCourseRate($courseID){
		     $parameterArray = array ('course_ID' => $courseID);
			 $dataArray = array();
			 $dataArray = $this->DB->Select('course_info',$parameterArray);
			 //print_r ($dataArray);
			// echo $dataArray["rating"];
			 return  $dataArray["rating"];
		}
		
		function getCurrentCourses($page, $count){
		   $dataArray = array();
		   $from = $count*($page-1);
		   $to = $page*$count;
		  $dataArray = $this->DB->Select('current_posts');
		  $dataArray = array_slice($dataArray,$from,$count);
		  //print_r ($dataArray);
		 // echo json_encode($dataArray,JSON_UNESCAPED_UNICODE);
		  return json_encode($dataArray,JSON_UNESCAPED_UNICODE);
		}
		
	    function postACourse($fbID, $want_send_courseID, $want_recieve_courseID='NULL'){
			$newCourse = array('fb_ID' => $fbID, 'send_course_ID' => $want_send_courseID , 'recieve_course_ID' =>$want_recieve_courseID, 'state' => 'ready');
		    $this->DB->Insert($newCourse,'current_posts');
		}
		
		function Login($userName, $fbID){
			 $parameterArray = array ('fb_ID' => $fbID);
			 $dataArray = array();
			 $dataArray = $this->DB->Select('user',$parameterArray);
		if ($dataArray==1) { 
		  //新增使用者
		    $newUser= array('user_name' => $userName, 'fb_ID' => $fbID);
			$this->DB->Insert($newUser, 'user');
			}
		}
		
		function setCoutseRate($fbID,$courseID,$newValue){
		     //set this fb_user can't rate the course again
			 $parameterArray = array ('fb_ID' => $fbID);
			 $dataArray = array();
			 $dataArray = $this->DB->Select('user',$parameterArray);
			 if (strstr($dataArray['ratedCourses'],$courseID)) 
				return "已經評比過該課程";
			 $newRatedCourses = array ('ratedCourses' => $dataArray['ratedCourses']. "," .$courseID);
		     $this -> DB -> Update('user',$newRatedCourses,$parameterArray);
			 
			 //count the rate avg and set the rate
		     $parameterArray = array ('course_ID' => $courseID);
			 $dataArray = array();
			 $dataArray = $this->DB->Select('course_info',$parameterArray);
			 $newValue = ($dataArray["rating"]+$newValue)/($dataArray["rateCount"]+1);
			 
			 //prepare var
			 $newRatingArray = array('rating' => $newValue, 'rateCount' => $dataArray["rateCount"]+1);
			 $conditionArray = array('course_ID' => $courseID);
			 $this -> DB -> Update('course_info',$newRatingArray,$conditionArray);
			 
		}
		
		function getCourseID($courseName){
		     $parameterArray = array ('course_name' => $courseName);
			 $dataArray = array();
			 $dataArray = $this->DB->Select('course_info',$parameterArray);
			//echo $dataArray["course_ID"];
			return $dataArray["course_ID"];
		}
		
		function getCourseName($courseID){
		     $parameterArray = array ('course_ID' => $courseID);
			 $dataArray = array();
			 $dataArray = $this->DB->Select('course_info',$parameterArray);
			//echo $dataArray["course_name"];
			return $dataArray["course_name"];
		}
		
		function getPersonalURL ($want_person, $post_person){
		    if ($want_person == $post_person) return '參數不可相同';
		    // 查看post個人網址的人 權力點數需要-1
		    $parameterArray = array ('fb_ID' => $want_person);
			$dataArray = array();
			$dataArray = $this->DB->Select('user',$parameterArray);
			if ($dataArray['right_point']-1 < 0) return '權力點數不足';
			$decreasePointArray = array ('right_point' => $dataArray['right_point']-1);
			$decreaseConditionArray = array ('fb_ID' => $want_person);
			$this -> DB -> Update('user',$decreasePointArray,$decreaseConditionArray);
			
			$parameterArray = array ('fb_ID' => $post_person);
			$dataArray = array();
			$dataArray = $this->DB->Select('user',$parameterArray);
			//echo 'http://www.facebook.com/profile.php?id='.$dataArray['fb_ID'];
			return 'http://www.facebook.com/profile.php?id='.$dataArray['fb_ID'];
		}
		
		function getRatedCourses($fbID){
			$parameterArray = array ('fb_ID' => $fbID);
			$dataArray = array();
			$dataArray = $this->DB->Select('user',$parameterArray);
			$ratedCourses_string = $dataArray["ratedCourses"];
			//print_r ($ratedCourses_string);
			$ratedCoursesArray = array();
			$token = strtok($ratedCourses_string,',');
			array_push($ratedCoursesArray,$token);
			while ( $token = strtok(','))    array_push($ratedCoursesArray,$token);
			//print_r ($ratedCoursesArray);
			return $ratedCoursesArray;
		}
		
		function fuzzySearch($fuzzyString){
		  $dataArray = array();
		  $dataArray = $this->DB->Select('course_info');
		  $resultArray = array();
		  foreach  ($dataArray as $row){
			if (  $this->compareWithWord($row['course_name'],$fuzzyString) <= abs(mb_strlen($fuzzyString, 'utf-8') - mb_strlen($row['course_name'], 'utf-8') ) )
				array_push($resultArray,$row['course_name']);
			}
		  return $resultArray;
		}
		
		private function compareWithWord($stringA,$stringB){
			//prepare var
			$stringA_len = mb_strlen($stringA, 'utf-8');
			$stringB_len = mb_strlen($stringB, 'utf-8');
			$distance_table = array();
		    //setup distance table
		    for ($i=0 ; $i < $stringA_len * $stringB_len; ++$i) $distance_table[ $i ] = 0;
			//print_r($distance_table);
		    //start to count  Levenshtein_Distance
			if( $stringA_len++ != 0 && $stringB_len++ != 0 ) {
			    for ( $k = 0; $k < $stringA_len; $k++)  $distance_table[$k] = $k;
                for ( $k = 0; $k < $stringB_len; $k++ )  $distance_table[ $k * $stringA_len ] = $k;
        
				for ( $i = 1; $i < $stringA_len; $i++ )
					for ( $j = 1; $j < $stringB_len; $j++ ) {
                        if( $stringA [ $i ]== $stringB [  $j  ] )  $cost = 0;
						else $cost = 1;
                        
                         $distance_table[ $j * $stringA_len + $i ] =  $this->smallest(
						                           $distance_table[ ($j - 1) * $stringA_len + $i ] + 1,
												   $distance_table [ $j * $stringA_len + $i - 1 ] +  1,
												   $distance_table[ ($j - 1) * $stringA_len + $i -1 ] + $cost 
													);
	            }
		
        $distance = $distance_table[ $stringA_len * $stringB_len - 1 ];
	     return $distance;
		}
		return 0;
		}
		
		
		private function smallest($a,$b,$c){
			  $min = $a;
			  if ( $b < $min )
					$min = $b;
              if( $c < $min )
				$min = $c;
			return $min;
		}
		
		
	
	}
?>