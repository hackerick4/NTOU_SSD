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
  <title>about</title>
  <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
  <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
  <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
  <link rel="stylesheet" href="/resources/demos/style.css" />
  <script src="logoutEvent.js"></script>
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
  .spam {
	font-family: "Comic Sans MS", cursive;
}
  span {
	font-family: Comic Sans MS, cursive;
}
  span {
	font-family: Comic Sans MS, cursive;
}
  span {
	font-family: Comic Sans MS, cursive;
}
  span {
	color: #F93;
}
  .name {
	color: #000;
}
  span {
	color: #36F;
}
  span {
	color: #36C;
}
  #apDiv9 {
	position:absolute;
	left:802px;
	top:189px;
	width:106px;
	height:83px;
	z-index:7;
}
  #apDiv10 {
	position:absolute;
	left:510px;
	top:181px;
	width:331px;
	height:119px;
	z-index:7;
	font-family: Arial, Helvetica, sans-serif;
	color: #36C;
	text-align: left;
	font-size: 18px;
}
  </style>
</head>
<body>
<div id="apDiv3" ><a href="tab.php"><img class="link"  src="image/home.png" width="80" height="22" alt="home"></a></div>
<div   id="apDiv4"><a href="designer.php"><img class="link"  src="image/designer.png" width="119" height="22" alt="designer"></a></div>
<div  id="apDiv5"><a href="help.html"><img class="link"  src="image/help.png" width="69" height="22" alt="help"></a></div>
<div  id="apDiv6"><a href=""><img class="link"  src="image/about.png" width="80" height="22" alt="about"></a></div>
<div id="apDiv7"><a href="javascript:createNewWindow('logout.php');"><img src="image/signOut.png" width="27" height="25" alt="singout"></a></div>
<div id="apDiv8"><img src="image/ocean.jpg" width="150" height="122" alt="ocean"></div>
<div id="apDiv10">這是一個換課的資訊交流平台，可以讓海大的學生利用此系統張貼自己不需要的課程，需要課程的人就&nbsp;&nbsp;&nbsp;&nbsp;可以在此瀏覽想要的課程，甚至是想要用A課換取B課的訊息也能張貼，也提供搜尋功能和自動配對的功能可以加速瀏覽。</div>
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
     <td align="left" valign="top" bgcolor="#FFFFFF">&nbsp;</td>
     <td width="15" bgcolor="#C2D8E0">&nbsp;</td>
   </tr>
  <tr>
    <td bgcolor="#C2D8E0">&nbsp;</td>
    <td align="right" valign="baseline">&nbsp;</td>
    <td align="left" valign="top" bgcolor="#FFFFFF">&nbsp;</td>
    <td bgcolor="#C2D8E0">&nbsp;</td>
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
 
 <div  style="display:none" id="buy" title="確認買賣">
   <label for="tags2">確認購買?</label></br></br>
  <button onClick="buyCourse() ">確認</button>
  <button onClick="cancelBuy()">取消</button>
</div>
<div value="0"  style="display:none" id="chooseID" title="課程資訊">
   

</div>
<div id='user' style="display:none" name="<?php echo $_SESSION['userID'] ?>"> </div>
 
</body>
</html>
