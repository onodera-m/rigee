<?php

error_reporting(0);//Noticeエラー非表示
session_start();
session_regenerate_id(true);



print '<img src="../rigee-bicycle/logo-rigee2.png" alt="logo"></a>';
print '<img src="../rigee-bicycle/logo-t.png" alt="logo2"></a>';
//print '<a href="shop_list.php"><img src="../rigee-bicycle/nav01.png" alt="login"></a>';
//print '<a href="shop_cartlook.php"><img src="../rigee-bicycle/nav02.png" alt=""></a>';
//print '<a href="member_login.html"><img src="../rigee-bicycle/nav04.png" alt="login"></a><br />';
if (isset($_SESSION['member_login']) == false)
{
	print '<a href="shop_list.php"><img src="../rigee-bicycle/nav01.png" alt="login"></a>';
	print '<a href="shop_cartlook.php"><img src="../rigee-bicycle/nav02.png" alt="cart"></a>';
	print '<a href="member_login.html"><img src="../rigee-bicycle/nav04.png" alt="login"></a><br />';
	print 'ようこそゲスト様　';
	//print //'<a href="member_login.html">会員ログイン</a><br />';
	print '<br />';
}
else
{
	print '<a href="shop_list.php"><img src="../rigee-bicycle/nav01.png" alt="login"></a>';
	print '<a href="shop_cartlook.php"><img src="../rigee-bicycle/nav02.png" alt="cart"></a>';
	print '<a href="member_logout.html"><img src="../rigee-bicycle/nav04.png" alt="logout"></a><br />';
	print 'ようこそ';
	print $_SESSION['member_name'];
	print ' 様　';
	//print '<a href="member_logout.php">ログアウト</a><br />';
	print '<br />';
}
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>ユビーネット</title>
</head>
<body>

<?php

try
{

$dsn = 'mysql:dbname=rigee;host=localhost;charset=utf8';
$user = 'root';
$password = '';
$dbh = new PDO($dsn,$user,$password);
$dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

$sql = 'SELECT code,name,price FROM mst_product WHERE 1';
$stmt = $dbh->prepare($sql);
$stmt->execute();

$dbh = null;

print '商品一覧<br /><br />';

$w=date("w");

print '<a href="shop_product.php?procode='.$rec['code'].'"><img src="../rigee-bicycle/bm0'.$w.'s.jpg" alt="bm0'.$w.' width="300" height="300">';
while (true)
{


	$rec = $stmt->fetch(PDO::FETCH_ASSOC);
	if ($rec == false)
	{
		break;
	}

	$i++;

	print '<a href="shop_product.php?procode='.$rec['code'].'"><img src="../rigee-bicycle/bm0'.$i.'s.jpg" alt="bm0'.$i.' width="300" height="300">';
	 //'</div>';
	//print '<a href="shop_product.php?procode='.$rec['code'].'">';
	//print $rec['name'].'---';
	//print $rec['price'].'円';
	//print '<CENTER>';
	if($i/1==1)
	{
		print '<br />';
		print '<div align="center">';
	}
	if($i%4==0)
	{print '<br />';
	}
	//print '</a>';
	//print '<br />';
}

//print '<br />';


}
catch (Exception $e)
{
	 print 'ただいま障害により大変ご迷惑をお掛けしております。';
	 exit();
}

?>

</body>
</html>
