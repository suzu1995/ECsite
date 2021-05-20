
<?php
session_start();
session_regenerate_id(true);


if(isset($_SESSION['member_login'])==false){
    print 'ようこそゲスト様<br />';
    print '<a href="member_login.html">会員ログイン</a><br />';
}else{
    print 'ようこそ';
    print $_SESSION['member_name'];
    print '様　';
    print '<a href="member_logout.php">ログアウト</a>';
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

try{
    $dsn = 'mysql:dbname=shop;host=localhost;charset=utf8';
    $user = 'suzu';
    $password ='u9oIjVjw1dSXbaPp';
    $dbh = new PDO($dsn, $user,$password);
    $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    //ここまでDBへの接続 エラーの設定

    $sql = 'SELECT product_code,product_price,product_name FROM m_product WHERE 1';
    $stmt = $dbh->prepare($sql);//SQL文のセット
    $stmt->execute();//実行

    $dbh = null;

    print '商品一覧<br /><br />';
    while(true)
    {
        $rec = $stmt->fetch(PDO::FETCH_ASSOC);
        if($rec==false)
        {
            break;
        }
        print '<a href="shop_product.php?procode='.$rec['code'].'">';
        print $rec['product_name'].'---';
        print $rec['product_price'].'円';
        print '</a>';
        print '<br />';
    }
}
catch(Exception $e){
    print 'ただいま障害により大変ご迷惑をおかけしています';
    exit();
}
?>
</body>
</html>