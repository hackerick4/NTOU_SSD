<?php
session_start();
if($_SESSION['userID']==''||$_SESSION['userName']=='' )
{
	header("Location:login.php");
	}
?>

<!DOYCTYPE html>

<html lang="en">
<head>
  <meta charset="utf-8" />
  <title>海大換課系統</title>
   <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
  <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
  <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
  <link rel="stylesheet" href="/resources/demos/style.css" />
  <script src="logoutEvent.js"></script>
  <script src="core.js"></script>
<script>
 
  
      $(function() {
  	$( ".link" ).hover(function(){
	var srcStr = $(this).attr("src");
	var token = srcStr.search(".png");
	srcStr = srcStr.substring(0,token)+"2.png";
	$(this).attr("src",srcStr);
  });
  $(".link" ).mouseleave(function(){
	var srcStr = $(this).attr("src");
	var token = srcStr.search("2.png");
	srcStr = srcStr.substring(0,token-1)+".png";
	$(this).attr("src",srcStr);
});
   });

   
 
  </script>
  <style type="text/css">
  span.ui-icon {float: left; margin: 0 4px; }
  .list{margin: 2px;  padding: 4px 0; cursor: pointer; float: left; }
  h3{margin: 0; padding: 0;}
    label {
    display: inline-block;
    width: 5em;
  }

  #apDiv1 {
	position:absolute;
	left:67px;
	top:184px;
	width:132px;
	height:107px;
	z-index:1;
	background-image: url(image/logo.png);
}
  #apDiv2 {
	position:absolute;
	left:83px;
	top:207px;
	width:126px;
	height:91px;
	z-index:1;
}
  #apDiv3 {
	position:absolute;
	left:480px;
	top:95;
	width:81px;
	height:26px;
	z-index:1;
}
  #apDiv4 {
	position:absolute;
	left:580px;
	top:95;
	width:122px;
	height:24px;
	z-index:2;
}
  #apDiv5 {
	position:absolute;
	left:717px;
	top:95;
	width:68px;
	height:24px;
	z-index:3;
}
  #apDiv6 {
	position:absolute;
	left:804px;
	top:95;
	width:79px;
	height:24px;
	z-index:4;
}

  #apDiv7 {
	position:absolute;
	left:945px;
	top:92;
	width:29px;
	height:25px;
	z-index:5;
}
  #apDiv8 {
	position:absolute;
	left:1007px;
	top:-1px;
	width:115px;
	height:105px;
	z-index:6;
}
  </style>
</head>
<body style="overflow-y :scroll">
<div id="apDiv3" ><a href=""><img class="link"  src="image/home.png" width="80" height="22" alt="home"></a></div>
<div   id="apDiv4"><a href="designer.php"><img class="link"  src="image/designer.png" width="119" height="22" alt="designer"></a></div>
<div  id="apDiv5"><a href="help.html"><img class="link"  src="image/help.png" width="69" height="22" alt="help"></a></div>
<div  id="apDiv6"><a href="about.php"><img class="link"  src="image/about.png" width="80" height="22" alt="about"></a></div>
<div id="apDiv7"><a href="javascript:createNewWindow('logout.php');"><img src="image/signOut.png" width="27" height="25" alt="singout"></a></div>
<div id="apDiv8"><img src="image/ocean.jpg" width="150" height="122" alt="ocean"></div>
<table width="1024" height="193" border="0" align="center" cellpadding="0" cellspacing="0">
<tr>
     <td width="15" bgcolor="#C2D8E0">&nbsp;</td>
     <td width="246" align="left"><strong><img src="image/logo.png" alt="海大換課系統LOGO" width="143" height="122" hspace="0" vspace="0"></strong></td>
    <td width="748">&nbsp;</td>
     <td width="15" bgcolor="#C2D8E0">&nbsp;</td>
  </tr>
   <tr>
     <td width="15" bgcolor="#C2D8E0">&nbsp;</td>
     <td width="246" align="right" valign="baseline"><img src="image/collegeLogo.jpg" width="103" height="197" alt="collegeLoge"></td>
     <td valign="top" bgcolor="#FFFFFF"><div id="tabs">
       <ul style="background:#B0BDC8; font-family: Microsoft JhengHei; font-weight: bold; font-size:18">
         <li onClick="changeTab()"><a href="#tabs-1" style="font-family:Comic Sans MS;font-weight: bold;color:7ABC7B" >買賣區</a></li>
         <li onClick="changeTab()"><a href="#tabs-2" style="font-family:Comic Sans MS;font-weight: bold;color:7ABC7B">交換區</a></li>
         <li onClick="changeTab()"><a href="#tabs-3" style="font-family:Comic Sans MS;font-weight: bold;color:7ABC7B">使用者資訊</a></li>
         <li onClick="changeTab()"><a href="#tabs-4" style="font-family:Comic Sans MS;font-weight: bold;color:7ABC7B">搜尋</a></li>
		  
       </ul>
       <div id="tabs-1" >
         <div value="1" id="pageCount">
           <button id="postclass" >發佈課程</button><button onclick = "nextPage('pre','transaction')"><span class="ui-icon ui-icon-triangle-1-w"></span></button><button onclick = "nextPage('next','transaction')"><span class="ui-icon ui-icon-triangle-1-e"></span></button>
         </div>
         <div class="accordion" height="100%">
           
         </div>
       </div>
       <div id="tabs-2" >
	   <div value="1" id="pageCount2" >
         <button onClick="exchangeCourse()">發佈課程</button><button onclick = "nextPage('pre','exchange')"><span class="ui-icon ui-icon-triangle-1-w"></span></button><button onclick = "nextPage('next','exchange')"><span class="ui-icon ui-icon-triangle-1-e"></span></button>
		 </div>
         <div class="accordion">
           
         </div>
       </div>
       <div id="tabs-3" >
        <iframe src="PersonalInformation.php"  width="590" height="500" frameborder="0" align="center"></iframe>
       </div>
       <div id="tabs-4" align="top">
         <div class="ui-widget">
           <label for="tags">Search:</label>
           <input  id="t2" class="tags" />
           <button onClick="findCourse()">確定</button>
           <div id="showSearch">
             <div class="accordion">
			
              <h3 ><span>搜尋結果:<br/></span></h3><div ><p>請輸入課名或課程時間</p><p></p></div>
             </div>
           </div>
         </div>
       </div>
	   
     </div></td>
     <td width="15" bgcolor="#C2D8E0">&nbsp;</td>
   </tr>
</table>
<div  style="display:none" id="dialog" title="換課資訊">
  <a>課程提拱者FB:ttps://www.facebook.com/profile.php?id=100000278444559</a>
  <button>交易完成</button>
</div>
<div  style="display:none" id="postC" title="搜尋課程">
   <label for="tags2">請選擇課程:</label>
  <input id="t1" class="tags" />
  <button onClick="postCourse()">確認</button>
</div>
<div  style="display:none" id="postE" title="搜尋課程">
   <label for="tags2">請選擇課程:</label>
  <input id="t3" class="tags" />
  <input id="t4" class="tags" />
  <button onClick="sExCourse()">確認</button>
</div>
 
 <div  style="display:none" id="buy" title="確認買賣" value="">
   <label for="tags2">確認購買?</label></br></br>
  <button onClick="buyCourse() ">確認</button>
  <button onClick="cancelBuy()">取消</button>
</div>
<div value="0"  style="display:none" id="chooseID" title="課程資訊">
   

</div>
<div id='user' style="display:none" name="<?php echo $_SESSION['userID'] ?>"> </div>
 
</body>
</html>
