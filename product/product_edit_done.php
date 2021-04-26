<body>

<?php

try
{

    $product_code = $_POST['product_code'];
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];

    $product_code = htmlspecialchars($product_code,ENT_QUOTES,'UTF-8');
    $product_name = htmlspecialchars($product_name,ENT_QUOTES,'UTF-8');
    $product_price = htmlspecialchars($product_price,ENT_QUOTES,'UTF-8');

    $dsn = 'mysql:dbname=shop;host=localhost;charset=utf8';

    $user = 'suzu';
    $password ='u9oIjVjw1dSXbaPp';
    $dbh = new PDO($dsn,$user,$password);
    
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = 'UPDATE m_product SET product_name=?,product_price=? WHERE product_code=?';
    $stmt = $dbh->prepare($sql);
    $data[] = $product_name;
    $data[] = $product_price;
    $data[] = $product_code;
    $stmt->execute($data);

    $dbh = null;
}
catch(Exception $e)
{
    print 'ただいま障害により大変ご迷惑をおかけしております';
    exit();
}

?>
修正しました<br />
<br />
<a href="product_list.php">戻る</a>

</body>