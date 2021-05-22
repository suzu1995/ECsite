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

    $dsn = 'mysql:dbname=shop;host=localhost;charset=utf8';
    $user = 'suzu';
    $password ='u9oIjVjw1dSXbaPp';
    $dbh = new PDO($dsn, $user,$password);
    $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

    $sql = 'SELECT product_price,product_name,product_gazou FROM m_product WHERE product_code=?';
    $stmt = $dbh->prepare($sql);//SQL文のセット
    $data[]=$product_code;
    $stmt->execute($data);//実行

    $record = $stmt->fetch(PDO::FETCH_ASSOC);
    $product_name = $record['product_name'];
    $product_price = $record['product_price'];
    $product_gazou = $record['product_gazou'];
    $dbh = null;

    if($product_gazou == ""){
        $gazou = "";
    }else{
        $gazou = '<img src="../product/gazou/'.$product_gazou.'">';
    }
    print '<a href="shop_cartin.php?product_code='.$product_code.'">カートに入れる</a><br /><br />';

}
catch(Exception $e)
{
    print 'ただいま障害により大変ご迷惑をおかけしています。';
    exit();
}
?>

商品参照情報<br />
<br />
商品名<br />
<?php print $product_name;?>
<br />
値段<br />
<?php print $product_price;?>
<br />
<?php print $gazou;?><br />
<form>
<input type="button" onclick="history.back()" value="戻る">
</form>
</body>
</html>