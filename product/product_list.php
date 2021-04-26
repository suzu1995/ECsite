
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
    print '<form method="post" action="product_branch.php">';
    while(true)
    {
        $rec = $stmt->fetch(PDO::FETCH_ASSOC);
        if($rec==false)
        {
            break;
        }
        print '<input type="radio" name="product_code" value="'.$rec['product_code'].'">';
        print $rec['product_name'].'---';
        print $rec['product_price'].'円';
        print '<br />';
    }
    print '<input type="submit" name="disp" value="参照">';
    print '<input type="submit" name="add" value="追加">';
    print '<input type="submit" name="edit" value="修正">';
    print '<input type="submit" name="delete" value="削除">';
    print '</form>';
}
catch(Exception $e){
    print 'ただいま障害により大変ご迷惑をおかけしています';
    exit();
}
?>
</body>