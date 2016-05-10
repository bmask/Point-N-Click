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
<h1>University's Schools Info</h1> 
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
        echo "<li><a href='#fragment-1'><span>Schools' Name</span></a></li>";
        echo "<li><a href='#fragment-2'><span>HomePage's Address</span></a></li>";
        echo "<li><a href='#fragment-3'><span>Homepages' Content</span></a></li>";
    echo "</ul>";
   // first tab	---------------------------------------------------------  
	echo "<div id='fragment-1'>";   
	session_start();
	$aDoor = $_POST['schoolInfo'];
	if(empty($aDoor))
	{
		header('Location:schools.php');
	}
	else
	{
		$selected = 0;
		$N = count($aDoor);
		for($i=0; $i < $N; $i++)
		{
			if($aDoor[$i]=="list")
			{
				$CSUFChosen=0;
				$selected=1;
				$s = count($_SESSION['view']);
				for($j=0; $j < $s; $j++)
				{
					if($_SESSION['view'][$j]=="CSUF")
					{
						$CSUFChosen=1;
						// get courses
						$html = getTextBetweenHTML ('http://www.fullerton.edu/academic-departments.aspx',"<!-- /#header -->","<!-- /.gutter -->");
						//$url = 'http://www.fullerton.edu/academic-departments.aspx';
						//$content = file_get_contents($url); 
						//$comment=explode("acadDept",$content); 
						//$comment=explode("<!-- /#header -->",$content); 
						//$comment=explode("<!-- /.gutter -->",$comment[1]);
						$dom = new DOMDocument();
						$dom->preserveWhiteSpace = false;
						//$html = $comment[0];
						@$dom->loadHTML($html);
						//get <strong> tag content for course names
						$strongTag = $dom->getElementsByTagName('strong');
						for ($i=0; $i < $strongTag->length; $i++) {
						$attr = $strongTag->item($i)->textContent;
						$CSUFArray [$i] = $attr;
						}
					}
					if($_SESSION['view'][$j]=="CSUN")
					{						
						$dom = new DOMDocument();
						$dom->preserveWhiteSpace = false;
						//$html = $comment[0];
						$html = getTextBetweenHTML ('http://www.csun.edu/academic',"<strong>A","</article>");
						@$dom->loadHTML($html);
						$a = $dom->getElementsByTagName('a');
						for ($i=0; $i < $a->length; $i++) {
						$attr = $a->item($i)->textContent;
						$nottingham [$i] = $attr;
						} 					
					}
					if($_SESSION['view'][$j]=="UCLA")
					{	// get courses
						$dom = new DOMDocument();
						$dom->preserveWhiteSpace = false;
						$html = getTextBetweenHTML ('http://www.ucla.edu/academics/departments-and-programs',"<!-- End section -->","<!-- End Main -->");
						@$dom->loadHTML($html);
						$a = $dom->getElementsByTagName('a');
						$k=0; // Assign to the array
						for ($i=0; $i < $a->length; $i++) { // ignore the One letters at the top of each list like A/B/C/D,...
							$attr = $a->item($i)->textContent;
							if (strlen($attr)>1){								
								$UCLAArray [$k] = $attr;
								$k++;
							}
						}
						 				
					} 
				}
				// Display Table
				echo "<table class='display' cellspacing='1'>";
					echo "<thead>";
						echo "<tr>";
							echo "<th>CSUFArray University's school</th>";
							echo "<th>nottingham University's school</th>";
							echo "<th>UCLA University's school</th>";
							echo "<th>KDU's University's school</th>";
							echo "<th>UCSI's University's school</th>";
						echo "</tr>";
					echo "</thead>";
					echo "<tbody>";
					for($i=0; $i < 130; $i++)
					{
						echo "<tr>";
						if ($CSUFChosen==1)
						{
							if (isset($CSUFArray[$i]))
							{
								echo "<td width='33%'><strong>".$CSUFArray[$i]."</strong></td>";
							}else{echo "<td> --- </td>";}
						} else{echo "<td> --- </td>";}
						if (isset($nottingham[$i]))
						{
						echo "<td width='33%'><strong>".$nottingham[$i]."</strong></td>";
						}else{echo "<td> --- </td>";}
						if (isset($UCLAArray[$i]))
						{
						echo "<td width='33%'><strong>".$UCLAArray[$i]."</strong></td>";
						}else{echo "<td> --- </td>";}	
						if (isset($KDU[$i]))
						{
						echo "<td width='33%'><strong>".$KDU[$i]."</strong></td>";
						}else{echo "<td> --- </td>";}	
						if (isset($UCSI[$i]))
						{
						echo "<td width='33%'><strong>".$UCSI[$i]."</strong></td>";
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
    $N = count($aDoor);
    for($i=0; $i < $N; $i++)
    {
		if($aDoor[$i]=="page")
		{
			$selected=1;
			//echo("You selected $N University(s): ");
			// get the universities name
			$s = count($_SESSION['view']);
			for($j=0; $j < $s; $j++)
			{
				if($_SESSION['view'][$j]=="CSUF")
				{
					echo "</br><u><b>California State University, Fullerton - School</b></u>";
					echo "<br/><b>Web Address:	</b><br/>http://www.fullerton.edu/academic-departments.aspx		<a href='http://www.fullerton.edu/academic-departments.aspx' target='_blank'><font color='blue'>click on</font></a><br/>";
				}
				if($_SESSION['view'][$j]=="CSUN")
				{
					echo "</br><u><b>California State University, Northridge - School</b></u>";
					echo "<br/><b>Web Address:	</b><br/>http://www.csun.edu/academic		<a href='http://www.csun.edu/academic' target='_blank'><font color='blue'>click on</font></a><br/>";
				}
				if($_SESSION['view'][$j]=="UCLA")
				{
					echo "</br><u><b>UCLA University - School</b></u>";
					echo "<br/><b>Web Address:	</b><br/>http://www.ucla.edu/academics/departments-and-programs		<a href='http://www.ucla.edu/academics/departments-and-programs' target='_blank'><font color='blue'>click on</font></a><br/>";
				}		
			}			
		}      
    }
	if($selected==0) {echo "This Item is not Selected"; } 	
   echo  "</div>";
   // third tab	---------------------------------------------------------
   echo "<div id='fragment-3'>";
	$selected = 0;
    for($i=0; $i < $N; $i++)
    {
		if($aDoor[$i]=="content")
		{
			$selected=1;
			// get the universities name
			$s = count($_SESSION['view']);
			for($j=0; $j < $s; $j++)
			{
				if($_SESSION['view'][$j]=="CSUF")

				{		
					echo "</br><u><b>CSUF University - School</b></u>";						
					$html = getTextBetweenHTML ('http://www.fullerton.edu/academic-departments.aspx',"<!-- /#header -->","<!-- /.gutter -->");	 
					$dom = new DOMDocument();
					$dom->preserveWhiteSpace = false; 					
					@$dom->loadHTML($html);
					//get the first sentence of the page
					$CSUFcontent = $dom->getElementsByTagName('p');
					//echo $a->item(0)->textContent;
					//echo "</br>".$a->item(0)->nodeValue;		
					echo "</br><b>Page Content:	</b><br/>".$CSUFcontent->item(0)->textContent."... <a href='http://www.fullerton.edu/academic-departments.aspx' target='_blank'><font color='blue'>Read More</font></a><br/>";
				}

			 	if($_SESSION['view'][$j]=="CSUN")
			 	{
					echo "</br><u><b>CSUN University - School</b></u>";
					$html = getHTMLContent ('http://www.csun.edu/academic');
					$doc = new DOMDocument();
					@$doc->loadHTML($html);
					$xpath = new DOMXPath($doc);
					$CSUNcontent = $xpath->query("//*[@class='field-item even']/p");
					echo "</br><b>Page Content:	</b><br/>".$CSUNcontent->item(0)->nodeValue."... <a href='http://www.csun.edu/academic' target='_blank'><font color='blue'>Read More</font></a><br/>";
				}
			 	if($_SESSION['view'][$j]=="UCLA")
			 	{
					// Get the meta tag description at the top of the page
			 		$tags = get_meta_tags('http://www.ucla.edu/academics/departments-and-programs');
					// make the sentence short...
					$cut = strpos($tags['description'], '.'); 
					$brief = substr($tags['description'], 0, $cut+1);
					echo "</br><u><b>UCLA University - School</b></u>";
			 		echo "</br><b>Page Content:	</b><br/>".$brief."... <a href='http://www.ucla.edu/academics/departments-and-programs' target='_blank'><font color='blue'>Read More</font></a><br/>";
			 	}				
			}			
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