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

    $product_code = $_POST['product_code'];
    $product_gazou = $_POST['product_gazou'];

    $product_code = htmlspecialchars($product_code,ENT_QUOTES,'UTF-8');

    $dsn = 'mysql:dbname=shop;host=localhost;charset=utf8';

    $user = 'suzu';
    $password ='u9oIjVjw1dSXbaPp';
    $dbh = new PDO($dsn,$user,$password);
    
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = 'DELETE FROM m_product WHERE product_code=?';
    $stmt = $dbh->prepare($sql);
    $data[] = $product_code;
    $stmt->execute($data);

    $dbh = null;

    if($product_gazou !=""){
        unlink('./gazou/'.$product_gazou);
    }
}
catch(Exception $e)
{
    print 'ただいま障害により大変ご迷惑をおかけしております';
    exit();
}

?>
削除しました<br />
<br />
<a href="product_list.php">戻る</a>

</body>
</html>