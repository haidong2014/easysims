<?

//phpinfo();


$hostname = "localhost";
$dbname = "student";
$uname = "root";
$upass = "easyss214W";


//MySQL に接続する。
if( !$res_dbcon = mysql_connect( $hostname, $uname, $upass) ){
	print "MYSQL への接続に失敗しました。";
	exit;
}
echo "success.";
?>