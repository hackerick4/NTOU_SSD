
 
 
 var checkPage1 = true;
   var checkPage2 = true;
   
 
   function closeChoose()
   {
    $("#chooseID").dialog('close');
   }
   
   function DbRate(cId)
   {
   var rate =  $("#chooseID").attr("value");
   var ownUserID = $("#user").attr("name");
   //alert(cId);
   $.ajax({
        url:"test.php",
        type: 'POST',
        async: false,
        cache: false,
        timeout: 30000,
		data:{userID:ownUserID,cID:cId,uRate:rate,type:"rate" },
        error: function(){
            return true;
        },
        success: function(data)
		{ 
		if(data=="已經評比過該課程")
			alert(data);
		else
		{
			alert("已成功評比");
			location.replace("tab.php");
			
			}
		closeChoose();
		
		}
		});
   
   }
   
   function updatRate(num,cId)
	{
    //alert(num);
	 $("#chooseID").attr("value",num);
	$("#chooseID").html("評比課程:<br>");
	var i=1
	for(;i<=num;i++)
	$("#chooseID").append("<image onclick=updatRate('"+i+"','"+cId+"') width='30' heigh='30'src='image/star2.png'></image>");
	for(;i<=5;i++)
	$("#chooseID").append("<image onclick=updatRate('"+i+"','"+cId+"') width='30' heigh='30'src='image/star_o.png'></image>");
	
	$("#chooseID").append("<br><button onclick=DbRate('"+cId+"')>確認</button>");
   }
   
   function setRate(cId)
   {
   //alert("fsd");
   $("#chooseID").attr("value","0");
	$("#chooseID").html("評比課程:<br>");
	$("#chooseID").dialog();
	for(var i=1;i<=5;i++)
	$("#chooseID").append("<image onclick=updatRate('"+i+"','"+cId+"') width='30' heigh='30'src='image/star_o.png'></image>");
	$("#chooseID").append("<br><button onclick='"+"DbRate('"+cId+"')"+"'>確認</button>");
   }
   
  function postExCourse()
  {
	var c1ID = $("input[name='C1']:checked").attr("value");
	var c2ID = $("input[name='C2']:checked").attr("value");
	 var ownUserID = $("#user").attr("name");
	//alert(c1ID);
	$.ajax({
        url:"test.php",
        type: 'POST',
        async: false,
        cache: false,
        timeout: 30000,
		data:{ keyWord1:c1ID,keyWord2:c2ID,userID:ownUserID,type:"ex" },
        error: function(){
            return true;
        },
        success: function(data)
		{ 
			
			
			if(data=="non-match")
			{
			alert("張貼成功");
			closeChoose();
			}
			else
			{
			var obj = JSON.parse(data);
			alert(data);
			$("#chooseID").html("找到符合資料!<br>是否確認交換?<br><button onclick=checkBuy('"+obj.PostID+"',"+"'buyEx'"+")>確認</button><button onclick='closeChoose()'>取消</button>");
			//$(#chooseID).dialog('close');
			 //alert(data);
			}
			location.replace("tab.php#tabs-2");
			
		}
		});
  }
   
   
 function reChoose2()
 {
 	$("#chooseID").dialog('close');
	$("#postE").dialog();
 }
 
function sExCourse()
{
	//alert("ex");
	var courseName1 = $("#t3").val();
	var courseName2 = $("#t4").val();
	$.ajax({
        url:"test.php",
        type: 'POST',
        async: false,
        cache: false,
        timeout: 30000,
		data:{ keyWord:courseName1,type:"post"},
        error: function(){
            return true;
        },
        success: function(data)
		{ 
		alert(data);
			var obj = JSON.parse(data);
			//alert(obj.length);
			$("#postE").dialog('close');
			
			$("#chooseID").html("<label for='tags3'>請選擇課程ID:</label><button onclick="+"reChoose2()"+">上一頁</button></br></br>"+courseName1+":</br>");
			for(var i=0;i<obj.length;i++)
			{
			if(i==0)
			{
			$("#chooseID").append("<input type='radio' name='C1' value="+obj[i].courseNum+" checked>"+obj[i].course_ID+"</br><span>"+
			obj[i].teacher+"<span><span>"+obj[i].courseTime+"</span><br>");
			}
			else
			{
			$("#chooseID").append("<input type='radio' name='C1' value="+obj[i].courseNum+" checked>"+obj[i].course_ID+"</br><span>"+
			obj[i].teacher+"<span><span>"+obj[i].courseTime+"</span><br>");
			}
			}
		}
		});
		$.ajax({
        url:"test.php",
        type: 'POST',
        async: false,
        cache: false,
        timeout: 30000,
		data:{ keyWord:courseName2,type:"post"},
        error: function(){
            return true;
        },
        success: function(data)
		{ 
			var obj = JSON.parse(data);
			//alert(obj.length);
			$("#chooseID").append(courseName2+":</br>");
			for(var i=0;i<obj.length;i++)
			{
			if(i==0)
			{
			$("#chooseID").append("<input type='radio' name='C2' value="+obj[i].courseNum+" checked>"+obj[i].course_ID+"</br><span>"+
			obj[i].teacher+"<span><span>"+obj[i].courseTime+"</span><br>");
			}
			else
			{
			$("#chooseID").append("<input type='radio' name='C2' value="+obj[i].courseNum+" checked>"+obj[i].course_ID+"</br><span>"+
			obj[i].teacher+"<span><span>"+obj[i].courseTime+"</span><br>");
			}
			}
			$("#chooseID").append("<button onclick="+"postExCourse()"+">確認送出</button>");
			$("#chooseID").dialog();
		}
		});
		
		

} 
function exchangeCourse()
{
	$("#postE").dialog();
}
function sendCourse(courseID)
{
	//alert(courseID);
	 var ownUserID = $("#user").attr("name");
	$.ajax({
        url:"test.php",
        type: 'POST',
        async: false,
        cache: false,
        timeout: 30000,
		data:{ keyWord:courseID,userID:ownUserID,type:"send" },
        error: function(){
            return true;
        },
        success: function(data)
		{ 
			//var obj = JSON.parse(data);
			alert(data);
			closeChoose();
			location.replace("tab.php");
		}
		});
	
}

