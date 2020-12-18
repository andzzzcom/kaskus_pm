<?php
error_reporting(0);

$username = $_GET['user'];
$password = $_GET['pass'];
$penerima = $_GET['penerima'];
$judul = $_GET['judul'];
$pesan = $_GET['pesan'];

$cookie = "cookie.txt";
$loginUrl = 'https://m.kaskus.co.id/user/login/';
$arraynama = array();
$arraypassword = array();

$ch = curl_init();

$ch = open($ch, $loginUrl);

$totalline=0;
foreach(file($file) as $line) 
{
	$source =  explode(' ',$line);
	
	array_push($arraynama, $source[0]);
	array_push($arraypassword, $source[1]);
	
	$totalline++;
}


$ch = login($ch, $username, $password, $cookie);

$content = curl_exec($ch);
if(strpos($content, "logging in") !== false)
{

}else
{
	echo"gagal";
	die();
	
}

$url = "http://www.kaskus.co.id/pm/compose";
$ch = open($ch,$url);
$content = curl_exec($ch);

$code = getcode($content);

$ch = pm($ch,$penerima, $judul, $pesan,$code, $cookie);


$content = curl_exec($ch);


if(strpos($content, "sent") !== false)
{
	echo"Berhasil";
}else
{
	echo"Gagal";
}


curl_close($ch);

unlink("/".$cookie);





function open($ch, $url)
{
	curl_setopt( $ch, CURLOPT_URL, $url);
	curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, false);
	
	return $ch;
}

function login($ch, $username, $password, $cookie)
{
	curl_setopt( $ch, CURLOPT_POST, 1);

	curl_setopt( $ch, CURLOPT_POSTFIELDS, 'username='.$username.'&password='.$password );
	
	curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt( $ch, CURLOPT_COOKIESESSION, true );
	curl_setopt( $ch, CURLOPT_COOKIEJAR, '/'.$cookie   );
	curl_setopt( $ch, CURLOPT_COOKIEFILE, '/'.$cookie  );
	
	return $ch;
}

function pm($ch,$penerima, $judul, $pesan,$token, $cookie)
{
	curl_setopt( $ch, CURLOPT_POST, 1);

	curl_setopt( $ch, CURLOPT_POSTFIELDS, 'recipient='.$penerima.'&subject='.$judul.'&message='.$pesan.'&txtLen=100&securitytoken='.$token );
	
	curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt( $ch, CURLOPT_COOKIESESSION, true );
	curl_setopt( $ch, CURLOPT_COOKIEJAR, '/'.$cookie   );
	curl_setopt( $ch, CURLOPT_COOKIEFILE, '/'.$cookie  );;
	
	return $ch;
}


function getcode($content)
{
	$temp = explode('Send to',htmlentities($content));
	
	$temp2 = explode("Site Footer",$temp[1]);
	
	$codenya = substr($temp2[0],2162,43);
	return $codenya;
}
?>