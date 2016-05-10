<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="css/styles.css" />
<link rel="stylesheet" type="text/css" href="jquery.tzCheckbox/jquery.tzCheckbox.css" />
<script src="js/jquery.min.js"></script>
<script src="jquery.tzCheckbox/jquery.tzCheckbox.js"></script>
<script src="js/script.js"></script>
  <link href="css/jquery-ui.css" rel="stylesheet" type="text/css"/>
  <script src="js/jquery.min.tabs.js"></script>
  <script src="js/jquery-ui.min.tabs.js"></script>
<link rel="stylesheet" type="text/css" href="css/table.css" />
<script type="text/javascript" src="js/jMenu-VerticalTab.js"></script> 
<link rel="stylesheet" type="text/css" href="css/vertical-Tab.css" />
  <script>
  $(document).ready(function() {
    $("#tabs").tabs();
  });
  </script>
</head>
<body bgcolor="#f2f2f2" >
 <style type="text/css"> 
 h2{font-family:Georgia ; font-style: italic;font-variant: small-caps; font-size: 2.5em; color: #C0C0C0; text-align:left; padding:0; margin-top:-80px;margin-bottom:100px;margin-right:50px;margin-left:50px;}
 h1 {font-size: 4.5em; font-family: "Brush Script MT", cursive; color: #fced01; text-align:left; padding:0; margin-top:-80px;margin-bottom:100px;margin-right:50px;margin-left:80px;}
 #help {padding:0; margin-top:-130px;margin-bottom:100px;margin-right:-700px;}
 #logo {position:relative; padding:0; margin-top:-130px;margin-bottom:200px;margin-right:-200px;margin-left:200px;}
#page {position:absolute; padding:0; margin-top:-320px;margin-bottom:200px;margin-right:-300px;margin-left:550px;}
#button {position:relative; padding:0; margin-top:-480px;margin-bottom:200px;margin-right:-230px;margin-left:260px;}
#button ul { list-style-type: none; }
 
</style>
<style type="text/css">
 .classname { 
	height: 40px; 
	width: 200px;  
	-moz-box-shadow:inset 0px 1px 0px 0px #ffffff;
	-webkit-box-shadow:inset 0px 1px 0px 0px #ffffff;
	box-shadow:inset 0px 1px 0px 0px #ffffff;
	background-color:#ededed;
	-moz-border-radius:6px;
	-webkit-border-radius:6px;
	border-radius:6px;
	border:1px solid #dcdcdc;
	display:inline-block;
	color:#777777;
	font-family:arial;
	font-size:15px;
	font-weight:bold;
	padding:6px 24px;
	text-decoration:none;
	text-shadow:1px 1px 0px #ffffff; 
}.classname:hover {
	background-color:#dfdfdf;
}.classname:active {
	position:relative;
	margin-top:1px;
}
 
</style>
<table border="0" width=100% height=100%>
<tr>
<td style="text-align: center; vertical-align: top;">
<img src="header.jpg" alt="header" />
<h1>News & Events</h1> 
<img src="helpIcon.png" alt="help" id="help" />
</td>
</tr>
<tr>
<td>
<img src="logo.png" alt="logo" id="logo"/>
<div id="button">
 <ul>
	<!--<li><button  class="classname" onClick="history.go(-1)"> << Previous Page</button></li>-->
	<li><button  class="classname" onclick="parent.location='MainPage.php'" > << Home Page </button></li>	
</ul>

</div>
<div id="page" style="font-size:62.5%;">  
  <div id="tabs">

	<?php
	// Get part of the HTML content from start point to end point
	function getTextBetweenHTML($url,$startPoint,$endPoint) {
	$content = file_get_contents($url); 
	$comment=explode($startPoint,$content); 
	$comment=explode($endPoint,$comment[1]);	
	$html = $comment[0];
	return $html;
	}
	// get all HTML content
	function getHTMLContent ($url) {
	$content = file_get_contents($url); 
	return $content;
	}
	session_start();
	   echo "<ul>";
        echo "<li><a href='#fragment-1'><span>Universities' news & events;</span></a></li>";
    echo "</ul>";
   // first tab	---------------------------------------------------------  
	echo "<div id='fragment-1'>"; 
 		echo "<div class='accordian'>";
			echo "<ul>";
			$s = count($_SESSION['view']);
			for($j=0; $j < $s; $j++)
			{	
			if($_SESSION['view'][$j]=="CSUF"){
				echo "<li><b>CSUF University'</li>";
				echo "<li>";
				$html = $html = getTextBetweenHTML ('http://news.fullerton.edu/','<!--NEWS-->','<!--/newsContainer-->');
				$dom = new DOMDocument();
				@$dom->loadHTML($html);
				$a = $dom->getElementsByTagName('h2'); // get university name and university ranking in CA
				for ($i=0; $i < $a->length; $i++) {
					$attr = $a->item($i)->textContent;
					echo "<font size='1' face='arial' color='blue'>".strip_tags($attr)."... </font></br>";	;  // a php manual	
					if ($i>9){break;}
				}					
				echo "<b>CSUF University's news & events; </b>"."<a href='http://news.fullerton.edu/' target='_blank'>click here</a>";
				echo "</li>";
			}
			if($_SESSION['view'][$j]=="UCLA"){

				echo "<li><b>UCLA University</b></li>";
				echo "<li>";				
				// get university News
				$html = $html = getHTMLContent ('http://happenings.ucla.edu/');
				$dom = new DOMDocument();
				@$dom->loadHTML($html);
				$a = $dom->getElementsByTagName('h3'); // get university name and university ranking in CA
				for ($i=0; $i < $a->length; $i++) {
					$attr = $a->item($i)->textContent;
					echo "<font size='1' face='arial' color='blue'>".strip_tags($attr)."... </font></br>";	;  // a php manual	
					if ($i>9){break;}
				}
				echo "<b>UCLA University's news & events; </b>"."<a href='http://happenings.ucla.edu/' target='_blank'>click here</a>";
				echo "</li>";				
			}
			if($_SESSION['view'][$j]=="CSUN"){

				echo "<li><b>CSUN University</li>";
				echo "<li>";
				// get university News
				@$dom->loadHTMLFile('http://www.csun.edu/busecon/news-events'); // Read the page
				$domxpath = new DOMXPath($dom);
				$newDom = new DOMDocument;
				$newDom->formatOutput = true;
				$filtered = $domxpath->query("//h2" . '[@' . "class='node--title node-title']"); // get <h2> content 
				$i = 0;
				while( $myItem = $filtered->item($i++) ){
					$node = $newDom->importNode( $myItem, true );    // import node			 
					$newDom->appendChild($node);                    // append node
					$test = $newDom->saveHTML();					// convert to string
					//echo strip_tags($test)."</br>";							
					echo "<font size='1' face='arial' color='blue'>".strip_tags($test)."</br></font>"; 
					$newDom->removeChild($node);					// reset object information 
					if ($i>9){break;}
				}
				echo "<b>CSUN University's news & events; </b>"."<a href='http://www.csun.edu/busecon/news-events' target='_blank'>click here</a>";
				echo "</li>";
			}
			if($_SESSION['view'][$j]=="KDU"){

				echo "<li>KDU University</li>";
				echo "<li>";
					echo "<b>KDU University's computing school's news & events; </b>"."<a href='http://www.kdu.edu.my/' target='_blank'>click here</a>";
					$some_link = 'http://www.kdu.edu.my/';
					$dom = new DOMDocument;
					$dom->preserveWhiteSpace = false;
					@$dom->loadHTMLFile($some_link);				 
					$domxpath = new DOMXPath($dom);
					$newDom = new DOMDocument;
					$newDom->formatOutput = true;
					$filtered = $domxpath->query("// span " . '[@' . "class='mod_events_latest_content']");
					$i = 0;
					while( $myItem = $filtered->item($i++) ){	 
					   $out= $myItem->nodeValue;		 		 
						echo "<br/><font size='1' face='arial' color='blue'>".$out."</font>";							// display node info 		 
					}				
				echo "</li>";
			}
			if($_SESSION['view'][$j]=="UCSI"){

				echo "<li>UCSI University</li>";
				echo "<li>";
					$some_link = 'http://lms.ucsi.edu.my/';
					$dom = new DOMDocument;
					$dom->preserveWhiteSpace = false;
					@$dom->loadHTMLFile($some_link); 
					$domxpath = new DOMXPath($dom);
					$newDom = new DOMDocument;
					$newDom->formatOutput = true;
					$filtered = $domxpath->query("// td" . '[@' . "class='news']");
					$i = 0;
					echo "<b>UCSI University's computing school's news & events; </b>"."<a href='$some_link' target='_blank'>click here</a>";
					while( $myItem = $filtered->item($i++) ){
						echo "<br/><font size='1' face='arial' color='blue'>".$out= $myItem->nodeValue."</font>"; 
					}						
				echo "</li>";
			}
			}
			echo "</ul>";
		echo "</div>";
		
	 
	echo " </div>";
	?>
</div>  
</div>
</td> 
</tr>
</table>
</body>
</html>