function reChoose()
{
	$("#chooseID").dialog('close');
	$("#postC").dialog();
}

function postCourse()
{
	//alert(post)
	var courseName = $("#t1").val();
	$.ajax({
        url:"test.php",
        type: 'POST',
        async: false,
        cache: false,
        timeout: 30000,
		data:{ keyWord:courseName,type:"post" },
        error: function(){
            return true;
        },
        success: function(data)
		{ 
			var obj = JSON.parse(data);
			//alert(data);
			$("#postC").dialog('close');
			
			$("#chooseID").html("<label for='tags3'>請選擇課程ID:</label><button onclick="+"reChoose()"+">上一頁</button></br></br>");
			for(var i=0;i<obj.length;i++)
			$("#chooseID").append("<button onclick="+"sendCourse("+"'"+obj[i].courseNum+"')"+">"+obj[i].course_ID +"</button><br><span>"+
			obj[i].teacher+"</span><span>"+obj[i].courseTime+"</span></br>");
			$("#chooseID").dialog();
		}
		});
	

}
function changeTab()
{
 var options = {autoHeight:false};
				$( ".accordion" ).accordion('destroy');
				$( ".accordion" ).accordion({autoHeight:false});
$(".tags").val("");

checkPage = true;
}

function buyCourse()
{
	var id = $( "#buy" ).val();
	var type = $( "#buy" ).attr("value");
	//alert(type);
	//alert(id);
	cancelBuy();
	//alert(id);
	var check = $( "#"+id ).attr("value");
	//alert(check);
	if(check=="ready")
	{
	 var ownUserID = $("#user").attr("name");
	$.ajax({
        url:"test.php",
        type: 'POST',
        async: false,
        cache: false,
        timeout: 30000,
		data:{ keyWord:id,type:type,uID:ownUserID},
        error: function(){
            return true;
        },
        success: function(data)
		{ 
			if(data=="權力點數不足")
			alert(data);
			else
			{
				//alert("交易完成");
				$("#chooseID").html(data);
				$("#chooseID").dialog();
				var check = $( "#"+id ).attr("src","image/complete.png");
				var check = $( "#"+id ).attr("value","complete");
			}
		}
		});
	}
	else
	alert("此課程已終止交易");
}

function cancelBuy()
{
	$( "#buy" ).dialog('close');
}
function checkBuy(pId,type)
{
	//alert(type);
	//alert(fbId);
	$( "#buy" ).dialog();
	$( "#buy" ).val(pId);
	$( "#buy" ).attr("value",type);
	$("#chooseID").dialog('close');
}


