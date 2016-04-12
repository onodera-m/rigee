<?php
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

$pro_code = $_GET['procode'];

$dsn = 'mysql:dbname=rigee;host=localhost;charset=utf8';
$user = 'root';
$password = '';
$dbh = new PDO($dsn,$user,$password);
$dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

$sql = 'SELECT name,price,gazou FROM mst_product WHERE code=?';
$stmt = $dbh->prepare($sql);
$data[] = $pro_code;
$stmt->execute($data);

$rec = $stmt->fetch(PDO::FETCH_ASSOC);
$pro_name = $rec['name'];
$pro_price = $rec['price'];
$pro_gazou_name = $rec['gazou'];

$dbh = null;

if ($pro_gazou_name == '')
{
	$disp_gazou='';
}
else
{
	$disp_gazou='<img src="../product/gazou/'.$pro_gazou_name.'">';
}
print '<a href="shop_cartin.php?procode='.$pro_code.'">カートに入れる</a><br /><br />';

}
catch(Exception $e)
{
	print'ただいま障害により大変ご迷惑をお掛けしております。';
	exit();
}

?>

商品情報参照<br />
<br />
商品コード<br />
<?php print $pro_code; ?>
<br />
商品名<br />
<?php print $pro_name; ?>
<br />
価格<br />
<?php print $pro_price; ?>円
<br />
<?php print $disp_gazou; ?>
<br />
<br />
<form>
<input type="button" onclick="history.back()" value="戻る">
</form>

</body>
</html>
