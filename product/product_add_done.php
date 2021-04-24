<body>

<?php

try
{

    $product_name = $_POST['name'];
    $product_price = $_POST['price'];

    $product_name = htmlspecialchars($product_name,ENT_QUOTES,'UTF-8');
    $product_price = htmlspecialchars($product_price,ENT_QUOTES,'UTF-8');

    $dsn = 'mysql:dbname=shop;host=localhost;charset=utf8';

    $user = 'suzu';
    $password ='u9oIjVjw1dSXbaPp';
    $dbh = new PDO($dsn,$user,$password);
    
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = 'INSERT INTO m_product(product_name,product_price) VALUES (?,?)';
    $stmt = $dbh->prepare($sql);
    $data[] = $product_name;
    $data[] = $product_price;
    $stmt->execute($data);

    $dbh = null;

    print $product_name;
    print 'を追加しました。<br />';
}
catch(Exception $e)
{
    print 'ただいま障害により大変ご迷惑をおかけしております';
    exit();
}

?>

<a href="product_list.php">戻る</a>

</body>