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

    $sql = 'SELECT product_code,product_price,product_name FROM m_product WHERE product_code=?';
    $stmt = $dbh->prepare($sql);//SQL文のセット
    $data[]=$product_code;
    $stmt->execute($data);//実行

    $record = $stmt->fetch(PDO::FETCH_ASSOC);
    $product_code = $record['product_code'];
    $product_name = $record['product_name'];
    $product_price = $record['product_price'];
    $dbh = null;
}
catch(Exception $e)
{
    print 'ただいま障害により大変ご迷惑をおかけしています。';
    exit();
}
?>

商品修正<br />
<br />
商品コード<br />
<?php print $product_code;?>
<br />
<br />
<form method="post" action="product_edit_check.php">
<input type="hidden" name="product_code" value="<?php print $product_code;?>">
商品名<br />
<input type="text" name="product_name" style="width:200px" value="<?php print $product_name;?>"><br />

価格<br />
<input type="text" name="product_price" style="width: 50px;" value="<?php print $product_price;?>"><br />
<br />
<input type="button" onclick="history.back()" value="戻る">
<input type="submit" value="OK">
</form>
</body>