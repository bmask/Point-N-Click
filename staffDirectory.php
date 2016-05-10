<!DOCTYPE html>
<html>
<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="css/styles.css" />
<link rel="stylesheet" type="text/css" href="css/loading.css" />
<link rel="stylesheet" type="text/css" href="jquery.tzCheckbox/jquery.tzCheckbox.css" />
<script src="js/jquery.min.js"></script>
<script src="jquery.tzCheckbox/jquery.tzCheckbox.js"></script>
<script src="js/script.js"></script>
</head>
<body bgcolor="#f2f2f2">
 <style type="text/css"> 
 h2{font-family:Georgia ; font-style: italic;font-variant: small-caps; font-size: 2.5em; color: #C0C0C0; text-align:left; padding:0; margin-top:-80px;margin-bottom:100px;margin-right:50px;margin-left:50px;}
 h1 {font-size: 4.5em; font-family: "Brush Script MT", cursive; color: #fced01; text-align:left; padding:0; margin-top:-80px;margin-bottom:100px;margin-right:50px;margin-left:80px;}
 #help {padding:0; margin-top:-130px;margin-bottom:100px;margin-right:-700px;}
 #logo {position:relative; padding:0; margin-top:-130px;margin-bottom:200px;margin-right:-200px;margin-left:200px;}
#page {position:absolute; padding:0; margin-top:-350px;margin-bottom:200px;margin-right:-300px;margin-left:600px;}
#button {position:relative; padding:0; margin-top:-480px;margin-bottom:200px;margin-right:-230px;margin-left:260px;}
#button ul { list-style-type: none; }
.dropdown {margin:0 -20px 0 0; background:#ededed}
.highlight{color:#bbb;}
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
<!-- loading -->
<div id="wait" style="display: none;">Please wait while loading...
<br/><img src="loading_animation.gif" alt="some_text"/>
</div>
<script type="text/javascript">
<!-- loading function -->
function WaitDiv()
{
	document.getElementById('wait').style.display = 'block';
}
</script>
<table border="0" width=100% height=100%>
<tr>
<td style="text-align: center; vertical-align: top;">
<img src="header.jpg" alt="header" />
<h1>Staff Directory</h1> 
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
<div id="page">
<form action="staffSearchResult.php" method="post">
	<ul>
		<li><label for="ch_location"> Add The Information to Your Search List </label></li>
		<li><label for="ch_location"> Select Your School </label>
		<SELECT class="dropdown">
		<OPTION  SELECTED> Computing School </OPTION>
		<OPTION CLASS="highlight"> Not Available </OPTION>
		<OPTION CLASS="highlight"> Not Available </OPTION>
		<OPTION CLASS="highlight"> Not Available </OPTION>
		<OPTION CLASS="highlight"> Not Available </OPTION>
		<OPTION CLASS="highlight"> Not Available </OPTION>
		<OPTION CLASS="highlight"> Not Available </OPTION>
		</SELECT>
		</li>
		<li><label for="ch_location"> Head of School </label>
			<input type="checkbox" name="schoolInfo[]" value="head" checked /> 
		</li>
		<li><label for="ch_location"> Programme Director(s) </label>
			<input type="checkbox" name="schoolInfo[]" value="director" checked /> 
		</li>
		<li><label for="ch_location"> Academic Staff </label>
			<input type="checkbox" name="schoolInfo[]" value="academic" checked /> 
		</li>
		<li><label for="ch_location"> Administrative Staff </label>
			<input type="checkbox" name="schoolInfo[]" value="administrative" checked /> 
		</li>
		<li> 	
			<button  class="classname" onclick="WaitDiv();" > Search </button>
		</li> 
	</ul>
</form>  
</div>
</td> 
</tr>
</table>
</body>

</html>