function findCourse()
{
//alert("find");
	var keyWord = $(".tags").val();
	search("t2","find");

}
 function search(check,type)
 {
 //alert(type);
	if(check=="t1")
	var keyWord = $("#t1").val();
	else if(check=="t2")
	var keyWord = $("#t2").val();
	else if(check=="t3")
	var keyWord = $("#t3").val();
	else if(check=="t4")
	var keyWord = $("#t4").val();
	//alert(keyWord);
	//alert(keyWord);
	$.ajax({
        url:"test.php",
        type: 'POST',
        async: false,
        cache: false,
        timeout: 30000,
		data:{ keyWord:keyWord,type:type },
        error: function(){
            return true;
        },
        success: function(data)
		{ 
			$( ".tags" ).autocomplete({
			source: []
			});
			  var availableTags = JSON.parse(data);
			   var num = availableTags.length;
			  
			  //alert(data);
			if(type=="search")
			{
		
				$( ".tags" ).autocomplete("destroy");
				$( ".tags" ).autocomplete({
				autoFill: true,
				mustMatch: true,
				source: function(request, response) {
					var term = request.term.toLowerCase();
					var matchingTags = $.grep(availableTags, function(tag) {
					return tag.toLowerCase().indexOf(term) >= 0;
				});
				response(matchingTags.length ? matchingTags : availableTags);
					}
				});
			}
			else if(type=="find")
			{
			//alert(data);
			$("#tabs-4 .accordion").html("");
				for(var i=1;i<=num;i++)
				{
				fbId = availableTags[i-1].fb_ID;
				id = availableTags[i-1].send_course_ID;
				name= availableTags[i-1].sendCourseName;
				teacher = availableTags[i-1].sendCourseTeacher;
				time = availableTags[i-1].sendCourseTime;
				postId = availableTags[i-1].PostID;
				rate = availableTags[i-1].sendCourseRate;
				state = availableTags[i-1].state;
				sendCourseNum = availableTags[i-1].sendCourseNum;
				/*$("#tabs-4 .accordion").append("<h3 id='item"+i+"'Title'><button onclick='checkBuy("+postId +")' class='list'><span class='ui-icon ui-icon-cart'></span></button><span>"+name+id+"</span></h3><div id='item"+i+"'><p>授課老師: "+teacher+"</p><p>上課時段: "+time+"</p></div>");*/
				
				var out = "<h3 id='item"+i+"'Title'><button onclick='checkBuy('"+postId+"',"+"'buy'"+") class='list'><span class='ui-icon ui-icon-cart'></span></button><span>"+name+" "+id+" </span>";
				//alert(parseInt(rate,10));
				
				if(state=="ready")
				out+="<image id="+postId+" width='25' height='25' src='image/ready.png' value='ready'>";
				else
				out+="<image id="+postId+" width='25' height='25' src='image/complete.png' value='complete'>";
				for(var x=0;x<parseInt(rate,10);x++)
				out+="<image value='"+parseInt(rate,10)+"'onclick=setRate('"+sendCourseNum+"') width='20' height='20' src='image/star2.png'>";
				out+="</h3>";
				$("#tabs-4 .accordion").append(out);
				$("#tabs-4 .accordion").append("<div id='item"+i+"'><p>授課老師: "+teacher+"</p><p>上課時段: "+time+"</p></div>");	
				
				
				
				}
				
				
				
				
				
				
				
				
				 var options = {autoHeight:false};
				$( ".accordion" ).accordion('destroy');
				$( ".accordion" ).accordion({autoHeight:false});
			}
			
			
		}
		});
 
 
 }
  function nextPage(attr,type)
  {
  var initPage=1;
  if(type=="transaction")
  {
   initPage = $("#pageCount"). attr("value");
  // alert(initPage);
   var currentPage = parseInt(initPage,10);
   if(attr =="pre"&& currentPage>1)
   {
     var page = currentPage-1;
	 $("#pageCount").attr("value",page);
   }
   else if(attr =="next"&& checkPage1)
   {
   //alert(currentPage);
	var page = currentPage+1;
	 $("#pageCount").attr("value",page);
   }
   }
   else
   {
	initPage = $("#pageCount2"). attr("value");
  // alert(initPage);
   var currentPage = parseInt(initPage,10);
   if(attr =="pre"&& currentPage>1)
   {
     var page = currentPage-1;
	 $("#pageCount2").attr("value",page);
   }
   else if(attr =="next"&& checkPage2)
   {
   //alert(currentPage);
	var page = currentPage+1;
	 $("#pageCount2").attr("value",page);
   }
   
   
   }
  // alert(page);
	getBoardInfo(page,type);
	
	var options = {autoHeight:false};
				$( ".accordion" ).accordion('destroy');
				$( ".accordion" ).accordion({autoHeight:false});
	  
	 // $( "#tabs" ).tabs();
  }
  
  

  var totalPage = 0;
  function getBoardInfo(page,type)
  {
	$.ajax({
        url:"test.php",
        type: 'POST',
        async: false,
        cache: false,
        timeout: 30000,
		data:{ page:page,type:type },
        error: function(){
            return true;
        },
        success: function(data){ 
		
          var obj = JSON.parse(data);
		  var num = obj.length;
		  //alert(data);
		  var pageNum= $("#pageCount"). attr("value");
		   var currentPageNum = parseInt(pageNum,10);
		 // 
		  if(type == "transaction")
		  {
				if(num < 2&&currentPageNum!=1)
		  {
		   checkPage1 = false;
		   }
		   else
		    checkPage1 = true;
			
			//alert(num);
			
			$("#tabs-1 .accordion").html("");
			for(var i=1;i<=num;i=i+1)
			{
			//alert("hellow");
			//alert(obj[i-1].post_time);
				fbId = obj[i-1].fb_ID;
				id = obj[i-1].send_course_ID;
				name= obj[i-1].sendCourseName;
				teacher = obj[i-1].sendCourseTeacher;
				time = obj[i-1].sendCourseTime;
				rate = obj[i-1].sendCourseRate;
				postId = obj[i-1].PostID;
				state = obj[i-1].state;
				sendCourseNum = obj[i-1].sendCourseNum;
				//sendCourseNum = obj[i-1].sendCourseNum;
				//alert(teacher);
				var out = "<h3 id='item"+i+"'Title'><button onclick=checkBuy('"+postId+"',"+"'buy'"+") class='list'><span class='ui-icon ui-icon-cart'></span></button><span>"+name+" "+id+" </span>";
				
				//$("#tabs-1 .accordion").append();
				//alert(parseInt(rate,10));
				
				if(state=="ready")
				out+="<image id="+postId+" width='25' height='25' src='image/ready.png' value='ready'>";
				else
				out+="<image id="+postId+" width='25' height='25' src='image/complete.png' value='complete'>";
				for(var x=0;x<parseInt(rate,10);x++)
				out+="<image value='"+parseInt(rate,10)+"'onclick=setRate('"+sendCourseNum+"') width='20' height='20' src='image/star2.png'>";
				out+="</h3>";
				$("#tabs-1 .accordion").append(out);
				$("#tabs-1 .accordion").append("<div id='item"+i+"'><p>授課老師: "+teacher+"</p><p>上課時段: "+time+"</p></div>");	
				//alert(i);
			}
		  }
		  else if(type == "exchange")
		  {
		  	if(num < 2&&currentPageNum!=1)
		  {
			//alert(currentPageNum);
		   //$("#pageCount"). attr("value",currentPageNum);
		   checkPage2 = false;
		   }
		   else
		    checkPage2 = true;
		  
		  
		  
		  
		  
		  
		  //alert(num);
		  $("#tabs-2 .accordion").html("");
		  for(var i=1;i<=num;i=i+1)
			{ 
				var fbId = obj[i-1].fb_ID;
				var sId = obj[i-1].send_course_ID;
				var sName= obj[i-1].sendCourseName;
				var sTeacher = obj[i-1].sendCourseTeacher;
				var sTime = obj[i-1].sendCourseTime;
				var postId = obj[i-1].PostID;
				
				var rId = obj[i-1].recieve_course_ID;
				var rName= obj[i-1].recieveCourseName;
				var rTeacher = obj[i-1].recieveCourseTeacher;
				var rTime = obj[i-1].recieveCourseTime;
				var state = obj[i-1].state;
				
				var out = "<h3 id='eitem"+i+"'Title' ><span style='float:left'>"+sName+" "+sId+ "</span>"+
				"<button style='float:left' class='list' onclick=checkBuy('"+postId+"',"+"'buyEx'"+")><span style='float:left' class='ui-icon ui-icon-arrowthick-2-e-w'></span></button><span style='float:left' >"+rName+" "+rId+"</span>";
				
				if(state=="ready")
				out+="<span><image id="+postId+" width='25' height='25' src='image/ready.png' value='ready'></span>";
				else
				out+="<image id="+postId+" width='25' height='25' src='image/complete.png' value='complete'>";
				
				out+="</h3><div>"+
				"<p>上課時間: "+sTime+"      "+"上課時間:"+rTime +"</p>"+
				"<p>授課老師: "+sTeacher+"      "+"授課老師:"+rTeacher +"</p> </div>";
					
				$("#tabs-2 .accordion").append(out);
			}
					
		  
		  }

		}
		      
    });
	
  
  }
  

  
   $(function() {
   

 $(".tags").keypress(function()
 {
 //alert(this.id);
 search(this.id,"search");
 })
   
	 getBoardInfo(1,"transaction");
	getBoardInfo(1,"exchange");
 var options = {autoHeight: false};
      $( ".accordion" ).accordion(options);
	  $( "#tabs" ).tabs();
  });

  
  $(function() {
    $( document ).tooltip();
  });
  
  $(function() {
    var availableTags = [
      ""
    ];
    $( ".tags" ).autocomplete({
      source: availableTags
    });

  });
  
  $(function() {
   $( "#button" ).click(function(){
    $( "#dialog" ).dialog();
	 
	$("#1st").text("Processing").css("color","orange");
	
	 });
  });
  
   
  $(function() {
   $( "#postclass" ).click(function(){
    $( "#postC" ).dialog();
	 });
  });