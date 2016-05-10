<!DOCTYPE html>
<html>
<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<link rel="stylesheet" type="text/css" href="css/styles.css" />
<link rel="stylesheet" type="text/css" href="jquery.tzCheckbox/jquery.tzCheckbox.css" />
<script src="js/jquery.min.js"></script>
<script src="jquery.tzCheckbox/jquery.tzCheckbox.js"></script>
<script src="js/script.js"></script>
<script>
	var select = 0;
	function addOption1(x) {
	sOption=document.getElementById('textBox1').value;
	sOptions=sOption.split("\n");
	document.getElementById('textBox1').value="CSU Northridge University;\n"+x+"\n";
	}
	function addOption2(x) {
	sOption=document.getElementById('textBox2').value;
	sOptions=sOption.split("\n");
	document.getElementById('textBox2').value="CSUF University;\n"+x+"\n";
	}
	function addOption3(x) {
	sOption=document.getElementById('textBox3').value;
	sOptions=sOption.split("\n");
	document.getElementById('textBox3').value="UCLA University;\n"+x+"\n";
	}
	function addOption4(x) {
	sOption=document.getElementById('textBox4').value;
	sOptions=sOption.split("\n");
	document.getElementById('textBox4').value="KDU University;\n"+x+"\n";
	}
	function dropdown(sel) {
	if(select !=0)
	{
		document.getElementById(select).style.display='none';
	}
	var value = sel.options[sel.selectedIndex].value;				 
	select = value;
	document.getElementById(value).style.display='block';			 
	}
