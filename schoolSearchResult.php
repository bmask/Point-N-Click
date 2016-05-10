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
<h1>University's School Info</h1> 
<img src="helpIcon.png" alt="help" id="help" />
</td>
</tr>
<tr>
<td>
<img src="logo.png" alt="logo" id="logo"/>
<div id="button">
 <ul>
	<li><button  class="classname" onClick="history.go(-1)"> << Previous Page</button></li>
	<li><button  class="classname" onclick="parent.location='MainPage.php'" > << Home Page </button></li>	
</ul>

</div>
<div id="page" style="font-size:62.5%;">  
  <div id="tabs">

	<?php
// Remove especial chars
function RemoveEspChars($string) {
   $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.
   $string = preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.

   return preg_replace('/-+/', '-', $string); // Replaces multiple hyphens with single one.
}
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
	   echo "<ul>";
        echo "<li><a href='#fragment-1'><span>Programmes Offered </span></a></li>";
        echo "<li><a href='#fragment-2'><span>HomePage's Address & Content</span></a></li>";
		echo "<li><a href='#fragment-3'><span>News & Events</span></a></li>";
    echo "</ul>";
   // first tab	---------------------------------------------------------  
	echo "<div id='fragment-1'>";   
	session_start();
	$arraySchool = $_POST['schoolInfo'];
	if(empty($arraySchool))
	{
		header('Location:schools.php');
	}
	else
	{
		$selected = 0;
		$N = count($arraySchool);
		for($i=0; $i < $N; $i++)
		{
			if($arraySchool[$i]=="program")
			{
				$selected=1;
				$s = count($_SESSION['view']);
				for($j=0; $j < $s; $j++)
				{
					
					if($_SESSION['view'][$j]=="CSUF")
					{
						// get courses
						$html = $html = getTextBetweenHTML ('http://www.fullerton.edu/ecs/cs/degree/',"Programs and Courses","Course Description are available at the following link");
						$dom = new DOMDocument();
						$dom->preserveWhiteSpace = false;
						@$dom->loadHTML($html);
						$a = $dom->getElementsByTagName('li');
						for ($i=0; $i < $a->length; $i++) {
						$attr = $a->item($i)->textContent;
						$CSUFArray[$i] = RemoveEspChars($attr); // Save content as an array 
						}				
					}
					
					if($_SESSION['view'][$j]=="CSUN")
					{
						// get courses
						$html = $html = getTextBetweenHTML ('http://www.csun.edu/catalog/academics/comp/programs/',"<!-- Banner -->","<!-- end row -->");
						$dom = new DOMDocument();
						$dom->preserveWhiteSpace = false;
						@$dom->loadHTML($html);
						$a = $dom->getElementsByTagName('h3');
						for ($i=0; $i < $a->length; $i++) {
						$attr = $a->item($i)->textContent;
						$CSUNArray[$i] = RemoveEspChars($attr);
						}					 					
					}
					
					if($_SESSION['view'][$j]=="UCLA")
					{				
						// get news and events
						$html = $html = getHTMLContent ('http://www.registrar.ucla.edu/archive/catalog/2012-13/catalog/catalog12-13-238.htm');
						$dom = new DOMDocument();
						$dom->preserveWhiteSpace = false;
						@$dom->loadHTML($html);
						$a = $dom->getElementsByTagName('h2');
						for ($i=0; $i < $a->length; $i++) {
						$attr = $a->item($i)->textContent;
						$UCLAArray [$i] = $attr;
						}					 				
					}					
				}	
					// Display Table
				echo "<table class='display' cellspacing='1'>";
					echo "<thead>";
						echo "<tr>";
							echo "<th>CSUF University</th>";
							echo "<th>CSUN University</th>";
							echo "<th>UCLA University</th>";	
							echo "<th>KDU University</th>";
							echo "<th>UCSI University</th>";							
						echo "</tr>";
					echo "</thead>";
					echo "<tbody>";
					for($i=0; $i < 7; $i++)
					{
						echo "<tr>";
						if (isset($CSUFArray[$i]))
						{
							echo "<td width='20%'><strong>".$CSUFArray[$i]."</strong></td>";
						}else{echo "<td> --- </td>";}					
						if (isset($CSUNArray[$i]))
						{
							echo "<td width='20%'><strong>".$CSUNArray[$i]."</strong></td>";
						}else{echo "<td> --- </td>";}
						if (isset($UCLAArray[$i]))
						{
							echo "<td width='20%'><strong>".$UCLAArray[$i]."</strong></td>";
						}else{echo "<td> --- </td>";}	
						if (isset($KDU[$i]))
						{
							echo "<td width='20%'><strong>".$KDU[$i]."</strong></td>";
						}else{echo "<td> --- </td>";}	
						if (isset($UCSI[$i]))
						{
							echo "<td width='20%'><strong>".$UCSI[$i]."</strong></td>";
						}else{echo "<td> --- </td>";}							
						echo "</tr>";
					}
					echo "</tbody>";
				echo "</table>";		
			}     
		}
	if($selected==0) {echo "This Item is not Selected"; } 
	} 	
   echo " </div>";
   
   // second tab	---------------------------------------------------------
   echo " <div id='fragment-2'>"; 
   	$selected = 0;
	$pageSelected=0;
	$contentSelected=0;
    $N = count($arraySchool);
    for($i=0; $i < $N; $i++)
    {
		if($arraySchool[$i]=="page")
		{$pageSelected=1;}
		if($arraySchool[$i]=="content")
		{$contentSelected=1;}
		if($arraySchool[$i]=="page" || $arraySchool[$i]=="content")
		{
			$selected=1;
			$Tselected;
			$Nselected;
			$Sselected;
			if($arraySchool[$i]=="page")
			{
				$Tselected=0;
				$Nselected=0;
				$Sselected=0;
				$Kselected=0;
				$Uselected=0;
				// get the universities name
				$s = count($_SESSION['view']);
				for($j=0; $j < $s; $j++)
				{
					if($_SESSION['view'][$j]=="CSUF")
					{
						$Tselected=1;
					echo "</br><u><b>California State University, Fullerton - Computer Science school</b></u>";
					echo "<br/><b>Web Address:	</b><br/>http://www.fullerton.edu/ecs/cs/degree/	<a href='http://www.fullerton.edu/ecs/cs/degree/' target='_blank'><font color='blue'>click on</font></a><br/>";
				}
					if($_SESSION['view'][$j]=="CSUN")
					{
						$Nselected=1;
					
					echo "</br><u><b>California State University, Northridge - Computer Science school</b></u>";
					echo "<br/><b>Web Address:	</b><br/>http://www.csun.edu/academic		<a href='http://www.csun.edu/academic' target='_blank'><font color='blue'>click on</font></a><br/>";
					}
					if($_SESSION['view'][$j]=="UCLA")
					{
						$Sselected=1;
					
					echo "</br><u><b>University of California, Los Angeles  - Computer Science school</b></u>";
					echo "<br/><b>Web Address:	</b><br/>http://www.registrar.ucla.edu/archive/catalog/2012-13/catalog/catalog12-13-238.htm		<a href='http://www.registrar.ucla.edu/archive/catalog/2012-13/catalog/catalog12-13-238.htm' target='_blank'><font color='blue'>click on</font></a><br/>";
					echo "<br/><b>Web Address:	</b><br/>http://www.registrar.ucla.edu/archive/catalog/2012-13/catalog/catalog12-13-28.htm		<a href='http://www.registrar.ucla.edu/archive/catalog/2012-13/catalog/catalog12-13-28.htm' target='_blank'><font color='blue'>click on</font></a><br/>";
					}	
					if($_SESSION['view'][$j]=="KDU")
					{
						$Kselected=1;
					}	
					if($_SESSION['view'][$j]=="UCSI")
					{
						$Uselected=1;
					}						
				}
			}  
 			if($arraySchool[$i]=="content")
			{
				// get the universities name
				$s = count($_SESSION['view']);
				for($j=0; $j < $s; $j++)
				{				
 					if($_SESSION['view'][$j]=="CSUN")
					{	
						$html = $html = getTextBetweenHTML ('http://www.csun.edu/catalog/academics/comp/programs/',"<!-- Banner -->","<!-- end row -->");
						$dom = new DOMDocument();
						@$dom->loadHTML($html);
						//get the first sentence of the page
						$a = $dom->getElementsByTagName('p');
						//echo RemoveEspChars($a->item(0)->textContent);
						echo "</br><u><b>CSUN University - Computing School</b></u>";
						if (!empty($Nselected))
						{
							if ($Nselected==1)
							{
								echo "<br/><b>Web Address:	</b><br/>http://www.csun.edu/catalog/academics/comp/programs/		<a href='http://www.csun.edu/catalog/academics/comp/programs/' target='_blank'><font color='blue'>click on</font></a>";
							}
						}
						echo "</br><b>Page Content:	</b><br/>".substr(RemoveEspChars($a->item(0)->textContent),0,200)."... <a href='http://www.csun.edu/catalog/academics/comp/programs/' target='_blank'><font color='blue'>Read More</font></a><br/>";			// display node info 
					}
					if($_SESSION['view'][$j]=="UCLA")
					{
						// get Description
						$html = $html = getTextBetweenHTML ('http://www.registrar.ucla.edu/archive/catalog/2012-13/catalog/catalog12-13-238.htm',"<h1>","</p>");
						$dom = new DOMDocument();
						$dom->preserveWhiteSpace = false;
						@$dom->loadHTML($html);
						//get the first P content
						$a = $dom->getElementsByTagName('p');
						
						echo "</br><u><b>UCLA University - Computing School</b></u>";	
						if (!empty($Sselected))
						{
							if ($Sselected==1)
							{
								echo "<br/><b>Web Address:	</b><br/>http://www.registrar.ucla.edu/archive/catalog/2012-13/catalog/catalog12-13-238.htm		<a href='http://www.registrar.ucla.edu/archive/catalog/2012-13/catalog/catalog12-13-238.htm' target='_blank'><font color='blue'>click on</font></a>";
							}	
						}						
						echo "</br><b>Page Content:	</b><br/>".substr($a->item(0)->textContent,0,200)."... <a href='http://www.registrar.ucla.edu/archive/catalog/2012-13/catalog/catalog12-13-238.htm' target='_blank'><font color='blue'>Read More</font></a><br/>";			// display node info 
					}
					if($_SESSION['view'][$j]=="CSUF")
					{				
						$html = $html = getTextBetweenHTML ('http://www.fullerton.edu/ecs/cs/degree/',"Programs and Courses","Course Description are available at the following link");
						$dom = new DOMDocument();
						@$dom->loadHTML($html);
						echo "</br><u><b>CSUF University - Computing School</b></u>";
						if (!empty($Tselected))
						{
							if ($Tselected==1)
							{
								echo "<br/><b>Web Address:	</b><br/>http://www.fullerton.edu/ecs/cs/degree/		<a href='http://www.fullerton.edu/ecs/cs/degree/' target='_blank'><font color='blue'>click on</font></a>";
							}
						}
						//get the first sentence of the page
						$a = $dom->getElementsByTagName('p');
						//echo $a->item(0)->textContent;
						echo "<br/><b>Page Content:	</b><br/>".$a->item(0)->textContent."... <a href='http://www.fullerton.edu/ecs/cs/degree/' target='_blank'><font color='blue'>Read More</font></a><br/>";	;  // a php manual
					}
					if($_SESSION['view'][$j]=="KDU")
					{				
						$tags = get_meta_tags('http://www.kdu.edu.my/programmes/information-technology.html');
						echo "</br><u><b>KDU University - Computing School</b></u>";
						if (!empty($Kselected))
						{
							if ($Kselected==1)
							{
								echo "<br/><b>Web Address:	</b><br/>http://www.kdu.edu.my/programmes/information-technology.html		<a href='http://www.kdu.edu.my/programmes/information-technology.html' target='_blank'><font color='blue'>click on</font></a>";
							}
						}
						echo "<br/><b>Page Content:	</b><br/>".$tags['description']."... <a href='http://www.kdu.edu.my/programmes/information-technology.html' target='_blank'><font color='blue'>Read More</font></a><br/>";	;  // a php manual
					}
					if($_SESSION['view'][$j]=="UCSI")
					{
						$some_link = 'http://lms.ucsi.edu.my/faculty-of-business-and-information-science';
						$dom = new DOMDocument;
						$dom->preserveWhiteSpace = false;
						@$dom->loadHTMLFile($some_link);  
						$domxpath = new DOMXPath($dom);
						$newDom = new DOMDocument;
						$newDom->formatOutput = true;						
						$filtered = $domxpath->query("//td" . '[@' . "style='text-align: justify']");
						$i = 0;
						$myItem = $filtered->item($i++)  ;
						$out= $myItem->nodeValue;
						// make the sentence short...
						$cut = strpos($out, '.'); 
						//echo "<li/>".substr($out, 0, $cut+1)."...";			// display node info 
						//echo "... <a href='http://lms.ucsi.edu.my/faculty-of-business-and-information-science' target='_blank'>Read More</a>";	;  // a php manual
						echo "</br><u><b>UCSI University - Computing School</b></u>";	
						if (!empty($Uselected))
						{
							if ($Uselected==1)
							{
								echo "<br/><b>Web Address:	</b><br/>http://lms.ucsi.edu.my/faculty-of-business-and-information-science		<a href='http://lms.ucsi.edu.my/faculty-of-business-and-information-science' target='_blank'><font color='blue'>click on</font></a>";
							}	
						}						
						echo "</br><b>Page Content:	</b><br/>".substr($out, 0, $cut+1)."... <a href='http://lms.ucsi.edu.my/faculty-of-business-and-information-science' target='_blank'><font color='blue'>Read More</font></a><br/>";			// display node info 
					}
					
				}
			}
		}      
    } 
	// if web address is selected but content page is not selected 
	if ($pageSelected==1 && $contentSelected==0)
	{	
		// get the universities name
		$s = count($_SESSION['view']);
		for($j=0; $j < $s; $j++)
		{
			if($_SESSION['view'][$j]=="CSUF")
			{
				//echo "</br><u><b>CSUF University - Computing School</b></u>";				
				//echo "<br/><b>Web Address:	</b><br/>http://www.CSUFArray.edu.my/en/university/schools/computing		<a href='http://www.CSUFArray.edu.my/en/university/schools/computing' target='_blank'><font color='blue'>click on</font></a><br/>";
			}
			if($_SESSION['view'][$j]=="CSUN")
			{
				//echo "</br><u><b>Nottingham University - Computing School</b></u>";		
				//echo "<br/><b>Web Address:	</b><br/>http://www.nottingham.edu.my/ComputerScience/index.aspx		<a href='http://www.nottingham.edu.my/ComputerScience/index.aspx' target='_blank'><font color='blue'>click on</font></a><br/>";
			}
			if($_SESSION['view'][$j]=="sunway")
			{
				echo "</br><u><b>Sunway University - Computing School</b></u>";						
				echo "<br/><b>Web Address:	</b><br/>http://sunway.edu.my/university/sct		<a href='http://sunway.edu.my/university/sct' target='_blank'><font color='blue'>click on</font></a></br>";
			}
			if($_SESSION['view'][$j]=="KDU")
			{
				echo "</br><u><b>KDU University - Computing School</b></u>";						
				echo "<br/><b>Web Address:	</b><br/>http://www.kdu.edu.my/programmes/information-technology.html		<a href='http://www.kdu.edu.my/programmes/information-technology.html' target='_blank'><font color='blue'>click on</font></a></br>";
			}	
			if($_SESSION['view'][$j]=="UCSI")
			{
				echo "</br><u><b>UCSI University - Computing School</b></u>";						
				echo "<br/><b>Web Address:	</b><br/>http://lms.ucsi.edu.my/faculty-of-business-and-information-science		<a href='http://lms.ucsi.edu.my/faculty-of-business-and-information-science' target='_blank'><font color='blue'>click on</font></a></br>";
			}			
		}
	}
	if($selected==0) {echo "This Item is not Selected"; }     
   echo  "</div>";
   // third tab	---------------------------------------------------------
   echo "<div id='fragment-3'>";   
   $selected = 0;
    $N = count($arraySchool);
    for($i=0; $i < $N; $i++)
    {
		if($arraySchool[$i]=="news")
		{
			$selected = 1;
			echo "<div class='accordian'>";
			echo "<ul>";
			$s = count($_SESSION['view']);
			for($j=0; $j < $s; $j++)
			{	
			if($_SESSION['view'][$j]=="CSUF"){		
				echo "<li>CSUF University</li>";
				echo "<li>"; 
				echo "<b>CSUF computing school's news & events ; </b>"."<a href='http://www.fullerton.edu/ecs/news/news.php' target='_blank'>click here </a>";
				$html = $html = getTextBetweenHTML ('http://www.fullerton.edu/ecs/news/news.php',"Archives","CalendarList");
				$dom = new DOMDocument();
				@$dom->loadHTML($html);
				foreach ($dom->getElementsByTagName('a') as $node) {
				//$href = $node->getAttribute( 'href' );
				//$node->setAttribute('href', 'http://www.fullerton.edu/ecs/news/'.$href);
				//echo $dom->saveHtml($node). "</br>";
				echo "<br/><font size='2' face='arial' color='blue'>".$node->nodeValue."</font>"; 
				}
				echo "</li>";
			}
			if($_SESSION['view'][$j]=="CSUN"){
				echo "<li>CSUN University</li>";
				echo "<li>"; 		
					echo "<b>CSUN University's computing school's news & events ; </b>"."<a href='http://www.csun.edu/engineering-computer-science/news-and-events' target='_blank'>click here</a>";
					// get news and events
					$html = $html = getHTMLContent ('http://www.csun.edu/engineering-computer-science/news-and-events/');
					$dom = new DOMDocument();
					$dom->preserveWhiteSpace = false;
					@$dom->loadHTML($html);
					$a = $dom->getElementsByTagName('h4');
					for ($i=0; $i < $a->length; $i++) {
						$attr = $a->item($i)->textContent;
						//echo $attr . "</br>";
						echo "<br/><font size='1' face='arial' color='blue'>".$attr."</font>"; 
						if($i>10){ 
							echo "<br/><font size='2' face='arial' color='blue'>.....</font>";
							break;
						}
					}					
 			
				echo "</li>";
				}
			if($_SESSION['view'][$j]=="KDU"){
				echo "<li>KDU University</li>";
				echo "<li>"; 		
					echo "<b>KDU's computing school's news & events ; </b>No Proper Information is Found  "."<a href='http://www.kdu.edu.my/programmes/information-technology.html' target='_blank'>click here </a>";			
				echo "</li>";
				}
			if($_SESSION['view'][$j]=="UCLA"){
				echo "<li>UCLA University</li>";
				echo "<li>"; 	
					$url = 'http://www.cs.ucla.edu/newsroom/';
					$html = $html = getHTMLContent ($url); 				
					echo "<b>UCLA computing school's news & events ; </b>"."<a href='$url' target='_blank'>click here </a>";
					// get News					
					$dom = new DOMDocument();
					@$dom->loadHTML($html);
					$a = $dom->getElementsByTagName('h2');
					for ($i=0; $i < $a->length; $i++) {
					$attr = $a->item($i)->textContent;
					echo "<br/><font size='1' face='arial' color='blue'>".$attr."</font>"; 
					}
				echo "</li>";
				}
			}
			echo "</ul>";
			echo "</div>";
		}
	}
	 if($selected==0) {echo "This Item is not Selected"; } 	
    echo "</div>"; 
	?>
</div>  
</div>
</td> 
</tr>
</table>
</body>
</html>