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

	require_once('../common/common.php');

	$post=sanitize($_POST);

	$max=$post['max'];
	for($i=0;$i<$max;$i++)
	{
		if(preg_match("/^[0-9]+$/", $post['kazu'.$i])==0)
		{
			print '数量に誤りがあります。';
			print '<a href="shop_cartlook.php">カートに戻る</a>';
			exit();
		}
		if($post['kazu'.$i]<1 || 10<$post['kazu'.$i])
		{
			print '数量は必ず1個以上、10個までです。';
			print '<a href="shop_cartlook.php">カートに戻る</a>';
			exit();
		}
		$kazu[]=$post['kazu'.$i];
	}

	$cart=$_SESSION['cart'];

	for($i=$max;0<=$i;$i--)
	{
		if(isset($_POST['sakujo'.$i])==true)
		{
			array_splice($cart,$i,1);
			array_splice($kazu,$i,1);
		}
	}

	$_SESSION['cart']=$cart;
	$_SESSION['kazu']=$kazu;

	header('Location:shop_cartlook.php');
?>
