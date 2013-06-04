<?php
    header("Content-Type:text/html; charset=utf-8");
	include 'sql.php';
	class SSD_DB_Service{
		
	  function SSD_DB_Service(){
	            $this->DB = new MySQL('ssd', 'root','', 'localhost');
		}
		
	function getHistory($fbID){
			$parameterArray = array ('fb_ID' => $fbID);
			$dataArray = array();
			$dataArray = $this->DB->Select('current_posts',$parameterArray);
			//echo json_encode($dataArray,JSON_UNESCAPED_UNICODE);
			return json_encode($dataArray,JSON_UNESCAPED_UNICODE);
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
		
		function getCourseTime($courseID){
			  $parameterArray = array ('course_ID' => $courseID);
			 $dataArray = array();
			 $dataArray = $this->DB->Select('course_info',$parameterArray);
			 //print_r ($dataArray);
			 return  $dataArray["course_time"];
			}
		function getCourseTeacher($courseID){
			  $parameterArray = array ('course_ID' => $courseID);
			 $dataArray = array();
			 $dataArray = $this->DB->Select('course_info',$parameterArray);
			 //print_r ($dataArray);
			 return  $dataArray["teacher"];
			}
			
		private function fixCurrentResultArray(&$dataArray){
				$sendCourseName =  $this -> getCourseName($dataArray["send_course_ID"]);
				$recieveCourseName =  $this -> getCourseName($dataArray["recieve_course_ID"]);
				$dataArray["sendCourseName"] = $sendCourseName;
				$dataArray["sendCourseRate"] = $this -> getCourseRate($dataArray["send_course_ID"]);
				$dataArray["sendCourseTeacher"] = $this -> getCourseTeacher($dataArray["send_course_ID"]);
				$dataArray["sendCourseTime"] = $this -> getCourseTime($dataArray["send_course_ID"]);
				if ($recieveCourseName){
					$dataArray["recieveCourseName"] = $recieveCourseName;
					$dataArray["recieveCourseRate"] = $this -> getCourseRate($dataArray["recieve_course_ID"]);
					$dataArray["recieveCourseTeacher"] = $this -> getCourseTeacher($dataArray["recieve_course_ID"]);
					$dataArray["recieveCourseTime"] = $this -> getCourseTime($dataArray["recieve_course_ID"]);
					}	
		}
			
		function getCurrentCourses($page, $count,$type){
		   $dataArray = array();
		   $from = $count*($page-1);
		   $to = $page*$count;
		   $conditionArray= array();
		   if ($type == 'exchange') $conditionArray = array ('recieve_course_ID' => '<>none');
		   else if ($type == 'transaction') $conditionArray =  array ('recieve_course_ID' => 'none');
		  $dataArray = $this->DB->Select('current_posts',$conditionArray);
		  $dataArray = array_slice($dataArray,$from,$count);
		  
		  foreach ($dataArray as &$rowArray){
			if( !is_array($rowArray)) {
			  		$this -> fixCurrentResultArray($dataArray);
				break;
			}
			$this -> fixCurrentResultArray($rowArray);
		 }
		 
	   	  echo json_encode($dataArray,JSON_UNESCAPED_UNICODE);
		  return json_encode($dataArray,JSON_UNESCAPED_UNICODE);
		}
		private function postInTransactionArea($fbID, $want_send_courseID){
			$newCourse = array('fb_ID' => $fbID, 'send_course_ID' => $want_send_courseID , 'state' => 'ready');
		    $this->DB->Insert($newCourse,'current_posts');
		}
		
		private function bestMatchCheck($want_send_courseID, $want_recieve_courseID){
		    //A換B 需要符合B換A
			$conditionArray = array('send_course_ID' => $want_recieve_courseID, 'recieve_course_ID' =>$want_send_courseID );
			$matchCourses = $this -> DB -> Select('current_posts',$conditionArray);
			if ($matchCourses==1) return 'non-match' ;//找不到
			else return $matchCourses[0];
		}
		
		private function postInExchangeArea($fbID, $want_send_courseID, $want_recieve_courseID){
		   $result = $this -> bestMatchCheck($want_send_courseID, $want_recieve_courseID);
		   if ($result == 'non-match'){
				$newCourse = array('fb_ID' => $fbID, 'send_course_ID' => $want_send_courseID , 'recieve_course_ID' =>$want_recieve_courseID, 'state' => 'ready');
				$this->DB->Insert($newCourse,'current_posts');
			}
			 return $result;
		}
		
	    function postACourse($fbID, $want_send_courseID, $want_recieve_courseID='none'){
		   if ($want_recieve_courseID == 'none') {
				$this -> postInTransactionArea($fbID, $want_send_courseID); 
				return;
				}
		   else $result = $this -> postInExchangeArea($fbID, $want_send_courseID, $want_recieve_courseID);
		   
		   if ($result != 'non-match')  return json_encode($result,JSON_UNESCAPED_UNICODE);
		   else return 'non-match';
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
		
		function setCourseRate($fbID,$courseID,$newValue){
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
			return json_encode($ratedCoursesArray,JSON_UNESCAPED_UNICODE);
		}
		
		private function is_chinese($str) {
			return preg_match("/\p{Han}+/u", $str);
		}
		
		private function setupResultFromFuzzy($matchPIDArray){
		$matchArray = array();
		  foreach ($matchPIDArray  as $PostID){
			$conditionArray = array ('PostID' => $PostID);
			$dataArray = $this -> DB -> Select('current_posts' , $conditionArray);
			$this -> fixCurrentResultArray($dataArray);
			array_push($matchArray,$dataArray);
			
		  }
		  return $matchArray;
		//print_r($matchArray);
		}
		
		function fuzzySearch($fuzzyString , $place = 'course_info' , $type){
		//if (! $this -> is_chinese($fuzzyString)) return "error_parameter" ;  
		  $dataArray = array();
		  $dataArray = $this->DB->Select($place);
		  $resultArray = array();
		  if ($place == 'course_info'){
			  foreach  ($dataArray as $row){
				$distance= $this->compareWithWord($row['course_name'],$fuzzyString);
				if (  $distance <= abs(mb_strlen($fuzzyString, 'utf-8') - mb_strlen($row['course_name'], 'utf-8') ) 
					 || ($distance < mb_strlen($fuzzyString, 'utf-8') && $distance <mb_strlen($row['course_name'], 'utf-8'))
				)
					array_push($resultArray,$row['course_name']);
				}
			//print_r($resultArray);
			return json_encode($resultArray,JSON_UNESCAPED_UNICODE);
		  }
		  else if ($place == 'current_posts' && $type == 'exchange'){
				 foreach  ($dataArray as $row){
						$sendCourseName =  $this -> getCourseName( $row[ 'send_course_ID' ]);
						$recieveCourseName =  $this -> getCourseName( $row[ 'recieve_course_ID' ]);
						$distance= $this->compareWithWord($sendCourseName,$fuzzyString) ; // sendCourseName distance
						if (  $distance <= abs(mb_strlen($fuzzyString, 'utf-8') - mb_strlen($sendCourseName, 'utf-8') ) 
							 || ($distance < mb_strlen($fuzzyString, 'utf-8') && $distance <mb_strlen($sendCourseName, 'utf-8')) )
							array_push($resultArray,$row[ 'PostID' ]);
						
						if ($recieveCourseName=="") continue;
						$distance= $this->compareWithWord($recieveCourseName,$fuzzyString); // recieveCourseName distance
						if (  $distance <= abs(mb_strlen($fuzzyString, 'utf-8') - mb_strlen($recieveCourseName, 'utf-8') ) 
							 || ($distance < mb_strlen($fuzzyString, 'utf-8') && $distance <mb_strlen($recieveCourseName, 'utf-8')) )
							array_push($resultArray,$row[ 'PostID' ]);
						}
					$resultArray = $this -> setupResultFromFuzzy($resultArray);
					//echo  json_encode($resultArray,JSON_UNESCAPED_UNICODE);
					return json_encode($resultArray,JSON_UNESCAPED_UNICODE);
		  }
		  
		  else if ($place == 'current_posts' && $type == 'transaction'){
					 foreach  ($dataArray as $row){
						$recieveCourseName =  $this -> getCourseName( $row[ 'recieve_course_ID' ]);
						if ($recieveCourseName!="") continue;
						$sendCourseName =  $this -> getCourseName( $row[ 'send_course_ID' ]);
						$distance= $this->compareWithWord($sendCourseName,$fuzzyString) ; // sendCourseName distance
						if (  $distance <= abs(mb_strlen($fuzzyString, 'utf-8') - mb_strlen($sendCourseName, 'utf-8') ) 
							 || ($distance < mb_strlen($fuzzyString, 'utf-8') && $distance <mb_strlen($sendCourseName, 'utf-8')) )
							array_push($resultArray,$row[ 'PostID' ]);
						}
					
					$resultArray = $this -> setupResultFromFuzzy($resultArray);
					//echo  json_encode($resultArray,JSON_UNESCAPED_UNICODE);
					return json_encode($resultArray,JSON_UNESCAPED_UNICODE);
		  
		  }
		}
		
		
		private function compareWithWord($stringA,$stringB){
			//prepare var
			
			$stringA_len = mb_strlen($stringA, 'utf-8');
			$stringB_len = mb_strlen($stringB, 'utf-8');
		    if (!$this -> is_chinese($stringB)) $stringB = utf8_encode($stringB);
		/*	echo $stringA.":".$stringA_len;
			echo "</br>";
			echo $stringB .":".$stringB_len;
			echo "</br>";
		*/
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
	/*	echo "dis : " . $distance;
		echo "</br>-----------------</br>";*/
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