<html>
<head>
<title>Kaskus Auto PM 1.0</title>
<link href="style/style.css" rel="stylesheet" type="text/css">
</head>

<body bgcolor="#E8EDEE">



<div class="maindiv">
	<div class="header">
		Kaskus Auto PM 1.0
		<br>
		<span class="subketerangan">Auto PM For Kaskus </span>
	</div>

	<div class="mainform">
		<div class="mainleft">
			<div class="headermain"><img class="imgpreview" src="style/img/account.png">&nbsp Sender Account</div>
			<div class="intimain">
				Username : <input class="textnya" id="usernamenya" type="text" placeholder="Username" required><br>
				Password :&nbsp <input class="textnya" id="passwordnya" type="password" placeholder="Password" required>
			</div>
		</div>
		<div class="mainright">
			<div class="headermain"><img class="imgpreview" src="style/img/user.png">&nbsp Recipient User</div>
			<div class="intimain">
				<br>
				<input type="text" class="textnya" id="penerima" placeholder="Recipient User Kaskus" required>
			
			</div>		
		</div>
		<div class="mainsubmit">
			<img onclick="pm()" src="style/img/play.png" class="imgplay" alt="Start" title="Start">
			<br>
			Status PM:<br>
			<i><div id="pmstatus">Belum Mulai</div></i>
		
		</div>
	</div>
	
	<div class="inputmsg">
		<div class="headermain2">Your Message</div>
		<div class="msgnya">
			Title : <input class="textnya2" id="judul" type="text" placeholder="Title Message" required><br>
			Content : <br> <textarea id="pesan" class="teksareanya" cols="80" rows="5" placeholder="Message"></textarea>
		</div>
	</div>
	
	<div class="status">@2016 AutoPM</div>

</div>





</body>
</html>


<script type="text/javascript">

var idok=0;
var idno=0;
function pm()
{
	
	var usernamenya = document.getElementById("usernamenya").value;
	var passwordnya = document.getElementById("passwordnya").value;
	var penerima = document.getElementById("penerima").value;
	var judul = document.getElementById("judul").value;
	var pesan = document.getElementById("pesan").value;
	if(usernamenya=="" | passwordnya=="" | penerima=="" | judul=="" | pesan=="")
	{
		document.getElementById("pmstatus").innerHTML = "Gagal";
	}else{
		
		pmhelper();
	}
	
}

function pmhelper()
{
	document.getElementById("pmstatus").innerHTML = "Loading .. ";
	
	
		var usernamenya = document.getElementById("usernamenya").value;
		var passwordnya = document.getElementById("passwordnya").value;
		var penerima = document.getElementById("penerima").value;
		var judul = document.getElementById("judul").value;
		var pesan = document.getElementById("pesan").value;
		
		
		repeatloop(usernamenya,passwordnya,penerima, judul,pesan);
		
		
	
}

	function createajax()
	{
		if(window.XMLHttpRequest)
			return new XMLHttpRequest();
		if(window.ActiveXObject)
			return new ActiveXObject("MicrosoftXMLHTTP");
	}
	
	function repeatloop(usernamenya,passwordnya,penerima, judul,pesan)
	{
		sendRequest('pm.php?penerima='+penerima+'&&user='+usernamenya+'&&pass='+passwordnya+'&&judul='+judul+'&&pesan='+pesan);
		
	}
	
	
	
	var http = createajax();
	function sendRequest(page) 
	{
		// Open PHP script for requests
		http.open('get', page);
		http.onreadystatechange = handleResponse;
		http.send(null);
	
	}
	
	function handleResponse() 
	{
		if(http.readyState == 4 && http.status == 200)
		{
			// Text returned FROM the PHP script
			var response = http.responseText;
			if(response =="Gagal")
			{
				
				document.getElementById("pmstatus").innerHTML = "Gagal";
			
				
			}else{
				document.getElementById("pmstatus").innerHTML = "Berhasil";
			}
			
			
		}
	}

</script>