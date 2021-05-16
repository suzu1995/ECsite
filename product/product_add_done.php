<?php
session_start();
session_regenerate_id(true);
if(isset($_SESSION['login'])==false){
    print 'ログインされていません。<br />';
    print '<a href=../staff_login/staff_login.html>ログイン画面へ</a>';
    exit();
}else{
    print $_SESSION['staff_name'];
    print 'さんログイン中<br />';
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

    $product_name = $_POST['name'];
    $product_price = $_POST['price'];
    $product_gazou = $_POST['gazou_name'];

    $product_name = htmlspecialchars($product_name,ENT_QUOTES,'UTF-8');
    $product_price = htmlspecialchars($product_price,ENT_QUOTES,'UTF-8');

    $dsn = 'mysql:dbname=shop;host=localhost;charset=utf8';

    $user = 'suzu';
    $password ='u9oIjVjw1dSXbaPp';
    $dbh = new PDO($dsn,$user,$password);
    
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = 'INSERT INTO m_product(product_name,product_price,product_gazou) VALUES (?,?,?)';
    $stmt = $dbh->prepare($sql);
    $data[] = $product_name;
    $data[] = $product_price;
    $data[] = $product_gazou;
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
</html>