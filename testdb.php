<?

//phpinfo();


$hostname = "localhost";
$dbname = "student";
$uname = "root";
$upass = "easyss214W";


//MySQL ‚ÉÚ‘±‚·‚éB
if( !$res_dbcon = mysql_connect( $hostname, $uname, $upass) ){
	print "MYSQL ‚Ö‚ÌÚ‘±‚ÉŽ¸”s‚µ‚Ü‚µ‚½B";
	exit;
}
echo "success.";
?>