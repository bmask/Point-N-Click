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
<h1>University worldRanking</h1> 
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
<div id="page" style="font-size:62.5%; ">  
  <div id="tabs">

	<?php
	session_start();
	   echo "<ul>";
        echo "<li><a href='#fragment-1'><span>University worldRanking</span></a></li>";
    echo "</ul>";
   // first tab	---------------------------------------------------------  
	echo "<div id='fragment-1'>"; 
		$CSUF = 0;
		$CSUN = 0;
		$UCSI = 0;
		$KDU = 0;
		$UCLA = 0;
 		echo "<div class='accordian'>";
			$s = count($_SESSION['view']);
			for($j=0; $j < $s; $j++)
			{		
				if($_SESSION['view'][$j]=="CSUF"){
					$CSUF = 1;
				}
				if($_SESSION['view'][$j]=="UCLA"){
					$UCLA = 1;
				}
				if($_SESSION['view'][$j]=="CSUN"){
					$CSUN = 1;
				}
				if($_SESSION['view'][$j]=="KDU"){
					$KDU = 1;
				}
				if($_SESSION['view'][$j]=="UCSI"){
					$UCSI = 1;
				}
			}
				
					echo "<b>University worldRanking</b></br>";
				//if (isset($nottingham)){
					echo "<table class='display' cellspacing='1'>";
					echo "<thead>";
						echo "<tr>";
							echo "<th>Local Rank</th>";
							echo "<th>World Rank</th>";	
							echo "<th>University</th>";
							echo "<th>Presence Rank</th>";
							echo "<th>Impact Rank</th>";
							echo "<th>Openness Rank</th>";	
							echo "<th>Excellence Rank</th>";							
						echo "</tr>";
					echo "</thead>";
					echo "<tbody><font COLOR='#800517'>";

					
					$some_link [0] = 'http://www.webometrics.info/en/Americas/USA?page=1'; // Set page 2
					$some_link [1] = 'http://www.webometrics.info/en/Americas/USA' ; // Set page 1
					$dom = new DOMDocument;
					$dom->preserveWhiteSpace = false;
					$page = 0;
					while ($page<2) {						
						@$dom->loadHTMLFile($some_link[$page]); // Read each page
						$domxpath = new DOMXPath($dom);
						$newDom = new DOMDocument;
						$newDom->formatOutput = true;
						$filtered = $domxpath->query("//tr" . '[@' . "class='odd']"); // get <tr> content 
						$i = 0;
						$k = 0;
						while( $myItem = $filtered->item($i++) ){
							$node = $newDom->importNode( $myItem, true );    // import node			 
							$newDom->appendChild($node);                    // append node
							$test = $newDom->saveHTML();					// convert to string
							if(strpos($test, "California State University Fullerton" ) && $CSUF==1|| strpos($test, "California State University Northridge" ) && $CSUN==1 || strpos($test, "University of California Los Angeles UCLA" ) && $UCLA==1 )		
							{	echo "<tr>";
								$arr = explode("</td>", $test);
								for ($j=0; $j < count ($arr); $j++) { 
									$val= trim(strip_tags($arr[$j]));
									if ($val != NULL){
										echo "<td width='33%'><strong>".$val."</strong></td>";
									}
								}
								$k++;
								echo "</tr>";
							}
							$newDom->removeChild($node);					// reset object information 
						}
						$page++;
					}						
 					echo "</font></tbody>";
					echo "</table>";				
				//}else{echo " It is not selected";}
			echo "<br/><b>See All USA Universities' Rankings' Page:	</b><a href='http://www.webometrics.info/en/Americas/USA' target='_blank'><font color='blue'>click on</font></a><br/>";
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