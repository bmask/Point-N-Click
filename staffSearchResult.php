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
<h1>Staff Info</h1> 
<img src="helpIcon.png" alt="help" id="help" />
</td>
</tr>
<tr>
<td>
<img src="logo.png" alt="logo" id="logo"/>
<div id="button">
 <ul>
	<li><button  class="classname" onClick="history.go(-1)" > << Previous Page</button></li>
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
	function getTextBetweenTags($string, $tagname) {
		// get text from html tag
		$re = "/<$tagname>(.*?)<\/$tagname>/";
		preg_match($re, $string, $matches);
		return $matches[1];
	}

	function getAttribute($attrib, $tag){
	  //get attribute from html tag
	  $re = '/'.$attrib.'=["\']?([^"\' ]*)["\' ]/is';
	  preg_match($re, $tag, $match);
	  if($match){
		return urldecode($match[1]);
	  }else {
		return false;
	  }
	}
	   echo "<ul>";
        echo "<li><a href='#fragment-1'><span>Head & Director(s) of School</span></a></li>";
        echo "<li><a href='#fragment-2'><span>Academic Staff</span></a></li>";
		echo "<li><a href='#fragment-3'><span>Adminastrative Staff</span></a></li>";
    echo "</ul>";
   // first tab	---------------------------------------------------------  
   echo " <div id='fragment-1'>"; 
   	session_start();
	$arrayStaff = $_POST['schoolInfo'];
	if(empty($arrayStaff))
	{
		header('Location:staffDirectory.php');
	}
	else
	{
		$selected = 0;
		$headSelected=0;
		$directorSelected=0;
		$N = count($arrayStaff);
		for($i=0; $i < $N; $i++)
		{
			if($arrayStaff[$i]=="head")
			{$headSelected=1;}
			if($arrayStaff[$i]=="director")
			{$directorSelected=1;}
			if($arrayStaff[$i]=="head" || $arrayStaff[$i]=="director")
			{
				$selected=1;
				$Tselected;
				$Nselected;
				$Sselected;
				$Kselected;
				$Uselected;
				if($arrayStaff[$i]=="head")
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
						}
						if($_SESSION['view'][$j]=="CSUN")
						{
							$Nselected=1;
						}
						if($_SESSION['view'][$j]=="sunway")
						{
							$Sselected=1;
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
				if($arrayStaff[$i]=="director")
				{
					// get the universities name
					$s = count($_SESSION['view']);
					for($j=0; $j < $s; $j++)
					{				
						if($_SESSION['view'][$j]=="CSUN")
						{	
							// get college Dean and Faculty Staff
							$html = $html = getTextBetweenHTML ('http://www.csun.edu/engineering-computer-science/cs-faculty','Full Time Faculty','Lecturers');
							$dom = new DOMDocument();
							@$dom->loadHTML($html);
							$a = $dom->getElementsByTagName('p');    
							for ($i=0; $i < $a->length; $i++) {
								$attr = $a->item($i)->textContent;								
								if(strpos($attr, "Chair") == true || strpos($attr, "Coordinator") == true || strpos($attr, "Director") == true )//if (strpos($attr, 'Dean') !== false)  //if(strpos($position, "Dean") == true || strpos($position, "Coordinator") == true || strpos($position, "Director") == true )  // College Dean
									{ 									 
									$cc = explode( 'Email', $attr );
									$nottingham[0] = str_replace("â", " ", $cc[0]);
									$nottingham[1] = str_replace("Â", " ", $cc[1]);
									$nottingham[1] = str_replace("â", " ", $nottingham[1]);
									  							
									}								
								}	 					 																
						}
						if($_SESSION['view'][$j]=="sunway")
						{	$k=0;
							if (!empty($Sselected))
							{
								if ($Sselected==1)
								{
									$some_link = 'http://sunway.edu.my/university/sct/management-staff';
									$dom = new DOMDocument;
									$dom->preserveWhiteSpace = false;
									@$dom->loadHTMLFile($some_link);				 
									$domxpath = new DOMXPath($dom);
									$newDom = new DOMDocument;
									$newDom->formatOutput = true;
									$filtered = $domxpath->query("//td" . '[@' . 'valign' . "='top']");
									$i = 0;									
									while( $myItem = $filtered->item($i++) ){
										$node = $newDom->importNode( $myItem, true );    // import node			 
										$newDom->appendChild($node);                    // append node
										$position = $newDom->saveHTML();					// convert to string
										if(strpos($position, "Prof") == true || strpos($position, "Head") == true || strpos($position, "@") == true  )
										{		
										$sunway[$k] = $position;	
										$k++;
										}
										$newDom->removeChild($node);					// reset object information 		 
									}									
 								}
							}else {$k=0;}		
							$some_link = 'http://sunway.edu.my/university/sct/academic';	
							@$dom->loadHTMLFile($some_link); 
							$domxpath = new DOMXPath($dom);
							$filtered = $domxpath->query("//td");
							$i = 0;
							while( $myItem = $filtered->item($i++) ){
								$node = $newDom->importNode( $myItem, true );    // import node			 
								$newDom->appendChild($node);                    // append node
								$position = $newDom->saveHTML();					// convert to string
								if(strpos($position, "Coordinator ") == true || strpos($position, "Director") == true)
								{
									$newDom->removeChild($node);
									$myItem = $filtered->item($i-2);	
									$node = $newDom->importNode( $myItem, true );    // import node			 
									$newDom->appendChild($node);                    // append node
									$sunway[$k] = $newDom->saveHTML();					// convert to string
									$k++;
									$sunway[$k] = $position ;
									$k++;
									$newDom->removeChild($node);
									$myItem = $filtered->item($i+2);	
									$node = $newDom->importNode( $myItem, true );    // import node			 
									$newDom->appendChild($node);                    // append node
									$sunway[$k] = $newDom->saveHTML();					// convert to string									  
									$k++;
								}
								$newDom->removeChild($node);				 	 
							}								
						}
						if($_SESSION['view'][$j]=="CSUF")
						{			 
							// get college Dean and Faculty Staff
							$html = $html = getTextBetweenHTML ('http://www.fullerton.edu/ecs/cs/faculty/','<h2>Faculty','Faculty Early Retirement Program');
							$dom = new DOMDocument();
							@$dom->loadHTML($html);
							$a = $dom->getElementsByTagName('p');  
							for ($i=0; $i < $a->length; $i++) {
								$attr = $a->item($i)->textContent;
								
							if(strpos($attr, "Dean") == true || strpos($attr, "Coordinator") == true || strpos($attr, "Director") == true )//if (strpos($attr, 'Dean') !== false)  //if(strpos($position, "Dean") == true || strpos($position, "Coordinator") == true || strpos($position, "Director") == true )  // College Dean
								{ 							
									$taylors = explode( 'Office:', strip_tags($attr ));	
									$taylors[0] = str_replace("â", " ", $taylors[0]);
									$taylors[1] = str_replace("Â", " ", $taylors[1]);
									$taylors[1] = str_replace("â", " ", $taylors[1]);
																
								}								 
							
							}	 
						}	
						if($_SESSION['view'][$j]=="KDU")
						{
							$KDU[0] = "no info...";
							$KDU[1] = "no info...";
							$KDU[2] = "no info...";
						}
						if($_SESSION['view'][$j]=="UCSI")
						{	$k=0;
							if (!empty($Uselected))
							{
								if ($Uselected==1)
								{
									$UCSI[0] = "Dr. Toh Kian Kok";
									$UCSI[1] = "Dean";
									$UCSI[2] = "tohkk@ucsi.edu.my";
									$k = 3;
 								}
							}else {$k=0;}							

								$some_link = 'http://www.ucsi.edu.my/v2/fobis/staff/it.aspx';	
								$dom = new DOMDocument;
								$dom->preserveWhiteSpace = false;
								@$dom->loadHTMLFile($some_link);								
								$domxpath = new DOMXPath($dom);
								$newDom = new DOMDocument;
								$newDom->formatOutput = true;
								$filtered = $domxpath->query("// table" . '[@' . "class='tab6']"); 
								$i = 0; 
								$myItem = $filtered->item(0)  ;
								$node = $newDom->importNode( $myItem, true );    // import node			 
								$newDom->appendChild($node); 
								$test = $newDom->saveHTML();				// convert to string											$pieces = explode("<td>", $test);
								$pieces = explode("<td>", $test);
								$r = 0;
								$E = count($pieces);
								for($i=0; $i < $E; $i++)
								{
									if (strpos($pieces[$i], "<b>")==true)
									{
										$pieces[$i] = getTextBetweenTags($pieces[$i],"b");
									}
									if (strpos($pieces[$i], "</a>")==true && strpos($pieces[$i], "br")==true)
									{
										
										$position = explode("<img", $pieces[$i]);
										$email[$r] = getAttribute('href', $pieces[$i]);
										$email[$r] = str_replace("mailto:", "", $email[$r]);
										$pieces[$i] = str_replace("$email[$r]", "", $pieces[$i]);	
										$r++;
										$pieces[$i] = $position[0]; 
									}
								}
								$F = count($pieces);
								for ($i=1; $i < $F; $i++)
								{
									if (strpos($pieces[$i], "Head")==true)
									{	 
										$UCSI[$k] = $pieces[$i-2];
										$k++;
										$UCSI[$k] = $pieces[$i];
										$k++;
										$UCSI[$k] = $email[($i/4)-1];
										$k++;
									}
								}							
						}
					}
				}
			}      
		} 
		if ($headSelected==1 || $directorSelected==1)
		{
			// Display Tables
		echo "<div class='accordian'>";
		echo "<ul>";
			// display CSUN university staff 
			echo "<li>CSUN University</li>";
			echo "<li>";
			echo "<b>School Management Team</b></br>";
				if (isset($nottingham)){
					echo "<table class='display' cellspacing='1'>";
					echo "<thead>";
						echo "<tr>";
							echo "<th>Name</th>";
							//echo "<th></th><th>Position</th>";
							echo "<th>Contact Info</th>";		 
						echo "</tr>";
					echo "</thead>";
					echo "<tbody>";
					// display nottingham staff					
					$N = count($nottingham);
					for($i=0; $i < $N; $i++)
					{
						echo "<tr>";
						echo "<td ><strong>".$nottingham[$i]."</strong></td>";	
						//echo "<td ><strong>".$nottingham[$i+1]."</strong></td>";	
						echo "<td ><strong>".$nottingham[$i+1]."</strong></td>";						
						echo "</tr>";	
						$i=$i+2;
					}
 					echo "</tbody>";
					echo "</table>";				
				}else{echo " It is not selected";}
			echo "<br/><b>See the School Management Team's Page:	</b><a href='http://www.csun.edu/engineering-computer-science/cs-faculty' target='_blank'><font color='blue'>click on</font></a><br/>";
			echo "</li>";
			
			// display CSUF university staff
 			echo "<li>CSUF University</li>";
			echo "<li>";
			echo "<b>School Management Team</b></br>";
				if (isset($taylors)){
					echo "<table class='display' cellspacing='1'>";
					echo "<thead>";
						echo "<tr>";
							echo "<th>Name</th>";
							//echo "<th></th><th>Position</th>";
							echo "<th>Contact Info</th>";		 
						echo "</tr>";
					echo "</thead>";
					echo "<tbody>";
					// display CSUF staff					
					$N = count($taylors);
					for($i=0; $i < $N; $i++)
					{
						echo "<tr>";
						echo "<td ><strong>".$taylors[$i]."</strong></td>";	
						//echo "<td ><strong>".$taylors[$i+1]."</strong></td>";	
						echo "<td ><strong>".$taylors[$i+1]."</strong></td>";						
						echo "</tr>";	
						$i=$i+1;
					}
 					echo "</tbody>";
					echo "</table>";				
				}else{echo " It is not selected";}
			echo "<br/><b>See the School Management Team's Page:	</b><a href='http://www.fullerton.edu/ecs/cs/faculty/' target='_blank'><font color='blue'>click on</font></a><br/>";
			echo "</li>";
			
			// displays sunway university staff
 			echo "<li>Sunway University</li>";
			echo "<li>";
			echo "<b>School Management Team</b></br>";
				if (isset($sunway)){
					echo "<table class='display' cellspacing='1'>";
					echo "<thead>";
						echo "<tr>";
							echo "<th></th><th>Name</th>";
							//echo "<th></th><th>Position</th>";
							echo "<th></th><th>Contact Info</th><th></th>";		 
						echo "</tr>";
					echo "</thead>";
					echo "<tbody>";
					// display taylors staff					
					$N = count($sunway);
					for($i=0; $i < $N; $i++)
					{
						echo "<tr>";
						echo "<td ><strong>".$sunway[$i]."</strong></td>";	
						//echo "<td ><strong>".$sunway[$i+1]."</strong></td>";	
						echo "<td ><strong>".$sunway[$i+2]."</strong></td><td></td>";						
						echo "</tr>";	
						$i=$i+2;
					}
 					echo "</tbody>";
					echo "</table>";				
				}else{echo " It is not selected";}
			echo "<br/><b>See the School Management Team's Page:	</b><a href='http://sunway.edu.my/university/sct/management-staff' target='_blank'><font color='blue'>click on</font></a><br/>";
			echo "</li>";
			
			// displays KDU university staff
 			echo "<li>KDU University</li>";
			echo "<li>";
			echo "<b>School Management Team</b></br>";
				if (isset($KDU)){
					echo "<table class='display' cellspacing='1'>";
					echo "<thead>";
						echo "<tr>";
							echo "<th></th><th>Name</th>";
							//echo "<th></th><th>Position</th>";
							echo "<th></th><th>Contact Info</th><th></th>";		 
						echo "</tr>";
					echo "</thead>";
					echo "<tbody>";
					// display KDU staff	
						echo "<tr>";
						echo "<td></td>";
						echo "<td ><strong>".$KDU[0]."</strong></td>";	
						//echo "<td ><strong>".$KDU[0]."</strong></td>";
						echo "<td></td>";						
						echo "<td ><strong>".$KDU[0]."</strong></td><td></td>";						
						echo "</tr>";
 					echo "</tbody>";
					echo "</table>";				
				}else{echo " It is not selected";}
			echo "<br/><b>See the School Management Team's Page:	</b><a href='http://www.kdu.edu.my/programmes/information-technology.html' target='_blank'><font color='blue'>click on</font></a><br/>";
			echo "</li>";
			
			// display UCSI university staff 
			echo "<li>UCSI University</li>";
			echo "<li>";
			echo "<b>School Management Team</b></br>";
				if (isset($UCSI)){
					echo "<table class='display' cellspacing='1'>";
					echo "<thead>";
						echo "<tr>";
							echo "<th></th><th>Name</th>";
							//echo "<th></th><th>Position</th>";
							echo "<th></th><th>Contact Info</th><th></th>";		 
						echo "</tr>";
					echo "</thead>";
					echo "<tbody>";
					// display UCSI staff					
					$N = count($UCSI);
					for($i=0; $i < $N; $i++)
					{
						echo "<tr>";
						echo "<td></td>";
						echo "<td ><strong>".$UCSI[$i]."</strong></td>";	
						echo "<td></td>";
						//echo "<td ><strong>".$nottingham[$i+1]."</strong></td>";	
						echo "<td ><strong>".$UCSI[$i+2]."</strong></td><td></td>";						
						echo "</tr>";	
						$i=$i+2;
					}
 					echo "</tbody>";
					echo "</table>";				
				}else{echo " It is not selected";}
			echo "<br/><b>See the School Management Team's Page:	</b><a href='http://www.ucsi.edu.my/v2/fobis/staff/it.aspx' target='_blank'><font color='blue'>click on</font></a><br/>";
			echo "</li>";
		echo "</ul>";
		echo "</div>";		
		}
		if($selected==0) {echo "This Item is not Selected"; }
	}
   echo  "</div>";
   
   //second tab ---------------------------------------------------------
   echo "<div id='fragment-2'>";   
   $selected = 0;
    $N = count($arrayStaff);
    for($i=0; $i < $N; $i++)
    {
		if($arrayStaff[$i]=="academic")
		{
			echo "<div class='accordian'>";
			echo "<ul>";
			$selected = 1;  
			// get the universities name
			$s = count($_SESSION['view']);
			for($j=0; $j < $s; $j++)
			{
				if($_SESSION['view'][$j]=="CSUF")
				{
					 // get college Dean and Faculty Staff
					$html = $html = getTextBetweenHTML ('http://www.fullerton.edu/ecs/cs/faculty/','<h2>Faculty','Faculty Early Retirement Program');
					$dom = new DOMDocument();
					@$dom->loadHTML($html);
					$a = $dom->getElementsByTagName('p');  
					$taylors [0]= '';
					$add;
					$merged = '';
					$nameContactExplode [0]= '';
					for ($i=0; $i < $a->length; $i++) {
						$attr = $a->item($i)->textContent;		
						$add = strip_tags($attr);
						if (strpos($add, "Office:") == true)	{				
							$add = $add."||";
						}	
						$merged = $merged.$add;		
					}
					$arr [0] = '';
					$nameContactExplode = explode( '||', $merged );
					$N = count($nameContactExplode);
					$h = 0;
					for($i=0; $i < $N-1; $i++){
						// Just set the variable to the name and family - delete the rest of the sentence
						$arr = explode( 'Office:', $nameContactExplode[$i] ); 
						if (strpos($arr [0], "Professor") == true){
							$seprated = explode( 'Professor', $arr [0]);
							$arr [0] =str_replace(",", " ", $seprated[0]);
						}
						if (strpos($arr [0], "Assistant") == true){
							$seprated = explode( 'Assistant', $arr [0]);
							$arr [0] =str_replace(",", " ", $seprated[0]);
						}
						if (strpos($arr [0], "Lecturer") == true){
							$seprated = explode( 'Lecturer', $arr [0]);
							$arr [0] =str_replace(",", " ", $seprated[0]);
						}
						if (strpos($arr [0], "Associate ") == true){
							$seprated = explode( 'Associate ', $arr [0]);
							$arr [0] =str_replace(",", " ", $seprated[0]);
						}
						$taylors [$h] = $arr [0];
						
						$seprated = explode( 'Phone:', $arr [1]);
						$office = $seprated [0];
						if (strpos($seprated[1], "email:") == true){
						$seprated = explode( 'email:', $seprated[1]);
						$Phone = $seprated [0];
						}else{ $Phone = ""; }
						
						
						if (strpos($seprated[1], "URL:") == true){
						$seprated = explode( 'URL:', $seprated[1]);
						$email = $seprated [0];
						}else{ $email = ""; }						
				 
						$taylors [$h+1] = $office."</br>".$Phone."</br>".$email;
						$h = $h+2;
					}
					
					echo "<li>CSUF University</li>";
					echo "<li>";
					//echo "<b>Senior Lecturers;</b></br>";
					echo "<table class='display' cellspacing='1'>";
					echo "<thead>";
						echo "<tr>";
							echo "<th>Name</th>";
							echo "<th>Contact Info</th>";		 
						echo "</tr>";
					echo "</thead>";
					echo "<tbody>";
					$N = count($taylors);
					for($i=0; $i < $N; $i++)
					{				
						echo "<tr>";  
						//echo "<td><strong >".substr($taylors[$i], 0, 30)."....</strong></td>";	
						echo "<td><strong >".$taylors[$i]."</strong></td>";
						echo "<td width='33%'><strong>".$taylors[$i+1]."</strong></td>";						
						echo "</tr>";	
						$i=$i+1;	
						
					}	
 					echo "</tbody>";
					echo "</table>";					
					echo "<br/><b>All lecturers:	</b><a href='http://www.fullerton.edu/ecs/cs/faculty/' target='_blank'><font color='blue'>click on</font></a><br/>";
					echo "</li>";				
				}
				if($_SESSION['view'][$j]=="CSUN")
				{
					
					echo "<li>CSUN University</li>";	
					echo "<li>";
					echo "<b>Lecturers;</b></br>";
					echo "<table class='display' cellspacing='1'>";
					echo "<thead>";
						echo "<tr>";
							echo "<th>Name and Contact Info</th>";
						echo "</tr>";
					echo "</thead>";
					echo "<tbody>";	
					// get college Dean and Faculty Staff
					$html = $html = getTextBetweenHTML ('http://www.csun.edu/engineering-computer-science/cs-faculty','Full Time Faculty','Lecturers');
					$dom = new DOMDocument();
					@$dom->loadHTML($html);
					$a = $dom->getElementsByTagName('p');   
					$nottingham [0]= '';
					$h = 0;
					for ($i=0; $i < $a->length; $i++) {
						$attr = $a->item($i)->textContent;	
						if(strpos($attr, "Chair") == false) {							
							$attr = str_replace("â", " ", $attr);
							$attr= str_replace("Â", " ", $attr);
							$nottingham = explode( 'Phone', $attr);	// seprated by phone keyword
							$N = count($nottingham);					
							for($j=2; $j < $N; $j++){
								$nottingham [$j] = substr($nottingham [$j], 33, 150);  // remove extra data such as contact number
								echo "<tr>";
								echo "<td ><strong>".$nottingham[$j]."</strong></td>";						
								echo "</tr>";								
							}								 
						}
	 
					}	
					echo "</tbody>";
					echo "</table>";
					echo "<br/><b>See the Academic Staff's Page:	</b><a href='http://www.csun.edu/engineering-computer-science/cs-faculty' target='_blank'><font color='blue'>click on</font></a><br/>";	
					echo "</li>";	
				}
				if($_SESSION['view'][$j]=="sunway")
				{		
					unset ($sunway);
					$some_link = 'http://sunway.edu.my/university/sct/academic';	
					@$dom->loadHTMLFile($some_link); 
					$domxpath = new DOMXPath($dom);
					$filtered = $domxpath->query("//td");
					$i = 0;
					$k=0;
					while( $myItem = $filtered->item($i++) ){
						$node = $newDom->importNode( $myItem, true );    // import node			 
						$newDom->appendChild($node);                    // append node
						$position = $newDom->saveHTML();					// convert to string
						if(strpos($position, "Senior") == true)
						{
							$newDom->removeChild($node);
							$myItem = $filtered->item($i-2);	
							$node = $newDom->importNode( $myItem, true );    // import node			 
							$newDom->appendChild($node);                    // append node
							$sunway[$k] = $newDom->saveHTML();					// convert to string
							$k++;
							$newDom->removeChild($node);
							$myItem = $filtered->item($i+2);	
							$node = $newDom->importNode( $myItem, true );    // import node			 
							$newDom->appendChild($node);                    // append node
							$sunway[$k] = $newDom->saveHTML();					// convert to string	
							$k++;
						}
						$newDom->removeChild($node);				 	 
					}						
					echo "<li>Sunway University</li>";
					echo "<li>";
					echo "<b>Senior Lecturers;</b></br>";
					echo "<table class='display' cellspacing='1'>";
					echo "<thead>";
						echo "<tr>";
							echo "<th></th><th>Name</th>";
							echo "<th></th><th>Contact Info</th><th></th>";		 
						echo "</tr>";
					echo "</thead>";
					echo "<tbody>";
					$N = count($sunway);
					// start from i=2 because of interface, otherwise can start from i=0;
					for($i=2; $i < $N; $i++)
					{				
						echo "<tr>";
						echo "<td ><strong>".$sunway[$i]."</strong></td>";	
						echo "<td ><strong>".$sunway[$i+1]."</strong></td><td></td>";						
						echo "</tr>";	
						$i=$i+1;				
					}	
 					echo "</tbody>";
					echo "</table>";					
					echo "<br/><b>All lecturers:	</b><a href='$some_link' target='_blank'><font color='blue'>click on</font></a><br/>";
					echo "</li>";			
				}
				if($_SESSION['view'][$j]=="KDU")
				{
					echo "<li>KDU University</li>";
					echo "<li>";
					echo "<b>Senior Lecturers;</b></br>";
					echo "<table class='display' cellspacing='1'>";
					echo "<thead>";
						echo "<tr>";
							echo "<th></th><th>Name</th>";
							echo "<th></th><th>Contact Info</th><th></th>";		 
						echo "</tr>";
					echo "</thead>";
					echo "<tbody>";
					$N = count($sunway); 				
					echo "<tr>";
					echo "<td></td>";
					echo "<td ><strong> no info </strong></td>";	
					echo "<td></td>";
					echo "<td ><strong> no info </strong></td><td></td>";						
					echo "</tr>";				 	
 					echo "</tbody>";
					echo "</table>";					
					echo "<br/><b>All lecturers:	</b><a href='http://www.kdu.edu.my/programmes/information-technology.html' target='_blank'><font color='blue'>click on</font></a><br/>";
					echo "</li>";				
				}
				if($_SESSION['view'][$j]=="UCSI")
				{
					$some_link = 'http://www.ucsi.edu.my/v2/fobis/staff/it.aspx';	
					$dom = new DOMDocument;
					$dom->preserveWhiteSpace = false;
					@$dom->loadHTMLFile($some_link);				 
					$domxpath = new DOMXPath($dom);
					$newDom = new DOMDocument;
					$newDom->formatOutput = true;

					$filtered = $domxpath->query("// table" . '[@' . "class='tab6']"); 
					$i = 0; 
					$myItem = $filtered->item(0)  ;
					$node = $newDom->importNode( $myItem, true );    // import node			 
					$newDom->appendChild($node); 
					$test = $newDom->saveHTML();				// convert to string		
					$pieces = explode("<td>", $test);
					$k = 0;
					$N = count($pieces);
					for($i=0; $i < $N; $i++)
					{
						if (strpos($pieces[$i], "<b>")==true)
						{
							//echo  "<br/>----".getAttribute('<b>', $pieces[$i]);
							$pieces[$i] = getTextBetweenTags($pieces[$i],"b");
							//echo "<li/>".$pieces[$i]."<br/>";
						}
						if (strpos($pieces[$i], "</a>")==true && strpos($pieces[$i], "br")==true)
						{
							$position = explode("<img", $pieces[$i]);
							//echo "<li/>".$position[0];
							$email[$k] = getAttribute('href', $pieces[$i]);
							$email[$k] = str_replace("mailto:", "", $email[$k]);
							$pieces[$i] = str_replace("$email[$k]", "", $pieces[$i]);	
							//echo "<li/>".$email[$k]."<br/>";
							$k++;
							$pieces[$i] = $position[0]; 
						}
					}
					$f = 0;
					$E = count($pieces);
					for ($i=1; $i < $E; $i++)
					{
						if (strpos($pieces[$i], "Lecturer")==true)
						{	 
							$UCSI[$f] = $pieces[$i-2];
							$f++;
							$UCSI[$f] = $pieces[$i];
							$f++;
							$UCSI[$f] = $email[($i/4)-1];
							$f++;
						}
					}					
					echo "<li>UCSI University</li>";	
					echo "<li>";
					echo "<b>Lecturers;</b></br>";
					echo "<table class='display' cellspacing='1'>";
					echo "<thead>";
						echo "<tr>";
							echo "<th></th><th>Name</th>";
							echo "<th></th><th>Contact Info</th><th></th>";		 
						echo "</tr>";
					echo "</thead>";
					echo "<tbody>";
					$N = count($UCSI);
					for($i=0; $i < $N; $i++)
					{				
						echo "<tr>";
						echo "<td></td>";
						echo "<td ><strong>".$UCSI[$i]."</strong></td>";	
						echo "<td></td>";
						echo "<td ><strong>".$UCSI[$i+2]."</strong></td><td></td>";						
						echo "</tr>";	
						$i=$i+2;				
					}	
 					echo "</tbody>";
					echo "</table>";
					echo "<br/><b>See the Academic Staff's Page:	</b><a href='$some_link' target='_blank'><font color='blue'>click on</font></a><br/>";
	
					echo "</li>";			
				}				
			}
			echo "</ul>";
			echo "</div>";			
 		}
	}
	 if($selected==0) {echo "This Item is not Selected"; } 	
   echo "</div>";  
   
   // third tab	---------------------------------------------------------
   echo "<div id='fragment-3'>";   
   $selected = 0;
    $N = count($arrayStaff); 
    for($i=0; $i < $N; $i++)
    {
		if($arrayStaff[$i]=="administrative")
		{
			$selected = 1;
			echo "<div class='accordian'>";
			echo "<ul>";
			$s = count($_SESSION['view']);
			for($j=0; $j < $s; $j++)
			{	
				if($_SESSION['view'][$j]=="CSUF"){	
					$html = $html = getTextBetweenHTML ('http://www.fullerton.edu/ecs/cs/faculty/','<h2>Staff','Fullerton All Rights Reserved');
					$dom = new DOMDocument();
					@$dom->loadHTML($html);
					$a = $dom->getElementsByTagName('h3');  
					$collegeAdmin [0]= '';
					$collegeAdmin1 [0]= '';
					$j=0;
					for ($i=0; $i < $a->length; $i++) {
						$attr = $a->item($i)->textContent;
						$collegeAdmin [$i]= strip_tags($attr); 
					}
					
					$b = $dom->getElementsByTagName('p');  
					for ($i=0; $i < $b->length; $i++) {
						$attr = $b->item($i)->textContent;
						$collegeAdmin1 [$i]= strip_tags($attr); 
					}
					
					echo "<li>CSUF University</li>";
					echo "<li>";
					echo "<b>Administrative Staff;</b></br>";
					echo "<table class='display' cellspacing='1'>";
					echo "<thead>";
						echo "<tr>";
							echo "<th>Name</th>";
							echo "<th>Contact Info</th>";		 
						echo "</tr>";
					echo "</thead>";
					echo "<tbody>";
					$N = count($collegeAdmin);
					$h = 0;
					for($i=0; $i < $N; $i++)
					{	 		
						echo "<tr>";
						echo "<td ><strong>".$collegeAdmin[$i]."</strong></td>";	
						echo "<td ><strong>".$collegeAdmin1[$h]."-".$collegeAdmin1[$h+1]."-".$collegeAdmin1[$h+2]."</strong></td>";						
						echo "</tr>";	
						$h = $h+3;
					}	
 					echo "</tbody>";
					echo "</table>";					
					echo "<br/><b>See the Administrative Staff's Page:	</b><a href='http://www.fullerton.edu/ecs/cs/faculty/' target='_blank'><font color='blue'>click on</font></a><br/>";
					echo "</li>";
				}
				if($_SESSION['view'][$j]=="sunway"){
					unset ($sunway);
					$some_link = 'http://sunway.edu.my/university/sct/admin';	
					$dom = new DOMDocument;
					$dom->preserveWhiteSpace = false;
					@$dom->loadHTMLFile($some_link);				 
					$domxpath = new DOMXPath($dom);
					$newDom = new DOMDocument;
					$newDom->formatOutput = true;
					//Administrative Staff
					$filtered = $domxpath->query("//td");
					$i = 0;
					$k = 0;
					while( $myItem = $filtered->item($i++) ){
						$node = $newDom->importNode( $myItem, true );    // import node			 
						$newDom->appendChild($node); 
						$test = $newDom->saveHTML();				// convert to string	 
						if($i == 1 || ($i+4)%5==0){
							$sunway [$k] = 	$test;	
							$k++;		
						}
						if ($i%5==0){
							$sunway [$k] = $test;
							$k++;
						} 
						$newDom->removeChild($node);				 	 
					}
					echo "<li>Sunway University</li>";
					echo "<li>";	
					echo "<b>Administrative Staff;</b></br>";
					echo "<table class='display' cellspacing='1'>";
					echo "<thead>";
						echo "<tr>";
							echo "<th></th><th>Name</th>";
							echo "<th></th><th>Contact Info</th><th></th>";		 
						echo "</tr>";
					echo "</thead>";
					echo "<tbody>";
					$E = count($sunway)-2;
					for($i=0; $i < $E; $i++)
					{
						echo "<tr>";
						echo "<td ><strong>".$sunway[$i]."</strong></td>";	
						echo "<td ><strong>".$sunway[$i+1]."</strong></td><td></td>";						
						echo "</tr>";	
						$i=$i+1;				
					}	
 					echo "</tbody>";
					echo "</table>";					
					echo "<br/><b>See the Administrative Staff's Page:	</b><a href='$some_link' target='_blank'><font color='blue'>click on</font></a><br/>";
					echo "</li>";
				}
				if($_SESSION['view'][$j]=="nottingham"){
					unset($nottingham);
					//adminastrative staff
					$some_link = 'http://www.nottingham.edu.my/ComputerScience/People/index.aspx';
					$dom = new DOMDocument;
					$dom->preserveWhiteSpace = false;
					@$dom->loadHTMLFile($some_link);					 
					$domxpath = new DOMXPath($dom);
					$newDom = new DOMDocument;
					$newDom->formatOutput = true;
					$filtered = $domxpath->query("// td"); 
					$i = 4;
					$k=0;
					while( $myItem = $filtered->item($i++) ){
						if($i>6){break;}
						$node = $newDom->importNode( $myItem, true );    // import node			 
						$newDom->appendChild($node);                    // append node
						$test = $newDom->saveHTML();					// convert to string
						$nottingham[$k] = $test;								// display node info
						$k++;
						$newDom->removeChild($node);					// reset object information 		 
					}						
					echo "<li>Nottingham University</li>";
					echo "<li>"; 
					echo "<b>Administrative Staff;</b></br>";
					echo "<table class='display' cellspacing='1'>";
					echo "<thead>";
						echo "<tr>";
							echo "<th></th><th>Name</th>";
							echo "<th></th><th>Contact Info</th><th></th>";		 
						echo "</tr>";
					echo "</thead>";
					echo "<tbody>";
					$N = count($nottingham);
					for($i=0; $i < $N; $i++)
					{				
						echo "<tr>";
						echo "<td ><strong>".$nottingham[$i]."</strong></td>";	
						echo "<td ><strong>".$nottingham[$i+1]."</strong></td><td></td>";						
						echo "</tr>";	
						$i=$i+1;				
					}	
 					echo "</tbody>";
					echo "</table>";
					echo "<br/><b>See the Administrative Staff's Page:	</b><a href='$some_link' target='_blank'><font color='blue'>click on</font></a><br/>";
					echo "</li>";
				}
				if($_SESSION['view'][$j]=="KDU"){
					echo "<li>KDU University</li>";
					echo "<li>"; 
					echo "<b>Administrative Staff;</b></br>";
					echo "<table class='display' cellspacing='1'>";
					echo "<thead>";
						echo "<tr>";
							echo "<th></th><th>Name</th>";
							echo "<th></th><th>Contact Info</th><th></th>";		 
						echo "</tr>";
					echo "</thead>";
					echo "<tbody>"; 			
					echo "<tr>";
					echo "<td></td>";
					echo "<td ><strong> no info </strong></td>";	
					echo "<td></td>";	
					echo "<td ><strong> no info </strong></td><td></td>";					
					echo "</tr>"; 
 					echo "</tbody>";
					echo "</table>";
					echo "<br/><b>See the Administrative Staff's Page:	</b><a href='$some_link' target='_blank'><font color='blue'>click on</font></a><br/>";
					echo "</li>";		
				}
				if($_SESSION['view'][$j]=="UCSI"){
					unset($UCSI);
					//adminastrative staff
					$some_link = 'http://www.ucsi.edu.my/v2/fobis/staff/it.aspx';	
					$dom = new DOMDocument;
					$dom->preserveWhiteSpace = false;
					@$dom->loadHTMLFile($some_link);				 
					$domxpath = new DOMXPath($dom);
					$newDom = new DOMDocument;
					$newDom->formatOutput = true;

					$filtered = $domxpath->query("// table" . '[@' . "class='tab6']"); 
					$i = 0; 
					$myItem = $filtered->item(0)  ;
					$node = $newDom->importNode( $myItem, true );    // import node			 
					$newDom->appendChild($node); 
					$test = $newDom->saveHTML();				// convert to string		
					$pieces = explode("<td>", $test);
					$k = 0;
					$P = count($pieces);
					for($i=0; $i < $P; $i++)
					{
						if (strpos($pieces[$i], "<b>")==true)
						{
							$pieces[$i] = getTextBetweenTags($pieces[$i],"b");
						}
						if (strpos($pieces[$i], "</a>")==true && strpos($pieces[$i], "br")==true)
						{
							$position = explode("<img", $pieces[$i]);
							$email[$k] = getAttribute('href', $pieces[$i]);
							$email[$k] = str_replace("mailto:", "", $email[$k]);
							$pieces[$i] = str_replace("$email[$k]", "", $pieces[$i]);	
							$k++;
							$pieces[$i] = $position[0]; 
						}
					}
					$f = 0;
					$T = count($pieces);
					for ($i=1; $i < $T; $i++)
					{
						if (strpos($pieces[$i], "Admin")==true)
						{	 
							$UCSI[$f] = $pieces[$i-2];
							$f++;
							$UCSI[$f] = $pieces[$i];
							$f++;
							$UCSI[$f] = $email[($i/4)-1];
							$f++;
						}
					} 
					echo "<li>UCSI University</li>";
					echo "<li>"; 
					echo "<b>Administrative Staff;</b></br>";
					echo "<table class='display' cellspacing='1'>";
					echo "<thead>";
						echo "<tr>";
							echo "<th></th><th>Name</th>";
							echo "<th></th><th>Contact Info</th><th></th>";		 
						echo "</tr>";
					echo "</thead>";
					echo "<tbody>";
					$R = count($UCSI);
					for($i=0; $i < $R; $i++)
					{				
						echo "<tr>";
						echo "<td></td>";
						echo "<td ><strong>".$UCSI[$i]."</strong></td>";	
						echo "<td></td>";
						echo "<td ><strong>".$UCSI[$i+2]."</strong></td><td></td>";						
						echo "</tr>";	
						$i=$i+2;				
					}	
 					echo "</tbody>";
					echo "</table>";
					echo "<br/><b>See the Administrative Staff's Page:	</b><a href='$some_link' target='_blank'><font color='blue'>click on</font></a><br/>";
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