</script>
</head>
<body bgcolor="#f2f2f2">
 <style type="text/css"> 
 h2{font-family:Georgia ; font-style: italic;font-variant: small-caps; font-size: 2.5em; color: #C0C0C0; text-align:left; padding:0; margin-top:-80px;margin-bottom:100px;margin-right:50px;margin-left:50px;}
 h1 {font-size: 4.5em; font-family: "Brush Script MT", cursive; color: #fced01; text-align:left; padding:0; margin-top:-80px;margin-bottom:100px;margin-right:50px;margin-left:80px;}
 #help {padding:0; margin-top:-130px;margin-bottom:100px;margin-right:-700px;}
 #logo {position:relative; padding:0; margin-top:-130px;margin-bottom:200px;margin-right:-200px;margin-left:200px;}
#page {position:absolute; padding:0; margin-top:-500px;margin-bottom:200px;margin-right:-300px;margin-left:600px;}
.textarea {position:absolute; padding:0; margin-top:150px;margin-bottom:200px;margin-right:350px}
#button {position:relative; padding:0; margin-top:-480px;margin-bottom:200px;margin-right:-230px;margin-left:260px;}
#button ul { list-style-type: none; }
.UCSI {position:absolute; padding:0; margin-top:-135px;margin-bottom:200px;margin-right:-40px;margin-left:365px;}
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
<h1>Fees Information</h1> 
<img src="helpIcon.png" alt="help" id="help" />
</td>
</tr>
<tr>
<td>
<img src="logo.png" alt="logo" id="logo"/>
<div id="button">
<ul>
	<!--<li><button  class="classname" onClick="history.go(-1)" > << Previous Page </button></li>	-->
	<li><button  class="classname" onclick="parent.location='MainPage.php'" > << Home Page </button></li>	
</ul>
</div>
<div id="page">  

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
// get UCLA university tuition fees
 
					$dom = new DOMDocument;
					$dom->preserveWhiteSpace = false;		 						
						//@$dom->loadHTMLFile("http://www.registrar.ucla.edu/fees/gradfee.htm"); // Read each page
						$html = $html = getTextBetweenHTML ('http://www.registrar.ucla.edu/fees/gradfee.htm','</blockquote>','</table>');
						@$dom->loadHTML($html);
						$domxpath = new DOMXPath($dom);
						$newDom = new DOMDocument;
						$newDom->formatOutput = true;
						$filtered = $domxpath->query("//tr"); // get <tr> content 
						$i = 0;  
						$dataA [0]= ''; 
						$dataB [0]= ''; 
						$dataC [0]= ''; 
						$dataD [0]= '';
						$dataE [0]= '';
						$dataF [0]= '';
						$dataL [0]= '';
						$dataUCLA [0]= '';
						$A=0;
						$B=0;
						$C=0;
						$D=0;
						$E=0;
						$F=0;
						$L=0;
						while( $myItem = $filtered->item($i++) ){
							$node = $newDom->importNode( $myItem, true );    // import node			 
							$newDom->appendChild($node);                    // append node
							$test = $newDom->saveHTML();					// convert to string
								if (strpos($test, '</span>') == false && strpos($test, '</p>') == false) {
								 	$arr = explode("</td>", $test);						
								for ($j=0; $j < count ($arr); $j++) { 
									$val= trim(strip_tags($arr[$j]));
									if ($val != NULL){
										//echo $j."=".$val." > ";										 
										if ($j==0){
											$dataA [$A] = $val;	
											$A++;
										}
										if ($j==1){
											$dataB [$B] = $val;	
											$B++;
										}	
										if ($j==2){
											$dataC [$C] = $val;	
											$C++;
										}	
										if ($j==3){
											$dataD [$D] = $val;	
											$D++;
										}	
										if ($j==4){
											$dataE [$E] = $val;	
											$E++;
										}	
										if ($j==5){
											$dataF [$F] = $val;	
											$F++;
										}	
										if ($j==6){
											$dataL [$L] = $val;	
											$L++;
										}											
									}
								}	
								
								}
							 
							$newDom->removeChild($node);					// reset object information 
						}
						$a = '';
						for ($j=0; $j < count ($dataA); $j++) {
							$a = $a.trim(strip_tags($dataA[$j]))."=".trim(strip_tags($dataB[$j]));
						}
						$dataUCLA [0]= $a;
						$a = ''; 
						for ($j=0; $j < count ($dataB); $j++) {
							$a = $a.trim(strip_tags($dataA[$j]))."=".trim(strip_tags($dataB[$j]));
						}	
						$dataUCLA [1]= $a;
						$a = ''; 						
						for ($j=0; $j < count ($dataC); $j++) {
							$a = $a.trim(strip_tags($dataA[$j]))."=".trim(strip_tags($dataC[$j]));
						}	 
						$dataUCLA [2]= $a;
						$a = ''; 
						for ($j=0; $j < count ($dataD); $j++) {
							$a = $a.trim(strip_tags($dataA[$j]))."=".trim(strip_tags($dataD[$j]));
						}	 
						$dataUCLA [3]= $a;
						$a = ''; 
						for ($j=0; $j < count ($dataE); $j++) {
							$a = $a.trim(strip_tags($dataA[$j]))."=".trim(strip_tags($dataE[$j]));
						}	
						$dataUCLA [4]= $a;
						$a = ''; 						
						for ($j=0; $j < count ($dataF); $j++) {
							$a = $a.trim(strip_tags($dataA[$j]))."=".trim(strip_tags($dataF[$j]));
						}	
						$dataUCLA [5]= $a;
						$a = ''; 						
						for ($j=0; $j < count ($dataL); $j++) {
							$a = $a.trim(strip_tags($dataA[$j]))."=".trim(strip_tags($dataL[$j]));
						}	 	
						$dataUCLA [6]= $a;
						$a = ''; 	
	
	// get CSUF fees info 
					$dom = new DOMDocument;
					$dom->preserveWhiteSpace = false;		 						
						@$dom->loadHTMLFile("http://international.fullerton.edu/admissions/costs/"); // Read each page
						$domxpath = new DOMXPath($dom);
						$newDom = new DOMDocument;
						$newDom->formatOutput = true;
						$filtered = $domxpath->query("//tr"); // get <tr> content 
						$i = 0; 
						$table [0]= "";
						$table [1]= "Tuition and Fees(two semesters): ";
						$table [2]= "Living Expenses: ";
						$table [3]= "Total: ";
						$fees= '';
						$data[0]='';
						$k=0;
						$CSUFProgrammes [0] = '';
						while( $myItem = $filtered->item($i++) ){
							$node = $newDom->importNode( $myItem, true );    // import node			 
							$newDom->appendChild($node);                    // append node
							$test = $newDom->saveHTML();					// convert to string
								if (strpos($test, '</td>') !== false) {
								$arr = explode("</td>", $test);		
								$CSUFProgrammes [$k]= trim(strip_tags($arr[0]));								
								for ($j=0; $j < count ($arr); $j++) { 
									$val= trim(strip_tags($arr[$j]));
									if ($val != NULL){
										//echo $table [$j].$val." > ";
										$fees= $fees.$table [$j].$val." > ";
									}
								}
								$data[$k] = $fees ;
								$k++;
								$fees= '';
								
								}
							 
							$newDom->removeChild($node);					// reset object information 
						}	
	
					// get CSUN university fees value output for menu bar
					@$dom->loadHTMLFile('http://www.csun.edu/financialaid/cost-attendance'); // Read the page
					$domxpath = new DOMXPath($dom);
					$newDom = new DOMDocument;
					$newDom->formatOutput = true;
					$filtered = $domxpath->query("//table" . '[@' . "border='0']"); // get <h2> content 
					$dataValueCSUN[0]='';
					$i = 0;
					$k = 0;
					while( $myItem = $filtered->item($i++) ){
						$node = $newDom->importNode( $myItem, true );    // import node			 
						$newDom->appendChild($node);                    // append node
						$test = $newDom->saveHTML();					// convert to string
						if ($i%3==0) 
						{
							$dataValueCSUN[$k] = strip_tags($test);	 
							$k++;
						}						
						$newDom->removeChild($node);					// reset object information 
					}
					echo "++++++++++++++++++"."</br>";

					// get CSUN university fees topics
					@$dom->loadHTMLFile('http://www.csun.edu/financialaid/cost-attendance'); // Read the page
					$domxpath = new DOMXPath($dom);
					$newDom = new DOMDocument;
					$newDom->formatOutput = true;
					$filtered = $domxpath->query("//h2" . '[@' . "class='field field-name-field-title-text field-type-text field-label-hidden']"); // get <h2> content 
					$dataCSUN[0]='';
					$i = 0;
					$k = 0;
					while( $myItem = $filtered->item($i++) ){
						$node = $newDom->importNode( $myItem, true );    // import node			 
						$newDom->appendChild($node);                    // append node
						$test = $newDom->saveHTML();					// convert to string
						$dataCSUN[$k] = strip_tags($test);	
						$k++;
						$newDom->removeChild($node);					// reset object information 
					}						
						
	// get the UCSI programmes info
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
	$some_link = 'http://lms.ucsi.edu.my/fee-schedules';	// input URL address as a variable
	$dom = new DOMDocument;						// create DOM object
	$dom->preserveWhiteSpace = false;
	@$dom->loadHTMLFile($some_link);			// Load the HTML file

    $domxpath = new DOMXPath($dom);
    $newDom = new DOMDocument;
    $newDom->formatOutput = true;
    $filtered = $domxpath->query("//a" . '[@' . "target='_blank']");	// Create the Query 
    $i = 0;
	$r = 0;
	$UCSIFees[0]=0;
    while( $myItem = $filtered->item($i++) ){
		$out= $myItem->nodeValue;					// Extract Node values
		if(strpos($out, "Fee" ) ==true )			
		{											// if any keyword is mentioned to "Fee", save it
			$UCSIFees[$r] = $out;
		}
        $node = $newDom->importNode( $myItem, true );    // import node			 
        $newDom->appendChild($node);                    // append node
		$test = $newDom->saveHTML();					// convert to string
		if(strpos($test, "Fee" ) ==true )		
		{												// gets the fees' pdf URL address
			$href = "http://lms.ucsi.edu.my".getAttribute('href', $test);
			$UCSILinks[$r] = $href;
			$r++;
		}
		$newDom->removeChild($node);					// reset object information 
    }		
 
	
	//get the UCLA programmes info
	$sunway = array ("Undergraduate Students - Resident","Undergraduate Students - Nonresident","Academic Master's Students - Resident","Academic Master's Students - Nonresident","Academic Doctoral Students - Resident","Academic Doctoral Students - Nonresident");	
	echo "<div class='textarea'>";
	echo "<div >";
	echo "<lable style='color:#bbb;font-size:20px;'>To Get Tuition Fees' Info, Choose Your Programmes;</lable></br></br>";	
	//sunway drop down	 
	echo "<lable style='color:#bbb;font-size:15px;'>UCLA University's Programmes</lable>";	 
	echo "<select name=selectBox3 id=selectBox3 onchange=addOption3(value); style='width: 550px; background-color:#f2f2f2;'>";
	echo "<option value=''>UCLA University's Programmes</option>";
	$N = count($dataUCLA);
	for($i=0; $i < $N; $i++){
	echo "<option value='$dataUCLA[$i]' >$sunway[$i]</option>";
	}
	echo "</select>";
	echo "</br>";
	// UCLA drop down
	echo "<lable style='color:#bbb;font-size:15px;'>CSU Northridge  University's Programmes</lable>";	
	echo "<select name=selectBox1 id=selectBox1 onchange=addOption1(value); style='width: 550px; background-color:#f2f2f2;'>";
	echo "<option value=''>CSU Northridge University's Programmes</option>";
	$N = count($dataCSUN);
	for($i=0; $i < $N; $i++){
	echo "<option value='$dataValueCSUN[$i]'>$dataCSUN[$i]</option>";
	}
	echo "</select>";	
	echo "</br>";	
	//CSUF drop down
	echo "<lable style='color:#bbb;font-size:15px;'>CSUF University's Programmes</lable>";	
	echo "<select name=selectBox2 id=selectBox2 onchange=addOption2(value); style='width: 550px; background-color:#f2f2f2;'>";
	echo "<option value=''>CSUF University's Programmes</option>";
	$N = count($CSUFProgrammes);
	for($i=0; $i < $N-1; $i++){
	echo "<option value='$data[$i]'>$CSUFProgrammes[$i]</option>";
	}
	echo "</select>";

	echo "</div>";
	echo "<br/>";
	echo "<div>";
	//CSU Northridge text area
	echo "<textarea rows=22 name=textBox1 id=textBox1 style='border: 0px solid #000000;background-color:#f2f2f2;'>";
	echo "</textarea>	";	
	//CSUF text area
	echo "<textarea rows=22 name=textBox2 id=textBox2 style='border: 0px solid #000000;background-color:#f2f2f2;'>";
	echo "</textarea>	";	
	//sunway text area
	echo "<textarea rows=22 name=textBox3 id=textBox3 style='border: 0px solid #000000;background-color:#f2f2f2;'>";
	echo "</textarea>	";
	//KDU text area
	echo "<textarea rows=22 name=textBox4 id=textBox4 style='border: 0px solid #000000;background-color:#f2f2f2;'>";
	echo "</textarea>	";	
	// UCSI text area
	$N = count($UCSIFees);	
	for($i=0; $i < $N; $i++){
	echo "<div class='UCSI' id='$UCSIFees[$i]' style='display:none;' >";
	echo "<label style=;font-family:Times New Roman;'><textarea rows=22  style='border: 0px solid #000000;background-color:#f2f2f2;'>UCSI University;		$UCSIFees[$i]	 Download the pdf file 
	</textarea><a href='$UCSILinks[$i]' target='_blank'> <img src='click.png'/>  </a></label>";	
	echo "</div>";	 	 
	}
	echo "</div>";
	echo "</div>";
?>
</div>
</td> 
</tr>
</table>
</body>
</html>