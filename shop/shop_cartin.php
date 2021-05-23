<?php
session_start();
session_regenerate_id(true);
if(isset($_SESSION['member_login'])==false){
    print 'ようこそゲストさん　';
    print '<a href="member_login.html">会員ログイン</a>';
    print '<br />';
}else{
    print 'ようこそ';
    print $_SESSION['member_name'];
    print '様';
    print '<a href="member_logout">ログアウト</a><br />';
    print '<br />';
}
?>
<!DECOTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>ろくまる農園</title>
</head>
<body>
<?php

try
{
    $product_code = $_GET['product_code'];

    if(isset($_SESSION['cart'])==true){
        $cart = $_SESSION['cart'];
        $kazu = $_SESSION['kazu'];
    }
    $cart[] = $product_code;
    $kazu[] = 1;
    $_SESSION['cart'] = $cart;
    $_SESSION['kazu'] = $kazu;

    foreach($cart as $key => $pcode){
        print $pcode;
        print '<br />';
    }

}
catch(Exception $e)
{
    print 'ただいま障害により大変ご迷惑をおかけしています。';
    exit();
}
?>
カートに追加しました。<br />
<br />
<a href="shop_list.php">商品一覧に戻る</a>

</body>
</html>