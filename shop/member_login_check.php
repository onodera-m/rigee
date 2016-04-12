<?php


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

try
{

require_once('../common/common.php');

$post=sanitize($_POST);
$member_email=$post['email'];
$member_pass=$post['pass'];

$member_pass=md5($member_pass);

$dsn='mysql:dbname=rigee;host=localhost;charset=utf8';
$user='root';
$password='';
$dbh=new PDO($dsn,$user,$password);
$dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

$sql='SELECT code,name FROM dat_member WHERE email=? AND password=?';
$stmt=$dbh->prepare($sql);
$data[]=$member_email;
$data[]=$member_pass;
$stmt->execute($data);

$dbh=null;

$rec=$stmt->fetch(PDO::FETCH_ASSOC);

if($rec==false)
{
	print 'メールアドレスかパスワードが間違っています。<br />';
	print '<a href="member_login.html"> 戻る</a>';
}
else
{
	session_start();
	$_SESSION['member_login']=1;
	$_SESSION['member_code']=$rec['code'];
	$_SESSION['member_name']=$rec['name'];
	header('Location:shop_list.php');
	exit();
}

}
catch(Exception $e)
{
	print 'ただいま障害により大変ご迷惑をお掛けしております。';
	exit();
}

?>