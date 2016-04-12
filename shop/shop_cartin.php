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

if (isset($_SESSION['cart']) == true)
{
	$cart = $_SESSION['cart'];
	$kazu = $_SESSION['kazu'];
	if (in_array($pro_code,$cart) == true)
	{
		print 'その商品はすでにカートに入っています。<br />';
		print '<a href="shop_list.php">商品一覧に戻る</a>';
		exit();
	}
}
$cart[] = $pro_code;
$kazu[] = 1;
//var_dump($cart);
//var_dump($kazu);
$_SESSION['cart'] = $cart;
$_SESSION['kazu'] = $kazu;

}
catch(Exception $e)
{
	print 'ただいま障害により大変ご迷惑をお掛けしております。';
	exit();
}

?>

カートに追加しました。<br />
<br />
<a href="shop_list.php">商品一覧に戻る</a>

</body>
</html>
