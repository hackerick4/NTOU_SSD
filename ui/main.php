<!doctype html>
 
<html lang="en">
<head>
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
  <meta charset="utf-8" />
  <title>jQuery UI Tabs - Default functionality</title>
  <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
  <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
  <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
  <link rel="stylesheet" href="/resources/demos/style.css" />

  <script>
  
  $(function() {
  
	 //	for(var i=1;i<=5;i++)
	 
	  $.ajax({
        url: "test.php",
        type: 'POST',
        async: false,
        cache: false,
        timeout: 30000,
        error: function(){
            return true;
        },
        success: function(data){ 
          var obj = JSON.parse(data);
		  var num = obj.length;
		  //alert(num);
		  
		  for(var i=1;i<=num;i=i+1)
		{ 
		id = obj[i-1].send_course_ID;
		$("#tabs-1 .accordion").append("<h3 id='item"+i+"'Title'>"+id+"</h3><div id='item"+i+"'></div>");
		
		
		//alert(i);
		}
		  for(var i=1;i<=num;i=i+1)
		{ 
		
			
		}
		
		},
		complete: function()
		{
			
		}
		  
       
    });
	$( ".accordion" ).accordion({
				autoHeight: false
				});
			$( "#tabs" ).tabs();
   /* $.post("test.php",function(data,status){
    //alert("Data: " + data + "\nStatus: " + status);
	var obj = JSON.parse(data);
	var num = obj.length;
	alert(num);
	

	
	for(var i=1;i<=num;i++)
	{ 
		var id = obj[i].send_course_ID;
		$("#tabs-1 .accordion").append("<h3 id='item"+i+"'Title'>"+i+"</h3><div id='item"+i+"'></div>");
		// $(".accordion").append("<h3 id='item"+i+"Title'>456</h3><div id='item"+i+"'></div>");
		//$("#item"+i+"Title").text(id);
	};
	
	 
    });*/
	
	
	
	//alert(obj[0].fb_ID);
	//alert(obj[0].fb_ID);
	 //
	
 
	  
	 


  });

 
  </script>
</head>
<body>
 
<div id="tabs">
  <ul>
    <li><a href="#tabs-1">Nunc tincidunt</a></li>
    <li><a href="#tabs-2">Proin dolor</a></li>
    <li><a href="#tabs-3">Aenean lacinia</a></li>
  </ul>
  <div id="tabs-1">
  <div class="accordion">

</div>
  </div>
  <div id="tabs-2">
     <div class="accordion">
  
</div>
  </div>
  <div id="tabs-3">
	<div class="accordion">
  
</div>
  </div>
</div>
 
 
</body>
</html>