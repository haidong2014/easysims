<?

//phpinfo();


$hostname = "localhost";
$dbname = "student";
$uname = "root";
$upass = "easyss214W";


//MySQL �ɐڑ�����B
if( !$res_dbcon = mysql_connect( $hostname, $uname, $upass) ){
	print "MYSQL �ւ̐ڑ��Ɏ��s���܂����B";
	exit;
}
echo "success.";
?>